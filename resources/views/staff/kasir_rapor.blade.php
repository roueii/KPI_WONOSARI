<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Akurasi Kasir | Capaian.id - KPI Wonosari</title>
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

        <!-- 2. Judul Halaman Sesuai Figma -->
        <h1 class="fl-detail-page-title">Akurasi Kasir</h1>

        <!-- 3. KARTU 1: Hari Ini Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-kasir-hari-ini">
            <div class="fl-step-card-header">
                <h2 class="fl-step-card-title" id="heading-kasir-hari-ini">Hari Ini</h2>
                <span class="fl-badge-auto">OTOMATIS</span>
            </div>

            <!-- Judul Besar Status Selisih Kas -->
            <div class="fl-omzet-big-number" style="font-size: 1.6rem; margin: 8px 0 2px;">
                {{ $hariIni['selisih'] ?? 'Selisih Kas: Rp 0' }}
            </div>

            <!-- Badge Akurat -->
            <span class="fl-badge-akurat">{{ $hariIni['status_badge'] ?? 'AKURAT' }}</span>

            <!-- Daftar Ceklis Verifikasi Kasir -->
            <div style="display: flex; flex-direction: column;">
                @foreach ($hariIni['checks'] as $check)
                    <div class="fl-kasir-check-row">
                        <span>{{ $check['label'] }}</span>
                        <svg class="fl-icon-circle-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="16 9 10 15 7 12"></polyline>
                        </svg>
                    </div>
                @endforeach
            </div>

            <!-- Footer Verifier Store Manager -->
            <div class="fl-kasir-verifier-row">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>{{ $hariIni['verifier'] ?? 'Diisi oleh Siti (Store Manager), 24 Okt 09:15' }}</span>
            </div>
        </section>

        <!-- 4. KARTU 2: Riwayat 7 Hari Terakhir Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-riwayat-kasir">
            <div class="fl-step-card-header" style="flex-direction: column; gap: 2px;">
                <h2 class="fl-step-card-title" id="heading-riwayat-kasir">Riwayat 7 Hari Terakhir</h2>
                <p class="fl-step-card-sub" style="margin-top: 2px; margin-bottom: 4px;">Catatan selisih kas harian saat tutup shift</p>
            </div>

            <div class="fl-kasir-history-list" role="list" aria-label="Riwayat selisih kas sepekan terakhir">
                @foreach ($riwayat7Hari as $item)
                    <div class="fl-kasir-history-item" role="listitem">
                        <!-- Sisi Kiri: Hari & Subketerangan -->
                        <div class="fl-kasir-item-left">
                            <span class="fl-kasir-item-day {{ $item['is_bold'] ? 'is-bold' : '' }}">
                                {{ $item['day'] }}
                            </span>
                            @if ($item['sub'])
                                <span class="fl-kasir-item-sub">{{ $item['sub'] }}</span>
                            @endif
                        </div>

                        <!-- Sisi Kanan: Status Selisih & Ikon Indikator -->
                        <div class="fl-kasir-item-right">
                            <span class="fl-kasir-amount-text {{ !$item['is_accurate'] ? 'is-negative' : '' }}">
                                {{ $item['status'] }}
                            </span>

                            @if ($item['is_accurate'])
                                <!-- Ikon Centang Hijau Lingkaran -->
                                <svg class="fl-icon-circle-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="16 9 10 15 7 12"></polyline>
                                </svg>
                            @else
                                <!-- Ikon Silang Merah/Oranye Lingkaran (Seperti pada Rabu, 20 Mar) -->
                                <div class="fl-icon-circle-cross" aria-label="Terdapat selisih">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 5. Kotak Informasi Catatan (Bawah Card 2) Sesuai Figma -->
        <div class="fl-info-card">
            <div class="fl-info-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </div>
            <span class="fl-info-text">
                Verifikasi akurasi kasir dicatat oleh Store Manager saat perhitungan fisik uang kas (closing kasir). Frontliner hanya dapat melihat rekapitulasi data.
            </span>
        </div>
    </div>
</body>

</html>

