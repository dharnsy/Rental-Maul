-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2024 at 02:04 PM
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
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `kembali`
--

DROP TABLE IF EXISTS `kembali`;
CREATE TABLE IF NOT EXISTS `kembali` (
  `id_kembali` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `tgl_kembali` date NOT NULL,
  `kondisi_mobil` text NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_kembali`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `nik` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`nik`, `nama`, `jk`, `telp`, `alamat`, `user`, `pass`) VALUES
(1122, 'Maulia', 'P', '0987656', 'karanganyr', 'maul', '$2y$10$BKqUseRy2nEKTt.G58fb7unr9qlYT/vc5z.z3ihZOtkEgK0kV3VfK'),
(1922, 'dina', 'P', 'dina', 'sukoharjo', 'dina', 'haha'),
(1872456, 'Sania Putri', 'P', '0876865467', 'Magelang', 'putri', '$2y$10$hBSf/JJAcMZB.qcWQ7/3BuCZvB9P6G1C2biwpUSBh.AsHizTmJBKi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

DROP TABLE IF EXISTS `tb_bayar`;
CREATE TABLE IF NOT EXISTS `tb_bayar` (
  `id_bayar` int NOT NULL AUTO_INCREMENT,
  `id_kembali` int NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `status` enum('lunas','belum lunas') NOT NULL,
  PRIMARY KEY (`id_bayar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobil`
--

DROP TABLE IF EXISTS `tb_mobil`;
CREATE TABLE IF NOT EXISTS `tb_mobil` (
  `nopol` varchar(10) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `status` enum('tersedia','tidak') DEFAULT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`nopol`, `brand`, `type`, `tahun`, `harga`, `status`, `foto`) VALUES
('H245', 'Toyota', 'G Gasoline Type 6', 2018, '500000.00', 'tersedia', 'G Gasoline Type_6.png'),
(' F 2345 IJ', 'Toyota', 'Reborn 2.0 V', 2022, '400000.00', 'tersedia', 'Toyota Innova Reborn 2.0 V.jpeg'),
('B 1234 XYZ', 'Suzuki', 'Ertiga GL', 2020, '600000.00', 'tersedia', 'gl.jpeg'),
('H 9012 DEF', 'Suzuki Swift', 'GX', 2019, '550000.00', 'tersedia', 'Suzuki Swift.jpeg'),
('H 1234 GHI', 'Daihatsu Xenia', 'X', 2021, '700000.00', 'tersedia', 'Daihatsu Xenia.jpeg'),
('L 5678 JKL', 'Mitsubishi Pajero', 'Exceed', 2022, '900000.00', 'tersedia', 'Mitsubishi Pajero.jpeg'),
('AB 3456 PQ', 'Mazda CX-5', 'GT', 2020, '500000.00', 'tersedia', 'Mazda CX-5.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `nik` int NOT NULL,
  `nopol` varchar(10) NOT NULL,
  `tgl_booking` date NOT NULL,
  `tgl_ambil` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `supir` tinyint(1) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL,
  `kekurangan` decimal(10,2) NOT NULL,
  `status` enum('booking','approve','ambil''kembali') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `nik`, `nopol`, `tgl_booking`, `tgl_ambil`, `tgl_kembali`, `supir`, `total`, `downpayment`, `kekurangan`, `status`) VALUES
(1, 1122, 'H245', '2024-10-19', '2024-10-30', '2024-11-08', 0, '900000.00', '700000.00', '80000.00', 'approve'),
(2, 1122, ' F 2345 IJ', '2024-10-20', '2024-10-22', '2024-11-08', 1, '0.00', '50000.00', '450000.00', 'approve'),
(3, 1122, 'H245', '2024-10-20', '2024-10-22', '2024-11-09', 1, '600000.00', '50000.00', '550000.00', ''),
(4, 1122, 'H 9012 DEF', '2024-10-20', '2024-10-23', '2024-10-25', 1, '650000.00', '70000.00', '580000.00', ''),
(5, 1122, 'H245', '2024-10-20', '2024-10-22', '2024-10-30', 1, '700000.00', '50000.00', '650000.00', 'approve'),
(6, 1872456, 'H 1234 GHI', '2024-10-20', '2024-10-22', '2024-10-24', 1, '800000.00', '500000.00', '300000.00', 'booking');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` enum('admin','petugas') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user`, `pass`, `level`) VALUES
(6, 'petugas', '$2y$10$YWZUch877kiEm4I4qtHMe.M1.Jng7MvoJgziEjU6EIUQvVK1QBbRq', 'petugas'),
(5, 'admin', '$2y$10$Pd0XT6338cKGE63UI5e6kew0JYDDLVybytj2os2/8kUzuU4jExJay', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
