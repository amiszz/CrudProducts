<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit;
}

require_once "../config/database.php";

$database = new Database();
$conn = $database->conectar();

$usuario = $_SESSION['usuario'];

// total para dashboard productos
$stmt = $conn->query("SELECT COUNT(*) AS total FROM produtos");
$totalProdutos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// total para dashboard fornecedores
$stmt = $conn->query("SELECT COUNT(*) AS total FROM fornecedores");
$totalFornecedores = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// total para dashboard cestas
$stmt = $conn->query("SELECT COUNT(*) AS total FROM cestas");
$totalCestas = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
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

            <!-- btn sair -->
            <a href="../logout.php" class="btn btn-danger" style="float: right;">
                Sair
            </a>

            <!-- title -->
            <h1>
                Bem-vindo,
                <?= $usuario['nome'] ?>
            </h1>

            <p class="text-muted">
                Painel administrativo do sistema
            </p>

            <hr>

            <!-- btns -->
            <a href="fornecedores.php" class="btn btn-primary">
                Gerenciar Fornecedores
            </a>

            <a href="produtos.php" class="btn btn-dark">
                Gerenciar Produtos
            </a>

            <a href="cesta.php" class="btn btn-success">
                Abrir Cesta
            </a>

            <hr>

            <!-- div's -->
            <div class="row">

                <!-- productos -->
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5>
                                Produtos
                            </h5>

                            <h1>
                                <?= $totalProdutos ?>
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- fornec. -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5>
                                Fornecedores
                            </h5>

                            <h1>
                                <?= $totalFornecedores ?>
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- cesta -->
                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <h5>
                                Cestas
                            </h5>

                            <h1>
                                <?= $totalCestas ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>