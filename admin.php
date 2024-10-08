<?php error_reporting(E_ALL); 
ini_set('display_errors', 1);  ?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Digital Library</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo/logobuku.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Admin Digital Library</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="inputbuku.php">Input Buku</a></li>
          <li><a href="#dashboard">Dashboard</a></li>
          <!---<li><a href="#events">Events</a></li>-->
          <li><a href="#buku">Hapus Buku</a></li> 
          <li><a href="#gallery">Gallery</a></li>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    <?php
    session_start(); 
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
    if(isset($_SESSION['username'])) : ?>
      <div class="" style="display:flex; ">
        <div class="btn-getstarted"><?= $_SESSION['username'] ?></div>
        <a href="logout.php" class="btn-getstarted">Logout</a>
      </div>
    <?php else : ?>
        <a class="btn-getstarted" href="login.php">Login</a>
     <?php endif; ?>


   
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Unlimited Reading<br>Unlimited Learning.</h1>
            <p data-aos="fade-up" data-aos-delay="100">Selamat Datang di Dashboard Admin Perpustakaan Digital.</p>
            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
              <a href="inputbuku.php" class="btn-get-started">Input Buku</a>
              <a href="https://youtu.be/BDDz1TnumNw?si=rxIJ7g3BdI1TOvD5" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/catread.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="dashboard" class="dashboard section">
    <?php
// Include koneksi ke database
include 'koneksi.php';

// Query untuk mendapatkan data peminjaman buku
$query = "SELECT p.id_peminjaman, p.tanggal_peminjaman, p.tanggal_pengembalian, p.status_peminjaman, 
                 b.judul, u.username, p.id_buku, u.id_user
          FROM peminjaman p
          JOIN buku b ON p.id_buku = b.id_buku
          JOIN user u ON p.id_user = u.id_user";
$result = mysqli_query($koneksi, $query);

// Jika ada error pada query, tampilkan pesan kesalahan
if (!$result) {
    die("Error saat mengambil data peminjaman: " . mysqli_error($koneksi));
}
?>

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <p><span>Dashboard</span> <span class="description-title">Aksi</span></p>
</div>

<div class="container mt-5">
    <table class="table table-bordered table-hover">
        <thead class="table-danger">
            <tr>
                <th>ID Peminjaman</th>
                <th>Judul Buku</th>
                <th>Username Peminjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $row['id_peminjaman'] ?></td>
                    <td><?= $row['judul'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_peminjaman'])) ?></td>
                    <td><?= !empty($row['tanggal_pengembalian']) ? date('d-m-Y', strtotime($row['tanggal_pengembalian'])) : '-' ?></td>
                    <td><?= $row['status_peminjaman'] ?></td>
                    <td>
                        <?php if ($row['status_peminjaman'] == 'pending') : ?>
                            <form method="POST" action="admin.php" style="display:inline;">
                                <input type="hidden" name="id_peminjaman" value="<?= $row['id_peminjaman'] ?>">
                                <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">
                                <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                                <button type="submit" name="action" value="approve" class="btn btn-warning btn-sm">Terima</button>
                                <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        <?php elseif ($row['status_peminjaman'] == 'approved') : ?>
                            <form method="POST" action="admin.php" style="display:inline;">
                                <input type="hidden" name="id_peminjaman" value="<?= $row['id_peminjaman'] ?>">
                                <button type="submit" name="action" value="return" class="btn btn-warning btn-sm">Pengembalian</button>
                            </form>
                        <?php elseif ($row['status_peminjaman'] == 'returned') : ?>
                            <span class="text-success">Buku Sudah Dikembalikan</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
// Proses aksi persetujuan, penolakan, atau pengembalian buku
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil ID peminjaman dan aksi dari POST
    $id_peminjaman = $_POST['id_peminjaman'];
    $id_buku = $_POST['id_buku']; // Tambahkan id_buku
    $id_user = $_POST['id_user']; // Tambahkan id_user
    $action = $_POST['action'];

    // Proses berdasarkan aksi yang diambil
    if ($action == 'approve') {
        // Update status peminjaman menjadi approved
        $query = "UPDATE peminjaman SET status_peminjaman = 'approved' WHERE id_peminjaman = $id_peminjaman";
        mysqli_query($koneksi, $query);

        // Update status buku menjadi 'kosong'
        $query2 = "UPDATE buku 
                    SET status = 'kosong' 
                    WHERE id_buku = $id_buku";
        mysqli_query($koneksi, $query2);

        // Tambahkan buku ke koleksi pribadi user
        $koleksiQuery = "INSERT INTO koleksipribadi (id_user, id_buku) VALUES ($id_user, $id_buku)";
        mysqli_query($koneksi, $koleksiQuery);

    } elseif ($action == 'reject') {
        // Update status peminjaman menjadi rejected
        $query = "UPDATE peminjaman SET status_peminjaman = 'rejected' WHERE id_peminjaman = $id_peminjaman";
        mysqli_query($koneksi, $query);

    } elseif ($action == 'return') {
        // Update status peminjaman menjadi returned dan set tanggal pengembalian
        $query = "UPDATE peminjaman SET status_peminjaman = 'returned', tanggal_pengembalian = NOW() WHERE id_peminjaman = $id_peminjaman";
        
        // Pastikan query peminjaman berhasil
        if (mysqli_query($koneksi, $query)) {
            // Ambil ID buku dari peminjaman yang dikembalikan
            $query_buku = "SELECT id_buku FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
            $result_buku = mysqli_query($koneksi, $query_buku);
            
            if ($result_buku && mysqli_num_rows($result_buku) > 0) {
                $buku = mysqli_fetch_assoc($result_buku);
                $id_buku = $buku['id_buku'];
                
                // Update status buku menjadi tersedia
                $query2 = "UPDATE buku SET status = 'tersedia' WHERE id_buku = $id_buku";
                if (mysqli_query($koneksi, $query2)) {
                    echo "<div class='alert alert-success'>Buku berhasil dikembalikan dan status diperbarui menjadi tersedia.</div>";
                } else {
                    echo "Gagal memperbarui status buku: " . mysqli_error($koneksi);
                }
            } else {
                echo "Gagal mengambil ID buku dari peminjaman: " . mysqli_error($koneksi);
            }
        } else {
            echo "Gagal memperbarui status peminjaman: " . mysqli_error($koneksi);
        }
    }

    // Refresh halaman untuk memperbarui tabel
    echo "<meta http-equiv='refresh' content='0'>";
}
?>


