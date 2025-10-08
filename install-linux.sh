#!/bin/bash

# ========================================
# FitPlan Academy - Script de Instalação Linux
# ========================================
# Este script automatiza a instalação completa do FitPlan Academy
# Compatível com Ubuntu, Debian, CentOS, Fedora e derivados
# 
# Uso: ./install-linux.sh
# ========================================

set -e  # Parar em caso de erro

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Função para imprimir mensagens coloridas
print_message() {
    echo -e "${2}${1}${NC}"
}

print_header() {
    echo -e "${PURPLE}"
    echo "=========================================="
    echo "🏋️‍♂️ FitPlan Academy - Instalação Linux"
    echo "=========================================="
    echo -e "${NC}"
}

print_step() {
    echo -e "${CYAN}📋 $1${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Função para detectar distribuição Linux
detect_distro() {
    if [ -f /etc/os-release ]; then
        . /etc/os-release
        DISTRO=$ID
    elif type lsb_release >/dev/null 2>&1; then
        DISTRO=$(lsb_release -si | tr '[:upper:]' '[:lower:]')
    else
        DISTRO=$(uname -s | tr '[:upper:]' '[:lower:]')
    fi
    echo $DISTRO
}

# Função para instalar dependências baseadas na distribuição
install_dependencies() {
    local distro=$(detect_distro)
    
    print_step "Detectando distribuição: $distro"
    
    case $distro in
        ubuntu|debian|linuxmint)
            print_step "Instalando dependências para Ubuntu/Debian..."
            sudo apt update
            sudo apt install -y curl wget git unzip software-properties-common apt-transport-https ca-certificates gnupg lsb-release
            ;;
        centos|rhel|fedora)
            print_step "Instalando dependências para CentOS/RHEL/Fedora..."
            if command -v dnf &> /dev/null; then
                sudo dnf update -y
                sudo dnf install -y curl wget git unzip
            else
                sudo yum update -y
                sudo yum install -y curl wget git unzip
            fi
            ;;
        arch|manjaro)
            print_step "Instalando dependências para Arch/Manjaro..."
            sudo pacman -Syu --noconfirm
            sudo pacman -S --noconfirm curl wget git unzip
            ;;
        *)
            print_warning "Distribuição não reconhecida: $distro"
            print_warning "Tentando instalar dependências básicas..."
            ;;
    esac
}

# Função para instalar PHP
install_php() {
    print_step "Instalando PHP 8.4..."
    
    local distro=$(detect_distro)
    
    case $distro in
        ubuntu|debian|linuxmint)
            # Adicionar repositório PHP
            sudo add-apt-repository ppa:ondrej/php -y
            sudo apt update
            sudo apt install -y php8.4 php8.4-cli php8.4-fpm php8.4-mysql php8.4-xml php8.4-mbstring php8.4-curl php8.4-zip php8.4-bcmath php8.4-gd php8.4-intl php8.4-xmlrpc php8.4-soap
            ;;
        centos|rhel|fedora)
            if command -v dnf &> /dev/null; then
                sudo dnf install -y php php-cli php-fpm php-mysqlnd php-xml php-mbstring php-curl php-zip php-bcmath php-gd php-intl php-xmlrpc php-soap
            else
                sudo yum install -y php php-cli php-fpm php-mysqlnd php-xml php-mbstring php-curl php-zip php-bcmath php-gd php-intl php-xmlrpc php-soap
            fi
            ;;
        arch|manjaro)
            sudo pacman -S --noconfirm php php-fpm
            ;;
        *)
            print_warning "Instalação manual de PHP necessária para $distro"
            ;;
    esac
    
    print_success "PHP instalado com sucesso!"
    php --version
}

# Função para instalar Composer
install_composer() {
    print_step "Instalando Composer..."
    
    if command -v composer &> /dev/null; then
        print_success "Composer já está instalado!"
        composer --version
        return
    fi
    
    # Baixar e instalar Composer
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    sudo chmod +x /usr/local/bin/composer
    
    print_success "Composer instalado com sucesso!"
    composer --version
}

