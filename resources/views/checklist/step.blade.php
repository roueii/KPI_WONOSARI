@extends('checklist.layout')

@section('title', $step['title'])

@php
    $r = $cfg['route'];
    $upload = $step['upload'] ?? null;
@endphp

@section('content')
    {{-- 1. Header: tombol tutup, badge role, progress langkah --}}
    <header class="ck-step-header">
        <div class="ck-step-top">
            <a href="{{ route($r . '.dashboard') }}" class="fl-step-close-btn" aria-label="Batal dan kembali ke dashboard">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
            <span class="fl-step-badge">{{ $cfg['badge'] }}</span>
        </div>

        <div class="ck-steps-bar" style="--ck-steps: {{ $totalSteps }};" role="progressbar" aria-valuemin="1" aria-valuemax="{{ $totalSteps }}" aria-valuenow="{{ $stepNumber }}" aria-label="Langkah {{ $stepNumber }} dari {{ $totalSteps }}">
            @for ($i = 1; $i <= $totalSteps; $i++)
                <span class="ck-step-pill {{ $i < $stepNumber ? 'is-done' : '' }} {{ $i === $stepNumber ? 'is-current' : '' }}"></span>
            @endfor
        </div>

        <div class="ck-step-meta">
            <strong>Langkah {{ $stepNumber }} dari {{ $totalSteps }}</strong>
            <span>{{ $step['title'] }}</span>
        </div>
    </header>

    {{-- 2. Judul --}}
    <div class="ck-step-title-group">
        <h1 class="ck-step-title">{{ $step['title'] }}</h1>
        <p class="ck-step-subtitle">{{ $step['subtitle'] }}</p>
    </div>

    <form action="{{ route($r . '.step.post', $slug) }}" method="POST" id="stepForm" @if ($upload) enctype="multipart/form-data" @endif>
        @csrf

        @if ($errors->any())
            <div class="ck-error" role="alert">{{ $errors->first() }}</div>
        @endif

        {{-- 3. Kartu indikator --}}
        <section class="ck-card" aria-labelledby="heading-indikator">
            <div class="ck-card-header">
                <h2 class="ck-card-title" id="heading-indikator">{{ $step['card_title'] }}</h2>
                <span class="ck-tag">{{ $step['tag'] }}</span>
            </div>
            <p class="ck-card-sub">{{ $step['card_sub'] }}</p>

            <div class="ck-check-list">
                @foreach ($step['items'] as $key => [$title, $desc])
                    <label class="driver-check-card {{ !empty($checked[$key]) ? 'is-checked' : '' }}">
                        <input type="checkbox" class="ck-check-input" name="indicators[{{ $key }}]" value="1" @checked(!empty($checked[$key])) />
                        <span class="driver-check-box" aria-hidden="true">
                            <svg class="driver-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </span>
                        <span class="driver-check-info">
                            <span class="driver-check-title">{{ $title }}</span>
                            <span class="driver-check-sub">{{ $desc }}</span>
                        </span>
                    </label>
                @endforeach
            </div>
        </section>

        {{-- 4. Unggah lampiran (opsional per langkah) --}}
        @if ($upload)
            <section class="ck-card" aria-labelledby="heading-upload">
                <div class="ck-card-header">
                    <h2 class="ck-card-title is-plain" id="heading-upload">{{ $upload['title'] }}</h2>
                    <span class="ck-tag">{{ $upload['tag'] }}</span>
                </div>
                <p class="ck-card-sub">{{ $upload['desc'] }}</p>

                <label class="ck-upload-zone" for="attachmentInput">
                    <input type="file" id="attachmentInput" name="attachments[]" multiple accept="image/jpeg,image/png,application/pdf" class="ck-visually-hidden" />
                    <span class="ck-upload-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                            <circle cx="12" cy="13" r="4"></circle>
                        </svg>
                    </span>
                    <span class="ck-upload-title">Ketuk untuk unggah foto</span>
                    <span class="ck-upload-hint">{{ $upload['hint'] }}</span>
                </label>

                <div class="ck-chips" id="attachmentChips" aria-live="polite">
                    @foreach ($attachments as $name)
                        <span class="ck-chip"><span class="ck-chip-name">{{ $name }}</span></span>
                    @endforeach
                </div>

                <button type="button" class="ck-example-link" onclick="alert(@js($upload['example']))">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span>Lihat contoh foto yang benar</span>
                </button>
            </section>
        @endif

        {{-- 5. Catatan --}}
        @if (!empty($step['notice']))
            <div class="driver-notice-dashed">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <span>{!! $step['notice'] !!}</span>
            </div>
        @endif

        {{-- 6. Tombol aksi --}}
        <div class="ck-step-footer">
            @if ($isLast)
                <div class="ck-btn-row">
                    @if ($cfg['last_has_back'] && $prevUrl)
                        <a href="{{ $prevUrl }}" class="fl-btn-back">Kembali</a>
                    @endif
                    <button type="submit" class="fl-btn-next">{{ $cfg['last_submit_label'] }}</button>
                </div>
                <button type="button" class="ck-draft-link" id="saveDraftBtn">Simpan sebagai Draf Sementara</button>
            @else
                <div class="ck-btn-row">
                    @if ($prevUrl)
                        <a href="{{ $prevUrl }}" class="fl-btn-back">Kembali</a>
                    @endif
                    <button type="submit" class="fl-btn-next">
                        <span>Lanjut</span>
                        <span aria-hidden="true">&rarr;</span>
                    </button>
                </div>
                <span class="ck-step-footer-text">Langkah {{ $stepNumber }} dari {{ $totalSteps }}</span>
            @endif
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Sinkronkan tampilan kartu dengan status checkbox (label native yang men-toggle input).
        document.querySelectorAll('.ck-check-input').forEach(input => {
            input.addEventListener('change', () => {
                input.closest('.driver-check-card').classList.toggle('is-checked', input.checked);
            });
        });

        const attachmentInput = document.getElementById('attachmentInput');
        attachmentInput?.addEventListener('change', () => {
            const chips = document.getElementById('attachmentChips');
            chips.innerHTML = '';
            [...attachmentInput.files].forEach(file => {
                const chip = document.createElement('span');
                chip.className = 'ck-chip';
                const name = document.createElement('span');
                name.className = 'ck-chip-name';
                name.textContent = file.name;
                chip.appendChild(name);
                chips.appendChild(chip);
            });
        });

        document.getElementById('saveDraftBtn')?.addEventListener('click', async () => {
            const form = document.getElementById('stepForm');
            const data = new FormData(form);
            data.delete('attachments[]');
            data.append('step', @js($slug));
            try {
                const res = await fetch(@js(route($r . '.draft.post')), {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    body: data,
                });
                const json = await res.json();
                alert(json.message || 'Draf tersimpan.');
                window.location.href = json.redirect || @js(route($r . '.dashboard'));
            } catch (e) {
                alert('Gagal menyimpan draf. Periksa koneksi Anda lalu coba lagi.');
            }
        });
    </script>
@endpush
