-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2016 at 09:59 AM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afekabookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

 create Database afekabookdb;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PostId` int(11) NOT NULL,
  `Publisher` varchar(320) NOT NULL,
  `Comment` varchar(1000) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Id`, `PostId`, `Publisher`, `Comment`, `Date`) VALUES
(17, 163, 'ariel@a.com', 'you must be the smartest guy I know..', '2016-07-05 20:23:48'),
(16, 160, 'matan@a.com', 'You Are My Master !!!', '2016-07-04 21:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `userEmail` varchar(320) NOT NULL,
  `friendEmail` varchar(320) NOT NULL,
  PRIMARY KEY (`userEmail`,`friendEmail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`userEmail`, `friendEmail`) VALUES
('ariel@a.com', 'barak@a.com'),
('ariel@a.com', 'james@a.com'),
('ariel@a.com', 'matan@a.com'),
('barak@a.com', 'ariel@a.com'),
('barak@a.com', 'james@a.com'),
('barak@a.com', 'matan@a.com'),
('james@a.com', 'ariel@a.com'),
('matan@a.com', 'ariel@a.com'),
('matan@a.com', 'barak@a.com'),
('matan@a.com', 'james@a.com');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Publisher` varchar(320) NOT NULL,
  `Src` varchar(1000) NOT NULL,
  `Thumb` varchar(1000) DEFAULT NULL,
  `PostId` int(11) DEFAULT NULL,
  `Privacy` varchar(10) NOT NULL DEFAULT 'Public',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`Id`, `Publisher`, `Src`, `Thumb`, `PostId`, `Privacy`) VALUES
(121, 'matan@a.com', 'server/users/matan@a.com/gallery/nature-0024.png', NULL, NULL, 'Public'),
(120, 'ariel@a.com', 'server/users/ariel@a.com/gallery/HelloWorld.svg_.png', NULL, 160, 'Public'),
(119, 'ariel@a.com', 'server/users/ariel@a.com/gallery/hello-world.jpg', 'server/users/ariel@a.com/gallery/thumb/hello-world.jpg', 160, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `PostId` int(11) NOT NULL,
  `Publisher` varchar(320) NOT NULL,
  PRIMARY KEY (`PostId`,`Publisher`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`PostId`, `Publisher`) VALUES
(160, 'ariel@a.com'),
(160, 'matan@a.com'),
(161, 'matan@a.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ThePost` varchar(1000) NOT NULL,
  `Publisher` varchar(320) NOT NULL,
  `Privacy` varchar(10) NOT NULL,
  `Likes` int(11) DEFAULT '0',
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`Id`, `ThePost`, `Publisher`, `Privacy`, `Likes`, `Date`) VALUES
(160, 'Hello World !!\n\n* Celebrating- success *', 'ariel@a.com', 'Public', 2, '2016-07-04 18:07:57'),
(161, 'This is nice :)', 'matan@a.com', 'Public', 1, '2016-07-04 18:34:09'),
(163, 'Don''t try to contact me this week, I''m on a secret mission', 'james@a.com', 'Public', 0, '2016-07-05 17:20:47'),
(164, 'Yes We Can!!\n\n* Eating- steak *', 'barak@a.com', 'Public', 0, '2016-07-09 09:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `FirstName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(320) NOT NULL,
  `Password` varchar(512) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `ProfilePic` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FirstName`, `LastName`, `DOB`, `Email`, `Password`, `Gender`, `ProfilePic`) VALUES
('James', 'Bond', '2016-07-05', 'james@a.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'Male', 'server/users/james@a.com/download (1).jpg'),
('Ariel', 'Gurevich', '2016-07-04', 'ariel@a.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'Male', 'server/users/ariel@a.com/ppp.jpg'),
('Matan', 'Giat', '2016-07-04', 'matan@a.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'Male', 'server/users/matan@a.com/nature-0006.png'),
('Barak', 'Obama', '2016-07-09', 'barak@a.com', 'ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb', 'Male', 'server/users/barak@a.com/download.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
