<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    <title>Register Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for social icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
require('koneksi.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['nama_lengkap'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($koneksi,$username); 
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($koneksi,$password);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($koneksi,$email);
        $nama_lengkap = stripslashes($_REQUEST['nama_lengkap']);
        $nama_lengkap = mysqli_real_escape_string($koneksi,$nama_lengkap);
        $alamat = stripslashes($_REQUEST['alamat']);
        $alamat = mysqli_real_escape_string($koneksi,$alamat);


    $sql = "SELECT id_user FROM user WHERE email = ? OR username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        echo "User sudah terdaftar. Silakan gunakan email atau username lain.";
    } elseif(isset($_POST)) {
        $query = "INSERT into `user` (`username`, `password`, `email`, `nama_lengkap`, `alamat`)
VALUES ('$username', '".md5($password)."', '$email','$nama_lengkap', '$alamat' )";
        $result = mysqli_query($koneksi,$query);
        if($result){
            header("Location: login.php");
        }
        }
    }
?>
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
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Buat Username" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">buat Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Buat Password" />
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email" />
                        </div>

                        <!-- Full Name input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control form-control-lg" placeholder="Nama Lengkap" />
                        </div>

                        <!-- Address input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control form-control-lg" placeholder="Alamat" />
                        </div>

                        <!-- Remember Me checkbox -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="rememberMe" />
                                <label class="form-check-label" for="rememberMe">Ingatkan saya</label>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="text-center text-lg-start mt-2 pt-1">
                            <button type="submit" class="btn btn-danger btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                           
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-danger">
            <div class="text-white md-3 mb-md-0">
                Copyright © Sept 2024. Aspasya Salsabila tugas sebelum UK tapi bukan pra UK
            </div>
        </div>
    </section>

    <!-- Custom styles -->
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
