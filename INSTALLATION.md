# 🚀 Guia de Instalação - FitPlan Academy

Este guia irá te ajudar a instalar e executar o FitPlan Academy na sua máquina local.

## 📋 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP 8.4** ou superior
- **Composer** (gerenciador de dependências PHP)
- **Git** (controle de versão)
- **Node.js** (opcional, para desenvolvimento frontend)

### Verificando as Instalações

```bash
# Verificar PHP
php --version
# Deve mostrar PHP 8.4.x ou superior

# Verificar Composer
composer --version
# Deve mostrar Composer 2.x

# Verificar Git
git --version
# Deve mostrar Git 2.x
```

## 🔧 Instalação

### 1. Clone o Repositório

```bash
git clone https://github.com/edufilhocruz/fitplan_acadamy.git
cd fitplan_acadamy
```

### 2. Instalar Dependências

```bash
# Instalar dependências PHP
composer install

# Instalar dependências Node.js (opcional)
npm install
```

### 3. Configurar Ambiente

```bash
# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

### 4. Configurar Banco de Dados

O projeto está configurado para usar **SQLite** por padrão, que é mais simples para desenvolvimento local.

```bash
# Criar arquivo do banco SQLite
touch database/database.sqlite

# Executar migrations
php artisan migrate
```

### 5. Configurar Permissões (Linux/Mac)

```bash
# Dar permissões para storage e cache
chmod -R 775 storage bootstrap/cache
```

## 🚀 Executando a Aplicação

### 1. Iniciar o Servidor

```bash
# Iniciar servidor de desenvolvimento
php artisan serve
```

A aplicação estará disponível em: `http://localhost:8000`

### 2. Acessar a Aplicação

Abra seu navegador e acesse:
- **Landing Page**: `http://localhost:8000`
- **Cadastro**: `http://localhost:8000/cadastro`
- **Login**: `http://localhost:8000/login`

## 🧪 Testando a Aplicação

### 1. Cadastro de Usuário

1. Acesse `http://localhost:8000/cadastro`
2. Preencha o formulário com dados válidos:
   - **Nome**: João Silva Santos
   - **Data de Nascimento**: 01/01/1990
   - **Gênero**: Masculino
   - **Nome da Mãe**: Maria Silva Santos
   - **CPF**: 123.456.789-00
   - **Email**: joao@email.com
   - **Telefones**: (+55)11-99999-9999 e (+55)11-3333-3333
   - **CEP**: 01234-567
   - **Endereço completo**
   - **Login**: EXEMPLO (6 letras)
   - **Senha**: MINHASENHA (8+ letras)

3. Clique em "Cadastrar"
4. Você será redirecionado para o dashboard

### 2. Login

1. Acesse `http://localhost:8000/login`
2. Use as credenciais cadastradas:
   - **Login**: EXEMPLO
   - **Senha**: MINHASENHA
3. Clique em "Entrar"

### 3. Explorar Funcionalidades

- **Dashboard**: Estatísticas pessoais e treinos
- **Treinos**: Executar treinos com cronômetro
- **Aulas**: Ver aulas disponíveis
- **Desafios**: Participar de desafios
- **Comunidade**: Interagir com outros usuários

## 🛠️ Comandos Úteis

### Desenvolvimento

```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Executar migrations
php artisan migrate

# Executar migrations com seeders
php artisan migrate --seed

# Ver rotas registradas
php artisan route:list

# Ver logs da aplicação
tail -f storage/logs/laravel.log
```

### Banco de Dados

```bash
# Criar nova migration
php artisan make:migration nome_da_migration

# Criar novo model
php artisan make:model NomeDoModel

# Criar novo controller
php artisan make:controller NomeDoController
```

## 🔧 Configuração Avançada

### Usando MySQL (Opcional)

Se preferir usar MySQL em vez de SQLite:

1. **Instalar MySQL**:
   ```bash
   # Ubuntu/Debian
   sudo apt install mysql-server
   
   # macOS com Homebrew
   brew install mysql
   
   # Windows
   # Baixar do site oficial do MySQL
   ```

2. **Criar banco de dados**:
   ```sql
   CREATE DATABASE fitplan_academy;
   ```

3. **Configurar .env**:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fitplan_academy
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

4. **Executar migrations**:
   ```bash
   php artisan migrate
   ```

### Configuração de Email (Opcional)

Para funcionalidades de email:

1. **Configurar .env**:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=seu_email@gmail.com
   MAIL_PASSWORD=sua_senha_app
   MAIL_ENCRYPTION=tls
   ```

## 🐛 Solução de Problemas

### Erro: "Target class does not exist"

```bash
# Limpar cache de configuração
php artisan config:clear
php artisan cache:clear
```

### Erro: "Permission denied" no storage

```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache

# Windows (PowerShell como Admin)
icacls storage /grant Everyone:F /T
```

### Erro: "Class not found"

```bash
# Reinstalar dependências
composer dump-autoload
```

### Banco de dados não encontrado

```bash
# Recriar banco SQLite
rm database/database.sqlite
touch database/database.sqlite
php artisan migrate
```

## 📱 Acessibilidade

O sistema inclui recursos de acessibilidade:

- **Contraste alto**: Botão na barra lateral
- **Tamanho da fonte**: Aumentar/diminuir
- **Simulação Libras**: Botão na barra lateral
- **Navegação por teclado**: Suporte completo
- **Screen readers**: Compatível

## 🔒 Segurança

### Validações Implementadas

- **CPF**: Algoritmo de dígito verificador
- **CEP**: Validação com API ViaCEP
- **Email**: Formato válido
- **Telefone**: Formato brasileiro
- **Senha**: Criptografia com Hash::make()

### Boas Práticas

- Senhas são sempre criptografadas
- Dados sensíveis não são expostos
- Validação tanto no frontend quanto backend
- Sanitização de todas as entradas

## 📞 Suporte

Se encontrar problemas:

1. **Verifique os logs**: `storage/logs/laravel.log`
2. **Consulte a documentação**: Laravel Docs
3. **Abra uma issue**: GitHub Issues
4. **Entre em contato**: eduardo@email.com

## 🎯 Próximos Passos

Após a instalação:

1. Explore todas as funcionalidades
2. Teste o cadastro e login
3. Experimente os treinos e cronômetro
4. Configure seu ambiente de desenvolvimento
5. Contribua com melhorias!

---

**🎊 Parabéns! O FitPlan Academy está rodando na sua máquina!**

*Para dúvidas ou problemas, consulte a documentação do Laravel ou abra uma issue no GitHub.*
