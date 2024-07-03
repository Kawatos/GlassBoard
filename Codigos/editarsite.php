<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

include("connect.php");

// Buscar o nome do usuário
$sqlUser = "SELECT nome FROM usuarios WHERE id = ?";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bind_param("i", $user_id);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();

if ($resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $nome = $rowUser['nome'];
} else {
    $nome = "Usuário";
}

$id = $_GET['id'];
if ($id) {
    $sqlEdit = "SELECT * FROM documentos WHERE id = ?";
    $stmtEdit = $conn->prepare($sqlEdit);
    $stmtEdit->bind_param("i", $id);
    $stmtEdit->execute();
    $resultEdit = $stmtEdit->get_result();

    if ($resultEdit->num_rows > 0) {
        $rowEdit = $resultEdit->fetch_assoc();
        $title = $rowEdit['title'];
        $author = $rowEdit['author'];
        $summary = $rowEdit['summary'];
        $content = $rowEdit['content'];
    } else {
        echo "Nenhuma postagem encontrada";
    }
} else {
    echo "Nenhuma postagem encontrada";
}
?>

<?php 
include ("header.php");
?>
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
                        <input class="conteudo-opcoes-criar-site" type="submit" value="Atualizar Página" name="update">
                    </div>
                
                    <div class="conteudo-fundo">
                        <div class="conteudo-opcoes" id="ieditar-pagina">
                            <h1 class="titulo-de-opcao">Editar Página</h1>
                            <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label"><h1>Título da Página</h1></label>
                            <input type="text" name="title" class="input-titulo-de-cabecario" id="inomedapagina" value="<?php echo htmlspecialchars($title); ?>">
                        
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Autor</h1></label>
                            <input type="text" name="author" class="input-titulo-de-cabecario" id="inomedoautor" placeholder="<?php echo ($nome); ?>" value="<?php echo htmlspecialchars($author); ?>">
                            
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Sumário</h1></label>
                            <input type="text" name="summary" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo htmlspecialchars($summary); ?>">
                            
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Conteúdo da Página</h1></label>
                            
                            <textarea name="content" id="summernote"><?php echo htmlspecialchars($content); ?></textarea>

                            <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
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
            placeholder: 'Escreva seu código aqui!',
            tabsize: 2,
            /* height: '200', // Altura inicial
            maxHeight: '300', // Altura máxima */
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });

       
    });
    </script>
</body>
</html>
