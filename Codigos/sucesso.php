<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <main>
        <section>
            <div id="imagem">

            </div>
            <div id="formulario">
                <h1>tudo certo</h1>
                <p>
                <?php
                session_start();

                if (!isset($_SESSION['login'])) {
                    header("Location: login.php");
                    exit();
                }

                echo "Bem-vindo, " . $_SESSION['login'];
                ?>
                </p>
                <p>
                    <form method="get" action="login.php">
                        <input type="submit" value="Fazer Login">
                    </form>
                </p>
                <p>
                    <form method="get" action="cadastro.php">
                        <input type="submit" value="Cadastrar-se">
                    </form>
                </p>
                
            </div>
        </section>
    </main>
    
</body>
</html>