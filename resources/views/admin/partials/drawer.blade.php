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
                <x-icon name="cancel" width="20" height="20" />
            </button>
        </div>

        <!-- Profil Singkat Pengguna di Menu -->
        <div class="drawer-user-card">
            <div class="drawer-user-avatar">
                <x-icon name="user" />
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
                        <x-icon name="home-simple" />
                    </span>
                    <span class="drawer-item-title">Beranda</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 2. Tinjau Revisi -->
            <a href="{{ route('admin.revisi') }}" class="drawer-nav-item {{ request()->routeIs('admin.revisi') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <x-icon name="page" />
                    </span>
                    <span class="drawer-item-title">Tinjau Revisi</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 3. Kelola Akun -->
            <a href="{{ route('admin.accounts') }}" class="drawer-nav-item {{ request()->routeIs('admin.accounts') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <x-icon name="group" />
                    </span>
                    <span class="drawer-item-title">Kelola Akun</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 4. Kelola KPI -->
            <a href="{{ route('admin.kpi') }}" class="drawer-nav-item {{ request()->routeIs('admin.kpi*') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <x-icon name="list" />
                    </span>
                    <span class="drawer-item-title">Kelola KPI</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 5. Approve Laporan -->
            <a href="{{ route('admin.approve') }}" class="drawer-nav-item {{ request()->routeIs('admin.approve*') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <x-icon name="verified-user" />
                    </span>
                    <span class="drawer-item-title">Approve Laporan</span>
                </div>
                <span class="drawer-item-chevron">&#8250;</span>
            </a>

            <!-- 6. Profil (Membuka Halaman Profil Gambar 2) -->
            <a href="{{ route('admin.profile') }}" class="drawer-nav-item {{ request()->routeIs('admin.profile') ? 'is-active' : '' }}">
                <div class="drawer-item-content">
                    <span class="drawer-item-icon">
                        <x-icon name="profile-circle" />
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
