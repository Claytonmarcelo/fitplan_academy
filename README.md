# FitPlan Academy

## 📋 Sobre o Projeto

Sistema completo de **gestão de academia** com **landing page de vendas**, **checkout brasileiro**, **pagamento** e **área de membros**. Desenvolvido com **Laravel** utilizando **Clean Architecture** (Arquitetura Limpa), organizado por features/módulos para facilitar manutenção e escalabilidade.

## 🎯 Fluxo Completo Implementado

```
Landing Page → Escolha de Plano → Checkout → Pagamento → Confirmação → Success Page
```

- ✅ **Landing Page** profissional com planos dinâmicos e destaque visual
- ✅ **Sistema de Checkout** com formulário brasileiro completo
- ✅ **Modal de Loading** com blur e animações performáticas
- ✅ **Página de Sucesso** com dados da compra
- ✅ **3 Planos** (Basic, Smart, Black) com preços e funcionalidades
- ✅ **API do Brasil** integrada para CEP e endereços
- ✅ **Formatação brasileira** para CPF, telefone e CEP

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
│   ├── User/                   # Feature de Usuários
│   ├── Plan/                   # Feature de Planos
│   ├── Checkout/               # Feature de Checkout
│   └── Success/                 # Feature de Página de Sucesso
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
- **Docker** (Ambiente de desenvolvimento)
- **Tailwind CSS** (Styling performático)
- **ViaCEP API** (Busca de endereços)

## 🎨 Features Implementadas

### 🏠 Landing Page
- **Design responsivo** com Tailwind CSS
- **3 planos** com destaque visual para "Smart"
- **Animações suaves** e transições
- **Dark mode** nativo
- **Performance otimizada** com CSS crítico inline

### 💳 Checkout Brasileiro
- **Formulário completo** com validações brasileiras
- **CPF** com formatação automática (000.000.000-00)
- **Telefone** com formatação brasileira ((11) 99999-9999)
- **CEP** com formatação e busca automática via ViaCEP
- **Endereço dinâmico** que aparece ao digitar CEP
- **3 métodos de pagamento**: Cartão, PIX, Boleto
- **Validações robustas** com mensagens em português

### ⚡ Modal de Loading
- **Backdrop blur** para efeito de desfoque
- **Spinner animado** com ícone de pagamento
- **Steps de progresso** visuais
- **Animações performáticas** com GPU acceleration
- **Fallback automático** para garantir redirecionamento

### 🎉 Página de Sucesso
- **Design moderno** com informações da compra
- **Dados formatados** do checkout
- **Botão para conta** do usuário
- **Link de suporte** integrado
- **Performance otimizada** com CSS crítico

## 📦 Instalação

### Pré-requisitos

- PHP 8.1 ou superior
- Composer
- Docker e Docker Compose (recomendado)
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

### 🐳 Instalação com Docker

Para desenvolvimento com Docker:

1. Configure o ambiente Docker:
```bash
cp .env.docker .env
```

2. Inicie os containers:
```bash
docker-compose up -d
```

3. Execute as migrations:
```bash
docker-compose exec app php artisan migrate
```

4. Acesse a aplicação:
```
http://localhost:8000
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

### Planos

```
GET    /api/plans             - Listar planos disponíveis
GET    /api/plans/{id}        - Buscar plano específico
```

### Checkout

```
GET    /checkout/{plan}       - Página de checkout
POST   /checkout/{plan}       - Processar checkout
GET    /success/{plan}/{checkout} - Página de sucesso
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
│   ├── Providers/             # Service Providers
│   └── External/              # Serviços externos
└── Presentation/
    ├── Controllers/           # Controllers HTTP
    ├── Requests/              # Form Requests (validação)
    ├── Resources/             # API Resources (serialização)
    └── Views/                 # Blade templates
```

## 🎯 Funcionalidades Brasileiras

### 🇧🇷 Formatação Automática
- **CPF**: 000.000.000-00
- **Telefone**: (11) 99999-9999
- **CEP**: 00000-000

### 🌐 API do Brasil
- **ViaCEP** integrada para busca de endereços
- **Preenchimento automático** de rua, bairro, cidade, estado
- **Validações brasileiras** rigorosas

### 💰 Métodos de Pagamento
- **Cartão de Crédito** com validações
- **PIX** com informações específicas
- **Boleto** com instruções

## 🚀 Performance

### ⚡ Otimizações Implementadas
- **CSS crítico** inline para above-the-fold
- **Preload** de recursos críticos
- **GPU acceleration** para animações
- **Lazy loading** de recursos não críticos
- **Minificação** automática do Tailwind

### 📱 Responsividade
- **Mobile-first** design
- **Breakpoints** otimizados
- **Touch-friendly** interfaces
- **Performance** em dispositivos móveis

## 🤝 Contribuindo

1. Sempre comente seu código
2. Siga os princípios SOLID
3. Escreva testes para novas funcionalidades
4. Use os padrões estabelecidos na arquitetura
5. Mantenha a separação por features
6. Documente novas funcionalidades

## 📄 Licença

Este projeto está sob a licença MIT.

## 🎉 Status do Projeto

- ✅ **Landing Page** - Implementada
- ✅ **Checkout Brasileiro** - Implementado
- ✅ **Modal de Loading** - Implementado
- ✅ **Página de Sucesso** - Implementada
- ✅ **API do Brasil** - Integrada
- ✅ **Formatação Brasileira** - Implementada
- ✅ **Performance** - Otimizada
- ✅ **Responsividade** - Implementada

**🎯 Projeto completo e funcional com arquitetura limpa, código performático e escalável!**