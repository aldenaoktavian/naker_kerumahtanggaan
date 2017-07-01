/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : depnaker_rumahtanggan

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2017-07-02 02:25:47
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
  `tgl_book` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `jml_peserta` int(11) DEFAULT NULL,
  `agenda_meeting` text,
  `status` char(1) NOT NULL DEFAULT 'B',
  `keterangan` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ruangan_id` (`ruangan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of booking_ruangans
-- ----------------------------
INSERT INTO `booking_ruangans` VALUES ('30', '3', 'BOOK1', '1', 'dd', 'ddd', '2017-06-28', '14:00:00', '17:00:00', '3', 'fff', 'C', 'yayaya', '2017-06-27 21:29:09', null, null);
INSERT INTO `booking_ruangans` VALUES ('31', '3', 'BOOK31', '2', 'sdgdfg', 'hfghfg', '2017-06-28', '14:00:00', '17:00:00', '5', 'jfffj', 'F', '', '2017-06-27 21:44:51', null, null);
INSERT INTO `booking_ruangans` VALUES ('32', '3', 'BOOK32', '2', 'thfgj', 'jfgjfg', '2017-06-28', '15:00:00', '20:00:00', '4', 'hhhh', 'B', null, '2017-06-28 02:17:15', null, null);

-- ----------------------------
-- Table structure for `jadwal_tugas`
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_tugas`;
CREATE TABLE `jadwal_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jadwal` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `bulan_tugas` varchar(2) DEFAULT NULL,
  `tahun_tugas` varchar(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_tugas
-- ----------------------------
INSERT INTO `jadwal_tugas` VALUES ('5', 'SCL1', 'C', '1', '2017', '2017-06-30 18:47:05', '1', '2017-07-01 19:10:50', '1');
INSERT INTO `jadwal_tugas` VALUES ('6', 'SSC1', 'S', '11', '2017', '2017-06-30 19:51:54', '1', '2017-07-01 19:13:31', '1');
INSERT INTO `jadwal_tugas` VALUES ('7', 'SCL6', 'C', '2', '2017', '2017-07-01 19:11:27', '1', '2017-07-01 19:11:27', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_tugas_details
-- ----------------------------
INSERT INTO `jadwal_tugas_details` VALUES ('19', '5', '5', 'kdsdls', '2017-07-01 19:10:50', '1', '2017-07-01 19:10:50', '1');
INSERT INTO `jadwal_tugas_details` VALUES ('20', '5', '6', 'kjdksjd', '2017-07-01 19:10:50', '1', '2017-07-01 19:10:50', '1');
INSERT INTO `jadwal_tugas_details` VALUES ('21', '7', '1', 'skdlskd', '2017-07-01 19:11:27', '1', '2017-07-01 19:11:27', '1');
INSERT INTO `jadwal_tugas_details` VALUES ('22', '6', '4', 'lskdlskdsldk', '2017-07-01 19:13:31', '1', '2017-07-01 19:13:31', '1');
INSERT INTO `jadwal_tugas_details` VALUES ('23', '6', '7', 'nkjdksjdskjd', '2017-07-01 19:13:31', '1', '2017-07-01 19:13:31', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_barangs
-- ----------------------------
INSERT INTO `jenis_barangs` VALUES ('1', 'BR1', 'ATK Kantor', '2017-06-23 23:01:55', '1', '2017-07-01 15:51:35', '1');
INSERT INTO `jenis_barangs` VALUES ('2', 'BR2', 'Mesin fotocopy', '2017-07-01 15:51:26', '1', '2017-07-01 15:51:26', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jenis_kendaraans
-- ----------------------------
INSERT INTO `jenis_kendaraans` VALUES ('1', 'VCT1', 'mobil roda 4', '2017-06-30 04:53:18', '1', '2017-06-30 05:54:30', '1');
INSERT INTO `jenis_kendaraans` VALUES ('2', 'VCT2', 'truk', '2017-06-30 04:53:29', '1', '2017-07-01 16:03:32', '1');
INSERT INTO `jenis_kendaraans` VALUES ('3', 'VCT3', 'bis', '2017-07-01 16:03:20', '1', '2017-07-01 16:03:20', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kendaraans
-- ----------------------------
INSERT INTO `kendaraans` VALUES ('1', 'VHC1', '2', 'mobilio oke', '2016', 'ksdso3lslakslaksas', 'SJS9293', 'sjkd933933984934', 'kajd33', 'oke', 'vita', 'IT', '2018-12-02 00:00:00', '2017-06-30 05:43:46', '1', '2017-07-01 19:03:26', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', null, 'master', 'Master', null, '2');
INSERT INTO `modules` VALUES ('2', '1', 'ruangan', 'Nama Ruangan', 'ruangan', '1');
INSERT INTO `modules` VALUES ('3', '1', 'petugas_cleaning', 'Petugas Cleaning', 'petugas_cleaning', '2');
INSERT INTO `modules` VALUES ('4', '1', 'petugas_security', 'Petugas Security', 'petugas_security', '3');
INSERT INTO `modules` VALUES ('5', '0', 'dashboard', 'Dashboard', 'dashboard', '1');
INSERT INTO `modules` VALUES ('6', null, 'pengadaan_barang_menu', 'Pelayanan Penyediaan Kebutuhan unit-unit', null, '3');
INSERT INTO `modules` VALUES ('7', null, 'booking_ruangan_meeting', 'Pelayanan Penggunaan Ruang Rapat', null, '6');
INSERT INTO `modules` VALUES ('8', '7', 'booking_ruangan', 'Booking Ruangan', 'booking_ruangan', '1');
INSERT INTO `modules` VALUES ('9', '7', 'booking_ruangan_history', 'Histori Booking Ruangan', 'booking_ruangan_history', '2');
INSERT INTO `modules` VALUES ('10', '1', 'jenis_barang', 'Jenis Barang', 'jenis_barang', '4');
INSERT INTO `modules` VALUES ('11', '1', 'kendaraan', 'Kendaraan', 'kendaraan', '6');
INSERT INTO `modules` VALUES ('12', '1', 'jenis_kendaraan', 'Jenis Kendaraan', 'jenis_kendaraan', '5');
INSERT INTO `modules` VALUES ('13', '6', 'pengadaan_barang', 'Request Barang', 'pengadaan_barang', '1');
INSERT INTO `modules` VALUES ('14', '6', 'penerimaan_barang', 'Penerimaan Barang', 'penerimaan_barang', '2');
INSERT INTO `modules` VALUES ('15', '6', 'history_pengadaan_barang', 'History Pengadaan Barang', 'history_pengadaan_barang', '3');
INSERT INTO `modules` VALUES ('16', null, 'perawatan_barang_menu', 'Pelayanan Perbaikan dan Perawatan Sarana dan Prasa', null, '4');
INSERT INTO `modules` VALUES ('17', '16', 'perawatan_barang', 'Request Perawatan', 'perawatan_barang', '1');
INSERT INTO `modules` VALUES ('18', '16', 'perawatan_barang_selesai', 'Perawatan Selesai', 'perawatan_barang_selesai', '2');
INSERT INTO `modules` VALUES ('19', '16', 'perawatan_barang_history', 'History Perawatan Barang', 'perawatan_barang_history', '3');
INSERT INTO `modules` VALUES ('20', null, 'perpanjangan_stnk_menu', 'Pelayanan Perpanjangan Pajak Kendaraan Dinas', null, '5');
INSERT INTO `modules` VALUES ('21', '20', 'perpanjangan_stnk', 'Perpanjangan STNK', 'perpanjangan_stnk', '1');
INSERT INTO `modules` VALUES ('22', '20', 'perpanjangan_stnk_report', 'Laporan Perpanjangan STNK', 'perpanjangan_stnk_report', '2');
INSERT INTO `modules` VALUES ('23', null, 'petugas_cleaning_dan_security', 'Jadwal Petugas Cleaning Services dan Jadwal Petuga', null, '7');
INSERT INTO `modules` VALUES ('24', '23', 'tugas_cleaning', 'Petugas Cleaning', 'tugas_cleaning', '1');
INSERT INTO `modules` VALUES ('25', '23', 'tugas_security', 'Petugas Security', 'tugas_security', '2');

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
  `notif_status` int(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifs_ibfk_1` (`notif_type_id`),
  CONSTRAINT `notifs_ibfk_1` FOREIGN KEY (`notif_type_id`) REFERENCES `notif_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notifs
-- ----------------------------
INSERT INTO `notifs` VALUES ('63', '1', '9', 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/34173cb38f07f89ddbebc2ac9128303f', '1', '2017-06-27 21:29:10');
INSERT INTO `notifs` VALUES ('64', '2', '9', 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/34173cb38f07f89ddbebc2ac9128303f', '1', '2017-06-27 21:29:16');
INSERT INTO `notifs` VALUES ('65', '1', '9', 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/c16a5320fa475530d9583c34fd356ef5', '1', '2017-06-27 21:44:51');
INSERT INTO `notifs` VALUES ('66', '2', '9', 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/c16a5320fa475530d9583c34fd356ef5', '1', '2017-06-27 21:44:58');
INSERT INTO `notifs` VALUES ('67', '1', '9', 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/6364d3f0f495b6ab9dcf8d3b5c6e0b01', '1', '2017-06-28 02:17:15');
INSERT INTO `notifs` VALUES ('68', '2', '9', 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/6364d3f0f495b6ab9dcf8d3b5c6e0b01', '1', '2017-06-28 02:17:21');
INSERT INTO `notifs` VALUES ('69', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/e4da3b7fbbce2345d7772b0674a318d5', '0', '2017-07-01 19:58:19');
INSERT INTO `notifs` VALUES ('70', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/1679091c5a880faf6fb5e6087eb1b2dc', '0', '2017-07-01 20:09:24');
INSERT INTO `notifs` VALUES ('71', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/8f14e45fceea167a5a36dedd4bea2543', '0', '2017-07-01 20:10:12');
INSERT INTO `notifs` VALUES ('72', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/c9f0f895fb98ab9159f51fd0297e236d', '0', '2017-07-01 20:12:02');
INSERT INTO `notifs` VALUES ('73', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/45c48cce2e2d7fbdea1afc51c7c6ad26', '0', '2017-07-01 20:38:50');
INSERT INTO `notifs` VALUES ('74', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/d3d9446802a44259755d38e6d163e820', '0', '2017-07-01 20:39:41');
INSERT INTO `notifs` VALUES ('75', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/6512bd43d9caa6e02c990b0a82652dca', '0', '2017-07-01 20:40:46');
INSERT INTO `notifs` VALUES ('76', '1', '1', 'Request barang oleh Superadmin.', 'http://localhost/naker_kerumahtanggaan/pengadaan_barang/approve/c20ad4d76fe97759aa27a0c99bff6710', '0', '2017-07-01 20:42:11');

-- ----------------------------
-- Table structure for `notif_types`
-- ----------------------------
DROP TABLE IF EXISTS `notif_types`;
CREATE TABLE `notif_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) DEFAULT NULL,
  `type_desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notif_types
-- ----------------------------
INSERT INTO `notif_types` VALUES ('1', 'User membuat request barang', 'Request barang oleh [nama_user].');
INSERT INTO `notif_types` VALUES ('2', 'Approve request barang', 'Request barang diterima.');
INSERT INTO `notif_types` VALUES ('3', 'Reject request barang', 'Request barang ditolak.');
INSERT INTO `notif_types` VALUES ('4', 'Update detail penerimaan barang', null);
INSERT INTO `notif_types` VALUES ('5', 'User membuat request perawatan barang', 'Request perawatan barang oleh [nama_user].');
INSERT INTO `notif_types` VALUES ('6', 'Approve request perawatan barang', 'Request perawatan barang diterima.');
INSERT INTO `notif_types` VALUES ('7', 'Reject request perawatan barang', 'Request perawatan barang ditolak.');
INSERT INTO `notif_types` VALUES ('8', 'Update detail perawatan selesai', null);
INSERT INTO `notif_types` VALUES ('9', 'User melakukan booking ruangan', 'Booking ruangan oleh [nama_user].');
INSERT INTO `notif_types` VALUES ('10', 'Finish booking ruangan', null);
INSERT INTO `notif_types` VALUES ('11', 'Cancel booking ruangan', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengadaan_barangs
-- ----------------------------
INSERT INTO `pengadaan_barangs` VALUES ('1', 'REQ1', '2017-06-01 00:00:00', '1', 'buku tulis kosong', 'sinar dunia emas', '5', 'GA', 'yuvita', 'skdskdlsk', 'dskdlskdlskd', 'R', 'tdk sesuai', null, null, null, null, '2017-06-24 17:01:22', '1', '2017-06-28 11:22:37', '1');
INSERT INTO `pengadaan_barangs` VALUES ('2', 'REQ2', null, '1', 'rak mejakuu', null, null, 'IT', 'yuvita dyah', null, null, 'S', null, null, '2017-06-29 03:26:41', 'urgivnif', 'Capture.PNG', '2017-06-24 17:03:07', '1', '2017-06-29 16:10:42', '1');
INSERT INTO `pengadaan_barangs` VALUES ('3', 'REQ3', '2017-07-01 00:00:00', '1', 'kertas hvs 2 rim ldskdlskd', 'sinar dunia oke', '2', 'GA', 'yuvi', 'habis', 'ukuran hvs', 'E', null, null, null, null, null, '2017-06-30 20:21:57', '1', '2017-06-30 20:34:40', '1');
INSERT INTO `pengadaan_barangs` VALUES ('4', 'REQ4', '2017-07-01 00:00:00', '2', 'fotocopyan', 'canon', '1', 'Finance', 'Lala', 'tidak punya', 'apa ajaa', 'S', null, null, '2017-07-01 17:44:43', 'okee', '2elgyo7_large.jpg', '2017-07-01 17:38:51', '1', '2017-07-01 17:41:18', '1');
INSERT INTO `pengadaan_barangs` VALUES ('5', 'REQ5', '2017-07-02 00:00:00', '1', 'kslklskd', 'lkdlskdlsk', '2', 'sdlsdsld', 'kdlskdlskd', 'slkdlskdslkd', 'slkdlskdlk', 'E', null, null, null, null, null, '2017-07-01 19:58:19', '1', '2017-07-01 19:58:19', '1');
INSERT INTO `pengadaan_barangs` VALUES ('6', 'REQ6', '2017-07-01 00:00:00', '1', 'ksldksdklk', 'sldksldksldk', '3', 'sldksldksldk', 'lskdsldksldk', 'lsdksldksldk', 'dksldkslkd', 'E', null, null, null, null, null, '2017-07-01 20:09:24', '1', '2017-07-01 20:09:24', '1');
INSERT INTO `pengadaan_barangs` VALUES ('7', 'REQ6', '2017-07-01 00:00:00', '1', 'ksldksdklk', 'sldksldksldk', '3', 'sldksldksldk', 'lskdsldksldk', 'lsdksldksldk', 'dksldkslkd', 'E', null, null, null, null, null, '2017-07-01 20:10:12', '1', '2017-07-01 20:10:12', '1');
INSERT INTO `pengadaan_barangs` VALUES ('8', 'REQ8', '2017-07-02 00:00:00', '1', 'lk', 'dskdsldk', '4', 'dlsldksldk', 'ldksldk', 'ldskdlsk', 'dlskdlsk', 'E', null, null, null, null, null, '2017-07-01 20:12:02', '1', '2017-07-01 20:12:02', '1');
INSERT INTO `pengadaan_barangs` VALUES ('9', 'REQ9', '2017-07-01 00:00:00', '1', 'daldkaldk', 'ldkslkdlskd', '3', 'ldksldkslk', 'lskdlskdls', 'skdsldksd', 'slkdsldk', 'E', null, null, null, null, null, '2017-07-01 20:38:50', '1', '2017-07-01 20:38:50', '1');
INSERT INTO `pengadaan_barangs` VALUES ('10', 'REQ9', '2017-07-01 00:00:00', '1', 'daldkaldk', 'ldkslkdlskd', '3', 'ldksldkslk', 'lskdlskdls', 'skdsldksd', 'slkdsldk', 'E', null, null, null, null, null, '2017-07-01 20:39:41', '1', '2017-07-01 20:39:41', '1');
INSERT INTO `pengadaan_barangs` VALUES ('11', 'REQ11', '2017-07-02 00:00:00', '1', 'dksdsdlk', 'sdklskdslk', '4', 'klsdksldk', 'kslkdslkd', 'dksldksl', 'dsldksldk', 'E', null, null, null, null, null, '2017-07-01 20:40:46', '1', '2017-07-01 20:40:46', '1');
INSERT INTO `pengadaan_barangs` VALUES ('12', 'REQ12', '2017-07-02 00:00:00', '1', 'kdladkla', 'kdlskdslk', '9', 'lskdlskd', 'lkdslkdslk', 'lskdlskdslk', 'sdsldkslkd', 'E', null, null, null, null, null, '2017-07-01 20:42:11', '1', '2017-07-01 20:42:11', '1');

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
  `tgl_selesai` datetime DEFAULT NULL,
  `keterangan_selesai` varchar(100) DEFAULT NULL,
  `bukti_foto_sesudah` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_barang_id` (`jenis_barang_id`),
  CONSTRAINT `perawatan_barangs_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perawatan_barangs
-- ----------------------------
INSERT INTO `perawatan_barangs` VALUES ('2', 'MNT1', '2017-06-29 00:00:00', '1', 'rak mejakuu', 'yuvita dyah', 'IT', 'karena rusak', 'lt 2', null, 'S', null, '2017-06-30 04:08:28', 'kldkdlakdladk', 'er2.JPG', '2017-06-29 07:16:24', '1', '2017-06-29 17:16:38', '1');
INSERT INTO `perawatan_barangs` VALUES ('3', 'MNT3', '2017-07-01 00:00:00', '2', 'mesin fotocopy epson', 'lili', 'finance', 'rusak', 'lt 5', '314596_306244216061988_135074093179002_1197415_967161783_n_large.jpg', 'E', null, null, null, null, '2017-07-01 18:05:02', '1', '2017-07-01 18:13:29', '1');
INSERT INTO `perawatan_barangs` VALUES ('4', 'MNT4', '2017-07-01 00:00:00', '1', 'rak laci', 'saya', 'GA', 'rusak', 'lt 2', 'co110221013625-1_large.jpg', 'R', 'bisa dibenarkan manual', null, null, null, '2017-07-01 18:14:55', '1', '2017-07-01 18:16:38', '1');
INSERT INTO `perawatan_barangs` VALUES ('5', 'MNT5', '2017-07-01 00:00:00', '2', 'mesin fotocopy canon', 'budi', 'marketing', 'rusak', 'lt 4', '404728_207827942646296_1105388321_n_large.jpg', 'S', null, '2017-07-01 18:22:48', 'sudah dibenarkan', '229513_181379451911647_159608400755419_420743_7073696_n_large.jpg', '2017-07-01 18:20:51', '1', '2017-07-01 18:21:04', '1');

-- ----------------------------
-- Table structure for `perpanjangan_stnks`
-- ----------------------------
DROP TABLE IF EXISTS `perpanjangan_stnks`;
CREATE TABLE `perpanjangan_stnks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kendaraan_id` int(36) DEFAULT NULL,
  `masa_awal_perpanjangan` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perpanjangan_stnks
-- ----------------------------
INSERT INTO `perpanjangan_stnks` VALUES ('4', '1', '2017-12-02 00:00:00', '2018-12-02 00:00:00', '2017-07-01 19:03:26', 'C', '2017-07-01 19:03:26', '1', '2017-07-01 19:03:26', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of petugas
-- ----------------------------
INSERT INTO `petugas` VALUES ('1', '1', 'PTGS1', 'coba yaaw', 'L', '87567576567', 'jakarta', '2017-06-23 08:29:22', '1', '2017-06-23 08:35:49', '1');
INSERT INTO `petugas` VALUES ('4', '2', 'PTGS4', 'fdgdfgzzz aop', 'L', '444', 'fff', '2017-06-23 08:53:24', '1', '2017-06-23 08:54:49', '1');
INSERT INTO `petugas` VALUES ('5', '1', 'PTGS5', 'vitaaa', 'P', '3940394', 'jakarta', '2017-06-30 18:29:47', '1', null, null);
INSERT INTO `petugas` VALUES ('6', '1', 'PTGS6', 'saya', 'L', '4738473847', 'kediri', '2017-06-30 18:37:46', '1', null, null);
INSERT INTO `petugas` VALUES ('7', '2', 'PTGS7', 'aku', 'L', '3843948', 'kediri', '2017-06-30 20:02:17', '1', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user_privileges
-- ----------------------------
INSERT INTO `user_privileges` VALUES ('1', '2', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('2', '3', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('3', '4', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('4', '5', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('5', '8', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('6', '9', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('7', '10', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('8', '11', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('9', '12', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('10', '13', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('11', '14', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('12', '15', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('13', '17', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('14', '18', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('15', '19', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('16', '21', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('17', '22', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('18', '24', '1', '1', '1', '1', '1', '1');
INSERT INTO `user_privileges` VALUES ('19', '25', '1', '1', '1', '1', '1', '1');
