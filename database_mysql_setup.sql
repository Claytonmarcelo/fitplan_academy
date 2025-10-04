-- ===============================================
-- Script SQL para Configuração MySQL - FitPlan Academy
-- ===============================================

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS fitplan_academy 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Usar o banco
USE fitplan_academy;

-- ===============================================
-- TABELA DE PLANOS (PRE-ENCHIDA)
-- ===============================================

INSERT INTO plans (id, name, description, price, features, is_active, created_at, updated_at) VALUES
(1, 'Basic', 'Ideal para iniciantes', 79.90, '["Acesso a equipamentos básicos", "Treino livre", "Vestiário com armários", "Horário: 6h às 22h"]', 1, NOW(), NOW()),
(2, 'Smart', 'Mais popular entre nossos alunos', 129.90, '["Todos os benefícios do Basic", "Aulas coletivas incluídas", "Avaliação física trimestral", "App de treinos personalizado", "Horário: 5h às 23h"]', 1, NOW(), NOW()),
(3, 'Black', 'Premium e completo', 199.90, '["Todos os benefícios do Smart", "Personal trainer 2x por mês", "Nutricionista incluso", "Acesso a todas as unidades", "Acesso 24 horas", "Sala VIP", "Convidados ilimitados"]', 1, NOW(), NOW());

-- ===============================================
-- TABELAS DE TREINO E METAS DOS ALUNOS
-- ===============================================

-- Tabela de treinos dos alunos
CREATE TABLE IF NOT EXISTS student_workouts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    workout_name VARCHAR(255) NOT NULL,
    duration_minutes INT NOT NULL,
    exercises JSON NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    started_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_student_workouts_user_created (user_id, created_at),
    INDEX idx_student_workouts_completed (completed, created_at)
);

-- Tabela de metas dos alunos
CREATE TABLE IF NOT EXISTS student_goals (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    type VARCHAR(50) NOT NULL,
    target_value DECIMAL(10,2) NOT NULL,
    target_unit VARCHAR(10) NOT NULL,
    current_value DECIMAL(10,2) DEFAULT 0,
    target_date DATE NOT NULL,
    is_achieved BOOLEAN DEFAULT FALSE,
    achieved_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_student_goals_user_target (user_id, target_date),
    INDEX idx_student_goals_achieved (is_achieved, created_at)
);

-- ===============================================
-- USUÁRIO MASTER (RESET DE SENHA)
-- ===============================================

-- Obs: Use este comando para criar/resetar o usuário Master
-- A senha será: Master123 (hasheada com bcrypt)

INSERT INTO users (
    id, name, cpf, email, phone, cep, street, number, complement, 
    district, city, state, login, password, profile, is_active, 
    email_verified_at, created_at, updated_at
) VALUES (
    1,
    'Administrador Master',
    '000.000.000-00',
    'master@fitplan.com.br',
    '(11) 99999-9999',
    '01000-000',
    'Rua Master',
    '1',
    'Admin',
    'Centro',
    'São Paulo',
    'SP',
    'MASTER',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: Master123
    'master',
    1,
    NOW(),
    NOW(),
    NOW()
) ON DUPLICATE KEY UPDATE 
    name = VALUES(name),
    email = VALUES(email),
    phone = VALUES(phone),
    password = VALUES(password),
    updated_at = NOW();

-- ===============================================
-- VERIFICAÇÃO DE DADOS
-- ===============================================

-- Verificar se as tabellas foram criadas
SHOW TABLES;

-- Verificar usuários cadastrados
SELECT id, name, login, email, profile, is_active, created_at FROM users;

-- Verificar planos
SELECT id, name, description, price, is_active FROM plans;

-- ===============================================
-- INSTRUÇÕES DE USO
-- ===============================================

-- 1. Execute este script no phpMyAdmin
-- 2. Configure as credenciais no .env
-- 3. Execute: php artisan migrate
-- 4. Execute: php artisan db:seed --class=MasterUserSeeder
-- 5. Execute: php artisan key:generate
-- 6. Execute: php artisan config:cache
-- 7. Execute: php artisan serve

-- ===============================================
-- CREDENCIAIS DE ACESSO
-- ===============================================

-- Usuário Master:
-- Login: MASTER
-- Senha: Master123
-- Email: master@fitplan.com.br

-- Banco de dados:
-- Nome: fitplan_academy
-- Charset: utf8mb4_unicode_ci
-- Engine: InnoDB
