<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['id_user']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

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
            margin-bottom: 20px;
        }

        th {
            background-color: pink;
            color: white;
        }

        .btn-back {
            margin: 15px;
            background-color: deeppink;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: hotpink;
        }

        table {
            background-color: white;
        }
    </style>
</head>
<body>

<a href="dashboard.php" class="btn-back">⬅ Kembali ke Dashboard</a>

<div class="container mt-3">
    <h2>Manajemen User</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-4">
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
</div>

</body>
</html>
