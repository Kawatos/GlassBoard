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

$sqlSelectUser = "SELECT email, nome, senha FROM usuarios WHERE id = ?";
$stmtUser = $conn->prepare($sqlSelectUser);

if ($stmtUser === false) {
    die("Erro na preparação da consulta SQL (usuário): " . $conn->error);
}

$stmtUser->bind_param("i", $user_id);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();

if ($resultUser->num_rows > 0) {
    $row = $resultUser->fetch_assoc();
    $email = $row['email'];
    $nome = $row['nome'];
    $senha = $row['senha'];
} else {
    echo "Dados não encontrados";
    exit();
}
?>

<?php 
include ("header.php");
?>
            
            <div class="conteudo-editor" id="iconteudo">
                
                <div class="conteudo-informacional">
                     <h1>Crie seu site aqui!</h1>
                </div>
                
                <form action="processos.php" method="post">
                    <div class="conteudo-fundo" id="iconteudo-opcoes-criar-site">
                        
                        <div class="conteudo-opcoes-criar-site-esquerdo">
                            <p>
                                Clique no botão ao lado para adicionar uma nova pagina ao seu site!
                                Ou se preferir, basta continuar editando a pagina atual.
                            </p>
                        </div>
                        <input class="conteudo-opcoes-criar-site" type="submit" value="Criar Nova Página" name="criarnovapagina">
                        
                    </div>
                    <div class="conteudo-fundo">
                        <div class="conteudo-opcoes" id="ieditar-pagina">
                            <h1 class="titulo-de-opcao">Editar Página</h1>
                            <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label">
                                <h1>Título da Página</h1>
                            </label>
                            <input type="text" name="title" class="input-titulo-de-cabecario" id="inomedapagina">

                            <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label">
                                <h1>Autor</h1>
                            </label>
                            <input type="text" name="author" class="input-titulo-de-cabecario" id="inomedoautor" placeholder="<?php echo ($nome); ?>">

                            <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label">
                                <h1>Sumário</h1>
                            </label>
                            <input type="text" name="summary" class="input-titulo-de-cabecario" id="inomedoautor">

                            <label for="summernote" class="titulo-de-cabecario-label">
                                <h1>Conteúdo da Página</h1>
                            </label>
                            <textarea name="content" id="summernote" class="textarea-conteudo"></textarea>
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