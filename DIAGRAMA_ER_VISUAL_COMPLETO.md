# 🗄️ **DIAGRAMA ER VISUAL - FITPLAN ACADEMY**

## 📊 **Estrutura Completa do Banco de Dados:**

```
┌─────────────────────────────────────────────────────────────────────────────────────────────────┐
│                                    FITPLAN ACADEMY DATABASE                                      │
│                                   Entity-Relationship Diagram                                    │
│                                                                                                 │
│  🔵 USERS (Entidade Central)                                                                   │
│  ┌─────────────────────────────────────────────────────────────────────────────────────────┐   │
│  │ id (PK) │ name │ cpf │ email │ phone │ address │ login │ password │ profile │ is_active │   │
│  │ 2FA     │ email_verified │ remember_token │ created_at │ updated_at                    │   │
│  └─────────────────────────────────────────────────────────────────────────────────────────┘   │
│                                    │                                                             │
│                                    │ 1:N (One to Many)                                          │
│                                    │                                                             │
│  ┌─────────────────────────────────┼─────────────────────────────────┐                         │
│  │                                 │                                 │                         │
│  ▼                                 ▼                                 ▼                         │
│  ┌─────────────────┐              ┌─────────────────┐              ┌─────────────────┐         │
│  │ SUBSCRIPTIONS   │              │ ACCESS_LOGS     │              │ STUDENT_WORKOUTS│         │
│  │                 │              │                 │              │                 │         │
│  │ • id (PK)       │              │ • id (PK)       │              │ • id (PK)       │         │
│  │ • user_id (FK)  │◄─────────────│ • user_id (FK)  │              │ • user_id (FK)  │         │
│  │ • plan_id (FK)  │              │ • user_name     │              │ • workout_name  │         │
│  │ • status        │              │ • user_cpf      │              │ • duration      │         │
│  │ • starts_at     │              │ • user_login   │              │ • exercises     │         │
│  │ • ends_at       │              │ • ip_address   │              │ • completed     │         │
│  │ • cancelled_at  │              │ • user_agent    │              │ • started_at    │         │
│  │ • created_at    │              │ • two_factor   │              │ • completed_at  │         │
│  │ • updated_at    │              │ • login_success│              │ • created_at    │         │
│  └─────────────────┘              │ • created_at    │              │ • updated_at    │         │
│           │                       │ • updated_at    │              └─────────────────┘         │
│           │ 1:N                   └─────────────────┘                       │                   │
│           │                               │                                 │ 1:N                │
│           ▼                               │                                 │                   │
│  ┌─────────────────┐                     │                                 ▼                   │
│  │ PAYMENTS        │                     │                                 ┌─────────────────┐ │
│  │                 │                     │                                 │ STUDENT_GOALS   │ │
│  │ • id (PK)       │                     │                                 │                 │ │
│  │ • user_id (FK)  │◄────────────────────┘                                 │ • id (PK)       │ │
│  │ • subscription_id│                                                      │ • user_id (FK)  │ │
│  │ • amount        │                                                      │ • title         │ │
│  │ • status        │                                                      │ • description   │ │
│  │ • payment_method│                                                      │ • type          │ │
│  │ • transaction_id│                                                      │ • target_value  │ │
│  │ • payment_data  │                                                      │ • target_unit   │ │
│  │ • paid_at       │                                                      │ • current_value │ │
│  │ • created_at    │                                                      │ • target_date   │ │
│  │ • updated_at    │                                                      │ • is_achieved   │ │
│  └─────────────────┘                                                      │ • achieved_at   │ │
│                                                                           │ • created_at    │ │
│                                                                           │ • updated_at    │ │
│                                                                           └─────────────────┘ │
│                                                                                                 │
│  🟢 PLANS (Entidade de Produto)                                                                 │
│  ┌─────────────────────────────────────────────────────────────────────────────────────────┐   │
│  │ id (PK) │ name │ description │ price │ features │ is_active │ created_at │ updated_at │   │
│  └─────────────────────────────────────────────────────────────────────────────────────────┘   │
│                                    │                                                             │
│                                    │ 1:N                                                         │
│                                    │                                                             │
│                                    ▼                                                             │
│  ┌─────────────────────────────────────────────────────────────────────────────────────────┐   │
│  │ CHECKOUTS (Processo de Compra)                                                         │   │
│  │                                                                                         │   │
│  │ • id (PK) │ plan_id (FK) │ email │ password │ payment_method │ card_data │ total │ status │   │
│  │ • transaction_id │ created_at │ updated_at                                            │   │
│  └─────────────────────────────────────────────────────────────────────────────────────────┘   │
│                                                                                                 │
│  ⚪ PASSWORD_RESET_TOKENS (Funcionalidade Auxiliar)                                            │
│  ┌─────────────────────────────────────────────────────────────────────────────────────────┐   │
│  │ email (PK) │ token │ created_at                                                         │   │
│  └─────────────────────────────────────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────────────────────────────────────┘
```

## 🔗 **Relacionamentos Detalhados:**

### **1. USERS (Entidade Central) - Relacionamentos 1:N:**

```
USERS ──────► SUBSCRIPTIONS
  │              │
  │              │ 1:N
  │              ▼
  │         PAYMENTS
  │
  │ 1:N
  ▼
ACCESS_LOGS

USERS ──────► STUDENT_WORKOUTS
  │
  │ 1:N
  ▼
STUDENT_GOALS
```

