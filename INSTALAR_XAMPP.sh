#!/bin/bash

# 🏋️‍♂️ Script de Instalação Automática - FitPlan Academy para XAMPP
# Este script configura o projeto para funcionar com XAMPP e MySQL

echo "🚀 Iniciando configuração do FitPlan Academy para XAMPP..."
echo "=================================================="

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Função para verificar se comando existe
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Função para exibir mensagens coloridas
print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

# Verificar se está no diretório correto
if [ ! -f "artisan" ]; then
    print_error "Este script deve ser executado na raiz do projeto Laravel (onde está o arquivo artisan)"
    exit 1
fi

print_info "Verificando pré-requisitos..."

# Verificar PHP
if command_exists php; then
    PHP_VERSION=$(php -v | head -n1 | cut -d' ' -f2 | cut -d'-' -f1)
    print_success "PHP encontrado: $PHP_VERSION"
else
    print_error "PHP não encontrado. Por favor, instale o PHP primeiro."
    exit 1
fi

# Verificar Composer
if command_exists composer; then
    COMPOSER_VERSION=$(composer --version | cut -d' ' -f3)
    print_success "Composer encontrado: $COMPOSER_VERSION"
else
    print_error "Composer não encontrado. Por favor, instale o Composer primeiro."
    exit 1
fi

# Verificar MySQL
if command_exists mysql; then
    print_success "MySQL cliente encontrado"
else
    print_warning "MySQL cliente não encontrado no PATH, mas isso pode ser normal com XAMPP"
fi

echo ""
print_info "Configurando ambiente..."

# Instalar dependências do Composer
echo "📦 Instalando dependências do Composer..."
if composer install --no-interaction --optimize-autoloader; then
    print_success "Dependências do Composer instaladas"
else
    print_error "Erro ao instalar dependências do Composer"
    exit 1
fi

# Copiar .env se não existir
if [ ! -f ".env" ]; then
    print_info "Copiando arquivo .env..."
    cp .env.example .env
    print_success "Arquivo .env criado"
fi

# Gerar APP_KEY
echo "🔑 Gerando chave da aplicação..."
if php artisan key:generate --force; then
    print_success "Chave da aplicação gerada"
else
    print_error "Erro ao gerar chave da aplicação"
    exit 1
fi

# Configurar permissões
echo "🔐 Configurando permissões..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache
print_success "Permissões configuradas"

# Limpar cache
echo "🧹 Limpando cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
print_success "Cache limpo"

echo ""
print_info "Configuração do banco de dados MySQL:"
echo "  - Host: 127.0.0.1"
echo "  - Porta: 3306"
echo "  - Banco: fitplan_academy"
echo "  - Usuário: root"
echo "  - Senha: (vazio - padrão XAMPP)"
echo ""

read -p "Pressione ENTER para continuar com a configuração do banco de dados..."

# Testar conexão com MySQL
echo "🔍 Testando conexão com MySQL..."
if mysql -h 127.0.0.1 -u root -e "SELECT 1;" 2>/dev/null; then
    print_success "Conexão com MySQL estabelecida"
    
    # Criar banco de dados
    echo "📊 Criando banco de dados fitplan_academy..."
    if mysql -h 127.0.0.1 -u root -e "CREATE DATABASE IF NOT EXISTS fitplan_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null; then
        print_success "Banco de dados criado com sucesso"
    else
        print_error "Erro ao criar banco de dados"
        exit 1
    fi
    
    # Executar migrations
    echo "🔄 Executando migrations..."
    if php artisan migrate --force; then
        print_success "Migrations executadas com sucesso"
    else
        print_error "Erro ao executar migrations"
        exit 1
    fi
    
    # Executar seeders
    echo "🌱 Executando seeders..."
    if php artisan db:seed --force; then
        print_success "Seeders executados com sucesso"
    else
        print_error "Erro ao executar seeders"
        exit 1
    fi
    
else
    print_error "Não foi possível conectar ao MySQL"
    print_info "Verifique se:"
    echo "  1. O XAMPP está instalado e rodando"
    echo "  2. O serviço MySQL está iniciado no XAMPP"
    echo "  3. As credenciais do MySQL estão corretas (root sem senha)"
    echo "  4. O MySQL está configurado para aceitar conexões locais"
    exit 1
fi

echo ""
print_info "Criando scripts de inicialização..."

# Criar script start.sh
cat > start.sh << 'EOF'
#!/bin/bash

echo "🏋️‍♂️ Iniciando FitPlan Academy..."

# Verificar se MySQL está rodando
if ! mysql -h 127.0.0.1 -u root -e "SELECT 1;" 2>/dev/null; then
    echo "❌ MySQL não está rodando. Inicie o XAMPP e o serviço MySQL."
    exit 1
fi

# Iniciar servidor Laravel
echo "🚀 Iniciando servidor Laravel em http://localhost:8000"
php artisan serve --host=0.0.0.0 --port=8000
EOF

chmod +x start.sh
print_success "Script start.sh criado"

# Criar script setup.sh
cat > setup.sh << 'EOF'
#!/bin/bash

echo "🔧 FitPlan Academy - Configuração Rápida"
echo "======================================"

echo "1. Inicie o XAMPP Control Panel"
echo "2. Inicie os serviços Apache e MySQL"
echo "3. Execute: ./start.sh"
echo ""
echo "Acesso:"
echo "- Local: http://localhost:8000"
echo "- Rede: http://SEU_IP_LOCAL:8000"
echo ""
echo "Login Master:"
echo "- Usuário: MASTER"
echo "- Senha: Master123"
EOF

chmod +x setup.sh
print_success "Script setup.sh criado"

echo ""
print_success "🎉 Configuração concluída com sucesso!"
echo ""
echo "📋 Próximos passos:"
echo "1. Inicie o XAMPP Control Panel"
echo "2. Inicie os serviços Apache e MySQL"
echo "3. Execute o servidor: ./start.sh"
echo "4. Acesse: http://localhost:8000"
echo ""
echo "🔐 Credenciais de acesso:"
echo "- Login Master: MASTER / Master123"
echo "- phpMyAdmin: http://localhost/phpmyadmin (root sem senha)"
echo ""
echo "📁 Banco de dados:"
echo "- Nome: fitplan_academy"
echo "- Acesso via phpMyAdmin disponível"
echo ""
print_info "O projeto está pronto para uso com XAMPP!"
