-- MySQL dump 10.13  Distrib 9.4.0, for macos15.4 (arm64)
--
-- Host: 127.0.0.1    Database: fitplan_academy
-- ------------------------------------------------------
-- Server version	9.4.0

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
-- Table structure for table `access_logs`
--

DROP TABLE IF EXISTS `access_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `access_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `user_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_login` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_used` tinyint(1) NOT NULL DEFAULT '0',
  `login_successful` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_logs_user_id_created_at_index` (`user_id`,`created_at`),
  KEY `access_logs_user_cpf_created_at_index` (`user_cpf`,`created_at`),
  KEY `access_logs_created_at_login_successful_index` (`created_at`,`login_successful`),
  CONSTRAINT `access_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_logs`
--

LOCK TABLES `access_logs` WRITE;
/*!40000 ALTER TABLE `access_logs` DISABLE KEYS */;
INSERT INTO `access_logs` VALUES (1,2,'Administrador Master','000.000.000-00','MASTER','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Safari/605.1.15',0,1,'2025-11-22 22:03:38','2025-11-22 22:03:38'),(2,3,'Sophia','222.222.222-22','SOPHIA','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Safari/605.1.15',0,1,'2025-11-22 22:03:47','2025-11-22 22:03:47'),(3,2,'Administrador Master','000.000.000-00','MASTER','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Safari/605.1.15',0,1,'2025-11-22 22:06:08','2025-11-22 22:06:08'),(4,2,'Administrador Master','000.000.000-00','MASTER','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Safari/605.1.15',0,1,'2025-11-22 22:23:11','2025-11-22 22:23:11'),(5,3,'Sophia','222.222.222-22','SOPHIA','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Safari/605.1.15',0,1,'2025-11-22 22:23:30','2025-11-22 22:23:30'),(6,2,'Administrador Master','000.000.000-00','MASTER','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Safari/605.1.15',0,1,'2025-11-22 22:59:23','2025-11-22 22:59:23'),(7,3,'Sophia','222.222.222-22','SOPHIA','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Safari/605.1.15',0,1,'2025-11-22 22:59:31','2025-11-22 22:59:31');
/*!40000 ALTER TABLE `access_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkouts`
--

DROP TABLE IF EXISTS `checkouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `checkouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` bigint unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cvc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `taxes` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkouts_email_status_index` (`email`,`status`),
  KEY `checkouts_plan_id_status_index` (`plan_id`,`status`),
  KEY `checkouts_transaction_id_index` (`transaction_id`),
  CONSTRAINT `checkouts_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkouts`
--

LOCK TABLES `checkouts` WRITE;
/*!40000 ALTER TABLE `checkouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkouts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2024_01_01_000000_create_users_table',1),(3,'2024_01_01_000001_create_password_reset_tokens_table',1),(4,'2024_01_01_000003_create_plans_table',1),(5,'2024_01_01_000004_create_subscriptions_table',1),(6,'2024_01_01_000005_create_payments_table',1),(7,'2025_10_01_135324_create_checkouts_table',1),(8,'2025_10_02_133142_create_access_logs_table',1),(9,'2025_10_04_162449_create_student_workouts_table',1),(10,'2025_10_04_162455_create_student_goals_table',1),(11,'2025_10_08_143929_add_missing_fields_to_users_table',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tokens para reset de senha';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `subscription_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` enum('credit_card','debit_card','pix','boleto') COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_data` json DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_subscription_id_foreign` (`subscription_id`),
  KEY `payments_status_index` (`status`),
  CONSTRAINT `payments_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `features` json NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plans_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Basic','Ideal para iniciantes',79.90,'[\"Acesso a equipamentos básicos\", \"Treino livre\", \"Vestiário com armários\", \"Horário: 6h às 22h\"]',1,'2025-11-22 22:03:17','2025-11-22 22:03:17'),(2,'Smart','Mais popular entre nossos alunos',129.90,'[\"Todos os benefícios do Basic\", \"Aulas coletivas incluídas\", \"Avaliação física trimestral\", \"App de treinos personalizado\", \"Horário: 5h às 23h\"]',1,'2025-11-22 22:03:17','2025-11-22 22:03:17'),(3,'Black','Premium e completo',199.90,'[\"Todos os benefícios do Smart\", \"Personal trainer 2x por mês\", \"Nutricionista incluso\", \"Acesso a todas as unidades\", \"Acesso 24 horas\", \"Sala VIP\", \"Convidados ilimitados\"]',1,'2025-11-22 22:03:17','2025-11-22 22:03:17'),(4,'Basic','Ideal para iniciantes',79.90,'[\"Acesso a equipamentos básicos\", \"Treino livre\", \"Vestiário com armários\", \"Horário: 6h às 22h\"]',1,'2025-11-23 22:01:56','2025-11-23 22:01:56'),(5,'Smart','Mais popular entre nossos alunos',129.90,'[\"Todos os benefícios do Basic\", \"Aulas coletivas incluídas\", \"Avaliação física trimestral\", \"App de treinos personalizado\", \"Horário: 5h às 23h\"]',1,'2025-11-23 22:01:57','2025-11-23 22:01:57'),(6,'Black','Premium e completo',199.90,'[\"Todos os benefícios do Smart\", \"Personal trainer 2x por mês\", \"Nutricionista incluso\", \"Acesso a todas as unidades\", \"Acesso 24 horas\", \"Sala VIP\", \"Convidados ilimitados\"]',1,'2025-11-23 22:01:57','2025-11-23 22:01:57');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_goals`
--

DROP TABLE IF EXISTS `student_goals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_goals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_value` decimal(10,2) NOT NULL,
  `target_unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `target_date` date NOT NULL,
  `is_achieved` tinyint(1) NOT NULL DEFAULT '0',
  `achieved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_goals_user_id_target_date_index` (`user_id`,`target_date`),
  KEY `student_goals_is_achieved_created_at_index` (`is_achieved`,`created_at`),
  CONSTRAINT `student_goals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_goals`
--

LOCK TABLES `student_goals` WRITE;
/*!40000 ALTER TABLE `student_goals` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_goals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_workouts`
--

DROP TABLE IF EXISTS `student_workouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_workouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `workout_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_minutes` int NOT NULL,
  `exercises` json NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_workouts_user_id_created_at_index` (`user_id`,`created_at`),
  KEY `student_workouts_completed_created_at_index` (`completed`,`created_at`),
  CONSTRAINT `student_workouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_workouts`
--

LOCK TABLES `student_workouts` WRITE;
/*!40000 ALTER TABLE `student_workouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_workouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `status` enum('active','cancelled','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `starts_at` timestamp NOT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_user_id_foreign` (`user_id`),
  KEY `subscriptions_plan_id_foreign` (`plan_id`),
  KEY `subscriptions_status_index` (`status`),
  CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('M','F','O') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landline_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('master','comum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'comum',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `two_factor_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_cpf_unique` (`cpf`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_login_unique` (`login`),
  KEY `users_profile_is_active_index` (`role`,`is_active`),
  KEY `users_cpf_index` (`cpf`),
  KEY `users_login_index` (`login`),
  KEY `users_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador',NULL,NULL,NULL,'111.111.111-11','admin@fitplanacademy.com','(11) 99999-1111',NULL,'01001-000','Praça da Sé','100',NULL,'Sé','São Paulo','SP',NULL,'ADMIN','$2y$12$cymYjxMIPWSqoZKxDc3AEOkgxkxt57fZ29v7Jpj49UtEyk5z6Kz0y','comum',1,NULL,NULL,'2025-11-22 22:03:17',NULL,'2025-11-22 22:03:17','2025-11-22 22:03:17'),(2,'Administrador Master',NULL,NULL,NULL,'000.000.000-00','master@fitplan.com.br','(11) 99999-9999',NULL,'01000-000','Rua Master','1','Admin','Centro','São Paulo','SP',NULL,'MASTER','$2y$12$BlYAeqXRL6/5bVRV/0U4neR9Z7QBFJkQ/66D3Z8qHGlcPFAM.nAAK','master',1,NULL,NULL,'2025-11-22 22:03:17',NULL,'2025-11-22 22:03:17','2025-11-22 22:03:17'),(3,'Sophia',NULL,NULL,NULL,'222.222.222-22','sophia@fitplanacademy.com','(11) 99999-2222',NULL,'01310-100','Av. Paulista','1000',NULL,'Bela Vista','São Paulo','SP',NULL,'SOPHIA','$2y$12$2NWmcswnUi69Rubt2hUIbOWR/F6KY1P8lQkACWU8Z2x6VlXmX2m7y','comum',1,NULL,NULL,'2025-11-22 22:03:17',NULL,'2025-11-22 22:03:17','2025-11-22 22:03:17');
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

-- Dump completed on 2025-11-23 16:04:09
