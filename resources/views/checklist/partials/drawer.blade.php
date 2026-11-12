@php $r = $cfg['route']; @endphp
<div class="drawer-overlay" id="drawerOverlay" aria-hidden="true">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <aside class="drawer-sheet" id="drawerSheet" role="dialog" aria-modal="true" aria-label="Menu Navigasi {{ $cfg['label'] }}" style="display: flex; flex-direction: column; height: 100%; max-height: 94vh;">
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

        <a href="{{ route($r . '.profile') }}" class="driver-drawer-menu-card" style="margin-bottom: 14px; background: #fffdfa;" aria-label="Lihat Profil">
            <div class="driver-drawer-menu-left">
                <div class="ck-drawer-avatar">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <div style="display: flex; flex-direction: column; line-height: 1.25;">
                    <strong style="font-size: 1rem; color: #1c1917;">{{ $user['name'] }}</strong>
                    <span style="font-size: 0.8rem; color: #78716c;">{{ $cfg['label'] }}</span>
                </div>
            </div>
        </a>

        @php
            $menu = [
                ['Beranda', route($r . '.dashboard'), request()->routeIs($r . '.dashboard'), 'home'],
                ['Input Capaian', route($r . '.step', array_key_first($cfg['steps'])), request()->routeIs($r . '.step'), 'document'],
                ['Riwayat', route($r . '.riwayat'), request()->routeIs($r . '.riwayat*'), 'clock'],
                ['Profil', route($r . '.profile'), request()->routeIs($r . '.profile'), 'user'],
            ];
        @endphp
        <nav style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;">
            @foreach ($menu as [$label, $url, $active, $icon])
                <a href="{{ $url }}" class="driver-drawer-menu-card {{ $active ? 'is-active' : '' }}" @if ($active) aria-current="page" @endif>
                    <div class="driver-drawer-menu-left">
                        <span class="driver-drawer-menu-icon">@include('checklist.partials.icon', ['name' => $icon, 'size' => 22])</span>
                        <span class="driver-drawer-menu-title">{{ $label }}</span>
                    </div>
                    <span style="color: #a8a29e; font-size: 1.1rem;" aria-hidden="true">&#8250;</span>
                </a>
            @endforeach
        </nav>

        <div class="driver-drawer-footer-chip">KPI Toko Roti Wonosari</div>
    </aside>
</div>
