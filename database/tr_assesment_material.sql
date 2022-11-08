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

-- Dumping structure for table ppqc.tr_assesment_material
DROP TABLE IF EXISTS `tr_assesment_material`;
CREATE TABLE IF NOT EXISTS `tr_assesment_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `nama_project` varchar(200) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `pekerjaan_id` int(11) DEFAULT NULL,
  `nama_pekerjaan` varchar(200) DEFAULT NULL,
  `nama_supplier` varchar(200) DEFAULT NULL,
  `satuan_pekerjaan` varchar(50) DEFAULT NULL,
  `nilai_pekerjaan` decimal(6,2) DEFAULT '0.00',
  `nc_pekerjaan` decimal(6,2) DEFAULT '0.00',
  `user_id` int(11) DEFAULT NULL,
  `koreksi` decimal(6,2) DEFAULT '0.00',
  `tanggal` date DEFAULT NULL,
  `tabul` char(6) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table ppqc.tr_assesment_material: ~3 rows (approximately)
DELETE FROM `tr_assesment_material`;
/*!40000 ALTER TABLE `tr_assesment_material` DISABLE KEYS */;
INSERT INTO `tr_assesment_material` (`id`, `project_id`, `nama_project`, `supplier_id`, `pekerjaan_id`, `nama_pekerjaan`, `nama_supplier`, `satuan_pekerjaan`, `nilai_pekerjaan`, `nc_pekerjaan`, `user_id`, `koreksi`, `tanggal`, `tabul`) VALUES
	(4, 18, NULL, 3, 12, 'BEKISTING', 'PT. BPMN', 'm2', 70.00, 30.00, 8, 45.00, '2022-06-15', '202206'),
	(5, 18, NULL, 1, 11, 'PEMBESIAN', 'PT. INDOTAMA', 'm2', 70.00, 10.00, 8, 50.00, '2022-06-15', '202206'),
	(6, 18, NULL, 2, 12, 'BEKISTING', 'PT. JANATA', 'm2', 30.00, 10.00, 8, 22.00, '2022-06-15', '202206');
/*!40000 ALTER TABLE `tr_assesment_material` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
