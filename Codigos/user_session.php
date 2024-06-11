<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Erro: ID do usuário não está definido na sessão.");
}

include("connect.php");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sqlSelectDocuments = "SELECT * FROM documentos WHERE user_id = ?";
$stmtDocuments = $conn->prepare($sqlSelectDocuments);

if ($stmtDocuments === false) {
    die("Erro na preparação da consulta SQL (documentos): " . $conn->error);
}

$stmtDocuments->bind_param("i", $user_id);
$stmtDocuments->execute();
$resultDocuments = $stmtDocuments->get_result();


$sqlSelectUser = "SELECT email, nome, senha FROM usuarios WHERE id = ?";
$stmtUser = $conn->prepare($sqlSelectUser);

if ($stmtUser === false) {
    die("Erro na preparação da consulta SQL (usuário): " . $conn->error);
}

$stmtUser->bind_param("i", $user_id);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();

if ($resultUser->num_rows > 0) {
    $row = $resultUser->fetch_assoc();
    $email = $row['email'];
    $nome = $row['nome'];
    $senha = $row['senha'];
} else {
    echo "Dados não encontrados";
    exit();
}

$stmtUser->close();
$stmtDocuments->close();
$conn->close();
?>
