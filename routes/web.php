<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontlinerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\StoreManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing Page
Route::get('/', function () {
    return view('landingpage');
})->name('home');

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman sesuai Akun / Role
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/tinjau-revisi', [AdminController::class, 'revisi'])->name('admin.revisi');
Route::get('/admin/revisi', [AdminController::class, 'revisi']); // Alias
Route::get('/admin/kelola-akun', [AdminController::class, 'kelolaAkun'])->name('admin.accounts');
Route::get('/admin/accounts', [AdminController::class, 'kelolaAkun']); // Alias
Route::get('/admin/akun', [AdminController::class, 'kelolaAkun']); // Alias
Route::get('/admin/kelola-kpi', [AdminController::class, 'kelolaKpi'])->name('admin.kpi');
Route::get('/admin/kpi', [AdminController::class, 'kelolaKpi']); // Alias
Route::get('/admin/approve-laporan', [AdminController::class, 'approveLaporan'])->name('admin.approve');
Route::get('/admin/approve', [AdminController::class, 'approveLaporan']); // Alias
Route::get('/admin/approval', [AdminController::class, 'approveLaporan']); // Alias
Route::get('/admin/profil', [AdminController::class, 'profile'])->name('admin.profile');
Route::get('/admin/profile', [AdminController::class, 'profile']); // Alias
Route::get('/profil', [AdminController::class, 'profile']); // Alias rute profil

// =========================================================================
// RUTE KHUSUS STORE MANAGER (SESUAI DOKUMENTASI FIGMA STORE MANAGER)
// =========================================================================

// 1. Dashboard Store Manager (Tab KPI Saya & Tab KPI Tim)
Route::get('/store-manager', [StoreManagerController::class, 'dashboard'])->name('storemanager.dashboard');
Route::get('/storemanager', [StoreManagerController::class, 'dashboard']); // Alias
Route::get('/store-manager/tim', function () {
    return redirect()->route('storemanager.dashboard', ['tab' => 'tim']);
})->name('storemanager.tim');

// 2. Multi-step Pengisian Capaian Store Manager (5 Langkah)
// Langkah 1: Penjualan
Route::get('/store-manager/isi-capaian/penjualan', [StoreManagerController::class, 'isiPenjualan'])->name('storemanager.penjualan');
Route::get('/store-manager/penjualan', [StoreManagerController::class, 'isiPenjualan']); // Alias
Route::post('/store-manager/isi-capaian/penjualan', [StoreManagerController::class, 'simpanPenjualan'])->name('storemanager.penjualan.post');

// Langkah 2: Laba & Persediaan
Route::get('/store-manager/isi-capaian/laba-persediaan', [StoreManagerController::class, 'isiLabaPersediaan'])->name('storemanager.laba_persediaan');
Route::get('/store-manager/laba-persediaan', [StoreManagerController::class, 'isiLabaPersediaan']); // Alias
Route::post('/store-manager/isi-capaian/laba-persediaan', [StoreManagerController::class, 'simpanLabaPersediaan'])->name('storemanager.laba_persediaan.post');

// Langkah 3: Pelayanan
Route::get('/store-manager/isi-capaian/pelayanan', [StoreManagerController::class, 'isiPelayanan'])->name('storemanager.pelayanan');
Route::get('/store-manager/pelayanan', [StoreManagerController::class, 'isiPelayanan']); // Alias
Route::post('/store-manager/isi-capaian/pelayanan', [StoreManagerController::class, 'simpanPelayanan'])->name('storemanager.pelayanan.post');

// Langkah 4: Operasional & SDM
Route::get('/store-manager/isi-capaian/operasional-sdm', [StoreManagerController::class, 'isiOperasionalSdm'])->name('storemanager.operasional_sdm');
Route::get('/store-manager/operasional-sdm', [StoreManagerController::class, 'isiOperasionalSdm']); // Alias
Route::post('/store-manager/isi-capaian/operasional-sdm', [StoreManagerController::class, 'simpanOperasionalSdm'])->name('storemanager.operasional_sdm.post');

