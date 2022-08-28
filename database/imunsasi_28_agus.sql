-- --------------------------------------------------------
-- Host:                         127.0.0.1
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


-- Dumping database structure for imunisasi
CREATE DATABASE IF NOT EXISTS `imunisasi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `imunisasi`;

-- Dumping structure for table imunisasi.anaks
CREATE TABLE IF NOT EXISTS `anaks` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `ibus_id` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ibu_anak_fk` (`ibus_id`),
  CONSTRAINT `ibu_anak_fk` FOREIGN KEY (`ibus_id`) REFERENCES `ibus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.anaks: ~0 rows (approximately)
/*!40000 ALTER TABLE `anaks` DISABLE KEYS */;
/*!40000 ALTER TABLE `anaks` ENABLE KEYS */;

-- Dumping structure for table imunisasi.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table imunisasi.ibus
CREATE TABLE IF NOT EXISTS `ibus` (
  `id` varchar(20) NOT NULL DEFAULT '0',
  `nama` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `wilayah_kerjas_id` varchar(20) NOT NULL,
  `id_telegram` varchar(40) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Wilayahkerja_ibu` (`wilayah_kerjas_id`),
  CONSTRAINT `Wilayahkerja_ibu` FOREIGN KEY (`wilayah_kerjas_id`) REFERENCES `wilayah_kerjas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.ibus: ~0 rows (approximately)
/*!40000 ALTER TABLE `ibus` DISABLE KEYS */;
/*!40000 ALTER TABLE `ibus` ENABLE KEYS */;

-- Dumping structure for table imunisasi.jadwal_imunisasis
CREATE TABLE IF NOT EXISTS `jadwal_imunisasis` (
  `anaks_id` varchar(20) NOT NULL,
  `jenis_imunisasis_id` varchar(10) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_pemberian` date DEFAULT NULL,
  `berat_badan` double DEFAULT NULL,
  `panjang_badan` decimal(3,0) DEFAULT NULL,
  `suhu` double DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`anaks_id`,`jenis_imunisasis_id`),
  KEY `jenis_imunisasi_jadwal_imunisasi_fk` (`jenis_imunisasis_id`),
  KEY `FK_jadwal_imunisasis_users` (`users_id`),
  CONSTRAINT `FK_jadwal_imunisasis_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `anak_jadwal_imunisasi_fk` FOREIGN KEY (`anaks_id`) REFERENCES `anaks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `jenis_imunisasi_jadwal_imunisasi_fk` FOREIGN KEY (`jenis_imunisasis_id`) REFERENCES `jenis_imunisasis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.jadwal_imunisasis: ~0 rows (approximately)
/*!40000 ALTER TABLE `jadwal_imunisasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal_imunisasis` ENABLE KEYS */;

-- Dumping structure for table imunisasi.jenis_imunisasis
CREATE TABLE IF NOT EXISTS `jenis_imunisasis` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `waktu_tepat` decimal(10,0) NOT NULL,
  `waktu_telat` decimal(10,0) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.jenis_imunisasis: ~0 rows (approximately)
/*!40000 ALTER TABLE `jenis_imunisasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `jenis_imunisasis` ENABLE KEYS */;

-- Dumping structure for table imunisasi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.migrations: ~5 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_08_12_014621_create_permission_tables', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table imunisasi.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table imunisasi.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.model_has_roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table imunisasi.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table imunisasi.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.permissions: ~4 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'role-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(2, 'role-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(3, 'role-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(4, 'role-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table imunisasi.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table imunisasi.pesans
CREATE TABLE IF NOT EXISTS `pesans` (
  `id` varchar(20) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `pesan` varchar(160) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.pesans: ~0 rows (approximately)
/*!40000 ALTER TABLE `pesans` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesans` ENABLE KEYS */;

-- Dumping structure for table imunisasi.riwayat_pesans
CREATE TABLE IF NOT EXISTS `riwayat_pesans` (
  `id` varchar(10) NOT NULL,
  `pesans_id` varchar(20) NOT NULL,
  `ibus_id` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pesan_riwayat_pesan_fk` (`pesans_id`),
  KEY `ibu_riwayat_pesan_fk` (`ibus_id`),
  CONSTRAINT `ibu_riwayat_pesan_fk` FOREIGN KEY (`ibus_id`) REFERENCES `ibus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pesan_riwayat_pesan_fk` FOREIGN KEY (`pesans_id`) REFERENCES `pesans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.riwayat_pesans: ~0 rows (approximately)
/*!40000 ALTER TABLE `riwayat_pesans` DISABLE KEYS */;
/*!40000 ALTER TABLE `riwayat_pesans` ENABLE KEYS */;

-- Dumping structure for table imunisasi.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'web', '2022-08-12 02:31:27', '2022-08-12 02:31:27');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table imunisasi.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.role_has_permissions: ~4 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table imunisasi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah_kerjas_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `wilayah_kerjas_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@gmail.com', '', NULL, '$2y$10$OkSeJ3RXURq9uo/xkQea0uDKz557ORHZpLe7YAvGEdp1JW9a/bEwi', NULL, '2022-08-12 02:31:27', '2022-08-12 02:31:27');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table imunisasi.users_wilayahs
CREATE TABLE IF NOT EXISTS `users_wilayahs` (
  `wilayah_kerjas_id` varchar(20) NOT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`wilayah_kerjas_id`,`users_id`),
  KEY `FK_users_wilayah_users` (`users_id`),
  CONSTRAINT `FK_users_wilayah_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `wilayah_kerjas_users_wilayah_fk` FOREIGN KEY (`wilayah_kerjas_id`) REFERENCES `wilayah_kerjas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.users_wilayahs: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_wilayahs` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_wilayahs` ENABLE KEYS */;

-- Dumping structure for table imunisasi.wilayah_kerjas
CREATE TABLE IF NOT EXISTS `wilayah_kerjas` (
  `id` varchar(20) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.wilayah_kerjas: ~1 rows (approximately)
/*!40000 ALTER TABLE `wilayah_kerjas` DISABLE KEYS */;
INSERT INTO `wilayah_kerjas` (`id`, `jenis`, `nama`, `created_at`, `updated_at`) VALUES
	('wk-01', 'jenis', 'nama', '2022-08-28 13:48:58', '2022-08-28 13:48:58');
/*!40000 ALTER TABLE `wilayah_kerjas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
