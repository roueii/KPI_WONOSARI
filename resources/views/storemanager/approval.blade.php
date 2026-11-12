<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approval Tim | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Sesuai Desain Figma Halaman Approval Tim.png -->
        <header class="fl-top-nav" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <a href="{{ route('storemanager.dashboard', ['tab' => 'tim']) }}" class="fl-nav-back-btn" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid #ebdcd0; background: #ffffff; display: flex; align-items: center; justify-content: center; color: #1c1917; text-decoration: none;" aria-label="Kembali ke Dashboard">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 style="font-size: 1.35rem; font-weight: 800; color: #1c1917; margin: 0;">Approval Tim</h1>
                    <span style="font-size: 0.8rem; color: #78716c;">Capaian harian Tim</span>
                </div>
            </div>
        </header>

        <!-- Flash Message jika ada aksi -->
        @if(session('status'))
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 14px; padding: 12px 16px; margin-bottom: 16px; color: #166534; font-size: 0.82rem; font-weight: 700; display: flex; align-items: center; gap: 8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>{{ session('status') }}</span>
        </div>
        @endif

        <!-- 2. Filter Chips Sesuai Figma -->
        <div class="sm-filter-row" style="display: flex; gap: 8px; overflow-x: auto; padding-bottom: 8px; margin-bottom: 18px; -webkit-overflow-scrolling: touch; scrollbar-width: none;">
            <button type="button" class="sm-filter-chip is-active" data-filter="semua" style="padding: 7px 16px; border-radius: 999px; border: none; background: #f97316; color: #ffffff; font-size: 0.8rem; font-weight: 700; white-space: nowrap; cursor: pointer;">
                Semua (5)
            </button>
            <button type="button" class="sm-filter-chip" data-filter="frontliner" style="padding: 7px 16px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; white-space: nowrap; cursor: pointer;">
                Frontliner
            </button>
            <button type="button" class="sm-filter-chip" data-filter="produksi" style="padding: 7px 16px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; white-space: nowrap; cursor: pointer;">
                Produksi
            </button>
            <button type="button" class="sm-filter-chip" data-filter="driver" style="padding: 7px 16px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; white-space: nowrap; cursor: pointer;">
                Driver
            </button>
            <button type="button" class="sm-filter-chip" data-filter="sales" style="padding: 7px 16px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; white-space: nowrap; cursor: pointer;">
                Sales/Marketing
            </button>
            <button type="button" class="sm-filter-chip" data-filter="supervisor" style="padding: 7px 16px; border-radius: 999px; border: 1px solid #ebdcd0; background: #ffffff; color: #78716c; font-size: 0.8rem; font-weight: 700; white-space: nowrap; cursor: pointer;">
                Supervisor
            </button>
        </div>

        <!-- 3. Daftar Kartu Persetujuan Tim -->
        <div class="sm-approval-list" style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 24px;">
            @foreach($approvalItems as $item)
            <div class="sm-approval-card" data-category="{{ $item['role_category'] ?? 'frontliner' }}" id="approvalCard-{{ $item['id'] }}" style="background: #fffdfa; border: 1px solid #ebdcd0; border-radius: 18px; padding: 16px; transition: all 0.2s ease;">
                <!-- Header Kartu Accordion -->
                <div class="sm-approval-card-header" onclick="toggleAccordion('{{ $item['id'] }}')" style="display: flex; align-items: flex-start; justify-content: space-between; cursor: pointer;">
                    <div style="flex: 1;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <h2 style="font-size: 1.05rem; font-weight: 800; color: #1c1917; margin: 0;">{{ $item['name'] }}</h2>
                            <span style="background: #fff7ed; border: 1px solid #fed7aa; color: #c2410c; font-size: 0.68rem; font-weight: 700; padding: 2px 8px; border-radius: 6px;">{{ $item['role'] }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px; font-size: 0.76rem; color: #78716c;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>{{ $item['submission_meta'] }}</span>
                        </div>
                        <span style="display: inline-block; background: #fff5ed; border: 1px solid #fed7aa; color: #c2410c; font-size: 0.7rem; font-weight: 700; padding: 3px 10px; border-radius: 999px; margin-top: 8px;">
                            ● {{ $item['status_label'] }}
                        </span>
                    </div>

                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #fbf5ee; display: flex; align-items: center; justify-content: center; color: #78716c; flex-shrink: 0; margin-left: 8px;">
                        <svg class="chevron-icon" id="chevron-{{ $item['id'] }}" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transform: {{ !empty($item['is_expanded']) ? 'rotate(180deg)' : 'rotate(0deg)' }}; transition: transform 0.2s ease;">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>

                <!-- Bagian Accordion Body (Hanya terbuka jika is_expanded atau dibuka user) -->
                <div class="sm-accordion-body" id="body-{{ $item['id'] }}" style="display: {{ !empty($item['is_expanded']) ? 'block' : 'none' }}; margin-top: 16px; border-top: 1px solid #ebdcd0; padding-top: 14px;">
                    @if(!empty($item['photos']))
                    <!-- Foto Bukti Lapangan Sesuai Figma -->
                    <span style="display: block; font-size: 0.72rem; font-weight: 800; color: #a8a29e; letter-spacing: 0.05em; margin-bottom: 8px;">FOTO BUKTI LAPORAN</span>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                        @foreach($item['photos'] as $photo)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; background: #fbf5ee; border: 1px solid #ebdcd0; border-radius: 12px;">
                            <div style="display: flex; align-items: center; gap: 10px; overflow: hidden;">
                                <div style="width: 38px; height: 38px; border-radius: 8px; background: #eedfd2; color: #b45309; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                </div>
                                <div style="overflow: hidden;">
                                    <span style="display: block; font-size: 0.78rem; font-weight: 700; color: #1c1917; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">{{ $photo['title'] }}</span>
                                    <span style="display: block; font-size: 0.68rem; color: #78716c;">{{ $photo['time'] }}</span>
                                    <button type="button" onclick="alert('Pratinjau foto akan tersedia setelah terhubung ke Backend.')" style="display: block; padding: 0; margin-top: 2px; border: none; background: none; font: inherit; font-size: 0.7rem; font-weight: 700; color: #ea580c; text-decoration: underline; cursor: pointer;">Ketuk untuk lihat foto</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if(!empty($item['categories']))
                    <!-- Checklist Review Kategori Sesuai Figma -->
                    <span style="display: block; font-size: 0.72rem; font-weight: 800; color: #a8a29e; letter-spacing: 0.05em; margin-bottom: 12px;">RINCIAN CEKLIS CAPAIAN</span>
                    
                    <div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 18px;">
                        @foreach($item['categories'] as $cat)
                        <div style="background: #faf6f0; border: 1px solid #ebdcd0; border-radius: 14px; padding: 14px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px solid #eedfd2; padding-bottom: 6px;">
                                <span style="font-size: 0.78rem; font-weight: 800; color: #1c1917; letter-spacing: 0.04em;">{{ $cat['name'] }}</span>
                                <span style="font-size: 0.72rem; font-weight: 700; color: #ea580c; background: #fff7ed; padding: 2px 8px; border-radius: 999px;">{{ $cat['ratio'] }}</span>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($cat['items'] as $chk)
                                <div style="display: flex; align-items: flex-start; gap: 10px;">
                                    <div style="width: 18px; height: 18px; border-radius: 5px; border: 1.5px solid {{ $chk['checked'] ? '#22c55e' : '#cbd5e1' }}; background: {{ $chk['checked'] ? '#22c55e' : '#ffffff' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px;">
                                        @if($chk['checked'])
                                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" style="width: 12px; height: 12px;">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        @endif
                                    </div>
                                    <span style="font-size: 0.78rem; color: {{ $chk['checked'] ? '#1c1917' : '#78716c' }}; font-weight: {{ $chk['checked'] ? '600' : '400' }}; line-height: 1.35;">{{ $chk['label'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Formulir Catatan & Aksi Store Manager -->
                    <form action="{{ route('storemanager.approval.reject', ['id' => $item['id']]) }}" method="POST" id="actionForm-{{ $item['id'] }}">
                        @csrf
                        <div style="margin-bottom: 14px;">
                            <label for="catatan-{{ $item['id'] }}" style="display: block; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.04em; color: #1c1917; margin-bottom: 6px;">CATATAN DARI STORE MANAGER</label>
                            <textarea id="catatan-{{ $item['id'] }}" name="catatan" rows="2" placeholder="Isi catatan untuk dikirim ke Admin" style="width: 100%; box-sizing: border-box; border: 1.5px solid #ebdcd0; border-radius: 12px; padding: 10px 12px; font-family: inherit; font-size: 0.8rem; background: #ffffff; resize: none;"></textarea>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="sm-btn-reject" style="flex: 1; padding: 12px; border-radius: 12px; border: 1.5px solid #ef4444; background: #ffffff; color: #ef4444; font-size: 0.85rem; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                <span>Tolak (Revisi)</span>
                            </button>

                            <button type="submit" formaction="{{ route('storemanager.approval.approve', ['id' => $item['id']]) }}" class="sm-btn-approve" style="flex: 1.2; padding: 12px; border-radius: 12px; border: none; background: #22c55e; color: #ffffff; font-size: 0.85rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.28);">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                <span>Setujui Capaian</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- 4. Tombol Setujui Semua Capaian Sekaligus Sesuai Figma -->
        <section style="background: #ffffff; border: 1.5px solid #bbf7d0; border-radius: 18px; padding: 18px; margin-bottom: 28px; text-align: center;">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h2 style="font-size: 1.05rem; font-weight: 800; color: #1c1917; margin: 0 0 4px;">Persetujuan Capaian Sekaligus</h2>
            <p style="font-size: 0.76rem; color: #78716c; margin: 0 0 16px;">Seluruh anggota tim di atas telah memenuhi verifikasi SOP minimum hari ini.</p>

            <form action="{{ route('storemanager.approval.approve_all') }}" method="POST">
                @csrf
                <button type="submit" style="width: 100%; padding: 14px; border-radius: 14px; border: none; background: #22c55e; color: #ffffff; font-size: 0.92rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(34, 197, 94, 0.32);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>Setujui Semua Capaian Sekaligus</span>
                </button>
            </form>
        </section>
    </div>

    <!-- Script Accordion & Filtering -->
    <script>
        function toggleAccordion(id) {
            const body = document.getElementById('body-' + id);
            const chevron = document.getElementById('chevron-' + id);
            if (body.style.display === 'none' || body.style.display === '') {
                body.style.display = 'block';
                chevron.style.transform = 'rotate(180deg)';
            } else {
                body.style.display = 'none';
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        // Filter chips handler
        document.querySelectorAll('.sm-filter-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelectorAll('.sm-filter-chip').forEach(c => {
                    c.style.background = '#ffffff';
                    c.style.color = '#78716c';
                    c.style.borderColor = '#ebdcd0';
                    c.classList.remove('is-active');
                });
                this.style.background = '#f97316';
                this.style.color = '#ffffff';
                this.style.borderColor = '#f97316';
                this.classList.add('is-active');

                const filter = this.getAttribute('data-filter');
                document.querySelectorAll('.sm-approval-card').forEach(card => {
                    const cat = card.getAttribute('data-category');
                    if (filter === 'semua' || cat === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>

