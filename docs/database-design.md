### Rancangan Database Garuda-Hub ###

## 1. Tujuan ##
Database Garuda-Hub digunakan untuk mengelola pengguna, proyek lelang IT, dan penawaran developer

## 2. Tabel ###
# A. users #
Menyimpan data seluruh pengguna aplikasi
- id: Primary Key
- nama: Nama pengguna
- email: Email unik
- password: Password yang sudah di-hash
- role: klien, developer, atau admin
- created_at: Waktu pendaftaran
# B. projects #
Menyimpan data proyek yang dibuat oleh klien.
- id: Primary Key
- client_id: Foreign Key ke users.id
- judul: Judul proyek
- deskripsi: Deskripsi proyek
- kategori: Kategori proyek
- budget_min: Anggaran minimum
- budget_max: Anggaran maksimum
- batas_lelang: Batas waktu lelang
- status: terbuka atau ditutup
- created_at: Waktu pembuatan
# C. bids #
Menyimpan penawaran developer terhadap proyek
- id: Primary Key
- project_id: Foreign Key ke projects.id
- developer_id: Foreign Key ke users.id
- harga: Harga penawaran
- durasi: Estimasi pengerjaan
- proposal: Deskripsi penawaran
- is_winner: Status pemenang
- created_at: Waktu penawaran

## Relasi Antar Tabel ##
1. users memiliki relasi one-to-many dengan projects melalui client_id.
2. users memiliki relasi one-to-many dengan bids melalui developer_id.
3. projects memiliki relasi one-to-many dengan bids melalui project_id.
4. Relasi many-to-many antara users (developer) dan projects dihubungkan oleh bids.

## 4. Aturan dan Perbaikan ##
1. Setiap email pengguna harus unik.
2. Setiap proyek harus memiliki klien sebagai pemilik.
3. Setiap penawaran harus terhubung dengan satu proyek dan satu developer.
4. Developer hanya boleh memberikan satu penawaran untuk proyek yang sama.
5. Validasi role pengguna dilakukan pada aplikasi.
6. Pemilihan pemenang harus memastikan hanya ada satu pemenang untuk setiap proyek.
7. Penghapusan data harus memperhatikan relasi dan dampak cascade delete.

## 5. Kesimpulan ##
Database Garuda-Hub menggunakan tiga tabel utama, yaitu users, projects, dan bids. Struktur ini mendukung proses pembuatan proyek, pengajuan penawaran, dan pemilihan developer melalui relasi database yang terintegrasi.