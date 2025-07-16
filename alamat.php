<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Simpan alamat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    mysqli_query($conn, "UPDATE user SET alamat = '$alamat' WHERE id_user = $id_user");
    header("Location: dashboard.php");
    exit;
}

// Ambil alamat sekarang
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT alamat FROM user WHERE id_user = $id_user"));
$alamat = $data['alamat'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alamat Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; padding: 30px; }
        .btn-pink { background-color: hotpink; color: white; border: none; }
    </style>
</head>
<body>
<div class="container">
    <a href="dashboard.php" class="btn btn-pink mb-3">⬅ Kembali ke Dashboard</a>
    <h3 class="text-center" style="color:deeppink">Alamat Pengiriman</h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="4" required><?= htmlspecialchars($alamat) ?></textarea>
        </div>
        <button type="submit" class="btn btn-pink w-100">Simpan Alamat</button>
    </form>
</div>
</body>
</html>
