#!/bin/bash

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}"
echo "=========================================="
echo "🏋️‍♂️ FitPlan Academy - XAMPP"
echo "=========================================="
echo -e "${NC}"

# Verificar se estamos no diretório correto
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Erro: Arquivo artisan não encontrado!${NC}"
    echo "Por favor, execute este script na raiz do projeto."
    exit 1
fi

# Verificar se PHP está disponível
if ! command -v php &> /dev/null; then
    echo -e "${RED}❌ Erro: PHP não encontrado!${NC}"
    echo "Por favor, adicione o PHP ao PATH."
    exit 1
fi

# Verificar se MySQL está rodando
echo -e "${YELLOW}🔍 Verificando MySQL...${NC}"
if ! mysqladmin -u root ping &> /dev/null; then
    echo -e "${YELLOW}⚠️  MySQL não está respondendo.${NC}"
    echo "Por favor, inicie o MySQL no XAMPP Control Panel."
    echo ""
    read -p "Pressione Enter após iniciar o MySQL..."
fi

# Verificar conexão com banco de dados
echo -e "${YELLOW}🔍 Verificando banco de dados...${NC}"
if ! php artisan db:show &> /dev/null; then
    echo -e "${YELLOW}⚠️  Não foi possível conectar ao banco de dados.${NC}"
    echo "Verifique as configurações no arquivo .env"
    echo ""
    read -p "Pressione Enter para continuar mesmo assim..."
fi

# Limpar cache
echo -e "${YELLOW}🧹 Limpando cache...${NC}"
php artisan cache:clear &> /dev/null
php artisan config:clear &> /dev/null
php artisan route:clear &> /dev/null
php artisan view:clear &> /dev/null

# Obter IP local
echo ""
echo -e "${YELLOW}🔍 Descobrindo IP local...${NC}"
LOCAL_IP=$(hostname -I | awk '{print $1}')

if [ -z "$LOCAL_IP" ]; then
    LOCAL_IP=$(ip addr show | grep -oP '(?<=inet\s)\d+(\.\d+){3}' | grep -v '127.0.0.1' | head -n1)
fi

echo ""
echo -e "${BLUE}=========================================="
echo "📋 INFORMAÇÕES DE ACESSO"
echo "=========================================="
echo -e "${NC}"
echo "🌐 URL Local: http://localhost:8000"
if [ ! -z "$LOCAL_IP" ]; then
    echo "🌐 URL Rede: http://$LOCAL_IP:8000"
fi
echo ""
echo "👤 Login Master: MASTER"
echo "🔑 Senha Master: Master123"
echo ""
echo -e "${BLUE}=========================================="
echo -e "${NC}"

# Iniciar servidor Laravel
echo -e "${GREEN}🚀 Iniciando servidor Laravel...${NC}"
echo ""
echo "Pressione Ctrl+C para parar o servidor."
echo ""

php artisan serve --host=0.0.0.0 --port=8000


