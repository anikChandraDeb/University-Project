-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2018 at 09:54 PM
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
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'b-'),
(10, 'a+'),
(3, 'b+'),
(4, 'a-'),
(11, 'ab+'),
(12, 'ab-'),
(13, 'o+'),
(14, 'o-');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `post_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `website` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `status` varchar(255) COLLATE utf8_bin NOT NULL,
  `reply_username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `post_title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=50 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`, `reply_username`, `post_title`) VALUES
(46, 1541113235, 'Ikble', 'Ikble', 17, 'aniksep222@gmail.com', 'anikproblemsolve.blogspot.com', 'anik.png', 0x616e696b70726f626c656d736f6c766520616e696b70726f626c656d736f6c766520616e696b70726f626c656d736f6c7665202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020, 'approve', NULL, 'I have need B+ blood for my  heart operation...'),
(44, 1540717361, 'Anik Deb', 'anikdeb', 17, 'anikprem222@gmail.com', '', 'anik.png', 0x486579206d616e207768617427732075703f, 'approve', 'AP', 'I have need B+ blood for my  heart operation...'),
(45, 1541107185, 'Ajgor hossain (ome)', 'Ajgor hossain (ome)', 17, 'ajgor.ome1996@gamil.com', 'I am give you B+ blood.', 'unknown.jpg', 0x4920616d206769766520796f7520422b20626c6f6f642e4920616d206769766520796f7520422b20626c6f6f642e4920616d206769766520796f7520422b20626c6f6f642e4920616d206769766520796f7520422b20626c6f6f642e4920616d206769766520796f7520422b20626c6f6f642e4920616d206769766520796f7520422b20626c6f6f642e202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020202020, 'approve', NULL, 'I have need B+ blood for my  heart operation...'),
(43, 1540716641, 'AP', 'AP', 17, 'aniksep222@gmail.com', 'nice', 'anik.png', 0x6e696365206a6f62, 'approve', NULL, 'I have need B+ blood for my  heart operation...'),
(47, 1541115153, 'Eikbal Kayes', 'eikbalkayes', 18, 'eikbalkayes920@gmail.com', '', 'Problem.PNG', 0x506c6561736520686172727920757020646f6e6f722e, 'approve', NULL, NULL),
(48, 1541115742, 'Anik Deb', 'anikdeb', 18, 'anikprem222@gmail.com', '', 'anik.png', 0x4920616d206769766520796f7520626c6f6f642074686973206973206d7920636f6e74616374206e756d3a3031373234313032323838, 'approve', NULL, NULL),
(49, 1541115831, 'Anik Deb', 'anikdeb', 18, 'anikprem222@gmail.com', '', 'anik.png', 0x4e696365206a6f62, 'approve', 'eikbalkayes', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `image`) VALUES
(36, 'ta.PNG'),
(35, 'anik.png'),
(34, 'ta.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `author_image` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `categories` varchar(255) COLLATE utf8_bin NOT NULL,
  `tags` varchar(255) COLLATE utf8_bin NOT NULL,
  `post_data` text COLLATE utf8_bin NOT NULL,
  `views` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=19 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `title`, `author`, `author_image`, `image`, `categories`, `tags`, `post_data`, `views`, `status`) VALUES
