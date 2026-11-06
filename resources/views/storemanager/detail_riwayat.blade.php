<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Riwayat | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Sesuai Desain Figma Halaman Detail Riwayat.png -->
        <header class="fl-top-nav" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <a href="{{ route('storemanager.riwayat') }}" class="fl-nav-back-btn" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid #ebdcd0; background: #ffffff; display: flex; align-items: center; justify-content: center; color: #1c1917; text-decoration: none;" aria-label="Kembali ke Riwayat">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 style="font-size: 1.35rem; font-weight: 800; color: #1c1917; margin: 0;">Detail Riwayat</h1>
                    <span style="font-size: 0.8rem; color: #78716c;">Capaian harian saya</span>
                </div>
            </div>
        </header>

        <!-- 2. Kartu Status Riwayat Utama Sesuai Figma -->
        <section style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 18px; padding: 18px; margin-bottom: 16px;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 6px;">
                <h2 style="font-size: 1.25rem; font-weight: 800; color: #1c1917; margin: 0;">{{ $reportMeta['title'] ?? 'Riwayat — 24 Okt' }}</h2>
                @if(!empty($reportMeta['is_revisi']))
                <span style="background: #fff7ed; border: 1.5px solid #ea580c; color: #c2410c; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 8px;">
                    PERLU REVISI
                </span>
                @else
                <span style="background: #dcfce7; border: 1px solid #86efac; color: #166534; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 8px;">
                    DISETUJUI
                </span>
                @endif
            </div>

            <div style="display: flex; align-items: center; gap: 6px; font-size: 0.76rem; color: #78716c;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>{{ $reportMeta['submitted_at'] ?? 'Dikirim 24 Okt 2026, 21:05 WIB' }}</span>
            </div>
        </section>

        <!-- 3. Kotak Catatan Revisi (Muncul saat status Revisi Sesuai Halaman Detail Riwayat Perlu Revisi.png) -->
        @if(!empty($reportMeta['is_revisi']))
        <section style="background: #fffdfa; border: 1.5px solid #f97316; border-radius: 18px; padding: 18px; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4px;">
                <span style="font-size: 0.72rem; font-weight: 800; color: #78716c; letter-spacing: 0.05em;">CATATAN REVISI</span>
                <span style="background: #f4ebe2; font-size: 0.7rem; font-weight: 600; color: #78716c; padding: 2px 8px; border-radius: 6px;">{{ $revisionNote['time'] ?? '25 Okt, 08:30 WIB' }}</span>
            </div>
            <div style="font-size: 0.84rem; font-weight: 800; color: #1c1917; margin-bottom: 12px;">
                Diminta oleh: {{ $revisionNote['requester'] ?? 'User (Store Manager)' }}
            </div>

            <div style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 12px; padding: 14px; margin-bottom: 16px; font-size: 0.84rem; color: #1c1917; line-height: 1.45;">
                {{ $revisionNote['text'] ?? '"Foto bukti Penjualan kurang jelas, mohon upload ulang."' }}
            </div>

            <a href="{{ $revisionNote['cta_url'] ?? route('storemanager.penjualan') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box; padding: 14px; border-radius: 14px; background: #f97316; color: #ffffff; font-size: 0.9rem; font-weight: 800; text-decoration: none; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.32);">
                <span>{{ $revisionNote['cta_title'] ?? 'PERBAIKI CAPAIAN' }}</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
        @endif

        <!-- 4. Ringkasan Laporan Harian (5 Kategori) Sesuai Figma -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; font-size: 0.8rem; font-weight: 700;">
            <span style="color: #78716c; letter-spacing: 0.04em;">RINGKASAN LAPORAN HARIAN</span>
            <span style="color: #78716c;">5 Kategori</span>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
            @foreach($categories as $cat)
            <a href="{{ $cat['url'] }}" style="display: flex; align-items: center; justify-content: space-between; background: #ffffff; border: {{ !empty($cat['is_revisi']) ? '1.5px solid #f97316' : '1px solid #ebdcd0' }}; border-radius: 16px; padding: 14px 16px; text-decoration: none; color: inherit; transition: all 0.2s ease;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <!-- Ikon Kategori -->
                    <div style="width: 40px; height: 40px; border-radius: 12px; background: {{ !empty($cat['is_revisi']) ? '#fff7ed' : '#faf6f0' }}; color: {{ !empty($cat['is_revisi']) ? '#ea580c' : '#78716c' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        @if($cat['icon'] === 'cash')
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        @elseif($cat['icon'] === 'trend')
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                        @elseif($cat['icon'] === 'headset')
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        </svg>
                        @elseif($cat['icon'] === 'users')
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        @else
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        @endif
                    </div>

                    <div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-size: 0.92rem; font-weight: 800; color: #1c1917;">{{ $cat['name'] }}</span>
                            @if(!empty($cat['is_revisi']))
                            <span style="background: #f59e0b; color: #ffffff; font-size: 0.66rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">PERLU REVISI</span>
                            @endif
                        </div>
                        <span style="display: block; font-size: 0.74rem; color: {{ !empty($cat['is_revisi']) ? '#ea580c' : '#78716c' }}; font-weight: {{ !empty($cat['is_revisi']) ? '600' : '400' }}; margin-top: 2px;">
                            {{ $cat['subtitle'] }}
                        </span>
                    </div>
                </div>

                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a8a29e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
            @endforeach
        </div>

        <!-- 5. Informasi Bantuan Revisi Sesuai Figma -->
        @if(!empty($reportMeta['is_revisi']))
        <div style="display: flex; align-items: flex-start; gap: 10px; padding: 14px; background: #fff8f3; border: 1px solid #fed7aa; border-radius: 14px; font-size: 0.76rem; color: #78716c; line-height: 1.45; margin-bottom: 28px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <span>Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.</span>
        </div>
        @endif
    </div>
</body>

</html>

