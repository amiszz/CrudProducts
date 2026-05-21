<?php

session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit;

}

$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <a href="../logout.php" class="btn btn-danger" style="float: right;">
                Sair
            </a>

            <h1>
                Bem-vindo,
                <?= $usuario['nome'] ?>
            </h1>

            <hr>

            <a href="fornecedores.php" class="btn btn-primary">
                Gerenciar Fornecedores
            </a>

            <a href="produtos.php" class="btn btn-dark">
                Gerenciar Produtos
            </a>

            <a href="cesta.php" class="btn btn-success">
                Abrir Cesta
            </a>

        </div>
    </div>
</div>

</body>
</html>