@echo off
setlocal enabledelayedexpansion

REM ========================================
REM FitPlan Academy - Script de Instalação Windows
REM ========================================
REM Este script automatiza a instalação completa do FitPlan Academy
REM Compatível com Windows 10/11
REM 
REM Uso: install-windows.bat
REM ========================================

title FitPlan Academy - Instalação Windows

echo.
echo ==========================================
echo 🏋️‍♂️ FitPlan Academy - Instalação Windows
echo ==========================================
echo.

REM Verificar se está executando como administrador
net session >nul 2>&1
if %errorLevel% == 0 (
    echo ✅ Executando como administrador
) else (
    echo ❌ Este script precisa ser executado como administrador
    echo    Clique com botão direito no arquivo e selecione "Executar como administrador"
    pause
    exit /b 1
)

REM Função para imprimir mensagens coloridas
:print_step
echo 📋 %~1
goto :eof

:print_success
echo ✅ %~1
goto :eof

:print_warning
echo ⚠️  %~1
goto :eof

:print_error
echo ❌ %~1
goto :eof

REM Verificar se Chocolatey está instalado
call :print_step "Verificando Chocolatey..."
where choco >nul 2>&1
if %errorLevel% neq 0 (
    call :print_step "Instalando Chocolatey..."
    powershell -Command "Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))"
    if %errorLevel% neq 0 (
        call :print_error "Falha ao instalar Chocolatey"
        pause
        exit /b 1
    )
    call :print_success "Chocolatey instalado com sucesso!"
) else (
    call :print_success "Chocolatey já está instalado!"
)

REM Instalar dependências
call :print_step "Instalando dependências..."

REM Instalar Git
call :print_step "Instalando Git..."
choco install git -y
if %errorLevel% neq 0 (
    call :print_error "Falha ao instalar Git"
    pause
    exit /b 1
)

REM Instalar PHP
call :print_step "Instalando PHP 8.4..."
choco install php --version=8.4.0 -y
if %errorLevel% neq 0 (
    call :print_error "Falha ao instalar PHP"
    pause
    exit /b 1
)

REM Instalar Composer
call :print_step "Instalando Composer..."
choco install composer -y
if %errorLevel% neq 0 (
    call :print_error "Falha ao instalar Composer"
    pause
    exit /b 1
)

REM Instalar MySQL
call :print_step "Instalando MySQL..."
choco install mysql -y
if %errorLevel% neq 0 (
    call :print_error "Falha ao instalar MySQL"
    pause
    exit /b 1
)

REM Instalar Node.js (opcional)
if "%1"=="--with-nodejs" (
    call :print_step "Instalando Node.js..."
    choco install nodejs -y
    if %errorLevel% neq 0 (
        call :print_warning "Falha ao instalar Node.js, continuando sem ele..."
    )
)

REM Configurar PATH
call :print_step "Configurando variáveis de ambiente..."
setx PATH "%PATH%;C:\tools\php84;C:\ProgramData\chocolatey\bin" /M
set PATH=%PATH%;C:\tools\php84;C:\ProgramData\chocolatey\bin

REM Iniciar MySQL
call :print_step "Iniciando MySQL..."
net start mysql
if %errorLevel% neq 0 (
    call :print_warning "MySQL pode não ter iniciado automaticamente"
    call :print_warning "Inicie manualmente via Serviços do Windows"
)

REM Aguardar MySQL inicializar
timeout /t 10 /nobreak >nul

REM Configurar MySQL
call :print_step "Configurando MySQL..."
mysql -u root -e "CREATE DATABASE IF NOT EXISTS fitplan_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -e "CREATE USER IF NOT EXISTS 'fitplan'@'localhost' IDENTIFIED BY 'fitplan123';"
mysql -u root -e "GRANT ALL PRIVILEGES ON fitplan_academy.* TO 'fitplan'@'localhost';"
mysql -u root -e "FLUSH PRIVILEGES;"

REM Verificar se o diretório já existe
if exist "fitplan_acadamy" (
    call :print_warning "Diretório fitplan_acadamy já existe. Removendo..."
    rmdir /s /q fitplan_acadamy
)

REM Clonar repositório
call :print_step "Clonando repositório..."
git clone https://github.com/edufilhocruz/fitplan_acadamy.git
if %errorLevel% neq 0 (
    call :print_error "Falha ao clonar repositório"
    pause
    exit /b 1
)

REM Navegar para o diretório do projeto
cd fitplan_acadamy

REM Instalar dependências PHP
call :print_step "Instalando dependências PHP..."
composer install --no-dev --optimize-autoloader
if %errorLevel% neq 0 (
    call :print_error "Falha ao instalar dependências PHP"
    pause
    exit /b 1
)

