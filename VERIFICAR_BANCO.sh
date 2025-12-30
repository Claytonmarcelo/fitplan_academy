#!/bin/bash

echo "🔍 Verificando configuração do banco de dados FitPlan Academy"
echo "=========================================================="

# Cores
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

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

echo ""
print_info "1. Verificando conexão com MySQL..."
if mysql -h 127.0.0.1 -u root -e "SELECT 1;" 2>/dev/null; then
    print_success "MySQL está conectado"
else
    print_error "MySQL não está conectado"
    exit 1
fi

echo ""
print_info "2. Verificando bancos de dados disponíveis..."
echo "Bancos encontrados:"
mysql -h 127.0.0.1 -u root -e "SHOW DATABASES;" 2>/dev/null

echo ""
print_info "3. Verificando se o banco fitplan_academy existe..."
if mysql -h 127.0.0.1 -u root -e "USE fitplan_academy;" 2>/dev/null; then
    print_success "Banco fitplan_academy encontrado"
else
    print_error "Banco fitplan_academy não encontrado"
    print_info "Criando banco de dados..."
    mysql -h 127.0.0.1 -u root -e "CREATE DATABASE IF NOT EXISTS fitplan_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null
    if [ $? -eq 0 ]; then
        print_success "Banco criado com sucesso"
    else
        print_error "Erro ao criar banco de dados"
        exit 1
    fi
fi

echo ""
print_info "4. Verificando tabelas no banco fitplan_academy..."
echo "Tabelas encontradas:"
mysql -h 127.0.0.1 -u root -e "USE fitplan_academy; SHOW TABLES;" 2>/dev/null

echo ""
print_info "5. Verificando usuários criados..."
echo "Usuários no sistema:"
mysql -h 127.0.0.1 -u root -e "USE fitplan_academy; SELECT login, name, email, role FROM users LIMIT 5;" 2>/dev/null

echo ""
print_info "6. Testando configuração Laravel..."
if php artisan tinker --execute="DB::connection()->getPdo(); echo 'Conexão Laravel OK';" 2>/dev/null; then
    print_success "Laravel conectado ao MySQL"
else
    print_error "Laravel não consegue conectar ao MySQL"
fi

echo ""
print_success "🎉 Verificação concluída!"
echo ""
print_info "Se o banco não aparece no phpMyAdmin:"
echo "1. Atualize a página do phpMyAdmin (F5)"
echo "2. Clique no ícone de recarregar no painel esquerdo"
echo "3. Faça logout e login novamente no phpMyAdmin"
echo ""
print_info "Acesso ao phpMyAdmin: http://localhost/phpmyadmin"
print_info "Banco: fitplan_academy"
print_info "Usuário: root (sem senha)"
