<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ketepatan Pengiriman & Keamanan | Capaian.id - Driver</title>
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

            <!-- 4-Steps Indicator -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="driver-steps-bar">
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill"></div>
                    <div class="driver-step-pill"></div>
                    <div class="driver-step-pill"></div>
                </div>
            </div>

            <span class="fl-step-badge">DRIVER</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: 0.8rem; font-weight: 600;">
            <span style="color: #1c1917;">Langkah 1 dari 4</span>
            <span style="color: #78716c;">Ketepatan & Pengiriman</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">Ketepatan Pengiriman &amp; Keamanan Barang</h1>
            <p class="fl-step-subtitle">Input Harian Divisi Logistik &amp; Distribusi Driver</p>
        </div>

        <form action="{{ route('driver.pengiriman.post') }}" method="POST" id="formPengiriman">
            @csrf

            <!-- 3. KARTU 1: KETEPATAN PENGIRIMAN -->
            <section class="fl-step-card" aria-labelledby="heading-ketepatan">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-ketepatan">KETEPATAN PENGIRIMAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini sesuai jadwal rute:</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="driver-check-card {{ !empty($stepData['datang_tepat']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[datang_tepat]" value="1" {{ !empty($stepData['datang_tepat']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Datang sesuai jam yang ditentukan</span>
                            <span class="driver-check-sub">Tiba di outlet atau titik drop tepat waktu sesuai jadwal rute.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['tidak_terlambat']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tidak_terlambat]" value="1" {{ !empty($stepData['tidak_terlambat']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Tidak terlambat tanpa alasan</span>
                            <span class="driver-check-sub">Keterlambatan wajib diinformasikan segera jika ada kendala lalu lintas.</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="driver-check-card {{ !empty($stepData['prioritas_pengiriman']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[prioritas_pengiriman]" value="1" {{ !empty($stepData['prioritas_pengiriman']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Mengikuti prioritas pengiriman</span>
                            <span class="driver-check-sub">Pengiriman barang pesanan prioritas &amp; kue sensitif suhu didahulukan.</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 4. KARTU 2: KEAMANAN BARANG -->
            <section class="fl-step-card" aria-labelledby="heading-keamanan">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-keamanan">KEAMANAN BARANG</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator keutuhan paket dan tata letak:</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="driver-check-card {{ !empty($stepData['kondisi_baik']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[kondisi_baik]" value="1" {{ !empty($stepData['kondisi_baik']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Produk sampai dalam kondisi baik</span>
                            <span class="driver-check-sub">Roti, cake, dan pastry tidak penyok, hancur, atau rusak kemasan.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['penataan_aman']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[penataan_aman]" value="1" {{ !empty($stepData['penataan_aman']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Penataan barang aman di kendaraan</span>
                            <span class="driver-check-sub">Krat terkunci rapi, tidak bertumpuk melebihi batas, bebas guncangan berat.</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="driver-check-card {{ !empty($stepData['tidak_komplain']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tidak_komplain]" value="1" {{ !empty($stepData['tidak_komplain']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Tidak ada komplain akibat kelalaian driver</span>
                            <span class="driver-check-sub">Tidak ada keluhan dari penerima atau pelanggan terkait cara mengemudi maupun penanganan barang hari ini</span>
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

            <!-- 6. Action Button Lanjut -->
            <button type="submit" class="fl-btn-next" style="width: 100%;">
                <span>Lanjut</span>
                <span aria-hidden="true">&rarr;</span>
            </button>

            <div style="text-align: center; margin-top: 12px; margin-bottom: 24px; font-size: 0.78rem; color: #a8a29e;">
                Langkah 1 dari 4
            </div>
        </form>
    </div>

    <!-- Script Checkbox Interaktif -->
    <script>
        document.querySelectorAll('.driver-check-card').forEach(card => {
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

