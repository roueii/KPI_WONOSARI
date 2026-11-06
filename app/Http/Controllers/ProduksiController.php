<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Karyawan Produksi
     */
    public function dashboard()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $todayBadge = 'Hari ini, 30 Sep';

        // 5 Indikator Capaian Produksi untuk Donut & Progress List
        $metricsSummary = [
            'total' => 16,
            'completed' => 5,
            'label' => '5/16',
            'status_text' => 'Tuntas',
            'percentage' => round((5 / 16) * 100),
            'indicators' => [
                [
                    'name' => 'Hasil Produksi',
                    'completed' => 3,
                    'total' => 3,
                    'percentage' => 100,
                ],
                [
                    'name' => 'Waktu & Alat',
                    'completed' => 3,
                    'total' => 4,
                    'percentage' => 75,
                ],
                [
                    'name' => 'Kehadiran & Disiplin',
                    'completed' => 0,
                    'total' => 3,
                    'percentage' => 0,
                ],
                [
                    'name' => 'Kepatuhan SOP',
                    'completed' => 3,
                    'total' => 4,
                    'percentage' => 75,
                ],
                [
                    'name' => 'Kebersihan Area Kerja',
                    'completed' => 6,
                    'total' => 6,
                    'percentage' => 100,
                ],
            ]
        ];

        // 5 Preview Status Tugas Harian Produksi Sesuai Figma
        $dailyTask = [
            'banner_title' => 'Mulai Isi Capaian Hari Ini',
            'banner_sub' => '5 kategori · 5–10 menit',
            'preview_items' => [
                [
                    'id' => 'hasil_produksi',
                    'title' => 'Hasil Produksi',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'url' => route('produksi.hasil_produksi'),
                ],
                [
                    'id' => 'waktu_alat',
                    'title' => 'Waktu & Alat',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'url' => route('produksi.waktu_alat'),
                ],
                [
                    'id' => 'kehadiran_disiplin',
                    'title' => 'Kehadiran & Disiplin',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'url' => route('produksi.kehadiran_disiplin'),
                ],
                [
                    'id' => 'kepatuhan_sop',
                    'title' => 'Kepatuhan SOP',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'url' => route('produksi.kepatuhan_sop'),
                ],
                [
                    'id' => 'kebersihan_area',
                    'title' => 'Kebersihan Area Kerja',
                    'status' => 'belum_diisi',
                    'status_label' => 'Belum diisi',
                    'badge_type' => 'warning',
                    'url' => route('produksi.kebersihan_area'),
                ],
            ]
        ];

        // Riwayat Capaian Terbaru Produksi Sesuai Figma
        $recentAchievements = [
            [
                'id' => 1,
                'title' => 'Riwayat 24 Oktober 2024',
                'sub' => '4/16 kategori terisi',
                'status' => 'menunggu',
                'status_label' => 'Menunggu',
                'badge_class' => 'badge-amber',
                'url' => route('produksi.riwayat.detail', ['id' => 1]),
            ],
            [
                'id' => 2,
                'title' => 'Riwayat 23 Oktober 2024',
                'sub' => '10/16 kategori terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'url' => route('produksi.riwayat.detail', ['id' => 2]),
            ],
            [
                'id' => 3,
                'title' => 'Riwayat 22 Oktober 2024',
                'sub' => '14/16 kategori terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'url' => route('produksi.riwayat.detail', ['id' => 3]),
            ],
        ];

        return view('produksi.dashboard', compact('user', 'todayBadge', 'metricsSummary', 'dailyTask', 'recentAchievements'));
    }

    /**
     * Langkah 1 dari 5: Hasil Produksi
     */
    public function isiHasilProduksi()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('produksi_capaian.step1', [
            'target_roti' => true,
            'reject_maksimal' => false,
            'waste_terkontrol' => true,
        ]);

        return view('produksi.hasil_produksi', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 1
     */
    public function simpanHasilProduksi(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['produksi_capaian.step1' => $indicators]);

        return redirect()->route('produksi.waktu_alat');
    }

    /**
     * Langkah 2 dari 5: Waktu & Alat
     */
    public function isiWaktuAlat()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('produksi_capaian.step2', [
            'selesai_sebelum_jadwal' => true,
            'tidak_terlambat_buka' => false,
            'bebas_kerusakan_operator' => false,
            'perawatan_harian' => true,
            'photos' => ['foto_kerusakan_1.jpg', 'foto_kerusa...'],
        ]);

        return view('produksi.waktu_alat', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 2
     */
    public function simpanWaktuAlat(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['produksi_capaian.step2' => $indicators]);

        return redirect()->route('produksi.kehadiran_disiplin');
    }

    /**
     * Langkah 3 dari 5: Kehadiran & Disiplin
     */
    public function isiKehadiranDisiplin()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('produksi_capaian.step3', [
            'tidak_terlambat' => false,
            'tidak_pulang_awal' => false,
            'tidak_mangkir' => false,
        ]);

        return view('produksi.kehadiran_disiplin', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 3
     */
    public function simpanKehadiranDisiplin(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['produksi_capaian.step3' => $indicators]);

        return redirect()->route('produksi.kepatuhan_sop');
    }

    /**
     * Langkah 4 dari 5: Kepatuhan SOP
     */
    public function isiKepatuhanSop()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('produksi_capaian.step4', [
            'menimbang_resep' => false,
            'waktu_fermentasi' => false,
            'menggunakan_apd' => false,
            'mencatat_batch' => false,
        ]);

        return view('produksi.kepatuhan_sop', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 4
     */
    public function simpanKepatuhanSop(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['produksi_capaian.step4' => $indicators]);

        return redirect()->route('produksi.kebersihan_area');
    }

    /**
     * Langkah 5 dari 5: Kebersihan Area Kerja
     */
    public function isiKebersihanArea()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('produksi_capaian.step5', [
            'meja_bersih' => false,
            'oven_bersih' => false,
            'mixer_bersih' => false,
            'lantai_bersih' => false,
            'rak_bersih' => false,
            'tempat_sampah' => false,
            'photos' => ['foto_kerusakan_1.jpg', 'foto_kerusa...'],
        ]);

        return view('produksi.kebersihan_area', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 5 & Kirim Semua
     */
    public function simpanKebersihanArea(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['produksi_capaian.step5' => $indicators]);

        session([
            'produksi_capaian_completed' => true,
            'produksi_capaian_completed_at' => now()->toDateTimeString(),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Seluruh capaian produksi harian berhasil dikirim!',
                'redirect' => route('produksi.dashboard'),
            ]);
        }

        return redirect()->route('produksi.dashboard')->with('status', 'Seluruh capaian produksi harian berhasil dikirim!');
    }

    /**
     * Simpan Draf Sementara
     */
    public function simpanDraft(Request $request)
    {
        session([
            'produksi_capaian_draft' => [
                'indicators' => $request->input('indicators', []),
                'drafted_at' => now()->toDateTimeString(),
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Capaian produksi berhasil disimpan sebagai draf sementara!',
            'redirect' => route('produksi.dashboard'),
        ]);
    }

    /**
     * Halaman Riwayat Capaian Produksi Sesuai Figma
     */
    public function riwayatCapaian(Request $request)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $summaryCounts = [
            'disetujui' => 3,
            'menunggu' => 1,
            'revisi' => 2,
            'semua' => 6,
        ];

        $riwayatList = [
            [
                'id' => 1,
                'day_name' => 'Kam',
                'day_num' => '24',
                'full_date' => '24 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 1]),
            ],
            [
                'id' => 2,
                'day_name' => 'Rab',
                'day_num' => '23',
                'full_date' => '23 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'menunggu',
                'status_label' => 'Menunggu',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 2]),
            ],
            [
                'id' => 3,
                'day_name' => 'Sel',
                'day_num' => '22',
                'full_date' => '22 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'revisi',
                'status_label' => 'Revisi',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 3]),
            ],
            [
                'id' => 4,
                'day_name' => 'Sen',
                'day_num' => '21',
                'full_date' => '21 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 4]),
            ],
            [
                'id' => 5,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 5]),
            ],
            [
                'id' => 6,
                'day_name' => 'Sab',
                'day_num' => '19',
                'full_date' => '19 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'revisi',
                'status_label' => 'Revisi',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 6]),
            ],
            [
                'id' => 7,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 7]),
            ],
            [
                'id' => 8,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 8]),
            ],
            [
                'id' => 9,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 9]),
            ],
            [
                'id' => 10,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 10]),
            ],
            [
                'id' => 11,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/16 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('produksi.riwayat.detail', ['id' => 11]),
            ],
        ];

        $filter = $request->query('status', 'disetujui');

        return view('produksi.riwayat', compact('user', 'summaryCounts', 'riwayatList', 'filter'));
    }

    /**
     * Halaman Detail Riwayat Capaian Produksi Sesuai Figma
     * (Mendukung Tampilan Disetujui & Perlu Revisi)
     */
    public function detailRiwayat(Request $request, $id = null)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'Produksi',
            'email' => 'user@capaian.id',
        ]);

        $isRevision = $request->query('status') === 'revisi' || in_array($id, [3, 6, 'revisi']);

        $detailRiwayat = [
            'id' => $id ?? 1,
            'title' => 'Riwayat — 24 Okt',
            'status' => $isRevision ? 'revisi' : 'disetujui',
            'status_label' => $isRevision ? 'PERLU REVISI' : 'DISETUJUI',
            'sent_at' => 'Dikirim 24 Okt 2026, 21:05 WIB',
            'revision_note' => [
                'label' => 'CATATAN REVISI',
                'requested_by' => 'User (Store Manager)',
                'requested_at' => '25 Okt, 08:30 WIB',
                'message' => 'Foto bukti Hasil Produksi kurang jelas, mohon upload ulang.',
                'repair_url' => route('produksi.hasil_produksi'),
                'repair_label' => 'PERBAIKI CAPAIAN',
            ],
            'categories_summary' => [
                'total_label' => '5 Kategori',
                'items' => [
                    [
                        'id' => 'hasil_produksi',
                        'title' => 'Hasil Produksi',
                        'badge' => $isRevision ? 'PERLU REVISI' : null,
                        'subtitle' => $isRevision ? 'Perlu Revisi · Foto tidak jelas' : '3/3 checklist selesai',
                        'icon' => 'box',
                        'is_highlighted' => $isRevision,
                        'url' => route('produksi.hasil_produksi'),
                    ],
                    [
                        'id' => 'waktu_alat',
                        'title' => 'Waktu & Alat',
                        'badge' => null,
                        'subtitle' => '3/4 checklist selesai',
                        'icon' => 'timer',
                        'is_highlighted' => false,
                        'url' => route('produksi.waktu_alat'),
                    ],
                    [
                        'id' => 'kehadiran_disiplin',
                        'title' => 'Kehadiran & Disiplin',
                        'badge' => null,
                        'subtitle' => '3/3 checklist selesai',
                        'icon' => 'user',
                        'is_highlighted' => false,
                        'url' => route('produksi.kehadiran_disiplin'),
                    ],
                    [
                        'id' => 'kepatuhan_sop',
                        'title' => 'Kepatuhan SOP',
                        'badge' => null,
                        'subtitle' => '3/4 checklist selesai',
                        'icon' => 'shield',
                        'is_highlighted' => false,
                        'url' => route('produksi.kepatuhan_sop'),
                    ],
                    [
                        'id' => 'kebersihan_area',
                        'title' => 'Kebersihan Area Kerja',
                        'badge' => null,
                        'subtitle' => '3/6 checklist selesai',
                        'icon' => 'sparkle',
                        'is_highlighted' => false,
                        'url' => route('produksi.kebersihan_area'),
                    ],
                ],
            ],
            'notice' => 'Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.',
        ];

        return view('produksi.detail_riwayat', compact('user', 'detailRiwayat', 'isRevision'));
    }

    /**
     * Halaman Profil Produksi Sesuai Figma
     */
    public function profil()
    {
        $sessionUser = session('user', []);

        $user = array_merge([
            'name' => 'User',
            'role' => 'produksi',
            'role_label' => 'PRODUKSI',
            'email' => 'User@capaian.id',
            'joined_at' => 'Jan 2024',
            'status_label' => 'Akun Aktif',
            'status' => 'active',
        ], $sessionUser);

        if (!empty($user['role_label'])) {
            $user['role_label'] = strtoupper($user['role_label']);
        }

        return view('produksi.profil', compact('user'));
    }
}

