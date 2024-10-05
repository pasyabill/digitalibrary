<?php
session_start();

// Menghapus semua variabel session
$_SESSION = array();

// Menghancurkan session
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: login.php");
exit();
?>