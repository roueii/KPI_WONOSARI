<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Promosi & Event | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol X, Progress 5-Langkah, Badge STORE MANAGER) -->
        <header class="fl-step-header">
            <a href="{{ route('storemanager.dashboard') }}" class="fl-step-close-btn" aria-label="Batal dan kembali ke dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>

            <!-- 5-Steps Indicator (Semua 5 Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="produksi-steps-bar" style="display: flex; gap: 6px;">
                    <div class="produksi-step-pill is-active" style="width: 28px; height: 6px; border-radius: 999px; background: #f97316;"></div>
                    <div class="produksi-step-pill is-active" style="width: 28px; height: 6px; border-radius: 999px; background: #f97316;"></div>
                    <div class="produksi-step-pill is-active" style="width: 28px; height: 6px; border-radius: 999px; background: #f97316;"></div>
                    <div class="produksi-step-pill is-active" style="width: 28px; height: 6px; border-radius: 999px; background: #f97316;"></div>
                    <div class="produksi-step-pill is-active" style="width: 28px; height: 6px; border-radius: 999px; background: #f97316;"></div>
                </div>
            </div>

            <span class="fl-step-badge" style="background: #fff7ed; border: 1px solid #fed7aa; color: #c2410c; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 999px;">STORE MANAGER</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: 0.8rem; font-weight: 600;">
            <span style="color: #1c1917;">Langkah 5 dari 5</span>
            <span style="color: #78716c;">Promosi & Event</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group" style="margin-bottom: 20px;">
            <h1 class="fl-step-title" style="font-size: 1.45rem; font-weight: 800; color: #1c1917; margin: 0 0 4px;">Promosi & Event</h1>
            <p class="fl-step-subtitle" style="font-size: 0.84rem; color: #78716c; margin: 0;">Centang indikator yang tercapai hari ini</p>
        </div>

        <form action="{{ route('storemanager.promosi_event.post') }}" method="POST" enctype="multipart/form-data" id="formPromosiEvent">
            @csrf

            <!-- 3. KARTU INDIKATOR PENILAIAN -->
            <section class="fl-step-card" style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 18px; padding: 18px; margin-bottom: 20px;" aria-labelledby="heading-promosi-event">
                <div class="fl-step-card-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <h2 class="fl-step-card-title" id="heading-promosi-event" style="font-size: 0.82rem; font-weight: 800; letter-spacing: 0.05em; color: #1c1917; margin: 0;">INDIKATOR PENILAIAN</h2>
                    <span class="fl-step-card-tag" style="background: #ffedd5; color: #c2410c; font-size: 0.68rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">WAJIB</span>
                </div>
                <p class="fl-step-card-sub" style="font-size: 0.76rem; color: #78716c; margin: 0 0 16px;">Centang indikator promosi dan event pemasaran yang dijalankan hari ini.</p>

                <!-- Section: PROMOSI & EVENT -->
                <span class="produksi-section-label" style="display: block; font-size: 0.72rem; font-weight: 800; color: #a8a29e; letter-spacing: 0.05em; margin-bottom: 10px;">PROMOSI & EVENT</span>
                
                @foreach($indicators as $indicator)
                <label class="sm-check-card {{ !empty($indicator['checked']) ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; background: {{ !empty($indicator['checked']) ? '#fff8f3' : '#faf6f0' }}; border: 1.5px solid {{ !empty($indicator['checked']) ? '#f97316' : '#ebdcd0' }}; border-radius: 14px; margin-bottom: 10px; cursor: pointer; transition: all 0.2s ease;">
                    <input type="checkbox" name="indicators[{{ $indicator['id'] }}]" value="1" {{ !empty($indicator['checked']) ? 'checked' : '' }} style="display: none;" />
                    <div class="sm-check-box" style="width: 22px; height: 22px; border-radius: 6px; border: 2px solid {{ !empty($indicator['checked']) ? '#f97316' : '#cbd5e1' }}; background: {{ !empty($indicator['checked']) ? '#f97316' : '#ffffff' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                        <svg class="sm-check-icon" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; {{ !empty($indicator['checked']) ? '' : 'display: none;' }}">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="sm-check-info" style="flex: 1;">
                        <span class="sm-check-title" style="display: block; font-size: 0.88rem; font-weight: 700; color: #1c1917; margin-bottom: 3px;">{{ $indicator['title'] }}</span>
                        <span class="sm-check-sub" style="display: block; font-size: 0.75rem; color: #78716c; line-height: 1.35;">{{ $indicator['desc'] }}</span>
                    </div>
                </label>
                @endforeach
            </section>

            <!-- 4. KARTU FOTO BUKTI PROMOSI -->
            <section class="fl-step-card" style="background: #ffffff; border: 1px solid #ebdcd0; border-radius: 18px; padding: 18px; margin-bottom: 20px;">
                <div class="fl-step-card-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <h2 class="fl-step-card-title" style="font-size: 0.82rem; font-weight: 800; letter-spacing: 0.05em; color: #1c1917; margin: 0;">FOTO BUKTI PROMOSI</h2>
                    <span class="fl-step-card-tag" style="background: #f4ebe2; color: #78716c; font-size: 0.68rem; font-weight: 800; padding: 2px 8px; border-radius: 6px;">OPSIONAL</span>
                </div>
                <p class="fl-step-card-sub" style="font-size: 0.76rem; color: #78716c; margin: 0 0 16px;">Unggah foto display materi promosi (POP, banner, poster, atau kasir).</p>

                <!-- Upload Area -->
                <div style="border: 1.5px dashed #ebdcd0; border-radius: 14px; background: #fbf5ee; padding: 20px; text-align: center; margin-bottom: 14px; cursor: pointer;" onclick="document.getElementById('promoPhotoInput').click()">
                    <input type="file" id="promoPhotoInput" name="photos[]" multiple accept="image/*" style="display: none;" />
                    <div style="width: 44px; height: 44px; border-radius: 50%; background: #eedfd2; color: #78716c; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                            <circle cx="12" cy="13" r="4"></circle>
                        </svg>
                    </div>
                    <span style="display: block; font-size: 0.84rem; font-weight: 700; color: #1c1917; margin-bottom: 2px;">Ambil foto atau pilih dari galeri</span>
                    <span style="display: block; font-size: 0.72rem; color: #78716c;">Format JPG, PNG maks. 5MB per file</span>
                </div>

                <!-- Existing Photos List -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; background: #faf6f0; border: 1px solid #ebdcd0; border-radius: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 36px; height: 36px; border-radius: 8px; background: #f5ebe0; display: flex; align-items: center; justify-content: center; color: #b45309;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.8rem; font-weight: 700; color: #1c1917;">foto_promo_kopi_sore.jpg</span>
                                <span style="display: block; font-size: 0.68rem; color: #78716c;">30 Sep 2026, 14:00 WIB</span>
                            </div>
                        </div>
                        <button type="button" style="border: none; background: transparent; color: #ef4444; cursor: pointer; padding: 4px;" aria-label="Hapus foto">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>

            <!-- 5. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="produksi-notice-dashed" style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; background: #fffbf7; border: 1.5px dashed #fed7aa; border-radius: 12px; font-size: 0.76rem; color: #9a3412; margin-bottom: 24px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>Ketuk baris untuk menandai ceklis selesai dikerjakan.</span>
            </div>

            <!-- 6. Action Buttons Final Submission Sesuai Figma -->
            <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                <button type="submit" style="width: 100%; padding: 15px; border-radius: 14px; border: none; background: #f97316; color: #ffffff; font-size: 0.95rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.32);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>Kirim Semua (5/5 Kategori)</span>
                </button>

                <button type="submit" formaction="{{ route('storemanager.draft.post') }}" style="width: 100%; padding: 13px; border-radius: 14px; border: 1.5px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.88rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    <span>Simpan sebagai Draf Sementara</span>
                </button>

                <a href="{{ route('storemanager.operasional_sdm') }}" class="fl-btn-back" style="display: block; width: 100%; box-sizing: border-box; padding: 13px; border-radius: 14px; border: 1.5px solid #ebdcd0; background: #ffffff; color: #1c1917; font-size: 0.88rem; font-weight: 700; text-decoration: none; text-align: center;">
                    Kembali
                </a>
            </div>

            <div style="text-align: center; margin-top: 14px; margin-bottom: 24px; font-size: 0.78rem; color: #a8a29e;">
                Langkah 5 dari 5
            </div>
        </form>
    </div>

    <!-- Script Checkbox Interaktif -->
    <script>
        document.querySelectorAll('.sm-check-card').forEach(card => {
            card.addEventListener('click', function(e) {
                const input = this.querySelector('input[type="checkbox"]');
                const box = this.querySelector('.sm-check-box');
                const icon = this.querySelector('.sm-check-icon');
                
                if (e.target !== input) {
                    input.checked = !input.checked;
                }
                
                if (input.checked) {
                    this.style.background = '#fff8f3';
                    this.style.borderColor = '#f97316';
                    box.style.background = '#f97316';
                    box.style.borderColor = '#f97316';
                    icon.style.display = 'block';
                } else {
                    this.style.background = '#faf6f0';
                    this.style.borderColor = '#ebdcd0';
                    box.style.background = '#ffffff';
                    box.style.borderColor = '#cbd5e1';
                    icon.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>

