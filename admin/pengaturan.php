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
    <title>Pengaturan Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-back {
            background-color: deeppink;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background-color: hotpink;
        }
    </style>
</head>
<body style="background-color: #fff0f5">
<div class="container mt-5">
    <a href="dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>
    <h2 class="text-center">Pengaturan Sistem</h2>
    <form>
        <div class="mb-3">
            <label>Nama Aplikasi</label>
            <input type="text" class="form-control" value="Nazwaazhf Skincare">
        </div>
        <div class="mb-3">
            <label>Warna Tema</label>
            <select class="form-control">
                <option selected>Pink</option>
                <option>Ungu</option>
                <option>Biru</option>
            </select>
        </div>
        <button class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>
