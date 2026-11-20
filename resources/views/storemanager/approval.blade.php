<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approval Tim | Capaian.id - Store Manager</title>
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
        <!-- 1. Header Sesuai Desain Figma Halaman Approval Tim.png -->
        <header class="fl-top-nav" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <a href="{{ route('storemanager.dashboard', ['tab' => 'tim']) }}" class="fl-nav-back-btn" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid var(--secondary-100); background: var(--white); display: flex; align-items: center; justify-content: center; color: var(--neutral-900); text-decoration: none;" aria-label="Kembali ke Dashboard">
                    <x-icon name="arrow-left" width="20" height="20" />
                </a>
                <div>
                    <h1 style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Approval Tim</h1>
                    <span style="font-size: var(--fs-12); color: var(--neutral-500);">Capaian harian Tim</span>
                </div>
            </div>
        </header>

        <!-- Flash Message jika ada aksi -->
        @if(session('status'))
        <div style="background: var(--success-100); border: 1px solid var(--success-100); border-radius: 14px; padding: 12px 16px; margin-bottom: 16px; color: var(--success-700); font-size: var(--fs-14); font-weight: var(--fw-semibold); display: flex; align-items: center; gap: 8px;">
            <x-icon name="check" width="18" height="18" />
            <span>{{ session('status') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div role="alert" style="background: var(--error-100); border: 1px solid var(--error-100); border-radius: 14px; padding: 12px 16px; margin-bottom: 16px; color: var(--error-700); font-size: var(--fs-14); font-weight: var(--fw-semibold);">
            {{ session('error') }}
        </div>
        @endif

        <!-- 2. Filter Chips Sesuai Figma -->
        <div class="sm-filter-row" style="display: flex; gap: 8px; overflow-x: auto; padding-bottom: 8px; margin-bottom: 18px; -webkit-overflow-scrolling: touch; scrollbar-width: none;">
            <button type="button" class="sm-filter-chip is-active" data-filter="semua" style="padding: 7px 16px; border-radius: 999px; border: none; background: var(--primary-500); color: var(--white); font-size: var(--fs-12); font-weight: var(--fw-semibold); white-space: nowrap; cursor: pointer;">
                Semua ({{ count($approvalItems) }})
            </button>
            <button type="button" class="sm-filter-chip" data-filter="frontliner" style="padding: 7px 16px; border-radius: 999px; border: 1px solid var(--secondary-100); background: var(--white); color: var(--neutral-500); font-size: var(--fs-12); font-weight: var(--fw-semibold); white-space: nowrap; cursor: pointer;">
                Frontliner
            </button>
            <button type="button" class="sm-filter-chip" data-filter="produksi" style="padding: 7px 16px; border-radius: 999px; border: 1px solid var(--secondary-100); background: var(--white); color: var(--neutral-500); font-size: var(--fs-12); font-weight: var(--fw-semibold); white-space: nowrap; cursor: pointer;">
                Produksi
            </button>
            <button type="button" class="sm-filter-chip" data-filter="driver" style="padding: 7px 16px; border-radius: 999px; border: 1px solid var(--secondary-100); background: var(--white); color: var(--neutral-500); font-size: var(--fs-12); font-weight: var(--fw-semibold); white-space: nowrap; cursor: pointer;">
                Driver
            </button>
            <button type="button" class="sm-filter-chip" data-filter="sales" style="padding: 7px 16px; border-radius: 999px; border: 1px solid var(--secondary-100); background: var(--white); color: var(--neutral-500); font-size: var(--fs-12); font-weight: var(--fw-semibold); white-space: nowrap; cursor: pointer;">
                Sales/Marketing
            </button>
            <button type="button" class="sm-filter-chip" data-filter="supervisor" style="padding: 7px 16px; border-radius: 999px; border: 1px solid var(--secondary-100); background: var(--white); color: var(--neutral-500); font-size: var(--fs-12); font-weight: var(--fw-semibold); white-space: nowrap; cursor: pointer;">
                Supervisor
            </button>
        </div>

        <!-- 3. Daftar Kartu Persetujuan Tim -->
        <div class="sm-approval-list" style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 24px;">
            @if(count($approvalItems) === 0)
            <div style="background: var(--white); border: 1px dashed var(--secondary-100); border-radius: 18px; padding: 28px 18px; text-align: center; color: var(--neutral-500); font-size: var(--fs-14);">
                <strong style="display: block; color: var(--neutral-900); font-size: var(--fs-16); margin-bottom: 4px;">Tidak ada laporan yang menunggu persetujuan</strong>
                Laporan karyawan yang sudah dikirim akan muncul di sini.
            </div>
            @endif
            @foreach($approvalItems as $item)
            <div class="sm-approval-card" data-category="{{ $item['role_category'] ?? 'frontliner' }}" id="approvalCard-{{ $item['id'] }}" style="background: var(--neutral-50); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 16px; transition: all 0.2s ease;">
                <!-- Header Kartu Accordion -->
                <div class="sm-approval-card-header" onclick="toggleAccordion('{{ $item['id'] }}')" style="display: flex; align-items: flex-start; justify-content: space-between; cursor: pointer;">
                    <div style="flex: 1;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <h2 style="font-size: var(--fs-16); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">{{ $item['name'] }}</h2>
                            <span style="background: var(--primary-50); border: 1px solid var(--primary-200); color: var(--primary-700); font-size: var(--fs-10); font-weight: var(--fw-semibold); padding: 2px 8px; border-radius: 6px;">{{ $item['role'] }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px; font-size: var(--fs-12); color: var(--neutral-500);">
                            <x-icon name="clock" width="14" height="14" />
                            <span>{{ $item['submission_meta'] }}</span>
                        </div>
                        <span style="display: inline-block; background: var(--primary-50); border: 1px solid var(--primary-200); color: var(--primary-700); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 3px 10px; border-radius: 999px; margin-top: 8px;">
                            ● {{ $item['status_label'] }}
                        </span>
                    </div>

                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary-50); display: flex; align-items: center; justify-content: center; color: var(--neutral-500); flex-shrink: 0; margin-left: 8px;">
                        <x-icon name="nav-arrow-down" class="chevron-icon" id="chevron-{{ $item['id'] }}" width="16" height="16" style="transform: {{ !empty($item['is_expanded']) ? 'rotate(180deg)' : 'rotate(0deg)' }}; transition: transform 0.2s ease;" />
                    </div>
                </div>

                <!-- Bagian Accordion Body (Hanya terbuka jika is_expanded atau dibuka user) -->
                <div class="sm-accordion-body" id="body-{{ $item['id'] }}" style="display: {{ !empty($item['is_expanded']) ? 'block' : 'none' }}; margin-top: 16px; border-top: 1px solid var(--secondary-100); padding-top: 14px;">
                    @if(!empty($item['photos']))
                    <!-- Foto Bukti Lapangan Sesuai Figma -->
                    <span style="display: block; font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-400); letter-spacing: 0.05em; margin-bottom: 8px;">FOTO BUKTI LAPORAN</span>
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                        @foreach($item['photos'] as $photo)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; background: var(--primary-50); border: 1px solid var(--secondary-100); border-radius: 12px;">
                            <div style="display: flex; align-items: center; gap: 10px; overflow: hidden;">
                                <div style="width: 38px; height: 38px; border-radius: 8px; background: var(--secondary-100); color: var(--warning-700); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <x-icon name="media-image" width="20" height="20" />
                                </div>
                                <div style="overflow: hidden;">
                                    <span style="display: block; font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-900); text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">{{ $photo['title'] }}</span>
                                    <span style="display: block; font-size: var(--fs-10); color: var(--neutral-500);">{{ $photo['time'] }}</span>
                                    <button type="button" onclick="{{ !empty($photo['url']) ? "window.open('" . e($photo['url']) . "', '_blank')" : "alert('Pratinjau foto belum tersedia untuk data contoh.')" }}" style="display: block; padding: 0; margin-top: 2px; border: none; background: none; font: inherit; font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--primary-600); text-decoration: underline; cursor: pointer;">Ketuk untuk lihat foto</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if(!empty($item['categories']))
                    <!-- Checklist Review Kategori Sesuai Figma -->
                    <span style="display: block; font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-400); letter-spacing: 0.05em; margin-bottom: 12px;">RINCIAN CEKLIS CAPAIAN</span>
                    
                    <div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 18px;">
                        @foreach($item['categories'] as $cat)
                        <div style="background: var(--secondary-50); border: 1px solid var(--secondary-100); border-radius: 14px; padding: 14px;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px solid var(--secondary-100); padding-bottom: 6px;">
                                <span style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-900); letter-spacing: 0.04em;">{{ $cat['name'] }}</span>
                                <span style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--primary-600); background: var(--primary-50); padding: 2px 8px; border-radius: 999px;">{{ $cat['ratio'] }}</span>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($cat['items'] as $chk)
                                <div style="display: flex; align-items: flex-start; gap: 10px;">
                                    <div style="width: 18px; height: 18px; border-radius: 5px; border: 1.5px solid {{ $chk['checked'] ? 'var(--success-500)' : 'var(--neutral-300)' }}; background: {{ $chk['checked'] ? 'var(--success-500)' : 'var(--white)' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px;">
                                        @if($chk['checked'])
                                        <x-icon name="check" style="width: 12px; height: 12px; color: var(--white);" />
                                        @endif
                                    </div>
                                    <span style="font-size: var(--fs-12); color: {{ $chk['checked'] ? 'var(--neutral-900)' : 'var(--neutral-500)' }}; font-weight: {{ $chk['checked'] ? '600' : '400' }}; line-height: 1.35;">{{ $chk['label'] }}</span>
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
                            <label for="catatan-{{ $item['id'] }}" style="display: block; font-size: var(--fs-12); font-weight: var(--fw-semibold); letter-spacing: 0.04em; color: var(--neutral-900); margin-bottom: 6px;">CATATAN DARI STORE MANAGER</label>
                            <textarea id="catatan-{{ $item['id'] }}" name="catatan" rows="2" placeholder="Isi catatan untuk dikirim ke Admin" style="width: 100%; box-sizing: border-box; border: 1.5px solid var(--secondary-100); border-radius: 12px; padding: 10px 12px; font-family: inherit; font-size: var(--fs-12); background: var(--white); resize: none;"></textarea>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="sm-btn-reject" style="flex: 1; padding: 12px; border-radius: 12px; border: 1.5px solid var(--error-500); background: var(--white); color: var(--error-500); font-size: var(--fs-14); font-weight: var(--fw-semibold); cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">
                                <x-icon name="cancel" width="16" height="16" />
                                <span>Tolak (Revisi)</span>
                            </button>

                            <button type="submit" formaction="{{ route('storemanager.approval.approve', ['id' => $item['id']]) }}" class="sm-btn-approve" style="flex: 1.2; padding: 12px; border-radius: 12px; border: none; background: var(--success-500); color: var(--white); font-size: var(--fs-14); font-weight: var(--fw-semibold); cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.28);">
                                <x-icon name="check" width="16" height="16" />
                                <span>Setujui Capaian</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        @if(count($approvalItems) > 0)
        <!-- 4. Tombol Setujui Semua Capaian Sekaligus Sesuai Figma -->
        <section style="background: var(--white); border: 1.5px solid var(--success-100); border-radius: 18px; padding: 18px; margin-bottom: 28px; text-align: center;">
            <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--success-100); color: var(--success-700); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                <x-icon name="check-circle" width="22" height="22" />
            </div>
            <h2 style="font-size: var(--fs-16); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0 0 4px;">Persetujuan Capaian Sekaligus</h2>
            <p style="font-size: var(--fs-12); color: var(--neutral-500); margin: 0 0 16px;">Seluruh anggota tim di atas telah memenuhi verifikasi SOP minimum hari ini.</p>

            <form action="{{ route('storemanager.approval.approve_all') }}" method="POST">
                @csrf
                <button type="submit" style="width: 100%; padding: 14px; border-radius: 14px; border: none; background: var(--success-500); color: var(--white); font-size: var(--fs-14); font-weight: var(--fw-semibold); cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(34, 197, 94, 0.32);">
                    <x-icon name="check" width="18" height="18" />
                    <span>Setujui Semua Capaian Sekaligus</span>
                </button>
            </form>
        </section>
        @endif
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

