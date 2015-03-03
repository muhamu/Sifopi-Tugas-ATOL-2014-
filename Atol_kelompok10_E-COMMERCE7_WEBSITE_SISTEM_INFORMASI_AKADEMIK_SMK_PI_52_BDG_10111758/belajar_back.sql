-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2014 at 05:54 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `belajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE IF NOT EXISTS `absen` (
  `nis` varchar(20) NOT NULL,
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `sakit` varchar(10) NOT NULL,
  `izin` varchar(10) NOT NULL,
  `alpha` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `akademi`
--

CREATE TABLE IF NOT EXISTS `akademi` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `kegiatan` text NOT NULL,
  `tgl_akhir` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buku_perpustakaan`
--

CREATE TABLE IF NOT EXISTS `buku_perpustakaan` (
  `id_buku` int(50) NOT NULL AUTO_INCREMENT,
  `jdl_buku` varchar(30) NOT NULL,
  `kode_buku` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `tgl_buku` varchar(30) NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE IF NOT EXISTS `daftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `no_induk` varchar(20) NOT NULL,
  `lahir` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telepon` varchar(30) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `pelajaran` varchar(30) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `no_induk`, `lahir`, `tgl`, `alamat`, `email`, `no_telepon`, `foto`, `pelajaran`, `golongan`, `tgl_masuk`, `status`, `agama`, `jenis_kelamin`) VALUES
(1, 'Uni Nisrina', '1012344552', 'Bandung', '2014-06-11', 'Bandung', 'uni@uni.com', '0897346462334', '', 'Biologi', 'IIIA', '2014-06-06', 'Lajang', 'Islam', 'Wanita'),
(11, 'Uun Indrawan', '214123455', 'Bandung', '1990-09-09', 'Situgunting', 'guru@guru.guru', '08945633234', '214123455.', 'Matematika', 'IIA', '2010-06-07', '', 'Islam', 'Pria');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` int(50) NOT NULL AUTO_INCREMENT,
  `id_pljrn_kelas` varchar(30) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` time NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(10) NOT NULL,
  `no_ruangan` varchar(25) NOT NULL,
  `id_kelas` varchar(25) NOT NULL,
  `wali` varchar(20) NOT NULL,
  `ajaran` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `no_ruangan`, `id_kelas`, `wali`, `ajaran`) VALUES
