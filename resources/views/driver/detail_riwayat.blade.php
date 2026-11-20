<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Riwayat Driver | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Panah Kembali + Judul Detail Riwayat) -->
        <header class="fl-riwayat-header">
            <a href="{{ route('driver.riwayat') }}" class="fl-step-close-btn" aria-label="Kembali ke Daftar Riwayat Driver">
                <x-icon name="arrow-left" />
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
                    <span class="fl-history-badge badge-revisi" style="font-size: var(--fs-12); padding: 4px 10px; text-transform: uppercase;">PERLU REVISI</span>
                @else
                    <span class="fl-history-badge badge-disetujui" style="font-size: var(--fs-12); padding: 4px 10px; text-transform: uppercase;">DISETUJUI</span>
                @endif
            </div>

            <div class="fl-dr-summary-time">
                <x-icon name="clock" width="16" height="16" aria-hidden="true" />
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
                                    <x-icon name="box-iso" width="22" height="22" />
                                @elseif($cat['icon'] === 'document')
                                    <!-- Icon Document (SOP Administrasi) -->
                                    <x-icon name="page" width="22" height="22" />
                                @elseif($cat['icon'] === 'truck')
                                    <!-- Icon Delivery Truck (Kendaraan & BBM) -->
                                    <x-icon name="truck" width="22" height="22" />
                                @else
                                    <!-- Icon Headset (Disiplin & Pelayanan) -->
                                    <x-icon name="headset-help" width="22" height="22" />
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
            <x-icon name="info-empty" class="fl-dr-notice-icon" width="20" height="20" aria-hidden="true" />
            <p class="fl-dr-notice-text">
                {{ $detailRiwayat['notice'] ?? 'Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.' }}
            </p>
        </aside>
        @endif

        <!-- Toggle Preview Status (Untuk Pengujian Status Disetujui vs Revisi) -->
        <div style="text-align: center; margin-top: 10px; margin-bottom: 24px; font-size: var(--fs-12);">
            @if(empty($isRevision))
                <a href="{{ request()->fullUrlWithQuery(['status' => 'revisi']) }}" style="color: var(--primary-600); text-decoration: none; font-weight: 600;">
                    &bull; Lihat Tampilan State: Perlu Perbaikan (Revisi) &bull;
                </a>
            @else
                <a href="{{ request()->fullUrlWithQuery(['status' => 'disetujui']) }}" style="color: var(--success-500); text-decoration: none; font-weight: 600;">
                    &bull; Lihat Tampilan State: Disetujui &bull;
                </a>
            @endif
        </div>
    </div>
</body>

</html>

