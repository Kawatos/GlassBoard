<?php 
session_start();
include "lib/classes/DatabaseController.php";

$dbController = new DatabaseController();


//TODO - como essa arquivo não é um view, é bom validar o request, para verificar se é $_POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Método de requisição inválido.");
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Erro: ID do usuário não está definido na sessão.");
}

$conn = $dbController->conn;

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Consultas SQL
function executeQuery($conn, $sql, $params, $types) {
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da consulta SQL: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result();
}

if (isset($_POST["feedback"])) {
    $message = $_POST["mensagem"];
    
    // Preparar a consulta
    $sqlInsert = "INSERT INTO mensagens (message, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sqlInsert);

    if ($stmt === false) {
        die("Erro na preparação da consulta SQL: " . $conn->error);
    }

    // Vincular os parâmetros
    $stmt->bind_param("si", $message, $user_id);

    // Executar a consulta
    if ($stmt->execute()) {
        header("Location: feedback.php");
        exit();
    } else {
        die("Dados não foram inseridos: " . $stmt->error);
    }
}
?>
