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

//TODO - esta query sendo executada aqui, faz com q ela seja executada em todas a paginas, melhor é colocar ela só em site.php, ou criar uma função para para ela, e só executar em site.php
