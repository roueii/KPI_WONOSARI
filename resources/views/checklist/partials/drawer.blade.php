@php $r = $cfg['route']; @endphp
<div class="drawer-overlay" id="drawerOverlay" aria-hidden="true">
    <div class="drawer-backdrop" id="drawerBackdrop"></div>
    <aside class="drawer-sheet" id="drawerSheet" role="dialog" aria-modal="true" aria-label="Menu Navigasi {{ $cfg['label'] }}" style="display: flex; flex-direction: column; height: 100%; max-height: 94vh;">
        <div class="drawer-header" style="border-bottom: none; padding-bottom: 8px;">
            <div class="drawer-brand">
                <strong class="drawer-brand-title" style="font-size: var(--fs-18); letter-spacing: -0.01em;">CAPAIAN.ID</strong>
                <span class="drawer-brand-sub" style="font-size: var(--fs-12); color: var(--neutral-500);">KPI Toko Roti Wonosari</span>
            </div>
            <button class="drawer-close-btn" id="drawerCloseBtn" type="button" aria-label="Tutup menu navigasi">
                <x-icon name="cancel" width="20" height="20" />
            </button>
        </div>

        <a href="{{ route($r . '.profile') }}" class="driver-drawer-menu-card" style="margin-bottom: 14px; background: var(--neutral-50);" aria-label="Lihat Profil">
            <div class="driver-drawer-menu-left">
                <div class="ck-drawer-avatar">
                    <x-icon name="user" width="24" height="24" />
                </div>
                <div style="display: flex; flex-direction: column; line-height: 1.25;">
                    <strong style="font-size: var(--fs-16); color: var(--neutral-900);">{{ $user['name'] }}</strong>
                    <span style="font-size: var(--fs-12); color: var(--neutral-500);">{{ $cfg['label'] }}</span>
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
                    <span style="color: var(--neutral-400); font-size: var(--fs-18);" aria-hidden="true">&#8250;</span>
                </a>
            @endforeach
        </nav>

        <div class="driver-drawer-footer-chip">KPI Toko Roti Wonosari</div>
    </aside>
</div>
