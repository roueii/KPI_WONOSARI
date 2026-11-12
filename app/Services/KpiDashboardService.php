<?php

namespace App\Services;

/**
 * Mengolah GET /api/my-kpis (Backend) menjadi ringkasan dashboard karyawan.
 *
 * Catatan: Backend mengelompokkan indikator per KATEGORI KPI (mis. "Pengiriman & Kendaraan"),
 * bukan per langkah form Figma. Karena itu label progres di dashboard mengikuti kategori Backend.
 */
class KpiDashboardService
{
    private const DONE = ['SUBMITTED', 'APPROVED'];

    /**
     * @return array{summary: array, groups: array<int, array>}|null  null jika Backend tidak tersedia / kosong
     */
    public static function myKpis(): ?array
    {
        $json = BackendApiService::fetch('my-kpis');
        $items = $json['data'] ?? null;

        if (! is_array($items) || count($items) === 0) {
            return null;
        }

        $groups = [];
        foreach ($items as $pk) {
            $category = $pk['indicator']['category']['name'] ?? 'Lainnya';
            $status = $pk['submission']['status'] ?? null;

            $groups[$category] ??= ['name' => $category, 'completed' => 0, 'total' => 0, 'rejected' => 0];
            $groups[$category]['total']++;
            if (in_array($status, self::DONE, true)) {
                $groups[$category]['completed']++;
            }
            if ($status === 'REJECTED') {
                $groups[$category]['rejected']++;
            }
        }

        $groups = array_values(array_map(function ($g) {
            $g['percentage'] = $g['total'] ? (int) round($g['completed'] / $g['total'] * 100) : 0;

            if ($g['rejected'] > 0) {
                [$g['status'], $g['status_label'], $g['badge_type']] = ['tidak_tercapai', 'Tidak tercapai', 'danger'];
            } elseif ($g['completed'] >= $g['total']) {
                [$g['status'], $g['status_label'], $g['badge_type']] = ['tercapai', 'Tercapai', 'success'];
            } else {
                [$g['status'], $g['status_label'], $g['badge_type']] = ['belum_diisi', 'Belum diisi', 'warning'];
            }

            return $g;
        }, $groups));

        $completed = array_sum(array_column($groups, 'completed'));
        $total = array_sum(array_column($groups, 'total'));

        return [
            'summary' => [
                'completed' => $completed,
                'total' => $total,
                'label' => $completed . '/' . $total,
                'status_text' => 'Tuntas',
                'percentage' => $total ? (int) round($completed / $total * 100) : 0,
            ],
            'groups' => $groups,
        ];
    }

    /**
     * Profil user dari Backend (GET /api/me) digabung ke data default.
     */
    public static function mergeProfile(array $user): array
    {
        $me = BackendApiService::fetch('me');
        if (! $me) {
            return $user;
        }

        return array_merge($user, array_filter([
            'name' => $me['name'] ?? null,
            'email' => $me['email'] ?? null,
        ]));
    }
}
