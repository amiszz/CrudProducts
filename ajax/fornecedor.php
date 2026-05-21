<?php

require_once "../classes/Fornecedor.php";
$fornecedor = new Fornecedor();

// validação do usuário
if ($_POST['acao'] == 'cadastrar') {
    $fornecedor->cadastrar(
        $_POST['nome'],
        $_POST['email'],
        $_POST['telefone']
    );

    echo json_encode([
        'status' => 'success'
    ]);
}