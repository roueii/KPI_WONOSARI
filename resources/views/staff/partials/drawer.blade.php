<!-- Side Menu Drawer (Overlay) Khusus Frontliner Sesuai Figma Revisi (Menu.png) -->
<div class="drawer-overlay" id="drawerOverlay" aria-hidden="true">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <aside class="drawer-sheet" id="drawerSheet" role="dialog" aria-modal="true" aria-label="Menu Navigasi Frontliner">
        <!-- Header Menu Drawer -->
        <div class="drawer-header" style="margin-bottom: 20px;">
            <div class="drawer-brand">
                <strong class="drawer-brand-title" style="font-size: 1.15rem; font-weight: 800; color: #1c1917; display: block; line-height: 1.2;">CAPAIAN.ID</strong>
                <span class="drawer-brand-sub" style="font-size: 0.78rem; color: #78716c; font-weight: 500;">KPI Toko Roti Wonosari</span>
            </div>
            <button class="drawer-close-btn" id="drawerCloseBtn" type="button" aria-label="Tutup menu navigasi" style="width: 38px; height: 38px; border-radius: 12px; border: 1px solid #ebdcd0; background: #ffffff; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #1c1917;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Profil Singkat Pengguna di Menu Sesuai Menu.png -->
        <div class="drawer-user-card" style="background: #fffdfa; border: 1px solid #ebdcd0; border-radius: 16px; padding: 12px 14px; display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
            <div class="drawer-user-avatar" style="width: 44px; height: 44px; border-radius: 50%; background: #ea580c; display: flex; align-items: center; justify-content: center; color: #ffffff; flex-shrink: 0;">
                <svg viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                </svg>
            </div>
            <div class="drawer-user-meta" style="display: flex; flex-direction: column;">
                <span class="drawer-user-name" style="font-size: 0.98rem; font-weight: 800; color: #1c1917;">{{ $user['name'] ?? 'User' }}</span>
                <span class="drawer-user-role" style="font-size: 0.78rem; font-weight: 600; color: #78716c;">Frontliner</span>
            </div>
        </div>

        <!-- Daftar 4 Menu Navigasi Sesuai Menu.png -->
        <nav class="drawer-nav-list" style="display: flex; flex-direction: column; gap: 10px; margin-bottom: auto;">
            <!-- 1. Beranda -->
            <a href="{{ route('frontliner.dashboard') }}" class="drawer-menu-revised-item {{ request()->routeIs('frontliner.dashboard', 'staff.dashboard') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9.5l9-7 9 7V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.5z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Beranda</span>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>

            <!-- 2. Input Capaian -->
            <a href="{{ route('frontliner.penjualan') }}" class="drawer-menu-revised-item {{ request()->is('*isi-capaian*') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span>Input Capaian</span>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>

            <!-- 3. Riwayat -->
            <a href="{{ route('frontliner.riwayat') }}" class="drawer-menu-revised-item {{ request()->routeIs('frontliner.riwayat*') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>Riwayat</span>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>

            <!-- 4. Profil -->
            <a href="{{ route('frontliner.profile') }}" class="drawer-menu-revised-item {{ request()->routeIs('frontliner.profile*') ? 'is-active' : '' }}">
                <div class="drawer-menu-revised-item-left">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="8" r="3"></circle>
                        <path d="M6.168 18.849a6.002 6.002 0 0 1 11.664 0"></path>
                    </svg>
                    <span>Profil</span>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        </nav>

        <!-- Kotak Bawah Sesuai Menu.png -->
        <div class="drawer-menu-revised-footer-pill" style="margin-top: 40px; margin-bottom: 10px;">
            KPI Toko Roti Wonosari
        </div>
    </aside>
</div>
