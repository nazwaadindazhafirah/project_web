<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$metode = $_POST['metode'];
$total = $_POST['total'];
$tanggal = date('Y-m-d H:i:s');

// Simpan ke tabel transaksi
mysqli_query($conn, "INSERT INTO transaksi (id_user, metode_pembayaran, total, tanggal) 
    VALUES ($id_user, '$metode', $total, '$tanggal')");

// Ambil ID transaksi terakhir
$id_transaksi = mysqli_insert_id($conn);

// Ambil isi keranjang
$items = mysqli_query($conn, "
    SELECT k.*, p.harga 
    FROM keranjang k 
    JOIN produk p ON k.id_produk = p.id_produk 
    WHERE k.id_user = $id_user
");

// Simpan ke tabel detail_transaksi
while ($row = mysqli_fetch_assoc($items)) {
    $id_produk = $row['id_produk'];
    $jumlah = $row['jumlah'];
    $harga_satuan = $row['harga'];

    mysqli_query($conn, "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah, harga_satuan) 
        VALUES ($id_transaksi, $id_produk, $jumlah, $harga_satuan)");
}

// Kosongkan keranjang
mysqli_query($conn, "DELETE FROM keranjang WHERE id_user = $id_user");

// Redirect ke struk
header("Location: struk.php?id=$id_transaksi");
exit;
?>
