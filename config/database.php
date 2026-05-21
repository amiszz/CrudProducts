<?php

class Database {

    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "crud_products";

    public function conectar() {
        try {

            // conectar banco
            $pdo = new PDO(
                "mysql:host={$this->host}",
                $this->usuario,
                $this->senha
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // criar banco e tabelas
            $pdo->exec("
                CREATE DATABASE IF NOT EXISTS {$this->banco}
                CHARACTER SET utf8mb4
                COLLATE utf8mb4_unicode_ci
            ");

            // Seleciona banco
            $pdo->exec("USE {$this->banco}");

            // tabela usuarios
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS usuarios (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(100) NOT NULL,
                    email VARCHAR(150) UNIQUE NOT NULL,
                    senha VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");

            // tabela fornecedores
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS fornecedores (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(100) NOT NULL,
                    email VARCHAR(150),
                    telefone VARCHAR(20),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");

            // tabela produtos
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS produtos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(100) NOT NULL,
                    descricao TEXT,
                    preco DECIMAL(10,2) NOT NULL,
                    fornecedor_id INT,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                    FOREIGN KEY (fornecedor_id)
                    REFERENCES fornecedores(id)
                    ON DELETE SET NULL
                )
            ");

            // tabela cestas
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS cestas (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    usuario_id INT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                    FOREIGN KEY (usuario_id)
                    REFERENCES usuarios(id)
                    ON DELETE CASCADE
                )
            ");

            // Tabela intermediária
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS cesta_produtos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    cesta_id INT NOT NULL,
                    produto_id INT NOT NULL,

                    FOREIGN KEY (cesta_id)
                    REFERENCES cestas(id)
                    ON DELETE CASCADE,

                    FOREIGN KEY (produto_id)
                    REFERENCES produtos(id)
                    ON DELETE CASCADE
                )
            ");

            return $pdo;
        } catch(PDOException $e) {
            die("ALERTA! Erro no banco: " . $e->getMessage());
        }
    }
}