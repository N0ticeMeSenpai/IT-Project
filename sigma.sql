-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: sigma
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `name_of_spouse` varchar(45) DEFAULT NULL,
  `present_address` varchar(100) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `requested_amount` int(11) DEFAULT '0',
  `registered_status` enum('Pending','Approved','Denied') NOT NULL DEFAULT 'Pending',
  `registered_date` date NOT NULL,
  `business_address` varchar(100) NOT NULL,
  `name_of_firm` varchar(60) NOT NULL,
  `employment` enum('Employed','Own Business') NOT NULL,
  `position` varchar(60) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (3,'Adam','Avila','Norte','Lowlyn Lode','Sn. Mamerto','09275816434',50000,'Approved','2019-05-29','Tagaytay','Bed Sheet INC.','Employed','Vice President'),(4,'Aeron','Abalos','Mark','Lorex Levi','Pangasinan','09265826434',5000,'Approved','2019-05-29','Ilocos Sur','Lumber company','Employed','CFO'),(5,'Oreinz','Maala','Kasilag','Nancy Mcdonie','Pangpanga','09271816264',50000,'Approved','2019-05-29','Magsaysay Ave.','Seven Eleven','Employed','Secretary'),(6,'Jasper','Tade','Tanglib','Crystelle Hannah','Manila','09275234434',25000,'Approved','2019-05-29','EDSA','Samsung','Own Business','Treasurer'),(7,'Nikki','Alimorong','Ganotan','Danice Daniel','La Union','09272346434',30000,'Approved','2019-05-29','Davao City','Galaxy','Own Business','Treasurer'),(8,'Jeffrey','Eclarino','Rimando','Deanne Tapec','La Union','09223434334',40000,'Approved','2019-05-29','Quezon City','Huawei','Own Business','CTO'),(9,'Leo','Cortez','Dion',NULL,'Epoc','09282346434',45000,'Approved','2019-05-29','Baguio City','Texas Instrument','Employed','Sales Manager'),(10,'Lenard','Tanglib','Llanillo',NULL,'Rosales','09262342334',55000,'Approved','2019-05-29','Baguio City','AWS','Employed','CEO'),(11,'Keyya','Capitulo','David','Eugene Rosales','Zamboanga','09231252334',60000,'Denied','2019-05-29','Baguio City','North Tech','Employed','Director'),(12,'Famela','Sapiano','Corazon','Fe Li Pe','Ilocos','09253471334',5000,'Approved','2019-05-30','Baguio City','Friend Tech','Employed','Chief'),(13,'Fernando','Patrocino','Magsaysay',NULL,'Cotabato','09272323324',50000,'Approved','2019-05-30','Baguio City','Facebook Co.','Employed','Employee'),(14,'Rachiel','Ann','Abalos','Bruce Wayne','Home','0926612352',8000,'Approved','2019-06-12','Ilocos Norte','Twitter','Employed','CEO');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_borrower`
--

DROP TABLE IF EXISTS `co_borrower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_borrower` (
  `co_borrower_id` int(11) NOT NULL AUTO_INCREMENT,
  `co_first_name` varchar(45) DEFAULT NULL,
  `co_middle_name` varchar(45) DEFAULT NULL,
  `co_last_name` varchar(45) DEFAULT NULL,
  `co_contact_no` varchar(45) DEFAULT NULL,
  `co_address` varchar(100) DEFAULT NULL,
  `co_business_address` varchar(100) DEFAULT NULL,
  `co_name_of_firm` varchar(60) DEFAULT NULL,
  `co_employment` enum('Employed','Own Business','') DEFAULT NULL,
  `co_position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`co_borrower_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_borrower`
--

