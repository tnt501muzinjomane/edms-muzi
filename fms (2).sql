-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2016 at 12:05 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `created_at` varchar(300) NOT NULL,
  `updated_at` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Receipts', '2016-06-18 16:10:44', '2016-06-18 16:10:44'),
(3, 'Admin Doc', '2016-06-18 16:11:45', '2016-06-18 16:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `path` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(300) NOT NULL,
  `updated_at` varchar(300) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `ad` varchar(11) NOT NULL,
  `mi` varchar(11) NOT NULL,
  `lo` varchar(11) NOT NULL,
  `ref` varchar(300) NOT NULL,
  `company` varchar(300) NOT NULL,
  `doc_date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `path`, `description`, `user_id`, `created_at`, `updated_at`, `cat_id`, `ad`, `mi`, `lo`, `ref`, `company`, `doc_date`) VALUES
(9, 'Admin1', 'documents/1466358284.pdf', '<p>hjhgjhjhh</p>', 35, '2016-06-19 19:12:33', '2016-06-19 20:58:10', 1, '3', '', '', '', '', ''),
(8, 'fggffhg', 'documents/1466256132.docx', '<p>hghkhjh nbhvgfbv bgvhbh</p>', 1, '2016-06-18 16:21:48', '2016-06-18 16:21:48', 3, '3', '', '1', '', '', ''),
(7, 'Receipt 567', 'documents/1466255596.pdf', '<p>dsfghh hvhghg</p>', 1, '2016-06-18 16:12:52', '2016-06-20 17:33:16', 2, '3', '2', '', '', '', ''),
(10, 'dsfdgbdgf', 'documents/1466428641.pdf', '<p>ytjhhg</p>', 1, '2016-06-20 16:16:57', '2016-06-21 17:34:52', 2, '3', '2', '1', 'TF56', 'Logicco', ''),
(11, 'dfsdfvf', 'documents/1466428710.docx', '<p>ytfhgfhgfgf</p>', 1, '2016-06-20 16:18:06', '2016-06-20 16:18:06', 3, '3', '2', '', 'RT78', 'School', ''),
(12, 'Invoince1', 'documents/1467204675.docx', '<p>Testing1</p>', 2, '2016-06-29 13:23:31', '2016-06-29 16:00:09', 2, '3', '2', '1', 'ref341', 'Real Image1', ''),
(13, 'Hello', 'documents/1467202336.pdf', '<p>Hi</p>', 2, '2016-06-29 15:11:52', '2016-06-29 15:11:52', 3, '3', '2', '1', 'HR45', 'Mbabane', ''),
(14, 'Hello', 'documents/1467266785.docx', '<p>Hello Muzi</p>', 2, '2016-06-30 09:06:01', '2016-06-30 09:06:01', 3, '3', '2', '1', 'HEL56', 'Mbabane', ''),
(15, 'Test', 'documents/1467358589.docx', '<p>Testing</p>', 0, '2016-07-01 10:36:05', '2016-07-01 10:36:05', 3, '3', '2', '1', 'TE34', 'Maputo', '2016-05-01'),
(16, 'Test4', 'documents/1467359808.docx', '<p>Helo</p>', 1, '2016-07-01 10:56:24', '2016-07-01 11:10:00', 3, '3', '', '', 'TS67', 'Manzini', '2016-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `surname` varchar(300) NOT NULL,
  `path` varchar(300) NOT NULL,
  `privilleges` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `path`, `privilleges`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Muzi', 'Mhlongo', 'profiles/1466432308.jpg', 3, 'muzi@realnet.co.sz', '25d55ad283aa400af464c76d713c07ad', '2016-06-18 11:31:08', '2016-06-20 17:18:28'),
(2, 'Menzi', 'Mhlongo', 'profiles/1466493812.jpg', 2, 'menzi@realnet.co.sz', '25d55ad283aa400af464c76d713c07ad', '2016-06-18 13:00:31', '2016-06-21 10:23:32'),
(3, 'Musa', 'Dludlu', '', 2, 'musa@realnet.co.sz', '25d55ad283aa400af464c76d713c07ad', '2016-06-18 13:09:28', '2016-06-18 13:09:28'),
(4, 'Vusi', 'Mb', 'profiles/1466244977.jpg', 2, 'vusi@realnet.co.sz', '25d55ad283aa400af464c76d713c07ad', '2016-06-18 13:15:53', '2016-06-18 13:15:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