(1, '3 RPL', '101110001', '002', 'Pepe Jarra Milo', '2014'),
(2, '3 TKJ', '100111002', '001', 'Gugun Gunawan', '2011'),
(4, '1 TKJ', '10112330322', '003', 'Gusti Randa', '2013'),
(6, '3 KWU', '102344423', '009', 'Jujun Junaedi', '2013'),
(7, '3 KWU', '10112330322', '003', 'Gusti Randa', '2013'),
(9, '3 KWU', '10112330322', '003', 'Gusti Randa', '2013'),
(11, '3 KWU', '10112330322', '003', 'Gusti Randa', '2013');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE IF NOT EXISTS `kurikulum` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(10) NOT NULL,
  `kurikulum` text NOT NULL,
  `id_pelajaran` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mata_pelajaran` varchar(25) NOT NULL,
  `kategori_pelajaran` varchar(30) NOT NULL,
  `id_pelajaran` varchar(25) NOT NULL,
  `ajaran` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE IF NOT EXISTS `murid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_induk` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `lahir` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `nama_ayah` varchar(30) NOT NULL,
  `nama_ibu` varchar(30) NOT NULL,
  `pekerjaan_ayah` varchar(30) NOT NULL,
  `pekerjaan_ibu` varchar(30) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `angkatan` varchar(19) NOT NULL,
  `approve` varchar(2) NOT NULL,
  `active` varchar(2) NOT NULL,
  `jenis_kelamin` varchar(6) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `no_telepon_wali` varchar(30) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `nama_wali` varchar(30) NOT NULL,
  `alamat_wali` text NOT NULL,
  `pekerjaan_wali` varchar(20) NOT NULL,
  `anak_ke` varchar(30) NOT NULL,
  `status_anak` varchar(20) NOT NULL,
  `di_kelas` varchar(10) NOT NULL,
  `nama_sekolah_asal` varchar(30) NOT NULL,
  `alamat_sekolah_asal` text NOT NULL,
  `alamat_orang_tua` text NOT NULL,
  `no_telepon_orang_tua` varchar(30) NOT NULL,
  PRIMARY KEY (`id`,`no_induk`),
  KEY `no_induk` (`no_induk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id`, `no_induk`, `nama`, `lahir`, `tgl`, `alamat`, `no_telepon`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `kelas`, `email`, `foto`, `angkatan`, `approve`, `active`, `jenis_kelamin`, `agama`, `tgl_masuk`, `no_telepon_wali`, `golongan_darah`, `nama_wali`, `alamat_wali`, `pekerjaan_wali`, `anak_ke`, `status_anak`, `di_kelas`, `nama_sekolah_asal`, `alamat_sekolah_asal`, `alamat_orang_tua`, `no_telepon_orang_tua`) VALUES
(1, '214123457', 'Ujang', 'Bandung', '1990-09-09', 'Situgunting', '08945633234', 'Handoko', 'Unin', 'Haji', 'Haji', '3 TKJ', 'asa@asda.com', '214123457.jpg', '2011', '', '', 'Wanita', 'Islam', '2014-06-14', '355', 'B', 'Unin', 'Situgunting', '35325', '3', 'Kandung', '3 KWU', 'SMPN 24 Bandung', 'Situgunting', 'Situgunting', '32253253'),
(2, '214123455', 'Muhammad Haikal', 'bandung', '1994-06-20', 'Situgunting', '08945633234', 'Handoko', 'Unin', 'Haji', 'Haji', '2 TKJ', 'guru@guru.guru', '214123455.jpg', '2011', '', '', 'Pr', '', '2014-06-14', '355', '', 'Unin', 'Situgunting', '35325', '4', '35', '3 KWU', 'SMPN 24 Bandung', 'Situgunting', 'Situgunting', '32253253'),
(3, '214123155', 'Jujun', 'bandung', '1990-09-09', 'Situgunting', '08945633234', 'Handoko', 'Unin', 'Haji', 'Haji', '3 TKJ', 'asa@asda.com', '214123155.jpg', '2011', '', '', 'Pr', 'Islam', '2014-06-14', '355', '', 'Unin', 'Situgunting', '35325', '4', 'Kandung', '3 KWU', 'SMPN 24 Bandung', 'Situgunting', 'Situgunting', '32253253'),
(4, '214123458', 'Uun Indrawan', 'Bandung', '1990-09-09', 'Situgunting', '08945633234', 'Handoko', 'Unin', 'Haji', 'Haji', '3 TKJ', 'guru@guru.guru', '214123458.jpg', '2011', '', '', 'Pria', 'Islam', '2010-06-07', '355', 'AB', 'Unin', 'Situgunting', '35325', '4', 'Kandung', '3 KWU', 'SMPN 24 Bandung', 'Situgunting', 'Situgunting', '32253253');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `no_induk` varchar(25) NOT NULL,
  `id_pelajaran` varchar(10) NOT NULL,
  `tugas` double NOT NULL,
  `uts` double NOT NULL,
  `uas` double NOT NULL,
  `rata_rata` double NOT NULL,
  `id_kelas` varchar(20) NOT NULL,
  `semester` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_induk` (`no_induk`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `no_induk`, `id_pelajaran`, `tugas`, `uts`, `uas`, `rata_rata`, `id_kelas`, `semester`) VALUES
(1, '214123457', '1234', 12, 12, 12, 12, '003', '3');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran_kelas`
--

CREATE TABLE IF NOT EXISTS `pelajaran_kelas` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_kelas` varchar(25) NOT NULL,
  `id_pelajaran` varchar(30) NOT NULL,
  `nama_guru` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_lain`
--

CREATE TABLE IF NOT EXISTS `pembayaran_lain` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `pembayaran` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `total` varchar(20) NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `denda` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `seleksi`
--

CREATE TABLE IF NOT EXISTS `seleksi` (
  `id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(30) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE IF NOT EXISTS `spp` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `no_induk` varchar(30) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `bayar` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id_ajaran` int(50) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(30) NOT NULL,
  PRIMARY KEY (`id_ajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `no_hp` bigint(14) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `fullname`, `agama`, `no_hp`) VALUES
(3, 'admin', 'admin', 'admin@admin.com', 'administrator', 'islam', 81234567891),
(6, 'sffsf', 'fsfs', 'sfsf@dgmasm.com', 'sfsf', 'sfsf', 10111245),
(5, 'haikal', 'haikal', 'muhamu@outlook.com', 'Muhammad Haikal', 'islam', 28),
(7, 'guru', 'guru', 'guru@guru.guru', 'guru', 'guru', 8986557);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`no_induk`) REFERENCES `murid` (`no_induk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
