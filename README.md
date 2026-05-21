# CRUD Produtos

Um sistema completo de gerenciamento de produtos, fornecedores e usuários desenvolvido em PHP com MySQL.

## 📋 Funcionalidades

- **Autenticação de Usuários**: Sistema de login e cadastro seguro
- **Gerenciamento de Produtos**: Criar, ler, atualizar e deletar produtos
- **Gerenciamento de Fornecedores**: Controle completo de fornecedores
- **Gerenciamento de Cesta**: Carrinho de compras funcional
- **Dashboard Interativo**: Painel de controle com tabelas e busca

## 🏗️ Estrutura do Projeto

```
crud_produtos/
├── classes/
│   ├── Database.php          # Conexão com banco de dados
│   ├── Usuario.php           # Gerenciamento de usuários
│   ├── Produto.php           # Gerenciamento de produtos
│   ├── Fornecedor.php        # Gerenciamento de fornecedores
│   └── Cesta.php             # Gerenciamento de carrinho
├── config/
│   └── database.php          # Configurações do banco de dados
├── database/
│   └── create_tables.sql     # Scripts para criação de tabelas
├── views/
│   ├── login.php             # Página de login
│   ├── cadastro.php          # Página de cadastro
│   └── dashboard.php         # Painel de controle
├── index.php                 # Página inicial
├── logout.php                # Logout do usuário
└── README.md                 # Este arquivo
```

## 🛠️ Tecnologias Utilizadas

- **PHP 7.4+** - Backend
- **MySQL** - Banco de dados
- **HTML5** - Estrutura
- **CSS3** - Estilos
- **JavaScript** - Interatividade

## 📦 Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor Web (Apache, Nginx)

## 🚀 Instalação

### 1. Clonar o repositório

```bash
git clone https://github.com/seu-usuario/crud_produtos.git
cd crud_produtos
```

### 2. Configurar o banco de dados

- Crie um banco de dados chamado `crud_db` no MySQL
- Importe o arquivo `database/create_tables.sql`:

```bash
mysql -u root -p crud_db < database/create_tables.sql
```

### 3. Configurar conexão com o banco

Edite o arquivo `config/database.php` com suas credenciais:

```php
$host = 'localhost';
$db_name = 'crud_db';
$user = 'root';
$password = '';
```

### 4. Iniciar o servidor

```bash
php -S localhost:8000
```

Acesse `http://localhost:8000` no seu navegador.

## 📝 Como Usar

### Criar novo usuário

1. Acesse a página de cadastro
2. Preencha nome, email e senha
3. Clique em "Cadastrar"

### Fazer Login

1. Insira seu email e senha
2. Clique em "Entrar"

### Gerenciar Produtos

1. No dashboard, clique em "+ Novo Produto"
2. Preencha os dados do produto
3. Use os botões Editar/Deletar na tabela

### Usar a Cesta

1. Adicione produtos à cesta
2. Visualize o total no carrinho
3. Proceda para o checkout

## 🔐 Segurança

- Senhas criptografadas com BCRYPT
- Proteção contra SQL Injection com prepared statements
- Validação e sanitização de inputs
- Gerenciamento seguro de sessões

## 📄 Estrutura das Classes

### Database
Gerencia a conexão com o banco de dados MySQL.

```php
$db = new Database();
$conn = $db->connect();
```

### Usuario
CRUD completo para usuários com métodos:
- `create()` - Criar novo usuário
- `read()` - Ler dados do usuário
- `update()` - Atualizar dados
- `delete()` - Deletar usuário

### Produto
Gerenciamento de produtos com:
- `create()` - Adicionar novo produto
- `readAll()` - Listar todos os produtos
- `update()` - Editar produto
- `delete()` - Remover produto

### Fornecedor
Controle de fornecedores com operações CRUD completas.

### Cesta
Gerenciamento de carrinho:
- `adicionarItem()` - Adicionar ao carrinho
- `removerItem()` - Remover item
- `atualizarQuantidade()` - Ajustar quantidade
- `calcularTotal()` - Somar preços
- `limparCesta()` - Esvaziar carrinho

## 🐛 Resolução de Problemas

### Erro: "Connection refused"
- Verifique se o MySQL está rodando
- Confirme as credenciais em `config/database.php`

### Erro: "Table doesn't exist"
- Importe novamente o arquivo `database/create_tables.sql`

### Erro 500 no Login
- Verifique os logs do PHP
- Confirme permissões de arquivo

## 📧 Contato

Para dúvidas ou sugestões, abra uma issue no repositório.

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

---

**Desenvolvido com ❤️ usando PHP e MySQL**