LOCK TABLES `co_borrower` WRITE;
/*!40000 ALTER TABLE `co_borrower` DISABLE KEYS */;
INSERT INTO `co_borrower` VALUES (8,'Thomas','Thawne','Wayne','09272122612','Baguio City','Baguio City','Facebook','Employed','Secretary'),(9,'Patrick','Morgin','Marston','09272312515','La Union','La Union','Google','Employed','Treasurer'),(10,'John','Wayne','Marson','09272312512','San Fernando City','San Fernando City','YouTube','Employed','Admiral'),(11,'Jack','Morgan','Marson','09265123125','Manila','Manila','Google','Employed','Vice'),(12,'Jhaylord','Rian','Rosal','09263254234','Quezon City','Quezon City','Facebook','Own Business','CEO'),(13,'Jhester','Dion','Kasilag','09261233453','Baguio City','Baguio City','Wix','Own Business','CEO'),(14,'Rose','Rimando','Tanglib','09271231252','Ilocos Sur','Ilocos Sur','Twitter','Own Business','Chief'),(15,'Jeffrey','Cortez','Ganotan','09262134353','Ilocos Norte','Ilocos Norte','Instagram','Own Business','Lord'),(16,'Mia','Torreto','Ramirez','09263423423','Cabanatuan','Cabanatuan','Google','Employed','Treasurer'),(17,'Dominique','Lopez','Fernandez','09277234234','Baguio City','Baguio City','TwistResources','Own Business','Employee'),(18,'Jasper','Tanglib','Cortez','09271231252','Davao City','Davao City','Texas Instruments','Employed','Employee'),(19,'Timothy','Cortez','Kasilag','09266123523','Baguio City','Baguio City','Sitel','Own Business','Employee'),(20,'Romeo','Liver','Kasilag','09231253424','Rosales','Rosales','New Media Services','Own Business','Employee'),(21,'Johnny','Test','Sins','09234236523','Rosales','Rosales','New Media Services','Own Business','Employee'),(22,'Anakin','Kenobi','Skywalker','09273242342','Urdaneta','Urdaneta','Microsoft','Employed','CEO'),(23,'Luke','Amidala','Skywalker','09453463454','La Union','La Union','Nokia','Employed','Treasurer'),(24,'Rey','Ren','Skywalker','09462342344','San Fernando City','San Fernando City','Trend Micro','Employed','Employee'),(25,'Obi','Wan','Kenobi','09234236523','Baguio City','Baguio City','Google','Own Business','Employee'),(26,'Qui','Gon','Jinn','09234235234','Baguio City','Baguio City','Sitel','Employed','CEO'),(27,'Dominic','Torretto','Torretto','09234236234','San Fernando','San Fernando','Texas Instruments','Employed','CEO'),(28,'Brian','Paul','Walker','09234236234','La Union','La Union','Texas Instruments','Employed','Employee'),(37,'Hal','Lantern','Jordan','09234236234','Davao City','Davao City','New Media Services','Employed','Chief'),(38,'Clark','Super','Kent','09234236232','Baguio City','Baguio City','New Media Services','Employed','CEO'),(39,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'');
/*!40000 ALTER TABLE `co_borrower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_loan`
--

DROP TABLE IF EXISTS `co_loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_loan` (
  `co_loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `co_borrower_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  PRIMARY KEY (`co_loan_id`),
  KEY `fk_coborrowerid_coloan_idx` (`co_borrower_id`),
  KEY `fk_loanid_coloan_idx` (`loan_id`),
  CONSTRAINT `fk_coborrowerid_coloan` FOREIGN KEY (`co_borrower_id`) REFERENCES `co_borrower` (`co_borrower_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_loanid_coloan` FOREIGN KEY (`loan_id`) REFERENCES `loan` (`loan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_loan`
--

LOCK TABLES `co_loan` WRITE;
/*!40000 ALTER TABLE `co_loan` DISABLE KEYS */;
INSERT INTO `co_loan` VALUES (2,8,3),(3,9,3),(4,10,4),(5,11,4),(6,12,5),(7,13,5),(8,14,6),(9,15,6),(12,18,8),(13,19,8),(14,20,9),(15,21,9),(16,22,10),(17,23,10),(21,27,19),(22,28,19);
/*!40000 ALTER TABLE `co_loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `em_position` enum('Operations Manager','Office Staff') NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'opmanager','opmanager','Operations Manager'),(2,'ofstaff','ofstaff','Office Staff');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_balance` int(11) DEFAULT '0',
  `date_booked` date NOT NULL,
  `maturity_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `bi_monthly` int(11) DEFAULT '0',
  `interest_rate` int(11) DEFAULT '0',
  `loan_class` varchar(45) NOT NULL,
  `original_amount` decimal(65,2) DEFAULT '0.00',
  `insurance` int(11) DEFAULT '0',
  `delinquent_status` enum('Active','Inactive','Legal') DEFAULT 'Active',
  `loan_type` enum('Salary','Business') NOT NULL,
  `loan_remarks` varchar(120) DEFAULT NULL,
  `loan_status` enum('Normal','Restructured','Remove') DEFAULT 'Normal',
  PRIMARY KEY (`loan_id`),
  KEY `fk_clientid_loan_idx` (`client_id`),
  CONSTRAINT `fk_clientid_loan` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` VALUES (3,52750,'2019-05-29','2019-07-30',3,52750,5,'Add',50000.00,3,'Active','Salary',NULL,'Normal'),(4,55250,'2019-05-29','2019-07-06',4,18417,5,'Add',50000.00,130,'Active','Salary','paid in cheque','Normal'),(5,56500,'2019-06-04','2019-07-04',5,14125,5,'Add',50000.00,130,'Active','Salary','','Normal'),(6,25000,'2019-05-29','2019-06-28',6,8334,5,'Deducted',25000.00,310,'Active','Business','','Normal'),(8,14365,'2019-05-29','2019-05-31',8,4789,5,'Add',13000.00,130,'Active','Business','','Normal'),(9,137150,'2019-05-29','2019-05-29',6,137150,5,'Add',130000.00,130,'Legal','Salary','','Normal'),(10,25415,'2019-05-29','2019-05-25',9,8472,5,'Add',23000.00,130,'Inactive','Salary','','Normal'),(14,140400,'2019-05-30','2019-03-07',12,70200,5,'Add',130000.00,130,'Active','Salary','','Normal'),(15,117223,'2019-05-30','2019-05-17',12,117223,5,'Add',111111.00,3,'Active','Salary',NULL,'Normal'),(16,13715,'2019-05-30','2019-05-23',12,13715,5,'Add',13000.00,130,'Active','Salary',NULL,'Normal'),(17,12660,'2019-05-30','2019-05-17',12,12660,5,'Add',12000.00,130,'Legal','Salary','','Normal'),(19,14040,'2019-05-30','2019-04-18',10,7020,5,'Add',13000.00,130,'Inactive','Salary',NULL,'Normal'),(20,84750,'2019-06-04','2019-06-04',5,21188,5,'Add',75000.00,0,'Legal','Salary',NULL,'Normal'),(22,13715,'2019-06-03','2019-06-03',9,13715,5,'Add',13000.00,0,'Active','Salary',NULL,'Normal'),(24,10000,'2019-06-12','2019-08-26',14,1667,5,'Deducted',10000.00,130,'Active','Salary',NULL,'Normal'),(26,10000,'2019-06-12','2019-09-04',14,1667,5,'Deducted',10000.00,130,'Active','Salary',NULL,'Normal'),(30,10000,'2019-06-12','2019-08-28',14,1667,5,'Deducted',10000.00,130,'Active','Salary',NULL,'Remove'),(31,7859,'2019-06-12','2019-09-03',14,1310,5,'Deducted',6834.00,1300,'Active','Salary',NULL,'Restructured'),(32,8000,'2019-06-13','2019-09-08',14,1334,5,'Deducted',8000.00,130,'Active','Salary',NULL,'Normal');
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `due_date` date DEFAULT NULL,
  `remaining_balance` decimal(65,2) DEFAULT '0.00',
  `loan_id` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_loanid_pyment_idx` (`loan_id`),
  CONSTRAINT `fk_loanid_pyment` FOREIGN KEY (`loan_id`) REFERENCES `loan` (`loan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (4,'2019-05-31',0.00,3,'2019-05-29'),(5,'2019-05-29',56171.00,4,'2019-05-29'),(6,'2019-06-13',0.00,4,'2019-05-29'),(7,'2019-06-28',0.00,4,'2019-05-29'),(8,'2019-05-29',57207.00,5,'2019-05-29'),(9,'2019-06-13',0.00,5,'2019-05-29'),(10,'2019-06-28',0.00,5,'2019-05-29'),(11,'2019-07-13',0.00,5,'2019-05-29'),(12,'2019-05-29',25417.00,6,'2019-05-29'),(13,'2019-06-13',0.00,6,'2019-05-29'),(14,'2019-06-28',0.00,6,'2019-05-29'),(17,'2019-05-01',14605.00,8,'2019-05-29'),(18,'2019-05-16',14845.00,8,'2019-05-29'),(19,'2019-05-31',15085.00,8,'2019-05-29'),(20,'2019-05-29',144008.00,9,'2019-05-29'),(21,'2019-04-25',24263.00,10,'2019-05-29'),(22,'2019-05-10',24687.00,10,'2019-05-29'),(23,'2019-05-25',25111.00,10,'2019-05-29'),(33,'2019-05-23',-59670.00,14,'2019-05-30'),(34,'2019-06-07',0.00,14,'2019-05-30'),(35,'2019-05-17',123085.00,15,'2019-05-30'),(36,'2019-05-23',14401.00,16,'2019-05-30'),(37,'2019-05-17',13293.00,17,'2019-05-30'),(41,'2019-04-03',14391.00,19,'2019-05-30'),(42,'2019-04-18',14691.00,19,'2019-05-30'),(43,'2019-05-18',16376.00,19,'2019-05-30'),(46,'2019-06-03',85810.00,20,'2019-06-03'),(47,'2019-06-18',0.00,20,'2019-06-03'),(48,'2019-07-03',0.00,20,'2019-06-03'),(49,'2019-07-18',0.00,20,'2019-06-03'),(52,'2019-06-03',14401.00,22,'2019-06-03'),(59,'2019-06-12',8333.00,24,'2019-06-12'),(60,'2019-06-27',6666.00,24,'2019-06-12'),(61,'2019-07-12',4999.00,24,'2019-06-12'),(62,'2019-07-27',3332.00,24,'2019-06-12'),(63,'2019-08-11',1665.00,24,'2019-06-12'),(64,'2019-08-26',-2.00,24,'2019-06-12'),(83,'2019-06-21',8333.00,26,'2019-06-12'),(84,'2019-07-06',6666.00,26,'2019-06-12'),(85,'2019-07-21',4999.00,26,'2019-06-12'),(86,'2019-08-05',3332.00,26,'2019-06-12'),(87,'2019-08-20',1665.00,26,'2019-06-12'),(88,'2019-09-04',-2.00,26,'2019-06-12'),(102,'2019-06-14',8333.00,30,'2019-06-12'),(103,'2019-06-29',6666.00,30,'2019-06-12'),(104,'2019-07-14',6750.00,30,'2019-06-12'),(105,'2019-07-29',6834.00,30,'2019-06-12'),(106,'2019-08-13',0.00,30,'2019-06-12'),(107,'2019-08-28',0.00,30,'2019-06-12'),(108,'2019-06-20',7925.00,31,'2019-06-12'),(109,'2019-07-05',7991.00,31,'2019-06-12'),(110,'2019-07-20',8057.00,31,'2019-06-12'),(111,'2019-08-04',8123.00,31,'2019-06-12'),(112,'2019-08-19',8189.00,31,'2019-06-12'),(113,'2019-06-25',6666.00,32,'2019-06-13'),(114,'2019-07-10',5332.00,32,'2019-06-13'),(115,'2019-07-25',3998.00,32,'2019-06-13'),(116,'2019-08-09',2664.00,32,'2019-06-13'),(117,'2019-08-24',1330.00,32,'2019-06-13'),(118,'2019-09-08',-4.00,32,'2019-06-13');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_info`
--

DROP TABLE IF EXISTS `payment_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_info` (
  `payment_id` int(11) NOT NULL,
  `amount_paid` decimal(65,2) DEFAULT '0.00',
  `payment_type` enum('Cash','Cheque','Bank Deposit','') DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `account_number` varchar(45) DEFAULT NULL,
  `check_no` varchar(45) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `interest` decimal(65,2) DEFAULT '0.00',
  `fines` decimal(65,2) DEFAULT '0.00',
  `remarks` varchar(45) DEFAULT NULL,
  `status` enum('Updated','Excused','Bounced') DEFAULT 'Updated',
  `other_income` decimal(65,2) DEFAULT '0.00',
  `payment_info_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`payment_info_id`),
  KEY `fk_payment_id_pymentinfo_idx` (`payment_id`),
  CONSTRAINT `fk_payment_id_pymentinfo` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_info`
--

LOCK TABLES `payment_info` WRITE;
/*!40000 ALTER TABLE `payment_info` DISABLE KEYS */;
INSERT INTO `payment_info` VALUES (4,52750.00,'Cash','2018-01-01','','','',0.00,0.00,'','Updated',0.00,1),(17,0.00,NULL,NULL,NULL,NULL,NULL,0.00,240.00,'lateBySystem','Updated',0.00,4),(21,0.00,NULL,NULL,NULL,NULL,NULL,0.00,424.00,'lateBySystem','Updated',0.00,5),(18,0.00,NULL,NULL,NULL,NULL,NULL,0.00,240.00,'lateBySystem','Updated',0.00,6),(22,0.00,NULL,NULL,NULL,NULL,NULL,0.00,424.00,'lateBySystem','Updated',0.00,7),(23,0.00,NULL,NULL,NULL,NULL,NULL,0.00,424.00,'lateBySystem','Updated',0.00,15),(21,2000.00,'Cheque','2018-01-01','095898','4555','989898',0.00,424.00,'Payment was Lacking(Penalty)','Updated',0.00,16),(5,0.00,NULL,NULL,NULL,NULL,NULL,0.00,921.00,'lateBySystem','Updated',0.00,21),(8,0.00,NULL,NULL,NULL,NULL,NULL,0.00,707.00,'lateBySystem','Updated',0.00,22),(12,0.00,NULL,NULL,NULL,NULL,NULL,0.00,417.00,'lateBySystem','Updated',0.00,23),(20,0.00,NULL,NULL,NULL,NULL,NULL,0.00,6858.00,'lateBySystem','Updated',0.00,24),(33,0.00,NULL,NULL,NULL,NULL,NULL,0.00,3510.00,'lateBySystem','Updated',0.00,25),(35,0.00,NULL,NULL,NULL,NULL,NULL,0.00,5862.00,'lateBySystem','Updated',0.00,26),(36,0.00,NULL,NULL,NULL,NULL,NULL,0.00,686.00,'lateBySystem','Updated',0.00,27),(37,0.00,NULL,'2019-03-30',NULL,NULL,NULL,0.00,633.00,'lateBySystem','Updated',0.00,28),(41,0.00,NULL,'2019-03-30',NULL,NULL,NULL,0.00,351.00,'lateBySystem','Updated',0.00,31),(43,0.00,NULL,'2019-03-30',NULL,NULL,NULL,0.00,982.80,'Penalty after maturity date(System)','Updated',0.00,32),(43,0.00,NULL,'2019-03-30',NULL,NULL,NULL,702.00,0.00,'Interest after maturity date','Updated',0.00,33),(42,0.00,'Cheque','2019-03-30','','','',0.00,300.00,'lateBySystem','Updated',0.00,34),(33,70200.00,'Cheque','2019-03-30','9829891','78128721873612','36563632',0.00,3510.00,'Payment was Lacking(Penalty)','Updated',0.00,35),(19,0.00,NULL,'2019-03-01',NULL,NULL,NULL,0.00,240.00,'lateBySystem','Updated',0.00,38),(33,70200.00,'Cash','2019-03-01','123','#216','9808009',0.00,3510.00,'Payment was Lacking(Penalty)','Updated',0.00,39),(46,0.00,NULL,'2019-06-04',NULL,NULL,NULL,0.00,1060.00,'lateBySystem','Updated',0.00,41),(52,0.00,NULL,'2019-06-04',NULL,NULL,NULL,0.00,686.00,'lateBySystem','Updated',0.00,42),(33,70200.00,'Cash','2019-06-04','095898','4555','989898',0.00,0.00,'paid in cash','Updated',0.00,43),(59,1667.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,50),(60,1667.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,51),(61,0.00,NULL,'2019-08-24',NULL,NULL,NULL,0.00,84.00,'lateBySystem','Updated',0.00,52),(62,0.00,NULL,'2019-08-24',NULL,NULL,NULL,0.00,84.00,'lateBySystem','Updated',0.00,53),(63,0.00,NULL,'2019-08-24',NULL,NULL,NULL,0.00,84.00,'lateBySystem','Updated',0.00,74),(61,1751.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,75),(62,1751.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,76),(63,1751.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,77),(64,1667.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,78),(83,7.00,'Cash','2019-06-12','','','',0.00,84.00,'Payment was Lacking(Penalty)','Updated',0.00,93),(83,660.00,'Cash','2019-06-12','','','',0.00,84.00,'Payment was Lacking(Penalty)','Updated',0.00,94),(83,1168.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,95),(84,667.00,'Cash','2019-06-12','','','12345',0.00,84.00,'Payment was Lacking(Penalty)','Updated',0.00,119),(84,1084.00,'Cash','2019-06-12','','','12566',0.00,0.00,'','Updated',0.00,120),(85,1667.00,'Cash','2019-06-12','','','16007',0.00,0.00,'','Updated',0.00,121),(86,667.00,'Cash','2019-06-12','','','16032',0.00,84.00,'Payment was Lacking(Penalty)','Updated',0.00,122),(86,1084.00,'Cash','2019-06-12','','','16050',0.00,0.00,'','Updated',0.00,124),(87,1667.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,125),(88,1667.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,126),(102,1667.00,'Cash','2019-06-12','','3721058','16157',0.00,0.00,'','Updated',0.00,127),(103,1667.00,'Cash','2019-06-12','','3721059','16184',0.00,0.00,'','Updated',0.00,130),(104,1667.00,'Cash','2019-06-12','','11111','',0.00,0.00,'Bouncing Check','Bounced',0.00,133),(104,0.00,NULL,NULL,NULL,NULL,NULL,0.00,84.00,'RC','Updated',0.00,134),(105,1667.00,'Cash','2019-06-12','','123213','',0.00,84.00,'Bouncing Check','Bounced',0.00,135),(105,0.00,NULL,NULL,NULL,NULL,NULL,0.00,84.00,'RC','Updated',0.00,136),(108,0.00,NULL,'2019-12-31',NULL,NULL,NULL,0.00,66.00,'lateBySystem','Updated',0.00,143),(109,0.00,NULL,'2019-12-31',NULL,NULL,NULL,0.00,66.00,'lateBySystem','Updated',0.00,148),(110,0.00,NULL,'2019-12-31',NULL,NULL,NULL,0.00,66.00,'lateBySystem','Updated',0.00,153),(111,0.00,NULL,'2019-12-31',NULL,NULL,NULL,0.00,66.00,'lateBySystem','Updated',0.00,156),(112,0.00,NULL,'2019-12-31',NULL,NULL,NULL,0.00,66.00,'lateBySystem','Updated',0.00,157),(113,1334.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,158),(114,1334.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,159),(115,1334.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,160),(116,1334.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,161),(117,1334.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,162),(118,1334.00,'Cash','2019-06-12','','','',0.00,0.00,'','Updated',0.00,163);
/*!40000 ALTER TABLE `payment_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rates` (
  `rate_id` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `service_handling_fee` int(11) NOT NULL,
  `penalty_not_maturity` int(11) NOT NULL,
  `maturity_interest` int(11) NOT NULL,
  `maturity_penalty` int(11) NOT NULL,
  `penalty_lack` int(11) NOT NULL,
  `penalty_bouncing_check` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rates`
--

LOCK TABLES `rates` WRITE;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` VALUES (1,5,3,5,5,2,5,5);
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-23 13:18:05
