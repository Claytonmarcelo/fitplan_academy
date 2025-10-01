# 🐳 Setup com Docker - FitPlan Academy

## 📦 O que está incluído

- ✅ **PostgreSQL 15** (porta 5432)
- ✅ **Redis** (porta 6379)
- ✅ **Nginx** (porta 8000)
- ✅ **PHP 8.2-FPM**
- ✅ **PgAdmin** (porta 5050) - Interface visual para PostgreSQL

---

## 🚀 Instalação Rápida

### 1. Copiar arquivo de ambiente

```bash
cp .env.docker .env
```

### 2. Iniciar containers

```bash
docker-compose up -d
```

### 3. Instalar dependências

```bash
docker-compose exec app composer install
```

### 4. Gerar chave da aplicação

```bash
docker-compose exec app php artisan key:generate
```

### 5. Executar migrations

```bash
docker-compose exec app php artisan migrate
```

### 6. Executar seeders

```bash
docker-compose exec app php artisan db:seed
```

### 7. Acessar aplicação

```
http://localhost:8000
```

---

## 🔧 Comandos Úteis

### Gerenciar Containers

```bash
# Iniciar containers
docker-compose up -d

# Parar containers
docker-compose down

# Ver logs
docker-compose logs -f

# Ver logs de um serviço específico
docker-compose logs -f app

# Restartar containers
docker-compose restart
```

### Executar Comandos Laravel

```bash
# Artisan
docker-compose exec app php artisan [comando]

# Composer
docker-compose exec app composer [comando]

# Migrations
docker-compose exec app php artisan migrate

# Seeders
docker-compose exec app php artisan db:seed

# Limpar cache
docker-compose exec app php artisan cache:clear
```

### Acessar Container

```bash
# Entrar no container da aplicação
docker-compose exec app bash

# Entrar no PostgreSQL
docker-compose exec postgres psql -U fitplan -d fitplan_academy
```

---

## 🗄️ Acessar Banco de Dados

### Opção 1: PgAdmin (Interface Visual)

Acesse: **http://localhost:5050**

```
Email: admin@fitplanacademy.com
Senha: admin123
```

**Configurar conexão:**
1. Clique em "Add New Server"
2. General → Name: `FitPlan Academy`
3. Connection:
   - Host: `postgres`
   - Port: `5432`
   - Database: `fitplan_academy`
   - Username: `fitplan`
   - Password: `fitplan123`

### Opção 2: Via Terminal

```bash
docker-compose exec postgres psql -U fitplan -d fitplan_academy
```

### Opção 3: Cliente local (TablePlus, DBeaver, etc)

```
Host: localhost
Port: 5432
Database: fitplan_academy
Username: fitplan
Password: fitplan123
```

---

## 📊 Portas Utilizadas

| Serviço | Porta | URL |
|---------|-------|-----|
| Aplicação (Nginx) | 8000 | http://localhost:8000 |
| PostgreSQL | 5432 | localhost:5432 |
| Redis | 6379 | localhost:6379 |
| PgAdmin | 5050 | http://localhost:5050 |

---

## 🔐 Credenciais

### Banco de Dados (PostgreSQL)

```
Host: postgres (dentro do Docker) / localhost (fora)
Port: 5432
Database: fitplan_academy
Username: fitplan
Password: fitplan123
```

### PgAdmin

```
Email: admin@fitplanacademy.com
Senha: admin123
```

### Aplicação (Usuários de teste)

```
Admin:
Email: admin@fitplanacademy.com
Senha: password123

Teste:
Email: teste@fitplanacademy.com
Senha: password123
```

---

## 🐛 Troubleshooting

### Porta 8000 já está em uso

```bash
# Parar o servidor local
# Ctrl+C no terminal onde está rodando php artisan serve

# Ou mudar a porta no docker-compose.yml
# nginx → ports → "8001:80"
```

### Erro de permissão

```bash
# Dar permissão às pastas
sudo chmod -R 777 storage bootstrap/cache
```

### Container não inicia

```bash
# Ver logs
docker-compose logs

# Rebuild containers
docker-compose down
docker-compose up -d --build
```

### Erro ao conectar no banco

```bash
# Verificar se o container está rodando
docker-compose ps

# Verificar logs do PostgreSQL
docker-compose logs postgres

# Reiniciar containers
docker-compose restart
```

---

## 🔄 Reset Completo

```bash
# Parar e remover containers
docker-compose down

# Remover volumes (apaga dados do banco)
docker-compose down -v

# Rebuild e iniciar
docker-compose up -d --build

# Instalar dependências
docker-compose exec app composer install

# Gerar chave
docker-compose exec app php artisan key:generate

# Migrations e seeders
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

---

## 📦 Estrutura Docker

```
fitplan_acadamy/
├── docker/
│   └── nginx/
│       └── default.conf    ← Config Nginx
├── docker-compose.yml       ← Orquestração
├── Dockerfile               ← Build da aplicação
└── .env.docker              ← Variáveis de ambiente
```

---

## 🚀 Deploy para Produção

### Configurações necessárias:

1. **.env para produção**
```env
APP_ENV=production
APP_DEBUG=false
DB_PASSWORD=senha_forte_aqui
```

2. **docker-compose.prod.yml**
```yaml
# Remover pgadmin
# Adicionar SSL/HTTPS
# Usar volumes nomeados
```

3. **Otimizações**
```bash
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

---

## ✅ Checklist de Setup

- [ ] Docker instalado
- [ ] Docker Compose instalado
- [ ] `cp .env.docker .env` executado
- [ ] `docker-compose up -d` executado
- [ ] `docker-compose exec app composer install` executado
- [ ] `docker-compose exec app php artisan key:generate` executado
- [ ] `docker-compose exec app php artisan migrate` executado
- [ ] `docker-compose exec app php artisan db:seed` executado
- [ ] Acessar http://localhost:8000
- [ ] Acessar http://localhost:5050 (PgAdmin)

---

## 🎉 Pronto!

Seu ambiente Docker está configurado!

**Acessos:**
- 🌐 Aplicação: http://localhost:8000
- 🗄️ PgAdmin: http://localhost:5050
- 📊 PostgreSQL: localhost:5432
- 🔴 Redis: localhost:6379

**Comandos principais:**
```bash
# Iniciar
docker-compose up -d

# Parar
docker-compose down

# Ver logs
docker-compose logs -f

# Executar artisan
docker-compose exec app php artisan [comando]
```

**🚀 Acesse agora: http://localhost:8000**

