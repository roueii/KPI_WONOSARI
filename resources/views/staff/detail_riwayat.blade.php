<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Riwayat | Frontliner Capaian.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontliner.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Panah Kembali + Judul Detail Riwayat) -->
        <header class="fl-riwayat-header">
            <a href="{{ route('frontliner.riwayat') }}" class="fl-step-close-btn" aria-label="Kembali ke Daftar Riwayat">
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

        @php
            $isRevisi = $reportMeta['is_revisi'] ?? false;
        @endphp

        <!-- 2. KARTU 1: Ringkasan Riwayat Sesuai Desain Figma Revisi -->
        <section class="fl-dr-summary-card" style="background: #fffdfa; border: 1px solid #ebdcd0; border-radius: 18px; padding: 18px; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                <h2 style="font-size: 1.25rem; font-weight: 800; color: #1c1917; margin: 0;">{{ $reportMeta['title'] ?? 'Riwayat — 24 Okt' }}</h2>
                @if($isRevisi)
                <span style="border: 1px solid #ea580c; background: #ea580c; color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 8px; letter-spacing: 0.04em;">PERLU REVISI</span>
                @else
                <span style="border: 1px solid #22c55e; background: #22c55e; color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 8px; letter-spacing: 0.04em;">DISETUJUI</span>
                @endif
            </div>

            <div style="display: flex; align-items: center; gap: 6px; font-size: 0.78rem; color: #78716c; margin-top: 8px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>{{ $reportMeta['submitted_at'] ?? 'Dikirim 24 Okt 2026, 21:05 WIB' }}</span>
            </div>
        </section>

        @if($isRevisi)
        <!-- 3. KARTU 2: Catatan Revisi Sesuai Halaman Detail Riwayat perlu revisi.png -->
        <section style="background: #ffffff; border: 2px solid #f97316; border-radius: 18px; padding: 18px; margin-bottom: 20px; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.08);" aria-labelledby="heading-catatan-revisi">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; border-bottom: 1px solid #f3ece5; padding-bottom: 12px; margin-bottom: 14px;">
                <div>
                    <span style="font-size: 0.75rem; font-weight: 800; color: #78716c; text-transform: uppercase; letter-spacing: 0.04em; display: block;" id="heading-catatan-revisi">CATATAN REVISI</span>
                    <span style="font-size: 0.82rem; font-weight: 700; color: #1c1917; margin-top: 2px; display: block;">Diminta oleh: <strong>{{ $revisionNote['requester'] ?? 'User (Store Manager)' }}</strong></span>
                </div>
                <span style="border: 1px solid #ebdcd0; background: #fffdfa; color: #78716c; font-size: 0.72rem; font-weight: 600; padding: 3px 8px; border-radius: 6px;">{{ $revisionNote['time'] ?? '25 Okt, 08:30 WIB' }}</span>
            </div>

            <!-- Pesan Instruksi Revisi -->
            <div style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 12px; padding: 14px; font-size: 0.82rem; color: #1c1917; line-height: 1.45; margin-bottom: 16px;">
                {{ $revisionNote['text'] ?? '"Foto bukti Penjualan kurang jelas, mohon upload ulang."' }}
            </div>

            <!-- Tombol Aksi Perbaiki Capaian -->
            <a href="{{ $revisionNote['cta_url'] ?? route('frontliner.penjualan') }}" style="background: #f97316; color: #ffffff; border-radius: 12px; padding: 14px; font-size: 0.88rem; font-weight: 800; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.28);">
                <span>{{ $revisionNote['cta_title'] ?? 'PERBAIKI CAPAIAN' }}</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
        @endif

        <!-- 4. Section: Ringkasan Laporan Harian Sesuai Figma Revisi (6 Kategori) -->
        <section aria-labelledby="heading-ringkasan-laporan" style="margin-bottom: 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                <h3 style="font-size: 0.8rem; font-weight: 800; color: #78716c; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;" id="heading-ringkasan-laporan">RINGKASAN LAPORAN HARIAN</h3>
                <span style="font-size: 0.78rem; font-weight: 600; color: #78716c;">{{ $isRevisi ? '4 Kategori' : '5 Kategori' }}</span>
            </div>

            <!-- Kontainer Terbungkus untuk 6 Kategori Sesuai Figma Revisi -->
            <div style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 18px; padding: 12px; display: flex; flex-direction: column; gap: 8px;">
                @foreach($categories as $cat)
                <a href="{{ $cat['url'] ?? '#' }}" class="fl-detail-category-card {{ $cat['is_revisi'] ? 'is-revisi' : '' }}" style="{{ $cat['is_revisi'] ? 'border: 2px solid #f97316; background: #fffcf9;' : '' }}">
                    <div class="fl-detail-cat-left">
                        <div class="fl-detail-cat-icon">
                            @if($cat['icon'] === 'cash')
                                <!-- Cash / Penjualan -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M6 12h.01M18 12h.01"></path>
                                </svg>
                            @elseif($cat['icon'] === 'headset')
                                <!-- Headset / Pelayanan -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                </svg>
                            @elseif($cat['icon'] === 'lightbulb')
                                <!-- Lightbulb / Product Knowledge -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 18h6"></path>
                                    <path d="M10 22h4"></path>
                                    <path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5.76.76 1.23 1.52 1.41 2.5"></path>
                                </svg>
                            @elseif($cat['icon'] === 'calculator')
                                <!-- Calculator / Akurasi Kasir -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="4" y="2" width="16" height="20" rx="2"></rect>
                                    <line x1="8" y1="6" x2="16" y2="6"></line>
                                    <line x1="16" y1="14" x2="16" y2="18"></line>
                                    <path d="M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M8 18h.01M12 18h.01"></path>
                                </svg>
                            @elseif($cat['icon'] === 'sparkles')
                                <!-- Sparkles / Display & Kebersihan -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3l1.912 5.813a2 2 0 0 0 1.275 1.275L21 12l-5.813 1.912a2 2 0 0 0-1.275 1.275L12 21l-1.912-5.813a2 2 0 0 0-1.275-1.275L3 12l5.813-1.912a2 2 0 0 0 1.275-1.275L12 3z"></path>
                                </svg>
                            @else
                                <!-- Shield Check / Kepatuhan SOP & Disiplin -->
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    <polyline points="9 12 11 14 15 10"></polyline>
                                </svg>
                            @endif
                        </div>

                        <div class="fl-detail-cat-info">
                            <div class="fl-detail-cat-title-row">
                                <h4 class="fl-detail-cat-title">{{ $cat['name'] }}</h4>
                                @if($cat['is_revisi'])
                                <span style="background: #ea580c; color: #ffffff; font-size: 0.65rem; font-weight: 800; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">PERLU REVISI</span>
                                @endif
                            </div>
                            <span class="fl-detail-cat-sub {{ $cat['is_revisi'] ? 'text-revisi' : '' }}">{{ $cat['subtitle'] }}</span>
                        </div>
                    </div>

                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#78716c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
                @endforeach
            </div>
        </section>

        @if($isRevisi)
        <!-- 5. Bottom Notice Card Sesuai Figma Revisi -->
        <div style="border: 1px solid #ebdcd0; border-radius: 14px; background: #fffcf9; padding: 14px; display: flex; align-items: flex-start; gap: 10px; margin-bottom: 24px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#78716c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <p style="font-size: 0.78rem; color: #57534e; line-height: 1.45; margin: 0;">
                Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.
            </p>
        </div>
        @endif
    </div>
</body>

</html>
