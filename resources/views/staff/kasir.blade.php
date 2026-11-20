<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Akurasi Kasir (Langkah 4/6) | Frontliner Capaian.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontliner.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Top Navigation Bar Sesuai Figma Revisi -->
        <header class="fl-step-header">
            <a href="{{ route('frontliner.dashboard') }}" class="fl-step-close-btn" aria-label="Tutup dan kembali ke Dashboard">
                <x-icon name="cancel" />
            </a>
            <span class="fl-step-badge">FRONTLINER</span>
        </header>

        <!-- 2. 6-Segment Stepper Progress Sesuai Figma Revisi -->
        <div class="fl-stepper-progress">
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-active"></div>
            <div class="fl-step-pill is-inactive"></div>
            <div class="fl-step-pill is-inactive"></div>
        </div>

        <div class="fl-step-meta-row">
            <span class="fl-step-current-text">Langkah 4 dari 6</span>
            <span class="fl-step-category-text">Akurasi Kasir</span>
        </div>

        <!-- 3. Judul & Subtitle Sesuai Figma Revisi -->
        <h1 class="fl-step-page-title">Akurasi Kasir</h1>
        <p class="fl-step-page-sub">Input total perolehan transaksi kasir shift hari ini.</p>

        <!-- Form Pengisian Langkah 4 -->
        <form action="{{ route('frontliner.kasir.post') }}" method="POST" id="formLangkah4">
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
                    <label class="fl-check-card {{ $item['checked'] ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; border: 1px solid var(--secondary-100); border-radius: 14px; cursor: pointer; background: var(--white);">
                        <input type="checkbox" name="indicators[]" value="{{ $item['id'] }}" {{ $item['checked'] ? 'checked' : '' }} class="ds-visually-hidden indicator-checkbox" />
                        <div class="fl-checkbox-custom">
                            <x-icon name="check" class="check-icon" style="color: var(--white);" />
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 2px;">
                            <strong style="font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900);">{{ $item['title'] }}</strong>
                            <span style="font-size: var(--fs-12); color: var(--neutral-500); line-height: 1.35;">{{ $item['desc'] }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </section>

            <!-- Info Notice Box Sesuai Figma Revisi -->
            <div style="border: 1px dashed var(--warning-700); border-radius: 12px; background: var(--neutral-50); padding: 12px 14px; display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">
                <x-icon name="warning-circle" width="18" height="18" style="flex-shrink: 0; color: var(--warning-700);" />
                <p style="font-size: var(--fs-12); color: var(--neutral-700); line-height: 1.4; margin: 0;">
                    Ketuk baris untuk menandai ceklis selesai dikerjakan.
                </p>
            </div>

            <!-- Footer Buttons Sesuai Figma Revisi -->
            <div class="fl-step-footer">
                <div class="fl-step-btn-row">
                    <a href="{{ route('frontliner.knowledge') }}" class="fl-btn-back" style="padding: 14px 20px; text-decoration: none; text-align: center;">Kembali</a>
                    <button type="submit" class="fl-btn-next" style="flex: 1; padding: 14px 20px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>Lanjut</span>
                        <x-icon name="arrow-right" width="18" height="18" />
                    </button>
                </div>
                <span class="fl-step-footer-text" style="display: block; text-align: center; margin-top: 10px; font-size: var(--fs-12); color: var(--neutral-400);">Langkah 4 dari 6</span>
            </div>
        </form>
    </div>

    <!-- Script Checkbox Interactivity -->
    <script>
        document.querySelectorAll('.fl-check-card').forEach(card => {
            const checkbox = card.querySelector('.indicator-checkbox');

            card.addEventListener('click', function (e) {
                if (e.target !== checkbox) {
                    e.preventDefault(); // cegah toggle ganda dari <label>
                    checkbox.checked = !checkbox.checked;
                }
                if (checkbox.checked) {
                    card.classList.add('is-checked');
                } else {
                    card.classList.remove('is-checked');
                }
            });
        });
    </script>
</body>

</html>
