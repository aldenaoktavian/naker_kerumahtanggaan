/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : depnaker_rumahtanggan

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2017-06-19 21:15:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `booking_ruangans`
-- ----------------------------
DROP TABLE IF EXISTS `booking_ruangans`;
CREATE TABLE `booking_ruangans` (
  `id` char(36) NOT NULL DEFAULT '',
  `kode_booking` varchar(50) DEFAULT NULL,
  `ruangan_id` char(36) DEFAULT NULL,
  `direktorat` varchar(10) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `tgl_book` datetime DEFAULT NULL,
  `jam_book` varchar(5) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `jml_peserta` int(11) DEFAULT NULL,
  `agenda_meeting` text,
  `status` varchar(1) DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ruangan_id` (`ruangan_id`),
  CONSTRAINT `booking_ruangans_ibfk_1` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of booking_ruangans
-- ----------------------------

-- ----------------------------
-- Table structure for `jadwal_tugas`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_tugas`;
CREATE TABLE `jadwal_tugas` (
  `id` char(36) NOT NULL DEFAULT '',
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
  `id` char(36) NOT NULL DEFAULT '',
  `jadwal_tugas_id` char(36) DEFAULT NULL,
  `petugas_id` char(36) DEFAULT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_tugas_id` (`jadwal_tugas_id`),
  KEY `petugas_id` (`petugas_id`),
  CONSTRAINT `jadwal_tugas_details_ibfk_1` FOREIGN KEY (`jadwal_tugas_id`) REFERENCES `jadwal_tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jadwal_tugas_details_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_tugas_details
-- ----------------------------

-- ----------------------------
-- Table structure for `jenis_barangs`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_barangs`;
CREATE TABLE `jenis_barangs` (
  `id` char(36) NOT NULL DEFAULT '',
  `kode_jenis` varchar(50) DEFAULT NULL,
  `nama_jenis` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_barangs
-- ----------------------------

-- ----------------------------
-- Table structure for `jenis_kendaraans`
-- ----------------------------
DROP TABLE IF EXISTS `jenis_kendaraans`;
CREATE TABLE `jenis_kendaraans` (
  `id` char(36) NOT NULL DEFAULT '',
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
  `id` char(36) NOT NULL DEFAULT '',
  `kode_kendaraan` varchar(50) DEFAULT NULL,
  `jns_kendaraan_id` char(36) DEFAULT NULL,
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
  KEY `jns_kendaraan_id` (`jns_kendaraan_id`),
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
  `id` char(36) NOT NULL DEFAULT '',
  `module_name` varchar(50) DEFAULT NULL,
  `module_alias` varchar(50) DEFAULT NULL,
  `module_url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('2', 'barangs', 'brg', 'brg');

-- ----------------------------
-- Table structure for `notifs`
-- ----------------------------
DROP TABLE IF EXISTS `notifs`;
CREATE TABLE `notifs` (
  `id` char(36) NOT NULL DEFAULT '',
  `user_id` char(36) DEFAULT NULL,
  `notif_type_id` char(36) DEFAULT NULL,
  `notif_desc` text,
  `notif_url` varchar(150) DEFAULT NULL,
  `notif_status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notif_type_id` (`notif_type_id`),
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
  `id` char(36) NOT NULL DEFAULT '',
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
-- Table structure for `penerimaan_barangs`
-- ----------------------------
DROP TABLE IF EXISTS `penerimaan_barangs`;
CREATE TABLE `penerimaan_barangs` (
  `id` char(36) NOT NULL DEFAULT '',
  `kode_penerimaan` varchar(50) DEFAULT NULL,
  `pengadaan_barang_id` char(36) DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `keterangan` text,
  `bukti_foto` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengadaan_barang_id` (`pengadaan_barang_id`),
  CONSTRAINT `penerimaan_barangs_ibfk_1` FOREIGN KEY (`pengadaan_barang_id`) REFERENCES `pengadaan_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penerimaan_barangs
-- ----------------------------

-- ----------------------------
-- Table structure for `pengadaan_barangs`
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan_barangs`;
CREATE TABLE `pengadaan_barangs` (
  `id` char(36) NOT NULL DEFAULT '',
  `kode_pengadaan` varchar(50) DEFAULT NULL,
  `tgl_pengadaan` datetime DEFAULT NULL,
  `jenis_barang_id` char(36) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `direktorat` varchar(100) DEFAULT NULL,
  `nama_pemesan` varchar(50) DEFAULT NULL,
  `alasan_pengadaan` text,
  `spesifikasi` text,
  `status` varchar(1) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_barang_id` (`jenis_barang_id`),
  CONSTRAINT `pengadaan_barangs_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengadaan_barangs
-- ----------------------------

-- ----------------------------
-- Table structure for `perawatan_barangs`
-- ----------------------------
DROP TABLE IF EXISTS `perawatan_barangs`;
CREATE TABLE `perawatan_barangs` (
  `id` char(36) NOT NULL DEFAULT '',
  `kode_perawatan` varchar(50) DEFAULT NULL,
  `tgl_perawatan` datetime DEFAULT NULL,
  `jenis_barang_id` char(36) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `direktorat` varchar(100) DEFAULT NULL,
  `alasan_perawatan` text,
  `lokasi` varchar(150) DEFAULT NULL,
  `bukti_foto` varchar(150) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_barang_id` (`jenis_barang_id`),
  CONSTRAINT `perawatan_barangs_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perawatan_barangs
-- ----------------------------

-- ----------------------------
-- Table structure for `perpanjangan_stnks`
-- ----------------------------
DROP TABLE IF EXISTS `perpanjangan_stnks`;
CREATE TABLE `perpanjangan_stnks` (
  `id` char(36) NOT NULL DEFAULT '',
  `kendaraan_id` char(36) DEFAULT NULL,
  `masa_akhir_perpanjangan` datetime DEFAULT NULL,
  `tgl_perpanjangan` datetime DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kendaraan_id` (`kendaraan_id`),
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
  `id` char(36) NOT NULL DEFAULT '',
  `petugas_tipe_id` char(36) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of petugas
-- ----------------------------

-- ----------------------------
-- Table structure for `ruangans`
-- ----------------------------
DROP TABLE IF EXISTS `ruangans`;
CREATE TABLE `ruangans` (
  `id` char(36) NOT NULL DEFAULT '',
  `kode_ruangan` varchar(50) DEFAULT NULL,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  `status_book` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ruangans
-- ----------------------------

-- ----------------------------
-- Table structure for `tipe_petugas`
-- ----------------------------
DROP TABLE IF EXISTS `tipe_petugas`;
CREATE TABLE `tipe_petugas` (
  `id` char(36) NOT NULL DEFAULT '',
  `kode_tipe` varchar(50) DEFAULT NULL,
  `tipe_petugas` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipe_petugas
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` char(36) NOT NULL DEFAULT '',
  `user_category_id` char(36) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_category_id` (`user_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'vita', 'vita@gmail.com', '1234', '2017-06-18 00:57:44', null, '2017-06-18 00:57:49', null);

-- ----------------------------
-- Table structure for `user_categories`
-- ----------------------------
DROP TABLE IF EXISTS `user_categories`;
CREATE TABLE `user_categories` (
  `id` char(36) NOT NULL DEFAULT '',
  `category_name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_categories
-- ----------------------------
INSERT INTO `user_categories` VALUES ('1', 'admin', null, null, null, null);

-- ----------------------------
-- Table structure for `user_priviledges`
-- ----------------------------
DROP TABLE IF EXISTS `user_priviledges`;
CREATE TABLE `user_priviledges` (
  `id` char(36) NOT NULL DEFAULT '',
  `module_id` char(36) DEFAULT NULL,
  `user_category_id` char(36) DEFAULT NULL,
  `is_view` varchar(1) DEFAULT NULL,
  `is_insert` varchar(1) DEFAULT NULL,
  `is_update` varchar(1) DEFAULT NULL,
  `is_delete` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_category_id` (`user_category_id`),
  KEY `user_priviledges_ibfk_2` (`module_id`),
  CONSTRAINT `user_priviledges_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_priviledges
-- ----------------------------
INSERT INTO `user_priviledges` VALUES ('1', '2', '1', '1', '1', '0', '0');
