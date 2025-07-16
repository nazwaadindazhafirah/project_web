<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id'");
header("Location: keranjang.php");
exit;
