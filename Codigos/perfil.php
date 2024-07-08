<?php
session_start();
include("connect.php");

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Erro: ID do usuário não está definido na sessão.");
}


$user_id = $_SESSION['user_id'];

$sqlSelectDocuments = "SELECT * FROM documentos WHERE user_id = ?";
$stmtDocuments = $conn->prepare($sqlSelectDocuments);

if ($stmtDocuments === false) {
    die("Erro na preparação da consulta SQL (documentos): " . $conn->error);
}

$stmtDocuments->bind_param("i", $user_id);
$stmtDocuments->execute();
$resultDocuments = $stmtDocuments->get_result();

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <script>
        function confirmDelete() {
            return window.confirm("Você tem certeza que deseja apagar o usuário?");
        }
    </script>
</head>
<body>
    <div class="conteudo" id="iconteudo">
        <div class="conteudo-informacional">
            <h1>Perfil</h1>
        </div>
        <div class="conteudo-fundo">
            <form action="processos.php" method="post" class="form-perfil">
                <div class="conteudo-fundo" id="iconteudo-opcoes-criar-site">
                    <div class="conteudo-opcoes-perfil-esquerdo">
                        <p>
                            Aqui você pode atualizar as suas informações de usuário ou excluir a sua conta!
                        </p>
                    </div>
                    
                    <input class="conteudo-opcoes-criar-site" type="submit" value="Atualizar" name="update-perfil">
                    

                    
                    <input class="conteudo-opcoes-criar-site" type="submit" value="Apagar Usuario" name="delete-perfil" onclick="return confirmDelete()">
                    
                </div>
            
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes" id="ieditar-perfil">
                        <h1 class="titulo-de-opcao">Editar Perfil</h1>
                        <label for="ninput-titulo-de-cabecario" class="titulo-de-cabecario-label"><h1>Seu nome</h1></label>
                        <input type="text" name="nome" class="input-titulo-de-cabecario" id="inomedapagina" value="<?php echo $nome; ?>">
                    
                        <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Seu email</h1></label>
                        <input type="email" name="email" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo $email; ?>">
                        
                        <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Sua senha</h1></label>
                        <input type="text" name="senha" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo $senha; ?>">

                        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
