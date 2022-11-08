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

-- Dumping structure for table ppqc.tr_qa
DROP TABLE IF EXISTS `tr_qa`;
CREATE TABLE IF NOT EXISTS `tr_qa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `nama_project` varchar(200) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `pekerjaan_id` int(11) DEFAULT NULL,
  `nama_pekerjaan` varchar(200) DEFAULT NULL,
  `nama_vendor` varchar(200) DEFAULT NULL,
  `satuan_pekerjaan` varchar(50) DEFAULT NULL,
  `nilai_pekerjaan` int(11) DEFAULT NULL,
  `nc_pekerjaan` varchar(50) DEFAULT NULL,
  `koreksi` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tabul` char(6) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table ppqc.tr_qa: ~9 rows (approximately)
DELETE FROM `tr_qa`;
/*!40000 ALTER TABLE `tr_qa` DISABLE KEYS */;
INSERT INTO `tr_qa` (`id`, `project_id`, `nama_project`, `vendor_id`, `pekerjaan_id`, `nama_pekerjaan`, `nama_vendor`, `satuan_pekerjaan`, `nilai_pekerjaan`, `nc_pekerjaan`, `koreksi`, `tanggal`, `tabul`, `user_id`) VALUES
	(1, 18, NULL, 1, 1, 'CLEARING & GRUBING', 'PT. ABC', 'm2', 90, '30', 40, '2022-06-15', '202206', 8),
	(2, 18, NULL, 3, 1, 'CLEARING & GRUBING', 'PT. KURNIA ALAM', 'm2', 70, '10', 80, '2022-06-15', '202206', 8),
	(3, 18, NULL, 2, 3, 'BOILING', 'PT. HARIBIMA', 'm2', 70, '10', 10, '2022-06-15', '202206', 8),
	(4, 18, NULL, 2, 1, 'CLEARING & GRUBING', 'PT. HARIBIMA', 'm', 50, '40', 12, '2022-06-15', '202206', 8),
	(8, 18, NULL, 2, 3, 'BOILING', 'PT. HARIBIMA', 'm2', 70, '30', 10, '2022-06-15', '202206', 8),
	(9, 18, NULL, 3, 4, 'STONE COLUMN', 'PT. KURNIA ALAM', 'm2', 70, '10', 60, '2022-05-15', '202205', 8),
	(11, 18, NULL, 2, 4, 'STONE COLUMN', 'PT. HARIBIMA', 'm2', 90, '70', 78, '2022-05-15', '202205', 8),
	(12, 18, NULL, 3, 14, 'GALIAN TANAH', 'PT. KURNIA ALAM', 'm2', 90, '30', 70, '2022-05-15', '202205', 8),
	(15, 18, NULL, 3, 6, 'DYNAMIC COMPACTION', 'PT. KURNIA ALAM', 'm2', 40, '35', 20, NULL, NULL, 8);
/*!40000 ALTER TABLE `tr_qa` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;