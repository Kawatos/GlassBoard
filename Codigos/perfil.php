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

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$id = $_SESSION['user_id'];

$sqlSelect = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sqlSelect);

if ($stmt === false) {
    die("Erro na preparação da consulta SQL: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<?php
include("connect.php");

$sqlSelect = "SELECT email, nome, senha FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sqlSelect);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $nome = $row['nome'];
    $senha = $row['senha'];
} else {
    echo "Dados nao encontrados";
}


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
                            <a href="perfil.php"><?php echo $nome; ?><span class="material-symbols-outlined">person</span></a>
                            <a href="logout.php">Sair<span class="material-symbols-outlined">logout</span></a>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="conteudo" id="iconteudo">
                <div class="conteudo-informacional">
                     <h1>Perfil</h1>
                </div>
                <div class="conteudo-fundo">
                    <form action="processos.php" method="post">
                        <div class="conteudo-fundo" id="iconteudo-opcoes-criar-site">
                            <div class="conteudo-opcoes-criar-site-esquerdo">
                                <p>
                                    Clique no botão ao lado para adicionar uma nova pagina ao seu site!
                                    Ou se preferir, basta continuar editando a pagina atual.
                                </p>
                            </div>
                            <div class="conteudo-opcoes-criar-site">
                                <input type="submit" value="Atualizar Página" name="update-perfil">
                            </div>
                            <div class="conteudo-opcoes-criar-site">
                                <input type="submit" value="Apagar Usuario" name="delete-perfil">
                            </div>
                        </div>
                    
                        <div class="conteudo-fundo">
                            <div class="conteudo-opcoes" id="ieditar-pagina">
                                <h1 class="titulo-de-opcao">Editar Página</h1>
                                <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label"><h1>Seu nome</h1></label>
                                <input type="text" name="nome" class="input-titulo-de-cabecario" id="inomedapagina" value="<?php echo $nome; ?>">
                            
                                <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Seu email</h1></label>
                                <input type="email" name="email" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo $email; ?>">
                                
                                <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Sua senha</h1></label>
                                <input type="text" name="senha" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo $senha; ?>">

                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
</body>
</html>