# Função para instalar MySQL
install_mysql() {
    print_step "Instalando MySQL..."
    
    local distro=$(detect_distro)
    
    case $distro in
        ubuntu|debian|linuxmint)
            sudo apt install -y mysql-server mysql-client
            sudo systemctl start mysql
            sudo systemctl enable mysql
            ;;
        centos|rhel|fedora)
            if command -v dnf &> /dev/null; then
                sudo dnf install -y mysql-server mysql
            else
                sudo yum install -y mysql-server mysql
            fi
            sudo systemctl start mysqld
            sudo systemctl enable mysqld
            ;;
        arch|manjaro)
            sudo pacman -S --noconfirm mysql
            sudo systemctl start mysqld
            sudo systemctl enable mysqld
            ;;
        *)
            print_warning "Instalação manual de MySQL necessária para $distro"
            ;;
    esac
    
    print_success "MySQL instalado com sucesso!"
}

# Função para configurar MySQL
configure_mysql() {
    print_step "Configurando MySQL..."
    
    # Criar banco de dados
    sudo mysql -e "CREATE DATABASE IF NOT EXISTS fitplan_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    
    # Criar usuário se não existir
    sudo mysql -e "CREATE USER IF NOT EXISTS 'fitplan'@'localhost' IDENTIFIED BY 'fitplan123';"
    sudo mysql -e "GRANT ALL PRIVILEGES ON fitplan_academy.* TO 'fitplan'@'localhost';"
    sudo mysql -e "FLUSH PRIVILEGES;"
    
    print_success "MySQL configurado com sucesso!"
}

# Função para instalar Node.js (opcional)
install_nodejs() {
    print_step "Instalando Node.js..."
    
    if command -v node &> /dev/null; then
        print_success "Node.js já está instalado!"
        node --version
        return
    fi
    
    # Instalar Node.js via NodeSource
    curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
    sudo apt install -y nodejs
    
    print_success "Node.js instalado com sucesso!"
    node --version
    npm --version
}

# Função para clonar e configurar o projeto
setup_project() {
    print_step "Configurando projeto FitPlan Academy..."
    
    # Verificar se já existe
    if [ -d "fitplan_acadamy" ]; then
        print_warning "Diretório fitplan_acadamy já existe. Removendo..."
        rm -rf fitplan_acadamy
    fi
    
    # Clonar repositório
    git clone https://github.com/edufilhocruz/fitplan_acadamy.git
    cd fitplan_acadamy
    
    # Instalar dependências PHP
    print_step "Instalando dependências PHP..."
    composer install --no-dev --optimize-autoloader
    
    # Instalar dependências Node.js (se disponível)
    if command -v npm &> /dev/null; then
        print_step "Instalando dependências Node.js..."
        npm install
    fi
    
    # Configurar ambiente
    print_step "Configurando ambiente..."
    cp mysql.env.config .env
    php artisan key:generate
    
    # Configurar banco de dados no .env
    sed -i "s/DB_PASSWORD=sua_senha_mysql_aqui/DB_PASSWORD=fitplan123/" .env
    sed -i "s/DB_USERNAME=root/DB_USERNAME=fitplan/" .env
    
    # Executar migrations
    print_step "Executando migrations..."
    php artisan migrate --force
    
    # Criar usuário Master
    print_step "Criando usuário Master..."
    php artisan db:seed --class=MasterUserSeeder --force
    
    # Configurar permissões
    print_step "Configurando permissões..."
    sudo chown -R $USER:$USER storage bootstrap/cache
    chmod -R 775 storage bootstrap/cache
    
    print_success "Projeto configurado com sucesso!"
}

# Função para criar script de inicialização
create_startup_script() {
    print_step "Criando script de inicialização..."
    
    cat > start-fitplan.sh << 'EOF'
#!/bin/bash

# FitPlan Academy - Script de Inicialização
echo "🏋️‍♂️ Iniciando FitPlan Academy..."

# Verificar se MySQL está rodando
if ! systemctl is-active --quiet mysql && ! systemctl is-active --quiet mysqld; then
    echo "⚠️  Iniciando MySQL..."
    if systemctl is-active --quiet mysql; then
        sudo systemctl start mysql
    else
        sudo systemctl start mysqld
    fi
fi

# Navegar para o diretório do projeto
cd "$(dirname "$0")/fitplan_acadamy"

# Iniciar servidor Laravel
echo "🚀 Iniciando servidor Laravel..."
php artisan serve --host=0.0.0.0 --port=8000
EOF

    chmod +x start-fitplan.sh
    
    print_success "Script de inicialização criado: start-fitplan.sh"
}

