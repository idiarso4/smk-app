# SMK APP - Sistem Manajemen Sekolah
## Tentang Aplikasi
MK APP adalah sistem manajemen sekolah berbasis web yang dibangun menggunakan Laravel dan Filament Admin Panel. Aplikasi ini dirancang untuk memudahkan pengelolaan data dan aktivitas sekolah.
## Teknologi yang Digunakan
 PHP 8.2
 Laravel 11.x
 Filament 3.x
 MySQL/MariaDB
## Fitur
 Dashboard Admin
 Manajemen User
 Manajemen Siswa
 Manajemen Guru
 Manajemen Kelas
 Manajemen Mata Pelajaran
 Manajemen Nilai
 Dan fitur lainnya
## Persyaratan Sistem
 PHP >= 8.2
 Composer
 Node.js & NPM
 MySQL/MariaDB
 Web Server (Apache/Nginx)
## Instalasi
. Clone repository

==================

git clone https://github.com/idiarso4/smk-app.git


2. Install dependencies


composer install
npm install


3. Setup environment


cp .env.example .env
php artisan key:generate

4. Konfigurasi database di file .env


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smk_app
DB_USERNAME=root
DB_PASSWORD=


5. Migrate database


php artisan migrate

6. Jalankan server


php artisan serve
npm run dev




## Penggunaan
1. Akses aplikasi melalui browser: `http://localhost:8000`
2. Login ke admin panel: `http://localhost:8000/admin`

## Kontribusi
Kontribusi selalu diterima. Untuk perubahan besar, harap buka issue terlebih dahulu untuk mendiskusikan apa yang ingin Anda ubah.

## Lisensi
[MIT License](LICENSE)

## Kontak
- Developer: [Nama Anda]
- Email: [Email Anda]

## Status Pengembangan
🚧 Dalam tahap pengembangan aktif

## Backup Konfigurasi
Backup konfigurasi tersedia di folder `backup-config/` untuk referensi jika terjadi masalah dengan konfigurasi Filament.