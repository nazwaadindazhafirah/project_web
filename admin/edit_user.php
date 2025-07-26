<?php include("../koneksi.php"); ?>
<?php
$id = $_GET['id_user'];
$result = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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
    <h2>Edit User</h2>
    <form method="POST">
        Nama:<br><input type="text" name="nama" value="<?= $data['nama']; ?>"><br>
        Email:<br><input type="email" name="email" value="<?= $data['email']; ?>"><br>
        Password:<br><input type="text" name="password" value="<?= $data['password']; ?>"><br>
        Role:<br>
        <select name="role">
            <option value="admin" <?= ($data['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="user" <?= ($data['role'] == 'user') ? 'selected' : '' ?>>User</option>
        </select><br>
        <button class="btn" type="submit" name="update">Update</button>
        <a class="btn back" href="manajemen_user.php">← Kembali</a>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $role = $_POST['role'];
        mysqli_query($conn, "UPDATE user SET nama='$nama', email='$email', password='$pass', role='$role' WHERE id_user='$id'");
        echo "<script>alert('User berhasil diupdate'); window.location='manajemen_user.php';</script>";
    }
    ?>
</body>
</html>
