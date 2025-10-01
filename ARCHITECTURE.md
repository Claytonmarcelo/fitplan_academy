# 🏗️ Arquitetura do Projeto

## Visão Geral

Este projeto segue os princípios da **Clean Architecture** (Arquitetura Limpa) proposta por Robert C. Martin (Uncle Bob), adaptada para o ecossistema Laravel.

## Estrutura de Camadas

```
┌─────────────────────────────────────────┐
│         Presentation Layer              │
│  (Controllers, Requests, Resources)     │
└─────────────────┬───────────────────────┘
                  │
┌─────────────────▼───────────────────────┐
│        Application Layer                │
│     (Use Cases, DTOs, Services)         │
└─────────────────┬───────────────────────┘
                  │
┌─────────────────▼───────────────────────┐
│          Domain Layer                   │
│   (Entities, Value Objects, Repos)      │
└─────────────────┬───────────────────────┘
                  │
┌─────────────────▼───────────────────────┐
│      Infrastructure Layer               │
│  (Models, Repositories, External APIs)  │
└─────────────────────────────────────────┘
```

## Camadas Detalhadas

### 1. Domain Layer (Domínio)

**Responsabilidade**: Regras de negócio puras, independentes de framework

**Localização**: `app/Features/{Feature}/Domain/`

**Componentes**:
- **Entities**: Objetos de negócio com identidade única
- **Value Objects**: Objetos imutáveis sem identidade (ex: Email, CPF)
- **Repository Interfaces**: Contratos para persistência
- **Domain Services**: Lógica que não pertence a uma entidade específica

**Características**:
- ✅ Sem dependências de framework
- ✅ Testável isoladamente
- ✅ Contém regras de negócio críticas
- ❌ Não conhece banco de dados
- ❌ Não conhece HTTP

**Exemplo**:
```php
// UserEntity.php
class UserEntity {
    public function activate(): void {
        // Regra de negócio: ativar usuário
        $this->isActive = true;
    }
}
```

### 2. Application Layer (Aplicação)

**Responsabilidade**: Orquestrar casos de uso da aplicação

**Localização**: `app/Features/{Feature}/Application/`

**Componentes**:
- **Use Cases**: Implementam casos de uso específicos
- **DTOs**: Transferem dados entre camadas
- **Application Services**: Orquestram múltiplos use cases

**Características**:
- ✅ Orquestra o fluxo da aplicação
- ✅ Pode depender do Domain
- ✅ Sem conhecimento de HTTP
- ❌ Não acessa banco diretamente

**Exemplo**:
```php
// CreateUserUseCase.php
class CreateUserUseCase {
    public function execute(CreateUserDTO $dto): UserEntity {
        // 1. Validar regras de negócio
        // 2. Criar entidade
        // 3. Persistir via repository
    }
}
```

### 3. Infrastructure Layer (Infraestrutura)

**Responsabilidade**: Detalhes de implementação (banco, APIs externas)

**Localização**: `app/Features/{Feature}/Infrastructure/`

**Componentes**:
- **Eloquent Models**: ORM para banco de dados
- **Repository Implementations**: Implementação dos contratos do Domain
- **External Services**: Integrações com APIs externas

**Características**:
- ✅ Implementa interfaces do Domain
- ✅ Acessa banco de dados
- ✅ Usa Eloquent ORM
- ✅ Integrações externas

**Exemplo**:
```php
// UserRepository.php
class UserRepository implements UserRepositoryInterface {
    public function save(UserEntity $user): UserEntity {
        // Usa Eloquent para persistir
        $model = User::create([...]);
        return $this->toEntity($model);
    }
}
```

### 4. Presentation Layer (Apresentação)

**Responsabilidade**: Interface com o mundo externo (HTTP, CLI)

**Localização**: `app/Features/{Feature}/Presentation/`

**Componentes**:
- **Controllers**: Recebem requisições HTTP
- **Form Requests**: Validação de entrada
- **Resources**: Serialização de resposta
- **Routes**: Definição de rotas

**Características**:
- ✅ Ponto de entrada HTTP
- ✅ Validação de dados
- ✅ Formatação de resposta
- ✅ Chama Use Cases

