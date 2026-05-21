<?php
require_once __DIR__ . '/../config/database.php';

class Cesta {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // criar cesta do usuário
    public function criarCesta($usuario_id) {
        $sql = "
            INSERT INTO cestas (usuario_id)
            VALUES (:usuario_id)
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuario_id
        ]);

        return $this->conn->lastInsertId();
    }

    // adicionar produtos a cesta
    public function adicionarProdutos($cesta_id, $produtos) {
        $sql = "
            INSERT INTO cesta_produtos
            (cesta_id, produto_id)
            VALUES
            (:cesta_id, :produto_id)
        ";

        $stmt = $this->conn->prepare($sql);
        foreach($produtos as $produto_id) {

            $stmt->execute([
                ':cesta_id' => $cesta_id,
                ':produto_id' => $produto_id
            ]);
        }
    }

    // listar produtos da cesta
    public function listarProdutosCesta($cesta_id) {
        $sql = "
            SELECT
                produtos.nome,
                produtos.preco,
                produtos.descricao
            FROM cesta_produtos

            INNER JOIN produtos
            ON cesta_produtos.produto_id = produtos.id

            WHERE cesta_produtos.cesta_id = :cesta_id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':cesta_id' => $cesta_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}