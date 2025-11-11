-- ========================================
-- Script de Configuração MySQL para XAMPP
-- FitPlan Academy
-- ========================================

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS fitplan_academy 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Usar o banco de dados
USE fitplan_academy;

-- Criar usuário para acesso local (opcional)
-- Descomente as linhas abaixo se quiser criar um usuário específico
/*
CREATE USER IF NOT EXISTS 'fitplan'@'localhost' IDENTIFIED BY 'fitplan123';
GRANT ALL PRIVILEGES ON fitplan_academy.* TO 'fitplan'@'localhost';
FLUSH PRIVILEGES;
*/

-- Permitir conexões remotas do usuário root (para desenvolvimento)
-- ATENÇÃO: Isso permite acesso de qualquer máquina na rede
-- Use apenas em ambiente de desenvolvimento!
UPDATE mysql.user SET host='%' WHERE user='root' AND host='localhost';
FLUSH PRIVILEGES;

-- Verificar configuração
SELECT user, host FROM mysql.user WHERE user='root';

-- ========================================
-- INSTRUÇÕES:
-- ========================================
-- 1. Abra o phpMyAdmin: http://localhost/phpmyadmin
-- 2. Clique em "SQL" no menu superior
-- 3. Cole este script e execute
-- 4. Ou execute via terminal: mysql -u root < xampp-mysql-setup.sql
--
-- IMPORTANTE:
-- - Este script permite conexões remotas do usuário root
-- - Use apenas em ambiente de desenvolvimento
-- - Para produção, crie usuários específicos com privilégios limitados
-- - Configure o firewall para proteger o MySQL

