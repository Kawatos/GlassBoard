<?php 

//TODO - como essa arquivo não é um view, é bom validar o request, para verificar se é $_POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // aqui vc realiza alguma ação, exibir erro, volta, redireciona, etc...
}

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Erro: ID do usuário não está definido na sessão.");
}

include("connect.php");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

//TODO - não encontrei onde esta sendo usado esta query...
$sqlSelect = "SELECT * FROM documentos WHERE user_id = ?";
$stmt = $conn->prepare($sqlSelect);

if ($stmt === false) {
    die("Erro na preparação da consulta SQL: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_POST["criarnovapagina"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $summary = mysqli_real_escape_string($conn, $_POST["summary"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    $sqlInsert = "INSERT INTO documentos (date, title, summary, content, author, user_id) VALUES ('$date', '$title', '$summary', '$content', '$author', '$user_id')";

    //TODO - ao invés de concatenar a $date vc pode utiliza a função now() do sql ...user_id) VALUES (NOW(),...
    //TODO - na tabela documentos a coluna "date" deve ser do tipo date ou datetime caso queira a hora

    if (mysqli_query($conn, $sqlInsert)){
        header("Location: sites.php");
    } else {
        die("Dados não foram inseridos: " . mysqli_error($conn));
    }
}

if (isset($_POST["update"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $summary = mysqli_real_escape_string($conn, $_POST["summary"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    $sqlUpdate = "UPDATE documentos SET title = '$title', summary = '$summary', content = '$content', date = '$date', author = '$author' WHERE id = '$id' AND user_id = '$user_id'";
    if (mysqli_query($conn, $sqlUpdate)){
        header("Location: sites.php");
    } else {
        die("Dados não foram atualizados: " . mysqli_error($conn));
    }
}

if (isset($_POST["update-perfil"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $senha = mysqli_real_escape_string($conn, $_POST["senha"]);

    $sqlUpdate = "UPDATE usuarios SET email = '$email', nome = '$nome', senha = '$senha' WHERE id = '$user_id'";
    if (mysqli_query($conn, $sqlUpdate)){
        header("Location: perfil.php");
    } else {
        die("Dados não foram atualizados: " . mysqli_error($conn));
    }
}

if (isset($_POST["delete-perfil"])) {
    if ($user_id) {
    
        $sqlDelete = "DELETE FROM usuarios WHERE id = $user_id";
        if (mysqli_query($conn, $sqlDelete)) {
            //TODO - aqui vc poderia só redirecionar para logout.php q é responsável por encerra a sessão do usuário
            session_start();
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            die("Usuario Nao Exluido");
        }
    } else {
        echo "Post nao encontrado";
    }
}


if (isset($_POST["feedback"])) {
    $message = mysqli_real_escape_string($conn, $_POST["mensagem"]);
    //TODO - aqui seria bom utilizar o prepare, bind e execute, ao inves de concatenar a mensagem direto na query
    $sqlInsert = "INSERT INTO mensagens (message, user_id) VALUES ('$message', '$user_id')";
    if (mysqli_query($conn, $sqlInsert)){
        header("Location: feedback.php");
    } else {
        die("Dados não foram inseridos: " . mysqli_error($conn));
    }
}
?>
