<?php

namespace App\Http\Controllers;

/**
 * KPI Karyawan Sales & Marketing (Figma: section "KARYAWAN SALES & MARKETING").
 * 4 langkah pengisian: Penjualan & Customer, Konten & Digital,
 * Kerjasama & Aktivasi, Analisa, Budget & NPD.
 */
class SalesMarketingController extends ChecklistRoleController
{
    protected function roleConfig(): array
    {
        $subtitle = 'Input Harian Divisi Sales & Marketing';
        $cardSub = 'Centang indikator yang dipenuhi hari ini:';
        $tapNotice = 'Ketuk baris untuk menandai ceklis selesai dikerjakan.';

        return [
            'key' => 'sales_marketing',
            'route' => 'sales',
            'label' => 'Sales & Marketing',
            'badge' => 'SALES & MARKETING',
            'page_title' => 'Sales & Marketing',
            'help_text' => 'Pusat Bantuan Sales & Marketing: Hubungi Store Manager Toko Roti Wonosari.',
            'last_submit_label' => 'Kirim Capaian Hari Ini',
            'last_has_back' => false,
            'steps' => [
                'penjualan-customer' => [
                    'title' => 'Penjualan & Customer',
                    'icon' => 'chart',
                    'subtitle' => $subtitle,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => $cardSub,
                    'notice' => $tapNotice,
                    'items' => [
                        'omset_program' => ['Omset dari program marketing sesuai target', 'Realisasi penjualan dari aktivitas marketing hari ini mencapai target yang ditetapkan'],
                        'customer_baru' => ['Ada pertumbuhan customer baru', 'Berhasil mendapat customer baru hari ini sesuai target'],
                        'repeat_order' => ['Ada repeat order customer', 'Ada customer lama yang kembali membeli hari ini'],
                        'promo_efektif' => ['Promo yang dijalankan efektif', 'Penjualan dari promo hari ini sesuai target yang diharapkan'],
                    ],
                ],
                'konten-digital' => [
                    'title' => 'Konten & Digital',
                    'icon' => 'megaphone',
                    'subtitle' => $subtitle,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => $cardSub,
                    'notice' => $tapNotice,
                    'items' => [
                        'upload_konten' => ['Sudah upload konten sosmed hari ini', 'Minimal 1 konten (foto/video/caption) sudah diupload ke akun sosmed toko hari ini'],
                        'engagement' => ['Engagement sosmed sesuai target', 'Total like, komentar, share, dan save hari ini sesuai target'],
                        'leads_baru' => ['Sudah dapat leads baru hari ini', 'Ada data customer baru (nomor WA atau pendaftaran member) yang masuk hari ini'],
                    ],
                ],
                'kerjasama-aktivasi' => [
                    'title' => 'Kerjasama & Aktivasi',
                    'icon' => 'handshake',
                    'subtitle' => $subtitle,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => $cardSub,
                    'notice' => $tapNotice,
                    'items' => [
                        'kerjasama_baru' => ['Ada kerjasama penjualan baru hari ini', 'Berhasil menjalin kerjasama dengan mitra baru hari ini'],
                        'aktivasi' => ['Ada aktivasi marketing hari ini', 'Ada kegiatan marketing offline yang dijalankan hari ini'],
                    ],
                ],
                'analisa-budget-npd' => [
                    'title' => 'Analisa, Budget & NPD',
                    'icon' => 'clipboard',
                    'subtitle' => $subtitle,
                    'card_title' => 'INDIKATOR PENILAIAN',
                    'tag' => 'WAJIB',
                    'card_sub' => $cardSub,
                    'notice' => 'Pastikan semua data input harian telah sesuai sebelum mengirim capaian. Laporan yang sudah dikirim akan langsung diverifikasi oleh <strong>Store Manager</strong>',
                    'items' => [
                        'analisa_kompetitor' => ['Analisa kompetitor sudah dilaporkan hari ini', 'Laporan harga dan promo pesaing hari ini sudah dibuat dan siap dilaporkan'],
                        'budget_sesuai' => ['Budget marketing sesuai rencana', 'Pengeluaran biaya promosi hari ini tidak melebihi anggaran yang ditetapkan'],
                        'riset_npd' => ['Ada progres riset atau launching produk baru hari ini', 'Ada aktivitas riset pasar atau persiapan launching produk baru yang dikerjakan hari ini'],
                    ],
                ],
            ],
            'dummy' => [
                // [jumlah tercentang, status preview] — data contoh sebelum Backend tersambung
                'progress' => [
                    'penjualan-customer' => [4, 'tercapai'],
                    'konten-digital' => [3, 'tercapai'],
                    'kerjasama-aktivasi' => [0, 'belum_diisi'],
                    'analisa-budget-npd' => [0, 'belum_diisi'],
                ],
                'recent' => $this->dummyRecent(),
                'riwayat' => $this->dummyRiwayat(12),
                'detail_done' => [
                    'penjualan-customer' => 3,
                ],
                'revision' => [
                    'step' => 'penjualan-customer',
                    'requested_by' => 'User (Store Manager)',
                    'requested_at' => '25 Okt, 08:30 WIB',
                    'message' => 'Data capaian Penjualan & Customer belum lengkap, mohon diperiksa dan dikirim ulang.',
                    'short' => 'Perlu Revisi · Data belum lengkap',
                ],
            ],
        ];
    }
}
