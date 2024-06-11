<?php
include('user_session.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlassBoard Sites</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/indexhtml/styleprincipal.css">
    <link rel="stylesheet" href="estilos/indexhtml/mqstyleprincipal.css">
</head>
<body>
    <main>
        <section class="principal-menu" id="iprincipal-menu">
            <header class="headermenu">
                <nav class="navmenu" id="inavamenu">
                    <div class="logo">
                        <h1 id="navlogo">GlassBoard</h1>
                    </div>
                    <div class="navmenu-opcoes">
                        <a href="sites.php">Sites</a>
                        <a href="loja.php">Loja</a>
                        <a href="ajuda.php">Ajuda</a>
                        <a href="feedback.php">Deixe aqui o seu feedback!</a>
                        <div class="navmenu-usuario">
                            <a href="perfil.php"><?php echo htmlspecialchars($nome); ?><span class="material-symbols-outlined">person</span></a>
                            <a href="logout.php">Sair<span class="material-symbols-outlined">logout</span></a>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="conteudo" id="iconteudo">
                <div class="conteudo-informacional">
                     <h1>Sites</h1>
                </div>
                <div class="conteudo-fundo">
                    <a href="criarsite.php" class="conteudo-opcoes-novosite">
                        <div class="conteudo-opcoes-novosite-div">
                            <h2 id="conteudo-opcoes-novosite-botao">Novo Site</h2>
                        </div>
                    </a>
                    <div class="conteudo-opcoes-novosite-direito">
                        <p>
                            Clique no botão ao lado para criar o seu primeiro site! <br>
                            É realmente muito simples e intuitivo pois utilizamos de modelos pré-projetados!
                        </p>
                    </div>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 1</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Data da Publicação</th>
                            <th>Título</th>
                            <th>Artigo</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($data = $resultDocuments->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data["date"]); ?></td>
                                <td><?php echo htmlspecialchars($data["title"]); ?></td>
                                <td><?php echo htmlspecialchars($data["summary"]); ?></td>
                                <td>
                                    <a class="btn btn-info" href="visualizador.php?id=<?php echo htmlspecialchars($data["id"]); ?>">View</a>
                                    <a class="btn btn-warning" href="editarsite.php?id=<?php echo htmlspecialchars($data["id"]); ?>">Edit</a>
                                    <a class="btn btn-danger" href="delete.php?id=<?php echo htmlspecialchars($data["id"]); ?>">delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
</body>
</html>
