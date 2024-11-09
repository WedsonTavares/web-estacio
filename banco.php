<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$banco = "cadastro";


$conexao = new mysqli($servidor, $usuario, $password);


if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $banco";
if ($conexao->query($sql) === TRUE) {
    echo "Banco de dados '$banco' criado com sucesso.<br>";
} else {
    die("Erro ao criar o banco de dados: " . $conexao->error);
}


$conexao->select_db($banco);


$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(250) NOT NULL,
    cpf VARCHAR(20) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    logradouro VARCHAR(250) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL
)";
if ($conexao->query($sql) === TRUE) {
    echo "Tabela 'usuarios' criada com sucesso.<br>";
} else {
    die("Erro ao criar a tabela: " . $conexao->error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $logradouro = $_POST['logradouro'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO usuarios (nome, cpf, telefone, email, cep, numero, logradouro, bairro, cidade, estado) 
            VALUES ('$nome', '$cpf', '$telefone', '$email', '$cep', '$numero', '$logradouro', '$bairro', '$cidade', '$estado')";

    if ($conexao->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
}


$conexao->close();
?>