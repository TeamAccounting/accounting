-- MySQL dump 10.16  Distrib 10.1.9-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: accounting
-- ------------------------------------------------------
-- Server version	10.1.9-MariaDB

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
-- Table structure for table `account_types`
--

DROP TABLE IF EXISTS `account_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_types` (
  `acc_types_id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `inc_when_debit` int(2) NOT NULL,
  PRIMARY KEY (`acc_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_types`
--

LOCK TABLES `account_types` WRITE;
/*!40000 ALTER TABLE `account_types` DISABLE KEYS */;
INSERT INTO `account_types` VALUES (1,'Revenue(Main)',0),(2,'Revenue(Side)',0),(3,'Expenses',1),(4,'Assets(Non-Current)',1),(5,'Assets(Current)',1),(6,'Liabilities(Current)',0),(7,'Liabilities(Non-Current)',0),(8,'Owner\'s Equity (Capital)',0),(9,'Owner\'s Equity (Drawing)',0),(10,'Contra (Current Assets)',0),(11,'Non-Current Asset',0);
/*!40000 ALTER TABLE `account_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `acc_id` bigint(20) NOT NULL,
  `account_name` longtext,
  `type` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1001,'Cash',5,0),(1002,'Petty Cash',5,0),(1003,'Accounts Recievable',5,0),(3001,'Salaries Expenses',3,0),(3002,'Utilities Expenses',3,0),(3003,'Supplies Expense',3,0),(4001,'Accounts Payable',6,0),(5001,'Service Income',1,0),(5002,'Sales',1,0),(7900,'Test',11,1);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journal_details`
--

DROP TABLE IF EXISTS `journal_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journal_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) DEFAULT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `is_debit` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journal_details`
--

LOCK TABLES `journal_details` WRITE;
/*!40000 ALTER TABLE `journal_details` DISABLE KEYS */;
INSERT INTO `journal_details` VALUES (1,3002,16011,2000,1),(2,1001,16011,2000,0),(3,1001,16021,2300,1),(4,1003,16021,2300,0),(5,3001,16022,500,1),(6,1001,16022,500,0),(7,1001,16012,10300,1),(8,5001,16012,10300,0),(9,3003,16013,4000,1),(10,1001,16013,4000,0),(11,1001,16023,5000,1),(12,5002,16023,5000,0),(13,1001,16014,200,1),(14,5001,16014,200,0);
/*!40000 ALTER TABLE `journal_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journal_entries`
--

DROP TABLE IF EXISTS `journal_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journal_entries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_entry_no` bigint(20) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `date_of_entry` date NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journal_entries`
--

LOCK TABLES `journal_entries` WRITE;
/*!40000 ALTER TABLE `journal_entries` DISABLE KEYS */;
INSERT INTO `journal_entries` VALUES (1,16011,1,'2016-01-04','Payed Utilites'),(2,16021,2,'2016-08-17','Recieved cash'),(3,16022,2,'2016-09-02','Payed Salaries'),(4,16012,1,'2016-09-07','Income'),(5,16013,1,'2016-09-27','Payed For Supplies'),(6,16023,2,'2016-09-13','Recieved Sales INcome'),(7,16014,1,'2016-09-05','xx');
/*!40000 ALTER TABLE `journal_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journals`
--

DROP TABLE IF EXISTS `journals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journals` (
  `journal_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_date` date DEFAULT NULL,
  `description` longtext,
  `ledger_id` bigint(20) DEFAULT NULL,
  `is_archived` int(2) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journals`
--

LOCK TABLES `journals` WRITE;
/*!40000 ALTER TABLE `journals` DISABLE KEYS */;
INSERT INTO `journals` VALUES (1,'2016-01-01','Journal For January\r\n',0,0),(2,'2016-02-01','Journal For February\r\n',0,0);
/*!40000 ALTER TABLE `journals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ledgers`
--

DROP TABLE IF EXISTS `ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ledgers` (
  `ledger_id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ledgers`
--

LOCK TABLES `ledgers` WRITE;
/*!40000 ALTER TABLE `ledgers` DISABLE KEYS */;
/*!40000 ALTER TABLE `ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `full_name` longtext,
  `username` longtext,
  `password` longtext,
  `user_type` varchar(50) DEFAULT NULL,
  `is_deleted` varchar(50) DEFAULT NULL,
  `is_logged_in` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Peter','admin','3dVoJ2bvdLynZysmiFxCaVySFMONfzv+IZKwJuE14wU=','admin','0',1),(2,'Lawrenc','admin1','UQ6ZD4B3CjZPSiaMt1Ch185x2vRjKHFTbNzi4O9SNS8=','admin','0',0),(3,'SAd','New','Tqar+gfCChdecU326IJE42EGTCf2hhCrRgsptasdx98=','Administrator','0',0),(4,'Elbert','eom','7plHrZPR6w5BUi0+Ftja+tlqbIUDsbvFVdTL2eMTwNw=','Accountant','0',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_chartacc`
--

DROP TABLE IF EXISTS `vw_chartacc`;
/*!50001 DROP VIEW IF EXISTS `vw_chartacc`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_chartacc` (
  `acc_id` tinyint NOT NULL,
  `account_name` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `is_deleted` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_journals`
--

DROP TABLE IF EXISTS `vw_journals`;
/*!50001 DROP VIEW IF EXISTS `vw_journals`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_journals` (
  `journal_id` tinyint NOT NULL,
  `journal_date` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `is_archived` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'accounting'
--
/*!50003 DROP PROCEDURE IF EXISTS `getEntries` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
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
						where journal_entries.journal_id=journal_var ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vw_chartacc`
--

/*!50001 DROP TABLE IF EXISTS `vw_chartacc`*/;
/*!50001 DROP VIEW IF EXISTS `vw_chartacc`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_chartacc` AS select `accounts`.`acc_id` AS `acc_id`,`accounts`.`account_name` AS `account_name`,`account_types`.`name` AS `name`,`accounts`.`is_deleted` AS `is_deleted` from (`accounts` join `account_types` on((`accounts`.`type` = `account_types`.`acc_types_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_journals`
--

/*!50001 DROP TABLE IF EXISTS `vw_journals`*/;
/*!50001 DROP VIEW IF EXISTS `vw_journals`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_journals` AS select `journals`.`journal_id` AS `journal_id`,`journals`.`journal_date` AS `journal_date`,`journals`.`description` AS `description`,`journals`.`is_archived` AS `is_archived` from `journals` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-15 13:20:27
