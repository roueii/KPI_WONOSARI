<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Driver | Capaian.id - KPI Wonosari</title>
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
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Kembali, Judul Profil, Hamburger Menu) -->
        <header class="fl-profile-header-bar">
            <div class="fl-profile-header-left">
                <a href="{{ route('driver.dashboard') }}" class="fl-step-close-btn" aria-label="Kembali ke Dashboard Driver">
                    <x-icon name="arrow-left" />
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
                <x-icon name="user" />
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
                        <x-icon name="mail" class="fl-account-info-icon" aria-hidden="true" />
                        <span>Email</span>
                    </div>
                    <span class="fl-account-info-val">{{ $user['email'] ?? 'User@capaian.id' }}</span>
                </div>

                <!-- Baris 3: Bergabung Sejak -->
                <div class="fl-account-info-row">
                    <div class="fl-account-info-left">
                        <x-icon name="calendar" class="fl-account-info-icon" aria-hidden="true" />
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
                <x-icon name="log-out" width="20" height="20" aria-hidden="true" />
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
    <script src="{{ asset('js/drawer.js') }}"></script>
</body>

</html>

