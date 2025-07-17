# 🌸 Nazwaazhf Skincare - E-Commerce Platform

**Developed by:** Nazwa Adinda Zhafirah  
**Student ID:** 202312047  
**Email:** zhafirahnazwaadinda@gmail.com  

## 📋 Deskripsi Singkat

Nazwaazhf Skincare adalah platform e-commerce berbasis web yang khusus menyediakan produk perawatan kulit (skincare) dari berbagai brand ternama. Aplikasi ini memungkinkan pengguna untuk menjelajahi produk, menambahkan ke keranjang, melakukan pembelian, dan admin dapat mengelola produk serta pengguna.

**Teknologi yang Digunakan:**
- Frontend: HTML5, CSS3, Bootstrap 5.3.0, JavaScript
- Backend: PHP Native (≥ 7.4)
- Database: MySQL (≥ 5.7)
- Server: Apache (XAMPP)

## 📁 Struktur Folder

```
nazwaazhf_skincare/
├── admin/                      # Panel administrasi
│   ├── dashboard.php           # Dashboard admin
│   ├── manajemen_produk.php    # Kelola produk
│   ├── manajemen_user.php      # Kelola pengguna
│   ├── laporan.php            # Laporan penjualan
│   ├── monitoring.php         # Monitoring sistem
│   ├── pengaturan.php         # Pengaturan aplikasi
│   ├── tambah_user.php        # Tambah pengguna baru
│   ├── edit_user.php          # Edit data pengguna
│   ├── hapus_user.php         # Hapus pengguna
│   ├── user.php               # Manajemen user
│   └── logout.php             # Logout admin
│
├── auth/                       # Sistem autentikasi
│   ├── login.php              # Halaman login
│   └── register.php           # Halaman registrasi
│
├── brand/                      # Halaman produk per brand
│   ├── azarine.php            # Produk Azarine
│   ├── emina.php              # Produk Emina
│   ├── garnier.php            # Produk Garnier
│   ├── glow2glow.php          # Produk Glow2Glow
│   ├── loreal.php             # Produk L'Oreal
│   ├── originote.php          # Produk Originote
│   ├── scarlett.php           # Produk Scarlett
│   └── skintific.php          # Produk Skintific
│
├── assets/                     # Aset statis
│   ├── css/
│   │   └── button-enhancement.css
│   ├── js/
│   │   └── button-enhancement.js
│   └── gambar/                # Gambar produk
│       ├── azarine/
│       ├── emina/
│       ├── garnier/
│       ├── glow2glow/
│       ├── loreal/
│       ├── originote/
│       ├── scarlett/
│       ├── skintific/
│       ├── promo1.jpg
│       ├── promo2.jpg
│       └── promo3.jpg
│
├── docs/                       # Dokumentasi
│   ├── database.md            # Dokumentasi database
│   ├── deployment.md          # Panduan deployment
│   ├── installation.md        # Panduan instalasi
│   └── usage.md               # Panduan penggunaan
│
├── dashboard.php               # Dashboard utama user
├── index.php                   # Halaman utama (redirect)
├── keranjang.php              # Halaman keranjang belanja
├── checkout.php               # Halaman checkout
├── riwayat.php                # Riwayat pembelian
├── alamat.php                 # Manajemen alamat
├── ulasan.php                 # Sistem ulasan produk
├── struk.php                  # Struk pembelian
├── laporan_transaksi.php      # Laporan transaksi
├── tambah_keranjang.php       # Proses tambah ke keranjang
├── simpan_keranjang.php       # Simpan keranjang
├── hapus_keranjang.php        # Hapus item keranjang
├── koneksi.php                # Konfigurasi database
├── hash.php                   # Hash password
├── logout.php                 # Logout pengguna
└── README.MD                  # Dokumentasi proyek
```

## 🛍️ Fitur Utama

### 👥 Untuk Pengguna
- **Katalog Produk**: Jelajahi koleksi skincare dari 8 brand terkenal
- **Keranjang Belanja**: Tambah/hapus produk dari keranjang
- **Checkout**: Proses pembelian yang mudah dan aman
- **Riwayat Pembelian**: Lihat history transaksi
- **Manajemen Alamat**: Kelola alamat pengiriman
- **Sistem Ulasan**: Berikan ulasan untuk produk
- **Struk Digital**: Struk pembelian otomatis

