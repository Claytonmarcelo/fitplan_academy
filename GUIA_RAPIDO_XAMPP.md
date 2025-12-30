# 🚀 Guia Rápido - FitPlan Academy com XAMPP

## 📋 Resumo da Configuração

Este guia ajuda a configurar o FitPlan Academy para funcionar com XAMPP e MySQL de forma rápida e simples.

## 🔧 Configuração Automática (Recomendado)

### Passo 1: Executar Script de Instalação

```bash
# No terminal, na pasta do projeto:
./INSTALAR_XAMPP.sh
```

Este script irá:

- ✅ Verificar pré-requisitos (PHP, Composer)
- ✅ Instalar dependências do Laravel
- ✅ Configurar arquivo `.env`
- ✅ Gerar chave da aplicação
- ✅ Configurar permissões
- ✅ Criar banco de dados `fitplan_academy`
- ✅ Executar migrations e seeders
- ✅ Criar scripts de inicialização

### Passo 2: Iniciar XAMPP

1. Abra o **XAMPP Control Panel**
2. Inicie os serviços:

   - ✅ **Apache**
   - ✅ **MySQL**

### Passo 3: Iniciar o Projeto

```bash
# Use o script criado automaticamente:
./start.sh
```

Ou manualmente:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## 🌐 Acesso ao Sistema

### Acesso Local

- **URL**: `http://localhost:8000`
- **Login Master**: `MASTER` / `Master123`

### Acesso via phpMyAdmin

- **URL**: `http://localhost/phpmyadmin`
- **Usuário**: `root`
- **Senha**: (vazio)
- **Banco**: `fitplan_academy`

## 📊 Estrutura do Banco de Dados

O sistema cria automaticamente as seguintes tabelas:

- `users` - Usuários do sistema
- `plans` - Planos de assinatura
- `subscriptions` - Assinaturas ativas
- `payments` - Pagamentos registrados
- `checkouts` - Registros de checkout
- `access_logs` - Logs de acesso
- `student_workouts` - Treinos dos alunos
- `student_goals` - Metas dos alunos

## 🐛 Solução de Problemas Comuns

### ❌ "MySQL não está rodando"

**Solução**: Inicie o XAMPP e o serviço MySQL

### ❌ "Erro de conexão com banco de dados"

**Solução**:

1. Verifique se o MySQL está rodando no XAMPP
2. Confirme as credenciais no `.env`:

   ```env
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fitplan_academy
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### ❌ "Erro 419 CSRF Token"

**Solução**: Limpe o cache:

```bash
php artisan cache:clear
php artisan session:clear
```

### ❌ "Não consigo acessar de outro computador"

**Solução**:

1. Use `--host=0.0.0.0` ao iniciar o servidor
2. Configure o firewall para permitir porta 8000
3. Acesse via IP: `http://IP_DO_SERVIDOR:8000`

## 📝 Scripts Disponíveis

Após a instalação, você terá estes scripts:

- `INSTALAR_XAMPP.sh` - Instalação completa
- `start.sh` - Inicia o servidor Laravel
- `setup.sh` - Lembretes de configuração

## 🔍 Verificação da Instalação

Para verificar se tudo está funcionando:

1. **Acesso ao sistema**: `http://localhost:8000`
2. **Login Master**: Faça login com `MASTER` / `Master123`
3. **Banco de dados**: Acesse `http://localhost/phpmyadmin` e verifique o banco `fitplan_academy`
4. **Cadastro**: Teste criar um novo usuário

## 📱 Funcionalidades Disponíveis

- ✅ Sistema de login/cadastro
- ✅ Dashboard administrativo
- ✅ Gestão de planos e assinaturas
- ✅ Registro de pagamentos
- ✅ Controle de acesso
- ✅ Gestão de treinos e metas

## 🎉 Pronto para Uso

Após seguir estes passos, o FitPlan Academy estará:
- ✅ Configurado com XAMPP
- ✅ Conectado ao MySQL
- ✅ Acessível via navegador
- ✅ Com dados iniciais carregados
- ✅ Pronto para uso em rede local

---

**Dúvidas?** Consulte o arquivo `CONFIGURACAO_XAMPP.md` para instruções detalhadas.
