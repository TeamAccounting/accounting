/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 10.1.21-MariaDB : Database - accounting1
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

/*Table structure for table `available_balance` */

DROP TABLE IF EXISTS `available_balance`;

CREATE TABLE `available_balance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `available_balance` */

insert  into `available_balance`(`id`,`amount`,`year`,`is_deleted`) values 
(1,'700','2017',0),
(3,'35','2018',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