<?php
$query = "SELECT ul.id_ulasan, ul.id_user, ul.id_buku, ul.ulasan, ul.rating, u.username 
          FROM ulasanbuku ul 
          JOIN user u ON ul.id_user = u.id_user"; // Ganti dengan nama kolom yang sesuai
$result = mysqli_query($koneksi, $query);
?>

<div class="container section-title" data-aos="fade-up">
    <p><span>Daftar</span> <span class="description-title">Ulasan</span></p>
</div>
<div class="container mt-5">
    <table class="table table-bordered table-hover">
        <thead class="table-danger">
            <tr>
                <th>ID Ulasan</th>
                <th>ID User</th>
                <th>Username</th>
                <th>ID Buku</th>
                <th>Ulasan</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Cek apakah ada data
            if (mysqli_num_rows($result) > 0) {
                // Iterasi melalui setiap baris hasil
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id_ulasan']}</td>
                            <td>{$row['id_user']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['id_buku']}</td>
                            <td>{$row['ulasan']}</td>
                            <td>{$row['rating']}</td>
                            <td>
                                <a href='hapus_ulasan.php?id_ulasan={$row['id_ulasan']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus ulasan ini?\");'>Hapus</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Tidak ada ulasan yang ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Sertakan koneksi database
include 'koneksi.php'; // Pastikan untuk mengganti dengan file koneksi Anda

$query = "SELECT id_user, username, role FROM user"; // Query untuk mengambil data dari tabel user
$result = mysqli_query($koneksi, $query);
?>

<div class="container section-title" data-aos="fade-up">
    <p><span>Daftar</span> <span class="description-title">Pengguna</span></p>
</div>
<div class="container mt-5">
    <table class="table table-bordered table-hover">
        <thead class="table-danger">
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Cek apakah ada data
            if (mysqli_num_rows($result) > 0) {
                // Iterasi melalui setiap baris hasil
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id_user']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['role']}</td>
                            <td>
                                <a href='edit_user.php?id_user={$row['id_user']}' class='btn btn-warning'>Edit</a>
                                <a href='hapus_user.php?id_user={$row['id_user']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\");'>Hapus</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Tidak ada pengguna yang ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Menutup koneksi
mysqli_close($koneksi);
?>

    </table>
</div>

            

      </div>
    </section>


    <section id="buku" class="tabel-buku">
    <div class="container section-title" data-aos="fade-up">
    <p><span>Daftar</span> <span class="description-title">Buku</span></p>
    </div>
    </div>
<div class="container mt-1">
    <div class="row mb-2">
        <div class="col-12 text-center">
            <p>Buku membuka jendela dunia</p>
            <form method="GET" action="" class="d-flex justify-content-center">
                <input type="text" name="search" placeholder="Cari berdasarkan judul buku..." class="form-control" style="width: 300px; margin-right: 10px;">
                <button type="submit" class="btn btn-danger">Cari</button>
            </form>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 text-center">
            <form method="GET" action="" class="d-flex justify-content-center">
                <select name="kategori" class="form-control" style="width: 300px; margin-right: 10px;">
                    <option value="">Semua Kategori</option>
                    <option value="novel">Novel</option>
                    <option value="komik">Komik</option>
                    <option value="majalah">Majalah</option>
                    <option value="ensiklopedi">Ensiklopedi</option>
                </select>
                <button type="submit" class="btn btn-danger">Filter</button>
            </form>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <?php
        include 'koneksi.php';

        // Ambil parameter pencarian dan kategori jika ada
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
        $query = "SELECT * FROM buku";

        // Jika ada pencarian, tambahkan kondisi WHERE
        if ($search) {
            $query .= " WHERE judul LIKE '%" . mysqli_real_escape_string($koneksi, $search) . "%'";
        }

        // Jika ada kategori yang dipilih, tambahkan kondisi WHERE
        if ($kategori) {
            $query .= $search ? " AND kategori='" . mysqli_real_escape_string($koneksi, $kategori) . "'" : " WHERE kategori='" . mysqli_real_escape_string($koneksi, $kategori) . "'";
        }

        $result = mysqli_query($koneksi, $query);

        // Cek apakah hasil query ada
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $imageFileName = $row['img'];
        ?>
                <div class="col-6 col-md-3 mb-4">
    <div class="card h-100 shadow-sm">
        <div class="card-img-top-container" style="overflow: hidden; height: 450px;">
            <img src="./assets/img/<?php echo $imageFileName; ?>" class="card-img-top" alt="Gambar Buku" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="card-body p-3">
            <h3 class="card-title text-center font-weight-bold"><?php echo $row['judul']; ?></h3>
            <p class="card-text text-center mb-1"><strong>Penulis:</strong> <?php echo $row['penulis']; ?></p>
            <p class="card-text text-center mb-1"><strong>Penerbit:</strong> <?php echo $row['penerbit']; ?></p>
            <p class="card-text text-center mb-1"><strong>Tahun Terbit:</strong> <?php echo $row['tahun_terbit']; ?></p>
            <p class="card-text text-center mb-1"><strong>Status:</strong> <?php echo $row['status']; ?></p>
            <p class="card-text text-center mb-1"><strong>Kategori:</strong> <?php echo $row['kategori']; ?></p>
        </div>
        <div class="card-footer text-center p-2">
            <form action="hapus_buku.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                <button type="submit" class="btn btn-danger btn-sm">Hapus Buku</button>
            </form>
        </div>
    </div>
</div>

        <?php
            }
        } else {
            echo '<p class="text-center">Tidak ada buku yang ditemukan.</p>';
        }
        ?>
    </div>
