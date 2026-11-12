<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Training Karyawan | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
    <style>
        .tr-header { display: flex; align-items: center; justify-content: space-between; margin: 0 -16px 20px; padding: 0 16px 14px; border-bottom: 1px solid #ebe5df; }
        .tr-title { font-size: 1.45rem; font-weight: 800; color: #1c1917; margin: 0; letter-spacing: -0.02em; }
        .tr-sub { font-size: 0.84rem; color: #78716c; margin: 4px 0 14px; }
        .tr-card { background: #fbf8f5; border: 2px solid #f97316; border-radius: 16px; padding: 16px; margin-bottom: 16px; }
        .tr-card-head { display: flex; align-items: center; justify-content: space-between; }
        .tr-card-label { font-size: 0.9rem; font-weight: 700; color: #1c1917; }
        .tr-tag { border: 1.5px solid #c2410c; background: #fff7ed; color: #9a3412; font-size: 0.66rem; font-weight: 800; letter-spacing: 0.04em; padding: 2px 8px; border-radius: 5px; }
        .tr-count { font-size: 2.2rem; font-weight: 800; color: #1c1917; margin: 10px 0 6px; letter-spacing: -0.02em; }
        .tr-count.is-met { color: #16a34a; }
        .tr-target { font-size: 0.78rem; color: #78716c; }
        .tr-divider { border: none; border-top: 1px solid #e7ddd3; margin: 0 0 12px; }
        .tr-btn { width: 100%; padding: 14px; border-radius: 14px; border: none; background: #f97316; color: #ffffff; font: inherit; font-size: 0.92rem; font-weight: 800; cursor: pointer; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.28); margin-bottom: 16px; }
        .tr-list-title { font-size: 0.95rem; font-weight: 700; color: #1c1917; margin: 0 0 6px; }
        .tr-row { display: grid; grid-template-columns: 1fr 1.25fr auto; gap: 10px; align-items: center; padding: 10px 0; font-size: 0.84rem; color: #1c1917; border-bottom: 1px solid #e7ddd3; }
        .tr-row:last-child { border-bottom: none; }
        .tr-row span:last-child { text-align: right; white-space: nowrap; }
        .tr-form { background: #fbf8f5; border: 1px solid #ebdcd0; border-radius: 16px; padding: 16px; margin-bottom: 16px; box-shadow: 0 6px 18px rgba(50, 30, 20, 0.06); }
        .tr-form[hidden] { display: none; }
        .tr-form h2 { font-size: 0.95rem; font-weight: 800; margin: 0 0 12px; color: #1c1917; }
        .tr-field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 12px; }
        .tr-field label { font-size: 0.78rem; font-weight: 600; color: #57534e; }
        .tr-field input { font: inherit; font-size: 0.92rem; padding: 12px; border: 1px solid #e7ddd3; border-radius: 10px; background: #ffffff; color: #1c1917; }
        .tr-field input:focus { outline: 2px solid #f97316; outline-offset: 1px; }
        .tr-error { font-size: 0.74rem; color: #b91c1c; }
        .tr-flash { background: #ecfdf5; border: 1px solid #86efac; color: #15803d; border-radius: 12px; padding: 10px 14px; font-size: 0.82rem; font-weight: 600; margin-bottom: 14px; }
        .tr-empty { font-size: 0.8rem; color: #a8a29e; padding: 8px 0; }
    </style>
</head>

<body>
    <div class="app-container">
        <header class="tr-header">
            <a href="{{ route('storemanager.operasional_sdm') }}" class="fl-step-close-btn" aria-label="Kembali ke Operasional & SDM">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <span class="fl-step-badge" style="background: #fff7ed; border: 1px solid #fed7aa; color: #c2410c; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 6px;">STORE MANAGER</span>
        </header>

        @if (session('status'))
            <div class="tr-flash" role="status">{{ session('status') }}</div>
        @endif

        <h1 class="tr-title">Training Karyawan</h1>
        <p class="tr-sub">Catat training yang sudah dilaksanakan</p>

        <section class="tr-card" aria-label="Capaian training bulan ini">
            <div class="tr-card-head">
                <span class="tr-card-label">Bulan Ini</span>
                <span class="tr-tag">BULANAN</span>
            </div>
            <div class="tr-count {{ $summary['done'] >= $summary['target'] ? 'is-met' : '' }}">{{ $summary['done'] }}/{{ $summary['target'] }}</div>
            <span class="tr-target">Target: minimal {{ $summary['target'] }}× per bulan</span>
        </section>

        <hr class="tr-divider" />

        <button type="button" class="tr-btn" id="toggleForm" aria-controls="trainingForm" aria-expanded="{{ $errors->any() ? 'true' : 'false' }}">Catat Training Baru</button>

        <form action="{{ route('storemanager.training.post') }}" method="POST" class="tr-form" id="trainingForm" @unless ($errors->any()) hidden @endunless>
            @csrf
            <h2>Catat Training Baru</h2>

            <div class="tr-field">
                <label for="date">Tanggal Pelaksanaan</label>
                <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" max="{{ now()->format('Y-m-d') }}" required />
                @error('date') <span class="tr-error">{{ $message }}</span> @enderror
            </div>

            <div class="tr-field">
                <label for="topic">Topik Training</label>
                <input type="text" id="topic" name="topic" value="{{ old('topic') }}" placeholder="Contoh: Product Knowledge Lanjutan" maxlength="120" required />
                @error('topic') <span class="tr-error">{{ $message }}</span> @enderror
            </div>

            <div class="tr-field">
                <label for="participants">Jumlah Peserta</label>
                <input type="number" id="participants" name="participants" value="{{ old('participants') }}" placeholder="Contoh: 12" min="1" max="500" inputmode="numeric" required />
                @error('participants') <span class="tr-error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="tr-btn" style="margin-bottom: 0;">Simpan Training</button>
        </form>

        <section class="tr-card" aria-labelledby="riwayat-training">
            <h2 class="tr-list-title" id="riwayat-training">Riwayat Training</h2>
            @forelse ($trainings as $t)
                <div class="tr-row">
                    <span>{{ $t['date_label'] }}</span>
                    <span>{{ $t['topic'] }}</span>
                    <span>{{ $t['participants'] }} orang</span>
                </div>
            @empty
                <p class="tr-empty">Belum ada training yang dicatat.</p>
            @endforelse
        </section>
    </div>

    <script>
        const toggle = document.getElementById('toggleForm');
        const form = document.getElementById('trainingForm');
        toggle.addEventListener('click', () => {
            form.hidden = !form.hidden;
            toggle.setAttribute('aria-expanded', String(!form.hidden));
            if (!form.hidden) document.getElementById('topic').focus();
        });
    </script>
</body>

</html>
