<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $id_user = $_SESSION['id_user'];
    $id_produk = $_POST['id_produk'];

    // Cek apakah produk sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user = $id_user AND id_produk = $id_produk");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_user = $id_user AND id_produk = $id_produk");
    } else {
        mysqli_query($conn, "INSERT INTO keranjang (id_user, id_produk, jumlah) VALUES ($id_user, $id_produk, 1)");
    }

    header("Location: keranjang.php");
    exit;
}
?>
