<?php
// Configuração do banco de dados (Railway)
$host = 'autorack.proxy.rlwy.net';       // Host fornecido pelo Railway
$db = 'railway';                          // Nome do banco de dados fornecido
$user = 'root';                           // Usuário fornecido (root)
$password = 'ppkZjaOjQbTjXYFIJtgBfrobTdOZqphA';  // Senha fornecida
$port = 22912;                            // Porta fornecida (22912)

// Conexão com o banco de dados MySQL
$conn = new mysqli($host, $user, $password, $db, $port);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Recebe dados do formulário de login (email e senha)
$email = $_POST['email'];
$senha = $_POST['senha'];

// Verifica se o usuário existe
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($senha, $usuario['senha'])) {
        echo "Login bem-sucedido!";
    } else {
        echo "Erro: Senha incorreta.";
    }
} else {
    echo "Erro: Usuário não encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
