<!-- Side Menu Drawer Khusus Driver Sesuai Menu.png -->
<div class="drawer-overlay" id="drawerOverlay" aria-hidden="true">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <aside class="drawer-sheet" id="drawerSheet" role="dialog" aria-modal="true" aria-label="Menu Navigasi Driver" style="display: flex; flex-direction: column; height: 100%; max-height: 94vh;">
        <!-- Header Menu Drawer -->
        <div class="drawer-header" style="border-bottom: none; padding-bottom: 8px;">
            <div class="drawer-brand">
                <strong class="drawer-brand-title" style="font-size: 1.15rem; letter-spacing: -0.01em;">CAPAIAN.ID</strong>
                <span class="drawer-brand-sub" style="font-size: 0.78rem; color: #78716c;">KPI Toko Roti Wonosari</span>
            </div>
            <button class="drawer-close-btn" id="drawerCloseBtn" type="button" aria-label="Tutup menu navigasi">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Profil Singkat Pengguna Driver Sesuai Menu.png -->
        <a href="{{ route('driver.profile') }}" class="driver-drawer-menu-card" style="margin-bottom: 14px; background: #fffdfa;" aria-label="Lihat Profil Driver">
            <div class="driver-drawer-menu-left">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: #f97316; display: flex; align-items: center; justify-content: center; color: #ffffff; flex-shrink: 0;">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <div style="display: flex; flex-direction: column; line-height: 1.25;">
                    <strong style="font-size: 1rem; color: #1c1917;">{{ $user['name'] ?? 'User' }}</strong>
                    <span style="font-size: 0.8rem; color: #78716c;">Driver</span>
                </div>
            </div>
        </a>

        <!-- Daftar Menu Navigasi Driver Sesuai Menu.png -->
        <nav style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;">
            <!-- 1. Beranda -->
            <a href="{{ route('driver.dashboard') }}" class="driver-drawer-menu-card {{ request()->routeIs('driver.dashboard') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9.5l9-7 9 7V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.5z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span class="driver-drawer-menu-title">Beranda</span>
                </div>
                <span style="color: #a8a29e; font-size: 1.1rem;">&#8250;</span>
            </a>

            <!-- 2. Input Capaian -->
            <a href="{{ route('driver.pengiriman') }}" class="driver-drawer-menu-card {{ request()->is('*driver/isi-capaian*') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </span>
                    <span class="driver-drawer-menu-title">Input Capaian</span>
                </div>
                <span style="color: #a8a29e; font-size: 1.1rem;">&#8250;</span>
            </a>

            <!-- 3. Riwayat -->
            <a href="{{ route('driver.riwayat') }}" class="driver-drawer-menu-card {{ request()->routeIs('driver.riwayat*') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </span>
                    <span class="driver-drawer-menu-title">Riwayat</span>
                </div>
                <span style="color: #a8a29e; font-size: 1.1rem;">&#8250;</span>
            </a>

            <!-- 4. Profil -->
            <a href="{{ route('driver.profile') }}" class="driver-drawer-menu-card {{ request()->routeIs('driver.profile*') ? 'is-active' : '' }}">
                <div class="driver-drawer-menu-left">
                    <span class="driver-drawer-menu-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <span class="driver-drawer-menu-title">Profil</span>
                </div>
                <span style="color: #a8a29e; font-size: 1.1rem;">&#8250;</span>
            </a>
        </nav>

        <!-- Bottom Chip Sesuai Menu.png -->
        <div class="driver-drawer-footer-chip">
            KPI Toko Roti Wonosari
        </div>
    </aside>
</div>

