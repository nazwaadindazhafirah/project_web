<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID transaksi tidak ditemukan.";
    exit;
}

$id_transaksi = $_GET['id'];

// Ambil info transaksi
$transaksi = mysqli_query($conn, "
    SELECT t.*, u.nama 
    FROM transaksi t 
    JOIN user u ON t.id_user = u.id_user 
    WHERE t.id_transaksi = $id_transaksi
");
$data_transaksi = mysqli_fetch_assoc($transaksi);

// Ambil detail produk
$detail = mysqli_query($conn, "
    SELECT d.*, p.nama_produk, p.harga 
    FROM detail_transaksi d 
    JOIN produk p ON d.id_produk = p.id_produk 
    WHERE d.id_transaksi = $id_transaksi
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        h2 { color: hotpink; text-align: center; margin-top: 20px; }
        .table th, .table td { vertical-align: middle; }
        .btn-pink {
            background-color: hotpink;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-pink:hover {
            background-color: deeppink;
            color: white;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <a href="dashboard.php" class="btn btn-pink mb-3">⬅ Kembali ke Dashboard</a>

    <h2>Struk Transaksi</h2>

    <p><strong>Nama:</strong> <?= $data_transaksi['nama'] ?></p>
    <p><strong>Metode Pembayaran:</strong> <?= $data_transaksi['metode_pembayaran'] ?></p>
    <p><strong>Tanggal:</strong> <?= $data_transaksi['tanggal'] ?></p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $total = 0;
        while ($row = mysqli_fetch_assoc($detail)):
            $subtotal = $row['jumlah'] * $row['harga_satuan'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?= $row['nama_produk'] ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td>Rp<?= number_format($row['harga_satuan']) ?></td>
                <td>Rp<?= number_format($subtotal) ?></td>
            </tr>
        <?php endwhile; ?>
            <tr>
                <th colspan="3" class="text-end">Total</th>
                <th>Rp<?= number_format($total) ?></th>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
