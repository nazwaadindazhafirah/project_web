<?php
session_start();
include '../koneksi.php';

$id_user = $_SESSION['user']['id_user'];
$query = "SELECT * FROM notifikasi WHERE id_user = $id_user ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Notifikasi</title>
  <style>
    body { font-family: Arial; background: #fff0f5; padding: 20px; }
    h2 { color: #ff3399; }
    .notif { background: white; border-left: 5px solid #ff99cc; padding: 10px; margin: 10px 0; border-radius: 8px; box-shadow: 0 0 5px pink; }
    .btn-kembali {
      background: #ff66a3; color: white; padding: 10px 15px;
      text-decoration: none; border-radius: 8px;
    }
  </style>
</head>
<body>
  <h2>🔔 Notifikasi</h2>
  <a href="dashboard.php" class="btn-kembali">← Kembali ke Dashboard</a><br><br>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="notif">
      <strong><?= $row['tanggal'] ?></strong><br>
      <?= $row['pesan'] ?>
    </div>
  <?php } ?>
</body>
</html>
