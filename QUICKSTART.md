# ⚡ Guia Rápido - FitPlan Academy

## 🚀 Início Rápido (5 minutos)

### 1. Instalar Dependências

```bash
composer install
npm install
```

### 2. Configurar Ambiente

```bash
# Copiar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

### 3. Configurar Banco PostgreSQL

**No .env, configure**:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=fitplan_academy
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
```

**Criar banco de dados**:
```sql
CREATE DATABASE fitplan_academy;
```

### 4. Executar Migrations

```bash
php artisan migrate
php artisan db:seed
```

### 5. Iniciar Servidor

```bash
php artisan serve
```

**Acesse**: http://localhost:8000

---

## 📝 Credenciais de Teste

Após executar `php artisan db:seed`:

```
Email: admin@fitplanacademy.com
Senha: password123
```

---

## 🧪 Testar API

### Opção 1: cURL

```bash
# Login
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@fitplanacademy.com","password":"password123"}'

# Listar Usuários (use o token recebido)
curl -X GET http://localhost:8000/api/users \
  -H "Authorization: Bearer SEU_TOKEN_AQUI"
```

### Opção 2: Postman

Importe o arquivo `postman_collection.json` no Postman!

### Opção 3: Frontend

Acesse http://localhost:8000 e veja a página com todos os endpoints!

---

## 📚 Estrutura do Projeto

```
app/
├── Features/
│   ├── Auth/          # Autenticação
│   │   ├── Domain/
│   │   ├── Application/
│   │   ├── Infrastructure/
│   │   └── Presentation/
│   └── User/          # Gerenciamento de Usuários
│       ├── Domain/
│       ├── Application/
│       ├── Infrastructure/
│       └── Presentation/
├── Shared/            # Código compartilhado
│   └── Exceptions/
└── Providers/         # Service Providers
```

---

## 🔥 Comandos Essenciais

```bash
# Migrations
php artisan migrate
php artisan migrate:fresh --seed    # Reset + seed

# Cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Testes
php artisan test
php artisan test --filter=UserTest

# Rotas
php artisan route:list

# Servidor
php artisan serve
php artisan serve --host=0.0.0.0 --port=8000
```

---

## 📦 Adicionar Nova Feature

```bash
# 1. Criar estrutura
mkdir -p app/Features/Produto/{Domain,Application,Infrastructure,Presentation}

# 2. Criar Entity (Domain)
# app/Features/Produto/Domain/Entities/ProdutoEntity.php

# 3. Criar Repository Interface (Domain)
# app/Features/Produto/Domain/Repositories/ProdutoRepositoryInterface.php

# 4. Criar Model (Infrastructure)
# app/Features/Produto/Infrastructure/Models/Produto.php

# 5. Implementar Repository (Infrastructure)
# app/Features/Produto/Infrastructure/Repositories/ProdutoRepository.php

# 6. Criar DTO (Application)
# app/Features/Produto/Application/DTOs/CreateProdutoDTO.php

# 7. Criar Use Case (Application)
# app/Features/Produto/Application/UseCases/CreateProdutoUseCase.php

# 8. Criar Controller (Presentation)
# app/Features/Produto/Presentation/Controllers/ProdutoController.php

# 9. Registrar no Service Provider
# app/Providers/AppServiceProvider.php

# 10. Adicionar rotas
# routes/api.php
```

---

## 🎯 Endpoints Disponíveis

### Autenticação

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| POST | `/api/auth/register` | Registrar usuário |
| POST | `/api/auth/login` | Login (gera token) |
| GET | `/api/auth/me` | Dados do usuário autenticado |
| POST | `/api/auth/logout` | Logout |

### Usuários (Autenticado)

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/users` | Listar usuários |
| GET | `/api/users/{id}` | Buscar usuário |
| POST | `/api/users` | Criar usuário |
| PUT | `/api/users/{id}` | Atualizar usuário |
| DELETE | `/api/users/{id}` | Deletar usuário |

---

## 🔒 Autenticação

### 1. Login

```bash
POST /api/auth/login
{
  "email": "admin@fitplanacademy.com",
  "password": "password123"
}
```

**Resposta**:
```json
{
  "data": {
    "user": {...},
    "token": "1|seu-token-aqui",
    "token_type": "Bearer"
  }
}
```

### 2. Usar Token

Adicione o header em todas as requisições protegidas:

```
Authorization: Bearer 1|seu-token-aqui
```

---

## 📖 Documentação Completa

- **README.md** - Visão geral e instalação
- **ARCHITECTURE.md** - Detalhes da arquitetura
- **SETUP.md** - Guia completo de configuração
- **CONTRIBUTING.md** - Como contribuir
- **QUICKSTART.md** - Este arquivo!

---

## 🆘 Problemas Comuns

### "Could not find driver"
```bash
# Instalar extensão PostgreSQL do PHP
sudo apt-get install php-pgsql  # Ubuntu
brew install php-pgsql          # macOS
```

### "SQLSTATE[08006]"
- Verificar se PostgreSQL está rodando
- Verificar credenciais no .env
- Verificar se o banco foi criado

### "Route not found"
```bash
php artisan route:clear
php artisan config:clear
```

---

## 💡 Próximos Passos

1. ✅ Explorar a API com Postman
2. ✅ Ler ARCHITECTURE.md para entender a estrutura
3. ✅ Criar sua primeira feature seguindo o padrão
4. ✅ Adicionar testes para novas funcionalidades
5. ✅ Configurar CI/CD para deploy

---

**🎉 Divirta-se desenvolvendo!**

