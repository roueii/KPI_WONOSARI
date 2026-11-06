<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Penjualan | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontliner.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Top Navigation Bar Sesuai Desain Figma (Tombol Kembali Panah Kiri) -->
        <header class="fl-detail-header">
            <a href="{{ route('staff.dashboard') }}" class="fl-step-close-btn" aria-label="Kembali ke beranda dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>

            <span class="fl-step-badge">FRONTLINER</span>
        </header>

        <!-- 2. Judul Halaman -->
        <h1 class="fl-detail-page-title">Penjualan</h1>

        <!-- 3. KARTU 1: Omzet Hari Ini Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-omzet-hari-ini">
            <div class="fl-step-card-header">
                <h2 class="fl-step-card-title" id="heading-omzet-hari-ini">Omzet Hari Ini</h2>
                <span class="fl-badge-auto">OTOMATIS</span>
            </div>

            <!-- Nominal Omzet -->
            <div class="fl-omzet-big-number">{{ $omzetData['total'] ?? 'Rp 2.500.000' }}</div>

            <!-- Target & Badge Persentase -->
            <div class="fl-omzet-meta-row">
                <span class="fl-omzet-target-text">
                    Target harian: <strong>{{ $omzetData['target'] ?? 'Rp 3.000.000' }}</strong>
                </span>
                <span class="fl-target-pill">{{ $omzetData['percentage_badge'] ?? '83.3% tercapai' }}</span>
            </div>

            <!-- Progress Bar Omzet -->
            <div class="fl-omzet-progress-bar" role="progressbar" aria-valuenow="{{ $omzetData['percentage'] ?? 83.3 }}" aria-valuemin="0" aria-valuemax="100">
                <div class="fl-omzet-progress-fill" style="width: {{ $omzetData['percentage'] ?? 83.3 }}%;"></div>
            </div>

            <!-- Sub Row Keterangan -->
            <div class="fl-omzet-sub-row">
                <span class="fl-omzet-remain-text">{{ $omzetData['kurang'] ?? 'Kurang Rp 500.000 untuk capai target' }}</span>
                <span class="fl-omzet-shift-text">{{ $omzetData['shift'] ?? 'Shift 1 & 2' }}</span>
            </div>
        </section>

        <!-- 4. KARTU 2: Kalkulasi Sistem Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-kalkulasi-sistem">
            <div class="fl-step-card-header">
                <h2 class="fl-step-card-title" id="heading-kalkulasi-sistem">Kalkulasi Sistem</h2>
                <span class="fl-badge-auto">OTOMATIS</span>
            </div>

            <div class="fl-calc-list">
                <!-- Baris 1: Pertumbuhan -->
                <div class="fl-calc-row">
                    <span class="fl-calc-label">Pertumbuhan vs bulan lalu</span>
                    <span class="fl-calc-value">
                        <span>{{ $kalkulasiData['growth'] ?? '+6%' }}</span>
                        <span style="font-size: 0.72rem; margin-left: 2px;">▲</span>
                    </span>
                </div>

                <!-- Baris 2: Average Basket -->
                <div class="fl-calc-row">
                    <span class="fl-calc-label">Rata-rata belanja (Average Basket)</span>
                    <span class="fl-calc-value">{{ $kalkulasiData['average_basket'] ?? 'Rp 45.000' }}</span>
                </div>
            </div>

            <!-- Catatan Kaki Otomatis -->
            <p class="fl-calc-footnote">{{ $kalkulasiData['note'] ?? '* Dihitung otomatis oleh sistem dari data transaksi kasir' }}</p>
        </section>

        <!-- 5. KARTU 3: Riwayat 7 Hari Terakhir Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-riwayat-omzet">
            <div class="fl-step-card-header" style="flex-direction: column; gap: 2px;">
                <h2 class="fl-step-card-title" id="heading-riwayat-omzet">Riwayat 7 Hari Terakhir</h2>
                <p class="fl-step-card-sub" style="margin-top: 2px; margin-bottom: 8px;">Tren capaian omzet sepekan terakhir</p>
            </div>

            <div class="fl-history-list" role="list" aria-label="Tren capaian omzet sepekan terakhir">
                @foreach ($riwayat7Hari as $item)
                    <div class="fl-history-row" role="listitem">
                        <!-- Hari & Tanggal -->
                        <span class="fl-history-day {{ $item['is_bold'] ? 'is-bold' : '' }}">
                            {{ $item['day'] }}
                        </span>

                        <!-- Mini Progress Bar Tren -->
                        <div class="fl-history-bar-track" aria-hidden="true">
                            <div class="fl-history-bar-fill" style="width: {{ $item['percent'] }}%;"></div>
                        </div>

                        <!-- Nominal Omzet -->
                        <span class="fl-history-amount">
                            {{ $item['amount'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 6. Kotak Informasi Catatan (Bawah Card 3) -->
        <div class="fl-info-card">
            <div class="fl-info-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </div>
            <span class="fl-info-text">
                Data penjualan diperbarui setiap pergantian shift oleh <strong>Store Manager</strong>. Jika terdapat ketidaksesuaian data transaksi, hubungi kasir utama atau supervisor.
            </span>
        </div>
    </div>
</body>

</html>

