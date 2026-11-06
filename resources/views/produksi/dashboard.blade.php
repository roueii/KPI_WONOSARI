<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Produksi | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/produksi.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Card (Profil Produksi & Menu Hamburger) Sesuai Figma -->
        <header class="fl-header">
            <a href="{{ route('produksi.profile') }}" class="fl-profile-group" style="text-decoration: none; color: inherit;" aria-label="Lihat Profil Produksi">
                <div class="fl-avatar-circle" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <div class="fl-profile-info">
                    <h1 class="fl-profile-name">Halo, {{ $user['name'] ?? 'User' }}</h1>
                    <span class="fl-profile-role">Produksi</span>
                </div>
            </a>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Section: Ringkasan Hari Ini Sesuai Dashboard KPI Produksi.png -->
        <section class="fl-summary-card" aria-labelledby="ringkasan-heading">
            <div class="fl-summary-header">
                <div class="fl-title-group">
                    <h2 id="ringkasan-heading">Ringkasan Hari Ini</h2>
                    <p>Indikator Capaian Harian</p>
                </div>
                <span class="fl-date-pill">{{ $todayBadge ?? 'Hari ini, 30 Sep' }}</span>
            </div>

            <!-- Kartu Krem Dalam Berisi Donut Chart & 5 Progress Bars -->
            <div class="produksi-chart-inner-card">
                <!-- Sisi Kiri: Donut Chart 5/16 Tuntas -->
                <div class="produksi-chart-left" aria-label="Grafik pencapaian metrik produksi: 5 dari 16 tuntas">
                    <svg class="produksi-donut-svg" viewBox="0 0 100 100">
                        <circle class="produksi-donut-track" cx="50" cy="50" r="40"></circle>
                        <!-- 5/16 = 31.25% (Circumference 2 * PI * 40 = 251.3) => 78.5 / 251.3 -->
                        <circle class="produksi-donut-progress" cx="50" cy="50" r="40" stroke-dasharray="78.5 251.3" stroke-dashoffset="0"></circle>
                    </svg>
                    <div class="produksi-donut-center">
                        <span class="produksi-donut-val">5/16</span>
                        <span class="produksi-donut-sub">Tuntas</span>
                    </div>
                </div>

                <!-- Sisi Kanan: 5 Progress Rows Sesuai Figma -->
                <div class="produksi-progress-list">
                    <!-- 1. Hasil Produksi 3/3 -->
                    <div class="produksi-progress-item">
                        <div class="produksi-progress-header">
                            <span>Hasil Produksi</span>
                            <span class="produksi-progress-count">3/3</span>
                        </div>
                        <div class="produksi-progress-bar-bg">
                            <div class="produksi-progress-bar-fill" style="width: 100%;"></div>
                        </div>
                    </div>

                    <!-- 2. Waktu & Alat 3/4 -->
                    <div class="produksi-progress-item">
                        <div class="produksi-progress-header">
                            <span>Waktu &amp; Alat</span>
                            <span class="produksi-progress-count">3/4</span>
                        </div>
                        <div class="produksi-progress-bar-bg">
                            <div class="produksi-progress-bar-fill" style="width: 75%;"></div>
                        </div>
                    </div>

                    <!-- 3. Kehadiran & Disiplin 0/3 -->
                    <div class="produksi-progress-item">
                        <div class="produksi-progress-header">
                            <span>Kehadiran &amp; Disiplin</span>
                            <span class="produksi-progress-count">0/3</span>
                        </div>
                        <div class="produksi-progress-bar-bg">
                            <div class="produksi-progress-bar-fill" style="width: 0%;"></div>
                        </div>
                    </div>

                    <!-- 4. Kepatuhan SOP 3/4 -->
                    <div class="produksi-progress-item">
                        <div class="produksi-progress-header">
                            <span>Kepatuhan SOP</span>
                            <span class="produksi-progress-count">3/4</span>
                        </div>
                        <div class="produksi-progress-bar-bg">
                            <div class="produksi-progress-bar-fill" style="width: 75%;"></div>
                        </div>
                    </div>

                    <!-- 5. Kebersihan Area Kerja 6/6 -->
                    <div class="produksi-progress-item">
                        <div class="produksi-progress-header">
                            <span>Kebersihan Area Kerja</span>
                            <span class="produksi-progress-count">6/6</span>
                        </div>
                        <div class="produksi-progress-bar-bg">
                            <div class="produksi-progress-bar-fill" style="width: 100%;"></div>
                        </div>
                    </div>
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
            <a href="{{ route('produksi.hasil_produksi') }}" class="fl-task-banner" style="text-decoration: none;" aria-label="Mulai mengisi capaian produksi hari ini">
                <div class="fl-task-banner-content">
                    <span class="fl-task-banner-title">Mulai Isi Capaian Hari Ini</span>
                    <div class="fl-task-banner-meta">
                        <svg class="fl-task-clock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span>3 kategori &middot; 5–10 menit</span>
                    </div>
                </div>
                <div class="fl-task-arrow-btn" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </div>
            </a>

            <!-- Kotak Status Preview (Tersimpan otomatis) - 5 Kartu Sesuai Figma -->
            <div class="fl-preview-box">
                <div class="fl-preview-top">
                    <span class="fl-preview-title">Preview Status</span>
                    <span class="fl-preview-autosave">Tersimpan otomatis</span>
                </div>

                <div class="produksi-preview-grid">
                    <!-- Kartu 1: Hasil Produksi -->
                    <a href="{{ route('produksi.hasil_produksi') }}" class="produksi-preview-card">
                        <span class="produksi-preview-card-title">Hasil Produksi</span>
                        <span class="fl-badge-pill success">
                            <span class="fl-dot green"></span>
                            <span>Tercapai</span>
                        </span>
                    </a>

                    <!-- Kartu 2: Waktu & Alat -->
                    <a href="{{ route('produksi.waktu_alat') }}" class="produksi-preview-card">
                        <span class="produksi-preview-card-title">Waktu &amp; Alat</span>
                        <span class="fl-badge-pill success">
                            <span class="fl-dot green"></span>
                            <span>Tercapai</span>
                        </span>
                    </a>

                    <!-- Kartu 3: Kehadiran & Disiplin -->
                    <a href="{{ route('produksi.kehadiran_disiplin') }}" class="produksi-preview-card">
                        <span class="produksi-preview-card-title">Kehadiran &amp; Disiplin</span>
                        <span class="fl-badge-pill success">
                            <span class="fl-dot green"></span>
                            <span>Tercapai</span>
                        </span>
                    </a>

                    <!-- Kartu 4: Kepatuhan SOP -->
                    <a href="{{ route('produksi.kepatuhan_sop') }}" class="produksi-preview-card">
                        <span class="produksi-preview-card-title">Kepatuhan SOP</span>
                        <span class="fl-badge-pill success">
                            <span class="fl-dot green"></span>
                            <span>Tercapai</span>
                        </span>
                    </a>

                    <!-- Kartu 5: Kebersihan Area Kerja -->
                    <a href="{{ route('produksi.kebersihan_area') }}" class="produksi-preview-card">
                        <span class="produksi-preview-card-title">Kebersihan Area Kerja</span>
                        <span class="fl-badge-pill warning">
                            <span class="fl-dot amber"></span>
                            <span>Belum diisi</span>
                        </span>
                    </a>
                </div>
            </div>
        </section>

        <!-- 4. Section: Capaian Terbaru Sesuai Dashboard KPI Produksi.png -->
        <section class="fl-section-group" aria-labelledby="terbaru-heading">
            <div class="fl-section-header" style="display: flex; align-items: center; justify-content: space-between;">
                <h2 id="terbaru-heading">Capaian Terbaru</h2>
                <a href="{{ route('produksi.riwayat') }}" style="font-size: 0.78rem; font-weight: 600; color: #f97316; text-decoration: none;">Lihat Semua &rarr;</a>
            </div>

            <div class="fl-recent-list">
                <!-- Item 1: 24 Oktober 2024 (Menunggu) -->
                <a href="{{ route('produksi.riwayat.detail', ['id' => 1]) }}" class="fl-recent-card" style="text-decoration: none; color: inherit;">
                    <div class="fl-recent-left">
                        <span class="fl-recent-title" style="font-size: 0.92rem; font-weight: 700;">Riwayat 24 Oktober 2024</span>
                        <span class="fl-recent-date" style="font-size: 0.78rem; color: #78716c;">4/16 kategori terisi</span>
                    </div>
                    <span class="fl-status-badge badge-amber">Menunggu</span>
                </a>

                <!-- Item 2: 23 Oktober 2024 (Disetujui) -->
                <a href="{{ route('produksi.riwayat.detail', ['id' => 2]) }}" class="fl-recent-card" style="text-decoration: none; color: inherit;">
                    <div class="fl-recent-left">
                        <span class="fl-recent-title" style="font-size: 0.92rem; font-weight: 700;">Riwayat 23 Oktober 2024</span>
                        <span class="fl-recent-date" style="font-size: 0.78rem; color: #78716c;">10/16 kategori terisi</span>
                    </div>
                    <span class="fl-status-badge badge-green">Disetujui</span>
                </a>

                <!-- Item 3: 22 Oktober 2024 (Disetujui) -->
                <a href="{{ route('produksi.riwayat.detail', ['id' => 3]) }}" class="fl-recent-card" style="text-decoration: none; color: inherit;">
                    <div class="fl-recent-left">
                        <span class="fl-recent-title" style="font-size: 0.92rem; font-weight: 700;">Riwayat 22 Oktober 2024</span>
                        <span class="fl-recent-date" style="font-size: 0.78rem; color: #78716c;">14/16 kategori terisi</span>
                    </div>
                    <span class="fl-status-badge badge-green">Disetujui</span>
                </a>
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

        <!-- Side Navigation Drawer Partial Khusus Produksi -->
        @include('produksi.partials.drawer')
    </div>

    <!-- Script Drawer Menu & Interaktivitas -->
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

        function openHelpModal() {
            alert("Pusat Bantuan Produksi: Hubungi Store Manager atau Kepala Produksi Toko Roti Wonosari.");
        }

        function openPrivacyModal() {
            alert("Kebijakan Privasi: Data laporan harian disimpan dengan aman untuk evaluasi standar dapur produksi.");
        }
    </script>
</body>

</html>

