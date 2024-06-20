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

$sqlSelectDocuments = "SELECT * FROM documentos WHERE user_id = ?";
$stmtDocuments = $conn->prepare($sqlSelectDocuments);

if ($stmtDocuments === false) {
    die("Erro na preparação da consulta SQL (documentos): " . $conn->error);
}

$stmtDocuments->bind_param("i", $user_id);
$stmtDocuments->execute();
$resultDocuments = $stmtDocuments->get_result();

//TODO - mesmo caso da query documentos
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

                            <!--TODO - é bom separar a ação de atualizar e apagar, e tbm colocar uam confirmação antes de apagar - https://www.w3schools.com/jsref/met_win_confirm.asp -->
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
