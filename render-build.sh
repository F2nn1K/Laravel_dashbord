#!/bin/bash

# Script de build simplificado para o Render

# Instalar dependências
composer install --optimize-autoloader --no-dev

# Dump autoload (carregar helpers)
composer dump-autoload

# Garantir pastas de cache/sessões/logs
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs
touch storage/logs/laravel.log
chmod -R 775 storage bootstrap/cache || true

# Limpar caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "✅ Build completo! Migrations serão executadas após o deploy."

