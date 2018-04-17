-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db706893253.db.1and1.com
-- Generation Time: Apr 17, 2018 at 08:50 PM
-- Server version: 5.5.59-0+deb7u1-log
-- PHP Version: 5.4.45-0+deb7u13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db706893253`
--

-- --------------------------------------------------------

--
-- Table structure for table `About_me`
--

CREATE TABLE IF NOT EXISTS `About_me` (
  `My_Information` text COLLATE latin1_general_ci,
  `My _relationship _with you` text COLLATE latin1_general_ci,
  `User_ID` int(11) DEFAULT NULL,
  `Owner_ID` int(11) NOT NULL DEFAULT '0',
  `Memories_with_you` text COLLATE latin1_general_ci,
  `My_Name` text COLLATE latin1_general_ci,
  PRIMARY KEY (`Owner_ID`),
  KEY `User_ID` (`User_ID`) COMMENT 'User_ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `About_me`
--

INSERT INTO `About_me` (`My_Information`, `My _relationship _with you`, `User_ID`, `Owner_ID`, `Memories_with_you`, `My_Name`) VALUES
('dfsdsf', 'dfsd', 7, 5, 'dsfsd', 'Catherine');

-- --------------------------------------------------------

--
-- Table structure for table `Digital_Albums`
--

CREATE TABLE IF NOT EXISTS `Digital_Albums` (
  `Owner_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Journal_Title` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Date` date DEFAULT NULL,
  `Comment` text COLLATE latin1_general_ci,
  PRIMARY KEY (`Journal_Title`),
  KEY `User_ID` (`User_ID`) COMMENT 'User_ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