### **2. PLANS (Entidade de Produto) - Relacionamentos 1:N:**

```
PLANS ──────► SUBSCRIPTIONS
  │
  │ 1:N
  ▼
CHECKOUTS
```

### **3. SUBSCRIPTIONS (Entidade de Relacionamento) - Relacionamentos 1:N:**

```
SUBSCRIPTIONS ──────► PAYMENTS
```

## 📋 **Cardinalidades e Tipos de Relacionamento:**

| Relacionamento | Tipo | Cardinalidade | Descrição |
|---|---|---|---|
| **USERS → SUBSCRIPTIONS** | 1:N | Um para Muitos | Um usuário pode ter múltiplas assinaturas |
| **USERS → ACCESS_LOGS** | 1:N | Um para Muitos | Um usuário pode ter múltiplos logs de acesso |
| **USERS → STUDENT_WORKOUTS** | 1:N | Um para Muitos | Um usuário pode ter múltiplos treinos |
| **USERS → STUDENT_GOALS** | 1:N | Um para Muitos | Um usuário pode ter múltiplas metas |
| **USERS → PAYMENTS** | 1:N | Um para Muitos | Um usuário pode ter múltiplos pagamentos |
| **PLANS → SUBSCRIPTIONS** | 1:N | Um para Muitos | Um plano pode ter múltiplas assinaturas |
| **PLANS → CHECKOUTS** | 1:N | Um para Muitos | Um plano pode ter múltiplos checkouts |
| **SUBSCRIPTIONS → PAYMENTS** | 1:N | Um para Muitos | Uma assinatura pode ter múltiplos pagamentos |

## 🎯 **Chaves Primárias e Estrangeiras:**

### **Chaves Primárias (PK):**
- `users.id` - ID único do usuário
- `plans.id` - ID único do plano
- `subscriptions.id` - ID único da assinatura
- `payments.id` - ID único do pagamento
- `checkouts.id` - ID único do checkout
- `access_logs.id` - ID único do log
- `student_workouts.id` - ID único do treino
- `student_goals.id` - ID único da meta
- `password_reset_tokens.email` - Email único para reset

### **Chaves Estrangeiras (FK) com CASCADE:**
- `subscriptions.user_id` → `users.id` (ON DELETE CASCADE)
- `subscriptions.plan_id` → `plans.id` (ON DELETE CASCADE)
- `payments.user_id` → `users.id` (ON DELETE CASCADE)
- `payments.subscription_id` → `subscriptions.id` (ON DELETE CASCADE)
- `checkouts.plan_id` → `plans.id` (ON DELETE CASCADE)
- `access_logs.user_id` → `users.id` (ON DELETE CASCADE)
- `student_workouts.user_id` → `users.id` (ON DELETE CASCADE)
- `student_goals.user_id` → `users.id` (ON DELETE CASCADE)

## 📊 **Índices de Performance:**

### **Índices Compostos:**
```
users(profile, is_active)           - Busca por perfil ativo
subscriptions(status)               - Status das assinaturas
payments(status)                    - Status dos pagamentos
access_logs(user_id, created_at)    - Logs por usuário
access_logs(created_at, login_successful) - Auditoria
student_workouts(user_id, created_at) - Treinos por usuário
student_workouts(completed, created_at) - Treinos concluídos
student_goals(user_id, target_date) - Metas por usuário
student_goals(is_achieved, created_at) - Metas alcançadas
```

### **Índices Únicos:**
```
users.cpf                          - CPF único
users.email                        - Email único
users.login                        - Login único
payments.transaction_id            - ID de transação único
```

## 🎨 **Cores e Estilos Sugeridos:**

| Entidade | Cor | Ícone | Descrição |
|---|---|---|---|
| **USERS** | 🔵 Azul | 👤 | Entidade central do sistema |
| **PLANS** | 🟢 Verde | 📋 | Produtos/serviços oferecidos |
| **SUBSCRIPTIONS** | 🟠 Laranja | 🔗 | Relacionamento usuário-plano |
| **PAYMENTS** | 🔴 Vermelho | 💳 | Transações financeiras |
| **ACCESS_LOGS** | ⚫ Cinza | 📊 | Auditoria e logs |
| **STUDENT_WORKOUTS** | 🟣 Roxo | 💪 | Treinos dos alunos |
| **STUDENT_GOALS** | 🟡 Amarelo | 🎯 | Metas dos alunos |
| **CHECKOUTS** | 🟤 Marrom | 🛒 | Processo de compra |
| **PASSWORD_RESET** | ⚪ Branco | 🔑 | Funcionalidade auxiliar |

## 🚀 **Fluxo de Dados Principal:**

```
1. USUÁRIO se CADASTRA → users
2. USUÁRIO escolhe PLANO → plans
3. SISTEMA cria ASSINATURA → subscriptions
4. USUÁRIO faz CHECKOUT → checkouts
5. SISTEMA processa PAGAMENTO → payments
6. SISTEMA registra LOG → access_logs
7. USUÁRIO faz TREINOS → student_workouts
8. USUÁRIO define METAS → student_goals
```

## 📈 **Estatísticas do Banco:**

- **9 Tabelas** principais
- **8 Relacionamentos** 1:N
- **8 Foreign Keys** com CASCADE
- **10 Índices** compostos
- **4 Índices** únicos
- **3 Campos JSON** para flexibilidade
- **Campos de auditoria** em todas as tabelas

**🎊 Diagrama ER visual completo e detalhado!**
