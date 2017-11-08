-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2017 at 11:42 AM
-- Server version: 5.6.33-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sibaskom_sertifikat`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_notifikasi`
--

CREATE TABLE IF NOT EXISTS `email_notifikasi` (
  `id_email_notifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `email1` varchar(200) DEFAULT NULL,
  `email2` varchar(200) DEFAULT NULL,
  `email3` varchar(200) DEFAULT NULL,
  `email4` varchar(200) DEFAULT NULL,
  `email5` varchar(200) DEFAULT NULL,
  `tanggal_update` date DEFAULT NULL,
  `jam_update` time DEFAULT NULL,
  `user_update` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_email_notifikasi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_notifikasi`
--

INSERT INTO `email_notifikasi` (`id_email_notifikasi`, `email1`, `email2`, `email3`, `email4`, `email5`, `tanggal_update`, `jam_update`, `user_update`) VALUES
(1, 'nelwan.topan@gmail.com', 'Umum.area.kupang@gmail.com', 'djoeniar@gmail.com', '', '', '2017-02-26', '21:24:14', '15051725');

--
-- Triggers `email_notifikasi`
--
DROP TRIGGER IF EXISTS `update_tanggal_jam_email_notifikasi`;
DELIMITER //
CREATE TRIGGER `update_tanggal_jam_email_notifikasi` BEFORE UPDATE ON `email_notifikasi`
 FOR EACH ROW SET NEW.tanggal_update = CURDATE(), 
      NEW.jam_update = CURTIME()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE IF NOT EXISTS `sertifikat` (
  `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `kode_diklat` varchar(150) DEFAULT NULL,
  `judul_diklat` varchar(255) DEFAULT NULL,
  `kode_sertifikat` varchar(150) DEFAULT NULL,
  `penyelenggara` varchar(200) DEFAULT NULL,
  `tanggal_mulai_pelatihan` date DEFAULT NULL,
  `masa_belaku_sertifikat` date DEFAULT NULL,
  `masa_alert` smallint(2) DEFAULT NULL COMMENT '0=none; 3=3bulan; 6=6bulan; 12=1tahun',
  `file_sertifikat` varchar(255) DEFAULT NULL,
  `tanggal_update` date DEFAULT NULL,
  `jam_update` time DEFAULT NULL,
  `user_update` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_sertifikat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `nip`, `nama`, `unit`, `kode_diklat`, `judul_diklat`, `kode_sertifikat`, `penyelenggara`, `tanggal_mulai_pelatihan`, `masa_belaku_sertifikat`, `masa_alert`, `file_sertifikat`, `tanggal_update`, `jam_update`, `user_update`) VALUES
(6, '8608036H3', 'YOHANES FERNANDES LAY', 'PT PLN (PERSERO) Area Kupang', 'B.1.1.3.69.3.M', 'PENYEGARAN PDKB TM METODE BERJARAK', 'B.1.1.3.69.3.M.03.16.01.8608036H3', 'Udiklat Semarang', '2016-02-15', '2016-05-01', 3, 'masnasabah.pdf', '2017-03-08', '10:52:03', '15051725'),
(5, '6590090H', 'YERMIAS A. CHRISTIAN LUDJI', 'PT PLN (PERSERO) Pusat Listrik Ende', 'B.1.1.3.37.3.M.EL', 'K2 / K3 UNTUK PENGAWAS PEKERJAAN DISTRIBUSI', '-', 'Udiklat Pandaan', '2016-01-01', '2016-06-23', 6, NULL, '2017-02-26', '17:52:42', '15051725'),
(4, '6489029H', 'PHILIPUS FERNANDEZ', 'PT PLN (PERSERO) WILAYAH NUSA TENGGARA TIMUR', 'B.1.1.1.057.3', 'K2K3 Pembangkit', 'B.1.1.1.057.3.07.16.01.6489029H', 'Udiklat Suralaya', '2015-02-01', '2016-01-01', 12, 'Chrysanthemum.jpg', '2017-03-08', '10:53:00', '15051725'),
(7, '8608036H32', 'Fulan', 'PT PLN (PERSERO) Area Kupang', 'B.1.1.3.69.3.M', 'PENYEGARAN PDKB TM METODE BERJARAK', 'B.1.1.3.69.3.M.03.16.01.8608036H3', 'Udiklat Semarang', '2016-02-15', '2016-05-01', 3, NULL, '2017-03-08', '10:39:23', '15051725');

--
-- Triggers `sertifikat`
--
DROP TRIGGER IF EXISTS `sertifikat_update_jam_tanggal`;
DELIMITER //
CREATE TRIGGER `sertifikat_update_jam_tanggal` BEFORE UPDATE ON `sertifikat`
 FOR EACH ROW SET NEW.tanggal_update = CURDATE(), 
      NEW.jam_update = CURTIME()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `bagian` varchar(250) DEFAULT NULL,
  `email_korporat` varchar(200) DEFAULT NULL,
  `email_nonkorporat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_level` int(1) DEFAULT NULL COMMENT '1=admin; 2=officer',
  `aktif` tinyint(1) DEFAULT '1' COMMENT '1=aktif; 0=tdk aktif',
  `tanggal_update` date DEFAULT NULL,
  `jam_update` time DEFAULT NULL,
  `user_update` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `nik` (`nik`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nik`, `password`, `full_name`, `unit`, `bagian`, `email_korporat`, `email_nonkorporat`, `no_hp`, `photo`, `id_level`, `aktif`, `tanggal_update`, `jam_update`, `user_update`) VALUES
(1, '15051725', '0baea2f0ae20150db78f58cddac442a9', 'Administrator', 'PT PLN (PERSERO) Area Kupang', 'Administrator', 'djoeniar@gmail.com', '', '01212121', NULL, 1, 1, '2017-02-26', '19:27:22', NULL),
(7, '12345678', '1cd8acc9b13c9466aea7e585f0b77ded', 'User SPV', 'PT PLN (PERSERO) WILAYAH NUSA TENGGARA TIMUR', 'Teknisi', 'rikoy@live.com', '', '', NULL, 2, 1, '2017-02-26', '16:00:08', NULL),
(17, '8608036H3', 'e10adc3949ba59abbe56e057f20f883e', 'YOHANES FERNANDES LAY', 'PT PLN (PERSERO) Area Kupang', 'Teknisi', 'rikoy@live.com', 'rikoy@live.com', '0101011', 'icon_6steps-audience.png', 2, 1, '2017-02-28', '14:11:45', '15051725'),
(18, '6789123', '7032fc28dd9088fc965f631d4d912ec5', 'Topan', 'PT PLN (PERSERO) Area Kupang', 'Programmer', 'nelwan.topan@gmail.com', 'nelwan.topan@gmail.com', '08191919911', NULL, 1, 1, '2017-02-26', '19:29:44', '15051725');

--
-- Triggers `users`
--
DROP TRIGGER IF EXISTS `update_tanggal_jam_user`;
DELIMITER //
CREATE TRIGGER `update_tanggal_jam_user` BEFORE UPDATE ON `users`
 FOR EACH ROW SET NEW.tanggal_update = CURDATE(), 
      NEW.jam_update = CURTIME()
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
