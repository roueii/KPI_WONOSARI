<!-- Side Menu Drawer Khusus Produksi Sesuai Menu.png -->
<div class="drawer-overlay" id="drawerOverlay" aria-hidden="true">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <aside class="drawer-sheet" id="drawerSheet" role="dialog" aria-modal="true" aria-label="Menu Navigasi Produksi" style="display: flex; flex-direction: column; height: 100%; max-height: 94vh;">
        <!-- Header Menu Drawer -->
        <div class="drawer-header" style="border-bottom: none; padding-bottom: 8px;">
            <div class="drawer-brand">
                <strong class="drawer-brand-title" style="font-size: var(--fs-18); letter-spacing: -0.01em;">CAPAIAN.ID</strong>
                <span class="drawer-brand-sub" style="font-size: var(--fs-12); color: var(--neutral-500);">KPI Toko Roti Wonosari</span>
            </div>
            <button class="drawer-close-btn" id="drawerCloseBtn" type="button" aria-label="Tutup menu navigasi">
                <x-icon name="cancel" width="20" height="20" />
            </button>
        </div>

        <!-- Profil Singkat Pengguna Produksi Sesuai Menu.png -->
        <a href="{{ route('produksi.profile') }}" class="driver-drawer-menu-card" style="margin-bottom: 14px; background: var(--neutral-50);" aria-label="Lihat Profil Produksi">
            <div class="driver-drawer-menu-left">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--primary-500); display: flex; align-items: center; justify-content: center; color: var(--white); flex-shrink: 0;">
                    <x-icon name="user" width="24" height="24" />
                </div>
                <div style="display: flex; flex-direction: column; line-height: 1.25;">
                    <strong style="font-size: var(--fs-16); color: var(--neutral-900);">{{ $user['name'] ?? 'User' }}</strong>
                    <span style="font-size: var(--fs-12); color: var(--neutral-500);">Produksi</span>
                </div>
            </div>
        </a>

        <!-- Daftar Menu Navigasi Produksi Sesuai Menu.png -->
        <nav style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;">
            <!-- 1. Beranda -->
            <a href="{{ route('produksi.dashboard') }}" class="driver-drawer-menu-card {{ request()->routeIs('produksi.dashboard') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <x-icon name="home-simple" />
                    </span>
                    <span class="driver-drawer-menu-title">Beranda</span>
                </div>
                <span style="color: var(--neutral-400); font-size: var(--fs-18);">&#8250;</span>
            </a>

            <!-- 2. Input Capaian -->
            <a href="{{ route('produksi.hasil_produksi') }}" class="driver-drawer-menu-card {{ request()->is('*produksi/isi-capaian*') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <x-icon name="page" />
                    </span>
                    <span class="driver-drawer-menu-title">Input Capaian</span>
                </div>
                <span style="color: var(--neutral-400); font-size: var(--fs-18);">&#8250;</span>
            </a>

            <!-- 3. Riwayat -->
            <a href="{{ route('produksi.riwayat') }}" class="driver-drawer-menu-card {{ request()->routeIs('produksi.riwayat*') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <x-icon name="clock" />
                    </span>
                    <span class="driver-drawer-menu-title">Riwayat</span>
                </div>
                <span style="color: var(--neutral-400); font-size: var(--fs-18);">&#8250;</span>
            </a>

            <!-- 4. Profil -->
            <a href="{{ route('produksi.profile') }}" class="driver-drawer-menu-card {{ request()->routeIs('produksi.profile*') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <x-icon name="user" />
                    </span>
                    <span class="driver-drawer-menu-title">Profil</span>
                </div>
                <span style="color: var(--neutral-400); font-size: var(--fs-18);">&#8250;</span>
            </a>
        </nav>

        <!-- Bottom Chip Sesuai Menu.png -->
        <div class="driver-drawer-footer-chip">
            KPI Toko Roti Wonosari
        </div>
    </aside>
</div>