### 🔧 Untuk Administrator
- **Dashboard Admin**: Monitoring sistem secara real-time
- **Manajemen Produk**: CRUD produk skincare
- **Manajemen Pengguna**: Kelola data pengguna
- **Laporan Penjualan**: Analisis transaksi dan penjualan
- **Monitoring Sistem**: Pantau aktivitas aplikasi
- **Pengaturan Aplikasi**: Konfigurasi sistem

## 🎨 Brand yang Tersedia

1. **Azarine** - Skincare halal dengan bahan alami
2. **Emina** - Produk skincare untuk remaja
3. **Garnier** - Perawatan kulit internasional
4. **Glow2Glow** - Skincare untuk kulit glowing
5. **L'Oréal** - Luxury skincare brand
6. **Originote** - Local skincare dengan kualitas premium
7. **Scarlett** - Whitening skincare products
8. **Skintific** - Advanced skincare technology

## 💾 Struktur Database

**Tabel utama:**
- `user` - Data pengguna dan admin
- `produk` - Informasi produk skincare
- `keranjang` - Item dalam keranjang belanja
- `transaksi` - Data pembelian
- `ulasan` - Review produk dari pengguna
- `alamat` - Alamat pengiriman pengguna

## 🔐 Sistem Keamanan

- **Session Management**: Proteksi halaman dengan PHP session
- **Password Hashing**: Enkripsi password pengguna
- **Input Validation**: Validasi data input untuk mencegah SQL injection
- **Role-based Access**: Pembatasan akses berdasarkan peran pengguna

## ⚙️ Instalasi

### 1. Prasyarat
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache via XAMPP recommended)
- Web browser modern

### 2. Setup Database
```sql
-- Buat database baru
CREATE DATABASE skincare;

-- Import struktur database (jika tersedia file SQL)
-- Atau buat tabel sesuai dengan struktur aplikasi
```

### 3. Konfigurasi Koneksi
Edit file `koneksi.php`:
```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "skincare";

$conn = mysqli_connect($host, $user, $pass, $db);
?>
```

### 4. Deployment
1. Pindahkan folder proyek ke `htdocs/` (XAMPP)
2. Aktifkan Apache dan MySQL di XAMPP
3. Akses aplikasi: `http://localhost/nazwaazhf_skincare/`

## 📱 Cara Penggunaan

### Untuk Pengguna:
1. **Registrasi/Login**: Buat akun atau login ke sistem
2. **Browse Produk**: Pilih brand dan lihat produk tersedia
3. **Tambah ke Keranjang**: Klik tombol "Tambah ke Keranjang"
4. **Checkout**: Proses pembelian dan pilih alamat pengiriman
5. **Pembayaran**: Konfirmasi pembelian dan dapatkan struk

### Untuk Admin:
1. **Login Admin**: Akses panel administrasi
2. **Dashboard**: Lihat statistik penjualan dan sistem
3. **Kelola Produk**: Tambah, edit, atau hapus produk
4. **Kelola User**: Manajemen data pengguna
5. **Laporan**: Analisis penjualan dan transaksi

## 🎯 Fitur Khusus

- **Responsive Design**: Tampilan optimal di desktop dan mobile
- **Pink Theme**: Desain feminin yang menarik
- **Hamburger Menu**: Navigasi yang user-friendly
- **Search & Filter**: Pencarian produk yang mudah
- **Real-time Updates**: Update keranjang secara real-time
- **Promotional Banners**: Tampilan promo yang menarik

## 📊 Teknologi & Library

- **Bootstrap 5.3.0**: Framework CSS untuk UI responsif
- **jQuery**: Library JavaScript untuk interaktivitas
- **PHP Native**: Backend processing
- **MySQL**: Database management system
- **CSS3**: Styling dan animasi
- **JavaScript**: Client-side functionality

## 🚀 Pengembangan Masa Depan

- Payment gateway integration
- Email notification system
- Advanced search and filtering
- Mobile app development
- API development untuk integrasi
- Multi-language support

## 📞 Kontak Developer

Untuk pertanyaan atau dukungan teknis:
- **Email**: zhafirahnazwaadinda@gmail.com
- **Developer**: Nazwa Adinda Zhafirah
- **Student ID**: 202312047

## 📝 Lisensi

Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran. Semua hak cipta dilindungi oleh developer.

---

*Dikembangkan dengan ❤️ oleh Nazwa Adinda Zhafirah*






