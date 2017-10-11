/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : accounting

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-09-14 13:30:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `acc_id` bigint(20) NOT NULL,
  `account_name` longtext,
  `type` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES ('1001', 'Cash', '5', '0');
INSERT INTO `accounts` VALUES ('1002', 'Petty Cash', '5', '0');
INSERT INTO `accounts` VALUES ('1003', 'Accounts Recievable', '5', '0');
INSERT INTO `accounts` VALUES ('3001', 'Salaries Expenses', '3', '0');
INSERT INTO `accounts` VALUES ('3002', 'Utilities Expenses', '3', '0');
INSERT INTO `accounts` VALUES ('3003', 'Supplies Expense', '3', '0');
INSERT INTO `accounts` VALUES ('4001', 'Accounts Payable', '6', '0');
INSERT INTO `accounts` VALUES ('5001', 'Service Income', '1', '0');
INSERT INTO `accounts` VALUES ('5002', 'Sales', '1', '0');
INSERT INTO `accounts` VALUES ('7900', 'Test', '11', '1');

-- ----------------------------
-- Table structure for `account_types`
-- ----------------------------
DROP TABLE IF EXISTS `account_types`;
CREATE TABLE `account_types` (
  `acc_types_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `inc_when_debit` int(2) NOT NULL,
  PRIMARY KEY (`acc_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of account_types
-- ----------------------------
INSERT INTO `account_types` VALUES ('1', 'Revenue(Main)', '0');
INSERT INTO `account_types` VALUES ('2', 'Revenue(Side)', '0');
INSERT INTO `account_types` VALUES ('3', 'Expenses', '1');
INSERT INTO `account_types` VALUES ('4', 'Assets(Non-Current)', '1');
INSERT INTO `account_types` VALUES ('5', 'Assets(Current)', '1');
INSERT INTO `account_types` VALUES ('6', 'Liabilities(Current)', '0');
INSERT INTO `account_types` VALUES ('7', 'Liabilities(Non-Current)', '0');
INSERT INTO `account_types` VALUES ('8', 'Owner\'s Equity (Capital)', '0');
INSERT INTO `account_types` VALUES ('9', 'Owner\'s Equity (Drawing)', '0');
INSERT INTO `account_types` VALUES ('10', 'Contra (Current Assets)', '0');
INSERT INTO `account_types` VALUES ('11', 'Non-Current Asset', '0');

-- ----------------------------
-- Table structure for `journals`
-- ----------------------------
DROP TABLE IF EXISTS `journals`;
CREATE TABLE `journals` (
  `journal_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_date` date DEFAULT NULL,
  `description` longtext,
  `ledger_id` bigint(20) DEFAULT NULL,
  `is_archived` int(2) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of journals
-- ----------------------------
INSERT INTO `journals` VALUES ('1', '2016-01-01', 'Journal For January\r\n', '0', '0');
INSERT INTO `journals` VALUES ('2', '2016-02-01', 'Journal For February\r\n', '0', '0');

-- ----------------------------
-- Table structure for `journal_details`
-- ----------------------------
DROP TABLE IF EXISTS `journal_details`;
CREATE TABLE `journal_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) DEFAULT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_debit` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of journal_details
-- ----------------------------
INSERT INTO `journal_details` VALUES ('1', '3002', '16011', '2000', '1');
INSERT INTO `journal_details` VALUES ('2', '1001', '16011', '2000', '0');
INSERT INTO `journal_details` VALUES ('3', '1001', '16021', '2300', '1');
INSERT INTO `journal_details` VALUES ('4', '1003', '16021', '2300', '0');
INSERT INTO `journal_details` VALUES ('5', '3001', '16022', '500', '1');
INSERT INTO `journal_details` VALUES ('6', '1001', '16022', '500', '0');
INSERT INTO `journal_details` VALUES ('7', '1001', '16012', '10300', '1');
INSERT INTO `journal_details` VALUES ('8', '5001', '16012', '10300', '0');
INSERT INTO `journal_details` VALUES ('9', '3003', '16013', '4000', '1');
INSERT INTO `journal_details` VALUES ('10', '1001', '16013', '4000', '0');
INSERT INTO `journal_details` VALUES ('11', '1001', '16023', '5000', '1');
INSERT INTO `journal_details` VALUES ('12', '5002', '16023', '5000', '0');
INSERT INTO `journal_details` VALUES ('13', '1001', '16014', '200', '1');
INSERT INTO `journal_details` VALUES ('14', '5001', '16014', '200', '0');

-- ----------------------------
-- Table structure for `journal_entries`
-- ----------------------------
DROP TABLE IF EXISTS `journal_entries`;
CREATE TABLE `journal_entries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_entry_no` bigint(20) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `date_of_entry` date NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of journal_entries
-- ----------------------------
INSERT INTO `journal_entries` VALUES ('1', '16011', '1', '2016-01-04', 'Payed Utilites');
INSERT INTO `journal_entries` VALUES ('2', '16021', '2', '2016-08-17', 'Recieved cash');
INSERT INTO `journal_entries` VALUES ('3', '16022', '2', '2016-09-02', 'Payed Salaries');
INSERT INTO `journal_entries` VALUES ('4', '16012', '1', '2016-09-07', 'Income');
INSERT INTO `journal_entries` VALUES ('5', '16013', '1', '2016-09-27', 'Payed For Supplies');
INSERT INTO `journal_entries` VALUES ('6', '16023', '2', '2016-09-13', 'Recieved Sales INcome');
INSERT INTO `journal_entries` VALUES ('7', '16014', '1', '2016-09-05', 'xx');

-- ----------------------------
-- Table structure for `ledgers`
-- ----------------------------
DROP TABLE IF EXISTS `ledgers`;
CREATE TABLE `ledgers` (
  `ledger_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ledgers
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `full_name` longtext,
  `username` longtext,
  `password` longtext,
  `user_type` varchar(50) DEFAULT NULL,
  `is_deleted` varchar(50) DEFAULT NULL,
  `is_logged_in` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Peter', 'admin', '3dVoJ2bvdLynZysmiFxCaVySFMONfzv+IZKwJuE14wU=', 'admin', '0', '1');
INSERT INTO `users` VALUES ('2', 'Lawrenc', 'admin1', 'UQ6ZD4B3CjZPSiaMt1Ch185x2vRjKHFTbNzi4O9SNS8=', 'admin', '0', '0');
INSERT INTO `users` VALUES ('3', 'SAd', 'New', 'Tqar+gfCChdecU326IJE42EGTCf2hhCrRgsptasdx98=', 'Administrator', '0', '0');

-- ----------------------------
-- View structure for `vw_chartacc`
-- ----------------------------
DROP VIEW IF EXISTS `vw_chartacc`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_chartacc` AS select `accounts`.`acc_id` AS `acc_id`,`accounts`.`account_name` AS `account_name`,`account_types`.`name` AS `name`,`accounts`.`is_deleted` AS `is_deleted` from (`accounts` join `account_types` on((`accounts`.`type` = `account_types`.`acc_types_id`)));

-- ----------------------------
-- View structure for `vw_journals`
-- ----------------------------
DROP VIEW IF EXISTS `vw_journals`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_journals` AS select `journals`.`journal_id` AS `journal_id`,`journals`.`journal_date` AS `journal_date`,`journals`.`description` AS `description`,`journals`.`is_archived` AS `is_archived` from `journals`;

-- ----------------------------
-- Procedure structure for `getEntries`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getEntries`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getEntries`(IN `journal_var` INT)
    NO SQL
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
						where journal_entries.journal_id=journal_var
;;
DELIMITER ;
