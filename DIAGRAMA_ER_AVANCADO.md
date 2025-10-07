# 🎨 **DIAGRAMA ER VISUAL AVANÇADO - FITPLAN ACADEMY**

## 📊 **Estrutura Hierárquica do Banco:**

```
                    ╔══════════════════════════════════════════════════════════════════════════════╗
                    ║                              FITPLAN ACADEMY DATABASE                       ║
                    ║                           Entity-Relationship Diagram                        ║
                    ╚══════════════════════════════════════════════════════════════════════════════╝

                                    🔵 USERS (CENTRAL ENTITY)
                                    ╔══════════════════════════════════════════════════════════════╗
                                    ║  ┌─────┬─────────┬─────────┬─────────┬─────────┬─────────┐  ║
                                    ║  │ id  │  name   │   cpf   │  email  │  phone  │ address │  ║
                                    ║  ├─────┼─────────┼─────────┼─────────┼─────────┼─────────┤  ║
                                    ║  │login│password │ profile │is_active│ 2FA     │timestamps│  ║
                                    ║  └─────┴─────────┴─────────┴─────────┴─────────┴─────────┘  ║
                                    ╚══════════════════════════════════════════════════════════════╝
                                                      │
                                                      │ 1:N
                                                      │
                    ╔═════════════════════════════════┼═══════════════════════════════════════════════╗
                    ║                                 │                                               ║
                    ║                                 ▼                                               ║
                    ║  ┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐ ║
                    ║  │ SUBSCRIPTIONS  │  │ ACCESS_LOGS     │  │STUDENT_WORKOUTS│  │ STUDENT_GOALS   │ ║
                    ║  │                 │  │                 │  │                 │  │                 │ ║
                    ║  │ • id (PK)       │  │ • id (PK)       │  │ • id (PK)       │  │ • id (PK)       │ ║
                    ║  │ • user_id (FK)  │  │ • user_id (FK)  │  │ • user_id (FK)  │  │ • user_id (FK)  │ ║
                    ║  │ • plan_id (FK)  │  │ • user_name     │  │ • workout_name  │  │ • title         │ ║
                    ║  │ • status        │  │ • user_cpf      │  │ • duration      │  │ • target_value  │ ║
                    ║  │ • starts_at     │  │ • ip_address    │  │ • exercises     │  │ • current_value │ ║
                    ║  │ • ends_at       │  │ • login_success │  │ • completed     │  │ • is_achieved  │ ║
                    ║  └─────────────────┘  └─────────────────┘  └─────────────────┘  └─────────────────┘ ║
                    ║           │                   │                   │                   │           ║
                    ║           │ 1:N               │ 1:N               │ 1:N               │ 1:N       ║
                    ║           │                   │                   │                   │           ║
                    ║           ▼                   ▼                   ▼                   ▼           ║
                    ║  ┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐ ║
                    ║  │ PAYMENTS        │  │PASSWORD_RESET   │  │    (FUTURE)     │  │    (FUTURE)     │ ║
                    ║  │                 │  │                 │  │                 │  │                 │ ║
                    ║  │ • id (PK)       │  │ • email (PK)    │  │                 │  │                 │ ║
                    ║  │ • user_id (FK)  │  │ • token         │  │                 │  │                 │ ║
                    ║  │ • subscription_id│ │ • created_at    │  │                 │  │                 │ ║
                    ║  │ • amount        │  │                 │  │                 │  │                 │ ║
                    ║  │ • status        │  │                 │  │                 │  │                 │ ║
                    ║  │ • payment_method│  │                 │  │                 │  │                 │ ║
                    ║  └─────────────────┘  └─────────────────┘  └─────────────────┘  └─────────────────┘ ║
                    ╚═══════════════════════════════════════════════════════════════════════════════════╝
                                                      │
                                                      │ 1:N
                                                      │
                    ╔═════════════════════════════════┼═══════════════════════════════════════════════╗
                    ║                                 │                                               ║
                    ║                                 ▼                                               ║
                    ║                            🟢 PLANS                                              ║
                    ║  ╔═══════════════════════════════════════════════════════════════════════════════╗ ║
                    ║  ║  ┌─────┬─────────┬─────────┬─────────┬─────────┬─────────┬─────────┬─────────┐ ║ ║
                    ║  ║  │ id  │  name   │description│ price  │features│is_active│created_at│updated_at│ ║ ║
                    ║  ║  └─────┴─────────┴─────────┴─────────┴─────────┴─────────┴─────────┴─────────┘ ║ ║
                    ║  ╚═══════════════════════════════════════════════════════════════════════════════╝ ║
                    ║                                 │                                               ║
                    ║                                 │ 1:N                                           ║
                    ║                                 │                                               ║
                    ║                                 ▼                                               ║
                    ║  ┌─────────────────────────────────────────────────────────────────────────────┐ ║
                    ║  │ CHECKOUTS (Processo de Compra)                                            │ ║
                    ║  │                                                                             │ ║
                    ║  │ • id (PK) │ plan_id (FK) │ email │ password │ payment_method │ total │ status │ ║
                    ║  │ • card_data │ transaction_id │ created_at │ updated_at                      │ ║
                    ║  └─────────────────────────────────────────────────────────────────────────────┘ ║
                    ╚═══════════════════════════════════════════════════════════════════════════════════╝
```