(16, '1540584472', 'sfdgh', 'anikdeb', 'anik.png', 'circuit.PNG', 'b-', 'sdfg', 0x61646667, 8, 'publish'),
(17, '1540641984', 'I have need B+ blood for my  heart operation...', 'bappy', 'sowkat.jpg', 'Circuit design.PNG', 'b+', 'sldfjklSDK', 0x492068617665206e65656420422b20626c6f6f6420666f72206d7920206865617274206f7065726174696f6e2e2e2e492068617665206e65656420422b20626c6f6f6420666f72206d7920206865617274206f7065726174696f6e2e2e2e492068617665206e65656420422b20626c6f6f6420666f72206d7920206865617274206f7065726174696f6e2e2e2e492068617665206e65656420422b20626c6f6f6420666f72206d7920206865617274206f7065726174696f6e2e2e2e492068617665206e65656420422b20626c6f6f6420666f72206d7920206865617274206f7065726174696f6e2e2e2e492068617665206e65656420422b20626c6f6f6420666f72206d7920206865617274206f7065726174696f6e2e2e2e492068617665206e65656420422b20626c6f6f6420666f72206d7920206865617274206f7065726174696f6e2e2e2e, 21, 'publish'),
(18, '1541114400', 'I hava need O+ blood in Holylab hospital,Brahmanbaria.', 'eikbalkayes', 'Problem.PNG', 'hospital3.jpg', 'o+', 'O+,blood,brahmanbaria.', 0x492068617661206e656564204f2b20626c6f6f6420696e20486f6c796c616220686f73706974616c2c427261686d616e62617269612e492068617661206e656564204f2b20626c6f6f6420696e20486f6c796c616220686f73706974616c2c427261686d616e62617269612e492068617661206e656564204f2b20626c6f6f6420696e20486f6c796c616220686f73706974616c2c427261686d616e62617269612e492068617661206e656564204f2b20626c6f6f6420696e20486f6c796c616220686f73706974616c2c427261686d616e62617269612e492068617661206e656564204f2b20626c6f6f6420696e20486f6c796c616220686f73706974616c2c427261686d616e62617269612e492068617661206e656564204f2b20626c6f6f6420696e20486f6c796c616220686f73706974616c2c427261686d616e62617269612e, 4, 'publish');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `first_name`, `last_name`, `username`, `email`, `image`, `password`, `role`, `datails`, `salt`, `blood_group`, `phone`, `district`, `age`, `donor_status`, `gender`) VALUES
(27, '1540462618', '9999999', '999999999', '999999', '999999999', 'anik.png', '$2FWTz9w3OI0w', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'B+', '9999999999', '9999999999', 9999, 'unready', 'male'),
(26, '1540462191', 'omor', 'khan', 'omor', 'omor@gmail.com', 'anik.png', '$2r4nNFVxfj5k', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'B-', '01555555555', 'brahmanbaria', 58, 'unready', 'male'),
(20, '1234567891', 'Anik', 'Deb', 'anikdeb', 'anikprem222@gmail.com', 'anik.png', '$2661wXAvH.Dg', 'admin', 0x616b73686a64666a613b6f6a7364666a6a613b6c73646a666b6d613b6c736b6d6466, '$2y$10$quickbrownfoxjumpsover', 'O-', '01724102288', 'brahmanbaria', 18, 'ready', 'Male'),
(21, '1540435318', 'Tamim', 'mia', 'tamim', 'tamim@gmail.com', 'anik.png', '$2661wXAvH.Dg', 'admin', '', '$2y$10$quickbrownfoxjumpsover', 'O+', '017256102288', 'brahmanbaria', 18, 'ready', 'male'),
(22, '1540460870', '123', '1', '1', '1', 'anik.png', '$2x7m7zVuAVjk', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'AB+', '1', '1', 1, 'unready', 'male'),
(23, '1540460947', '2', '2', '8', '8', 'anik.png', '$2yJG/0T6EyGI', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'A+', '5', '1', 45, 'unready', 'male'),
(24, '1540461643', 'dghdfg', 'sdfgsdfg', 'sdfgsdfg', 'sdfgsdfg', 'Circuit design.PNG', '$2kIako3B/e6U', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'AB-', 'sdfgsdfg', 'sdfgsdfg', 0, 'unready', 'male'),
(25, '1540461860', 'dghdfg', 'sdfgsdfg', 'rtyurtyu', 'rtyurtyu', 'anik.png', '$2XpDqpnfMlEY', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'A-', 'rtyurtyurtyu', 'sdfgsdfg', 0, 'unready', 'male'),
(30, '1540601324', 'Anik chandra', 'deb', 'anikdebprem', 'aniksep222@gmail.com', 'anik.png', '$2cFYylPq.ub2', 'admin', '', '$2y$10$quickbrownfoxjumpsover', 'O+', '01905730745', 'brahmanbaria', 18, 'ready', 'male'),
(31, '1540571581', 'Tonmoy', 'deb', 'tonmoy', 'tonmoy@gmail.com', 'watch.PNG', '$2Cfr2fHK/dZU', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'AB-', '01789456258', 'brahmanbaria', 18, 'unready', 'male'),
(32, '1540580553', 'Ripn', 'deb', 'ripon', 'ripon@gamil.com', '341-1LGWd31506756682.jpg', '$2bGdm8JModAM', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'AB-', '01854687521', 'brahmanbaria', 20, 'unready', 'male'),
(33, '1540641838', 'Bappy', 'mia', 'bappy', 'bappy@gmail.com', 'sowkat.jpg', '$2l9UqFavY9Vg', 'author', '', '$2y$10$quickbrownfoxjumpsover', 'AB+', '25251.21', 'brahmanbaria', 18, 'unready', 'male'),
(34, '1541114083', 'Eikbal', 'Kayes', 'eikbalkayes', 'eikbalkayes920@gmail.com', 'Problem.PNG', '$2.bvdYtFV3x6', 'author', 0x4920616d20616e206469706c6f6d6120696e20636f6d70757465722073747564656e7420736f20646f6e5c5c5c27742e, '$2y$10$quickbrownfoxjumpsover', 'B+', '01733489937', 'mymensingh', 18, 'ready', 'male');
