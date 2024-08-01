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
                     <h1>Me deixe o seu Feedback!</h1>
                </div>
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes-area-texto" id="caixa-do-feedback">
                        <h1 class="titulo-de-opcao" >A sua opinião é realmente muito importante para mim!</h1>
                        <h2 id="h2-feedback">Não tenha medo de elogiar ou de criticar. <br>Críticas construtivas são tão bem-vindas quanto elogios!</h2>
                        <p id="mensagemdofeedback"><?php if (isset($feedback)) { echo "$feedback"; } ?></p>
                        <form method="post" action="processos.php">
                            <textarea name="mensagem" class="area-de-edicao-do-site-classe" id="iarea-de-edicao-do-feedback" placeholder="Digite sua mensagem aqui..." required maxlength="200"></textarea>
                            <div class="conteudo-fundo" id="conteudo-fundo-feedback"><button type="submit" id="botao-do-feedback" name="feedback">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
</body>
</html>
