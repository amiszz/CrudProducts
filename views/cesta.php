<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit;
}

require_once "../classes/Produto.php";
require_once "../classes/Cesta.php";

$produto = new Produto();
$cesta = new Cesta();

$produtos = $produto->listar();
$resumo = [];
$total = 0;
$totalItens = 0;


// criação da cesta 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['produtos'])) {

        $usuario_id = $_SESSION['usuario']['id'];

        // cria cesta
        $cesta_id = $cesta->criarCesta($usuario_id);

        // adiciona produtos
        $cesta->adicionarProdutos(
            $cesta_id,
            $_POST['produtos']
        );

        // busca resumo
        $resumo = $cesta->listarProdutosCesta($cesta_id);

        // calcula total
        foreach($resumo as $item) {
            $total += $item['preco'];

            $totalItens++;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Cesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Cesta de Compras</h2>
        <a href="dashboard.php" class="btn btn-secondary">
            Dashboard
        </a>
    </div>

    <!-- produtos -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($produtos as $p): ?>
                            <tr>
                                <td width="50">
                                    <input
                                        type="checkbox"
                                        name="produtos[]"
                                        value="<?= $p['id'] ?>"
                                    >

                                </td>
                                <td><?= $p['nome'] ?></td>
                                <td><?= $p['descricao'] ?></td>

                                <td>
                                    R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button class="btn btn-success">
                    Adicionar ao carrinho
                </button>
            </form>
        </div>
    </div>

    <!-- RESUMO -->
    <?php if(!empty($resumo)): ?>
        <div class="card shadow">
            <div class="card-body">
                <h4 class="mb-4">
                    Resumo da Compra
                </h4>
                <ul class="list-group mb-4">
                    <?php foreach($resumo as $item): ?>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                <?= $item['nome'] ?>
                            </span>

                            <strong>
                                R$ <?= number_format($item['preco'], 2, ',', '.') ?>
                            </strong>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="alert alert-primary">
                    <h5>
                        Total de itens:
                        <?= $totalItens ?>
                    </h5>

                    <h5>
                        Valor total:
                        R$ <?= number_format($total, 2, ',', '.') ?>
                    </h5>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>