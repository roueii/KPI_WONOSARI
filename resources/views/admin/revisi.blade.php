<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tinjau Revisi | Capaian.id - KPI Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Halaman Tinjau Revisi -->
        <header class="revisi-header-bar">
            <div class="header-title-wrapper">
                <a href="{{ route('admin.dashboard') }}" class="back-btn" aria-label="Kembali ke beranda">
                    <x-icon name="arrow-left" width="20" height="20" />
                </a>
                <div class="header-titles">
                    <h1 class="header-page-title">Tinjau Revisi</h1>
                    <span class="header-page-subtitle">Laporan yang sudah disetujui Store Manager</span>
                </div>
            </div>

            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </header>

        <!-- 2. Banner Perhatian -->
        <div class="revisi-alert-banner">
            <div class="alert-icon-square" aria-hidden="true">
                <x-icon name="warning-circle" />
            </div>
            <strong class="alert-text">3 Karyawan Perlu Revisi</strong>
        </div>

        <!-- 3. Filter Kategori Tabs -->
        <div class="filter-tabs-row" role="tablist">
            <button class="filter-chip is-active" data-filter="all">Semua (3)</button>
            <button class="filter-chip" data-filter="sm">Diminta SM</button>
            <button class="filter-chip" data-filter="owner">Diminta Owner</button>
            <button class="filter-chip" data-filter="store_manager">Store Manager</button>
        </div>

        <!-- 4. Daftar Kartu Revisi Karyawan -->
        <div class="revisi-cards-list">

            <!-- KARTU 1: Budi Santoso (Frontliner) - Expanded View -->
            <article class="revisi-card" id="card-budi" data-category="sm">
                <div class="revisi-card-header">
                    <div class="user-meta-group">
                        <div class="user-name-role">
                            <h2 class="user-name">Budi Santoso</h2>
                            <span class="user-role-badge">Frontliner</span>
                        </div>
                        <span class="user-subtitle">Pelayanan &amp; Kasir &middot; Shift Pagi</span>
                    </div>
                    <div class="req-origin-badge">
                        <x-icon name="clock" width="13" height="13" />
                        <span>Diminta SM</span>
                    </div>
                </div>

                <!-- Overdue Status Bar -->
                <div class="overdue-bar danger-mode">
                    <x-icon name="clock" width="14" height="14" />
                    <span>Menggantung 3 hari (Overdue &gt; 48 Jam)</span>
                </div>

                <!-- Kotak Alasan Revisi -->
                <div class="revisi-reason-box">
                    <strong class="reason-title">Alasan Revisi: Foto slip terlipat</strong>
                    <p class="reason-desc">Foto setoran kasir berbayang dan total penerimaan tunai terpotong pada batas frame.</p>
                    <span class="reason-date">22 Okt 2024</span>
                </div>

                <!-- Konten Rincian (Detail yang bisa di-expand/collapse) -->
                <div class="revisi-detail-content" id="detail-budi">
                    <!-- Berkas Lampiran -->
                    <div class="attachment-preview-box">
                        <div class="attachment-icon-peach">
                            <x-icon name="media-image" />
                        </div>
                        <div class="attachment-info">
                            <strong class="attachment-filename">Foto_Setoran_22Okt.jpg</strong>
                            <span class="attachment-time">Diunggah: 22 Okt, 19:40 WIB</span>
                            <button type="button" class="preview-link-btn" onclick="showToast('Membuka pratinjau Foto_Setoran_22Okt.jpg...');">Pratinjau Berkas</button>
                        </div>
                    </div>

                    <!-- Status Indikator Form Harian -->
                    <div class="indicators-section-box">
                        <span class="indicators-box-title">STATUS INDIKATOR FORM HARIAN</span>
                        <div class="indicator-item-row">
                            <div class="indicator-name-group">
                                <span class="indicator-icon-status success">
                                    <x-icon name="check" />
                                </span>
                                <span class="indicator-label">Kebersihan Kasir &amp; Display Roti</span>
                            </div>
                            <span class="indicator-score terracotta">100% Sesuai</span>
                        </div>

                        <div class="indicator-item-row">
                            <div class="indicator-name-group">
                                <span class="indicator-icon-status success">
                                    <x-icon name="check" />
                                </span>
                                <span class="indicator-label">Greeting &amp; Senyum Ramah</span>
                            </div>
                            <span class="indicator-score dark">32 / 50 Pax</span>
                        </div>

                        <div class="indicator-item-row">
                            <div class="indicator-name-group">
                                <span class="indicator-icon-status warning">
                                    <x-icon name="warning-circle" />
                                </span>
                                <span class="indicator-label">Ketepatan Setoran Fisik Kasir</span>
                            </div>
                            <span class="indicator-score warning">Perlu Revisi</span>
                        </div>
                    </div>

                    <!-- Catatan Evaluator / SM -->
                    <div class="reviewer-quote-box">
                        <div class="quote-icon" aria-hidden="true">
                            <x-icon name="page" />
                        </div>
                        <div class="quote-text-group">
                            <span class="quote-author">Siti Rahma (22 Okt, 20:15 WIB)</span>
                            <blockquote class="quote-body">
                                &ldquo;Foto slip setoran tidak terbaca dan nominal terpotong. Mohon foto ulang dengan pencahayaan jelas sebelum disubmit kembali.&rdquo;
                            </blockquote>
                        </div>
                    </div>

                    <!-- Jejak Audit Revisi (Timeline) -->
                    <div class="audit-trail-wrapper">
                        <span class="audit-trail-heading">JEJAK AUDIT REVISI</span>
                        <div class="audit-timeline">
                            <div class="timeline-step">
                                <div class="timeline-dot red"></div>
                                <div class="timeline-line"></div>
                                <div class="timeline-step-content">
                                    <strong class="step-title">Ditolak SM (22 Okt, 20:15)</strong>
                                    <p class="step-desc">Siti Rahma meminta perbaikan slip setoran fisik.</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-dot orange"></div>
                                <div class="timeline-line"></div>
                                <div class="timeline-step-content">
                                    <strong class="step-title">Tindak Lanjut Karyawan Dikirim</strong>
                                    <p class="step-desc">Pemberitahuan sistem otomatis terkirim via WhatsApp.</p>
                                </div>
                            </div>
                            <div class="timeline-step">
                                <div class="timeline-dot orange"></div>
                                <div class="timeline-step-content">
                                    <strong class="step-title">Belum Diselesaikan (+72 Jam)</strong>
                                    <p class="step-desc">Melebihi SLA penyelesaian 48 jam operasional outlet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Kartu 1 -->
                <div class="revisi-card-actions">
                    <button type="button" class="toggle-detail-btn" id="btn-toggle-budi" onclick="toggleCardDetail('budi')">
                        <span class="toggle-icon">&#9650;</span>
                        <span class="toggle-text">Sembunyikan Rincian</span>
                    </button>

                    <button type="button" class="btn-manual-resolve-green" onclick="handleManualResolve('Budi Santoso', 'card-budi')">
                        <x-icon name="check-circle" width="18" height="18" />
                        <span>Tandai sudah ditegur/ditindaklanjuti manual</span>
                    </button>
                </div>
            </article>

            <!-- KARTU 2: Joko Prasetyo (Produksi) - Collapsed View -->
            <article class="revisi-card" id="card-joko" data-category="owner">
                <div class="revisi-card-header">
                    <div class="user-meta-group">
                        <div class="user-name-role">
                            <h2 class="user-name">Joko Prasetyo</h2>
                            <span class="user-role-badge">Produksi</span>
                        </div>
                        <span class="user-subtitle">Laporan Rendemen Roti Tawar</span>
                    </div>
                </div>

                <!-- Overdue Status Bar (SLA Aman) -->
                <div class="overdue-bar safe-mode">
                    <div class="overdue-left">
                        <x-icon name="clock" width="14" height="14" />
                        <span>Menggantung 18 jam</span>
                    </div>
                    <span class="sla-badge">SLA Aman</span>
                </div>

                <!-- Deskripsi Masalah Singkat -->
                <div class="revisi-summary-block">
                    <strong class="summary-title">Efisiensi Oven &amp; Bahan Baku</strong>
                    <p class="summary-desc">Catatan Owner: Terdapat selisih 2.4 kg adonan tepung dengan output loyang yang belum dicantumkan...</p>
                    <span class="summary-date">Diajukan kembali: 24 Okt 2024</span>
                </div>

                <!-- Dokumen Lampiran Baris -->
                <div class="attachment-bar-row" onclick="showToast('Membuka Foto Logbook Oven...');">
                    <div class="bar-row-left">
                        <span class="doc-icon">&#128196;</span>
                        <span class="doc-name">Foto Logbook Oven (1 Dokumen)</span>
                    </div>
                    <span class="bar-chevron">&#8250;</span>
                </div>

                <!-- Aksi Kartu 2 -->
                <div class="revisi-card-actions">
                    <button type="button" class="btn-primary-orange" onclick="showToast('Membuka formulir detail Joko Prasetyo...');">
                        <x-icon name="eye-empty" width="17" height="17" />
                        <span>Lihat Detail Permintaan</span>
                    </button>

                    <button type="button" class="btn-secondary-outline" onclick="handleManualResolve('Joko Prasetyo', 'card-joko')">
                        <x-icon name="clock" width="15" height="15" />
                        <span>Tandai sudah ditindaklanjuti manual</span>
                    </button>
                </div>
            </article>

            <!-- KARTU 3: Agus Hermawan (Driver) - Collapsed View -->
            <article class="revisi-card" id="card-agus" data-category="sm">
                <div class="revisi-card-header">
                    <div class="user-meta-group">
                        <div class="user-name-role">
                            <h2 class="user-name">Agus Hermawan</h2>
                            <span class="user-role-badge">Driver</span>
                        </div>
                        <span class="user-subtitle">Distribusi Tray Croissant &amp; Pastry</span>
                    </div>
                </div>

                <!-- Overdue Status Bar (Batas: Besok) -->
                <div class="overdue-bar safe-mode">
                    <div class="overdue-left">
                        <x-icon name="clock" width="14" height="14" />
                        <span>Menggantung 1 hari (26 Jam)</span>
                    </div>
                    <span class="sla-badge">Batas: Besok</span>
                </div>

                <!-- Deskripsi Masalah Singkat -->
                <div class="revisi-summary-block">
                    <strong class="summary-title">Ketepatan Pengantaran Outlet Kaliurang</strong>
                    <p class="summary-desc">Catatan SM: Lembar surat jalan fisik belum ditandatangani oleh supervisor penerima outlet Kaliurang. Mohon unggah...</p>
                    <span class="summary-date">23 Okt 2024</span>
                </div>

                <!-- Dokumen Lampiran Baris -->
                <div class="attachment-bar-row" onclick="showToast('Membuka Surat_Jalan_Kaliurang_No4.pdf...');">
                    <div class="bar-row-left">
                        <span class="doc-icon">&#128196;</span>
                        <span class="doc-name">Surat_Jalan_Kaliurang_No4.pdf</span>
                    </div>
                    <span class="bar-chevron">&#8250;</span>
                </div>

                <!-- Aksi Kartu 3 -->
                <div class="revisi-card-actions">
                    <button type="button" class="btn-primary-orange" onclick="showToast('Membuka formulir detail Agus Hermawan...');">
                        <x-icon name="eye-empty" width="17" height="17" />
                        <span>Lihat Detail Permintaan</span>
                    </button>

                    <button type="button" class="btn-secondary-outline" onclick="handleManualResolve('Agus Hermawan', 'card-agus')">
                        <x-icon name="clock" width="15" height="15" />
                        <span>Tandai sudah ditindaklanjuti manual</span>
                    </button>
                </div>
            </article>

        </div>

        <!-- 5. Kartu Informasi Batasan Akses Mode Monitoring -->
        <footer class="monitoring-notice-box">
            <div class="notice-icon" aria-hidden="true">
                <x-icon name="info-empty" />
            </div>
            <div class="notice-content">
                <strong class="notice-title">Batasan Akses Mode Monitoring</strong>
                <p class="notice-desc">
                    Layar ini difungsikan khusus untuk pengawasan dan koordinasi lintas outlet oleh Pemilik Bisnis. Perbaikan data checklist serta unggah ulang dokumen fisik wajib dilakukan langsung oleh staf bersangkutan melalui portal operasional masing-masing.
                </p>
            </div>
        </footer>

        <!-- Include Side Menu Drawer (Gambar 1) -->
        @include('admin.partials.drawer')
    </div>

    <!-- Toast Notification Element -->
    <div class="toast-msg" id="toastMsg" role="alert" aria-live="polite"></div>

    <script src="{{ asset('js/drawer.js') }}"></script>
    <script>
        const toastEl = document.getElementById('toastMsg');
        let toastTimeout;

        // Toggle Expand/Collapse Rincian Kartu
        function toggleCardDetail(cardKey) {
            const detailEl = document.getElementById(`detail-${cardKey}`);
            const btnEl = document.getElementById(`btn-toggle-${cardKey}`);
            if (!detailEl || !btnEl) return;

            const isHidden = detailEl.style.display === 'none';
            if (isHidden) {
                detailEl.style.display = 'block';
                btnEl.querySelector('.toggle-icon').innerHTML = '&#9650;';
                btnEl.querySelector('.toggle-text').textContent = 'Sembunyikan Rincian';
            } else {
                detailEl.style.display = 'none';
                btnEl.querySelector('.toggle-icon').innerHTML = '&#9660;';
                btnEl.querySelector('.toggle-text').textContent = 'Lihat Rincian Lengkap';
            }
        }

        // Filter Tabs
        const filterChips = document.querySelectorAll('.filter-chip');
        const cards = document.querySelectorAll('.revisi-card');

        filterChips.forEach(chip => {
            chip.addEventListener('click', () => {
                filterChips.forEach(c => c.classList.remove('is-active'));
                chip.classList.add('is-active');

                const filter = chip.getAttribute('data-filter');
                cards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (filter === 'all' || cardCat === filter || (filter === 'store_manager' && cardCat === 'sm')) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Tandai sudah ditindaklanjuti
        function handleManualResolve(nama, cardId) {
            showToast(`Laporan ${nama} berhasil ditandai telah ditindaklanjuti manual.`);
            const cardEl = document.getElementById(cardId);
            if (cardEl) {
                cardEl.style.opacity = '0.5';
                cardEl.style.filter = 'grayscale(0.4)';
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
