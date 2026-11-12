<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller dasar untuk role KPI berbasis checklist multi-langkah
 * (dipakai oleh Sales & Marketing dan Supervisor).
 *
 * Seluruh konten (langkah, indikator, label) didefinisikan sebagai data di
 * method roleConfig() milik subclass, sehingga saat integrasi Backend cukup
 * mengganti sumber data (session dummy -> BackendApiService) tanpa
 * menyentuh Blade.
 */
abstract class ChecklistRoleController extends Controller
{
    /**
     * Konfigurasi role. Struktur:
     * - key, route (prefix nama route), label, badge, drawer_label, help_text
     * - steps: [slug => [title, short_title, preview_title, subtitle, card_title,
     *           tag, card_sub, notice, notice_type, upload?, items => [key => [title, desc]]]]
     * - dummy: data contoh dashboard/riwayat/detail sebelum Backend tersambung
     */
    abstract protected function roleConfig(): array;

    protected function config(): array
    {
        static $cache = [];
        return $cache[static::class] ??= $this->roleConfig();
    }

    protected function sessionKey(string $suffix = ''): string
    {
        return $this->config()['key'] . '_capaian' . ($suffix !== '' ? '.' . $suffix : '');
    }

    protected function currentUser(): array
    {
        $cfg = $this->config();

        return array_merge([
            'name' => 'User',
            'email' => 'User@capaian.id',
            'joined_at' => 'Jan 2024',
            'status_label' => 'Akun Aktif',
        ], session('user', []), [
            'role' => $cfg['key'],
            'role_label' => $cfg['label'],
        ]);
    }

    /**
     * Data bersama untuk semua view role checklist.
     */
    protected function viewData(array $extra = []): array
    {
        return array_merge([
            'cfg' => $this->config(),
            'user' => $this->currentUser(),
        ], $extra);
    }

    /**
     * Hitung progres tiap kategori: dari session jika sudah diisi,
     * jika belum pakai data dummy agar tampilan sesuai Figma.
     */
    protected function categoryProgress(): array
    {
        $cfg = $this->config();
        $saved = session($this->sessionKey(), []);
        $result = [];

        foreach ($cfg['steps'] as $slug => $step) {
            $total = count($step['items']);

            if (isset($saved[$slug])) {
                $completed = count(array_intersect(array_keys($saved[$slug]['indicators'] ?? []), array_keys($step['items'])));
                $status = $completed >= $total ? 'tercapai' : 'tidak_tercapai';
            } else {
                [$completed, $status] = $cfg['dummy']['progress'][$slug] ?? [0, 'belum_diisi'];
                $completed = min($completed, $total);
            }

            $result[] = [
                'slug' => $slug,
                'name' => $step['short_title'] ?? $step['title'],
                'preview_title' => $step['preview_title'] ?? ($step['short_title'] ?? $step['title']),
                'completed' => $completed,
                'total' => $total,
                'percentage' => $total > 0 ? round($completed / $total * 100) : 0,
                'status' => $status,
                'url' => route($cfg['route'] . '.step', $slug),
            ];
        }

        return $result;
    }

    public function dashboard()
    {
        $cfg = $this->config();
        $categories = $this->categoryProgress();

        $completed = array_sum(array_column($categories, 'completed'));
        $total = array_sum(array_column($categories, 'total'));

        $summary = [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $total > 0 ? round($completed / $total * 100) : 0,
        ];

        $firstStep = array_key_first($cfg['steps']);

        // Data nyata dari Backend (GET /api/my-kpis) jika login lewat Backend.
        // Kategori mengikuti Backend, bukan langkah form Figma.
        if ($live = \App\Services\KpiDashboardService::myKpis()) {
            $summary = $live['summary'];
            $categories = array_map(fn ($g) => [
                'slug' => null,
                'name' => $g['name'],
                'preview_title' => $g['name'],
                'completed' => $g['completed'],
                'total' => $g['total'],
                'percentage' => $g['percentage'],
                'status' => $g['status'],
                'url' => route($cfg['route'] . '.step', $firstStep),
            ], $live['groups']);
        }

        return view('checklist.dashboard', $this->viewData([
            'todayBadge' => 'Hari ini, ' . now()->locale('id')->translatedFormat('j M'),
            'summary' => $summary,
            'categories' => $categories,
            'startUrl' => route($cfg['route'] . '.step', $firstStep),
            'recentAchievements' => $cfg['dummy']['recent'],
        ]));
    }