## 🔗 **Fluxo de Relacionamentos:**

```
USERS (1) ──────────────► (N) SUBSCRIPTIONS ──────────────► (N) PAYMENTS
   │                           │
   │ 1:N                       │ 1:N
   ▼                           ▼
ACCESS_LOGS                PLANS (1) ──────────────► (N) CHECKOUTS

USERS (1) ──────────────► (N) STUDENT_WORKOUTS
   │
   │ 1:N
   ▼
STUDENT_GOALS

USERS (1) ──────────────► (N) PASSWORD_RESET_TOKENS
```

## 📊 **Resumo das Entidades:**

| Entidade | Campos | Relacionamentos | Índices |
|---|---|---|---|
| **USERS** | 15 campos | 5 relacionamentos 1:N | 4 índices |
| **PLANS** | 7 campos | 2 relacionamentos 1:N | 1 índice |
| **SUBSCRIPTIONS** | 8 campos | 1 relacionamento 1:N | 1 índice |
| **PAYMENTS** | 9 campos | 0 relacionamentos | 1 índice |
| **CHECKOUTS** | 10 campos | 0 relacionamentos | 3 índices |
| **ACCESS_LOGS** | 10 campos | 0 relacionamentos | 3 índices |
| **STUDENT_WORKOUTS** | 9 campos | 0 relacionamentos | 2 índices |
| **STUDENT_GOALS** | 11 campos | 0 relacionamentos | 2 índices |
| **PASSWORD_RESET_TOKENS** | 3 campos | 0 relacionamentos | 0 índices |

## 🎯 **Chaves e Índices:**

### **Chaves Primárias:**
- `users.id` (AUTO_INCREMENT)
- `plans.id` (AUTO_INCREMENT)
- `subscriptions.id` (AUTO_INCREMENT)
- `payments.id` (AUTO_INCREMENT)
- `checkouts.id` (AUTO_INCREMENT)
- `access_logs.id` (AUTO_INCREMENT)
- `student_workouts.id` (AUTO_INCREMENT)
- `student_goals.id` (AUTO_INCREMENT)
- `password_reset_tokens.email` (VARCHAR)

### **Chaves Estrangeiras:**
- `subscriptions.user_id` → `users.id` (CASCADE)
- `subscriptions.plan_id` → `plans.id` (CASCADE)
- `payments.user_id` → `users.id` (CASCADE)
- `payments.subscription_id` → `subscriptions.id` (CASCADE)
- `checkouts.plan_id` → `plans.id` (CASCADE)
- `access_logs.user_id` → `users.id` (CASCADE)
- `student_workouts.user_id` → `users.id` (CASCADE)
- `student_goals.user_id` → `users.id` (CASCADE)

## 🚀 **Como Importar no MySQL Workbench:**

1. **Abrir MySQL Workbench**
2. **File → Open SQL Script** → `fitplan_academy_database_schema.sql`
3. **Executar script** (Ctrl+Shift+Enter)
4. **Database → Reverse Engineer**
5. **Selecionar todas as tabelas**
6. **Executar** para gerar diagrama visual
7. **Personalizar layout e cores**
8. **Exportar como imagem**

**🎊 Diagrama ER visual avançado completo!**
