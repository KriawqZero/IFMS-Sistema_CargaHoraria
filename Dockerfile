# Use a imagem oficial do PHP com Nginx
FROM php:8.2-fpm

# Instale as dependências necessárias para PHP, Nginx e Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    git \
    unzip \
    curl \
    nginx \
    nodejs \
    npm \
    nano \
    vim \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql bcmath exif

# Instale o Yarn globalmente
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | tee /etc/apt/trusted.gpg.d/yarn.asc
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install yarn

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crie o diretório da aplicação e defina como o diretório de trabalho
WORKDIR /var/www/html

# Copie o código da aplicação para dentro do container
COPY . .

# Instale as dependências do Composer
RUN composer install --optimize-autoloader --no-dev

# Gere a chave do Laravel
RUN php artisan key:generate

# Instale as dependências do Node.js (yarn)
RUN yarn install

# Compile os arquivos de front-end com Vite e TailwindCSS
RUN yarn build

# Defina permissões para os diretórios de armazenamento e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 80 para o Nginx
EXPOSE 80

# Copie os arquivos de configuração do Nginx
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default

# Exponha o volume para o banco de dados e outros arquivos de configuração
VOLUME ["/var/www/html/storage"]

# Comando para iniciar o Nginx e PHP-FPM
CMD service nginx start && php-fpm

