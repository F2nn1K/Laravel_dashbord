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
    netcat-openbsd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

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

# Expor porta
EXPOSE 10000

# Criar script de inicialização inline
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'php -S 0.0.0.0:${PORT:-10000} -t public &' >> /start.sh && \
    echo 'sleep 3' >> /start.sh && \
    echo 'for i in 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20; do' >> /start.sh && \
    echo '  php artisan migrate --force 2>&1 && break' >> /start.sh && \
    echo '  sleep 3' >> /start.sh && \
    echo 'done' >> /start.sh && \
    echo 'php artisan db:seed --class=PermissionsSeeder --force 2>&1 || true' >> /start.sh && \
    echo 'wait' >> /start.sh && \
    chmod +x /start.sh

# Executar script
CMD ["/start.sh"]

