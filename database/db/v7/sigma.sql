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
  `date_modified` date NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (12,'Thy','ti','mo','Denmark','Baguio','0989898888',500000000,'Approved','2019-04-27','qweqwwqdqw','tagaytay express','Employed','cargador','2019-04-27');
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
  `loan_id` int(11) NOT NULL,
  PRIMARY KEY (`co_borrower_id`),
  KEY `fk_clientid_coborrower_idx` (`client_id`),
  KEY `fk_loanid_coborrower_idx` (`loan_id`),
  CONSTRAINT `fk_clientid_coborrower` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_loanid_coborrower` FOREIGN KEY (`loan_id`) REFERENCES `loan` (`loan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_borrower`
--

LOCK TABLES `co_borrower` WRITE;
/*!40000 ALTER TABLE `co_borrower` DISABLE KEYS */;
INSERT INTO `co_borrower` VALUES (3,'jasper','tange','silver','09009089089','abc street','aunty','bauiog','balot deliver co.','Employed','ceo',12,40),(4,'leo','trtr','dion','09090909','technical','uncle','baguio','panagasinan','Own Business','ceo',12,40);
/*!40000 ALTER TABLE `co_borrower` ENABLE KEYS */;
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
INSERT INTO `employee` VALUES (1,'opmanager','ì^óaì©Ë«»>\Zú|ÿ.','Operations','Manager','Operations Manager','0912312512','Operations Manager house','');
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
  PRIMARY KEY (`loan_id`),
  KEY `fk_clientid_loan_idx` (`client_id`),
  CONSTRAINT `fk_clientid_loan` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` VALUES (40,708000,'2019-04-27','2019-04-30',12,162732,5,'Add',600000.00,0,'Active','Business');
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
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (126,'2019-06-26',707509.16,40,'2019-04-27'),(127,'2019-04-26',-282490.84,40,'2019-04-27'),(128,'2019-04-19',-248410.84,40,'2019-04-27'),(129,'2019-04-12',-279106.84,40,'2019-04-27'),(130,'2019-04-26',-282490.84,40,'2019-04-27'),(131,'2019-04-30',0.00,40,'2019-04-27');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_info`
--

LOCK TABLES `payment_info` WRITE;
/*!40000 ALTER TABLE `payment_info` DISABLE KEYS */;
INSERT INTO `payment_info` VALUES (126,0.00,NULL,NULL,NULL,NULL,NULL,0.00,0.00,'Waived','Excused',5000.00,2),(127,60000.00,'Cash','2019-01-01','','','',0.00,6480.00,'Payment was Lacking(Penalty)','Updated',0.00,3),(127,11111.00,'Cash','2019-01-01','','5555','',0.00,6480.00,'Bouncing Check','Bounced',0.00,4),(127,0.00,NULL,NULL,NULL,NULL,NULL,0.00,6480.00,'Penalty for bouncing check#-5555','Updated',0.00,5),(127,0.00,NULL,NULL,NULL,NULL,NULL,0.00,6480.00,'Penalty for bouncing check#-5555','Updated',0.00,6),(127,0.00,NULL,NULL,NULL,NULL,NULL,0.00,6480.00,'Penalty for bouncing check#-5555','Updated',0.00,7),(128,0.00,NULL,NULL,NULL,NULL,NULL,30696.00,0.00,NULL,'Updated',0.00,8),(129,1000000.00,'Cash','2019-04-11','','11111','',0.00,6447.00,'Bouncing Check111','Updated',0.00,9),(129,0.00,NULL,NULL,NULL,NULL,NULL,0.00,6446.16,'Penalty for bouncing check#-11111','Updated',0.00,10),(126,0.00,NULL,NULL,NULL,NULL,NULL,0.00,0.00,'Waived','Excused',13000.00,11);
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

-- Dump completed on 2019-05-25 10:57:35
