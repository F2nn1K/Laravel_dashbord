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

# Servidor PHP built-in - MAIS RÁPIDO
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-10000} -t public"]

