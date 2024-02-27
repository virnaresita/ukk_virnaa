-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 09:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brary`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `cover` varchar(255) NOT NULL,
  `id_buku` varchar(25) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `thn_terbit` date NOT NULL,
  `jml_halaman` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `isi_buku` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`cover`, `id_buku`, `kategori`, `judul`, `pengarang`, `penerbit`, `thn_terbit`, `jml_halaman`, `deskripsi`, `isi_buku`) VALUES
('65d1ea2b6f21d.jpeg', 'KB0001', 'sains', 'Daddy Rich Poor Dad', 'Robert Kiyosaki', 'Warner Books', '1997-06-18', 336, 'masalah finansial yang dihadapi banyak orang dikarenakan ajaran keliru orangtua mereka mengenai keuangan, yang juga dialamai semasa kecil dan remaja.', 'Rich Dad Poor Dad (Robert T. Kiyosaki) (z-lib.org).pdf'),
('65d2157937f41.jpg', 'KB0002', 'novel', 'HUJAN', 'tere liye', 'Gramedia', '2016-06-08', 413, 'Buku ini menceritakan tentang perjalanan hidup dan kisah cinta wanita yang bernama lail', '{Candys} Hujan (Cover Baru) - Tere Liye.pdf'),
('65d21c0ece224.jpg', 'KB0003', 'novel', 'Matahari', 'tere liye', 'Gramedia Pustaka Utama', '2016-07-25', 390, 'matahari adalah sebuah novel karya tere liye, novel ini adalah buku ketiga dari seri bumi/serial dunia pararel', '14.-Matahari.pdf'),
('65d21bf5da091.jpg', 'KB0004', 'fantasy', 'Bulan', 'tere liye', 'Gramedia Pustaka Utama', '2015-02-19', 440, 'novel ini adalah buku kedua dari seri Bumi/serial dunia pararel', 'Bulan.pdf'),
('65d21cff80216.jpg', 'KB0005', 'fantasy', 'Bumi', 'tere liye', 'Gramedia Pustaka Utama', '2014-07-09', 440, 'Novel ini merupakan buku pertama dari serial Bumi atau Dunia Pararel ', 'Bumi.pdf'),
('65d21e2322fd8.jpg', 'KB0006', 'fantasy', 'Renjana', 'Elizabeth Alicia', 'Gramedia', '2021-06-16', 455, 'Cerita buku ini mengisahkan tentang reinkarnasi seorang raja majapahit yang menghapus namanya dari sejarah manapun', 'ElAlicia - Renjana.pdf'),
('65d21f2ee0aa7.jpg', 'KB0007', 'fantasy', 'Harry Potter dan Batu Bertuah', 'J. K. Rowling', 'Gramedia', '1997-07-08', 388, 'Harry Potter dan Btu Bertuah adalah novel fantasy yang merupakan novel pertama dalam seri Harry Potter dan Novel debut Rowling', 'Harry-Potter-01-Harry-Potter-dan-Batu-Bertuah-1.pdf'),
('65d22034dc6a3.jpeg', 'KB0008', 'komik', 'Si Juki', 'Faza Meonk', 'pt.book', '2010-06-08', 455, 'Mengisahkan keseharian  juki', 'Si Juki Komik Strip (Faza Meonk) (z-lib.org).pdf'),
('65d9891818874.jpg', 'KB0009', 'komik', 'Lolipop', 'pp', 'pp', '2024-02-24', 777, 'pp', 'Novel_Lollipop_Titi_Setyoningsih.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`kategori`) VALUES
('bisnis'),
('fantasy'),
('filsafat'),
('informatika'),
('Komedi'),
('komik'),
('novel'),
('sains');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `nisn` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`nisn`, `nama`, `password`, `kelas`, `jurusan`, `alamat`) VALUES
(111, 'virna resita', '123', 'XI', 'Rekayasa Perangkat Lunak', 'sanding'),
(123, 'virna', '123', 'XI', 'Rekayasa Perangkat Lunak', 'isekai'),
(1111, 'virna', '123', 'XI', 'Rekayasa Perangkat Lunak', 'isekai');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `nisn` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `harga` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `nisn`, `id_user`, `tgl_pinjam`, `tgl_kembali`, `harga`, `status`) VALUES
(1, 'KB0008', 1111, 9, '2024-02-24', '2024-02-24', '', 3),
(2, 'KB0008', 123, 9, '2024-02-24', '2024-02-24', '', 1),
(3, 'KB0001', 1111, 9, '2024-02-24', '2024-02-25', '', 1),
(4, 'KB0009', 1111, 9, '2024-02-24', '2024-02-27', '', 0),
(5, 'KB0005', 1111, 9, '2024-02-24', '2024-02-27', '', 0),
(6, 'KB0004', 1111, 9, '2024-02-24', '2024-02-29', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `sebagai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `no_telp`, `sebagai`) VALUES
(9, 'virna resita', '123', '085711921552', 'petugas'),
(17, 'virna', '123', '085711921552', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nisn`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `nisn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2122;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_buku` (`kategori`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `member` (`nisn`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