// Langkah 5: Promosi & Event
Route::get('/store-manager/isi-capaian/promosi-event', [StoreManagerController::class, 'isiPromosiEvent'])->name('storemanager.promosi_event');
Route::get('/store-manager/promosi-event', [StoreManagerController::class, 'isiPromosiEvent']); // Alias
Route::post('/store-manager/isi-capaian/promosi-event', [StoreManagerController::class, 'simpanPromosiEvent'])->name('storemanager.promosi_event.post');

// Simpan Draf
Route::post('/store-manager/isi-capaian/draft', [StoreManagerController::class, 'simpanDraft'])->name('storemanager.draft.post');

// 3. Approval Tim
Route::get('/store-manager/approval', [StoreManagerController::class, 'approvalTim'])->name('storemanager.approval');
Route::get('/store-manager/approval-tim', [StoreManagerController::class, 'approvalTim']); // Alias
Route::post('/store-manager/approval/{id}/setujui', [StoreManagerController::class, 'approveCapaian'])->name('storemanager.approval.approve');
Route::post('/store-manager/approval/{id}/tolak', [StoreManagerController::class, 'rejectCapaian'])->name('storemanager.approval.reject');
Route::post('/store-manager/approval/setujui-semua', [StoreManagerController::class, 'approveAllCapaian'])->name('storemanager.approval.approve_all');

// 4. Riwayat Capaian Store Manager
Route::get('/store-manager/riwayat', [StoreManagerController::class, 'riwayatCapaian'])->name('storemanager.riwayat');
Route::get('/storemanager/riwayat', [StoreManagerController::class, 'riwayatCapaian']); // Alias

// 5. Detail Riwayat Capaian Store Manager (Disetujui & Perlu Revisi)
Route::get('/store-manager/riwayat/detail', [StoreManagerController::class, 'detailRiwayat'])->name('storemanager.riwayat.detail');
Route::get('/store-manager/riwayat/{id}', [StoreManagerController::class, 'detailRiwayat'])->where('id', '[0-9]+');
Route::get('/storemanager/riwayat/detail', [StoreManagerController::class, 'detailRiwayat']); // Alias
Route::get('/storemanager/riwayat/{id}', [StoreManagerController::class, 'detailRiwayat'])->where('id', '[0-9]+'); // Alias

// 6. Profil Store Manager
Route::get('/store-manager/profil', [StoreManagerController::class, 'profil'])->name('storemanager.profile');
Route::get('/store-manager/profile', [StoreManagerController::class, 'profil']); // Alias
Route::get('/storemanager/profil', [StoreManagerController::class, 'profil']); // Alias
Route::get('/storemanager/profile', [StoreManagerController::class, 'profil']); // Alias

// Halaman Karyawan (Frontliner)
Route::get('/karyawan', [FrontlinerController::class, 'dashboard'])->name('staff.dashboard');
Route::get('/frontliner', [FrontlinerController::class, 'dashboard'])->name('frontliner.dashboard');
Route::post('/frontliner/simpan-tugas', [FrontlinerController::class, 'saveDailyTask'])->name('frontliner.save_task');

// Pengisian Capaian Frontliner (Multi-Step Form - 6 Langkah Sesuai Figma Revisi)
// Langkah 1: Penjualan
Route::get('/karyawan/isi-capaian/penjualan', [FrontlinerController::class, 'isiPenjualan'])->name('frontliner.penjualan');
Route::get('/frontliner/isi-capaian/penjualan', [FrontlinerController::class, 'isiPenjualan']); // Alias
Route::get('/frontliner/penjualan', [FrontlinerController::class, 'isiPenjualan']); // Alias
Route::get('/karyawan/penjualan', [FrontlinerController::class, 'isiPenjualan']); // Alias
Route::post('/karyawan/isi-capaian/penjualan', [FrontlinerController::class, 'simpanPenjualan'])->name('frontliner.penjualan.post');
Route::post('/frontliner/isi-capaian/penjualan', [FrontlinerController::class, 'simpanPenjualan']); // Alias

