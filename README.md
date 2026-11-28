# GarudaHub

GarudaHub adalah aplikasi marketplace lelang proyek IT yang memungkinkan klien membuat proyek dan developer mengajukan penawaran.

Proyek ini merupakan tugas pembelajaran **Web-Based Programming** dengan fokus pada perancangan database relasional dan refactoring aplikasi PHP Native menjadi Laravel menggunakan pola MVC dan Eloquent ORM.

## Teknologi

- PHP 8.3+
- Laravel 13
- MySQL
- Blade Template
- Eloquent ORM
- Composer

## Fitur yang Diimplementasikan

- Menampilkan daftar proyek.
- Menambahkan proyek.
- Melihat detail proyek.
- Mengubah data proyek.
- Menghapus proyek.
- Menampilkan daftar penawaran.
- Menambahkan penawaran.
- Melihat detail penawaran.
- Mengubah data penawaran.
- Menghapus penawaran.
- Relasi antara User, Project, dan Bid menggunakan Eloquent ORM.

## Kebutuhan Sistem

Pastikan perangkat telah memiliki:

- PHP 8.3 atau lebih baru.
- Composer.
- MySQL atau MariaDB.
- Git.

## Instalasi

### 1. Clone Repository

```bash
git clone -b adisza0-refactor-garudahub https://github.com/adisza0/garudaHub.git
cd garudaHub
```

### 2. Install Dependensi

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`.

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

### 4. Buat Database

Buat database MySQL dengan nama:

```sql
CREATE DATABASE garuda_hub;
```

### 5. Atur Koneksi Database

Sesuaikan konfigurasi berikut di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=garuda_hub
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password berdasarkan konfigurasi MySQL lokal.

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

Perintah ini membuat tabel database dan mengisi data contoh.

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka aplikasi melalui:

http://127.0.0.1:8000

## Akun Demo

Seeder menyediakan tiga akun contoh:

| Peran | Email | Password |
|---|---|---|
| Admin | admin@garudahub.test | password |
| Klien | klien@garudahub.test | password |
| Developer | developer@garudahub.test | password |

Akun tersebut merupakan data dummy untuk kebutuhan pengujian. Fitur autentikasi belum diimplementasikan.

## Struktur Proyek

```text
garudaHub/
├── app/
│   ├── Http/Controllers/
│   │   ├── ProjectController.php
│   │   └── BidController.php
│   └── Models/
│       ├── User.php
│       ├── Project.php
│       └── Bid.php
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       ├── projects/
│       └── bids/
├── routes/
│   └── web.php
├── tests/
├── src/
│   ├── index.php
│   └── database.sql
└── README.md
```

Folder `src/` menyimpan aplikasi PHP Native versi awal sebagai arsip dan referensi refactoring.

## Pengujian

Jalankan pengujian Laravel menggunakan:

```bash
php artisan test
```

Pengujian fitur mencakup pemeriksaan respons halaman utama, daftar proyek, dan daftar penawaran.

## Catatan

- Aplikasi ini dibuat untuk kebutuhan pembelajaran dan pengembangan lokal.
- Data yang digunakan merupakan data dummy.
- Fitur autentikasi dan otorisasi pengguna belum diimplementasikan.
- Jangan menggunakan konfigurasi database lokal yang tidak aman pada server publik.

## Lisensi

MIT. Lihat file [LICENSE](LICENSE).