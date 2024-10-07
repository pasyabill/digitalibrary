<?php
include 'koneksi.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = $_POST['id_buku'];
    $sql = "DELETE FROM buku WHERE id_buku = ?";
    $stmt = $koneksi->prepare($sql); 
    $stmt->bind_param("i", $id_buku);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>