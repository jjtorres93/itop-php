/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for test
DROP DATABASE IF EXISTS `db_Drusa`;
CREATE DATABASE IF NOT EXISTS `db_Drusa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `db_Drusa`;

-- Dumping structure for table test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_pass` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'default md5 pass: 1234',
  `status` tinyint(4) DEFAULT 0 COMMENT '0="inactive",\r\n1="active"',
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table test.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user_name`, `user_pass`, `status`, `name`, `last_name`) VALUES
	(1, 'RebeccaJames', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Rebecca', 'James'),
	(2, 'KeithUnderwood', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Keith', 'Underwood'),
	(3, 'FaithLewis', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'Faith', 'Lewis');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table test.records
CREATE TABLE IF NOT EXISTS `records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `create_datetime` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 1 COMMENT '0="deleted",\r\n1="active",\r\n2="archived"',
  `table` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_users_records` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table test.records: ~6 rows (approximately)
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` (`id`, `user_id`, `create_datetime`, `status`, `table`) VALUES
	(1, 1, '2021-10-21 14:46:33', 0, 'business'),
	(2, 1, '2021-10-21 14:46:42', 1, 'business'),
	(3, 2, '2021-10-21 14:47:51', 2, 'customer'),
	(4, 3, '2021-10-21 14:47:55', 1, 'customer'),
	(5, 1, '2021-10-21 14:47:55', 1, 'customer'),
	(6, 2, '2021-10-21 14:46:42', 1, 'business');
/*!40000 ALTER TABLE `records` ENABLE KEYS */;

-- Dumping structure for table test.business
CREATE TABLE IF NOT EXISTS `business` (
  `id` int(10) unsigned NOT NULL,
  `business_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'DNI, CIF, NIF, ...',
  `status` tinyint(4) DEFAULT NULL COMMENT '0="inactive"\r\n1="active"',
  `email` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id_unique` (`id`),
  KEY `id` (`id`) USING BTREE,
  CONSTRAINT `fk_business_records` FOREIGN KEY (`id`) REFERENCES `records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table test.business: ~3 rows (approximately)
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
INSERT INTO `business` (`id`, `business_name`, `vat_number`, `status`, `email`, `phone`) VALUES
	(1, 'Abigail S.L.', 'B09833575', 1, 'Abigail@localhost', '+34 922 000 000'),
	(2, 'Alan S.A.', 'A21111786', 0, 'Alan@localhost', '+34 922 000 001'),
	(6, 'Emma S.A.', 'A62537493', 0, 'Emma@localhost', '+34 922 000 002');
/*!40000 ALTER TABLE `business` ENABLE KEYS */;

-- Dumping structure for table test.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0="inactive"\r\n1="active"',
  `email` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id_unique` (`id`),
  KEY `id` (`id`) USING BTREE,
  CONSTRAINT `fk_customer_records` FOREIGN KEY (`id`) REFERENCES `records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table test.customer: ~3 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id`, `name`, `last_name`, `status`, `email`, `phone`) VALUES
	(3, 'Julian', 'Simpson', 1, 'JulianSimpson@localhost', '+34 922 999 999'),
	(4, 'Max', 'Johnston', 0, 'MaxJohnston@localhost', '+34 922 999 998'),
	(5, 'Isaac', 'Howard', 1, 'IsaacHoward@localhost', '+34 922 999 997');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
