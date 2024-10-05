<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    <title>Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

        .rating input:checked~label {
            color: gold;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: gold;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Rating dan Ulasan</h2>
        <form action="" method="POST">
            <?php
            include 'koneksi.php';
            $id_buku = $_GET['id'] ?? null; // Menggunakan 'id' sebagai parameter
            $result = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id_buku'");
            $row = mysqli_fetch_assoc($result);

            // Pastikan $row tidak null
            if (!$row) {
                echo "Buku tidak ditemukan.";
                exit;
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

                    <div class="mb-3">
                        <label for="setting-input-1" class="form-label"><strong>Kode Buku:</strong></label>
                        <input type="text" class="form-control" id="setting-input-1" required name="id_buku" value="<?= $row['id_buku'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label"><strong>Username:</strong></label>
                        <input type="text" class="form-control" id="setting-input-2" name="username" required>
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