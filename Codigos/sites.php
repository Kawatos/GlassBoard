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


            <script>
                function confirmDelete() {
                    return window.confirm("Você tem certeza que deseja apagar este site? Essa ação não poderá ser desfeita!");
                }
            </script>
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
                <div class="conteudo-fundo-tabela">
                    
                    <table class="tabela-de-opcoes">
                        <thead class="tabela-de-opcoes-head">
                            <tr>
                                <th>Título</th>
                                <th>Sumário</th>
                                <th>Data da Publicação</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 0; // Inicializa o contador
                            while ($data = $resultDocuments->fetch_assoc()) {
                                $rowClass = ($counter % 2 == 0) ? 'even-row' : 'odd-row'; // Define a classe com base no valor do contador
                            ?>
                                <tr class="<?php echo $rowClass; ?>">
                                    <td><?php echo ($data["title"]); ?></td>
                                    <td><?php echo ($data["summary"]); ?></td>
                                    <td><?php echo ($data["date"]); ?></td>
                                    <td class="tabela-botoes">
                                        <a class="btn btn-info" href="visualizador.php?id=<?php echo ($data["id"]); ?>" id="botao-tabela-visualizar">Visualizar</a>
                                        <a class="btn btn-warning" href="editarsite.php?id=<?php echo ($data["id"]); ?>" id="botao-tabela-editar">Editar</a>
                                        <a class="btn btn-danger" href="delete.php?id=<?php echo ($data["id"]); ?>" id="botao-tabela-apagar" onclick="return confirmDelete()">Apagar</a>
                                    </td>
                                </tr>
                            <?php
                                $counter++; // Incrementa o contador
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
</body>
</html>
