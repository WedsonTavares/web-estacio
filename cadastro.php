<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$banco = "cadastro";

try {
    // Conexão com o banco de dados
    $conexao = new mysqli($servidor, $usuario, $password);

    if ($conexao->connect_error) {
        throw new Exception("Conexão falhou: " . $conexao->connect_error);
    }

    // Criação do banco de dados, se não existir
    $sql = "CREATE DATABASE IF NOT EXISTS $banco";
    if (!$conexao->query($sql)) {
        throw new Exception("Erro ao criar o banco de dados: " . $conexao->error);
    }

    echo "Banco de dados '$banco' criado com sucesso.<br>";

    // Seleciona o banco de dados
    $conexao->select_db($banco);

    // Criação da tabela 'usuarios', se não existir
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
    if (!$conexao->query($sql)) {
        throw new Exception("Erro ao criar a tabela: " . $conexao->error);
    }

    echo "Tabela 'usuarios' criada com sucesso.<br>";

    // Processamento do formulário
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Validação básica dos campos
        $nome = trim($_POST['nome']);
        $cpf = trim($_POST['cpf']);
        $telefone = trim($_POST['telefone']);
        $email = trim($_POST['email']);
        $cep = trim($_POST['cep']);
        $numero = trim($_POST['numero']);
        $logradouro = trim($_POST['logradouro']);
        $bairro = trim($_POST['bairro']);
        $cidade = trim($_POST['cidade']);
        $estado = trim($_POST['estado']);

        // Preparação da consulta para evitar SQL Injection
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome, cpf, telefone, email, cep, numero, logradouro, bairro, cidade, estado) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta: " . $conexao->error);
        }

        $stmt->bind_param("ssssssssss", $nome, $cpf, $telefone, $email, $cep, $numero, $logradouro, $bairro, $cidade, $estado);

        // Executa a consulta
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            throw new Exception("Erro ao cadastrar: " . $stmt->error);
        }

        $stmt->close();
    }
} catch (Exception $e) {
    // Tratamento de erros
    echo "Erro: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conexao->close();
}
?>