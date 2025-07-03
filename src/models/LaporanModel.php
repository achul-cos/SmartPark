<?php

class LaporanModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    // Ambil data laporan harian
    public function getLaporanHarian($tanggal, $jenis = '') {
        $params = [$tanggal];
        $query = "SELECT * FROM kendaraan 
                  WHERE DATE(waktu_masuk) = ? 
                  AND status = 'keluar'";
        
        if ($jenis) {
            $query .= " AND jenis = ?";
            $params[] = $jenis;
        }
        
        $query .= " ORDER BY waktu_masuk DESC";
        
        return $this->qry($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hitung statistik harian
    public function getStatistikHarian($tanggal, $jenis = '') {
        $params = [$tanggal];
        $query = "SELECT 
                    COUNT(*) AS total_kendaraan,
                    SUM(biaya) AS total_pendapatan,
                    SUM(CASE WHEN jenis = 'motor' THEN 1 ELSE 0 END) AS total_motor,
                    SUM(CASE WHEN jenis = 'mobil' THEN 1 ELSE 0 END) AS total_mobil
                  FROM kendaraan 
                  WHERE DATE(waktu_masuk) = ?
                  AND status = 'keluar'";
        
        if ($jenis) {
            $query .= " AND jenis = ?";
            $params[] = $jenis;
        }
        
        return $this->qry($query, $params)->fetch(PDO::FETCH_ASSOC);
    }
}