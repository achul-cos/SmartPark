-- Tabel kendaraan
CREATE TABLE kendaraan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    plat_nomor VARCHAR(15) NOT NULL,
    jenis ENUM('motor','mobil') NOT NULL,
    waktu_masuk DATETIME NOT NULL,
    waktu_keluar DATETIME,
    biaya INT DEFAULT 0,
    status ENUM('parkir','keluar') DEFAULT 'parkir'
);

-- Tabel tarif_parkir
CREATE TABLE tarif_parkir (
    id INT PRIMARY KEY AUTO_INCREMENT,
    jenis ENUM('motor','mobil') NOT NULL UNIQUE,
    tarif_per_jam INT NOT NULL
);

-- Data awal tarif
INSERT INTO tarif_parkir (jenis, tarif_per_jam) VALUES 
('motor', 2000),
('mobil', 5000);