</div>

      </div>
      </div>
    </section>
    <!-- Gallery Section -->
    <section id="gallery" class="gallery section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p><span>Check</span> <span class="description-title">Our Gallery</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 0
                },
                "768": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/perpus1.jpg"><img src="assets/img/gallery/perpus1.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/perpus2.jpg"><img src="assets/img/gallery/perpus2.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/perpus3.jpg"><img src="assets/img/gallery/perpus3.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/perpus4.jpg"><img src="assets/img/gallery/perpus4.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/perpus5.jpg"><img src="assets/img/gallery/perpus5.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/perpus6.jpg"><img src="assets/img/gallery/perpus6.jpg" class="img-fluid" alt=""></a></div>
            <!-- <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg" class="img-fluid" alt=""></a></div> -->
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Gallery Section -->

    
         

   

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>Jl. Medan Merdeka Sel. No.11, Gambir, Jakarta Pusat</p>
            <p>DKI Jakarta 10110</p>
            <p></p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>+1234567890</span><br>
              <strong>Email:</strong> <span>info@digitalibrary.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Senin-Jumat:</strong> <span>08.00 - 19.00</span><br>
              <strong>Sabtu-Minggu</strong>: <span>08.00 - 16.00</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Aspasya Salsabila</strong> <span>All Rights Reserved</span></p>
      
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>