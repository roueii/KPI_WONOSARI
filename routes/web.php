<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FrontlinerController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\SalesMarketingController;
use App\Http\Controllers\StoreManagerController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| URL utama tiap halaman + nama route-nya. URL lama/alternatif ada di
| bagian "Alias" paling bawah dan cukup diarahkan (redirect) ke URL utama.
*/

Route::view('/', 'landingpage')->name('home');

// Autentikasi
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::match(['get', 'post'], '/logout', 'logout')->name('logout');
});

/**
 * Daftarkan langkah-langkah form isi capaian sebuah role.
 * $steps: [slug-url => [nama route, method tampil, method simpan]]
 */
$registerSteps = function (string $prefix, string $name, array $steps): void {
    foreach ($steps as $slug => [$routeName, $show, $save]) {
        Route::get("{$prefix}/isi-capaian/{$slug}", $show)->name("{$name}.{$routeName}");
        Route::post("{$prefix}/isi-capaian/{$slug}", $save)->name("{$name}.{$routeName}.post");
    }
    Route::post("{$prefix}/isi-capaian/draft", 'simpanDraft')->name("{$name}.draft.post");
};

/** Daftarkan halaman riwayat, detail riwayat, dan profil sebuah role. */
$registerCommon = function (string $prefix, string $name): void {
    Route::get("{$prefix}/riwayat", 'riwayatCapaian')->name("{$name}.riwayat");
    Route::get("{$prefix}/riwayat/detail", 'detailRiwayat')->name("{$name}.riwayat.detail");
    Route::get("{$prefix}/riwayat/{id}", 'detailRiwayat')->whereNumber('id');
    Route::get("{$prefix}/profil", 'profil')->name("{$name}.profile");
};

// =========================================================================
// ADMIN
// =========================================================================
Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/tinjau-revisi', 'revisi')->name('revisi');
    Route::get('/kelola-kpi', 'kelolaKpi')->name('kpi');
    Route::get('/approve-laporan', 'approveLaporan')->name('approve');
    Route::get('/profil', 'profile')->name('profile');

    Route::get('/kelola-akun', 'kelolaAkun')->name('accounts');
    Route::post('/kelola-akun', 'simpanAkun')->name('accounts.store');
    Route::post('/kelola-akun/{id}', 'ubahAkun')->whereNumber('id')->name('accounts.update');
    Route::post('/kelola-akun/{id}/status', 'ubahStatusAkun')->whereNumber('id')->name('accounts.status');
});

// =========================================================================
// STORE MANAGER
// =========================================================================
Route::controller(StoreManagerController::class)->group(function () use ($registerSteps, $registerCommon) {
    Route::get('/store-manager', 'dashboard')->name('storemanager.dashboard');

    $registerSteps('/store-manager', 'storemanager', [
        'penjualan' => ['penjualan', 'isiPenjualan', 'simpanPenjualan'],
        'laba-persediaan' => ['laba_persediaan', 'isiLabaPersediaan', 'simpanLabaPersediaan'],
        'pelayanan' => ['pelayanan', 'isiPelayanan', 'simpanPelayanan'],
        'operasional-sdm' => ['operasional_sdm', 'isiOperasionalSdm', 'simpanOperasionalSdm'],
        'promosi-event' => ['promosi_event', 'isiPromosiEvent', 'simpanPromosiEvent'],
    ]);

    Route::get('/store-manager/training', 'training')->name('storemanager.training');
    Route::post('/store-manager/training', 'simpanTraining')->name('storemanager.training.post');

    Route::get('/store-manager/approval', 'approvalTim')->name('storemanager.approval');
    Route::post('/store-manager/approval/setujui-semua', 'approveAllCapaian')->name('storemanager.approval.approve_all');
    Route::post('/store-manager/approval/{id}/setujui', 'approveCapaian')->name('storemanager.approval.approve');
    Route::post('/store-manager/approval/{id}/tolak', 'rejectCapaian')->name('storemanager.approval.reject');

    $registerCommon('/store-manager', 'storemanager');
});

