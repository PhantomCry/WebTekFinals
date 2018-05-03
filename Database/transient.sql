-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
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
  `admin_firstname` varchar(45) NOT NULL,
  `admin_lastname` varchar(45) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `admin_email` varchar(45) NOT NULL,
  `admin_contact` varchar(45) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
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
  `client_username` varchar(25) NOT NULL,
  `client_password` varchar(45) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_info`
--

DROP TABLE IF EXISTS `client_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_info` (
  `client_id` int(11) NOT NULL,
  `client_firstname` varchar(45) NOT NULL,
  `client_lastname` varchar(45) NOT NULL,
  `client_email` varchar(45) NOT NULL,
  `client_contactno` int(11) NOT NULL,
  PRIMARY KEY (`client_id`),
  CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_info`
--

LOCK TABLES `client_info` WRITE;
/*!40000 ALTER TABLE `client_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dorm_provider`
--

DROP TABLE IF EXISTS `dorm_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dorm_provider` (
  `dormprov_id` int(11) NOT NULL AUTO_INCREMENT,
  `dormprov_username` varchar(25) NOT NULL,
  `dormprov_password` varchar(45) NOT NULL,
  PRIMARY KEY (`dormprov_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dorm_provider`
--

LOCK TABLES `dorm_provider` WRITE;
/*!40000 ALTER TABLE `dorm_provider` DISABLE KEYS */;
/*!40000 ALTER TABLE `dorm_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupancy`
--

DROP TABLE IF EXISTS `occupancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupancy` (
  `occupancy_id` int(11) NOT NULL AUTO_INCREMENT,
  `check_in` varchar(45) NOT NULL,
  `check_out` varchar(45) NOT NULL,
  `room_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `occupancy_no` int(11) NOT NULL,
  PRIMARY KEY (`occupancy_id`),
  KEY `occupant_idx` (`client_id`),
  KEY `occupies_idx` (`room_id`),
  CONSTRAINT `occupant` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `occupies` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupancy`
--

LOCK TABLES `occupancy` WRITE;
/*!40000 ALTER TABLE `occupancy` DISABLE KEYS */;
/*!40000 ALTER TABLE `occupancy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provider_info`
--

DROP TABLE IF EXISTS `provider_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provider_info` (
  `dormprov_id` int(11) NOT NULL AUTO_INCREMENT,
  `rep_firstname` varchar(45) NOT NULL,
  `rep_lastname` varchar(45) NOT NULL,
  `representative_contact` varchar(45) NOT NULL,
  `representative_email` varchar(45) NOT NULL,
  PRIMARY KEY (`dormprov_id`),
  CONSTRAINT `dormprov_id` FOREIGN KEY (`dormprov_id`) REFERENCES `dorm_provider` (`dormprov_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider_info`
--

LOCK TABLES `provider_info` WRITE;
/*!40000 ALTER TABLE `provider_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `provider_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserved`
--

DROP TABLE IF EXISTS `reserved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserved` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_date` varchar(45) NOT NULL,
  `reservation_end` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `client_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `room_id_idx` (`room_id`),
  KEY `client_id_idx` (`client_id`),
  CONSTRAINT `clientsroom` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reserving` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserved`
--

LOCK TABLES `reserved` WRITE;
/*!40000 ALTER TABLE `reserved` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserved` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(360) NOT NULL,
  `capacity` int(11) NOT NULL,
  `address` varchar(160) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `dormprov_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `provider_idx` (`dormprov_id`),
  KEY `admin_id_idx` (`admin_id`),
  CONSTRAINT `checker` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `provider` FOREIGN KEY (`dormprov_id`) REFERENCES `dorm_provider` (`dormprov_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-03 10:26:51
