-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.18-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for rmedia
CREATE DATABASE IF NOT EXISTS `rmedia` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `rmedia`;

-- Dumping structure for table rmedia.auth_groups_users
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.auth_groups_users: ~0 rows (approximately)
INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
	(1, 4, 'admin', '2024-08-16 12:15:17'),
	(2, 5, 'admin', '2024-08-17 08:31:56'),
	(3, 6, 'admin', '2024-08-17 08:33:56');

-- Dumping structure for table rmedia.auth_identities
CREATE TABLE IF NOT EXISTS `auth_identities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_secret` (`type`,`secret`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.auth_identities: ~0 rows (approximately)
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(3, 4, 'email_password', NULL, 'david@gmail.com', '$2y$12$uTyyZ0Wmk54CYMqJRca6Ze8bEP6x4va0kfGWtlrulaRbYVFR6GqOW', NULL, NULL, 0, '2024-08-17 08:11:31', '2024-08-16 12:15:16', '2024-08-17 08:11:31'),
	(4, 5, 'email_password', NULL, 'johnte@gmail.com', '$2y$12$BsQ1Sc5DS1N77.RljF3nvuVG2WgRn4QIJ5LpfNN.sY/2ALvPLgEhW', NULL, NULL, 0, NULL, '2024-08-17 08:31:56', '2024-08-17 08:31:56'),
	(5, 6, 'email_password', NULL, 'hill@gmail.com', '$2y$12$lu.uLsPk86vY72rU/Hbsiu.TYu.0vn0k/jn5.UoqYs/4lH0lTY5Jy', NULL, NULL, 0, NULL, '2024-08-17 08:33:55', '2024-08-17 08:33:56');

-- Dumping structure for table rmedia.auth_logins
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.auth_logins: ~8 rows (approximately)
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
	(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'mbathadavid3@gmail.com', NULL, '2024-08-16 12:33:01', 0),
	(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'david@gmail.com', NULL, '2024-08-16 12:33:24', 0),
	(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'david@gmail.com', 4, '2024-08-16 12:33:32', 1),
	(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'mbathadavid3@gmail.com', NULL, '2024-08-16 22:04:29', 0),
	(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'david@gmail.com', 4, '2024-08-16 22:04:56', 1),
	(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'david@gmail.com', 4, '2024-08-17 08:10:56', 1),
	(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'david@gmail.com', 4, '2024-08-17 08:11:14', 1),
	(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'david@gmail.com', 4, '2024-08-17 08:11:31', 1);

-- Dumping structure for table rmedia.auth_permissions_users
CREATE TABLE IF NOT EXISTS `auth_permissions_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_permissions_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.auth_permissions_users: ~0 rows (approximately)

-- Dumping structure for table rmedia.auth_remember_tokens
CREATE TABLE IF NOT EXISTS `auth_remember_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `auth_remember_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.auth_remember_tokens: ~0 rows (approximately)

-- Dumping structure for table rmedia.auth_token_logins
CREATE TABLE IF NOT EXISTS `auth_token_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.auth_token_logins: ~0 rows (approximately)

-- Dumping structure for table rmedia.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.groups: ~2 rows (approximately)
INSERT INTO `groups` (`id`, `name`, `title`, `description`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
	(1, 'super admin', 'Super Admin', 'For SuperAdmins', 4, NULL, 1723801949, NULL),
	(2, 'admin', 'Admin', 'For admin groups', 4, NULL, 1723802005, NULL);

-- Dumping structure for table rmedia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.migrations: ~4 rows (approximately)
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1723788400, 1),
	(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1723788400, 1),
	(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1723788400, 1),
	(4, '2024-08-16-074348', 'App\\Database\\Migrations\\AddAttrinutesToUsers', 'default', 'App', 1723794470, 2);

-- Dumping structure for table rmedia.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` text DEFAULT NULL,
  `module_path` text DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table rmedia.modules: ~2 rows (approximately)
INSERT INTO `modules` (`id`, `module_name`, `module_path`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
	(1, 'Groups', '\\App\\Modules\\Groups\\Controllers\\Administrator', 1723801478, 4, NULL, NULL),
	(2, 'Users', '\\App\\Modules\\Users\\Controllers\\Administrator', 1723801478, 4, NULL, NULL);

-- Dumping structure for table rmedia.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.settings: ~0 rows (approximately)

-- Dumping structure for table rmedia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table rmedia.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`, `first_name`, `last_name`, `phone`) VALUES
	(4, 'Daudi', NULL, NULL, 1, NULL, '2024-08-16 12:15:16', '2024-08-16 12:15:17', NULL, NULL, NULL, '0748269865'),
	(5, 'johnte', NULL, NULL, 0, NULL, '2024-08-17 08:31:56', '2024-08-17 08:31:56', NULL, 'Johnson', 'Hillary', '0735353632'),
	(6, 'hill', NULL, NULL, 1, NULL, '2024-08-17 08:33:55', '2024-08-17 08:33:56', NULL, 'Hillary', 'Joshua', '0734353546');



CREATE TABLE `mediahouses` (
	`id` INT(9) NOT NULL AUTO_INCREMENT,
	`name` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`category` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`rate_card` FLOAT NULL DEFAULT NULL,
	`created_on` INT(11) NULL DEFAULT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	`updated_at` INT(11) NULL DEFAULT NULL,
	`modified_by` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=56
;


CREATE TABLE `industries` (
	`id` INT(9) NOT NULL AUTO_INCREMENT,
	`name` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`description` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`status` INT(11) NULL DEFAULT NULL,
	`created_on` INT(11) NULL DEFAULT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	`updated_at` INT(11) NULL DEFAULT NULL,
	`modified_by` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;


CREATE TABLE IF NOT EXISTS `group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `permission` text DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `slots` (
	`id` INT(9) NOT NULL AUTO_INCREMENT,
	`name` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`description` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`status` INT(11) NULL DEFAULT NULL,
	`created_on` INT(11) NULL DEFAULT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	`updated_at` INT(11) NULL DEFAULT NULL,
	`modified_by` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;


CREATE TABLE `platforms` (
	`id` INT(9) NOT NULL AUTO_INCREMENT,
	`name` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`description` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`created_on` INT(11) NULL DEFAULT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	`updated_at` INT(11) NULL DEFAULT NULL,
	`modified_by` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;


CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `industry` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `mediaclips` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `storytitle` text DEFAULT NULL,
  `mediahouse` int(11) DEFAULT NULL,
  `ratecard` int(11) DEFAULT NULL,
  `datetime` int(11) DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `sector` text DEFAULT NULL,
  `duration` text DEFAULT NULL,
  `tonality` text DEFAULT NULL,
  `journalist` text DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `filepath` text DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `industry` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

 