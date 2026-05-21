<?php

require_once __DIR__ . '/../config/database.php';

class Fornecedor {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // listagem dos fornecedores
    public function listar() {
        $sql = "SELECT * FROM fornecedores ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cadastrar fornecedor
    public function cadastrar($nome, $email, $telefone) {
        $sql = "INSERT INTO fornecedores
                (nome, email, telefone)
                VALUES
                (:nome, :email, :telefone)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone
        ]);
    }

    // localizar fornecedor por ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM fornecedores WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // edição do fornecedor
    public function editar($id, $nome, $email, $telefone) {
        $sql = "UPDATE fornecedores
                SET nome = :nome,
                    email = :email,
                    telefone = :telefone
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone
        ]);
    }

    // exclusão do fornecedor
    public function excluir($id) {
        $sql = "DELETE FROM fornecedores WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}