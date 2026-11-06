<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Capaian Harian | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontliner.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol Panah Kembali + Judul Riwayat) -->
        <header class="fl-riwayat-header">
            <a href="{{ route('frontliner.dashboard') }}" class="fl-step-close-btn" aria-label="Kembali ke Beranda Dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>

            <div class="fl-riwayat-header-text">
                <h1 class="fl-riwayat-title">Riwayat</h1>
                <p class="fl-riwayat-subtitle">Capaian harian saya</p>
            </div>
        </header>

        @php
            $counts = $summary ?? $summaryCounts ?? ['disetujui' => 3, 'menunggu' => 1, 'revisi' => 2, 'semua' => 6];
            $items = $historyList ?? $riwayatList ?? [];
        @endphp

        <!-- 2. Summary Metric Cards Sesuai Desain Figma (3 Kolom: Disetujui, Menunggu, Revisi) -->
        <section class="fl-riwayat-metrics-grid" aria-label="Ringkasan Status Capaian">
            <!-- Disetujui -->
            <div class="fl-riwayat-metric-card" id="metric-disetujui" onclick="applyStatusFilter('disetujui')" role="button" tabindex="0" aria-label="Filter status Disetujui, total {{ $counts['disetujui'] ?? 3 }}">
                <div class="fl-riwayat-metric-header">
                    <span class="fl-dot-circle dot-green"></span>
                    <span class="fl-riwayat-metric-label">Disetujui</span>
                </div>
                <div class="fl-riwayat-metric-value">{{ $counts['disetujui'] ?? 3 }}</div>
            </div>

            <!-- Menunggu -->
            <div class="fl-riwayat-metric-card" id="metric-menunggu" onclick="applyStatusFilter('menunggu')" role="button" tabindex="0" aria-label="Filter status Menunggu, total {{ $counts['menunggu'] ?? 1 }}">
                <div class="fl-riwayat-metric-header">
                    <span class="fl-dot-circle dot-gray"></span>
                    <span class="fl-riwayat-metric-label">Menunggu</span>
                </div>
                <div class="fl-riwayat-metric-value">{{ $counts['menunggu'] ?? 1 }}</div>
            </div>

            <!-- Revisi -->
            <div class="fl-riwayat-metric-card" id="metric-revisi" onclick="applyStatusFilter('revisi')" role="button" tabindex="0" aria-label="Filter status Revisi, total {{ $counts['revisi'] ?? 2 }}">
                <div class="fl-riwayat-metric-header">
                    <span class="fl-dot-circle dot-amber"></span>
                    <span class="fl-riwayat-metric-label">Revisi</span>
                </div>
                <div class="fl-riwayat-metric-value">{{ $counts['revisi'] ?? 2 }}</div>
            </div>
        </section>

        <!-- 3. Category Filter Tabs Sesuai Desain Figma (Pill Chips) -->
        <nav class="fl-filter-chips-row" aria-label="Filter Riwayat Capaian">
            <button type="button" class="fl-filter-chip" data-status="semua" onclick="applyStatusFilter('semua')">
                Semua ({{ $counts['semua'] ?? 6 }})
            </button>
            <button type="button" class="fl-filter-chip is-active" data-status="disetujui" onclick="applyStatusFilter('disetujui')">
                Disetujui ({{ $counts['disetujui'] ?? 3 }})
            </button>
            <button type="button" class="fl-filter-chip" data-status="menunggu" onclick="applyStatusFilter('menunggu')">
                Menunggu ({{ $counts['menunggu'] ?? 1 }})
            </button>
            <button type="button" class="fl-filter-chip" data-status="revisi" onclick="applyStatusFilter('revisi')">
                Revisi ({{ $counts['revisi'] ?? 2 }})
            </button>
        </nav>

        <!-- 4. Daftar Riwayat Capaian Harian Sesuai Desain Figma (Halaman Riwayat .png) -->
        <main class="fl-history-list" id="historyListContainer" aria-label="Daftar Log Riwayat Capaian">
            @foreach($items as $item)
                @php
                    $fullDate = $item['date_formatted'] ?? $item['full_date'] ?? '24 Okt 2024';
                    $subInfo = $item['checklist_text'] ?? $item['category_info'] ?? '4/16 Checklist terisi';
                    $isRevisiItem = $item['status'] === 'revisi';
                @endphp
                <a href="{{ route('frontliner.riwayat.detail', ['id' => $item['id'], 'status' => $item['status']]) }}" class="fl-history-card-item" data-status="{{ $item['status'] }}" aria-label="Capaian {{ $fullDate }}, Status {{ $item['status_label'] }}">
                    <!-- Kolom Kiri: Tanggal Kalender (Nama Hari + Angka Hari) -->
                    <div class="fl-history-item-left">
                        <div class="fl-history-date-block">
                            <span class="fl-history-day-name">{{ $item['day_name'] }}</span>
                            <span class="fl-history-day-num">{{ $item['day_num'] }}</span>
                        </div>

                        <!-- Kolom Tengah: Tanggal Lengkap & Checklist Terisi -->
                        <div class="fl-history-meta">
                            <span class="fl-history-full-date">{{ $fullDate }}</span>
                            <span class="fl-history-category-info">{{ $subInfo }}</span>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Status Badge & Chevron Panah Kanan -->
                    <div class="fl-history-item-right">
                        <span class="fl-history-badge badge-{{ $item['status'] }}">{{ $item['status_label'] }}</span>
                        <span class="fl-history-chevron" aria-hidden="true">&#8250;</span>
                    </div>
                </a>
            @endforeach

            <!-- Empty State jika filter tidak menemukan data -->
            <div class="fl-history-empty" id="emptyState" style="display: none;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#a8a29e" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <p style="margin: 0; font-weight: 600; color: #57534e;">Tidak ada capaian dengan status ini</p>
                <p style="margin: 4px 0 0; font-size: 0.78rem; color: #a8a29e;">Pilih filter lain untuk melihat riwayat pengisian Anda.</p>
            </div>
        </main>

        <!-- 5. Kartu Legenda Status Sesuai Desain Figma (Indikator Bentuk Status) -->
        <footer class="fl-history-legend-card" aria-label="Legenda Bentuk Status">
            <div class="fl-history-legend-title">Indikator Bentuk Status:</div>
            <div class="fl-history-legend-items">
                <span class="fl-history-legend-item">
                    <span class="fl-dot-circle dot-green"></span>
                    <span>Hijau = Disetujui</span>
                </span>
                <span class="fl-history-legend-item">
                    <span class="fl-dot-circle dot-gray"></span>
                    <span>Abu-abu = Menunggu</span>
                </span>
                <span class="fl-history-legend-item">
                    <span class="fl-dot-circle dot-amber"></span>
                    <span>Kuning = Revisi</span>
                </span>
            </div>
        </footer>
    </div>

    <!-- Script Filter Interaktif Sesuai Figma -->
    <script>
        function applyStatusFilter(status) {
            const chips = document.querySelectorAll('.fl-filter-chip');
            chips.forEach(chip => {
                if (chip.getAttribute('data-status') === status) {
                    chip.classList.add('is-active');
                } else {
                    chip.classList.remove('is-active');
                }
            });

            const cards = document.querySelectorAll('.fl-history-card-item');
            let visibleCount = 0;

            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'semua' || cardStatus === status) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('emptyState');
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
            }
        }
    </script>
</body>

</html>
