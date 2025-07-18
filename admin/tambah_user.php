<?php include("../koneksi.php"); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0;
            padding: 20px;
        }
        input, select {
            padding: 8px;
            margin-bottom: 10px;
            width: 300px;
        }
        .btn {
            background-color: #ff66a3;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
        }
        .back {
            background-color: #999;
        }
    </style>
</head>
<body>
    <h2>Tambah User</h2>
    <form action="" method="POST">
        Nama:<br><input type="text" name="nama" required><br>
        Email:<br><input type="email" name="email" required><br>
        Password:<br><input type="password" name="password" required><br>
        Role:<br>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br>
        <button class="btn" type="submit" name="simpan">Simpan</button>
        <a class="btn back" href="manajemen_user.php">← Kembali</a>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $role = $_POST['role'];
        mysqli_query($conn, "INSERT INTO user (nama, email, password, role) VALUES ('$nama', '$email', '$pass', '$role')");
        echo "<script>alert('User berhasil ditambahkan'); window.location='manajemen_user.php';</script>";
    }
    ?>
</body>
</html>
