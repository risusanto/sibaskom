-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2017 at 12:04 PM
-- Server version: 5.7.17-log
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sibaskom_sertifikat`
--

-- --------------------------------------------------------

--
-- Table structure for table `assesment`
--

CREATE TABLE `assesment` (
  `id_assesment` bigint(20) NOT NULL,
  `nip` varchar(200) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `tanggal_awal_berlaku` date DEFAULT NULL,
  `tanggal_akhir_berlaku` date DEFAULT NULL,
  `hasil_assesment` varchar(255) DEFAULT NULL,
  `rekomendasi` varchar(255) DEFAULT NULL,
  `waktu_alert` date DEFAULT NULL,
  `file_evidence` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `diklat`
--

CREATE TABLE `diklat` (
  `id_diklat` bigint(20) NOT NULL,
  `nip` varchar(200) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `tanggal_awal_berlaku` date DEFAULT NULL,
  `tanggal_akhir_berlaku` date DEFAULT NULL,
  `no_sertifikat` varchar(200) DEFAULT NULL,
  `judul_diklat` varchar(255) DEFAULT NULL,
  `lembaga_penyelenggara` varchar(255) DEFAULT NULL,
  `waktu_alert` date DEFAULT NULL,
  `file_sertifikat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_notifikasi`
--

CREATE TABLE `email_notifikasi` (
  `id_email_notifikasi` int(11) NOT NULL,
  `email1` varchar(200) DEFAULT NULL,
  `email2` varchar(200) DEFAULT NULL,
  `email3` varchar(200) DEFAULT NULL,
  `email4` varchar(200) DEFAULT NULL,
  `email5` varchar(200) DEFAULT NULL,
  `tanggal_update` date DEFAULT NULL,
  `jam_update` time DEFAULT NULL,
  `user_update` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_notifikasi`
--

INSERT INTO `email_notifikasi` (`id_email_notifikasi`, `email1`, `email2`, `email3`, `email4`, `email5`, `tanggal_update`, `jam_update`, `user_update`) VALUES
(1, 'prathrw@gmail.com', '', '', '', '', '2017-11-03', '19:31:13', '15051725');

