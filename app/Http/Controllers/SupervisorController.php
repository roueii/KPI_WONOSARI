<?php

namespace App\Http\Controllers;

/**
 * KPI Karyawan Supervisor (Figma: section "KARYAWAN SUPERVISOR").
 * 6 langkah pengisian kunjungan toko.
 */
class SupervisorController extends ChecklistRoleController
{
    protected function roleConfig(): array
    {
        $visit = 'Input Harian Kunjungan Toko oleh Supervisor';
        $visitSub = 'Centang indikator yang dipenuhi hari ini saat kunjungan toko:';
        $verifyNotice = 'Pastikan semua data input harian telah sesuai sebelum mengirim capaian. Laporan yang sudah dikirim akan langsung diverifikasi oleh <strong>Store Manager</strong>';

        return [
            'key' => 'supervisor',
            'route' => 'supervisor',
            'label' => 'Supervisor',
            'badge' => 'SUPERVISOR',
            'page_title' => 'Supervisor',
            'help_text' => 'Pusat Bantuan Supervisor: Hubungi Store Manager atau Admin Toko Roti Wonosari.',
            'last_submit_label' => 'Kirim Semua',
            'last_has_back' => true,
            'steps' => [
                'kontrol-operasional' => [
                    'title' => 'Kontrol Operasional Toko',
                    'icon' => 'store',
                    'subtitle' => $visit,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => $visitSub,
                    'notice' => 'Catatan: Ketidaksesuaian SOP wajib diberikan teguran langsung atau dicatat pada laporan evaluasi kunjungan.',
                    'items' => [
                        'buka_tepat_waktu' => ['Toko buka tepat waktu', 'Jam buka gerai sesuai jadwal operasional resmi tanpa keterlambatan staf.'],
                        'sop_operasional' => ['SOP operasional berjalan dengan baik', 'Seluruh alur pelayanan, seragam standar, dan penanganan kasir dipatuhi frontliner.'],
                        'kesiapan_display' => ['Kesiapan display sebelum jam operasional', 'Rak roti terisi penuh, penataan rapi, dan label harga (price tag) terpasang lengkap.'],
                    ],
                ],
                'kualitas-pelayanan' => [
                    'title' => 'Kualitas Pelayanan Customer',
                    'preview_title' => 'Kualitas & Pelayanan',
                    'icon' => 'headset',
                    'subtitle' => $visit,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => $visitSub,
                    'notice' => 'Catatan: Komplain terkait kualitas produk atau pelayanan wajib segera dikonfirmasi dan ditindaklanjuti bersama kepala toko.',
                    'items' => [
                        'kecepatan_layanan' => ['Kecepatan pelayanan sesuai standar', 'Waktu tunggu antrean dan proses transaksi kasir memenuhi SOP.'],
                        'keramahan_staf' => ['Keramahan staf terjaga', 'Pemberian salam (greeting), senyum, dan penawaran produk tambahan dijalankan staf.'],
                        'komplain_tertangani' => ['Komplain customer tertangani dengan baik', 'Semua komplain yang masuk hari ini sudah ditanggapi dan diselesaikan'],
                    ],
                ],
                'kontrol-produk-display' => [
                    'title' => 'Kontrol Produk & Display',
                    'icon' => 'box',
                    'subtitle' => $visit,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => $visitSub,
                    'notice' => 'Catatan: Pastikan produk yang mendekati tanggal kedaluwarsa segera dikoordinasikan untuk promo clearance atau retur.',
                    'items' => [
                        'kerapian_display' => ['Kerapian display terjaga', 'Penataan roti rapi, nampan display bersih, dan rak display terawat.'],
                        'ketersediaan_produk' => ['Ketersediaan produk lengkap', 'Varian produk utama tersedia sesuai target stok pajang toko.'],
                        'rotasi_fifo' => ['Rotasi produk FIFO/FEFO berjalan', 'Produk lama ditempatkan di depan dan tanggal kedaluwarsa rutin dicek.'],
                    ],
                ],
                'pelaporan-administrasi' => [
                    'title' => 'Pelaporan & Administrasi',
                    'icon' => 'document',
                    'subtitle' => 'Centang laporan yang sudah direkap hari ini',
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => 'Centang indikator yang dipenuhi hari ini:',
                    'notice' => $verifyNotice,
                    'items' => [
                        'rekap_penjualan' => ['Laporan penjualan sudah direkap', 'Rekap penjualan toko hari ini sudah selesai dibuat'],
                        'rekap_stok' => ['Laporan stok sudah direkap', 'Rekap kondisi stok toko hari ini sudah selesai dibuat'],
                        'rekap_kas' => ['Laporan kas sudah direkap', 'Rekap kondisi kas toko hari ini sudah selesai dibuat'],
                        'kejadian_khusus' => ['Kejadian khusus outlet sudah dicatat', 'Insiden atau catatan khusus hari ini (jika ada) sudah didokumentasikan'],
                    ],
                ],
                'inisiatif-improvement' => [
                    'title' => 'Inisiatif Improvement',
                    'icon' => 'lightbulb',
                    'subtitle' => 'Centang jika ada usulan perbaikan hari ini',
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'OPSIONAL',
                    'card_sub' => 'Centang indikator yang dipenuhi hari ini:',
                    'notice' => $verifyNotice,
                    'items' => [
                        'usulan_ide' => ['Ada usulan ide perbaikan hari ini', 'Mengajukan ide promo, peningkatan penjualan, atau efisiensi kerja hari ini (boleh dikosongkan jika tidak ada)'],
                    ],
                ],
                'kebersihan-outlet' => [
                    'title' => 'Kebersihan & Kerapian Outlet',
                    'preview_title' => 'Kebersihan Outlet',
                    'icon' => 'sparkle',
                    'subtitle' => $visit,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => 'Centang area yang sudah dicek hari ini:',
                    'notice' => null,
                    'upload' => [
                        'title' => 'Unggah Lampiran',
                        'tag' => 'OPSIONAL',
                        'desc' => 'Unggah dokumen rekap pendukung (misal: PDF rekap kas, spreadsheet fisik, atau berita acara):',
                        'hint' => 'Format JPG/PNG, maks. 5MB.',
                        'example' => 'Contoh foto: ambil foto area jual, meja display, gudang, dan toilet dari sudut yang memperlihatkan seluruh area.',
                    ],
                    'items' => [
                        'area_jual' => ['Area jual bersih', 'Lantai gerai bebas kotoran, tempat sampah kosong & rapi.'],
                        'meja_display' => ['Meja display bersih', 'Rak pajang, nampan roti, dan kaca pelindung higienis.'],
                        'gudang' => ['Gudang rapi', 'Stok bahan & kemasan tertata rapi di atas pallet/rak.'],
                        'toilet' => ['Toilet bersih', 'Toilet staf & pelanggan wangi, air mengalir, sabun tersedia.'],
                    ],
                ],
            ],
            'dummy' => [
                'progress' => [
                    'kontrol-operasional' => [3, 'tercapai'],
                    'kualitas-pelayanan' => [3, 'tercapai'],
                    'kontrol-produk-display' => [3, 'tercapai'],
                    'pelaporan-administrasi' => [0, 'belum_diisi'],
                    'inisiatif-improvement' => [0, 'tidak_tercapai'],
                    'kebersihan-outlet' => [2, 'tidak_tercapai'],
                ],
                'recent' => $this->dummyRecent(),
                'riwayat' => $this->dummyRiwayat(18),
                'detail_done' => [
                    'kontrol-operasional' => 2,
                ],
                'revision' => [
                    'step' => 'kontrol-operasional',
                    'requested_by' => 'User (Store Manager)',
                    'requested_at' => '25 Okt, 08:30 WIB',
                    'message' => 'Foto bukti Kontrol Operasional Toko kurang jelas, mohon upload ulang.',
                    'short' => 'Perlu Revisi · Foto tidak jelas',
                ],
            ],
        ];
    }
}
