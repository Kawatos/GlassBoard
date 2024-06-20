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

<?php 
include ("header.php");
?>
            <div class="conteudo-editor" id="iconteudo">
                
                <div class="conteudo-informacional">
                     <h1>Crie seu site aqui!</h1>
                </div>
                
                <div class="conteudo-fundo" id="iconteudo-opcoes-criar-site">
                    
                    <div class="conteudo-opcoes-criar-site-esquerdo">
                        <p>
                            Clique no botão ao lado para adicionar uma nova pagina ao seu site!
                            Ou se preferir, basta continuar editando a pagina atual.
                        </p>
                    </div>
                    <a href="#" class="conteudo-opcoes-criar-site">
                        <h2>Nova página</h2>
                    </a>
                </div>
                <form action="processos.php" method="post">
                    <div class="conteudo-fundo">
                        <div class="conteudo-opcoes" id="ieditar-pagina">
                            <h1 class="titulo-de-opcao">Editar Página</h1>
                            <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label"><h1>Título da Página</h1></label>
                            <input type="text" name="title" class="input-titulo-de-cabecario" id="inomedapagina">
                    
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Autor</h1></label>
                            <input type="text" name="author" class="input-titulo-de-cabecario" id="inomedoautor">
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Sumário</h1></label>
                            <input type="text" name="summary" class="input-titulo-de-cabecario" id="inomedoautor">
                            <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Conteúdo da Página</h1></label>
                            <textarea name="content" id="" cols="30" rows="10" placeholder="Digite o conteudo"></textarea>
                            <!-- <div class="summernotediv">
                                <div id="summernote" class="summernote" name="summernote" ></div>
                            </div> -->
                            <input type="hidden">
                        </div>
                    </div>
                    <div class="conteudo-fundo">
                        <input type="submit" value="Criar Nova Página" name="criarnovapagina">
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