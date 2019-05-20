CREATE DATABASE  IF NOT EXISTS `sigma` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sigma`;
-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: sigma
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
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
 SET character_set_client = utf8mb4 ;
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
  `date_modified` date NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (2,'Jon','Dela Cruz','Cort','Denmark','Bakakeng','0989898888',100000,'Approved','2019-04-29','baguio','tagaytay express','Employed','cargador','2019-04-29'),(3,'Jon','apilada','Aquino','Jenny','Bakakeng','09123456789',5000000,'Approved','2019-04-29','baguio','tagaytay express','Own Business','cargador','2019-04-29'),(4,'Oreinz','Mama','Kasilag','Jen','Bakakeng','09123456789',5000000,'Approved','2019-04-29','baguio','tagaytay express','Own Business','cargador','2019-04-29'),(5,'Jeffrey','Lol','Rimando','Jen','Bakakeng','09123456789',5000000,'Approved','2019-04-29','baguio','tagaytay express','Own Business','cargador','2019-04-29'),(6,'Luke','Dota','Llanillo','Jenhy','Bakakeng','09123456789',5000000,'Approved','2019-04-29','baguio','tagaytay express','Own Business','cargador','2019-04-29'),(7,'Nikki','Malong','Ganotan','Yolo','Bakakeng','09123456789',5000000,'Approved','2019-04-29','baguio','tagaytay express','Own Business','cargador','2019-04-29'),(8,'Jasper','Tade','Tanglib','May','Bakakeng','09123456789',5000000,'Approved','2019-04-29','baguio','tagaytay express','Own Business','cargador','2019-04-29'),(9,'Leo','Jhester','Dion','April','Bakakeng','09123456789',5000000,'Approved','2019-04-29','baguio','tagaytay express','Own Business','cargador','2019-04-29'),(10,'Tim','apilada','Dion','Jenny','Baguio','09123456789',900000,'Approved','2019-04-29','baguio','tagaytay express','Employed','cargador','2019-04-29'),(11,'timothy','apilada','Dion','Denmark','Bakakeng','0909909090',899990000,'Approved','2019-04-29','Tubero','tagaytay express','Employed','cargador','2019-04-29'),(12,'zzzzzzzzzz','z','z','t','t','0',20000,'Approved','2019-04-29','t','t','Employed','t','2019-04-29'),(13,'celes','te','nar','asap','jolly town','09275816333',5000000,'Pending','2019-04-29','waitress','jollibee','Employed','staff','0000-00-00');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_borrower`
--

DROP TABLE IF EXISTS `co_borrower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `co_borrower` (
  `co_borrower_id` int(11) NOT NULL AUTO_INCREMENT,
  `co_first_name` varchar(45) NOT NULL,
  `co_middle_name` varchar(45) NOT NULL,
  `co_last_name` varchar(45) NOT NULL,
  `co_contact_no` varchar(45) NOT NULL,
  `co_address` varchar(100) NOT NULL,
  `related_client` varchar(45) NOT NULL,
  `co_business_address` varchar(100) NOT NULL,
  `co_name_of_firm` varchar(60) NOT NULL,
  `co_employment` enum('Employed','Own Business') NOT NULL,
  `co_position` varchar(45) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`co_borrower_id`),
  KEY `fk_clientid_coborrower_idx` (`client_id`),
  CONSTRAINT `fk_clientid_coborrower` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_borrower`
--

