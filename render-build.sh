#!/bin/bash

# Script de build para o Render
# Este script roda automaticamente no deploy

echo "🚀 Iniciando build do Marudi Mountain..."

# Instalar dependências
echo "📦 Instalando dependências..."
composer install --optimize-autoloader --no-dev

# Dump autoload (IMPORTANTE para carregar helpers)
echo "🔄 Carregando helpers..."
composer dump-autoload

# Rodar migrations
echo "🗄️ Executando migrations..."
php artisan migrate --force

# Popular dados (se tabelas existirem)
echo "🌱 Populando dados iniciais..."
php artisan db:seed --force || true

# Limpar caches
echo "🧹 Limpando caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true

# Cachear configurações para produção
echo "⚡ Otimizando para produção..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "✅ Build concluído com sucesso!"