# Função para mostrar informações finais
show_final_info() {
    echo -e "${GREEN}"
    echo "=========================================="
    echo "🎊 INSTALAÇÃO CONCLUÍDA COM SUCESSO!"
    echo "=========================================="
    echo -e "${NC}"
    
    echo -e "${CYAN}📋 INFORMAÇÕES DE ACESSO:${NC}"
    echo "🌐 URL: http://localhost:8000"
    echo "👤 Login Master: MASTER"
    echo "🔑 Senha Master: Master123"
    echo "📧 Email Master: master@fitplan.com.br"
    echo ""
    
    echo -e "${CYAN}🗄️ BANCO DE DADOS:${NC}"
    echo "🏠 Host: localhost"
    echo "🔌 Porta: 3306"
    echo "📊 Banco: fitplan_academy"
    echo "👤 Usuário: fitplan"
    echo "🔑 Senha: fitplan123"
    echo ""
    
    echo -e "${CYAN}🚀 COMANDOS ÚTEIS:${NC}"
    echo "▶️  Iniciar: ./start-fitplan.sh"
    echo "📁 Projeto: cd fitplan_acadamy"
    echo "🔧 Artisan: php artisan [comando]"
    echo "🗄️ MySQL: mysql -u fitplan -p fitplan_academy"
    echo ""
    
    echo -e "${YELLOW}⚠️  IMPORTANTE:${NC}"
    echo "• Altere a senha do usuário Master após o primeiro login"
    echo "• Configure um servidor web (Apache/Nginx) para produção"
    echo "• Configure SSL/HTTPS para ambiente de produção"
    echo "• Faça backup regular do banco de dados"
    echo ""
    
    echo -e "${GREEN}🎯 Próximos passos:${NC}"
    echo "1. Execute: ./start-fitplan.sh"
    echo "2. Acesse: http://localhost:8000"
    echo "3. Faça login com as credenciais Master"
    echo "4. Explore todas as funcionalidades!"
}

# Função principal
main() {
    print_header
    
    # Verificar se é root
    if [ "$EUID" -eq 0 ]; then
        print_error "Não execute este script como root!"
        print_warning "Execute como usuário normal. O script pedirá sudo quando necessário."
        exit 1
    fi
    
    # Verificar se sudo está disponível
    if ! command -v sudo &> /dev/null; then
        print_error "sudo não está disponível. Instale sudo primeiro."
        exit 1
    fi
    
    print_step "Iniciando instalação do FitPlan Academy..."
    
    # Instalar dependências
    install_dependencies
    
    # Instalar PHP
    install_php
    
    # Instalar Composer
    install_composer
    
    # Instalar MySQL
    install_mysql
    
    # Configurar MySQL
    configure_mysql
    
    # Instalar Node.js (opcional)
    if [ "$1" = "--with-nodejs" ]; then
        install_nodejs
    fi
    
    # Configurar projeto
    setup_project
    
    # Criar script de inicialização
    create_startup_script
    
    # Mostrar informações finais
    show_final_info
}

# Verificar argumentos
if [ "$1" = "--help" ] || [ "$1" = "-h" ]; then
    echo "FitPlan Academy - Script de Instalação Linux"
    echo ""
    echo "Uso: ./install-linux.sh [opções]"
    echo ""
    echo "Opções:"
    echo "  --with-nodejs    Instalar Node.js também"
    echo "  --help, -h      Mostrar esta ajuda"
    echo ""
    echo "Exemplos:"
    echo "  ./install-linux.sh"
    echo "  ./install-linux.sh --with-nodejs"
    exit 0
fi

# Executar função principal
main "$@"
