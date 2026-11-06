<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Driver (Karyawan Driver)
     */
    public function dashboard()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'Driver',
            'email' => 'user@capaian.id',
        ]);

        $todayBadge = 'Hari ini, 30 Sep';

        // 4 Indikator Capaian Driver untuk Donut & Progress List
        $metricsSummary = [
            'total' => 22,
            'completed' => 5,
            'label' => '5/22',
            'status_text' => 'Tuntas',
            'percentage' => round((5 / 22) * 100),
            'indicators' => [
                [
                    'name' => 'Pengiriman & Keamanan',
                    'completed' => 3,
                    'total' => 3,
                    'percentage' => 100,
                ],
                [
                    'name' => 'SOP Administrasi',
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
            ]
        ];

        // 4 Preview Status Tugas Harian Driver
        $dailyTask = [
            'banner_title' => 'Mulai Isi Capaian Hari Ini',
            'banner_sub' => '4 kategori · 5–10 menit',
            'preview_items' => [
                [
                    'id' => 'pengiriman',
                    'title' => 'Pengiriman & Keamanan',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'url' => route('driver.pengiriman'),
                ],
                [
                    'id' => 'administrasi',
                    'title' => 'SOP Administrasi',
                    'status' => 'tercapai',
                    'status_label' => 'Tercapai',
                    'badge_type' => 'success',
                    'url' => route('driver.administrasi'),
                ],
                [
                    'id' => 'kendaraan',
                    'title' => 'Kendaraan & BBM',
                    'status' => 'belum_diisi',
                    'status_label' => 'Belum diisi',
                    'badge_type' => 'warning',
                    'url' => route('driver.kendaraan'),
                ],
                [
                    'id' => 'pelayanan',
                    'title' => 'Disiplin & Pelayanan',
                    'status' => 'belum_diisi',
                    'status_label' => 'Belum diisi',
                    'badge_type' => 'warning',
                    'url' => route('driver.pelayanan'),
                ],
            ]
        ];

        // Riwayat Capaian Terbaru Driver
        $recentAchievements = [
            [
                'id' => 1,
                'title' => 'Riwayat 24 Oktober 2024',
                'sub' => '4/16 kategori terisi',
                'status' => 'menunggu',
                'status_label' => 'Menunggu',
                'badge_class' => 'badge-amber',
                'url' => route('driver.riwayat.detail', ['id' => 1]),
            ],
            [
                'id' => 2,
                'title' => 'Riwayat 23 Oktober 2024',
                'sub' => '10/16 kategori terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'url' => route('driver.riwayat.detail', ['id' => 2]),
            ],
            [
                'id' => 3,
                'title' => 'Riwayat 22 Oktober 2024',
                'sub' => '14/16 kategori terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'badge_class' => 'badge-green',
                'url' => route('driver.riwayat.detail', ['id' => 3]),
            ],
        ];

        return view('driver.dashboard', compact('user', 'todayBadge', 'metricsSummary', 'dailyTask', 'recentAchievements'));
    }

    /**
     * Langkah 1: Ketepatan Pengiriman & Keamanan Barang
     */
    public function isiPengiriman()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'Driver',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('driver_capaian.step1', [
            'datang_tepat' => true,
            'tidak_terlambat' => false,
            'prioritas_pengiriman' => false,
            'kondisi_baik' => false,
            'penataan_aman' => false,
            'tidak_komplain' => false,
        ]);

        return view('driver.pengiriman', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 1
     */
    public function simpanPengiriman(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['driver_capaian.step1' => $indicators]);

        return redirect()->route('driver.administrasi');
    }

    /**
     * Langkah 2: SOP Administrasi
     */
    public function isiAdministrasi()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'Driver',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('driver_capaian.step2', [
            'surat_jalan' => false,
            'tanda_tangan' => false,
            'kembalikan_dokumen' => false,
            'photos' => ['foto_kerusakan_1.jpg', 'foto_kerusakan_2.jpg'],
        ]);

        return view('driver.administrasi', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 2
     */
    public function simpanAdministrasi(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['driver_capaian.step2' => $indicators]);

        return redirect()->route('driver.kendaraan');
    }

    /**
     * Langkah 3: Kendaraan & BBM
     */
    public function isiKendaraan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'Driver',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('driver_capaian.step3', [
            'kebersihan' => false,
            'cek_rem' => false,
            'cek_oli' => false,
            'cek_ban' => false,
            'cek_lampu' => false,
            'lapor_kerusakan' => false,
            'tidak_boros_bbm' => false,
            'tidak_pribadi' => false,
            'rute_efektif' => false,
        ]);

        return view('driver.kendaraan', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 3
     */
    public function simpanKendaraan(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['driver_capaian.step3' => $indicators]);

        return redirect()->route('driver.pelayanan');
    }

    /**
     * Langkah 4: Disiplin & Pelayanan
     */
    public function isiPelayanan()
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'Driver',
            'email' => 'user@capaian.id',
        ]);

        $stepData = session('driver_capaian.step4', [
            'kerapian' => false,
            'briefing' => false,
            'komunikasi' => false,
            'tidak_konflik' => false,
            'photos' => ['foto_kerusakan_1.jpg', 'foto_kerusakan_2.jpg'],
        ]);

        return view('driver.pelayanan', compact('user', 'stepData'));
    }

    /**
     * Simpan Langkah 4 & Kirim Semua
     */
    public function simpanPelayanan(Request $request)
    {
        $indicators = $request->input('indicators', []);
        session(['driver_capaian.step4' => $indicators]);

        // Tandai capaian hari ini selesai
        session([
            'driver_capaian_completed' => true,
            'driver_capaian_completed_at' => now()->toDateTimeString(),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Seluruh capaian driver harian berhasil dikirim!',
                'redirect' => route('driver.dashboard'),
            ]);
        }

        return redirect()->route('driver.dashboard')->with('status', 'Seluruh capaian driver harian berhasil dikirim!');
    }

    /**
     * Simpan Draf Sementara
     */
    public function simpanDraft(Request $request)
    {
        session([
            'driver_capaian_draft' => [
                'indicators' => $request->input('indicators', []),
                'drafted_at' => now()->toDateTimeString(),
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Capaian berhasil disimpan sebagai draf sementara!',
            'redirect' => route('driver.dashboard'),
        ]);
    }

    /**
     * Halaman Riwayat Capaian Driver Sesuai Figma
     */
    public function riwayatCapaian(Request $request)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'Driver',
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
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 1]),
            ],
            [
                'id' => 2,
                'day_name' => 'Rab',
                'day_num' => '23',
                'full_date' => '23 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'menunggu',
                'status_label' => 'Menunggu',
                'detail_url' => route('driver.riwayat.detail', ['id' => 2]),
            ],
            [
                'id' => 3,
                'day_name' => 'Sel',
                'day_num' => '22',
                'full_date' => '22 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'revisi',
                'status_label' => 'Revisi',
                'detail_url' => route('driver.riwayat.detail', ['id' => 3]),
            ],
            [
                'id' => 4,
                'day_name' => 'Sen',
                'day_num' => '21',
                'full_date' => '21 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 4]),
            ],
            [
                'id' => 5,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 5]),
            ],
            [
                'id' => 6,
                'day_name' => 'Sab',
                'day_num' => '19',
                'full_date' => '19 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'revisi',
                'status_label' => 'Revisi',
                'detail_url' => route('driver.riwayat.detail', ['id' => 6]),
            ],
            [
                'id' => 7,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 7]),
            ],
            [
                'id' => 8,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 8]),
            ],
            [
                'id' => 9,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 9]),
            ],
            [
                'id' => 10,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 10]),
            ],
            [
                'id' => 11,
                'day_name' => 'Min',
                'day_num' => '20',
                'full_date' => '20 Okt 2024',
                'category_info' => '4/22 Checklist terisi',
                'status' => 'disetujui',
                'status_label' => 'Disetujui',
                'detail_url' => route('driver.riwayat.detail', ['id' => 11]),
            ],
        ];

        $filter = $request->query('status', 'disetujui');

        return view('driver.riwayat', compact('user', 'summaryCounts', 'riwayatList', 'filter'));
    }

    /**
     * Halaman Detail Riwayat Capaian Driver Sesuai Figma
     * (Mendukung Tampilan Disetujui & Perlu Perbaikan/Revisi)
     */
    public function detailRiwayat(Request $request, $id = null)
    {
        $user = session('user', [
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'Driver',
            'email' => 'user@capaian.id',
        ]);

        // Cek jika status revisi dari parameter atau id
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
                'message' => 'Foto bukti Ketepatan Pengiriman & Keamanan Barang kurang jelas, mohon upload ulang.',
                'repair_url' => route('driver.pengiriman'),
                'repair_label' => 'PERBAIKI CAPAIAN',
            ],
            'categories_summary' => [
                'total_label' => '4 Kategori',
                'items' => [
                    [
                        'id' => 'pengiriman',
                        'title' => 'Ketepatan Pengiriman & Keamanan Barang',
                        'badge' => $isRevision ? 'PERLU REVISI' : null,
                        'subtitle' => $isRevision ? 'Perlu Revisi · Foto tidak jelas' : '3/6 checklist selesai',
                        'icon' => 'box',
                        'is_highlighted' => $isRevision,
                        'url' => route('driver.pengiriman'),
                    ],
                    [
                        'id' => 'administrasi',
                        'title' => 'SOP Administrasi',
                        'badge' => null,
                        'subtitle' => '3/4 checklist selesai',
                        'icon' => 'document',
                        'is_highlighted' => false,
                        'url' => route('driver.administrasi'),
                    ],
                    [
                        'id' => 'kendaraan',
                        'title' => 'Kendaraan & BBM',
                        'badge' => null,
                        'subtitle' => '3/9 checklist selesai',
                        'icon' => 'truck',
                        'is_highlighted' => false,
                        'url' => route('driver.kendaraan'),
                    ],
                    [
                        'id' => 'pelayanan',
                        'title' => 'Disiplin & Pelayanan',
                        'badge' => null,
                        'subtitle' => '3/4 checklist selesai',
                        'icon' => 'headset',
                        'is_highlighted' => false,
                        'url' => route('driver.pelayanan'),
                    ],
                ],
            ],
            'notice' => 'Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.',
        ];

        return view('driver.detail_riwayat', compact('user', 'detailRiwayat', 'isRevision'));
    }

    /**
     * Halaman Profil Driver Sesuai Figma
     */
    public function profil()
    {
        $sessionUser = session('user', []);

        $user = array_merge([
            'name' => 'User',
            'role' => 'driver',
            'role_label' => 'DRIVER',
            'email' => 'User@capaian.id',
            'phone' => '081234567890',
            'joined_at' => 'Jan 2024',
            'status_label' => 'Akun Aktif',
            'status' => 'active',
        ], $sessionUser);

        if (!empty($user['role_label'])) {
            $user['role_label'] = strtoupper($user['role_label']);
        }

        return view('driver.profil', compact('user'));
    }
}

