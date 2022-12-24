-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2018 at 03:58 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kateringdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `kd_menu` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(12) NOT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`kd_menu`, `nama`, `keterangan`, `harga`, `pic`) VALUES
(7, 'Nasi Ayam Goreng', 'Nasi dengan ayam goreng hangat yang nikmat dan lezat', 10000, 'asset/menu-pic/Nasi_Ayam_Goreng16161616-1212-2020.jpg'),
(8, 'Nasi Telur Pedas', 'Nasi dengan lauk telur pedas + sayur random yang pastinya enak.', 7000, 'asset/menu-pic/Nasi_Telur_Pedas16161616-1212-2020.jpg'),
(9, 'Nasi Telur dan Ayam', 'Nasi dengan lauk lengkap telur + sayur + ayam goreng', 13000, 'asset/menu-pic/Nasi_Telur_dan_Ayam16161616-1212-2020.jpg'),
(10, 'Nasi Rames', 'Murah, enak, dan bergizi. Cocok untuk akhir bulan.', 6000, 'asset/menu-pic/Nasi_Rames16161616-1212-2020.jpg'),
(11, 'Gado-Gado', 'Gado gado spesial dengan rasa nikmat.', 10000, 'asset/menu-pic/Gado-Gado16161616-1212-2020.jpg'),
(12, 'Nasi Rica-Rica Ayam', 'Pedas, gurih dan nikmat. Cocok untuk dinikmati siang hari.', 10000, 'asset/menu-pic/Nasi_Rica-Rica_Ayam16161616-1212-2020.jpg'),
(13, 'Kupat Tahu', 'Makanan tradisional yang kita semua suka pastinya.', 8000, 'asset/menu-pic/Kupat_Tahu16161616-1212-2020.jpg'),
(14, 'Mangut Lele', 'Segar, nikmat pastinya.', 10000, 'asset/menu-pic/Mangut_Lele16161616-1212-2020.jpg'),
(15, 'Mangut Ayam', 'Sedap nan istimewa seperti Yogyakarta.', 10000, 'asset/menu-pic/Mangut_Ayam16161616-1212-2020.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(25) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `no_pesanan`, `bukti_pembayaran`, `checked`) VALUES
(1, 'zfvPRgFrHDNkJdyKijCnIYGhO', 'asset/bukti-pembayaran/zfvPRgFrHDNkJdyKijCnIYGhO.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no` int(11) NOT NULL,
  `no_pesanan` varchar(25) DEFAULT NULL,
  `tgl_masukan` date NOT NULL,
  `modal` int(11) NOT NULL,
  `keuntungan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no`, `no_pesanan`, `tgl_masukan`, `modal`, `keuntungan`) VALUES
(1, 'zfvPRgFrHDNkJdyKijCnIYGhO', '2018-07-22', 5250, 1750);

-- --------------------------------------------------------

--
-- Table structure for table `tpesanan`
--

CREATE TABLE `tpesanan` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(25) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `kd_menu` int(11) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `tgl_ambil` date NOT NULL,
  `status_pesanan` tinyint(1) NOT NULL DEFAULT '0',
  `status_pembayaran` tinyint(1) NOT NULL DEFAULT '0',
  `metode_pengambilan` tinyint(1) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpesanan`
--

INSERT INTO `tpesanan` (`id`, `no_pesanan`, `id_user`, `kd_menu`, `tgl_pesan`, `tgl_ambil`, `status_pesanan`, `status_pembayaran`, `metode_pengambilan`, `qty`, `harga_total`) VALUES
(24, 'zfvPRgFrHDNkJdyKijCnIYGhO', 'amelia', 8, '2018-06-22 08:48:58', '2018-07-22', 0, 1, 0, 1, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no`, `id_user`, `email`, `password`, `level`) VALUES
(6, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(18, 'amelia', 'amelia@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `kd_pos` varchar(10) DEFAULT NULL,
  `profile` text NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id_user`, `nama`, `alamat`, `kd_pos`, `profile`, `no_telp`) VALUES
('amelia', 'iqbaladinur', 'gsydgysgd', '362536', 'asset/img/profile.png', '0812265371');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kd_menu`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tpesanan`
--
ALTER TABLE `tpesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `kd_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tpesanan`
--
ALTER TABLE `tpesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
