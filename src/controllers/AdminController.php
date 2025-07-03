<?php

class AdminController extends BaseController {

    private $tarifModel;
    private $laporanModel;

    public function __construct() {
        $this->tarifModel = $this->model('TarifModel');
        $this->laporanModel = $this->model('LaporanModel');
    }

    // Menampilkan halaman kelola tarif
    public function tarifView() {
        // Ambil data tarif dari database
        $tarifMobil = $this->tarifModel->getTarifByJenis('mobil');
        $tarifMotor = $this->tarifModel->getTarifByJenis('motor');

        $data = [
            'title' => 'Kelola Tarif Parkir',
            'tarifMobil' => $tarifMobil,
            'tarifMotor' => $tarifMotor
        ];

        $this->view('admin/tarif', $data);
    }

    // Menangani update tarif
    public function tarifUpdate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $jenis = $_POST['jenis'];
            $tarif_per_jam = (int)$_POST['tarif_per_jam'];

            // Validasi input
            if (!in_array($jenis, ['mobil', 'motor']) || $tarif_per_jam <= 0) {
                $_SESSION['error'] = "Data tidak valid!";
                $this->redirect(BASEURL . '/admin/tarif');
                return;
            }

            // Update tarif
            $result = $this->tarifModel->updateTarif($jenis, $tarif_per_jam);

            if ($result) {
                $_SESSION['success'] = "Tarif $jenis berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui tarif $jenis!";
            }

            $this->redirect(BASEURL . '/admin/tarif');
        }
    }

    // Menampilkan halaman laporan
    public function laporanView() {
        // Ambil parameter filter dari URL
        $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
        $jenis = $_GET['jenis'] ?? '';
        
        // Ambil data transaksi yang sudah keluar (status = 'keluar')
        $transaksi = $this->laporanModel->getLaporanHarian($tanggal, $jenis);
        
        // Hitung statistik
        $statistik = $this->laporanModel->getStatistikHarian($tanggal, $jenis);
        
        $data = [
            'title' => 'Laporan Harian',
            'tanggal' => $tanggal,
            'jenisFilter' => $jenis,
            'transaksi' => $transaksi,
            'statistik' => $statistik
        ];
        
        $this->view('admin/laporan', $data);
    }

    public function exportCSV() {
        // Ambil parameter filter
        $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
        $jenis = $_GET['jenis'] ?? '';
        
        // Ambil data transaksi
        $transaksi = $this->laporanModel->getLaporanHarian($tanggal, $jenis);
        
        // Set header untuk download file CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=laporan_parkir_' . $tanggal . '.csv');
        
        $output = fopen('php://output', 'w');
        
        // Header CSV
        fputcsv($output, ['No', 'Plat Nomor', 'Jenis', 'Waktu Masuk', 'Waktu Keluar', 'Durasi', 'Biaya']);
        
        // Data
        $no = 1;
        foreach ($transaksi as $t) {
            // Hitung durasi
            $durasi = '';
            if ($t['waktu_masuk'] && $t['waktu_keluar']) {
                $masuk = new DateTime($t['waktu_masuk']);
                $keluar = new DateTime($t['waktu_keluar']);
                $interval = $masuk->diff($keluar);
                $durasi = $interval->format('%h jam %i menit');
            }
            
            fputcsv($output, [
                $no++,
                $t['plat_nomor'],
                $t['jenis'],
                $t['waktu_masuk'],
                $t['waktu_keluar'],
                $durasi,
                $t['biaya']
            ]);
        }
        
        fclose($output);
        exit();
    }
}