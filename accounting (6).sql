-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2016 at 03:18 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getEntries` (IN `journal_var` INT)  NO SQL
SELECT
					journal_entries.journal_entry_no,
					journal_entries.date_of_entry,
					journal_details.account_id,
                    accounts.name,
					journal_details.amount,
					journal_details.is_debit
					
						FROM journal_entries
						INNER JOIN journal_details on journal_entries.journal_entry_no = journal_details.journal_entry_no
                        INNER JOIN accounts on accounts.acc_id = journal_details.account_id						
						where journal_entries.journal_id=journal_var$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` bigint(20) NOT NULL,
  `account_name` longtext,
  `type` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `account_name`, `type`, `is_deleted`) VALUES
(1001, 'Cash', 5, 0),
(2001, 'Accounts Payable', 6, 0),
(2102, 'Utilities Expenses', 3, 0),
(2311, 'Office Expenses', 3, 0),
(3102, 'Accounts Recievable', 4, 0),
(5501, 'Accounts Receivable', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `acc_types_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `inc_when_debit` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`acc_types_id`, `name`, `inc_when_debit`) VALUES
(1, 'Revenue(Main)', 0),
(2, 'Revenue(Side)', 0),
(3, 'Expenses', 1),
(4, 'Assets(Non-Current)', 1),
(5, 'Assets(Current)', 1),
(6, 'Liabilities(Current)', 0),
(7, 'Liabilities(Non-Current)', 0),
(8, 'Owner''s Equity (Capital)', 0),
(9, 'Owner''s Equity (Drawing)', 0),
(10, 'Contra (Current Assets)', 0),
(11, 'Non-Current Asset', 0);

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `journal_id` bigint(20) NOT NULL,
  `journal_date` date DEFAULT NULL,
  `description` longtext,
  `ledger_id` bigint(20) DEFAULT NULL,
  `is_archived` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`journal_id`, `journal_date`, `description`, `ledger_id`, `is_archived`) VALUES
(1, '2015-01-21', 'Journal For March 2016\r\n', 0, 0),
(2, '2016-04-16', 'Journal for April 2016\r\n', 0, 0),
(3, '2016-05-16', 'Journal For May 2016\r\n', 0, 0),
(7, '2016-07-16', 'Journal for July 2016\r\n\r\n', 0, 0),
(8, '2017-01-16', 'Journal For January 2017', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `journal_details`
--

CREATE TABLE `journal_details` (
  `id` bigint(20) NOT NULL,
  `account_id` bigint(20) DEFAULT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_debit` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal_details`
--

INSERT INTO `journal_details` (`id`, `account_id`, `journal_entry_no`, `amount`, `is_debit`) VALUES
(0, 1001, 16031, 1000, 1),
(1, 2001, 16031, 1000, 0),
(3, 1001, 16032, 2500, 1),
(4, 2311, 16032, 2500, 0),
(5, 3102, 16032, 1000, 1),
(6, 2102, 16032, 1000, 0),
(7, 2001, 16041, 1000, 1),
(8, 1001, 16041, 1000, 0),
(9, 1001, 16042, 3500, 1),
(10, 5501, 16042, 3500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` bigint(20) NOT NULL,
  `journal_entry_no` bigint(20) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `date_of_entry` date NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `journal_entry_no`, `journal_id`, `date_of_entry`, `description`) VALUES
(0, 16031, 1, '2016-03-03', 'Payed Debts'),
(1, 16032, 1, '2016-03-04', 'Purchased Office Equipment and payed bills'),
(2, 16041, 2, '2016-07-08', 'Payed Debts'),
(3, 16042, 2, '2016-07-15', 'Received Cash');

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `ledger_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `full_name` longtext,
  `username` longtext,
  `password` longtext,
  `user_type` varchar(50) DEFAULT NULL,
  `is_deleted` varchar(50) DEFAULT NULL,
  `is_logged_in` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `username`, `password`, `user_type`, `is_deleted`, `is_logged_in`) VALUES
(1, 'Peter', 'admin', '3dVoJ2bvdLynZysmiFxCaVySFMONfzv+IZKwJuE14wU=', 'admin', '0', 1),
(2, 'Lawrenc', 'admin1', 'UQ6ZD4B3CjZPSiaMt1Ch185x2vRjKHFTbNzi4O9SNS8=', 'admin', '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`acc_types_id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`journal_id`);

--
-- Indexes for table `journal_details`
--
ALTER TABLE `journal_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `journal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
