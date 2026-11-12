<?php

namespace App\Http\Controllers;

use App\Services\BackendApiService;
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
     * Pemetaan nama jabatan Backend -> label, kunci filter, dan kelas warna di UI.
     */
    private function divisionMeta(?string $position): array
    {
        return match (strtolower((string) $position)) {
            'store manager' => ['Store Manager', 'store_manager', 'store-manager'],
            'frontliner' => ['Frontliner', 'frontliner', 'frontliner'],
            'produksi' => ['Produksi', 'produksi', 'produksi'],
            'driver' => ['Driver', 'driver', 'driver'],
            'sales' => ['Sales & Marketing', 'sales', 'frontliner'],
            'spv' => ['Supervisor', 'supervisor', 'store-manager'],
            '' => ['Admin', 'admin', 'outline'],
            default => [(string) $position, \Illuminate\Support\Str::slug((string) $position, '_'), 'outline'],
        };
    }

    private function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim(preg_replace('/\(.*?\)/', '', $name)));
        return strtoupper(mb_substr($parts[0] ?? '', 0, 1) . mb_substr($parts[1] ?? '', 0, 1));
    }

    /**
     * Tampilkan halaman Kelola Akun.
     * Data dari Backend: GET /api/admin/users & /api/admin/positions (fallback: data contoh).
     */
    public function kelolaAkun()
    {
        $user = session('user', [
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'User@capaian.id',
        ]);

        $usersJson = BackendApiService::fetch('admin/users', ['per_page' => 100]);
        $positionsJson = BackendApiService::fetch('admin/positions');
        $isLive = $usersJson !== null && $positionsJson !== null;

        if ($isLive) {
            $positions = array_map(fn ($p) => [
                'id' => $p['id'],
                'label' => $this->divisionMeta($p['name'])[0],
            ], $positionsJson['data'] ?? $positionsJson);

            $raw = array_map(fn ($u) => [
                'id' => $u['id'],
                'name' => $u['name'],
                'email' => $u['email'],
                'active' => (bool) $u['is_active'],
                'position' => $u['position']['name'] ?? null,
                'position_id' => $u['position']['id'] ?? null,
                'is_admin' => strtolower($u['role']['name'] ?? '') === 'admin',
                'created_at' => $u['created_at'] ?? null,
            ], $usersJson['data'] ?? []);
        } else {
            // Data contoh (mode demo / Backend tidak tersedia)
            $positions = array_map(fn ($n, $i) => ['id' => $i + 1, 'label' => $this->divisionMeta($n)[0]],
                ['Store Manager', 'Frontliner', 'Produksi', 'Driver', 'Sales', 'SPV'], range(0, 5));
            $raw = [
                ['id' => 1, 'name' => 'Budi Santoso', 'email' => 'budi.frontliner@capaian.id', 'active' => true, 'position' => 'Frontliner', 'position_id' => 2, 'is_admin' => false, 'created_at' => '2024-01-10'],
                ['id' => 2, 'name' => 'Siti Rahma', 'email' => 'siti@capaian.id', 'active' => true, 'position' => 'Store Manager', 'position_id' => 1, 'is_admin' => false, 'created_at' => '2023-08-01'],
                ['id' => 3, 'name' => 'Joko Prasetyo', 'email' => 'joko@capaian.id', 'active' => true, 'position' => 'Produksi', 'position_id' => 3, 'is_admin' => false, 'created_at' => '2024-03-01'],
                ['id' => 4, 'name' => 'Agus Hermawan', 'email' => 'agus@capaian.id', 'active' => true, 'position' => 'Driver', 'position_id' => 4, 'is_admin' => false, 'created_at' => '2024-05-01'],
                ['id' => 5, 'name' => 'Dewi Lestari', 'email' => 'dewi@capaian.id', 'active' => true, 'position' => 'Frontliner', 'position_id' => 2, 'is_admin' => false, 'created_at' => '2024-06-01'],
                ['id' => 6, 'name' => 'Hendra Wijaya', 'email' => 'hendra@capaian.id', 'active' => false, 'position' => 'Produksi', 'position_id' => 3, 'is_admin' => false, 'created_at' => '2024-11-01'],
            ];
        }

        $accounts = array_map(function ($u) {
            [$label, $key, $pill] = $this->divisionMeta($u['position']);
            return array_merge($u, [
                'division' => $label,
                'category' => $key,
                'pill_class' => $pill,
                'initials' => $this->initials($u['name']),
                'joined' => $u['created_at']
                    ? 'Bergabung ' . \Carbon\Carbon::parse($u['created_at'])->locale('id')->translatedFormat('M Y')
                    : 'Tanggal bergabung tidak tersedia',
            ]);
        }, $raw);

        // Hitung jumlah per divisi untuk chip filter
        $divisions = [];
        foreach ($accounts as $acc) {
            $divisions[$acc['category']] ??= ['key' => $acc['category'], 'label' => $acc['division'], 'count' => 0];
            $divisions[$acc['category']]['count']++;
        }

        $nonAdmin = array_filter($accounts, fn ($a) => ! $a['is_admin']);
        $summary = [
            'total_karyawan' => count($nonAdmin),
            'total_divisi' => count(array_unique(array_column($nonAdmin, 'category'))),
        ];

        $filterCounts = [
            'all' => count($accounts),
            'divisions' => array_values($divisions),
        ];

        return view('admin.accounts', compact('user', 'summary', 'filterCounts', 'accounts', 'positions', 'isLive'));
    }

    /**
     * Role Backend ditentukan dari jabatan: Store Manager -> Manager, selain itu -> Karyawan.
     */
    private function roleIdForPosition(int $positionId): ?int
    {
        $positions = BackendApiService::fetch('admin/positions');
        $roles = BackendApiService::fetch('admin/roles');
        if (! $positions || ! $roles) {
            return null;
        }

        $posName = collect($positions['data'] ?? $positions)->firstWhere('id', $positionId)['name'] ?? '';
        $wanted = strtolower($posName) === 'store manager' ? 'manager' : 'karyawan';

        return collect($roles['data'] ?? $roles)->first(fn ($r) => strtolower($r['name']) === $wanted)['id'] ?? null;
    }

    private function backendResult(array $res, string $okMessage)
    {
        if ($res['ok']) {
            return redirect()->route('admin.accounts')->with('status', $okMessage);
        }

        return back()->withInput()->with('error', $res['first_error'] ?? $res['message'])
            ->withErrors($res['errors'] ?: ['backend' => $res['message']]);
    }

    /**
     * Tambah akun baru (POST /api/admin/users)
     */
    public function simpanAkun(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'position_id' => ['required', 'integer'],
        ]);

        $roleId = $this->roleIdForPosition((int) $data['position_id']);
        if (! $roleId) {
            return back()->withInput()->with('error', 'Tidak dapat terhubung ke Backend. Akun belum dibuat.');
        }

        $res = BackendApiService::send('POST', 'admin/users', $data + ['role_id' => $roleId, 'is_active' => true]);

        return $this->backendResult($res, "Akun {$data['name']} berhasil dibuat.");
    }

    /**
     * Ubah data akun (PUT /api/admin/users/{id})
     */
    public function ubahAkun(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'position_id' => ['nullable', 'integer'],
        ]);

        $payload = array_filter($data, fn ($v) => $v !== null);
        if (! empty($payload['position_id'])) {
            $payload['role_id'] = $this->roleIdForPosition((int) $payload['position_id']);
        }

        $res = BackendApiService::send('PUT', "admin/users/{$id}", $payload);

        return $this->backendResult($res, "Data {$data['name']} berhasil diperbarui.");
    }

    /**
     * Aktif / nonaktifkan akun (PATCH /api/admin/users/{id}/status)
     */
    public function ubahStatusAkun(Request $request, int $id)
    {
        $active = $request->boolean('is_active');
        $res = BackendApiService::send('PATCH', "admin/users/{$id}/status", ['is_active' => $active]);

        return $this->backendResult($res, $active ? 'Akun berhasil diaktifkan kembali.' : 'Akun berhasil dinonaktifkan.');
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

        // Data nyata dari Backend: indikator aktif per jabatan (GET /api/positions/{id}/kpis)
        if ($live = $this->liveKpiGroups()) {
            [$divisions, $kpiGroups] = $live;
            $activeDivision = $divisions[0];
        }

        return view('admin.kpi', compact('user', 'divisions', 'activeDivision', 'kpiGroups'));
    }

    /**
     * @return array{0: array<int,string>, 1: array<string,array>}|null
     */
    private function liveKpiGroups(): ?array
    {
        $positions = BackendApiService::fetch('admin/positions');
        if (! $positions) {
            return null;
        }

        $freq = ['DAILY' => 'Harian', 'WEEKLY' => 'Mingguan', 'MONTHLY' => 'Bulanan'];
        $fmt = fn ($n) => str_ends_with($s = number_format((float) $n, 2, ',', '.'), ',00') ? substr($s, 0, -3) : $s;

        $divisions = [];
        $kpiGroups = [];
        foreach ($positions['data'] ?? [] as $pos) {
            $label = $this->divisionMeta($pos['name'])[0];
            $items = BackendApiService::fetch("positions/{$pos['id']}/kpis")['data'] ?? null;
            if ($items === null) {
                continue;
            }

            $groups = [];
            foreach ($items as $pk) {
                $ind = $pk['indicator'] ?? [];
                $cat = $ind['category']['name'] ?? 'Lainnya';
                $isYesNo = ($pk['input_type'] ?? '') === 'YES_NO';
                $unit = $ind['unit'] ?? '';

                $groups[$cat] ??= [
                    'id' => \Illuminate\Support\Str::slug($cat),
                    'title' => $cat,
                    'count_text' => null,
                    'expanded' => true,
                    'items' => [],
                ];
                $groups[$cat]['items'][] = [
                    'id' => $pk['id'],
                    'name' => $ind['name'] ?? '-',
                    'subtitle' => ($isYesNo ? 'Target: Ya' : (($pk['calculation_type'] ?? '') === 'LOWER_IS_BETTER' ? 'Maksimal ' : 'Target: ') . $fmt($pk['target']) . ' ' . $unit)
                        . ' · Bobot ' . $fmt($pk['weight']) . '% · ' . ($freq[$pk['frequency']] ?? $pk['frequency']),
                    'badge' => $isYesNo ? 'Ceklis' : 'Angka · ' . $unit,
                    'type' => $isYesNo ? 'checklist' : 'number',
                ];
            }

            foreach ($groups as &$g) {
                $g['count_text'] = count($g['items']) . ' indikator';
            }
            unset($g);

            $divisions[] = $label;
            $kpiGroups[$label] = array_values($groups);
        }

        return $divisions ? [$divisions, $kpiGroups] : null;
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
