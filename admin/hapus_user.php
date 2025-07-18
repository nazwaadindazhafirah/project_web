<?php
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
header("Location: manajemen_user.php");
exit;
?>
