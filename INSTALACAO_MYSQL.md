# 🏋️ FitPlan Academy - Instalação MySQL + phpMyAdmin

## 📋 Pré-requisitos

- ✅ **XAMPP/WAMP/MAMP** instalado com MySQL
- ✅ **phpMyAdmin** funcionando
- ✅ **PHP 8.1+**
- ✅ **Composer**

## 🚀 Passo a Passo Completo

### 1. 🌐 Configurar phpMyAdmin

1. **Abra o phpMyAdmin** (geralmente: http://localhost/phpmyadmin)
2. **Execute o script SQL** que está em: `database_mysql_setup.sql`
3. **Ou execute manualmente:**

```sql
-- Criar banco de dados
CREATE DATABASE fitplan_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar o banco
USE fitplan_academy;
```

### 2. 📁 Configurar Projeto

```bash
# Navegar para o projeto
cd /Users/eduardocruz/fitplan_acadamy

# Configurar .env para MySQL
cp .env.example .env
```

**Editar `.env` com suas credenciais MySQL:**
```env
# Configuração MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitplan_academy
DB_USERNAME=root
DB_PASSWORD=suasua_senha_aqui

# Outras configurações...
APP_KEY=
APP_DEBUG=true
```

### 3. 🔑 Gerar Chave da Aplicação

```bash
php artisan key:generate
```

### 4. 📊 Executar Migrations

```bash
php artisan migrate --database=mysql
```

Isso criará as seguintes tabelas:
- ✅ `users` - Usuários do sistema
- ✅ `plans` - Planos de academia  
- ✅ `access_logs` - Logs de acesso
- ✅ `password_reset_tokens` - Tokens de reset
- ✅ `personal_access_tokens` - Tokens do Sanctum
- ✅ `checkouts` - Checkouts
- ✅ `subscriptions` - Assinaturas
- ✅ `payments` - Pagamentos

### 5. 👤 Criar Usuário Master

```bash
php artisan db:seed --class=MasterUserSeeder
```

**Credenciais criadas:**
- **Login:** `MASTER`
- **Senha:** `Master123`
- **Email:** `master@fitplan.com.br`

### 6. 📈 Preencher Dados de Planos

```bash
php artisan db:seed --class=PlanSeeder
```

### 7. ⚡ Criar Cache de Configuração

```bash
php artisan config:cache
php artisan route:cache
```

### 8. 🎯 Iniciar Servidor

```bash
php artisan serve
```

**Acesse:** http://localhost:8000

## 🔍 Verificação no phpMyAdmin

Após a instalação, verifique no phpMyAdmin:

### 📋 Tabelas Criadas:
```sql
USE fitplan_academy;
SHOW TABLES;
```

### 👥 Usuários:
```sql
SELECT id, name, login, email, profile, is_active FROM users;
```

### 🎯 Planos:
```sql
SELECT id, name, description, price, is_active FROM plans;
```

### 📊 Logs:
```sql
SELECT COUNT(*) as total_logs FROM access_logs;
```

## 🎉 Acesso ao Sistema

### 🏠 **Landing Page**
```
http://localhost:8000
```

### 🔐 **Login**
```
http://localhost:8000/login
Login: MASTER
Senha: Master123
```

### 👥 **Cadastro**
```
http://localhost:8000/register
```

### 📊 **Dashboard (após login)**
```
http://localhost:8000/dashboard
```

## 🔧 Solução de Problemas

### ❌ **Erro de Conexão MySQL**
```
Check your .env DB credentials
Certifique-se de que o MySQL está rodando
```

### ❌ **Erro "Table doesn't exist"**
```bash
php artisan migrate:fresh
php artisan db:seed --class=MasterUserSeeder
```

### ❌ **Erro "Class not found"**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### ❌ **Erro de Permissões**
```bash
chmod -R 775 storage bootstrap/cache
```

## 📊 Estrutura do Banco

```sql
-- Usuários (Master e Comum)
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60),
    cpf VARCHAR(14) UNIQUE,
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(20),
    cep VARCHAR(9),
    street VARCHAR(255),
    number VARCHAR(10),
    complement VARCHAR(255),
    district VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(2),
    login VARCHAR(6) UNIQUE,
    password VARCHAR(255),
    profile ENUM('master', 'comum'),
    is_active BOOLEAN DEFAULT TRUE,
    two_factor_secret VARCHAR(255),
    two_factor_confirmed_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Logs de Acesso
CREATE TABLE access_logs (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT,
    user_name VARCHAR(60),
    user_cpf VARCHAR(14),
    user_login VARCHAR(6),
    ip_address VARCHAR(45),
    user_agent TEXT,
    two_factor_used BOOLEAN DEFAULT FALSE,
    login_successful BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## ✅ Funcionalidades Disponíveis

### 👑 **Usuário Master:**
- ✅ Gerenciar todos os usuários
- ✅ Visualizar logs de acesso
- ✅ Exportar PDFs
- ✅ Acesso total ao sistema

### 👤 **Usuários Comum:**
- ✅ Cadastro público
- ✅ Login com 2FA
- ✅ Alterar dados próprios
- ✅ Alterar senha

## 🎨 Recursos Implementados

- ✅ **Design responsivo** Bootstrap 5
- ✅ **Validações brasileiras** (CPF, CEP, telefone)
- ✅ **Barra de acessibilidade**
- ✅ **Toasts elegantes**
- ✅ **Sistema de logs completo**
- ✅ **Controle de acesso por perfis**

**🎊 Sistema completo funcionando com MySQL e phpMyAdmin!**
