<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit;
}

require_once "../classes/Produto.php";
require_once "../classes/Fornecedor.php";

$produto = new Produto();
$fornecedor = new Fornecedor();

/* cadastro
if (isset($_POST['cadastrar'])) {
    $produto->cadastrar(
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $_POST['fornecedor_id']
    );

    header("Location: produtos.php");
    exit;
} */

// edição 
if (isset($_POST['editar'])) {
    $produto->editar(
        $_POST['id'],
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $_POST['fornecedor_id']
    );

    header("Location: produtos.php");
    exit;
}


// exclusão
if (isset($_GET['excluir'])) {
    $produto->excluir($_GET['excluir']);

    header("Location: produtos.php");
    exit;
}

$produtos = $produto->listar();
$fornecedores = $fornecedor->listar();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Produtos</h2>
        <a href="dashboard.php" class="btn btn-secondary">
            Dashboard
        </a>

    </div>

    <!-- lista de produtos -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="formProduto">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input
                            type="text"
                            name="nome"
                            class="form-control"
                            placeholder="Nome do produto"
                            required
                        >
                    </div>

                    <div class="col-md-3">
                        <input
                            type="text"
                            name="descricao"
                            class="form-control"
                            placeholder="Descrição"
                        >
                    </div>

                    <div class="col-md-2">
                        <input
                            type="number"
                            step="0.01"
                            name="preco"
                            class="form-control"
                            placeholder="Preço"
                            required
                        >
                    </div>

                    <div class="col-md-3">
                        <select
                            name="fornecedor_id"
                            class="form-select"
                            required
                        >
                            <option value="">
                                Selecione fornecedor
                            </option>

                            <?php foreach($fornecedores as $f): ?>
                                <option value="<?= $f['id'] ?>">
                                    <?= $f['nome'] ?>
                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button
                            type="submit"
                            name="cadastrar"
                            class="btn btn-primary w-100"
                        >
                            Incluir
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- lista de produtos -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Fornecedor</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($produtos as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= $p['nome'] ?></td>
                            <td><?= $p['descricao'] ?></td>
                            <td>
                                R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                            </td>

                            <td><?= $p['fornecedor_nome'] ?></td>

                            <td>
                                <button
                                    class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal<?= $p['id'] ?>"
                                >
                                    Editar
                                </button>
                                <a
                                    href="?excluir=<?= $p['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Excluir produto?')"
                                >
                                    Excluir
                                </a>
                            </td>
                        </tr>

                        <!-- modal -->
                        <div
                            class="modal fade"
                            id="modal<?= $p['id'] ?>"
                            tabindex="-1"
                        >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Editar Produto
                                            </h5>
                                        </div>

                                        <div class="modal-body">
                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= $p['id'] ?>"
                                            >
                                            <div class="mb-3">
                                                <label>Nome</label>
                                                <input
                                                    type="text"
                                                    name="nome"
                                                    class="form-control"
                                                    value="<?= $p['nome'] ?>"
                                                >
                                            </div>

                                            <div class="mb-3">
                                                <label>Descrição</label>
                                                <input
                                                    type="text"
                                                    name="descricao"
                                                    class="form-control"
                                                    value="<?= $p['descricao'] ?>"
                                                >
                                            </div>

                                            <div class="mb-3">
                                                <label>Preço</label>
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    name="preco"
                                                    class="form-control"
                                                    value="<?= $p['preco'] ?>"
                                                >
                                            </div>

                                            <div class="mb-3">
                                                <label>Fornecedor</label>
                                                <select
                                                    name="fornecedor_id"
                                                    class="form-select"
                                                >
                                                    <?php foreach($fornecedores as $f): ?>
                                                        <option
                                                            value="<?= $f['id'] ?>"
                                                            <?= $f['id'] == $p['fornecedor_id'] ? 'selected' : '' ?>
                                                        >
                                                            <?= $f['nome'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button
                                                type="submit"
                                                name="editar"
                                                class="btn btn-success"
                                            >
                                                Salvar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>