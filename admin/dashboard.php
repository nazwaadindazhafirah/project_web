<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/button-enhancement.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        .header {
            background-color: pink;
            color: deeppink;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .container { margin-top: 30px; }
        .table th { background-color: hotpink; color: white; }
        .table td { background-color: #ffe6f0; }
        .menu-btns {
            text-align: center;
            margin: 20px 0;
        }
        .menu-btns a {
            margin: 5px;
            padding: 8px 15px;
            border-radius: 10px;
            background-color: deeppink;
            color: white;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }
        .menu-btns a:hover {
            background-color: hotpink;
        }
    </style>
</head>
<body>

<div class="header">
    Selamat Datang, Admin! 🌸
</div>

<div class="container">
    <div class="menu-btns">
        <a href="laporan.php">📊 Laporan Transaksi</a>
        <a href="manajemen_user.php">👤 Manajemen User</a>
        <a href="monitoring.php">📋 Monitoring</a>
        <a href="pengaturan.php">⚙️ Pengaturan</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <h3 class="text-center text-deeppink mb-4">Data Stok Produk</h3>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Brand</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $produk = mysqli_query($conn, "SELECT * FROM produk");
            while ($row = mysqli_fetch_assoc($produk)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td><?= htmlspecialchars($row['brand']) ?></td>
                <td><?= $row['stok'] ?></td>
                <td>Rp<?= number_format($row['harga']) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
