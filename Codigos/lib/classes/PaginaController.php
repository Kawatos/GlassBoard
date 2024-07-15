<?php 

class PaginaController {
    private $conn;
    private $user_id;

    

    public function criarNovaPagina($dados) {
        if (isset($dados["criarnovapagina"])) {
            $title = $dados["title"];
            $summary = $dados["summary"];
            $content = $dados["content"];
            $author = $dados["author"];

            $this->inserirPagina($title, $summary, $content, $author);
            header("Location: sites.php");
            exit();
        }
    }

    private function inserirPagina($title, $summary, $content, $author) {
        $sqlInsert = "INSERT INTO documentos (date, title, summary, content, author, user_id) VALUES (NOW(), ?, ?, ?, ?, ?)";
        $params = [$title, $summary, $content, $author, $this->user_id];

        $this->executeQuery($sqlInsert, $params, 'ssssi');
    }

    private function executeQuery($sql, $params, $types) {
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $stmt->close();
    }
}
?>

