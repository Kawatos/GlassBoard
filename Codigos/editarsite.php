<?php
session_start();
include "lib/classes/DatabaseController.php";
include "lib/classes/PaginaController.php";
include "lib/classes/UserController.php";
$dbController = new DatabaseController();
$conn = $dbController->conn;
$userController = new UserController($conn);

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$user = $userController->getUserById($user_id);

if ($user) {
    $email = $user['email'];
    $nome = $user['nome'];
    $senha = $user['senha'];
} else {
    echo "Dados não encontrados";
    exit();
}

$paginaController = new PaginaController($conn, $user_id);

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $retorno = $paginaController->editarPagina($_POST);
    if ($retorno === false) {
        die("Erro na preparação da consulta SQL (pagina): " . $conn->error);
    }
    header("Location: sites.php");
    exit();
}

if ($id) {
    $documento = $paginaController->getDocumento($id);

    if ($documento) {
        $title = $documento['title'];
        $author = $documento['author'];
        $summary = $documento['summary'];
        $content = $documento['content'];
    } else {
        echo "Nenhuma postagem encontrada";
        exit();
    }
} else {
    echo "Nenhuma postagem encontrada";
    exit();
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
                            <input type="text" name="author" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo htmlspecialchars($author); ?>">
                            
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
