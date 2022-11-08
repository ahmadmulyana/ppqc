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

-- Dumping structure for table ppqc.tr_css_files
DROP TABLE IF EXISTS `tr_css_files`;
CREATE TABLE IF NOT EXISTS `tr_css_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `type_css` enum('1','2') DEFAULT '1',
  `lengkap` enum('1','2') DEFAULT '1',
  `nama_file` varchar(50) DEFAULT NULL,
  `nama_file_nilai` varchar(50) DEFAULT NULL,
  `files` varchar(50) DEFAULT NULL,
  `files_nilai` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `tanggal_nilai` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ppqc.tr_css_files: ~0 rows (approximately)
DELETE FROM `tr_css_files`;
/*!40000 ALTER TABLE `tr_css_files` DISABLE KEYS */;
INSERT INTO `tr_css_files` (`id`, `project_id`, `type_css`, `lengkap`, `nama_file`, `nama_file_nilai`, `files`, `files_nilai`, `tanggal`, `tanggal_nilai`) VALUES
	(1, 18, '1', '2', 'SPTJM SISWA(1).xlsx', 'SPTJM SISWA.xlsx', 'SPTJM SISWA(1).xlsx', 'SPTJM SISWA.xlsx', '2022-09-09 17:54:44', '2022-09-09 17:54:59');
/*!40000 ALTER TABLE `tr_css_files` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
