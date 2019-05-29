-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: sigma
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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `name_of_spouse` varchar(45) DEFAULT NULL,
  `present_address` varchar(100) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `requested_amount` varchar(100) NOT NULL,
  `registered_status` enum('Pending','Approve','Denied') NOT NULL DEFAULT 'Pending',
  `registered_date` date NOT NULL,
  `loan_type` enum('Salary','Business','Mortgage') NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (201,'Vhong','Navarro','Vice Ganda','Tagaytay City','09656586562','30000','Denied','2000-08-22','Business'),(202,'Shernan','De Leon','Lil Sisa','Quezon City','09656235954','25000','Denied','2010-12-12','Salary'),(203,'Felix','Pewdiepie','Marzia','United States of America','09653265985','100000','Pending','2005-03-18','Salary'),(204,'Leo','Dion','Onodera','Japan','09562359684','40000','Pending','2008-08-15','Salary'),(205,'Naufomi','Sama','Birdie','Korea','09565624851','3000','Denied','2009-02-14','Business'),(206,'Mark','Senpai','Edgar Chan','South Korea','09235652005','10000','Pending','2014-02-11','Business'),(207,'efkeik','gkeogk','rkeokgo','efkeofko','09059969532','50000','Approve','2009-02-14','Business'),(208,'ssfko','ekfiek','kgoeko','gkeogk','09582651511','60000','Approve','2019-02-11','Business'),(209,'dkifkk','kfolp','kdwko','ekfoeko','09595659859','70000','Approve','2016-02-11','Salary'),(210,'mfemi','emfieim','efmeimfi','efmfmfiem','09484580048','80000','Approve','2019-05-20','Salary'),(211,'Sample','Name','devr','efefe','089895656','111','Pending','2019-02-11','Business'),(212,'Hilot','Masakit','Wewew','wdwdw','099595956','dsdgbnhj','Pending','2010-02-02','Business');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_borrower`
--

DROP TABLE IF EXISTS `co_borrower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_borrower` (
  `co_borrower_id` int(11) NOT NULL,
  `co_first_name` varchar(45) NOT NULL,
  `co_last_name` varchar(45) NOT NULL,
  `co_contact_no` varchar(45) NOT NULL,
  `co_address` varchar(100) NOT NULL,
  `related_client` varchar(45) NOT NULL,
  PRIMARY KEY (`co_borrower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_borrower`
--

LOCK TABLES `co_borrower` WRITE;
/*!40000 ALTER TABLE `co_borrower` DISABLE KEYS */;
INSERT INTO `co_borrower` VALUES (301,'Shinichi','Conan','09653265891','Makati City','Friend'),(302,'Yamcha','Denden','09565659597','Gotham City','Ex Wife'),(303,'Ken','Kaneki','09568474624','Isabela','Ex Bf'),(304,'Donald','Trump','09778740014','England','Boss'),(305,'Oshiteo','Suno','09030326265','Hongkong','Sensei'),(306,'Naruto','Uzumaki','09262063696','Beijing','Senpai'),(307,'dv dqsxq','dwfad','09700464616','efek','kfoeko'),(308,'ekfoek','dp','09003164654','kfeeoof','kefokeok'),(309,'ekfokeo','ekfokeo','09600651188','elofleo','efokokfo'),(310,'veelol','leolvp','09160068654','wdowdo0','eof');
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
  `em_last_name` varchar(55) NOT NULL,
  `em_position` enum('Operations Manager','Office Staff') NOT NULL,
  `contact_no` varchar(55) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (101,'ofstaff','ofstaff','Pangalan','Nila','Office Staff','09896532655','Igorot Park, Baguio City'),(102,'opmanager','opmanager','Tatanungin','Nmin','Operations Manager','09320015448','Bakakeng, Baguio City');
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
  `credit_type` enum('Savings','Checking','Loans','Credit Cards') NOT NULL,
  `address` varchar(100) NOT NULL,
  `bank_or_institution` varchar(100) NOT NULL,
  `loan_balance` int(11) NOT NULL,
  `date_booked` date NOT NULL,
  `maturity_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `loan_status` enum('Paid','Not Paid') DEFAULT NULL,
  PRIMARY KEY (`loan_id`),
  KEY `client_id_idx` (`client_id`),
  KEY `payment_id_idx` (`payment_id`),
  CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  CONSTRAINT `payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=411 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
INSERT INTO `loan` VALUES (401,'Savings','elelfp','elfplepf',1000,'2010-02-02','2010-02-02',201,501,NULL),(402,'Credit Cards','elfpelpf','rlplpc',20000,'2010-02-10','2010-02-10',202,502,NULL),(403,'Checking','edefe','effe',4000,'2002-11-11','2010-02-02',203,503,NULL),(404,'Loans','wwdw','eccwe',44333,'2019-08-12','2010-02-10',204,504,NULL),(405,'Loans','cwcwc','xcxc',343432,'2010-02-02','2008-12-03',205,505,NULL),(406,'Loans','wcw','csc',23232,'2008-12-03','2010-02-02',206,506,NULL),(407,'Credit Cards','cwc','scscs',23232,'2019-07-03','2008-09-01',207,507,NULL),(408,'Credit Cards','cwcw','scscscsc',2323,'2008-09-01','2019-07-03',208,508,NULL),(409,'Checking','cwcwcw','wcqpop',121,'2000-10-11','2000-12-02',209,509,NULL),(410,'Checking','dlwcp','leplple',2323,'2000-12-02','2000-12-02',210,510,NULL);
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupation`
--

