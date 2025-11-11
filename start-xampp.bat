@echo off
title FitPlan Academy - XAMPP
echo.
echo ==========================================
echo 🏋️‍♂️ FitPlan Academy - XAMPP
echo ==========================================
echo.

REM Verificar se estamos no diretório correto
if not exist "artisan" (
    echo ❌ Erro: Arquivo artisan não encontrado!
    echo Por favor, execute este script na raiz do projeto.
    pause
    exit /b 1
)

REM Verificar se PHP está disponível
php --version >nul 2>&1
if %errorLevel% neq 0 (
    echo ❌ Erro: PHP não encontrado!
    echo Por favor, adicione o PHP do XAMPP ao PATH.
    echo Caminho padrão: C:\xampp\php
    pause
    exit /b 1
)

REM Verificar se MySQL está rodando
echo 🔍 Verificando MySQL...
mysqladmin -u root ping >nul 2>&1
if %errorLevel% neq 0 (
    echo ⚠️  MySQL não está respondendo.
    echo Por favor, inicie o MySQL no XAMPP Control Panel.
    echo.
    echo Pressione qualquer tecla após iniciar o MySQL...
    pause >nul
)

REM Verificar conexão com banco de dados
echo 🔍 Verificando banco de dados...
php artisan db:show >nul 2>&1
if %errorLevel% neq 0 (
    echo ⚠️  Não foi possível conectar ao banco de dados.
    echo Verifique as configurações no arquivo .env
    echo.
    echo Pressione qualquer tecla para continuar mesmo assim...
    pause >nul
)

REM Limpar cache
echo 🧹 Limpando cache...
php artisan cache:clear >nul 2>&1
php artisan config:clear >nul 2>&1
php artisan route:clear >nul 2>&1
php artisan view:clear >nul 2>&1

REM Obter IP local
echo.
echo 🔍 Descobrindo IP local...
for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /c:"IPv4"') do (
    set LOCAL_IP=%%a
    set LOCAL_IP=!LOCAL_IP: =!
    goto :found_ip
)
:found_ip

echo.
echo ==========================================
echo 📋 INFORMAÇÕES DE ACESSO
echo ==========================================
echo.
echo 🌐 URL Local: http://localhost:8000
if defined LOCAL_IP (
    echo 🌐 URL Rede: http://%LOCAL_IP%:8000
)
echo.
echo 👤 Login Master: MASTER
echo 🔑 Senha Master: Master123
echo.
echo ==========================================
echo.

REM Iniciar servidor Laravel
echo 🚀 Iniciando servidor Laravel...
echo.
echo Pressione Ctrl+C para parar o servidor.
echo.

php artisan serve --host=0.0.0.0 --port=8000

pause

