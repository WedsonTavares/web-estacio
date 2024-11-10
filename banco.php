<?php
$servidor = "localhost"; // Define o servidor do banco de dados
$usuario = "root"; // Define o usuário do banco de dados
$password = ""; // Define a senha do banco de dados
$banco = "cadastro"; // Define o nome do banco de dados

// Cria uma nova conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $password);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error); // Encerra o script em caso de erro
}

// Cria o banco de dados se ele não existir
$sql = "CREATE DATABASE IF NOT EXISTS $banco";
if ($conexao->query($sql) === TRUE) {
    echo "Banco de dados '$banco' criado com sucesso.<br>"; // Mensagem de sucesso
} else {
    die("Erro ao criar o banco de dados: " . $conexao->error); // Encerra o script em caso de erro
}

// Seleciona o banco de dados
$conexao->select_db($banco);

// Cria a tabela 'usuarios' se ela não existir
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
    echo "Tabela 'usuarios' criada com sucesso.<br>"; // Mensagem de sucesso
} else {
    die("Erro ao criar a tabela: " . $conexao->error); // Encerra o script em caso de erro
}

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém os dados do formulário
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

    // Insere os dados na tabela 'usuarios'
    $sql = "INSERT INTO usuarios (nome, cpf, telefone, email, cep, numero, logradouro, bairro, cidade, estado) 
            VALUES ('$nome', '$cpf', '$telefone', '$email', '$cep', '$numero', '$logradouro', '$bairro', '$cidade', '$estado')";

    // Verifica se a inserção foi bem-sucedida
    if ($conexao->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!"; // Mensagem de sucesso
    } else {
        echo "Erro ao cadastrar: " . $conexao->error; // Mensagem de erro
    }
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>