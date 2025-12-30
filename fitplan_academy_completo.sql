-- ========================================
-- FitPlan Academy - Banco de Dados Completo
-- ========================================
-- Gerado em: 2025-11-23
-- Versão: MySQL 9.4.0
-- Charset: utf8mb4_unicode_ci

-- Criar banco de dados se não existir
CREATE DATABASE IF NOT EXISTS `fitplan_academy` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar o banco de dados
USE `fitplan_academy`;

-- ========================================
-- ESTRUTURA DAS TABELAS
-- ========================================

-- Tabela de Usuários
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complement` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'comum',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_cpf_unique` (`cpf`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_login_unique` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Planos
DROP TABLE IF EXISTS `plans`;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `duration_months` int NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Assinaturas
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_user_id_foreign` (`user_id`),
  KEY `subscriptions_plan_id_foreign` (`plan_id`),
  CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Pagamentos
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `subscription_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_date` date DEFAULT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `payments_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Checkouts
DROP TABLE IF EXISTS `checkouts`;
CREATE TABLE `checkouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `checkout_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkouts_user_id_foreign` (`user_id`),
  KEY `checkouts_plan_id_foreign` (`plan_id`),
  CONSTRAINT `checkouts_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Logs de Acesso
DROP TABLE IF EXISTS `access_logs`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Treinos dos Alunos
DROP TABLE IF EXISTS `student_workouts`;
CREATE TABLE `student_workouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `workout_date` date NOT NULL,
  `exercise_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sets` int NOT NULL,
  `reps` int NOT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_workouts_user_id_foreign` (`user_id`),
  CONSTRAINT `student_workouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Metas dos Alunos
DROP TABLE IF EXISTS `student_goals`;
CREATE TABLE `student_goals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `goal_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_value` decimal(10,2) NOT NULL,
  `current_value` decimal(10,2) DEFAULT '0.00',
  `target_date` date NOT NULL,
  `is_achieved` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_goals_user_id_foreign` (`user_id`),
  CONSTRAINT `student_goals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Reset de Senha
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Tokens de Acesso Pessoal
DROP TABLE IF EXISTS `personal_access_tokens`;
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

-- Tabela de Migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- DADOS INICIAIS
-- ========================================

-- Inserir usuários padrão
INSERT INTO `users` (`name`, `cpf`, `email`, `phone`, `cep`, `street`, `number`, `complement`, `district`, `city`, `state`, `login`, `password`, `role`, `is_active`, `email_verified_at`, `created_at`, `updated_at`) VALUES
('Administrador', '111.111.111-11', 'admin@fitplanacademy.com', '(11) 99999-1111', '01001-000', 'Praça da Sé', '100', NULL, 'Sé', 'São Paulo', 'SP', 'ADMIN', '$2y$12$XtM3qZ1XQ6qHQyQii6dHK.NmAwJC9yOysZLJtyzGdbl4BylI028BC', 'comum', 1, '2025-11-23 19:01:27', '2025-11-23 19:01:27', '2025-11-23 19:01:27'),
('Administrador Master', '000.000.000-00', 'master@fitplan.com.br', '(11) 99999-9999', '01000-000', 'Rua Master', '1', 'Admin', 'Centro', 'São Paulo', 'SP', 'MASTER', '$2y$12$B1wL8M8d9Q2wK3jN4pO5eO5r6Q7s8T9u0V1wX2yZ3a4b5c6d7e8f9g0h1i2j3k', 'master', 1, '2025-11-23 19:01:27', '2025-11-23 19:01:27', '2025-11-23 19:01:27'),
('Sophia', '222.222.222-22', 'sophia@fitplanacademy.com', '(11) 99999-2222', '01310-100', 'Av. Paulista', '1000', NULL, 'Bela Vista', 'São Paulo', 'SP', 'SOPHIA', '$2y$12$E3fG4hI5jJ6kL7mN8oP9qR0sT1uV2wX3yZ4a5b6c7d8e9f0g1h2i3j4k5l6m7', 'comum', 1, '2025-11-23 19:01:27', '2025-11-23 19:01:27', '2025-11-23 19:01:27');

-- Inserir planos
INSERT INTO `plans` (`name`, `description`, `price`, `duration_months`, `is_active`, `created_at`, `updated_at`) VALUES
('Plano Básico', 'Acesso à academia das 6h às 14h', 89.90, 1, 1, NOW(), NOW()),
('Plano Premium', 'Acesso integral + avaliação física mensal', 149.90, 1, 1, NOW(), NOW()),
('Plano Master', 'Acesso integral + personal trainer 2x/semana', 299.90, 1, 1, NOW(), NOW()),
('Plano Anual', 'Acesso integral + benefícios especiais', 1199.90, 12, 1, NOW(), NOW());

-- Inserir migrations
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2024_01_01_000000_create_users_table', 1),
('2024_01_01_000001_create_password_reset_tokens_table', 1),
('2024_01_01_000003_create_plans_table', 1),
('2024_01_01_000004_create_subscriptions_table', 1),
('2024_01_01_000005_create_payments_table', 1),
('2025_10_01_135324_create_checkouts_table', 1),
('2025_10_02_133142_create_access_logs_table', 1),
('2025_10_04_162449_create_student_workouts_table', 1),
('2025_10_04_162455_create_student_goals_table', 1),
('2025_10_08_143929_add_missing_fields_to_users_table', 1);

-- ========================================
-- RELATÓRIO FINAL
-- ========================================
SELECT 'FitPlan Academy - Banco de dados criado com sucesso!' AS mensagem;
SELECT COUNT(*) AS total_tabelas FROM information_schema.tables WHERE table_schema = 'fitplan_academy';
SELECT COUNT(*) AS total_usuarios FROM users;
SELECT COUNT(*) AS total_planos FROM plans;
