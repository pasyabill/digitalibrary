<?php
require('koneksi.php'); // Koneksi ke database
session_start();

// Jika form disubmit, proses input
if (isset($_POST['submit'])) {
    // Mengambil dan mengamankan input
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($koneksi, $username);
    
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($koneksi, $password);
    
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($koneksi, $email);
    
    $nama_lengkap = stripslashes($_POST['nama_lengkap']);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $nama_lengkap);
    
    $alamat = stripslashes($_POST['alamat']);
    $alamat = mysqli_real_escape_string($koneksi, $alamat);
    
    // Cek apakah username atau email sudah terdaftar
    $sql = "SELECT id_user FROM user WHERE email = ? OR username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    // Jika user sudah terdaftar
    if ($stmt->num_rows > 0) {
        echo "<div class='alert alert-danger text-center'>User sudah terdaftar. Silakan gunakan email atau username lain.</div>";
    } else {
        // Jika belum terdaftar, insert ke database
        $query = "INSERT INTO `user` (`username`, `password`, `email`, `nama_lengkap`, `alamat`, `role`) 
                  VALUES (?, ?, ?, ?, ?, 'user')";
        $stmt = $koneksi->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashing password
        $stmt->bind_param("sssss", $username, $hashed_password, $email, $nama_lengkap, $alamat);
        
        if ($stmt->execute()) {
            // Redirect ke halaman login setelah berhasil register
            header("Location: login.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Terjadi kesalahan saat mendaftar. Silakan coba lagi.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="assets/img/logo/cutt.jpg" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="">
                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Buat Username</label>
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Buat Username" required />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Buat Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Buat Password" required />
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email" required />
                        </div>

                        <!-- Full Name input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control form-control-lg" placeholder="Nama Lengkap" required />
                        </div>

                        <!-- Address input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control form-control-lg" placeholder="Alamat" required />
                        </div>

                        <!-- Submit button -->
                        <div class="text-center text-lg-start mt-2 pt-1">
                            <button type="submit" name="submit" class="btn btn-danger btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-danger">
            <div class="text-white mb-md-0">
                Copyright © Sept 2024. Aspasya Salsabila
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <style>
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</body>
</html>
