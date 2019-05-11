-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2019 at 08:44 AM
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
(2, 'Jon', 'Dela Cruz', 'Cort', 'Denmark', 'Bakakeng', '0989898888', 100000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Employed', 'cargador', '2019-04-29'),
(3, 'Jon', 'apilada', 'Aquino', 'Jen', 'Bakakeng', '09123456789', 5000000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Own Business', 'idris', '2019-04-29'),
(4, 'Oreinz', 'Mama', 'Kasilag', 'Jen', 'Bakakeng', '09123456789', 5000000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Own Business', 'cargador', '2019-04-29'),
(5, 'Jeffrey', 'Lol', 'Rimando', 'Jen', 'Bakakeng', '09123456789', 5000000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Own Business', 'cargador', '2019-04-29'),
(6, 'Luke', 'Dota', 'Llanillo', 'Jen', 'Bakakeng', '09123456725', 5000000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Own Business', 'finisher', '2019-04-29'),
(7, 'Nikki', 'Malong', 'Ganotan', 'Yolo', 'Bakakeng', '09123456789', 5000000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Own Business', 'cargador', '2019-04-29'),
(8, 'Jasper', 'Tade', 'Tanglib', 'May', 'Bakakeng', '09123456789', 5000000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Own Business', 'cargador', '2019-04-29'),
(9, 'Leo', 'Jhester', 'Dion', 'April', 'Baka', '09123456789', 5000000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Own Business', 'cargador', '2019-04-29'),
(10, 'Tim', 'apilada', 'Dion', 'Jenny', 'Baguio', '09123456789', 900000, 'Approved', '2019-04-29', 'baguio', 'tagaytay express', 'Employed', 'cargador', '2019-04-29'),
(11, 'timothy', 'apilada', 'Dion', 'Denmark', 'Bakakeng', '0909909090', 899990000, 'Approved', '2019-04-29', 'Tubero', 'tagaytay express', 'Employed', 'cargador', '2019-04-29'),
(12, 'zzzzzzzzzz', 'z', 'z', 't', 't', '0', 20000, 'Approved', '2019-04-29', 't', 't', 'Employed', 't', '2019-04-29'),
(13, 'celes', 'te', 'nar', 'asap', 'jolly town', '09275816333', 5000000, 'Denied', '2019-04-29', 'waitress', 'jollibee', 'Employed', 'staff', '2019-04-30');

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
(3, 'oreinz', 'tange', 'silver', '09009089089', 'abc street', 'aunty', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 2),
(4, 'leo', 'ganotan', 'dion', '098989898', 'technical', 'friend', 'baguio', 'panagasinan', 'Employed', 'ceo', 2),
(5, 'balot deliver co.', 'tang', 'silvery', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'bossy', 3),
(6, 'panagasinan', 'ganotan', 'dion', '098989898', 'technically', 'aunty', 'baguio', 'panagasinan', 'Employed', 'Trainer', 3),
(7, 'january', 'tange', 'silver', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 4),
(8, 'february', 'q', 'gold', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 4),
(9, 'february', 'march', 'copper', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 5),
(10, 'balot deliver co.', 'april', 'silver', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'bore', 5),
(11, 'balot deliver co.', 'may', 'gold', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'bossy', 6),
(12, 'may', 'june', 'silver', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 6),
(13, 'july', 'august', 'silver', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 7),
(14, 'august', 'september', 'copper', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 7),
(15, 'september', 'november', 'diamond', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 8),
(16, 'november', 'december', 'bronze', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 8),
(17, 'november', 'december', 'platinum', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 9),
(18, 'december', 'january', 'master', '098209299', 'abc street', 'auntie', 'bauiog', 'balot deliver co.', 'Employed', 'boss', 9),
(19, 'oreinz', 'tange', 'dion', '09009089089', 'abc street', 'employee', 'qwewqeqwew', 'balot deliver co.', 'Employed', 'ceo', 10),
(20, 'leo', 'ganotan', 'dion', '09090909', 'technical', 'uncle', 'baguio', 'panagasinan', 'Employed', 'benguet', 10),
(21, 'jasper', 'tange', 'silver', '09009089089', 'abc street', 'employee', 'bauiog', 'balot deliver co.', 'Own Business', 'boss', 11),
(22, 'jefferey', 'ganotan', 'dion', '098989898', 'technical', 'friend', 'baguio', 'panagasinan', 'Own Business', 'Trainer', 11),
(23, 'z', 'z', '33', '0', 'z', 'z', 'z', 'z', 'Own Business', 'z', 12),
(24, 'z', 'z', 'z', '1', 'z', 'z', 'z', 'z', 'Employed', 'z', 12),
(25, 'boss', 'joey', 'dizon', '092999929', 'emerald', 'friend', 'lower session', 'market', 'Employed', 'manager', 13),
(26, 'diokno', 'kyree', 'nikki', '09098099080', 'nikki', 'employee', 'upper session', 'sigma co.', 'Own Business', 'ceo', 13);

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
(1, 'opmanager', 'opmanager', 'Operations', 'Manager', 'Operations Manager', '0912312512', 'Operations Manager house', ''),
(2, 'ofstaff', 'ofstaff', '', '', 'Office Staff', '', '', '');

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
(2, 52690, '2019-04-29', '2019-05-10', 3, 52690, 5, 'Add', '50000.00', 60, 'Active', 'Salary'),
(3, 57865, '2019-04-29', '2019-05-11', 4, 57865, 5, 'Add', '55000.00', 160, 'Active', 'Business'),
(4, 42200, '2019-04-29', '2019-04-16', 5, 42200, 5, 'Add', '40000.00', 0, 'Legal', 'Salary'),
(5, 66180, '2019-04-29', '2019-04-27', 6, 76493, 5, 'Add', '60000.00', 280, 'Inactive', 'Business'),
(6, 84300, '2019-04-29', '2019-05-02', 7, 84300, 5, 'Add', '80000.00', 100, 'Active', 'Salary'),
(7, 663000, '2019-04-29', '2019-04-16', 8, 221000, 5, 'Add', '600000.00', 0, 'Inactive', 'Salary'),
(8, 6630000, '2019-04-29', '2019-06-01', 10, 2210000, 5, 'Add', '6000000.00', 0, 'Active', 'Business'),
(9, 55130, '2019-04-29', '2019-05-29', 9, 18377, 5, 'Add', '50000.00', 120, 'Active', 'Salary'),
(10, 1105000, '2019-04-29', '2019-06-01', 2, 368333, 5, 'Add', '1000000.00', 0, 'Active', 'Salary'),
(11, 53870, '2019-04-29', '2019-06-01', 11, 29696, 5, 'Add', '50000.00', 130, 'Active', 'Salary'),
(12, 52620, '2019-04-29', '2019-03-28', 12, 52620, 5, 'Add', '50000.00', 130, 'Legal', 'Salary');

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
(2, '2019-05-10', '3744.00', 2, '2019-04-29'),
(3, '2019-05-11', '0.00', 3, '2019-04-29'),
(4, '2019-04-16', '44310.00', 4, '2019-04-29'),
(5, '2019-04-10', '69339.00', 5, '2019-04-29'),
(6, '2019-05-02', '0.00', 6, '2019-04-29'),
(7, '2019-03-16', '674050.00', 7, '2019-04-29'),
(8, '2019-04-01', '685100.00', 7, '2019-04-29'),
(9, '2019-04-16', '696150.00', 7, '2019-04-29'),
(10, '2019-05-01', '6740500.00', 8, '2019-04-29'),
(11, '2019-05-16', '0.00', 8, '2019-04-29'),
(12, '2019-06-01', '0.00', 8, '2019-04-29'),
(13, '2019-04-29', '56049.00', 9, '2019-04-29'),
(14, '2019-05-14', '0.00', 9, '2019-04-29'),
(15, '2019-05-29', '0.00', 9, '2019-04-29'),
(16, '2019-05-01', '748479.00', 10, '2019-04-29'),
(17, '2019-05-16', '368334.00', 10, '2019-04-29'),
(18, '2019-06-01', '0.00', 10, '2019-04-29'),
(19, '2019-03-14', '55217.00', 11, '2019-04-29'),
(20, '2019-03-29', '56564.00', 11, '2019-04-29'),
(21, '2019-03-28', '55251.00', 12, '2019-04-29'),
(22, '2019-04-28', '64091.16', 12, '2019-04-29'),
(26, '2019-04-30', '84143.00', 5, '2019-04-29'),
(27, '2019-05-16', '59393.00', 11, '2019-04-28'),
(28, '2019-06-01', '0.00', 11, '2019-04-29'),
(29, '2019-06-01', '0.00', 5, '2019-04-29'),
(30, '2019-04-20', '74627.00', 5, '2019-04-28'),
(31, '2019-04-27', '80318.00', 5, '2019-04-28');

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
(5, '0.00', 'Cheque', NULL, '', '', '', '0.00', '3159.00', 'lateBySystem', 'Updated', '0.00', 1),
(19, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '1347.00', 'lateBySystem', 'Updated', '0.00', 2),
(20, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '1347.00', 'lateBySystem', 'Updated', '0.00', 3),
(21, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '2631.00', 'lateBySystem', 'Updated', '0.00', 4),
(22, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '4972.59', 'Penalty after maturity date(System)', 'Updated', '0.00', 5),
(22, '0.00', NULL, NULL, NULL, NULL, NULL, '3867.57', '0.00', 'Interest after maturity date', 'Updated', '0.00', 6),
(16, '363888.00', 'Cash', '2019-04-30', '', '', '', '0.00', '7367.00', 'Payment was Lacking(Penalty)', 'Updated', '0.00', 15),
(17, '380145.00', 'Cash', '2019-05-16', '', '', '', '0.00', '0.00', '', 'Updated', '0.00', 16),
(27, '0.00', NULL, NULL, NULL, NULL, NULL, '2829.00', '0.00', NULL, 'Updated', '0.00', 17),
(30, '0.00', NULL, NULL, NULL, NULL, NULL, '1734.00', '0.00', NULL, 'Updated', '0.00', 18),
(30, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '3554.00', 'lateBySystem', 'Updated', '0.00', 19),
(31, '0.00', NULL, NULL, NULL, NULL, NULL, '1866.00', '0.00', NULL, 'Updated', '0.00', 20),
(31, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '3825.00', 'lateBySystem', 'Updated', '0.00', 21),
(7, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '11050.00', 'lateBySystem', 'Updated', '0.00', 22),
(4, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '2110.00', 'lateBySystem', 'Updated', '0.00', 23),
(8, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '11050.00', 'lateBySystem', 'Updated', '0.00', 24),
(9, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '11050.00', 'lateBySystem', 'Updated', '0.00', 25),
(13, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '919.00', 'lateBySystem', 'Updated', '0.00', 26),
(6, '84300.00', 'Cash', '2019-04-12', '', '', '', '0.00', '0.00', '', 'Updated', '0.00', 27),
(2, '50000.00', 'Cash', '2019-04-11', '', '', '', '0.00', '1054.00', 'Payment was Lacking(Penalty)', 'Updated', '0.00', 28),
(26, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '3825.00', 'lateBySystem', 'Updated', '0.00', 29),
(10, '0.00', NULL, NULL, NULL, NULL, NULL, '0.00', '110500.00', 'lateBySystem', 'Updated', '0.00', 30);

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
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `co_borrower`
--
ALTER TABLE `co_borrower`
  MODIFY `co_borrower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `payment_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
