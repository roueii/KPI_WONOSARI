<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hasil Produksi | Capaian.id - Produksi</title>
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

            <!-- 5-Steps Indicator (Langkah 1 Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="produksi-steps-bar">
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill"></div>
                    <div class="produksi-step-pill"></div>
                    <div class="produksi-step-pill"></div>
                    <div class="produksi-step-pill"></div>
                </div>
            </div>

            <span class="fl-step-badge">PRODUKSI</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: 0.8rem; font-weight: 600;">
            <span style="color: #1c1917;">Langkah 1 dari 5</span>
            <span style="color: #78716c;">Hasil Produksi</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">Hasil Produksi</h1>
            <p class="fl-step-subtitle">Centang indikator yang tercapai hari ini</p>
        </div>

        <form action="{{ route('produksi.hasil_produksi.post') }}" method="POST" id="formHasilProduksi">
            @csrf

            <!-- 3. KARTU INDIKATOR PENILAIAN -->
            <section class="fl-step-card" aria-labelledby="heading-hasil-produksi">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-hasil-produksi">INDIKATOR PENILAIAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini sesuai standar operasional dapur produksi.</p>

                <!-- Section: PRODUKTIVITAS PRODUKSI -->
                <span class="produksi-section-label">PRODUKTIVITAS PRODUKSI</span>
                <label class="produksi-check-card {{ !empty($stepData['target_roti']) ? 'is-checked' : '' }}">
                    <input type="checkbox" name="indicators[target_roti]" value="1" {{ !empty($stepData['target_roti']) ? 'checked' : '' }} style="display: none;" />
                    <div class="produksi-check-box">
                        <svg class="produksi-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="produksi-check-info">
                        <span class="produksi-check-title">Target jumlah roti sesuai rencana harian</span>
                        <span class="produksi-check-sub">Jumlah roti yang selesai diproduksi hari ini sesuai atau melampaui rencana produksi harian</span>
                    </div>
                </label>

                <!-- Section: KUALITAS PRODUK -->
                <span class="produksi-section-label">KUALITAS PRODUK</span>
                <label class="produksi-check-card {{ !empty($stepData['reject_maksimal']) ? 'is-checked' : '' }}">
                    <input type="checkbox" name="indicators[reject_maksimal]" value="1" {{ !empty($stepData['reject_maksimal']) ? 'checked' : '' }} style="display: none;" />
                    <div class="produksi-check-box">
                        <svg class="produksi-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="produksi-check-info">
                        <span class="produksi-check-title">Produk reject maksimal 2%</span>
                        <span class="produksi-check-sub">Roti gosong, bantat, atau tidak sesuai bentuk/ukuran tidak melebihi 2% dari total produksi hari ini</span>
                    </div>
                </label>

                <!-- Section: WASTE BAHAN BAKU -->
                <span class="produksi-section-label">WASTE BAHAN BAKU</span>
                <label class="produksi-check-card {{ !empty($stepData['waste_terkontrol']) ? 'is-checked' : '' }}">
                    <input type="checkbox" name="indicators[waste_terkontrol]" value="1" {{ !empty($stepData['waste_terkontrol']) ? 'checked' : '' }} style="display: none;" />
                    <div class="produksi-check-box">
                        <svg class="produksi-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="produksi-check-info">
                        <span class="produksi-check-title">Penggunaan bahan baku terkontrol</span>
                        <span class="produksi-check-sub">Pemakaian tepung, mentega, telur, dan bahan lain hari ini tidak melebihi takaran yang direncanakan</span>
                    </div>
                </label>
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
                <a href="{{ route('produksi.dashboard') }}" class="fl-btn-back" style="text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next">
                    <span>Lanjut</span>
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </div>

            <div style="text-align: center; margin-top: 12px; margin-bottom: 24px; font-size: 0.78rem; color: #a8a29e;">
                Langkah 1 dari 5
            </div>
        </form>
    </div>

    <!-- Script Checkbox Interaktif -->
    <script>
        document.querySelectorAll('.produksi-check-card').forEach(card => {
            card.addEventListener('click', function(e) {
                const input = this.querySelector('input[type="checkbox"]');
                if (e.target !== input) {
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

