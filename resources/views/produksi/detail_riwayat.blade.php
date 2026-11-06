<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Riwayat Produksi | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/produksi.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Panah Kembali + Judul Detail Riwayat) -->
        <header class="fl-riwayat-header">
            <a href="{{ route('produksi.riwayat') }}" class="fl-step-close-btn" aria-label="Kembali ke Daftar Riwayat Produksi">
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

        <!-- 2. KARTU 1: Ringkasan Riwayat Produksi (Riwayat - 24 Okt & Badge Status) -->
        <section class="fl-dr-summary-card" aria-label="Ringkasan Status Pengiriman">
            <div class="fl-dr-summary-top">
                <h2 class="fl-dr-summary-title">{{ $detailRiwayat['title'] ?? 'Riwayat — 24 Okt' }}</h2>
                @if(!empty($isRevision))
                    <span class="fl-history-badge badge-revisi" style="font-size: 0.72rem; padding: 4px 10px; text-transform: uppercase;">PERLU REVISI</span>
                @else
                    <span class="fl-history-badge badge-disetujui" style="font-size: 0.72rem; padding: 4px 10px; text-transform: uppercase;">DISETUJUI</span>
                @endif
            </div>

            <div class="fl-dr-summary-time">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>{{ $detailRiwayat['sent_at'] ?? 'Dikirim 24 Okt 2026, 21:05 WIB' }}</span>
            </div>
        </section>

        <!-- 3. KARTU 2: Catatan Revisi Sesuai Halaman Detail Riwayat Perlu Revisi.png -->
        @if(!empty($isRevision))
        <section class="fl-dr-revision-card" aria-labelledby="heading-catatan-revisi-produksi">
            <div class="fl-dr-revision-header">
                <div class="fl-dr-revision-meta">
                    <span class="fl-dr-revision-label" id="heading-catatan-revisi-produksi">{{ $detailRiwayat['revision_note']['label'] ?? 'CATATAN REVISI' }}</span>
                    <span class="fl-dr-revision-author">
                        Diminta oleh: <strong>{{ $detailRiwayat['revision_note']['requested_by'] ?? 'User (Store Manager)' }}</strong>
                    </span>
                </div>
                <span class="fl-dr-revision-time-chip">{{ $detailRiwayat['revision_note']['requested_at'] ?? '25 Okt, 08:30 WIB' }}</span>
            </div>

            <!-- Pesan Instruksi Revisi Produksi -->
            <div class="fl-dr-revision-bubble">
                "Foto bukti Hasil Produksi kurang jelas, mohon upload ulang."
            </div>

            <!-- Tombol Aksi Perbaiki Capaian -->
            <a href="{{ $detailRiwayat['revision_note']['repair_url'] ?? route('produksi.hasil_produksi') }}" class="fl-dr-btn-repair">
                <span>{{ $detailRiwayat['revision_note']['repair_label'] ?? 'PERBAIKI CAPAIAN' }}</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
        @endif

        <!-- 4. Section: Ringkasan Laporan Harian Sesuai Figma -->
        <section aria-labelledby="heading-ringkasan-laporan-produksi">
            <div class="fl-dr-section-header">
                <h3 class="fl-dr-section-title" id="heading-ringkasan-laporan-produksi">RINGKASAN LAPORAN HARIAN</h3>
                <span class="fl-dr-section-count">{{ $detailRiwayat['categories_summary']['total_label'] ?? '5 Kategori' }}</span>
            </div>

            <!-- Kontainer Kategori Produksi Sesuai Figma -->
            <div class="fl-dr-categories-container">
                @foreach($detailRiwayat['categories_summary']['items'] as $cat)
                    <a href="{{ $cat['url'] ?? '#' }}" class="fl-dr-category-item {{ $cat['is_highlighted'] ? 'is-highlighted' : '' }}" aria-label="Kategori {{ $cat['title'] }}">
                        <div class="fl-dr-category-left">
                            <div class="produksi-cat-icon-box {{ $cat['is_highlighted'] ? 'is-orange' : '' }}">
                                @if($cat['icon'] === 'box')
                                    <!-- Icon Box / 3D Cube (Hasil Produksi) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                    </svg>
                                @elseif($cat['icon'] === 'timer')
                                    <!-- Icon Stopwatch / Timer (Waktu & Alat) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="14" r="8"></circle>
                                        <line x1="12" y1="2" x2="12" y2="6"></line>
                                        <line x1="12" y1="14" x2="12" y2="10"></line>
                                    </svg>
                                @elseif($cat['icon'] === 'user')
                                    <!-- Icon User / Person (Kehadiran & Disiplin) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                @elseif($cat['icon'] === 'shield')
                                    <!-- Icon Shield (Kepatuhan SOP) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        <polyline points="9 12 11 14 15 10"></polyline>
                                    </svg>
                                @else
                                    <!-- Icon Sparkles (Kebersihan Area Kerja) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" />
                                    </svg>
                                @endif
                            </div>

                            <div class="fl-dr-category-info">
                                <div class="fl-dr-category-title-row">
                                    <span class="fl-dr-category-title">{{ $cat['title'] }}</span>
                                    @if(!empty($cat['badge']))
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

        <!-- 5. KARTU NOTIFIKASI BAWAH (Hanya jika perlu perbaikan) -->
        @if(!empty($isRevision))
        <aside class="fl-dr-notice-card" role="note">
            <svg class="fl-dr-notice-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <p class="fl-dr-notice-text">
                {{ $detailRiwayat['notice'] ?? 'Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.' }}
            </p>
        </aside>
        @endif

        <!-- Toggle Preview Status (Untuk Pengujian Status Disetujui vs Revisi) -->
        <div style="text-align: center; margin-top: 10px; margin-bottom: 24px; font-size: 0.78rem;">
            @if(empty($isRevision))
                <a href="{{ request()->fullUrlWithQuery(['status' => 'revisi']) }}" style="color: #ea580c; text-decoration: none; font-weight: 600;">
                    &bull; Lihat Tampilan State: Perlu Revisi &bull;
                </a>
            @else
                <a href="{{ request()->fullUrlWithQuery(['status' => 'disetujui']) }}" style="color: #22c55e; text-decoration: none; font-weight: 600;">
                    &bull; Lihat Tampilan State: Disetujui &bull;
                </a>
            @endif
        </div>
    </div>
</body>

</html>

