/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : depnaker_rumahtanggan

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2017-06-29 23:02:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `booking_ruangans`
-- ----------------------------
DROP TABLE IF EXISTS `booking_ruangans`;
CREATE TABLE `booking_ruangans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `kode_booking` varchar(50) DEFAULT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
  `direktorat` varchar(10) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `tgl_book` datetime DEFAULT NULL,
  `jam_book` time DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `jml_peserta` int(11) DEFAULT NULL,
  `agenda_meeting` text,
  `status` int(1) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ruangan_id` (`ruangan_id`),
  CONSTRAINT `booking_ruangans_ibfk_1` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of booking_ruangans
-- ----------------------------
INSERT INTO `booking_ruangans` VALUES ('1', '1', 'BOOK1', '1', 'gdfhfg', 'ggdf', '2017-06-26 00:00:00', '01:00:00', '1', '3', 'gfdgdf', '0', null, '2017-06-23 10:31:16', null, null);

-- ----------------------------
-- Table structure for `jadwal_tugas`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_tugas`;
CREATE TABLE `jadwal_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jadwal` varchar(50) DEFAULT NULL,
  `bulan_tugas` varchar(2) DEFAULT NULL,
  `tahun_tugas` varchar(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_tugas
-- ----------------------------

-- ----------------------------
-- Table structure for `jadwal_tugas_details`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_tugas_details`;
CREATE TABLE `jadwal_tugas_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_tugas_id` int(11) DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `petugas_id` (`petugas_id`),
  KEY `jadwal_tugas_id` (`jadwal_tugas_id`),
  CONSTRAINT `jadwal_tugas_details_ibfk_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jadwal_tugas_details_ibfk_2` FOREIGN KEY (`jadwal_tugas_id`) REFERENCES `jadwal_tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_tugas_details
-- ----------------------------

-- ----------------------------
-- Table structure for `jenis_barangs`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_barangs`;
CREATE TABLE `jenis_barangs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis` varchar(50) DEFAULT NULL,
  `nama_jenis` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_barangs
-- ----------------------------
INSERT INTO `jenis_barangs` VALUES ('1', 'BR1', 'ATK Kantor', '2017-06-23 23:01:55', '1', '2017-06-23 23:40:10', '1');

-- ----------------------------
-- Table structure for `jenis_kendaraans`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_kendaraans`;
CREATE TABLE `jenis_kendaraans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis` varchar(50) DEFAULT NULL,
  `nama_jenis` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_kendaraans
-- ----------------------------

-- ----------------------------
-- Table structure for `kendaraans`
-- ----------------------------
DROP TABLE IF EXISTS `kendaraans`;
CREATE TABLE `kendaraans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kendaraan` varchar(50) DEFAULT NULL,
  `jns_kendaraan_id` int(11) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `tahun` varchar(5) DEFAULT NULL,
  `nup` varchar(50) DEFAULT NULL,
  `no_pol` varchar(10) DEFAULT NULL,
  `no_mesin` varchar(20) DEFAULT NULL,
  `no_chasis` varchar(20) DEFAULT NULL,
  `kondisi` varchar(150) DEFAULT NULL,
  `pemegang` varchar(50) DEFAULT NULL,
  `direktorat` varchar(10) DEFAULT NULL,
  `masa_stnk` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kendaraans_ibfk_1` (`jns_kendaraan_id`),
  CONSTRAINT `kendaraans_ibfk_1` FOREIGN KEY (`jns_kendaraan_id`) REFERENCES `jenis_kendaraans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kendaraans
-- ----------------------------

-- ----------------------------
-- Table structure for `modules`
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `module_alias` varchar(50) DEFAULT NULL,
  `module_url` varchar(50) DEFAULT NULL,
  `no_urut` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', null, 'master', 'Master', null, '2');
INSERT INTO `modules` VALUES ('2', '1', 'ruangan', 'Nama Ruangan', 'ruangan', '1');
INSERT INTO `modules` VALUES ('3', '1', 'petugas_cleaning', 'Petugas Cleaning', 'petugas_cleaning', '2');
INSERT INTO `modules` VALUES ('4', '1', 'petugas_security', 'Petugas Security', 'petugas_security', '3');
INSERT INTO `modules` VALUES ('5', '0', 'dashboard', 'Dashboard', 'dashboard', '1');
INSERT INTO `modules` VALUES ('6', null, 'pengadaan_barang', 'Pengadaaan Barang', 'pengadaan_barang', '3');
INSERT INTO `modules` VALUES ('7', null, 'booking_ruangan_meeting', 'Booking Ruangan Meeting', null, '4');
INSERT INTO `modules` VALUES ('8', '7', 'booking_ruangan', 'Booking Ruangan', 'booking_ruangan', '1');
INSERT INTO `modules` VALUES ('9', '7', 'booking_ruangan_history', 'Histori Booking Ruangan', 'booking_ruangan_history', '2');

-- ----------------------------
-- Table structure for `notifs`
-- ----------------------------
DROP TABLE IF EXISTS `notifs`;
CREATE TABLE `notifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `notif_type_id` int(11) DEFAULT NULL,
  `notif_desc` text,
  `notif_url` varchar(150) DEFAULT NULL,
  `notif_status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifs_ibfk_1` (`notif_type_id`),
  CONSTRAINT `notifs_ibfk_1` FOREIGN KEY (`notif_type_id`) REFERENCES `notif_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notifs
-- ----------------------------

-- ----------------------------
-- Table structure for `notif_types`
-- ----------------------------
DROP TABLE IF EXISTS `notif_types`;
CREATE TABLE `notif_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) DEFAULT NULL,
  `type_desc` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notif_types