CREATE TABLE IF NOT EXISTS `Image` (
  `imageID` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `img_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `img_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`img_name`),
  UNIQUE KEY `imageID` (`imageID`,`img_title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Photos`
--

CREATE TABLE IF NOT EXISTS `Photos` (
  `User_ID` int(11) DEFAULT NULL,
  `Photo_ID` int(11) NOT NULL DEFAULT '0',
  `Owner_ID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`Photo_ID`),
  KEY `User_ID` (`User_ID`) COMMENT 'User_ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Reminders`
--

CREATE TABLE IF NOT EXISTS `Reminders` (
  `User_ID` int(11) DEFAULT NULL,
  `Reminders_ID` varchar(15) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Notes` text COLLATE latin1_general_ci,
  `To_do_list` text COLLATE latin1_general_ci,
  `Owner_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Reminders_ID`),
  KEY `User_ID` (`User_ID`) COMMENT 'User_ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Sounds`
--

CREATE TABLE IF NOT EXISTS `Sounds` (
  `User_ID` int(11) DEFAULT NULL,
  `Sound _ID` int(11) NOT NULL DEFAULT '0',
  `Owner_ID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`Sound _ID`),
  KEY `User_ID` (`User_ID`) COMMENT 'User_ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User_Image`
--

CREATE TABLE IF NOT EXISTS `User_Image` (
  `imageID` int(100) NOT NULL AUTO_INCREMENT,
  `User_ID` int(100) NOT NULL,
  `img_title` text COLLATE latin1_general_ci NOT NULL,
  `img_desc` text COLLATE latin1_general_ci NOT NULL,
  `img_filename` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`imageID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `User_Image`
--

INSERT INTO `User_Image` (`imageID`, `User_ID`, `img_title`, `img_desc`, `img_filename`) VALUES
(1, 1, 'Testing now', 'Hello', '5a82d769e00828.42322766.png'),
(2, 0, 'test', 'test', '4Capture.PNG'),
(3, 10, 'test', 'test', '8Capture.PNG'),
(4, 10, 'test2', 'test2', '9Capture.PNG'),
(5, 10, 'test3', 'test3', '10Capture.PNG'),
(6, 10, 'test', 'test', 'delete.png'),
(7, 19, 'test', 'test', '2018-02-15_1512.png'),
(8, 11, 'test', 'test', 'WhatsApp Image 2018-02-27 at 10.54.09.jpeg'),
(9, 10, 'test', 'test', 'edit.png');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Owner_ID` int(11) DEFAULT '1',
  `Password` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Email_address` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `Name` text COLLATE latin1_general_ci NOT NULL,
  `ConfirmPassword` text COLLATE latin1_general_ci NOT NULL,
  `Username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`User_ID`),
  KEY `Owner_ID` (`Owner_ID`) COMMENT 'Owner_ID'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`User_ID`, `Owner_ID`, `Password`, `Email_address`, `Name`, `ConfirmPassword`, `Username`) VALUES
(1, 1, 'password', 'catherinemcclos', '', '', '0'),
(7, 1, 'adrianpassx', 'test@test.com', 'Adrian', 'adrianpass', '0'),
(11, 1, 'Vicky', 'vdonaghy081@hot', 'Victoria', 'Vicky', 'Victoria'),
(10, 1, '29august', 'mccloskey-c22@u', 'Catherine', '29august', 'Cath'),
(12, 1, '', '', '', '', ''),
(13, 1, '', '', '', '', ''),
(14, 1, '29august', 'catherinemcclos', 'Catherine', '29august', 'catherine'),
(15, 1, 'password', 'sarah@example.c', 'Sarah', 'password', 'sarah'),
(16, 1, 'password', 'alison@example.', 'Alison', 'password', 'ali'),
(17, 1, '', '', '', '', ''),
(18, 1, '', '', '', '', ''),
(19, 1, '0228ffg60', 'naucnik@gmail.com', 'Jasenko Test', '0228ffg60', 'jasenko');

-- --------------------------------------------------------

--
-- Table structure for table `Videos`
--

CREATE TABLE IF NOT EXISTS `Videos` (
  `User_ID` int(11) DEFAULT NULL,
  `Video_ID` int(11) NOT NULL DEFAULT '0',
  `Owner_ID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`Video_ID`),
  KEY `User_ID` (`User_ID`) COMMENT 'User_ID'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(400) COLLATE latin1_general_ci DEFAULT NULL,
  `category` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `eventDay` int(2) DEFAULT NULL,
  `eventMonth` int(2) DEFAULT NULL,
  `eventYear` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `description`, `category`, `eventDay`, `eventMonth`, `eventYear`) VALUES
(1, 'today', 'hello world', NULL, 8, 2, 2015),
(2, 'tomorrow', 'hello world', NULL, 9, 2, 2015),
(3, '', '', '', 0, 0, 0),
(4, '', '', '', 0, 0, 0),
(5, '', '', '', 0, 0, 0),
(6, 'Yesterday ', 'test', 'school', 20, 1, 2018),
(7, 'Catherine', 'test', 'school', 20, 1, 2018),
(8, 'hello', '....', 'school', 22, 3, 2018),
(9, 'hello', 'sdsd', 'school', 23, 1, 2018),
(10, 'Hello', 'sds', 'school', 23, 1, 2018),
(11, 'sdd', 'sada', 'school', 4, 2, 2018),
(12, '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(150) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category`) VALUES
('school');

-- --------------------------------------------------------

--
-- Table structure for table `digitalDiary`
--

CREATE TABLE IF NOT EXISTS `digitalDiary` (
  `diaryID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `diary_title` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `diary_date` date NOT NULL,
  `diaryEntry` varchar(10000) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`diaryID`),
  UNIQUE KEY `User_ID` (`User_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Block',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `post_body` text COLLATE latin1_general_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `posted` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profileimg`
--

CREATE TABLE IF NOT EXISTS `profileimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `table_img`
--

CREATE TABLE IF NOT EXISTS `table_img` (
  `image_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `imageName` blob NOT NULL,
  PRIMARY KEY (`image_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_gallery_shares`
--

CREATE TABLE IF NOT EXISTS `user_gallery_shares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shared_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `shared_user_id` (`shared_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_gallery_shares`
--

INSERT INTO `user_gallery_shares` (`id`, `user_id`, `shared_user_id`) VALUES
(7, 10, 11);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
