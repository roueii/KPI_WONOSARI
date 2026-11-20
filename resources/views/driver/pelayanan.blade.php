<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Disiplin & Pelayanan | Capaian.id - Driver</title>
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

            <!-- 4-Steps Indicator (Seluruh 4 Langkah Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="driver-steps-bar">
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill is-active"></div>
                    <div class="driver-step-pill is-active"></div>
                </div>
            </div>

            <span class="fl-step-badge">DRIVER</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: var(--fs-12); font-weight: 600;">
            <span style="color: var(--neutral-900);">Langkah 4 dari 4</span>
            <span style="color: var(--neutral-500);">Disiplin &amp; Pelayanan</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">Disiplin &amp; Pelayanan</h1>
            <p class="fl-step-subtitle">Input Harian Divisi Logistik &amp; Distribusi Driver</p>
        </div>

        <form action="{{ route('driver.pelayanan.post') }}" method="POST" id="formPelayanan" enctype="multipart/form-data">
            @csrf

            <!-- 3. KARTU 1: DISIPLIN -->
            <section class="fl-step-card" aria-labelledby="heading-disiplin">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-disiplin">DISIPLIN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator kedisiplinan kerja hari ini:</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="driver-check-card {{ !empty($stepData['kerapian']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[kerapian]" value="1" {{ !empty($stepData['kerapian']) ? 'checked' : '' }} />
                        <div class="driver-check-box">
                            <x-icon name="check" class="driver-check-icon" />
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Kerapian berpakaian</span>
                            <span class="driver-check-sub">Seragam kerja bersih, rapi, dan menggunakan sepatu kerja standar.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['briefing']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[briefing]" value="1" {{ !empty($stepData['briefing']) ? 'checked' : '' }} />
                        <div class="driver-check-box">
                            <x-icon name="check" class="driver-check-icon" />
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Mengikuti briefing</span>
                            <span class="driver-check-sub">Hadir pada sesi pengarahan pagi dan koordinasi rute harian.</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 4. KARTU 2: PELAYANAN -->
            <section class="fl-step-card" aria-labelledby="heading-pelayanan">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-pelayanan">PELAYANAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator etika dan pelayanan hari ini:</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="driver-check-card {{ !empty($stepData['komunikasi']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[komunikasi]" value="1" {{ !empty($stepData['komunikasi']) ? 'checked' : '' }} />
                        <div class="driver-check-box">
                            <x-icon name="check" class="driver-check-icon" />
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Komunikasi baik dengan toko, gudang, customer</span>
                            <span class="driver-check-sub">Menyampaikan informasi serah terima dengan sopan dan jelas.</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="driver-check-card {{ !empty($stepData['tidak_konflik']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[tidak_konflik]" value="1" {{ !empty($stepData['tidak_konflik']) ? 'checked' : '' }} />
                        <div class="driver-check-box">
                            <x-icon name="check" class="driver-check-icon" />
                        </div>
                        <div class="driver-check-info">
                            <span class="driver-check-title">Tidak mudah konflik</span>
                            <span class="driver-check-sub">Menjaga sikap profesional dan menyelesaikan kendala di lapangan secara kepala dingin.</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 5. KARTU 3: UNGGAH BUKTI FOTO -->
            <section class="fl-step-card" aria-labelledby="heading-unggah-foto-pelayanan">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-unggah-foto-pelayanan">Unggah Bukti Foto</h2>
                    <span class="fl-step-card-tag" style="font-size: var(--fs-10);">WAJIB SEBELUM LANJUT</span>
                </div>
                <p class="fl-step-card-sub">Dokumentasi Driver</p>

                <!-- Dropzone Upload Area -->
                <div class="fl-upload-zone" onclick="document.getElementById('fileInputStep4').click()" style="cursor: pointer;">
                    <input type="file" id="fileInputStep4" name="photos[]" multiple accept="image/*" style="display: none;" onchange="handleFileSelectStep4(event)" />
                    <div class="fl-upload-icon-circle">
                        <x-icon name="camera" width="28" height="28" />
                    </div>
                    <span class="fl-upload-prompt-text">Ketuk untuk unggah foto</span>
                    <span class="fl-upload-subtext">Format JPG/PNG, maks. 5MB.</span>
                </div>

                <!-- Chips Foto Terunggah -->
                <div class="fl-photo-chips-row" id="photoChipsListStep4">
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

                <div style="text-align: center; margin-top: 14px;">
                    <a href="javascript:void(0)" onclick="alert('Contoh Foto: Ambil foto kerapian seragam dan armada saat briefing sebelum pengantaran dimulai.')" style="display: inline-flex; align-items: center; gap: 6px; font-size: var(--fs-12); font-weight: 600; color: var(--neutral-600); text-decoration: none;">
                        <x-icon name="eye-empty" width="16" height="16" />
                        <span>Lihat contoh foto yang benar</span>
                    </a>
                </div>
            </section>

            <!-- 6. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="driver-notice-dashed">
                <x-icon name="info-empty" width="18" height="18" />
                <span>Pastikan semua data input harian telah sesuai sebelum mengirim capaian. Laporan yang sudah dikirim akan langsung diverifikasi oleh <strong>Store Manager</strong></span>
            </div>

            <!-- 7. Action Buttons (Kembali & Kirim Semua) Sesuai Figma -->
            <div class="fl-btn-row">
                <a href="{{ route('driver.kendaraan') }}" class="fl-btn-back" style="text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next">
                    <span>Kirim Semua</span>
                </button>
            </div>

            <!-- Sub Action: Simpan sebagai Draf Sementara -->
            <div style="text-align: center; margin-top: 14px; margin-bottom: 24px;">
                <button type="button" onclick="saveDraft()" style="background: none; border: none; font-size: var(--fs-14); font-weight: 600; color: var(--neutral-500); text-decoration: underline; cursor: pointer;">
                    Simpan sebagai Draf Sementara
                </button>
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

        function handleFileSelectStep4(e) {
            const files = e.target.files;
            const container = document.getElementById('photoChipsListStep4');
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

        function saveDraft() {
            fetch("{{ route('driver.draft.post') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                // Kirim checklist yang sedang dicentang (tanpa file foto)
                body: (() => {
                    const data = new FormData(document.getElementById('formPelayanan'));
                    data.delete('photos[]');
                    return data;
                })()
            }).then(res => {
                if (!res.ok) throw new Error('Gagal menyimpan draf');
                alert('Capaian driver berhasil disimpan sebagai draf sementara!');
                window.location.href = "{{ route('driver.dashboard') }}";
            }).catch(() => {
                alert('Gagal menyimpan draf. Periksa koneksi Anda lalu coba lagi.');
            });
        }
    </script>
</body>

</html>

