<?php
session_start();
include '../koneksi.php';

$error = ''; // Default tidak ada error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['level']   = $row['level'];

            // Redirect berdasarkan level user
            if ($row['level'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../dashboard.php");
            }
            exit;
        } else {
            $error = "⚠️ Password salah!";
        }
    } else {
        $error = "⚠️ Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/button-enhancement.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6f0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px pink;
            width: 100%;
            max-width: 400px;
        }
        .login-card h2 {
            color: deeppink;
            text-align: center;
            margin-bottom: 25px;
        }
        .btn-pink {
            background-color: hotpink;
            color: white;
            border: none;
        }
        .btn-pink:hover {
            background-color: deeppink;
        }
        .form-control {
            border-radius: 10px;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form class="login-card" method="post">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required autocomplete="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" class="form-control" name="password" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-pink w-100">Login</button>
        <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar</a></p>
    </form>
</body>
</html>
