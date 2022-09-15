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

-- Dumping data for table imunisasi.anaks: ~1 rows (approximately)
/*!40000 ALTER TABLE `anaks` DISABLE KEYS */;
INSERT INTO `anaks` (`id`, `nama`, `tgl_lahir`, `jenis_kelamin`, `ibus_id`, `created_at`, `updated_at`) VALUES
	('an-0001', 'Budi', '2019-02-10', 'laki-laki', 'ib-0001', '2022-08-31 14:24:20', '2022-08-31 14:24:20'),
	('an-0002', 'Tono', '2022-09-09', 'laki-laki', 'ib-0001', '2022-09-04 14:23:17', '2022-09-13 14:26:09');
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

-- Dumping data for table imunisasi.ibus: ~2 rows (approximately)
/*!40000 ALTER TABLE `ibus` DISABLE KEYS */;
INSERT INTO `ibus` (`id`, `nama`, `tgl_lahir`, `no_hp`, `alamat`, `wilayah_kerjas_id`, `id_telegram`, `created_at`, `updated_at`) VALUES
	('ib-0001', 'Ani', '1994-12-04', '085274503739', 'Padang', 'wk-01', '5161990440', '2022-08-31 14:20:13', '2022-09-08 15:14:41'),
	('ib-0002', 'Emi', '1995-04-09', '085274503739', 'pasaman', 'wk-01', NULL, '2022-09-01 08:34:51', '2022-09-01 08:34:51');
/*!40000 ALTER TABLE `ibus` ENABLE KEYS */;

