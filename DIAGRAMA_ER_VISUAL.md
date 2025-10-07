# 🗄️ **DIAGRAMA ER - FITPLAN ACADEMY**

## 📊 **Estrutura Visual do Banco de Dados:**

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                              FITPLAN ACADEMY DATABASE                           │
│                              Entity-Relationship Diagram                        │
└─────────────────────────────────────────────────────────────────────────────────┘

                    ┌─────────────────┐
                    │     USERS       │ ◄─── CENTRAL ENTITY
                    │                 │
                    │ • id (PK)       │
                    │ • name          │
                    │ • cpf (UK)      │
                    │ • email (UK)    │
                    │ • phone         │
                    │ • address       │
                    │ • login (UK)    │
                    │ • password      │
                    │ • profile       │
                    │ • is_active     │
                    │ • 2FA fields    │
                    └─────────────────┘
                            │
                            │ 1:N
                            │
        ┌───────────────────┼───────────────────┐
        │                   │                   │
        ▼                   ▼                   ▼
┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│SUBSCRIPTIONS│    │ACCESS_LOGS  │    │STUDENT_DATA │
│             │    │             │    │             │
│• id (PK)    │    │• id (PK)    │    │• id (PK)    │
│• user_id(FK)│    │• user_id(FK)│    │• user_id(FK)│
│• plan_id(FK)│    │• user_name  │    │• workout_name│
│• status     │    │• user_cpf   │    │• duration   │
│• starts_at  │    │• ip_address │    │• exercises  │
│• ends_at    │    │• login_success│   │• completed  │
└─────────────┘    └─────────────┘    └─────────────┘
        │                   │                   │
        │ 1:N               │ 1:N               │ 1:N
        │                   │                   │
        ▼                   ▼                   ▼
┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│  PAYMENTS   │    │PASSWORD_RESET│    │STUDENT_GOALS│
│             │    │             │    │             │
│• id (PK)    │    │• email (PK) │    │• id (PK)    │
│• user_id(FK)│    │• token      │    │• user_id(FK)│
│• subscription_id│ │• created_at │    │• title      │
│• amount     │    │             │    │• target_value│
│• status     │    │             │    │• current_value│
│• payment_method│ │             │    │• is_achieved│
└─────────────┘    └─────────────┘    └─────────────┘

        │
        │ 1:N
        │
        ▼
┌─────────────┐
│   PLANS     │
│             │
│• id (PK)    │
│• name       │
│• description│
│• price      │
│• features   │
│• is_active  │
└─────────────┘
        │
        │ 1:N
        │
        ▼
┌─────────────┐
│  CHECKOUTS  │
│             │
│• id (PK)    │
│• plan_id(FK)│
│• email      │
│• payment_method│
│• total      │
│• status     │
└─────────────┘
```

## 🔗 **Relacionamentos Detalhados:**

### **1. USERS (Entidade Central)**
```
USERS (1) ──────► (N) SUBSCRIPTIONS
USERS (1) ──────► (N) ACCESS_LOGS  
USERS (1) ──────► (N) STUDENT_WORKOUTS
USERS (1) ──────► (N) STUDENT_GOALS
USERS (1) ──────► (N) PAYMENTS
```

### **2. PLANS (Entidade de Produto)**
```
PLANS (1) ──────► (N) SUBSCRIPTIONS
PLANS (1) ──────► (N) CHECKOUTS
```

### **3. SUBSCRIPTIONS (Entidade de Relacionamento)**
```
SUBSCRIPTIONS (1) ──────► (N) PAYMENTS
```

## 📋 **Cardinalidades:**

| Relacionamento | Tipo | Descrição |
|---|---|---|
| USERS → SUBSCRIPTIONS | 1:N | Um usuário pode ter múltiplas assinaturas |
| USERS → ACCESS_LOGS | 1:N | Um usuário pode ter múltiplos logs |
| USERS → STUDENT_WORKOUTS | 1:N | Um usuário pode ter múltiplos treinos |
| USERS → STUDENT_GOALS | 1:N | Um usuário pode ter múltiplas metas |
| USERS → PAYMENTS | 1:N | Um usuário pode ter múltiplos pagamentos |
| PLANS → SUBSCRIPTIONS | 1:N | Um plano pode ter múltiplas assinaturas |
| PLANS → CHECKOUTS | 1:N | Um plano pode ter múltiplos checkouts |
| SUBSCRIPTIONS → PAYMENTS | 1:N | Uma assinatura pode ter múltiplos pagamentos |

## 🎯 **Chaves Estrangeiras:**

### **Foreign Keys com CASCADE:**
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
- `users(profile, is_active)` - Busca por perfil ativo
- `subscriptions(status)` - Status das assinaturas
- `payments(status)` - Status dos pagamentos
- `access_logs(user_id, created_at)` - Logs por usuário
- `access_logs(created_at, login_successful)` - Auditoria
- `student_workouts(user_id, created_at)` - Treinos por usuário
- `student_workouts(completed, created_at)` - Treinos concluídos
- `student_goals(user_id, target_date)` - Metas por usuário
- `student_goals(is_achieved, created_at)` - Metas alcançadas

### **Índices Únicos:**
- `users.cpf` - CPF único
- `users.email` - Email único
- `users.login` - Login único
- `payments.transaction_id` - ID de transação único

## 🎨 **Cores Sugeridas para MySQL Workbench:**

| Entidade | Cor Sugerida | Motivo |
|---|---|---|
| **USERS** | 🔵 Azul | Entidade central do sistema |
| **PLANS** | 🟢 Verde | Produtos/serviços oferecidos |
| **SUBSCRIPTIONS** | 🟠 Laranja | Relacionamento usuário-plano |
| **PAYMENTS** | 🔴 Vermelho | Transações financeiras |
| **ACCESS_LOGS** | ⚫ Cinza | Auditoria e logs |
| **STUDENT_DATA** | 🟣 Roxo | Funcionalidades específicas |
| **CHECKOUTS** | 🟡 Amarelo | Processo de compra |
| **PASSWORD_RESET** | ⚪ Branco | Funcionalidade auxiliar |

## 🚀 **Como Usar no MySQL Workbench:**

1. **Abrir MySQL Workbench**
2. **File → Open SQL Script** → Selecionar `fitplan_academy_database_schema.sql`
3. **Executar o script** (Ctrl+Shift+Enter)
4. **Database → Reverse Engineer**
5. **Selecionar todas as tabelas**
6. **Executar** para gerar diagrama visual
7. **Personalizar cores e layout**
8. **Exportar como imagem** para documentação

**🎊 Diagrama ER completo e pronto para importação!**
