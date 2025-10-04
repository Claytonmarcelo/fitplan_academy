# 📊 Diagrama ER - FitPlan Academy

## 🏗️ Estrutura do Banco de Dados

```mermaid
erDiagram
    USERS {
        bigint id PK
        varchar name
        varchar cpf UK
        varchar email UK
        timestamp email_verified_at
        varchar password
        varchar phone
        varchar cep
        varchar street
        int number
        varchar complement
        varchar district
        varchar city
        varchar state
        varchar login UK
        enum profile "master,comum"
        varchar two_factor_secret
        timestamp two_factor_confirmed_at
        boolean is_active "default true"
        timestamp created_at
        timestamp updated_at
    }

    ACCESS_LOGS {
        bigint id PK
        bigint user_id FK
        varchar user_name
        varchar user_cpf
        varchar user_login
        varchar ip_address
        text user_agent
        boolean two_factor_used "default false"
        boolean login_successful "default true"
        timestamp created_at
        timestamp updated_at
    }

    PLANS {
        bigint id PK
        varchar name
        text description
        decimal price
        json features
        boolean is_active "default true"
        timestamp created_at
        timestamp updated_at
    }

    SUBSCRIPTIONS {
        bigint id PK
        bigint user_id FK
        bigint plan_id FK
        varchar status "active,inactive,cancelled"
        timestamp starts_at
        timestamp expires_at
        timestamp created_at
        timestamp updated_at
    }

    PAYMENTS {
        bigint id PK
        bigint subscription_id FK
        decimal amount
        varchar currency "default 'BRL'"
        varchar method "credit_card,pix,boleto"
        varchar status "pending,paid,failed"
        varchar transaction_id
        timestamp paid_at
        timestamp created_at
        timestamp updated_at
    }

    CHECKOUTS {
        bigint id PK
        bigint user_id FK
        bigint plan_id FK
        status varchar "pending,completed,failed"
        decimal amount
        json payment_info
        timestamp created_at
        timestamp updated_at
    }

    STUDENT_WORKOUTS {
        bigint id PK
        bigint user_id FK
        varchar workout_name
        int duration_minutes
        json exercises
        boolean completed "default false"
        timestamp started_at
        timestamp completed_at
        timestamp created_at
        timestamp updated_at
    }

    STUDENT_GOALS {
        bigint id PK
        bigint user_id FK
        varchar title
        text description
        varchar type
        decimal target_value
        varchar target_unit
        decimal current_value "default 0"
        date target_date
        boolean is_achieved "default false"
        timestamp achieved_at
        timestamp created_at
        timestamp updated_at
    }

    PASSWORD_RESET_TOKENS {
        varchar email PK
        varchar token
        timestamp created_at
    }

    %% Relacionamentos
    USERS ||--o{ ACCESS_LOGS : "tem logs"
    USERS ||--o{ SUBSCRIPTIONS : "possui assinaturas"
    USERS }o--|| CHECKOUTS : "realiza checkouts"
    USERS ||--o{ STUDENT_WORKOUTS : "executa treinos"
    USERS ||--o{ STUDENT_GOALS : "define metas"

    PLANS ||--o{ SUBSCRIPTIONS : "gera assinaturas"
    PLANS }o--|| CHECKOUTS : "vendidos em checkouts"

    SUBSCRIPTIONS ||--o{ PAYMENTS : "gera pagamentos"

    CHECKOUTS }o--|| PLANS : "referencia planos"
```

## 🔗 Relacionamentos Principais

### 1. **USERS (Usuários)**
- **Perfis:** `master` (Administrador) e `comum` (Aluno)
- **Autenticação:** Login + Senha + 2FA
- **Endereço:** CEP, rua, número, complemento, bairro, cidade, estado
- **Contato:** Telefone e email únic

### 2. **ACCESS_LOGS (Logs de Acesso)**
- Registra todas as tentativas de login
- Inclui informações de segurança (IP, User Agent)
- Controla uso de 2FA
- Relaciona com USERS

### 3. **PLANS (Plans)**
- **Basic:** R$ 79,90 - Ideal para iniciantes
- **Smart:** R$ 129,90 - Mais popular
- **Black:** R$ 199,90 - Premium

### 4. **STUDENT_WORKOUTS (Treinos do Aluno)**
- Armazena treinos personalizados por usuário
- Inclui exercícios em formato JSON
- Controla status de conclusão
- Registra tempo de início e fim

### 5. **STUDENT_GOALS (Metas do Aluno)**
- Metas personalizadas (peso, frequência, força)
- Progresso em tempo real
- Data objetivo para conquista
- Controla conquista de metas

## 🎯 Funcionalidades Suportadas

✅ **Autenticação 2FA**
- Google Authenticator
- Logs de segurança

✅ **Gestão de Usuários**
- Perfis Master/Comum
- Validações brasileiras (CPF, CEP)

✅ **Dashboard do Aluno**
- Frequência mensal
- Progresso de metas
- Treinos personalizados

✅ **Sistema de Pagamentos**
- Assinaturas
- Múltiplos métodos de pagamento

✅ **Auditoria Completa**
- Logs de acesso
- Tracking de 2FA

## 📊 Estatísticas do Sistema

- **Tabelas:** 9 principais + 1 de tokens
- **Funcionalidades:** Autenticação, gestão, treinos, metas, pagamentos
- **Segurança:** 2FA, logs de acesso, validações
- **Escalabilidade:** Índices otimizados, foreign keys

## 🚀 Comandos de Setup

```bash
# Criar banco e executar migrações
php artisan migrate

# Criar usuário Master
php artisan db:seed --class=MasterUserSeeder

# Popular planos
php artisan db:seed --class=PlanSeeder

# Popular dados de demonstração do aluno
php artisan student:populate
```

---

**🏋️ FitPlan Academy - Sistema Completo de Gestão de Academia**
