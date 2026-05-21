<?php

require_once "config/database.php";

$db = new Database();

$conexao = $db->conectar();

echo "Banco conectado com sucesso!";