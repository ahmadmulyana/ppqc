-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table ppqc.tr_observasi
DROP TABLE IF EXISTS `tr_observasi`;
CREATE TABLE IF NOT EXISTS `tr_observasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `pekerjaan_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `dampak_masalah` text,
  `uraian_potensi_masalah` text,
  `created_by` int(11) DEFAULT NULL,
  `level` enum('1','2','3','4') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table ppqc.tr_observasi: ~4 rows (approximately)
DELETE FROM `tr_observasi`;
/*!40000 ALTER TABLE `tr_observasi` DISABLE KEYS */;
INSERT INTO `tr_observasi` (`id`, `project_id`, `pekerjaan_id`, `tanggal`, `dampak_masalah`, `uraian_potensi_masalah`, `created_by`, `level`) VALUES
	(1, 13, 3, '2022-03-25', 'Kebocoran', 'Penyebab kebocoran', 1, '3'),
	(2, 18, 1, '2022-03-29', 'Dampak Masalah', 'Potensi Masalah', 8, NULL),
	(3, 18, 1, '2022-03-30', 'Dampak Masalah', 'Uraian potensi masalah', 8, NULL),
	(6, 18, 4, '2022-05-20', 'Masalah besar', 'Akan terjadi kebakaran hutan', 8, NULL);
/*!40000 ALTER TABLE `tr_observasi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