// Langkah 2: Pelayanan
Route::get('/karyawan/isi-capaian/pelayanan', [FrontlinerController::class, 'isiPelayanan'])->name('frontliner.pelayanan');
Route::get('/frontliner/isi-capaian/pelayanan', [FrontlinerController::class, 'isiPelayanan']); // Alias
Route::get('/frontliner/pelayanan', [FrontlinerController::class, 'isiPelayanan']); // Alias
Route::get('/karyawan/pelayanan', [FrontlinerController::class, 'isiPelayanan']); // Alias
Route::post('/karyawan/isi-capaian/pelayanan', [FrontlinerController::class, 'simpanPelayanan'])->name('frontliner.pelayanan.post');
Route::post('/frontliner/isi-capaian/pelayanan', [FrontlinerController::class, 'simpanPelayanan']); // Alias

// Langkah 3: Product Knowledge
Route::get('/karyawan/isi-capaian/product-knowledge', [FrontlinerController::class, 'isiProductKnowledge'])->name('frontliner.knowledge');
Route::get('/frontliner/isi-capaian/product-knowledge', [FrontlinerController::class, 'isiProductKnowledge']); // Alias
Route::get('/karyawan/isi-capaian/knowledge', [FrontlinerController::class, 'isiProductKnowledge']); // Alias
Route::get('/frontliner/product-knowledge', [FrontlinerController::class, 'isiProductKnowledge']); // Alias
Route::get('/frontliner/knowledge', [FrontlinerController::class, 'isiProductKnowledge']); // Alias
Route::get('/karyawan/product-knowledge', [FrontlinerController::class, 'isiProductKnowledge']); // Alias
Route::post('/karyawan/isi-capaian/product-knowledge', [FrontlinerController::class, 'simpanProductKnowledge'])->name('frontliner.knowledge.post');
Route::post('/frontliner/isi-capaian/product-knowledge', [FrontlinerController::class, 'simpanProductKnowledge']); // Alias

// Langkah 4: Akurasi Kasir
Route::get('/karyawan/isi-capaian/akurasi-kasir', [FrontlinerController::class, 'isiAkurasiKasir'])->name('frontliner.kasir');
Route::get('/frontliner/isi-capaian/akurasi-kasir', [FrontlinerController::class, 'isiAkurasiKasir']); // Alias
Route::get('/karyawan/isi-capaian/kasir', [FrontlinerController::class, 'isiAkurasiKasir']); // Alias
Route::get('/frontliner/akurasi-kasir', [FrontlinerController::class, 'isiAkurasiKasir']); // Alias
Route::get('/karyawan/akurasi-kasir', [FrontlinerController::class, 'isiAkurasiKasir']); // Alias
Route::get('/karyawan/kasir', [FrontlinerController::class, 'isiAkurasiKasir']); // Alias
Route::post('/karyawan/isi-capaian/akurasi-kasir', [FrontlinerController::class, 'simpanAkurasiKasir'])->name('frontliner.kasir.post');
Route::post('/frontliner/isi-capaian/akurasi-kasir', [FrontlinerController::class, 'simpanAkurasiKasir']); // Alias

// Langkah 5: Display & Kebersihan
Route::get('/karyawan/isi-capaian/display-kebersihan', [FrontlinerController::class, 'isiDisplayKebersihan'])->name('frontliner.display');
Route::get('/frontliner/isi-capaian/display-kebersihan', [FrontlinerController::class, 'isiDisplayKebersihan']); // Alias
Route::get('/karyawan/isi-capaian/display', [FrontlinerController::class, 'isiDisplayKebersihan']); // Alias
Route::get('/frontliner/display-kebersihan', [FrontlinerController::class, 'isiDisplayKebersihan']); // Alias
Route::get('/karyawan/display-kebersihan', [FrontlinerController::class, 'isiDisplayKebersihan']); // Alias
Route::post('/karyawan/isi-capaian/display-kebersihan', [FrontlinerController::class, 'simpanDisplayKebersihan'])->name('frontliner.display.post');
Route::post('/frontliner/isi-capaian/display-kebersihan', [FrontlinerController::class, 'simpanDisplayKebersihan']); // Alias

