<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BackendApiService;
use App\Services\KpiHistoryService;

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

    // =========================================================================
    // INTEGRASI BACKEND: kirim capaian ke POST /api/my-kpis/submissions
    // =========================================================================

    /**
     * Pemetaan item checklist Frontend -> NAMA indikator Backend (seeder Backend).
     * Hanya diisi untuk role yang itemnya 1:1 dengan indikator Backend.
     * Kosong = capaian role ini belum dikirim ke Backend (tetap disimpan di session).
     */
    protected function backendIndicators(): array
    {
        return [];
    }

    /**
     * KPI jabatan user dari GET /api/my-kpis untuk item yang dipetakan.
     *
     * @return array<string, array>|null  item key => position KPI Backend; null jika tidak terhubung / tidak dipetakan
     */
    protected function backendKpis(): ?array
    {
        $map = $this->backendIndicators();
        if (! $map || ! BackendApiService::connected()) {
            return null;
        }

        $items = BackendApiService::fetch('my-kpis')['data'] ?? null;
        if (! is_array($items)) {
            return null;
        }

        $byName = collect($items)->keyBy(fn ($pk) => $pk['indicator']['name'] ?? '');
        $result = [];
        foreach ($map as $key => $name) {
            if (isset($byName[$name])) {
                $result[$key] = $byName[$name];
            }
        }

        return $result;
    }

    /**
     * Kirim jawaban ya/tidak untuk $keys ke Backend. Item yang periodenya sudah dikirim/disetujui dilewati.
     *
     * @return array|null  hasil BackendApiService::send, atau null jika role/sesi tidak terhubung ke Backend
     */
    protected function sendToBackend(array $checkedKeys, array $keys, bool $submit): ?array
    {
        $kpis = $keys ? $this->backendKpis() : null;
        if ($kpis === null || ! array_intersect_key($kpis, array_flip($keys))) {
            return null;
        }

        $items = [];
        foreach ($keys as $key) {
            $pk = $kpis[$key] ?? null;
            $status = $pk['submission']['status'] ?? null;
            if (! $pk || ($pk['input_type'] ?? null) !== 'YES_NO' || in_array($status, ['SUBMITTED', 'APPROVED'], true)) {
                continue;
            }
            $items[] = ['position_kpi_id' => $pk['id'], 'answer_yes_no' => in_array($key, $checkedKeys, true)];
        }

        if (! $items) {
            return ['ok' => false, 'message' => 'Capaian periode ini sudah dikirim ke Backend dan menunggu/selesai direview.', 'first_error' => null];
        }

        return BackendApiService::send('POST', 'my-kpis/submissions', ['items' => $items, 'submit' => $submit]);
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

        // Belum ada isian di sesi ini: pakai jawaban yang sudah tersimpan di Backend (draft/terkirim)
        if (! isset($saved['indicators']) && ! isset($draft['indicators']) && ($kpis = $this->backendKpis())) {
            $fromBackend = array_filter(
                array_intersect_key($kpis, $cfg['steps'][$step]['items']),
                fn ($pk) => ($pk['submission']['answer_yes_no'] ?? false) === true
            );
            if ($fromBackend) {
                $draft = ['indicators' => array_map(fn () => true, $fromBackend)];
            }
        }

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

        // Kirim ke Backend (hanya role yang itemnya dipetakan 1:1 ke indikator Backend)
        $checkedKeys = [];
        foreach ($slugs as $slug) {
            $checkedKeys = array_merge($checkedKeys, array_keys($saved[$slug]['indicators'] ?? []));
        }
        $res = $this->sendToBackend($checkedKeys, array_keys($this->backendIndicators()), true);
        if ($res && ! $res['ok']) {
            return redirect()->route($cfg['route'] . '.step', $step)
                ->withErrors(['step' => $res['first_error'] ?? $res['message']]);
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

        // Simpan juga sebagai DRAFT di Backend (jika role dipetakan & login lewat Backend)
        $res = $this->sendToBackend(
            array_keys($indicators),
            array_values(array_intersect(array_keys($this->backendIndicators()), array_keys($cfg['steps'][$step]['items']))),
            false
        );
        if ($res && ! $res['ok']) {
            return response()->json([
                'success' => false,
                'message' => 'Draf tersimpan di perangkat ini, tetapi gagal disimpan ke Backend: ' . ($res['first_error'] ?? $res['message']),
                'redirect' => route($cfg['route'] . '.dashboard'),
            ]);
        }

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

        // Data nyata dari Backend (GET /api/my-kpis/history) jika login lewat Backend
        if ($history = KpiHistoryService::list()) {
            $list = $history['items'];
            $summaryCounts = $history['summary'];
        }

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

        // Data nyata dari Backend (GET /api/my-kpis/history/{date}); id = tanggal laporan (Ymd)
        if (($date = KpiHistoryService::dateFromId($id)) && ($live = KpiHistoryService::detail($date))) {
            return $this->liveDetailView($live);
        }

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

    /**
     * Detail riwayat dari Backend. Kategori mengikuti Backend (bukan langkah form Figma),
     * jadi tautan kategori / "Perbaiki Capaian" diarahkan ke langkah pertama form.
     */
    protected function liveDetailView(array $live)
    {
        $cfg = $this->config();
        $formUrl = route($cfg['route'] . '.step', array_key_first($cfg['steps']));

        // Nama ikon KpiHistoryService -> alias ikon di checklist/partials/icon.blade.php
        $iconAlias = ['cash' => 'chart', 'dollar' => 'chart', 'sparkles' => 'sparkle', 'shield-check' => 'clipboard', 'truck' => 'box', 'document' => 'clipboard'];

        $categories = array_map(fn ($c) => [
            'title' => $c['name'],
            'icon' => $iconAlias[$c['icon']] ?? $c['icon'],
            'is_highlighted' => $c['needs_revision'],
            'badge' => $c['needs_revision'] ? 'PERLU REVISI' : null,
            'subtitle' => $c['subtitle'],
            'url' => $formUrl,
        ], $live['categories']);

        return view('checklist.detail_riwayat', $this->viewData([
            'item' => [
                'short_date' => $live['short_date'],
                'full_date' => $live['full_date'],
                'sent_label' => $live['sent_label'],
            ],
            'isRevision' => $live['is_revision'],
            'categories' => $categories,
            'revision' => [
                'requested_by' => $live['revision']['requested_by'] ?? '-',
                'requested_at' => $live['revision']['requested_at'] ?? '',
                'message' => $live['revision']['message'] ?? '',
                'short' => 'Perlu Revisi',
                'repair_url' => $formUrl,
            ],
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
