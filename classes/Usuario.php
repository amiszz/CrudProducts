<?php

require_once __DIR__ . '/../config/database.php';

class Usuario {

    private $conn;

    public function __construct() {

        $database = new Database();
        $this->conn = $database->conectar();

    }

    // função para cadastrar usuário
    public function cadastrar($nome, $email, $senha) {

        // HASH SHA-256
        $senhaHash = hash('sha256', $senha);

        $sql = "INSERT INTO usuarios (nome, email, senha)
                VALUES (:nome, :email, :senha)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);
    }

    // função para login
    public function login($email, $senha) {

        $senhaHash = hash('sha256', $senha);

        $sql = "SELECT * FROM usuarios
                WHERE email = :email
                AND senha = :senha";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':email' => $email,
            ':senha' => $senhaHash
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}