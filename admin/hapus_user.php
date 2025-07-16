<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['id_user']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM user WHERE id_user=$id");
header("Location: manajemen_user.php");