// Langkah 6: Kepatuhan SOP & Disiplin
Route::get('/karyawan/isi-capaian/kepatuhan-sop', [FrontlinerController::class, 'isiKepatuhanSop'])->name('frontliner.kepatuhan');
Route::get('/frontliner/isi-capaian/kepatuhan-sop', [FrontlinerController::class, 'isiKepatuhanSop']); // Alias
Route::get('/karyawan/isi-capaian/kepatuhan', [FrontlinerController::class, 'isiKepatuhanSop']); // Alias
Route::get('/frontliner/kepatuhan-sop', [FrontlinerController::class, 'isiKepatuhanSop']); // Alias
Route::get('/karyawan/kepatuhan-sop', [FrontlinerController::class, 'isiKepatuhanSop']); // Alias
Route::get('/karyawan/kepatuhan', [FrontlinerController::class, 'isiKepatuhanSop']); // Alias
Route::post('/karyawan/isi-capaian/kepatuhan-sop', [FrontlinerController::class, 'simpanKepatuhanSop'])->name('frontliner.kepatuhan.post');
Route::post('/frontliner/isi-capaian/kepatuhan-sop', [FrontlinerController::class, 'simpanKepatuhanSop']); // Alias

// Simpan Draf Sementara
Route::post('/karyawan/isi-capaian/draft', [FrontlinerController::class, 'simpanDraft'])->name('frontliner.draft.post');
Route::post('/frontliner/isi-capaian/draft', [FrontlinerController::class, 'simpanDraft']); // Alias

// Rapor & Detail Lama (Tetap didukung untuk kompatibilitas)
Route::get('/karyawan/rapor/penjualan', [FrontlinerController::class, 'detailPenjualan'])->name('frontliner.rapor.penjualan');
Route::get('/karyawan/rapor/akurasi-kasir', [FrontlinerController::class, 'detailAkurasiKasir'])->name('frontliner.rapor.kasir');
Route::get('/karyawan/rapor/product-knowledge', [FrontlinerController::class, 'detailProductKnowledge'])->name('frontliner.rapor.knowledge');

// Halaman Riwayat Capaian Frontliner Sesuai Figma
Route::get('/karyawan/riwayat', [FrontlinerController::class, 'riwayatCapaian'])->name('frontliner.riwayat');
Route::get('/frontliner/riwayat', [FrontlinerController::class, 'riwayatCapaian']); // Alias
Route::get('/staff/riwayat', [FrontlinerController::class, 'riwayatCapaian']); // Alias

// Halaman Detail Riwayat Capaian Frontliner Sesuai Figma (Disetujui & Perlu Revisi)
Route::get('/karyawan/riwayat/detail', [FrontlinerController::class, 'detailRiwayat'])->name('frontliner.riwayat.detail');
Route::get('/karyawan/riwayat/{id}', [FrontlinerController::class, 'detailRiwayat'])->where('id', '[0-9]+');
Route::get('/frontliner/riwayat/detail', [FrontlinerController::class, 'detailRiwayat']); // Alias
Route::get('/frontliner/riwayat/{id}', [FrontlinerController::class, 'detailRiwayat'])->where('id', '[0-9]+'); // Alias
Route::get('/staff/riwayat/detail', [FrontlinerController::class, 'detailRiwayat']); // Alias

// Halaman Profil Frontliner Sesuai Figma
Route::get('/karyawan/profil', [FrontlinerController::class, 'profil'])->name('frontliner.profile');
Route::get('/frontliner/profil', [FrontlinerController::class, 'profil']); // Alias
Route::get('/karyawan/profile', [FrontlinerController::class, 'profil']); // Alias
Route::get('/frontliner/profile', [FrontlinerController::class, 'profil']); // Alias
Route::get('/staff/profil', [FrontlinerController::class, 'profil']); // Alias

// =========================================================================
// RUTE KHUSUS KARYAWAN DRIVER (SESUAI DOKUMENTASI FIGMA DRIVER)
// =========================================================================

// 1. Dashboard Driver
Route::get('/driver', [DriverController::class, 'dashboard'])->name('driver.dashboard');
Route::get('/karyawan/driver', [DriverController::class, 'dashboard']); // Alias
Route::get('/karyawan-driver', [DriverController::class, 'dashboard']); // Alias

// 2. Multi-step Pengisian Capaian Harian Driver
// Langkah 1: Ketepatan & Pengiriman
Route::get('/driver/isi-capaian/pengiriman', [DriverController::class, 'isiPengiriman'])->name('driver.pengiriman');
Route::get('/driver/pengiriman', [DriverController::class, 'isiPengiriman']); // Alias
Route::get('/karyawan/driver/pengiriman', [DriverController::class, 'isiPengiriman']); // Alias
Route::post('/driver/isi-capaian/pengiriman', [DriverController::class, 'simpanPengiriman'])->name('driver.pengiriman.post');

