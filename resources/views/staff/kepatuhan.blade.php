<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kepatuhan SOP & Disiplin (Langkah 6/6) | Frontliner Capaian.id</title>
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
                    <span class="fl-step-required-badge" style="border: 1px solid var(--primary-700); background: var(--primary-50); color: var(--primary-800); font-size: var(--fs-10); font-weight: var(--fw-semibold); padding: 3px 8px; border-radius: 6px;">WAJIB</span>
                </div>

                <!-- Subheading 1: Kepatuhan SOP -->
                <div style="margin-top: 16px; margin-bottom: 8px;">
                    <span style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-900); text-transform: uppercase; letter-spacing: 0.04em;">Kepatuhan SOP</span>
                </div>

                <div class="fl-check-list" style="display: flex; flex-direction: column; gap: 10px;">
                    @foreach($sopIndicators as $item)
                    <label class="fl-check-card {{ $item['checked'] ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; border: 1px solid var(--secondary-100); border-radius: 14px; cursor: pointer; background: var(--white);">
                        <input type="checkbox" name="sop[]" value="{{ $item['id'] }}" {{ $item['checked'] ? 'checked' : '' }} class="ds-visually-hidden indicator-checkbox" />
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

                <!-- Subheading 2: Disiplin -->
                <div style="margin-top: 18px; margin-bottom: 8px;">
                    <span style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-900); text-transform: uppercase; letter-spacing: 0.04em;">Disiplin</span>
                </div>

                <div class="fl-check-list" style="display: flex; flex-direction: column; gap: 10px;">
                    @foreach($disiplinIndicators as $item)
                    <label class="fl-check-card {{ $item['checked'] ? 'is-checked' : '' }}" style="display: flex; align-items: flex-start; gap: 12px; padding: 14px; border: 1px solid var(--secondary-100); border-radius: 14px; cursor: pointer; background: var(--white);">
                        <input type="checkbox" name="disiplin[]" value="{{ $item['id'] }}" {{ $item['checked'] ? 'checked' : '' }} class="ds-visually-hidden indicator-checkbox" />
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

            <!-- Warning Notice Box Sesuai Figma Revisi -->
            <div style="border: 1px dashed var(--warning-700); border-radius: 12px; background: var(--neutral-50); padding: 14px; display: flex; align-items: flex-start; gap: 10px; margin-bottom: 24px;">
                <x-icon name="warning-circle" width="20" height="20" style="flex-shrink: 0; margin-top: 2px; color: var(--warning-700);" />
                <p style="font-size: var(--fs-12); color: var(--neutral-700); line-height: 1.45; margin: 0;">
                    Pastikan semua data input harian telah sesuai sebelum mengirim capaian. Laporan yang sudah dikirim akan langsung diverifikasi oleh <strong>Store Manager</strong>
                </p>
            </div>

            <!-- Footer Buttons Sesuai Figma Revisi -->
            <div class="fl-step-footer">
                <div class="fl-step-btn-row">
                    <a href="{{ route('frontliner.display') }}" class="fl-btn-back" style="padding: 14px 20px; text-decoration: none; text-align: center;">Kembali</a>
                    <button type="submit" class="fl-btn-next" style="flex: 1; padding: 14px 20px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>Kirim Semua</span>
                    </button>
                </div>
                <div style="text-align: center; margin-top: 14px;">
                    <button type="submit" form="formLangkah6" formaction="{{ route('frontliner.draft.post') }}" style="background: none; border: none; color: var(--neutral-500); font-size: var(--fs-12); font-weight: 600; cursor: pointer; text-decoration: underline;">
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
