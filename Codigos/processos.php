<?php 
session_start();
include "lib/classes/DatabaseControler.php";

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

if (isset($_POST["update"])) {
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $id = $_POST["id"];
    $author = $_POST["author"];

    $sqlUpdate = "UPDATE documentos SET title = ?, summary = ?, content = ?, date = NOW(), author = ? WHERE id = ? AND user_id = ?";
    $params = [$title, $summary, $content, $author, $id, $user_id];

    executeQuery($conn, $sqlUpdate, $params, 'ssssis');
    header("Location: sites.php");
    exit();
}

if (isset($_POST["update-perfil"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);

    $sqlUpdate = "UPDATE usuarios SET email = '$email', nome = '$nome', senha = '$senha' WHERE id = '$user_id'";
    if (mysqli_query($conn, $sqlUpdate)){
        header("Location: perfil.php");
    } else {
        die("Dados não foram atualizados: " . mysqli_error($conn));
    }
}

if (isset($_POST["delete-perfil"])) {
    $sqlDelete = "DELETE FROM usuarios WHERE id = ?";
    $params = [$user_id];

    executeQuery($conn, $sqlDelete, $params, 'i');

    // Redirecionar para logout.php
    header("Location: logout.php");
    exit();
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
