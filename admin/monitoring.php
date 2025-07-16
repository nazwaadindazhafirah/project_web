<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Aktivitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-back {
            background-color: deeppink;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: hotpink;
        }
        ul li {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #fff0f5">
<div class="container mt-5">
    <a href="dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>
    <h2 class="text-center text-primary">Monitoring Aktivitas</h2>
    <p class="text-center">Fitur ini akan menampilkan aktivitas user seperti login, pembelian, dan interaksi lainnya. (simulasi)</p>
    <ul>
        <li>Admin login - <?= date('Y-m-d H:i:s') ?></li>
        <li>User "Nazwa" melakukan checkout</li>
        <li>User "Hikma" logout</li>
        <li>User "Aulia" memberikan ulasan produk</li>
        <li>User "Fadli" mengganti alamat pengiriman</li>
    </ul>
</div>
</body>
</html>
