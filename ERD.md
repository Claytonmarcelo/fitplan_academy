# Diagrama de Entidade e Relacionamento (DER) - FitPlan Academy

Este documento apresenta o diagrama de entidade e relacionamento (DER) do banco de dados do sistema FitPlan Academy, gerado a partir das migrações do Laravel.

## Diagrama Mermaid

```mermaid
erDiagram
    USERS ||--o{ SUBSCRIPTIONS : "has"
    USERS ||--o{ PAYMENTS : "makes"
    USERS ||--o{ STUDENT_WORKOUTS : "performs"
    USERS ||--o{ STUDENT_GOALS : "sets"
    USERS ||--o{ ACCESS_LOGS : "generates"
    
    PLANS ||--o{ SUBSCRIPTIONS : "included_in"
    PLANS ||--o{ CHECKOUTS : "purchased_via"
    
    SUBSCRIPTIONS ||--o{ PAYMENTS : "generates"

    USERS {
        bigint id PK
        string name
        string cpf UK
        string email UK
        string phone
        string cep
        string street
        string number
        string complement
        string district
        string city
        string state
        string login UK
        string password
        enum role "master, comum"
        boolean is_active
        string two_factor_secret
        timestamp two_factor_confirmed_at
        timestamp email_verified_at
        date birth_date
        enum gender
        string mother_name
        string landline_phone
        string zip_code
        timestamp created_at
        timestamp updated_at
    }

    PLANS {
        bigint id PK
        string name
        text description
        decimal price
        json features
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }

    SUBSCRIPTIONS {
        bigint id PK
        bigint user_id FK
        bigint plan_id FK
        enum status "active, cancelled, expired"
        timestamp starts_at
        timestamp ends_at
        timestamp cancelled_at
        timestamp created_at
        timestamp updated_at
    }

    PAYMENTS {
        bigint id PK
        bigint user_id FK
        bigint subscription_id FK
        decimal amount
        enum status "pending, paid, failed, refunded"
        enum payment_method "credit_card, debit_card, pix, boleto"
        string transaction_id UK
        json payment_data
        timestamp paid_at
        timestamp created_at
        timestamp updated_at
    }

    CHECKOUTS {
        bigint id PK
        bigint plan_id FK
        string email
        string password
        string payment_method
        string card_name
        string card_number
        string expiry_date
        string cvc
        string zip_code
        decimal subtotal
        decimal taxes
        decimal total
        string status
        string transaction_id
        timestamp created_at
        timestamp updated_at
    }

    STUDENT_WORKOUTS {
        bigint id PK
        bigint user_id FK
        string workout_name
        integer duration_minutes
        json exercises
        boolean completed
        timestamp started_at
        timestamp completed_at
        timestamp created_at
        timestamp updated_at
    }

    STUDENT_GOALS {
        bigint id PK
        bigint user_id FK
        string title
        text description
        string type
        decimal target_value
        string target_unit
        decimal current_value
        date target_date
        boolean is_achieved
        timestamp achieved_at
        timestamp created_at
        timestamp updated_at
    }

    ACCESS_LOGS {
        bigint id PK
        bigint user_id FK
        string user_name
        string user_cpf
        string user_login
        ipAddress ip_address
        string user_agent
        boolean two_factor_used
        boolean login_successful
        timestamp created_at
        timestamp updated_at
    }
```

## Descrição das Tabelas

### 1. Users (Usuários)
Tabela central que armazena todos os usuários do sistema (Master, Admin, Alunos).
- **Relacionamentos:** Possui assinaturas, pagamentos, treinos, metas e logs de acesso.

### 2. Plans (Planos)
Define os planos disponíveis na academia (ex: Basic, Smart, Black).
- **Relacionamentos:** Vinculado a assinaturas e checkouts.

### 3. Subscriptions (Assinaturas)
Registra a assinatura ativa de um usuário em um plano.
- **Relacionamentos:** Pertence a um usuário e a um plano. Gera pagamentos.

### 4. Payments (Pagamentos)
Histórico de pagamentos realizados.
- **Relacionamentos:** Vinculado a um usuário e a uma assinatura.

### 5. Checkouts
Registra tentativas de compra de planos (carrinho abandonado ou concluído).
- **Relacionamentos:** Vinculado a um plano.

### 6. Student Workouts (Treinos do Aluno)
Registra os treinos realizados pelos alunos.
- **Relacionamentos:** Pertence a um usuário.

### 7. Student Goals (Metas do Aluno)
Metas definidas pelos alunos (ex: perder peso).
- **Relacionamentos:** Pertence a um usuário.

### 8. Access Logs (Logs de Acesso)
Auditoria de logins no sistema.
- **Relacionamentos:** Pertence a um usuário.
