<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Akun | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Halaman Kelola Akun -->
        <header class="revisi-header-bar">
            <div class="header-title-wrapper">
                <a href="{{ route('admin.dashboard') }}" class="back-btn" aria-label="Kembali ke beranda">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div class="header-titles">
                    <h1 class="header-page-title">Kelola Akun</h1>
                    <span class="header-page-subtitle">Laporan yang sudah disetujui Store Manager</span>
                </div>
            </div>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Kotak Ringkasan Jumlah Akun -->
        @if(session('status'))
            <div class="toast-inline success" role="status" style="background: #ecfdf5; border: 1px solid #86efac; color: #15803d; border-radius: 12px; padding: 10px 14px; font-size: 0.82rem; font-weight: 600; margin-bottom: 12px;">{{ session('status') }}</div>
        @endif
        @if(session('error') && (old('_edit_id') || ! old('name')))
            <div role="alert" style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; border-radius: 12px; padding: 10px 14px; font-size: 0.82rem; font-weight: 600; margin-bottom: 12px;">{{ session('error') }}</div>
        @endif
        @unless($isLive)
            <div role="note" style="background: #fffbeb; border: 1px dashed #f59e0b; color: #92400e; border-radius: 12px; padding: 10px 14px; font-size: 0.78rem; margin-bottom: 12px;">Mode demo: data di bawah adalah contoh. Login dengan akun Backend agar daftar akun bisa dikelola.</div>
        @endunless

        <div class="account-summary-card">
            <div class="summary-card-left">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <strong class="summary-card-title">Daftar Akun</strong>
            </div>
            <span class="summary-card-badge">{{ $summary['total_karyawan'] }} Karyawan &middot; {{ $summary['total_divisi'] }} Divisi</span>
        </div>

        <!-- 3. Pencarian & Tombol Tambah -->
        <div class="account-actions-row">
            <div class="search-input-box">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="accountSearchInput" placeholder="Cari nama karyawan..." aria-label="Cari nama karyawan" />
            </div>

            <button type="button" class="btn-add-account" onclick="scrollToAddForm()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah</span>
            </button>
        </div>

        <!-- 4. Filter Tabs Kategori -->
        <div class="filter-tabs-row" role="tablist">
            <button class="filter-chip is-active" data-filter="all">Semua ({{ $filterCounts['all'] }})</button>
            @foreach($filterCounts['divisions'] as $div)
                <button class="filter-chip" data-filter="{{ $div['key'] }}">{{ $div['label'] }} ({{ $div['count'] }})</button>
            @endforeach
        </div>

        <!-- 5. Daftar Akun Pengguna -->
        <section class="accounts-list-section">
            <span class="section-subheading">DAFTAR AKUN PENGGUNA</span>

            <div class="accounts-cards-container" id="accountsCardsContainer">
                @forelse($accounts as $acc)
                    @php $open = (string) old('_edit_id') === (string) $acc['id']; @endphp
                    <div class="employee-account-wrapper {{ $acc['active'] ? '' : 'is-inactive-account' }} {{ $open ? 'is-expanded-mode' : '' }}" id="item-{{ $acc['id'] }}" data-name="{{ strtolower($acc['name']) }}" data-category="{{ $acc['category'] }}">
                        <div class="employee-card-header {{ $open ? 'highlighted' : '' }}" onclick="toggleEditCard('{{ $acc['id'] }}')" role="button" tabindex="0" aria-expanded="{{ $open ? 'true' : 'false' }}" aria-controls="panel-{{ $acc['id'] }}">
                            <div class="employee-left-group">
                                <div class="employee-avatar-circle {{ $acc['active'] ? '' : 'muted' }}">{{ $acc['initials'] }}</div>
                                <div class="employee-name-meta">
                                    <div class="employee-title-row">
                                        <strong class="employee-name {{ $acc['active'] ? '' : 'muted' }}">{{ $acc['name'] }}</strong>
                                        <span class="role-pill {{ $acc['pill_class'] }} {{ $acc['active'] ? '' : 'outline' }}">{{ $acc['division'] }}</span>
                                    </div>
                                    <span class="employee-join-date">{{ $acc['joined'] }}</span>
                                </div>
                            </div>

                            <div class="employee-right-group">
                                <span class="status-pill {{ $acc['active'] ? 'active' : 'inactive' }}">{{ $acc['active'] ? 'Aktif' : 'Nonaktif' }}</span>
                                <span class="expand-caret-icon" id="caret-{{ $acc['id'] }}">{!! $open ? '&#9650;' : '&#9660;' !!}</span>
                            </div>
                        </div>

                        <div class="edit-employee-panel" id="panel-{{ $acc['id'] }}" style="display: {{ $open ? 'block' : 'none' }};">
                            <div class="edit-panel-header">
                                <div class="panel-header-left">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                    <strong>EDIT DATA KARYAWAN: {{ strtoupper($acc['name']) }}</strong>
                                </div>
                                <button type="button" class="panel-close-btn" onclick="toggleEditCard('{{ $acc['id'] }}')" aria-label="Tutup form edit">&times;</button>
                            </div>

                            <form class="edit-employee-form" method="POST" action="{{ route('admin.accounts.update', $acc['id']) }}">
                                @csrf
                                <input type="hidden" name="_edit_id" value="{{ $acc['id'] }}" />

                                <div class="form-group-item">
                                    <label for="name-{{ $acc['id'] }}">Nama Lengkap</label>
                                    <input type="text" id="name-{{ $acc['id'] }}" name="name" value="{{ $open ? old('name', $acc['name']) : $acc['name'] }}" required maxlength="255" />
                                </div>

                                <div class="form-group-item">
                                    <label for="email-{{ $acc['id'] }}">Email Akun</label>
                                    <input type="email" id="email-{{ $acc['id'] }}" name="email" value="{{ $open ? old('email', $acc['email']) : $acc['email'] }}" required />
                                </div>

                                <div class="form-group-item">
                                    <label for="divisi-{{ $acc['id'] }}">Divisi Kerja</label>
                                    <div class="select-wrapper">
                                        <select id="divisi-{{ $acc['id'] }}" name="position_id" {{ $acc['is_admin'] ? 'disabled' : '' }}>
                                            @if($acc['is_admin'])
                                                <option>Admin (tanpa divisi)</option>
                                            @endif
                                            @foreach($positions as $pos)
                                                <option value="{{ $pos['id'] }}" @selected($acc['position_id'] == $pos['id'])>{{ $pos['label'] }}</option>
                                            @endforeach
                                        </select>
                                        <span class="select-chevron">&#9662;</span>
                                    </div>
                                </div>

                                <div class="edit-form-actions">
                                    <button type="button" class="btn-form-cancel" onclick="toggleEditCard('{{ $acc['id'] }}')">Batal</button>
                                    <button type="submit" class="btn-form-save">Simpan Perubahan</button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('admin.accounts.status', $acc['id']) }}" onsubmit="return confirm(@js(($acc['active'] ? 'Nonaktifkan' : 'Aktifkan') . ' akun ' . $acc['name'] . '?'))">
                                @csrf
                                <input type="hidden" name="is_active" value="{{ $acc['active'] ? 0 : 1 }}" />
                                <button type="submit" class="btn-deactivate-dashed" @unless($acc['active']) style="border-color: #22c55e; color: #15803d;" @endunless>
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                        <line x1="12" y1="9" x2="12" y2="13"></line>
                                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                    </svg>
                                    <span>{{ $acc['active'] ? 'Nonaktifkan Akun Karyawan' : 'Aktifkan Kembali Akun' }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #78716c; font-size: 0.85rem; padding: 18px 0;">Belum ada akun.</p>
                @endforelse
            </div>
        </section>

        <!-- 6. Form Tambah Karyawan Baru -->
        <section class="add-employee-section" id="addEmployeeSection">
            <span class="section-subheading">FORM TAMBAH KARYAWAN</span>

            <div class="add-employee-card">
                <div class="add-card-header">
                    <div class="add-header-titles">
                        <h2 class="add-card-title">Tambah Karyawan Baru</h2>
                        <span class="add-card-subtitle">Buat kredensial akun staf bakery</span>
                    </div>
                </div>

                <form class="add-employee-form" method="POST" action="{{ route('admin.accounts.store') }}">
                    @csrf
                    @if($errors->any() && ! old('_edit_id') && old('name'))
                        <div role="alert" style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; border-radius: 10px; padding: 8px 12px; font-size: 0.78rem; margin-bottom: 10px;">{{ $errors->first() }}</div>
                    @endif

                    <div class="form-group-item">
                        <label for="new-employee-name">Nama Lengkap</label>
                        <input type="text" id="new-employee-name" name="name" value="{{ old('_edit_id') ? '' : old('name') }}" placeholder="Nama lengkap karyawan" required maxlength="255" />
                    </div>

                    <div class="form-group-item">
                        <label for="new-employee-email">Email Akun</label>
                        <input type="email" id="new-employee-email" name="email" value="{{ old('_edit_id') ? '' : old('email') }}" placeholder="nama@capaian.id" required />
                    </div>

                    <div class="form-group-item">
                        <label for="new-employee-password">Kata Sandi Awal</label>
                        <input type="password" id="new-employee-password" name="password" placeholder="Minimal 8 karakter" minlength="8" required autocomplete="new-password" />
                    </div>

                    <div class="form-group-item">
                        <label for="new-employee-divisi">Divisi</label>
                        <div class="select-wrapper">
                            <select id="new-employee-divisi" name="position_id" required>
                                <option value="" disabled @selected(! old('position_id'))>Pilih divisi...</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos['id'] }}" @selected(old('position_id') == $pos['id'])>{{ $pos['label'] }}</option>
                                @endforeach
                            </select>
                            <span class="select-chevron">&#9662;</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-save-new-account">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Simpan Akun Baru</span>
                    </button>
                </form>
            </div>
        </section>

        <!-- Include Side Menu Drawer (Gambar 1) -->
        @include('admin.partials.drawer')
    </div>

    <!-- Toast Notification Element -->
    <div class="toast-msg" id="toastMsg" role="alert" aria-live="polite"></div>

    <script>
        // Toggle Side Menu Drawer
        const menuToggleBtn = document.getElementById('menuToggle');
        const drawerOverlay = document.getElementById('drawerOverlay');
        const drawerBackdrop = document.getElementById('drawerBackdrop');
        const drawerCloseBtn = document.getElementById('drawerCloseBtn');
        const toastEl = document.getElementById('toastMsg');
        let toastTimeout;

        function openDrawer() {
            drawerOverlay.classList.add('is-open');
            menuToggleBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            drawerOverlay.classList.remove('is-open');
            menuToggleBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        if (menuToggleBtn) menuToggleBtn.addEventListener('click', openDrawer);
        if (drawerCloseBtn) drawerCloseBtn.addEventListener('click', closeDrawer);
        if (drawerBackdrop) drawerBackdrop.addEventListener('click', closeDrawer);

        // Toggle Expand/Collapse Edit Data Budi Santoso
        function toggleEditCard(cardKey) {
            const panelEl = document.getElementById(`panel-${cardKey}`);
            const caretEl = document.getElementById(`caret-${cardKey}`);
            const wrapperEl = document.getElementById(`item-${cardKey}`);
            const headerEl = wrapperEl.querySelector('.employee-card-header');

            if (!panelEl || !caretEl) return;

            const isHidden = panelEl.style.display === 'none';
            if (isHidden) {
                panelEl.style.display = 'block';
                caretEl.innerHTML = '&#9650;';
                headerEl.classList.add('highlighted');
                wrapperEl.classList.add('is-expanded-mode');
            } else {
                panelEl.style.display = 'none';
                caretEl.innerHTML = '&#9660;';
                headerEl.classList.remove('highlighted');
                wrapperEl.classList.remove('is-expanded-mode');
            }
        }

        // Header kartu bisa dibuka lewat keyboard (Enter / Spasi)
        document.querySelectorAll('.employee-card-header[role="button"]').forEach(header => {
            header.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    header.click();
                }
            });
            header.addEventListener('click', () => {
                header.setAttribute('aria-expanded', header.classList.contains('highlighted') ? 'true' : 'false');
            });
        });

        // Filter Tabs
        const filterChips = document.querySelectorAll('.filter-chip');
        const accountCards = document.querySelectorAll('.employee-account-wrapper');

        filterChips.forEach(chip => {
            chip.addEventListener('click', () => {
                filterChips.forEach(c => c.classList.remove('is-active'));
                chip.classList.add('is-active');

                const filter = chip.getAttribute('data-filter');
                accountCards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (filter === 'all' || cardCat === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Search Filter
        const searchInput = document.getElementById('accountSearchInput');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase().trim();
                accountCards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    if (name.includes(term)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // Scroll to Add Form
        function scrollToAddForm() {
            const addSection = document.getElementById('addEmployeeSection');
            if (addSection) {
                addSection.scrollIntoView({ behavior: 'smooth' });
                document.getElementById('new-employee-name').focus();
            }
        }

        function showToast(message) {
            clearTimeout(toastTimeout);
            toastEl.textContent = message;
            toastEl.classList.add('show');
            toastTimeout = setTimeout(() => {
                toastEl.classList.remove('show');
            }, 2600);
        }
    </script>
</body>

</html>
