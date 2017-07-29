-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: afekabookdb
-- ------------------------------------------------------
-- Server version	5.7.15-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PostId` int(11) NOT NULL,
  `Publisher` varchar(320) NOT NULL,
  `Comment` varchar(1000) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,'roi@gmail.com','Messi is the best player ever!','2017-07-29 14:13:18');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `userEmail` varchar(320) NOT NULL,
  `friendEmail` varchar(320) NOT NULL,
  PRIMARY KEY (`userEmail`,`friendEmail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES ('messi@gmail.com','roi@gmail.com'),('messi@gmail.com','yonatan@gmail.com'),('roi@gmail.com','messi@gmail.com'),('roi@gmail.com','yonatan@gmail.com'),('ronaldo@gmail.com','messi@gmail.com'),('ronaldo@gmail.com','roi@gmail.com'),('ronaldo@gmail.com','yonatan@gmail.com'),('yonatan@gmail.com','messi@gmail.com'),('yonatan@gmail.com','roi@gmail.com');
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Publisher` varchar(320) NOT NULL,
  `Src` varchar(1000) NOT NULL,
  `Thumb` varchar(1000) DEFAULT NULL,
  `PostId` int(11) DEFAULT NULL,
  `Privacy` varchar(10) NOT NULL DEFAULT 'Public',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (1,'yonatan@gmail.com','server/users/yonatan@gmail.com/gallery/lionel-messi-barcelona-psg-uefa-champions-league-08032016_feltmf12bt0f18v9iprtnl463.jpg','server/users/yonatan@gmail.com/gallery/thumblionel-messi-barcelona-psg-uefa-champions-league-08032016_feltmf12bt0f18v9iprtnl463.jpg',1,'Public'),(2,'ronaldo@gmail.com','server/users/ronaldo@gmail.com/gallery/download.jpg','server/users/ronaldo@gmail.com/gallery/thumbdownload.jpg',3,'Public'),(3,'messi@gmail.com','server/users/messi@gmail.com/gallery/download.jpg','server/users/messi@gmail.com/gallery/thumbdownload.jpg',4,'Public');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `PostId` int(11) NOT NULL,
  `Publisher` varchar(320) NOT NULL,
  PRIMARY KEY (`PostId`,`Publisher`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (1,'roi@gmail.com'),(4,'yonatan@gmail.com');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ThePost` varchar(1000) NOT NULL,
  `Publisher` varchar(320) NOT NULL,
  `Privacy` varchar(10) NOT NULL,
  `Likes` int(11) DEFAULT '0',
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Messi is legendary\n\n* Feeling- excited *','yonatan@gmail.com','Public',1,'2017-07-29 11:11:47'),(2,'Messi is better than Ronaldo for sure!!!!\n\n* Feeling- happy *','roi@gmail.com','Public',0,'2017-07-29 11:13:47'),(3,'I am the best player in the world haha\n\n* Celebrating- victory *','ronaldo@gmail.com','Public',0,'2017-07-29 11:15:35'),(4,'Sometimes when I have time during a game I do laundry.\n\n* Celebrating- success *','messi@gmail.com','Public',1,'2017-07-29 11:17:33');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `FirstName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(320) NOT NULL,
  `Password` varchar(512) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `ProfilePic` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('Ronaldo','Cristiano ','1985-02-05','ronaldo@gmail.com','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','Male','server/users/ronaldo@gmail.com/download.jpg'),('Bot','Bot ','2000-01-01','bot@gmail.com','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','Male',''),('Messi','Lionel','1987-06-24','messi@gmail.com','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','Male','server/users/messi@gmail.com/download.jpg'),('Yonatan','Ittah','1991-06-16','yonatan@gmail.com','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','Male',''),('Roi','Shukrun','1995-04-12','roi@gmail.com','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','Male','server/users/roi@gmail.com/roi.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'afekabookdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-29 14:19:44
