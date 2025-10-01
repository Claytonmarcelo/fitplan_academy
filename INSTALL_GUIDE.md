# 📦 Guia de Instalação Completo - FitPlan Academy

## 🚀 Instalação Rápida (5 minutos)

### 1. Instalar Dependências

```bash
composer install
npm install
```

### 2. Configurar Ambiente

```bash
# Copiar .env
cp .env.example .env

# Gerar chave
php artisan key:generate
```

### 3. Configurar PostgreSQL

**Edite o `.env`**:
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

### 4. Executar Migrations e Seeders

```bash
# Criar tabelas
php artisan migrate

# Popular com dados de teste
php artisan db:seed
```

**Isso criará**:
- ✅ 2 usuários (admin e teste)
- ✅ 3 planos (Basic, Smart, Black)

### 5. Iniciar Servidor

```bash
php artisan serve
```

Acesse: **http://localhost:8000**

---

## 🎯 Testando o Fluxo Completo

### 1. Acessar Landing Page

```
http://localhost:8000
```

Você verá:
- Hero section
- 3 planos disponíveis (Basic R$99, Smart R$149, Black R$249)
- Tabela de comparação
- Locais/unidades

### 2. Escolher um Plano

- Clique em **"Selecionar Plano"** em qualquer plano
- Será redirecionado para o checkout

### 3. Página de Checkout

```
http://localhost:8000/checkout/{plan_id}
```

Preencha:
- Nome completo
- Email
- Número do cartão: `4111 1111 1111 1111`
- Validade: `12/25`
- CVV: `123`

Clique em **"Finalizar Pagamento"**

### 4. Confirmação de Pagamento

```
http://localhost:8000/checkout/{plan_id}/success
```

Você verá:
- ✅ Confirmação de pagamento
- Detalhes do plano
- Botão "Fazer Login"

### 5. Fazer Login

```
http://localhost:8000/login
```

Use as credenciais:
```
Email: admin@fitplanacademy.com
Senha: password123
```

ou

```
Email: teste@fitplanacademy.com
Senha: password123
```

---

## 📊 Dados de Teste

### Usuários Criados

| Email | Senha | Tipo |
|-------|-------|------|
| admin@fitplanacademy.com | password123 | Admin |
| teste@fitplanacademy.com | password123 | Usuário |

### Planos Criados

| Plano | Preço | ID |
|-------|-------|-----|
| Basic | R$ 99,00 | 1 |
| Smart | R$ 149,00 | 2 |
| Black | R$ 249,00 | 3 |

---

## 🔧 Comandos Úteis

### Resetar Banco de Dados

```bash
# Apagar tudo e recriar
php artisan migrate:fresh --seed
```

### Limpar Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Ver Rotas

```bash
php artisan route:list
```

### Executar Testes

```bash
php artisan test
```

---

## 🌐 Rotas Disponíveis

### Frontend (Web)

| Rota | Método | Descrição |
|------|--------|-----------|
| `/` | GET | Landing Page |
| `/checkout/{plan}` | GET | Checkout |
| `/checkout/{plan}` | POST | Processar Pagamento |
| `/checkout/{plan}/success` | GET | Confirmação |
| `/login` | GET | Login |
| `/dashboard` | GET | Dashboard (protegido) |

### Backend (API)

| Rota | Método | Descrição |
|------|--------|-----------|
| `/api/auth/register` | POST | Registrar |
| `/api/auth/login` | POST | Login |
| `/api/auth/logout` | POST | Logout |
| `/api/auth/me` | GET | Usuário autenticado |
| `/api/users` | GET | Listar usuários |
| `/api/users/{id}` | GET | Buscar usuário |
| `/api/users` | POST | Criar usuário |
| `/api/users/{id}` | PUT | Atualizar usuário |
| `/api/users/{id}` | DELETE | Deletar usuário |

---

## 🧪 Testando a API

### 1. Login via API

```bash
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@fitplanacademy.com",
    "password": "password123"
  }'
```

**Resposta**:
```json
{
  "message": "Login realizado com sucesso",
  "data": {
    "user": {...},
    "token": "1|xxxxxxxxxxxx",
    "token_type": "Bearer"
  }
}
```

### 2. Usar Token

Copie o token e use em requisições protegidas:

```bash
curl -X GET http://localhost:8000/api/users \
  -H "Authorization: Bearer 1|xxxxxxxxxxxx"
```

---

## 📱 Postman Collection

Importe o arquivo `postman_collection.json` no Postman para testar todas as rotas facilmente!

**Passos**:
1. Abra o Postman
2. Import → Upload Files
3. Selecione `postman_collection.json`
4. Todas as rotas estarão disponíveis

---

## 🎨 Frontend

### Landing Page

- Design moderno com Tailwind CSS
- Responsivo (mobile-first)
- Planos dinâmicos do banco de dados
- Navegação suave com âncoras

### Checkout

- Formulário de pagamento
- Validação de dados
- Resumo do pedido
- Design profissional

### Login

- Integração com API via JavaScript
- Salvamento de token no localStorage
- Redirect automático após login

---

## 🔐 Segurança

### Dados Sensíveis

⚠️ **Nunca exponha em produção**:
- `.env` (já está no .gitignore)
- Senhas em texto puro
- Tokens de API

### Recomendações para Produção

```env
APP_ENV=production
APP_DEBUG=false
```

- Use HTTPS
- Configure CORS adequadamente
- Implemente rate limiting
- Ative logs de auditoria

---

## 💳 Gateway de Pagamento

### Atual (Demo)

O sistema atualmente **simula** pagamentos para demonstração.

### Para Produção

Integre com:

#### Stripe
```bash
composer require stripe/stripe-php
```

#### PagSeguro
```bash
composer require pagseguro/pagseguro-php-sdk
```

#### Mercado Pago
```bash
composer require mercadopago/dx-php
```

---

## 📚 Documentação Adicional

- **README.md** - Visão geral
- **ARCHITECTURE.md** - Arquitetura detalhada
- **SETUP.md** - Setup completo
- **QUICKSTART.md** - Início rápido
- **CONTRIBUTING.md** - Como contribuir
- **FLOW_COMPLETE.md** - Fluxo de vendas completo
- **PROJECT_SUMMARY.md** - Resumo do projeto

---

## 🆘 Problemas Comuns

### "SQLSTATE[08006]"
- Verificar se PostgreSQL está rodando
- Verificar credenciais no .env

### "Class 'App\Features\...' not found"
```bash
composer dump-autoload
```

### "419 Page Expired" (CSRF)
```bash
php artisan config:clear
```

### Rotas não funcionam
```bash
php artisan route:clear
php artisan cache:clear
```

---

## ✅ Checklist de Instalação

- [ ] Composer instalado
- [ ] PHP 8.1+ instalado
- [ ] PostgreSQL instalado e rodando
- [ ] Banco de dados criado
- [ ] `.env` configurado
- [ ] `php artisan key:generate` executado
- [ ] `php artisan migrate` executado
- [ ] `php artisan db:seed` executado
- [ ] `php artisan serve` rodando
- [ ] Acessar http://localhost:8000

---

## 🎉 Pronto!

Seu sistema FitPlan Academy está instalado e funcionando!

**Próximos passos**:
1. Explore a landing page
2. Teste o fluxo de checkout
3. Faça login no sistema
4. Teste a API com Postman
5. Customize conforme suas necessidades

---

**Desenvolvido com ❤️ usando Clean Architecture + Laravel + PostgreSQL**

