<?php
include 'koneksi.php';
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $query = "DELETE FROM user WHERE id_user = '$id_user'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Pengguna berhasil dihapus!');
                window.location.href = 'admin.php'; 
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus pengguna: " . mysqli_error($koneksi) . "');
                window.location.href = 'admin.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID Pengguna tidak ditemukan.');
            window.location.href = 'admin.php'; 
          </script>";
}
?>