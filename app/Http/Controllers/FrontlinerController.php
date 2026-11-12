<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontlinerController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Frontliner (Karyawan) Sesuai Figma Revisi
     */
    public function dashboard()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
            'email' => 'User@capaian.id',
        ]);

        // Badge tanggal hari ini sesuai Figma Revisi
        $todayBadge = 'Hari ini, 30 Sep';

        // Ringkasan Indikator Capaian Harian (Donut 5/22 Tuntas)
        $metricsSummary = [
            'total' => 22,
            'completed' => 5,
            'label' => '5/22',
            'status_text' => 'Tuntas',
            'percentage' => round((5 / 22) * 100), // ~23%
        ];

        // 6 Baris Progress di Sebelah Kanan Donut Chart Sesuai Figma
        $progressRows = [
            [
                'title' => 'Penjualan',
                'current' => 3,
                'target' => 3,
                'percent' => 100,
            ],
            [
                'title' => 'Pelayanan',
                'current' => 3,
                'target' => 4,
                'percent' => 75,
            ],
            [
                'title' => 'Product Knowledge',
                'current' => 0,
                'target' => 2,
                'percent' => 0,
            ],
            [
                'title' => 'Akurasi Kasir',
                'current' => 3,
                'target' => 5,
                'percent' => 60,
            ],
            [
                'title' => 'Display & Kebersihan',
                'current' => 2,
                'target' => 2,
                'percent' => 100,
            ],
            [
                'title' => 'Kepatuhan SOP & Disiplin',
                'current' => 2,
                'target' => 2,
                'percent' => 100,
            ],
        ];

        // Banner Tugas Harian
        $dailyTask = [
            'banner_title' => 'Mulai Isi Capaian Hari Ini',
            'banner_sub' => '6 kategori · 5-10 menit',
            'start_route' => route('frontliner.penjualan'),
            // 6 Kartu Preview Status (Grid 2 Kolom x 3 Baris) Sesuai Figma
            'preview_items' => [
                [
                    'id' => 'penjualan',
                    'title' => 'Penjualan',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success', // hijau
                    'route' => route('frontliner.penjualan'),
                ],
                [
                    'id' => 'pelayanan',
                    'title' => 'Pelayanan',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success', // hijau
                    'route' => route('frontliner.pelayanan'),
                ],
                [
                    'id' => 'product_knowledge',
                    'title' => 'Product Knowledge',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success', // hijau
                    'route' => route('frontliner.knowledge'),
                ],
                [
                    'id' => 'akurasi_kasir',
                    'title' => 'Akurasi Kasir',
                    'status' => 'belum_diisi',
                    'status_label' => 'Belum diisi',
                    'badge_type' => 'warning', // kuning/amber
                    'route' => route('frontliner.kasir'),
                ],
                [
                    'id' => 'display_kebersihan',
                    'title' => 'Display & Kebersihan',
                    'status' => 'tidak_tercapai',
                    'status_label' => 'Tidak tercapai',
                    'badge_type' => 'danger', // merah
                    'route' => route('frontliner.display'),
                ],
                [
                    'id' => 'kepatuhan_sop_disiplin',
                    'title' => 'Kepatuhan SOP & Disiplin',
                    'status' => 'tidak_tercapai',
                    'status_label' => 'Tidak tercapai',
                    'badge_type' => 'danger', // merah
                    'route' => route('frontliner.kepatuhan'),
                ],
            ],
        ];

        // Capaian Terbaru Sesuai Figma Revisi
        $recentAchievements = [
            [
                'id' => 1,
                'title' => 'Riwayat 24 Oktober 2024',
                'sub' => '4/16 kategori terisi',
                'status' => 'pending',
                'status_label' => 'Menunggu',
                'badge_class' => 'badge-amber',
                'route' => route('frontliner.riwayat.detail', ['id' => 1]),
            ],
            [
                'id' => 2,
                'title' => 'Riwayat 23 Oktober 2024',
                'sub' => '10/16 kategori terisi',
                'status' => 'approved',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'route' => route('frontliner.riwayat.detail', ['id' => 2]),
            ],
            [
                'id' => 3,
                'title' => 'Riwayat 22 Oktober 2024',
                'sub' => '14/16 kategori terisi',
                'status' => 'approved',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'route' => route('frontliner.riwayat.detail', ['id' => 3]),
            ],
        ];

        return view('staff.dashboard', compact(
            'user',
            'todayBadge',
            'metricsSummary',
            'progressRows',
            'dailyTask',
            'recentAchievements'
        ));
    }

    /**
     * Endpoint untuk menyimpan input tugas capaian harian (AJAX)
     */
    public function saveDailyTask(Request $request)
    {
        $validated = $request->validate([
            'pelayanan' => 'nullable|string',
            'display_bersih' => 'nullable|string',
            'kepatuhan_sop' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Capaian tugas harian berhasil disimpan!',
        ]);
    }

    // =========================================================================
    // MULTI-STEP FORM PENGISIAN CAPAIAN FRONTLINER (6 LANGKAH REVISI)
    // =========================================================================

    /**
     * Langkah 1 dari 6: Penjualan
     */
    public function isiPenjualan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 1,
            'total' => 6,
            'title' => 'Penjualan',
            'subtitle' => 'Input total perolehan transaksi kasir shift hari ini.',
            'category_name' => 'Penjualan',
            'next_route' => route('frontliner.pelayanan'),
            'back_route' => route('frontliner.dashboard'),
        ];

        $indicators = [
            [
                'id' => 'target_omzet',
                'title' => 'Mencapai target omzet harian/bulanan',
                'desc' => 'Omset toko hari ini sudah mencapai atau melampaui target yang ditetapkan',
                'checked' => true,
            ],
            [
                'id' => 'rata_rata_belanja',
                'title' => 'Meningkatkan nilai rata-rata belanja pelanggan',
                'desc' => 'Nilai transaksi per pelanggan hari ini lebih tinggi dari rata-rata bulan lalu',
                'checked' => false,
            ],
            [
                'id' => 'tawarkan_promo',
                'title' => 'Aktif menawarkan produk promo',
                'desc' => 'Kamu sudah menawarkan produk promo kepada pelanggan yang datang hari ini',
                'checked' => false,
            ],
        ];

        $existingPhotos = [
            [
                'id' => 1,
                'name' => 'foto_kerusakan_1.jpg',
            ],
            [
                'id' => 2,
                'name' => 'foto_kerusakan_2.jpg',
            ],
        ];

        return view('staff.penjualan', compact('user', 'stepInfo', 'indicators', 'existingPhotos'));
    }

    /**
     * Simpan Langkah 1: Penjualan
     */
    public function simpanPenjualan(Request $request)
    {
        session([
            'capaian_penjualan' => [
                'indicators' => $request->input('indicators', []),
                'photos' => $request->input('photos', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Capaian Penjualan berhasil disimpan! Lanjut ke Pelayanan...',
                'redirect' => route('frontliner.pelayanan'),
            ]);
        }

        return redirect()->route('frontliner.pelayanan')->with('status', 'Penjualan berhasil disimpan!');
    }

    /**
     * Langkah 2 dari 6: Pelayanan
     */
    public function isiPelayanan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 2,
            'total' => 6,
            'title' => 'Pelayanan',
            'subtitle' => 'Input total perolehan transaksi kasir shift hari ini.',
            'category_name' => 'Pelayanan',
            'next_route' => route('frontliner.knowledge'),
            'back_route' => route('frontliner.penjualan'),
        ];

        $indicators = [
            [
                'id' => 'menyapa_pelanggan',
                'title' => 'Menyapa pelanggan',
                'desc' => 'Setiap pelanggan yang masuk disambut dengan salam dan senyum',
                'checked' => true,
            ],
            [
                'id' => 'ramah_komunikatif',
                'title' => 'Ramah dan komunikatif',
                'desc' => 'Melayani dengan sikap positif dan komunikasi yang jelas sepanjang shift',
                'checked' => false,
            ],
            [
                'id' => 'cepat_melayani',
                'title' => 'Cepat melayani',
                'desc' => 'Waktu tunggu pelanggan tidak terlalu lama dan antrian tidak menumpuk',
                'checked' => false,
            ],
            [
                'id' => 'menangani_komplain',
                'title' => 'Menangani komplain dengan baik',
                'desc' => 'Setiap komplain pelanggan ditanggapi dengan tenang dan diselesaikan hari ini',
                'checked' => false,
            ],
        ];

        return view('staff.pelayanan', compact('user', 'stepInfo', 'indicators'));
    }

    /**
     * Simpan Langkah 2: Pelayanan
     */
    public function simpanPelayanan(Request $request)
    {
        session([
            'capaian_pelayanan' => [
                'indicators' => $request->input('indicators', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Capaian Pelayanan berhasil disimpan! Lanjut ke Product Knowledge...',
                'redirect' => route('frontliner.knowledge'),
            ]);
        }

        return redirect()->route('frontliner.knowledge')->with('status', 'Pelayanan berhasil disimpan!');
    }

    /**
     * Langkah 3 dari 6: Product Knowledge
     */
    public function isiProductKnowledge()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 3,
            'total' => 6,
            'title' => 'Product Knowledge',
            'subtitle' => 'Input total perolehan transaksi kasir shift hari ini.',
            'category_name' => 'Product Knowledge',
            'next_route' => route('frontliner.kasir'),
            'back_route' => route('frontliner.pelayanan'),
        ];

        $indicators = [
            [
                'id' => 'fungsi_bahan_kue',
                'title' => 'Menguasai fungsi bahan kue',
                'desc' => 'Bisa menjelaskan bahan-bahan yang digunakan dalam produk roti kepada pelanggan',
                'checked' => true,
            ],
            [
                'id' => 'stok_lokasi_produk',
                'title' => 'Mengetahui stok dan lokasi produk',
                'desc' => 'Tahu produk apa yang tersedia hari ini dan di mana letaknya di toko',
                'checked' => false,
            ],
            [
                'id' => 'rekomendasi_pelanggan',
                'title' => 'Mampu memberi rekomendasi kepada pelanggan',
                'desc' => 'Aktif menyarankan produk yang sesuai kebutuhan atau selera pelanggan',
                'checked' => false,
            ],
        ];

        return view('staff.knowledge', compact('user', 'stepInfo', 'indicators'));
    }

    /**
     * Simpan Langkah 3: Product Knowledge
     */
    public function simpanProductKnowledge(Request $request)
    {
        session([
            'capaian_knowledge' => [
                'indicators' => $request->input('indicators', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Capaian Product Knowledge berhasil disimpan! Lanjut ke Akurasi Kasir...',
                'redirect' => route('frontliner.kasir'),
            ]);
        }

        return redirect()->route('frontliner.kasir')->with('status', 'Product Knowledge berhasil disimpan!');
    }

    /**
     * Langkah 4 dari 6: Akurasi Kasir
     */
    public function isiAkurasiKasir()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 4,
            'total' => 6,
            'title' => 'Akurasi Kasir',
            'subtitle' => 'Input total perolehan transaksi kasir shift hari ini.',
            'category_name' => 'Akurasi Kasir',
            'next_route' => route('frontliner.display'),
            'back_route' => route('frontliner.knowledge'),
        ];

        $indicators = [
            [
                'id' => 'tidak_ada_selisih',
                'title' => 'Tidak ada selisih kas',
                'desc' => 'Jumlah uang fisik di laci kasir sesuai dengan total transaksi tercatat',
                'checked' => true,
            ],
            [
                'id' => 'tidak_salah_harga',
                'title' => 'Tidak salah input harga',
                'desc' => 'Semua harga produk diinput sesuai harga yang berlaku, tidak ada koreksi transaksi',
                'checked' => false,
            ],
            [
                'id' => 'nota_sesuai',
                'title' => 'Nota sesuai transaksi',
                'desc' => 'Struk atau nota yang diberikan ke pelanggan sesuai dengan pesanan dan pembayaran',
                'checked' => false,
            ],
        ];

        return view('staff.kasir', compact('user', 'stepInfo', 'indicators'));
    }

    /**
     * Simpan Langkah 4: Akurasi Kasir
     */
    public function simpanAkurasiKasir(Request $request)
    {
        session([
            'capaian_kasir' => [
                'indicators' => $request->input('indicators', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Capaian Akurasi Kasir berhasil disimpan! Lanjut ke Display & Kebersihan...',
                'redirect' => route('frontliner.display'),
            ]);
        }

        return redirect()->route('frontliner.display')->with('status', 'Akurasi Kasir berhasil disimpan!');
    }

    /**
     * Langkah 5 dari 6: Display & Kebersihan
     */
    public function isiDisplayKebersihan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 5,
            'total' => 6,
            'title' => 'Display & Kebersihan',
            'subtitle' => 'Input total perolehan transaksi kasir shift hari ini.',
            'category_name' => 'Display & Kebersihan',
            'next_route' => route('frontliner.kepatuhan'),
            'back_route' => route('frontliner.kasir'),
        ];

        $indicators = [
            [
                'id' => 'rak_selalu_rapi',
                'title' => 'Rak selalu rapi',
                'desc' => 'Produk di rak tertata rapi dan tidak ada yang jatuh atau berantakan sepanjang shift',
                'checked' => true,
            ],
            [
                'id' => 'produk_fifo',
                'title' => 'Produk FIFO',
                'desc' => 'Produk yang lebih lama dipajang di depan, produk baru di belakang',
                'checked' => false,
            ],
            [
                'id' => 'label_harga_lengkap',
                'title' => 'Label harga lengkap',
                'desc' => 'Semua produk di rak sudah terpasang label harga yang jelas dan benar',
                'checked' => false,
            ],
            [
                'id' => 'area_kerja_bersih',
                'title' => 'Area kerja bersih',
                'desc' => 'Meja kasir, area display, dan sekitar tempat kerja bersih dari sampah dan kotoran',
                'checked' => false,
            ],
        ];

        $existingPhotos = [
            [
                'id' => 1,
                'name' => 'foto_kerusakan_1.jpg',
            ],
            [
                'id' => 2,
                'name' => 'foto_kerusakan_2.jpg',
            ],
        ];

        return view('staff.display', compact('user', 'stepInfo', 'indicators', 'existingPhotos'));
    }

    /**
     * Simpan Langkah 5: Display & Kebersihan
     */
    public function simpanDisplayKebersihan(Request $request)
    {
        session([
            'capaian_display' => [
                'indicators' => $request->input('indicators', []),
                'photos' => $request->input('photos', []),
                'saved_at' => now()->toDateTimeString(),
            ]
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Capaian Display & Kebersihan berhasil disimpan! Lanjut ke Kepatuhan SOP & Disiplin...',
                'redirect' => route('frontliner.kepatuhan'),
            ]);
        }

        return redirect()->route('frontliner.kepatuhan')->with('status', 'Display & Kebersihan berhasil disimpan!');
    }

    /**
     * Langkah 6 dari 6: Kepatuhan SOP & Disiplin
     */
    public function isiKepatuhanSop()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
            'email' => 'User@capaian.id',
        ]);

        $stepInfo = [
            'current' => 6,
            'total' => 6,
            'title' => 'Kepatuhan SOP & Disiplin',
            'subtitle' => 'Input total perolehan transaksi kasir shift hari ini.',
            'category_name' => 'Kepatuhan SOP',
            'back_route' => route('frontliner.display'),
        ];

        $sopIndicators = [
            [
                'id' => 'seragam_lengkap',
                'title' => 'Menggunakan seragam lengkap',
                'desc' => 'Hadir dengan seragam lengkap sesuai ketentuan toko hari ini',
                'checked' => true,
            ],
            [
                'id' => 'sop_buka_tutup',
                'title' => 'Mengikuti SOP buka/tutup toko',
                'desc' => 'Semua prosedur pembukaan atau penutupan toko sudah dijalankan sesuai urutan',
                'checked' => false,
            ],
            [
                'id' => 'prosedur_keamanan',
                'title' => 'Menjalankan prosedur pelayanan dan keamanan',
                'desc' => 'Prosedur layanan pelanggan dan keamanan toko diikuti sepanjang shift',
                'checked' => false,
            ],
        ];

        $disiplinIndicators = [
            [
                'id' => 'tidak_terlambat',
                'title' => 'Tidak terlambat',
                'desc' => 'Hadir di lokasi dan siap memproduksi roti tepat waktu sesuai jadwal shift hari ini',
                'checked' => false,
            ],
            [
                'id' => 'jadwal_kerja',
                'title' => 'Mematuhi Jadwal kerja',
                'desc' => 'Semua langkah perawatan alat harian sudah dilakukan dan tercatat',
                'checked' => true,
            ],
        ];

        // Pulihkan centang dari draf / data tersimpan sebelumnya
        $saved = session('capaian_kepatuhan') ?? session('capaian_frontliner_draft');
        if (is_array($saved)) {
            foreach ($sopIndicators as &$item) {
                $item['checked'] = in_array($item['id'], $saved['sop'] ?? [], true);
            }
            foreach ($disiplinIndicators as &$item) {
                $item['checked'] = in_array($item['id'], $saved['disiplin'] ?? [], true);
            }
            unset($item);
        }

        return view('staff.kepatuhan', compact('user', 'stepInfo', 'sopIndicators', 'disiplinIndicators'));
    }

    /**
     * Simpan Langkah 6: Kepatuhan SOP & Disiplin (Final Submit)
     */
    public function simpanKepatuhanSop(Request $request)
    {
        session([
            'capaian_kepatuhan' => [
                'sop' => $request->input('sop', []),
                'disiplin' => $request->input('disiplin', []),
                'saved_at' => now()->toDateTimeString(),
                'status' => 'submitted',
            ]
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Seluruh capaian frontliner (6/6 kategori) berhasil dikirim ke Store Manager!',
                'redirect' => route('frontliner.dashboard'),
            ]);
        }

        return redirect()->route('frontliner.dashboard')->with('status', 'Seluruh capaian frontliner berhasil dikirim ke Store Manager!');
    }

    /**
     * Simpan sebagai Draf Sementara
     */
    public function simpanDraft(Request $request)
    {
        session(['capaian_frontliner_draft' => [
            'sop' => $request->input('sop', []),
            'disiplin' => $request->input('disiplin', []),
            'drafted_at' => now()->toDateTimeString(),
        ]]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Draf pengisian capaian berhasil disimpan sementara.',
                'redirect' => route('frontliner.dashboard'),
            ]);
        }

        return redirect()->route('frontliner.dashboard')->with('status', 'Draf capaian berhasil disimpan sementara.');
    }

    // =========================================================================
    // HALAMAN RIWAYAT & DETAIL RIWAYAT FRONTLINER (SESUAI FIGMA REVISI)
    // =========================================================================

    /**
     * Halaman Riwayat Capaian
     */
    public function riwayatCapaian()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
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

        return view('staff.riwayat', compact('user', 'summary', 'historyList'));
    }

    /**
     * Halaman Detail Riwayat (Mendukung Disetujui & Perlu Revisi)
     */
    public function detailRiwayat(Request $request, $id = null)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'frontliner',
            'role_label' => 'Frontliner',
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
            'cta_url' => route('frontliner.penjualan'),
        ];

        $categories = [
            [
                'id' => 'penjualan',
                'name' => 'Penjualan',
                'subtitle' => $isRevisi ? 'Perlu Revisi · Foto tidak jelas' : '3/3 checklist selesai',
                'is_revisi' => $isRevisi,
                'icon' => 'cash',
                'url' => route('frontliner.penjualan'),
            ],
            [
                'id' => 'pelayanan',
                'name' => 'Pelayanan',
                'subtitle' => '3/4 checklist selesai',
                'is_revisi' => false,
                'icon' => 'headset',
                'url' => route('frontliner.pelayanan'),
            ],
            [
                'id' => 'product_knowledge',
                'name' => 'Product Knowledge',
                'subtitle' => '3/3 checklist selesai',
                'is_revisi' => false,
                'icon' => 'lightbulb',
                'url' => route('frontliner.knowledge'),
            ],
            [
                'id' => 'akurasi_kasir',
                'name' => 'Akurasi Kasir',
                'subtitle' => '3/3 checklist selesai',
                'is_revisi' => false,
                'icon' => 'calculator',
                'url' => route('frontliner.kasir'),
            ],
            [
                'id' => 'display_kebersihan',
                'name' => 'Display & Kebersihan',
                'subtitle' => $isRevisi ? '3/3 checklist selesai' : '3/4 checklist selesai',
                'is_revisi' => false,
                'icon' => 'sparkles',
                'url' => route('frontliner.display'),
            ],
            [
                'id' => 'kepatuhan_sop_disiplin',
                'name' => 'Kepatuhan SOP & Disiplin',
                'subtitle' => '3/5 checklist selesai',
                'is_revisi' => false,
                'icon' => 'shield-check',
                'url' => route('frontliner.kepatuhan'),
            ],
        ];

        return view('staff.detail_riwayat', compact('user', 'reportMeta', 'revisionNote', 'categories'));
    }

    /**
     * Halaman Profil Frontliner
     */
    public function profil()
    {
        $user = [
            'name' => 'User',
            'role_label' => 'FRONTLINER',
            'status_label' => 'Akun Aktif',
            'email' => 'User@capaian.id',
            'joined_at' => 'Jan 2024',
        ];

        return view('staff.profil', compact('user'));
    }

    // =========================================================================
    // DETAIL RAPOR HISTORIS (KOMPATIBILITAS HALAMAN SEBELUMNYA)
    // =========================================================================

    public function detailPenjualan()
    {
        return view('staff.penjualan_rapor');
    }

    public function detailAkurasiKasir()
    {
        return view('staff.kasir_rapor');
    }

    public function detailProductKnowledge()
    {
        return view('staff.knowledge_rapor');
    }
}
