CREATE DATABASE  IF NOT EXISTS `transient` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `transient`;
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
-- Table structure for table `trans_unit`
--

DROP TABLE IF EXISTS `trans_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_unit` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_pic` varchar(45) NOT NULL DEFAULT 'null',
  `unit_desccription` varchar(700) NOT NULL,
  `unit_capacity` varchar(45) NOT NULL,
  `unit_address` varchar(45) NOT NULL,
  `unit_type` varchar(45) NOT NULL,
  `price_per_night` varchar(45) NOT NULL,
  `vacancy` varchar(45) NOT NULL DEFAULT 'vacant',
  `status` varchar(45) NOT NULL DEFAULT 'Waiting for approvement from admin',
  `occupied_client` int(11) DEFAULT NULL,
  `prov_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `provider_idx` (`prov_id`),
  KEY `occupant_idx` (`occupied_client`),
  KEY `checker_idx` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_unit`
--

LOCK TABLES `trans_unit` WRITE;
/*!40000 ALTER TABLE `trans_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_unit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-09  1:08:54
