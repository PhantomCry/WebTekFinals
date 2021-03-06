CREATE DATABASE  IF NOT EXISTS `transient` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `transient`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: transient
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(45) NOT NULL,
  `admin_pswd` varchar(45) NOT NULL,
  `admin_fname` varchar(45) NOT NULL,
  `admin_lname` varchar(45) NOT NULL,
  `admin_phoneno` varchar(45) NOT NULL,
  `admin_email` varchar(45) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_username_UNIQUE` (`admin_username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'SuperAdmin','222555','Ange','Donguiz','09052460039','angege@gmail.com'),(2,'AdminBeta','12345','Sam','Tan','09772400510','sammeh@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_username` varchar(45) NOT NULL,
  `client_pswd` varchar(45) NOT NULL,
  `client_pic` varchar(45) DEFAULT NULL,
  `client_fname` varchar(45) NOT NULL,
  `client_lname` varchar(45) NOT NULL,
  `client_email` varchar(45) NOT NULL,
  `client_phoneno` varchar(45) NOT NULL,
  `client_status` varchar(45) NOT NULL DEFAULT 'Under Review',
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_username_UNIQUE` (`client_username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Ipsum','lorem',NULL,'Nicole','Sanchez','nickieSan@gmail.com','09269080380','Active'),(2,'Azeroth','alliance',NULL,'Leeroy','Jenkins','LEEROY@yahoo.com','09845621546','Active'),(3,'Rhys','selesnya',NULL,'Trostani','Wolfblood','trostaniW@gmail.com','09495080501','Banned'),(4,'Forebear','dryad',NULL,'Teferi','karn','TeferiK@gmail.com','09533354621','Active');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(45) NOT NULL,
  `date_sent` varchar(45) NOT NULL,
  `time_sent` varchar(45) NOT NULL,
  `reciever` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  PRIMARY KEY (`notif_id`),
  KEY `clientreceiver_idx` (`reciever`),
  KEY `sender_idx` (`sender`),
  CONSTRAINT `clientreceiver` FOREIGN KEY (`reciever`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `provreceiver` FOREIGN KEY (`reciever`) REFERENCES `provider` (`prov_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sender` FOREIGN KEY (`sender`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provider` (
  `prov_id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_pic` varchar(45) NOT NULL DEFAULT 'null',
  `prov_username` varchar(45) NOT NULL,
  `prov_pswd` varchar(45) NOT NULL,
  `business_name` varchar(45) NOT NULL,
  `rep_fname` varchar(45) NOT NULL,
  `rep_lname` varchar(45) NOT NULL,
  `rep_phoneno` varchar(45) NOT NULL,
  `rep_email` varchar(45) NOT NULL,
  `rep_status` varchar(45) NOT NULL DEFAULT 'under review',
  PRIMARY KEY (`prov_id`),
  UNIQUE KEY `prov_username_UNIQUE` (`prov_username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider`
--

LOCK TABLES `provider` WRITE;
/*!40000 ALTER TABLE `provider` DISABLE KEYS */;
INSERT INTO `provider` VALUES (1,'null','Black','lotus','Wizards Transient','Nissa','Revane','09225030580','nissaR@yahoo.com','Active'),(2,'null','Zentikar','elrazi','Ally Houses','Gideon','Jura','09246412132','Gideon_','Active'),(3,'null','MasterPiece','swordsff','Kaladesh Artifacts','Sahilee','Ray','09752353412','SahileeRy@yahoo.com','Banned'),(4,'null','Protos','Aiur','Zelnaga ','Artanis','Executores','09265642321','ArtanisExe@yahoo.com','Active');
/*!40000 ALTER TABLE `provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_date` varchar(45) NOT NULL,
  `checkout_date` varchar(45) NOT NULL,
  `no_of_tenents` varchar(45) NOT NULL,
  `res_status` varchar(45) NOT NULL DEFAULT 'Under Review',
  `client_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  PRIMARY KEY (`res_id`),
  KEY `unit_idx` (`trans_id`),
  KEY `client_idx` (`client_id`),
  CONSTRAINT `client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unit` FOREIGN KEY (`trans_id`) REFERENCES `units` (`trans_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (11,'05-08-18','05-12-18','5','Under Review',1,1),(12,'05-09-18','05-13-18','4','Under Review',2,1),(13,'05-09-18','05-14-18','4','Under Review',3,1),(14,'05-18-18','05-25-18','3','Under Review',4,1),(15,'05-13-18','05-18-18','4','Under Review',1,2),(16,'05-13-18','05-19-18','4','Under Review',2,2);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_pics`
--

DROP TABLE IF EXISTS `unit_pics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_pics` (
  `upic_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` int(11) NOT NULL,
  `picture` varchar(75) NOT NULL,
  PRIMARY KEY (`upic_id`),
  KEY `picture_of_idx` (`trans_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_pics`
--

LOCK TABLES `unit_pics` WRITE;
/*!40000 ALTER TABLE `unit_pics` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_pics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_id` int(11) NOT NULL,
  `condo_name` varchar(75) NOT NULL,
  `unit_description` varchar(1500) NOT NULL,
  `unit_capacity` int(11) NOT NULL,
  `unit_address` varchar(300) NOT NULL,
  `no_of_beds` int(11) NOT NULL,
  `price_per_night` decimal(10,0) NOT NULL,
  `vacancy` varchar(45) NOT NULL DEFAULT 'vacant',
  `post_status` varchar(45) NOT NULL DEFAULT 'under review',
  PRIMARY KEY (`trans_id`),
  KEY `prov_id_idx` (`prov_id`),
  CONSTRAINT `prov_id` FOREIGN KEY (`prov_id`) REFERENCES `provider` (`prov_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,1,'Vega Residences','Open 24/7',5,'#34 Caguioa BAgio',4,2000,'vacant','under review'),(2,2,'North Cambridge','Asdad',3,'#43 Asdfa',3,1000,'vacant','under review');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-15  2:06:32
