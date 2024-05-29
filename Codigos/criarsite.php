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
    <title>GlassBoard Criador de Sites</title>
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
                        <a href="Feedback.php">Deixe aqui o seu feedback!</a>
                        <div class="navmenu-usuario">
                            <a href="perfil.php"><?php echo $_SESSION['nome']; ?><span class="material-symbols-outlined">person</span></a>
                            <a href="logout.php">Sair<span class="material-symbols-outlined">logout</span></a>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="menu-lateral-esquerdo">
                <div class="menu-lateral-esquerdo-opcoes">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>

                </div>
                
            </div>
            <div class="conteudo-editor" id="iconteudo">
                
                <div class="conteudo-informacional">
                     <h1>Crie seu site aqui!</h1>
                </div>
                
                <div class="conteudo-fundo" id="iconteudo-opcoes-criar-site">
                    
                    <div class="conteudo-opcoes-criar-site-esquerdo">
                        <p>
                            Clique no botão ao lado para adicionar uma nova pagina ao seu site! <br>
                            Ou se preferir, basta continuar editando a pagina atual.
                        </p>
                    </div>
                    <a href="#" class="conteudo-opcoes-criar-site">
                        <h2>Nova página</h2>
                    </a>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes" id="ieditar-pagina">
                        <h1 class="titulo-de-opcao">Editar Página</h1>
                        <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label"><h1>Título da Página</h1></label>
                        <input type="text" name="ninput-titulo-de-cabecario" class="input-titulo-de-cabecario" id="inomedapagina">
                        <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Conteúdo da Página</h1></label>
                        <textarea name="area-de-edicao-do-site" class="area-de-edicao-do-site-classe" id="iarea-de-edicao-do-site"></textarea>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 2</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 3</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 4</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 5</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 6</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 7</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 8</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
    
</body>
</html>