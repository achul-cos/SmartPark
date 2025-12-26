# 🚀 SmartPark - Sistem Manajemen Parkir Berbasis Web

![SmartPark Banner](https://github.com/achul-cos/SmartPark/releases+Sistem+Parkir+Modern)

**SmartPark** adalah solusi modern untuk manajemen parkir berbasis web dengan arsitektur MVC. Sistem ini menyederhanakan operasional parkir mulai dari input kendaraan, penentuan tarif, hingga analisis laporan keuangan - semuanya dalam satu platform terintegrasi!

<div align="center">
  
[![PHP Version](https://github.com/achul-cos/SmartPark/releases%https://github.com/achul-cos/SmartPark/releases)](https://github.com/achul-cos/SmartPark/releases)
[![License](https://github.com/achul-cos/SmartPark/releases)](LICENSE)
[![GitHub Stars](https://github.com/achul-cos/SmartPark/releases)](https://github.com/achul-cos/SmartPark/releases)

</div>

## ✨ Fitur Unggulan

| Fitur | Deskripsi |
|-------|------------|
| 🚗 **Manajemen Kendaraan** | Input kendaraan masuk/keluar secara real-time |
| ⚙️ **Kelola Tarif Dinamis** | Update tarif parkir untuk motor & mobil dengan mudah |
| 📊 **Analitik Cerdas** | Laporan harian dengan filter dan statistik visual |
| 📱 **Responsif** | Akses dari desktop, tablet, atau smartphone |
| 📤 **Ekspor Data** | Unduh laporan dalam format CSV untuk analisis lanjutan |

## 🛠 Teknologi

**Backend**  
![PHP](https://github.com/achul-cos/SmartPark/releases%2B-777BB4?logo=php)
![MySQL](https://github.com/achul-cos/SmartPark/releases+-4479A1?logo=mysql)
![PDO](https://github.com/achul-cos/SmartPark/releases%20Access-1A1A2E)

**Frontend**  
![HTML5](https://github.com/achul-cos/SmartPark/releases)
![CSS3](https://github.com/achul-cos/SmartPark/releases)
![JavaScript](https://github.com/achul-cos/SmartPark/releases)

**Arsitektur**  
![MVC Pattern](https://github.com/achul-cos/SmartPark/releases)

## 🖥️ Demo Aplikasi

| Halaman Dashboard | Halaman Kelola Tarif | Halaman Laporan |
|-------------------|----------------------|-----------------|
| ![Dashboard](https://github.com/achul-cos/SmartPark/releases) | ![Tarif](https://github.com/achul-cos/SmartPark/releases+Tarif) | ![Laporan](https://github.com/achul-cos/SmartPark/releases) |
| Monitor kendaraan aktif secara real-time | Atur tarif parkir dengan antarmuka intuitif | Analisis statistik pendapatan dan kendaraan |

## 🚀 Panduan Instalasi

### Prasyarat Sistem
- PHP 8.2+
- MySQL 5.7+
- Web Server (Apache/Nginx)
- Composer (disarankan)

### Instalasi Langkah demi Langkah

```bash
# 1. Clone repositori
git clone https://github.com/achul-cos/SmartPark/releases
cd smartpark

# 2. Install dependencies
composer install

# 3. Buat database
mysql -u root -p -e "CREATE DATABASE smartpark;"

# 4. Import struktur database
mysql -u root -p smartpark < https://github.com/achul-cos/SmartPark/releases

# 5. Konfigurasi environment
cp https://github.com/achul-cos/SmartPark/releases .env
```

Konfigurasi file `.env`:
```env
DB_HOST=localhost
DB_NAME=smartpark
DB_USER=root
DB_PASSWORD=rahasia
```

### Menjalankan Aplikasi
```bash
# Dengan PHP built-in server
php -S localhost:8000 -t public

# Atau dengan Apache/Nginx
# (Pastikan document root mengarah ke folder 'public')
```

Akses aplikasi di browser: [http://localhost:8000](http://localhost:8000)

## 🧩 Struktur Proyek

```markdown
smartpark/
├── src/
│   ├── controllers/    # Logic aplikasi
│   ├── models/         # Interaksi database
│   └── views/          # Template antarmuka
├── config/             # Konfigurasi sistem
├── public/             # Aset publik
│   ├── assets/
│   │   ├── css/        # Stylesheet
│   │   ├── js/         # Skrip JavaScript
│   │   └── images/     # Gambar
├── database/           # Skema dan data awal
├── vendor/             # Dependencies
├── https://github.com/achul-cos/SmartPark/releases          # Routing aplikasi
└── https://github.com/achul-cos/SmartPark/releases           # Entry point
```

## 🧪 Struktur Database

```mermaid
erDiagram
    KENDARAAN ||--o{ TARIF_PARKIR : jenis
    KENDARAAN {
        int id PK
        varchar plat_nomor
        enum jenis
        datetime waktu_masuk
        datetime waktu_keluar
        int biaya
        enum status
    }
    TARIF_PARKIR {
        int id PK
        enum jenis
        int tarif_per_jam
    }
```

## 🤝 Berkontribusi

Kontribusi sangat diterima! Ikuti alur berikut:

1. Fork proyek ini
2. Buat branch fitur (`git checkout -b fitur/namafitur`)
3. Commit perubahan (`git commit -m 'Tambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur/namafitur`)
5. Buat Pull Request

## 📜 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE) - lihat file [LICENSE](LICENSE) untuk detailnya.

---

**SmartPark** © 2024 - Dibuat dengan ❤️ untuk sistem parkir yang lebih baik  
[![Twitter](https://github.com/achul-cos/SmartPark/releases)](https://github.com/achul-cos/SmartPark/releases)
[![Sponsor](https://github.com/achul-cos/SmartPark/releases)](https://github.com/achul-cos/SmartPark/releases)