--
-- Triggers `email_notifikasi`
--
DELIMITER $$
CREATE TRIGGER `update_tanggal_jam_email_notifikasi` BEFORE UPDATE ON `email_notifikasi` FOR EACH ROW SET NEW.tanggal_update = CURDATE(), 
      NEW.jam_update = CURTIME()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fit_and_proper`
--

CREATE TABLE `fit_and_proper` (
  `id_fit_and_proper` bigint(20) NOT NULL,
  `nip` varchar(200) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `job_suksesi` varchar(255) DEFAULT NULL,
  `penguji` varchar(255) DEFAULT NULL,
  `hasil_fit_and_proper` varchar(255) DEFAULT NULL,
  `file_evidence` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `penugasan`
--

CREATE TABLE `penugasan` (
  `id_penugasan` bigint(20) NOT NULL,
  `nip` varchar(200) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `lokasi_penugasan` varchar(255) DEFAULT NULL,
  `tanggal_awal_masa_penugasan` date DEFAULT NULL,
  `proyeksi` varchar(255) DEFAULT NULL,
  `waktu_alert` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `kode_diklat` varchar(250) DEFAULT NULL,
  `judul_diklat` varchar(255) DEFAULT NULL,
  `kode_sertifikat` varchar(250) DEFAULT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `tanggal_mulai_pelatihan` date DEFAULT NULL,
  `masa_belaku_sertifikat` date DEFAULT NULL,
  `masa_alert` smallint(2) DEFAULT NULL COMMENT '0=none; 3=3bulan; 6=6bulan; 12=1tahun',
  `file_sertifikat` varchar(255) DEFAULT NULL,
  `tanggal_update` date DEFAULT NULL,
  `jam_update` time DEFAULT NULL,
  `user_update` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `nip`, `nama`, `unit`, `kode_diklat`, `judul_diklat`, `kode_sertifikat`, `penyelenggara`, `tanggal_mulai_pelatihan`, `masa_belaku_sertifikat`, `masa_alert`, `file_sertifikat`, `tanggal_update`, `jam_update`, `user_update`) VALUES
(6, '8608036H3', 'YOHANES FERNANDES LAY', 'PT PLN (PERSERO) Area Kupang', 'B.1.1.3.69.3.M', 'PENYEGARAN PDKB TM METODE BERJARAK', 'B.1.1.3.69.3.M.03.16.01.8608036H3', 'Udiklat Semarang', '2016-02-15', '2016-05-01', 3, 'masnasabah.pdf', '2017-03-08', '10:52:03', '15051725'),
(5, '6590090H', 'YERMIAS A. CHRISTIAN LUDJI', 'PT PLN (PERSERO) Pusat Listrik Ende', 'B.1.1.3.37.3.M.EL', 'K2 / K3 UNTUK PENGAWAS PEKERJAAN DISTRIBUSI', '-', 'Udiklat Pandaan', '2016-01-01', '2016-06-23', 6, NULL, '2017-02-26', '17:52:42', '15051725'),
(4, '6489029H', 'PHILIPUS FERNANDEZ', 'PT PLN (PERSERO) WILAYAH NUSA TENGGARA TIMUR', 'B.1.1.1.057.3', 'K2K3 Pembangkit', 'B.1.1.1.057.3.07.16.01.6489029H', 'Udiklat Suralaya', '2015-02-01', '2016-01-01', 12, 'Chrysanthemum.jpg', '2017-03-08', '10:53:00', '15051725'),
(8, '9115540ZY', 'BUDI SUTRISNO', 'AREA FBT', NULL, 'SERTIFIKAT KOMPETENSI MEMELIHARA INSTALASI APP ELEKTRONIK FASE SATU DAN FASE TIGA PENGUKURAN LANGSUNG', '1093.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(9, '9115540ZY', 'BUDI SUTRISNO', 'AREA FBT', NULL, 'SERTIFIKAT KOMPETENSI MENGGANTI INSTALASI APP PENGUKURAN LANGSUNG', '1094.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(10, '9115540ZY', 'BUDI SUTRISNO', 'AREA FBT', NULL, 'SERTIFIKAT KOMPETENSI MEMELIHARA SISTEM PEMBUMIAN (ARDE)', '1095.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(11, '9115540ZY', 'BUDI SUTRISNO', 'AREA FBT', NULL, 'SERTIFIKAT KOMPETENSI MENGGANTI KWH METER', '1096.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(12, '9115540ZY', 'BUDI SUTRISNO', 'AREA FBT', NULL, 'SERTIFIKAT KOMPETENSI MENGGANTI SALURAN PELANGGAN TEGANGAN RENDAH', '1097.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(13, '8915342ZY', 'THEO AJI CARAKA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MEMELIHARA INSTALASI APP ELEKTROMEKANIK FASE SATU DAN FASE TIGA PENGUKURAN LANGSUNG', '1153.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(14, '8915342ZY', 'THEO AJI CARAKA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MENGGANTI INSTALASI APP PENGUKURAN LANGSUNG', '1154.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(15, '8915342ZY', 'THEO AJI CARAKA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MEMELIHARA SISTEM PEMBUMIAN (ARDE)', '1155.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(16, '8915342ZY', 'THEO AJI CARAKA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MENGGANTI KWH METER', '1156.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(17, '8915342ZY', 'THEO AJI CARAKA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MENGGANTI SALURAN PELANGGAN TEGANGAN RENDAH', '1157.0.04.D052.03.2015', 'PT. GEMAPEDEKABE', '2015-03-31', '2018-03-31', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(18, '9015736ZY', 'I PUTU GEDE WINDU SUKADINATA', 'SEKTOR NTT', NULL, 'SERTIFIKAT KOMPETENSI MENGUKUR TAHANAN ISOLASI PERALATAN INSTALASI TENAGA LISTRIK (MEGGER)', '0187.0.03.T051.05.2015', 'PT. ELESKA IATKI', '2015-04-05', '2018-04-05', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(19, '9015736ZY', 'I PUTU GEDE WINDU SUKADINATA', 'SEKTOR NTT', NULL, 'SERTIFIKAT KOMPETENSI MENGUKUR TAHANAN PERTANAHAN PERALATAN INSTALASI TENAGA LISTRIK', '0167.0.03.T051.05.2015', 'PT. ELESKA IATKI', '2015-04-05', '2018-04-05', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(20, '9115831ZY', 'VIRTUS GITA ANGGARA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MEMELIHARA INSTALASI KUBIKEL TEGANGAN MENENGAH', '1954.0.04.D052.04.2015', 'PT. GEMAPEDEKABE', '2015-04-25', '2018-04-25', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(21, '9115831ZY', 'VIRTUS GITA ANGGARA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MEMELIHARA INSTALASI PENYULANG TEGANGAN MENENGAH GARDU INDUK DAN PERALATAN LAINNYA', '1955.0.04.D052.04.2015', 'PT. GEMAPEDEKABE', '2015-04-25', '2018-04-25', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(22, '9115831ZY', 'VIRTUS GITA ANGGARA', 'AREA KUPANG', NULL, 'SERTIFIKAT KOMPETENSI MENGGANTI KUBIKEL PENYULANG TEGANGAN MENENGAH GARDU INDUK', '1956.0.04.D052.04.2015', 'PT. GEMAPEDEKABE', '2015-04-25', '2018-04-25', NULL, NULL, '2017-04-19', '13:58:37', '15051725'),
(23, '9115831ZY', 'VIRTUS GITA ANGGARA', 'AREA KUPANG', '0', 'SERTIFIKAT KOMPETENSI MENGGANTI PEMUTUS TENAGA (PMT) DAN PEMISAH (PMS) TEGANGAN MENENGAH GARDU INDUK', '1957.0.04.D052.04.2015', 'PT. GEMAPEDEKABE', '2015-04-25', '2018-01-01', 6, 'SOP_SISTEM_MANAJEMEN_KINERJA_PEGAWAI.pdf', '2017-11-03', '19:34:48', '15051725'),
(64, '123456', 'A', 'b', '0', '3131', '1234', 'ccc', '2017-11-05', '2017-11-20', 3, NULL, '2017-11-05', '19:04:41', '15051725');

--
-- Triggers `sertifikat`
--
DELIMITER $$
CREATE TRIGGER `sertifikat_update_jam_tanggal` BEFORE UPDATE ON `sertifikat` FOR EACH ROW SET NEW.tanggal_update = CURDATE(), 
      NEW.jam_update = CURTIME()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
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
  `user_update` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nik`, `password`, `full_name`, `unit`, `bagian`, `email_korporat`, `email_nonkorporat`, `no_hp`, `photo`, `id_level`, `aktif`, `tanggal_update`, `jam_update`, `user_update`) VALUES
