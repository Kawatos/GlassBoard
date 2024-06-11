<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
?>

<?php 
$id = $_GET['id'];
if ($id) {
    include("connect.php");
    $sqlEdit = "SELECT * FROM documentos WHERE id= $id";
    $result = mysqli_query($conn, $sqlEdit);
} else {
    echo "Nenhuma postagem encontrada";
}


?>

<?php

$sqlSelect = "SELECT title, author, summary, content FROM documentos WHERE id = ?";
$stmt = $conn->prepare($sqlSelect);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $author = $row['author'];
    $summary = $row['summary'];
    $content = $row['content'];
} else {
    echo "Dados nao encontrados";
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

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
                     <h1>Editar Site</h1>
                </div>
                <form action="processos.php" method="post">
                    <div class="conteudo-fundo" id="iconteudo-opcoes-criar-site">
                        <div class="conteudo-opcoes-criar-site-esquerdo">
                            <p>
                                Clique no botão ao lado para adicionar uma nova pagina ao seu site!
                                Ou se preferir, basta continuar editando a pagina atual.
                            </p>
                        </div>
                        <div class="conteudo-opcoes-criar-site">
                            <input type="submit" value="Atualizar Página" name="update">
                        </div>
                    </div>
                
                    <div class="conteudo-fundo">
                        <div class="conteudo-opcoes" id="ieditar-pagina">
                            <h1 class="titulo-de-opcao">Editar Página</h1>
                            <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label"><h1>Título da Página</h1></label>
                            <input type="text" name="title" class="input-titulo-de-cabecario" id="inomedapagina" value="<?php echo $title; ?>">
                        
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Autor</h1></label>
                            <input type="text" name="author" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo $author; ?>">
                            
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Sumário</h1></label>
                            <input type="text" name="summary" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo $summary; ?>">
                            
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Conteúdo da Página</h1></label>
                            <textarea name="content" id="" cols="30" rows="10" placeholder="Digite o conteudo"><?php echo $content; ?></textarea>

                            <input type="hidden" name="date" value="<?php echo date("y/m/d"); ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>
                    </div>
                </form>
                
            </div>

            <footer>
            
            </footer>
        </section>
    </main>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
            placeholder: 'Esceva seu código aqui!',
            tabsize: 5,
            
            maxHeight: 'calc(100%)',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
            });
            $('.note-editor').css('height', 'g');
            $('.note-editable').css('height', '30vh'); 
        });
</script>
</body>
</html>