-- Dumping structure for table imunisasi.jadwal_imunisasis
CREATE TABLE IF NOT EXISTS `jadwal_imunisasis` (
  `id` varchar(10) NOT NULL,
  `jenis_imunisasis_id` varchar(10) NOT NULL,
  `anaks_id` varchar(20) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_pemberian` date DEFAULT NULL,
  `berat_badan` double DEFAULT NULL,
  `panjang_badan` decimal(3,0) DEFAULT NULL,
  `suhu` double DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `pesans_id` varchar(20) DEFAULT NULL,
  `status_pesan` varchar(1) DEFAULT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`anaks_id`,`id`) USING BTREE,
  KEY `jenis_imunisasi_jadwal_imunisasi_fk` (`jenis_imunisasis_id`),
  KEY `FK_jadwal_imunisasis_users` (`users_id`),
  KEY `FK_jadwal_imunisasis_pesans` (`pesans_id`),
  CONSTRAINT `FK_jadwal_imunisasis_pesans` FOREIGN KEY (`pesans_id`) REFERENCES `pesans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_jadwal_imunisasis_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `anak_jadwal_imunisasi_fk` FOREIGN KEY (`anaks_id`) REFERENCES `anaks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `jenis_imunisasi_jadwal_imunisasi_fk` FOREIGN KEY (`jenis_imunisasis_id`) REFERENCES `jenis_imunisasis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.jadwal_imunisasis: ~1 rows (approximately)
/*!40000 ALTER TABLE `jadwal_imunisasis` DISABLE KEYS */;
INSERT INTO `jadwal_imunisasis` (`id`, `jenis_imunisasis_id`, `anaks_id`, `tempat`, `tanggal`, `waktu_pemberian`, `berat_badan`, `panjang_badan`, `suhu`, `status`, `keterangan`, `pesans_id`, `status_pesan`, `users_id`, `created_at`, `updated_at`) VALUES
	('jd-0005', 'ji-0004', 'an-0001', 'tes', '2022-09-13', '2022-09-14', 22, 122, 36.1, 'Tepat Waktu', '-', 'ps-0001', '1', 1, '2022-09-12 14:46:55', '2022-09-13 15:18:54');
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

-- Dumping data for table imunisasi.jenis_imunisasis: ~2 rows (approximately)
/*!40000 ALTER TABLE `jenis_imunisasis` DISABLE KEYS */;
INSERT INTO `jenis_imunisasis` (`id`, `nama`, `waktu_tepat`, `waktu_telat`, `keterangan`, `created_at`, `updated_at`) VALUES
	('ji-0003', 'Hepatitis B', 0, 1, '-', '2022-09-04 14:30:03', '2022-09-04 14:30:03'),
	('ji-0004', 'BCG', 1, 2, '-', '2022-09-04 14:31:47', '2022-09-04 14:31:47');
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
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.permissions: ~36 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'role-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(2, 'role-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(3, 'role-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(4, 'role-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(5, 'anaks-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(6, 'anaks-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(7, 'anaks-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(8, 'anaks-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(9, 'ibus-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(10, 'ibus-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(11, 'ibus-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(12, 'ibus-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(13, 'jadwalimunisasis-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(14, 'jadwalimunisasis-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(15, 'jadwalimunisasis-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(16, 'jadwalimunisasis-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(17, 'jenisimunisasis-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(18, 'jenisimunisasis-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(19, 'jenisimunisasis-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(20, 'jenisimunisasis-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(21, 'pesans-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(22, 'pesans-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(23, 'pesans-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(24, 'pesans-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(25, 'users-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(26, 'users-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(27, 'users-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(28, 'users-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(29, 'userswilayahs-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(30, 'userswilayahs-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(31, 'userswilayahs-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(32, 'userswilayahs-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(33, 'wilayahkerjas-list', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(34, 'wilayahkerjas-create', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(35, 'wilayahkerjas-edit', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02'),
	(36, 'wilayahkerjas-delete', 'web', '2022-08-12 02:28:02', '2022-08-12 02:28:02');
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
  `jenis` varchar(50) NOT NULL,
  `pesan` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table imunisasi.pesans: ~2 rows (approximately)
/*!40000 ALTER TABLE `pesans` DISABLE KEYS */;
INSERT INTO `pesans` (`id`, `jenis`, `pesan`, `created_at`, `updated_at`) VALUES
	('ps-0001', 'Imunisasi Dasar', 'Yth. Ibu [nama ibu], jangan lupa besok [tanggal imunisasi] adalah jadwal imunisasi anak ibu atas nama [nama anak] berupa imunisasi dasar lengkap  [jenis imunisasi], tempat [tempat imunisasi] / posyandu terdekat', '2022-09-04 14:40:20', '2022-09-04 14:40:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.roles: ~0 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'web', '2022-08-12 02:31:27', '2022-08-12 02:31:27'),
	(2, 'Operator', 'web', '2022-09-11 08:32:48', '2022-09-11 08:32:48');
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

-- Dumping data for table imunisasi.role_has_permissions: ~50 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(5, 2),
	(6, 2),
	(7, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(11, 2),
	(12, 2),
	(13, 2),
	(14, 2),
	(15, 2),
	(16, 2),
	(21, 2),
	(29, 2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table imunisasi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah_kerjas_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table imunisasi.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `wilayah_kerjas_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin', '', NULL, '$2y$10$OkSeJ3RXURq9uo/xkQea0uDKz557ORHZpLe7YAvGEdp1JW9a/bEwi', NULL, '2022-08-12 02:31:27', '2022-09-14 01:38:25'),
	(2, 'Operator', 'operator', NULL, NULL, '$2y$10$TDIKap0WC33lANNi0dudSeKPzwj9R6J26YgtFJa3Y.dFBlyRCSbQy', NULL, '2022-09-11 08:33:57', '2022-09-14 01:39:38');
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

-- Dumping data for table imunisasi.users_wilayahs: ~1 rows (approximately)
/*!40000 ALTER TABLE `users_wilayahs` DISABLE KEYS */;
INSERT INTO `users_wilayahs` (`wilayah_kerjas_id`, `users_id`, `created_at`, `updated_at`) VALUES
	('wk-01', 1, '2022-08-31 16:16:15', '2022-09-11 08:34:19'),
	('wk-01', 2, '2022-09-11 08:34:24', '2022-09-11 08:34:24');
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

-- Dumping data for table imunisasi.wilayah_kerjas: ~0 rows (approximately)
/*!40000 ALTER TABLE `wilayah_kerjas` DISABLE KEYS */;
INSERT INTO `wilayah_kerjas` (`id`, `jenis`, `nama`, `created_at`, `updated_at`) VALUES
	('wk-01', 'padang barat', 'Padang', '2022-08-28 13:48:58', '2022-08-31 14:13:09');
/*!40000 ALTER TABLE `wilayah_kerjas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