LOCK TABLES `co_borrower` WRITE;
/*!40000 ALTER TABLE `co_borrower` DISABLE KEYS */;
INSERT INTO `co_borrower` VALUES (3,'oreinz','tange','silver','09009089089','abc street','aunty','bauiog','balot deliver co.','Employed','boss',2),(4,'leo','ganotan','dion','098989898','technical','friend','baguio','panagasinan','Employed','ceo',2),(5,'jasper','tange','silver','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',3),(6,'leo','ganotan','dion','098989898','technical','aunty','baguio','panagasinan','Employed','Trainer',3),(7,'january','tange','silver','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',4),(8,'february','q','gold','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',4),(9,'february','march','copper','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',5),(10,'march','april','silver','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',5),(11,'april','may','gold','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',6),(12,'may','june','silver','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',6),(13,'july','august','silver','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',7),(14,'august','september','copper','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',7),(15,'september','november','diamond','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',8),(16,'november','december','bronze','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',8),(17,'november','december','platinum','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',9),(18,'december','january','master','098209299','abc street','auntie','bauiog','balot deliver co.','Employed','boss',9),(19,'oreinz','tange','dion','09009089089','abc street','employee','qwewqeqwew','balot deliver co.','Employed','ceo',10),(20,'leo','ganotan','dion','09090909','technical','uncle','baguio','panagasinan','Employed','benguet',10),(21,'jasper','tange','silver','09009089089','abc street','employee','bauiog','balot deliver co.','Own Business','boss',11),(22,'jefferey','ganotan','dion','098989898','technical','friend','baguio','panagasinan','Own Business','Trainer',11),(23,'z','z','z','0','z','z','z','z','Own Business','z',12),(24,'z','z','z','1','z','z','z','z','Employed','z',12),(25,'boss','joey','dizon','092999929','emerald','friend','lower session','market','Employed','manager',13),(26,'diokno','kyree','nikki','09098099080','nikki','employee','upper session','sigma co.','Own Business','ceo',13);
/*!40000 ALTER TABLE `co_borrower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `em_first_name` varchar(45) NOT NULL,
  `em_last_name` varchar(45) NOT NULL,
  `em_position` enum('Operations Manager','Office Staff') NOT NULL,
  `contact_no` varchar(55) NOT NULL,
  `address` varchar(100) NOT NULL,
  `employee_img` longblob NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'opmanager','opmanager','Operations','Manager','Operations Manager','0912312512','Operations Manager house',''),(2,'ofstaff','ofstaff','','','Office Staff','','','');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
  PRIMARY KEY (`loan_id`),
  KEY `fk_clientid_loan_idx` (`client_id`),
  CONSTRAINT `fk_clientid_loan` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` VALUES (2,52690,'2019-04-29','2019-05-10',3,52690,5,'Add',50000.00,60,'Active','Salary'),(3,57865,'2019-04-29','2019-05-11',4,57865,5,'Add',55000.00,160,'Active','Business'),(4,42200,'2019-04-29','2019-04-16',5,42200,5,'Add',40000.00,0,'Inactive','Salary'),(5,66180,'2019-04-29','2019-04-27',6,76493,5,'Add',60000.00,280,'Active','Business'),(6,84300,'2019-04-29','2019-05-02',7,84300,5,'Add',80000.00,100,'Active','Salary'),(7,663000,'2019-04-29','2019-04-16',8,221000,5,'Add',600000.00,0,'Inactive','Salary'),(8,6630000,'2019-04-29','2019-06-01',10,2210000,5,'Add',6000000.00,0,'Active','Business'),(9,55130,'2019-04-29','2019-05-29',9,18377,5,'Add',50000.00,120,'Active','Salary'),(10,1105000,'2019-04-29','2019-06-01',2,368333,5,'Add',1000000.00,0,'Active','Salary'),(11,53870,'2019-04-29','2019-06-01',11,29696,5,'Add',50000.00,130,'Active','Salary'),(12,52620,'2019-04-29','2019-03-28',12,52620,5,'Add',50000.00,130,'Inactive','Salary');
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `due_date` date DEFAULT NULL,
  `remaining_balance` decimal(65,2) DEFAULT '0.00',
  `loan_id` int(11) NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_loanid_pyment_idx` (`loan_id`),
  CONSTRAINT `fk_loanid_pyment` FOREIGN KEY (`loan_id`) REFERENCES `loan` (`loan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (2,'2019-05-10',0.00,2,'2019-04-29'),(3,'2019-05-11',60759.00,3,'2019-04-29'),(4,'2019-04-16',0.00,4,'2019-04-29'),(5,'2019-04-10',69339.00,5,'2019-04-29'),(6,'2019-05-02',0.00,6,'2019-04-29'),(7,'2019-03-16',0.00,7,'2019-04-29'),(8,'2019-04-01',0.00,7,'2019-04-29'),(9,'2019-04-16',0.00,7,'2019-04-29'),(10,'2019-05-01',0.00,8,'2019-04-29'),(11,'2019-05-16',0.00,8,'2019-04-29'),(12,'2019-06-01',0.00,8,'2019-04-29'),(13,'2019-04-29',0.00,9,'2019-04-29'),(14,'2019-05-14',0.00,9,'2019-04-29'),(15,'2019-05-29',0.00,9,'2019-04-29'),(16,'2019-05-01',748479.00,10,'2019-04-29'),(17,'2019-05-16',368334.00,10,'2019-04-29'),(18,'2019-06-01',0.00,10,'2019-04-29'),(19,'2019-03-14',55217.00,11,'2019-04-29'),(20,'2019-03-29',56564.00,11,'2019-04-29'),(21,'2019-03-28',55251.00,12,'2019-04-29'),(22,'2019-04-28',64091.16,12,'2019-04-29'),(26,'2019-04-30',0.00,5,'2019-04-29'),(27,'2019-05-16',59393.00,11,'2019-04-28'),(28,'2019-06-01',0.00,11,'2019-04-29'),(29,'2019-06-01',0.00,5,'2019-04-29'),(30,'2019-04-20',74627.00,5,'2019-04-28'),(31,'2019-04-27',80318.00,5,'2019-04-28');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_info`
--

DROP TABLE IF EXISTS `payment_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `payment_info` (
  `payment_id` int(11) NOT NULL,
  `amount_paid` decimal(65,2) DEFAULT '0.00',
  `payment_type` enum('Cash','Cheque','Bank Deposit') DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_info`
--

LOCK TABLES `payment_info` WRITE;
/*!40000 ALTER TABLE `payment_info` DISABLE KEYS */;
INSERT INTO `payment_info` VALUES (5,0.00,'Cheque',NULL,'','','',0.00,3159.00,'lateBySystem','Updated',0.00,1),(19,0.00,NULL,NULL,NULL,NULL,NULL,0.00,1347.00,'lateBySystem','Updated',0.00,2),(20,0.00,NULL,NULL,NULL,NULL,NULL,0.00,1347.00,'lateBySystem','Updated',0.00,3),(21,0.00,NULL,NULL,NULL,NULL,NULL,0.00,2631.00,'lateBySystem','Updated',0.00,4),(22,0.00,NULL,NULL,NULL,NULL,NULL,0.00,4972.59,'Penalty after maturity date(System)','Updated',0.00,5),(22,0.00,NULL,NULL,NULL,NULL,NULL,3867.57,0.00,'Interest after maturity date','Updated',0.00,6),(16,363888.00,'Cash','2019-04-30','','','',0.00,7367.00,'Payment was Lacking(Penalty)','Updated',0.00,15),(17,380145.00,'Cash','2019-05-16','','','',0.00,0.00,'','Updated',0.00,16),(27,0.00,NULL,NULL,NULL,NULL,NULL,2829.00,0.00,NULL,'Updated',0.00,17),(30,0.00,NULL,NULL,NULL,NULL,NULL,1734.00,0.00,NULL,'Updated',0.00,18),(30,0.00,NULL,NULL,NULL,NULL,NULL,0.00,3554.00,'lateBySystem','Updated',0.00,19),(31,0.00,NULL,NULL,NULL,NULL,NULL,1866.00,0.00,NULL,'Updated',0.00,20),(31,0.00,NULL,NULL,NULL,NULL,NULL,0.00,3825.00,'lateBySystem','Updated',0.00,21),(3,0.00,NULL,NULL,NULL,NULL,NULL,0.00,2894.00,'lateBySystem','Updated',0.00,22);
/*!40000 ALTER TABLE `payment_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
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
INSERT INTO `rates` VALUES (1,5,3,5,7,2,2,2);
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

-- Dump completed on 2019-05-20 19:56:53
