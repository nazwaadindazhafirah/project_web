<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$nama_user = '';
$user = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id_user'");
if ($row = mysqli_fetch_assoc($user)) {
    $nama_user = $row['nama'];
}

// Proses kirim ulasan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['isi_ulasan'])) {
    $isi_ulasan = mysqli_real_escape_string($conn, $_POST['isi_ulasan']);
    mysqli_query($conn, "INSERT INTO ulasan (id_user, isi_ulasan) VALUES ('$id_user', '$isi_ulasan')");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ulasan - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: 'Segoe UI', sans-serif;
        }
        h2, h4 {
            color: deeppink;
            text-align: center;
            margin: 20px 0;
        }
        .btn-pink {
            background-color: hotpink;
            border: none;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 10px;
        }
        .btn-pink:hover {
            background-color: deeppink;
        }
        .ulasan-box {
            border: 2px solid pink;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            margin-bottom: 15px;
            box-shadow: 0 0 8px rgba(255, 105, 180, 0.3);
        }
        .ulasan-box h6 {
            color: deeppink;
            margin-bottom: 5px;
        }
        textarea.form-control {
            border: 2px solid pink;
            border-radius: 10px;
            box-shadow: 0 0 5px pink;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <a href="dashboard.php" class="btn btn-pink mb-3">⬅ Kembali ke Dashboard</a>
    <h2>Berikan Ulasanmu ✨</h2>

    <!-- Form Ulasan -->
    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="isi_ulasan" class="form-label">Tulis Ulasan Kamu</label>
            <textarea class="form-control" id="isi_ulasan" name="isi_ulasan" rows="3" required placeholder="Ceritakan pengalamanmu dengan skincare kami..."></textarea>
        </div>
        <button type="submit" class="btn btn-pink">🌸 Kirim Ulasan</button>
    </form>

    <!-- Daftar Ulasan -->
    <h4 class="mb-3">Ulasan Kamu Sebelumnya:</h4>
    <?php
    $ulasan = mysqli_query($conn, "SELECT * FROM ulasan WHERE id_user = '$id_user' ORDER BY tanggal DESC");
    if (mysqli_num_rows($ulasan) > 0):
        while ($u = mysqli_fetch_assoc($ulasan)):
    ?>
        <div class="ulasan-box">
            <h6><?= date('d-m-Y H:i', strtotime($u['tanggal'])) ?></h6>
            <p><?= nl2br(htmlspecialchars($u['isi_ulasan'])) ?></p>
        </div>
    <?php endwhile; else: ?>
        <p class="text-muted text-center">Belum ada ulasan yang kamu kirimkan 😊</p>
    <?php endif; ?>
</div>

</body>
</html>
