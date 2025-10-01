# 🤝 Guia de Contribuição

## Como Contribuir

Agradecemos seu interesse em contribuir para o FitPlan Academy! Este documento fornece diretrizes para manter a qualidade e consistência do código.

## Padrões de Código

### PHP

- Seguir PSR-12 para estilo de código
- Usar type hints sempre que possível
- Documentar classes e métodos com PHPDoc
- Manter métodos pequenos e com responsabilidade única

### Arquitetura

- Seguir a Clean Architecture estabelecida
- Cada nova feature deve seguir a estrutura de camadas
- Domínio não pode depender de infraestrutura
- Use Cases devem orquestrar o fluxo

### Nomenclatura

**Classes**:
```php
// Entities
UserEntity, ProductEntity

// Use Cases
CreateUserUseCase, UpdateProductUseCase

// DTOs
CreateUserDTO, UpdateProductDTO

// Repositories
UserRepository, UserRepositoryInterface

// Controllers
UserController, ProductController
```

**Métodos**:
```php
// Use Cases
public function execute(CreateUserDTO $dto): UserEntity

// Repositories
public function findById(int $id): ?UserEntity
public function save(UserEntity $entity): UserEntity

// Controllers
public function store(CreateUserRequest $request): JsonResponse
```

## Fluxo de Trabalho

### 1. Criar Nova Feature

```bash
# Criar branch
git checkout -b feature/nome-da-feature

# Criar estrutura de pastas
mkdir -p app/Features/NomeFeature/{Domain,Application,Infrastructure,Presentation}
```

### 2. Implementar Camadas

**Ordem recomendada**:
1. Domain (Entities, Interfaces)
2. Infrastructure (Models, Repositories)
3. Application (DTOs, Use Cases)
4. Presentation (Requests, Resources, Controllers)
5. Routes

### 3. Adicionar Testes

```php
// Testes Unitários (Domain)
tests/Unit/NomeFeature/

// Testes de Integração (Use Cases)
tests/Integration/NomeFeature/

// Testes de Feature (API)
tests/Feature/NomeFeature/
```

### 4. Documentar

- Adicione comentários PHPDoc em todas as classes
- Atualize README.md se necessário
- Documente endpoints na API

### 5. Commit

```bash
# Seguir Conventional Commits
git commit -m "feat: adicionar feature de produtos"
git commit -m "fix: corrigir validação de email"
git commit -m "docs: atualizar README"
```

**Tipos de commit**:
- `feat`: Nova funcionalidade
- `fix`: Correção de bug
- `docs`: Documentação
- `style`: Formatação
- `refactor`: Refatoração
- `test`: Testes
- `chore`: Tarefas gerais

### 6. Pull Request

- Descreva as mudanças claramente
- Referencie issues relacionadas
- Adicione screenshots se aplicável
- Aguarde code review

## Regras de Negócio

### Onde colocar lógica?

**Domain (Entities)**:
```php
// ✅ Regras de negócio da entidade
public function activate(): void
public function deactivate(): void
public function isEligibleForDiscount(): bool
```

**Application (Use Cases)**:
```php
// ✅ Orquestração e regras de aplicação
public function execute(CreateUserDTO $dto): UserEntity
{
    // Validar regras
    // Criar entidade
    // Persistir
}
```

**Presentation (Controllers)**:
```php
// ❌ NÃO colocar lógica aqui
// ✅ Apenas receber request e chamar use case
public function store(Request $request): JsonResponse
{
    $dto = CreateUserDTO::fromArray($request->validated());
    $user = $this->useCase->execute($dto);
    return new UserResource($user);
}
```

## Performance

### Otimizações

- Use eager loading para evitar N+1
- Adicione índices em campos de busca
- Use cache para dados frequentemente acessados
- Implemente paginação

```php
// ✅ Eager loading
User::with('posts')->get();

// ❌ N+1 problem
User::all(); // depois $user->posts para cada user

// ✅ Cache
Cache::remember('users', 3600, fn() => User::all());

// ✅ Paginação
User::paginate(15);
```

## Segurança

### Checklist

- [ ] Validar todos os inputs
- [ ] Usar prepared statements (Eloquent já faz)
- [ ] Hash de senhas (bcrypt/argon2)
- [ ] Proteger rotas com middleware
- [ ] Sanitizar outputs
- [ ] Rate limiting em endpoints sensíveis
- [ ] Logs de auditoria

```php
// ✅ Validação
$request->validate([
    'email' => 'required|email|unique:users',
]);

// ✅ Hash de senha
Hash::make($password);

// ✅ Proteção de rotas
Route::middleware('auth:sanctum')->group(function() {
    // rotas protegidas
});
```

## Testes

### Pirâmide de Testes

```
        /\
       /  \      Unit Tests (70%)
      /----\     Integration Tests (20%)
     /______\    Feature Tests (10%)
```

### Exemplos

**Unit Test**:
```php
public function test_user_can_be_activated(): void
{
    $user = new UserEntity(...);
    $user->activate();
    $this->assertTrue($user->isActive());
}
```

**Feature Test**:
```php
public function test_can_create_user_via_api(): void
{
    $response = $this->postJson('/api/users', [...]);
    $response->assertStatus(201);
}
```

## Code Review

### O que verificamos

- [ ] Código segue a arquitetura
- [ ] Testes estão passando
- [ ] Código está documentado
- [ ] Performance foi considerada
- [ ] Segurança foi considerada
- [ ] Não há código duplicado

## Dúvidas?

Abra uma issue ou entre em contato com o time!

---

**Obrigado por contribuir! 🚀**

