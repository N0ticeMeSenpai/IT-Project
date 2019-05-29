-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: sigma_database
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
-- Table structure for table `sigma_account`
--

DROP TABLE IF EXISTS `sigma_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_account` (
  `account_number` int(11) NOT NULL,
  `account_type` varchar(45) DEFAULT NULL,
  `account_balance` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_account`
--

LOCK TABLES `sigma_account` WRITE;
/*!40000 ALTER TABLE `sigma_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigma_co_borrower`
--

DROP TABLE IF EXISTS `sigma_co_borrower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_co_borrower` (
  `co_borrower_name` varchar(45) DEFAULT NULL,
  `address` varchar(99) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `e-mail` varchar(45) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `co_borrower_id` int(11) NOT NULL,
  PRIMARY KEY (`co_borrower_id`),
  KEY `fk_customer_id_borrower_idx` (`customer_id`),
  CONSTRAINT `fk_customer_id_borrower` FOREIGN KEY (`customer_id`) REFERENCES `sigma_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_co_borrower`
--

LOCK TABLES `sigma_co_borrower` WRITE;
/*!40000 ALTER TABLE `sigma_co_borrower` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_co_borrower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigma_customer`
--

DROP TABLE IF EXISTS `sigma_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_customer` (
  `customer_id` int(11) NOT NULL,
  `type_of_customer` varchar(45) DEFAULT NULL,
  `paid_status` varchar(45) DEFAULT NULL,
  `account_number` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_id_UNIQUE` (`customer_id`),
  KEY `fk_account_number_idx` (`account_number`),
  KEY `fk_person_id_idx` (`person_id`),
  CONSTRAINT `fk_account_number` FOREIGN KEY (`account_number`) REFERENCES `sigma_account` (`account_number`) ON UPDATE CASCADE,
  CONSTRAINT `fk_person_id_customer` FOREIGN KEY (`person_id`) REFERENCES `sigma_person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_customer`
--

LOCK TABLES `sigma_customer` WRITE;
/*!40000 ALTER TABLE `sigma_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigma_employee`
--

DROP TABLE IF EXISTS `sigma_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_employee` (
  `employee_id` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `verification_code` varchar(45) NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `fk_person_id_idx` (`person_id`),
  CONSTRAINT `fk_person_id_employee` FOREIGN KEY (`person_id`) REFERENCES `sigma_person` (`person_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_employee`
--

LOCK TABLES `sigma_employee` WRITE;
/*!40000 ALTER TABLE `sigma_employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigma_insufficient_payment`
--

DROP TABLE IF EXISTS `sigma_insufficient_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_insufficient_payment` (
  `remaining_balance` int(11) DEFAULT NULL,
  `amount_paid` varchar(45) DEFAULT NULL,
  `due_amount` varchar(45) DEFAULT NULL,
  KEY `amount_paid_idx` (`amount_paid`),
  CONSTRAINT `fk_amount_paid_insufficient` FOREIGN KEY (`amount_paid`) REFERENCES `sigma_payment` (`amount_paid`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_insufficient_payment`
--

LOCK TABLES `sigma_insufficient_payment` WRITE;
/*!40000 ALTER TABLE `sigma_insufficient_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_insufficient_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigma_loans`
--

DROP TABLE IF EXISTS `sigma_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_loans` (
  `loan_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `loan_type` varchar(45) DEFAULT NULL,
  `loan_balance` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`loan_id`),
  UNIQUE KEY `loan_id_UNIQUE` (`loan_id`),
  KEY `fk_customer_id_loans_idx` (`customer_id`),
  CONSTRAINT `fk_customer_id_loans` FOREIGN KEY (`customer_id`) REFERENCES `sigma_customer` (`customer_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_loans`
--

LOCK TABLES `sigma_loans` WRITE;
/*!40000 ALTER TABLE `sigma_loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigma_payment`
--

DROP TABLE IF EXISTS `sigma_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_payment` (
  `payment_id` int(11) NOT NULL,
  `date_paid` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `amount_paid` varchar(45) NOT NULL,
  `payment_type` varchar(45) DEFAULT NULL,
  `account_number` int(11) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `remarks` varchar(99) DEFAULT NULL,
  `interest` varchar(45) DEFAULT NULL,
  `penalty` varchar(45) DEFAULT NULL,
  `check_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `amount_paid_UNIQUE` (`amount_paid`),
  KEY `fk_account_number_payment_idx` (`account_number`),
  KEY `fk_loan_id_payment_idx` (`loan_id`),
  KEY `fk_customer_id_payment_idx` (`customer_id`),
  CONSTRAINT `fk_account_number_payment` FOREIGN KEY (`account_number`) REFERENCES `sigma_account` (`account_number`) ON UPDATE CASCADE,
  CONSTRAINT `fk_customer_id_payment` FOREIGN KEY (`customer_id`) REFERENCES `sigma_customer` (`customer_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_loan_id_payment` FOREIGN KEY (`loan_id`) REFERENCES `sigma_loans` (`loan_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_payment`
--

LOCK TABLES `sigma_payment` WRITE;
/*!40000 ALTER TABLE `sigma_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sigma_person`
--

DROP TABLE IF EXISTS `sigma_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sigma_person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address` varchar(99) DEFAULT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `citizenship` varchar(45) DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `date_joined` datetime DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `person_id_UNIQUE` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sigma_person`
--

LOCK TABLES `sigma_person` WRITE;
/*!40000 ALTER TABLE `sigma_person` DISABLE KEYS */;
/*!40000 ALTER TABLE `sigma_person` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-31  6:43:00
