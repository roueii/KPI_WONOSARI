<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kebersihan Area Kerja | Capaian.id - Produksi</title>
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

            <!-- 5-Steps Indicator (Seluruh 5 Langkah Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="produksi-steps-bar">
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                    <div class="produksi-step-pill is-active"></div>
                </div>
            </div>

            <span class="fl-step-badge">PRODUKSI</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: var(--fs-12); font-weight: 600;">
            <span style="color: var(--neutral-900);">Langkah 5 dari 5</span>
            <span style="color: var(--neutral-500);">Kebersihan Area Kerja</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group">
            <h1 class="fl-step-title">Kebersihan Area Kerja</h1>
            <p class="fl-step-subtitle">Input Harian Divisi Produksi Roti</p>
        </div>

        <form action="{{ route('produksi.kebersihan_area.post') }}" method="POST" id="formKebersihanArea" enctype="multipart/form-data">
            @csrf

            <!-- 3. KARTU INDIKATOR PENILAIAN (6 ITEM) -->
            <section class="fl-step-card" aria-labelledby="heading-kebersihan-area">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-kebersihan-area">INDIKATOR PENILAIAN</h2>
                    <span class="fl-step-card-tag">WAJIB</span>
                </div>
                <p class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini sesuai checklist sanitasi &amp; standar kebersihan dapur produksi.</p>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Item 1 -->
                    <label class="produksi-check-card {{ !empty($stepData['meja_bersih']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[meja_bersih]" value="1" {{ !empty($stepData['meja_bersih']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Meja bersih</span>
                            <span class="produksi-check-sub">Meja kerja stainless steril, bebas sisa adonan tepung &amp; remah</span>
                        </div>
                    </label>

                    <!-- Item 2 -->
                    <label class="produksi-check-card {{ !empty($stepData['oven_bersih']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[oven_bersih]" value="1" {{ !empty($stepData['oven_bersih']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Oven bersih</span>
                            <span class="produksi-check-sub">Kaca deck, loyang pembakar, dan kerak dalam ruang bakar bersih</span>
                        </div>
                    </label>

                    <!-- Item 3 -->
                    <label class="produksi-check-card {{ !empty($stepData['mixer_bersih']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[mixer_bersih]" value="1" {{ !empty($stepData['mixer_bersih']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Mixer bersih</span>
                            <span class="produksi-check-sub">Bowl spiral mixer, hook pengaduk, dan bodi luar dicuci kering</span>
                        </div>
                    </label>

                    <!-- Item 4 -->
                    <label class="produksi-check-card {{ !empty($stepData['lantai_bersih']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[lantai_bersih]" value="1" {{ !empty($stepData['lantai_bersih']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Lantai bersih</span>
                            <span class="produksi-check-sub">Disapu dan dipel dengan disinfektan dapur tidak licin/berminyak</span>
                        </div>
                    </label>

                    <!-- Item 5 -->
                    <label class="produksi-check-card {{ !empty($stepData['rak_bersih']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[rak_bersih]" value="1" {{ !empty($stepData['rak_bersih']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Rak bersih</span>
                            <span class="produksi-check-sub">Cooling rack &amp; rak penyimpanan bahan tertata rapi tanpa debu</span>
                        </div>
                    </label>

                    <!-- Item 6 -->
                    <label class="produksi-check-card {{ !empty($stepData['tempat_sampah']) ? 'is-checked' : '' }}">
                        <input class="ds-visually-hidden" type="checkbox" name="indicators[tempat_sampah]" value="1" {{ !empty($stepData['tempat_sampah']) ? 'checked' : '' }} />
                        <div class="produksi-check-box">
                            <x-icon name="check" class="produksi-check-icon" />
                        </div>
                        <div class="produksi-check-info">
                            <span class="produksi-check-title">Tempat sampah tertutup</span>
                            <span class="produksi-check-sub">Plastik sampah diganti baru, tutup pedal berfungsi rapat</span>
                        </div>
                    </label>
                </div>
            </section>

            <!-- 4. KARTU UNGGAH BUKTI FOTO -->
            <section class="fl-step-card" aria-labelledby="heading-unggah-foto-kebersihan">
                <div class="fl-step-card-header">
                    <h2 class="fl-step-card-title" id="heading-unggah-foto-kebersihan">Unggah Bukti Foto</h2>
                    <span class="fl-step-card-tag" style="font-size: var(--fs-10);">WAJIB SEBELUM LANJUT</span>
                </div>
                <p class="fl-step-card-sub">Dokumentasi Produksi</p>

                <!-- Dropzone Upload Area -->
                <div class="fl-upload-zone" onclick="document.getElementById('fileInputArea').click()" style="cursor: pointer;">
                    <input type="file" id="fileInputArea" name="photos[]" multiple accept="image/*" style="display: none;" onchange="handleFileSelectArea(event)" />
                    <div class="fl-upload-icon-circle">
                        <x-icon name="camera" width="28" height="28" />
                    </div>
                    <span class="fl-upload-prompt-text">Ketuk untuk unggah foto</span>
                    <span class="fl-upload-subtext">Format JPG/PNG, maks. 5MB.</span>
                </div>

                <!-- Chips Foto Terunggah -->
                <div class="fl-photo-chips-row" id="photoChipsListArea">
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
                    <a href="javascript:void(0)" onclick="alert('Contoh Foto: Ambil foto area meja stainless steril dan lantai dapur produksi yang bersih.')" style="display: inline-flex; align-items: center; gap: 6px; font-size: var(--fs-12); font-weight: 600; color: var(--neutral-600); text-decoration: none;">
                        <x-icon name="eye-empty" width="16" height="16" />
                        <span>Lihat contoh foto yang benar</span>
                    </a>
                </div>
            </section>

            <!-- 5. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="produksi-notice-dashed">
                <x-icon name="info-empty" width="18" height="18" />
                <span>Pastikan semua data input harian telah sesuai sebelum mengirim capaian. Laporan yang sudah dikirim akan langsung diverifikasi oleh <strong>Store Manager</strong></span>
            </div>

            <!-- 6. Action Buttons (Kembali & Kirim Semua) Sesuai Figma -->
            <div class="fl-btn-row">
                <a href="{{ route('produksi.kepatuhan_sop') }}" class="fl-btn-back" style="text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next">
                    <span>Kirim Semua</span>
                </button>
            </div>

            <!-- Sub Action: Simpan sebagai Draf Sementara -->
            <div style="text-align: center; margin-top: 14px; margin-bottom: 24px;">
                <button type="button" onclick="saveDraftProduksi()" style="background: none; border: none; font-size: var(--fs-14); font-weight: 600; color: var(--neutral-500); text-decoration: underline; cursor: pointer;">
                    Simpan sebagai Draf Sementara
                </button>
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

        function handleFileSelectArea(e) {
            const files = e.target.files;
            const container = document.getElementById('photoChipsListArea');
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

        function saveDraftProduksi() {
            fetch("{{ route('produksi.draft.post') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                // Kirim checklist yang sedang dicentang (tanpa file foto)
                body: (() => {
                    const data = new FormData(document.getElementById('formKebersihanArea'));
                    data.delete('photos[]');
                    return data;
                })()
            }).then(res => {
                if (!res.ok) throw new Error('Gagal menyimpan draf');
                alert('Capaian produksi berhasil disimpan sebagai draf sementara!');
                window.location.href = "{{ route('produksi.dashboard') }}";
            }).catch(() => {
                alert('Gagal menyimpan draf. Periksa koneksi Anda lalu coba lagi.');
            });
        }
    </script>
</body>

</html>

