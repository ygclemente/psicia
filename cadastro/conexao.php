<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "chat_ia"; 

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica se houve erro
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>
