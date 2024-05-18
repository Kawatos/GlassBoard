<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/indexhtml/style2.css">
</head>
<body>
    <main>
        <section class="principal-menu" id="iprincipal-menu">
            <header class="header">
                <nav class="navmenu" id="inavamenu">
                    <div class="logo">
                        <h1 id="navlogo">GlassBoard</h1>
                    </div>
                    <div class="navmenu-opcoes">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                        <a href="#">Link 4</a>
                        <div class="navmenu-usuario">
                            <a href="#"><?php echo $_SESSION['nome']; ?></a>
                        </div>
                    </div>
                    
                </nav>
            </header>
            <div class="conteudo" id="iconteudo">
                <h1>tudo certo</h1>
                <p>Bem-vindo, <?php echo $_SESSION['nome']; ?> !!!</p>

                <div class="opcoes-do-menu-grandes">
                    <h2>Nome do Site</h2>

                </div>
            </div>
            <footer>

            </footer>
        </section>
    </main>
    
</body>
</html>