-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2017 at 05:08 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `futsalsocial`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `rownum`() RETURNS int(11)
BEGIN
  set @prvrownum=if(@ranklastrun=CURTIME(6),@prvrownum+1,1);
  set @ranklastrun=CURTIME(6);
  RETURN @prvrownum;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `team_challenge_count`( team_id int(11) ) RETURNS int(11)
BEGIN 
  DECLARE total int(11);
  SET total = ( SELECT count(*) FROM team_challenge WHERE ( inviter_team = team_id OR rival_team = team_id ) AND status_challenge = 5 );
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `team_inviter_point`( team_id int(11) ) RETURNS int(11)
BEGIN 
  DECLARE total int(11);
  SET total = ( SELECT CASE WHEN SUM(inviter_point) IS NULL THEN 0 ELSE SUM(inviter_point) END FROM team_challenge WHERE inviter_team = team_id AND status_challenge = 5 );
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `team_inviter_score`( team_id int(11) ) RETURNS int(11)
BEGIN 
  DECLARE total int(11);
  SET total = ( SELECT CASE WHEN SUM(inviter_score) IS NULL THEN 0 ELSE SUM(inviter_score) END FROM team_challenge WHERE inviter_team = team_id AND status_challenge = 5 );
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `team_rival_point`( team_id int(11) ) RETURNS int(11)
BEGIN 
  DECLARE total int(11);
  SET total = ( SELECT CASE WHEN SUM(rival_point) IS NULL THEN 0 ELSE SUM(rival_point) END FROM team_challenge WHERE rival_team = team_id AND status_challenge = 5 );
  RETURN total;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `team_rival_score`( team_id int(11) ) RETURNS int(11)
BEGIN 
  DECLARE total int(11);
  SET total = ( SELECT CASE WHEN SUM(rival_score) IS NULL THEN 0 ELSE SUM(rival_score) END FROM team_challenge WHERE rival_team = team_id AND status_challenge = 5 );
  RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `notif_type` int(11) NOT NULL,
  `notif_detail` varchar(255) NOT NULL,
  `notif_url` varchar(255) NOT NULL,
  `notif_status` int(1) NOT NULL,
  `notif_created` datetime NOT NULL,
  `notif_show` int(1) NOT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`notif_id`, `member_id`, `notif_type`, `notif_detail`, `notif_url`, `notif_status`, `notif_created`, `notif_show`) VALUES