    /**
     * Tampilkan langkah pengisian capaian.
     */
    public function step(string $step)
    {
        $cfg = $this->config();
        abort_unless(isset($cfg['steps'][$step]), 404);

        $slugs = array_keys($cfg['steps']);
        $index = array_search($step, $slugs, true);

        $saved = session($this->sessionKey($step), []);
        $draft = session($this->sessionKey('draft.' . $step), []);

        return view('checklist.step', $this->viewData([
            'slug' => $step,
            'step' => $cfg['steps'][$step],
            'stepNumber' => $index + 1,
            'totalSteps' => count($slugs),
            'isFirst' => $index === 0,
            'isLast' => $index === count($slugs) - 1,
            'prevUrl' => $index > 0 ? route($cfg['route'] . '.step', $slugs[$index - 1]) : null,
            'checked' => $saved['indicators'] ?? ($draft['indicators'] ?? []),
            'attachments' => $saved['attachments'] ?? [],
        ]));
    }

    /**
     * Simpan langkah, lanjut ke langkah berikutnya atau kirim semua.
     */
    public function saveStep(Request $request, string $step)
    {
        $cfg = $this->config();
        abort_unless(isset($cfg['steps'][$step]), 404);

        $request->validate([
            'attachments' => ['nullable', 'array', 'max:10'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        $indicators = array_intersect_key(
            (array) $request->input('indicators', []),
            $cfg['steps'][$step]['items']
        );

        $attachments = collect($request->file('attachments', []))
            ->map(fn ($file) => $file->getClientOriginalName())
            ->values()
            ->all();

        session([$this->sessionKey($step) => [
            'indicators' => array_map(fn () => true, $indicators),
            'attachments' => $attachments,
            'saved_at' => now()->toDateTimeString(),
        ]]);
        session()->forget($this->sessionKey('draft.' . $step));

        $slugs = array_keys($cfg['steps']);
        $index = array_search($step, $slugs, true);

        if ($index < count($slugs) - 1) {
            return redirect()->route($cfg['route'] . '.step', $slugs[$index + 1]);
        }

        // Pastikan semua langkah sebelumnya sudah disimpan sebelum mengirim
        $saved = session($this->sessionKey(), []);
        foreach ($slugs as $i => $slug) {
            if (!isset($saved[$slug])) {
                return redirect()->route($cfg['route'] . '.step', $slug)->withErrors([
                    'step' => 'Langkah ' . ($i + 1) . ' (' . $cfg['steps'][$slug]['title'] . ') belum disimpan. Lengkapi lalu lanjutkan sampai langkah terakhir.',
                ]);
            }
        }

        session([$this->sessionKey('_completed_at') => now()->toDateTimeString()]);

        return redirect()->route($cfg['route'] . '.dashboard')
            ->with('status', 'Seluruh capaian harian berhasil dikirim!');
    }

    /**
     * Simpan draf sementara (AJAX) untuk langkah yang sedang dibuka.
     */
    public function draft(Request $request)
    {
        $cfg = $this->config();
        $step = (string) $request->input('step');
        abort_unless(isset($cfg['steps'][$step]), 422);

        $indicators = array_intersect_key(
            (array) $request->input('indicators', []),
            $cfg['steps'][$step]['items']
        );

        session([$this->sessionKey('draft.' . $step) => [
            'indicators' => array_map(fn () => true, $indicators),
            'drafted_at' => now()->toDateTimeString(),
        ]]);

        return response()->json([
            'success' => true,
            'message' => 'Capaian berhasil disimpan sebagai draf sementara!',
            'redirect' => route($cfg['route'] . '.dashboard'),
        ]);
    }

    public function riwayat(Request $request)
    {
        $cfg = $this->config();
        $list = $cfg['dummy']['riwayat'];

        $counts = array_count_values(array_column($list, 'status'));
        $summaryCounts = [
            'disetujui' => $counts['disetujui'] ?? 0,
            'menunggu' => $counts['menunggu'] ?? 0,
            'revisi' => $counts['revisi'] ?? 0,
            'semua' => count($list),
        ];

        $filter = in_array($request->query('status'), ['semua', 'disetujui', 'menunggu', 'revisi'], true)
            ? $request->query('status')
            : 'semua';

        return view('checklist.riwayat', $this->viewData([
            'riwayatList' => $list,
            'summaryCounts' => $summaryCounts,
            'filter' => $filter,
        ]));
    }

    public function detailRiwayat(Request $request, $id)
    {
        $cfg = $this->config();
        $item = collect($cfg['dummy']['riwayat'])->firstWhere('id', (int) $id);
        abort_unless($item, 404);

        $isRevision = $request->query('status')
            ? $request->query('status') === 'revisi'
            : $item['status'] === 'revisi';

        $revisedSlug = $cfg['dummy']['revision']['step'];
        $categories = [];
        foreach ($cfg['steps'] as $slug => $step) {
            $highlight = $isRevision && $slug === $revisedSlug;
            $done = $cfg['dummy']['detail_done'][$slug] ?? count($step['items']);
            $categories[] = [
                'title' => $step['title'],
                'icon' => $step['icon'] ?? 'clipboard',
                'is_highlighted' => $highlight,
                'badge' => $highlight ? 'PERLU REVISI' : null,
                'subtitle' => $highlight
                    ? $cfg['dummy']['revision']['short']
                    : min($done, count($step['items'])) . '/' . count($step['items']) . ' checklist selesai',
                'url' => route($cfg['route'] . '.step', $slug),
            ];
        }

        return view('checklist.detail_riwayat', $this->viewData([
            'item' => $item,
            'isRevision' => $isRevision,
            'categories' => $categories,
            'revision' => array_merge($cfg['dummy']['revision'], [
                'repair_url' => route($cfg['route'] . '.step', $revisedSlug),
            ]),
        ]));
    }

    public function profil()
    {
        return view('checklist.profil', $this->viewData());
    }

    /**
     * Data dummy riwayat (sesuai frame "Halaman Riwayat" di Figma).
     */
    protected function dummyRiwayat(int $totalChecklist): array
    {
        $rows = [
            ['Kam', '24', 'disetujui'], ['Rab', '23', 'menunggu'], ['Sel', '22', 'revisi'],
            ['Sen', '21', 'disetujui'], ['Min', '20', 'disetujui'], ['Sab', '19', 'revisi'],
        ];
        $labels = ['disetujui' => 'Disetujui', 'menunggu' => 'Menunggu', 'revisi' => 'Revisi'];

        return array_map(fn ($row, $i) => [
            'id' => $i + 1,
            'day_name' => $row[0],
            'day_num' => $row[1],
            'full_date' => $row[1] . ' Okt 2024',
            'short_date' => $row[1] . ' Okt',
            'category_info' => '4/' . $totalChecklist . ' Checklist terisi',
            'status' => $row[2],
            'status_label' => $labels[$row[2]],
        ], $rows, array_keys($rows));
    }

    /**
     * Data dummy "Capaian Terbaru" di dashboard.
     */
    protected function dummyRecent(): array
    {
        return [
            ['id' => 2, 'title' => 'Riwayat 24 Oktober 2024', 'sub' => '4/16 kategori terisi', 'status_label' => 'Menunggu', 'badge_class' => 'badge-amber'],
            ['id' => 1, 'title' => 'Riwayat 23 Oktober 2024', 'sub' => '10/16 kategori terisi', 'status_label' => 'Disetujui', 'badge_class' => 'badge-green'],
            ['id' => 4, 'title' => 'Riwayat 22 Oktober 2024', 'sub' => '14/16 kategori terisi', 'status_label' => 'Disetujui', 'badge_class' => 'badge-green'],
        ];
    }
}