REM Instalar dependências Node.js (se disponível)
where npm >nul 2>&1
if %errorLevel% == 0 (
    call :print_step "Instalando dependências Node.js..."
    npm install
    if %errorLevel% neq 0 (
        call :print_warning "Falha ao instalar dependências Node.js, continuando..."
    )
)

REM Configurar ambiente
call :print_step "Configurando ambiente..."
copy mysql.env.config .env
php artisan key:generate

REM Configurar banco de dados no .env
powershell -Command "(Get-Content .env) -replace 'DB_PASSWORD=sua_senha_mysql_aqui', 'DB_PASSWORD=fitplan123' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_USERNAME=root', 'DB_USERNAME=fitplan' | Set-Content .env"

REM Executar migrations
call :print_step "Executando migrations..."
php artisan migrate --force
if %errorLevel% neq 0 (
    call :print_error "Falha ao executar migrations"
    pause
    exit /b 1
)

REM Criar usuário Master
call :print_step "Criando usuário Master..."
php artisan db:seed --class=MasterUserSeeder --force
if %errorLevel% neq 0 (
    call :print_error "Falha ao criar usuário Master"
    pause
    exit /b 1
)

REM Criar script de inicialização
call :print_step "Criando script de inicialização..."
echo @echo off > ..\start-fitplan.bat
echo title FitPlan Academy >> ..\start-fitplan.bat
echo echo 🏋️‍♂️ Iniciando FitPlan Academy... >> ..\start-fitplan.bat
echo. >> ..\start-fitplan.bat
echo REM Verificar se MySQL está rodando >> ..\start-fitplan.bat
echo net start mysql ^>nul 2^>^&1 >> ..\start-fitplan.bat
echo if %%errorLevel%% neq 0 ^( >> ..\start-fitplan.bat
echo     echo ⚠️  Iniciando MySQL... >> ..\start-fitplan.bat
echo     net start mysql >> ..\start-fitplan.bat
echo ^) >> ..\start-fitplan.bat
echo. >> ..\start-fitplan.bat
echo REM Navegar para o diretório do projeto >> ..\start-fitplan.bat
echo cd /d "%%~dp0fitplan_acadamy" >> ..\start-fitplan.bat
echo. >> ..\start-fitplan.bat
echo REM Iniciar servidor Laravel >> ..\start-fitplan.bat
echo echo 🚀 Iniciando servidor Laravel... >> ..\start-fitplan.bat
echo php artisan serve --host=0.0.0.0 --port=8000 >> ..\start-fitplan.bat
echo pause >> ..\start-fitplan.bat

REM Criar atalho na área de trabalho
call :print_step "Criando atalho na área de trabalho..."
powershell -Command "$WshShell = New-Object -comObject WScript.Shell; $Shortcut = $WshShell.CreateShortcut('%USERPROFILE%\Desktop\FitPlan Academy.lnk'); $Shortcut.TargetPath = '%CD%\..\start-fitplan.bat'; $Shortcut.WorkingDirectory = '%CD%\..'; $Shortcut.Description = 'FitPlan Academy - Sistema de Gestão de Academia'; $Shortcut.Save()"

REM Mostrar informações finais
echo.
echo ==========================================
echo 🎊 INSTALAÇÃO CONCLUÍDA COM SUCESSO!
echo ==========================================
echo.
echo 📋 INFORMAÇÕES DE ACESSO:
echo 🌐 URL: http://localhost:8000
echo 👤 Login Master: MASTER
echo 🔑 Senha Master: Master123
echo 📧 Email Master: master@fitplan.com.br
echo.
echo 🗄️ BANCO DE DADOS:
echo 🏠 Host: localhost
echo 🔌 Porta: 3306
echo 📊 Banco: fitplan_academy
echo 👤 Usuário: fitplan
echo 🔑 Senha: fitplan123
echo.
echo 🚀 COMANDOS ÚTEIS:
echo ▶️  Iniciar: start-fitplan.bat
echo 📁 Projeto: cd fitplan_acadamy
echo 🔧 Artisan: php artisan [comando]
echo 🗄️ MySQL: mysql -u fitplan -p fitplan_academy
echo.
echo ⚠️  IMPORTANTE:
echo • Altere a senha do usuário Master após o primeiro login
echo • Configure um servidor web (IIS/Apache) para produção
echo • Configure SSL/HTTPS para ambiente de produção
echo • Faça backup regular do banco de dados
echo.
echo 🎯 Próximos passos:
echo 1. Execute: start-fitplan.bat
echo 2. Acesse: http://localhost:8000
echo 3. Faça login com as credenciais Master
echo 4. Explore todas as funcionalidades!
echo.

REM Verificar se foi executado com Node.js
if "%1"=="--with-nodejs" (
    echo 📦 Node.js também foi instalado!
)

echo.
echo ✅ Instalação concluída! Pressione qualquer tecla para sair...
pause >nul
