-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 09:55 AM
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
  `kode_booking` varchar(50) DEFAULT NULL,
  `ruangan_id` int(11) DEFAULT NULL,
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
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_tugas`
--

CREATE TABLE `jadwal_tugas` (
  `id` int(11) NOT NULL,
  `kode_jadwal` varchar(50) DEFAULT NULL,
  `bulan_tugas` varchar(2) DEFAULT NULL,
  `tahun_tugas` varchar(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 1, 'ruangan', 'Nama Ruangan', 'master_ruangan', 1),
(3, 1, 'petugas_cleaning', 'Petugas Cleaning', 'petugas_cleaning', 2),
(4, 1, 'petugas_security', 'Petugas Security', 'petugas_security', 3),
(5, 0, 'dashboard', 'Dashboard', 'dashboard', 1),
(6, NULL, 'pengadaan_barang', 'Pengadaaan Barang', 'pengadaan_barang', 3);

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
  `notif_status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif_types`
--

CREATE TABLE `notif_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) DEFAULT NULL,
  `type_desc` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barangs`
--

CREATE TABLE `penerimaan_barangs` (
  `id` int(11) NOT NULL,
  `kode_penerimaan` varchar(50) DEFAULT NULL,
  `pengadaan_barang_id` int(11) DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `keterangan` text,
  `bukti_foto` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perawatan_barangs`
--

CREATE TABLE `perawatan_barangs` (
  `id` int(11) NOT NULL,
  `kode_perawatan` varchar(50) DEFAULT NULL,
  `tgl_perawatan` datetime DEFAULT NULL,
  `jenis_barang_id` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `direktorat` varchar(100) DEFAULT NULL,
  `alasan_perawatan` text,
  `lokasi` varchar(150) DEFAULT NULL,
  `bukti_foto` varchar(150) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perpanjangan_stnks`
--

CREATE TABLE `perpanjangan_stnks` (
  `id` int(11) NOT NULL,
  `kendaraan_id` int(36) DEFAULT NULL,
  `masa_akhir_perpanjangan` datetime DEFAULT NULL,
  `tgl_perpanjangan` datetime DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` int(11) NOT NULL,
  `kode_ruangan` varchar(50) DEFAULT NULL,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `status_aktif` varchar(1) DEFAULT NULL,
  `status_book` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_petugas`
--

CREATE TABLE `tipe_petugas` (
  `id` int(11) NOT NULL,
  `kode_tipe` varchar(50) DEFAULT NULL,
  `tipe_petugas` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 'Superadmin', 'superadmin', 'superadmin@localhost.com', '0cc175b9c0f1b6a831c399e269772661', '2017-06-22 00:00:00', '0', '2017-06-22 00:00:00', '0');

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
(1, 'Superadmin', '2017-06-22 00:00:00', '0', '2017-06-22 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `user_category_id` int(11) DEFAULT NULL,
  `is_view` varchar(1) DEFAULT NULL,
  `is_insert` varchar(1) DEFAULT NULL,
  `is_update` varchar(1) DEFAULT NULL,
  `is_delete` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`id`, `module_id`, `user_category_id`, `is_view`, `is_insert`, `is_update`, `is_delete`) VALUES
(1, 2, 1, '1', '1', '1', '1'),
(2, 3, 1, '1', '1', '1', '1'),
(3, 4, 1, '1', '1', '1', '1'),
(4, 5, 1, '1', '1', '1', '1');

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
-- Indexes for table `penerimaan_barangs`
--
ALTER TABLE `penerimaan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengadaan_barang_id` (`pengadaan_barang_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jadwal_tugas`
--
ALTER TABLE `jadwal_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jadwal_tugas_details`
--
ALTER TABLE `jadwal_tugas_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_barangs`
--
ALTER TABLE `jenis_barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenis_kendaraans`
--
ALTER TABLE `jenis_kendaraans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kendaraans`
--
ALTER TABLE `kendaraans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notifs`
--
ALTER TABLE `notifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notif_types`
--
ALTER TABLE `notif_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penerimaan_barangs`
--
ALTER TABLE `penerimaan_barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengadaan_barangs`
--
ALTER TABLE `pengadaan_barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perawatan_barangs`
--
ALTER TABLE `perawatan_barangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perpanjangan_stnks`
--
ALTER TABLE `perpanjangan_stnks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipe_petugas`
--
ALTER TABLE `tipe_petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_ruangans`
--
ALTER TABLE `booking_ruangans`
  ADD CONSTRAINT `booking_ruangans_ibfk_1` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `penerimaan_barangs`
--
ALTER TABLE `penerimaan_barangs`
  ADD CONSTRAINT `penerimaan_barangs_ibfk_1` FOREIGN KEY (`pengadaan_barang_id`) REFERENCES `pengadaan_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
