#!/bin/sh
# entrypoint.sh
# Primeiro setup do Dockerfile
php artisan migrate:fresh --seed
service nginx start
php-fpm
exec "$@"
