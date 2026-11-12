<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Driver | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Kembali, Judul Profil, Hamburger Menu) -->
        <header class="fl-profile-header-bar">
            <div class="fl-profile-header-left">
                <a href="{{ route('driver.dashboard') }}" class="fl-step-close-btn" aria-label="Kembali ke Dashboard Driver">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h1 class="fl-profile-header-title">Profil</h1>
            </div>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. KARTU PROFIL UTAMA Sesuai Halaman Profil.png -->
        <section class="fl-user-profile-card" aria-label="Profil Karyawan Driver">
            <!-- Lingkaran Avatar Siluet Garis -->
            <div class="fl-user-profile-avatar" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="7" r="4.5"></circle>
                    <path d="M20 21v-1.5a6.5 6.5 0 0 0-13 0V21"></path>
                </svg>
            </div>

            <!-- Nama Pengguna -->
            <h2 class="fl-user-profile-name">{{ $user['name'] ?? 'User' }}</h2>

            <!-- Role Badge DRIVER -->
            <span class="fl-user-profile-badge">{{ $user['role_label'] ?? 'DRIVER' }}</span>

            <!-- Status Akun -->
            <div class="fl-user-profile-status">
                <span class="fl-user-profile-dot"></span>
                <span>{{ $user['status_label'] ?? 'Akun Aktif' }}</span>
            </div>
        </section>

        <!-- 3. SECTION: INFORMASI AKUN Sesuai Figma -->
        <section aria-labelledby="heading-info-akun-driver">
            <h3 class="fl-account-info-heading" id="heading-info-akun-driver">INFORMASI AKUN</h3>

            <div class="fl-account-info-card">
                <!-- Baris 1: Email -->
                <div class="fl-account-info-row">
                    <div class="fl-account-info-left">
                        <svg class="fl-account-info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="M22 7l-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <span>Email</span>
                    </div>
                    <span class="fl-account-info-val">{{ $user['email'] ?? 'User@capaian.id' }}</span>
                </div>

                <!-- Baris 3: Bergabung Sejak -->
                <div class="fl-account-info-row">
                    <div class="fl-account-info-left">
                        <svg class="fl-account-info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Bergabung Sejak</span>
                    </div>
                    <span class="fl-account-info-val">{{ $user['joined_at'] ?? 'Jan 2024' }}</span>
                </div>
            </div>
        </section>

        <!-- 4. ACTION BUTTON: Keluar (Logout) Sesuai Figma -->
        <form action="{{ route('logout') }}" method="POST" id="logoutFormDriver">
            @csrf
            <button type="submit" class="fl-btn-logout">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Keluar (Logout)</span>
            </button>
        </form>

        <!-- 5. FOOTER BRANDING Sesuai Figma -->
        <footer class="fl-profile-footer-brand">
            <span class="fl-profile-footer-name">CAPAIAN.ID</span>
            <span class="fl-profile-footer-sub">Sistem Pemantauan Kinerja Karyawan Toko Roti Wonosari</span>
        </footer>

        <!-- Side Navigation Drawer Partial Khusus Driver -->
        @include('driver.partials.drawer')
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

