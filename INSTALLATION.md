# 🛠️ Guia de Instalação - FitPlan Academy

Este guia detalha o passo a passo para instalar e configurar o projeto **FitPlan Academy** em seu ambiente local.

## 📋 Pré-requisitos

Antes de começar, certifique-se de ter as seguintes ferramentas instaladas:

1.  **PHP 8.1 ou superior**
2.  **Composer** (Gerenciador de dependências do PHP)
3.  **MySQL** (Banco de dados) ou **XAMPP** (que já inclui PHP e MySQL)
4.  **Git** (Opcional, para clonar o repositório)

---

## 🚀 Passo a Passo da Instalação

### 1. Clonar ou Baixar o Projeto

Se você tiver o Git instalado:
```bash
git clone https://github.com/edufilhocruz/fitplan_acadamy.git
cd fitplan_acadamy
```

Ou baixe o arquivo ZIP e extraia na pasta desejada.

### 2. Instalar Dependências do PHP

Na raiz do projeto, execute o seguinte comando para instalar as bibliotecas necessárias:

```bash
php composer.phar install
# OU se você tiver o composer instalado globalmente:
composer install
```

> **Nota:** Se encontrar erros de falta de extensão (ex: `ext-gd`, `ext-zip`), certifique-se de habilitá-las no seu arquivo `php.ini`.

### 3. Configurar o Ambiente (.env)

O Laravel precisa de um arquivo de configuração `.env`. Faça uma cópia do arquivo de exemplo:

**Windows:**
```cmd
copy .env.example .env
```

**Linux/Mac:**
```bash
cp .env.example .env
```

Abra o arquivo `.env` e configure as informações do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitplan_academy
DB_USERNAME=root       # Seu usuário do MySQL (padrão do XAMPP é root)
DB_PASSWORD=           # Sua senha do MySQL (padrão do XAMPP é vazio)
```

### 4. Gerar Chave da Aplicação

Gere a chave de criptografia única para sua aplicação:

```bash
php artisan key:generate
```

### 5. Configurar o Banco de Dados

1.  Abra seu gerenciador de banco de dados (ex: phpMyAdmin em `http://localhost/phpmyadmin`).
2.  Crie um novo banco de dados chamado **`fitplan_academy`** (com collation `utf8mb4_unicode_ci`).

Em seguida, execute as migrações para criar as tabelas:

```bash
php artisan migrate
```

### 6. Popular o Banco de Dados (Seeders)

Para criar os usuários iniciais (Master, Admin, etc.) e planos, execute:

```bash
php artisan db:seed
```

Isso criará:
*   **Usuário Master:** Login `MASTER` / Senha `Master123`
*   **Usuário Admin:** Login `ADMIN` / Senha `password`
*   **Usuário Comum:** Login `SOPHIA` / Senha `password`

### 7. Iniciar o Servidor

Agora você pode iniciar o servidor de desenvolvimento local:

```bash
php artisan serve
```

Acesse a aplicação em: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🐛 Solução de Problemas Comuns

### Erro: `Vendor folder missing` ou `autoload.php not found`
**Solução:** Você esqueceu de rodar o `composer install`. Execute o passo 2 novamente.

### Erro: `could not find driver` (PDOException)
**Solução:** O driver MySQL não está habilitado no PHP que seu terminal está usando.
1.  Rode `php --ini` no terminal para ver qual arquivo está sendo usado (ex: `Loaded Configuration File`).
2.  Abra esse arquivo específico (pode ser diferente do XAMPP, ex: `C:\php\php.ini`).
3.  Procure por `;extension=pdo_mysql` e remova o ponto e vírgula `;`.
4.  Faça o mesmo para `;extension=mysqli`.
5.  Salve e tente rodar o comando novamente.

### Erro: `Access denied for user 'root'@'localhost'`
**Solução:** Verifique se a senha do banco de dados no arquivo `.env` está correta. No XAMPP, a senha padrão costuma ser vazia.

### Erro: `Unknown database 'fitplan_academy'`
**Solução:** Você precisa criar o banco de dados manualmente no MySQL/phpMyAdmin antes de rodar as migrações.

### Erro: `No application encryption key has been specified`
**Solução:** Execute `php artisan key:generate`.

### Permissões de Pasta (Linux/Mac)
Se tiver erros de permissão ao salvar arquivos ou logs:
```bash
chmod -R 775 storage bootstrap/cache
```

---

## 📄 Credenciais de Acesso Padrão

| Perfil | Login | Senha |
| :--- | :--- | :--- |
| **Master** | `MASTER` | `Master123` |
| **Admin** | `ADMIN` | `password` |
| **Aluno** | `SOPHIA` | `password` |
