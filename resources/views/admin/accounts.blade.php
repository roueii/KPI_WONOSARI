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
            <span class="summary-card-badge">23 Karyawan &middot; 6 Divisi</span>
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
            <button class="filter-chip is-active" data-filter="all">Semua (23)</button>
            <button class="filter-chip" data-filter="store_manager">Store Manager (2)</button>
            <button class="filter-chip" data-filter="frontliner">Frontliner (6)</button>
            <button class="filter-chip" data-filter="produksi">Produksi (8)</button>
        </div>

        <!-- 5. Daftar Akun Pengguna -->
        <section class="accounts-list-section">
            <span class="section-subheading">DAFTAR AKUN PENGGUNA</span>

            <div class="accounts-cards-container" id="accountsCardsContainer">

                <!-- ITEM 1: Budi Santoso (Expanded Edit State) -->
                <div class="employee-account-wrapper is-expanded-mode" id="item-budi" data-name="budi santoso" data-category="frontliner">
                    <!-- Header Kartu -->
                    <div class="employee-card-header highlighted" onclick="toggleEditCard('budi')">
                        <div class="employee-left-group">
                            <div class="employee-avatar-circle">BS</div>
                            <div class="employee-name-meta">
                                <div class="employee-title-row">
                                    <strong class="employee-name">Budi Santoso</strong>
                                    <span class="role-pill frontliner">Frontliner</span>
                                </div>
                                <span class="employee-join-date">Bergabung Jan 2024</span>
                            </div>
                        </div>

                        <div class="employee-right-group">
                            <span class="status-pill active">Aktif</span>
                            <span class="expand-caret-icon" id="caret-budi">&#9650;</span>
                        </div>
                    </div>

                    <!-- Form Edit Data Karyawan (Expanded) -->
                    <div class="edit-employee-panel" id="panel-budi">
                        <div class="edit-panel-header">
                            <div class="panel-header-left">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <strong>EDIT DATA KARYAWAN: BUDI SANTOSO</strong>
                            </div>
                            <button type="button" class="panel-close-btn" onclick="toggleEditCard('budi')" aria-label="Tutup form edit">&times;</button>
                        </div>

                        <form class="edit-employee-form" onsubmit="handleSaveEdit(event, 'Budi Santoso')">
                            <!-- Field: Nama Lengkap -->
                            <div class="form-group-item">
                                <label for="name-budi">Nama Lengkap</label>
                                <input type="text" id="name-budi" value="Budi Santoso" required />
                            </div>

                            <!-- Field: Nomor HP -->
                            <div class="form-group-item">
                                <label for="phone-budi">Nomor HP / WhatsApp</label>
                                <input type="text" id="phone-budi" value="0812-3456-7890" required />
                            </div>

                            <!-- Field: Email Akun -->
                            <div class="form-group-item">
                                <label for="email-budi">Email Akun</label>
                                <input type="email" id="email-budi" value="budi.frontliner@capaian.id" required />
                            </div>

                            <!-- Field: Divisi Kerja -->
                            <div class="form-group-item">
                                <label for="divisi-budi">Divisi Kerja</label>
                                <div class="select-wrapper">
                                    <select id="divisi-budi">
                                        <option value="Frontliner" selected>Frontliner</option>
                                        <option value="Store Manager">Store Manager</option>
                                        <option value="Produksi">Produksi</option>
                                        <option value="Driver">Driver</option>
                                        <option value="Sales & Marketing">Sales &amp; Marketing</option>
                                        <option value="SPV">SPV</option>
                                    </select>
                                    <span class="select-chevron">&#9662;</span>
                                </div>
                            </div>

                            <!-- Field: Penempatan Outlet / Cabang -->
                            <div class="form-group-item">
                                <label for="outlet-budi">Penempatan Outlet / Cabang</label>
                                <div class="select-wrapper">
                                    <select id="outlet-budi">
                                        <option value="Outlet Malioboro" selected>Outlet Malioboro</option>
                                        <option value="Outlet Kaliurang">Outlet Kaliurang</option>
                                        <option value="Dapur Pusat Wonosari">Dapur Pusat Wonosari</option>
                                    </select>
                                    <span class="select-chevron">&#9662;</span>
                                </div>
                            </div>

                            <!-- Toggle Status Akun Aktif -->
                            <div class="toggle-status-row">
                                <div class="toggle-status-info">
                                    <strong>Status Akun Aktif</strong>
                                    <span>Karyawan dapat login dan mengisi KPI harian</span>
                                </div>
                                <label class="switch-toggle" aria-label="Toggle status akun aktif">
                                    <input type="checkbox" id="toggle-active-budi" checked />
                                    <span class="switch-slider"></span>
                                </label>
                            </div>

                            <!-- Tombol Aksi Form -->
                            <div class="edit-form-actions">
                                <button type="button" class="btn-form-cancel" onclick="toggleEditCard('budi')">Batal</button>
                                <button type="submit" class="btn-form-save">Simpan Perubahan</button>
                            </div>

                            <!-- Tombol Nonaktifkan Akun -->
                            <button type="button" class="btn-deactivate-dashed" onclick="handleDeactivate('Budi Santoso', 'item-budi')">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                <span>Nonaktifkan Akun Karyawan</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- ITEM 2: Siti Rahma (Store Manager) -->
                <div class="employee-account-wrapper" id="item-siti" data-name="siti rahma" data-category="store_manager">
                    <div class="employee-card-header" onclick="showToast('Membuka edit data Siti Rahma...');">
                        <div class="employee-left-group">
                            <div class="employee-avatar-circle">SR</div>
                            <div class="employee-name-meta">
                                <div class="employee-title-row">
                                    <strong class="employee-name">Siti Rahma</strong>
                                    <span class="role-pill store-manager">Store Manager</span>
                                </div>
                                <span class="employee-join-date">Bergabung Agt 2023</span>
                            </div>
                        </div>

                        <div class="employee-right-group">
                            <span class="status-pill active">Aktif</span>
                            <span class="chevron-right-icon">&#8250;</span>
                        </div>
                    </div>
                </div>

                <!-- ITEM 3: Joko Prasetyo (Produksi) -->
                <div class="employee-account-wrapper" id="item-joko" data-name="joko prasetyo" data-category="produksi">
                    <div class="employee-card-header" onclick="showToast('Membuka edit data Joko Prasetyo...');">
                        <div class="employee-left-group">
                            <div class="employee-avatar-circle">JP</div>
                            <div class="employee-name-meta">
                                <div class="employee-title-row">
                                    <strong class="employee-name">Joko Prasetyo</strong>
                                    <span class="role-pill produksi">Produksi</span>
                                </div>
                                <span class="employee-join-date">Bergabung Mar 2023</span>
                            </div>
                        </div>

                        <div class="employee-right-group">
                            <span class="status-pill active">Aktif</span>
                            <span class="chevron-right-icon">&#8250;</span>
                        </div>
                    </div>
                </div>

                <!-- ITEM 4: Agus Hermawan (Driver) -->
                <div class="employee-account-wrapper" id="item-agus" data-name="agus hermawan" data-category="driver">
                    <div class="employee-card-header" onclick="showToast('Membuka edit data Agus Hermawan...');">
                        <div class="employee-left-group">
                            <div class="employee-avatar-circle">AH</div>
                            <div class="employee-name-meta">
                                <div class="employee-title-row">
                                    <strong class="employee-name">Agus Hermawan</strong>
                                    <span class="role-pill driver">Driver</span>
                                </div>
                                <span class="employee-join-date">Bergabung Mei 2023</span>
                            </div>
                        </div>

                        <div class="employee-right-group">
                            <span class="status-pill active">Aktif</span>
                            <span class="chevron-right-icon">&#8250;</span>
                        </div>
                    </div>
                </div>

                <!-- ITEM 5: Dewi Lestari (Frontliner) -->
                <div class="employee-account-wrapper" id="item-dewi" data-name="dewi lestari" data-category="frontliner">
                    <div class="employee-card-header" onclick="showToast('Membuka edit data Dewi Lestari...');">
                        <div class="employee-left-group">
                            <div class="employee-avatar-circle">DL</div>
                            <div class="employee-name-meta">
                                <div class="employee-title-row">
                                    <strong class="employee-name">Dewi Lestari</strong>
                                    <span class="role-pill frontliner">Frontliner</span>
                                </div>
                                <span class="employee-join-date">Bergabung Feb 2024</span>
                            </div>
                        </div>

                        <div class="employee-right-group">
                            <span class="status-pill active">Aktif</span>
                            <span class="chevron-right-icon">&#8250;</span>
                        </div>
                    </div>
                </div>

                <!-- ITEM 6: Hendra Wijaya (Produksi - Nonaktif) -->
                <div class="employee-account-wrapper is-inactive-account" id="item-hendra" data-name="hendra wijaya" data-category="produksi">
                    <div class="employee-card-header" onclick="showToast('Akun Hendra Wijaya berstatus nonaktif.');">
                        <div class="employee-left-group">
                            <div class="employee-avatar-circle muted">HW</div>
                            <div class="employee-name-meta">
                                <div class="employee-title-row">
                                    <strong class="employee-name muted">Hendra Wijaya</strong>
                                    <span class="role-pill produksi outline">Produksi</span>
                                </div>
                                <span class="employee-join-date">Bergabung Nov 2024</span>
                            </div>
                        </div>

                        <div class="employee-right-group">
                            <span class="status-pill inactive">Nonaktif</span>
                            <span class="chevron-right-icon">&#8250;</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- 6. Form Tambah Karyawan Baru (Preview Sesuai Gambar) -->
        <section class="add-employee-section" id="addEmployeeSection">
            <span class="section-subheading">PREVIEW: FORM TAMBAH KARYAWAN</span>

            <div class="add-employee-card">
                <div class="add-card-header">
                    <div class="add-header-titles">
                        <h2 class="add-card-title">Tambah Karyawan Baru</h2>
                        <span class="add-card-subtitle">Buat kredensial akun staf bakery</span>
                    </div>
                    <button type="button" class="add-close-btn" onclick="showToast('Form dapat diisi di bawah');" aria-label="Tutup form">&times;</button>
                </div>

                <form class="add-employee-form" onsubmit="handleAddNewEmployee(event)">
                    <!-- Nama Lengkap -->
                    <div class="form-group-item">
                        <label for="new-employee-name">Nama Lengkap</label>
                        <input type="text" id="new-employee-name" placeholder="Nama lengkap karyawan" required />
                    </div>

                    <!-- Nomor HP / WhatsApp -->
                    <div class="form-group-item">
                        <label for="new-employee-phone">Nomor HP / WhatsApp</label>
                        <input type="text" id="new-employee-phone" placeholder="Contoh: 08123456789" required />
                    </div>

                    <!-- Email Akun -->
                    <div class="form-group-item">
                        <label for="new-employee-email">Email Akun</label>
                        <input type="email" id="new-employee-email" placeholder="nama@capaian.id" required />
                    </div>

                    <!-- Divisi -->
                    <div class="form-group-item">
                        <label for="new-employee-divisi">Divisi</label>
                        <div class="select-wrapper">
                            <select id="new-employee-divisi" required>
                                <option value="" disabled selected>Pilih divisi...</option>
                                <option value="Store Manager">Store Manager</option>
                                <option value="Frontliner">Frontliner</option>
                                <option value="Produksi">Produksi</option>
                                <option value="Driver">Driver</option>
                                <option value="Sales & Marketing">Sales &amp; Marketing</option>
                                <option value="SPV">SPV</option>
                            </select>
                            <span class="select-chevron">&#9662;</span>
                        </div>
                    </div>

                    <!-- Outlet / Cabang -->
                    <div class="form-group-item">
                        <label for="new-employee-outlet">Outlet / Cabang</label>
                        <div class="select-wrapper">
                            <select id="new-employee-outlet" required>
                                <option value="" disabled selected>Pilih outlet penempatan...</option>
                                <option value="Outlet Malioboro">Outlet Malioboro</option>
                                <option value="Outlet Kaliurang">Outlet Kaliurang</option>
                                <option value="Dapur Pusat Wonosari">Dapur Pusat Wonosari</option>
                            </select>
                            <span class="select-chevron">&#9662;</span>
                        </div>
                    </div>

                    <!-- Tombol Simpan Akun Baru -->
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

        // Handle Save Edit
        function handleSaveEdit(e, name) {
            e.preventDefault();
            showToast(`Perubahan data ${name} berhasil disimpan!`);
            setTimeout(() => {
                toggleEditCard('budi');
            }, 600);
        }

        // Handle Deactivate Account
        function handleDeactivate(name, wrapperId) {
            if (confirm(`Apakah Anda yakin ingin menonaktifkan akun ${name}?`)) {
                showToast(`Akun ${name} telah dinonaktifkan.`);
                const wrapper = document.getElementById(wrapperId);
                if (wrapper) {
                    wrapper.classList.add('is-inactive-account');
                    const statusPill = wrapper.querySelector('.status-pill');
                    if (statusPill) {
                        statusPill.className = 'status-pill inactive';
                        statusPill.textContent = 'Nonaktif';
                    }
                }
            }
        }

        // Handle Add New Employee
        function handleAddNewEmployee(e) {
            e.preventDefault();
            const name = document.getElementById('new-employee-name').value;
            showToast(`Akun karyawan baru (${name}) berhasil dibuat!`);
            e.target.reset();
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
