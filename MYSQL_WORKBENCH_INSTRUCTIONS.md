# 🗄️ **MYSQL WORKBENCH - DIAGRAMA ER FITPLAN ACADEMY**

## 📋 **Como Gerar o Diagrama ER:**

### **1. Abrir MySQL Workbench:**
- Abra o MySQL Workbench
- Conecte-se ao seu servidor MySQL (ou use MySQL local)

### **2. Importar Schema:**
- Vá em **File** → **Open SQL Script**
- Selecione o arquivo: `fitplan_academy_database_schema.sql`
- Execute o script (Ctrl+Shift+Enter)

### **3. Gerar Diagrama ER:**
- Vá em **Database** → **Reverse Engineer**
- Selecione a conexão MySQL
- Escolha o schema `fitplan_academy` (ou seu nome de banco)
- Selecione todas as tabelas
- Clique em **Next** → **Next** → **Execute**

### **4. Visualizar Relacionamentos:**
- O Workbench criará automaticamente o diagrama ER
- Mostrará todas as tabelas com suas chaves estrangeiras
- Relacionamentos serão desenhados automaticamente

## 🎯 **Estrutura do Diagrama:**

### **📊 Entidades Principais:**

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│     USERS       │    │      PLANS      │    │  SUBSCRIPTIONS  │
│                 │    │                 │    │                 │
│ • id (PK)       │    │ • id (PK)       │    │ • id (PK)       │
│ • name          │    │ • name          │    │ • user_id (FK)  │
│ • cpf           │    │ • description   │    │ • plan_id (FK)  │
│ • email         │    │ • price         │    │ • status        │
│ • login         │    │ • features      │    │ • starts_at     │
│ • profile       │    │ • is_active     │    │ • ends_at       │
│ • is_active     │    │                 │    │                 │
│ • 2FA fields    │    │                 │    │                 │
└─────────────────┘    └─────────────────┘    └─────────────────┘
         │                       │                       │
         │                       │                       │
         │ 1:N                   │ 1:N                   │ 1:N
         │                       │                       │
         ▼                       ▼                       ▼
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│  ACCESS_LOGS    │    │   CHECKOUTS     │    │    PAYMENTS     │
│                 │    │                 │    │                 │
│ • id (PK)       │    │ • id (PK)       │    │ • id (PK)       │
│ • user_id (FK)  │    │ • plan_id (FK)  │    │ • user_id (FK)  │
│ • user_name     │    │ • email         │    │ • subscription_id│
│ • user_cpf      │    │ • payment_method│    │ • amount        │
│ • ip_address    │    │ • total         │    │ • status        │
│ • login_success │    │ • status        │    │ • payment_method│
└─────────────────┘    └─────────────────┘    └─────────────────┘
         │                       │                       │
         │                       │                       │
         │ 1:N                   │ N:1                   │ N:1
         │                       │                       │
         ▼                       ▼                       ▼
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│STUDENT_WORKOUTS │    │  STUDENT_GOALS  │    │PASSWORD_RESET   │
│                 │    │                 │    │                 │
│ • id (PK)       │    │ • id (PK)       │    │ • email (PK)    │
│ • user_id (FK)  │    │ • user_id (FK)  │    │ • token         │
│ • workout_name  │    │ • title         │    │ • created_at    │
│ • duration      │    │ • target_value  │    │                 │
│ • exercises     │    │ • current_value │    │                 │
│ • completed     │    │ • is_achieved   │    │                 │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

## 🔗 **Relacionamentos Detalhados:**

### **1. USERS → SUBSCRIPTIONS (1:N)**
- Um usuário pode ter múltiplas assinaturas
- Chave: `subscriptions.user_id → users.id`

### **2. PLANS → SUBSCRIPTIONS (1:N)**
- Um plano pode ter múltiplas assinaturas
- Chave: `subscriptions.plan_id → plans.id`

### **3. USERS → PAYMENTS (1:N)**
- Um usuário pode ter múltiplos pagamentos
- Chave: `payments.user_id → users.id`

### **4. SUBSCRIPTIONS → PAYMENTS (1:N)**
- Uma assinatura pode ter múltiplos pagamentos
- Chave: `payments.subscription_id → subscriptions.id`

### **5. PLANS → CHECKOUTS (1:N)**
- Um plano pode ter múltiplos checkouts
- Chave: `checkouts.plan_id → plans.id`

### **6. USERS → ACCESS_LOGS (1:N)**
- Um usuário pode ter múltiplos logs de acesso
- Chave: `access_logs.user_id → users.id`

### **7. USERS → STUDENT_WORKOUTS (1:N)**
- Um usuário pode ter múltiplos treinos
- Chave: `student_workouts.user_id → users.id`

### **8. USERS → STUDENT_GOALS (1:N)**
- Um usuário pode ter múltiplas metas
- Chave: `student_goals.user_id → users.id`

## 🎨 **Personalização do Diagrama:**

### **Cores Sugeridas:**
- **USERS:** Azul (entidade central)
- **PLANS:** Verde (produtos/serviços)
- **SUBSCRIPTIONS:** Laranja (relacionamentos)
- **PAYMENTS:** Vermelho (transações)
- **LOGS:** Cinza (auditoria)
- **STUDENT_DATA:** Roxo (funcionalidades específicas)

### **Layout Sugerido:**
- **Centro:** USERS (entidade principal)
- **Esquerda:** PLANS, SUBSCRIPTIONS, PAYMENTS
- **Direita:** STUDENT_WORKOUTS, STUDENT_GOALS
- **Abaixo:** ACCESS_LOGS, CHECKOUTS
- **Canto:** PASSWORD_RESET_TOKENS

## 📈 **Índices e Performance:**

### **Índices Principais:**
- `users.profile + users.is_active` (busca por perfil)
- `subscriptions.status` (status das assinaturas)
- `payments.status` (status dos pagamentos)
- `access_logs.created_at + login_successful` (auditoria)
- `student_workouts.user_id + created_at` (treinos por usuário)

### **Chaves Estrangeiras:**
- Todas com `ON DELETE CASCADE`
- Integridade referencial garantida
- Performance otimizada para consultas

## 🚀 **Próximos Passos:**

1. **Importar o schema** no MySQL Workbench
2. **Executar Reverse Engineer** para gerar diagrama
3. **Personalizar cores e layout** conforme preferência
4. **Exportar como imagem** (PNG/JPG) para documentação
5. **Salvar o modelo** (.mwb) para futuras modificações

**🎊 Diagrama ER completo e pronto para uso!**
