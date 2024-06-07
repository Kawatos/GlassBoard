<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}



if (isset($_POST["criarnovapagina"])) {
    include("connect.php");
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $summary = mysqli_real_escape_string($conn, $_POST["summary"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    /* echo $title;
    echo $summary;
    echo $content;
    echo $date; */

    $sqlInsert = "INSERT INTO documentos (date, title, summary, content, author) VALUES ('$date', '$title', '$summary', '$content', '$author')";
    if (mysqli_query($conn, $sqlInsert)){
        header("Location: sites.php");
    } else {
        die("Dados não foram inseridos");
    }
}

?>

<?php 
if (isset($_POST["update"])) {
    include("connect.php");
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $summary = mysqli_real_escape_string($conn, $_POST["summary"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    /* echo $title;
    echo $summary;
    echo $content;
    echo $date; */

    $sqlUpdate = "UPDATE documentos SET title = '$title', summary = '$summary', content = '$content', date = '$date', author = '$author' WHERE id = '$id'";
    if (mysqli_query($conn, $sqlUpdate)){
        header("Location: sites.php");

    } else {
        die("Dados não foram atualizados");
    }
}

?>