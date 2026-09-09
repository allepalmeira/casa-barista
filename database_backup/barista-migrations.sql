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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);
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
INSERT INTO `sessions` VALUES ('ca03StQM0O5Fhjs8o8ywFMClv0vzfXGykaKnnpmI',NULL,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','eyJfdG9rZW4iOiJyRWFHRTZYamFHNkhEWHFOQVllSEpSZmNMblVpVjBndGgzRnd2SW8zIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvY2F0ZWdvcmlhIiwicm91dGUiOiJhZG1pbi5jYXRlZ29yaWEuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1788284285),('ogSa8jHaFqhnI4fqGX5nr7E29sIIP3Wvi8lMJuHx',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJFNld0WGtKRGM3VFZuajhsRUtYeDVRSExmVWZRNzdoOHBaYVhCR0lwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvYmFubmVyIiwicm91dGUiOiJhZG1pbi5iYW5uZXIuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1788894713),('PRhIWkMRf2CgwF5fP9mE2czITTfY0s9D1hQSl52t',NULL,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','eyJfdG9rZW4iOiJtZEhYSmQxd0dXWHBuZ2pNWFVSQk5KVnNGYmJiUnhaSGhqNWpKdDlYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1788375324),('S40QbzxdTZyLb5eUh5pL3NDfTtVFs43PEChkyVii',NULL,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','eyJfdG9rZW4iOiJaTmFEZjJMUHUyMkk3VDhLbFdTTGl2RGNRMWhRNTlaRVRIb0lqYkkwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1788291825),('u6lpYAGfkH5f0iYtUAtwRlYhl5wO91iftT6z8PWf',NULL,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0','eyJfdG9rZW4iOiI1QzBYZ25FWWpLb21ZRWhRWFlnbjhCbXBFcmJNSENHS0hxeWQ2RzE3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvcHJvZHV0byIsInJvdXRlIjoiYWRtaW4ucHJvZHV0by5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1788206633),('uve7RfA4hcFsmDLUNEVjPbjSOriIzfmoZHhlg8TB',NULL,'172.18.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJCZ0Vjd0N1blFvTnlmOHo5blJhQWlaeGNlQ1NYTHFRbzFzczUzQ1NrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1788973421);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_banner`
--

LOCK TABLES `tbl_banner` WRITE;
/*!40000 ALTER TABLE `tbl_banner` DISABLE KEYS */;
INSERT INTO `tbl_banner` VALUES (1,'Promoção especial de inverno','banner/promocao_especial_de_inverno.png','ATIVO','2026-05-13 14:02:20','2026-05-20 14:09:27'),(2,'Festival de cafés especiais','banner/festival_de_cafes_especiais.png','ATIVO','2026-05-18 13:18:13','2026-05-18 13:18:13'),(3,'Semana do espresso','banner/semana_do_espresso.png','INATIVO','2026-05-18 13:18:13','2026-06-02 14:09:21'),(4,'Novos doces artesanais','banner/novos_doces_artesanais.png','ATIVO','2026-05-18 13:18:13','2026-08-20 20:07:11'),(5,'Café gelado da casa','banner/cafe_gelado_da_casa.png','ATIVO','2026-05-18 13:18:13','2026-05-18 13:18:13'),(6,'Combo da tarde','banner/combo_da_tarde.png','ATIVO','2026-05-18 13:18:13','2026-05-18 13:18:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galeria`
--

LOCK TABLES `tbl_galeria` WRITE;
/*!40000 ALTER TABLE `tbl_galeria` DISABLE KEYS */;
INSERT INTO `tbl_galeria` VALUES (1,'Ambiente Interno','galeria/ambiente_interno.png','ATIVO','2026-05-13 14:26:45','2026-05-13 14:26:45'),(2,'Barista preparando café','galeria/barista_preparando_cafe.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59'),(3,'Mesa com cappuccino','galeria/mesa_com_cappuccino.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59'),(4,'Vitrine de doces','galeria/vitrine_de_doces.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59'),(5,'Área externa','galeria/area_externa.png','INATIVO','2026-05-18 13:18:59','2026-08-31 17:17:36'),(6,'Clientes na cafeteria','galeria/clientes_na_cafeteria.png','ATIVO','2026-05-18 13:18:59','2026-05-18 13:18:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itens_venda`
--

LOCK TABLES `tbl_itens_venda` WRITE;
/*!40000 ALTER TABLE `tbl_itens_venda` DISABLE KEYS */;
INSERT INTO `tbl_itens_venda` VALUES (1,1,1,2.00,13.90,27.80,'CONFIRMADO','2026-05-13 17:04:33','2026-05-13 17:04:33'),(2,2,1,2.00,13.90,27.80,'CONFIRMADO','2026-05-18 13:53:46','2026-05-18 13:53:46'),(3,2,3,1.00,14.90,14.90,'CONFIRMADO','2026-05-18 13:53:46','2026-05-18 13:53:46'),(4,3,2,1.00,8.90,8.90,'CONFIRMADO','2026-05-18 13:54:07','2026-05-18 13:54:07'),(5,3,4,1.00,16.90,16.90,'CONFIRMADO','2026-05-18 13:54:07','2026-05-18 13:54:07'),(6,4,5,2.00,13.90,27.80,'CONFIRMADO','2026-05-18 13:54:26','2026-05-18 13:54:26'),(7,4,3,2.00,14.90,29.80,'CONFIRMADO','2026-05-18 13:54:26','2026-05-18 13:54:26'),(8,5,6,3.00,21.90,65.70,'CONFIRMADO','2026-05-18 13:54:42','2026-05-20 14:39:30'),(9,5,1,1.00,13.90,13.90,'CONFIRMADO','2026-05-18 13:54:42','2026-05-18 13:54:42'),(10,6,4,2.00,16.90,33.80,'CONFIRMADO','2026-05-18 13:55:09','2026-05-18 13:55:09'),(11,6,5,1.00,13.90,13.90,'CONFIRMADO','2026-05-18 13:55:09','2026-05-18 13:55:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_news`
--

LOCK TABLES `tbl_news` WRITE;
/*!40000 ALTER TABLE `tbl_news` DISABLE KEYS */;
INSERT INTO `tbl_news` VALUES (1,'pedro@gmail.com',1,'2026-05-13 14:20:54','2026-05-13 14:20:54'),(2,'newsletter01@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(3,'newsletter02@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(4,'newsletter03@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(5,'newsletter04@email.com',0,'2026-05-18 13:18:31','2026-05-18 13:18:31'),(6,'newsletter05@email.com',1,'2026-05-18 13:18:31','2026-05-18 13:18:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,'Pedro da Silva','pedro@casadobarista.com.br','senha123','usuario/pedro_da_silva.jpg','ADMINISTRADOR','ATIVO','2026-05-13 15:06:08','2026-05-13 15:06:08'),(2,'Carla Silva','carla@casadobarista.com.br','senha123','usuario/carla_silva.png','GERENTE','ATIVO','2026-05-18 13:35:19','2026-05-18 13:38:59'),(3,'Marcos Renato','marcos@casadobarista.com.br','senha123','usuario/marcos_renato.png','ATENDENTE','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:15'),(4,'Beatriz Costa','beatriz@casadobarista.com.br','senha123','usuario/beatriz_costa.png','CAIXA','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:31'),(5,'Felipe Souza','felipe@casadobarista.com.br','senha123','usuario/felipe_souza.png','BARISTA','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:45'),(6,'Renata Pereira','renata@casadobarista.com.br','senha123','usuario/renata_pereira.png','ATENDENTE','ATIVO','2026-05-18 13:35:19','2026-05-18 13:39:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios_venda`
--

LOCK TABLES `tbl_usuarios_venda` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios_venda` DISABLE KEYS */;
INSERT INTO `tbl_usuarios_venda` VALUES (1,1,1,'2026-05-13 16:39:34','2026-05-13 16:39:34'),(2,2,2,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(3,3,3,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(4,4,4,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(5,5,5,'2026-05-18 13:49:39','2026-05-18 13:49:39'),(6,6,6,'2026-05-18 13:49:39','2026-05-18 13:49:39');
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
  `forma_pagamento_venda` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_cliente` int NOT NULL,
  `status_venda` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'EM ANDAMENTO',
  `observacao_venda` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_venda`),
  KEY `fk_venda_cliente` (`id_cliente`),
  CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_venda`
--

LOCK TABLES `tbl_venda` WRITE;
/*!40000 ALTER TABLE `tbl_venda` DISABLE KEYS */;
INSERT INTO `tbl_venda` VALUES (1,'2026-05-13 16:35:32',27.80,'DÉBITO',1,'FINALIZADA','Está na mesa 27.','2026-05-13 16:35:32','2026-05-13 17:18:47'),(2,'2026-05-18 09:10:00',42.70,'DÉBITO',2,'FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-18 13:53:46'),(3,'2026-05-18 10:25:00',25.80,'CRÉDITO',3,'FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-20 14:26:00'),(4,'2026-05-18 12:40:00',57.60,'CRÉDITO',4,'FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-18 13:54:26'),(5,'2026-05-18 15:05:00',35.80,'DINHEIRO',5,'FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-18 13:54:42'),(6,'2026-05-18 17:30:00',47.70,'PIX',6,'FINALIZADA','Venda aguardando inclusão dos itens','2026-05-18 13:47:07','2026-05-18 13:55:09');
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

-- Dump completed on 2026-09-09 17:07:11
