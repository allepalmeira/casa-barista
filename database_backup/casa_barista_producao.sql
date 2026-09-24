-- MySQL dump 10.13  Distrib 8.4.11, for Linux (x86_64)
--
-- Host: localhost    Database: casa_barista
-- ------------------------------------------------------
-- Server version	8.4.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('casa-do-barista-cache-902ba3cda1883801594b6e1b452790cc53948fda','i:1;',1790276715),('casa-do-barista-cache-902ba3cda1883801594b6e1b452790cc53948fda:timer','i:1790276715;',1790276715),('casa-do-barista-cache-newsletterb7ad7f2b04bd98f199a2b8c016e37e66c831b866','i:1;',1790277020),('casa-do-barista-cache-newsletterb7ad7f2b04bd98f199a2b8c016e37e66c831b866:timer','i:1790277020;',1790277020);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_09_173229_create_tbl_banner_table',0),(5,'2026_09_09_173229_create_tbl_categoria_table',0),(6,'2026_09_09_173229_create_tbl_cliente_table',0),(7,'2026_09_09_173229_create_tbl_contato_table',0),(8,'2026_09_09_173229_create_tbl_depoimento_table',0),(9,'2026_09_09_173229_create_tbl_galeria_table',0),(10,'2026_09_09_173229_create_tbl_horarios_table',0),(11,'2026_09_09_173229_create_tbl_itens_venda_table',0),(12,'2026_09_09_173229_create_tbl_linha_tempo_table',0),(13,'2026_09_09_173229_create_tbl_news_table',0),(14,'2026_09_09_173229_create_tbl_produto_table',0),(15,'2026_09_09_173229_create_tbl_usuarios_table',0),(16,'2026_09_09_173229_create_tbl_usuarios_venda_table',0),(17,'2026_09_09_173229_create_tbl_venda_table',0),(18,'2026_09_09_173230_add_foreign_keys_to_tbl_depoimento_table',0),(19,'2026_09_09_173230_add_foreign_keys_to_tbl_itens_venda_table',0),(20,'2026_09_09_173230_add_foreign_keys_to_tbl_produto_table',0),(21,'2026_09_09_173230_add_foreign_keys_to_tbl_usuarios_venda_table',0),(22,'2026_09_09_173230_add_foreign_keys_to_tbl_venda_table',0),(23,'2026_09_24_120000_create_tbl_local_table',2),(24,'2026_09_24_120001_add_local_to_tbl_venda_table',2),(25,'2026_09_24_130000_create_tbl_equipe_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('3br9rp0EQMJ5NTQYd4B4w9cZ63qvcOi0PrNxVzgI',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJkc2lJak1JSElPRE5SdTBBT0k1Tm9EeFlHUGRsWmxsYWN3VVp3WVJ5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790276714),('3wo5D1vQ1vXy4rQ5LGKrvPXegdOU8Jylmp7VojDS',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJ4YWlEVk1ublo4MGxwejZlQnZVRWxSZWMxajRBdUlMWUozTTlpbHpOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9ldmVudG8iLCJyb3V0ZSI6ImV2ZW50byJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790276502),('4IXdYBAvRoTq8gda9g4MlYAKEqDGUrhNTYRw9Yt5',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJ1TGJXVElORmtMSjdJbTJGcXJFSGZScFpDMmpBU3lLY0NoZDZ5bTlRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790277243),('9Egb6H4iKhZiQf9zNQs7icNszILCgGTFOcEekf7L',7,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJZdDNBWXdyVFI3UDFxUERWM3hSdE1tbHVKMmZGajUzemx2cnlQOXNYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwidXJsIjpbXSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjd9',1790277590),('9WIZQDDf2h0nhsSgon0vOmheWpiFdA13FOPdJUMZ',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJRanFxeFBkNzJMVE1EN1B5eVFlTEMySjlNQU9xckJ4OEE3MUFRRTJ0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790276501),('AubCXj4jsQXNe2D3zTYA8EcfWPHSZdNtHEMIgw2a',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJ3bVBvcU9jSEkwRGlzRGYxS3ZrQlNqZFE1R0Z2aUN4QW1TQ2hUMWRGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790278090),('bxzdRlE3R02YKvyxnRYL3ZxxpyCAq7pQw2yn9ZL7',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJmbXBCR0NZWHZrR0c5aURiMmFZM3VLM1M2VFdHVk03VG1nT0ZBVkhqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jYXJkYXBpbyIsInJvdXRlIjoiY2FyZGFwaW8ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790276502),('D47ohS9pzbvNqZVe52QSnKJUdsB3DZywvaDqKmlz',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiI0N1B6M3gxd2ZvQ2tlVTBkVVZYeWtBeEF1dzBqZ0JHMndxWkpUZmRrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790276629),('eartE1BQK1QokUlAM8UXVyZJxmRbbqdJyD1jIcRE',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ4VWgxMlFTdnB4bnNSNFVDa1owam5HZU1Sak9BUmg1YUJPcDVreGtyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790276710),('FBg0jXwC5UW2WjGf6z49xNOtRMHYrnkToo54tmyB',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiI3TDZDek5QbW1PRmJEVHdsQUhtUGNpVFhBZVFHU29mVjU3VXU1NjB0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790277386),('Fvia95lhPWhtBDZE4gdxSz3pCQBXyHtdYxg87Bvx',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJBd1E2UXhYOEdaa2RHRVFxdkp4M1g1T2ZBbkpHQ2R2dnpaMzZJVjVLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790276503),('gn9lztEkZTD0denPK74O1gSfsFi6nezetoszmE5L',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJmQUcxUkFQTGFDRlJaRWhQSXZ3ZjhqMkRWbFI3STdReG9md0duUlpqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790277551),('iX8bOHnd2HNv7j7CutSHcaXegQxmgNwVSUA3wgXN',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJ0OFRKT05GMm5VWUJKYVN2bjVvQXVyZnVnVEJ5QWdxSTB0bmFuZ3AyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790276629),('iyModeZ9NvaA3FO4CrgQrQt2t66es1ebaXWZyGBQ',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJRV29NVExzUldsNzFTVXZJUVJoUzViaG5IMHZrSndZYXlPNUVFMGRGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790278090),('MB18IjRzF2f9tOgEoGX7zWhsiL3qfR7vWqiRQyev',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJKSUNLR3RpODJxZmpyRU5XOEcwNk1Zb3R2eUtLNTJjYU1Nd3kzNTkyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790277385),('P2AUuTL9pFEE8JwGDxUzi1v7cp9oRYRpik7xwGkc',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJEZXJSeVp2U3U0Q3F6RFdnUmRCTzRaYlk4U0tYdnRxQWM1VzA4THg4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790277999),('PgVY4W9mOuu7qLDNOiVlTxmKwh1cp2CZET2hNoEb',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiI3M2J2RTJtcmhJWldnRjJKazlHTTNvVHdSTlFWWkFPZzJBVGpBQ0ZvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790276502),('PicXH7p3qv6hFTGd28t1QK99tJCOfyYftynzox12',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJrR211eVJLVk1Fd2l0VERNall6SGRtb29ZZGZReDdpRUIzd3I4NXZzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790277999),('RkLxOc972GVCuBGTFvleNWKeIpAeWiFAyWaNOvbU',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJENHMyd0xIcDBQckx0SXV5dVFDY0pkMkhocHNtZ3NBWndHejF1MkhrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790277551),('RlbEyzjEwrJHVISx4y6BNllVqP7qDFAPXf8lRdku',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJyV0ZrVFlaMTdpTmVRR01XcjNNcG1LUFFBZGZ0UU1ISGxqTHdmTVBxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9zb2JyZSIsInJvdXRlIjoic29icmUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790277242),('S8QNGseo82pHWRVu16J4RGpgQxQkyynFvWdFbZZz',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiI5NzcwVzkwU0ZROTB0aXhzYVRsNkJNd0RqdzBjcjhEN1BuaHR6NjBNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9ldmVudG8iLCJyb3V0ZSI6ImV2ZW50byJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790276630),('sUlU61D9iDA4Jnu84Jy53uY2mObI4AxwZG5sqh0y',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiIzSzFlYzZ1R2VLcnJLM3BIMm5QWm1HTDVtT1dEbzhOcHA1dFAyRUJmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jb250YXRvIiwicm91dGUiOiJjb250YXRvIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790276502),('T5Ma6uFhYOzF5VZFfDfuqbQ3J7bZ91FzRHxJ6RVw',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJITVk4eFo0MlpDREtzN0E0aFMxTlJoempwcWE2SEt3eHR5ZndZOHQ0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jYXJkYXBpbyIsInJvdXRlIjoiY2FyZGFwaW8ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790276629),('UAN6KhBlwGNXCZyATcBAUWT9FISgwblFpaTledS1',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJzRk1UZWVsYUN2OXhDazZmZklseDRSZFQ2UlIyUGtramo1Tk44cHVDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jb250YXRvIiwicm91dGUiOiJjb250YXRvIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790277999),('Ukvm2ieSemjbiL4GlhPkgEidHEuwOilpWLI7hffz',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJMQzl0c2Q1T1NpS1hldXlVaFExN2R1cW9tQ2dBbE5CRnVZS2oxZU5TIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790277999),('vjmVNJ3S8kdVGfIWG6nl8xbqs7Wt5RARRKk9006h',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJFbHBHbVFlMTRoMUtwSEhCSk1NVzBMS2lad3YwalhjazZEMGNVU3FZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jb250YXRvIiwicm91dGUiOiJjb250YXRvIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790276630),('xDNQ0hEVGenKTvAibeRyQzw1eJNF3pWdpJFAXo7k',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJKWU1RZjl2TENNaXBnanVuQVp5dDFMQTE5bGtnU2VuejVrc0E2ZllOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jb250YXRvIiwicm91dGUiOiJjb250YXRvIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790276960),('zdSLSrcilTCr32tcdC6xdSBOSUm9539qcMK4Ppyb',NULL,'172.18.0.1','curl/8.17.0','eyJfdG9rZW4iOiJweTh3RngwNWJzYWw5bGtMMlhFT2NjUllRaW5aM3ZINnpsUWJwTVkwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790277242);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_banner`
--

DROP TABLE IF EXISTS `tbl_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_banner` (
  `id_banner` int NOT NULL AUTO_INCREMENT,
  `titulo_banner` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagem_banner` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_banner` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_banner` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_banner` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_banner`
