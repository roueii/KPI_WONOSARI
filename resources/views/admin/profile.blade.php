<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Profil (Kembali, Judul, Hamburger Menu) -->
        <header class="profile-header-bar">
            <a href="{{ route('admin.dashboard') }}" class="back-btn" aria-label="Kembali ke beranda">
                <x-icon name="arrow-left" width="20" height="20" />
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
                <x-icon name="user" />
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
                            <x-icon name="mail" />
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
                <x-icon name="log-out" width="20" height="20" />
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

    <script src="{{ asset('js/drawer.js') }}"></script>
    <script>
        const toastEl = document.getElementById('toastMsg');
        let toastTimeout;

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
