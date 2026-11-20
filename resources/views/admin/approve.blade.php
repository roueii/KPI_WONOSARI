<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Approve Laporan | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Approve Laporan -->
        <header class="revisi-header-bar">
            <div class="header-title-wrapper">
                <a href="{{ route('admin.dashboard') }}" class="back-btn" aria-label="Kembali ke beranda">
                    <x-icon name="arrow-left" width="20" height="20" />
                </a>
                <div class="header-titles">
                    <h1 class="header-page-title">Approve Laporan</h1>
                    <span class="header-page-subtitle">Laporan yang sudah disetujui Store Manager</span>
                </div>
            </div>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Horizontal Filter Tabs / Divisi -->
        <div class="kpi-tabs-scroll-wrapper" role="tablist" aria-label="Filter Divisi Laporan">
            <button type="button" 
                    class="kpi-tab-btn is-active" 
                    data-filter="all" 
                    onclick="filterReports('all', this)">
                Semua Divisi
            </button>
            <button type="button" 
                    class="kpi-tab-btn" 
                    data-filter="Store Manager" 
                    onclick="filterReports('Store Manager', this)">
                Store Manager
            </button>
            <button type="button" 
                    class="kpi-tab-btn" 
                    data-filter="Frontliner" 
                    onclick="filterReports('Frontliner', this)">
                Frontliner
            </button>
            <button type="button" 
                    class="kpi-tab-btn" 
                    data-filter="Produksi" 
                    onclick="filterReports('Produksi', this)">
                Produksi
            </button>
            <button type="button" 
                    class="kpi-tab-btn" 
                    data-filter="Driver" 
                    onclick="filterReports('Driver', this)">
                Driver
            </button>
            <button type="button" 
                    class="kpi-tab-btn" 
                    data-filter="Sales & Marketing" 
                    onclick="filterReports('Sales & Marketing', this)">
                Sales & Marketing
            </button>
        </div>

        <!-- 3. Kotak Ringkasan Antrean Approval -->
        <div class="account-summary-card">
            <div class="summary-card-left">
                <div class="approval-summary-icon">
                    <x-icon name="verified-user" width="20" height="20" />
                </div>
                <div class="approval-summary-text">
                    <strong class="approval-summary-count" id="reportsCountText">6 Laporan</strong>
                    <span class="approval-summary-sub">Menunggu verifikasi & approval final Admin</span>
                </div>
            </div>
        </div>

        <!-- 4. Daftar Kartu Laporan Approval -->
        <main class="approval-reports-list" id="approvalReportsList">
            
            <!-- KARTU 1: Budi Santoso (Expanded Sesuai Mockup) -->
            <article class="approval-card is-expanded" id="report-card-1" data-division="Frontliner">
                <!-- Header Kartu -->
                <div class="approval-card-header">
                    <div class="approval-card-person">
                        <h2 class="approval-person-name">Budi Santoso</h2>
                        <span class="approval-division-tag">Frontliner</span>
                    </div>
                    <span class="approval-status-badge">
                        <x-icon name="check" width="12" height="12" />
                        <span>Disetujui SM</span>
                    </span>
                </div>

                <div class="approval-person-sub">Outlet Malioboro &middot; Pelayanan & Kasir</div>

                <!-- Info Approval SM -->
                <div class="approval-meta-row">
                    <x-icon name="check" width="14" height="14" style="color: var(--primary-600);" />
                    <span>Disetujui oleh <strong>Siti (Store Manager)</strong> &middot; 24 Okt, 09:15</span>
                </div>

                <!-- Foto Bukti Card -->
                <div class="approval-attachment-card">
                    <div class="attachment-left">
                        <div class="attachment-thumb-icon">
                            <x-icon name="media-image" width="20" height="20" />
                        </div>
                        <div class="attachment-meta">
                            <strong>Foto Bukti (2 File)</strong>
                            <small>Display kasir & bukti fisik setoran</small>
                        </div>
                    </div>
                    <button type="button" class="attachment-preview-btn" onclick="previewAttachment('Budi Santoso - Foto Bukti (2 File)')">
                        Pratinjau Berkas
                    </button>
                </div>

                <!-- Rincian Indikator Checklist -->
                <div class="approval-checklist-box">
                    <div class="checklist-box-header">
                        <span class="checklist-box-title">RINCIAN INDIKATOR CHECKLIST</span>
                        <span class="checklist-box-progress">1/4 Terpenuhi</span>
                    </div>

                    <div class="checklist-items-stack">
                        <!-- Item 1: Checked -->
                        <div class="checklist-item-entry">
                            <div class="checklist-checkbox is-checked" aria-hidden="true">
                                <x-icon name="check" width="13" height="13" />
                            </div>
                            <div class="checklist-entry-info">
                                <div class="checklist-entry-title">Kebersihan Kasir & Display Roti</div>
                                <div class="checklist-entry-sub">Target: 100% &middot; Hasil: 100% Bersih</div>
                            </div>
                        </div>

                        <!-- Item 2: Unchecked -->
                        <div class="checklist-item-entry">
                            <div class="checklist-checkbox" aria-hidden="true"></div>
                            <div class="checklist-entry-info">
                                <div class="checklist-entry-title">Greeting & Senyum Ramah</div>
                                <div class="checklist-entry-sub">Target: Min 50 &middot; Hasil: 54 transaksi tercatat</div>
                            </div>
                        </div>

                        <!-- Item 3: Unchecked -->
                        <div class="checklist-item-entry">
                            <div class="checklist-checkbox" aria-hidden="true"></div>
                            <div class="checklist-entry-info">
                                <div class="checklist-entry-title">Ketepatan Setoran Fisik Kasir</div>
                                <div class="checklist-entry-sub">Target: Match &middot; Sesuai Rp 4.850.000 (Selisih Rp 0)</div>
                            </div>
                        </div>

                        <!-- Item 4: Unchecked -->
                        <div class="checklist-item-entry">
                            <div class="checklist-checkbox" aria-hidden="true"></div>
                            <div class="checklist-entry-info">
                                <div class="checklist-entry-title">Up-selling Produk Promo (Roti Abon)</div>
                                <div class="checklist-entry-sub">Target: 15 pcs &middot; Hasil: 18 pcs terjual</div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Store Manager Bubble -->
                    <div class="sm-note-bubble">
                        <div class="sm-note-header">
                            <x-icon name="page" width="14" height="14" />
                            <span>CATATAN STORE MANAGER</span>
                        </div>
                        <p class="sm-note-text">
                            &ldquo;Kerja Budi sangat tertib hari ini, display rapi dan closing kasir tepat waktu tanpa selisih.&rdquo;
                        </p>
                    </div>
                </div>

                <!-- Input Catatan Admin / Owner (Opsional) -->
                <div class="admin-note-wrapper">
                    <label for="adminNote1" class="admin-note-label">Catatan Admin / Owner (Opsional)</label>
                    <input type="text" id="adminNote1" class="admin-note-input" placeholder="Tulis catatan revisi atau apresiasi..." />
                </div>

                <!-- Tombol Aksi: Tolak & Approve Final -->
                <div class="approval-card-actions">
                    <button type="button" class="btn-reject-action" onclick="rejectReport(1, 'Budi Santoso')">
                        <x-icon name="cancel" width="14" height="14" />
                        <span>Tolak (Revisi)</span>
                    </button>
                    <button type="button" class="btn-approve-action" onclick="approveReport(1, 'Budi Santoso')">
                        <x-icon name="check" width="15" height="15" />
                        <span>Approve Final</span>
                    </button>
                </div>
            </article>

            <!-- KARTU 2: Joko Prasetyo (Produksi) -->
            <article class="approval-card is-collapsed" id="report-card-2" data-division="Produksi">
                <div class="approval-card-header">
                    <div class="approval-card-person">
                        <h2 class="approval-person-name">Joko Prasetyo</h2>
                        <span class="approval-division-tag">Produksi</span>
                    </div>
                    <span class="approval-status-badge">
                        <x-icon name="check" width="12" height="12" />
                        <span>Disetujui SM</span>
                    </span>
                </div>
                <div class="approval-person-sub">Efisiensi Oven & Bahan Baku &middot; 24 Okt 2024</div>
                
                <div class="approval-summary-row">
                    <div class="approval-time-info">
                        <x-icon name="clock" width="14" height="14" />
                        <span>Disetujui Siti &middot; 10:30 WIB</span>
                    </div>
                    <span class="approval-proof-pill" onclick="previewAttachment('Joko Prasetyo - 1 Foto Bukti')">
                        <x-icon name="camera" width="12" height="12" />
                        <span>1 Foto Bukti</span>
                    </span>
                </div>

                <div class="approval-card-actions">
                    <button type="button" class="btn-reject-action" onclick="rejectReport(2, 'Joko Prasetyo')">
                        <span>Tolak (Revisi)</span>
                    </button>
                    <button type="button" class="btn-approve-action" onclick="approveReport(2, 'Joko Prasetyo')">
                        <x-icon name="check" width="15" height="15" />
                        <span>Approve Final</span>
                    </button>
                </div>
            </article>

            <!-- KARTU 3: Dewi Lestari (Frontliner) -->
            <article class="approval-card is-collapsed" id="report-card-3" data-division="Frontliner">
                <div class="approval-card-header">
                    <div class="approval-card-person">
                        <h2 class="approval-person-name">Dewi Lestari</h2>
                        <span class="approval-division-tag">Frontliner</span>
                    </div>
                    <span class="approval-status-badge">
                        <x-icon name="check" width="12" height="12" />
                        <span>Disetujui SM</span>
                    </span>
                </div>
                <div class="approval-person-sub">Display & Rotasi Stok Roti &middot; 24 Okt 2024</div>
                
                <div class="approval-summary-row">
                    <div class="approval-time-info">
                        <x-icon name="clock" width="14" height="14" />
                        <span>Disetujui Siti &middot; 11:00 WIB</span>
                    </div>
                    <span class="approval-proof-pill" onclick="previewAttachment('Dewi Lestari - 3 Foto Bukti')">
                        <x-icon name="camera" width="12" height="12" />
                        <span>3 Foto Bukti</span>
                    </span>
                </div>

                <div class="approval-card-actions">
                    <button type="button" class="btn-reject-action" onclick="rejectReport(3, 'Dewi Lestari')">
                        <span>Tolak (Revisi)</span>
                    </button>
                    <button type="button" class="btn-approve-action" onclick="approveReport(3, 'Dewi Lestari')">
                        <x-icon name="check" width="15" height="15" />
                        <span>Approve Final</span>
                    </button>
                </div>
            </article>

            <!-- KARTU 4: Agus Hermawan (Driver) -->
            <article class="approval-card is-collapsed" id="report-card-4" data-division="Driver">
                <div class="approval-card-header">
                    <div class="approval-card-person">
                        <h2 class="approval-person-name">Agus Hermawan</h2>
                        <span class="approval-division-tag">Driver</span>
                    </div>
                    <span class="approval-status-badge">
                        <x-icon name="check" width="12" height="12" />
                        <span>Disetujui SM</span>
                    </span>
                </div>
                <div class="approval-person-sub">Ketepatan Pengantaran Outlet &middot; 24 Okt 2024</div>
                
                <div class="approval-summary-row">
                    <div class="approval-time-info">
                        <x-icon name="clock" width="14" height="14" />
                        <span>Disetujui Siti &middot; 11:45 WIB</span>
                    </div>
                    <span class="approval-proof-pill" onclick="previewAttachment('Agus Hermawan - 1 Foto Bukti')">
                        <x-icon name="camera" width="12" height="12" />
                        <span>1 Foto Bukti</span>
                    </span>
                </div>

                <div class="approval-card-actions">
                    <button type="button" class="btn-reject-action" onclick="rejectReport(4, 'Agus Hermawan')">
                        <span>Tolak (Revisi)</span>
                    </button>
                    <button type="button" class="btn-approve-action" onclick="approveReport(4, 'Agus Hermawan')">
                        <x-icon name="check" width="15" height="15" />
                        <span>Approve Final</span>
                    </button>
                </div>
            </article>

            <!-- KARTU 5: Rian Hidayat (Sales & Marketing) -->
            <article class="approval-card is-collapsed" id="report-card-5" data-division="Sales & Marketing">
                <div class="approval-card-header">
                    <div class="approval-card-person">
                        <h2 class="approval-person-name">Rian Hidayat</h2>
                        <span class="approval-division-tag">Sales & Marketing</span>
                    </div>
                    <span class="approval-status-badge">
                        <x-icon name="check" width="12" height="12" />
                        <span>Disetujui SM</span>
                    </span>
                </div>
                <div class="approval-person-sub">Kemitraan Katering Event &middot; 23 Okt 2024</div>
                
                <div class="approval-summary-row">
                    <div class="approval-time-info">
                        <x-icon name="clock" width="14" height="14" />
                        <span>Disetujui Siti &middot; 24 Okt, 08:30 WIB</span>
                    </div>
                    <span class="approval-proof-pill" onclick="previewAttachment('Rian Hidayat - 2 Foto Bukti')">
                        <x-icon name="camera" width="12" height="12" />
                        <span>2 Foto Bukti</span>
                    </span>
                </div>

                <div class="approval-card-actions">
                    <button type="button" class="btn-reject-action" onclick="rejectReport(5, 'Rian Hidayat')">
                        <span>Tolak (Revisi)</span>
                    </button>
                    <button type="button" class="btn-approve-action" onclick="approveReport(5, 'Rian Hidayat')">
                        <x-icon name="check" width="15" height="15" />
                        <span>Approve Final</span>
                    </button>
                </div>
            </article>

            <!-- KARTU 6: Siti Rahma (Store Manager) -->
            <article class="approval-card is-collapsed" id="report-card-6" data-division="Store Manager">
                <div class="approval-card-header">
                    <div class="approval-card-person">
                        <h2 class="approval-person-name">Siti Rahma</h2>
                        <span class="approval-division-tag">Store Manager</span>
                    </div>
                    <span class="approval-status-badge is-self">
                        <x-icon name="check-circle" width="12" height="12" />
                        <span>Self-Review SM</span>
                    </span>
                </div>
                <div class="approval-person-sub">Stock Opname & Laba Harian &middot; 23 Okt 2024</div>
                
                <div class="approval-summary-row">
                    <div class="approval-time-info">
                        <x-icon name="clock" width="14" height="14" />
                        <span>Disubmit Siti &middot; 23 Okt, 21:00 WIB</span>
                    </div>
                    <span class="approval-proof-pill" onclick="previewAttachment('Siti Rahma - 4 Foto Bukti')">
                        <x-icon name="camera" width="12" height="12" />
                        <span>4 Foto Bukti</span>
                    </span>
                </div>

                <div class="approval-card-actions">
                    <button type="button" class="btn-reject-action" onclick="rejectReport(6, 'Siti Rahma')">
                        <span>Tolak (Revisi)</span>
                    </button>
                    <button type="button" class="btn-approve-action" onclick="approveReport(6, 'Siti Rahma')">
                        <x-icon name="check" width="15" height="15" />
                        <span>Approve Final</span>
                    </button>
                </div>
            </article>

        </main>

        <!-- 5. Info / Disclaimer Sinkronisasi Rapor Bulanan -->
        <footer class="approval-sync-disclaimer">
            <div class="disclaimer-icon">
                <x-icon name="info-empty" width="18" height="18" />
            </div>
            <div class="disclaimer-text">
                Laporan yang disetujui final akan langsung disinkronisasi ke <strong>Rapor Bulanan</strong> dan menjadi basis kalkulasi bonus KPI karyawan secara otomatis.
            </div>
        </footer>

        <!-- 6. Modal Pratinjau Berkas Bukti -->
        <div class="kpi-modal-overlay" id="proofModal" aria-hidden="true">
            <div class="kpi-modal-sheet" role="dialog" aria-modal="true" aria-labelledby="proofTitle">
                <div class="kpi-modal-header">
                    <h3 class="kpi-modal-title" id="proofTitle">Pratinjau Foto Bukti</h3>
                    <button type="button" class="kpi-modal-close" onclick="closeProofModal()" aria-label="Tutup preview">&times;</button>
                </div>
                <div class="proof-modal-body">
                    <div class="proof-photo-box">
                        <div class="photo-placeholder-card">
                            <x-icon name="media-image" width="40" height="40" style="color: var(--primary-600);" />
                            <span class="photo-title" id="proofPhotoName">Foto Display Kasir & Setoran</span>
                            <small class="photo-sub">Diambil melalui kamera aplikasi &middot; Geotag Outlet Malioboro</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close-proof" onclick="closeProofModal()">Tutup Pratinjau</button>
                </div>
            </div>
        </div>

        <!-- 7. Side Menu Drawer Partial -->
        @include('admin.partials.drawer')

        <!-- 8. Toast Notification Pop-up -->
        <div id="toastNotification" class="toast-popup" role="alert" aria-live="polite">
            <div class="toast-indicator"></div>
            <span id="toastMessage">Pemberitahuan</span>
        </div>
    </div>

    <!-- Script Interaktif Approve Laporan -->
    <script src="{{ asset('js/drawer.js') }}"></script>
    <script>
        let totalRemaining = 6;

        // Filter daftar laporan berdasarkan divisi
        function filterReports(division, btnElement) {
            document.querySelectorAll('.kpi-tabs-scroll-wrapper .kpi-tab-btn').forEach(btn => {
                btn.classList.remove('is-active');
            });
            if (btnElement) {
                btnElement.classList.add('is-active');
            }

            const cards = document.querySelectorAll('.approval-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const cardDiv = card.getAttribute('data-division');
                if (division === 'all' || cardDiv === division) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            showToast(`Menampilkan ${visibleCount} laporan untuk filter ${division === 'all' ? 'Semua Divisi' : division}`);
        }

        // Aksi Approve Final
        function approveReport(id, name) {
            const card = document.getElementById(`report-card-${id}`);
            if (!card) return;

            card.style.transition = 'all 0.35s cubic-bezier(0.16, 1, 0.3, 1)';
            card.style.transform = 'scale(0.96) translateY(-10px)';
            card.style.opacity = '0';

            setTimeout(() => {
                card.remove();
                totalRemaining = Math.max(0, totalRemaining - 1);
                updateCountDisplay();
                showToast(`✓ Laporan ${name} berhasil di-approve final dan disinkronkan ke Rapor Bulanan!`);
            }, 350);
        }

        // Aksi Tolak (Revisi)
        function rejectReport(id, name) {
            const noteInput = document.getElementById(`adminNote${id}`);
            const noteVal = noteInput ? noteInput.value.trim() : '';

            const confirmReject = confirm(`Kirim kembali laporan ${name} ke antrean revisi?`);
            if (!confirmReject) return;

            const card = document.getElementById(`report-card-${id}`);
            if (!card) return;

            card.style.transition = 'all 0.35s cubic-bezier(0.16, 1, 0.3, 1)';
            card.style.transform = 'scale(0.96) translateX(-20px)';
            card.style.opacity = '0';

            setTimeout(() => {
                card.remove();
                totalRemaining = Math.max(0, totalRemaining - 1);
                updateCountDisplay();
                showToast(`Laporan ${name} dikembalikan untuk diperbaiki (Perlu Revisi).`);
            }, 350);
        }

        function updateCountDisplay() {
            const countText = document.getElementById('reportsCountText');
            if (countText) {
                countText.textContent = `${totalRemaining} Laporan`;
            }
        }

        // Modal Preview Berkas
        function previewAttachment(title) {
            const modal = document.getElementById('proofModal');
            const proofTitle = document.getElementById('proofTitle');
            const photoName = document.getElementById('proofPhotoName');

            if (proofTitle) proofTitle.textContent = title;
            if (photoName) photoName.textContent = title;

            if (modal) {
                modal.classList.add('is-active');
                modal.setAttribute('aria-hidden', 'false');
            }
        }

        function closeProofModal() {
            const modal = document.getElementById('proofModal');
            if (modal) {
                modal.classList.remove('is-active');
                modal.setAttribute('aria-hidden', 'true');
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
            }, 3400);
        }

        // Drawer navigation
        document.addEventListener('DOMContentLoaded', function () {
        });
    </script>
</body>

</html>
