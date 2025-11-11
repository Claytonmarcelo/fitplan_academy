# 🚀 Configuração do XAMPP para FitPlan Academy

Este guia irá te ajudar a configurar o XAMPP e permitir acesso de outras máquinas na rede.

## 📋 Pré-requisitos

- **XAMPP** instalado (Windows, Linux ou macOS)
- **PHP 8.1+** (incluído no XAMPP)
- **Composer** instalado
- Máquinas na mesma rede

## 🔧 Passo 1: Instalar e Configurar XAMPP

### 1.1. Instalar XAMPP

1. Baixe o XAMPP do site oficial: https://www.apachefriends.org/
2. Instale o XAMPP na sua máquina
3. Inicie o **XAMPP Control Panel**

### 1.2. Iniciar Serviços do XAMPP

1. No **XAMPP Control Panel**, inicie os seguintes serviços:
   - ✅ **Apache** (servidor web)
   - ✅ **MySQL** (banco de dados)

2. Verifique se os serviços estão rodando (ícone verde)

## 🗄️ Passo 2: Configurar MySQL no XAMPP

### 2.1. Acessar phpMyAdmin

1. Abra o navegador e acesse: `http://localhost/phpmyadmin`
2. Faça login (usuário: `root`, senha: vazio por padrão no XAMPP)

### 2.2. Criar Banco de Dados

1. Clique em **"Novo"** no menu lateral
2. Nome do banco: `fitplan_academy`
3. Collation: `utf8mb4_unicode_ci`
4. Clique em **"Criar"**

### 2.3. Criar Usuário MySQL (Opcional, recomendado)

1. Vá em **"Contas de usuário"** → **"Adicionar conta de usuário"**
2. Preencha:
   - **Nome de usuário**: `fitplan`
   - **Nome do host**: `%` (permite acesso de qualquer máquina)
   - **Senha**: `fitplan123` (ou a senha que preferir)
3. Marque **"Conceder todos os privilégios"**
4. Clique em **"Continuar"**

### 2.4. Permitir Conexões Remotas (Importante!)

1. Edite o arquivo `my.ini` do MySQL (geralmente em `C:\xampp\mysql\bin\my.ini` no Windows)
2. Procure pela linha `bind-address = 127.0.0.1`
3. Comente ou altere para: `bind-address = 0.0.0.0`
4. Reinicie o MySQL no XAMPP Control Panel

**Ou via SQL no phpMyAdmin:**
```sql
-- Permitir conexões de qualquer host
UPDATE mysql.user SET host='%' WHERE user='root' AND host='localhost';
FLUSH PRIVILEGES;
```

## 🔧 Passo 3: Configurar o Projeto Laravel

### 3.1. Configurar arquivo .env

Abra o arquivo `.env` na raiz do projeto e configure:

```env
APP_NAME="FitPlan Academy"
APP_ENV=local
APP_KEY=base64:SUA_CHAVE_AQUI
APP_DEBUG=true
APP_URL=http://SEU_IP_LOCAL:8000

# Configuração do Banco de Dados XAMPP
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitplan_academy
DB_USERNAME=root
DB_PASSWORD=

# Ou use o usuário criado:
# DB_USERNAME=fitplan
# DB_PASSWORD=fitplan123

# Configuração de Sessão para Rede
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=null

# Permitir acesso de outras máquinas
TRUSTED_PROXIES=*
```

### 3.2. Descobrir seu IP Local

**Windows:**
```cmd
ipconfig
```
Procure por **"IPv4 Address"** (ex: 192.168.1.100)

**Linux/macOS:**
```bash
ifconfig
# ou
ip addr show
```
Procure por **"inet"** na interface de rede (ex: 192.168.1.100)

### 3.3. Atualizar APP_URL

No arquivo `.env`, altere:
```env
APP_URL=http://SEU_IP_LOCAL:8000
```

Exemplo:
```env
APP_URL=http://192.168.1.100:8000
```

## 🚀 Passo 4: Executar Migrations e Seeders

### 4.1. Executar Migrations

```bash
php artisan migrate
```

### 4.2. Criar Usuário Master

```bash
php artisan db:seed --class=MasterUserSeeder
```

## 🌐 Passo 5: Iniciar Servidor para Acesso em Rede

### 5.1. Iniciar Servidor Laravel

**IMPORTANTE:** Use `--host=0.0.0.0` para permitir acesso de outras máquinas:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### 5.2. Verificar Firewall

**Windows:**
1. Abra **"Windows Defender Firewall"**
2. Clique em **"Configurações Avançadas"**
3. Clique em **"Regras de Entrada"** → **"Nova Regra"**
4. Selecione **"Porta"** → **"TCP"** → Porta **8000**
5. Permita a conexão

**Linux:**
```bash
sudo ufw allow 8000/tcp
```

**macOS:**
1. Vá em **"Preferências do Sistema"** → **"Segurança"** → **"Firewall"**
2. Clique em **"Opções de Firewall"**
3. Adicione regra para porta 8000

## 🔍 Passo 6: Testar Acesso

### 6.1. Testar na Máquina Local

1. Abra o navegador e acesse: `http://localhost:8000`
2. Deve carregar a landing page

### 6.2. Testar de Outra Máquina na Rede

1. Na outra máquina, abra o navegador
2. Acesse: `http://SEU_IP_LOCAL:8000`
   - Exemplo: `http://192.168.1.100:8000`