**Exemplo**:
```php
// UserController.php
class UserController extends Controller {
    public function store(CreateUserRequest $request, CreateUserUseCase $useCase) {
        $dto = CreateUserDTO::fromArray($request->validated());
        $user = $useCase->execute($dto);
        return new UserResource($user);
    }
}
```

## Fluxo de uma Requisição

```
1. HTTP Request
   ↓
2. Route → Controller (Presentation)
   ↓
3. FormRequest valida dados
   ↓
4. DTO é criado
   ↓
5. Use Case é executado (Application)
   ↓
6. Entidade é manipulada (Domain)
   ↓
7. Repository persiste (Infrastructure)
   ↓
8. Resource serializa resposta (Presentation)
   ↓
9. HTTP Response (JSON)
```

## Princípios SOLID Aplicados

### Single Responsibility Principle (SRP)
- Cada classe tem uma única responsabilidade
- Controllers apenas recebem requests
- Use Cases contêm lógica de aplicação
- Entities contêm regras de negócio

### Open/Closed Principle (OCP)
- Aberto para extensão, fechado para modificação
- Novas features não modificam código existente
- Use interfaces e abstrações

### Liskov Substitution Principle (LSP)
- Implementações podem ser substituídas
- Repository pode ser trocado (SQL → NoSQL)

### Interface Segregation Principle (ISP)
- Interfaces específicas para cada necessidade
- Repository tem apenas métodos necessários

### Dependency Inversion Principle (DIP)
- **Camadas superiores dependem de abstrações**
- Use Cases dependem de interfaces, não implementações
- Service Provider faz o binding

## Vantagens desta Arquitetura

### ✅ Testabilidade
- Cada camada pode ser testada isoladamente
- Mock de dependências é simples
- Domain é testado sem banco de dados

### ✅ Manutenibilidade
- Código organizado por feature
- Fácil localizar e modificar
- Responsabilidades bem definidas

### ✅ Escalabilidade
- Adicionar features é simples
- Não afeta código existente
- Trabalho em equipe facilitado

### ✅ Flexibilidade
- Troca de banco de dados sem afetar lógica
- Múltiplas interfaces (API, CLI, Web)
- Migrações de framework simplificadas

### ✅ Performance
- Repository otimizado para PostgreSQL
- Cache pode ser adicionado na camada Infrastructure
- Queries otimizadas sem afetar Domain

## Convenções do Projeto

### Nomenclatura

- **Entities**: `{Nome}Entity.php`
- **Use Cases**: `{Ação}{Nome}UseCase.php`
- **DTOs**: `{Ação}{Nome}DTO.php`
- **Controllers**: `{Nome}Controller.php`
- **Repositories**: `{Nome}Repository.php` + `{Nome}RepositoryInterface.php`

### Organização por Feature

```
app/Features/{Feature}/
├── Domain/
│   ├── Entities/
│   ├── Repositories/
│   └── Services/
├── Application/
│   ├── UseCases/
│   ├── DTOs/
│   └── Services/
├── Infrastructure/
│   ├── Models/
│   ├── Repositories/
│   └── External/
└── Presentation/
    ├── Controllers/
    ├── Requests/
    ├── Resources/
    └── Routes/
```

## Performance Tips

### PostgreSQL
- Índices em campos de busca frequente (email, is_active)
- Usa tipos de dados apropriados
- Queries otimizadas via Eloquent

### Eloquent ORM
- Usa eager loading para evitar N+1
- Scopes para queries reutilizáveis
- Paginação nativa

### Redis
- Cache de sessões
- Cache de queries frequentes
- Filas para processamento assíncrono

## Adicionando Nova Feature

1. Crie a estrutura de pastas:
```bash
mkdir -p app/Features/{Feature}/{Domain,Application,Infrastructure,Presentation}
```

2. Crie a entidade de domínio
3. Crie a interface do repositório
4. Implemente o repositório
5. Crie os DTOs
6. Crie os Use Cases
7. Crie o Controller
8. Registre no Service Provider
9. Adicione as rotas

## Recursos Adicionais

- [Clean Architecture - Uncle Bob](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
- [Domain-Driven Design](https://martinfowler.com/bliki/DomainDrivenDesign.html)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Laravel Documentation](https://laravel.com/docs)

