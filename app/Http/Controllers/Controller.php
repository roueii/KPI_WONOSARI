<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Data user cadangan saat belum login (mode demo). Tiap controller role mengisi sendiri.
     */
    protected array $defaultUser = ['name' => 'User', 'email' => 'User@capaian.id'];

    /**
     * User yang sedang login (dari session), atau $defaultUser jika belum ada.
     */
    protected function currentUser(): array
    {
        return session('user', $this->defaultUser);
    }

    /**
     * Detail riwayat dari Backend (KpiHistoryService::detail) -> bentuk $detailRiwayat
     * yang dipakai view detail_riwayat Driver & Produksi.
     *
     * Catatan: Backend mengelompokkan per KATEGORI KPI, bukan per langkah form Figma,
     * sehingga tautan kategori / "Perbaiki Capaian" diarahkan ke langkah pertama form.
     */
    protected function liveDetailRiwayat(array $live, string $formUrl): array
    {
        return [
            'id' => $live['short_date'],
            'title' => $live['title'],
            'status' => $live['status'],
            'status_label' => $live['status_label'],
            'sent_at' => $live['sent_label'],
            'revision_note' => [
                'label' => 'CATATAN REVISI',
                'requested_by' => $live['revision']['requested_by'] ?? '-',
                'requested_at' => $live['revision']['requested_at'] ?? '',
                'message' => $live['revision']['message'] ?? '',
                'repair_url' => $formUrl,
                'repair_label' => 'PERBAIKI CAPAIAN',
            ],
            'categories_summary' => [
                'total_label' => count($live['categories']) . ' Kategori',
                'items' => array_map(fn ($c) => [
                    'id' => $c['name'],
                    'title' => $c['name'],
                    'badge' => $c['needs_revision'] ? 'PERLU REVISI' : null,
                    'subtitle' => $c['subtitle'],
                    'icon' => $c['icon'],
                    'is_highlighted' => $c['needs_revision'],
                    'url' => $formUrl,
                ], $live['categories']),
            ],
            'notice' => 'Catatan: Laporan ini perlu direvisi sesuai catatan reviewer. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.',
        ];
    }

    /**
     * Detail riwayat dari Backend -> [$reportMeta, $revisionNote, $categories]
     * yang dipakai view detail_riwayat Frontliner & Store Manager.
     */
    protected function liveReportDetail(array $live, string $formUrl): array
    {
        $reportMeta = [
            'title' => $live['title'],
            'submitted_at' => $live['sent_label'],
            'status' => $live['status_label'],
            'is_revisi' => $live['is_revision'],
        ];

        $revisionNote = [
            'requester' => $live['revision']['requested_by'] ?? '-',
            'time' => $live['revision']['requested_at'] ?? '',
            'text' => ! empty($live['revision']['message']) ? '"' . $live['revision']['message'] . '"' : '',
            'cta_title' => 'PERBAIKI CAPAIAN',
            'cta_url' => $formUrl,
        ];

        $categories = array_map(fn ($c) => [
            'id' => $c['name'],
            'name' => $c['name'],
            'subtitle' => $c['subtitle'],
            'is_revisi' => $c['needs_revision'],
            'icon' => $c['icon'],
            'url' => $formUrl,
        ], $live['categories']);

        return [$reportMeta, $revisionNote, $categories];
    }
}
