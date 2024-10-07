-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2024 at 12:35 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` int NOT NULL,
  `status` enum('tersedia','kosong') NOT NULL,
  `kategori` enum('novel','komik','ensiklopedi','majalah') NOT NULL,
  `img` varchar(100) NOT NULL,
  `file_buku` varchar(255) NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=MyISAM AUTO_INCREMENT=12346 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `status`, `kategori`, `img`, `file_buku`) VALUES
(1, 'Negeri Para Bedebah', 'Tere Liye', 'Gramedia', 2012, 'tersedia', 'novel', 'negeri.jpg', 'bumi_manusia.pdf'),
(2, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Lentera Dipantara', 1980, '', 'novel', 'bumi.jpg', 'bumi_manusia.pdf'),
(3, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'tersedia', 'novel', 'laskar.jpg', 'bumi_manusia.pdf'),
(4, 'Gadis Kretek', 'Ratih Kumala', 'Gramedia', 2012, 'tersedia', 'novel', 'gadis.jpg', 'bumi_manusia.pdf'),
(5, 'Daun yang Jatuh Tak Pernah Membenci Angin', 'Tere Liye', 'Gramedia', 2010, 'kosong', 'novel', 'daunjatuhh.jpg', 'daunjatuh.pdf'),
(6, 'Death Note Black Edition', 'Tsugumi Ohba', 'Gramedia', 2010, '', 'komik', 'death.jpg', 'bumi_manusia.pdf'),
(7, 'Bobo Edisi 48 2022', 'Bobo', 'Sarana Bobo', 2022, 'tersedia', 'majalah', 'bobo.jpg', 'bumi_manusia.pdf'),
(8, 'Laut bercerita', 'Leila S Chudori', 'Gramedia', 2017, 'tersedia', 'novel', 'laut.jpg', 'bumi_manusia.pdf'),
(9, 'Lelaki Harimau', 'Eka Kurniawan', 'Gramedia', 2004, '', 'novel', 'lelakii.jpg', 'bumi_manusia.pdf'),
(10, 'Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Gramedia', 1982, 'tersedia', 'novel', 'ronggeng.png', 'ronggeng.pdf'),
(12, 'Entrok', ' Okky Madasari', 'Gramedia', 2010, '', 'novel', 'entrox.jpg', 'bumi_manusia.pdf'),
(11, 'Kita Pergi Hari Ini', ' Ziggy Zezsyazeoviennazabrizkie', 'Gramedia', 2021, 'tersedia', 'novel', 'kitapergi.jpg', 'bumi_manusia.pdf'),
(15, 'cobaan buat dihapus', 'cobaan ya dicobain dek', 'pasyarentalkomik', 2009, 'tersedia', 'komik', 'cobaandicobain.jpg', 'bumi_manusia.pdf'),
(12345, 'cobaan', 'aspasya salsabila', 'ohmediapanelstudio', 2009, 'tersedia', 'komik', 'canntik.jpg', 'bumi_manusia.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

DROP TABLE IF EXISTS `kategoribuku_relasi`;
CREATE TABLE IF NOT EXISTS `kategoribuku_relasi` (
  `id_kategoribuku` int NOT NULL AUTO_INCREMENT,
  `id_buku` int NOT NULL,
  `id_kategori` int NOT NULL,
  PRIMARY KEY (`id_kategoribuku`),
  KEY `id_buku` (`id_buku`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

DROP TABLE IF EXISTS `koleksipribadi`;
CREATE TABLE IF NOT EXISTS `koleksipribadi` (
  `id_koleksi` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  PRIMARY KEY (`id_koleksi`),
  KEY `id_user` (`id_user`),
  KEY `id_buku` (`id_buku`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_peminjaman` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `pdf_access` varchar(255) NOT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `id_user` (`id_user`),
  KEY `id_buku` (`id_buku`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`, `pdf_access`) VALUES
(1, 9, 2, '2024-10-06', '2024-10-13', 'approved', ''),
(2, 8, 6, '2024-10-07', '2024-10-14', 'approved', ''),
(3, 8, 5, '2024-10-07', '2024-10-14', 'approved', ''),
(4, 9, 12, '2024-10-07', '2024-10-14', 'approved', ''),
(5, 8, 9, '2024-10-07', '2024-10-14', 'approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

DROP TABLE IF EXISTS `ulasanbuku`;
CREATE TABLE IF NOT EXISTS `ulasanbuku` (
  `id_ulasan` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int NOT NULL,
  PRIMARY KEY (`id_ulasan`),
  KEY `id_user` (`id_user`),
  KEY `id_buku` (`id_buku`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `email`, `nama_lengkap`, `alamat`) VALUES
(1, 'pasya', 'a8f5f167f44f4964e6c998dee827110c', 'user', 'salsabila@gmail.com', 'aspasya', 'amerika'),
(2, 'salsa', '$2y$10$/Lq6O9n2q2J3J67qKUk9EOtEu0UI4ZxVnJbsQjIxRkIa4.BudiNy.', 'user', 'salsa@gmail.com', 'salsabila', 'indonesia'),
(3, 'www', '85e1c5fcd281659a09398f110f2d039f', 'user', 'ww@example.com', 'wwww', 'wwww'),
(4, 'zoorozuya', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 'zoorozuya@gmail.com', 'shiroyasha', 'jepang'),
(5, 'testing', '5b0975e3ed5e8d8657dc14c0a1eb4f6c', 'user', 'testing@example.com', 'tess', 'tess'),
(6, 'zara', 'b35f8922ff1d54a5aff55a1d4107e245', 'user', 'zara@gmail.com', 'yara', 'secang'),
(7, 'salsabila', '$2y$10$zgWa32.i0npGsFNyZ7Q44eFGA86yBJvB55C4ZrMzvVT3pa0SsRYaa', 'admin', 'admin@gmail.com', 'Aspasya Salsabila', 'Bekasi'),
(8, 'zoorozuyyie', '$2y$10$2Tqp4RU5rnqoM8mCL3/KHOPrS7WKHFyjwxI6J26SdjVtWa/.PPCxC', 'user', 'user@gmail.com', 'shiroyasha', 'depok'),
(9, 'shiro', '$2y$10$kNEY2fHR.TSMwsJ66TP8EuLXcq.KWixrvSm0EWOGWUPBWbzw/A4sS', 'user', 'shiroyasha@gmail.com', 'shiroyashe', 'Konoha');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
