<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Riwayat | Frontliner Capaian.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontliner.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Panah Kembali + Judul Detail Riwayat) -->
        <header class="fl-riwayat-header">
            <a href="{{ route('frontliner.riwayat') }}" class="fl-step-close-btn" aria-label="Kembali ke Daftar Riwayat">
                <x-icon name="arrow-left" />
            </a>

            <div class="fl-riwayat-header-text">
                <h1 class="fl-riwayat-title">Detail Riwayat</h1>
                <p class="fl-riwayat-subtitle">Capaian harian saya</p>
            </div>
        </header>

        @php
            $isRevisi = $reportMeta['is_revisi'] ?? false;
        @endphp

        <!-- 2. KARTU 1: Ringkasan Riwayat Sesuai Desain Figma Revisi -->
        <section class="fl-dr-summary-card" style="background: var(--neutral-50); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 18px; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                <h2 style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">{{ $reportMeta['title'] ?? 'Riwayat — 24 Okt' }}</h2>
                @if($isRevisi)
                <span style="border: 1px solid var(--primary-600); background: var(--primary-600); color: var(--white); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 4px 10px; border-radius: 8px; letter-spacing: 0.04em;">PERLU REVISI</span>
                @else
                <span style="border: 1px solid var(--success-500); background: var(--success-500); color: var(--white); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 4px 10px; border-radius: 8px; letter-spacing: 0.04em;">DISETUJUI</span>
                @endif
            </div>

            <div style="display: flex; align-items: center; gap: 6px; font-size: var(--fs-12); color: var(--neutral-500); margin-top: 8px;">
                <x-icon name="clock" width="15" height="15" />
                <span>{{ $reportMeta['submitted_at'] ?? 'Dikirim 24 Okt 2026, 21:05 WIB' }}</span>
            </div>
        </section>

        @if($isRevisi)
        <!-- 3. KARTU 2: Catatan Revisi Sesuai Halaman Detail Riwayat perlu revisi.png -->
        <section style="background: var(--white); border: 2px solid var(--primary-500); border-radius: 18px; padding: 18px; margin-bottom: 20px; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.08);" aria-labelledby="heading-catatan-revisi">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; border-bottom: 1px solid var(--secondary-100); padding-bottom: 12px; margin-bottom: 14px;">
                <div>
                    <span style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-500); text-transform: uppercase; letter-spacing: 0.04em; display: block;" id="heading-catatan-revisi">CATATAN REVISI</span>
                    <span style="font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900); margin-top: 2px; display: block;">Diminta oleh: <strong>{{ $revisionNote['requester'] ?? 'User (Store Manager)' }}</strong></span>
                </div>
                <span style="border: 1px solid var(--secondary-100); background: var(--neutral-50); color: var(--neutral-500); font-size: var(--fs-12); font-weight: 600; padding: 3px 8px; border-radius: 6px;">{{ $revisionNote['time'] ?? '25 Okt, 08:30 WIB' }}</span>
            </div>

            <!-- Pesan Instruksi Revisi -->
            <div style="background: var(--white); border: 1px solid var(--secondary-100); border-radius: 12px; padding: 14px; font-size: var(--fs-14); color: var(--neutral-900); line-height: 1.45; margin-bottom: 16px;">
                {{ $revisionNote['text'] ?? '"Foto bukti Penjualan kurang jelas, mohon upload ulang."' }}
            </div>

            <!-- Tombol Aksi Perbaiki Capaian -->
            <a href="{{ $revisionNote['cta_url'] ?? route('frontliner.penjualan') }}" style="background: var(--primary-500); color: var(--white); border-radius: 12px; padding: 14px; font-size: var(--fs-14); font-weight: var(--fw-semibold); text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.28);">
                <span>{{ $revisionNote['cta_title'] ?? 'PERBAIKI CAPAIAN' }}</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
        @endif

        <!-- 4. Section: Ringkasan Laporan Harian Sesuai Figma Revisi (6 Kategori) -->
        <section aria-labelledby="heading-ringkasan-laporan" style="margin-bottom: 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <h3 style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-500); text-transform: uppercase; letter-spacing: 0.05em; margin: 0;" id="heading-ringkasan-laporan">RINGKASAN LAPORAN HARIAN</h3>
                <span style="font-size: var(--fs-12); font-weight: 600; color: var(--neutral-500);">{{ $isRevisi ? '4 Kategori' : '5 Kategori' }}</span>
            </div>

            <!-- Kontainer Terbungkus untuk 6 Kategori Sesuai Figma Revisi -->
            <div style="background: var(--white); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 12px; display: flex; flex-direction: column; gap: 8px;">
                @foreach($categories as $cat)
                <a href="{{ $cat['url'] ?? '#' }}" class="fl-detail-category-card {{ $cat['is_revisi'] ? 'is-revisi' : '' }}" style="{{ $cat['is_revisi'] ? 'border: 2px solid var(--primary-500); background: var(--neutral-50);' : '' }}">
                    <div class="fl-detail-cat-left">
                        <div class="fl-detail-cat-icon">
                            @if($cat['icon'] === 'cash')
                                <!-- Cash / Penjualan -->
                                <x-icon name="cash" width="20" height="20" />
                            @elseif($cat['icon'] === 'headset')
                                <!-- Headset / Pelayanan -->
                                <x-icon name="headset-help" width="20" height="20" />
                            @elseif($cat['icon'] === 'lightbulb')
                                <!-- Lightbulb / Product Knowledge -->
                                <x-icon name="light-bulb" width="20" height="20" />
                            @elseif($cat['icon'] === 'calculator')
                                <!-- Calculator / Akurasi Kasir -->
                                <x-icon name="calculator" width="20" height="20" />
                            @elseif($cat['icon'] === 'sparkles')
                                <!-- Sparkles / Display & Kebersihan -->
                                <x-icon name="sparks" width="20" height="20" />
                            @else
                                <!-- Shield Check / Kepatuhan SOP & Disiplin -->
                                <x-icon name="shield-check" width="20" height="20" />
                            @endif
                        </div>

                        <div class="fl-detail-cat-info">
                            <div class="fl-detail-cat-title-row">
                                <h4 class="fl-detail-cat-title">{{ $cat['name'] }}</h4>
                                @if($cat['is_revisi'])
                                <span style="background: var(--primary-600); color: var(--white); font-size: var(--fs-10); font-weight: var(--fw-semibold); padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">PERLU REVISI</span>
                                @endif
                            </div>
                            <span class="fl-detail-cat-sub {{ $cat['is_revisi'] ? 'text-revisi' : '' }}">{{ $cat['subtitle'] }}</span>
                        </div>
                    </div>

                    <x-icon name="nav-arrow-right" width="18" height="18" style="color: var(--neutral-500);" />
                </a>
                @endforeach
            </div>
        </section>

        @if($isRevisi)
        <!-- 5. Bottom Notice Card Sesuai Figma Revisi -->
        <div style="border: 1px solid var(--secondary-100); border-radius: 14px; background: var(--neutral-50); padding: 14px; display: flex; align-items: flex-start; gap: 10px; margin-bottom: 24px;">
            <x-icon name="info-empty" width="20" height="20" style="flex-shrink: 0; margin-top: 2px; color: var(--neutral-500);" />
            <p style="font-size: var(--fs-12); color: var(--neutral-600); line-height: 1.45; margin: 0;">
                Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.
            </p>
        </div>
        @endif
    </div>
</body>

</html>
