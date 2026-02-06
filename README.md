# Sistem Informasi PPDB Online (Pelita Sriwijaya)

Aplikasi Penerimaan Peserta Didik Baru (PPDB) berbasis web yang dibangun menggunakan **Laravel** dan **Filament PHP**. Aplikasi ini dirancang untuk mempermudah proses pendaftaran siswa, manajemen data orang tua, verifikasi dokumen, hingga pengumuman hasil seleksi.

## 🚀 Fitur Utama

1.  **Formulir Pendaftaran Cerdas**
    * Frontend responsif dengan validasi *real-time* (NIK, File Upload).
    * Otomatis mendeteksi Gelombang Pendaftaran aktif.
2.  **Dashboard Admin Eksekutif (Filament)**
    * Visualisasi data statistik (Pie Chart, Cards) dengan filter Tahun Ajaran global.
    * Manajemen user admin dan staff.
3.  **Manajemen Data Terpusat**
    * Relasi data Siswa, Orang Tua, dan Dokumen dalam satu tampilan.
    * Pencarian instan dan fitur Export Excel.
4.  **High-Performance Database**
    * Teroptimasi dengan *Database Indexing* untuk menangani ribuan data tanpa lambat.

## 🛠️ Persyaratan Sistem (System Requirements)

Pastikan komputer Anda telah terinstal:

* **PHP**: Versi **8.5.2** (Terbaru/Bleeding Edge) atau minimal 8.2.
* **Composer**: Untuk manajemen dependensi PHP.
* **Database**: MySQL atau MariaDB (via XAMPP/Laragon).
* **Node.js & NPM**: Untuk compile aset frontend (Tailwind/Vite).

### Ekstensi PHP Wajib
Pastikan ekstensi berikut diaktifkan (uncomment) di `php.ini` Anda:
* `fileinfo`
* `curl`
* `mbstring`
* `openssl`
* `pdo_mysql`
* `zip`
* `intl`
* `gd`

## ⚙️ Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal:

### 1. Clone Repository
Unduh source code proyek atau jalankan perintah git:
```bash
git clone [https://github.com/username-anda/nama-repo-ppdb.git](https://github.com/username-anda/nama-repo-ppdb.git)
cd nama-repo-ppdb

### 2. Install Dependensi
Install library PHP dan aset frontend *jalankan di terminal*:
1. composer install
2. npm install

### 3. Konfigurasi Environment
Duplikat file .env.example menjadi .env lalu Buka file .env dan sesuaikan pengaturan database Anda *Contoh*:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_ppdb
DB_USERNAME=root
DB_PASSWORD=

### 4. Generate Key & Migrasi Database
Buat Application Key dan jalankan struktur tabel (termasuk indexing) *Jalankan Di terminal*:
1. php artisan key:generate
2. php artisan migrate

### 5. Buat Akun Admin (Filament) *Jalankan Diterminal*
Untuk bisa masuk ke dashboard admin, buat user baru:
1. Untuk bisa masuk ke dashboard admin, buat user baru:

### 6. Build Aset Frontend *Jalankan Diterminal*
npm run build

# Cara Menjalankan Aplikasi *Jalankan Diterminal*
php artisan serve

#⚠️ Catatan Khusus PHP 8.5+
Karena menggunakan PHP versi developer (8.5+), terminal mungkin akan penuh dengan pesan Deprecated Warning. Untuk membersihkannya, edit file php.ini, cari error_reporting, dan ubah menjadi:
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT

Lalu restart server Anda.

Dibuat oleh: Felix & Valencio Arjun (Kerja Praktik)