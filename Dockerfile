FROM php:8.2-fpm-alpine

# Instalar dependências
RUN apk update && apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    mariadb-client \
    yarn \
    shadow

# Instalar extensões PHP
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    gd \
    zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar usuário e permissões ANTES de copiar os arquivos
RUN mkdir -p /var/www/html/storage/framework/{views,cache,sessions} \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && usermod -u 1000 www-data \
    && groupmod -g 1000 www-data

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos
COPY . .

# Instalar dependências e build
RUN composer install --optimize-autoloader --no-dev \
    && yarn install \
    && yarn build \
    && chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]
