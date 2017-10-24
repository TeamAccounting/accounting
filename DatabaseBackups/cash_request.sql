/*
SQLyog Community v12.2.0 (64 bit)
MySQL - 10.1.19-MariaDB : Database - accounting1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`accounting1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `accounting1`;

/*Table structure for table `cash_request` */

DROP TABLE IF EXISTS `cash_request`;

CREATE TABLE `cash_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request_by` bigint(20) NOT NULL,
  `journal_entry_no` bigint(20) DEFAULT NULL,
  `journal_id` bigint(20) DEFAULT NULL,
  `date_of_entry` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) DEFAULT '1',
  `approver_id` bigint(20) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `cash_request` */

insert  into `cash_request`(`id`,`request_by`,`journal_entry_no`,`journal_id`,`date_of_entry`,`description`,`status_id`,`approver_id`) values 
(1,0,17102,13,'2017-10-17','1111',1,0),
(2,1,17102,13,'2017-10-11','test',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
