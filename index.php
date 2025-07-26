<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit;
}
header("Location: auth/login.php");
exit;
?>
