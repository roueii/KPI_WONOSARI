<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Frontliner | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontliner.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Card (Profil & Menu) Sesuai Figma Revisi -->
        <header class="fl-header">
            <a href="{{ route('frontliner.profile') }}" class="fl-profile-group" style="text-decoration: none; color: inherit;" aria-label="Lihat Profil Pengguna">
                <div class="fl-avatar-circle" style="background: var(--neutral-900); color: var(--white);" aria-hidden="true">
                    <x-icon name="user" />
                </div>
                <div class="fl-profile-info">
                    <h1 class="fl-profile-name">Halo, {{ $user['name'] ?? 'User' }}</h1>
                    <span class="fl-profile-role">Frontliner</span>
                </div>
            </a>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Section Card: Ringkasan Hari Ini Sesuai Figma Revisi -->
        <section class="fl-summary-card" aria-labelledby="ringkasan-heading">
            <div class="fl-summary-header">
                <div class="fl-title-group">
                    <h2 id="ringkasan-heading" style="font-size: var(--fs-18); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Ringkasan Hari Ini</h2>
                    <p style="font-size: var(--fs-12); color: var(--neutral-500); margin: 2px 0 0;">Indikator Capaian Harian</p>
                </div>
                <span class="fl-date-pill" style="border: 1px solid var(--secondary-100); background: var(--neutral-50); color: var(--neutral-500); font-size: var(--fs-12); font-weight: 600; padding: 4px 10px; border-radius: 999px;">{{ $todayBadge ?? 'Hari ini, 30 Sep' }}</span>
            </div>

            <!-- Kartu Dalam: Donut Chart 5/22 Tuntas & 6 Progress Bars Sesuai Figma -->
            <div class="fl-revised-donut-card" style="margin-top: 14px;">
                <!-- Kiri: Donut Gauge -->
                <div class="fl-revised-chart-left">
                    <svg class="fl-revised-donut-svg" viewBox="0 0 100 100">
                        <!-- Background Circle Track -->
                        <circle class="fl-revised-donut-track" cx="50" cy="50" r="40"></circle>
                        <!-- Progress Arc: 5/22 = ~22.7% (Circumference 2*pi*40 = 251.32. Offset = 251.32 - (251.32 * 0.227) = 194.2) -->
                        <circle class="fl-revised-donut-progress" cx="50" cy="50" r="40"
                            stroke-dasharray="251.32"
                            stroke-dashoffset="{{ 251.32 - (251.32 * ($metricsSummary['completed'] / $metricsSummary['total'])) }}"></circle>
                    </svg>
                    <div class="fl-revised-donut-center">
                        <span class="fl-revised-donut-val">{{ $metricsSummary['label'] ?? '5/22' }}</span>
                        <span class="fl-revised-donut-sub">{{ $metricsSummary['status_text'] ?? 'Tuntas' }}</span>
                    </div>
                </div>

                <!-- Kanan: 6 Progress Rows Sesuai Figma Revisi -->
                <div class="fl-revised-progress-list">
                    @foreach($progressRows as $row)
                    <div class="fl-revised-progress-item">
                        <div class="fl-revised-progress-header">
                            <strong>{{ $row['title'] }}</strong>
                            <span>{{ $row['current'] }}/{{ $row['target'] }}</span>
                        </div>
                        <div class="fl-revised-bar-track">
                            <div class="fl-revised-bar-fill" style="width: {{ $row['percent'] }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Baris Indikator Legend Bawah Sesuai Figma Revisi -->
            <div class="fl-legend-bar-revised">
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

        <!-- 3. Section: Tugas Harian Sesuai Figma Revisi -->
        <section style="margin-top: 24px;" aria-labelledby="heading-tugas-harian">
            <div style="margin-bottom: 12px;">
                <h2 id="heading-tugas-harian" style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Tugas Harian</h2>
                <p style="font-size: var(--fs-12); color: var(--neutral-500); margin: 2px 0 0;">Wajib diisi hari ini</p>
            </div>

            <!-- Banner Utama Solid Orange CTA Sesuai Figma Revisi -->
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

            <!-- Card: Preview Status (Tersimpan Otomatis) Sesuai Figma Revisi (Grid 2 Kolom x 3 Baris) -->
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

        <!-- 4. Section: Capaian Terbaru Sesuai Figma Revisi -->
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

        <!-- 5. Footer Branding Sesuai Figma Revisi -->
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

        <!-- Side Navigation Drawer Partial Khusus Frontliner -->
        @include('staff.partials.drawer')
    </div>

    <!-- Script Drawer Menu Navigasi -->
    <script src="{{ asset('js/drawer.js') }}"></script>
</body>

</html>
