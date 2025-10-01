# 🚀 Guia de Configuração - FitPlan Academy

## Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- ✅ **PHP 8.1+** com extensões:
  - `php-pgsql` (PostgreSQL)
  - `php-mbstring`
  - `php-xml`
  - `php-curl`
  - `php-zip`
  
- ✅ **Composer** (gerenciador de dependências PHP)
- ✅ **PostgreSQL 12+**
- ✅ **Redis** (opcional, mas recomendado)
- ✅ **Git**

## Instalação Passo a Passo

### 1. Instalar Dependências

```bash
# Instalar dependências PHP via Composer
composer install
```

### 2. Configurar Ambiente

```bash
# Copiar arquivo de exemplo
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

### 3. Configurar Banco de Dados PostgreSQL

#### Criar banco de dados:

```sql
-- Conecte-se ao PostgreSQL
psql -U postgres

-- Crie o banco de dados
CREATE DATABASE fitplan_academy;

-- Crie um usuário (opcional)
CREATE USER fitplan_user WITH ENCRYPTED PASSWORD 'senha_segura';
GRANT ALL PRIVILEGES ON DATABASE fitplan_academy TO fitplan_user;
```

#### Configurar .env:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=fitplan_academy
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
```

### 4. Executar Migrations

```bash
# Executar migrations para criar as tabelas
php artisan migrate

# (Opcional) Popular banco com dados de teste
php artisan db:seed
```

### 5. Iniciar Servidor

```bash
# Iniciar servidor de desenvolvimento
php artisan serve

# A aplicação estará disponível em:
# http://localhost:8000
```

## 🧪 Testando a API

### Endpoints Públicos

#### 1. Registrar Usuário

```bash
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "João Silva",
    "email": "joao@email.com",
    "password": "senha123",
    "password_confirmation": "senha123"
  }'
```

#### 2. Login

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "joao@email.com",
    "password": "senha123"
  }'
```

**Resposta**:
```json
{
  "message": "Login realizado com sucesso",
  "data": {
    "user": {...},
    "token": "1|seu-token-aqui",
    "token_type": "Bearer"
  }
}
```

### Endpoints Protegidos

Use o token recebido no login:

#### 3. Buscar Usuário Autenticado

```bash
curl -X GET http://localhost:8000/api/auth/me \
  -H "Authorization: Bearer SEU_TOKEN_AQUI"
```

#### 4. Listar Usuários

```bash
curl -X GET http://localhost:8000/api/users \
  -H "Authorization: Bearer SEU_TOKEN_AQUI"
```

## 🔧 Comandos Úteis

### Artisan Commands

```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Listar rotas
php artisan route:list

# Criar nova migration
php artisan make:migration create_exemplo_table

# Executar testes
php artisan test
```

### Composer Commands

```bash
# Atualizar dependências
composer update

# Instalar nova dependência
composer require nome/pacote

# Gerar autoload
composer dump-autoload
```

### PostgreSQL Commands

```bash
# Conectar ao banco
psql -U postgres -d fitplan_academy

# Listar tabelas
\dt

# Descrever tabela
\d users

# Executar query
SELECT * FROM users;
```

## 🐳 Docker (Opcional)

Se preferir usar Docker:

```bash
# Criar arquivo docker-compose.yml
# (arquivo já está no projeto)

# Iniciar containers
docker-compose up -d

# Executar migrations no container
docker-compose exec app php artisan migrate

# Acessar container
docker-compose exec app bash
```

## ⚙️ Configurações Avançadas

### Redis Cache

Se quiser usar Redis para cache e sessões:

```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Variáveis de Ambiente Importantes

```env
# Performance
CACHE_DRIVER=redis          # file, redis, memcached
SESSION_DRIVER=redis        # file, redis, database
QUEUE_CONNECTION=redis      # sync, redis, database

# Logs
LOG_CHANNEL=stack           # single, daily, slack
LOG_LEVEL=debug            # debug, info, warning, error

# Mail (para reset de senha)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

## 🧪 Executando Testes

```bash
# Executar todos os testes
php artisan test

# Executar testes com coverage
php artisan test --coverage

# Executar teste específico
php artisan test --filter=UserTest
```

## 📊 Monitoramento

### Verificar Status da API

```bash
curl http://localhost:8000/api/health
```

**Resposta**:
```json
{
  "status": "ok",
  "timestamp": "2024-01-01T10:00:00.000000Z",
  "service": "FitPlan Academy API"
}
```

## 🔒 Segurança

### Checklist de Produção

- [ ] Mudar `APP_DEBUG=false`
- [ ] Mudar `APP_ENV=production`
- [ ] Gerar `APP_KEY` forte
- [ ] Configurar SSL/HTTPS
- [ ] Configurar CORS adequadamente
- [ ] Backup automático do banco
- [ ] Logs de auditoria
- [ ] Rate limiting em endpoints sensíveis

## 🆘 Troubleshooting

### Erro: "Could not find driver"

```bash
# Instalar extensão PostgreSQL do PHP
# Ubuntu/Debian:
sudo apt-get install php-pgsql

# macOS (via Homebrew):
brew install php-pgsql
```

### Erro: "SQLSTATE[08006]"

- Verificar se PostgreSQL está rodando
- Verificar credenciais no `.env`
- Verificar se o banco foi criado

### Erro: "Class 'Redis' not found"

```bash
# Instalar extensão Redis do PHP
# Ubuntu/Debian:
sudo apt-get install php-redis

# macOS:
brew install php-redis
```

## 📞 Suporte

- 📧 Email: suporte@fitplanacademy.com
- 📖 Documentação: [README.md](README.md)
- 🏗️ Arquitetura: [ARCHITECTURE.md](ARCHITECTURE.md)

---

✨ **Projeto configurado e pronto para desenvolvimento!**

