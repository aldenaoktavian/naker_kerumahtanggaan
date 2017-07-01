-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2017 at 05:13 AM
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
-- Table structure for table `notifs`
--

CREATE TABLE IF NOT EXISTS `notifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `notif_type_id` int(11) DEFAULT NULL,
  `notif_desc` text,
  `notif_url` varchar(150) DEFAULT NULL,
  `notif_status` int(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifs_ibfk_1` (`notif_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `notifs`
--

INSERT INTO `notifs` (`id`, `user_id`, `notif_type_id`, `notif_desc`, `notif_url`, `notif_status`, `created`) VALUES
(63, 1, 9, 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/34173cb38f07f89ddbebc2ac9128303f', 1, '2017-06-27 21:29:10'),
(64, 2, 9, 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/34173cb38f07f89ddbebc2ac9128303f', 1, '2017-06-27 21:29:16'),
(65, 1, 9, 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/c16a5320fa475530d9583c34fd356ef5', 1, '2017-06-27 21:44:51'),
(66, 2, 9, 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/c16a5320fa475530d9583c34fd356ef5', 1, '2017-06-27 21:44:58'),
(67, 1, 9, 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/6364d3f0f495b6ab9dcf8d3b5c6e0b01', 1, '2017-06-28 02:17:15'),
(68, 2, 9, 'Booking ruangan oleh Booking.', 'http://localhost/naker_kerumahtanggaan/booking_ruangan/view/6364d3f0f495b6ab9dcf8d3b5c6e0b01', 1, '2017-06-28 02:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `notif_types`
--

CREATE TABLE IF NOT EXISTS `notif_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) DEFAULT NULL,
  `type_desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifs`
--
ALTER TABLE `notifs`
  ADD CONSTRAINT `notifs_ibfk_1` FOREIGN KEY (`notif_type_id`) REFERENCES `notif_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
