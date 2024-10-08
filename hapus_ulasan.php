<?php
include 'koneksi.php'; 

if (isset($_GET['id_ulasan'])) {
    $id_ulasan = $_GET['id_ulasan'];
    $query = "DELETE FROM ulasanbuku WHERE id_ulasan = '$id_ulasan'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Ulasan berhasil dihapus!');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus ulasan: " . mysqli_error($koneksi) . "');
                window.location.href = 'admin.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID Ulasan tidak ditemukan.');
            window.location.href = 'admin.php';
          </script>";
}
?>