-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2018 at 03:43 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(70) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` varchar(255) COLLATE utf8_bin NOT NULL,
  `datails` text COLLATE utf8_bin NOT NULL,
  `salt` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '$2y$10$quickbrownfoxjumpsover',
  `blood_group` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `district` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `donor_status` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=30 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `first_name`, `last_name`, `username`, `email`, `image`, `password`, `role`, `datails`, `salt`, `blood_group`, `phone`, `district`, `age`, `donor_status`, `gender`) VALUES
(27, '1540462618', '9999999', '999999999', '999999', '999999999', 'anik.png', '$2FWTz9w3OI0w', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'B+', '9999999999', '9999999999', 9999, 'unready', 'male'),
(26, '1540462191', 'omor', 'khan', 'omor', 'omor@gmail.com', 'anik.png', '$2r4nNFVxfj5k', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'B-', '01555555555', 'brahmanbaria', 58, 'unready', 'male'),
(20, '1234567891', 'Anik', 'Deb', 'anikdeb', 'anikprem222@gmail.com', 'anik.png', '$2xD5RJNGWBNc', 'admin', 0x616b73686a64666a613b6f6a7364666a6a613b6c73646a666b6d613b6c736b6d6466, '$2y$10$quickbrownfoxjumpsover', 'O-', '01724102288', 'brahmanbaria', 18, 'ready', 'Male'),
(21, '1540435318', 'Tamim', 'mia', 'tamim', 'tamim@gmail.com', 'anik.png', '$2661wXAvH.Dg', 'admin', '', '$2y$10$quickbrownfoxjumpsover', 'O+', '017256102288', 'brahmanbaria', 18, 'ready', 'male'),
(22, '1540460870', '123', '1', '1', '1', 'anik.png', '$2x7m7zVuAVjk', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'AB+', '1', '1', 1, 'unready', 'male'),
(23, '1540460947', '2', '2', '8', '8', 'anik.png', '$2yJG/0T6EyGI', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'A+', '5', '1', 45, 'unready', 'male'),
(24, '1540461643', 'dghdfg', 'sdfgsdfg', 'sdfgsdfg', 'sdfgsdfg', 'Circuit design.PNG', '$2kIako3B/e6U', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'AB-', 'sdfgsdfg', 'sdfgsdfg', 0, 'unready', 'male'),
(25, '1540461860', 'dghdfg', 'sdfgsdfg', 'rtyurtyu', 'rtyurtyu', 'anik.png', '$2XpDqpnfMlEY', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'A-', 'rtyurtyurtyu', 'sdfgsdfg', 0, 'unready', 'male'),
(28, '1540498949', 'Arnov', 'deb', 'arnov', 'arnov@gmail.com', 'anik.png', '$2xD5RJNGWBNc', 'author', 0x4920616d2061206167726963756c747572616c20656e67696e656572202e736f20706c6561736520616e79206b696e6473206f66206167726963756c747572616c2070726f626c656d20636f6e74616374206d652e, '$2y$10$quickbrownfoxjumpsover', 'B+', '01929768206', 'brahmanbaria', 18, 'ready', 'male'),
(29, '1540501495', 'Rekha rani', 'deb', 'rekha', 'rekha@gami.com', 'Problem.PNG', '$2xD5RJNGWBNc', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'B+', '01786787623', 'brahmanbaria', 50, 'unready', 'female');
