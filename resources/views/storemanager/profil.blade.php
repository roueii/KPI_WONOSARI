<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Pengguna | Capaian.id - Store Manager</title>
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
        <!-- 1. Header Bar Sesuai Desain Figma Halaman Profil.png -->
        <header class="fl-top-nav" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <a href="{{ route('storemanager.dashboard') }}" class="fl-nav-back-btn" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid #ebdcd0; background: #ffffff; display: flex; align-items: center; justify-content: center; color: #1c1917; text-decoration: none;" aria-label="Kembali ke Dashboard">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <h1 style="font-size: 1.35rem; font-weight: 800; color: #1c1917; margin: 0;">Profil</h1>
            </div>

            <!-- Hamburger Button -->
            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid #ebdcd0; background: #ffffff; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">
                <span style="width: 18px; height: 2px; background: #1c1917; border-radius: 2px;"></span>
                <span style="width: 18px; height: 2px; background: #1c1917; border-radius: 2px;"></span>
                <span style="width: 18px; height: 2px; background: #1c1917; border-radius: 2px;"></span>
            </button>
        </header>

        <!-- 2. Kartu Profil Pengguna Sesuai Figma -->
        <section style="background: #fffdfa; border: 1px solid #ebdcd0; border-radius: 20px; padding: 28px 20px; text-align: center; margin-bottom: 24px;">
            <div style="width: 76px; height: 76px; border-radius: 50%; border: 1.5px solid #fed7aa; background: #ffffff; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: #78716c;">
                <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>

            <h2 style="font-size: 1.35rem; font-weight: 800; color: #1c1917; margin: 0 0 6px;">{{ $user['name'] ?? 'User' }}</h2>

            <div style="margin-bottom: 8px;">
                <span style="display: inline-block; border: 1.5px solid #c2410c; background: #fff8f3; color: #c2410c; font-size: 0.72rem; font-weight: 800; padding: 3px 12px; border-radius: 999px; letter-spacing: 0.05em;">
                    {{ $user['role_label'] ?? 'STORE MANAGER' }}
                </span>
            </div>

            <div style="display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.78rem; font-weight: 700; color: #ea580c;">
                <span style="width: 7px; height: 7px; border-radius: 50%; background: #ea580c;"></span>
                <span>{{ $user['status_label'] ?? 'Akun Aktif' }}</span>
            </div>
        </section>

        <!-- 3. Informasi Akun Sesuai Figma -->
        <div style="font-size: 0.74rem; font-weight: 800; color: #a8a29e; letter-spacing: 0.05em; margin-bottom: 8px;">
            INFORMASI AKUN
        </div>

        <section style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 18px; padding: 6px 18px; margin-bottom: 28px;">
            <!-- Baris Email -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 14px 0; border-bottom: 1px solid #f4ebe2;">
                <div style="display: flex; align-items: center; gap: 12px; color: #78716c; font-size: 0.82rem; font-weight: 600;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <span>Email</span>
                </div>
                <span style="font-size: 0.82rem; font-weight: 700; color: #1c1917;">{{ $user['email'] ?? 'User@capaian.id' }}</span>
            </div>

            <!-- Baris Bergabung Sejak -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 14px 0;">
                <div style="display: flex; align-items: center; gap: 12px; color: #78716c; font-size: 0.82rem; font-weight: 600;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>Bergabung Sejak</span>
                </div>
                <span style="font-size: 0.82rem; font-weight: 700; color: #1c1917;">{{ $user['joined_at'] ?? 'Jan 2024' }}</span>
            </div>
        </section>

        <!-- 4. Tombol Keluar (Logout) Sesuai Figma -->
        <form action="{{ route('logout') }}" method="POST" style="margin-bottom: 32px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 15px; border-radius: 14px; border: none; background: #f97316; color: #ffffff; font-size: 0.95rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.32);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Keluar (Logout)</span>
            </button>
        </form>

        <!-- 5. Footer Branding Sesuai Figma -->
        <footer style="text-align: center; margin-bottom: 24px;">
            <div style="font-size: 0.78rem; font-weight: 800; color: #78716c; letter-spacing: 0.05em; margin-bottom: 4px;">
                CAPAIAN.ID
            </div>
            <div style="font-size: 0.72rem; color: #a8a29e;">
                Sistem Pemantauan Kinerja Karyawan Toko Roti Wonosari
            </div>
        </footer>
    </div>

    <!-- Navigation Drawer -->
    @include('storemanager.partials.drawer')

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sideDrawer = document.getElementById('sideDrawer');
        const drawerBackdrop = document.getElementById('drawerBackdrop');
        const closeDrawer = document.getElementById('closeDrawer');

        function openMenu() {
            if (sideDrawer && drawerBackdrop) {
                sideDrawer.classList.add('is-open');
                drawerBackdrop.classList.add('is-open');
                menuToggle.setAttribute('aria-expanded', 'true');
            }
        }

        function closeMenu() {
            if (sideDrawer && drawerBackdrop) {
                sideDrawer.classList.remove('is-open');
                drawerBackdrop.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        }

        if (menuToggle) menuToggle.addEventListener('click', openMenu);
        if (closeDrawer) closeDrawer.addEventListener('click', closeMenu);
        if (drawerBackdrop) drawerBackdrop.addEventListener('click', closeMenu);
    </script>
</body>

</html>

