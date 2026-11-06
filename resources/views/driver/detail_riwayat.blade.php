<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Riwayat Driver | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Panah Kembali + Judul Detail Riwayat) -->
        <header class="fl-riwayat-header">
            <a href="{{ route('driver.riwayat') }}" class="fl-step-close-btn" aria-label="Kembali ke Daftar Riwayat Driver">
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

        <!-- 2. KARTU 1: Ringkasan Riwayat Driver (Riwayat - 24 Okt & Badge Status) -->
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

        <!-- 3. KARTU 2: Catatan Revisi Sesuai Halaman Detail Riwayat Perlu Perbaikan.png (Jika Status Revisi) -->
        @if(!empty($isRevision))
        <section class="fl-dr-revision-card" aria-labelledby="heading-catatan-revisi-driver">
            <div class="fl-dr-revision-header">
                <div class="fl-dr-revision-meta">
                    <span class="fl-dr-revision-label" id="heading-catatan-revisi-driver">{{ $detailRiwayat['revision_note']['label'] ?? 'CATATAN REVISI' }}</span>
                    <span class="fl-dr-revision-author">
                        Diminta oleh: <strong>{{ $detailRiwayat['revision_note']['requested_by'] ?? 'User (Store Manager)' }}</strong>
                    </span>
                </div>
                <span class="fl-dr-revision-time-chip">{{ $detailRiwayat['revision_note']['requested_at'] ?? '25 Okt, 08:30 WIB' }}</span>
            </div>

            <!-- Pesan Instruksi Revisi Driver -->
            <div class="fl-dr-revision-bubble">
                "Foto bukti Ketepatan Pengiriman &amp; Keamanan Barang kurang jelas, mohon upload ulang."
            </div>

            <!-- Tombol Aksi Perbaiki Capaian -->
            <a href="{{ $detailRiwayat['revision_note']['repair_url'] ?? route('driver.pengiriman') }}" class="fl-dr-btn-repair">
                <span>{{ $detailRiwayat['revision_note']['repair_label'] ?? 'PERBAIKI CAPAIAN' }}</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
        @endif

        <!-- 4. Section: Ringkasan Laporan Harian Sesuai Figma -->
        <section aria-labelledby="heading-ringkasan-laporan-driver">
            <div class="fl-dr-section-header">
                <h3 class="fl-dr-section-title" id="heading-ringkasan-laporan-driver">RINGKASAN LAPORAN HARIAN</h3>
                <span class="fl-dr-section-count">{{ $detailRiwayat['categories_summary']['total_label'] ?? '4 Kategori' }}</span>
            </div>

            <!-- Kontainer Kategori Driver Sesuai Figma -->
            <div class="fl-dr-categories-container">
                @foreach($detailRiwayat['categories_summary']['items'] as $cat)
                    <a href="{{ $cat['url'] ?? '#' }}" class="fl-dr-category-item {{ $cat['is_highlighted'] ? 'is-highlighted' : '' }}" aria-label="Kategori {{ $cat['title'] }}">
                        <div class="fl-dr-category-left">
                            <div class="driver-cat-icon-box {{ $cat['is_highlighted'] ? 'is-orange' : '' }}">
                                @if($cat['icon'] === 'box')
                                    <!-- Icon Box / Package (Ketepatan Pengiriman & Keamanan) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                    </svg>
                                @elseif($cat['icon'] === 'document')
                                    <!-- Icon Document (SOP Administrasi) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                @elseif($cat['icon'] === 'truck')
                                    <!-- Icon Delivery Truck (Kendaraan & BBM) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="1" y="3" width="15" height="13"></rect>
                                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                    </svg>
                                @else
                                    <!-- Icon Headset (Disiplin & Pelayanan) -->
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
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
                    &bull; Lihat Tampilan State: Perlu Perbaikan (Revisi) &bull;
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

