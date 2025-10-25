# Biblioteca Virtual

Um sistema simples de gerenciamento de livros, desenvolvido em **PHP** com **MySQL**, que permite **adicionar, editar, listar e excluir** livros.

---

## Funcionalidades

* **Listagem de livros** (com título e botões de ação)
* **Adição de novos livros** com título, autor, ano e gênero
* **Edição de informações** de livros já cadastrados
* **Exclusão** de livros individualmente
* **Validação para evitar duplicatas** (mesmo título não pode ser cadastrado duas vezes)
* Interface simples e responsiva com **HTML + CSS puro**

---

## Estrutura de Pastas

```
├── database/
│   └── livros.sql          # Script do banco de dados
│
├── public/
│   ├── adicionar.php       # Página de adição de livros
│   ├── editar.php          # Página de edição de livros
│   ├── excluir.php         # Página de exclusão de livros
│   ├── index.php           # Página inicial (listagem)
│   └── style.css           # Estilos da interface
│
├── src/
│   └── db_connect.php      # Conexão com o banco de dados
│
├── .gitignore
└── README.md
```

---

## Requisitos

*  **PHP 8.0+**
*  **MySQL 5.7+**
*  **Servidor local** (XAMPP, WAMP, LAMP ou Apache/Nginx configurado)

---

## Configuração do Banco de Dados

1. Acesse o MySQL e crie o banco de dados com o script disponível:

   ```sql
   source database/livros.sql;
   ```
2. Verifique se o arquivo `src/db_connect.php` contém as credenciais corretas:

   ```php
   $connect = mysqli_connect("localhost", "root", "SENHA", "exercicios");
   ```

---

## Como Rodar o Projeto

1. Clone o repositório:

   ```bash
   git clone git@github.com:GabrielVioli/bibliotecaVirtual-simpleCrud.git
   ```
2. Entre na pasta do projeto:

   ```bash
   cd bibliotecaVirtual-simpleCrud
   ```
3. Mova a pasta `public` para o diretório acessível do servidor (ex: `htdocs` no XAMPP ou `/var/www/html` no Linux).
4. Inicie o servidor Apache e MySQL.
5. Acesse o sistema no navegador:

   ```
   http://localhost/public/index.php
   ```

---

## Conceitos Utilizados

* `mysqli` para interação com o banco de dados
* `require_once` e `__DIR__` para caminhos absolutos
* `session_start()` para controle de mensagens e duplicação
* `header("Location: ...")` para redirecionamento
* `mysqli_real_escape_string()` para segurança contra SQL Injection

---

---

## Autor

**Gabriel Vinicius**
📍 Guarapuava - PR
💼 Desenvolvido com foco em aprendizado e boas práticas em PHP e MySQL.
