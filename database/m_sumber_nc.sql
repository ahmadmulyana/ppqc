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

-- Dumping structure for table ppqc.m_sumber_nc
DROP TABLE IF EXISTS `m_sumber_nc`;
CREATE TABLE IF NOT EXISTS `m_sumber_nc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sumber_nc` varchar(100) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ppqc.m_sumber_nc: ~4 rows (approximately)
DELETE FROM `m_sumber_nc`;
/*!40000 ALTER TABLE `m_sumber_nc` DISABLE KEYS */;
INSERT INTO `m_sumber_nc` (`id`, `sumber_nc`, `tgl_input`, `created_by`) VALUES
	(1, 'Pek. Vendor', '2022-06-14', 1),
	(2, 'Pek. Internal', '2022-03-11', 1),
	(3, 'Cust. Complaint', '2022-03-11', 1),
	(4, 'Material SBO', '2022-03-11', 1);
/*!40000 ALTER TABLE `m_sumber_nc` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
