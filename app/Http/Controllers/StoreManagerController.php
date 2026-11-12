<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KpiDashboardService;
use App\Services\BackendApiService;

class StoreManagerController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Store Manager (Mendukung Tab "KPI Saya" dan "KPI Tim")
     */
    public function dashboard(Request $request)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        // Tab aktif: 'saya' atau 'tim'
        $activeTab = $request->query('tab', 'saya');

        // ==========================================
        // DATA TAB: KPI SAYA (Dashboard KPI Store Manager.png)
        // ==========================================
        $todayBadge = 'Hari ini, ' . now()->locale('id')->translatedFormat('j M');

        // Donut Chart: 5/16 Tuntas (~31.25%)
        $metricsSummary = [
            'total' => 16,
            'completed' => 5,
            'label' => '5/16',
            'status_text' => 'Tuntas',
            'percentage' => round((5 / 16) * 100),
        ];

        // 5 Progress Bar di Kanan Donut Sesuai Figma
        $progressRows = [
            [
                'title' => 'Penjualan',
                'current' => 3,
                'target' => 3,
                'percent' => 100,
            ],
            [
                'title' => 'Laba & Persediaan',
                'current' => 3,
                'target' => 4,
                'percent' => 75,
            ],
            [
                'title' => 'Pelayanan',
                'current' => 0,
                'target' => 2,
                'percent' => 0,
            ],
            [
                'title' => 'Operasional & SDM',
                'current' => 3,
                'target' => 5,
                'percent' => 60,
            ],
            [
                'title' => 'Promosi & Event',
                'current' => 2,
                'target' => 2,
                'percent' => 100,
            ],
        ];

        // Banner Tugas Harian & 5 Kartu Preview Status
        $dailyTask = [
            'banner_title' => 'Mulai Isi Capaian Hari Ini',
            'banner_sub' => '5 kategori · 5-10 menit',
            'start_route' => route('storemanager.penjualan'),
            'preview_items' => [
                [
                    'id' => 'penjualan',
                    'title' => 'Penjualan',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'route' => route('storemanager.penjualan'),
                ],
                [
                    'id' => 'laba_persediaan',
                    'title' => 'Laba & Persediaan',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'route' => route('storemanager.laba_persediaan'),
                ],
                [
                    'id' => 'pelayanan',
                    'title' => 'Pelayanan',
                    'status' => 'belum_diisi',
                    'status_label' => 'Belum diisi',
                    'badge_type' => 'warning',
                    'route' => route('storemanager.pelayanan'),
                ],
                [
                    'id' => 'operasional_sdm',
                    'title' => 'Operasional & SDM',
                    'status' => 'tidak_tercapai',
                    'status_label' => 'Tidak tercapai',
                    'badge_type' => 'danger',
                    'route' => route('storemanager.operasional_sdm'),
                ],
                [
                    'id' => 'promosi_event',
                    'title' => 'Promosi & Event',
                    'status' => 'tidak_tercapai',
                    'status_label' => 'Tidak tercapai',
                    'badge_type' => 'danger',
                    'route' => route('storemanager.promosi_event'),
                ],
            ],
        ];

        // Capaian Terbaru Sesuai Figma
        $recentAchievements = [
            [
                'id' => 1,
                'title' => 'Riwayat 24 Oktober 2024',
                'sub' => '4/16 kategori terisi',
                'status' => 'pending',
                'status_label' => 'Menunggu',
                'badge_class' => 'badge-amber',
                'route' => route('storemanager.riwayat.detail', ['id' => 1]),
            ],
            [
                'id' => 2,
                'title' => 'Riwayat 23 Oktober 2024',
                'sub' => '10/16 kategori terisi',
                'status' => 'approved',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'route' => route('storemanager.riwayat.detail', ['id' => 2]),
            ],
            [
                'id' => 3,
                'title' => 'Riwayat 22 Oktober 2024',
                'sub' => '14/16 kategori terisi',
                'status' => 'approved',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'route' => route('storemanager.riwayat.detail', ['id' => 3]),
            ],
        ];

        // ==========================================
        // DATA TAB: KPI TIM (Dashboard KPI Tim.png)
        // ==========================================
        $teamSummary = [
            'shift_label' => 'Shift Pagi & Siang',
            'reported_text' => '5 dari 8 karyawan sudah lapor',
            'percentage' => '62.5%',
            'percent_val' => 62.5,
            'pending_count' => 3,
            'approved_count' => 2,
            'not_reported_count' => 3,
        ];

        // Daftar 8 Karyawan Tim
        $teamMembers = [
            [
                'id' => 1,
                'name' => 'Budi Santoso',
                'role' => 'Frontliner (Kasir & Display)',
                'status' => 'approval',
                'status_label' => 'Approval',
                'badge_class' => 'badge-orange',
                'link' => route('storemanager.approval'),
            ],
            [
                'id' => 2,
                'name' => 'Dewi Novita',
                'role' => 'Frontliner (Pelayanan & Kasir)',
                'status' => 'approval',
                'status_label' => 'Approval',
                'badge_class' => 'badge-orange',
                'link' => route('storemanager.approval'),
            ],
            [
                'id' => 3,
                'name' => 'Agus Pratama',
                'role' => 'Produksi (Baker Shift Pagi)',
                'status' => 'approval',
                'status_label' => 'Approval',
                'badge_class' => 'badge-orange',
                'link' => route('storemanager.approval'),
            ],
            [
                'id' => 4,
                'name' => 'Rini Triana',
                'role' => 'Produksi (Pastry & Oven)',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'link' => '#',
            ],
            [
                'id' => 5,
                'name' => 'Hendra Setiawan',
                'role' => 'Logistik & Gudang',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'link' => '#',
            ],
            [
                'id' => 6,
                'name' => 'Wulan Mayasari',
                'role' => 'Frontliner (Shift Siang)',
                'status' => 'belum_lapor',
                'status_label' => 'Belum Lapor',
                'badge_class' => 'badge-gray',
                'link' => '#',
            ],
            [
                'id' => 7,
                'name' => 'Siti Rahayu',
                'role' => 'Kasir Utama',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'link' => '#',
            ],
            [
                'id' => 8,
                'name' => 'Fajar Ramadhan',
                'role' => 'Driver Pengiriman',
                'status' => 'belum_lapor',
                'status_label' => 'Belum Lapor',
                'badge_class' => 'badge-gray',
                'link' => '#',
            ],
        ];

        // Data nyata dari Backend (GET /api/my-kpis) jika login lewat Backend
        if ($live = KpiDashboardService::myKpis()) {
            $metricsSummary = $live['summary'];
            $progressRows = array_map(fn ($g) => [
                'title' => $g['name'],
                'current' => $g['completed'],
                'target' => $g['total'],
                'percent' => $g['percentage'],
            ], $live['groups']);
            $dailyTask['banner_sub'] = count($live['groups']) . ' kategori · 5–10 menit';
            $dailyTask['preview_items'] = array_map(fn ($g) => [
                'title' => $g['name'],
                'status' => $g['status'],
                'status_label' => $g['status_label'],
                'badge_type' => $g['badge_type'],
                'route' => $dailyTask['start_route'],
            ], $live['groups']);
        }

        // Tab KPI Tim: laporan yang menunggu persetujuan (GET /api/reviews/reports)
        if ($pending = $this->pendingReports()) {
            $teamSummary = array_merge($teamSummary, [
                'pending_count' => $pending['total'],
                // Rekap laporan seluruh tim belum ada endpoint-nya di Backend
                'reported_text' => 'Rekap laporan tim belum tersedia dari Backend',
                'percentage' => '–',
                'percent_val' => 0,
                'approved_count' => '–',
                'not_reported_count' => '–',
            ]);
            $teamMembers = array_map(fn ($r) => [
                'id' => $r['user']['id'],
                'name' => $r['user']['name'],
                'role' => ($r['user']['position'] ?? '-') . ' · ' . $r['report_date'],
                'status' => 'approval',
                'status_label' => 'Approval',
                'badge_class' => 'badge-orange',
                'link' => route('storemanager.approval'),
            ], $pending['data']);
        }

        return view('storemanager.dashboard', compact(
            'user',
            'activeTab',
            'todayBadge',
            'metricsSummary',
            'progressRows',
            'dailyTask',
            'recentAchievements',
            'teamSummary',
            'teamMembers'
        ));
    }

    // =========================================================================
    // MULTI-STEP PENGISIAN CAPAIAN STORE MANAGER (5 LANGKAH SESUAI FIGMA)
    // =========================================================================

    /**
     * Langkah 1 dari 5: Penjualan
     */
    public function isiPenjualan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 1,
            'total' => 5,
            'title' => 'Penjualan',
            'subtitle' => 'Centang indikator yang tercapai hari ini',
            'category_name' => 'Penjualan',
            'next_route' => route('storemanager.laba_persediaan'),
            'back_route' => route('storemanager.dashboard'),
        ];

        $indicators = [
            [
                'id' => 'target_omset',
                'title' => 'Pencapaian target omset ≥100%',
                'desc' => 'Total omset hari ini sudah mencapai atau melampaui target harian toko',
                'checked' => true,
            ],
            [
                'id' => 'pertumbuhan_omset',
                'title' => 'Pertumbuhan omset vs bulan lalu ≥5%',
                'desc' => 'Tren penjualan minggu ini lebih tinggi dibanding periode yang sama bulan lalu',
                'checked' => false,
            ],
            [
                'id' => 'average_basket',
                'title' => 'Rata-rata belanja (Average Basket) naik ≥10%',
                'desc' => 'Nilai transaksi per pelanggan hari ini lebih tinggi dari rata-rata bulan lalu',
                'checked' => false,
            ],
        ];

        return view('storemanager.penjualan', compact('user', 'stepInfo', 'indicators'));
    }

    /**
     * Simpan Langkah 1: Penjualan
     */
    public function simpanPenjualan(Request $request)
    {
        session([
            'sm_penjualan' => [
                'indicators' => $request->input('indicators', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        return redirect()->route('storemanager.laba_persediaan')->with('status', 'Penjualan berhasil disimpan!');
    }

    /**
     * Langkah 2 dari 5: Laba & Persediaan
     */
    public function isiLabaPersediaan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 2,
            'total' => 5,
            'title' => 'Laba & Persediaan',
            'subtitle' => 'Centang indikator yang tercapai hari ini',
            'category_name' => 'Laba & Persediaan',
            'next_route' => route('storemanager.pelayanan'),
            'back_route' => route('storemanager.penjualan'),
        ];

        $labaBiayaIndicators = [
            [
                'id' => 'food_cost',
                'title' => 'Food Cost sesuai standar ≤ target perusahaan',
                'desc' => 'Biaya bahan baku terhadap harga jual minggu ini tidak melebihi target yang ditetapkan perusahaan',
                'checked' => true,
            ],
            [
                'id' => 'waste_expired',
                'title' => 'Waste/produk rusak & expired ≤1% dari omset',
                'desc' => 'Nilai roti yang dibuang, rusak, atau kedaluwarsa hari ini tidak lebih dari 1% omset',
                'checked' => false,
            ],
        ];

        $persediaanIndicators = [
            [
                'id' => 'akurasi_stok',
                'title' => 'Akurasi stok ≥98%',
                'desc' => 'Selisih antara stok fisik di toko dan catatan sistem tidak lebih dari 2%',
                'checked' => true,
            ],
            [
                'id' => 'stock_opname',
                'title' => 'Stock opname tepat waktu 100%',
                'desc' => 'Penghitungan stok fisik hari ini sudah dilakukan sesuai jadwal yang ditetapkan',
                'checked' => false,
            ],
        ];

        return view('storemanager.laba_persediaan', compact('user', 'stepInfo', 'labaBiayaIndicators', 'persediaanIndicators'));
    }

    /**
     * Simpan Langkah 2: Laba & Persediaan
     */
    public function simpanLabaPersediaan(Request $request)
    {
        session([
            'sm_laba_persediaan' => [
                'laba' => $request->input('laba', []),
                'persediaan' => $request->input('persediaan', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        return redirect()->route('storemanager.pelayanan')->with('status', 'Laba & Persediaan berhasil disimpan!');
    }

    /**
     * Langkah 3 dari 5: Pelayanan
     */
    public function isiPelayanan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 3,
            'total' => 5,
            'title' => 'Pelayanan',
            'subtitle' => 'Centang indikator yang tercapai hari ini',
            'category_name' => 'Pelayanan',
            'next_route' => route('storemanager.operasional_sdm'),
            'back_route' => route('storemanager.laba_persediaan'),
        ];

        $indicators = [
            [
                'id' => 'kepuasan_pelanggan',
                'title' => 'Kepuasan pelanggan ≥90%',
                'desc' => 'Rating toko hari ini berada di atas 90% berdasarkan penilaian dan feedback pelanggan',
                'checked' => true,
            ],
            [
                'id' => 'komplain_selesai',
                'title' => 'Komplain terselesaikan 100% dalam 1x24 jam',
                'desc' => 'Semua komplain yang masuk hari ini sudah ditangani dan diselesaikan sebelum 24 jam',
                'checked' => false,
            ],
        ];

        return view('storemanager.pelayanan', compact('user', 'stepInfo', 'indicators'));
    }

    /**
     * Simpan Langkah 3: Pelayanan
     */
    public function simpanPelayanan(Request $request)
    {
        session([
            'sm_pelayanan' => [
                'indicators' => $request->input('indicators', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        return redirect()->route('storemanager.operasional_sdm')->with('status', 'Pelayanan berhasil disimpan!');
    }

    /**
     * Langkah 4 dari 5: Operasional & SDM
     */
    public function isiOperasionalSdm()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 4,
            'total' => 5,
            'title' => 'Operasional & SDM',
            'subtitle' => 'Centang indikator yang tercapai hari ini',
            'category_name' => 'Operasional & SDM',
            'next_route' => route('storemanager.promosi_event'),
            'back_route' => route('storemanager.pelayanan'),
        ];

        $operasionalIndicators = [
            [
                'id' => 'display_lengkap',
                'title' => 'Display produk lengkap saat jam operasional',
                'desc' => 'Etalase roti terisi penuh & label harga terpasang rapi',
                'checked' => true,
            ],
            [
                'id' => 'sop_buka',
                'title' => 'SOP buka toko dijalankan',
                'desc' => 'Sanitasi, pencatatan kas modal awal, dan uji mesin POS',
                'checked' => false,
            ],
            [
                'id' => 'sop_tutup',
                'title' => 'SOP tutup toko dijalankan',
                'desc' => 'Rekapitulasi sisa produk, kunci chiller, dan pemadaman lampu',
                'checked' => false,
            ],
        ];

        $sdmIndicators = [
            [
                'id' => 'briefing_harian',
                'title' => 'Briefing harian sudah dilaksanakan',
                'desc' => 'Penyampaian target penjualan harian dan fokus produk promo',
                'checked' => true,
            ],
            [
                'id' => 'training_karyawan',
                'title' => 'Training karyawan Minimal 1 kali/bulan',
                'desc' => 'Pelatihan standar sanitasi, pencatatan kas, dan operasional sistem POS.',
                'checked' => false,
            ],
        ];

        $existingPhotos = [
            ['id' => 1, 'name' => 'foto_kerusakan_1.jpg'],
            ['id' => 2, 'name' => 'foto_kerusakan_2.jpg'],
        ];

        return view('storemanager.operasional_sdm', compact('user', 'stepInfo', 'operasionalIndicators', 'sdmIndicators', 'existingPhotos'));
    }

    /**
     * Simpan Langkah 4: Operasional & SDM
     */
    public function simpanOperasionalSdm(Request $request)
    {
        session([
            'sm_operasional_sdm' => [
                'operasional' => $request->input('operasional', []),
                'sdm' => $request->input('sdm', []),
                'photos' => $request->input('photos', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        return redirect()->route('storemanager.promosi_event')->with('status', 'Operasional & SDM berhasil disimpan!');
    }

    /**
     * Langkah 5 dari 5: Promosi & Event (Final Submit)
     */
    public function isiPromosiEvent()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 5,
            'total' => 5,
            'title' => 'Promosi & Event',
            'subtitle' => 'Centang indikator yang tercapai hari ini',
            'category_name' => 'Promosi & Event',
            'back_route' => route('storemanager.operasional_sdm'),
        ];

        $indicators = [
            [
                'id' => 'promo_terjadwal',
                'title' => 'Ada promo terjadwal hari ini?',
                'desc' => 'Contoh: Bundling Roti Kopi Sore / Diskon Akhir Pekan',
                'checked' => true,
            ],
            [
                'id' => 'promo_dieksekusi',
                'title' => 'Promo dieksekusi sesuai jadwal',
                'desc' => 'Materi POP terpasang, kasir menerapkan diskon & display siap',
                'checked' => false,
            ],
        ];

        $existingPhotos = [
            ['id' => 1, 'name' => 'foto_kerusakan_1.jpg'],
            ['id' => 2, 'name' => 'foto_kerusakan_2.jpg'],
        ];

        // Pulihkan centang dari draf / data tersimpan sebelumnya
        $saved = session('sm_promosi_event') ?? session('sm_capaian_draft');
        if (is_array($saved)) {
            foreach ($indicators as &$indicator) {
                $indicator['checked'] = !empty($saved['indicators'][$indicator['id']]);
            }
            unset($indicator);
        }

        return view('storemanager.promosi_event', compact('user', 'stepInfo', 'indicators', 'existingPhotos'));
    }

    /**
     * Simpan Langkah 5: Promosi & Event (Final Submit)
     */
    public function simpanPromosiEvent(Request $request)
    {
        session([
            'sm_promosi_event' => [
                'indicators' => $request->input('indicators', []),
                'photos' => $request->input('photos', []),
                'saved_at' => now()->toDateTimeString(),
                'status' => 'submitted',
            ]
        ]);

        return redirect()->route('storemanager.dashboard')->with('status', 'Seluruh capaian Store Manager (5/5 kategori) berhasil dikirim!');
    }

    /**
     * Simpan Draf Sementara
     */
    public function simpanDraft(Request $request)
    {
        session(['sm_capaian_draft' => [
            'indicators' => $request->input('indicators', []),
            'drafted_at' => now()->toDateTimeString(),
        ]]);

        return redirect()->route('storemanager.dashboard')->with('status', 'Draf capaian Store Manager berhasil disimpan.');
    }

    // =========================================================================
    // INTEGRASI BACKEND: APPROVAL TIM (GET/POST /api/reviews/reports)
    // =========================================================================

    /**
     * Laporan karyawan berstatus SUBMITTED yang menunggu keputusan.
     * @return array{total:int, data:array}|null  null jika belum terhubung ke Backend
     */
    protected function pendingReports(): ?array
    {
        $json = BackendApiService::fetch('reviews/reports', ['per_page' => 50]);
        if ($json === null) {
            return null;
        }

        return [
            'total' => (int) ($json['total'] ?? count($json['data'] ?? [])),
            'data' => $json['data'] ?? [],
        ];
    }

    /**
     * Ubah laporan Backend menjadi bentuk kartu di halaman Approval Tim.
     */
    protected function liveApprovalItems(): ?array
    {
        $pending = $this->pendingReports();
        if ($pending === null) {
            return null;
        }

        $categoryOf = fn (?string $position) => match (strtolower((string) $position)) {
            'frontliner' => 'frontliner',
            'produksi' => 'produksi',
            'driver' => 'driver',
            'sales' => 'sales',
            'spv' => 'supervisor',
            default => 'lainnya',
        };

        $items = [];
        foreach ($pending['data'] as $i => $report) {
            $userId = $report['user']['id'];
            $date = $report['report_date'];
            $detail = BackendApiService::fetch("reviews/reports/{$userId}/{$date}")['data'] ?? [];

            $photos = [];
            $rows = [];
            foreach ($detail as $sub) {
                foreach ($sub['evidences'] ?? [] as $ev) {
                    $photos[] = ['title' => $ev['file_name'], 'time' => $sub['indicator']['name'] ?? '', 'url' => $ev['url']];
                }

                $ind = $sub['indicator'] ?? [];
                if (($ind['input_type'] ?? '') === 'YES_NO') {
                    $label = $ind['name'];
                    $met = (bool) $sub['answer_yes_no'];
                } else {
                    $value = $sub['numeric_value'];
                    $target = $ind['target'] ?? 0;
                    $unit = $ind['unit'] ?? '';
                    $label = sprintf('%s: %s %s (target %s)', $ind['name'], $this->fmt($value), $unit, $this->fmt($target));
                    $met = ($ind['calculation_type'] ?? '') === 'LOWER_IS_BETTER' ? $value <= $target : $value >= $target;
                }
                $rows[] = ['label' => $label, 'checked' => $met];
            }

            $metCount = count(array_filter($rows, fn ($r) => $r['checked']));

            $items[] = [
                'id' => $userId . '_' . $date,
                'name' => $report['user']['name'],
                'role' => $report['user']['position'] ?? '-',
                'role_category' => $categoryOf($report['user']['position'] ?? null),
                'submission_meta' => $report['total_indicators'] . ' indikator · ' . \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('j M Y'),
                'status_label' => 'Menunggu Persetujuan Anda',
                'is_expanded' => $i === 0,
                'photos' => $photos,
                'categories' => $rows ? [[
                    'name' => 'INDIKATOR KPI',
                    'ratio' => $metCount . '/' . count($rows) . ' Memenuhi target',
                    'items' => $rows,
                ]] : [],
            ];
        }

        return $items;
    }

    private function fmt($n): string
    {
        $s = number_format((float) $n, 2, ',', '.');
        return str_ends_with($s, ',00') ? substr($s, 0, -3) : $s;
    }

    /**
     * Kirim keputusan satu laporan ke Backend. $id = "{userId}_{YYYY-mm-dd}".
     */
    protected function decideReport(string $id, string $decision, ?string $notes)
    {
        if (! BackendApiService::connected()) {
            return null; // mode demo: pakai perilaku dummy lama
        }

        if (! preg_match('/^(\d+)_(\d{4}-\d{2}-\d{2})$/', $id, $m)) {
            return redirect()->route('storemanager.approval')->with('error', 'Laporan tidak dikenali.');
        }

        $res = BackendApiService::send('POST', "reviews/reports/{$m[1]}/{$m[2]}", [
            'decision' => $decision,
            'notes' => $notes ?: null,
        ]);

        return redirect()->route('storemanager.approval')
            ->with($res['ok'] ? 'status' : 'error', $res['ok'] ? $res['message'] : $res['first_error']);
    }

    // =========================================================================
    // HALAMAN TRAINING KARYAWAN (Figma: "Detail Training" & "Card Catat Training Baru")
    // =========================================================================

    /**
     * Daftar training: data dummy + training yang dicatat di session.
     */
    protected function trainingList(): array
    {
        $dummy = [
            ['date' => '2026-10-20', 'topic' => 'Service Excellence', 'participants' => 8],
            ['date' => '2026-09-15', 'topic' => 'Food Safety & Hygiene', 'participants' => 15],
            ['date' => '2026-08-10', 'topic' => 'Basic Product Knowledge', 'participants' => 12],
        ];

        $list = array_merge(session('sm_trainings', []), $dummy);
        usort($list, fn ($a, $b) => strcmp($b['date'], $a['date']));

        return $list;
    }

    /**
     * Halaman Training Karyawan
     */
    public function training()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $trainings = array_map(function ($t) {
            $t['date_label'] = \Carbon\Carbon::parse($t['date'])->locale('id')->translatedFormat('j M Y');
            return $t;
        }, $this->trainingList());

        $currentMonth = now()->format('Y-m');
        $monthCount = count(array_filter($trainings, fn ($t) => str_starts_with($t['date'], $currentMonth)));

        $summary = [
            'done' => $monthCount,
            'target' => 1,
        ];

        return view('storemanager.training', compact('user', 'trainings', 'summary'));
    }

    /**
     * Simpan training baru
     */
    public function simpanTraining(Request $request)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'topic' => ['required', 'string', 'max:120'],
            'participants' => ['required', 'integer', 'min:1', 'max:500'],
        ], [], [
            'date' => 'Tanggal Pelaksanaan',
            'topic' => 'Topik Training',
            'participants' => 'Jumlah Peserta',
        ]);

        $trainings = session('sm_trainings', []);
        $trainings[] = [
            'date' => $data['date'],
            'topic' => $data['topic'],
            'participants' => (int) $data['participants'],
        ];
        session(['sm_trainings' => $trainings]);

        return redirect()->route('storemanager.training')->with('status', 'Training berhasil dicatat.');
    }

    // =========================================================================
    // HALAMAN APPROVAL TIM (Halaman Approval Tim.png)
    // =========================================================================

    /**
     * Tampilkan Halaman Approval Tim
     */
    public function approvalTim(Request $request)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $filter = $request->query('filter', 'semua');

        // Daftar anggota tim yang menunggu persetujuan
        $approvalItems = [
            [
                'id' => 1,
                'name' => 'Budi Santoso',
                'role' => 'Frontliner',
                'role_category' => 'frontliner',
                'submission_meta' => 'Pelayanan · 30 Sep 2026, 17:30 WIB',
                'status_label' => 'Menunggu Persetujuan Anda',
                'is_expanded' => true,
                'photos' => [
                    ['title' => 'Foto_Display_Pagi_22Okt.jpg', 'time' => 'Diunggah: 22 Okt, 19:40 WIB'],
                    ['title' => 'Foto_Display_Pagi_22Okt.jpg', 'time' => 'Diunggah: 22 Okt, 19:40 WIB'],
                    ['title' => 'Foto_Display_Pagi_22Okt.jpg', 'time' => 'Diunggah: 22 Okt, 19:40 WIB'],
                ],
                'categories' => [
                    [
                        'name' => 'PENJUALAN',
                        'ratio' => '1/3 Terpenuhi',
                        'items' => [
                            ['label' => 'Mencapai target omzet harian/bulanan', 'checked' => true],
                            ['label' => 'Meningkatkan nilai rata-rata belanja pelanggan', 'checked' => false],
                            ['label' => 'Aktif menawarkan produk promo', 'checked' => false],
                        ],
                    ],
                    [
                        'name' => 'PELAYANAN',
                        'ratio' => '1/4 Terpenuhi',
                        'items' => [
                            ['label' => 'Menyapa pelanggan', 'checked' => true],
                            ['label' => 'Ramah dan komunikatif', 'checked' => false],
                            ['label' => 'Cepat melayani', 'checked' => false],
                            ['label' => 'Menangani komplain dengan baik', 'checked' => false],
                        ],
                    ],
                    [
                        'name' => 'PRODUCT KNOWLEDGE',
                        'ratio' => '1/3 Terpenuhi',
                        'items' => [
                            ['label' => 'Menguasai fungsi bahan kue', 'checked' => true],
                            ['label' => 'Mengetahui stok dan lokasi produk', 'checked' => false],
                            ['label' => 'Mampu memberi rekomendasi kepada pelanggan', 'checked' => false],
                        ],
                    ],
                    [
                        'name' => 'AKURASI KASIR',
                        'ratio' => '1/3 Terpenuhi',
                        'items' => [
                            ['label' => 'Tidak ada selisih kas', 'checked' => true],
                            ['label' => 'Tidak salah input harga', 'checked' => false],
                            ['label' => 'Nota sesuai transaksi', 'checked' => false],
                        ],
                    ],
                    [
                        'name' => 'DISPLAY & KEBERSIHAN',
                        'ratio' => '1/4 Terpenuhi',
                        'items' => [
                            ['label' => 'Rak selalu rapi', 'checked' => true],
                            ['label' => 'Produk FIFO', 'checked' => false],
                            ['label' => 'Label harga lengkap', 'checked' => false],
                            ['label' => 'Area kerja bersih', 'checked' => false],
                        ],
                    ],
                    [
                        'name' => 'KEPATUHAN SOP & DISIPLIN',
                        'ratio' => '1/5 Terpenuhi',
                        'items' => [
                            ['label' => 'Menggunakan seragam lengkap', 'checked' => true],
                            ['label' => 'Mengikuti SOP buka/tutup toko', 'checked' => false],
                            ['label' => 'Menjalankan prosedur pelayanan dan keamanan', 'checked' => false],
                            ['label' => 'Tidak terlambat', 'checked' => false],
                            ['label' => 'Mematuhi Jadwal kerja', 'checked' => false],
                        ],
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Dewi Lestari',
                'role' => 'Frontliner',
                'role_category' => 'frontliner',
                'submission_meta' => 'Pelayanan · 30 Sep 2026, 17:30 WIB',
                'status_label' => 'Menunggu Persetujuan Anda',
                'is_expanded' => false,
            ],
            [
                'id' => 3,
                'name' => 'Agus Hermawan',
                'role' => 'Driver',
                'role_category' => 'driver',
                'submission_meta' => 'Pelayanan · 30 Sep 2026, 17:30 WIB',
                'status_label' => 'Menunggu Persetujuan Anda',
                'is_expanded' => false,
            ],
            [
                'id' => 4,
                'name' => 'Rian Hidayat',
                'role' => 'Sales/Marketing',
                'role_category' => 'sales',
                'submission_meta' => 'Pelayanan · 30 Sep 2026, 17:30 WIB',
                'status_label' => 'Menunggu Persetujuan Anda',
                'is_expanded' => false,
            ],
        ];

        // Data nyata dari Backend jika login lewat Backend
        if (($live = $this->liveApprovalItems()) !== null) {
            $approvalItems = $live;
        }

        return view('storemanager.approval', compact('user', 'approvalItems', 'filter'));
    }

    /**
     * Setujui Capaian Karyawan Tunggal
     */
    public function approveCapaian($id)
    {
        if ($resp = $this->decideReport((string) $id, 'APPROVED', null)) {
            return $resp;
        }

        return redirect()->route('storemanager.approval')->with('status', 'Capaian karyawan berhasil disetujui!');
    }

    /**
     * Tolak / Minta Revisi Capaian Karyawan
     */
    public function rejectCapaian(Request $request, $id)
    {
        $catatan = $request->input('catatan', 'Foto bukti kurang jelas, mohon perbaiki.');

        if (BackendApiService::connected() && trim((string) $request->input('catatan')) === '') {
            return redirect()->route('storemanager.approval')->with('error', 'Alasan penolakan wajib diisi pada kolom catatan.');
        }
        if ($resp = $this->decideReport((string) $id, 'REJECTED', $catatan)) {
            return $resp;
        }

        return redirect()->route('storemanager.approval')->with('status', 'Permintaan revisi berhasil dikirim ke karyawan.');
    }

    /**
     * Setujui Semua Capaian Sekaligus
     */
    public function approveAllCapaian()
    {
        if (($pending = $this->pendingReports()) !== null) {
            $ok = 0;
            $failed = [];
            foreach ($pending['data'] as $r) {
                $res = BackendApiService::send('POST', "reviews/reports/{$r['user']['id']}/{$r['report_date']}", ['decision' => 'APPROVED']);
                if ($res['ok']) {
                    $ok++;
                } else {
                    $failed[] = $r['user']['name'];
                }
            }

            if ($failed) {
                return redirect()->route('storemanager.approval')->with('error', "{$ok} laporan disetujui, gagal: " . implode(', ', $failed));
            }

            return redirect()->route('storemanager.approval')->with('status', $ok
                ? "{$ok} laporan berhasil disetujui sekaligus."
                : 'Tidak ada laporan yang menunggu persetujuan.');
        }

        return redirect()->route('storemanager.approval')->with('status', 'Semua capaian tim berhasil disetujui sekaligus!');
    }

    // =========================================================================
    // RIWAYAT & DETAIL RIWAYAT STORE MANAGER
    // =========================================================================

    /**
     * Halaman Riwayat Capaian
     */
    public function riwayatCapaian()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $summary = [
            'disetujui' => 3,
            'menunggu' => 1,
            'revisi' => 2,
            'semua' => 6,
        ];

        $historyList = [
            [
                'id' => 1,
                'day_name' => 'Kam',
                'day_num' => '24',
                'date_formatted' => '24 Okt 2024',
                'checklist_text' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
            ],
            [
                'id' => 2,
                'day_name' => 'Rab',
                'day_num' => '23',
                'date_formatted' => '23 Okt 2024',
                'checklist_text' => '4/16 Checklist terisi',
                'status' => 'menunggu',
                'status_label' => 'Menunggu',
            ],
            [
                'id' => 3,
                'day_name' => 'Sel',
                'day_num' => '22',
                'date_formatted' => '22 Okt 2024',
                'checklist_text' => '4/16 Checklist terisi',
                'status' => 'revisi',
                'status_label' => 'Revisi',
            ],
            [
                'id' => 4,
                'day_name' => 'Sen',
                'day_num' => '21',
                'date_formatted' => '21 Okt 2024',
                'checklist_text' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
            ],
            [
                'id' => 5,
                'day_name' => 'Min',
                'day_num' => '20',
                'date_formatted' => '20 Okt 2024',
                'checklist_text' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
            ],
            [
                'id' => 6,
                'day_name' => 'Sab',
                'day_num' => '19',
                'date_formatted' => '19 Okt 2024',
                'checklist_text' => '4/16 Checklist terisi',
                'status' => 'revisi',
                'status_label' => 'Revisi',
            ],
        ];

        return view('storemanager.riwayat', compact('user', 'summary', 'historyList'));
    }

    /**
     * Halaman Detail Riwayat (Disetujui & Perlu Revisi)
     */
    public function detailRiwayat(Request $request, $id = null)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'store_manager',
            'role_label' => 'Store Manager',
            'email' => 'User@capaian.id',
        ]);

        $isRevisi = $request->query('status') === 'revisi' || in_array($id, [3, 6, 'revisi']);

        $reportMeta = [
            'title' => 'Riwayat — 24 Okt',
            'submitted_at' => 'Dikirim 24 Okt 2026, 21:05 WIB',
            'status' => $isRevisi ? 'PERLU REVISI' : 'DISETUJUI',
            'is_revisi' => $isRevisi,
        ];

        $revisionNote = [
            'requester' => 'User (Store Manager)',
            'time' => '25 Okt, 08:30 WIB',
            'text' => '"Foto bukti Penjualan kurang jelas, mohon upload ulang."',
            'cta_title' => 'PERBAIKI CAPAIAN',
            'cta_url' => route('storemanager.penjualan'),
        ];

        // 5 Kategori Sesuai Halaman Detail Riwayat.png Store Manager
        $categories = [
            [
                'id' => 'penjualan',
                'name' => 'Penjualan',
                'subtitle' => $isRevisi ? 'Perlu Revisi · Foto tidak jelas' : '3/3 checklist selesai',
                'is_revisi' => $isRevisi,
                'icon' => 'cash',
                'url' => route('storemanager.penjualan'),
            ],
            [
                'id' => 'laba_persediaan',
                'name' => 'Laba & Persediaan',
                'subtitle' => '3/3 checklist selesai',
                'is_revisi' => false,
                'icon' => 'trend',
                'url' => route('storemanager.laba_persediaan'),
            ],
            [
                'id' => 'pelayanan',
                'name' => 'Pelayanan',
                'subtitle' => '3/3 checklist selesai',
                'is_revisi' => false,
                'icon' => 'headset',
                'url' => route('storemanager.pelayanan'),
            ],
            [
                'id' => 'operasional_sdm',
                'name' => 'Operasional & SDM',
                'subtitle' => '3/3 checklist selesai',
                'is_revisi' => false,
                'icon' => 'users',
                'url' => route('storemanager.operasional_sdm'),
            ],
            [
                'id' => 'promosi_event',
                'name' => 'Promosi & Event',
                'subtitle' => '3/3 checklist selesai',
                'is_revisi' => false,
                'icon' => 'megaphone',
                'url' => route('storemanager.promosi_event'),
            ],
        ];

        return view('storemanager.detail_riwayat', compact('user', 'reportMeta', 'revisionNote', 'categories'));
    }

    /**
     * Halaman Profil Store Manager Sesuai Halaman Profil.png
     */
    public function profil()
    {
        $user = [
            'name' => 'User',
            'role_label' => 'STORE MANAGER',
            'status_label' => 'Akun Aktif',
            'email' => 'User@capaian.id',
            'joined_at' => 'Jan 2024',
        ];

        return view('storemanager.profil', compact('user'));
    }
}

