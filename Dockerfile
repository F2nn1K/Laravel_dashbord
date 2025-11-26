FROM php:8.2-cli

# Instalar extensões e dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip gd

# Instalar Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instalar dependências do Node e compilar assets
RUN npm install && npm run build

# Criar diretórios necessários e ajustar permissões
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && chmod -R 775 storage bootstrap/cache

# Expor porta (Render usa variável PORT)
EXPOSE 10000

# Comando de inicialização com retry para aguardar MySQL
CMD set -e; \
    echo "Aguardando MySQL ficar disponível..."; \
    for i in 1 2 3 4 5 6 7 8 9 10; do \
        if php artisan migrate --force 2>/dev/null; then \
            echo "✅ Migrations executadas com sucesso!"; \
            break; \
        else \
            echo "⏳ Tentativa $i/10 - MySQL ainda não disponível, aguardando 5s..."; \
            sleep 5; \
        fi; \
    done; \
    php artisan db:seed --class=PermissionsSeeder --force || true; \
    php artisan config:cache; \
    echo "🚀 Iniciando servidor na porta ${PORT:-10000}..."; \
    php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

