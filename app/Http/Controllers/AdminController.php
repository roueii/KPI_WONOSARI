<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilkan halaman utama Admin Dashboard
     */
    public function dashboard()
    {
        $user = session('user', [
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'User@capaian.id',
        ]);

        $attentionItems = [
            [
                'id' => 'approval',
                'title' => 'Menunggu Approval Final',
                'subtitle' => 'Sudah disetujui Store Manager',
                'count' => 6,
                'icon' => 'approval',
            ],
            [
                'id' => 'revisi',
                'title' => 'Perlu Revisi',
                'subtitle' => 'Belum ditindaklanjuti > 2 hari',
                'count' => 3,
                'icon' => 'revisi',
            ],
        ];

        $divisions = [
            [
                'name' => 'Store Manager',
                'staff_count' => 2,
                'percentage' => 100,
            ],
            [
                'name' => 'Frontliner',
                'staff_count' => 6,
                'percentage' => 88,
            ],
            [
                'name' => 'Produksi',
                'staff_count' => 8,
                'percentage' => 75,
            ],
            [
                'name' => 'Driver',
                'staff_count' => 3,
                'percentage' => 84,
            ],
            [
                'name' => 'Sales & Marketing',
                'staff_count' => 2,
                'percentage' => 68,
            ],
            [
                'name' => 'SPV',
                'staff_count' => 2,
                'percentage' => 80,
            ],
        ];

        $adminMenus = [
            [
                'title' => 'Tinjau Revisi',
                'badge' => '3 aktif',
                'badge_type' => 'pill',
                'icon' => 'file-edit',
                'url' => '#',
            ],
            [
                'title' => 'Kelola Akun',
                'badge' => '23 staf',
                'badge_type' => 'text',
                'icon' => 'users',
                'url' => '#',
            ],
            [
                'title' => 'Kelola KPI',
                'badge' => '6 divisi',
                'badge_type' => 'text',
                'icon' => 'sliders',
                'url' => '#',
            ],
            [
                'title' => 'Approve Laporan',
                'badge' => '6 antrean',
                'badge_type' => 'pill',
                'icon' => 'user-check',
                'url' => '#',
            ],
        ];

        return view('admin.dashboard', compact('user', 'attentionItems', 'divisions', 'adminMenus'));
    }

    /**
     * Tampilkan halaman Profil Admin
     */
    public function profile()
    {
        $sessionUser = session('user');

        $user = [
            'name' => 'User',
            'role' => 'ADMIN',
            'status' => 'Akun Aktif',
            'email' => 'User@capaian.id',
            'phone' => '081234567890',
            'joined_date' => 'Jan 2024',
        ];

        return view('admin.profile', compact('user'));
    }

    /**
     * Tampilkan halaman Tinjau Revisi
     */
    public function revisi()
    {
        $user = session('user', [
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'User@capaian.id',
        ]);

        $filterCounts = [
            'all' => 3,
            'sm' => 2,
            'owner' => 1,
            'store_manager' => 2,
        ];

        return view('admin.revisi', compact('user', 'filterCounts'));
    }

    /**
     * Tampilkan halaman Kelola Akun
     */
    public function kelolaAkun()
    {
        $user = session('user', [
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'User@capaian.id',
        ]);

        $summary = [
            'total_karyawan' => 23,
            'total_divisi' => 6,
        ];

        $filterCounts = [
            'all' => 23,
            'store_manager' => 2,
            'frontliner' => 6,
            'produksi' => 8,
        ];

        return view('admin.accounts', compact('user', 'summary', 'filterCounts'));
    }

    /**
     * Tampilkan halaman Kelola KPI
     */
    public function kelolaKpi()
    {
        $user = session('user', [
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'User@capaian.id',
        ]);

        $divisions = ['Store Manager', 'Frontliner', 'Produksi', 'Driver'];
        $activeDivision = 'Produksi';

        $kpiGroups = [
            'Produksi' => [
                [
                    'id' => 'produktivitas',
                    'title' => 'Produktivitas produksi',
                    'count_text' => null,
                    'expanded' => true,
                    'items' => [
                        [
                            'id' => 1,
                            'name' => 'Jumlah roti diproduksi',
                            'subtitle' => 'Minimum: belum diisi',
                            'badge' => 'Angka · pcs',
                            'type' => 'number',
                        ],
                    ],
                ],
                [
                    'id' => 'kualitas',
                    'title' => 'Kualitas produk',
                    'count_text' => null,
                    'expanded' => true,
                    'items' => [
                        [
                            'id' => 2,
                            'name' => 'Produk reject',
                            'subtitle' => 'Maksimal 2%',
                            'badge' => 'Angka · %',
                            'type' => 'number',
                        ],
                    ],
                ],
                [
                    'id' => 'sop',
                    'title' => 'Kepatuhan SOP',
                    'count_text' => '4 hal',
                    'expanded' => true,
                    'items' => [
                        [
                            'id' => 3,
                            'name' => 'Menimbang sesuai resep',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 4,
                            'name' => 'Mengikuti waktu fermentasi',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 5,
                            'name' => 'Menggunakan APD',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 6,
                            'name' => 'Mencatat batch produksi',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                    ],
                ],
                [
                    'id' => 'kebersihan',
                    'title' => 'Kebersihan area produksi',
                    'count_text' => '3 hal',
                    'expanded' => false,
                    'items' => [
                        [
                            'id' => 7,
                            'name' => 'Sanitasi meja kerja dan loyang',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 8,
                            'name' => 'Pembersihan proofer & oven',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 9,
                            'name' => 'Pembuangan limbah adonan',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                    ],
                ],
            ],
            'Frontliner' => [
                [
                    'id' => 'penjualan',
                    'title' => 'Penjualan Toko',
                    'count_text' => '2 hal',
                    'expanded' => true,
                    'items' => [
                        [
                            'id' => 10,
                            'name' => 'Target omzet harian',
                            'subtitle' => 'Target: Rp 4.500.000',
                            'badge' => 'Angka · Rp',
                            'type' => 'number',
                        ],
                        [
                            'id' => 11,
                            'name' => 'Transaksi kasir selesai',
                            'subtitle' => 'Minimum: 80 struk',
                            'badge' => 'Angka · pcs',
                            'type' => 'number',
                        ],
                    ],
                ],
                [
                    'id' => 'layanan',
                    'title' => 'Layanan & Kebersihan',
                    'count_text' => '3 hal',
                    'expanded' => true,
                    'items' => [
                        [
                            'id' => 12,
                            'name' => 'Display roti rapi & first-in-first-out',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 13,
                            'name' => 'Penerapan senyum, salam, sapa (3S)',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 14,
                            'name' => 'Closing kasir balance tanpa selisih',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                    ],
                ],
            ],
            'Store Manager' => [
                [
                    'id' => 'operasional',
                    'title' => 'Operasional Toko & Manajerial',
                    'count_text' => '3 hal',
                    'expanded' => true,
                    'items' => [
                        [
                            'id' => 15,
                            'name' => 'Pemeriksaan stok bahan baku mingguan',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 16,
                            'name' => 'Approval laporan harian divisi',
                            'subtitle' => 'Sebelum jam 21:00',
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 17,
                            'name' => 'Laporan cashflow harian',
                            'subtitle' => null,
                            'badge' => 'Angka · Rp',
                            'type' => 'number',
                        ],
                    ],
                ],
            ],
            'Driver' => [
                [
                    'id' => 'distribusi',
                    'title' => 'Distribusi & Logistik',
                    'count_text' => '3 hal',
                    'expanded' => true,
                    'items' => [
                        [
                            'id' => 18,
                            'name' => 'Waktu pengiriman tepat jadwal',
                            'subtitle' => 'Toleransi maks 10 menit',
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 19,
                            'name' => 'Pemeriksaan kondisi armada kendaraan',
                            'subtitle' => 'Sebelum berangkat',
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                        [
                            'id' => 20,
                            'name' => 'Surat jalan ditandatangani outlet',
                            'subtitle' => null,
                            'badge' => 'Ceklis',
                            'type' => 'checkbox',
                        ],
                    ],
                ],
            ],
        ];

        return view('admin.kpi', compact('user', 'divisions', 'activeDivision', 'kpiGroups'));
    }

    /**
     * Tampilkan halaman Approve Laporan
     */
    public function approveLaporan()
    {
        $user = session('user', [
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'User@capaian.id',
        ]);

        $filterCounts = [
            'total' => 6,
            'semua' => 6,
            'store_manager' => 1,
            'frontliner' => 2,
            'produksi' => 1,
            'driver' => 1,
            'sales_marketing' => 1,
        ];

        $reports = [
            [
                'id' => 1,
                'name' => 'Budi Santoso',
                'division' => 'Frontliner',
                'status_sm' => 'Disetujui SM',
                'is_self_review' => false,
                'is_expanded' => true,
                'outlet_info' => 'Outlet Malioboro · Pelayanan & Kasir',
                'approval_meta' => 'Disetujui oleh Siti (Store Manager) · 24 Okt, 09:15',
                'files_count' => 2,
                'files_title' => 'Foto Bukti (2 File)',
                'files_subtitle' => 'Display kasir & bukti fisik setoran',
                'checklist_summary' => '1/4 Terpenuhi',
                'checklists' => [
                    [
                        'title' => 'Kebersihan Kasir & Display Roti',
                        'target_sub' => 'Target: 100% · Hasil: 100% Bersih',
                        'is_checked' => true,
                    ],
                    [
                        'title' => 'Greeting & Senyum Ramah',
                        'target_sub' => 'Target: Min 50 · Hasil: 54 transaksi tercatat',
                        'is_checked' => false,
                    ],
                    [
                        'title' => 'Ketepatan Setoran Fisik Kasir',
                        'target_sub' => 'Target: Match · Sesuai Rp 4.850.000 (Selisih Rp 0)',
                        'is_checked' => false,
                    ],
                    [
                        'title' => 'Up-selling Produk Promo (Roti Abon)',
                        'target_sub' => 'Target: 15 pcs · Hasil: 18 pcs terjual',
                        'is_checked' => false,
                    ],
                ],
                'sm_note' => 'Kerja Budi sangat tertib hari ini, display rapi dan closing kasir tepat waktu tanpa selisih.',
            ],
            [
                'id' => 2,
                'name' => 'Joko Prasetyo',
                'division' => 'Produksi',
                'status_sm' => 'Disetujui SM',
                'is_self_review' => false,
                'is_expanded' => false,
                'outlet_info' => 'Efisiensi Oven & Bahan Baku · 24 Okt 2024',
                'time_text' => 'Disetujui Siti · 10:30 WIB',
                'files_count' => 1,
                'files_badge' => '1 Foto Bukti',
            ],
            [
                'id' => 3,
                'name' => 'Dewi Lestari',
                'division' => 'Frontliner',
                'status_sm' => 'Disetujui SM',
                'is_self_review' => false,
                'is_expanded' => false,
                'outlet_info' => 'Display & Rotasi Stok Roti · 24 Okt 2024',
                'time_text' => 'Disetujui Siti · 11:00 WIB',
                'files_count' => 3,
                'files_badge' => '3 Foto Bukti',
            ],
            [
                'id' => 4,
                'name' => 'Agus Hermawan',
                'division' => 'Driver',
                'status_sm' => 'Disetujui SM',
                'is_self_review' => false,
                'is_expanded' => false,
                'outlet_info' => 'Ketepatan Pengantaran Outlet · 24 Okt 2024',
                'time_text' => 'Disetujui Siti · 11:45 WIB',
                'files_count' => 1,
                'files_badge' => '1 Foto Bukti',
            ],
            [
                'id' => 5,
                'name' => 'Rian Hidayat',
                'division' => 'Sales & Marketing',
                'status_sm' => 'Disetujui SM',
                'is_self_review' => false,
                'is_expanded' => false,
                'outlet_info' => 'Kemitraan Katering Event · 23 Okt 2024',
                'time_text' => 'Disetujui Siti · 24 Okt, 08:30 WIB',
                'files_count' => 2,
                'files_badge' => '2 Foto Bukti',
            ],
            [
                'id' => 6,
                'name' => 'Siti Rahma',
                'division' => 'Store Manager',
                'status_sm' => 'Self-Review SM',
                'is_self_review' => true,
                'is_expanded' => false,
                'outlet_info' => 'Stock Opname & Laba Harian · 23 Okt 2024',
                'time_text' => 'Disubmit Siti · 23 Okt, 21:00 WIB',
                'files_count' => 4,
                'files_badge' => '4 Foto Bukti',
            ],
        ];

        return view('admin.approve', compact('user', 'filterCounts', 'reports'));
    }
}
