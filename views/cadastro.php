<?php

require_once "../classes/Usuario.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuario = new Usuario();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($usuario->cadastrar($nome, $email, $senha)) {

        $msg = "Usuário cadastrado com sucesso!";

    } else {

        $msg = "ALERTA! Erro ao cadastrar.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-dark">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4">
                        Cadastro
                    </h2>

                    <?php if($msg): ?>

                        <div class="alert alert-info">
                            <?= $msg ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Nome</label>

                            <input
                                type="text"
                                name="nome"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label>Senha</label>

                            <input
                                type="password"
                                name="senha"
                                class="form-control"
                                required
                            >
                        </div>

                        <button class="btn btn-primary w-100">
                            Cadastrar
                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <a href="login.php">
                            Já tenho conta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>