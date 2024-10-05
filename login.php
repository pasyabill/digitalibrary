<?php
require('koneksi.php'); // Koneksi ke database
session_start(); // Memulai session

// Jika form disubmit, proses login
if (isset($_POST['submit'])) {
    // Mengambil dan mengamankan input
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($koneksi, $username);
    
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($koneksi, $password);
    
    // Mencari user berdasarkan username
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $koneksi->prepare($query);
    
    if ($stmt === false) {
        die('Error prepare statement: ' . htmlspecialchars($koneksi->error));
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Cek apakah ada user dengan username tersebut
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Memverifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data pengguna ke session
            $_SESSION['user_id'] = $user['id_user']; // Menyimpan ID pengguna
            $_SESSION['username'] = $user['username']; // Menyimpan username
            $_SESSION['role'] = $user['role']; // Menyimpan role pengguna

            // Cek apakah ada halaman redirect yang tersimpan di session
            if (isset($_SESSION['redirect_url'])) {
                $redirect_url = $_SESSION['redirect_url'];
                unset($_SESSION['redirect_url']); // Hapus session setelah digunakan
                header("Location: $redirect_url");
            } else {
                // Redirect berdasarkan role pengguna
                if ($user['role'] == 'admin') {
                    header("Location: admin.php"); // Redirect ke dashboard admin
                } else {
                    header("Location: index.php"); // Redirect ke dashboard user
                }
            }
            exit(); // Menghentikan eksekusi skrip setelah redirect
        } else {
            // Jika password salah
            echo "<div class='alert alert-danger text-center'>Password salah. Silakan coba lagi.</div>";
        }
    } else {
        // Jika user tidak ditemukan
        echo "<div class='alert alert-danger text-center'>User tidak ditemukan. Silakan coba lagi.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
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
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Masukkan Username" required />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan Password" required />
                        </div>

                        <!-- Submit button -->
                        <div class="text-center text-lg-start mt-2 pt-1">
                            <button type="submit" name="submit" class="btn btn-danger btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                        <p class="text-center mt-3">Belum punya akun? <a href="registration.php">Daftar sekarang</a></p>
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