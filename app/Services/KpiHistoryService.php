<?php

namespace App\Services;

use Carbon\Carbon;

/**
 * Riwayat capaian dari Backend:
 *   GET /api/my-kpis/history          -> daftar laporan (1 baris = 1 tanggal laporan)
 *   GET /api/my-kpis/history/{date}   -> detail laporan per kategori + catatan revisi
 *
 * Backend mengenali laporan lewat TANGGAL (Y-m-d), sedangkan route Frontend memakai {id} angka.
 * Karena itu tanggal dikodekan sebagai id angka Ymd (mis. 20261120). Id data dummy (1..11) tidak bentrok.
 *
 * Semua method mengembalikan null bila sesi belum login lewat Backend / Backend gagal,
 * sehingga controller tetap memakai data dummy.
 */
class KpiHistoryService
{
    private const TZ = 'Asia/Jakarta';

    /** Status laporan Backend -> [status Frontend, label] */
    private const STATUS = [
        'APPROVED' => ['disetujui', 'Disetujui'],
        'PENDING' => ['menunggu', 'Menunggu'],
        'REVISION' => ['revisi', 'Revisi'],
    ];

    public static function idFromDate(string $date): int
    {
        return (int) str_replace('-', '', substr($date, 0, 10));
    }

    /** Id angka Ymd -> 'Y-m-d', atau null jika id bukan tanggal (mis. id data dummy). */
    public static function dateFromId($id): ?string
    {
        if (! is_numeric($id) || strlen((string) $id) !== 8) {
            return null;
        }

        $d = \DateTime::createFromFormat('!Ymd', (string) $id);

        return $d && $d->format('Ymd') === (string) $id ? $d->format('Y-m-d') : null;
    }

    /**
     * @return array{summary: array{disetujui:int, menunggu:int, revisi:int, semua:int}, items: array<int, array>}|null
     */
    public static function list(): ?array
    {
        $json = BackendApiService::fetch('my-kpis/history', ['per_page' => 100]);
        if (! is_array($json) || ! isset($json['data'])) {
            return null;
        }

        $s = $json['summary'] ?? [];
        $summary = [
            'disetujui' => (int) ($s['approved'] ?? 0),
            'menunggu' => (int) ($s['pending'] ?? 0),
            'revisi' => (int) ($s['revision'] ?? 0),
            'semua' => (int) ($s['all'] ?? 0),
        ];

        $items = array_map(function (array $r) {
            $date = Carbon::parse($r['report_date'])->locale('id');
            [$status, $label] = self::STATUS[$r['status'] ?? ''] ?? ['menunggu', $r['status_label'] ?? 'Menunggu'];
            $checklist = ($r['filled_count'] ?? 0) . '/' . ($r['total_count'] ?? 0) . ' Checklist terisi';

            return [
                'id' => self::idFromDate($r['report_date']),
                'date' => $r['report_date'],
                'day_name' => $date->translatedFormat('D'),
                'day_num' => $date->format('d'),
                'full_date' => $date->translatedFormat('d M Y'),
                'short_date' => $date->translatedFormat('d M'),
                'date_formatted' => $date->translatedFormat('d M Y'),
                'category_info' => $checklist,
                'checklist_text' => $checklist,
                'status' => $status,
                'status_label' => $label,
            ];
        }, $json['data']);

        return ['summary' => $summary, 'items' => $items];
    }

    /**
     * @return array{
     *   title: string, short_date: string, full_date: string, sent_label: string,
     *   is_revision: bool, status: string, status_label: string,
     *   revision: array{requested_by: string, requested_at: string, message: string}|null,
     *   categories: array<int, array{name: string, filled: int, total: int, needs_revision: bool, subtitle: string, icon: string}>
     * }|null
     */
    public static function detail(string $date): ?array
    {
        $d = BackendApiService::fetch('my-kpis/history/' . $date)['data'] ?? null;
        if (! is_array($d)) {
            return null;
        }

        $day = Carbon::parse($d['report_date'])->locale('id');
        $isRevision = ($d['status'] ?? '') === 'REVISION';
        [, $label] = self::STATUS[$d['status'] ?? ''] ?? [null, $d['status_label'] ?? ''];

        $sent = ! empty($d['submitted_at'])
            ? Carbon::parse($d['submitted_at'])->setTimezone(self::TZ)->locale('id')->translatedFormat('d M Y, H:i') . ' WIB'
            : $day->translatedFormat('d M Y');

        $revision = null;
        if ($isRevision && ! empty($d['revision'])) {
            $by = $d['revision']['requested_by'] ?? [];
            $name = $by['name'] ?? 'Reviewer';
            $position = $by['position'] ?? '';
            $revision = [
                // Tambahkan jabatan hanya jika belum tercantum di nama (mis. "Budi (Store Manager)")
                'requested_by' => $position !== '' && ! str_contains($name, $position) ? "{$name} ({$position})" : $name,
                'requested_at' => ! empty($d['revision']['reviewed_at'])
                    ? Carbon::parse($d['revision']['reviewed_at'])->setTimezone(self::TZ)->locale('id')->translatedFormat('d M, H:i') . ' WIB'
                    : '',
                'message' => (string) ($d['revision']['notes'] ?? ''),
            ];
        }

        $categories = array_map(function (array $c) {
            $name = $c['category']['name'] ?? 'Kategori';
            $filled = (int) ($c['filled_count'] ?? 0);
            $total = (int) ($c['total_count'] ?? 0);
            $needs = (bool) ($c['needs_revision'] ?? false);

            return [
                'name' => $name,
                'filled' => $filled,
                'total' => $total,
                'needs_revision' => $needs,
                'subtitle' => $needs
                    ? 'Perlu Revisi' . (! empty($c['revision_note']) ? ' · ' . $c['revision_note'] : '')
                    : "{$filled}/{$total} checklist selesai",
                'icon' => self::iconFor($name),
            ];
        }, $d['categories'] ?? []);

        return [
            'title' => 'Riwayat — ' . $day->translatedFormat('d M'),
            'short_date' => $day->translatedFormat('d M'),
            'full_date' => $day->translatedFormat('d M Y'),
            'sent_label' => 'Dikirim ' . $sent,
            'is_revision' => $isRevision,
            'status' => $isRevision ? 'revisi' : (($d['status'] ?? '') === 'APPROVED' ? 'disetujui' : 'menunggu'),
            'status_label' => strtoupper($isRevision ? 'Perlu Revisi' : $label),
            'revision' => $revision,
            'categories' => $categories,
        ];
    }

    /** Ikon kategori Backend (nama kategori dari seeder Backend). */
    private static function iconFor(string $category): string
    {
        $map = [
            'Penjualan' => 'cash',
            'Laba & Biaya' => 'dollar',
            'Persediaan & Stok' => 'box',
            'Pelayanan Pelanggan' => 'headset',
            'Operasional & SOP' => 'shield-check',
            'Kebersihan & Display' => 'sparkles',
            'SDM & Disiplin' => 'user',
            'Produksi' => 'box',
            'Pengiriman & Kendaraan' => 'truck',
            'Marketing & Promosi' => 'megaphone',
        ];

        return $map[$category] ?? 'document';
    }
}
