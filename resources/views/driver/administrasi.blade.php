<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOP Administrasi | Capaian.id - Driver</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol X, Progress 4-Langkah, Badge DRIVER) -->
        <header class="fl-step-header">
            <a href="{{ route('driver.dashboard') }}" class="fl-step-close-btn" aria-label="Batal dan kembali ke dashboard">
                <x-icon name="cancel" />
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
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: var(--fs-12); font-weight: 600;">
            <span style="color: var(--neutral-900);">Langkah 2 dari 4</span>
            <span style="color: var(--neutral-500);">SOP Administrasi</span>
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
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[surat_jalan]" value="1" {{ !empty($stepData['surat_jalan']) ? 'checked' : '' }} />
                        <div class="driver-check-box">
                            <x-icon name="check" class="driver-check-icon" />
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Membawa surat jalan/nota</span>
                            <span class="driver-check-sub">Memastikan kelengkapan dokumen pengiriman sebelum armada berangkat.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['tanda_tangan']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[tanda_tangan]" value="1" {{ !empty($stepData['tanda_tangan']) ? 'checked' : '' }} />
                        <div class="driver-check-box">
                            <x-icon name="check" class="driver-check-icon" />
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Memastikan barang diterima &amp; ditandatangani</span>
                            <span class="driver-check-sub">Tanda tangan bukti serah terima sah dari penerima atau kepala toko outlet.</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="driver-check-card {{ !empty($stepData['kembalikan_dokumen']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[kembalikan_dokumen]" value="1" {{ !empty($stepData['kembalikan_dokumen']) ? 'checked' : '' }} />
                        <div class="driver-check-box">
                            <x-icon name="check" class="driver-check-icon" />
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
                    <span class="fl-step-card-tag" style="font-size: var(--fs-10);">WAJIB SEBELUM LANJUT</span>
                </div>
                <p class="fl-step-card-sub">Dokumentasi Driver</p>

                <!-- Dropzone Upload Area -->
                <div class="fl-upload-zone" onclick="document.getElementById('fileInput').click()" style="cursor: pointer;">
                    <input type="file" id="fileInput" name="photos[]" multiple accept="image/*" style="display: none;" onchange="handleFileSelect(event)" />
                    <div class="fl-upload-icon-circle">
                        <x-icon name="camera" width="28" height="28" />
                    </div>
                    <span class="fl-upload-prompt-text">Ketuk untuk unggah foto</span>
                    <span class="fl-upload-subtext">Format JPG/PNG, maks. 5MB.</span>
                </div>

                <!-- Chips Foto Terunggah -->
                <div class="fl-photo-chips-row" id="photoChipsList">
                    <div class="fl-photo-chip">
                        <x-icon name="media-image" class="fl-photo-chip-icon" />
                        <span class="fl-photo-chip-name">foto_kerusakan_1.jpg</span>
                        <button type="button" class="fl-photo-chip-close" onclick="this.parentElement.remove()" aria-label="Hapus file">&times;</button>
                    </div>
                    <div class="fl-photo-chip">
                        <x-icon name="media-image" class="fl-photo-chip-icon" />
                        <span class="fl-photo-chip-name">foto_kerusa...</span>
                        <button type="button" class="fl-photo-chip-close" onclick="this.parentElement.remove()" aria-label="Hapus file">&times;</button>
                    </div>
                </div>

                <!-- Link Contoh Foto yang Benar -->
                <div style="text-align: center; margin-top: 14px;">
                    <a href="javascript:void(0)" onclick="alert('Contoh Foto: Ambil foto surat jalan yang telah ditandatangani outlet secara jelas dan tegak lurus.')" style="display: inline-flex; align-items: center; gap: 6px; font-size: var(--fs-12); font-weight: 600; color: var(--neutral-600); text-decoration: none;">
                        <x-icon name="eye-empty" width="16" height="16" />
                        <span>Lihat contoh foto yang benar</span>
                    </a>
                </div>
            </section>

            <!-- 5. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="driver-notice-dashed">
                <x-icon name="info-empty" width="18" height="18" />
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

            <div style="text-align: center; margin-top: 12px; margin-bottom: 24px; font-size: var(--fs-12); color: var(--neutral-400);">
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
                    <x-icon name="media-image" class="fl-photo-chip-icon" />
                    <span class="fl-photo-chip-name">${files[i].name}</span>
                    <button type="button" class="fl-photo-chip-close" onclick="this.parentElement.remove()" aria-label="Hapus file">&times;</button>
                `;
                container.appendChild(chip);
            }
        }
    </script>
</body>

</html>

