<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre-se no GlassBoard</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/cadastresephp/style.css">
    <link rel="stylesheet" href="estilos/cadastresephp/mqstyle.css">
    <script>
        function voltarf() {
            window.location.href = "index.html"
        }
    </script>
</head>
<body>
    <main>
        <h1 id="logo">GlassBoard</h1>
        <section id="principal">
            <div id="imagem">

            </div>
            <div id="menu">
                <h1>Aqui você coloca os dados</h1>
                <p>
                <?php
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    $servername = "localhost";
                    $username = "id22176838_kawatos";
                    $password = "TCRCt000#";
                    $dbname = "id22176838_glassboard";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    
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
                <form action="cadastro.php" method="post">
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
                        <input type="button" value="Voltar" id="ivoltar" onclick="voltarf()">
                        <input type="submit" value="Cadastrar-se" id="cadb">
                    </div>
                </form>
            </div>
        </section>
    </main>
    
</body>
</html>