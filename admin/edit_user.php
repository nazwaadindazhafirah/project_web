<?php
session_start();
include '../koneksi.php';

$id = $_GET['id'];
$user = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id'");
$data = mysqli_fetch_assoc($user);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    mysqli_query($conn, "UPDATE user SET nama='$nama', username='$username', email='$email', level='$level' WHERE id_user='$id'");
    header("Location: manajemen_user.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fff0f5">
<div class="container mt-5">
    <h3 class="mb-4">✏️ Edit Pengguna</h3>
    <form method="post">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Level</label>
            <select name="level" class="form-select" required>
                <option value="user" <?= $data['level'] == 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $data['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="manajemen_user.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
