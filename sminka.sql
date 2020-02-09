/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.6-MariaDB : Database - sminka
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sminka` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sminka`;

/*Table structure for table `korisnik` */

DROP TABLE IF EXISTS `korisnik`;

CREATE TABLE `korisnik` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ime` varchar(30) DEFAULT NULL,
  `prezime` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `sifra` varchar(30) DEFAULT NULL,
  `uloga` bigint(20) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `uloga` (`uloga`),
  CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`uloga`) REFERENCES `uloga` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `korisnik` */

insert  into `korisnik`(`id`,`ime`,`prezime`,`email`,`username`,`sifra`,`uloga`) values 
(1,'pera','pera','pera','perapera','pera',1),
(2,'zika','zika','zika','zika','zika',1),
(3,'milena','milena','milena','milena','milena',1),
(5,'admin','admin','admin','admin','admin',2),
(6,'Jana','Milojevic','jana@gmail.com','milojevicjana18','jana',1),
(7,'Pera','Peric','peraperic@gmail.com','peraperic','pera',1);

/*Table structure for table `narudzbina` */

DROP TABLE IF EXISTS `narudzbina`;

CREATE TABLE `narudzbina` (
  `kupac` bigint(20) NOT NULL,
  `sminka` bigint(20) NOT NULL,
  `kolicina` int(11) DEFAULT NULL,
  `naruceno` int(11) DEFAULT 0,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kupac`,`sminka`,`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `narudzbina` */

insert  into `narudzbina`(`kupac`,`sminka`,`kolicina`,`naruceno`,`id`) values 
(5,1,5,1,1),
(5,1,2,1,2),
(5,6,5,1,3);

/*Table structure for table `pol` */

DROP TABLE IF EXISTS `pol`;

CREATE TABLE `pol` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pol` */

insert  into `pol`(`id`,`naziv`) values 
(1,'puder'),
(2,'BB krema'),
(3,'CC krema'),
(4,'Korektor');

/*Table structure for table `sminka` */

DROP TABLE IF EXISTS `sminka`;

CREATE TABLE `sminka` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) DEFAULT NULL,
  `slika` varchar(90) DEFAULT NULL,
  `cena` double DEFAULT NULL,
  `pol` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pol` (`pol`),
  CONSTRAINT `sminka_ibfk_1` FOREIGN KEY (`pol`) REFERENCES `pol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sminka` */

insert  into `sminka`(`id`,`naziv`,`slika`,`cena`,`pol`) values 
(8,'NARS foundation// rad 01','../img/1.jpg',5000,1),
(9,'YSL //foundation 01','../img/2.jpg',4500,1),
(10,'URBANDECAY 02','../img/3.jpg',5000,1),
(11,'MUF 04','../img/4.jpg',5000,1);

/*Table structure for table `uloga` */

DROP TABLE IF EXISTS `uloga`;

CREATE TABLE `uloga` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `uloga` */

insert  into `uloga`(`id`,`naziv`) values 
(1,'kupac'),
(2,'admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
