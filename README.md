# FitPlan Academy

## 📋 Sobre o Projeto

Sistema completo de **gestão de academia** com **landing page de vendas**, **checkout**, **pagamento** e **área de membros**. Desenvolvido com **Laravel** utilizando **Clean Architecture** (Arquitetura Limpa), organizado por features/módulos para facilitar manutenção e escalabilidade.

## 🎯 Fluxo Completo Implementado

```
Landing Page → Escolha de Plano → Checkout → Pagamento → Confirmação → Login → Dashboard
```

- ✅ **Landing Page** profissional com planos dinâmicos
- ✅ **Sistema de Checkout** com formulário de pagamento
- ✅ **Confirmação de Pagamento** com página de sucesso
- ✅ **Login Integrado** com autenticação via API
- ✅ **3 Planos** (Basic, Smart, Black) com preços e funcionalidades


## 🏗️ Arquitetura

Este projeto segue os princípios da **Clean Architecture**, organizando o código em camadas bem definidas:

```
app/
├── Features/                    # Módulos/Features do sistema
│   ├── Auth/                   # Feature de Autenticação
│   │   ├── Domain/            # Camada de Domínio (Entidades, Regras de Negócio)
│   │   ├── Application/       # Camada de Aplicação (Use Cases, DTOs)
│   │   ├── Infrastructure/    # Camada de Infraestrutura (Repositories, External Services)
│   │   └── Presentation/      # Camada de Apresentação (Controllers, Requests, Resources)
│   └── User/                   # Feature de Usuários
│       ├── Domain/
│       ├── Application/
│       ├── Infrastructure/
│       └── Presentation/
├── Shared/                     # Código compartilhado entre features
│   ├── Domain/                # Interfaces e abstrações comuns
│   ├── Infrastructure/        # Implementações comuns
│   └── Exceptions/            # Exceções customizadas
└── Http/
    └── Middleware/            # Middlewares globais
```

### Princípios Aplicados

- **SOLID**: Cada classe tem uma única responsabilidade
- **DDD**: Domain-Driven Design para regras de negócio
- **Repository Pattern**: Abstração da camada de dados
- **Dependency Injection**: Inversão de controle
- **DTO Pattern**: Data Transfer Objects para tráfego de dados

## 🚀 Tecnologias

- **PHP 8.1+**
- **Laravel 10.x**
- **PostgreSQL** (Banco de dados principal)
- **Eloquent ORM** (Object-Relational Mapping)
- **Laravel Sanctum** (Autenticação API)
- **Redis** (Cache e Sessions)

## 📦 Instalação

### Pré-requisitos

- PHP 8.1 ou superior
- Composer
- PostgreSQL
- Redis (opcional, mas recomendado)

### Passos

1. Clone o repositório:
```bash
git clone <repository-url>
cd fitplan_acadamy
```

2. Instale as dependências:
```bash
composer install
```

3. Configure o arquivo `.env`:
```bash
cp .env.example .env
```

4. Gere a chave da aplicação:
```bash
php artisan key:generate
```

5. Configure o banco de dados PostgreSQL no `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=fitplan_academy
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

6. Execute as migrations:
```bash
php artisan migrate
```

7. (Opcional) Execute os seeders para dados de teste:
```bash
php artisan db:seed
```

8. Inicie o servidor:
```bash
php artisan serve
```

## 🔐 Autenticação

O sistema utiliza **Laravel Sanctum** para autenticação de API com tokens.

### Endpoints de Autenticação

```
POST   /api/auth/register     - Registro de novo usuário
POST   /api/auth/login        - Login
POST   /api/auth/logout       - Logout
GET    /api/auth/me           - Dados do usuário autenticado
```

## 📚 Documentação da API

### Usuários

```
GET    /api/users             - Listar usuários (paginado)
GET    /api/users/{id}        - Buscar usuário específico
POST   /api/users             - Criar novo usuário
PUT    /api/users/{id}        - Atualizar usuário
DELETE /api/users/{id}        - Deletar usuário
```

## 🧪 Testes

Execute os testes com:

```bash
php artisan test
```

## 📝 Padrões de Código

### Estrutura de uma Feature

Cada feature segue a estrutura:

```
Feature/
├── Domain/
│   ├── Entities/              # Entidades de domínio
│   ├── ValueObjects/          # Objetos de valor
│   ├── Repositories/          # Interfaces de repositórios
│   └── Services/              # Serviços de domínio
├── Application/
│   ├── UseCases/              # Casos de uso
│   ├── DTOs/                  # Data Transfer Objects
│   └── Services/              # Serviços de aplicação
├── Infrastructure/
│   ├── Repositories/          # Implementação dos repositórios
│   ├── Models/                # Eloquent Models
│   └── External/              # Serviços externos
└── Presentation/
    ├── Controllers/           # Controllers HTTP
    ├── Requests/              # Form Requests (validação)
    ├── Resources/             # API Resources (serialização)
    └── Routes/                # Rotas da feature
```

## 🤝 Contribuindo

1. Sempre comente seu código
2. Siga os princípios SOLID
3. Escreva testes para novas funcionalidades
4. Use os padrões estabelecidos na arquitetura

## 📄 Licença

Este projeto está sob a licença MIT.

