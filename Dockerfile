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

RUN echo "\
    server {\n\
        listen 80;\n\
        listen [::]:80;\n\
        root /var/www/html/public;\n\
        add_header X-Frame-Options \"SAMEORIGIN\";\n\
        add_header X-Content-Type-Options \"nosniff\";\n\
        index index.php;\n\
        charset utf-8;\n\
        location / {\n\
            try_files \$uri \$uri/ /index.php?\$query_string;\n\
        }\n\
        location = /favicon.ico { access_log off; log_not_found off; }\n\
        location = /robots.txt  { access_log off; log_not_found off; }\n\
        error_page 404 /index.php;\n\
        location ~ \.php$ {\n\
            fastcgi_pass unix:/run/php/php8.2-fpm.sock;\n\
            fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;\n\
            include fastcgi_params;\n\
        }\n\
        location ~ /\.(?!well-known).* {\n\
            deny all;\n\
        }\n\
    }\n" > /etc/nginx/sites-available/default

# Crie o diretório da aplicação e defina como o diretório de trabalho
WORKDIR /var/www/html

# Copie o código da aplicação para dentro do container
COPY . .

# Defina permissões para os diretórios de armazenamento e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN git config --global --add safe.directory /var/www/html

# Instale as dependências do Composer
RUN composer install

# Gere a chave do Laravel
RUN php artisan key:generate

# Instale as dependências do Node.js (yarn)
RUN yarn install

# Compile os arquivos de front-end com Vite e TailwindCSS
RUN yarn build


# Exponha a porta 80 para o Nginx
EXPOSE 80

# Copie os arquivos de configuração do Nginx
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default

# Exponha o volume para o banco de dados e outros arquivos de configuração
VOLUME ["/var/www/html/storage"]

# Comando para iniciar o Nginx e PHP-FPM
CMD service nginx start && php-fpm

