<?php

class TarifModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    // Ambil tarif berdasarkan jenis kendaraan
    public function getTarifByJenis($jenis) {
        $query = "SELECT * FROM tarif_parkir WHERE jenis = ?";
        return $this->qry($query, [$jenis])->fetch(PDO::FETCH_ASSOC);
    }

    // Update tarif
    public function updateTarif($jenis, $tarif_per_jam) {
        $query = "UPDATE tarif_parkir SET tarif_per_jam = ? WHERE jenis = ?";
        $stmt = $this->qry($query, [$tarif_per_jam, $jenis]);
        return $stmt->rowCount() > 0;
    }

    public function getAllTarif() {
        $query = "SELECT * FROM tarif_parkir";
        return $this->qry($query)->fetchAll(PDO::FETCH_ASSOC);
    }    
}