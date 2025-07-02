# Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/). Sistem ini menyediakan beberapa fungsionalitas untuk toko online, termasuk manajemen produk, keranjang belanja, dan sistem transaksi.

## Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)

## Fitur

- Katalog Produk
  - Tampilan produk dengan gambar
  - Pencarian produk
- Keranjang Belanja
  - Tambah/hapus produk
  - Update jumlah produk
- Sistem Transaksi
  - Proses checkout
  - Riwayat transaksi
- Panel Admin
  - Manajemen produk (CRUD)
  - Manajemen kategori
  - Laporan transaksi
  - Export data ke PDF
- Sistem Autentikasi
  - Login/Register pengguna
  - Manajemen akun
- UI Responsif dengan NiceAdmin template

## Persyaratan Sistem

- PHP >= 7.4
- Composer
- Web server (XAMPP)

## Instalasi

1. **Clone repository ini**
   ```bash
   git clone [URL repository]
   cd belajar-ci-tugas
   ```
2. **Install dependensi**
   ```bash
   composer install
   ```
3. **Konfigurasi database**

   - Start module Apache dan MySQL pada XAMPP
   - Buat database **db_ci4** di phpmyadmin.
   - copy file .env dari tutorial https://www.notion.so/april-ns/Codeigniter4-Migration-dan-Seeding-045ffe5f44904e5c88633b2deae724d2

4. **Jalankan migrasi database**
   ```bash
   php spark migrate
   ```
5. **Seeder data**
   ```bash
   php spark db:seed ProductSeeder
   ```
   ```bash
   php spark db:seed UserSeeder
   ```
6. **Jalankan server**
   ```bash
   php spark serve
   ```
7. **Akses aplikasi**
   Buka browser dan akses `http://localhost:8080` untuk melihat aplikasi.

## Struktur Proyek

Proyek menggunakan struktur MVC CodeIgniter 4:

- app/Controllers - Logika aplikasi dan penanganan request
  - AuthController.php - Autentikasi pengguna
  - ProdukController.php - Manajemen produk
  - TransaksiController.php - Proses transaksi
- app/Models - Model untuk interaksi database
  - ProductModel.php - Model produk
  - UserModel.php - Model pengguna
- app/Views - Template dan komponen UI
  - v_produk.php - Tampilan produk
  - v_keranjang.php - Halaman keranjang
- public/img - Gambar produk dan aset
- public/NiceAdmin - Template admin


### ✨ Fitur

Aplikasi ini merupakan platform Toko Online berbasis CodeIgniter 4 yang dilengkapi dengan sistem backend dan frontend modern. Berikut adalah fitur-fitur utama yang tersedia:

#### 👤 Fitur Pengguna (Customer)
- **Katalog Produk Interaktif**
  - Daftar produk ditampilkan dalam grid layout modern menggunakan template NiceAdmin
  - Menampilkan nama, harga, gambar, dan stok produk
  - Tombol “Tambah ke Keranjang” langsung dari katalog
- **Diskon Otomatis Harian**
  - Diskon diatur oleh admin berdasarkan tanggal
  - Diskon akan otomatis diterapkan ke harga produk saat dimasukkan ke keranjang (per item)
- **Keranjang Belanja Dinamis**
  - Menggunakan library eksternal `Cart` bawaan CodeIgniter 4
  - Informasi harga asli, potongan diskon, harga final, dan subtotal per item
  - Fitur edit jumlah item, hapus item, dan kosongkan keranjang
- **Checkout dengan Estimasi Ongkir**
  - Estimasi biaya ongkir dari RajaOngkir (WebService client via Guzzle)
  - Menyimpan transaksi ke database
- **Transaksi & Riwayat Belanja**
  - Setiap transaksi menyimpan data item, diskon, subtotal, alamat, dan waktu transaksi

#### 🛠️ Fitur Admin
- **Manajemen Produk (CRUD)**
  - Tambah, ubah, hapus produk melalui panel admin
  - Upload gambar produk
- **Manajemen Kategori Produk**
  - Admin dapat menambahkan dan mengatur kategori produk
- **Manajemen Diskon Harian**
  - Admin dapat menambahkan diskon berdasarkan tanggal tertentu
  - Validasi agar tidak ada duplikasi tanggal diskon
- **Dashboard Admin**
  - Menampilkan data transaksi dari WebService (Client)
  - Menampilkan jumlah item per transaksi secara dinamis
- **Export & Laporan**
  - Laporan transaksi dapat diakses dari admin dashboard
- **Autentikasi Role-based**
  - Sistem login untuk Admin dan Pengguna (Customer)
  - Hanya admin yang dapat mengakses manajemen data

#### 💡 UI & UX
- Responsif dan modern menggunakan **NiceAdmin Bootstrap 5 Template**
- Validasi form & flash messaging (sukses/gagal) sudah terintegrasi


