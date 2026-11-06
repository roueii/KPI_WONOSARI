<!-- Side Menu Drawer (Overlay) Sesuai Gambar 1 -->
<div class="drawer-overlay" id="drawerOverlay" aria-hidden="true">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <aside class="drawer-sheet" id="drawerSheet" role="dialog" aria-modal="true" aria-label="Menu Navigasi">
        <!-- Header Menu Drawer -->
        <div class="drawer-header">
            <div class="drawer-brand">
                <strong class="drawer-brand-title">CAPAIAN.ID</strong>
                <span class="drawer-brand-sub">KPI Toko Roti Wonosari</span>
            </div>
            <button class="drawer-close-btn" id="drawerCloseBtn" type="button" aria-label="Tutup menu navigasi">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Profil Singkat Pengguna di Menu -->
        <div class="drawer-user-card">
            <div class="drawer-user-avatar">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                </svg>
            </div>
            <div class="drawer-user-meta">
                <span class="drawer-user-name">{{ $user['name'] ?? 'Admin' }}</span>
                <span class="drawer-user-role">Admin</span>
            </div>
        </div>

        <!-- Daftar Menu Navigasi -->
        <nav class="drawer-nav-list">
            <!-- 1. Beranda -->
            <a href="{{ route('admin.dashboard') }}" class="drawer-nav-item {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9.5l9-7 9 7V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.5z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span class="drawer-item-title">Beranda</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 2. Tinjau Revisi -->
            <a href="{{ route('admin.revisi') }}" class="drawer-nav-item {{ request()->routeIs('admin.revisi') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </span>
                    <span class="drawer-item-title">Tinjau Revisi</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 3. Kelola Akun -->
            <a href="{{ route('admin.accounts') }}" class="drawer-nav-item {{ request()->routeIs('admin.accounts') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </span>
                    <span class="drawer-item-title">Kelola Akun</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 4. Kelola KPI -->
            <a href="{{ route('admin.kpi') }}" class="drawer-nav-item {{ request()->routeIs('admin.kpi*') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                    </span>
                    <span class="drawer-item-title">Kelola KPI</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 5. Approve Laporan -->
            <a href="{{ route('admin.approve') }}" class="drawer-nav-item {{ request()->routeIs('admin.approve*') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="7" r="4" />
                            <path d="M2 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v2" />
                            <circle cx="19" cy="11" r="3" />
                            <path d="m17.5 11 1 1 2-2" />
                        </svg>
                    </span>
                    <span class="drawer-item-title">Approve Laporan</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 6. Profil (Membuka Halaman Profil Gambar 2) -->
            <a href="{{ route('admin.profile') }}" class="drawer-nav-item {{ request()->routeIs('admin.profile') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="10" r="3"></circle>
                            <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                        </svg>
                    </span>
                    <span class="drawer-item-title">Profil</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>
        </nav>

        <!-- Bagian Bawah Menu Drawer -->
        <div class="drawer-footer">
            <div class="drawer-footer-badge">
                <span>KPI Toko Roti Wonosari</span>
            </div>
        </div>
    </aside>
</div>
