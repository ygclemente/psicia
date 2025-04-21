<?php
session_start(); 

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'chat_ia';

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Pega os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta o usuário no banco
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verifica a senha
    if (password_verify($senha, $usuario['senha'])) {
        // Login bem-sucedido
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        echo "Login realizado com sucesso. Bem-vindo, " . $usuario['nome'] . "!";
        
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}

$conn->close();
?>
