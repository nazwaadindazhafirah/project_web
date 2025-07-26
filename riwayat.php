<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil semua transaksi user
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_user = $id_user ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        h2 { color: deeppink; text-align: center; margin: 20px 0; }
        .btn-pink { background-color: hotpink; border: none; color: white; }
    </style>
</head>
<body>
<div class="container mt-4">
    <a href="dashboard.php" class="btn btn-pink mb-3">⬅ Kembali ke Dashboard</a>
    <h2>Riwayat Transaksi</h2>

    <?php while ($row = mysqli_fetch_assoc($transaksi)): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Transaksi Tanggal: <?= $row['tanggal'] ?></h5>
                <p><strong>Metode Pembayaran:</strong> <?= $row['metode_pembayaran'] ?></p>
                <p><strong>Total:</strong> Rp<?= number_format($row['total']) ?></p>

                <ul>
                    <?php
                    // Ambil detail produk dari transaksi ini
                    $detail = mysqli_query($conn, "SELECT dt.*, p.nama_produk 
                        FROM detail_transaksi dt 
                        JOIN produk p ON dt.id_produk = p.id_produk 
                        WHERE dt.id_transaksi = {$row['id_transaksi']}");

                    while ($d = mysqli_fetch_assoc($detail)):
                    ?>
                        <li><?= $d['nama_produk'] ?> (<?= $d['jumlah'] ?> pcs)</li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
