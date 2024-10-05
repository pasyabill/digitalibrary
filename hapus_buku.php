<?php
// Sertakan file koneksi
include 'koneksi.php'; // pastikan jalur benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil id_buku dari form
    $id_buku = $_POST['id_buku'];

    // Query untuk menghapus buku berdasarkan id_buku
    $sql = "DELETE FROM buku WHERE id_buku = ?";
    $stmt = $koneksi->prepare($sql); // pastikan $conn terdefinisi
    $stmt->bind_param("i", $id_buku);

    if ($stmt->execute()) {
        // Setelah penghapusan berhasil, arahkan kembali ke halaman daftar buku dengan pesan sukses
        header("Location: admin.php");
    } else {
        // Jika ada kesalahan saat menghapus data
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
