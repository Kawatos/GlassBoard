<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre-se no GlassBoard</title>
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
                <h1>Preencha seus dados no campo abaixo:</h1>
                <p>
                <?php
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include("connect.php");
                    if ($conn->connect_error) {
                        die("Falha na conexão: " . $conn->connect_error);
                    }

                    $nome = $_POST["primeironome"];
                    $email = $_POST["primeirologin"];
                    $senha = $_POST["primeirasenha"];

                    
                    $sql = "INSERT INTO usuarios (nome, email, senha)
                    VALUES ('$nome', '$email', '$senha')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Registro inserido com sucesso";
                    } else {
                        echo "Erro ao inserir registro: " . $conn->error;
                    }

                    $conn->close();
                }
                ?>

                </p>
                <form action="cadastro.php" method="post" class="lpformulario">
                    <div class="campo">
                        <span class="material-symbols-outlined">person</span>
                        <input type="text" name="primeironome" id="iprimeirologin" placeholder="Seu nome" autocomplete="name" required maxlength="30">
                        <label for="inovologin">Insira aqui o nome</label>
                    </div>
                    <div class="campo">
                        <span class="material-symbols-outlined">mail</span>
                        <input type="email" name="primeirologin" id="iprimeirologin" placeholder="Seu e-mail" autocomplete="email" required maxlength="30">
                        <label for="inovologin">Insira aqui o seu email</label>
                    </div>
                    <div class="campo">
                        <span class="material-symbols-outlined">key</span>
                        <input type="password" name="primeirasenha" id="iprimeirasenha" placeholder="Sua senha" autocomplete="current-password" required minlength="8" maxlength="30">
                        <label for="iprimeirasenha">Crie uma senha</label>
                    </div>
                    <div class="botao-container">
                        <a href="index.html" class="lpb1" id="lpbvoltar">Voltar</a>
                        <input type="submit" value="Cadastrar-se" class="lpb2" id="lpbcad">
                    </div>
                </form>
            </div>
        </section>
    </main>
    
</body>
</html>