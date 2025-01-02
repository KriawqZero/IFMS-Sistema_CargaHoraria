# IFMS - Sistema de Gerenciamento de Carga Horária

## Tema
Desenvolvimento de um software WEB para gerenciamento de carga horária de atividades diversificadas realizadas pelos alunos dos cursos técnicos do Campus Corumbá.

---

## Objetivos

### Objetivo Geral
Desenvolver um Sistema WEB de Gerenciamento de carga horária de atividades diversificadas para os cursos técnicos do Campus Corumbá.

### Objetivos Específicos
1. Realizar uma pesquisa bibliográfica sobre os conceitos relacionados com a utilização de atividades diversificadas na vivência acadêmica dos alunos.
2. Identificar os requisitos necessários para a elaboração da documentação do software.
3. Desenvolver o sistema web e apresentar suas funcionalidades aos usuários.

---

## Justificativa
O envio obrigatório das cargas horárias atualmente apresenta dificuldades logísticas e organizacionais que não favorecem o acompanhamento do aluno sobre seu quantitativo de horas entregue, além de sobrecarregar o professor responsável por validar as atividades diversificadas. Esse sistema visa solucionar essas dificuldades, facilitando a comunicação, validação e acompanhamento do processo.

---

## Passos para o Desenvolvimento

### 1. Levantamento de Requisitos

#### Requisitos Funcionais
- Login via API externa para alunos.
- Cadastro de professores e administradores pelo administrador.
- Upload de certificados com campos específicos (tipo, observação, arquivo).
- Validação ou rejeição de certificados por professores.
- Gerenciamento de turmas e responsáveis.
- Dashboard para alunos, professores e administradores.
- Importação em massa de alunos via CSV.

#### Requisitos Não Funcionais
- **Segurança:** Proteção de dados dos alunos e certificados.
- **Escalabilidade:** Suporte ao crescimento do sistema.
- **Usabilidade:** Interfaces intuitivas baseadas nos protótipos do Figma.

### 2. Prototipagem
Finalize os protótipos no Figma para:
- Fluxos de interação do aluno, professor e administrador.
- Tela de login.
- Dashboard do aluno.
- Páginas de envio e detalhamento de certificados.
- Painéis de controle para professores e administradores.

### 3. Modelagem de Casos de Uso
Crie diagramas de caso de uso para cada funcionalidade principal. Exemplos:
- **Enviar Certificado**
  - **Ator:** Aluno.
  - **Fluxo principal:** Preencher formulário → Enviar → Certificado entra no sistema como "pendente".
  - **Extensões:** Mensagens de erro (arquivo inválido, tamanho excedido).

Principais casos de uso:
1. Login (Alunos via API e Administradores/Professores via sistema interno).
2. Gerenciamento de turmas.
3. Validação de certificados.
4. Visualização de progresso dos alunos.

### 4. Diagrama de Entidade-Relacionamento (ER)
Estruture as tabelas do banco de dados:
- **Aluno:** id, nome, turma, cpf.
- **Certificado:** id, aluno_id, tipo, src, observação, carga_horária, validado, timestamps.
- **Professor:** id, nome, turma_responsável.
- **Administrador:** id, nome, permissões.
- **Turma:** número (chave primária), professor_id.

### 5. Diagramas de Sequência
Documente o fluxo de operações principais:

#### Exemplo: Login do Aluno
1. Aluno insere CPF e senha.
2. API externa valida os dados.
3. Sistema verifica a existência do aluno no banco local.
4. Autentica e redireciona para a página inicial.

Fluxos adicionais:
- Validação de certificados.
- Upload de CSV.
- Cadastro de professores.

### 6. Arquitetura do Software
Defina os componentes principais:

#### **Frontend**
- Framework: Tailwind, Bootstrap.
- Interface baseada nos protótipos do Figma.

#### **Backend**
- Framework: Laravel 11 (controladores, modelos e serviços).
- Integração com API externa para autenticação de alunos.

#### **Banco de Dados**
- MariaDB com tabelas estruturadas para alunos, certificados, professores, administradores e turmas.

#### **Integração**
- API de teste em C# para simular a API oficial.

### 7. Roadmap de Desenvolvimento
Organize o trabalho em sprints:
- **Sprint 1:** Login e autenticação via API externa.
- **Sprint 2:** Sistema de upload e validação de certificados.
- **Sprint 3:** Painéis para administradores e professores.
- **Sprint 4:** Funcionalidades de importação CSV e relatórios.

### 8. Documentação
Prepare a documentação para:
- **Manual do Usuário:** Passo a passo para utilização do sistema.
- **Manual Técnico:** Arquitetura, requisitos, diagramas e detalhes de implementação.

---

## Tecnologias Utilizadas
- **Frontend:** Tailwind, Bootstrap.
- **Backend:** Laravel 11.
- **Banco de Dados:** MariaDB.
- **Prototipagem:** Figma.
- **Ambiente de Desenvolvimento:** Docker, Docker-compose.
- **API de Teste:** C#.

---

## Pré-requisitos para Configuração
- PHP 8.x.
- Composer.
- Node.js.
- MariaDB.

---

## Fluxo do Sistema

### Aluno
1. Faz login com CPF e senha.
2. Visualiza progresso atual de carga horária.
3. Envia certificados (tipo, observação, arquivo).
4. Visualiza todos os certificados enviados em uma tabela detalhada.

### Professor
1. Valida ou rejeita certificados enviados pelos alunos.
2. Acompanha certificados de sua turma.

### Administrador
1. Realiza todas as ações do professor.
2. Gerencia alunos, professores e turmas.
3. Importa alunos via CSV (CPF e turma).
4. Define professores responsáveis por turmas.

---

## Estrutura do Banco de Dados
- **Aluno:** id, nome, turma, cpf.
- **Certificado:** id, aluno_id, tipo, src, observação, carga_horária, validado, timestamps.
- **Professor:** id, nome, turma_responsável.
- **Administrador:** id, nome, permissões.
- **Turma:** número (chave primária), professor_id.

