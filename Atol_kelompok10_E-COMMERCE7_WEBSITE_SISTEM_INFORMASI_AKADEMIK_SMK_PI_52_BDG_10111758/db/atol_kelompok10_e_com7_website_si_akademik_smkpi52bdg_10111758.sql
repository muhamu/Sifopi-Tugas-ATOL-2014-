/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : atol_kelompok10_e_com7_website_si_akademik_smkpi52bdg_10111758

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-06-26 11:15:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `absen`
-- ----------------------------
DROP TABLE IF EXISTS `absen`;
CREATE TABLE `absen` (
  `nis` varchar(20) NOT NULL,
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `sakit` varchar(10) NOT NULL,
  `izin` varchar(10) NOT NULL,
  `alpha` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nis` (`nis`) USING BTREE,
  CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `murid` (`no_induk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`id`) REFERENCES `murid` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of absen
-- ----------------------------
INSERT INTO `absen` VALUES ('214123451', '1', '1', '2', '3', '0');
INSERT INTO `absen` VALUES ('214123452', '2', '1', '3', '4', '0');
INSERT INTO `absen` VALUES ('214123453', '3', '1', '1', '1', '0');

-- ----------------------------
-- Table structure for `akademi`
-- ----------------------------
DROP TABLE IF EXISTS `akademi`;
CREATE TABLE `akademi` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `kegiatan` text NOT NULL,
  `tgl_akhir` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of akademi
-- ----------------------------
INSERT INTO `akademi` VALUES ('1', 'Cakrawala 2014', '2014-06-26', 'Hiburan', '2014-06-28');
INSERT INTO `akademi` VALUES ('2', 'Ujian Nasional', '2014-03-05', 'Akademik', '2014-03-07');

