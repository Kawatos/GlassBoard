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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlassBoard Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/indexhtml/visualizador.css">
</head>
<body class="visualizador-body">
    <main class="visualizador-main">
        <?php 
        $id = $_GET["id"];
        $date = "";
        if ($id) {
            include("connect.php");
            $sqlSelectPost = "SELECT * FROM documentos WHERE id = $id";
            $result = mysqli_query($conn, $sqlSelectPost);
            while ($data = mysqli_fetch_array($result)) {
                $date = $data['date'];
        ?>
                <h1 class="h1-data"><?php echo $data['title']; ?></h1>
                <div class="content-central">
                    <?php echo $data['content']; ?>
                </div>
        <?php
            }
        } else {
            echo "<h1>Post não encontrado</h1>";
        }
        ?>
        <footer>
            <p><?php echo $date; ?></p>
            <a href="sites.php" class="conteudo-opcoes-novosite-botao">Voltar</a>
        </footer>
    </main>
</body>
</html>
