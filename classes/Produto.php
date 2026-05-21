<?php

require_once __DIR__ . '/../config/database.php';

class Produto {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // listar produtos
    public function listar() {
        $sql = "
            SELECT
                produtos.*,
                fornecedores.nome AS fornecedor_nome
            FROM produtos

            LEFT JOIN fornecedores
            ON produtos.fornecedor_id = fornecedores.id

            ORDER BY produtos.id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cadastrar produto
    public function cadastrar(
        $nome,
        $descricao,
        $preco,
        $fornecedor_id
    ) {
        $sql = "
            INSERT INTO produtos
            (
                nome,
                descricao,
                preco,
                fornecedor_id
            )
            VALUES
            (
                :nome,
                :descricao,
                :preco,
                :fornecedor_id
            )
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':fornecedor_id' => $fornecedor_id
        ]);
    }

    // edição do produto
    public function editar(
        $id,
        $nome,
        $descricao,
        $preco,
        $fornecedor_id
    ) {
        $sql = "
            UPDATE produtos
            SET
                nome = :nome,
                descricao = :descricao,
                preco = :preco,
                fornecedor_id = :fornecedor_id
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':fornecedor_id' => $fornecedor_id
        ]);
    }

    // exclusão do produto
    public function excluir($id) {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}