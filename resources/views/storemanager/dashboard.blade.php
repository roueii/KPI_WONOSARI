<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Store Manager | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Card (Profil & Menu) Sesuai Figma -->
        <header class="fl-header">
            <a href="{{ route('storemanager.profile') }}" class="fl-profile-group" style="text-decoration: none; color: inherit;" aria-label="Lihat Profil Pengguna">
                <div class="fl-avatar-circle" style="background: var(--neutral-900); color: var(--white);" aria-hidden="true">
                    <x-icon name="user" />
                </div>
                <div class="fl-profile-info">
                    <h1 class="fl-profile-name">Halo, {{ $user['name'] ?? 'User' }}</h1>
                    <span class="fl-profile-role">Store Manager</span>
                </div>
            </a>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Segmented Tab Bar Sesuai Figma (KPI Saya vs KPI Tim 3) -->
        <div class="sm-tab-container">
            <a href="{{ route('storemanager.dashboard', ['tab' => 'saya']) }}" class="sm-tab-btn {{ $activeTab === 'saya' ? 'is-active' : '' }}">
                <span>KPI Saya</span>
            </a>
            <a href="{{ route('storemanager.dashboard', ['tab' => 'tim']) }}" class="sm-tab-btn {{ $activeTab === 'tim' ? 'is-active' : '' }}">
                <span>KPI Tim</span>
                @if(($teamSummary['pending_count'] ?? 0) > 0)<span class="sm-tab-badge">{{ $teamSummary['pending_count'] }}</span>@endif
            </a>
        </div>

        @if($activeTab === 'tim')
        <!-- ===================================================================
             TAB KONTEN: KPI TIM (Dashboard KPI Tim.png)
             =================================================================== -->

        <!-- Banner Menunggu Persetujuan Tim -->
        <a href="{{ route('storemanager.approval') }}" class="sm-team-pending-banner">
            <div class="sm-team-pending-left">
                <div class="sm-team-pending-icon">
                    <x-icon name="group" width="22" height="22" />
                </div>
                <div>
                    <h3 class="sm-team-pending-title">{{ $teamSummary['pending_count'] ?? 3 }} Karyawan Menunggu Persetujuan</h3>
                    <p class="sm-team-pending-sub">Ketuk untuk review bukti capaian hari ini</p>
                </div>
            </div>
            <div class="sm-team-arrow-btn">
                <x-icon name="arrow-right" width="18" height="18" />
            </div>
        </a>

        <!-- Ringkasan Tim Hari Ini -->
        <section class="sm-team-summary-box" aria-labelledby="heading-ringkasan-tim">
            <div class="sm-team-summary-top">
                <h2 class="sm-team-summary-title" id="heading-ringkasan-tim">Ringkasan Tim Hari Ini</h2>
                <span class="sm-team-summary-shift">{{ $teamSummary['shift_label'] ?? 'Shift Pagi & Siang' }}</span>
            </div>

            <div class="sm-team-summary-mid">
                <span>{{ $teamSummary['reported_text'] ?? '5 dari 8 karyawan sudah lapor' }}</span>
                <strong>{{ $teamSummary['percentage'] ?? '62.5%' }}</strong>
            </div>

            <div class="sm-team-bar-track">
                <div class="sm-team-bar-fill" style="width: {{ $teamSummary['percent_val'] ?? 62.5 }}%;"></div>
            </div>

            <div class="sm-team-counts-row">
                <div class="sm-team-count-item">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--primary-500);"></span>
                    <span><strong>{{ $teamSummary['pending_count'] ?? 3 }}</strong> Menunggu</span>
                </div>
                <div class="sm-team-count-item">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--success-500);"></span>
                    <span><strong>{{ $teamSummary['approved_count'] ?? 2 }}</strong> Disetujui</span>
                </div>
                <div class="sm-team-count-item">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--neutral-500);"></span>
                    <span><strong>{{ $teamSummary['not_reported_count'] ?? 3 }}</strong> Belum Lapor</span>
                </div>
            </div>
        </section>

        <!-- Daftar Karyawan Sesuai Figma -->
        <section style="margin-bottom: 24px;" aria-labelledby="heading-daftar-karyawan">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <h3 id="heading-daftar-karyawan" style="font-size: var(--fs-18); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Daftar Karyawan</h3>
                    <span style="border: 1px solid var(--secondary-100); background: var(--neutral-50); color: var(--neutral-500); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 2px 8px; border-radius: 999px;">{{ count($teamMembers) }} Anggota</span>
                </div>
                <span style="font-size: var(--fs-12); font-weight: 600; color: var(--neutral-500); cursor: pointer;">Urutkan ⇅</span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                @if(count($teamMembers) === 0)
                <p style="text-align: center; color: var(--neutral-500); font-size: var(--fs-14); padding: 12px 0; margin: 0;">Belum ada laporan karyawan yang menunggu persetujuan.</p>
                @endif
                @foreach($teamMembers as $member)
                <a href="{{ $member['link'] ?? '#' }}" class="sm-team-member-card">
                    <div class="sm-team-member-left">
                        <div class="sm-team-avatar">
                            <x-icon name="user" width="22" height="22" />
                        </div>
                        <div>
                            <h4 class="sm-team-member-name">{{ $member['name'] }}</h4>
                            <p class="sm-team-member-role">{{ $member['role'] }}</p>
                        </div>
                    </div>

                    <div class="sm-team-member-right">
                        @if($member['status'] === 'approval')
                        <span class="sm-badge-approval">{{ $member['status_label'] }}</span>
                        @elseif($member['status'] === 'disetujui')
                        <span class="sm-badge-disetujui">{{ $member['status_label'] }}</span>
                        @else
                        <span class="sm-badge-belum">{{ $member['status_label'] }}</span>
                        @endif
                        <x-icon name="nav-arrow-right" width="16" height="16" style="color: var(--neutral-500);" />
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        @else
        <!-- ===================================================================
             TAB KONTEN: KPI SAYA (Dashboard KPI Store Manager.png)
             =================================================================== -->

        <!-- Section: Ringkasan Hari Ini Sesuai Figma -->
        <section class="fl-summary-card" aria-labelledby="ringkasan-heading">
            <div class="fl-summary-header">
                <div class="fl-title-group">
                    <h2 id="ringkasan-heading" style="font-size: var(--fs-18); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Ringkasan Hari Ini</h2>
                    <p style="font-size: var(--fs-12); color: var(--neutral-500); margin: 2px 0 0;">Indikator Capaian Harian</p>
                </div>
                <span class="fl-date-pill" style="border: 1px solid var(--secondary-100); background: var(--neutral-50); color: var(--neutral-500); font-size: var(--fs-12); font-weight: 600; padding: 4px 10px; border-radius: 999px;">{{ $todayBadge ?? 'Hari ini, 30 Sep' }}</span>
            </div>

            <!-- Kartu Dalam: Donut Gauge 5/16 Tuntas & 5 Progress Bars -->
            <div class="sm-donut-inner-card" style="margin-top: 14px;">
                <!-- Kiri: Donut Gauge -->
                <div class="sm-chart-left">
                    <svg class="sm-donut-svg" viewBox="0 0 100 100">
                        <circle class="sm-donut-track" cx="50" cy="50" r="40"></circle>
                        <!-- 5/16 = 31.25% (Circumference 251.32. Offset = 251.32 - (251.32 * 0.3125) = 172.8) -->
                        <circle class="sm-donut-progress" cx="50" cy="50" r="40"
                            stroke-dasharray="251.32"
                            stroke-dashoffset="{{ 251.32 - (251.32 * ($metricsSummary['completed'] / $metricsSummary['total'])) }}"></circle>
                    </svg>
                    <div class="sm-donut-center">
                        <span class="sm-donut-val">{{ $metricsSummary['label'] ?? '5/16' }}</span>
                        <span class="sm-donut-sub">{{ $metricsSummary['status_text'] ?? 'Tuntas' }}</span>
                    </div>
                </div>

                <!-- Kanan: 5 Progress Rows Sesuai Figma -->
                <div class="sm-progress-list">
                    @foreach($progressRows as $row)
                    <div class="sm-progress-item">
                        <div class="sm-progress-header">
                            <strong>{{ $row['title'] }}</strong>
                            <span>{{ $row['current'] }}/{{ $row['target'] }}</span>
                        </div>
                        <div class="sm-bar-track">
                            <div class="sm-bar-fill" style="width: {{ $row['percent'] }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Baris Indikator Legend Bawah -->
            <div class="fl-legend-bar-revised" style="margin-top: 12px;">
                <div class="fl-legend-note-item">
                    <span class="fl-dot green" style="width: 8px; height: 8px; border-radius: 50%; background: var(--success-500);"></span>
                    <span>Hijau: Tercapai</span>
                </div>
                <div class="fl-legend-note-item">
                    <span class="fl-dot amber" style="width: 8px; height: 8px; border-radius: 50%; background: var(--warning-500);"></span>
                    <span>Kuning: Belum diisi</span>
                </div>
                <div class="fl-legend-note-item">
                    <span class="fl-dot red" style="width: 8px; height: 8px; border-radius: 50%; background: var(--error-500);"></span>
                    <span>Merah: Tidak tercapai</span>
                </div>
            </div>
        </section>

        <!-- Section: Tugas Harian Sesuai Figma -->
        <section style="margin-top: 24px;" aria-labelledby="heading-tugas-harian">
            <div style="margin-bottom: 12px;">
                <h2 id="heading-tugas-harian" style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Tugas Harian</h2>
                <p style="font-size: var(--fs-12); color: var(--neutral-500); margin: 2px 0 0;">Wajib diisi hari ini</p>
            </div>

            <!-- Banner Utama Solid Orange CTA Sesuai Figma -->
            <a href="{{ $dailyTask['start_route'] }}" class="fl-task-banner" style="background: var(--primary-500); border-radius: 18px; padding: 18px 20px; display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: var(--white); box-shadow: 0 4px 14px rgba(249, 115, 22, 0.28); margin-bottom: 16px;">
                <div>
                    <h3 style="font-size: var(--fs-18); font-weight: var(--fw-semibold); color: var(--white); margin: 0;">{{ $dailyTask['banner_title'] }}</h3>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: var(--fs-14); color: rgba(255, 255, 255, 0.9); margin-top: 4px;">
                        <x-icon name="clock" width="15" height="15" />
                        <span>{{ $dailyTask['banner_sub'] }}</span>
                    </div>
                </div>
                <div style="width: 38px; height: 38px; border-radius: 50%; background: var(--white); color: var(--primary-500); display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                    <x-icon name="arrow-right" width="20" height="20" />
                </div>
            </a>

            <!-- Card: Preview Status (5 Kartu Sesuai Figma) -->
            <div class="fl-preview-box">
                <div class="fl-preview-top">
                    <span class="fl-preview-title">Preview Status</span>
                    <span class="fl-preview-autosave">Tersimpan otomatis</span>
                </div>

                <div class="fl-preview-grid">
                    @foreach($dailyTask['preview_items'] as $item)
                    <a href="{{ $item['route'] }}" class="fl-preview-card" style="background: var(--secondary-50); border: 1px solid var(--secondary-100);">
                        <span class="fl-item-title">{{ $item['title'] }}</span>
                        <div class="fl-badge-pill {{ $item['badge_type'] }}">
                            <span class="fl-dot {{ $item['badge_type'] == 'success' ? 'green' : ($item['badge_type'] == 'warning' ? 'amber' : 'red') }}"></span>
                            <span>{{ $item['status_label'] }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Section: Capaian Terbaru Sesuai Figma -->
        <section style="margin-top: 24px;" aria-labelledby="heading-capaian-terbaru">
            <h2 id="heading-capaian-terbaru" style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0 0 12px;">Capaian Terbaru</h2>

            <div style="background: var(--white); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 14px; display: flex; flex-direction: column; gap: 10px;">
                @foreach($recentAchievements as $history)
                <a href="{{ $history['route'] }}" style="background: var(--secondary-50); border: 1px solid var(--secondary-100); border-radius: 14px; padding: 14px 16px; display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: inherit; transition: all 0.2s ease;">
                    <div>
                        <h4 style="font-size: var(--fs-16); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">{{ $history['title'] }}</h4>
                        <span style="font-size: var(--fs-12); color: var(--neutral-500); margin-top: 3px; display: block;">{{ $history['sub'] }}</span>
                    </div>
                    <span class="status-pill {{ $history['badge_class'] }}" style="padding: 4px 12px; border-radius: 999px; font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--white);">
                        {{ $history['status_label'] }}
                    </span>
                </a>
                @endforeach
            </div>
        </section>

        @endif

        <!-- Footer Branding Sesuai Figma -->
        <footer style="text-align: center; margin-top: 32px; margin-bottom: 30px; background: var(--neutral-50); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 20px;">
            <strong style="font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900); letter-spacing: 0.04em; text-transform: uppercase; display: block;">CAPAIAN.ID</strong>
            <span style="font-size: var(--fs-12); font-weight: 500; color: var(--neutral-500); margin-top: 3px; display: block;">Portal Manajemen Kinerja Roti Wonosari</span>

            <div style="display: flex; align-items: center; justify-content: center; gap: 12px; font-size: var(--fs-12); color: var(--neutral-500); margin-top: 14px;">
                <a href="#" style="color: inherit; text-decoration: none;">Pusat Bantuan</a>
                <span>&bull;</span>
                <a href="#" style="color: inherit; text-decoration: none;">Kebijakan Privasi</a>
                <span>&bull;</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; padding: 0; color: inherit; font-size: inherit; font-family: inherit; cursor: pointer;">Keluar</button>
                </form>
            </div>
        </footer>

        <!-- Side Navigation Drawer Partial Khusus Store Manager -->
        @include('storemanager.partials.drawer')
    </div>

    <!-- Script Drawer Menu Navigasi -->
    <script src="{{ asset('js/drawer.js') }}"></script>
</body>

</html>
