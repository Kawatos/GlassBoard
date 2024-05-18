<?php
ob_start();
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "glassboard";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

  
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $login = mysqli_real_escape_string($conn, $_POST["login"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);

    
    $sql = "SELECT * FROM usuarios WHERE email='$login' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['login'] = $login;
        header("Location: sucesso.php");
        exit();
    } else {
        echo "Usuário ou senha inválidos.";
    }

    $conn->close();
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
    <link rel="stylesheet" href="estilos/indexhtml/style2.css">
</head>
<body>
    <main>
        <section id="principal">
            <div id="imagem">
                <h1 id="logo">GlassBoard</h1>
            </div>
            <div id="formulario-menu">
                <h1>GlassBoard Login</h1>
                <p>
                <?php
                
                ?>
                </p>
                <form action="login.php" method="post" class="lpformulario">
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
                        <a href="index.html" class="lpb1" id="lpbvoltar">Voltar</a>
                        <input type="submit" value="Entrar" class="lpb2" id="lpbentrar">
                        <a href="esqueci.php" class="lpb" id="lpbesqueci">Esqueci a senha<span id="spn" class="material-symbols-outlined">email</span></a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
