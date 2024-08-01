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
                     <h1>No que podemos ajudar você agora?</h1>
                </div>
                
                
                <div class="conteudo-fundo">
                    <div class="conteudo-opcoes">
                        <h2>Nome do Site 1</h2>
                    </div>
                    <div class="conteudo-opcoes-direito">
                        <h3>Aqui devem ficar informações importantes sobre seu site.</h3>
                    </div>
                </div>
                
            </div>
            <footer>
            
            </footer>
        </section>
    </main>
    
</body>
</html>