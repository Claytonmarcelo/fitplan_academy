#!/bin/bash

# Instalar dependências se não existirem
if [ ! -d "vendor" ]; then
    composer install
fi

# Copiar .env se não existir
if [ ! -f ".env" ]; then
    cp .env.example .env
    php artisan key:generate
fi

# Aguardar MySQL estar pronto
echo "Aguardando MySQL..."
sleep 10

# Rodar migrações
php artisan migrate --force

# Rodar seeders (opcional, descomente se quiser rodar sempre)
# php artisan db:seed --force

# Iniciar PHP-FPM
php-fpm
