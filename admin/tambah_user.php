<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $level = $_POST['level'];

    $query = "INSERT INTO user (nama, username, email, password, level) 
              VALUES ('$nama', '$username', '$email', '$password', '$level')";
    mysqli_query($conn, $query);
    header("Location: manajemen_user.php");
    exit;
}
?>

<h2>Tambah Pengguna</h2>
<form method="POST">
    <input name="nama" placeholder="Nama" required><br>
    <input name="username" placeholder="Username" required><br>
    <input name="email" placeholder="Email" required><br>
    <input name="password" type="password" placeholder="Password" required><br>
    <select name="level">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select><br>
    <button type="submit">Simpan</button>
</form>
