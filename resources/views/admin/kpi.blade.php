<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola KPI | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Kelola KPI -->
        <header class="revisi-header-bar">
            <div class="header-title-wrapper">
                <a href="{{ route('admin.dashboard') }}" class="back-btn" aria-label="Kembali ke beranda">
                    <x-icon name="arrow-left" width="20" height="20" />
                </a>
                <div class="header-titles">
                    <h1 class="header-page-title">Kelola KPI</h1>
                    <span class="header-page-subtitle">Atur hal yang dicatat tiap bagian</span>
                </div>
            </div>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Horizontal Filter Tabs / Divisi -->
        <div class="kpi-tabs-scroll-wrapper" role="tablist" aria-label="Pilih Divisi KPI">
            @foreach($divisions as $div)
                <button type="button" 
                        class="kpi-tab-btn {{ $div === $activeDivision ? 'is-active' : '' }}" 
                        role="tab"
                        aria-selected="{{ $div === $activeDivision ? 'true' : 'false' }}"
                        data-division="{{ $div }}"
                        onclick="switchDivision('{{ $div }}', this)">
                    {{ $div }}
                </button>
            @endforeach
        </div>

        <!-- 3. Alert / Info Banner -->
        <div class="kpi-info-banner" role="status">
            <div class="kpi-info-icon" aria-hidden="true">
                <x-icon name="info-empty" width="18" height="18" />
            </div>
            <div class="kpi-info-text">
                Aplikasi hanya merekap isian, tanpa bobot dan nilai akhir. Perubahan berlaku mulai isian besok.
            </div>
        </div>

        <!-- 4. Kontainer Grup KPI untuk setiap Divisi -->
        <main class="kpi-groups-container" id="kpiGroupsContainer">
            @foreach($kpiGroups as $divisionName => $groups)
                <div class="kpi-division-panel {{ $divisionName === $activeDivision ? 'is-visible' : 'is-hidden' }}" 
                     id="panel-{{ Str::slug($divisionName) }}"
                     data-division-panel="{{ $divisionName }}">
                    
                    @foreach($groups as $groupIndex => $group)
                        <div class="kpi-group-card {{ $group['expanded'] ? 'is-open' : 'is-collapsed' }}" 
                             id="group-{{ $divisionName }}-{{ $group['id'] }}">
                            
                            <!-- Accordion Header -->
                            <button type="button" class="kpi-group-header" onclick="toggleKpiGroup('group-{{ $divisionName }}-{{ $group['id'] }}')">
                                <div class="kpi-group-title-box">
                                    <h2 class="kpi-group-title">{{ $group['title'] }}</h2>
                                    @if(!empty($group['count_text']))
                                        <span class="kpi-group-subtitle">{{ $group['count_text'] }}</span>
                                    @endif
                                </div>
                                <span class="kpi-group-chevron" aria-hidden="true">
                                    <x-icon name="nav-arrow-up" width="18" height="18" />
                                </span>
                            </button>

                            <!-- Accordion Body -->
                            <div class="kpi-group-body">
                                <div class="kpi-items-list">
                                    @foreach($group['items'] as $item)
                                        <div class="kpi-item-row" id="kpi-item-{{ $item['id'] }}">
                                            <div class="kpi-item-main">
                                                <div class="kpi-item-title">{{ $item['name'] }}</div>
                                                @if(!empty($item['subtitle']))
                                                    <div class="kpi-item-sub">{{ $item['subtitle'] }}</div>
                                                @endif
                                            </div>

                                            <div class="kpi-item-side">
                                                <span class="kpi-type-badge {{ str_contains($item['badge'], 'Ceklis') ? 'is-ceklis' : 'is-angka' }}">
                                                    {{ $item['badge'] }}
                                                </span>
                                                <button type="button" 
                                                        class="kpi-options-btn" 
                                                        aria-label="Opsi indikator {{ $item['name'] }}"
                                                        onclick="openItemOptions(event, '{{ $item['id'] }}', '{{ addslashes($item['name']) }}')">
                                                    &middot;&middot;&middot;
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Tombol Tambah di Kelompok Ini -->
                                <button type="button" 
                                        class="kpi-add-group-action"
                                        onclick="openAddModal('{{ $group['title'] }}')">
                                    <x-icon name="plus" width="16" height="16" />
                                    <span>Tambah di kelompok ini</span>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <!-- Kelompok Nonaktif (Collapsible Section) -->
                    <div class="kpi-inactive-accordion" id="inactive-{{ Str::slug($divisionName) }}">
                        <button type="button" class="kpi-inactive-header" onclick="toggleInactive('inactive-{{ Str::slug($divisionName) }}')">
                            <span class="kpi-inactive-chevron">&#8250;</span>
                            <span class="kpi-inactive-title">Nonaktif (0)</span>
                        </button>
                        <div class="kpi-inactive-body">
                            <p class="kpi-inactive-empty">Belum ada indikator KPI yang dinonaktifkan di bagian ini.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </main>

        <!-- 5. Tombol CTA Tambah Hal Yang Dicatat & Footer Hint -->
        <div class="kpi-bottom-action-wrapper">
            <button type="button" class="btn-add-kpi-main" onclick="openAddModal('')">
                <x-icon name="plus" width="18" height="18" />
                <span>Tambah hal yang dicatat</span>
            </button>
            <p class="kpi-swipe-hint">Geser tab untuk melihat bagian lainnya.</p>
        </div>

        <!-- 6. Modal Tambah Hal yang Dicatat -->
        <div class="kpi-modal-overlay" id="addKpiModal" aria-hidden="true">
            <div class="kpi-modal-sheet" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
                <div class="kpi-modal-header">
                    <h3 class="kpi-modal-title" id="modalTitle">Tambah Hal yang Dicatat</h3>
                    <button type="button" class="kpi-modal-close" onclick="closeAddModal()" aria-label="Tutup form">
                        &times;
                    </button>
                </div>

                <form class="kpi-modal-form" onsubmit="saveNewKpi(event)">
                    <div class="form-group-field">
                        <label for="kpiDivisionSelect">Divisi Kerja</label>
                        <select id="kpiDivisionSelect" class="form-select-kpi" required>
                            @foreach($divisions as $div)
                                <option value="{{ $div }}" {{ $div === 'Produksi' ? 'selected' : '' }}>{{ $div }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group-field">
                        <label for="kpiGroupSelect">Kelompok / Kategori</label>
                        <select id="kpiGroupSelect" class="form-select-kpi" required>
                            <option value="Produktivitas produksi">Produktivitas produksi</option>
                            <option value="Kualitas produk">Kualitas produk</option>
                            <option value="Kepatuhan SOP">Kepatuhan SOP</option>
                            <option value="Kebersihan area produksi">Kebersihan area produksi</option>
                            <option value="+ Buat Kelompok Baru">+ Buat Kelompok Baru...</option>
                        </select>
                    </div>

                    <div class="form-group-field">
                        <label for="kpiNameInput">Nama Hal / Indikator yang Dicatat</label>
                        <input type="text" id="kpiNameInput" class="form-input-kpi" placeholder="Contoh: Mengontrol suhu oven, Sanitasi meja..." required />
                    </div>

                    <div class="form-group-field">
                        <label>Tipe Isian</label>
                        <div class="kpi-radio-toggle-group">
                            <label class="kpi-radio-card">
                                <input type="radio" name="kpiType" value="checkbox" checked onchange="toggleTypeInputs('checkbox')" />
                                <span class="radio-card-content">
                                    <strong>Ceklis (Ya / Tidak)</strong>
                                    <small>Staf mencentang setelah tugas selesai</small>
                                </span>
                            </label>
                            <label class="kpi-radio-card">
                                <input type="radio" name="kpiType" value="number" onchange="toggleTypeInputs('number')" />
                                <span class="radio-card-content">
                                    <strong>Angka / Nilai</strong>
                                    <small>Input angka seperti pcs, kg, persen (%)</small>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group-field" id="numberOptionsRow" style="display: none;">
                        <label for="kpiUnitInput">Satuan & Target (Opsional)</label>
                        <div class="kpi-dual-inputs">
                            <input type="text" id="kpiUnitInput" class="form-input-kpi" placeholder="Satuan (misal: pcs, %, Rp)" />
                            <input type="text" id="kpiTargetInput" class="form-input-kpi" placeholder="Target / Standar (misal: Maks 2%)" />
                        </div>
                    </div>

                    <div class="kpi-modal-actions">
                        <button type="button" class="btn-kpi-cancel" onclick="closeAddModal()">Batal</button>
                        <button type="submit" class="btn-kpi-submit">Simpan Hal Ini</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- 7. Action Sheet / Options Menu Popup for 3-dots -->
        <div class="kpi-options-menu" id="kpiOptionsMenu">
            <button type="button" class="options-menu-item" onclick="triggerEditOption()">
                <x-icon name="edit-pencil" width="16" height="16" />
                <span>Edit Hal Ini</span>
            </button>
            <button type="button" class="options-menu-item" onclick="triggerDeactivateOption()">
                <x-icon name="prohibition" width="16" height="16" />
                <span>Pindahkan ke Nonaktif</span>
            </button>
            <button type="button" class="options-menu-item is-danger" onclick="triggerDeleteOption()">
                <x-icon name="trash" width="16" height="16" />
                <span>Hapus Permanen</span>
            </button>
        </div>

        <!-- 8. Side Menu Drawer Partial -->
        @include('admin.partials.drawer')

        <!-- 9. Toast Notification Pop-up -->
        <div id="toastNotification" class="toast-popup" role="alert" aria-live="polite">
            <div class="toast-indicator"></div>
            <span id="toastMessage">Pemberitahuan</span>
        </div>
    </div>

    <!-- Script Interaktif Kelola KPI -->
    <script src="{{ asset('js/drawer.js') }}"></script>
    <script>
        let currentTargetItemId = null;
        let currentTargetItemName = '';

        // Switch division tabs
        function switchDivision(divisionName, btnElement) {
            // Update tab active classes
            document.querySelectorAll('.kpi-tab-btn').forEach(btn => {
                btn.classList.remove('is-active');
                btn.setAttribute('aria-selected', 'false');
            });
            if (btnElement) {
                btnElement.classList.add('is-active');
                btnElement.setAttribute('aria-selected', 'true');
            }

            // Show matching division panel
            document.querySelectorAll('.kpi-division-panel').forEach(panel => {
                panel.classList.remove('is-visible');
                panel.classList.add('is-hidden');
            });

            const targetPanel = document.querySelector(`[data-division-panel="${divisionName}"]`);
            if (targetPanel) {
                targetPanel.classList.remove('is-hidden');
                targetPanel.classList.add('is-visible');
            }

            // Sync select in modal
            const divisionSelect = document.getElementById('kpiDivisionSelect');
            if (divisionSelect) {
                divisionSelect.value = divisionName;
            }
        }

        // Toggle KPI group accordion (expand / collapse)
        function toggleKpiGroup(groupId) {
            const card = document.getElementById(groupId);
            if (!card) return;

            if (card.classList.contains('is-open')) {
                card.classList.remove('is-open');
                card.classList.add('is-collapsed');
            } else {
                card.classList.remove('is-collapsed');
                card.classList.add('is-open');
            }
        }

        // Toggle inactive group
        function toggleInactive(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.toggle('is-open');
            }
        }

        // Open modal to add KPI
        function openAddModal(groupTitle) {
            const modal = document.getElementById('addKpiModal');
            const groupSelect = document.getElementById('kpiGroupSelect');
            
            if (groupTitle && groupSelect) {
                // Check if option exists, otherwise select or set it
                let exists = false;
                for (let i = 0; i < groupSelect.options.length; i++) {
                    if (groupSelect.options[i].value === groupTitle) {
                        groupSelect.selectedIndex = i;
                        exists = true;
                        break;
                    }
                }
                if (!exists) {
                    const opt = document.createElement('option');
                    opt.value = groupTitle;
                    opt.textContent = groupTitle;
                    opt.selected = true;
                    groupSelect.insertBefore(opt, groupSelect.firstChild);
                }
            }

            if (modal) {
                modal.classList.add('is-active');
                modal.setAttribute('aria-hidden', 'false');
                document.getElementById('kpiNameInput').focus();
            }
        }

        // Close modal
        function closeAddModal() {
            const modal = document.getElementById('addKpiModal');
            if (modal) {
                modal.classList.remove('is-active');
                modal.setAttribute('aria-hidden', 'true');
            }
        }

        // Toggle radio type inputs
        function toggleTypeInputs(type) {
            const row = document.getElementById('numberOptionsRow');
            if (row) {
                row.style.display = type === 'number' ? 'block' : 'none';
            }
        }

        // Save new KPI
        function saveNewKpi(e) {
            e.preventDefault();
            const name = document.getElementById('kpiNameInput').value.trim();
            const division = document.getElementById('kpiDivisionSelect').value;
            const group = document.getElementById('kpiGroupSelect').value;

            if (!name) return;

            closeAddModal();
            showToast(`Berhasil menambahkan "${name}" ke bagian ${division}!`);
            document.getElementById('kpiNameInput').value = '';
        }

        // Options menu for 3-dots
        function openItemOptions(event, itemId, itemName) {
            event.stopPropagation();
            currentTargetItemId = itemId;
            currentTargetItemName = itemName;

            const menu = document.getElementById('kpiOptionsMenu');
            const btn = event.currentTarget;
            const rect = btn.getBoundingClientRect();

            menu.style.top = `${rect.bottom + window.scrollY + 6}px`;
            menu.style.left = `${Math.min(rect.left - 130, window.innerWidth - 180)}px`;
            menu.classList.add('is-visible');
        }

        // Hide options menu when clicking outside
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('kpiOptionsMenu');
            if (menu && !menu.contains(e.target)) {
                menu.classList.remove('is-visible');
            }
        });

        function triggerEditOption() {
            document.getElementById('kpiOptionsMenu').classList.remove('is-visible');
            showToast(`Mengedit hal: ${currentTargetItemName}`);
        }

        function triggerDeactivateOption() {
            document.getElementById('kpiOptionsMenu').classList.remove('is-visible');
            showToast(`"${currentTargetItemName}" dipindahkan ke Nonaktif.`);
            const row = document.getElementById(`kpi-item-${currentTargetItemId}`);
            if (row) {
                row.style.opacity = '0.4';
                row.style.textDecoration = 'line-through';
            }
        }

        function triggerDeleteOption() {
            document.getElementById('kpiOptionsMenu').classList.remove('is-visible');
            if (confirm(`Hapus "${currentTargetItemName}" secara permanen?`)) {
                const row = document.getElementById(`kpi-item-${currentTargetItemId}`);
                if (row) {
                    row.remove();
                }
                showToast(`"${currentTargetItemName}" berhasil dihapus.`);
            }
        }

        // Toast feedback
        let toastTimer;
        function showToast(msg) {
            const toast = document.getElementById('toastNotification');
            const toastMsg = document.getElementById('toastMessage');
            if (!toast || !toastMsg) return;

            clearTimeout(toastTimer);
            toastMsg.textContent = msg;
            toast.classList.add('is-visible');
            toastTimer = setTimeout(() => {
                toast.classList.remove('is-visible');
            }, 3200);
        }

        // Drawer navigation
        document.addEventListener('DOMContentLoaded', function () {
        });
    </script>
</body>

</html>