3. Deve carregar a landing page

### 6.3. Testar Cadastro

1. Acesse: `http://SEU_IP_LOCAL:8000/cadastro`
2. Preencha o formulário
3. Clique em **"Cadastrar"**
4. Deve redirecionar para o dashboard

### 6.4. Testar Login

1. Acesse: `http://SEU_IP_LOCAL:8000/login`
2. Use as credenciais:
   - **Login**: MASTER
   - **Senha**: Master123
3. Clique em **"Entrar"**
4. Deve redirecionar para o dashboard

## 🐛 Solução de Problemas

### Problema: Não consegue acessar de outra máquina

**Solução:**
1. Verifique se o servidor está rodando com `--host=0.0.0.0`
2. Verifique o firewall (porta 8000 deve estar aberta)
3. Verifique se as máquinas estão na mesma rede
4. Verifique o IP local: `ipconfig` (Windows) ou `ifconfig` (Linux/macOS)

### Problema: Erro de conexão com banco de dados

**Solução:**
1. Verifique se o MySQL está rodando no XAMPP
2. Verifique as credenciais no `.env`
3. Teste a conexão: `mysql -u root -p fitplan_academy`
4. Verifique se o banco `fitplan_academy` foi criado

### Problema: Erro 419 (CSRF Token Mismatch)

**Solução:**
1. Limpe o cache: `php artisan cache:clear`
2. Limpe as sessões: `php artisan session:clear`
3. Verifique se `SESSION_DOMAIN=null` no `.env`
4. Verifique se `APP_URL` está correto no `.env`

### Problema: Sessão expirada

**Solução:**
1. Aumente `SESSION_LIFETIME` no `.env` (ex: 480 minutos)
2. Verifique se `SESSION_DRIVER=file` no `.env`
3. Limpe as sessões antigas: `php artisan session:clear`

### Problema: Não consegue fazer login

**Solução:**
1. Verifique se o usuário Master foi criado: `php artisan db:seed --class=MasterUserSeeder`
2. Verifique as credenciais no banco de dados
3. Limpe o cache: `php artisan cache:clear`
4. Verifique os logs: `storage/logs/laravel.log`

## 📝 Scripts Úteis

### Script para Iniciar Servidor (Windows)

Crie um arquivo `start-xampp.bat`:

```batch
@echo off
title FitPlan Academy - XAMPP
echo 🏋️‍♂️ Iniciando FitPlan Academy com XAMPP...

REM Verificar se XAMPP está rodando
net start mysql >nul 2>&1
if %errorLevel% neq 0 (
    echo ⚠️  MySQL não está rodando. Inicie o XAMPP Control Panel.
    pause
    exit
)

REM Navegar para o diretório do projeto
cd /d "%~dp0"

REM Iniciar servidor Laravel
echo 🚀 Iniciando servidor Laravel...
php artisan serve --host=0.0.0.0 --port=8000

pause
```

### Script para Iniciar Servidor (Linux/macOS)

Crie um arquivo `start-xampp.sh`:

```bash
#!/bin/bash

echo "🏋️‍♂️ Iniciando FitPlan Academy com XAMPP..."

# Verificar se MySQL está rodando
if ! pgrep -x "mysqld" > /dev/null; then
    echo "⚠️  MySQL não está rodando. Inicie o XAMPP Control Panel."
    exit 1
fi

# Navegar para o diretório do projeto
cd "$(dirname "$0")"

# Iniciar servidor Laravel
echo "🚀 Iniciando servidor Laravel..."
php artisan serve --host=0.0.0.0 --port=8000
```

Torne executável:
```bash
chmod +x start-xampp.sh
```

## 📊 Credenciais Padrão

### Usuário Master
- **Login**: MASTER
- **Senha**: Master123
- **Email**: master@fitplan.com.br

### Banco de Dados XAMPP
- **Host**: 127.0.0.1 (localhost)
- **Porta**: 3306
- **Banco**: fitplan_academy
- **Usuário**: root (padrão XAMPP)
- **Senha**: (vazio por padrão no XAMPP)

## 🌐 Acesso em Rede

### URL Local
- **Máquina local**: `http://localhost:8000`
- **Outras máquinas**: `http://SEU_IP_LOCAL:8000`

### Exemplo
Se seu IP local for `192.168.1.100`:
- **Máquina local**: `http://localhost:8000`
- **Outras máquinas**: `http://192.168.1.100:8000`

## ✅ Checklist de Configuração

- [ ] XAMPP instalado e rodando
- [ ] Apache iniciado no XAMPP
- [ ] MySQL iniciado no XAMPP
- [ ] Banco de dados `fitplan_academy` criado
- [ ] Arquivo `.env` configurado
- [ ] `APP_URL` configurado com IP local
- [ ] Migrations executadas (`php artisan migrate`)
- [ ] Usuário Master criado (`php artisan db:seed --class=MasterUserSeeder`)
- [ ] Servidor iniciado com `--host=0.0.0.0`
- [ ] Firewall configurado (porta 8000)
- [ ] Testado acesso local
- [ ] Testado acesso de outra máquina
- [ ] Testado cadastro
- [ ] Testado login

## 🎉 Pronto!

Agora o FitPlan Academy está configurado para funcionar com XAMPP e permitir acesso de outras máquinas na rede!

Para mais informações, consulte a documentação do Laravel: https://laravel.com/docs

