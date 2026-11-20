<!-- Side Menu Drawer (Overlay) Khusus Frontliner Sesuai Figma Revisi (Menu.png) -->
<div class="drawer-overlay" id="drawerOverlay" aria-hidden="true">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <aside class="drawer-sheet" id="drawerSheet" role="dialog" aria-modal="true" aria-label="Menu Navigasi Frontliner">
        <!-- Header Menu Drawer -->
        <div class="drawer-header" style="margin-bottom: 20px;">
            <div class="drawer-brand">
                <strong class="drawer-brand-title" style="font-size: var(--fs-18); font-weight: var(--fw-semibold); color: var(--neutral-900); display: block; line-height: 1.2;">CAPAIAN.ID</strong>
                <span class="drawer-brand-sub" style="font-size: var(--fs-12); color: var(--neutral-500); font-weight: 500;">KPI Toko Roti Wonosari</span>
            </div>
            <button class="drawer-close-btn" id="drawerCloseBtn" type="button" aria-label="Tutup menu navigasi" style="width: 38px; height: 38px; border-radius: 12px; border: 1px solid var(--secondary-100); background: var(--white); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--neutral-900);">
                <x-icon name="cancel" width="18" height="18" />
            </button>
        </div>

        <!-- Profil Singkat Pengguna di Menu Sesuai Menu.png -->
        <div class="drawer-user-card" style="background: var(--neutral-50); border: 1px solid var(--secondary-100); border-radius: 16px; padding: 12px 14px; display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
            <div class="drawer-user-avatar" style="width: 44px; height: 44px; border-radius: 50%; background: var(--primary-600); display: flex; align-items: center; justify-content: center; color: var(--white); flex-shrink: 0;">
                <x-icon name="user" width="24" height="24" />
            </div>
            <div class="drawer-user-meta" style="display: flex; flex-direction: column;">
                <span class="drawer-user-name" style="font-size: var(--fs-16); font-weight: var(--fw-semibold); color: var(--neutral-900);">{{ $user['name'] ?? 'User' }}</span>
                <span class="drawer-user-role" style="font-size: var(--fs-12); font-weight: 600; color: var(--neutral-500);">Frontliner</span>
            </div>
        </div>

        <!-- Daftar 4 Menu Navigasi Sesuai Menu.png -->
        <nav class="drawer-nav-list" style="display: flex; flex-direction: column; gap: 10px; margin-bottom: auto;">
            <!-- 1. Beranda -->
            <a href="{{ route('frontliner.dashboard') }}" class="drawer-menu-revised-item {{ request()->routeIs('frontliner.dashboard', 'staff.dashboard') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <x-icon name="home-simple" width="20" height="20" />
                    <span>Beranda</span>
                </div>
                <x-icon name="nav-arrow-right" width="16" height="16" />
            </a>

            <!-- 2. Input Capaian -->
            <a href="{{ route('frontliner.penjualan') }}" class="drawer-menu-revised-item {{ request()->is('*isi-capaian*') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <x-icon name="page" width="20" height="20" />
                    <span>Input Capaian</span>
                </div>
                <x-icon name="nav-arrow-right" width="16" height="16" />
            </a>

            <!-- 3. Riwayat -->
            <a href="{{ route('frontliner.riwayat') }}" class="drawer-menu-revised-item {{ request()->routeIs('frontliner.riwayat*') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <x-icon name="clock" width="20" height="20" />
                    <span>Riwayat</span>
                </div>
                <x-icon name="nav-arrow-right" width="16" height="16" />
            </a>

            <!-- 4. Profil -->
            <a href="{{ route('frontliner.profile') }}" class="drawer-menu-revised-item {{ request()->routeIs('frontliner.profile*') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <x-icon name="profile-circle" width="20" height="20" />
                    <span>Profil</span>
                </div>
                <x-icon name="nav-arrow-right" width="16" height="16" />
            </a>
        </nav>

        <!-- Kotak Bawah Sesuai Menu.png -->
        <div class="drawer-menu-revised-footer-pill" style="margin-top: 40px; margin-bottom: 10px;">
            KPI Toko Roti Wonosari
        </div>
    </aside>
</div>
