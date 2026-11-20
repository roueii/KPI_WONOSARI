<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kepatuhan SOP | Capaian.id - Produksi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/produksi.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol X, Progress 5-Langkah, Badge PRODUKSI) -->
        <header class="fl-step-header">
            <a href="{{ route('produksi.dashboard') }}" class="fl-step-close-btn" aria-label="Batal dan kembali ke dashboard">
                <x-icon name="cancel" />
            </a>

            <!-- 5-Steps Indicator (Langkah 4 Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="produksi-steps-bar">
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill"></div>
                </div>
            </div>

            <span class="fl-step-badge">PRODUKSI</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: var(--fs-12); font-weight: 600;">
            <span style="color: var(--neutral-900);">Langkah 4 dari 5</span>
            <span style="color: var(--neutral-500);">Kepatuhan SOP</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">Kepatuhan SOP</h1>
            <p class="fl-step-subtitle">Input Harian Divisi Produksi Roti</p>
        </div>

        <form action="{{ route('produksi.kepatuhan_sop.post') }}" method="POST" id="formKepatuhanSop">
            @csrf

            <!-- 3. KARTU INDIKATOR PENILAIAN -->
            <section class="fl-step-card" aria-labelledby="heading-kepatuhan-sop">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-kepatuhan-sop">INDIKATOR PENILAIAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini sesuai standar operasional dapur produksi.</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="produksi-check-card {{ !empty($stepData['menimbang_resep']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[menimbang_resep]" value="1" {{ !empty($stepData['menimbang_resep']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Menimbang sesuai resep</span>
                            <span class="produksi-check-sub">Toleransi timbangan bahan utama maksimal &plusmn;2 gram</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="produksi-check-card {{ !empty($stepData['waktu_fermentasi']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[waktu_fermentasi]" value="1" {{ !empty($stepData['waktu_fermentasi']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Mengikuti waktu fermentasi</span>
                            <span class="produksi-check-sub">First proofing &amp; final proofing tercatat di timer dapur</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="produksi-check-card {{ !empty($stepData['menggunakan_apd']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[menggunakan_apd]" value="1" {{ !empty($stepData['menggunakan_apd']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Menggunakan APD</span>
                            <span class="produksi-check-sub">Celemek, penutup kepala, sarung tangan, dan masker higienis</span>
                        </div>
                    </label>

                    <!-- Item 4 -->
                    <label class="produksi-check-card {{ !empty($stepData['mencatat_batch']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[mencatat_batch]" value="1" {{ !empty($stepData['mencatat_batch']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Mencatat batch produksi</span>
                            <span class="produksi-check-sub">Nomor batch, jam aduk, dan suhu oven tercatat di lembar kerja</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 4. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="produksi-notice-dashed">
                <x-icon name="info-empty" width="18" height="18" />
                <span>Ketuk baris untuk menandai ceklis selesai dikerjakan.</span>
            </div>

            <!-- 5. Action Buttons (Kembali & Lanjut) Sesuai Figma -->
            <div class="fl-btn-row">
                <a href="{{ route('produksi.kehadiran_disiplin') }}" class="fl-btn-back" style="text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next">
                    <span>Lanjut</span>
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </div>

            <div style="text-align: center; margin-top: 12px; margin-bottom: 24px; font-size: var(--fs-12); color: var(--neutral-400);">
                Langkah 4 dari 5
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