-- ----------------------------
-- Table structure for `buku_perpustakaan`
-- ----------------------------
DROP TABLE IF EXISTS `buku_perpustakaan`;
CREATE TABLE `buku_perpustakaan` (
  `id_buku` int(50) NOT NULL AUTO_INCREMENT,
  `jdl_buku` varchar(30) NOT NULL,
  `kode_buku` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `tgl_buku` date NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=10104 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of buku_perpustakaan
-- ----------------------------
INSERT INTO `buku_perpustakaan` VALUES ('10101', 'Buka Mata Hati', 'K001', 'Asep Sunarya', '12344055-1344504', '2013-01-07');
INSERT INTO `buku_perpustakaan` VALUES ('10102', 'Dream Catcher', 'K002', 'Jusuf Kalla', '12445567654-875548', '2014-06-11');
INSERT INTO `buku_perpustakaan` VALUES ('10103', 'Laskar Pelangi', 'K003', 'Bentang Pustaka', '1243535666 - 3636677', '0000-00-00');

-- ----------------------------
-- Table structure for `daftar`
-- ----------------------------
DROP TABLE IF EXISTS `daftar`;
CREATE TABLE `daftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nama` (`nama`) USING BTREE,
  KEY `tgl_daftar` (`tgl_daftar`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of daftar
-- ----------------------------
INSERT INTO `daftar` VALUES ('1', 'Uun Indrawan', '2008-07-20');
INSERT INTO `daftar` VALUES ('2', 'Usman', '2008-07-20');
INSERT INTO `daftar` VALUES ('3', 'Mario Goetze', '2010-07-20');

-- ----------------------------
-- Table structure for `guru`
-- ----------------------------
DROP TABLE IF EXISTS `guru`;
CREATE TABLE `guru` (
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
  PRIMARY KEY (`id`),
  KEY `nama` (`nama`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of guru
-- ----------------------------
INSERT INTO `guru` VALUES ('1', 'Uni Nisrina', '1012344551', 'Bandung', '1989-06-13', 'Kacapiring', 'uni@uni.com', '0897346462334', '', 'Matematika', 'IIA', '2014-06-06', 'Lajang', 'Islam', 'Wanita');
INSERT INTO `guru` VALUES ('2', 'Uun Indrawan', '1012344552', 'Sukabumi', '1990-09-09', 'Situgunting', 'guru@guru.guru', '08945633234', '214123455.', 'Matematika', 'IIA', '2010-06-07', 'Lajang', 'Islam', 'Pria');
INSERT INTO `guru` VALUES ('3', 'Mujiono', '1012344553', 'Bandung', '1980-10-24', 'Tegal', 'muji@bosendipuji.com', '0897346462334', '', 'Otomotif', 'Honorer', '2013-06-05', 'Lajang', 'Kristen', 'Pria');
INSERT INTO `guru` VALUES ('4', 'asd', '1012', 'asd', '0000-00-00', 'aasdada', 'asd@asd.vom', '9000', '1012.', 'Kewarganegaraan', 'IIIA', '2008-08-01', '', 'Kristen (K', 'Pria');
INSERT INTO `guru` VALUES ('5', 'Ibing Suribing Sutisna', '1012344554', 'Bandung', '2014-03-01', 'Situgunting', 'ibing@aol.com', '08945633234', '1012344554.', 'Bhs. Indonesia', 'IIA', '2008-08-01', '', 'Islam', 'Pria');

-- ----------------------------
-- Table structure for `jadwal`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `id_jadwal` int(50) NOT NULL AUTO_INCREMENT,
  `id_pljrn_kelas` varchar(30) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` time NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_pljrn_kelas` (`id_pljrn_kelas`) USING BTREE,
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_pljrn_kelas`) REFERENCES `pelajaran_kelas` (`id_pljrn_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal
-- ----------------------------
INSERT INTO `jadwal` VALUES ('1', '00010', 'Senin', '07:01:39');
INSERT INTO `jadwal` VALUES ('2', '00010', 'Minggu', '12:00:00');
INSERT INTO `jadwal` VALUES ('3', '00010', 'Jumat', '12:00:00');
INSERT INTO `jadwal` VALUES ('4', '00010', 'Rabu', '13:00:00');
INSERT INTO `jadwal` VALUES ('5', '00010', '', '00:00:00');

-- ----------------------------
-- Table structure for `kelas`
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(10) NOT NULL,
  `no_ruangan` varchar(25) NOT NULL,
  `id_kelas` varchar(25) NOT NULL,
  `wali` varchar(20) NOT NULL,
  `ajaran` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelas` (`id_kelas`) USING BTREE,
  KEY `nama_kelas` (`nama_kelas`) USING BTREE,
  KEY `nama_kelas_2` (`nama_kelas`,`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES ('1', '1 TKJ', '101110001', '001', 'Jujun Junaedi', '2014');
INSERT INTO `kelas` VALUES ('2', '2 TKJ', '100111002', '002', 'Hermawan', '2014');
INSERT INTO `kelas` VALUES ('3', '3 TKJ', '101110003', '003', 'Ferdianto', '2014');
INSERT INTO `kelas` VALUES ('4', '1 TMO', '100111004', '004', 'Mumun Suyrana', '2014');
INSERT INTO `kelas` VALUES ('5', '2 TMO', '100111005', '005', 'Mulyana', '2014');
INSERT INTO `kelas` VALUES ('6', '3 TMO', '101110006', '006', 'Purkon Jajuli', '2014');
INSERT INTO `kelas` VALUES ('7', '1 TL', '101110007', '007', 'Kurawa', '2014');
INSERT INTO `kelas` VALUES ('8', '2 TL', '101110008', '008', 'Joko Widodo', '2014');
INSERT INTO `kelas` VALUES ('9', '3 TL', '101111009', '008', 'Prabowo', '2014');

-- ----------------------------
-- Table structure for `kurikulum`
-- ----------------------------
DROP TABLE IF EXISTS `kurikulum`;
CREATE TABLE `kurikulum` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(10) NOT NULL,
  `kurikulum` text NOT NULL,
  `id_pelajaran` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kurikulum
-- ----------------------------
INSERT INTO `kurikulum` VALUES ('1', '1 TKJ', '2010', '013011');
INSERT INTO `kurikulum` VALUES ('2', '3 TKJ', 'KTSP', '012011');
INSERT INTO `kurikulum` VALUES ('3', '1 TMO', 'KTSP', '013452');
INSERT INTO `kurikulum` VALUES ('4', '1 TMO', '2010', '013044');

-- ----------------------------
-- Table structure for `mapel`
-- ----------------------------
DROP TABLE IF EXISTS `mapel`;
CREATE TABLE `mapel` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `mata_pelajaran` varchar(25) NOT NULL,
  `kategori_pelajaran` varchar(30) NOT NULL,
  `id_pelajaran` varchar(25) NOT NULL,
  `ajaran` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pelajaran` (`id_pelajaran`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mapel
-- ----------------------------
INSERT INTO `mapel` VALUES ('1', 'Bhs. Indonesia', 'MPDU', '012011', '2014');
INSERT INTO `mapel` VALUES ('2', 'Otomotif', 'Kejuruan', '013011', '2014');
INSERT INTO `mapel` VALUES ('3', 'Praktikum Jarkom', 'Kejuruan', '013012', '2014');
INSERT INTO `mapel` VALUES ('4', 'Agama', 'MPDU', '012001', '2014');
INSERT INTO `mapel` VALUES ('5', 'Kelistrikan', 'Listrik', '013033', '2014');
INSERT INTO `mapel` VALUES ('6', 'MPPC', 'Kejuruan', '013033', '2014');
INSERT INTO `mapel` VALUES ('7', 'Kewirausahaan', 'MPDU', '012002', '2014');
INSERT INTO `mapel` VALUES ('8', 'Elektronika Lanjut', 'Kejuruan', '013044', '2014');
INSERT INTO `mapel` VALUES ('9', 'Bhs. Indonesia', 'MPDU', '012037', '2013');

-- ----------------------------
-- Table structure for `murid`
-- ----------------------------
DROP TABLE IF EXISTS `murid`;
CREATE TABLE `murid` (
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
  KEY `no_induk` (`no_induk`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `nama` (`nama`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of murid
-- ----------------------------
INSERT INTO `murid` VALUES ('1', '214123451', 'Muhammad Anuur', 'Bandung', '1993-09-09', 'Kacapiring', '08945633234', 'Duleh', 'Nining', 'Pengusaha', 'Juragan Kupat', '3 TKJ', 'asa@asda.com', '214123457.jpg', '2014', '', '', 'Pria', 'Islam', '2014-06-14', '089895355353', 'Pr', 'Ijim Surijim', 'Kacapiring', 'Penambang Duit', '3', 'Kandung', '3 SMP', 'SMPN 1 Nabire', 'Nabire', 'Kacapiring', '08932253253');
INSERT INTO `murid` VALUES ('2', '214123452', 'Muhammad Haikal', 'Bandung', '1994-06-20', 'Situgunting', '08945633234', 'Handoko', 'Unin', 'Agen Asuransi', 'Guru', '3 TKJ', 'guru@guru.guru', '214123455.jpg', '2014', '', '', 'Pria', 'Islam', '2014-06-14', '089895355355', 'AB', 'Kurwa', 'Situgunting', 'Pengusaha', '4', 'Kandung', '3 SMP', 'SMPN 24 Bandung', 'Situgunting', 'Situgunting', '08532253253');
INSERT INTO `murid` VALUES ('3', '214123453', 'Muhamad Usman Sepen Sepen', 'Bandung', '1990-09-09', 'Situ Aksan', '08945633234', 'Umuh', 'Imas', 'Haji', 'Ibu Rumah Tangga', '3 TMO', 'asa@asda.com', '214123155.jpg', '2014', '', '', 'Pria', 'Islam', '2014-06-14', '089895355358', 'O', 'Sololin', 'Situ Aksan', 'Pemilik Toko', '4', 'Kandung', '3 SMP', 'SMPN 18 Bandung', 'Jurang', 'Situ Aksan', '08232253253');
INSERT INTO `murid` VALUES ('4', '214123454', 'Santar Jyu', 'Bandung', '1990-09-09', 'Karawang', '08945633234', 'Imin', 'Ngantini', 'Broker', 'Ibu Rumah Tangga', '2 TKJ', 'guru@gurus.guru', '214123458.jpg', '2014', '', '', 'Pria', 'Islam', '2010-06-07', '089895355351', 'Pr', 'Tiesto', 'Karawang', 'Disc Jockey', '5', 'Kandung', '3 SMP', 'SMPN 3 Karawang', 'Rengat', 'Rengat', '08632253253');

-- ----------------------------
-- Table structure for `nilai`
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `no_induk` varchar(25) NOT NULL,
  `id_pelajaran` varchar(10) NOT NULL,
  `tugas` double NOT NULL,
  `uts` double NOT NULL,
  `uas` double NOT NULL,
  `nilai_akhir` double NOT NULL,
  `id_kelas` varchar(20) NOT NULL,
  `semester` varchar(3) NOT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_induk` (`no_induk`) USING BTREE,
  KEY `id_kelas` (`id_kelas`) USING BTREE,
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`no_induk`) REFERENCES `murid` (`no_induk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nilai
-- ----------------------------
INSERT INTO `nilai` VALUES ('1', '214123451', '012011', '56', '78', '78', '63.6', '001', '3', 'LULUS');
INSERT INTO `nilai` VALUES ('2', '214123452', '013011', '30', '70', '70', '51', '003', '2', 'TIDAK LULUS');
INSERT INTO `nilai` VALUES ('3', '214123453', '013012', '70', '90', '90', '75', '003', '2', 'LULUS');

-- ----------------------------
-- Table structure for `pelajaran_kelas`
-- ----------------------------
DROP TABLE IF EXISTS `pelajaran_kelas`;
CREATE TABLE `pelajaran_kelas` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_kelas` varchar(25) NOT NULL,
  `id_pelajaran` varchar(30) NOT NULL,
  `nama_guru` varchar(30) NOT NULL,
  `id_pljrn_kelas` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelas` (`id_kelas`) USING BTREE,
  KEY `id_pljrn_kelas` (`id_pljrn_kelas`) USING BTREE,
  CONSTRAINT `pelajaran_kelas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pelajaran_kelas
-- ----------------------------
INSERT INTO `pelajaran_kelas` VALUES ('1', '003', '013011', 'Uun', '00010');

-- ----------------------------
-- Table structure for `pembayaran_lain`
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran_lain`;
CREATE TABLE `pembayaran_lain` (
  `no_induk` int(50) NOT NULL AUTO_INCREMENT,
  `pembayaran` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `total` varchar(20) NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `denda` varchar(30) NOT NULL,
  PRIMARY KEY (`no_induk`)
) ENGINE=InnoDB AUTO_INCREMENT=214123458 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pembayaran_lain
-- ----------------------------
INSERT INTO `pembayaran_lain` VALUES ('214123451', 'SPP', 'First Installment', '1000000', '2013-06-11', '2013-07-08', '0');
INSERT INTO `pembayaran_lain` VALUES ('214123452', 'SPP', 'Telat 3 Bulan', '120000', '2013-06-11', '2013-07-08', '0');
INSERT INTO `pembayaran_lain` VALUES ('214123453', 'SPP', 'First Installment', '1000000', '2013-06-11', '2013-07-07', '0');
INSERT INTO `pembayaran_lain` VALUES ('214123454', 'SPP', 'First Installment', '1000000', '2013-06-11', '2013-07-07', 'denda');
INSERT INTO `pembayaran_lain` VALUES ('214123457', 'SPP', 'Telat 2 Bulan', '90000', '2013-06-11', '2013-07-07', 'denda');

-- ----------------------------
-- Table structure for `seleksi`
-- ----------------------------
DROP TABLE IF EXISTS `seleksi`;
CREATE TABLE `seleksi` (
  `id` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(30) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tgl_daftar` (`tgl_daftar`) USING BTREE,
  CONSTRAINT `seleksi_ibfk_1` FOREIGN KEY (`id`) REFERENCES `daftar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `seleksi_ibfk_2` FOREIGN KEY (`tgl_daftar`) REFERENCES `daftar` (`tgl_daftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of seleksi
-- ----------------------------
INSERT INTO `seleksi` VALUES ('1', 'Uun', '2008-07-20', 'LULUS', '2008-08-01');
INSERT INTO `seleksi` VALUES ('2', 'Usman', '2010-07-20', 'TIDAK LULUS', '2008-08-01');
INSERT INTO `seleksi` VALUES ('3', 'Mario', '2008-07-20', 'LULUS', '0000-00-00');

-- ----------------------------
-- Table structure for `spp`
-- ----------------------------
DROP TABLE IF EXISTS `spp`;
CREATE TABLE `spp` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `no_induk` varchar(30) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `bayar` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of spp
-- ----------------------------
INSERT INTO `spp` VALUES ('1', 'Ujang', '214123457', '3 RPL', 'Januari', '45000', '2014-06-24');
INSERT INTO `spp` VALUES ('2', 'Muhamad', '214123451', '2 TKJ', 'April', '45000', '2014-03-01');
INSERT INTO `spp` VALUES ('3', 'Muhammad', '214123455', '3 TKJ', 'Juni', '45000', '2014-03-01');
INSERT INTO `spp` VALUES ('4', 'Muhamad', '214123453', '2 TKJ', 'Juni', '45000', '0000-00-00');

-- ----------------------------
-- Table structure for `tahun_ajaran`
-- ----------------------------
DROP TABLE IF EXISTS `tahun_ajaran`;
CREATE TABLE `tahun_ajaran` (
  `id_ajaran` int(50) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(30) NOT NULL,
  PRIMARY KEY (`id_ajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tahun_ajaran
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `no_hp` bigint(14) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('3', 'admin', 'admin', 'admin@admin.com', 'administrator', 'islam', '81234567891');
INSERT INTO `user` VALUES ('6', 'sffsf', 'fsfs', 'sfsf@dgmasm.com', 'sfsf', 'sfsf', '10111245');
INSERT INTO `user` VALUES ('5', 'haikal', 'haikal', 'muhamu@outlook.com', 'Muhammad Haikal', 'islam', '28');
INSERT INTO `user` VALUES ('7', 'guru', 'guru', 'guru@guru.guru', 'guru', 'guru', '8986557');

-- ----------------------------
-- View structure for `view_kenaikan`
-- ----------------------------
DROP VIEW IF EXISTS `view_kenaikan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kenaikan` AS select `murid`.`no_induk` AS `no_induk`,`murid`.`nama` AS `nama`,`kelas`.`nama_kelas` AS `nama_kelas`,`mapel`.`mata_pelajaran` AS `mata_pelajaran`,`nilai`.`nilai_akhir` AS `nilai_akhir`,`nilai`.`semester` AS `semester`,`nilai`.`status` AS `status` from (((`murid` join `nilai` on((`murid`.`no_induk` = `nilai`.`no_induk`))) join `kelas` on((`nilai`.`id_kelas` = `kelas`.`id_kelas`))) join `mapel` on((`nilai`.`id_pelajaran` = `mapel`.`id_pelajaran`))) ;
