<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
include 'koneksi.php';
if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];
    $query = "UPDATE peminjaman 
              SET status_peminjaman = 'returned', tanggal_pengembalian = NOW(), pdf_access = NULL 
              WHERE id_peminjaman = ?";
    
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_peminjaman);
    
    if ($stmt->execute()) {
        echo "Buku berhasil dikembalikan. Akses ke PDF telah dihentikan.";
        echo "<meta http-equiv='refresh' content='2;url=admin.php'>";
    } else {
        echo "Terjadi kesalahan saat memproses pengembalian buku: " . $stmt->error;
    }
} else {
    header("Location: admin.php");
    exit();
}
?>