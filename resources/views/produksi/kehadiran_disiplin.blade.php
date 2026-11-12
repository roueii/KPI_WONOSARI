<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kehadiran & Disiplin | Capaian.id - Produksi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/produksi.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol X, Progress 5-Langkah, Badge PRODUKSI) -->
        <header class="fl-step-header">
            <a href="{{ route('produksi.dashboard') }}" class="fl-step-close-btn" aria-label="Batal dan kembali ke dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>

            <!-- 5-Steps Indicator (Langkah 3 Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="produksi-steps-bar">
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill"></div>
                    <div class="produksi-step-pill"></div>
                </div>
            </div>

            <span class="fl-step-badge">PRODUKSI</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: 0.8rem; font-weight: 600;">
            <span style="color: #1c1917;">Langkah 3 dari 5</span>
            <span style="color: #78716c;">Kehadiran &amp; Disiplin</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">Kehadiran &amp; Disiplin</h1>
            <p class="fl-step-subtitle">Input Harian Divisi Produksi Roti</p>
        </div>

        <form action="{{ route('produksi.kehadiran_disiplin.post') }}" method="POST" id="formKehadiranDisiplin">
            @csrf

            <!-- 3. KARTU INDIKATOR PENILAIAN -->
            <section class="fl-step-card" aria-labelledby="heading-kehadiran-disiplin">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-kehadiran-disiplin">INDIKATOR PENILAIAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini sesuai standar operasional dapur produksi.</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="produksi-check-card {{ !empty($stepData['tidak_terlambat']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tidak_terlambat]" value="1" {{ !empty($stepData['tidak_terlambat']) ? 'checked' : '' }} style="display: none;" />
                        <div class="produksi-check-box">
                            <svg class="produksi-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Tidak terlambat</span>
                            <span class="produksi-check-sub">Hadir di lokasi dan siap memproduksi roti tepat waktu sesuai jadwal shift hari ini</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="produksi-check-card {{ !empty($stepData['tidak_pulang_awal']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tidak_pulang_awal]" value="1" {{ !empty($stepData['tidak_pulang_awal']) ? 'checked' : '' }} style="display: none;" />
                        <div class="produksi-check-box">
                            <svg class="produksi-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Tidak pulang sebelum waktunya</span>
                            <span class="produksi-check-sub">Menyelesaikan jam kerja secara penuh hingga akhir shift yang ditentukan</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="produksi-check-card {{ !empty($stepData['tidak_mangkir']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tidak_mangkir]" value="1" {{ !empty($stepData['tidak_mangkir']) ? 'checked' : '' }} style="display: none;" />
                        <div class="produksi-check-box">
                            <svg class="produksi-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Tidak mangkir</span>
                            <span class="produksi-check-sub">Hadir bekerja hari ini tanpa absen atau izin mendadak yang tidak sah</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 4. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="produksi-notice-dashed">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Ketuk baris untuk menandai ceklis selesai dikerjakan.</span>
            </div>

            <!-- 5. Action Buttons (Kembali & Lanjut) Sesuai Figma -->
            <div class="fl-btn-row">
                <a href="{{ route('produksi.waktu_alat') }}" class="fl-btn-back" style="text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next">
                    <span>Lanjut</span>
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </div>

            <div style="text-align: center; margin-top: 12px; margin-bottom: 24px; font-size: 0.78rem; color: #a8a29e;">
                Langkah 3 dari 5
            </div>
        </form>
    </div>

    <!-- Script Interaktif -->
    <script>
        document.querySelectorAll('.produksi-check-card').forEach(card => {
            card.addEventListener('click', function(e) {
                const input = this.querySelector('input[type="checkbox"]');
                if (e.target !== input) {
                    e.preventDefault(); // cegah toggle ganda dari <label>
                    input.checked = !input.checked;
                }
                if (input.checked) {
                    this.classList.add('is-checked');
                } else {
                    this.classList.remove('is-checked');
                }
            });
        });
    </script>
</body>

</html>

