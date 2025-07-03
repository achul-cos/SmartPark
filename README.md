# 🚀 SmartPark - Sistem Manajemen Parkir Berbasis Web

![SmartPark Banner](https://via.placeholder.com/1200x400/0f3460/ffffff?text=SmartPark+Sistem+Parkir+Modern)

**SmartPark** adalah solusi modern untuk manajemen parkir berbasis web dengan arsitektur MVC. Sistem ini menyederhanakan operasional parkir mulai dari input kendaraan, penentuan tarif, hingga analisis laporan keuangan - semuanya dalam satu platform terintegrasi!

<div align="center">
  
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-8892BF.svg?style=flat-square)](https://php.net/)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE)
[![GitHub Stars](https://img.shields.io/github/stars/username/smartpark?style=social)](https://github.com/username/smartpark)

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
![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql)
![PDO](https://img.shields.io/badge/PDO-Database%20Access-1A1A2E)

**Frontend**  
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?logo=javascript)

**Arsitektur**  
![MVC Pattern](https://img.shields.io/badge/Arsitektur-MVC-4FC08D)

## 🖥️ Demo Aplikasi

| Halaman Dashboard | Halaman Kelola Tarif | Halaman Laporan |
|-------------------|----------------------|-----------------|
| ![Dashboard](https://via.placeholder.com/350x200/16213e/ffffff?text=Dashboard) | ![Tarif](https://via.placeholder.com/350x200/1a1a2e/ffffff?text=Kelola+Tarif) | ![Laporan](https://via.placeholder.com/350x200/0f3460/ffffff?text=Laporan) |
| Monitor kendaraan aktif secara real-time | Atur tarif parkir dengan antarmuka intuitif | Analisis statistik pendapatan dan kendaraan |

## 🚀 Panduan Instalasi

### Prasyarat Sistem
- PHP 7.4+
- MySQL 5.7+
- Web Server (Apache/Nginx)
- Composer (disarankan)

### Instalasi Langkah demi Langkah

```bash
# 1. Clone repositori
git clone https://github.com/username/smartpark.git
cd smartpark

# 2. Install dependencies
composer install

# 3. Buat database
mysql -u root -p -e "CREATE DATABASE smartpark;"

# 4. Import struktur database
mysql -u root -p smartpark < database/smartpark.sql

# 5. Konfigurasi environment
cp .env.example .env
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
├── app/
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
├── router.php          # Routing aplikasi
└── index.php           # Entry point
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
[![Twitter](https://img.shields.io/badge/Twitter-1DA1F2?logo=twitter)](https://twitter.com/smartpark)
[![Sponsor](https://img.shields.io/badge/Sponsor-FF5E5B?logo=githubsponsors)](https://github.com/sponsors/username)