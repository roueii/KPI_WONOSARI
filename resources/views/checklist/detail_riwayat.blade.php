@extends('checklist.layout')

@section('title', 'Detail Riwayat')

@php $r = $cfg['route']; @endphp
@section('content')
    <header class="fl-riwayat-header">
        <a href="{{ route($r . '.riwayat') }}" class="fl-step-close-btn" aria-label="Kembali ke daftar riwayat">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
        <div class="fl-riwayat-header-text">
            <h1 class="fl-riwayat-title">Detail Riwayat</h1>
            <p class="fl-riwayat-subtitle">Capaian harian saya</p>
        </div>
    </header>

    <section class="fl-dr-summary-card" aria-label="Ringkasan status laporan">
        <div class="fl-dr-summary-top">
            <h2 class="fl-dr-summary-title">Riwayat — {{ $item['short_date'] }}</h2>
            <span class="fl-history-badge {{ $isRevision ? 'badge-revisi' : 'badge-disetujui' }} ck-badge-upper">{{ $isRevision ? 'PERLU REVISI' : 'DISETUJUI' }}</span>
        </div>
        <div class="fl-dr-summary-time">
            @include('checklist.partials.icon', ['name' => 'clock', 'size' => 16])
            <span>Dikirim {{ $item['full_date'] }}, 21:05 WIB</span>
        </div>
    </section>

    @if ($isRevision)
        <section class="fl-dr-revision-card" aria-labelledby="heading-catatan-revisi">
            <div class="fl-dr-revision-header">
                <div class="fl-dr-revision-meta">
                    <span class="fl-dr-revision-label" id="heading-catatan-revisi">CATATAN REVISI</span>
                    <span class="fl-dr-revision-author">Diminta oleh: <strong>{{ $revision['requested_by'] }}</strong></span>
                </div>
                <span class="fl-dr-revision-time-chip">{{ $revision['requested_at'] }}</span>
            </div>
            <div class="fl-dr-revision-bubble">"{{ $revision['message'] }}"</div>
            <a href="{{ $revision['repair_url'] }}" class="fl-dr-btn-repair">
                <span>PERBAIKI CAPAIAN</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
    @endif

    <section aria-labelledby="heading-ringkasan-laporan">
        <div class="fl-dr-section-header">
            <h3 class="fl-dr-section-title" id="heading-ringkasan-laporan">RINGKASAN LAPORAN HARIAN</h3>
            <span class="fl-dr-section-count">{{ count($categories) }} Kategori</span>
        </div>

        <div class="fl-dr-categories-container">
            @foreach ($categories as $cat)
                <a href="{{ $cat['url'] }}" class="fl-dr-category-item {{ $cat['is_highlighted'] ? 'is-highlighted' : '' }}">
                    <div class="fl-dr-category-left">
                        <div class="driver-cat-icon-box {{ $cat['is_highlighted'] ? 'is-orange' : '' }}">
                            @include('checklist.partials.icon', ['name' => $cat['icon'], 'size' => 22])
                        </div>
                        <div class="fl-dr-category-info">
                            <div class="fl-dr-category-title-row">
                                <span class="fl-dr-category-title">{{ $cat['title'] }}</span>
                                @if ($cat['badge'])
                                    <span class="fl-dr-category-badge-warning">{{ $cat['badge'] }}</span>
                                @endif
                            </div>
                            <span class="fl-dr-category-sub">{{ $cat['subtitle'] }}</span>
                        </div>
                    </div>
                    <span class="fl-dr-category-chevron" aria-hidden="true">&#8250;</span>
                </a>
            @endforeach
        </div>
    </section>

    @if ($isRevision)
        <aside class="fl-dr-notice-card" role="note">
            <svg class="fl-dr-notice-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <p class="fl-dr-notice-text">Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.</p>
        </aside>
    @endif
@endsection
