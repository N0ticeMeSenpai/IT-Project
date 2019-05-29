-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2019 at 02:50 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigma`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
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
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `first_name`, `middle_name`, `last_name`, `name_of_spouse`, `present_address`, `contact_no`, `requested_amount`, `registered_status`, `registered_date`, `business_address`, `name_of_firm`, `employment`, `position`, `date_modified`) VALUES
(12, 'Thy', 'ti', 'mo', 'Denmark', 'Baguio', '0989898888', 500000000, 'Approved', '2019-04-27', 'qweqwwqdqw', 'tagaytay express', 'Employed', 'cargador', '2019-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `co_borrower`
--

CREATE TABLE `co_borrower` (
  `co_borrower_id` int(11) NOT NULL,
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
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `co_borrower`
--

INSERT INTO `co_borrower` (`co_borrower_id`, `co_first_name`, `co_middle_name`, `co_last_name`, `co_contact_no`, `co_address`, `related_client`, `co_business_address`, `co_name_of_firm`, `co_employment`, `co_position`, `client_id`) VALUES
(3, 'jasper', 'tange', 'silver', '09009089089', 'abc street', 'aunty', 'bauiog', 'balot deliver co.', 'Employed', 'ceo', 12),
(4, 'leo', 'trtr', 'dion', '09090909', 'technical', 'uncle', 'baguio', 'panagasinan', 'Own Business', 'ceo', 12);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `em_first_name` varchar(45) NOT NULL,
  `em_last_name` varchar(45) NOT NULL,
  `em_position` enum('Operations Manager','Office Staff') NOT NULL,
  `contact_no` varchar(55) NOT NULL,
  `address` varchar(100) NOT NULL,
  `employee_img` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `password`, `em_first_name`, `em_last_name`, `em_position`, `contact_no`, `address`, `employee_img`) VALUES
(1, 'opmanager', 'opmanager', 'Operations', 'Manager', 'Operations Manager', '0912312512', 'Operations Manager house', '');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
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
  `loan_type` enum('Salary','Business') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `loan_balance`, `date_booked`, `maturity_date`, `client_id`, `bi_monthly`, `interest_rate`, `loan_class`, `original_amount`, `insurance`, `delinquent_status`, `loan_type`) VALUES
(40, 708000, '2019-04-27', '2019-04-30', 12, 162732, 5, 'Add', '600000.00', 0, 'Active', 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `due_date` date DEFAULT NULL,
  `remaining_balance` decimal(65,2) DEFAULT '0.00',
  `loan_id` int(11) NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `due_date`, `remaining_balance`, `loan_id`, `date_modified`) VALUES
(126, '2019-06-26', '707509.16', 40, '2019-04-27'),
(127, '2019-04-26', '-282490.84', 40, '2019-04-27'),
(128, '2019-04-19', '-248410.84', 40, '2019-04-27'),
(129, '2019-04-12', '-279106.84', 40, '2019-04-27'),
(130, '2019-04-26', '-282490.84', 40, '2019-04-27'),
(131, '2019-04-30', '0.00', 40, '2019-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

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
  `payment_info_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`payment_id`, `amount_paid`, `payment_type`, `date_paid`, `account_number`, `check_no`, `ref_no`, `interest`, `fines`, `remarks`, `status`, `other_income`, `payment_info_id`) VALUES
(126, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', 'Waived', 'Excused', '5000.00', 2),
(127, '60000.00', 'Cash', '2019-01-01', '', '', '', '0.00', '6480.00', 'Payment was Lacking(Penalty)', 'Updated', '0.00', 3),
(127, '11111.00', 'Cash', '2019-01-01', '', '5555', '', '0.00', '6480.00', 'Bouncing Check', 'Bounced', '0.00', 4),
(127, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '6480.00', 'Penalty for bouncing check#-5555', 'Updated', '0.00', 5),
(127, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '6480.00', 'Penalty for bouncing check#-5555', 'Updated', '0.00', 6),
(127, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '6480.00', 'Penalty for bouncing check#-5555', 'Updated', '0.00', 7),
(128, '0.00', NULL, NULL, NULL, NULL, NULL, '30696.00', '0.00', NULL, 'Updated', '0.00', 8),
(129, '1000000.00', 'Cash', '2019-04-11', '', '11111', '', '0.00', '6447.00', 'Bouncing Check111', 'Updated', '0.00', 9),
(129, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '6446.16', 'Penalty for bouncing check#-11111', 'Updated', '0.00', 10),
(126, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', 'Waived', 'Excused', '13000.00', 11);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `rate_id` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `service_handling_fee` int(11) NOT NULL,
  `penalty_not_maturity` int(11) NOT NULL,
  `maturity_interest` int(11) NOT NULL,
  `maturity_penalty` int(11) NOT NULL,
  `penalty_lack` int(11) NOT NULL,
  `penalty_bouncing_check` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`rate_id`, `interest`, `service_handling_fee`, `penalty_not_maturity`, `maturity_interest`, `maturity_penalty`, `penalty_lack`, `penalty_bouncing_check`) VALUES
(1, 5, 3, 5, 7, 2, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `co_borrower`
--
ALTER TABLE `co_borrower`
  ADD PRIMARY KEY (`co_borrower_id`),
  ADD KEY `fk_clientid_coborrower_idx` (`client_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `fk_clientid_loan_idx` (`client_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_loanid_pyment_idx` (`loan_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`payment_info_id`),
  ADD KEY `fk_payment_id_pymentinfo_idx` (`payment_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `co_borrower`
--
ALTER TABLE `co_borrower`
  MODIFY `co_borrower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `payment_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `co_borrower`
--
ALTER TABLE `co_borrower`
  ADD CONSTRAINT `fk_clientid_coborrower` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `fk_clientid_loan` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_loanid_pyment` FOREIGN KEY (`loan_id`) REFERENCES `loan` (`loan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `fk_payment_id_pymentinfo` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
