-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Версія сервера:               5.7.25 - MySQL Community Server (GPL)
-- ОС сервера:                   Win64
-- HeidiSQL Версія:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for apartments_db
CREATE DATABASE IF NOT EXISTS `apartments_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `apartments_db`;

-- Dumping structure for таблиця apartments_db.apartments
CREATE TABLE IF NOT EXISTS `apartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `total_area` float NOT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `apartments_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apartments_db.apartments: ~0 rows (приблизно)
/*!40000 ALTER TABLE `apartments` DISABLE KEYS */;
INSERT INTO `apartments` (`id`, `type_id`, `total_area`, `total_price`) VALUES
	(1, 4, 82, 3090000000),
	(2, 5, 50, 240000000),
	(3, 4, 74, 1776000),
	(4, 3, 86, 2580000),
	(5, 3, 53, 1060000),
	(6, 2, 45, 1530000),
	(7, 4, 79, 1998740),
	(8, 3, 45, 900000),
	(9, 6, 128, 5120000),
	(19, 3, 45, 1080000),
	(20, 4, 67, 2278000),
	(21, 3, 56, 2520000),
	(22, 3, 78, 2340000),
	(23, 1, 56, 1680000),
	(24, 6, 90, 3060000),
	(25, 4, 89, 890000),
	(26, 3, 45, 1080000),
	(27, 3, 67, 670000),
	(28, 5, 78, 2652000),
	(29, 5, 67, 2412000),
	(30, 3, 67, 2278000),
	(31, 3, 50, 500000),
	(32, 3, 40, 1200000),
	(33, 7, 180, 3600000),
	(34, 8, 128, 2560000),
	(35, 4, 67, 707520),
	(36, 3, 56, 2240000),
	(37, 2, 45, 450000);
/*!40000 ALTER TABLE `apartments` ENABLE KEYS */;

-- Dumping structure for таблиця apartments_db.apartments_type
CREATE TABLE IF NOT EXISTS `apartments_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apartments_db.apartments_type: ~0 rows (приблизно)
/*!40000 ALTER TABLE `apartments_type` DISABLE KEYS */;
INSERT INTO `apartments_type` (`id`, `name`) VALUES
	(1, 'Студия'),
	(2, '1к'),
	(3, '2к'),
	(4, '3к'),
	(5, '4к'),
	(6, '5к'),
	(7, '5к двухуровневая'),
	(8, '6к двухуровневая');
/*!40000 ALTER TABLE `apartments_type` ENABLE KEYS */;

-- Dumping structure for таблиця apartments_db.houses
CREATE TABLE IF NOT EXISTS `houses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `residential_com_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `residential_com_id` (`residential_com_id`),
  CONSTRAINT `houses_ibfk_1` FOREIGN KEY (`residential_com_id`) REFERENCES `residential_complexes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apartments_db.houses: ~0 rows (приблизно)
/*!40000 ALTER TABLE `houses` DISABLE KEYS */;
INSERT INTO `houses` (`id`, `name`, `residential_com_id`) VALUES
	(1, 'Очередь 1 Дом 1', 1),
	(2, 'ул. Липковского 37', 1),
	(3, 'Очередь 2 Дом 1', 1),
	(10, 'Дом 1', 5),
	(11, 'Дом 2', 5),
	(12, 'ул. Ломоносова, 75а', 5),
	(13, 'Очередь 1 Дом 1', 6),
	(14, 'Очередь 1 Дом 2', 6),
	(15, 'Очередь 1 Дом 3', 6),
	(16, 'Дом 1', 7),
	(17, 'Дом 2', 7),
	(18, 'ул. Борщаговская 37', 8);
/*!40000 ALTER TABLE `houses` ENABLE KEYS */;

-- Dumping structure for таблиця apartments_db.houses_apartments
CREATE TABLE IF NOT EXISTS `houses_apartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `house_id` (`house_id`),
  KEY `apartment_id` (`apartment_id`),
  CONSTRAINT `houses_apartments_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `houses_apartments_ibfk_2` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apartments_db.houses_apartments: ~0 rows (приблизно)
/*!40000 ALTER TABLE `houses_apartments` DISABLE KEYS */;
INSERT INTO `houses_apartments` (`id`, `house_id`, `apartment_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 1, 3),
	(4, 2, 3),
	(5, 1, 4),
	(6, 2, 4),
	(7, 1, 5),
	(8, 2, 5),
	(9, 3, 5),
	(10, 1, 6),
	(11, 2, 6),
	(12, 3, 6),
	(13, 1, 7),
	(14, 2, 7),
	(15, 3, 7),
	(16, 1, 8),
	(17, 2, 8),
	(18, 3, 8),
	(19, 1, 9),
	(34, 10, 19),
	(35, 11, 19),
	(36, 12, 19),
	(37, 10, 20),
	(38, 11, 20),
	(39, 12, 20),
	(40, 10, 21),
	(41, 11, 21),
	(42, 12, 21),
	(43, 10, 22),
	(44, 11, 22),
	(45, 12, 22),
	(46, 11, 23),
	(47, 13, 24),
	(48, 13, 25),
	(49, 14, 25),
	(50, 13, 26),
	(51, 14, 26),
	(52, 15, 26),
	(53, 13, 27),
	(54, 14, 27),
	(55, 15, 27),
	(56, 13, 28),
	(57, 14, 28),
	(58, 15, 28),
	(59, 13, 29),
	(60, 14, 29),
	(61, 15, 29),
	(62, 16, 30),
	(63, 17, 30),
	(64, 16, 31),
	(65, 17, 31),
	(66, 16, 32),
	(67, 17, 32),
	(68, 16, 33),
	(69, 17, 33),
	(70, 16, 34),
	(71, 17, 34),
	(72, 18, 35),
	(73, 18, 36),
	(74, 18, 37);
/*!40000 ALTER TABLE `houses_apartments` ENABLE KEYS */;

-- Dumping structure for таблиця apartments_db.residential_complexes
CREATE TABLE IF NOT EXISTS `residential_complexes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apartments_db.residential_complexes: ~0 rows (приблизно)
/*!40000 ALTER TABLE `residential_complexes` DISABLE KEYS */;
INSERT INTO `residential_complexes` (`id`, `name`, `city`) VALUES
	(1, 'Сонячна Брама', 'Киев'),
	(5, 'Echo Park', 'Петропавловская Борщаговка'),
	(6, 'Sky', 'Киев'),
	(7, 'Svitlo Park', 'Киев'),
	(8, 'Campus', 'Киев');
/*!40000 ALTER TABLE `residential_complexes` ENABLE KEYS */;

-- Dumping structure for таблиця apartments_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apartments_db.user: ~0 rows (приблизно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `login`, `password`, `is_admin`) VALUES
	(1, 'admin', '$2y$13$VK09lkIQMoRbjjgvrLGC4.3M.U1Bz0qF6Rlh9RL9D3LyS2GdnTLyO', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
