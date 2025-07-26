<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['level']) || $_SESSION['level'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

$users = mysqli_query($conn, "SELECT * FROM user");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff0f5; padding: 30px; }
        .btn-pink { background-color: hotpink; color: white; border: none; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center text-danger mb-4">Manajemen Pengguna</h2>
    <a href="tambah_user.php" class="btn btn-pink mb-3">➕ Tambah Pengguna</a>
    <table class="table table-bordered table-striped">
        <thead class="table-danger">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['level']) ?></td>
                <td>
                    <a href="hapus_user.php?id=<?= $row['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>