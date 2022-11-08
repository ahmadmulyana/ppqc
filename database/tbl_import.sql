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

-- Dumping structure for table pphadir_new.tbl_import
DROP TABLE IF EXISTS `tbl_import`;
CREATE TABLE IF NOT EXISTS `tbl_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nrp` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(150) DEFAULT NULL,
  `keterangan` text,
  `is_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table pphadir_new.tbl_import: ~0 rows (approximately)
DELETE FROM `tbl_import`;
/*!40000 ALTER TABLE `tbl_import` DISABLE KEYS */;
INSERT INTO `tbl_import` (`id`, `nrp`, `nama_lengkap`, `keterangan`, `is_status`) VALUES
	(1, '17061981', 'EKA RIANA', 'Nama Jabatan tidak terdaftar di master jabatan', 0),
	(2, '17061981', 'EKA RIANA', 'Nama Unit tidak terdaftar di master unit', 0),
	(3, '17061981', 'EKA RIANA', 'Nama Divisi tidak terdaftar di master Divisi', 0),
	(4, '17061981', 'EKA RIANA', 'Data lengkap sesuai dengan format ...', 1),
	(5, '17061981', 'EKA RIANA', 'Data lengkap sesuai dengan format ...', 1),
	(6, '17061981', 'EKA RIANA', 'Data lengkap sesuai dengan format ...', 1);
/*!40000 ALTER TABLE `tbl_import` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
