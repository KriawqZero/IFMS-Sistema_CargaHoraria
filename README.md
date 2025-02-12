
# Sistema de Carga Horária IFMS

✨ Sistema para gestão de carga horária do IFMS (Instituto Federal do Mato Grosso do Sul).

## 🚀 Começando

Siga estas etapas para configurar o ambiente de desenvolvimento:

### Pré-requisitos
- PHP 8.0+
- Composer 2.0+
- Node.js 16.x+
- Yarn 1.22+
- MySQL 5.7+ ou banco de dados equivalente
- Git

### Configuração do Ambiente

1. **Clonar o repositório**
   ```bash
   git clone https://github.com/KriawqZero/IFMS-Sistema_CargaHoraria.git
   cd IFMS-Sistema_CargaHoraria
   ```

2. **Instalar dependências**
   ```bash
   # Dependências JavaScript
   yarn install

   # Dependências PHP
   composer install
   ```

3. **Compilar assets**
   ```bash
   yarn build
   ```

4. **Configurar banco de dados**
   ```bash
   # Executar migrações e seeders
   php artisan migrate:fresh --seed
   ```

5. **Iniciar servidor de desenvolvimento**
   ```bash
   php artisan serve
   ```

### 🛠️ Opções Avançadas

**Para ambientes com suporte a `make`:**
```bash
make
```

**Configuração manual (sem make):**
```bash
composer update
composer install
php artisan migrate:fresh --seed
```

## 🔧 Solução de Problemas

Se encontrar erros:
1. Verifique as credenciais do banco de dados no arquivo `.env`
2. Confira se todas as dependências estão instaladas
3. Limpe o cache se necessário:
   ```bash
   php artisan cache:clear
   php artisan view:clear
   ```
   
**Nota para Windows:**  
Se o comando `make` não estiver disponível, instale o [MinGW](http://mingw.org/) ou use os comandos manuais listados acima.

## 🌐 Acessar a Aplicação
Após executar `php artisan serve`, acesse o sistema em:  
http://localhost:8000

---

📌 **Importante:** Sempre verifique se o arquivo `.env` está configurado corretamente com as credenciais do banco de dados antes de executar as migrações.
