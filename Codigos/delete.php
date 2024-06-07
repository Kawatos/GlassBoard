<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];
if ($id) {
    include("connect.php");
    $sqlDelete = "DELETE FROM documentos WHERE id = $id";
    if (mysqli_query($conn, $sqlDelete)) {
        header("Location: sites.php");
    } else {
        die("Post nao apagado");
    }
} else {
    echo "Post nao encontrado";
}


?>