<?php 
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "glassboard";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Erro na hora de conectar");
}

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>



<!--
    $servername = "localhost";
    $username = "id22176838_kawatos";
    $password = "TCRCt000#";
    $dbname = "id22176838_glassboard";
-->