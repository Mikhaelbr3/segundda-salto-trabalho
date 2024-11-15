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

// Recebe dados do formulário (email e senha)
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Verifica se o usuário já existe
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Erro: Email já registrado!";
} else {
    // Insere um novo usuário
    $sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro bem-sucedido!";
    } else {
        echo "Erro ao registrar: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