--

LOCK TABLES `tbl_banner` WRITE;
/*!40000 ALTER TABLE `tbl_banner` DISABLE KEYS */;
INSERT INTO `tbl_banner` VALUES (1,'Promoção especial de inverno','banner/promocao_especial_de_inverno.png','ATIVO','2026-05-13 14:02:20','2026-05-20 14:09:27'),(2,'Festival de cafés especiais','banner/festival_de_cafes_especiais.png','ATIVO','2026-05-18 13:18:13','2026-09-24 17:00:13'),(3,'Semana do espresso','banner/semana_do_espresso.png','ATIVO','2026-05-18 13:18:13','2026-09-24 17:00:14'),(4,'Novos doces artesanais','banner/novos-doces-artesanais_4.png','INATIVO','2026-05-18 13:18:13','2026-09-24 17:00:04'),(5,'Café gelado da casa','banner/cafe_gelado_da_casa.png','ATIVO','2026-05-18 13:18:13','2026-09-22 16:37:02'),(6,'Combo da tarde','banner/combo_da_tarde.png','ATIVO','2026-05-18 13:18:13','2026-09-22 16:37:02'),(10,'Café Mineiro da Mãe','banner/cafe-mineiro-da-mae_10.png','INATIVO','2026-09-15 19:51:05','2026-09-22 16:36:59'),(11,'Café Mineiro do Pai','banner/cafe-mineiro-do-pai_11.png','INATIVO','2026-09-15 20:15:53','2026-09-22 16:36:57');
/*!40000 ALTER TABLE `tbl_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_categoria` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_categoria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_categoria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'CAFÉ','ATIVO','2026-05-13 14:52:54','2026-05-13 14:52:54'),(2,'ESPECIAIS','ATIVO','2026-05-18 13:29:01','2026-05-18 13:29:01'),(3,'TORTAS','ATIVO','2026-05-18 13:29:01','2026-05-18 13:29:01'),(4,'SANDUÍCHES','ATIVO','2026-05-18 13:29:01','2026-05-18 13:29:01'),(5,'CHOCOLATES','ATIVO','2026-05-18 13:29:01','2026-05-18 13:29:01'),(6,'PROMOÇÕES','ATIVO','2026-05-18 13:29:01','2026-05-18 13:29:01');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_cliente` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha_cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_cliente` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_cliente` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_cliente` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_cliente` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email_cliente` (`email_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` VALUES (1,'Lucas Martins','lucas@gmail.com','senha123','cliente/lucas_martins.png','ATIVO','2026-05-13 15:11:06','2026-05-13 15:11:06'),(2,'Gabriel Oliveira','gabriel@email.com','senha123','cliente/gabriel_oliveira.png','ATIVO','2026-05-18 13:38:04','2026-05-18 13:38:04'),(3,'Isabela Martins','isabela@email.com','senha123','cliente/isabela_martins.png','INATIVO','2026-05-18 13:38:04','2026-08-20 20:10:21'),(4,'Henrique Lopes','henrique@email.com','senha123','cliente/henrique_lopes.png','ATIVO','2026-05-18 13:38:04','2026-05-18 13:38:04'),(5,'Natália Ribeiro','natalia@email.com','senha123','cliente/natalia_ribeiro.png','ATIVO','2026-05-18 13:38:04','2026-05-18 13:38:04'),(6,'Thiago Pereira','thiago@email.com','senha123','cliente/thiago_pereira.png','ATIVO','2026-05-18 13:38:04','2026-05-18 13:38:04');
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contato`
--

DROP TABLE IF EXISTS `tbl_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_contato` (
  `id_contato` int NOT NULL AUTO_INCREMENT,
  `nome_contato` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_contato` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefone_contato` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `assunto_contato` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mensagem_contato` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_contato` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_contato` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_contato` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contato`
--

LOCK TABLES `tbl_contato` WRITE;
/*!40000 ALTER TABLE `tbl_contato` DISABLE KEYS */;
INSERT INTO `tbl_contato` VALUES (1,'Mariana Souza','mariana@gmail.com','(11)98888-7777','DÚVIDA','Gostaria de saber se vocês aceitam reservas para grupos.','NOVO','2026-05-13 14:16:12','2026-05-13 14:16:12'),(2,'Bruno Almeida','bruno@email.com','11933332222','Reserva','Gostaria de reservar uma mesa para quatro pessoas no sábado.','NOVO','2026-05-18 13:27:32','2026-05-18 13:27:32'),(3,'Larissa Mendes','larissa@email.com','11922221111','Pedido','Gostaria de saber se vocês fazem encomenda de brownies.','NOVO','2026-05-18 13:27:32','2026-05-18 13:27:32'),(4,'Diego Ramos','diego@email.com','11911110000','Evento','Tenho interesse em realizar uma reunião pequena na cafeteria.','LIDO','2026-05-18 13:27:32','2026-05-20 14:18:17'),(5,'Vanessa Prado','vanessa@email.com','11900009999','Elogio','Gostei muito do atendimento e da qualidade do café.','LIDO','2026-05-18 13:27:32','2026-05-18 13:27:32'),(6,'Eduardo Nunes','eduardo@email.com','11899998888','Dúvida','Gostaria de saber quais métodos de preparo vocês oferecem.','NOVO','2026-05-18 13:27:32','2026-05-18 13:27:32');
/*!40000 ALTER TABLE `tbl_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_depoimento`
--

DROP TABLE IF EXISTS `tbl_depoimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_depoimento` (
  `id_depoimento` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `titulo_depoimento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_depoimento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nota_depoimento` int NOT NULL,
  `status_depoimento` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'PENDENTE',
  `data_criacao_depoimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_depoimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_depoimento`),
  KEY `fk_depoimento_cliente` (`id_cliente`),
  CONSTRAINT `fk_depoimento_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_depoimento`
--

LOCK TABLES `tbl_depoimento` WRITE;
/*!40000 ALTER TABLE `tbl_depoimento` DISABLE KEYS */;
INSERT INTO `tbl_depoimento` VALUES (1,1,'Excelente café','O café estava perfeito e o atendimento foi muito acolhedor.',1,'APROVADO','2026-05-13 15:29:22','2026-07-28 19:51:55'),(2,2,'Café excelente','O Café Longo estava muito saboroso e o atendimento foi muito bom.',4,'APROVADO','2026-05-18 13:43:10','2026-07-28 19:45:21'),(3,3,'Ambiente acolhedor','Gostei muito do ambiente da cafeteria e da organização do espaço.',5,'PENDENTE','2026-05-18 13:43:10','2026-07-28 17:21:03'),(4,4,'Ótima torta','A Torta de Limão estava muito boa e combinou bem com o café.',2,'APROVADO','2026-05-18 13:43:10','2026-07-28 19:45:12'),(5,5,'Bom atendimento','Fui bem atendida e meu pedido ficou pronto rapidamente.',5,'PENDENTE','2026-05-18 13:43:10','2026-05-18 13:43:10'),(6,6,'Voltarei mais vezes','Gostei bastante dos produtos e pretendo voltar com minha família.',4,'PENDENTE','2026-05-18 13:43:10','2026-05-18 13:43:10');
/*!40000 ALTER TABLE `tbl_depoimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_equipe`
--

DROP TABLE IF EXISTS `tbl_equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_equipe` (
  `id_equipe` int NOT NULL AUTO_INCREMENT,
  `nome_equipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo_equipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_equipe` varchar(65) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordem_equipe` int NOT NULL DEFAULT '0',
  `status_equipe` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_criacao_equipe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_equipe` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_equipe`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_equipe`
--

LOCK TABLES `tbl_equipe` WRITE;
/*!40000 ALTER TABLE `tbl_equipe` DISABLE KEYS */;
INSERT INTO `tbl_equipe` VALUES (1,'Lucas Ribeiro','Barista Especialista','equipe/lucas-ribeiro_1.png',1,'ATIVO','2026-09-24 19:11:58','2026-09-24 19:11:58'),(2,'Mariana Alves','Mestre de Torra','equipe/mariana-alves_2.png',2,'ATIVO','2026-09-24 19:11:58','2026-09-24 19:11:58'),(3,'Renato Silva','Atendimento e Experiência do Cliente','equipe/renato-silva_3.png',3,'ATIVO','2026-09-24 19:11:58','2026-09-24 19:11:58');
/*!40000 ALTER TABLE `tbl_equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_galeria`
--

DROP TABLE IF EXISTS `tbl_galeria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_galeria` (
  `id_galeria` int NOT NULL AUTO_INCREMENT,
  `nome_galeria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagem_galeria` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_galeria` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_galeria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_galeria` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_galeria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galeria`
--

LOCK TABLES `tbl_galeria` WRITE;
/*!40000 ALTER TABLE `tbl_galeria` DISABLE KEYS */;
INSERT INTO `tbl_galeria` VALUES (1,'Ambiente Interno','galeria/ambiente_interno.png','ATIVO','2026-05-13 14:26:45','2026-05-13 14:26:45'),(2,'Barista preparando café','galeria/barista_preparando_cafe.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59'),(3,'Mesa com cappuccino','galeria/mesa_com_cappuccino.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59'),(4,'Vitrine de doces','galeria/vitrine_de_doces.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59'),(5,'Área externa','galeria/area_externa.png','ATIVO','2026-05-18 13:18:59','2026-09-24 17:50:29'),(6,'Clientes na cafeteria','galeria/clientes_na_cafeteria.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59'),(10,'Site','galeria/site_10.png','INATIVO','2026-09-24 17:16:50','2026-09-24 18:03:37');
/*!40000 ALTER TABLE `tbl_galeria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_horarios`
--

DROP TABLE IF EXISTS `tbl_horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_horarios` (
  `id_horarios` int NOT NULL AUTO_INCREMENT,
  `dia_semana_horarios` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hora_abertura_horarios` time NOT NULL,
  `hora_fechamento_horarios` time NOT NULL,
  `observacao_horarios` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_horarios` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_horarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_horarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_horarios`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_horarios`
--

LOCK TABLES `tbl_horarios` WRITE;
/*!40000 ALTER TABLE `tbl_horarios` DISABLE KEYS */;
INSERT INTO `tbl_horarios` VALUES (1,'SEGUNDA-FEIRA','08:00:00','20:00:00','Atendimento por ordem de chegada','ATIVO','2026-05-13 14:47:46','2026-05-13 14:47:46'),(2,'TERÇA-FEIRA','07:30:00','19:30:00','Atendimento normal de segunda-feira','ATIVO','2026-05-18 13:24:39','2026-05-18 13:24:39'),(3,'QUARTA-FEIRA','07:30:00','19:30:00','Atendimento normal de terça-feira','ATIVO','2026-05-18 13:24:39','2026-05-18 13:24:39'),(4,'QUINTA-FEIRA','07:30:00','19:30:00','Atendimento normal de quarta-feira','ATIVO','2026-05-18 13:24:39','2026-05-18 13:24:39'),(5,'SEXTA-FEIRA','07:30:00','21:00:00','Horário estendido de quinta-feira','ATIVO','2026-05-18 13:24:39','2026-05-18 13:24:39'),(6,'SÁBADO','07:30:00','22:00:00','Horário especial de sexta-feira','ATIVO','2026-05-18 13:24:39','2026-05-18 13:24:39');
/*!40000 ALTER TABLE `tbl_horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_itens_venda`
--

DROP TABLE IF EXISTS `tbl_itens_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_itens_venda` (
  `id_itens_venda` int NOT NULL AUTO_INCREMENT,
  `id_venda` int NOT NULL,
  `id_produto` int NOT NULL,
  `qtde_itens_venda` double(6,2) NOT NULL,
  `valor_unit_itens_venda` double(6,2) NOT NULL,
  `subtotal_itens_venda` double(6,2) NOT NULL,
  `status_itens_venda` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'CONFIRMADO',
  `data_criacao_itens_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_itens_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_itens_venda`),
  KEY `fk_itens_venda_venda` (`id_venda`),
  KEY `fk_itens_venda_produto` (`id_produto`),
  CONSTRAINT `fk_itens_venda_produto` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produto` (`id_produto`),
  CONSTRAINT `fk_itens_venda_venda` FOREIGN KEY (`id_venda`) REFERENCES `tbl_venda` (`id_venda`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itens_venda`
--

LOCK TABLES `tbl_itens_venda` WRITE;
/*!40000 ALTER TABLE `tbl_itens_venda` DISABLE KEYS */;
INSERT INTO `tbl_itens_venda` VALUES (1,1,1,2.00,13.90,27.80,'CONFIRMADO','2026-05-13 17:04:33','2026-05-13 17:04:33'),(2,2,1,2.00,13.90,27.80,'CONFIRMADO','2026-05-18 13:53:46','2026-05-18 13:53:46'),(3,2,3,1.00,14.90,14.90,'CONFIRMADO','2026-05-18 13:53:46','2026-05-18 13:53:46'),(4,3,2,1.00,8.90,8.90,'CONFIRMADO','2026-05-18 13:54:07','2026-05-18 13:54:07'),(5,3,4,1.00,16.90,16.90,'CONFIRMADO','2026-05-18 13:54:07','2026-05-18 13:54:07'),(6,4,5,2.00,13.90,27.80,'CONFIRMADO','2026-05-18 13:54:26','2026-05-18 13:54:26'),(7,4,3,2.00,14.90,29.80,'CONFIRMADO','2026-05-18 13:54:26','2026-05-18 13:54:26'),(8,5,6,3.00,21.90,65.70,'CONFIRMADO','2026-05-18 13:54:42','2026-05-20 14:39:30'),(9,5,1,1.00,13.90,13.90,'CONFIRMADO','2026-05-18 13:54:42','2026-05-18 13:54:42'),(10,6,4,2.00,16.90,33.80,'CONFIRMADO','2026-05-18 13:55:09','2026-05-18 13:55:09'),(11,6,5,1.00,13.90,13.90,'CONFIRMADO','2026-05-18 13:55:09','2026-05-18 13:55:09'),(19,11,1,2.00,13.90,27.80,'CONFIRMADO','2026-09-24 18:32:11','2026-09-24 18:32:11'),(20,11,6,2.00,21.90,43.80,'CONFIRMADO','2026-09-24 18:32:20','2026-09-24 18:32:20');
/*!40000 ALTER TABLE `tbl_itens_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_linha_tempo`
--

DROP TABLE IF EXISTS `tbl_linha_tempo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_linha_tempo` (
  `id_linha_tempo` int NOT NULL AUTO_INCREMENT,
  `titulo_linha_tempo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ano_linha_tempo` date NOT NULL,
  `descricao_linha_tempo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_linha_tempo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_linha_tempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_linha_tempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_linha_tempo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_linha_tempo`
--

LOCK TABLES `tbl_linha_tempo` WRITE;
/*!40000 ALTER TABLE `tbl_linha_tempo` DISABLE KEYS */;
INSERT INTO `tbl_linha_tempo` VALUES (1,'FUNDAÇÃO','2001-01-01','A Casa do Barista iniciou suas atividades \noferencendo cafés especiais e atendimento acolhedor.','ATIVO','2026-05-13 14:34:08','2026-05-13 14:34:08'),(2,'Novo blend','2006-01-01','A cafeteria lançou um novo blend exclusivo com grãos selecionados.','ATIVO','2026-05-18 13:20:14','2026-05-18 13:20:14'),(3,'Delivery','2011-02-01','A Casa do Barista iniciou o atendimento por delivery para clientes da região.','ATIVO','2026-05-18 13:20:39','2026-05-18 13:20:39'),(4,'Novo cardápio','2015-03-01','Foi lançado um novo cardápio com cafés, doces, salgados e bebidas geladas.','ATIVO','2026-05-18 13:20:39','2026-05-18 13:20:39'),(5,'Curso de barista','2021-04-01','A cafeteria começou a oferecer pequenos workshops sobre preparo de café.','ATIVO','2026-05-18 13:20:39','2026-05-18 13:20:39'),(6,'Cartão fidelidade','2026-05-01','Foi criado um cartão fidelidade para clientes frequentes da cafeteria.','ATIVO','2026-05-18 13:20:39','2026-05-18 13:20:39');
/*!40000 ALTER TABLE `tbl_linha_tempo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_local`
--

DROP TABLE IF EXISTS `tbl_local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_local` (
  `id_local` int NOT NULL AUTO_INCREMENT,
  `nome_local` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_local` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_local` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_local` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_criacao_local` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_local` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_local`),
  UNIQUE KEY `codigo_local` (`codigo_local`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_local`
--

LOCK TABLES `tbl_local` WRITE;
/*!40000 ALTER TABLE `tbl_local` DISABLE KEYS */;
INSERT INTO `tbl_local` VALUES (5,'Mesa 01','MESA','eyjmlabdgb','ATIVO','2026-09-24 18:30:40','2026-09-24 18:30:40'),(6,'Mesa 02','MESA','ea88cldsj0','ATIVO','2026-09-24 18:34:00','2026-09-24 18:34:00');
/*!40000 ALTER TABLE `tbl_local` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_news`
--

DROP TABLE IF EXISTS `tbl_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_news` (
  `id_news` int NOT NULL AUTO_INCREMENT,
  `email_news` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `aceite_news` int NOT NULL DEFAULT '1',
  `data_criacao_news` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_news` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_news`),
  UNIQUE KEY `email_news` (`email_news`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_news`
--

LOCK TABLES `tbl_news` WRITE;
/*!40000 ALTER TABLE `tbl_news` DISABLE KEYS */;
INSERT INTO `tbl_news` VALUES (1,'pedro@gmail.com',1,'2026-05-13 14:20:54','2026-05-13 14:20:54'),(2,'newsletter01@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(3,'newsletter02@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(4,'newsletter03@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(5,'newsletter04@email.com',0,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(6,'newsletter05@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(7,'allepalmeira@senac.com',1,'2026-09-24 17:40:18','2026-09-24 17:40:18'),(8,'alessandro.psilva@sp.senac.br',1,'2026-09-24 19:04:15','2026-09-24 19:04:15');
/*!40000 ALTER TABLE `tbl_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_produto` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_categoria` int NOT NULL,
  `descricao_curta_produto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_longa_produto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `valor_produto` double(6,2) NOT NULL,
  `imagem_produto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `destaque_produto` int NOT NULL DEFAULT '0',
  `status_produto` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_produto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_produto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_produto`),
  KEY `fk_produto_categoria` (`id_categoria`),
  CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (1,'Café Longo',1,'Café longo feito no coador.','Café Gourmet das montanhas \nfrias do monte Centro Oeste.',13.90,'produto/cafe_longo.png',1,'ATIVO','2026-05-13 15:00:59','2026-05-13 15:00:59'),(2,'Café Longo Espresso',1,'Café longo suave.','Café longo preparado com grãos selecionados, ideal para quem prefere uma bebida mais suave.',8.90,'produto/cafe_longo_espresso.png',1,'ATIVO','2026-05-18 13:33:15','2026-07-30 19:24:43'),(3,'Torta de Limão',3,'Torta doce e cremosa.','Torta de limão com massa crocante, creme suave e cobertura especial.',14.90,'produto/torta_de_limao.png',1,'ATIVO','2026-05-18 13:33:15','2026-05-18 13:33:15'),(4,'Sanduíche Natural',6,'Sanduíche leve e fresco.','Sanduíche natural preparado com pão integral, frango desfiado, cenoura e creme especial.',16.90,'produto/sanduiche_natural.png',0,'ATIVO','2026-05-18 13:33:15','2026-07-30 19:25:32'),(5,'Chocolate Quente',6,'Chocolate quente cremoso.','Bebida quente feita com chocolate cremoso, leite vaporizado e toque especial da casa.',13.90,'produto/chocolate_quente.png',1,'ATIVO','2026-05-18 13:33:15','2026-07-30 19:25:26'),(6,'Combo Café e Torta',6,'Café longo com torta.','Combo promocional com uma unidade de Café Longo e uma fatia de Torta de Limão.',21.90,'produto/combo_cafe_e_torta.png',1,'ATIVO','2026-05-18 13:33:15','2026-05-18 13:33:15');
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuarios` (
  `id_usuarios` int NOT NULL AUTO_INCREMENT,
  `nome_usuarios` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_usuarios` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha_usuarios` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_usuarios` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nivel_usuarios` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_usuarios` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_usuarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_usuarios` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuarios`),
  UNIQUE KEY `email_usuarios` (`email_usuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,'Pedro da Silva','pedro@casadobarista.com.br','senha123','usuario/pedro_da_silva.jpg','ADMINISTRADOR','ATIVO','2026-05-13 15:06:08','2026-05-13 15:06:08'),(2,'Carla Silva','carla@casadobarista.com.br','senha123','usuario/carla_silva.png','GERENTE','ATIVO','2026-05-18 13:35:19','2026-05-18 13:38:59'),(3,'Marcos Renato','marcos@casadobarista.com.br','senha123','usuario/marcos_renato.png','ATENDENTE','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:15'),(4,'Beatriz Costa','beatriz@casadobarista.com.br','senha123','usuario/beatriz_costa.png','CAIXA','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:31'),(5,'Felipe Souza','felipe@casadobarista.com.br','senha123','usuario/felipe_souza.png','BARISTA','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:45'),(6,'Renata Pereira','renata@casadobarista.com.br','senha123','usuario/renata_pereira.png','ATENDENTE','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:58'),(7,'Administrador','admin@casadobarista.com.br','$2y$12$CPABFlMGeuP87AOI73OO1OBcvQlIF1deIJB775pMSMMJSeJQuIk0q','usuario-padrao.png','ADMIN','ATIVO','2026-09-22 16:29:46','2026-09-22 16:29:46'),(9,'Administrador2','admin2@casadobarista.com.br','$2y$12$PpvgfXpE8u00CJRRcOJvi.gYKFLdiFRISRnddb7uhi8t6zzTmRhDK','admin.jpg','ADMINISTRADOR','ATIVO','2026-09-22 17:49:33','2026-09-22 17:49:33');
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios_venda`
--

DROP TABLE IF EXISTS `tbl_usuarios_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuarios_venda` (
  `id_usuarios_venda` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_venda` int NOT NULL,
  `data_criacao_usuarios_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_usuarios_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuarios_venda`),
  KEY `fk_usuarios_venda_usuario` (`id_usuario`),
  KEY `fk_usuarios_venda_venda` (`id_venda`),
  CONSTRAINT `fk_usuarios_venda_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuarios`),
  CONSTRAINT `fk_usuarios_venda_venda` FOREIGN KEY (`id_venda`) REFERENCES `tbl_venda` (`id_venda`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios_venda`
--

LOCK TABLES `tbl_usuarios_venda` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios_venda` DISABLE KEYS */;
INSERT INTO `tbl_usuarios_venda` VALUES (1,1,1,'2026-05-13 16:39:34','2026-05-13 16:39:34'),(2,2,2,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(3,3,3,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(4,4,4,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(5,5,5,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(6,6,6,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(11,7,11,'2026-09-24 18:31:59','2026-09-24 18:31:59'),(12,7,12,'2026-09-24 18:53:28','2026-09-24 18:53:28');
/*!40000 ALTER TABLE `tbl_usuarios_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_venda`
--

DROP TABLE IF EXISTS `tbl_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_venda` (
  `id_venda` int NOT NULL AUTO_INCREMENT,
  `data_hora_venda` datetime NOT NULL,
  `valor_total_venda` double(10,2) NOT NULL,
  `forma_pagamento_venda` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  `id_local` int DEFAULT NULL,
  `origem_venda` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'DASHBOARD',
  `status_venda` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'EM ANDAMENTO',
  `observacao_venda` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_criacao_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_venda`),
  KEY `fk_venda_cliente` (`id_cliente`),
  KEY `fk_venda_local` (`id_local`),
  CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`),
  CONSTRAINT `fk_venda_local` FOREIGN KEY (`id_local`) REFERENCES `tbl_local` (`id_local`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_venda`
--

LOCK TABLES `tbl_venda` WRITE;
/*!40000 ALTER TABLE `tbl_venda` DISABLE KEYS */;
INSERT INTO `tbl_venda` VALUES (1,'2026-05-13 16:35:32',27.80,'DÉBITO',1,NULL,'DASHBOARD','FINALIZADA','Está na mesa 27.','2026-05-13 16:35:32','2026-05-13 17:18:47'),(2,'2026-05-18 09:10:00',42.70,'DÉBITO',2,NULL,'DASHBOARD','FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-18 13:53:46'),(3,'2026-05-18 10:25:00',25.80,'CRÉDITO',3,NULL,'DASHBOARD','FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-20 14:26:00'),(4,'2026-05-18 12:40:00',57.60,'CRÉDITO',4,NULL,'DASHBOARD','FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-18 13:54:26'),(5,'2026-05-18 15:05:00',35.80,'DINHEIRO',5,NULL,'DASHBOARD','FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-18 13:54:42'),(6,'2026-05-18 17:30:00',47.70,'PIX',6,NULL,'DASHBOARD','EM ANDAMENTO','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-09-24 18:00:41'),(11,'2026-09-24 18:31:59',71.60,'PIX',2,5,'DASHBOARD','FINALIZADA',NULL,'2026-09-24 18:31:59','2026-09-24 18:32:45'),(12,'2026-09-24 18:53:28',0.00,NULL,2,6,'DASHBOARD','EM ANDAMENTO',NULL,'2026-09-24 18:53:28','2026-09-24 18:53:28');
/*!40000 ALTER TABLE `tbl_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2026-09-08 18:11:36','$2y$12$rKdNLQcuQBYsHoBkkotlnOBl2bQYYHISUE5IdWqHexj8JheD45UQ2','FydaMbf73x','2026-09-08 18:11:36','2026-09-08 18:11:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-24 19:28:46
