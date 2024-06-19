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



$user_id = $_SESSION['user_id'];

?>