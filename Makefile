# Makefile para comandos Artisan e Yarn

.PHONY: all serve migrate clear build seed

all:
	yarn build
	php artisan optimize:clear
	php artisan migrate:fresh --seed
	php artisan serve

# Comando para migrar e popular o banco de dados
migrate:
	php artisan migrate:fresh --seed

# Comando para iniciar o servidor de desenvolvimento
dev:
	php artisan serve

# Comando para limpar o cache e otimizações
clear:
	php artisan optimize:clear

# Comando para compilar os assets
build:
	yarn build

# Comando para executar os seeds do banco de dados
seed:
	php artisan db:seed
