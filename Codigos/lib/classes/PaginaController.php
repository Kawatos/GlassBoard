<?php 

class PaginaController {
    private $conn;
    private $user_id;

    public function __construct($conn, $user_id) {
        $this->conn = $conn;
        $this->user_id = $user_id;
    }

    public function criarNovaPagina($dados) {
        if (isset($dados["criarnovapagina"])) {
            $title = $dados["title"];
            $summary = $dados["summary"];
            $content = $dados["content"];
            $author = $dados["author"];

            $sqlInsert = "INSERT INTO documentos (date, title, summary, content, author, user_id) VALUES (NOW(), ?, ?, ?, ?, ?)";
            $params = [$title, $summary, $content, $author, $this->user_id];

            return $this->executeQuery($sqlInsert, $params, 'ssssi');
            
        }
        return false;
    }

    public function editarPagina($dados) {
        if (isset($dados["update"])) {
            $title = $dados["title"];
            $summary = $dados["summary"];
            $content = $dados["content"];
            $author = $dados["author"];
            $id = $dados["id"];

            $sqlUpdate = "UPDATE documentos SET title = ?, summary = ?, content = ?, date = NOW(), author = ? WHERE id = ? AND user_id = ?";
            $params = [$title, $summary, $content, $author, $id, $this->user_id];

            return $this->executeQuery($sqlUpdate, $params, 'ssssii');
            
        }
        return false;
    }

    public function deletePagina($id) {
        $sqlDelete = "DELETE FROM documentos WHERE id = ? AND user_id = ?";
        $params = [$id, $this->user_id];

        return $this->executeQuery($sqlDelete, $params, 'ii');
    }

    public function getDocumento($id) {
        $sqlSelect = "SELECT * FROM documentos WHERE id = ? AND user_id = ?";
        $params = [$id, $this->user_id];
        
        $stmt = $this->conn->prepare($sqlSelect);
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param('ii', ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }


    private function executeQuery($sql, $params, $types) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param($types, ...$params);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>

