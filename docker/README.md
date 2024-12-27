# Comandos Essenciais do Docker e Docker Compose

Este guia contém os principais comandos que você precisa saber para trabalhar com Docker e Docker Compose no seu projeto.

---

## **Docker Commands**
| Comando                             | Descrição                                                                                       |
|-------------------------------------|-------------------------------------------------------------------------------------------------|
| `docker ps`                         | Lista todos os contêineres em execução.                                                        |
| `docker ps -a`                      | Lista todos os contêineres, incluindo os que estão parados.                                     |
| `docker start <nome ou id>`         | Inicia um contêiner parado.                                                                    |
| `docker stop <nome ou id>`          | Para um contêiner em execução.                                                                 |
| `docker rm <nome ou id>`            | Remove um contêiner parado.                                                                    |
| `docker images`                     | Lista todas as imagens disponíveis localmente.                                                 |
| `docker rmi <nome ou id>`           | Remove uma imagem.                                                                             |
| `docker exec -it <nome ou id> bash` | Abre um terminal interativo (bash) dentro do contêiner.                                        |
| `docker logs <nome ou id>`          | Exibe os logs do contêiner.                                                                    |
| `docker-compose logs`               | Mostra os logs de todos os serviços definidos no `docker-compose.yml`.                         |
| `docker volume ls`                  | Lista todos os volumes disponíveis.                                                           |
| `docker volume rm <nome>`           | Remove um volume.                                                                              |
| `docker network ls`                 | Lista todas as redes disponíveis no Docker.                                                   |
| `docker-compose config`             | Valida o arquivo `docker-compose.yml`.                                                        |

---

## **Docker Compose Commands**

| Comando                                | Descrição                                                                                       |
|----------------------------------------|-------------------------------------------------------------------------------------------------|
| `docker-compose up`                    | Inicia os serviços definidos no `docker-compose.yml`.                                          |
| `docker-compose up -d`                 | Inicia os serviços em modo "detached" (em segundo plano).                                     |
| `docker-compose down`                  | Para e remove todos os contêineres, redes e volumes associados aos serviços.                   |
| `docker-compose stop`                  | Apenas para os serviços em execução.                                                          |
| `docker-compose start`                 | Reinicia os serviços que foram parados.                                                       |
| `docker-compose restart`               | Reinicia todos os serviços.                                                                    |
| `docker-compose ps`                    | Lista todos os serviços definidos no `docker-compose.yml`.                                     |
| `docker-compose logs`                  | Exibe os logs de todos os serviços.                                                            |
| `docker-compose logs -f`               | Exibe os logs de todos os serviços em tempo real.                                              |
| `docker-compose exec <serviço> bash`   | Abre um terminal interativo no serviço especificado.                                           |
| `docker-compose config`                | Valida a configuração do `docker-compose.yml`.                                                |
| `docker-compose build`                 | Reconstrói as imagens dos serviços.                                                           |

---

## **Exemplos Práticos no Projeto**

1. **Iniciar os serviços (MariaDB e phpMyAdmin)**:
   ```bash
   docker-compose up -d
   ```

2. **Verificar os serviços em execução:**
   ```bash
   docker-compose ps
   ```

3. **Acessar o banco de dados MariaDB:**
   ```bash
   docker exec -it mariadb_local bash
   mysql -u root -p
   ```

4. **Parar os serviços:**
   ```bash
   docker-compose stop
   ```

5. **Remover os serviços e volumes associados:**
   ```bash
   docker-compose down -v
   ```

6. **Visualizar logs do phpMyAdmin:**
   ```bash
   docker-compose logs phpmyadmin
   ```

7. **Reconstruir as imagens após alterações no `docker-compose.yml`:**
   ```bash
   docker-compose build
   ```

---

Tenha este guia como referência rápida para gerenciar os contêineres do seu projeto! 🚀

