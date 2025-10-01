# ⚡ Comandos Rápidos - FitPlan Academy

## 🚀 Setup Inicial (Copie e Cole)

```bash
# 1. Instalar dependências
composer install && npm install

# 2. Configurar ambiente
cp .env.example .env && php artisan key:generate

# 3. Edite o .env e configure PostgreSQL
# Depois execute:

# 4. Criar banco (PostgreSQL)
createdb fitplan_academy

# 5. Executar migrations e seeders
php artisan migrate && php artisan db:seed

# 6. Iniciar servidor
php artisan serve
```

Acesse: **http://localhost:8000**

---

## 🔄 Resetar Banco de Dados

```bash
# Apagar tudo e recriar
php artisan migrate:fresh --seed
```

---

## 🧹 Limpar Cache

```bash
# Limpar tudo
php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear
```

---

## 📋 Ver Informações

```bash
# Listar todas as rotas
php artisan route:list

# Listar rotas da API
php artisan route:list --path=api

# Listar rotas web
php artisan route:list --path=web
```

---

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Executar com coverage
php artisan test --coverage

# Executar teste específico
php artisan test --filter=UserApiTest
```

---

## 🗄️ Banco de Dados

```bash
# Criar nova migration
php artisan make:migration create_nome_table

# Criar model + migration
php artisan make:model Nome -m

# Criar seeder
php artisan make:seeder NomeSeeder

# Executar seeder específico
php artisan db:seed --class=NomeSeeder
```

---

## 🎨 Frontend

```bash
# Compilar assets
npm run dev

# Build para produção
npm run build

# Watch (desenvolvimento)
npm run dev -- --watch
```

---

## 🔐 Autenticação (API)

### Login

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@fitplanacademy.com",
    "password": "password123"
  }'
```

### Usar Token

```bash
# Copie o token do login e use:
curl -X GET http://localhost:8000/api/users \
  -H "Authorization: Bearer SEU_TOKEN_AQUI"
```

---

## 📦 Composer

```bash
# Instalar pacote
composer require nome/pacote

# Remover pacote
composer remove nome/pacote

# Atualizar autoload
composer dump-autoload

# Atualizar dependências
composer update
```

---

## 🔍 Debug

```bash
# Habilitar query log
# No arquivo .env:
# DB_LOG=true

# Ver logs
tail -f storage/logs/laravel.log

# Limpar logs
> storage/logs/laravel.log
```

---

## 🐳 Docker (Opcional)

```bash
# Criar containers
docker-compose up -d

# Parar containers
docker-compose down

# Ver logs
docker-compose logs -f

# Executar comando no container
docker-compose exec app php artisan migrate
```

---

## 📊 Produção

```bash
# Otimizar para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev

# Build frontend
npm run build
```

---

## 🆘 Solução de Problemas

### Erro de permissão

```bash
# Laravel precisa escrever em:
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

### Erro de autoload

```bash
composer dump-autoload
```

### Erro de CSRF

```bash
php artisan config:clear
```

### Erro de rotas

```bash
php artisan route:clear
php artisan cache:clear
```

---

## 🔑 Credenciais de Teste

```
📧 Admin
Email: admin@fitplanacademy.com
Senha: password123

📧 Teste
Email: teste@fitplanacademy.com
Senha: password123
```

---

## 📂 Arquivos Importantes

```
.env                 - Configurações
routes/web.php       - Rotas web
routes/api.php       - Rotas API
config/database.php  - Config banco
config/auth.php      - Config auth
```

---

## 🎯 Fluxo Rápido de Teste

1. Acesse: `http://localhost:8000`
2. Escolha um plano
3. Preencha checkout (cartão: `4111 1111 1111 1111`)
4. Confirme pagamento
5. Faça login: `admin@fitplanacademy.com` / `password123`

---

## 📱 Postman

```bash
# Importar collection
1. Abra Postman
2. Import → Upload Files
3. Selecione: postman_collection.json
4. Pronto! Todas as rotas disponíveis
```

---

## 🚀 Comandos Git

```bash
# Inicializar repositório
git init

# Adicionar remote
git remote add origin URL

# Primeiro commit
git add .
git commit -m "feat: projeto inicial FitPlan Academy"
git push -u origin main
```

---

## 📚 Documentação

- `README.md` - Visão geral
- `INSTALL_GUIDE.md` - Instalação
- `QUICKSTART.md` - Início rápido  
- `ARCHITECTURE.md` - Arquitetura
- `FLOW_COMPLETE.md` - Fluxo vendas
- `RESUMO_FINAL.md` - Resumo completo
- `CONTRIBUTING.md` - Contribuir
- `PROJECT_SUMMARY.md` - Resumo técnico

---

## ⚡ One-Liners Úteis

```bash
# Setup completo
composer install && cp .env.example .env && php artisan key:generate && php artisan migrate && php artisan db:seed && php artisan serve

# Reset completo
php artisan migrate:fresh --seed && php artisan cache:clear

# Limpar tudo
php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear

# Otimizar produção
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

---

**💡 Dica**: Salve este arquivo nos favoritos para acesso rápido!