// =========================================================================
// FRONTLINER (URL /karyawan)
// =========================================================================
Route::controller(FrontlinerController::class)->group(function () use ($registerSteps, $registerCommon) {
    Route::get('/karyawan', 'dashboard')->name('staff.dashboard');
    Route::get('/frontliner', 'dashboard')->name('frontliner.dashboard');

    $registerSteps('/karyawan', 'frontliner', [
        'penjualan' => ['penjualan', 'isiPenjualan', 'simpanPenjualan'],
        'pelayanan' => ['pelayanan', 'isiPelayanan', 'simpanPelayanan'],
        'product-knowledge' => ['knowledge', 'isiProductKnowledge', 'simpanProductKnowledge'],
        'akurasi-kasir' => ['kasir', 'isiAkurasiKasir', 'simpanAkurasiKasir'],
        'display-kebersihan' => ['display', 'isiDisplayKebersihan', 'simpanDisplayKebersihan'],
        'kepatuhan-sop' => ['kepatuhan', 'isiKepatuhanSop', 'simpanKepatuhanSop'],
    ]);

    $registerCommon('/karyawan', 'frontliner');
});

// =========================================================================
// DRIVER
// =========================================================================
Route::controller(DriverController::class)->group(function () use ($registerSteps, $registerCommon) {
    Route::get('/driver', 'dashboard')->name('driver.dashboard');

    $registerSteps('/driver', 'driver', [
        'pengiriman' => ['pengiriman', 'isiPengiriman', 'simpanPengiriman'],
        'administrasi' => ['administrasi', 'isiAdministrasi', 'simpanAdministrasi'],
        'kendaraan' => ['kendaraan', 'isiKendaraan', 'simpanKendaraan'],
        'pelayanan' => ['pelayanan', 'isiPelayanan', 'simpanPelayanan'],
    ]);

    $registerCommon('/driver', 'driver');
});

// =========================================================================
// PRODUKSI
// =========================================================================
Route::controller(ProduksiController::class)->group(function () use ($registerSteps, $registerCommon) {
    Route::get('/produksi', 'dashboard')->name('produksi.dashboard');

    $registerSteps('/produksi', 'produksi', [
        'hasil-produksi' => ['hasil_produksi', 'isiHasilProduksi', 'simpanHasilProduksi'],
        'waktu-alat' => ['waktu_alat', 'isiWaktuAlat', 'simpanWaktuAlat'],
        'kehadiran-disiplin' => ['kehadiran_disiplin', 'isiKehadiranDisiplin', 'simpanKehadiranDisiplin'],
        'kepatuhan-sop' => ['kepatuhan_sop', 'isiKepatuhanSop', 'simpanKepatuhanSop'],
        'kebersihan-area' => ['kebersihan_area', 'isiKebersihanArea', 'simpanKebersihanArea'],
    ]);

    $registerCommon('/produksi', 'produksi');
});

// =========================================================================
// SALES & MARKETING DAN SUPERVISOR
// Memakai ChecklistRoleController + view bersama "checklist.*".
// Slug langkah diambil dari roleConfig(), mis. /sales-marketing/isi-capaian/penjualan-customer
// =========================================================================
foreach ([
    ['sales-marketing', 'sales', SalesMarketingController::class],
    ['supervisor', 'supervisor', SupervisorController::class],
] as [$prefix, $name, $controller]) {
    Route::prefix($prefix)->name("{$name}.")->controller($controller)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/isi-capaian/{step}', 'step')->name('step');
        Route::post('/isi-capaian/{step}', 'saveStep')->name('step.post');
        Route::post('/draft', 'draft')->name('draft.post');
        Route::get('/riwayat', 'riwayat')->name('riwayat');
        Route::get('/riwayat/{id}', 'detailRiwayat')->whereNumber('id')->name('riwayat.detail');
        Route::get('/profil', 'profil')->name('profile');
    });
}

