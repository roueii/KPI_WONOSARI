<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penjualan (Langkah 1/6) | Frontliner Capaian.id</title>
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
            <div class="fl-step-pill is-inactive"></div>
            <div class="fl-step-pill is-inactive"></div>
            <div class="fl-step-pill is-inactive"></div>
            <div class="fl-step-pill is-inactive"></div>
            <div class="fl-step-pill is-inactive"></div>
        </div>

        <div class="fl-step-meta-row">
            <span class="fl-step-current-text">Langkah 1 dari 6</span>
            <span class="fl-step-category-text">Penjualan</span>
        </div>

        <!-- 3. Judul & Subtitle Sesuai Figma Revisi -->
        <h1 class="fl-step-page-title">Penjualan</h1>
        <p class="fl-step-page-sub">Input total perolehan transaksi kasir shift hari ini.</p>

        <!-- Form Pengisian Langkah 1 -->
        <form action="{{ route('frontliner.penjualan.post') }}" method="POST" id="formLangkah1" enctype="multipart/form-data">
            @csrf

            <!-- Card 1: Indikator Penilaian -->
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

            <!-- Card 2: Unggah Bukti Foto -->
            <section class="fl-step-card" style="margin-bottom: 20px;">
                <div class="fl-step-card-header">
                    <div class="fl-step-card-titles">
                        <h2 class="fl-step-card-title">Unggah Bukti Foto</h2>
                        <span class="fl-step-card-sub">Dokumentasi Frontliner</span>
                    </div>
                    <span class="fl-step-required-badge" style="border: 1px solid var(--primary-700); background: var(--primary-50); color: var(--primary-800); font-size: var(--fs-10); font-weight: var(--fw-semibold); padding: 3px 8px; border-radius: 6px;">WAJIB SEBELUM LANJUT</span>
                </div>

                <!-- Area Unggah Dashed -->
                <div class="fl-upload-dashed-box" id="dropArea" style="border: 2px dashed var(--primary-700); border-radius: 14px; padding: 24px 16px; text-align: center; margin-top: 14px; background: var(--neutral-50); cursor: pointer;">
                    <input type="file" id="fotoInput" name="photos[]" multiple accept="image/*" style="display: none;" />
                    <div style="width: 44px; height: 44px; border-radius: 50%; border: 1.5px solid var(--secondary-100); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; color: var(--neutral-500);">
                        <x-icon name="camera" style="width: 22px; height: 22px;" />
                    </div>
                    <strong style="font-size: var(--fs-16); font-weight: var(--fw-semibold); color: var(--neutral-900); display: block;">Ketuk untuk unggah foto</strong>
                    <span style="font-size: var(--fs-12); color: var(--neutral-500); margin-top: 4px; display: block;">Format JPG/PNG, maks. 5MB.</span>
                </div>

                <!-- Preview Thumbnail Foto Sesuai Figma -->
                <div class="fl-photo-preview-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-top: 12px;">
                    @foreach($existingPhotos as $photo)
                    <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid var(--secondary-100); border-radius: 10px; padding: 8px 10px; background: var(--white); font-size: var(--fs-12); color: var(--neutral-900);">
                        <div style="display: flex; align-items: center; gap: 6px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <x-icon name="media-image" width="14" height="14" style="flex-shrink: 0; color: var(--neutral-500);" />
                            <span style="overflow: hidden; text-overflow: ellipsis;">{{ $photo['name'] }}</span>
                        </div>
                        <button type="button" style="background: none; border: none; color: var(--neutral-500); cursor: pointer; padding: 0 4px;" onclick="this.parentElement.remove();">&times;</button>
                    </div>
                    @endforeach
                </div>

                <!-- Link Contoh Foto Benar Sesuai Figma -->
                <div style="display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 14px; font-size: var(--fs-12); color: var(--neutral-900); font-weight: 600; cursor: pointer;">
                    <x-icon name="eye-empty" width="16" height="16" />
                    <span>Lihat contoh foto yang benar</span>
                </div>
            </section>

            <!-- Warning Notice Box Sesuai Figma Revisi -->
            <div style="border: 1px dashed var(--warning-700); border-radius: 12px; background: var(--neutral-50); padding: 12px 14px; display: flex; align-items: flex-start; gap: 10px; margin-bottom: 24px;">
                <x-icon name="warning-circle" width="18" height="18" style="flex-shrink: 0; margin-top: 2px; color: var(--warning-700);" />
                <p style="font-size: var(--fs-12); color: var(--neutral-700); line-height: 1.4; margin: 0;">
                    Semua indikator penilaian dan 1 foto bukti wajib dilengkapi sebelum Anda dapat melangkah ke tahap <strong>Selanjutnya</strong>.
                </p>
            </div>

            <!-- Footer Buttons Sesuai Figma Revisi -->
            <div class="fl-step-footer">
                <div class="fl-step-btn-row">
                    <a href="{{ route('frontliner.dashboard') }}" class="fl-btn-back" style="padding: 14px 20px; text-decoration: none; text-align: center;">Kembali</a>
                    <button type="submit" class="fl-btn-next" style="flex: 1; padding: 14px 20px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>Lanjut</span>
                        <x-icon name="arrow-right" width="18" height="18" />
                    </button>
                </div>
                <span class="fl-step-footer-text" style="display: block; text-align: center; margin-top: 10px; font-size: var(--fs-12); color: var(--neutral-400);">Langkah 1 dari 6</span>
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

        // Drop Area
        const dropArea = document.getElementById('dropArea');
        const fotoInput = document.getElementById('fotoInput');
        dropArea?.addEventListener('click', () => fotoInput?.click());
    </script>
</body>

</html>
