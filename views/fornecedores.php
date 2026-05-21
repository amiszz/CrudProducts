<?php
session_start();
if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit;
}

require_once "../classes/Fornecedor.php";

$fornecedor = new Fornecedor();


/* cadastro de fornecedor
if (isset($_POST['cadastrar'])) {
    $fornecedor->cadastrar(
        $_POST['nome'],
        $_POST['email'],
        $_POST['telefone']
    );

    header("Location: fornecedores.php");
    exit;
} */


// exclusão de fornecedor
if (isset($_GET['excluir'])) {
    $fornecedor->excluir($_GET['excluir']);

    header("Location: fornecedores.php");
    exit;
}


// edição de fornecedor
if (isset($_POST['editar'])) {
    $fornecedor->editar(
        $_POST['id'],
        $_POST['nome'],
        $_POST['email'],
        $_POST['telefone']
    );

    header("Location: fornecedores.php");
    exit;
}


$fornecedores = $fornecedor->listar();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Fornecedores</h2>
        <a href="dashboard.php" class="btn btn-secondary">
            Dashboard
        </a>
    </div>

    <!-- formulário para cadastro -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="formFornecedor">
                <div class="row">
                    <div class="col-md-4">
                        <input
                            type="text"
                            name="nome"
                            class="form-control"
                            placeholder="Nome"
                            required
                        >
                    </div>

                    <div class="col-md-4">
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Email"
                        >
                    </div>
                    <div class="col-md-3">
                        <input
                            type="text"
                            name="telefone"
                            class="form-control"
                            placeholder="Telefone"
                        >
                    </div>

                    <div class="col-md-1">
                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Incluir
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- lista de fornecedores -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($fornecedores as $f): ?>

                        <tr>
                            <td><?= $f['id'] ?></td>
                            <td><?= $f['nome'] ?></td>
                            <td><?= $f['email'] ?></td>
                            <td><?= $f['telefone'] ?></td>
                            <td>
                                <!-- btn edição -->
                                <button
                                    class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal<?= $f['id'] ?>"
                                >
                                    Editar

                                </button>
                                <!-- btn exclusão -->
                                <a
                                    href="?excluir=<?= $f['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Excluir fornecedor?')"
                                >
                                    Excluir
                                </a>
                            </td>
                        </tr>

                        <!-- modal-->
                        <div
                            class="modal fade"
                            id="modal<?= $f['id'] ?>"
                            tabindex="-1"
                        >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Editar Fornecedor
                                            </h5>
                                        </div>

                                        <div class="modal-body">
                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= $f['id'] ?>"
                                            >
                                            <div class="mb-3">
                                                <label>Nome</label>
                                                <input
                                                    type="text"
                                                    name="nome"
                                                    class="form-control"
                                                    value="<?= $f['nome'] ?>"
                                                >
                                            </div>

                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input
                                                    type="email"
                                                    name="email"
                                                    class="form-control"
                                                    value="<?= $f['email'] ?>"
                                                >
                                            </div>

                                            <div class="mb-3">
                                                <label>Telefone</label>
                                                <input
                                                    type="text"
                                                    name="telefone"
                                                    class="form-control"
                                                    value="<?= $f['telefone'] ?>"
                                                >
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $("#formFornecedor").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "../ajax/fornecedor.php",
            method: "POST",
            data: {
                acao: "cadastrar",
                nome: $("input[name='nome']").val(),
                email: $("input[name='email']").val(),
                telefone: $("input[name='telefone']").val()
            },
            success: function(response){
                alert("Fornecedor cadastrado com sucesso!");
                location.reload();
            }
        });
    });
</script>
</body>
</html>