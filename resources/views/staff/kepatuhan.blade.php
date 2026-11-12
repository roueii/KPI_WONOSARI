<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kepatuhan SOP & Disiplin (Langkah 6/6) | Frontliner Capaian.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontliner.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Top Navigation Bar Sesuai Figma Revisi -->
        <header class="fl-step-header">
            <a href="{{ route('frontliner.dashboard') }}" class="fl-step-close-btn" aria-label="Tutup dan kembali ke Dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
            <span class="fl-step-badge">FRONTLINER</span>
        </header>

        <!-- 2. 6-Segment Stepper Progress Sesuai Figma Revisi (Semua 6 Aktif) -->
        <div class="fl-stepper-progress">
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
        </div>

        <div class="fl-step-meta-row">
            <span class="fl-step-current-text">Langkah 6 dari 6</span>
            <span class="fl-step-category-text">Kepatuhan SOP</span>
        </div>

        <!-- 3. Judul & Subtitle Sesuai Figma Revisi -->
        <h1 class="fl-step-page-title">Kepatuhan SOP & Disiplin</h1>
        <p class="fl-step-page-sub">Input total perolehan transaksi kasir shift hari ini.</p>

        <!-- Form Pengisian Langkah 6 (Final Submit) -->
        <form action="{{ route('frontliner.kepatuhan.post') }}" method="POST" id="formLangkah6">
            @csrf

            <!-- Card: Indikator Penilaian (Wajib) -->
            <section class="fl-step-card" style="margin-bottom: 20px;">
                <div class="fl-step-card-header">
                    <div class="fl-step-card-titles">
                        <h2 class="fl-step-card-title">Indikator Penilaian</h2>
                        <span class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini sesuai standar operasional dapur produksi.</span>
                    </div>
                    <span class="fl-step-required-badge" style="border: 1px solid #c2410c; background: #fff7ed; color: #9a3412; font-size: 0.68rem; font-weight: 800; padding: 3px 8px; border-radius: 6px;">WAJIB</span>
                </div>

                <!-- Subheading 1: Kepatuhan SOP -->
                <div style="margin-top: 16px; margin-bottom: 8px;">
                    <span style="font-size: 0.8rem; font-weight: 800; color: #1c1917; text-transform: uppercase; letter-spacing: 0.04em;">Kepatuhan SOP</span>
                </div>

                <div class="fl-check-list" style="display: flex; flex-direction: column; gap: 10px;">
                    @foreach($sopIndicators as $item)
                    <label class="fl-check-card {{ $item['checked'] ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; border: 1px solid #ebdcd0; border-radius: 14px; cursor: pointer; background: #ffffff;">
                        <input type="checkbox" name="sop[]" value="{{ $item['id'] }}" {{ $item['checked'] ? 'checked' : '' }} style="display: none;" class="indicator-checkbox" />
                        <div class="fl-checkbox-custom" style="width: 22px; height: 22px; border-radius: 6px; border: 1.8px solid #c2410c; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: {{ $item['checked'] ? '#c2410c' : '#ffffff' }}; margin-top: 2px;">
                            <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; display: {{ $item['checked'] ? 'block' : 'none' }};">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 2px;">
                            <strong style="font-size: 0.92rem; font-weight: 700; color: #1c1917;">{{ $item['title'] }}</strong>
                            <span style="font-size: 0.78rem; color: #78716c; line-height: 1.35;">{{ $item['desc'] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>

                <!-- Subheading 2: Disiplin -->
                <div style="margin-top: 18px; margin-bottom: 8px;">
                    <span style="font-size: 0.8rem; font-weight: 800; color: #1c1917; text-transform: uppercase; letter-spacing: 0.04em;">Disiplin</span>
                </div>

                <div class="fl-check-list" style="display: flex; flex-direction: column; gap: 10px;">
                    @foreach($disiplinIndicators as $item)
                    <label class="fl-check-card {{ $item['checked'] ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; border: 1px solid #ebdcd0; border-radius: 14px; cursor: pointer; background: #ffffff;">
                        <input type="checkbox" name="disiplin[]" value="{{ $item['id'] }}" {{ $item['checked'] ? 'checked' : '' }} style="display: none;" class="indicator-checkbox" />
                        <div class="fl-checkbox-custom" style="width: 22px; height: 22px; border-radius: 6px; border: 1.8px solid #c2410c; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: {{ $item['checked'] ? '#c2410c' : '#ffffff' }}; margin-top: 2px;">
                            <svg class="check-icon" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px; display: {{ $item['checked'] ? 'block' : 'none' }};">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 2px;">
                            <strong style="font-size: 0.92rem; font-weight: 700; color: #1c1917;">{{ $item['title'] }}</strong>
                            <span style="font-size: 0.78rem; color: #78716c; line-height: 1.35;">{{ $item['desc'] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </section>

            <!-- Warning Notice Box Sesuai Figma Revisi -->
            <div style="border: 1px dashed #b45309; border-radius: 12px; background: #fffcf9; padding: 14px; display: flex; align-items: flex-start; gap: 10px; margin-bottom: 24px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#b45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 2px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <p style="font-size: 0.78rem; color: #44403c; line-height: 1.45; margin: 0;">
                    Pastikan semua data input harian telah sesuai sebelum mengirim capaian. Laporan yang sudah dikirim akan langsung diverifikasi oleh <strong>Store Manager</strong>
                </p>
            </div>

            <!-- Footer Buttons Sesuai Figma Revisi -->
            <div class="fl-step-footer">
                <div class="fl-step-btn-row">
                    <a href="{{ route('frontliner.display') }}" class="fl-btn-back" style="padding: 14px 20px; border-radius: 14px; border: 1px solid #ebdcd0; background: #ffffff; font-weight: 700; color: #1c1917; text-decoration: none; text-align: center;">Kembali</a>
                    <button type="submit" class="fl-btn-next" style="flex: 1; padding: 14px 20px; border-radius: 14px; border: none; background: #f97316; font-weight: 700; color: #ffffff; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.28);">
                        <span>Kirim Semua</span>
                    </button>
                </div>
                <div style="text-align: center; margin-top: 14px;">
                    <button type="submit" form="formLangkah6" formaction="{{ route('frontliner.draft.post') }}" style="background: none; border: none; color: #78716c; font-size: 0.8rem; font-weight: 600; cursor: pointer; text-decoration: underline;">
                        Simpan sebagai Draf Sementara
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Script Checkbox Interactivity -->
    <script>
        document.querySelectorAll('.fl-check-card').forEach(card => {
            const checkbox = card.querySelector('.indicator-checkbox');
            const customBox = card.querySelector('.fl-checkbox-custom');
            const icon = card.querySelector('.check-icon');

            card.addEventListener('click', function (e) {
                if (e.target !== checkbox) {
                    e.preventDefault(); // cegah toggle ganda dari <label>
                    checkbox.checked = !checkbox.checked;
                }
                if (checkbox.checked) {
                    card.classList.add('is-checked');
                    customBox.style.background = '#c2410c';
                    icon.style.display = 'block';
                } else {
                    card.classList.remove('is-checked');
                    customBox.style.background = '#ffffff';
                    icon.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
