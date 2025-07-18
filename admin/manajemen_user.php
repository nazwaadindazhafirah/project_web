<?php
session_start();
include '../koneksi.php';

// Proteksi halaman: hanya admin yang bisa mengakses
if (!isset($_SESSION['id_user']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil data user dari database
$users = mysqli_query($conn, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: Arial, sans-serif;
        }
        h2 {
            color: deeppink;
            text-align: center;
            margin-top: 30px;
        }
        th {
            background-color: pink;
            color: white;
            text-align: center;
        }
        td {
            text-align: center;
        }
        .btn-back {
            margin: 20px;
            background-color: deeppink;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: hotpink;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<a href="dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>

<div class="container mt-3">
    <h2>Daftar User Terdaftar</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($u = mysqli_fetch_assoc($users)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($u['nama']) ?></td>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['level']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
