/*
SQLyog Enterprise v12.4.3 (64 bit)
MySQL - 10.4.28-MariaDB : Database - lsp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama`,`keterangan`,`created_at`,`updated_at`) values 
(1,'Undangan','Kategori ini digunakan untuk surat yang bersifat undangan baik untuk kelurahan atau masyarakat kelurahan','2023-11-11 10:20:55','2023-11-11 18:47:13'),
(4,'Pemberitahuan','Kategori ini digunakan untuk surat yang sifatnya berupa pengumuman atau menginformasikan suatu perihal\r\n','2023-11-11 11:05:33',NULL),
(7,'Nota Dinas','Kategori ini digunakan untuk menyampaikan laporan, pemberitahuan, pernyataan, permintaan, atau penyampaian kepada pejabat lain.','2023-11-11 21:02:41',NULL);

/*Table structure for table `surat` */

DROP TABLE IF EXISTS `surat`;

CREATE TABLE `surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `surat` */

insert  into `surat`(`id`,`nomor`,`id_kategori`,`judul`,`file_name`,`created_at`,`updated_at`) values 
(34,'PD02',1,'undangan nikah','Surat-2023-11-11_12-05-02.pdf','2023-11-11 17:05:58','2023-11-11 18:05:02'),
(35,'PD03',4,'Informasi bantuan Bulan November dapat diambil secara kolektif di Kantor Kelurahan','Surat-2023-11-11_12-21-29.pdf','2023-11-11 18:21:29',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
