-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2015 at 12:25 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearning_smk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `jurusan_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `jurusan_nama` varchar(50) NOT NULL,
  PRIMARY KEY (`jurusan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`jurusan_id`, `jurusan_nama`) VALUES
(1, 'Multimedia'),
(2, 'Akomodasi Perhotelan'),
(3, 'Bangunan'),
(4, 'Otomotif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajar`
--

CREATE TABLE IF NOT EXISTS `tb_pengajar` (
  `pengajar_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pengajar_nama` varchar(100) NOT NULL,
  `pengajar_nip` varchar(30) NOT NULL,
  `pengajar_username` varchar(100) NOT NULL,
  `pengajar_password` varchar(100) NOT NULL,
  `pengajar_alamat` varchar(100) NOT NULL,
  `pengajar_group` int(2) NOT NULL,
  PRIMARY KEY (`pengajar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tb_pengajar`
--

INSERT INTO `tb_pengajar` (`pengajar_id`, `pengajar_nama`, `pengajar_nip`, `pengajar_username`, `pengajar_password`, `pengajar_alamat`, `pengajar_group`) VALUES
(1, 'I Kadek Adi Suandana, S.Kom', '', 'kadoelnoesa', 'f7e4d600ecaef4290b4b315dc685d084', 'Br. Mentigi, Batununggul', 2),
(15, 'I Kadek Juliantara, S.Pd', '', 'juliantara', '9df0d0a7ae79611af11151fa0018622c', 'nusa penida', 2),
(16, 'I Gede Juli, S.Pd', '', 'gedejuli', 'a0a448c73ddeb0657f4c90e9784fefc1', 'Br. Kutampi', 2),
(17, 'Super Administrator', '', 'admin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'Nusa Penida', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE IF NOT EXISTS `tb_setting` (
  `setting_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `setting_semester` varchar(50) DEFAULT NULL,
  `setting_thnajaran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`setting_id`, `setting_semester`, `setting_thnajaran`) VALUES
(1, 'Genap', '2014/2015');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
