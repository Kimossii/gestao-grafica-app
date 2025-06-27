-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: grafica
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.04.1

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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ativo','pendente','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Cadernetas','Pequena e Grandes','ativo','2025-05-30 11:18:14','2025-05-30 11:18:14');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '999999999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('ativo','pendente','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Consumidor final',NULL,'99999999',NULL,'999999999','2025-05-18 04:07:42','2025-06-01 13:19:49','ativo'),(3,'Paulo Da Silva','paulo@gmail.com','937945987','Angola/Luanda','898989348','2025-05-18 04:09:34','2025-05-18 04:09:34','ativo'),(5,'Tis Madame','tis@gmail.com','934099222','Luanda/Angola','5387282788','2025-05-29 14:46:36','2025-05-29 15:06:54','ativo');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas_a_pagares`
--

DROP TABLE IF EXISTS `contas_a_pagares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contas_a_pagares` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `status` enum('pendente','pago') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `fornecedor_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contas_a_pagares_fornecedor_id_foreign` (`fornecedor_id`),
  CONSTRAINT `contas_a_pagares_fornecedor_id_foreign` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas_a_pagares`
--

LOCK TABLES `contas_a_pagares` WRITE;
/*!40000 ALTER TABLE `contas_a_pagares` DISABLE KEYS */;
/*!40000 ALTER TABLE `contas_a_pagares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas_a_receberes`
--

DROP TABLE IF EXISTS `contas_a_receberes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contas_a_receberes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `data_recebimento` date DEFAULT NULL,
  `status` enum('pendente','recebido') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `cliente_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contas_a_receberes_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `contas_a_receberes_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas_a_receberes`
--

LOCK TABLES `contas_a_receberes` WRITE;
/*!40000 ALTER TABLE `contas_a_receberes` DISABLE KEYS */;
INSERT INTO `contas_a_receberes` VALUES (1,'Iphone 15 plus',650000.00,'2025-06-27',NULL,'pendente','Serve para 3 prestações.',5,'2025-06-13 12:46:30','2025-06-13 12:46:30'),(2,'Iphone 15 plus',900000.00,'2025-07-31','2025-06-28','recebido','Pagar por 2 prestações.',3,'2025-06-13 12:47:33','2025-06-13 13:15:38');
/*!40000 ALTER TABLE `contas_a_receberes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `fatura_itens`
--

DROP TABLE IF EXISTS `fatura_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fatura_itens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quantidade` int DEFAULT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `item_id` bigint unsigned NOT NULL,
  `item_tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fatura_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fatura_itens_fatura_id_foreign` (`fatura_id`),
  CONSTRAINT `fatura_itens_fatura_id_foreign` FOREIGN KEY (`fatura_id`) REFERENCES `faturas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fatura_itens`
--

LOCK TABLES `fatura_itens` WRITE;
/*!40000 ALTER TABLE `fatura_itens` DISABLE KEYS */;
INSERT INTO `fatura_itens` VALUES (15,1,7000.00,7000.00,1,'produto',24,'2025-06-02 19:30:49','2025-06-02 19:30:49','T-Sherts'),(16,3,15000.00,45000.00,1,'servico',25,'2025-06-02 19:31:37','2025-06-02 19:31:37','Manutenção de impressora'),(17,2,15000.00,30000.00,1,'servico',26,'2025-06-02 19:37:24','2025-06-02 19:37:24','Manutenção de impressora'),(18,2,7000.00,14000.00,1,'produto',27,'2025-06-02 19:57:23','2025-06-02 19:57:23','T-Sherts'),(19,2,15000.00,30000.00,1,'servico',27,'2025-06-02 19:57:23','2025-06-02 19:57:23','Manutenção de impressora'),(20,1,4000.00,4000.00,2,'produto',27,'2025-06-02 19:57:23','2025-06-02 19:57:23','Equipamento de Barcelona'),(21,2,4000.00,8000.00,2,'produto',28,'2025-06-14 12:42:29','2025-06-14 12:42:29','Equipamento de Barcelona'),(22,1,15000.00,15000.00,1,'servico',29,'2025-06-14 12:50:12','2025-06-14 12:50:12','Manutenção de impressora'),(23,1,15000.00,15000.00,1,'servico',30,'2025-06-14 12:58:07','2025-06-14 12:58:07','Manutenção de impressora'),(24,1,15000.00,15000.00,1,'servico',31,'2025-06-14 12:58:22','2025-06-14 12:58:22','Manutenção de impressora'),(25,1,15000.00,15000.00,1,'servico',32,'2025-06-14 13:02:17','2025-06-14 13:02:17','Manutenção de impressora'),(26,1,7000.00,7000.00,1,'produto',38,'2025-06-14 13:36:34','2025-06-14 13:36:34','T-Sherts'),(27,1,7000.00,7000.00,1,'produto',39,'2025-06-14 13:36:57','2025-06-14 13:36:57','T-Sherts');
/*!40000 ALTER TABLE `fatura_itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faturas`
--

DROP TABLE IF EXISTS `faturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faturas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_emissao` date DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `metodo_pagamento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` enum('fatura','recibo','fatura-recibo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fatura',
  `status` enum('pendente','pago','cancelado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `cliente_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faturas_cliente_id_foreign` (`cliente_id`),
  KEY `faturas_user_id_foreign` (`user_id`),
  CONSTRAINT `faturas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `faturas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faturas`
--

LOCK TABLES `faturas` WRITE;
/*!40000 ALTER TABLE `faturas` DISABLE KEYS */;
INSERT INTO `faturas` VALUES (24,'FT-00024','2025-06-07',7000.00,'Cache/TPA','fatura','pendente',1,1,'2025-06-02 19:30:49','2025-06-07 16:43:56'),(25,'FT-00025','2025-06-07',45000.00,'Cache/TPA','fatura','pendente',1,1,'2025-06-02 19:31:37','2025-06-07 16:34:37'),(26,'FR-00026','2025-06-07',30000.00,'TPA','fatura-recibo','pago',1,1,'2025-06-02 19:37:24','2025-06-07 17:35:59'),(27,'FR-00027','2025-06-07',48000.00,'Cache/TPA','fatura-recibo','pago',1,1,'2025-06-02 19:57:23','2025-06-07 17:35:29'),(28,'FR-00028','2025-06-14',8000.00,'TPA','fatura-recibo','pago',1,1,'2025-06-14 12:42:29','2025-06-14 12:42:29'),(29,'FT-00029','2025-06-14',15000.00,NULL,'fatura','pendente',3,1,'2025-06-14 12:50:12','2025-06-14 12:50:12'),(30,'FR-00030','2025-06-14',15000.00,'Cache','fatura-recibo','pago',1,1,'2025-06-14 12:58:07','2025-06-14 12:58:07'),(31,'FR-00031','2025-06-14',15000.00,'Cache','fatura-recibo','pago',1,1,'2025-06-14 12:58:22','2025-06-14 12:58:22'),(32,'FT-00032','2025-06-14',15000.00,NULL,'fatura','pendente',1,1,'2025-06-14 13:02:17','2025-06-14 13:02:17'),(33,'FT-00033','2025-06-14',0.00,NULL,'fatura','pendente',3,1,'2025-06-14 13:26:43','2025-06-14 13:26:43'),(34,'FT-00034','2025-06-14',0.00,NULL,'fatura','pendente',3,1,'2025-06-14 13:27:44','2025-06-14 13:27:44'),(35,'FT-00035','2025-06-14',0.00,NULL,'fatura','pendente',3,1,'2025-06-14 13:28:04','2025-06-14 13:28:04'),(36,'FT-00036','2025-06-14',0.00,NULL,'fatura','pendente',3,1,'2025-06-14 13:28:09','2025-06-14 13:28:09'),(37,'FT-00037','2025-06-14',0.00,NULL,'fatura','pendente',3,1,'2025-06-14 13:29:16','2025-06-14 13:29:16'),(38,'FT-00038','2025-06-14',7000.00,NULL,'fatura','pendente',1,1,'2025-06-14 13:36:34','2025-06-14 13:36:34'),(39,'FR-00039','2025-06-14',7000.00,NULL,'fatura-recibo','pago',5,1,'2025-06-14 13:36:57','2025-06-14 13:36:57');
/*!40000 ALTER TABLE `faturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fornecedores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('ativo','pendente','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'Tis, Lda','tiss@gmail.com','943888238','Luanda/Cazenga\r\ncazenga-Mediateca Zé du',NULL,'53872827866','2025-05-29 14:48:24','2025-05-29 14:48:24','ativo'),(3,'ENDE','ende@gmail.com','934099222','Luanda/Cazenga',NULL,'5387282787','2025-06-13 13:28:40','2025-06-13 13:28:40','ativo');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_05_18_035637_create_clintes_table',1),(5,'2025_05_18_043625_create_fornecedores_table',1),(6,'2025_05_18_043729_create_prdutos_table',1),(7,'2025_05_18_043739_create_faturas_table',1),(8,'2025_05_29_161835_create_servicos_table',2),(9,'2025_05_29_162812_create_categorias_table',2),(10,'2025_05_29_162817_create_produtos_table',2),(11,'2025_06_01_125410_create_faturas_table',3),(12,'2025_06_01_125500_create_fatura_itens_table',3),(13,'2025_06_01_125518_create_recibos_table',3),(14,'2025_06_13_123957_create_contas_a_pagares_table',4),(15,'2025_06_13_124008_create_contas_a_receberes_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `prdutos`
--

DROP TABLE IF EXISTS `prdutos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prdutos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `preco_unitario` decimal(10,2) NOT NULL,
  `estoque` int NOT NULL DEFAULT '0',
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prdutos_fornecedor_id_foreign` (`fornecedor_id`),
  CONSTRAINT `prdutos_fornecedor_id_foreign` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prdutos`
--

LOCK TABLES `prdutos` WRITE;
/*!40000 ALTER TABLE `prdutos` DISABLE KEYS */;
/*!40000 ALTER TABLE `prdutos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `preco_base` decimal(10,2) DEFAULT NULL,
  `largura` decimal(8,2) DEFAULT NULL,
  `altura` decimal(8,2) DEFAULT NULL,
  `quantidade_minima` int NOT NULL DEFAULT '0',
  `prazo_producao` int DEFAULT NULL,
  `tipo_papel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gramatura` int DEFAULT NULL,
  `cores` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acabamento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `categoria_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'T-Sherts','Teste de descrição',7000.00,24.00,23.00,5,NULL,'Teste de pepel',5,'verdes','Melhor','images/upload/capas/produtos/1748608572_fotocarregador.png','ativo',1,'2025-05-30 11:36:12','2025-05-30 11:36:12'),(2,'Equipamento de Barcelona','Barcelona',4000.00,3.00,3.00,3,1,'3',3,'Azul','Melhor','images/upload/capas/produtos/1748608898_barça.jpg','ativo',1,'2025-05-30 11:41:38','2025-06-01 11:17:00');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibos`
--

DROP TABLE IF EXISTS `recibos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recibos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data_pagamento` date DEFAULT NULL,
  `valor_pago` decimal(10,2) DEFAULT NULL,
  `metodo_pagamento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fatura_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recibos_fatura_id_foreign` (`fatura_id`),
  CONSTRAINT `recibos_fatura_id_foreign` FOREIGN KEY (`fatura_id`) REFERENCES `faturas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibos`
--

LOCK TABLES `recibos` WRITE;
/*!40000 ALTER TABLE `recibos` DISABLE KEYS */;
/*!40000 ALTER TABLE `recibos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `preco` decimal(10,2) NOT NULL,
  `prazo_estimado` int DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1,'Manutenção de impressora','Manutenção de impressora na cidade',15000.00,2,'Teste de categoria','ativo','2025-05-30 10:17:27','2025-05-30 10:17:27');
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('ThZCwQWIUiSwd1kdgc6uxMK8lqVzdCssf4bfJ43w',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZXN2eFpCZmJLQlFQWWtlRG9zMklpNW82RHA3RnR5QnlWQUJHNnNISCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9nZXN0YW8tZ3JhZmljYS1hcHAudGVzdC9mbHV4by1jYWl4YS9pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1751015678),('xyhyU2pPbbP9n8gXFuTpWcoYqeMaeQpHdv4Hj9Pl',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQnlaTEZVSFd6Y0JaaHJ2SWVpZ3hKSUVhTEREMms4OElKWFFMbFgwUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0OToiaHR0cDovL2dlc3Rhby1ncmFmaWNhLWFwcC50ZXN0L3NlcnZpY29zL2NhZGFzdHJhciI7fX0=',1750348631);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `perfil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT (_utf8mb4'admin'),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Teste User','teste@gmail.com',NULL,'$2y$12$9EzyKeNboLNvlZvlNQhW.e1/KqKrHf0v.aYvjhEsj6hay/FU39tUO',NULL,'ativo',NULL,'2025-05-18 03:42:47','2025-06-07 16:56:40','admin'),(2,'ANTONIO LUKAU','lukau@gmail.com',NULL,'$2y$12$k0a78zVB3XMBncBOCTs9i.q4Tw9A.Xf2dhJgbOH5lO0VB716MGDNm',NULL,'ativo',NULL,'2025-05-18 20:45:02','2025-06-07 16:52:00','vendedor'),(4,'Teste de Cadastros','cadastrars@gmail.com',NULL,'$2y$12$W.sjquDQOKpuXhJaaes3AODWJPsktJhHRwBcGASY7y7Dfu.sMLIgC','4778758','ativo',NULL,'2025-06-02 21:05:00','2025-06-02 21:16:31','admin');
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

-- Dump completed on 2025-06-27 10:16:25
