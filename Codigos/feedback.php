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
                            <a href="perfil.php"><?php echo htmlspecialchars($nome); ?><span class="material-symbols-outlined">person</span></a>
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
                    <div class="conteudo-opcoes-area-texto" id="caixa-do-feedback">
                        <h1 class="titulo-de-opcao">A sua opinião é realmente muito importante para mim!</h1>
                        <h2>Não tenha medo de elogiar ou de criticar. <br>Críticas construtivas são tão bem-vindas quanto elogios!</h2>
                        <p id="mensagemdofeedback"><?php if (isset($feedback)) { echo "$feedback"; } ?></p>
                        <form method="post" action="processos.php">
                            <textarea name="mensagem" class="area-de-edicao-do-site-classe" id="iarea-de-edicao-do-feedback" placeholder="Digite sua mensagem aqui..." required maxlength="200"></textarea>
                            <div class="conteudo-fundo" id="conteudo-fundo-feedback"><button type="submit" id="botao-do-feedback" name="feedback">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
</body>
</html>
