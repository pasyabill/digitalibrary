
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Digital Library</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Digital Library</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#buku">Buku</a></li> 
          <li><a href="#gallery">Gallery</a></li>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    <?php
    session_start(); 

    if (isset($_SESSION['success_message'])) {
      echo "<div class='alert alert-success'>".$_SESSION['success_message']."</div>";
      unset($_SESSION['success_message']);
  }
          
      if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
      }
    if(isset($_SESSION['username'])) : ?>
      <div class="" style="display:flex; ">
        <a href="profile.php" class="btn-getstarted" style="text-decoration:none;">
        <?= $_SESSION['username'] ?>
        </a>
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
            <p data-aos="fade-up" data-aos-delay="100">Selamat Datang di Perpustakaan Digital.</p>
            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
              <a href="#buku" class="btn-get-started">Daftar Buku</a>
              <a href="profile.php" class="btn-get-started glightbox"><i class="bi bi-person"></i> Profil</a>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/catread.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <p><span>Perpustakaan</span> <span class="description-title">Digital</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/catlibrary.jpeg" class="img-fluid mb-4" alt="">
            
          </div> 
          <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
              Perpustakaan digital (digital library atau E – Library) adalah tempat di mana Anda dapat meminjam koleksi buku dan sumber edukatif lainnya secara digital atau daring. Di era digital seperti sekarang ini, perpustakaan digital sudah umum dimiliki oleh setiap lembaga pendidikan atau organisasi.
              </p>
              <ul>
                <li><i class="bi bi-check-circle-fill"></i> <span>Praktis dan tidak terbatas oleh waktu dan tempat.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Tidak memerlukan tempat penyimpanan fisik untuk buku atau referensi pustaka.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Mudah digunakan oleh siapa saja karena menggunakan teknologi digital.</span></li>
              </ul>
              <p>
              Digital library bisa dijadikan warisan edukatif berbentuk virtual.
              </p>
              <div class="book-a-table">
              <h3>"Explore Knowledge, Anytime,</h3>
              <p>Anywhere."</p>
            </div>

              <!-- <div class="position-relative mt-4">
                <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
              </div> -->
            </div>
          </div>
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
                    <?php
                    // Ambil kategori dari database
                    include 'koneksi.php';
                    $kategoriQuery = "SELECT * FROM kategori";
                    $kategoriResult = mysqli_query($koneksi, $kategoriQuery);
                    while ($kategoriRow = mysqli_fetch_assoc($kategoriResult)) {
                        echo '<option value="' . $kategoriRow['id_kategori'] . '">' . $kategoriRow['nama_kategori'] . '</option>';
                    }
                    ?>
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
$query = "SELECT buku.*, kategori.nama_kategori FROM buku JOIN kategori ON buku.id_kategori = kategori.id_kategori";

// Jika ada pencarian, tambahkan kondisi WHERE
if ($search) {
    $query .= " WHERE buku.judul LIKE '%" . mysqli_real_escape_string($koneksi, $search) . "%'";
}

// Jika ada kategori yang dipilih, tambahkan kondisi WHERE
if ($kategori) {
    $query .= $search ? " AND buku.id_kategori='" . mysqli_real_escape_string($koneksi, $kategori) . "'" 
                      : " WHERE buku.id_kategori='" . mysqli_real_escape_string($koneksi, $kategori) . "'";
}

$result = mysqli_query($koneksi, $query);

// Cek apakah hasil query ada
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $imageFileName = $row['img'];

        // Ambil ulasan berdasarkan id_buku
        $id_buku = $row['id_buku'];
        $ulasan_query = "SELECT * FROM ulasanbuku WHERE id_buku = '$id_buku'";
        $ulasan_result = mysqli_query($koneksi, $ulasan_query);
        $ulasan_count = mysqli_num_rows($ulasan_result);
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
                    <p class="card-text text-center mb-1"><strong>Kategori:</strong> <?php echo $row['nama_kategori']; ?></p>
                </div>
                <div class="card-footer text-center p-2">
                    <a href="pinjam.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-danger btn-sm">Pinjam</a>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalUlasan-<?php echo $id_buku; ?>">
                        Lihat Ulasan (<?php echo $ulasan_count; ?>)
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal untuk menampilkan ulasan -->
        <div class="modal fade" id="modalUlasan-<?php echo $id_buku; ?>" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUlasanLabel">Ulasan untuk <?php echo $row['judul']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        if ($ulasan_count > 0) {
                            // Loop untuk menampilkan ulasan
                            while ($ulasan_row = mysqli_fetch_assoc($ulasan_result)) {
                                // Pastikan kunci "username" ada sebelum mencoba menampilkannya
                                $username = isset($ulasan_row['username']) ? $ulasan_row['username'] : 'Anonim';
                                echo '<div class="mb-3">';
                                echo '<strong>' . $username . ':</strong>';
                                echo '<p>' . $ulasan_row['ulasan'] . '</p>';
                                echo '<p><strong>Rating:</strong> ' . str_repeat('★', $ulasan_row['rating']) . str_repeat('☆', 5 - $ulasan_row['rating']) . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Tidak ada ulasan untuk buku ini.</p>';
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
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
            <a href="https://x.com/pasyabill" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.facebook.com/dktvktdiqlfk" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/aespasya/" class="instagram"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright 2024</span> <strong class="px-1 sitename">Aspasya Salsabila</strong> <span>All Rights Reserved</span></p>
      
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