DROP TABLE IF EXISTS `occupation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupation` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `business_address` varchar(100) NOT NULL,
  `name_of_firm` varchar(60) NOT NULL,
  `employment` enum('Employed','Own Business') NOT NULL,
  `position` varchar(60) NOT NULL,
  `co_borrower_id` int(11) NOT NULL,
  `co_business_address` varchar(100) NOT NULL,
  `co_name_of_firm` varchar(100) NOT NULL,
  `co_employment` enum('Employed','Own Business') NOT NULL,
  `co_position` varchar(45) NOT NULL,
  KEY `client_id_idx` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupation`
--

LOCK TABLES `occupation` WRITE;
/*!40000 ALTER TABLE `occupation` DISABLE KEYS */;
INSERT INTO `occupation` VALUES (206,'flepfl','flepflp','Employed','lgprp',301,'grg','','Own Business','fdfde'),(205,'fkoefko','fkfeokgo','Own Business','lfpelp',302,'grg','','Employed','rg'),(204,'fdlfdp','lfepflp','Own Business','fkfkdl',303,'rgrg','','Own Business','rgrg'),(203,'fkeofk','kfkeok','Own Business','kdovkeo',304,'qw','','Own Business','ffgf'),(202,'dfdf','efw','Employed','dfdf',305,'rre','','Own Business','wqw'),(201,'efkekfo','fekfkok','Employed','kfokefooke',306,'yjy','','Employed','gfgf'),(207,'ghb ','fgfg','Employed','efef',307,'tt','','Employed','gfgf'),(208,'dfdf','sfd','Employed','efefe',308,'tht','','Own Business','erere'),(209,'dv','dfww','Own Business','efef',309,'wew','','Own Business','er'),(210,'dfd','dfdf','Own Business','efefe',310,'sdsd','','Own Business','eregt');
/*!40000 ALTER TABLE `occupation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paid` date DEFAULT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `payment_type` varchar(45) DEFAULT NULL,
  `account_number` int(11) DEFAULT NULL,
  `check_no` varchar(45) DEFAULT NULL,
  `ref_no` int(11) DEFAULT NULL,
  `interest` int(11) DEFAULT NULL,
  `fines` varchar(45) DEFAULT NULL,
  `loan_id` int(11) NOT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `oustanding_balance` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `loan_id` (`loan_id`),
  CONSTRAINT `loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loan` (`loan_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=511 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (501,'2010-02-20',3323,'wdl,fo',232,'wlow',2323,232,'efe',401,'qwqw','2010-02-20',50000),(502,'2010-02-20',232,'fdfd',232,'dsd',121,343,'scscs',402,'asasa','2010-02-20',46677),(503,'2010-02-20',23,'asqs',232,'sds',212,4545,'ccsscs',403,'efef','2010-02-20',2636),(504,'2010-02-20',544,'wdw',232,'sdsds',1212,545,'scscsq',404,'dfece','2010-02-20',2342),(505,'2010-02-20',454,'wdwd',232,'sasa',1212,4545,'qqq',405,'dfdf','2010-02-20',26326),(506,'2010-02-20',343,'wd',232,'asas',121,4545,'qxqx',406,'dfdf','2010-02-20',3242),(507,'2010-02-20',676,'wew',232,'asas',121,4545,'xqq',407,'ddf','2010-02-20',4235),(508,'2010-02-20',4545,'dwd',232,'asas',121,656,'zzz',408,'ecdc','2010-02-20',6236),(509,'2010-02-20',232,'wd',232,'asa',112,878,'qwq',409,'wece','2010-02-20',4234),(510,'2013-03-25',545,'wew',232,'as',243,877,'juk',410,'wewe','2010-02-20',3614);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-06 15:36:35
