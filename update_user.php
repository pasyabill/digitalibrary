<?php
include 'koneksi.php'; 

if (isset($_POST['id_user']) && isset($_POST['role'])) {
    $id_user = $_POST['id_user'];
    $role = $_POST['role'];
    $query = "UPDATE user SET role = '$role' WHERE id_user = '$id_user'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Peran pengguna berhasil diperbarui!');
                window.location.href = 'admin.php'; 
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui peran pengguna: " . mysqli_error($koneksi) . "');
                window.location.href = 'admin.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Data tidak lengkap.');
            window.location.href = 'admin.php';
          </script>";
}
?>