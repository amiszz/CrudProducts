<?php

require_once "../classes/Produto.php";
$produto = new Produto();

if ($_POST['acao'] == 'cadastrar') {
    $produto->cadastrar(
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $_POST['fornecedor_id']
    );

    echo json_encode([
        'status' => 'success'
    ]);
}