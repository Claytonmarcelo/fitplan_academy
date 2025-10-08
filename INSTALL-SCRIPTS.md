# 🚀 Scripts de Instalação Automática - FitPlan Academy

Scripts executáveis para instalação automática e completa do FitPlan Academy em diferentes sistemas operacionais.

## 📋 Scripts Disponíveis

### 🔧 Instalador Universal
- **Arquivo**: `install.sh`
- **Descrição**: Detecta automaticamente o sistema operacional e executa o instalador apropriado
- **Uso**: `./install.sh [opções]`

### 🐧 Instalador Linux
- **Arquivo**: `install-linux.sh`
- **Descrição**: Instalação completa para Linux (Ubuntu, Debian, CentOS, Fedora, Arch)
- **Uso**: `./install-linux.sh [opções]`

### 🪟 Instalador Windows
- **Arquivo**: `install-windows.bat`
- **Descrição**: Instalação completa para Windows 10/11
- **Uso**: `install-windows.bat [opções]`

## 🚀 Instalação Rápida

### Linux/macOS
```bash
# Baixar e executar instalador universal
curl -sSL https://raw.githubusercontent.com/edufilhocruz/fitplan_acadamy/main/install.sh | bash

# Ou baixar e executar manualmente
wget https://raw.githubusercontent.com/edufilhocruz/fitplan_acadamy/main/install.sh
chmod +x install.sh
./install.sh
```

### Windows
```cmd
# Baixar e executar como administrador
powershell -Command "Invoke-WebRequest -Uri 'https://raw.githubusercontent.com/edufilhocruz/fitplan_acadamy/main/install-windows.bat' -OutFile 'install-windows.bat'; .\install-windows.bat"
```

## 📦 O que é Instalado

### Dependências Básicas
- **Git** - Controle de versão
- **PHP 8.4** - Linguagem principal
- **Composer** - Gerenciador de dependências PHP
- **MySQL** - Banco de dados
- **Node.js** (opcional) - Para desenvolvimento frontend

### Configurações Automáticas
- ✅ Banco de dados `fitplan_academy` criado
- ✅ Usuário MySQL `fitplan` configurado
- ✅ Projeto clonado do GitHub
- ✅ Dependências instaladas
- ✅ Migrations executadas
- ✅ Usuário Master criado
- ✅ Script de inicialização gerado

## 🎯 Opções de Instalação

### Com Node.js
```bash
# Linux/macOS
./install.sh --with-nodejs

# Windows
install-windows.bat --with-nodejs
```

### Apenas Linux
```bash
./install-linux.sh --with-nodejs
```

## 📊 Credenciais Padrão

### Usuário Master
- **Login**: MASTER
- **Senha**: Master123
- **Email**: master@fitplan.com.br

### Banco MySQL
- **Host**: localhost
- **Porta**: 3306
- **Banco**: fitplan_academy
- **Usuário**: fitplan
- **Senha**: fitplan123

## 🚀 Após a Instalação

### Iniciar o Sistema
```bash
# Linux/macOS
./start-fitplan.sh

# Windows
start-fitplan.bat
```

### Acessar a Aplicação
- **URL**: http://localhost:8000
- **Login**: MASTER
- **Senha**: Master123

## 🔧 Comandos Úteis

### Gerenciamento do Projeto
```bash
# Navegar para o projeto
cd fitplan_acadamy

# Comandos Laravel
php artisan serve
php artisan migrate
php artisan db:seed

# Comandos MySQL
mysql -u fitplan -p fitplan_academy
```

### Desenvolvimento
```bash
# Instalar dependências
composer install
npm install

# Executar testes
php artisan test

# Limpar cache
php artisan cache:clear
```

## 🐛 Solução de Problemas

### Linux
```bash
# Verificar serviços
sudo systemctl status mysql
sudo systemctl start mysql

# Verificar logs
tail -f storage/logs/laravel.log

# Recriar banco
mysql -u root -e "DROP DATABASE fitplan_academy; CREATE DATABASE fitplan_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Windows
```cmd
# Verificar serviços
net start mysql

# Verificar logs
type storage\logs\laravel.log

# Recriar banco
mysql -u root -e "DROP DATABASE fitplan_academy; CREATE DATABASE fitplan_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

## 📋 Requisitos do Sistema

### Linux
- **Distribuições**: Ubuntu 18.04+, Debian 9+, CentOS 7+, Fedora 30+, Arch Linux
- **RAM**: Mínimo 2GB, Recomendado 4GB+
- **Espaço**: Mínimo 2GB livres
- **Permissões**: sudo (para instalação de pacotes)

### Windows
- **Sistema**: Windows 10/11
- **RAM**: Mínimo 2GB, Recomendado 4GB+
- **Espaço**: Mínimo 2GB livres
- **Permissões**: Administrador (para instalação)

### macOS
- **Sistema**: macOS 10.15+
- **RAM**: Mínimo 2GB, Recomendado 4GB+
- **Espaço**: Mínimo 2GB livres
- **Ferramentas**: Homebrew (instalado automaticamente)

## 🔒 Segurança

### Pós-Instalação
1. **Altere a senha** do usuário Master
2. **Configure SSL/HTTPS** para produção
3. **Configure firewall** adequadamente
4. **Faça backup** regular do banco
5. **Atualize** dependências regularmente

### Produção
- Use servidor web (Apache/Nginx/IIS)
- Configure SSL/TLS
- Use banco de dados dedicado
- Configure monitoramento
- Implemente backup automático

## 📞 Suporte

### Problemas Comuns
1. **MySQL não inicia**: Verifique serviços e permissões
2. **Composer falha**: Verifique conexão com internet
3. **Permissões negadas**: Execute como administrador/sudo
4. **Porta ocupada**: Pare outros serviços na porta 8000

### Contato
- **GitHub Issues**: [Abrir issue](https://github.com/edufilhocruz/fitplan_acadamy/issues)
- **Email**: eduardo@email.com
- **Documentação**: [INSTALLATION.md](INSTALLATION.md)

## 🎊 Próximos Passos

Após a instalação bem-sucedida:

1. **Execute** o script de inicialização
2. **Acesse** http://localhost:8000
3. **Faça login** com as credenciais Master
4. **Explore** todas as funcionalidades
5. **Configure** para seu ambiente específico
6. **Contribua** com melhorias!

---

**🎯 Instalação automática e completa do FitPlan Academy!**

*Para instalação manual, consulte o arquivo [INSTALLATION.md](INSTALLATION.md)*
