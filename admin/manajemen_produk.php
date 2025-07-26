<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
include '../koneksi.php';

// Tambah produk
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_produk'];
    $brand = $_POST['brand'];
    $deskripsi = $_POST['deskripsi'];
    mysqli_query($conn, "INSERT INTO produk (nama_produk, brand, deskripsi) VALUES ('$nama','$brand','$deskripsi')");
    header("Location: manajemen_produk.php");
    exit;
}

// Hapus produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");
    header("Location: manajemen_produk.php");
    exit;
}

// Data produk
$data = mysqli_query($conn, "SELECT * FROM produk ORDER BY brand");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; }
        h2 { color: deeppink; margin-top: 20px; text-align: center; }
        .btn-pink { background: hotpink; border: none; color: white; }
        .table th { background: pink; color: white; }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Manajemen Produk</h2>

    <form class="row g-3 mt-3" method="post">
        <div class="col-md-3"><input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" required></div>
        <div class="col-md-3"><input type="text" name="brand" class="form-control" placeholder="Brand" required></div>
        <div class="col-md-4"><input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Produk" required></div>
        <div class="col-md-2"><button type="submit" name="tambah" class="btn btn-pink w-100">Tambah</button></div>
    </form>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th><th>Nama Produk</th><th>Brand</th><th>Deskripsi</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_produk'] ?></td>
                <td><?= $row['brand'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td>
                    <a href="?hapus=<?= $row['id_produk'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>
</body>
</html>
