@extends('checklist.layout')

@section('title', 'Riwayat Capaian')

@php $r = $cfg['route']; @endphp
@section('content')
    <header class="fl-riwayat-header">
        <a href="{{ route($r . '.dashboard') }}" class="fl-step-close-btn" aria-label="Kembali ke Dashboard">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
        <div class="fl-riwayat-header-text">
            <h1 class="fl-riwayat-title">Riwayat</h1>
            <p class="fl-riwayat-subtitle">Capaian harian saya</p>
        </div>
    </header>

    @php
        $metrics = [
            'disetujui' => ['Disetujui', 'dot-green'],
            'menunggu' => ['Menunggu', 'dot-gray'],
            'revisi' => ['Revisi', 'dot-amber'],
        ];
    @endphp

    <section class="fl-riwayat-metrics-grid" aria-label="Ringkasan status capaian">
        @foreach ($metrics as $key => [$label, $dot])
            <button type="button" class="fl-riwayat-metric-card ck-reset-btn {{ $filter === $key ? 'is-active' : '' }}" data-filter="{{ $key }}">
                <span class="fl-riwayat-metric-header">
                    <span class="fl-dot-circle {{ $dot }}"></span>
                    <span class="fl-riwayat-metric-label">{{ $label }}</span>
                </span>
                <span class="fl-riwayat-metric-value">{{ $summaryCounts[$key] }}</span>
            </button>
        @endforeach
    </section>

    <nav class="fl-filter-chips-row" aria-label="Filter riwayat capaian">
        <button type="button" class="fl-filter-chip {{ $filter === 'semua' ? 'is-active' : '' }}" data-filter="semua">Semua ({{ $summaryCounts['semua'] }})</button>
        @foreach ($metrics as $key => [$label])
            <button type="button" class="fl-filter-chip {{ $filter === $key ? 'is-active' : '' }}" data-filter="{{ $key }}">{{ $label }} ({{ $summaryCounts[$key] }})</button>
        @endforeach
    </nav>

    <main class="fl-history-list" aria-label="Daftar riwayat capaian">
        @foreach ($riwayatList as $item)
            <a href="{{ route($r . '.riwayat.detail', $item['id']) }}" class="fl-history-card-item" data-status="{{ $item['status'] }}" aria-label="Capaian {{ $item['full_date'] }}, status {{ $item['status_label'] }}">
                <div class="fl-history-item-left">
                    <div class="fl-history-date-block">
                        <span class="fl-history-day-name">{{ $item['day_name'] }}</span>
                        <span class="fl-history-day-num">{{ $item['day_num'] }}</span>
                    </div>
                    <div class="fl-history-meta">
                        <span class="fl-history-full-date">{{ $item['full_date'] }}</span>
                        <span class="fl-history-category-info">{{ $item['category_info'] }}</span>
                    </div>
                </div>
                <div class="fl-history-item-right">
                    <span class="fl-history-badge badge-{{ $item['status'] }}">{{ $item['status_label'] }}</span>
                    <span class="fl-history-chevron" aria-hidden="true">&#8250;</span>
                </div>
            </a>
        @endforeach

        <div class="fl-history-empty" id="emptyState">
            <p style="margin: 0; font-weight: 600; color: #57534e;">Tidak ada riwayat dengan status ini</p>
            <p style="margin: 4px 0 0; font-size: 0.78rem; color: #a8a29e;">Pilih filter lain untuk melihat riwayat.</p>
        </div>
    </main>

    <footer class="fl-history-legend-card" aria-label="Legenda status">
        <div class="fl-history-legend-title">Indikator Bentuk Status:</div>
        <div class="fl-history-legend-items">
            <span class="fl-history-legend-item"><span class="fl-dot-circle dot-green"></span><span>Hijau = Disetujui</span></span>
            <span class="fl-history-legend-item"><span class="fl-dot-circle dot-gray"></span><span>Abu-abu = Menunggu</span></span>
            <span class="fl-history-legend-item"><span class="fl-dot-circle dot-amber"></span><span>Kuning = Revisi</span></span>
        </div>
    </footer>
@endsection

@push('scripts')
    <script>
        function applyStatusFilter(status) {
            document.querySelectorAll('.fl-filter-chip').forEach(c => c.classList.toggle('is-active', c.dataset.filter === status));
            document.querySelectorAll('.fl-riwayat-metric-card').forEach(c => c.classList.toggle('is-active', c.dataset.filter === status));
            let visible = 0;
            document.querySelectorAll('.fl-history-card-item').forEach(item => {
                const show = status === 'semua' || item.dataset.status === status;
                item.style.display = show ? 'flex' : 'none';
                if (show) visible++;
            });
            document.getElementById('emptyState').style.display = visible ? 'none' : 'block';
            const url = new URL(window.location);
            url.searchParams.set('status', status);
            history.replaceState(null, '', url);
        }
        document.querySelectorAll('[data-filter]').forEach(btn => btn.addEventListener('click', () => applyStatusFilter(btn.dataset.filter)));
        applyStatusFilter(@js($filter));
    </script>
@endpush
