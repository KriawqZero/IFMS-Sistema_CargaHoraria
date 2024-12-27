# Comandos Essenciais do Git

Este guia contém os principais comandos que você precisa saber para trabalhar com Git no seu projeto.

---

## **Comandos Básicos**

| Comando                            | Descrição                                                                                     |
|------------------------------------|---------------------------------------------------------------------------------------------|
| `git init`                         | Inicializa um repositório Git em um diretório.                                              |
| `git clone <url>`                  | Faz o download de um repositório remoto para o seu computador.                             |
| `git status`                       | Mostra o status atual do repositório (arquivos alterados, não rastreados, etc.).           |
| `git add <arquivo>`                | Adiciona um arquivo específico à área de staging.                                           |
| `git add .`                        | Adiciona todos os arquivos modificados à área de staging.                                   |
| `git commit -m "mensagem"`        | Realiza um commit com uma mensagem descritiva.                                              |
| `git push`                         | Envia os commits locais para o repositório remoto.                                          |
| `git pull`                         | Atualiza o repositório local com as mudanças do repositório remoto.                         |
| `git log`                          | Exibe o histórico de commits do repositório.                                               |
| `git diff`                         | Mostra as alterações feitas nos arquivos não staged.                                        |
| `git reset <arquivo>`              | Remove um arquivo da área de staging.                                                      |
| `git reset --hard`                 | Desfaz todas as alterações não confirmadas no repositório (cuidado ao usar).               |

---

## **Trabalhando com Branches**

| Comando                            | Descrição                                                                                     |
|------------------------------------|---------------------------------------------------------------------------------------------|
| `git branch`                       | Lista todas as branches do repositório.                                                     |
| `git branch <nome>`                | Cria uma nova branch.                                                                        |
| `git checkout <nome>`              | Troca para a branch especificada.                                                           |
| `git checkout -b <nome>`           | Cria e troca para uma nova branch.                                                          |
| `git merge <branch>`               | Faz o merge de outra branch na branch atual.                                                |
| `git branch -d <nome>`             | Deleta uma branch local (desde que já tenha sido mesclada).                                 |

---

## **Repositórios Remotos**

| Comando                            | Descrição                                                                                     |
|------------------------------------|---------------------------------------------------------------------------------------------|
| `git remote -v`                    | Lista os repositórios remotos configurados.                                                 |
| `git remote add <nome> <url>`      | Adiciona um novo repositório remoto com o nome especificado.                                 |
| `git fetch`                        | Baixa as atualizações do repositório remoto sem mesclá-las.                                 |
| `git pull origin <branch>`         | Atualiza a branch atual com as mudanças do repositório remoto.                              |
| `git push origin <branch>`         | Envia as mudanças da branch atual para o repositório remoto.                                |
| `git push -u origin <branch>`      | Define a branch remota como padrão para os próximos push/pull.                              |

---

## **Exemplos Práticos no Projeto**

1. **Iniciar um novo repositório:**
   ```bash
   git init
   git add .
   git commit -m "Primeiro commit"
   git remote add origin <url-do-repositorio>
   git push -u origin main
   ```

2. **Criar e trocar para uma nova branch:**
   ```bash
   git checkout -b nova-branch
   ```

3. **Fazer merge de uma branch:**
   ```bash
   git checkout main
   git merge nova-branch
   ```

4. **Resolver conflitos de merge:**
   - Edite os arquivos em conflito.
   - Use `git add <arquivo>` para marcar os conflitos como resolvidos.
   - Finalize com um commit:
     ```bash
     git commit -m "Conflitos resolvidos"
     ```

5. **Resetar alterações locais:**
   ```bash
   git reset --hard
   ```

---

Este guia deve ajudá-lo a lembrar e usar os comandos essenciais do Git no seu projeto! 🚀