(1, '15051725', '0baea2f0ae20150db78f58cddac442a9', 'Administrator', 'PT PLN (PERSERO) Area Kupang', 'Administrator', 'djoeniar@gmail.com', '', '01212121', NULL, 1, 1, '2017-02-26', '19:27:22', NULL),
(7, '12345678', '1cd8acc9b13c9466aea7e585f0b77ded', 'User SPV', 'PT PLN (PERSERO) WILAYAH NUSA TENGGARA TIMUR', 'Teknisi', 'rikoy@live.com', '', '', NULL, 2, 1, '2017-02-26', '16:00:08', NULL),
(17, '8608036H3', 'e10adc3949ba59abbe56e057f20f883e', 'YOHANES FERNANDES LAY', 'PT PLN (PERSERO) Area Kupang', 'Teknisi', 'rikoy@live.com', 'rikoy@live.com', '0101011', 'icon_6steps-audience.png', 2, 1, '2017-02-28', '14:11:45', '15051725'),
(18, '6789123', '2b165d92e828c00b5b83f9dc3eb7cc20', 'Topan', 'PT PLN (PERSERO) Area Kupang', 'Programmer', 'nelwan.topan@gmail.com', 'nelwan.topan@gmail.com', '08191919911', NULL, 1, 1, '2017-03-15', '02:21:36', '15051725'),
(19, '098710', '2ab03492b2fee1bb56686a84a5f8d16a', 'fulan', 'area kupang', 'pelayanan pelanggan', 'fulan@yahoo.com', 'fulan@yahoo.com', '08112397401', NULL, 2, 1, '2017-03-15', '02:27:09', '15051725'),
(22, '123456', 'e10adc3949ba59abbe56e057f20f883e', 'a', 'b', 'v', 'deinatraumen@gmail.com', 'deinatraumen@gmail.com', '123', 'line_15084093790981.jpeg', 2, 0, '2017-11-07', '15:36:45', '15051725'),
(21, '220212', '25d55ad283aa400af464c76d713c07ad', 'Habibb', 'h', 'h', 'rm.habibb@ymail.com', '', '', NULL, 2, 0, '2017-11-03', '16:00:56', '15051725');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `update_tanggal_jam_user` BEFORE UPDATE ON `users` FOR EACH ROW SET NEW.tanggal_update = CURDATE(), 
      NEW.jam_update = CURTIME()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assesment`
--
ALTER TABLE `assesment`
  ADD PRIMARY KEY (`id_assesment`);

--
-- Indexes for table `diklat`
--
ALTER TABLE `diklat`
  ADD PRIMARY KEY (`id_diklat`);

--
-- Indexes for table `email_notifikasi`
--
ALTER TABLE `email_notifikasi`
  ADD PRIMARY KEY (`id_email_notifikasi`);

--
-- Indexes for table `fit_and_proper`
--
ALTER TABLE `fit_and_proper`
  ADD PRIMARY KEY (`id_fit_and_proper`);

--
-- Indexes for table `penugasan`
--
ALTER TABLE `penugasan`
  ADD PRIMARY KEY (`id_penugasan`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `nik` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assesment`
--
ALTER TABLE `assesment`
  MODIFY `id_assesment` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `diklat`
--
ALTER TABLE `diklat`
  MODIFY `id_diklat` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_notifikasi`
--
ALTER TABLE `email_notifikasi`
  MODIFY `id_email_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fit_and_proper`
--
ALTER TABLE `fit_and_proper`
  MODIFY `id_fit_and_proper` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id_penugasan` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
