<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Profil (Kembali, Judul, Hamburger Menu) -->
        <header class="profile-header-bar">
            <a href="{{ route('admin.dashboard') }}" class="back-btn" aria-label="Kembali ke beranda">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>

            <h1 class="header-page-title">Profil</h1>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Kartu Ringkasan Profil Utama -->
        <section class="profile-card">
            <div class="profile-avatar-large">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>

            <h2 class="profile-display-name">{{ $user['name'] ?? 'User' }}</h2>
            <div class="profile-role-badge">{{ $user['role'] ?? 'ADMIN' }}</div>

            <div class="profile-status-indicator">
                <span class="status-dot"></span>
                <span class="status-text">{{ $user['status'] ?? 'Akun Aktif' }}</span>
            </div>
        </section>

        <!-- 3. Bagian Informasi Akun -->
        <section class="account-info-section">
            <h3 class="section-subheading">INFORMASI AKUN</h3>

            <div class="account-info-card">
                <!-- Baris Email -->
                <div class="info-row">
                    <div class="info-label-group">
                        <div class="info-icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <span class="info-label">Email</span>
                    </div>
                    <span class="info-value">{{ $user['email'] ?? 'User@capaian.id' }}</span>
                </div>
            </div>
        </section>

        <!-- 4. Tombol Logout (Pindah ke Profil Sesuai Permintaan) -->
        <form action="{{ route('logout') }}" method="POST" class="logout-form-wrapper">
            @csrf
            <button type="submit" class="logout-action-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Keluar (Logout)</span>
            </button>
        </form>

        <!-- 5. Footer Informasi -->
        <footer class="profile-footer-note">
            <strong class="footer-note-title">CAPAIAN.ID</strong>
            <p class="footer-note-desc">Sistem Pemantauan Kinerja Karyawan Toko Roti Wonosari</p>
        </footer>

        <!-- Include Side Menu Drawer (Gambar 1) -->
        @include('admin.partials.drawer')
    </div>

    <!-- Toast Element -->
    <div class="toast-msg" id="toastMsg" role="alert" aria-live="polite"></div>

    <script>
        // Drawer toggle logic
        const menuToggleBtn = document.getElementById('menuToggle');
        const drawerOverlay = document.getElementById('drawerOverlay');
        const drawerBackdrop = document.getElementById('drawerBackdrop');
        const drawerCloseBtn = document.getElementById('drawerCloseBtn');
        const toastEl = document.getElementById('toastMsg');
        let toastTimeout;

        function openDrawer() {
            drawerOverlay.classList.add('is-open');
            menuToggleBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            drawerOverlay.classList.remove('is-open');
            menuToggleBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        if (menuToggleBtn) menuToggleBtn.addEventListener('click', openDrawer);
        if (drawerCloseBtn) drawerCloseBtn.addEventListener('click', closeDrawer);
        if (drawerBackdrop) drawerBackdrop.addEventListener('click', closeDrawer);

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