// Langkah 2: SOP Administrasi
Route::get('/driver/isi-capaian/administrasi', [DriverController::class, 'isiAdministrasi'])->name('driver.administrasi');
Route::get('/driver/administrasi', [DriverController::class, 'isiAdministrasi']); // Alias
Route::get('/karyawan/driver/administrasi', [DriverController::class, 'isiAdministrasi']); // Alias
Route::post('/driver/isi-capaian/administrasi', [DriverController::class, 'simpanAdministrasi'])->name('driver.administrasi.post');

// Langkah 3: Kendaraan & BBM
Route::get('/driver/isi-capaian/kendaraan', [DriverController::class, 'isiKendaraan'])->name('driver.kendaraan');
Route::get('/driver/kendaraan', [DriverController::class, 'isiKendaraan']); // Alias
Route::get('/karyawan/driver/kendaraan', [DriverController::class, 'isiKendaraan']); // Alias
Route::post('/driver/isi-capaian/kendaraan', [DriverController::class, 'simpanKendaraan'])->name('driver.kendaraan.post');

// Langkah 4: Disiplin & Pelayanan
Route::get('/driver/isi-capaian/pelayanan', [DriverController::class, 'isiPelayanan'])->name('driver.pelayanan');
Route::get('/driver/pelayanan', [DriverController::class, 'isiPelayanan']); // Alias
Route::get('/karyawan/driver/pelayanan', [DriverController::class, 'isiPelayanan']); // Alias
Route::post('/driver/isi-capaian/pelayanan', [DriverController::class, 'simpanPelayanan'])->name('driver.pelayanan.post');
Route::post('/driver/isi-capaian/draft', [DriverController::class, 'simpanDraft'])->name('driver.draft.post');

// 3. Riwayat Capaian Driver
Route::get('/driver/riwayat', [DriverController::class, 'riwayatCapaian'])->name('driver.riwayat');
Route::get('/karyawan/driver/riwayat', [DriverController::class, 'riwayatCapaian']); // Alias

// 4. Detail Riwayat Capaian Driver (Mendukung Tampilan Disetujui & Perlu Revisi)
Route::get('/driver/riwayat/detail', [DriverController::class, 'detailRiwayat'])->name('driver.riwayat.detail');
Route::get('/driver/riwayat/{id}', [DriverController::class, 'detailRiwayat'])->where('id', '[0-9]+');
Route::get('/karyawan/driver/riwayat/detail', [DriverController::class, 'detailRiwayat']); // Alias
Route::get('/karyawan/driver/riwayat/{id}', [DriverController::class, 'detailRiwayat'])->where('id', '[0-9]+'); // Alias

// 5. Profil Driver
Route::get('/driver/profil', [DriverController::class, 'profil'])->name('driver.profile');
Route::get('/driver/profile', [DriverController::class, 'profil']); // Alias
Route::get('/karyawan/driver/profil', [DriverController::class, 'profil']); // Alias
Route::get('/karyawan/driver/profile', [DriverController::class, 'profil']); // Alias

// =========================================================================
// RUTE KHUSUS KARYAWAN PRODUKSI (SESUAI DOKUMENTASI FIGMA PRODUKSI)
// =========================================================================

// 1. Dashboard Produksi
Route::get('/produksi', [ProduksiController::class, 'dashboard'])->name('produksi.dashboard');
Route::get('/karyawan/produksi', [ProduksiController::class, 'dashboard']); // Alias
Route::get('/karyawan-produksi', [ProduksiController::class, 'dashboard']); // Alias

// 2. Multi-step Pengisian Capaian Harian Produksi (5 Langkah)
// Langkah 1: Hasil Produksi
Route::get('/produksi/isi-capaian/hasil-produksi', [ProduksiController::class, 'isiHasilProduksi'])->name('produksi.hasil_produksi');
Route::get('/produksi/hasil-produksi', [ProduksiController::class, 'isiHasilProduksi']); // Alias
Route::get('/karyawan/produksi/hasil-produksi', [ProduksiController::class, 'isiHasilProduksi']); // Alias
Route::post('/produksi/isi-capaian/hasil-produksi', [ProduksiController::class, 'simpanHasilProduksi'])->name('produksi.hasil_produksi.post');

