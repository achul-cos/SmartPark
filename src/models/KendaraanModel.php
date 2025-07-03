<?php

class KendaraanModel extends Database {
    public function __construct(){
        parent::__construct(); // Inisialisasi koneksi
        error_log("Koneksi database: " . ($this->conn ? "OK" : "Gagal"));
    }

    public function getAll(){
        $query = "SELECT * FROM kendaraan";
        return $this->qry($query)->fetchAll();
    }

    // Fungsi helper untuk normalisasi plat nomor
    private function normalizePlateNumber($plate) {
        $normalized = strtoupper(preg_replace('/\s+/', '', $plate));
        error_log("Normalizing '$plate' to '$normalized'");
        return $normalized;
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
        error_log("======== START exitVehicle ========");
        error_log("Memproses keluar untuk plat: " . $plat_nomor);
        
        // Normalisasi input plat nomor
        $plat_input = $this->normalizePlateNumber($plat_nomor);
        error_log("Plat dinormalisasi: " . $plat_input);
        
        // Cari kendaraan yang sesuai
        $vehicle = $this->findParkedVehicle($plat_input);

        if (!$vehicle) {
            error_log("Kendaraan TIDAK ditemukan");
            $this->logAllParkedVehicles();
            return ['success' => false];
        }
        
        error_log("Kendaraan ditemukan: " . print_r($vehicle, true));
        
        // Proses keluar kendaraan
        $result = $this->processVehicleExit($vehicle);
        
        error_log("======== END exitVehicle ========");
        return [
            'success' => true,
            'data' => $result
        ];
    }

    private function findParkedVehicle($normalized_plate) {
        error_log("Mencari kendaraan dengan plat: '$normalized_plate'");
        
        // Gunakan query yang lebih robust
        $query = "SELECT * FROM kendaraan 
                  WHERE REPLACE(UPPER(TRIM(plat_nomor)), ' ', '') = ?
                  AND status = 'parkir'";
        
        error_log("Query: " . $query);
        error_log("Parameter: " . $normalized_plate);
        
        $stmt = $this->qry($query, [$normalized_plate]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function processVehicleExit($vehicle) {
        $waktu_keluar = date('Y-m-d H:i:s');
        $waktu_masuk = $vehicle['waktu_masuk'];
        
        // Hitung durasi parkir
        $masuk = new DateTime($waktu_masuk);
        $keluar = new DateTime($waktu_keluar);
        $diff = $keluar->diff($masuk);
        
        // Hitung total jam (pembulatan ke atas)
        $hours = $this->calculateParkingHours($diff);
        
        // Dapatkan tarif per jam
        $tarif = $this->getTarifByJenis($vehicle['jenis']);
        $biaya = $hours * $tarif;
        
        // Update data kendaraan
        $this->updateVehicleExit($vehicle['id'], $waktu_keluar, $biaya);
        
        return [
            'plat_nomor' => $vehicle['plat_nomor'],
            'jenis' => $vehicle['jenis'],
            'waktu_masuk' => $waktu_masuk,
            'waktu_keluar' => $waktu_keluar,
            'durasi' => $diff->format('%H jam %i menit'),
            'biaya' => $biaya
        ];
    }

    private function calculateParkingHours($diff) {
        $hours = $diff->h + ($diff->days * 24);
        
        // Jika ada menit atau detik, tambahkan 1 jam
        if ($diff->i > 0 || $diff->s > 0) {
            $hours += 1;
        }
        
        return $hours;
    }

    private function getTarifByJenis($jenis) {
        $tarifQuery = "SELECT tarif_per_jam FROM tarif_parkir WHERE jenis = ?";
        $tarif = $this->qry($tarifQuery, [$jenis])->fetch();
        
        if (!$tarif) {
            error_log("Tarif tidak ditemukan untuk jenis: $jenis");
            return 0;
        }
        
        return $tarif['tarif_per_jam'];
    }

    private function updateVehicleExit($id, $waktu_keluar, $biaya) {
        $updateQuery = "UPDATE kendaraan 
                       SET waktu_keluar = ?, biaya = ?, status = 'keluar' 
                       WHERE id = ?";
        
        $this->qry($updateQuery, [$waktu_keluar, $biaya, $id]);
    }

    private function logAllParkedVehicles() {
        $query = "SELECT * FROM kendaraan WHERE status = 'parkir'";
        $stmt = $this->qry($query);
        $allVehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        error_log("Semua kendaraan parkir (" . count($allVehicles) . "):");
        foreach ($allVehicles as $vehicle) {
            $normalized = $this->normalizePlateNumber($vehicle['plat_nomor']);
            error_log("- Plat: '{$vehicle['plat_nomor']}' (Normalized: '$normalized')");
        }
    }

    public function getParkedVehicles() {
        $query = "SELECT * FROM kendaraan WHERE status = 'parkir'";
        return $this->qry($query)->fetchAll();
    }
}