// =========================================================================
// ALIAS: URL lama / alternatif -> URL utama
// =========================================================================
$aliases = [
    // Admin
    '/profil' => '/admin/profil',
    '/admin/profile' => '/admin/profil',
    '/admin/revisi' => '/admin/tinjau-revisi',
    '/admin/accounts' => '/admin/kelola-akun',
    '/admin/akun' => '/admin/kelola-akun',
    '/admin/kpi' => '/admin/kelola-kpi',
    '/admin/approve' => '/admin/approve-laporan',
    '/admin/approval' => '/admin/approve-laporan',

    // Store Manager
    '/storemanager' => '/store-manager',
    '/store-manager/tim' => '/store-manager?tab=tim',
    '/store-manager/approval-tim' => '/store-manager/approval',
    '/store-manager/profile' => '/store-manager/profil',
    '/storemanager/profil' => '/store-manager/profil',
    '/storemanager/profile' => '/store-manager/profil',
    '/storemanager/riwayat' => '/store-manager/riwayat',
    '/storemanager/riwayat/detail' => '/store-manager/riwayat/detail',
    '/storemanager/riwayat/{id}' => '/store-manager/riwayat/{id}',

    // Frontliner
    '/frontliner/riwayat' => '/karyawan/riwayat',
    '/staff/riwayat' => '/karyawan/riwayat',
    '/frontliner/riwayat/detail' => '/karyawan/riwayat/detail',
    '/staff/riwayat/detail' => '/karyawan/riwayat/detail',
    '/frontliner/riwayat/{id}' => '/karyawan/riwayat/{id}',
    '/karyawan/profile' => '/karyawan/profil',
    '/frontliner/profil' => '/karyawan/profil',
    '/frontliner/profile' => '/karyawan/profil',
    '/staff/profil' => '/karyawan/profil',

    // Driver & Produksi (juga dapat diakses lewat /karyawan/driver/... dan /karyawan/produksi/...)
    '/karyawan-driver' => '/driver',
    '/driver/profile' => '/driver/profil',
    '/karyawan-produksi' => '/produksi',
    '/produksi/profile' => '/produksi/profil',

    // Sales & Supervisor
    '/sales' => '/sales-marketing',
    '/marketing' => '/sales-marketing',
    '/spv' => '/supervisor',
];

// /karyawan/driver/* -> /driver/*  dan  /karyawan/produksi/* -> /produksi/*
foreach (['driver', 'produksi'] as $role) {
    foreach (['', '/riwayat', '/riwayat/detail', '/riwayat/{id}', '/profil', '/profile'] as $path) {
        $aliases["/karyawan/{$role}{$path}"] = "/{$role}" . ($path === '/profile' ? '/profil' : $path);
    }
}

// Alias langkah form tanpa "/isi-capaian", mis. /driver/pengiriman -> /driver/isi-capaian/pengiriman
// Format: [prefix alias, prefix tujuan, [slug alias => slug tujuan]]
$frontlinerSteps = [
    'penjualan' => 'penjualan', 'pelayanan' => 'pelayanan', 'product-knowledge' => 'product-knowledge',
    'akurasi-kasir' => 'akurasi-kasir', 'display-kebersihan' => 'display-kebersihan', 'kepatuhan-sop' => 'kepatuhan-sop',
];
$driverSteps = array_combine($s = ['pengiriman', 'administrasi', 'kendaraan', 'pelayanan'], $s);
$produksiSteps = array_combine($s = ['hasil-produksi', 'waktu-alat', 'kehadiran-disiplin', 'kepatuhan-sop', 'kebersihan-area'], $s);

$stepAliases = [
    ['/store-manager', '/store-manager', array_combine($s = ['penjualan', 'laba-persediaan', 'pelayanan', 'operasional-sdm', 'promosi-event'], $s)],
    ['/karyawan', '/karyawan', $frontlinerSteps + ['kasir' => 'akurasi-kasir', 'kepatuhan' => 'kepatuhan-sop']],
    ['/karyawan/isi-capaian', '/karyawan', ['knowledge' => 'product-knowledge', 'kasir' => 'akurasi-kasir', 'display' => 'display-kebersihan', 'kepatuhan' => 'kepatuhan-sop']],
    ['/frontliner', '/karyawan', $frontlinerSteps + ['knowledge' => 'product-knowledge']],
    ['/frontliner/isi-capaian', '/karyawan', $frontlinerSteps],
    ['/driver', '/driver', $driverSteps],
    ['/karyawan/driver', '/driver', $driverSteps],
    ['/produksi', '/produksi', $produksiSteps],
    ['/karyawan/produksi', '/produksi', $produksiSteps],
];

foreach ($stepAliases as [$from, $to, $slugs]) {
    foreach ($slugs as $alias => $slug) {
        $aliases["{$from}/{$alias}"] = "{$to}/isi-capaian/{$slug}";
    }
}

foreach ($aliases as $from => $to) {
    Route::redirect($from, $to);
}