-- ----------------------------

-- ----------------------------
-- Table structure for `pengadaan_barangs`
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan_barangs`;
CREATE TABLE `pengadaan_barangs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengadaan` varchar(50) DEFAULT NULL,
  `tgl_pengadaan` datetime DEFAULT NULL,
  `jenis_barang_id` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `direktorat` varchar(100) DEFAULT NULL,
  `nama_pemesan` varchar(50) DEFAULT NULL,
  `alasan_pengadaan` text,
  `spesifikasi` text,
  `status` varchar(1) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `kode_terima` varchar(50) DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `keterangan` text,
  `bukti_foto` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_barang_id` (`jenis_barang_id`),
  CONSTRAINT `pengadaan_barangs_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengadaan_barangs
-- ----------------------------
INSERT INTO `pengadaan_barangs` VALUES ('1', 'REQ1', '2017-06-01 00:00:00', '1', 'buku tulis kosong', 'sinar dunia emas', '5', 'GA', 'yuvita', 'skdskdlsk', 'dskdlskdlskd', 'R', 'tdk sesuai', null, null, null, null, '2017-06-24 17:01:22', '1', '2017-06-28 11:22:37', '1');
INSERT INTO `pengadaan_barangs` VALUES ('2', 'REQ2', null, '1', 'rak mejakuu', null, null, 'IT', 'yuvita dyah', null, null, 'S', null, null, '2017-06-29 03:26:41', 'urgivnif', 'Capture.PNG', '2017-06-24 17:03:07', '1', '2017-06-29 16:10:42', '1');

-- ----------------------------
-- Table structure for `perawatan_barangs`
-- ----------------------------
DROP TABLE IF EXISTS `perawatan_barangs`;
CREATE TABLE `perawatan_barangs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_perawatan` varchar(50) DEFAULT NULL,
  `tgl_perawatan` datetime DEFAULT NULL,
  `jenis_barang_id` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `direktorat` varchar(100) DEFAULT NULL,
  `alasan_perawatan` text,
  `lokasi` varchar(150) DEFAULT NULL,
  `bukti_foto_sebelum` varchar(150) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `alasan_reject` varchar(100) DEFAULT NULL,
  `keterangan_selesai` varchar(100) DEFAULT NULL,
  `bukti_foto_sesudah` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_barang_id` (`jenis_barang_id`),
  CONSTRAINT `perawatan_barangs_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perawatan_barangs
-- ----------------------------
INSERT INTO `perawatan_barangs` VALUES ('2', 'MNT1', '2017-06-29 00:00:00', '1', 'rak mejakuu', 'yuvita dyah', 'IT', 'karena rusak', 'lt 2', null, 'A', null, null, null, '2017-06-29 07:16:24', '1', '2017-06-29 17:16:38', '1');

-- ----------------------------
-- Table structure for `perpanjangan_stnks`
-- ----------------------------
DROP TABLE IF EXISTS `perpanjangan_stnks`;
CREATE TABLE `perpanjangan_stnks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kendaraan_id` int(36) DEFAULT NULL,
  `masa_akhir_perpanjangan` datetime DEFAULT NULL,
  `tgl_perpanjangan` datetime DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perpanjangan_stnks_ibfk_1` (`kendaraan_id`),
  CONSTRAINT `perpanjangan_stnks_ibfk_1` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perpanjangan_stnks
