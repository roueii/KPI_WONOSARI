<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Akun | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Halaman Kelola Akun -->
        <header class="revisi-header-bar">
            <div class="header-title-wrapper">
                <a href="{{ route('admin.dashboard') }}" class="back-btn" aria-label="Kembali ke beranda">
                    <x-icon name="arrow-left" width="20" height="20" />
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
            <div class="toast-inline success" role="status" style="background: var(--success-100); border: 1px solid var(--success-500); color: var(--success-700); border-radius: 12px; padding: 10px 14px; font-size: var(--fs-14); font-weight: 600; margin-bottom: 12px;">{{ session('status') }}</div>
        @endif
        @if(session('error') && (old('_edit_id') || ! old('name')))
            <div role="alert" style="background: var(--error-100); border: 1px solid var(--error-100); color: var(--error-700); border-radius: 12px; padding: 10px 14px; font-size: var(--fs-14); font-weight: 600; margin-bottom: 12px;">{{ session('error') }}</div>
        @endif
        @unless($isLive)
            <div role="note" style="background: var(--warning-100); border: 1px dashed var(--warning-500); color: var(--warning-700); border-radius: 12px; padding: 10px 14px; font-size: var(--fs-12); margin-bottom: 12px;">Mode demo: data di bawah adalah contoh. Login dengan akun Backend agar daftar akun bisa dikelola.</div>
        @endunless

        <div class="account-summary-card">
            <div class="summary-card-left">
                <x-icon name="group" width="20" height="20" />
                <strong class="summary-card-title">Daftar Akun</strong>
            </div>
            <span class="summary-card-badge">{{ $summary['total_karyawan'] }} Karyawan &middot; {{ $summary['total_divisi'] }} Divisi</span>
        </div>

        <!-- 3. Pencarian & Tombol Tambah -->
        <div class="account-actions-row">
            <div class="search-input-box">
                <x-icon name="search" width="18" height="18" />
                <input type="text" id="accountSearchInput" placeholder="Cari nama karyawan..." aria-label="Cari nama karyawan" />
            </div>

            <button type="button" class="btn-add-account" onclick="scrollToAddForm()">
                <x-icon name="plus" width="18" height="18" />
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
                                    <x-icon name="empty-page" width="16" height="16" />
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
                                <button type="submit" class="btn-deactivate-dashed" @unless($acc['active']) style="border-color: var(--success-500); color: var(--success-700);" @endunless>
                                    <x-icon name="warning-triangle" width="15" height="15" />
                                    <span>{{ $acc['active'] ? 'Nonaktifkan Akun Karyawan' : 'Aktifkan Kembali Akun' }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: var(--neutral-500); font-size: var(--fs-14); padding: 18px 0;">Belum ada akun.</p>
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
                        <div role="alert" style="background: var(--error-100); border: 1px solid var(--error-100); color: var(--error-700); border-radius: 10px; padding: 8px 12px; font-size: var(--fs-12); margin-bottom: 10px;">{{ $errors->first() }}</div>
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
                        <x-icon name="check" width="18" height="18" />
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

    <script src="{{ asset('js/drawer.js') }}"></script>
    <script>
        const toastEl = document.getElementById('toastMsg');
        let toastTimeout;

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
