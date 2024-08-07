<?php
ob_start();
session_start();

include "lib/classes/DatabaseController.php";
include "lib/classes/UserController.php";

$dbController = new DatabaseController();
$conn = $dbController->conn;
$userController = new UserController($conn);

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $login = $_POST["login"];
    $senha =  $_POST["senha"];

    $user = $userController->login($login, $senha);

    if ($user) {
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['login'] = $login;
        $_SESSION['user_id'] = $user['id']; 
        header("Location: sites.php"); 
        exit();
    } else {
        $login_error = "Usuário ou senha inválidos.";
    }
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlassBoard Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/indexhtml/style.css">
    <link rel="stylesheet" href="estilos/indexhtml/mqstyle.css">
</head>
<body>
    <main>
        <section id="principal">
            <div id="imagem">
                <h1 id="logo">GlassBoard</h1>
            </div>
            <div id="formulario-menu">
                <form action="login.php" name="login"method="post" class="lpformulario">
                    <h1 class="mensagemini">Login</h1> 
                    <?php if (!empty($login_error)): ?>
                        <p class="lpmsg-erro"><?php echo $login_error; ?></p>
                    <?php endif; ?>
                    <div class="campo">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" name="login" id="ilogin" placeholder="Seu e-mail" autocomplete="email" required maxlength="30">
                        <label for="ilogin">Login</label>
                    </div>
                    <div class="campo">
                        <span class="material-symbols-outlined">key</span>
                        <input type="password" name="senha" id="isenha" placeholder="Sua senha" autocomplete="current-password" required minlength="8" maxlength="30">
                        <label for="isenha">Senha</label>
                    </div>
                    <div class="botao-container">
                        <a href="index.php" class="lpb1" id="lpbvoltar">Voltar</a>
                        <input type="submit" value="Entrar" class="lpb2" id="lpbentrar">
                        <a href="esqueci.php" class="lpb" id="lpbesqueci">Esqueci a senha<span id="spn" class="material-symbols-outlined">email</span></a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
