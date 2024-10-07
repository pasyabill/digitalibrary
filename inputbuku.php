<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    <title>Input Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Input Buku</h2>
        <form action="" method="POST" enctype="multipart/form-data"> <!-- Tambahkan enctype -->
            <div class="mb-3">
                <label for="id_buku" class="form-label">Id Buku</label>
                <input type="text" class="form-control" id="id_buku" name="id_buku" placeholder="Masukkan id buku" required>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul buku" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan nama penulis" required>
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" required>
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select col-12" name="kategori">
                    <option selected="" value="option-1">Pilih Kategori</option>
                    <option value="novel">Novel</option>
                    <option value="komik">Komik</option>
                    <option value="ensiklopedi">Ensiklopedi</option>
                    <option value="majalah">Majalah</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar</label>
                <input class="form-control" id="img" type="file" accept="image/png, image/gif, image/jpeg" name="img">
            </div>
            <div class="mb-3">
                <label for="file_pdf" class="form-label">Upload PDF Buku</label>
                <input class="form-control" id="file_pdf" type="file" accept="application/pdf" name="file_pdf">
            </div>

            <button type="submit" name="submit" class="btn btn-danger">Submit</button>
        </form>

        <?php
if (isset($_POST['submit'])){
    include 'koneksi.php';

    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $kategori = $_POST['kategori'];

    // File upload handling
    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $pdf = $_FILES['file_pdf']['name'];
    $pdf_tmp = $_FILES['file_pdf']['tmp_name'];

    // Correcting the target paths
    $img_target = __DIR__ . "/assets/img/" . basename($img);  // Absolute path for image
    $pdf_target = __DIR__ . "/assets/pdf/" . basename($pdf);  // Absolute path for PDF

    // Check if directories exist, if not create them
    if (!file_exists(__DIR__ . '/assets/img')) {
        mkdir(__DIR__ . '/assets/img', 0777, true);  // Create folder if it doesn't exist
    }
    if (!file_exists(__DIR__ . '/assets/pdf')) {
        mkdir(__DIR__ . '/assets/pdf', 0777, true);  // Create folder if it doesn't exist
    }

    // Move the uploaded files to the correct location
    if (move_uploaded_file($img_tmp, $img_target) && move_uploaded_file($pdf_tmp, $pdf_target)) {
        $sql = "INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `status`, `kategori`, `img`, `file_buku`) 
                VALUES ('$id_buku', '$judul', '$penulis', '$penerbit', '$tahun_terbit', 'tersedia', '$kategori', '$img', '$pdf');";
        
        $query = mysqli_query($koneksi, $sql);
        if ($query) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Data gagal disimpan.";
        }
    } else {
        echo "Gagal mengupload file.";
    }
}
?>

    </div>

    <!-- Bootstrap JS (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>