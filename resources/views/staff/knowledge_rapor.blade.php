<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Product Knowledge | Capaian.id - KPI Wonosari</title>
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
        <h1 class="fl-detail-page-title">Product Knowledge</h1>

        <!-- 3. KARTU 1: Skor Terakhir Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-skor-terakhir">
            <div class="fl-step-card-header">
                <h2 class="fl-step-card-title" id="heading-skor-terakhir">Skor Terakhir</h2>
                <span class="fl-badge-grade">{{ $skorTerakhir['type_badge'] ?? 'BULANAN' }}</span>
            </div>

            <!-- Big Score 88 / 100 -->
            <div class="fl-knowledge-big-score">
                <span class="fl-knowledge-score-val">{{ $skorTerakhir['score'] ?? 88 }}</span>
                <span class="fl-knowledge-score-max">/ {{ $skorTerakhir['max'] ?? 100 }}</span>
            </div>

            <!-- Progress Bar Skor -->
            <div class="fl-omzet-progress-bar" role="progressbar" aria-valuenow="{{ $skorTerakhir['percentage'] ?? 88 }}" aria-valuemin="0" aria-valuemax="100">
                <div class="fl-omzet-progress-fill" style="width: {{ $skorTerakhir['percentage'] ?? 88 }}%;"></div>
            </div>

            <!-- Footer Penilai Store Manager -->
            <div class="fl-kasir-verifier-row" style="margin-top: 8px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>
                    Dinilai: <strong>{{ $skorTerakhir['evaluated_at'] ?? '15 Sep 2026' }}</strong> &middot; oleh <strong>{{ $skorTerakhir['evaluator'] ?? 'Siti (Store Manager)' }}</strong>
                </span>
            </div>
        </section>

        <!-- 4. KARTU 2: Rincian Penilaian Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-rincian-penilaian">
            <div class="fl-step-card-header" style="flex-direction: column; gap: 2px;">
                <h2 class="fl-step-card-title" id="heading-rincian-penilaian">Rincian Penilaian</h2>
                <p class="fl-step-card-sub" style="margin-top: 2px; margin-bottom: 4px;">Hasil observasi & evaluasi berkala</p>
            </div>

            <div class="fl-knowledge-criteria-list">
                @foreach ($rincianPenilaian as $kriteria)
                    <div class="fl-knowledge-criteria-item">
                        <div class="fl-criteria-top-row">
                            <span class="fl-criteria-title">{{ $kriteria['title'] }}</span>
                            <span class="fl-badge-grade">{{ $kriteria['badge'] }}</span>
                        </div>

                        <!-- 5 Segmen Bar Rating -->
                        <div class="fl-criteria-bars-row">
                            @for ($i = 1; $i <= $kriteria['max']; $i++)
                                <div class="fl-criteria-pill-segment {{ $i <= $kriteria['score'] ? 'is-active' : 'is-inactive' }}"></div>
                            @endfor
                            <span class="fl-criteria-score-text">{{ $kriteria['score'] }} / {{ $kriteria['max'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 5. KARTU 3: Penilaian Berikutnya Sesuai Figma -->
        <section class="fl-step-card" aria-labelledby="heading-penilaian-berikutnya">
            <div class="fl-step-card-header" style="justify-content: flex-start; align-items: center; gap: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9a3412" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <h2 class="fl-step-card-title" id="heading-penilaian-berikutnya">Penilaian Berikutnya</h2>
            </div>

            <div class="fl-next-eval-title">
                Estimasi: {{ $penilaianBerikutnya['estimasi'] ?? 'minggu ke-3 November 2026' }}
            </div>
            <p class="fl-next-eval-desc">
                {{ $penilaianBerikutnya['desc'] ?? 'Evaluasi dilakukan 2 bulan sekali melalui tes materi produk dan observasi langsung di counter.' }}
            </p>
        </section>

        <!-- 6. Kotak Informasi Catatan (Bawah Card 3) Sesuai Figma -->
        <div class="fl-info-card">
            <div class="fl-info-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </div>
            <span class="fl-info-text">
                Penilaian Product Knowledge dicatat oleh <strong>Store Manager secara berkala</strong>. Frontliner hanya dapat melihat rekapitulasi data hasil evaluasi.
            </span>
        </div>
    </div>
</body>

</html>

