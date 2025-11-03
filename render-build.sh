#!/bin/bash

# Script de build simplificado para o Render

# Instalar dependências
composer install --optimize-autoloader --no-dev

# Dump autoload (carregar helpers)
composer dump-autoload

# Rodar migrations
php artisan migrate --force

# Limpar caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Cachear config
php artisan config:cache

