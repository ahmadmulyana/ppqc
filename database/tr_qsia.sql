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

-- Dumping structure for table ppqc.tr_nilai_qsia
DROP TABLE IF EXISTS `tr_nilai_qsia`;
CREATE TABLE IF NOT EXISTS `tr_nilai_qsia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_id` int(11) DEFAULT NULL,
  `nilai_item_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT '-1',
  `nilai_maksimal` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tabul` char(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- Dumping data for table ppqc.tr_nilai_qsia: ~84 rows (approximately)
DELETE FROM `tr_nilai_qsia`;
/*!40000 ALTER TABLE `tr_nilai_qsia` DISABLE KEYS */;
INSERT INTO `tr_nilai_qsia` (`id`, `nilai_id`, `nilai_item_id`, `nilai`, `nilai_maksimal`, `user_id`, `project_id`, `tanggal`, `tabul`) VALUES
	(1, 1, 1, 1, 4, 8, 18, '2022-06-12', '202206'),
	(2, 1, 2, 1, 4, 8, 18, '2022-06-12', '202206'),
	(3, 1, 3, 1, 4, 8, 18, '2022-06-12', '202206'),
	(4, 1, 4, 1, 4, 8, 18, '2022-06-12', '202206'),
	(5, 1, 5, 1, 4, 8, 18, '2022-06-12', '202206'),
	(6, 1, 6, 1, 4, 8, 18, '2022-06-12', '202206'),
	(7, 1, 7, 1, 4, 8, 18, '2022-06-12', '202206'),
	(8, 1, 8, 1, 4, 8, 18, '2022-06-12', '202206'),
	(9, 2, 9, -1, 0, 8, 18, NULL, '202206'),
	(10, 2, 10, -1, 0, 8, 18, NULL, '202206'),
	(11, 2, 11, -1, 0, 8, 18, NULL, '202206'),
	(12, 2, 12, 1, 4, 8, 18, '2022-06-13', '202206'),
	(13, 2, 13, -1, 0, 8, 18, NULL, '202206'),
	(14, 2, 14, -1, 0, 8, 18, NULL, '202206'),
	(15, 2, 15, -1, 0, 8, 18, NULL, '202206'),
	(16, 2, 16, -1, 0, 8, 18, NULL, '202206'),
	(17, 3, 17, 3, 4, 8, 18, '2022-06-14', '202206'),
	(18, 3, 18, -1, 0, 8, 18, NULL, '202206'),
	(19, 3, 19, -1, 0, 8, 18, NULL, '202206'),
	(20, 3, 20, -1, 0, 8, 18, NULL, '202206'),
	(21, 3, 21, -1, 0, 8, 18, NULL, '202206'),
	(22, 3, 22, -1, 0, 8, 18, NULL, '202206'),
	(23, 3, 23, -1, 0, 8, 18, NULL, '202206'),
	(24, 3, 24, -1, 0, 8, 18, NULL, '202206'),
	(25, 3, 25, -1, 0, 8, 18, NULL, '202206'),
	(26, 3, 26, -1, 0, 8, 18, NULL, '202206'),
	(27, 3, 27, -1, 0, 8, 18, NULL, '202206'),
	(28, 3, 28, 4, 4, 8, 18, '2022-06-14', '202206'),
	(29, 4, 29, -1, 0, 8, 18, NULL, '202206'),
	(30, 4, 30, -1, 0, 8, 18, NULL, '202206'),
	(31, 4, 31, -1, 0, 8, 18, NULL, '202206'),
	(32, 4, 32, -1, 0, 8, 18, NULL, '202206'),
	(33, 4, 33, -1, 0, 8, 18, NULL, '202206'),
	(34, 4, 34, 4, 4, 8, 18, '2022-06-13', '202206'),
	(35, 4, 35, -1, 0, 8, 18, NULL, '202206'),
	(36, 5, 36, 3, 4, 8, 18, '2022-06-13', '202206'),
	(37, 5, 37, -1, 0, 8, 18, NULL, '202206'),
	(38, 5, 38, 0, 4, 8, 18, '2022-06-13', '202206'),
	(39, 5, 39, 1, 4, 8, 18, '2022-06-13', '202206'),
	(40, 5, 40, -1, 0, 8, 18, NULL, '202206'),
	(41, 5, 41, -1, 0, 8, 18, NULL, '202206'),
	(42, 5, 42, 3, 4, 8, 18, '2022-06-14', '202206'),
	(43, 1, 1, 1, 4, 8, 18, '2022-06-12', '202205'),
	(44, 1, 2, -1, 0, 8, 18, NULL, '202205'),
	(45, 1, 3, -1, 0, 8, 18, NULL, '202205'),
	(46, 1, 4, -1, 0, 8, 18, NULL, '202205'),
	(47, 1, 5, -1, 0, 8, 18, NULL, '202205'),
	(48, 1, 6, -1, 0, 8, 18, NULL, '202205'),
	(49, 1, 7, -1, 0, 8, 18, NULL, '202205'),
	(50, 1, 8, -1, 0, 8, 18, NULL, '202205'),
	(51, 2, 9, 3, 4, 8, 18, '2022-06-14', '202205'),
	(52, 2, 10, 3, 4, 8, 18, '2022-06-14', '202205'),
	(53, 2, 11, -1, 0, 8, 18, NULL, '202205'),
	(54, 2, 12, -1, 0, 8, 18, NULL, '202205'),
	(55, 2, 13, -1, 0, 8, 18, NULL, '202205'),
	(56, 2, 14, -1, 0, 8, 18, NULL, '202205'),
	(57, 2, 15, -1, 0, 8, 18, NULL, '202205'),
	(58, 2, 16, 1, 4, 8, 18, '2022-06-14', '202205'),
	(59, 3, 17, -1, 0, 8, 18, NULL, '202205'),
	(60, 3, 18, -1, 0, 8, 18, NULL, '202205'),
	(61, 3, 19, 1, 4, 8, 18, '2022-06-14', '202205'),
	(62, 3, 20, -1, 0, 8, 18, NULL, '202205'),
	(63, 3, 21, -1, 0, 8, 18, NULL, '202205'),
	(64, 3, 22, -1, 0, 8, 18, NULL, '202205'),
	(65, 3, 23, -1, 0, 8, 18, NULL, '202205'),
	(66, 3, 24, 3, 4, 8, 18, '2022-06-14', '202205'),
	(67, 3, 25, -1, 0, 8, 18, NULL, '202205'),
	(68, 3, 26, 1, 4, 8, 18, '2022-06-14', '202205'),
	(69, 3, 27, -1, 0, 8, 18, NULL, '202205'),
	(70, 3, 28, 1, 4, 8, 18, '2022-06-14', '202205'),
	(71, 4, 29, -1, 0, 8, 18, NULL, '202205'),
	(72, 4, 30, -1, 0, 8, 18, NULL, '202205'),
	(73, 4, 31, -1, 0, 8, 18, NULL, '202205'),
	(74, 4, 32, 3, 4, 8, 18, '2022-06-14', '202205'),
	(75, 4, 33, -1, 0, 8, 18, NULL, '202205'),
	(76, 4, 34, 1, 4, 8, 18, '2022-06-14', '202205'),
	(77, 4, 35, -1, 0, 8, 18, NULL, '202205'),
	(78, 5, 36, -1, 0, 8, 18, NULL, '202205'),
	(79, 5, 37, -1, 0, 8, 18, NULL, '202205'),
	(80, 5, 38, -1, 0, 8, 18, NULL, '202205'),
	(81, 5, 39, -1, 0, 8, 18, NULL, '202205'),
	(82, 5, 40, -1, 0, 8, 18, NULL, '202205'),
	(83, 5, 41, -1, 0, 8, 18, NULL, '202205'),
	(84, 5, 42, 4, 4, 8, 18, '2022-06-12', '202205');
/*!40000 ALTER TABLE `tr_nilai_qsia` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;