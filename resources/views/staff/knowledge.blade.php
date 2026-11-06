<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Knowledge (Langkah 3/6) | Frontliner Capaian.id</title>
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

        <!-- 2. 6-Segment Stepper Progress Sesuai Figma Revisi -->
        <div class="fl-stepper-progress">
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-inactive"></div>
            <div class="fl-step-pill is-inactive"></div>
            <div class="fl-step-pill is-inactive"></div>
        </div>

        <div class="fl-step-meta-row">
            <span class="fl-step-current-text">Langkah 3 dari 6</span>
            <span class="fl-step-category-text">Product Knowledge</span>
        </div>

        <!-- 3. Judul & Subtitle Sesuai Figma Revisi -->
        <h1 class="fl-step-page-title">Product Knowledge</h1>
        <p class="fl-step-page-sub">Input total perolehan transaksi kasir shift hari ini.</p>

        <!-- Form Pengisian Langkah 3 -->
        <form action="{{ route('frontliner.knowledge.post') }}" method="POST" id="formLangkah3">
            @csrf

            <!-- Card: Indikator Penilaian -->
            <section class="fl-step-card" style="margin-bottom: 20px;">
                <div class="fl-step-card-header">
                    <div class="fl-step-card-titles">
                        <h2 class="fl-step-card-title">Indikator Penilaian</h2>
                        <span class="fl-step-card-sub">Centang indikator yang dipenuhi hari ini</span>
                    </div>
                </div>

                <div class="fl-check-list" style="margin-top: 14px; display: flex; flex-direction: column; gap: 10px;">
                    @foreach($indicators as $index => $item)
                    <label class="fl-check-card {{ $item['checked'] ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; border: 1px solid #ebdcd0; border-radius: 14px; cursor: pointer; background: #ffffff;">
                        <input type="checkbox" name="indicators[]" value="{{ $item['id'] }}" {{ $item['checked'] ? 'checked' : '' }} style="display: none;" class="indicator-checkbox" />
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

            <!-- Info Notice Box Sesuai Figma Revisi -->
            <div style="border: 1px dashed #b45309; border-radius: 12px; background: #fffcf9; padding: 12px 14px; display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#b45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <p style="font-size: 0.78rem; color: #44403c; line-height: 1.4; margin: 0;">
                    Ketuk baris untuk menandai ceklis selesai dikerjakan.
                </p>
            </div>

            <!-- Footer Buttons Sesuai Figma Revisi -->
            <div class="fl-step-footer">
                <div class="fl-step-btn-row">
                    <a href="{{ route('frontliner.pelayanan') }}" class="fl-btn-back" style="padding: 14px 20px; border-radius: 14px; border: 1px solid #ebdcd0; background: #ffffff; font-weight: 700; color: #1c1917; text-decoration: none; text-align: center;">Kembali</a>
                    <button type="submit" class="fl-btn-next" style="flex: 1; padding: 14px 20px; border-radius: 14px; border: none; background: #f97316; font-weight: 700; color: #ffffff; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.28);">
                        <span>Lanjut</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </div>
                <span class="fl-step-footer-text" style="display: block; text-align: center; margin-top: 10px; font-size: 0.75rem; color: #a8a29e;">Langkah 3 dari 6</span>
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
