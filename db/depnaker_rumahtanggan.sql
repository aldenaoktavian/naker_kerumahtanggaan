-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2017 at 08:06 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `depnaker_rumahtanggan`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_ruangans`
--

CREATE TABLE `booking_ruangans` (
  `id` int(11) NOT NULL,
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
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_ruangans`
--

INSERT INTO `booking_ruangans` (`id`, `id_user`, `kode_booking`, `ruangan_id`, `direktorat`, `nama_pemesan`, `tgl_book`, `start_time`, `end_time`, `jml_peserta`, `agenda_meeting`, `status`, `keterangan`, `created`, `modified`, `modi_by`) VALUES
(30, 3, 'BOOK1', 1, 'dd', 'ddd', '2017-06-28', '14:00:00', '17:00:00', 3, 'fff', 'C', 'yayaya', '2017-06-27 21:29:09', NULL, NULL),
(31, 3, 'BOOK31', 2, 'sdgdfg', 'hfghfg', '2017-06-28', '14:00:00', '17:00:00', 5, 'jfffj', 'F', '', '2017-06-27 21:44:51', NULL, NULL),
(32, 3, 'BOOK32', 2, 'thfgj', 'jfgjfg', '2017-06-28', '15:00:00', '20:00:00', 4, 'hhhh', 'B', NULL, '2017-06-28 02:17:15', NULL, NULL),
(33, 1, 'BOOK33', 1, 'y', 'hvjhvgh', '2017-07-05', '21:01:00', '23:01:00', 6, 'dddd', 'B', NULL, '2017-07-05 06:21:49', '2017-07-05 06:35:02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_tugas`
--

CREATE TABLE `jadwal_tugas` (
  `id` int(11) NOT NULL,
  `kode_jadwal` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `bulan_tugas` varchar(2) DEFAULT NULL,
  `tahun_tugas` varchar(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_tugas`
--

INSERT INTO `jadwal_tugas` (`id`, `kode_jadwal`, `tipe`, `bulan_tugas`, `tahun_tugas`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(5, 'SCL1', 'C', '1', '2017', '2017-06-30 18:47:05', '1', '2017-07-01 19:10:50', '1'),
(6, 'SSC1', 'S', '11', '2017', '2017-06-30 19:51:54', '1', '2017-07-01 19:13:31', '1'),
(7, 'SCL6', 'C', '2', '2017', '2017-07-01 19:11:27', '1', '2017-07-01 19:11:27', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_tugas_details`
--

CREATE TABLE `jadwal_tugas_details` (
  `id` int(11) NOT NULL,
  `jadwal_tugas_id` int(11) DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_tugas_details`
--

INSERT INTO `jadwal_tugas_details` (`id`, `jadwal_tugas_id`, `petugas_id`, `lokasi`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(19, 5, 5, 'kdsdls', '2017-07-01 19:10:50', '1', '2017-07-01 19:10:50', '1'),
(20, 5, 6, 'kjdksjd', '2017-07-01 19:10:50', '1', '2017-07-01 19:10:50', '1'),
(21, 7, 1, 'skdlskd', '2017-07-01 19:11:27', '1', '2017-07-01 19:11:27', '1'),
(22, 6, 4, 'lskdlskdsldk', '2017-07-01 19:13:31', '1', '2017-07-01 19:13:31', '1'),
(23, 6, 7, 'nkjdksjdskjd', '2017-07-01 19:13:31', '1', '2017-07-01 19:13:31', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barangs`
--

CREATE TABLE `jenis_barangs` (
  `id` int(11) NOT NULL,
  `kode_jenis` varchar(50) DEFAULT NULL,
  `nama_jenis` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barangs`
--

INSERT INTO `jenis_barangs` (`id`, `kode_jenis`, `nama_jenis`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'BR1', 'ATK Kantor', '2017-06-23 23:01:55', '1', '2017-07-01 15:51:35', '1'),
(2, 'BR2', 'Mesin fotocopy', '2017-07-01 15:51:26', '1', '2017-07-01 15:51:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kendaraans`
--

CREATE TABLE `jenis_kendaraans` (
  `id` int(11) NOT NULL,
  `kode_jenis` varchar(50) DEFAULT NULL,
  `nama_jenis` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kendaraans`
--

INSERT INTO `jenis_kendaraans` (`id`, `kode_jenis`, `nama_jenis`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'VCT1', 'mobil roda 4', '2017-06-30 04:53:18', '1', '2017-06-30 05:54:30', '1'),
(2, 'VCT2', 'truk', '2017-06-30 04:53:29', '1', '2017-07-01 16:03:32', '1'),
(3, 'VCT3', 'bis', '2017-07-01 16:03:20', '1', '2017-07-01 16:03:20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraans`
--

CREATE TABLE `kendaraans` (
  `id` int(11) NOT NULL,
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
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraans`
--

INSERT INTO `kendaraans` (`id`, `kode_kendaraan`, `jns_kendaraan_id`, `merk`, `tahun`, `nup`, `no_pol`, `no_mesin`, `no_chasis`, `kondisi`, `pemegang`, `direktorat`, `masa_stnk`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'VHC1', 2, 'mobilio oke', '2016', 'ksdso3lslakslaksas', 'SJS9293', 'sjkd933933984934', 'kajd33', 'oke', 'vita', 'IT', '2018-12-02 00:00:00', '2017-06-30 05:43:46', '1', '2017-07-01 19:03:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `module_alias` varchar(50) DEFAULT NULL,
  `module_url` varchar(50) DEFAULT NULL,
  `no_urut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `id_parent`, `module_name`, `module_alias`, `module_url`, `no_urut`) VALUES
(1, NULL, 'master', 'Master', NULL, 2),
(2, 1, 'ruangan', 'Nama Ruangan', 'ruangan', 1),
(3, 1, 'petugas_cleaning', 'Petugas Cleaning', 'petugas_cleaning', 2),
(4, 1, 'petugas_security', 'Petugas Security', 'petugas_security', 3),
(5, 0, 'dashboard', 'Dashboard', 'dashboard', 1),
(6, NULL, 'pengadaan_barang_menu', 'Pelayanan Penyediaan Kebutuhan unit-unit', NULL, 3),
(7, NULL, 'booking_ruangan_meeting', 'Pelayanan Penggunaan Ruang Rapat', NULL, 6),
(8, 7, 'booking_ruangan', 'Booking Ruangan', 'booking_ruangan', 1),
(9, 7, 'booking_ruangan_history', 'Histori Booking Ruangan', 'booking_ruangan_history', 2),
(10, 1, 'jenis_barang', 'Jenis Barang', 'jenis_barang', 4),
(11, 1, 'kendaraan', 'Kendaraan', 'kendaraan', 6),
(12, 1, 'jenis_kendaraan', 'Jenis Kendaraan', 'jenis_kendaraan', 5),
(13, 6, 'pengadaan_barang', 'Request Barang', 'pengadaan_barang', 1),
(14, 6, 'penerimaan_barang', 'Penerimaan Barang', 'penerimaan_barang', 2),
(15, 6, 'history_pengadaan_barang', 'History Pengadaan Barang', 'history_pengadaan_barang', 3),
(16, NULL, 'perawatan_barang_menu', 'Pelayanan Perbaikan dan Perawatan Sarana dan Prasa', NULL, 4),
(17, 16, 'perawatan_barang', 'Request Perawatan', 'perawatan_barang', 1),
(18, 16, 'perawatan_barang_selesai', 'Perawatan Selesai', 'perawatan_barang_selesai', 2),
(19, 16, 'perawatan_barang_history', 'History Perawatan Barang', 'perawatan_barang_history', 3),
(20, NULL, 'perpanjangan_stnk_menu', 'Pelayanan Perpanjangan Pajak Kendaraan Dinas', NULL, 5),
(21, 20, 'perpanjangan_stnk', 'Perpanjangan STNK', 'perpanjangan_stnk', 1),
(22, 20, 'perpanjangan_stnk_report', 'Laporan Perpanjangan STNK', 'perpanjangan_stnk_report', 2),
(23, NULL, 'petugas_cleaning_dan_security', 'Jadwal Petugas Cleaning Services dan Jadwal Petuga', NULL, 7),
(24, 23, 'tugas_cleaning', 'Petugas Cleaning', 'tugas_cleaning', 1),
(25, 23, 'tugas_security', 'Petugas Security', 'tugas_security', 2),
(26, NULL, 'user_management', 'User Management', NULL, 8),
(27, 26, 'user_category', 'User Category', 'user_category', 1),
(28, 26, 'user', 'User', 'user', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifs`
--

CREATE TABLE `notifs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notif_type_id` int(11) DEFAULT NULL,
  `notif_desc` text,
  `notif_url` varchar(150) DEFAULT NULL,
  `notif_status` int(1) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif_types`
--

CREATE TABLE `notif_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) DEFAULT NULL,
  `type_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif_types`
--

INSERT INTO `notif_types` (`id`, `type_name`, `type_desc`) VALUES
(1, 'User membuat request barang', 'Request barang oleh [nama_user].'),
(2, 'Approve request barang', 'Request barang diterima.'),
(3, 'Reject request barang', 'Request barang ditolak.'),
(4, 'Update detail penerimaan barang', NULL),
(5, 'User membuat request perawatan barang', 'Request perawatan barang oleh [nama_user].'),
(6, 'Approve request perawatan barang', 'Request perawatan barang diterima.'),
(7, 'Reject request perawatan barang', 'Request perawatan barang ditolak.'),
(8, 'Update detail perawatan selesai', NULL),
(9, 'User melakukan booking ruangan', 'Booking ruangan oleh [nama_user].'),
(10, 'Finish booking ruangan', NULL),
(11, 'Cancel booking ruangan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_barangs`
--

CREATE TABLE `pengadaan_barangs` (
  `id` int(11) NOT NULL,
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
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan_barangs`
--

INSERT INTO `pengadaan_barangs` (`id`, `kode_pengadaan`, `tgl_pengadaan`, `jenis_barang_id`, `nama_barang`, `merk`, `qty`, `direktorat`, `nama_pemesan`, `alasan_pengadaan`, `spesifikasi`, `status`, `remark`, `kode_terima`, `tgl_terima`, `keterangan`, `bukti_foto`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'REQ1', '2017-06-01 00:00:00', 1, 'buku tulis kosong', 'sinar dunia emas', 5, 'GA', 'yuvita', 'skdskdlsk', 'dskdlskdlskd', 'R', 'tdk sesuai', NULL, NULL, NULL, NULL, '2017-06-24 17:01:22', '1', '2017-06-28 11:22:37', '1'),
(2, 'REQ2', NULL, 1, 'rak mejakuu', NULL, NULL, 'IT', 'yuvita dyah', NULL, NULL, 'S', NULL, NULL, '2017-06-29 03:26:41', 'urgivnif', 'Capture.PNG', '2017-06-24 17:03:07', '1', '2017-06-29 16:10:42', '1'),
(3, 'REQ3', '2017-07-01 00:00:00', 1, 'kertas hvs 2 rim ldskdlskd', 'sinar dunia oke', 2, 'GA', 'yuvi', 'habis', 'ukuran hvs', 'A', '', NULL, NULL, NULL, NULL, '2017-06-30 20:21:57', '1', '2017-07-05 04:11:38', '1'),
(4, 'REQ4', '2017-07-01 00:00:00', 2, 'fotocopyan', 'canon', 1, 'Finance', 'Lala', 'tidak punya', 'apa ajaa', 'S', NULL, NULL, '2017-07-01 17:44:43', 'okee', '2elgyo7_large.jpg', '2017-07-01 17:38:51', '1', '2017-07-01 17:41:18', '1'),
(5, 'REQ5', '2017-07-02 00:00:00', 1, 'kslklskd', 'lkdlskdlsk', 2, 'sdlsdsld', 'kdlskdlskd', 'slkdlskdslkd', 'slkdlskdlk', 'R', 'aaa', NULL, NULL, NULL, NULL, '2017-07-01 19:58:19', '1', '2017-07-05 04:14:55', '1'),
(8, 'REQ8', '2017-07-02 00:00:00', 1, 'lk', 'dskdsldk', 4, 'dlsldksldk', 'ldksldk', 'ldskdlsk', 'dlskdlsk', 'E', NULL, NULL, NULL, NULL, NULL, '2017-07-01 20:12:02', '1', '2017-07-01 20:12:02', '1'),
(9, 'REQ9', '2017-07-01 00:00:00', 1, 'daldkaldk', 'ldkslkdlskd', 3, 'ldksldkslk', 'lskdlskdls', 'skdsldksd', 'slkdsldk', 'E', NULL, NULL, NULL, NULL, NULL, '2017-07-01 20:38:50', '1', '2017-07-01 20:38:50', '1'),
(10, 'REQ9', '2017-07-01 00:00:00', 1, 'daldkaldk', 'ldkslkdlskd', 3, 'ldksldkslk', 'lskdlskdls', 'skdsldksd', 'slkdsldk', 'E', NULL, NULL, NULL, NULL, NULL, '2017-07-01 20:39:41', '1', '2017-07-01 20:39:41', '1'),
(11, 'REQ11', '2017-07-02 00:00:00', 1, 'dksdsdlk', 'sdklskdslk', 4, 'klsdksldk', 'kslkdslkd', 'dksldksl', 'dsldksldk', 'E', NULL, NULL, NULL, NULL, NULL, '2017-07-01 20:40:46', '1', '2017-07-01 20:40:46', '1'),
(12, 'REQ12', '2017-07-02 00:00:00', 1, 'kdladkla', 'kdlskdslk', 9, 'lskdlskd', 'lkdslkdslk', 'lskdlskdslk', 'sdsldkslkd', 'E', NULL, NULL, NULL, NULL, NULL, '2017-07-01 20:42:11', '1', '2017-07-01 20:42:11', '1');

-- --------------------------------------------------------

--
-- Table structure for table `perawatan_barangs`
--

CREATE TABLE `perawatan_barangs` (
  `id` int(11) NOT NULL,
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
  `usulan` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perawatan_barangs`
--

INSERT INTO `perawatan_barangs` (`id`, `kode_perawatan`, `tgl_perawatan`, `jenis_barang_id`, `nama_barang`, `nama_pemesan`, `direktorat`, `alasan_perawatan`, `lokasi`, `bukti_foto_sebelum`, `status`, `alasan_reject`, `tgl_selesai`, `keterangan_selesai`, `bukti_foto_sesudah`, `usulan`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(2, 'MNT1', '2017-06-29 00:00:00', 1, 'rak mejakuu', 'yuvita dyah', 'IT', 'karena rusak', 'lt 2', NULL, 'S', NULL, '2017-06-30 04:08:28', 'kldkdlakdladk', 'er2.JPG', '', '2017-06-29 07:16:24', '1', '2017-06-29 17:16:38', '1'),
(3, 'MNT3', '2017-07-01 00:00:00', 2, 'mesin fotocopy epson', 'lili', 'finance', 'rusak', 'lt 5', '314596_306244216061988_135074093179002_1197415_967161783_n_large.jpg', 'R', 'aa', NULL, NULL, NULL, '', '2017-07-01 18:05:02', '1', '2017-07-05 05:03:27', '1'),
(4, 'MNT4', '2017-07-01 00:00:00', 1, 'rak laci', 'saya', 'GA', 'rusak', 'lt 2', 'co110221013625-1_large.jpg', 'R', 'bisa dibenarkan manual', NULL, NULL, NULL, '', '2017-07-01 18:14:55', '1', '2017-07-01 18:16:38', '1'),
(5, 'MNT5', '2017-07-01 00:00:00', 2, 'mesin fotocopy canon', 'budi', 'marketing', 'rusak', 'lt 4', '404728_207827942646296_1105388321_n_large.jpg', 'S', NULL, '2017-07-01 18:22:48', 'sudah dibenarkan', '229513_181379451911647_159608400755419_420743_7073696_n_large.jpg', '', '2017-07-01 18:20:51', '1', '2017-07-01 18:21:04', '1');

-- --------------------------------------------------------

--
-- Table structure for table `perpanjangan_stnks`
--

CREATE TABLE `perpanjangan_stnks` (
  `id` int(11) NOT NULL,
  `kendaraan_id` int(36) DEFAULT NULL,
  `masa_awal_perpanjangan` datetime DEFAULT NULL,
  `masa_akhir_perpanjangan` datetime DEFAULT NULL,
  `tgl_perpanjangan` datetime DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perpanjangan_stnks`
--

INSERT INTO `perpanjangan_stnks` (`id`, `kendaraan_id`, `masa_awal_perpanjangan`, `masa_akhir_perpanjangan`, `tgl_perpanjangan`, `status`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(4, 1, '2017-12-02 00:00:00', '2018-12-02 00:00:00', '2017-07-01 19:03:26', 'C', '2017-07-01 19:03:26', '1', '2017-07-01 19:03:26', '1');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `petugas_tipe_id` int(11) DEFAULT NULL,
  `kode_petugas` varchar(50) DEFAULT NULL,
  `nama_petugas` varchar(100) DEFAULT NULL,
  `jns_kelamin` varchar(1) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `petugas_tipe_id`, `kode_petugas`, `nama_petugas`, `jns_kelamin`, `no_telp`, `alamat`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 1, 'PTGS1', 'coba yaaw', 'L', '87567576567', 'jakarta', '2017-06-23 08:29:22', '1', '2017-06-23 08:35:49', '1'),
(4, 2, 'PTGS4', 'fdgdfgzzz aop', 'L', '444', 'fff', '2017-06-23 08:53:24', '1', '2017-06-23 08:54:49', '1'),
(5, 1, 'PTGS5', 'vitaaa', 'P', '3940394', 'jakarta', '2017-06-30 18:29:47', '1', NULL, NULL),
(6, 1, 'PTGS6', 'saya', 'L', '4738473847', 'kediri', '2017-06-30 18:37:46', '1', NULL, NULL),
(7, 2, 'PTGS7', 'aku', 'L', '3843948', 'kediri', '2017-06-30 20:02:17', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` int(11) NOT NULL,
  `kode_ruangan` varchar(50) DEFAULT NULL,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `kode_ruangan`, `nama_ruangan`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'RUANG1', 'Ruang Meetings 1', '2017-06-23 06:08:37', '1', '2017-06-23 06:27:36', '1'),
(2, 'RUANG2', 'Ruang Meeting 2', '2017-06-23 06:14:28', '1', NULL, NULL),
(4, 'RUANG3', 'wohooo', '2017-06-23 06:35:38', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_petugas`
--

CREATE TABLE `tipe_petugas` (
  `id` int(11) NOT NULL,
  `tipe_petugas` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_petugas`
--

INSERT INTO `tipe_petugas` (`id`, `tipe_petugas`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'Petugas Cleaning', NULL, NULL, NULL, NULL),
(2, 'Petugas Security', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_category_id` int(11) DEFAULT NULL,
  `fullname` varchar(150) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_category_id`, `fullname`, `username`, `email`, `password`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 1, 'Superadmin', 'superadmin', 'superadmin@localhost.com', '0cc175b9c0f1b6a831c399e269772661', '2017-06-22 00:00:00', '0', '2017-07-05 01:14:24', '1'),
(2, 3, 'Booking', 'booking', 'aldenaoktavian96@gmail.com', '0cc175b9c0f1b6a831c399e269772661', '2017-07-02 00:00:00', NULL, '2017-07-02 00:00:00', NULL),
(3, 2, 'Admin', 'admin', 'admin@yahoo.com', '0cc175b9c0f1b6a831c399e269772661', '2017-07-05 00:30:10', '1', '2017-07-05 00:35:18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE `user_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_categories`
--

INSERT INTO `user_categories` (`id`, `category_name`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'Superadmin', '2017-06-22 00:00:00', '0', '2017-07-03 19:59:01', '1'),
(2, 'Admin', '2017-07-02 00:00:00', '0', '2017-07-02 00:00:00', '0'),
(3, 'User Booking Ruangan', '2017-07-02 00:00:00', '0', '2017-07-02 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `user_category_id` int(11) DEFAULT NULL,
  `is_view` int(1) DEFAULT NULL,
  `is_insert` int(1) DEFAULT NULL,
  `is_update` int(1) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  `is_approve` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`id`, `module_id`, `user_category_id`, `is_view`, `is_insert`, `is_update`, `is_delete`, `is_approve`) VALUES
(1, 2, 1, 1, 1, 1, 1, 1),
(2, 3, 1, 1, 1, 1, 1, 1),
(3, 4, 1, 1, 1, 1, 1, 1),
(4, 5, 1, 1, 1, 1, 1, 1),
(5, 8, 1, 1, 1, 1, 1, 1),
(6, 9, 1, 1, 1, 1, 1, 1),
(7, 10, 1, 1, 1, 1, 1, 1),
(8, 11, 1, 1, 1, 1, 1, 1),
(9, 12, 1, 1, 1, 1, 1, 1),
(10, 13, 1, 1, 1, 1, 1, 1),
(11, 14, 1, 1, 1, 1, 1, 1),
(12, 15, 1, 1, 1, 1, 1, 1),
(13, 17, 1, 1, 1, 1, 1, 1),
(14, 18, 1, 1, 1, 1, 1, 1),
(15, 19, 1, 1, 1, 1, 1, 1),
(16, 21, 1, 1, 1, 1, 1, 1),
(17, 22, 1, 1, 1, 1, 1, 1),
(18, 24, 1, 1, 1, 1, 1, 1),
(19, 25, 1, 1, 1, 1, 1, 1),
(20, 27, 1, 1, 1, 1, 1, 1),
(21, 28, 1, 1, 1, 1, 1, 1),
(22, 8, 3, 1, 1, 1, 1, 0),
(23, 9, 3, 1, 1, 1, 1, 0),
(24, 5, 3, 1, 0, 0, 0, 0),
(25, 5, 2, 1, 1, 1, 1, 0),
(26, 2, 2, 1, 1, 1, 1, 0),
(27, 3, 2, 1, 1, 1, 1, 0),
(28, 4, 2, 1, 1, 1, 1, 0),
(29, 10, 2, 1, 1, 1, 1, 0),
(30, 12, 2, 1, 1, 1, 1, 0),
(31, 11, 2, 1, 1, 1, 1, 0),
(32, 13, 2, 1, 1, 1, 1, 0),
(33, 14, 2, 1, 1, 1, 1, 0),
(34, 15, 2, 1, 1, 1, 1, 0),
(35, 8, 2, 1, 1, 1, 1, 0),
(36, 9, 2, 1, 1, 1, 1, 0),
(37, 17, 2, 1, 1, 1, 1, 0),
(38, 18, 2, 1, 1, 1, 1, 0),
(39, 19, 2, 1, 1, 1, 1, 0),
(40, 21, 2, 1, 1, 1, 1, 0),
(41, 22, 2, 1, 1, 1, 1, 0),
(42, 24, 2, 1, 1, 1, 1, 0),
(43, 25, 2, 1, 1, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_ruangans`
--
ALTER TABLE `booking_ruangans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

--
-- Indexes for table `jadwal_tugas`
--
ALTER TABLE `jadwal_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_tugas_details`
--
ALTER TABLE `jadwal_tugas_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_id` (`petugas_id`),
  ADD KEY `jadwal_tugas_id` (`jadwal_tugas_id`);

--
-- Indexes for table `jenis_barangs`
--
ALTER TABLE `jenis_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kendaraans`
--
ALTER TABLE `jenis_kendaraans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraans`
--
ALTER TABLE `kendaraans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kendaraans_ibfk_1` (`jns_kendaraan_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifs_ibfk_1` (`notif_type_id`);

--
-- Indexes for table `notif_types`
--
ALTER TABLE `notif_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengadaan_barangs`
--
ALTER TABLE `pengadaan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_barang_id` (`jenis_barang_id`);

--
-- Indexes for table `perawatan_barangs`
--
ALTER TABLE `perawatan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_barang_id` (`jenis_barang_id`);

--
-- Indexes for table `perpanjangan_stnks`
--
ALTER TABLE `perpanjangan_stnks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perpanjangan_stnks_ibfk_1` (`kendaraan_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_tipe_id` (`petugas_tipe_id`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_petugas`
--
ALTER TABLE `tipe_petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_category_id` (`user_category_id`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `user_category_id` (`user_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_ruangans`
--
ALTER TABLE `booking_ruangans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `jadwal_tugas`
--
ALTER TABLE `jadwal_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `jadwal_tugas_details`
--
ALTER TABLE `jadwal_tugas_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `jenis_barangs`
--
ALTER TABLE `jenis_barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jenis_kendaraans`
--
ALTER TABLE `jenis_kendaraans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kendaraans`
--
ALTER TABLE `kendaraans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `notifs`
--
ALTER TABLE `notifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `notif_types`
--
ALTER TABLE `notif_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pengadaan_barangs`
--
ALTER TABLE `pengadaan_barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `perawatan_barangs`
--
ALTER TABLE `perawatan_barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `perpanjangan_stnks`
--
ALTER TABLE `perpanjangan_stnks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipe_petugas`
--
ALTER TABLE `tipe_petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_tugas_details`
--
ALTER TABLE `jadwal_tugas_details`
  ADD CONSTRAINT `jadwal_tugas_details_ibfk_1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_tugas_details_ibfk_2` FOREIGN KEY (`jadwal_tugas_id`) REFERENCES `jadwal_tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kendaraans`
--
ALTER TABLE `kendaraans`
  ADD CONSTRAINT `kendaraans_ibfk_1` FOREIGN KEY (`jns_kendaraan_id`) REFERENCES `jenis_kendaraans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifs`
--
ALTER TABLE `notifs`
  ADD CONSTRAINT `notifs_ibfk_1` FOREIGN KEY (`notif_type_id`) REFERENCES `notif_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan_barangs`
--
ALTER TABLE `pengadaan_barangs`
  ADD CONSTRAINT `pengadaan_barangs_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perawatan_barangs`
--
ALTER TABLE `perawatan_barangs`
  ADD CONSTRAINT `perawatan_barangs_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perpanjangan_stnks`
--
ALTER TABLE `perpanjangan_stnks`
  ADD CONSTRAINT `perpanjangan_stnks_ibfk_1` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`petugas_tipe_id`) REFERENCES `tipe_petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_category_id`) REFERENCES `user_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD CONSTRAINT `user_privileges_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_privileges_ibfk_2` FOREIGN KEY (`user_category_id`) REFERENCES `user_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
