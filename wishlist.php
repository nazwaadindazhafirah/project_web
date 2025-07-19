<?php
session_start();
include '../koneksi.php';

$id_user = $_SESSION['user']['id_user'];
$query = "SELECT produk.nama_produk, produk.harga, produk.gambar FROM wishlist 
          JOIN produk ON wishlist.id_produk = produk.id_produk 
          WHERE wishlist.id_user = $id_user";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Wishlist</title>
  <style>
    body { font-family: Arial; background: #ffe6f0; padding: 20px; }
    h2 { color: #ff3399; }
    .produk { background: white; border-radius: 10px; padding: 10px; margin: 10px 0; box-shadow: 0 0 5px pink; }
    .btn-kembali {
      background: #ff66a3; color: white; padding: 10px 15px;
      text-decoration: none; border-radius: 8px;
    }
  </style>
</head>
<body>
  <h2>💖 Wishlist Kamu</h2>
  <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a><br><br>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="produk">
      <strong><?= $row['nama_produk'] ?></strong><br>
      Harga: Rp<?= number_format($row['harga']) ?><br>
      <img src="../gambar/<?= $row['gambar'] ?>" width="100" alt="Gambar produk">
    </div>
  <?php } ?>
</body>
</html>
