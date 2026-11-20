<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Riwayat | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Sesuai Desain Figma Halaman Detail Riwayat.png -->
        <header class="fl-top-nav" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <a href="{{ route('storemanager.riwayat') }}" class="fl-nav-back-btn" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid var(--secondary-100); background: var(--white); display: flex; align-items: center; justify-content: center; color: var(--neutral-900); text-decoration: none;" aria-label="Kembali ke Riwayat">
                    <x-icon name="arrow-left" width="20" height="20" />
                </a>
                <div>
                    <h1 style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Detail Riwayat</h1>
                    <span style="font-size: var(--fs-12); color: var(--neutral-500);">Capaian harian saya</span>
                </div>
            </div>
        </header>

        <!-- 2. Kartu Status Riwayat Utama Sesuai Figma -->
        <section style="background: var(--white); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 18px; margin-bottom: 16px;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 6px;">
                <h2 style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">{{ $reportMeta['title'] ?? 'Riwayat — 24 Okt' }}</h2>
                @if(!empty($reportMeta['is_revisi']))
                <span style="background: var(--primary-50); border: 1.5px solid var(--primary-600); color: var(--primary-700); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 3px 10px; border-radius: 8px;">
                    PERLU REVISI
                </span>
                @else
                <span style="background: var(--success-100); border: 1px solid var(--success-500); color: var(--success-700); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 3px 10px; border-radius: 8px;">
                    DISETUJUI
                </span>
                @endif
            </div>

            <div style="display: flex; align-items: center; gap: 6px; font-size: var(--fs-12); color: var(--neutral-500);">
                <x-icon name="clock" width="14" height="14" />
                <span>{{ $reportMeta['submitted_at'] ?? 'Dikirim 24 Okt 2026, 21:05 WIB' }}</span>
            </div>
        </section>

        <!-- 3. Kotak Catatan Revisi (Muncul saat status Revisi Sesuai Halaman Detail Riwayat Perlu Revisi.png) -->
        @if(!empty($reportMeta['is_revisi']))
        <section style="background: var(--neutral-50); border: 1.5px solid var(--primary-500); border-radius: 18px; padding: 18px; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4px;">
                <span style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-500); letter-spacing: 0.05em;">CATATAN REVISI</span>
                <span style="background: var(--secondary-100); font-size: var(--fs-12); font-weight: 600; color: var(--neutral-500); padding: 2px 8px; border-radius: 6px;">{{ $revisionNote['time'] ?? '25 Okt, 08:30 WIB' }}</span>
            </div>
            <div style="font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900); margin-bottom: 12px;">
                Diminta oleh: {{ $revisionNote['requester'] ?? 'User (Store Manager)' }}
            </div>

            <div style="background: var(--white); border: 1px solid var(--secondary-100); border-radius: 12px; padding: 14px; margin-bottom: 16px; font-size: var(--fs-14); color: var(--neutral-900); line-height: 1.45;">
                {{ $revisionNote['text'] ?? '"Foto bukti Penjualan kurang jelas, mohon upload ulang."' }}
            </div>

            <a href="{{ $revisionNote['cta_url'] ?? route('storemanager.penjualan') }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box; padding: 14px; border-radius: 14px; background: var(--primary-500); color: var(--white); font-size: var(--fs-14); font-weight: var(--fw-semibold); text-decoration: none; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.32);">
                <span>{{ $revisionNote['cta_title'] ?? 'PERBAIKI CAPAIAN' }}</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </section>
        @endif

        <!-- 4. Ringkasan Laporan Harian (5 Kategori) Sesuai Figma -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; font-size: var(--fs-12); font-weight: var(--fw-semibold);">
            <span style="color: var(--neutral-500); letter-spacing: 0.04em;">RINGKASAN LAPORAN HARIAN</span>
            <span style="color: var(--neutral-500);">5 Kategori</span>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
            @foreach($categories as $cat)
            <a href="{{ $cat['url'] }}" style="display: flex; align-items: center; justify-content: space-between; background: var(--white); border: {{ !empty($cat['is_revisi']) ? '1.5px solid var(--primary-500)' : '1px solid var(--secondary-100)' }}; border-radius: 16px; padding: 14px 16px; text-decoration: none; color: inherit; transition: all 0.2s ease;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <!-- Ikon Kategori -->
                    <div style="width: 40px; height: 40px; border-radius: 12px; background: {{ !empty($cat['is_revisi']) ? 'var(--primary-50)' : 'var(--secondary-50)' }}; color: {{ !empty($cat['is_revisi']) ? 'var(--primary-600)' : 'var(--neutral-500)' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        @if($cat['icon'] === 'cash')
                        <x-icon name="dollar" width="20" height="20" />
                        @elseif($cat['icon'] === 'trend')
                        <x-icon name="graph-up" width="20" height="20" />
                        @elseif($cat['icon'] === 'headset')
                        <x-icon name="headset-help" width="20" height="20" />
                        @elseif($cat['icon'] === 'users')
                        <x-icon name="group" width="20" height="20" />
                        @else
                        <x-icon name="star" width="20" height="20" />
                        @endif
                    </div>

                    <div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900);">{{ $cat['name'] }}</span>
                            @if(!empty($cat['is_revisi']))
                            <span style="background: var(--warning-500); color: var(--white); font-size: var(--fs-10); font-weight: var(--fw-semibold); padding: 2px 8px; border-radius: 6px;">PERLU REVISI</span>
                            @endif
                        </div>
                        <span style="display: block; font-size: var(--fs-12); color: {{ !empty($cat['is_revisi']) ? 'var(--primary-600)' : 'var(--neutral-500)' }}; font-weight: {{ !empty($cat['is_revisi']) ? '600' : '400' }}; margin-top: 2px;">
                            {{ $cat['subtitle'] }}
                        </span>
                    </div>
                </div>

                <x-icon name="nav-arrow-right" width="18" height="18" style="color: var(--neutral-400);" />
            </a>
            @endforeach
        </div>

        <!-- 5. Informasi Bantuan Revisi Sesuai Figma -->
        @if(!empty($reportMeta['is_revisi']))
        <div style="display: flex; align-items: flex-start; gap: 10px; padding: 14px; background: var(--secondary-50); border: 1px solid var(--primary-200); border-radius: 14px; font-size: var(--fs-12); color: var(--neutral-500); line-height: 1.45; margin-bottom: 28px;">
            <x-icon name="info-empty" width="18" height="18" style="flex-shrink: 0; margin-top: 2px; color: var(--primary-600);" />
            <span>Catatan: Laporan ini perlu direvisi sesuai catatan Store Manager. Perubahan hanya dibuka untuk kategori yang membutuhkan perbaikan.</span>
        </div>
        @endif
    </div>
</body>

</html>

