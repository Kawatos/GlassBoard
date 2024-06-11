<?php
include('user_session.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlassBoard Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/indexhtml/styleprincipal.css">
    <link rel="stylesheet" href="estilos/indexhtml/mqstyleprincipal.css">
</head>
<body>
    <main>
        <section class="principal-menu" id="iprincipal-menu">
            <header class="headermenu">
                <nav class="navmenu" id="inavamenu">
                    <div class="logo">
                        <h1 id="navlogo">GlassBoard</h1>
                    </div>
                    <div class="navmenu-opcoes">
                        <a href="sites.php">Sites</a>
                        <a href="loja.php">Loja</a>
                        <a href="ajuda.php">Ajuda</a>
                        <a href="feedback.php">Deixe aqui o seu feedback!</a>
                        <div class="navmenu-usuario">
                            <a href="perfil.php"><?php echo $_SESSION['nome']; ?><span class="material-symbols-outlined">person</span></a>
                            <a href="logout.php">Sair<span class="material-symbols-outlined">logout</span></a>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="conteudo" id="iconteudo">
                <div class="conteudo-informacional">
                     <h1>Me deixe o seu Feedback!</h1>
                </div>
                <div class="conteudo-fundo">
                    <div>
                        <?php 
                        $id = $_GET["id"];
                        if ($id) {
                            include("connect.php");
                            $sqlSelectPost = "SELECT * FROM documentos WHERE id = $id";
                            $result = mysqli_query($conn, $sqlSelectPost);
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                            <h1><?php echo $data['title']; ?></h1>
                            <p><?php echo $data['date']; ?></p>
                            <p><?php echo $data['content']; ?></p>
                            <?php
                            }
                        } else {
                            echo "Post nao encontrado";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
</body>
</html>
