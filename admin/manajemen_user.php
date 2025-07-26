<?php include("../koneksi.php"); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0;
            padding: 20px;
        }
        h2 {
            color: #cc3366;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #ff99cc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #ffb3d1;
        }
        a {
            color: #cc0066;
            text-decoration: none;
            margin: 0 5px;
        }
        .btn {
            padding: 8px 15px;
            background-color: #ff66a3;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .back {
            background-color: #999;
        }
    </style>
</head>
<body>
    <h2>Manajemen User</h2>
    <a class="btn" href="tambah_user.php">+ Tambah User</a>
    <a class="btn back" href="dashboard.php">← Kembali ke Dashboard</a>
    <br><br>

    <table>
        <tr>
            <th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM user");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['id_user']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['email']}</td>
                <td>{$row['role']}</td>
                <td>
                    <a href='edit_user.php?id_user={$row['id_user']}'>Edit</a> |
                    <a href='hapus_user.php?id_user={$row['id_user']}' onclick=\"return confirm('Yakin mau hapus?')\">Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
