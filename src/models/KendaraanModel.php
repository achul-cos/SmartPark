<?php

class KendaraanModel extends Database {
    public function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $query = "SELECT * FROM kendaraan";
        return $this->qry($query)->fetchAll();
    }

    // Method baru untuk mendapatkan kendaraan yang masih parkir
    // public function getParkedVehicles() {
    //     $query = "SELECT * FROM kendaraan WHERE status = 'parkir'";
    //     return $this->qry($query)->fetchAll();
    // }

    // Method untuk menambahkan kendaraan masuk
    // public function addVehicle($plat_nomor, $jenis) {
    //     $waktu_masuk = date('Y-m-d H:i:s');
    //     $query = "INSERT INTO kendaraan (plat_nomor, jenis, waktu_masuk, status) VALUES (?, ?, ?, 'parkir')";
    //     return $this->qry($query, [$plat_nomor, $jenis, $waktu_masuk]);
    // }

    // Fungsi helper untuk normalisasi plat nomor
    private function normalizePlateNumber($plate) {
        return strtoupper(preg_replace('/\s+/', '', $plate));
    }

    public function addVehicle($plat_nomor, $jenis) {
        // Normalisasi plat nomor untuk pengecekan
        $plat_normalized = $this->normalizePlateNumber($plat_nomor);
        
        // Cek apakah plat nomor sudah ada dan masih parkir
        $query = "SELECT id FROM kendaraan WHERE status = 'parkir'";
        $vehicles = $this->qry($query)->fetchAll();
        
        foreach ($vehicles as $vehicle) {
            $db_plat_normalized = $this->normalizePlateNumber($vehicle['plat_nomor']);
            if ($db_plat_normalized === $plat_normalized) {
                return false; // Plat nomor sudah ada
            }
        }

        $waktu_masuk = date('Y-m-d H:i:s');
        $query = "INSERT INTO kendaraan (plat_nomor, jenis, waktu_masuk, status) VALUES (?, ?, ?, 'parkir')";
        $stmt = $this->qry($query, [$plat_nomor, $jenis, $waktu_masuk]);
        
        return $stmt->rowCount() > 0;
    }

public function exitVehicle($plat_nomor) {
    error_log("Memproses keluar untuk plat: " . $plat_nomor);
    
    // Normalisasi input
    $plat_input = $this->normalizePlateNumber($plat_nomor);
    error_log("Plat dinormalisasi: " . $plat_input);
    
    // Query untuk mencari kendaraan
    $query = "SELECT * FROM kendaraan 
              WHERE REPLACE(UPPER(plat_nomor), ' ', '') = ?
              AND status = 'parkir'";
    
    error_log("Query: " . $query);
    error_log("Parameter: " . $plat_input);
    
    $vehicle = $this->qry($query, [$plat_input])->fetch();
    
    if ($vehicle) {
        error_log("Kendaraan ditemukan: " . print_r($vehicle, true));
        // ... lanjutan kode ...
    } else {
        error_log("Kendaraan TIDAK ditemukan");
        $allVehicles = $this->qry("SELECT * FROM kendaraan")->fetchAll();
        error_log("Semua kendaraan: " . print_r($allVehicles, true));
    }
    
    return ['success' => false];
}

    public function getParkedVehicles() {
        $query = "SELECT * FROM kendaraan WHERE status = 'parkir'";
        return $this->qry($query)->fetchAll();
    }

}