<?php
session_start();

include "lib/classes/DatabaseController.php";
include "lib/classes/PaginaController.php";

$dbController = new DatabaseController();
$conn = $dbController->conn;

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Erro: ID do usuário não está definido na sessão.");
}

$user_id = $_SESSION['user_id'];
$paginaController = new PaginaController($conn, $user_id);

$id = $_GET["id"];
if ($id) {
    if ($paginaController->deletePagina($id)) {
        header("Location: sites.php");
        exit();
    } else {
        die("Erro ao apagar a página.");
    }
} else {
    echo "Página não encontrada.";
}
?>