(8, 2, 1, '"Team Coba" mengundang Anda untuk bergabung dalam tim.', 'http://localhost/futsalsocial/notif/team_request/1679091c5a880faf6fb5e6087eb1b2dc', 1, '2017-06-06 01:18:36', 0),
(11, 1, 2, 'Reno telah menerima permintaan Anda untuk bergabung dalam tim.', 'http://localhost/futsalsocial/notif/team_request/1679091c5a880faf6fb5e6087eb1b2dc', 1, '2017-06-06 01:42:31', 0),
(16, 4, 4, 'Tim "Team Halo" mengundang tim Anda untuk melakukan pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/d3d9446802a44259755d38e6d163e820', 1, '2017-06-10 10:20:53', 0),
(17, 3, 4, 'Tim "Team Halo" mengundang tim Anda untuk melakukan pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/aab3238922bcc25a6f606eb525ffdc56', 1, '2017-06-10 17:07:54', 0),
(21, 4, 9, 'Tim "Team Coba" mengajukan score challenge.', 'http://localhost/futsalsocial/notif/detail_score_challenge/d3d9446802a44259755d38e6d163e820', 1, '2017-06-15 18:15:29', 0),
(25, 1, 10, 'Tim "Team Halods" mengajukan revisi untuk score challenge.', 'http://localhost/futsalsocial/notif/detail_score_challenge/d3d9446802a44259755d38e6d163e820', 1, '2017-06-15 18:49:00', 0),
(26, 2, 10, 'Tim "Team Halods" mengajukan revisi untuk score challenge.', 'http://localhost/futsalsocial/notif/detail_score_challenge/d3d9446802a44259755d38e6d163e820', 0, '2017-06-15 18:49:00', 0),
(27, 4, 9, 'Tim "Team Coba" mengajukan score challenge.', 'http://localhost/futsalsocial/notif/detail_score_challenge/d3d9446802a44259755d38e6d163e820', 1, '2017-06-15 18:49:16', 0),
(28, 1, 10, 'Tim "Team Halods" mengajukan revisi untuk score challenge.', 'http://localhost/futsalsocial/notif/detail_score_challenge/d3d9446802a44259755d38e6d163e820', 1, '2017-06-15 18:49:37', 0),
(29, 2, 10, 'Tim "Team Halods" mengajukan revisi untuk score challenge.', 'http://localhost/futsalsocial/notif/detail_score_challenge/d3d9446802a44259755d38e6d163e820', 0, '2017-06-15 18:49:37', 0),
(31, 4, 11, 'Score challenge telah disetujui', 'http://localhost/futsalsocial/notif/detail_score_challenge/d3d9446802a44259755d38e6d163e820', 1, '2017-06-15 19:03:55', 0),
(32, 3, 4, 'Tim "Team Coba" mengundang tim Anda untuk melakukan pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/9bf31c7ff062936a96d3c8bd1f8f2ff3', 1, '2017-06-17 01:10:34', 0),
(33, 1, 5, 'Tim "Team Coba Coba" mengajukan revisi.', 'http://localhost/futsalsocial/notif/detail_revisi_challenge/9bf31c7ff062936a96d3c8bd1f8f2ff3', 1, '2017-06-17 01:12:35', 1),
(37, 3, 12, 'Tim "Team Coba Coba" merubah challenge.', 'http://localhost/futsalsocial/notif/detail_challenge/9bf31c7ff062936a96d3c8bd1f8f2ff3', 1, '2017-06-18 20:48:50', 0),
(86, 6, 1, '"Team Coba" mengundang Anda untuk bergabung dalam tim.', 'http://localhost/futsalsocial/notif/team_request/02e74f10e0327ad868d138f2b4fdd6f0', 1, '2017-06-29 08:30:37', 0),
(88, 1, 3, 'Atan menolak permintaan Anda untuk bergabung dalam tim.', 'http://localhost/futsalsocial/notif/team_request/02e74f10e0327ad868d138f2b4fdd6f0', 1, '2017-06-29 08:32:25', 0),
(92, 3, 4, 'Tim "Team Coba" mengundang tim Anda untuk melakukan pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/1f0e3dad99908345f7439f8ffabdffc4', 1, '2017-06-29 08:46:56', 0),
(109, 1, 5, 'Tim "Team Coba Coba" mengajukan revisi.', 'http://localhost/futsalsocial/notif/detail_revisi_challenge/1f0e3dad99908345f7439f8ffabdffc4', 1, '2017-06-29 13:46:28', 0),
(110, 2, 5, 'Tim "Team Coba Coba" mengajukan revisi.', 'http://localhost/futsalsocial/notif/detail_revisi_challenge/1f0e3dad99908345f7439f8ffabdffc4', 0, '2017-06-29 13:46:28', 0),
(111, 3, 6, 'Tim "Team Coba" telah merubah pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/1f0e3dad99908345f7439f8ffabdffc4', 1, '2017-06-29 14:03:48', 0),
(120, 1, 9, 'Tim "Team Coba Coba" menyetujui pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/1f0e3dad99908345f7439f8ffabdffc4', 1, '2017-06-29 14:30:50', 0),
(121, 2, 9, 'Tim "Team Coba Coba" menyetujui pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/1f0e3dad99908345f7439f8ffabdffc4', 0, '2017-06-29 14:30:50', 0),
(130, 3, 4, 'Tim "Team Coba" mengundang tim Anda untuk melakukan pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/33e75ff09dd601bbe69f351039152189', 1, '2017-06-30 01:40:57', 0),
(131, 1, 5, 'Tim "Team Coba Coba" mengajukan revisi.', 'http://localhost/futsalsocial/notif/detail_revisi_challenge/33e75ff09dd601bbe69f351039152189', 1, '2017-06-30 02:32:24', 0),
(132, 2, 5, 'Tim "Team Coba Coba" mengajukan revisi.', 'http://localhost/futsalsocial/notif/detail_revisi_challenge/33e75ff09dd601bbe69f351039152189', 0, '2017-06-30 02:32:24', 0),
(138, 3, 6, 'Tim "Team Coba" telah merubah pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/33e75ff09dd601bbe69f351039152189', 1, '2017-06-30 06:33:34', 0),
(139, 1, 5, 'Tim "Team Coba Coba" mengajukan revisi.', 'http://localhost/futsalsocial/notif/detail_revisi_challenge/33e75ff09dd601bbe69f351039152189', 1, '2017-06-30 06:35:43', 0),
(140, 2, 5, 'Tim "Team Coba Coba" mengajukan revisi.', 'http://localhost/futsalsocial/notif/detail_revisi_challenge/33e75ff09dd601bbe69f351039152189', 0, '2017-06-30 06:35:43', 0),
(141, 3, 8, 'Tim "Team Coba" membatalkan pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/33e75ff09dd601bbe69f351039152189', 1, '2017-06-30 06:36:05', 0),
(143, 2, 11, 'Tim "Team Coba Coba" mengajukan score pertandingan.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 0, '2017-06-30 06:50:21', 0),
(144, 3, 4, 'Tim "Team Coba" mengundang tim Anda untuk melakukan pertandingan.', 'http://localhost/futsalsocial/notif/detail_challenge/6ea9ab1baa0efb9e19094440c317e21b', 1, '2017-06-30 06:58:19', 0),
(145, 1, 11, 'Tim "Team Coba Coba" mengajukan score pertandingan.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 1, '2017-06-30 07:08:35', 0),
(146, 2, 11, 'Tim "Team Coba Coba" mengajukan score pertandingan.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 0, '2017-06-30 07:08:35', 0),
(148, 1, 11, 'Tim "Team Coba Coba" mengajukan score pertandingan.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 1, '2017-06-30 07:33:23', 0),
(149, 2, 11, 'Tim "Team Coba Coba" mengajukan score pertandingan.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 0, '2017-06-30 07:33:23', 0),
(150, 3, 12, 'Tim "Team Coba" mengajukan revisi untuk score pertandingan.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 1, '2017-06-30 07:33:31', 0),
(151, 1, 13, 'Score pertandingan telah disetujui.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 1, '2017-06-30 07:34:01', 0),
(152, 2, 13, 'Score pertandingan telah disetujui.', 'http://localhost/futsalsocial/notif/detail_score_challenge/6512bd43d9caa6e02c990b0a82652dca', 0, '2017-06-30 07:34:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notif_type`
--

CREATE TABLE IF NOT EXISTS `notif_type` (
  `notif_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `notif_type_name` varchar(100) NOT NULL,
  `notif_type_detail` varchar(255) NOT NULL,
  PRIMARY KEY (`notif_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `notif_type`
--

INSERT INTO `notif_type` (`notif_type_id`, `notif_type_name`, `notif_type_detail`) VALUES
(1, 'Undangan Bergabung ke Team', '"{team_name}" mengundang Anda untuk bergabung dalam tim.'),
(2, 'Undangan Bergabung Diterima', '{member_name} telah menerima permintaan Anda untuk bergabung dalam tim.'),
(3, 'Undangan Bergabung Ditolak', '{member_name} menolak permintaan Anda untuk bergabung dalam tim.'),
(4, 'Undangan Permintaan Challenge', 'Tim "{inviter_team_name}" mengundang tim Anda untuk melakukan pertandingan.'),
(5, 'Permintaan Revisi Challenge', 'Tim "{rival_team_name}" mengajukan revisi.'),
(6, 'Update Challenge oleh Inviter', 'Tim "{inviter_team_name}" telah merubah pertandingan.'),
(7, 'Challenge Ditolak', 'Tim "{rival_team_name}" menolak pertandingan.'),
(8, 'Challenge Dibatalkan', 'Tim "{inviter_team_name}" membatalkan pertandingan.'),
(9, 'Challenge Diterima', 'Tim "{rival_team_name}" menyetujui pertandingan.'),
(10, 'Reminder Input Score', ''),
(11, 'Pengajuan Score Challenge', 'Tim "{inviter_team_name}" mengajukan score pertandingan.'),
(12, 'Revisi Score Challenge', 'Tim "{team_name}" mengajukan revisi untuk score pertandingan.'),
(13, 'Score Challenge Disetujui', 'Score pertandingan telah disetujui.'),
(14, 'Comment Post Member', '{member_name} mengomentari post Anda.'),
(15, 'Comment Challenge', '{member_name} mengomentari challenge tim Anda.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