-- ----------------------------

-- ----------------------------
-- Table structure for `petugas`
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `petugas_tipe_id` int(11) DEFAULT NULL,
  `kode_petugas` varchar(50) DEFAULT NULL,
  `nama_petugas` varchar(100) DEFAULT NULL,
  `jns_kelamin` varchar(1) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `petugas_tipe_id` (`petugas_tipe_id`),
  CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`petugas_tipe_id`) REFERENCES `tipe_petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of petugas
-- ----------------------------
INSERT INTO `petugas` VALUES ('1', '1', 'PTGS1', 'coba yaaw', 'L', '87567576567', 'jakarta', '2017-06-23 08:29:22', '1', '2017-06-23 08:35:49', '1');
INSERT INTO `petugas` VALUES ('4', '2', 'PTGS4', 'fdgdfgzzz aop', 'L', '444', 'fff', '2017-06-23 08:53:24', '1', '2017-06-23 08:54:49', '1');

-- ----------------------------
-- Table structure for `ruangans`
-- ----------------------------
DROP TABLE IF EXISTS `ruangans`;
CREATE TABLE `ruangans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ruangan` varchar(50) DEFAULT NULL,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ruangans
-- ----------------------------
INSERT INTO `ruangans` VALUES ('1', 'RUANG1', 'Ruang Meetings 1', '2017-06-23 06:08:37', '1', '2017-06-23 06:27:36', '1');
INSERT INTO `ruangans` VALUES ('2', 'RUANG2', 'Ruang Meeting 2', '2017-06-23 06:14:28', '1', null, null);
INSERT INTO `ruangans` VALUES ('4', 'RUANG3', 'wohooo', '2017-06-23 06:35:38', '1', null, null);

-- ----------------------------
-- Table structure for `tipe_petugas`
-- ----------------------------
DROP TABLE IF EXISTS `tipe_petugas`;
CREATE TABLE `tipe_petugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_petugas` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipe_petugas
-- ----------------------------
INSERT INTO `tipe_petugas` VALUES ('1', 'Petugas Cleaning', null, null, null, null);
INSERT INTO `tipe_petugas` VALUES ('2', 'Petugas Security', null, null, null, null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_category_id` int(11) DEFAULT NULL,
  `fullname` varchar(150) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_category_id` (`user_category_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_category_id`) REFERENCES `user_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'Superadmin', 'superadmin', 'superadmin@localhost.com', '0cc175b9c0f1b6a831c399e269772661', '2017-06-22 00:00:00', '0', '2017-06-22 00:00:00', '0');

-- ----------------------------
-- Table structure for `user_categories`
-- ----------------------------
DROP TABLE IF EXISTS `user_categories`;
CREATE TABLE `user_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user_categories
-- ----------------------------
INSERT INTO `user_categories` VALUES ('1', 'Superadmin', '2017-06-22 00:00:00', '0', '2017-06-22 00:00:00', '0');

-- ----------------------------
-- Table structure for `user_privileges`
-- ----------------------------
DROP TABLE IF EXISTS `user_privileges`;
CREATE TABLE `user_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `user_category_id` int(11) DEFAULT NULL,
  `is_view` int(1) DEFAULT NULL,
  `is_insert` int(1) DEFAULT NULL,
  `is_update` int(1) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  `is_approve` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`),
  KEY `user_category_id` (`user_category_id`),
  CONSTRAINT `user_privileges_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_privileges_ibfk_2` FOREIGN KEY (`user_category_id`) REFERENCES `user_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user_privileges
-- ----------------------------
INSERT INTO `user_privileges` VALUES ('1', '2', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('2', '3', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('3', '4', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('4', '5', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('5', '8', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('6', '9', '1', '1', '1', '1', '1', '1');
