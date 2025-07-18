<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id_user = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    mysqli_query($conn, "UPDATE user SET 
        nama='$nama', username='$username', email='$email', level='$level' 
        WHERE id_user=$id");

    header("Location: manajemen_user.php");
    exit;
}
?>

<h2>Edit Pengguna</h2>
<form method="POST">
    <input name="nama" value="<?= $data['nama'] ?>"><br>
    <input name="username" value="<?= $data['username'] ?>"><br>
    <input name="email" value="<?= $data['email'] ?>"><br>
    <select name="level">
        <option value="admin" <?= $data['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $data['level'] == 'user' ? 'selected' : '' ?>>User</option>
    </select><br>
    <button type="submit">Update</button>
</form>
