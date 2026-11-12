<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kendaraan & BBM | Capaian.id - Driver</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol X, Progress 4-Langkah, Badge DRIVER) -->
        <header class="fl-step-header">
            <a href="{{ route('driver.dashboard') }}" class="fl-step-close-btn" aria-label="Batal dan kembali ke dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>

            <!-- 4-Steps Indicator (Langkah 3 Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="driver-steps-bar">
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill"></div>
                </div>
            </div>

            <span class="fl-step-badge">DRIVER</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: 0.8rem; font-weight: 600;">
            <span style="color: #1c1917;">Langkah 3 dari 4</span>
            <span style="color: #78716c;">Kendaraan &amp; BBM</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">Kendaraan &amp; BBM</h1>
            <p class="fl-step-subtitle">Input Harian Divisi Logistik &amp; Distribusi Driver</p>
        </div>

        <form action="{{ route('driver.kendaraan.post') }}" method="POST" id="formKendaraan">
            @csrf

            <!-- 3. KARTU 1: KENDARAAN (6 INDIKATOR) -->
            <section class="fl-step-card" aria-labelledby="heading-kendaraan">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-kendaraan">KENDARAAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator kelaikan dan kebersihan kendaraan hari ini:</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="driver-check-card {{ !empty($stepData['kebersihan']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[kebersihan]" value="1" {{ !empty($stepData['kebersihan']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Kendaraan bersih setiap hari</span>
                            <span class="driver-check-sub">Interior kabin dan boks muatan dicuci/dibersihkan secara berkala.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['cek_rem']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[cek_rem]" value="1" {{ !empty($stepData['cek_rem']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Cek rem pada kendaraan</span>
                            <span class="driver-check-sub">Pemeriksaan fungsi keselamatan sebelum armada dijalankan.</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="driver-check-card {{ !empty($stepData['cek_oli']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[cek_oli]" value="1" {{ !empty($stepData['cek_oli']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Cek oli pada kendaraan</span>
                            <span class="driver-check-sub">Pemeriksaan fungsi keselamatan sebelum armada dijalankan.</span>
                        </div>
                    </label>

                    <!-- Item 4 -->
                    <label class="driver-check-card {{ !empty($stepData['cek_ban']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[cek_ban]" value="1" {{ !empty($stepData['cek_ban']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Cek ban pada kendaraan</span>
                            <span class="driver-check-sub">Pemeriksaan fungsi keselamatan sebelum armada dijalankan.</span>
                        </div>
                    </label>

                    <!-- Item 5 -->
                    <label class="driver-check-card {{ !empty($stepData['cek_lampu']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[cek_lampu]" value="1" {{ !empty($stepData['cek_lampu']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Cek lampu pada kendaraan</span>
                            <span class="driver-check-sub">Pemeriksaan fungsi keselamatan sebelum armada dijalankan.</span>
                        </div>
                    </label>

                    <!-- Item 6 -->
                    <label class="driver-check-card {{ !empty($stepData['lapor_kerusakan']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[lapor_kerusakan]" value="1" {{ !empty($stepData['lapor_kerusakan']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Melaporkan kerusakan sebelum parah</span>
                            <span class="driver-check-sub">Jika hari ini ada kerusakan pada kendaraan segera lapor</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 4. KARTU 2: BBM & RUTE -->
            <section class="fl-step-card" aria-labelledby="heading-bbm">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-bbm">BBM &amp; RUTE</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="driver-check-card {{ !empty($stepData['tidak_boros_bbm']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tidak_boros_bbm]" value="1" {{ !empty($stepData['tidak_boros_bbm']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Tidak boros BBM</span>
                            <span class="driver-check-sub">Penggunaan BBM hari ini wajar dan sesuai dengan jarak tempuh yang dilalui.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['tidak_pribadi']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tidak_pribadi]" value="1" {{ !empty($stepData['tidak_pribadi']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Tidak menggunakan kendaraan untuk kepentingan pribadi</span>
                            <span class="driver-check-sub">Armada operasional hanya digunakan untuk rute distribusi resmi.</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="driver-check-card {{ !empty($stepData['rute_efektif']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[rute_efektif]" value="1" {{ !empty($stepData['rute_efektif']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Menggunakan rute efektif</span>
                            <span class="driver-check-sub">Mematuhi urutan pengantaran dan efisiensi jarak tempuh.</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 5. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="driver-notice-dashed">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Ketuk baris untuk menandai ceklis selesai dikerjakan.</span>
            </div>

            <!-- 6. Action Buttons (Kembali & Lanjut) Sesuai Figma -->
            <div class="fl-btn-row">
                <a href="{{ route('driver.administrasi') }}" class="fl-btn-back" style="text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next">
                    <span>Lanjut</span>
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </div>

            <div style="text-align: center; margin-top: 12px; margin-bottom: 24px; font-size: 0.78rem; color: #a8a29e;">
                Langkah 3 dari 4
            </div>
        </form>
    </div>

    <!-- Script Interaktif -->
    <script>
        document.querySelectorAll('.driver-check-card').forEach(card => {
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

