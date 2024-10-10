<?php
session_start(); // Memulai session
include 'koneksi.php'; // Koneksi ke database

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style untuk rating */
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }
        .rating input {
            display: none;
        }
        .rating label {
            font-size: 2rem;
            color: lightgray;
            cursor: pointer;
        }
        .rating input:checked ~ label {
            color: gold;
        }
        .rating label:hover,
        .rating label:hover ~ label {
            color: gold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Rating dan Ulasan</h2>
        <form action="" method="POST">
            <?php
            // Ambil id_buku dari parameter URL
            $id_buku = $_GET['id'] ?? null;

            // Validasi apakah id_buku ada
            if (!$id_buku) {
                echo "<div class='alert alert-danger'>ID Buku tidak valid.</div>";
                exit;
            }

            // Ambil data buku berdasarkan id_buku
            $query = "SELECT * FROM buku WHERE id_buku = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("i", $id_buku);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Pastikan $row tidak null
            if (!$row) {
                echo "<div class='alert alert-danger'>Buku tidak ditemukan.</div>";
                exit;
            }

            // Jika form di-submit
            if (isset($_POST['submit'])) {
                $username = $_SESSION['username']; // Gunakan username dari session
                $rating = $_POST['rating'] ?? null; // Ambil rating
                $ulasan = $_POST['ulasan'] ?? null; // Ambil ulasan

                // Cek user berdasarkan username
                $user_result = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username = '$username'");
                $user_row = mysqli_fetch_assoc($user_result);

                if (!$user_row) {
                    echo "<script>
                            swal('Error!', 'Pengguna tidak ditemukan.', 'error').then(function() {
                                window.location = 'index.php';
                            });
                          </script>";
                } else {
                    $id_user = $user_row['id_user'];

                    // Insert ulasan ke tabel ulasanbuku
                    $query = "INSERT INTO ulasanbuku (id_user, id_buku, ulasan, rating) 
                              VALUES ('$id_user', '$id_buku', '$ulasan', '$rating')";
                    if (mysqli_query($koneksi, $query)) {
                        echo "<script>
                    swal('Success!', 'Terimakasih, ulasan berhasil dikirim!', 'success').then(function() {
                        window.location.href = 'profile.php'; // Redirect ke halaman profile.php
                    });
                </script>";

                    } else {
                        echo "<script>
                                swal('Error!', 'Terjadi kesalahan: " . mysqli_error($koneksi) . "', 'error').then(function() {
                                    window.location = 'index.php';
                                });
                              </script>";
                    }
                }
            }
            ?>

            <div class="d-flex align-items-start mb-3">
                <div class="me-4" style="flex: 1;">
                    <img src="./assets/img/<?= $row['img'] ?>" alt="Gambar Buku" style="max-width: 90%; height: auto;">
                </div>
                <div style="flex: 2;">
                    <h2 class="mb-2"><?= $row['judul'] ?></h2>
                    <p><strong>Penulis:</strong> <?= $row['penulis'] ?></p>
                    <p><strong>Penerbit:</strong> <?= $row['penerbit'] ?></p>
                    <p><strong>Tahun Terbit:</strong> <?= $row['tahun_terbit'] ?></p>
                    <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label"><strong>Username:</strong></label>
                        <input type="text" class="form-control" id="setting-input-2" name="username" required value="<?= $_SESSION['username'] ?>" readonly>
                    </div>

                    <!-- Rating Bintang -->
                    <div class="mb-3">
                        <label for="rating"><strong>Rating:</strong></label>
                        <div class="rating">
                            <input type="radio" name="rating" id="star5" value="5"><label for="star5">★</label>
                            <input type="radio" name="rating" id="star4" value="4"><label for="star4">★</label>
                            <input type="radio" name="rating" id="star3" value="3"><label for="star3">★</label>
                            <input type="radio" name="rating" id="star2" value="2"><label for="star2">★</label>
                            <input type="radio" name="rating" id="star1" value="1"><label for="star1">★</label>
                        </div>
                    </div>
                    <!-- Ulasan -->
                    <div class="mb-3">
                        <label for="ulasan" class="form-label"><strong>Ulasan:</strong></label>
                        <textarea class="form-control" id="ulasan" name="ulasan" rows="4" required placeholder="Tulis ulasan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-danger">Kirim Ulasan</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>