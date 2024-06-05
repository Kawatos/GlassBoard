<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Erro: ID do usuário não está definido na sessão.");
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glassboard";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

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
    <title>GlassBoard Sites</title>
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
                     <h1>Sites</h1>
                </div>
                
                <div class="conteudo-fundo">
                    <a href="criarsite.php" class="conteudo-opcoes-novosite">
                        <div class="conteudo-opcoes-novosite-div">
                            <h2 id="conteudo-opcoes-novosite-botao">Novo Site</h2>
                        </div>
                    </a>
                    <div class="conteudo-opcoes-novosite-direito">
                        <p>
                            Clique no botão ao lado para criar o seu primeiro site! <br>
                            É realmente muito simples e intuitivo pois utilizamos de modelos pré-projetados!
                        </p>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 1</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
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