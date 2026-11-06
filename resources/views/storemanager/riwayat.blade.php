<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Capaian | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Sesuai Figma Halaman Riwayat.png -->
        <header class="fl-top-nav" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <a href="{{ route('storemanager.dashboard') }}" class="fl-nav-back-btn" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid #ebdcd0; background: #ffffff; display: flex; align-items: center; justify-content: center; color: #1c1917; text-decoration: none;" aria-label="Kembali ke Dashboard">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 style="font-size: 1.35rem; font-weight: 800; color: #1c1917; margin: 0;">Riwayat</h1>
                    <span style="font-size: 0.8rem; color: #78716c;">Capaian harian saya</span>
                </div>
            </div>
        </header>

        <!-- 2. Ringkasan Status 3 Kartu Sesuai Figma -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px;">
            <div style="background: #ffffff; border: 1.5px solid #bbf7d0; border-radius: 16px; padding: 12px; text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.74rem; font-weight: 700; color: #166534; margin-bottom: 4px;">
                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #22c55e;"></span>
                    <span>Disetujui</span>
                </div>
                <div style="font-size: 1.45rem; font-weight: 800; color: #1c1917;">{{ $summary['disetujui'] ?? 3 }}</div>
            </div>

            <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 12px; text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.74rem; font-weight: 700; color: #64748b; margin-bottom: 4px;">
                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #94a3b8;"></span>
                    <span>Menunggu</span>
                </div>
                <div style="font-size: 1.45rem; font-weight: 800; color: #1c1917;">{{ $summary['menunggu'] ?? 1 }}</div>
            </div>

            <div style="background: #ffffff; border: 1.5px solid #fed7aa; border-radius: 16px; padding: 12px; text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 6px; font-size: 0.74rem; font-weight: 700; color: #c2410c; margin-bottom: 4px;">
                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #f97316;"></span>
                    <span>Revisi</span>
                </div>
                <div style="font-size: 1.45rem; font-weight: 800; color: #1c1917;">{{ $summary['revisi'] ?? 2 }}</div>
            </div>
        </div>

        <!-- 3. Filter Chips Sesuai Figma -->
        <div class="sm-history-filters" style="display: flex; gap: 8px; margin-bottom: 20px; overflow-x: auto; padding-bottom: 6px; scrollbar-width: none;">
            <button type="button" class="history-filter-btn is-active" data-filter="semua" style="padding: 7px 18px; border-radius: 999px; border: none; background: #f97316; color: #ffffff; font-size: 0.8rem; font-weight: 700; cursor: pointer; white-space: nowrap;">
                Semua ({{ $summary['semua'] ?? 6 }})
            </button>
            <button type="button" class="history-filter-btn" data-filter="disetujui" style="padding: 7px 18px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; cursor: pointer; white-space: nowrap;">
                Disetujui ({{ $summary['disetujui'] ?? 3 }})
            </button>
            <button type="button" class="history-filter-btn" data-filter="menunggu" style="padding: 7px 18px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; cursor: pointer; white-space: nowrap;">
                Menunggu ({{ $summary['menunggu'] ?? 1 }})
            </button>
            <button type="button" class="history-filter-btn" data-filter="revisi" style="padding: 7px 18px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; cursor: pointer; white-space: nowrap;">
                Revisi ({{ $summary['revisi'] ?? 2 }})
            </button>
        </div>

        <!-- 4. Daftar Riwayat Capaian Sesuai Figma -->
        <div class="history-items-list" style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;">
            @foreach($historyList as $item)
            @php
                $detailUrl = route('storemanager.riwayat.detail', ['id' => $item['id']]) . ($item['status'] === 'revisi' ? '?status=revisi' : '');
            @endphp
            <a href="{{ $detailUrl }}" class="history-card-item" data-status="{{ $item['status'] }}" style="display: flex; align-items: center; justify-content: space-between; background: #fffdfa; border: 1px solid #ebdcd0; border-radius: 16px; padding: 14px 16px; text-decoration: none; color: inherit; transition: all 0.2s ease;">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <!-- Tanggal Box -->
                    <div style="text-align: center; min-width: 38px;">
                        <span style="display: block; font-size: 0.72rem; font-weight: 700; color: #78716c;">{{ $item['day_name'] }}</span>
                        <span style="display: block; font-size: 1.15rem; font-weight: 800; color: #1c1917; line-height: 1;">{{ $item['day_num'] }}</span>
                    </div>

                    <!-- Detail Capaian -->
                    <div>
                        <span style="display: block; font-size: 0.88rem; font-weight: 800; color: #1c1917; margin-bottom: 2px;">{{ $item['date_formatted'] }}</span>
                        <span style="display: block; font-size: 0.74rem; color: #78716c;">{{ $item['checklist_text'] }}</span>
                    </div>
                </div>

                <!-- Status Badge dengan Panah Kanan Sesuai Figma -->
                <div style="display: flex; align-items: center; gap: 6px;">
                    @if($item['status'] === 'disetujui')
                    <span style="background: #22c55e; color: #ffffff; font-size: 0.72rem; font-weight: 700; padding: 4px 12px; border-radius: 999px;">
                        Disetujui
                    </span>
                    @elseif($item['status'] === 'menunggu')
                    <span style="background: #8c7b6d; color: #ffffff; font-size: 0.72rem; font-weight: 700; padding: 4px 12px; border-radius: 999px;">
                        Menunggu
                    </span>
                    @elseif($item['status'] === 'revisi')
                    <span style="background: #ea580c; color: #ffffff; font-size: 0.72rem; font-weight: 700; padding: 4px 12px; border-radius: 999px;">
                        Revisi
                    </span>
                    @endif
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a8a29e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>

        <!-- 5. Indikator Bentuk Status Box Sesuai Figma -->
        <div style="background: #fff8f3; border: 1.5px solid #fed7aa; border-radius: 14px; padding: 14px; margin-bottom: 28px;">
            <span style="display: block; font-size: 0.75rem; font-weight: 800; color: #1c1917; margin-bottom: 8px;">Indikator Bentuk Status:</span>
            <div style="display: flex; align-items: center; justify-content: flex-start; gap: 14px; font-size: 0.74rem; color: #78716c; flex-wrap: wrap;">
                <span style="display: inline-flex; align-items: center; gap: 5px;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span>
                    <span>Hijau = Disetujui</span>
                </span>
                <span style="display: inline-flex; align-items: center; gap: 5px;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #94a3b8;"></span>
                    <span>Abu-abu = Menunggu</span>
                </span>
                <span style="display: inline-flex; align-items: center; gap: 5px;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #ea580c;"></span>
                    <span>Kuning/Oranye = Revisi</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Script Filtering Riwayat -->
    <script>
        document.querySelectorAll('.history-filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.history-filter-btn').forEach(b => {
                    b.style.background = '#ffffff';
                    b.style.color = '#78716c';
                    b.style.borderColor = '#ebdcd0';
                    b.classList.remove('is-active');
                });
                this.style.background = '#f97316';
                this.style.color = '#ffffff';
                this.style.borderColor = '#f97316';
                this.classList.add('is-active');

                const filter = this.getAttribute('data-filter');
                document.querySelectorAll('.history-card-item').forEach(card => {
                    const status = card.getAttribute('data-status');
                    if (filter === 'semua' || status === filter) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>

