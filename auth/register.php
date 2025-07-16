<?php
session_start();
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 👇 PERBAIKI DISINI
    $query = "INSERT INTO user (nama, username, email, password, level) 
              VALUES ('$nama', '$username', '$email', '$password', 'user')";

    if (mysqli_query($conn, $query)) {
        header("Location: login.php");
        exit;
    } else {
        echo "Gagal mendaftar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/button-enhancement.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            font-family: Arial, sans-serif;
        }
        .register-box {
            width: 400px;
            margin: 80px auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px hotpink;
        }
        h2 {
            text-align: center;
            color: hotpink;
            margin-bottom: 25px;
        }
        .btn-pink {
            background-color: hotpink;
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-pink:hover {
            background-color: deeppink;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Registrasi Akun</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-pink w-100">Daftar</button>
        <p class="mt-3 text-center">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </form>
</div>

</body>
</html>