// Langkah 2: Waktu & Alat
Route::get('/produksi/isi-capaian/waktu-alat', [ProduksiController::class, 'isiWaktuAlat'])->name('produksi.waktu_alat');
Route::get('/produksi/waktu-alat', [ProduksiController::class, 'isiWaktuAlat']); // Alias
Route::get('/karyawan/produksi/waktu-alat', [ProduksiController::class, 'isiWaktuAlat']); // Alias
Route::post('/produksi/isi-capaian/waktu-alat', [ProduksiController::class, 'simpanWaktuAlat'])->name('produksi.waktu_alat.post');

// Langkah 3: Kehadiran & Disiplin
Route::get('/produksi/isi-capaian/kehadiran-disiplin', [ProduksiController::class, 'isiKehadiranDisiplin'])->name('produksi.kehadiran_disiplin');
Route::get('/produksi/kehadiran-disiplin', [ProduksiController::class, 'isiKehadiranDisiplin']); // Alias
Route::get('/karyawan/produksi/kehadiran-disiplin', [ProduksiController::class, 'isiKehadiranDisiplin']); // Alias
Route::post('/produksi/isi-capaian/kehadiran-disiplin', [ProduksiController::class, 'simpanKehadiranDisiplin'])->name('produksi.kehadiran_disiplin.post');

// Langkah 4: Kepatuhan SOP
Route::get('/produksi/isi-capaian/kepatuhan-sop', [ProduksiController::class, 'isiKepatuhanSop'])->name('produksi.kepatuhan_sop');
Route::get('/produksi/kepatuhan-sop', [ProduksiController::class, 'isiKepatuhanSop']); // Alias
Route::get('/karyawan/produksi/kepatuhan-sop', [ProduksiController::class, 'isiKepatuhanSop']); // Alias
Route::post('/produksi/isi-capaian/kepatuhan-sop', [ProduksiController::class, 'simpanKepatuhanSop'])->name('produksi.kepatuhan_sop.post');

// Langkah 5: Kebersihan Area Kerja
Route::get('/produksi/isi-capaian/kebersihan-area', [ProduksiController::class, 'isiKebersihanArea'])->name('produksi.kebersihan_area');
Route::get('/produksi/kebersihan-area', [ProduksiController::class, 'isiKebersihanArea']); // Alias
Route::get('/karyawan/produksi/kebersihan-area', [ProduksiController::class, 'isiKebersihanArea']); // Alias
Route::post('/produksi/isi-capaian/kebersihan-area', [ProduksiController::class, 'simpanKebersihanArea'])->name('produksi.kebersihan_area.post');
Route::post('/produksi/isi-capaian/draft', [ProduksiController::class, 'simpanDraft'])->name('produksi.draft.post');

// 3. Riwayat Capaian Produksi
Route::get('/produksi/riwayat', [ProduksiController::class, 'riwayatCapaian'])->name('produksi.riwayat');
Route::get('/karyawan/produksi/riwayat', [ProduksiController::class, 'riwayatCapaian']); // Alias

// 4. Detail Riwayat Capaian Produksi (Mendukung Tampilan Disetujui & Perlu Revisi)
Route::get('/produksi/riwayat/detail', [ProduksiController::class, 'detailRiwayat'])->name('produksi.riwayat.detail');
Route::get('/produksi/riwayat/{id}', [ProduksiController::class, 'detailRiwayat'])->where('id', '[0-9]+');
Route::get('/karyawan/produksi/riwayat/detail', [ProduksiController::class, 'detailRiwayat']); // Alias
Route::get('/karyawan/produksi/riwayat/{id}', [ProduksiController::class, 'detailRiwayat'])->where('id', '[0-9]+'); // Alias

// 5. Profil Produksi
Route::get('/produksi/profil', [ProduksiController::class, 'profil'])->name('produksi.profile');
Route::get('/produksi/profile', [ProduksiController::class, 'profil']); // Alias
Route::get('/karyawan/produksi/profil', [ProduksiController::class, 'profil']); // Alias
Route::get('/karyawan/produksi/profile', [ProduksiController::class, 'profil']); // Alias
