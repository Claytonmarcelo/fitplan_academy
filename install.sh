#!/bin/bash

# ========================================
# FitPlan Academy - Instalador Universal
# ========================================
# Este script detecta o sistema operacional e executa
# o instalador apropriado (Linux ou Windows)
# 
# Uso: ./install.sh [opções]
# ========================================

set -e

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
    echo "🏋️‍♂️ FitPlan Academy - Instalador Universal"
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

# Função para detectar sistema operacional
detect_os() {
    local os=""
    
    if [[ "$OSTYPE" == "linux-gnu"* ]]; then
        os="linux"
    elif [[ "$OSTYPE" == "darwin"* ]]; then
        os="macos"
    elif [[ "$OSTYPE" == "cygwin" ]] || [[ "$OSTYPE" == "msys" ]] || [[ "$OSTYPE" == "win32" ]]; then
        os="windows"
    else
        os="unknown"
    fi
    
    echo $os
}

# Função para mostrar ajuda
show_help() {
    echo "FitPlan Academy - Instalador Universal"
    echo ""
    echo "Uso: ./install.sh [opções]"
    echo ""
    echo "Opções:"
    echo "  --with-nodejs    Instalar Node.js também"
    echo "  --help, -h      Mostrar esta ajuda"
    echo ""
    echo "Sistemas Suportados:"
    echo "  • Linux (Ubuntu, Debian, CentOS, Fedora, Arch)"
    echo "  • macOS (via Homebrew)"
    echo "  • Windows (via Chocolatey)"
    echo ""
    echo "Exemplos:"
    echo "  ./install.sh"
    echo "  ./install.sh --with-nodejs"
    echo ""
    echo "Arquivos de Instalação:"
    echo "  • install-linux.sh    - Instalador para Linux"
    echo "  • install-windows.bat - Instalador para Windows"
    echo "  • install.sh          - Instalador universal (este arquivo)"
}

# Função para executar instalador Linux
run_linux_installer() {
    print_step "Executando instalador Linux..."
    
    if [ ! -f "install-linux.sh" ]; then
        print_error "Arquivo install-linux.sh não encontrado!"
        exit 1
    fi
    
    chmod +x install-linux.sh
    ./install-linux.sh "$@"
}

# Função para executar instalador Windows
run_windows_installer() {
    print_step "Executando instalador Windows..."
    
    if [ ! -f "install-windows.bat" ]; then
        print_error "Arquivo install-windows.bat não encontrado!"
        exit 1
    fi
    
    cmd.exe /c install-windows.bat "$@"
}

# Função para executar instalador macOS
run_macos_installer() {
    print_step "Executando instalador macOS..."
    print_warning "macOS não é oficialmente suportado, mas tentando usar o instalador Linux..."
    
    if [ ! -f "install-linux.sh" ]; then
        print_error "Arquivo install-linux.sh não encontrado!"
        exit 1
    fi
    
    chmod +x install-linux.sh
    ./install-linux.sh "$@"
}

# Função principal
main() {
    print_header
    
    # Verificar argumentos de ajuda
    if [ "$1" = "--help" ] || [ "$1" = "-h" ]; then
        show_help
        exit 0
    fi
    
    # Detectar sistema operacional
    local os=$(detect_os)
    print_step "Sistema operacional detectado: $os"
    
    case $os in
        linux)
            print_success "Linux detectado! Executando instalador Linux..."
            run_linux_installer "$@"
            ;;
        macos)
            print_warning "macOS detectado! Usando instalador Linux (compatibilidade limitada)..."
            run_macos_installer "$@"
            ;;
        windows)
            print_success "Windows detectado! Executando instalador Windows..."
            run_windows_installer "$@"
            ;;
        *)
            print_error "Sistema operacional não suportado: $OSTYPE"
            print_warning "Sistemas suportados: Linux, macOS, Windows"
            print_warning "Execute manualmente o instalador apropriado:"
            print_warning "  • Linux/macOS: ./install-linux.sh"
            print_warning "  • Windows: install-windows.bat"
            exit 1
            ;;
    esac
}

# Executar função principal
main "$@"
