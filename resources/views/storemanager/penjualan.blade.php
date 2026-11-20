<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penjualan | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma (Tombol X, Progress 5-Langkah, Badge STORE MANAGER) -->
        <header class="fl-step-header">
            <a href="{{ route('storemanager.dashboard') }}" class="fl-step-close-btn" aria-label="Batal dan kembali ke dashboard">
                <x-icon name="cancel" />
            </a>

            <!-- 5-Steps Indicator (Langkah 1 Aktif) -->
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px;">
                <div class="produksi-steps-bar" style="display: flex; gap: 6px;">
                    <div class="produksi-step-pill is-active" style="width: 28px; height: 6px; border-radius: 999px; background: var(--primary-500);"></div>
                    <div class="produksi-step-pill" style="width: 28px; height: 6px; border-radius: 999px; background: var(--secondary-100);"></div>
                    <div class="produksi-step-pill" style="width: 28px; height: 6px; border-radius: 999px; background: var(--secondary-100);"></div>
                    <div class="produksi-step-pill" style="width: 28px; height: 6px; border-radius: 999px; background: var(--secondary-100);"></div>
                    <div class="produksi-step-pill" style="width: 28px; height: 6px; border-radius: 999px; background: var(--secondary-100);"></div>
                </div>
            </div>

            <span class="fl-step-badge" style="background: var(--primary-50); border: 1px solid var(--primary-200); color: var(--primary-700); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 4px 10px; border-radius: 999px;">STORE MANAGER</span>
        </header>

        <!-- Subheader Langkah -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; font-size: var(--fs-12); font-weight: 600;">
            <span style="color: var(--neutral-900);">Langkah 1 dari 5</span>
            <span style="color: var(--neutral-500);">Penjualan</span>
        </div>

        <!-- 2. Judul Halaman Sesuai Figma -->
        <div class="fl-step-title-group" style="margin-bottom: 20px;">
            <h1 class="fl-step-title" style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0 0 4px;">Penjualan</h1>
            <p class="fl-step-subtitle" style="font-size: var(--fs-14); color: var(--neutral-500); margin: 0;">Centang indikator yang tercapai hari ini</p>
        </div>

        <form action="{{ route('storemanager.penjualan.post') }}" method="POST" id="formPenjualan">
            @csrf

            <!-- 3. KARTU INDIKATOR PENILAIAN -->
            <section class="fl-step-card" style="background: var(--white); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 18px; margin-bottom: 20px;" aria-labelledby="heading-penjualan">
                <div class="fl-step-card-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <h2 class="fl-step-card-title" id="heading-penjualan" style="font-size: var(--fs-14); font-weight: var(--fw-semibold); letter-spacing: 0.05em; color: var(--neutral-900); margin: 0;">INDIKATOR PENILAIAN</h2>
                    <span class="fl-step-card-tag" style="background: var(--primary-100); color: var(--primary-700); font-size: var(--fs-10); font-weight: var(--fw-semibold); padding: 2px 8px; border-radius: 6px;">WAJIB</span>
                </div>
                <p class="fl-step-card-sub" style="font-size: var(--fs-12); color: var(--neutral-500); margin: 0 0 16px;">Centang indikator yang dipenuhi hari ini sesuai target penjualan toko roti.</p>

                <!-- Section: PENJUALAN -->
                <span class="produksi-section-label" style="display: block; font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-400); letter-spacing: 0.05em; margin-bottom: 10px;">PENJUALAN</span>
                
                @foreach($indicators as $indicator)
                <label class="sm-check-card {{ !empty($indicator['checked']) ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; background: {{ !empty($indicator['checked']) ? 'var(--secondary-50)' : 'var(--secondary-50)' }}; border: 1.5px solid {{ !empty($indicator['checked']) ? 'var(--primary-500)' : 'var(--secondary-100)' }}; border-radius: 14px; margin-bottom: 10px; cursor: pointer; transition: all 0.2s ease;">
                    <input class="ds-visually-hidden" type="checkbox" name="indicators[{{ $indicator['id'] }}]" value="1" {{ !empty($indicator['checked']) ? 'checked' : '' }} />
                    <div class="sm-check-box" style="width: 22px; height: 22px; border-radius: 6px; border: 2px solid {{ !empty($indicator['checked']) ? 'var(--primary-500)' : 'var(--neutral-300)' }}; background: {{ !empty($indicator['checked']) ? 'var(--primary-500)' : 'var(--white)' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                        <x-icon name="check" class="sm-check-icon" style="width: 14px; height: 14px; {{ !empty($indicator['checked']) ? '' : 'display: none;' }}; color: var(--white);" />
                    </div>
                    <div class="sm-check-info" style="flex: 1;">
                        <span class="sm-check-title" style="display: block; font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900); margin-bottom: 3px;">{{ $indicator['title'] }}</span>
                        <span class="sm-check-sub" style="display: block; font-size: var(--fs-12); color: var(--neutral-500); line-height: 1.35;">{{ $indicator['desc'] }}</span>
                    </div>
                </label>
                @endforeach
            </section>

            <!-- 4. Dashed Notice Bottom Box Sesuai Figma -->
            <div class="produksi-notice-dashed" style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; background: var(--secondary-50); border: 1.5px dashed var(--primary-200); border-radius: 12px; font-size: var(--fs-12); color: var(--primary-800); margin-bottom: 24px;">
                <x-icon name="info-empty" width="18" height="18" style="flex-shrink: 0;" />
                <span>Ketuk baris untuk menandai ceklis selesai dikerjakan.</span>
            </div>

            <!-- 5. Action Buttons (Kembali & Lanjut) Sesuai Figma -->
            <div class="fl-btn-row" style="display: flex; gap: 12px;">
                <a href="{{ route('storemanager.dashboard') }}" class="fl-btn-back" style="flex: 1; padding: 14px; text-decoration: none; text-align: center;">
                    Kembali
                </a>
                <button type="submit" class="fl-btn-next" style="flex: 2; padding: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span>Lanjut</span>
                    <span aria-hidden="true">&rarr;</span>
                </button>
            </div>

            <div style="text-align: center; margin-top: 14px; margin-bottom: 24px; font-size: var(--fs-12); color: var(--neutral-400);">
                Langkah 1 dari 5
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
                    e.preventDefault(); // cegah toggle ganda dari <label>
                    input.checked = !input.checked;
                }
                
                if (input.checked) {
                    this.style.background = '#fff8f3';
                    this.style.borderColor = '#f97316';
                    box.style.background = '#f97316';
                    box.style.borderColor = '#f97316';
                } else {
                    this.style.background = '#faf6f0';
                    this.style.borderColor = '#ebdcd0';
                    box.style.background = '#ffffff';
                    box.style.borderColor = '#cbd5e1';
                }
            });
        });
    </script>
</body>

</html>

