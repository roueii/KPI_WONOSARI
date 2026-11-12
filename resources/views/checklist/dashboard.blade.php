@extends('checklist.layout')

@section('title', 'Dashboard ' . $cfg['label'])
@section('with-drawer', true)

@php
    $r = $cfg['route'];
    $statusMap = [
        'tercapai' => ['success', 'green', 'Tercapai'],
        'belum_diisi' => ['warning', 'amber', 'Belum diisi'],
        'tidak_tercapai' => ['danger', 'red', 'Tidak tercapai'],
    ];
    $circumference = 2 * M_PI * 40;
    $dash = round($circumference * $summary['completed'] / max($summary['total'], 1), 1);
@endphp

@section('content')
    {{-- 1. Header --}}
    <header class="fl-header">
        <a href="{{ route($r . '.profile') }}" class="fl-profile-group" style="text-decoration: none; color: inherit;" aria-label="Lihat Profil">
            <div class="fl-avatar-circle" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                </svg>
            </div>
            <div class="fl-profile-info">
                <h1 class="fl-profile-name">Halo, {{ $user['name'] }}</h1>
                <span class="fl-profile-role">{{ $cfg['label'] }}</span>
            </div>
        </a>

        <button class="menu-btn" id="menuToggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </header>

    {{-- 2. Ringkasan Hari Ini --}}
    <section class="fl-summary-card" aria-labelledby="ringkasan-heading">
        <div class="fl-summary-header">
            <div class="fl-title-group">
                <h2 id="ringkasan-heading">Ringkasan Hari Ini</h2>
                <p>Indikator Capaian Harian</p>
            </div>
            <span class="fl-date-pill">{{ $todayBadge }}</span>
        </div>

        <div class="driver-chart-inner-card">
            <div class="driver-chart-left" role="img" aria-label="{{ $summary['completed'] }} dari {{ $summary['total'] }} indikator tuntas">
                <svg class="driver-donut-svg" viewBox="0 0 100 100">
                    <circle class="driver-donut-track" cx="50" cy="50" r="40"></circle>
                    <circle class="driver-donut-progress" cx="50" cy="50" r="40" stroke-dasharray="{{ $dash }} {{ round($circumference, 1) }}" @if($summary['completed'] == 0) stroke-opacity="0" @endif></circle>
                </svg>
                <div class="driver-donut-center">
                    <span class="driver-donut-val">{{ $summary['completed'] }}/{{ $summary['total'] }}</span>
                    <span class="driver-donut-sub">Tuntas</span>
                </div>
            </div>

            <div class="driver-progress-list">
                @foreach ($categories as $cat)
                    <div class="driver-progress-item">
                        <div class="driver-progress-header">
                            <span>{{ $cat['name'] }}</span>
                            <span class="driver-progress-count">{{ $cat['completed'] }}/{{ $cat['total'] }}</span>
                        </div>
                        <div class="driver-progress-bar-bg">
                            <div class="driver-progress-bar-fill" style="width: {{ $cat['percentage'] }}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="fl-legend-bar-revised">
            <div class="fl-legend-note-item"><span class="ck-dot green"></span><span>Hijau: Tercapai</span></div>
            <div class="fl-legend-note-item"><span class="ck-dot amber"></span><span>Kuning: Belum diisi</span></div>
            <div class="fl-legend-note-item"><span class="ck-dot red"></span><span>Merah: Tidak tercapai</span></div>
        </div>
    </section>

    {{-- 3. Tugas Harian --}}
    <section class="fl-section-group" aria-labelledby="tugas-heading">
        <div class="fl-section-header">
            <h2 id="tugas-heading">Tugas Harian</h2>
            <p>Wajib diisi hari ini</p>
        </div>

        <a href="{{ $startUrl }}" class="ck-cta-banner" aria-label="Mulai mengisi capaian hari ini">
            <div>
                <span class="ck-cta-title">Mulai Isi Capaian Hari Ini</span>
                <span class="ck-cta-meta">
                    @include('checklist.partials.icon', ['name' => 'clock', 'size' => 15])
                    <span>{{ count($categories) }} kategori &middot; 5–10 menit</span>
                </span>
            </div>
            <span class="ck-cta-arrow" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </span>
        </a>

        <div class="fl-preview-box">
            <div class="fl-preview-top">
                <span class="fl-preview-title">Preview Status</span>
                <span class="fl-preview-autosave">Tersimpan otomatis</span>
            </div>

            <div class="driver-preview-grid">
                @foreach ($categories as $cat)
                    @php [$badge, $dot, $label] = $statusMap[$cat['status']] ?? $statusMap['belum_diisi']; @endphp
                    <a href="{{ $cat['url'] }}" class="driver-preview-card">
                        <span class="driver-preview-card-title">{{ $cat['preview_title'] }}</span>
                        <span class="fl-badge-pill {{ $badge }}">
                            <span class="ck-dot {{ $dot }}"></span>
                            <span>{{ $label }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. Capaian Terbaru --}}
    <section class="fl-section-group" aria-labelledby="terbaru-heading">
        <div class="fl-section-header ck-row-between">
            <h2 id="terbaru-heading">Capaian Terbaru</h2>
            <a href="{{ route($r . '.riwayat') }}" class="ck-link-orange">Lihat Semua &rarr;</a>
        </div>

        <div class="fl-recent-list">
            @foreach ($recentAchievements as $item)
                <a href="{{ route($r . '.riwayat.detail', $item['id']) }}" class="fl-recent-card" style="text-decoration: none; color: inherit;">
                    <div class="fl-recent-left">
                        <span class="fl-recent-title" style="font-size: 0.92rem; font-weight: 700;">{{ $item['title'] }}</span>
                        <span class="fl-recent-date" style="font-size: 0.78rem; color: #78716c;">{{ $item['sub'] }}</span>
                    </div>
                    <span class="fl-status-badge {{ $item['badge_class'] }}">{{ $item['status_label'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- 5. Footer --}}
    <footer class="fl-footer-card">
        <span class="fl-footer-brand">CAPAIAN.ID</span>
        <span class="fl-footer-sub">Portal Manajemen Kinerja Roti Wonosari</span>
        <div class="fl-footer-links">
            <button type="button" class="fl-footer-link" onclick="alert(@js($cfg['help_text']))">Pusat Bantuan</button>
            <span class="fl-footer-dot">&bull;</span>
            <button type="button" class="fl-footer-link" onclick="alert('Kebijakan Privasi: Data laporan harian disimpan dengan aman untuk keperluan evaluasi kinerja berkala.')">Kebijakan Privasi</button>
            <span class="fl-footer-dot">&bull;</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="fl-footer-link">Keluar</button>
            </form>
        </div>
    </footer>
@endsection
