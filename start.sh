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
