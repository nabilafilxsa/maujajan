# 🍜 MauJajan — Web Pemesanan Kantin Sekolah

Aplikasi web pemesanan makanan kantin sekolah berbasis **Laravel**. Customer bisa memesan makanan tanpa login, sementara admin (petugas kantin) bisa mengelola menu dan pesanan.

---

## 📌 Fitur Utama

### 👤 Sisi Customer (Publik)
- Lihat katalog menu (Makanan, Minuman, Cemilan)
- Filter kategori tanpa reload
- Pilih menu + jumlah porsi
- Isi nama & nomor meja
- Konfirmasi pesanan via modal
- Tanpa perlu login

### 🔐 Sisi Admin (Wajib Login)
- Dashboard rekap pesanan masuk
- Update status pesanan (Pending → Diproses → Selesai)
- CRUD menu makanan (Tambah, Edit, Hapus)
- Upload gambar menu

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Fungsi |
|-----------|--------|
| Laravel 12 | Framework PHP utama |
| PHP 8.5 | Bahasa pemrograman server |
| MySQL | Database |
| Laravel Breeze | Autentikasi admin |
| Blade | Template engine |
| Tailwind CSS | Styling UI |
| Vite | Build tool frontend |
| Composer | Manajemen dependency PHP |
| NPM | Manajemen dependency JS |

---

## 🚀 Cara Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL / MariaDB
- XAMPP / Laragon

### Langkah Instalasi

1. Clone repository
git clone https://github.com/nabilafilxsa/maujajan.git
cd maujajan

2. Install dependency PHP
composer install

3. Install dependency JS
npm install

4. Copy file environment
cp .env.example .env

5. Generate application key
php artisan key:generate

6. Konfigurasi database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=maujajan
DB_USERNAME=root
DB_PASSWORD=

7. Jalankan migrasi + seeder
php artisan migrate:fresh --seed

8. Link storage untuk gambar
php artisan storage:link

9. Build aset frontend
npm run build

10. Jalankan server
php artisan serve

Buka di browser: http://127.0.0.1:8000

---

## 🔑 Akun Admin Default

| Field | Value |
|-------|-------|
| URL | http://127.0.0.1:8000/login |
| Email | admin@gmail.com |
| Password | password123 |

---

## 🧪 Cara Penggunaan

### Untuk Customer
1. Buka halaman utama
2. Pilih menu + jumlah porsi
3. Isi nama & nomor meja
4. Klik "Pesan Sekarang"
5. Konfirmasi pesanan

### Untuk Admin
1. Login di /login
2. Lihat rekap pesanan di /dashboard
3. Update status pesanan
4. Kelola menu di /admin/foods

---

## 👨‍💻 Developer

Nabila Filxsa
GitHub: https://github.com/nabilafilxsa

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran.
