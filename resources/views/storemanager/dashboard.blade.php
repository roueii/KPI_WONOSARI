<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Store Manager | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Card (Profil & Menu) Sesuai Figma -->
        <header class="fl-header">
            <a href="{{ route('storemanager.profile') }}" class="fl-profile-group" style="text-decoration: none; color: inherit;" aria-label="Lihat Profil Pengguna">
                <div class="fl-avatar-circle" style="background: #1c1917; color: #ffffff;" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
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
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="sm-team-pending-title">{{ $teamSummary['pending_count'] ?? 3 }} Karyawan Menunggu Persetujuan</h3>
                    <p class="sm-team-pending-sub">Ketuk untuk review bukti capaian hari ini</p>
                </div>
            </div>
            <div class="sm-team-arrow-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
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
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #f97316;"></span>
                    <span><strong>{{ $teamSummary['pending_count'] ?? 3 }}</strong> Menunggu</span>
                </div>
                <div class="sm-team-count-item">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span>
                    <span><strong>{{ $teamSummary['approved_count'] ?? 2 }}</strong> Disetujui</span>
                </div>
                <div class="sm-team-count-item">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #8c7b6d;"></span>
                    <span><strong>{{ $teamSummary['not_reported_count'] ?? 3 }}</strong> Belum Lapor</span>
                </div>
            </div>
        </section>

        <!-- Daftar Karyawan Sesuai Figma -->
        <section style="margin-bottom: 24px;" aria-labelledby="heading-daftar-karyawan">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <h3 id="heading-daftar-karyawan" style="font-size: 1.15rem; font-weight: 800; color: #1c1917; margin: 0;">Daftar Karyawan</h3>
                    <span style="border: 1px solid #ebdcd0; background: #fffdfa; color: #78716c; font-size: 0.72rem; font-weight: 700; padding: 2px 8px; border-radius: 999px;">{{ count($teamMembers) }} Anggota</span>
                </div>
                <span style="font-size: 0.78rem; font-weight: 600; color: #78716c; cursor: pointer;">Urutkan ⇅</span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                @if(count($teamMembers) === 0)
                <p style="text-align: center; color: #78716c; font-size: 0.82rem; padding: 12px 0; margin: 0;">Belum ada laporan karyawan yang menunggu persetujuan.</p>
                @endif
                @foreach($teamMembers as $member)
                <a href="{{ $member['link'] ?? '#' }}" class="sm-team-member-card">
                    <div class="sm-team-member-left">
                        <div class="sm-team-avatar">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            </svg>
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
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#78716c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
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
                    <h2 id="ringkasan-heading" style="font-size: 1.15rem; font-weight: 800; color: #1c1917; margin: 0;">Ringkasan Hari Ini</h2>
                    <p style="font-size: 0.8rem; color: #78716c; margin: 2px 0 0;">Indikator Capaian Harian</p>
                </div>
                <span class="fl-date-pill" style="border: 1px solid #ebdcd0; background: #fffdfa; color: #78716c; font-size: 0.75rem; font-weight: 600; padding: 4px 10px; border-radius: 999px;">{{ $todayBadge ?? 'Hari ini, 30 Sep' }}</span>
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
                    <span class="fl-dot green" style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span>
                    <span>Hijau: Tercapai</span>
                </div>
                <div class="fl-legend-note-item">
                    <span class="fl-dot amber" style="width: 8px; height: 8px; border-radius: 50%; background: #f59e0b;"></span>
                    <span>Kuning: Belum diisi</span>
                </div>
                <div class="fl-legend-note-item">
                    <span class="fl-dot red" style="width: 8px; height: 8px; border-radius: 50%; background: #ef4444;"></span>
                    <span>Merah: Tidak tercapai</span>
                </div>
            </div>
        </section>

        <!-- Section: Tugas Harian Sesuai Figma -->
        <section style="margin-top: 24px;" aria-labelledby="heading-tugas-harian">
            <div style="margin-bottom: 12px;">
                <h2 id="heading-tugas-harian" style="font-size: 1.25rem; font-weight: 800; color: #1c1917; margin: 0;">Tugas Harian</h2>
                <p style="font-size: 0.8rem; color: #78716c; margin: 2px 0 0;">Wajib diisi hari ini</p>
            </div>

            <!-- Banner Utama Solid Orange CTA Sesuai Figma -->
            <a href="{{ $dailyTask['start_route'] }}" class="fl-task-banner" style="background: #f97316; border-radius: 18px; padding: 18px 20px; display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: #ffffff; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.28); margin-bottom: 16px;">
                <div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #ffffff; margin: 0;">{{ $dailyTask['banner_title'] }}</h3>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: rgba(255, 255, 255, 0.9); margin-top: 4px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span>{{ $dailyTask['banner_sub'] }}</span>
                    </div>
                </div>
                <div style="width: 38px; height: 38px; border-radius: 50%; background: #ffffff; color: #f97316; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
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
                    <a href="{{ $item['route'] }}" class="fl-preview-card" style="background: #fff8f3; border: 1px solid #ebdcd0;">
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
            <h2 id="heading-capaian-terbaru" style="font-size: 1.25rem; font-weight: 800; color: #1c1917; margin: 0 0 12px;">Capaian Terbaru</h2>

            <div style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 18px; padding: 14px; display: flex; flex-direction: column; gap: 10px;">
                @foreach($recentAchievements as $history)
                <a href="{{ $history['route'] }}" style="background: #fff8f3; border: 1px solid #ebdcd0; border-radius: 14px; padding: 14px 16px; display: flex; align-items: center; justify-content: space-between; text-decoration: none; color: inherit; transition: all 0.2s ease;">
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 800; color: #1c1917; margin: 0;">{{ $history['title'] }}</h4>
                        <span style="font-size: 0.78rem; color: #78716c; margin-top: 3px; display: block;">{{ $history['sub'] }}</span>
                    </div>
                    <span class="status-pill {{ $history['badge_class'] }}" style="padding: 4px 12px; border-radius: 999px; font-size: 0.72rem; font-weight: 700; color: #ffffff;">
                        {{ $history['status_label'] }}
                    </span>
                </a>
                @endforeach
            </div>
        </section>

        @endif

        <!-- Footer Branding Sesuai Figma -->
        <footer style="text-align: center; margin-top: 32px; margin-bottom: 30px; background: #fffdfa; border: 1px solid #ebdcd0; border-radius: 18px; padding: 20px;">
            <strong style="font-size: 0.88rem; font-weight: 800; color: #1c1917; letter-spacing: 0.04em; text-transform: uppercase; display: block;">CAPAIAN.ID</strong>
            <span style="font-size: 0.78rem; font-weight: 500; color: #78716c; margin-top: 3px; display: block;">Portal Manajemen Kinerja Roti Wonosari</span>

            <div style="display: flex; align-items: center; justify-content: center; gap: 12px; font-size: 0.75rem; color: #78716c; margin-top: 14px;">
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
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const drawerOverlay = document.getElementById('drawerOverlay');
        const drawerCloseBtn = document.getElementById('drawerCloseBtn');
        const drawerBackdrop = document.getElementById('drawerBackdrop');

        function openDrawer() {
            if (drawerOverlay) {
                drawerOverlay.classList.add('is-open');
                drawerOverlay.setAttribute('aria-hidden', 'false');
                menuToggle?.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeDrawer() {
            if (drawerOverlay) {
                drawerOverlay.classList.remove('is-open');
                drawerOverlay.setAttribute('aria-hidden', 'true');
                menuToggle?.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        }

        menuToggle?.addEventListener('click', openDrawer);
        drawerCloseBtn?.addEventListener('click', closeDrawer);
        drawerBackdrop?.addEventListener('click', closeDrawer);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && drawerOverlay?.classList.contains('is-open')) {
                closeDrawer();
            }
        });
    </script>
</body>

</html>
