<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Card (Profil & Menu) -->
        <header class="header-card">
            <div class="profile-group">
                <div class="avatar-circle" aria-hidden="true">
                    <x-icon name="user" />
                </div>
                <div class="profile-info">
                    <h1 class="profile-name">Halo, {{ $user['name'] ?? 'Admin' }}</h1>
                    <span class="profile-role">Admin</span>
                </div>
            </div>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Section Card: Perlu Perhatian -->
        <section class="card-section" aria-labelledby="perhatian-heading">
            <div class="section-header">
                <div class="title-group">
                    <h2 id="perhatian-heading">Perlu Perhatian</h2>
                    <p>Ringkasan tindakan hari ini</p>
                </div>
                <span class="badge-pill">Prioritas</span>
            </div>

            <div class="attention-list">
                <!-- Item 1: Menunggu Approval Final -->
                <a href="{{ route('admin.approve') }}" class="attention-item">
                    <div class="attention-left">
                        <div class="icon-box" aria-hidden="true">
                            <x-icon name="verified-user" />
                        </div>
                        <div class="attention-text">
                            <span class="attention-title">Menunggu Approval Final</span>
                            <span class="attention-subtitle">Sudah disetujui Store Manager</span>
                        </div>
                    </div>
                    <div class="attention-right">
                        <span class="count-number">6</span>
                        <span class="chevron-arrow" aria-hidden="true">&#8250;</span>
                    </div>
                </a>

                <!-- Item 2: Perlu Revisi -->
                <a href="{{ route('admin.revisi') }}" class="attention-item">
                    <div class="attention-left">
                        <div class="icon-box" aria-hidden="true">
                            <x-icon name="page" />
                        </div>
                        <div class="attention-text">
                            <span class="attention-title">Perlu Revisi</span>
                            <span class="attention-subtitle">Belum ditindaklanjuti &gt; 2 hari</span>
                        </div>
                    </div>
                    <div class="attention-right">
                        <span class="count-number">3</span>
                        <span class="chevron-arrow" aria-hidden="true">&#8250;</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- 3. Section Card: Ringkasan Divisi -->
        <section class="card-section" aria-labelledby="divisi-heading">
            <div class="section-header">
                <div class="title-group">
                    <h2 id="divisi-heading">Ringkasan Divisi</h2>
                    <p>6 divisi &middot; 23 karyawan</p>
                </div>
                <span class="badge-pill">Agregat 81%</span>
            </div>

            <div class="division-list">
                <!-- Store Manager -->
                <div class="division-item">
                    <div class="division-info-row">
                        <span class="division-label">Store Manager (2 staf)</span>
                        <span class="division-percentage">100%</span>
                    </div>
                    <div class="progress-track" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-fill" style="width: 100%;"></div>
                    </div>
                </div>

                <!-- Frontliner -->
                <div class="division-item">
                    <div class="division-info-row">
                        <span class="division-label">Frontliner (6 staf)</span>
                        <span class="division-percentage">88%</span>
                    </div>
                    <div class="progress-track" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-fill" style="width: 88%;"></div>
                    </div>
                </div>

                <!-- Produksi -->
                <div class="division-item">
                    <div class="division-info-row">
                        <span class="division-label">Produksi (8 staf)</span>
                        <span class="division-percentage">75%</span>
                    </div>
                    <div class="progress-track" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-fill" style="width: 75%;"></div>
                    </div>
                </div>

                <!-- Driver -->
                <div class="division-item">
                    <div class="division-info-row">
                        <span class="division-label">Driver (3 staf)</span>
                        <span class="division-percentage">84%</span>
                    </div>
                    <div class="progress-track" role="progressbar" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-fill" style="width: 84%;"></div>
                    </div>
                </div>

                <!-- Sales & Marketing -->
                <div class="division-item">
                    <div class="division-info-row">
                        <span class="division-label">Sales &amp; Marketing (2 staf)</span>
                        <span class="division-percentage">68%</span>
                    </div>
                    <div class="progress-track" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-fill" style="width: 68%;"></div>
                    </div>
                </div>

                <!-- SPV -->
                <div class="division-item">
                    <div class="division-info-row">
                        <span class="division-label">SPV (2 staf)</span>
                        <span class="division-percentage">80%</span>
                    </div>
                    <div class="progress-track" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-fill" style="width: 80%;"></div>
                    </div>
                </div>
            </div>

            <!-- Legend Info -->
            <div class="division-legend">
                <div class="legend-item">
                    <span class="legend-dot tercapai"></span>
                    <span>Tercapai</span>
                </div>
                <div class="legend-item">
                    <span class="legend-dot proses"></span>
                    <span>Proses</span>
                </div>
                <div class="legend-item unfilled">
                    <span>Belum / Terlambat</span>
                </div>
            </div>
        </section>

        <!-- 4. Section: Menu Admin -->
        <section class="admin-menu-section" aria-labelledby="menu-admin-heading">
            <div class="admin-menu-header">
                <h2 id="menu-admin-heading">Menu Admin</h2>
                <span class="shortcut-label">Pintasan Cepat</span>
            </div>

            <div class="menu-grid">
                <!-- Card 1: Tinjau Revisi -->
                <a href="{{ route('admin.revisi') }}" class="menu-card">
                    <div class="menu-card-top">
                        <div class="menu-icon" aria-hidden="true">
                            <x-icon name="page" />
                        </div>
                        <span class="menu-badge pill">3 aktif</span>
                    </div>
                    <div class="menu-card-bottom">
                        <span class="menu-title">Tinjau Revisi</span>
                        <span class="menu-chevron" aria-hidden="true">&#8250;</span>
                    </div>
                </a>

                <!-- Card 2: Kelola Akun -->
                <a href="{{ route('admin.accounts') }}" class="menu-card">
                    <div class="menu-card-top">
                        <div class="menu-icon" aria-hidden="true">
                            <x-icon name="group" />
                        </div>
                        <span class="menu-badge text-only">23 staf</span>
                    </div>
                    <div class="menu-card-bottom">
                        <span class="menu-title">Kelola Akun</span>
                        <span class="menu-chevron" aria-hidden="true">&#8250;</span>
                    </div>
                </a>

                <!-- Card 3: Kelola KPI -->
                <a href="{{ route('admin.kpi') }}" class="menu-card">
                    <div class="menu-card-top">
                        <div class="menu-icon" aria-hidden="true">
                            <x-icon name="list" />
                        </div>
                        <span class="menu-badge text-only">6 divisi</span>
                    </div>
                    <div class="menu-card-bottom">
                        <span class="menu-title">Kelola KPI</span>
                        <span class="menu-chevron" aria-hidden="true">&#8250;</span>
                    </div>
                </a>

                <!-- Card 4: Approve Laporan -->
                <a href="{{ route('admin.approve') }}" class="menu-card">
                    <div class="menu-card-top">
                        <div class="menu-icon" aria-hidden="true">
                            <x-icon name="verified-user" />
                        </div>
                        <span class="menu-badge pill">6 antrean</span>
                    </div>
                    <div class="menu-card-bottom">
                        <span class="menu-title">Approve Laporan</span>
                        <span class="menu-chevron" aria-hidden="true">&#8250;</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- Include Side Menu Drawer (Gambar 1) -->
        @include('admin.partials.drawer')
    </div>

    <!-- Toast Notification Element -->
    <div class="toast-msg" id="toastMsg" role="alert" aria-live="polite"></div>

    <script src="{{ asset('js/drawer.js') }}"></script>
    <script>
        const toastEl = document.getElementById('toastMsg');
        let toastTimeout;

        // Toast feedback for button clicks
        function showToast(message) {
            clearTimeout(toastTimeout);
            toastEl.textContent = message;
            toastEl.classList.add('show');
            toastTimeout = setTimeout(() => {
                toastEl.classList.remove('show');
            }, 2400);
        }
    </script>
</body>

</html>
