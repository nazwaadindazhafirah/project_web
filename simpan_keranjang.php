<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_produk = $_POST['id_produk'];
$jumlah = $_POST['jumlah'];

// Cek apakah produk sudah ada di keranjang
$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user = '$id_user' AND id_produk = '$id_produk'");

if (mysqli_num_rows($cek) > 0) {
    // Update jumlah
    mysqli_query($conn, "UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE id_user = '$id_user' AND id_produk = '$id_produk'");
} else {
    // Insert baru
    mysqli_query($conn, "INSERT INTO keranjang (id_user, id_produk, jumlah) VALUES ('$id_user', '$id_produk', '$jumlah')");
}

header("Location: keranjang.php");
exit;
