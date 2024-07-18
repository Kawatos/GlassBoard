<?php
session_start();
include "lib/classes/DatabaseController.php";
include "lib/classes/UserController.php";

$dbController = new DatabaseController();
$conn = $dbController->conn;
$userController = new UserController($conn);

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Erro: ID do usuário não está definido na sessão.");
}

$user_id = $_SESSION['user_id'];

// Obtém os dados do usuário para exibir no formulário
$user = $userController->getUserById($user_id);

if ($user) {
    $email = $user['email'];
    $nome = $user['nome'];
    $senha = $user['senha'];
} else {
    echo "Dados não encontrados";
    exit();
}

// Processa as requisições de atualização e exclusão
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["update-perfil"])) {
        if ($userController->editarUsuario($_POST, $user_id)) {
            header("Location: perfil.php");
            exit();
        } else {
            die("Dados não foram atualizados.");
        }
    }

    if (isset($_POST["delete-perfil"])) {
        if ($userController->apagarUsuario($user_id)) {
            // Redirecionar para logout.php
            header("Location: logout.php");
            exit();
        } else {
            die("Erro ao apagar o usuário.");
        }
    }
}
?>
<?php include ("header.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
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
            <form action="perfil.php" method="post" class="form-perfil">
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
                        <input type="text" name="nome" class="input-titulo-de-cabecario" id="inomedapagina" value="<?php echo htmlspecialchars($nome); ?>">
                    
                        <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Seu email</h1></label>
                        <input type="email" name="email" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo htmlspecialchars($email); ?>">
                        
                        <label for="area-de-edicao-do-site" class="titulo-de-cabecario-label" id="area-de-edicao-do-site-classe"><h1>Sua senha</h1></label>
                        <input type="text" name="senha" class="input-titulo-de-cabecario" id="inomedoautor" value="<?php echo htmlspecialchars($senha); ?>">

                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
