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

// Ambil data user dari database berdasarkan username yang ada di session
$username = $_SESSION['username'];
$query = "SELECT username, nama_lengkap, email, alamat FROM user WHERE username = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $username);  // "s" berarti string
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Jika data user ditemukan, tampilkan di halaman
if ($userData):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profile</title>
    <link href="assets/img/logo/logobuku.jpg" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <!-- Profile Section -->
    <div class="row">
        <!-- Left Column (Profile Photo and Description) -->
        <div class="col-md-4 d-flex flex-column align-items-center">
            <!-- Profile Icon (Placeholder) -->
            <img src="assets/img/logo/logouser.jpg" alt="Profile Icon" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            <!-- Profile Description -->
            <p class="text-center">
                Halo! Saya seorang pengguna setia dari perpustakaan digital ini.
            </p>
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

<?php else: ?>
    <p>Data pengguna tidak ditemukan.</p>
<?php endif; ?>
    </div>

    <!-- Card Section -->
    <div class="row mt-5">
        <div class="col-md-12">
           <h3><center>Koleksi Buku Kamu</h3>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tulis Ulasan Anda</h5>
                    <p class="card-text">Berikan ulasan mengenai buku yang telah Anda baca.</p>
                    <a href="ulasan.php" class="btn btn-danger">Ulas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
