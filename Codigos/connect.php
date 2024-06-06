<?php 
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "glassboard";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Erro na hora de conectar");
}
?>