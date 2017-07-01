-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2017 at 07:33 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `depnaker_rumahtanggan`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_ruangans`
--

CREATE TABLE IF NOT EXISTS `booking_ruangans` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `booking_ruangans`
--

INSERT INTO `booking_ruangans` (`id`, `id_user`, `kode_booking`, `ruangan_id`, `direktorat`, `nama_pemesan`, `tgl_book`, `start_time`, `end_time`, `jml_peserta`, `agenda_meeting`, `status`, `keterangan`, `created`, `modified`, `modi_by`) VALUES
(30, 3, 'BOOK1', 1, 'dd', 'ddd', '2017-06-28', '14:00:00', '17:00:00', 3, 'fff', 'C', 'yayaya', '2017-06-27 21:29:09', NULL, NULL),
(31, 3, 'BOOK31', 2, 'sdgdfg', 'hfghfg', '2017-06-28', '14:00:00', '17:00:00', 5, 'jfffj', 'F', '', '2017-06-27 21:44:51', NULL, NULL),
(32, 3, 'BOOK32', 2, 'thfgj', 'jfgjfg', '2017-06-28', '15:00:00', '20:00:00', 4, 'hhhh', 'B', NULL, '2017-06-28 02:17:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE IF NOT EXISTS `ruangans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ruangan` varchar(50) DEFAULT NULL,
  `nama_ruangan` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `create_by` char(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modi_by` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `kode_ruangan`, `nama_ruangan`, `created`, `create_by`, `modified`, `modi_by`) VALUES
(1, 'RUANG1', 'Ruang Meetings 1', '2017-06-23 06:08:37', '1', '2017-06-23 06:27:36', '1'),
(2, 'RUANG2', 'Ruang Meeting 2', '2017-06-23 06:14:28', '1', NULL, NULL),
(4, 'RUANG3', 'wohooo', '2017-06-23 06:35:38', '1', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_ruangans`
--
ALTER TABLE `booking_ruangans`
  ADD CONSTRAINT `booking_ruangans_ibfk_1` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
