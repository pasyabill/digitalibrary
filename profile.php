<?php
// Mulai session
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include koneksi ke database dari koneksi.php
include 'koneksi.php';

// Ambil data user dari database berdasarkan username yang ada di session, pastikan juga untuk mengambil id_user
$username = $_SESSION['username'];
$query = "SELECT id_user, username, nama_lengkap, email, alamat FROM user WHERE username = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $username);  // "s" berarti string
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Ambil ID user
$id_user = $userData['id_user'];

// Ambil data peminjaman yang sudah disetujui dan PDF yang bisa diakses
$pdfQuery = "SELECT b.judul, p.pdf_access, p.tanggal_pengembalian, p.id_peminjaman, b.id_buku
             FROM peminjaman p
             JOIN buku b ON p.id_buku = b.id_buku
             WHERE p.id_user = ? AND p.status_peminjaman = 'approved' AND p.pdf_access IS NOT NULL";
$pdfStmt = $koneksi->prepare($pdfQuery);
$pdfStmt->bind_param("i", $id_user); // i for integer
$pdfStmt->execute();
$pdfResult = $pdfStmt->get_result();
$pdfs = $pdfResult->fetch_all(MYSQLI_ASSOC);

// Ambil koleksi pribadi user dari koleksipribadi
$koleksiQuery = "SELECT b.judul, b.penulis, b.penerbit, b.tahun_terbit, b.img
                 FROM koleksipribadi kp
                 JOIN buku b ON kp.id_buku = b.id_buku
                 WHERE kp.id_user = ?";
$koleksiStmt = $koneksi->prepare($koleksiQuery);
$koleksiStmt->bind_param("i", $id_user); // i for integer
$koleksiStmt->execute();
$koleksiResult = $koleksiStmt->get_result();
$koleksi = $koleksiResult->fetch_all(MYSQLI_ASSOC);

// Jika data user ditemukan, tampilkan di halaman
if ($userData):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Pengguna</title>
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <!-- Profile Section -->
    <div class="row">
        <!-- Left Column (Profile Photo and Description) -->
        <div class="col-md-4 d-flex flex-column align-items-center">
            <img src="assets/img/logo/logouser.jpg" alt="Profile Icon" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            <p class="text-center">Halo! Saya seorang pengguna setia dari perpustakaan digital ini.</p>
        </div>

        <!-- Right Column (User Data) -->
        <div class="col-md-8">
            <h3>Data Diri</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Username:</strong> <?= htmlspecialchars($userData['username']) ?></li>
                <li class="list-group-item"><strong>Nama Lengkap:</strong> <?= htmlspecialchars($userData['nama_lengkap']) ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($userData['email']) ?></li>
                <li class="list-group-item"><strong>Alamat:</strong> <?= htmlspecialchars($userData['alamat']) ?></li>
            </ul>
        </div>
    </div>

    <!-- PDF Books Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3><center>Buku Bacaan Kamu</center></h3>
            <?php if (count($pdfs) > 0): ?>
                <?php foreach ($pdfs as $pdf): ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($pdf['judul']) ?></h5>
                            <p class="card-text">Tanggal Pengembalian: <?= date('d-m-Y', strtotime($pdf['tanggal_pengembalian'])) ?></p>
                            
                            <!-- Tombol Baca PDF -->
                            <a href="baca.php?id=<?php echo $pdf['id_peminjaman']; ?>" class="btn btn-danger">Baca PDF</a>
                            
                            <!-- Tombol Berikan Ulasan -->
                            <a href="ulasan.php?id=<?= $pdf['id_buku'] ?>" class="btn btn-warning">Berikan Ulasan</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Anda belum memiliki buku yang dapat diakses saat ini.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Koleksi Pribadi Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3><center>Koleksi Pribadi</center></h3>
            <?php if (count($koleksi) > 0): ?>
                <div class="row">
                    <?php foreach ($koleksi as $item): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="./assets/img/<?= $item['img'] ?>" class="card-img-top" alt="Cover Buku">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($item['judul']) ?></h5>
                                    <p class="card-text">Penulis: <?= htmlspecialchars($item['penulis']) ?></p>
                                    <p class="card-text">Penerbit: <?= htmlspecialchars($item['penerbit']) ?></p>
                                    <p class="card-text">Tahun Terbit: <?= htmlspecialchars($item['tahun_terbit']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Anda belum memiliki koleksi buku.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php else: ?>
    <p>Data pengguna tidak ditemukan.</p>
<?php endif; ?>