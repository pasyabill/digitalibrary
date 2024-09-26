<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    <title>Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Form Peminjaman Buku</h2>
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

                <div class="row mb-3">
                    <label for="inputTanggalPinjam" class="col-sm-4 col-form-label"><strong>Tanggal Pinjam:</strong></label>
                    <div class="col-sm-8">
                        <?php
                        function hari_ini($hari) {
                            $seminggu = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                            return $seminggu[$hari];
                        }

                        function bulan_indo($bln) {
                            $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                            return $bulan[(int)$bln - 1];
                        }

                        function tgl_indo($tgl) {
                            $tanggal = substr($tgl, 8, 2);
                            $bulan = bulan_indo(substr($tgl, 5, 2));
                            $tahun = substr($tgl, 0, 4);
                            $hari = date('w', strtotime($tgl));
                            $nama_hari = hari_ini($hari);
                            return $nama_hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun;
                        }

                        $tgl_pinjam = date('Y-m-d');
                        echo tgl_indo($tgl_pinjam);
                        ?>
                    </div>
                    <input type="hidden" name="tgl_pinjam" value="<?= date('Y-m-d') ?>">
                </div>

                <div class="row mb-3">
                    <label for="inputTanggalKembali" class="col-sm-4 col-form-label"><strong>Tanggal Kembali:</strong></label>
                    <div class="col-sm-8">
                        <?php
                        $n = 14;
                        $tgl_kembali = date('Y-m-d', strtotime('+' . $n . ' days'));
                        echo tgl_indo($tgl_kembali);
                        ?>
                    </div>
                </div>
                <input type="hidden" name="tgl_kembali" value="<?= $tgl_kembali ?>">

                <button type="submit" name="pinjam" value="submit" class="btn btn-danger">Ajukan peminjaman buku</button>
            </div>
        </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
