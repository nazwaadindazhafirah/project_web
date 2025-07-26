<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil isi keranjang user
$items = mysqli_query($conn, "SELECT k.*, p.nama_produk, p.harga, p.gambar, p.brand 
    FROM keranjang k 
    JOIN produk p ON k.id_produk = p.id_produk 
    WHERE k.id_user = $id_user");

$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/button-enhancement.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        h2 { color: deeppink; text-align: center; margin-top: 20px; }
        .btn-pink { background-color: hotpink; border: none; color: white; }
        .btn-pink:hover { background-color: deeppink; }
        .table th, .table td { vertical-align: middle; }
    </style>
</head>
<body>
<div class="container mt-4">
    <a href="dashboard.php" class="btn btn-pink mb-3">⬅ Kembali ke Beranda</a>
    <h2>Keranjang Belanja</h2>
    <?php if (mysqli_num_rows($items) > 0): ?>
    <form method="post" action="checkout.php">
        <table class="table table-bordered align-middle">
            <thead>
                <tr class="table-pink">
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($items)): 
                $subtotal = $row['harga'] * $row['jumlah'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><img src="assets/gambar/<?= $row['brand'] ?>/<?= $row['gambar'] ?>" width="80"></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td>Rp<?= number_format($row['harga']) ?></td>
                    <td>Rp<?= number_format($subtotal) ?></td>
                </tr>
            <?php endwhile; ?>
                <tr>
                    <th colspan="4" class="text-end">Total</th>
                    <th>Rp<?= number_format($total) ?></th>
                </tr>
            </tbody>
        </table>

        <div class="mb-3">
            <label for="metode" class="form-label">Metode Pembayaran</label>
            <select class="form-select" name="metode" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="COD">Bayar di Tempat (COD)</option>
                <option value="E-Wallet">E-Wallet (Dana, Gopay, dll)</option>
            </select>
        </div>

        <input type="hidden" name="total" value="<?= $total ?>">
        <button type="submit" name="checkout" class="btn btn-pink w-100">Checkout Sekarang</button>
    </form>
    <?php else: ?>
        <p class="text-center text-muted">Keranjang kamu masih kosong 😢</p>
    <?php endif; ?>
    <a href="dashboard.php" class="btn btn-pink mt-4">⬅ Kembali ke Beranda</a>
</div>
</body>
</html>
