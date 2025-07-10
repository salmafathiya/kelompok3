/*
SQLyog Ultimate v8.61 
MySQL - 5.5.5-10.4.32-MariaDB : Database - kelompok3
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kelompok3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `kelompok3`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values (1,'2025-06-12-190455','App\\Database\\Migrations\\User','default','App',1749730061,1),(2,'2025-06-12-190555','App\\Database\\Migrations\\Product','default','App',1749730061,1),(3,'2025-06-12-190655','App\\Database\\Migrations\\Transaction','default','App',1749730061,1),(4,'2025-06-12-190755','App\\Database\\Migrations\\TransactionDetail','default','App',1749730152,2);

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `product` */

insert  into `product`(`id`,`nama`,`harga`,`jumlah`,`foto`,`created_at`,`updated_at`) values (1,'ASUS TUF A15 FA506NF',10899000,5,'asus_tuf_a15.jpg','2025-06-12 12:16:33',NULL),(2,'Asus Vivobook 14 A1404ZA',6899000,7,'asus_vivobook_14.jpg','2025-06-12 12:16:33',NULL),(3,'Lenovo IdeaPad Slim 3-14IAU7',6299000,5,'lenovo_idepad_slim_3.jpg','2025-06-12 12:16:33',NULL),(4,'laptop lenovo thinkpad',4599000,5,'1749746663_29fa3a29402587473cf6.jpg','2025-06-12 16:36:59','2025-06-12 16:44:23');

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` double DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaction` */

insert  into `transaction`(`id`,`username`,`total_harga`,`alamat`,`ongkir`,`status`,`created_at`,`updated_at`) values (1,'zamira30',10911000,'Jl Salam Indah No 24',12000,0,'2025-06-13 07:14:45','2025-06-13 07:14:45'),(2,'zamira30',6899000,'Jl Baskoro Raya No 61',0,0,'2025-06-13 08:05:00','2025-06-13 08:05:00');

/*Table structure for table `transaction_detail` */

DROP TABLE IF EXISTS `transaction_detail`;

CREATE TABLE `transaction_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `jumlah` int(5) NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaction_detail` */

insert  into `transaction_detail`(`id`,`transaction_id`,`product_id`,`jumlah`,`diskon`,`subtotal_harga`,`created_at`,`updated_at`) values (1,1,1,1,0,10899000,'2025-06-13 07:14:45','2025-06-13 07:14:45'),(2,2,2,1,0,6899000,'2025-06-13 08:05:00','2025-06-13 08:05:00');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`email`,`password`,`role`,`created_at`,`updated_at`) values (1,'salmaa','anasyidah@simanjuntak.in','$2y$10$tTmIbqS2mln2J10PJu0e6e6Og.EprpxHRkBQPt/LRgawfFyuOl8Qy','admin','2025-06-12 12:19:11',NULL),(2,'fathiya','opradana@megantara.in','$2y$10$yKhmtp7G.uAYcbWYWsOnL.6rHAnKCguVBtWKarrY4jUwX.NMO7Y32','guest','2025-06-12 12:19:11',NULL),(3,'marcellinus','vicky75@purwanti.biz.id','$2y$10$IEkuGjd/PlZeixvEclpT1ughXJohI8Iigz/WAIxViImJ8/uqjxDiO','admin','2025-06-12 12:19:11',NULL),(4,'anggaa','rama36@usada.name','$2y$10$a9L8CkcnnggEUzIm5sCu2O4F3VyNtrGwGihkyTbrsoHNaW5agPPu2','guest','2025-06-12 12:19:12',NULL),(5,'febianti','novi.tamba@gmail.com','$2y$10$TM1bvsOG/ZrBeG7j2gzateolcs.XgBsfGhDPNozA2XCpvwdrQ95nK','guest','2025-06-12 12:19:12',NULL),(6,'jessica','warsa05@prasetya.ac.id','$2y$10$6/kWWsbJfTwxld4RdrNcw.xMZT3VKOMnx/dcmB0ABZbkeOsUmTahS','admin','2025-06-12 12:19:12',NULL),(7,'liaaaa','vivi.prasetya@hutagalung.info','$2y$10$pnqqZOZy4ZAo69nZYCfnFuhINAjscP8Q3CSaP.YmV1klnfDA1trzG','admin','2025-06-12 12:19:12',NULL),(8,'rulyyy','kalim.adriansyah@yahoo.co.id','$2y$10$A6mt1wmIWjNY3OaDU4Tod.TU4zXk4bzwJP.NGe0pxhJgaVwF.9V8C','admin','2025-06-12 12:19:12',NULL),(9,'ekaaaa','najam81@susanti.desa.id','$2y$10$s7r9/1t.HncyCT7Tgs6hpeVgzH59ncMpArsN7aFMvBkNzn6Z4/m7G','guest','2025-06-12 12:19:12',NULL),(10,'handika','halima.halim@wijaya.id','$2y$10$AlGIV9HNJVvvu9Y1CyVuUOtuzu7QsWWVjOyVCsPfW4PhY0SK.zxwK','guest','2025-06-12 12:19:12',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
