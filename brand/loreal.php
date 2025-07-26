<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../index.php");
    exit;
}

// Ambil produk dengan brand 'Loreal' dari tabel produk
$produk = mysqli_query($conn, "SELECT * FROM produk WHERE brand = 'Loreal'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Produk Loreal - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        h2 { color: hotpink; text-align: center; margin-bottom: 20px; font-weight: bold; }
        .card {
            border: 2px solid pink;
            box-shadow: 0 0 10px pink;
            border-radius: 15px;
            height: 100%;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.03);
        }
        .card-title { color: deeppink; font-weight: bold; }
        .produk-img {
            height: 230px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            width: 100%;
        }
        .btn-pink {
            background-color: hotpink;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-pink:hover {
            background-color: deeppink;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <a href="../dashboard.php" class="btn btn-pink mb-3">⬅ Kembali ke Dashboard</a>
    <h2>Produk Loreal</h2>
    <div class="row">
        <?php if (mysqli_num_rows($produk) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($produk)): ?>
            <div class="col-md-4 mb-4 d-flex">
                <div class="card flex-fill">
                    <img src="../assets/gambar/loreal/<?= $row['gambar'] ?>" class="produk-img card-img-top" alt="<?= $row['nama_produk'] ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $row['nama_produk'] ?></h5>
                        <p class="card-text"><?= $row['deskripsi'] ?></p>
                        <form action="../tambah_keranjang.php" method="post" class="mt-auto">
                            <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                            <button type="submit" name="tambah" class="btn btn-pink w-100">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-danger">Produk Loreal tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
