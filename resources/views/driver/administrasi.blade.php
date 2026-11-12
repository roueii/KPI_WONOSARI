<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOP Administrasi | Capaian.id - Driver</title>
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

            <!-- 4-Steps Indicator (Langkah 2 Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="driver-steps-bar">
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill"></div>
                    <div class="driver-step-pill"></div>
                </div>
            </div>

            <span class="fl-step-badge">DRIVER</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: 0.8rem; font-weight: 600;">
            <span style="color: #1c1917;">Langkah 2 dari 4</span>
            <span style="color: #78716c;">SOP Administrasi</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">SOP Administrasi</h1>
            <p class="fl-step-subtitle">Input Harian Divisi Logistik &amp; Distribusi Driver</p>
        </div>

        <form action="{{ route('driver.administrasi.post') }}" method="POST" id="formAdministrasi" enctype="multipart/form-data">
            @csrf

            <!-- 3. KARTU 1: INDIKATOR PENILAIAN -->
            <section class="fl-step-card" aria-labelledby="heading-indikator-admin">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-indikator-admin">INDIKATOR PENILAIAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini:</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="driver-check-card {{ !empty($stepData['surat_jalan']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[surat_jalan]" value="1" {{ !empty($stepData['surat_jalan']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Membawa surat jalan/nota</span>
                            <span class="driver-check-sub">Memastikan kelengkapan dokumen pengiriman sebelum armada berangkat.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['tanda_tangan']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[tanda_tangan]" value="1" {{ !empty($stepData['tanda_tangan']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Memastikan barang diterima &amp; ditandatangani</span>
                            <span class="driver-check-sub">Tanda tangan bukti serah terima sah dari penerima atau kepala toko outlet.</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="driver-check-card {{ !empty($stepData['kembalikan_dokumen']) ? 'is-checked' : '' }}">
                        <input type="checkbox" name="indicators[kembalikan_dokumen]" value="1" {{ !empty($stepData['kembalikan_dokumen']) ? 'checked' : '' }} style="display: none;" />
                        <div class="driver-check-box">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Mengembalikan dokumen lengkap</span>
                            <span class="driver-check-sub">Surat jalan kembali dalam kondisi bersih, utuh, dan diserahkan ke bagian admin.</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 4. KARTU 2: UNGGAH BUKTI FOTO -->
            <section class="fl-step-card" aria-labelledby="heading-unggah-foto">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-unggah-foto">Unggah Bukti Foto</h2>
                    <span class="fl-step-card-tag" style="font-size: 0.68rem;">WAJIB SEBELUM LANJUT</span>
                </div>
                <p class="fl-step-card-sub">Dokumentasi Driver</p>

                <!-- Dropzone Upload Area -->
                <div class="fl-upload-zone" onclick="document.getElementById('fileInput').click()" style="cursor: pointer;">
                    <input type="file" id="fileInput" name="photos[]" multiple accept="image/*" style="display: none;" onchange="handleFileSelect(event)" />
                    <div class="fl-upload-icon-circle">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="28" height="28">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                            <circle cx="12" cy="13" r="4"></circle>
                        </svg>
                    </div>
                    <span class="fl-upload-prompt-text">Ketuk untuk unggah foto</span>
                    <span class="fl-upload-subtext">Format JPG/PNG, maks. 5MB.</span>
                </div>

                <!-- Chips Foto Terunggah -->
                <div class="fl-photo-chips-row" id="photoChipsList">
                    <div class="fl-photo-chip">
                        <svg class="fl-photo-chip-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <span class="fl-photo-chip-name">foto_kerusakan_1.jpg</span>
                        <button type="button" class="fl-photo-chip-close" onclick="this.parentElement.remove()" aria-label="Hapus file">&times;</button>
                    </div>
                    <div class="fl-photo-chip">
                        <svg class="fl-photo-chip-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <span class="fl-photo-chip-name">foto_kerusa...</span>
                        <button type="button" class="fl-photo-chip-close" onclick="this.parentElement.remove()" aria-label="Hapus file">&times;</button>
                    </div>
                </div>

                <!-- Link Contoh Foto yang Benar -->
                <div style="text-align: center; margin-top: 14px;">
                    <a href="javascript:void(0)" onclick="alert('Contoh Foto: Ambil foto surat jalan yang telah ditandatangani outlet secara jelas dan tegak lurus.')" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.78rem; font-weight: 600; color: #57534e; text-decoration: none;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <span>Lihat contoh foto yang benar</span>
                    </a>
                </div>
            </section>

            <!-- 5. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="driver-notice-dashed">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Semua indikator penilaian dan 1 foto bukti wajib dilengkapi sebelum Anda dapat melangkah ke tahap Selanjutnya.</span>
            </div>

            <!-- 6. Action Buttons (Kembali & Lanjut) Sesuai Figma -->
            <div class="fl-btn-row">
                <a href="{{ route('driver.pengiriman') }}" class="fl-btn-back" style="text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next">
                    <span>Lanjut</span>
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </div>

            <div style="text-align: center; margin-top: 12px; margin-bottom: 24px; font-size: 0.78rem; color: #a8a29e;">
                Langkah 2 dari 4
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

        function handleFileSelect(e) {
            const files = e.target.files;
            const container = document.getElementById('photoChipsList');
            for (let i = 0; i < files.length; i++) {
                const chip = document.createElement('div');
                chip.className = 'fl-photo-chip';
                chip.innerHTML = `
                    <svg class="fl-photo-chip-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                    <span class="fl-photo-chip-name">${files[i].name}</span>
                    <button type="button" class="fl-photo-chip-close" onclick="this.parentElement.remove()" aria-label="Hapus file">&times;</button>
                `;
                container.appendChild(chip);
            }
        }
    </script>
</body>

</html>

