<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id = $_SESSION['id_user'];
$user = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id'");
$data = mysqli_fetch_assoc($user);
$nama = $data['nama'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/button-enhancement.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
        }
        .sidebar {
            background-color: pink;
            padding: 20px;
            min-height: 100vh;
        }
        .sidebar h5 {
            font-size: 16px;
            color: black;
            margin-bottom: 10px;
        }
        .quote {
            font-size: 13px;
            font-style: italic;
            color: deeppink;
            margin-bottom: 20px;
        }
        .icon-kawaii {
            text-align: center;
            margin-bottom: 20px;
        }
        .icon-kawaii img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 5px hotpink;
        }
        .sidebar a {
            display: block;
            margin-bottom: 15px;
            background-color: #ddd;
            padding: 10px;
            border-radius: 10px;
            color: black;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
        }
        .sidebar a:hover {
            background-color: hotpink;
            color: white;
        }
        .brand-buttons {
            padding: 30px;
            text-align: center;
        }
        .brand-buttons h2 {
            color: hotpink;
            margin-bottom: 10px;
        }
        .brand-buttons p {
            color: #cc3399;
            font-weight: bold;
            font-style: italic;
            margin-bottom: 25px;
        }
        .brand-buttons a {
            background-color: hotpink;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 5px;
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
        }
        .brand-buttons a:hover {
            background-color: deeppink;
        }
        .promo-images {
            margin-top: 30px;
            text-align: center;
        }
        .promo-images img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            margin: 10px;
            border: 3px solid pink;
            border-radius: 20px;
            box-shadow: 0 0 10px hotpink;
            transition: 0.3s ease-in-out;
        }
        .promo-images img:hover {
            transform: scale(1.05);
        }
        marquee {
            font-size: 16px;
            color: deeppink;
            margin-bottom: 10px;
        }
        
        /* Hamburger Menu Styles */
        .hamburger-menu {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            cursor: pointer;
        }
        
        .hamburger-btn {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ff69b4, #ff1493);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.3);
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .hamburger-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(255, 105, 180, 0.5);
            background: linear-gradient(135deg, #ff1493, #dc143c);
        }
        
        .hamburger-line {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 2px 0;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        .hamburger-menu:hover .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .hamburger-menu:hover .hamburger-line:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger-menu:hover .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
        
        .nav-dropdown {
            position: absolute;
            top: 60px;
            left: 0;
            background: linear-gradient(135deg, #fff0f5, #ffe6f0);
            min-width: 220px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(255, 105, 180, 0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 105, 180, 0.2);
            backdrop-filter: blur(10px);
            padding: 10px;
        }
        
        .hamburger-menu:hover .nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .nav-dropdown a {
            display: block;
            padding: 12px 20px;
            color: #dc143c;
            text-decoration: none;
            font-weight: 600;
            border-radius: 10px;
            margin: 5px 0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-dropdown a:hover {
            background: linear-gradient(135deg, #ff69b4, #ff1493);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(255, 105, 180, 0.3);
        }
        
        .nav-dropdown a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.1), transparent);
            transition: width 0.3s ease;
        }
        
        .nav-dropdown a:hover::before {
            width: 100%;
        }
        
        .nav-dropdown a i {
            margin-right: 10px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        
        /* Animation for menu items */
        .nav-dropdown a:nth-child(1) { animation-delay: 0.1s; }
        .nav-dropdown a:nth-child(2) { animation-delay: 0.2s; }
        .nav-dropdown a:nth-child(3) { animation-delay: 0.3s; }
        .nav-dropdown a:nth-child(4) { animation-delay: 0.4s; }
        .nav-dropdown a:nth-child(5) { animation-delay: 0.5s; }
        .nav-dropdown a:nth-child(6) { animation-delay: 0.6s; }
        
        .hamburger-menu:hover .nav-dropdown a {
            animation: slideInLeft 0.3s ease forwards;
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Hide sidebar on larger screens when hamburger is active */
        @media (min-width: 768px) {
            .sidebar {
                display: none;
            }
            .col-md-9 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hamburger-btn {
                width: 45px;
                height: 45px;
            }
            
            .nav-dropdown {
                min-width: 200px;
            }
        }
    </style>
</head>
<body>

<!-- Hamburger Menu -->
<div class="hamburger-menu">
    <div class="hamburger-btn">
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
    </div>
    <div class="nav-dropdown">
        <a href="dashboard.php">🏠 Beranda</a>
        <a href="alamat.php">📍 Alamat</a>
        <a href="riwayat.php">📋 Riwayat</a>
        <a href="ulasan.php">⭐ Ulasan</a>
        <a href="laporan_transaksi.php">📊 Laporan Transaksi</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <h5>Halo, <?= htmlspecialchars($nama) ?>!</h5>
            <p class="quote">✨ Rawat kulitmu seperti kamu merawat hati 💕</p>
            <div class="icon-kawaii">
                <img src="assets/gambar/icon1.jpg" alt="icon1">
                <img src="assets/gambar/icon2.jpg" alt="icon2">
            </div>
            <a href="dashboard.php">Beranda</a>
            <a href="alamat.php">Alamat</a>
            <a href="riwayat.php">Riwayat</a>
            <a href="ulasan.php">Ulasan</a>
            <a href="laporan_transaksi.php">Laporan Transaksi</a> <!-- Tambahan tombol laporan -->
            <a href="logout.php">Logout</a>
            <a href="wishlist.php">Wishlist</a>
            <a href="notifikasi.php">Notifikasi</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="brand-buttons">
                <marquee scrollamount="5">✨ Yuk rawat kulitmu mulai dari sekarang bareng Nazwaazhf Skincare! ✨</marquee>
                <h2>Nazwaazhf Skincare - Pilih Brand:</h2>
                <p>Pilih brand favoritmu dan nikmati perawatan kulit terbaik 💕</p>
                <a href="brand/glow2glow.php">Glow2Glow</a>
                <a href="brand/skintific.php">Skintific</a>
                <a href="brand/emina.php">Emina</a>
                <a href="brand/originote.php">Originote</a>
                <a href="brand/garnier.php">Garnier</a>
                <a href="brand/loreal.php">L'Oreal</a>
                <a href="brand/azarine.php">Azarine</a>
                <a href="brand/scarlett.php">Scarlett</a>
            </div>

            <!-- Gambar Promo -->
            <div class="promo-images">
                <img src="assets/gambar/promo1.jpg" alt="Promo 1">
                <img src="assets/gambar/promo2.jpg" alt="Promo 2">
                <img src="assets/gambar/promo3.jpg" alt="Promo 3">
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/button-enhancement.js"></script>
</body>
</html>
