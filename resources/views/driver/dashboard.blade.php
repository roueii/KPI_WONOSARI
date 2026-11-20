<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Driver | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Card (Profil Driver & Menu Hamburger) Sesuai Figma -->
        <header class="fl-header">
            <a href="{{ route('driver.profile') }}" class="fl-profile-group" style="text-decoration: none; color: inherit;" aria-label="Lihat Profil Driver">
                <div class="fl-avatar-circle" aria-hidden="true">
                    <x-icon name="user" />
                </div>
                <div class="fl-profile-info">
                    <h1 class="fl-profile-name">Halo, {{ $user['name'] ?? 'User' }}</h1>
                    <span class="fl-profile-role">Driver</span>
                </div>
            </a>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Section: Ringkasan Hari Ini Sesuai Dashboard KPI Driver.png -->
        <section class="fl-summary-card" aria-labelledby="ringkasan-heading">
            <div class="fl-summary-header">
                <div class="fl-title-group">
                    <h2 id="ringkasan-heading">Ringkasan Hari Ini</h2>
                    <p>Indikator Capaian Harian</p>
                </div>
                <span class="fl-date-pill">{{ $todayBadge ?? 'Hari ini, 30 Sep' }}</span>
            </div>

            <!-- Kartu Krem Dalam Berisi Donut Chart & 4 Progress Bars -->
            <div class="driver-chart-inner-card">
                <!-- Sisi Kiri: Donut Chart (dari $metricsSummary) -->
                <div class="driver-chart-left" aria-label="{{ $metricsSummary['completed'] }} dari {{ $metricsSummary['total'] }} indikator tuntas">
                    <svg class="driver-donut-svg" viewBox="0 0 100 100">
                        <circle class="driver-donut-track" cx="50" cy="50" r="40"></circle>
                        <circle class="driver-donut-progress" cx="50" cy="50" r="40" stroke-dasharray="{{ round(251.3 * $metricsSummary['completed'] / max($metricsSummary['total'], 1), 1) }} 251.3" stroke-dashoffset="0" @if($metricsSummary['completed'] == 0) stroke-opacity="0" @endif></circle>
                    </svg>
                    <div class="driver-donut-center">
                        <span class="driver-donut-val">{{ $metricsSummary['completed'] }}/{{ $metricsSummary['total'] }}</span>
                        <span class="driver-donut-sub">{{ $metricsSummary['status_text'] }}</span>
                    </div>
                </div>

                <!-- Sisi Kanan: 4 Progress Rows -->
                <div class="driver-progress-list">
                    @foreach ($metricsSummary['indicators'] as $indicator)
                        <div class="driver-progress-item">
                            <div class="driver-progress-header">
                                <span>{{ $indicator['name'] }}</span>
                                <span class="driver-progress-count">{{ $indicator['completed'] }}/{{ $indicator['total'] }}</span>
                            </div>
                            <div class="driver-progress-bar-bg">
                                <div class="driver-progress-bar-fill" style="width: {{ $indicator['percentage'] }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Footer Legenda Status Donut -->
            <div class="fl-chart-legend-box" style="margin-top: 0;">
                <div class="fl-legend-bullet">
                    <span class="fl-dot green"></span>
                    <span>Hijau: Tercapai</span>
                </div>
                <div class="fl-legend-bullet">
                    <span class="fl-dot amber"></span>
                    <span>Kuning: Belum diisi</span>
                </div>
                <div class="fl-legend-bullet">
                    <span class="fl-dot red"></span>
                    <span>Merah: Tidak tercapai</span>
                </div>
            </div>
        </section>

        <!-- 3. Section: Tugas Harian Sesuai Figma -->
        <section class="fl-section-group" aria-labelledby="tugas-heading">
            <div class="fl-section-header">
                <h2 id="tugas-heading">Tugas Harian</h2>
                <p>Wajib diisi hari ini</p>
            </div>

            <!-- Banner Utama Oranye: Mulai Isi Capaian Hari Ini -->
            <a href="{{ $dailyTask['preview_items'][0]['url'] }}" class="fl-task-banner" style="text-decoration: none;" aria-label="Mulai mengisi capaian driver hari ini">
                <div class="fl-task-banner-content">
                    <span class="fl-task-banner-title">{{ $dailyTask['banner_title'] }}</span>
                    <div class="fl-task-banner-meta">
                        <x-icon name="clock" class="fl-task-clock-icon" aria-hidden="true" />
                        <span>{{ $dailyTask['banner_sub'] }}</span>
                    </div>
                </div>
                <div class="fl-task-arrow-btn" aria-hidden="true">
                    <x-icon name="arrow-right" />
                </div>
            </a>

            <!-- Kotak Status Preview (Tersimpan otomatis) - Grid 2x2 Sesuai Figma -->
            <div class="fl-preview-box">
                <div class="fl-preview-top">
                    <span class="fl-preview-title">Preview Status</span>
                    <span class="fl-preview-autosave">Tersimpan otomatis</span>
                </div>

                <div class="driver-preview-grid">
                    @foreach ($dailyTask['preview_items'] as $item)
                        <a href="{{ $item['url'] }}" class="driver-preview-card">
                            <span class="driver-preview-card-title">{{ $item['title'] }}</span>
                            <span class="fl-badge-pill {{ $item['badge_type'] }}">
                                <span class="fl-dot {{ ['success' => 'green', 'warning' => 'amber'][$item['badge_type']] ?? 'red' }}"></span>
                                <span>{{ $item['status_label'] }}</span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 4. Section: Capaian Terbaru Sesuai Dashboard KPI Driver.png -->
        <section class="fl-section-group" aria-labelledby="terbaru-heading">
            <div class="fl-section-header" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                <h2 id="terbaru-heading">Capaian Terbaru</h2>
                <a href="{{ route('driver.riwayat') }}" style="font-size: var(--fs-12); font-weight: 600; color: var(--primary-500); text-decoration: none;">Lihat Semua &rarr;</a>
            </div>

            <div class="fl-recent-list">
                @foreach ($recentAchievements as $item)
                    <a href="{{ $item['url'] }}" class="fl-recent-card" style="text-decoration: none; color: inherit;">
                        <div class="fl-recent-left">
                            <span class="fl-recent-title" style="font-size: var(--fs-14); font-weight: var(--fw-semibold);">{{ $item['title'] }}</span>
                            <span class="fl-recent-date" style="font-size: var(--fs-12); color: var(--neutral-500);">{{ $item['sub'] }}</span>
                        </div>
                        <span class="fl-status-badge {{ $item['badge_class'] }}">{{ $item['status_label'] }}</span>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- 5. Footer Card Sesuai Figma -->
        <footer class="fl-footer-card">
            <span class="fl-footer-brand">CAPAIAN.ID</span>
            <span class="fl-footer-sub">Portal Manajemen Kinerja Roti Wonosari</span>
            <div class="fl-footer-links">
                <button type="button" class="fl-footer-link" onclick="openHelpModal()">Pusat Bantuan</button>
                <span class="fl-footer-dot">&bull;</span>
                <button type="button" class="fl-footer-link" onclick="openPrivacyModal()">Kebijakan Privasi</button>
                <span class="fl-footer-dot">&bull;</span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('footer-logout').submit();" class="fl-footer-link">Keluar</a>
            </div>
            <form id="footer-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </footer>

        <!-- Side Navigation Drawer Partial Khusus Driver -->
        @include('driver.partials.drawer')
    </div>

    <!-- Script Drawer Menu & Interaktivitas -->
    <script src="{{ asset('js/drawer.js') }}"></script>
    <script>

        function openHelpModal() {
            alert("Pusat Bantuan Driver: Hubungi Store Manager atau Kepala Logistik Toko Roti Wonosari.");
        }

        function openPrivacyModal() {
            alert("Kebijakan Privasi: Data laporan harian disimpan dengan aman untuk keperluan evaluasi kinerja berkala.");
        }
    </script>
</body>

</html>

