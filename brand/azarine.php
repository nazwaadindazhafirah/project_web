<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit;
}
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE brand = 'Azarine'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Azarine - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        h2 { color: hotpink; text-align: center; margin-bottom: 20px; }
        .card { border: 2px solid pink; box-shadow: 0 0 10px pink; border-radius: 15px; }
        .card-title { color: deeppink; }
        .produk-img { height: 200px; object-fit: cover; border-top-left-radius: 15px; border-top-right-radius: 15px; }
        .btn-pink { background-color: hotpink; border: none; color: white; }
    </style>
</head>
<body>
<div class="container mt-4">
    <a href="../dashboard.php" class="btn btn-pink mb-3">⬅ Kembali ke Dashboard</a>
    <h2>Produk Azarine</h2>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($produk)): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../assets/gambar/azarine/<?= $row['gambar'] ?>" class="produk-img card-img-top" alt="<?= $row['nama_produk'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['nama_produk'] ?></h5>
                    <p class="card-text"><?= $row['deskripsi'] ?></p>
                    <form action="../tambah_keranjang.php" method="post">
                        <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                        <button type="submit" name="tambah" class="btn btn-pink w-100">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
