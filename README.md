# CRUD Produtos

Um sistema de gerenciamento de produtos, fornecedores e usuários desenvolvido em PHP com MySQL.

## Funcionalidades

- **Autenticação de Usuários**: Sistema de login e cadastro seguro.
- **Gerenciamento de Produtos**: Criar, ler, atualizar e deletar produtos.
- **Gerenciamento de Fornecedores**: Controle completo de fornecedores.
- **Inclusão de produtos na Cesta**: Carrinho de compras.
- **Dashboard**: Painel de controle.

## Estrutura do Projeto

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

## Tecnologias Utilizadas

- **PHP 7.4+** - Backend
- **MySQL** - Banco de dados
- **HTML5** - Estrutura
- **CSS3** - Estilos
- **Bootstrap 5** - Layout e componentes visuais
- **JavaScript** - Interatividade

## Finalidade Acadêmica

Trabalho prático desenvolvido para fins de aprendizado em desenvolvimento Web e integração com banco de dados em tempo real.


