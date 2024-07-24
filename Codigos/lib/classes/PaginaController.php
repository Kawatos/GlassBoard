<?php 

class PaginaController {
    private $conn;
    private $user_id;

    public function __construct($conn, $user_id) {
        $this->conn = $conn;
        $this->user_id = $user_id;
    }

    public function criarNovaPagina($dados) {
        if ($this->validarDados($dados, ["title", "summary", "content", "author"])) {
            $sqlInsert = "INSERT INTO documentos (date, title, summary, content, author, user_id) VALUES (NOW(), :title, :summary, :content, :author, :user_id)";
            $params = [
                ':title' => $dados["title"],
                ':summary' => $dados["summary"],
                ':content' => $dados["content"],
                ':author' => $dados["author"],
                ':user_id' => $this->user_id
            ];

            return $this->executeQuery($sqlInsert, $params);
        }
        return false;
    }

    public function editarPagina($dados) {
        if ($this->validarDados($dados, ["id", "title", "summary", "content", "author"])) {
            $sqlUpdate = "UPDATE documentos SET title = :title, summary = :summary, content = :content, date = NOW(), author = :author WHERE id = :id AND user_id = :user_id";
            $params = [
                ':title' => $dados["title"],
                ':summary' => $dados["summary"],
                ':content' => $dados["content"],
                ':author' => $dados["author"],
                ':id' => $dados["id"],
                ':user_id' => $this->user_id
            ];

            return $this->executeQuery($sqlUpdate, $params);
        }
        return false;
    }

    public function deletePagina($id) {
        $sqlDelete = "DELETE FROM documentos WHERE id = :id AND user_id = :user_id";
        $params = [
            ':id' => $id,
            ':user_id' => $this->user_id
        ];

        return $this->executeQuery($sqlDelete, $params);
    }

    public function getDocumento($id) {
        $sqlSelect = "SELECT * FROM documentos WHERE id = :id AND user_id = :user_id";
        $params = [
            ':id' => $id,
            ':user_id' => $this->user_id
        ];

        return $this->executeSelectQuery($sqlSelect, $params);
    }

    private function executeQuery($sql, $params) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . implode(" ", $this->conn->errorInfo()));
        }
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();  // Use closeCursor() instead of close()
        return $result;
    }

    private function executeSelectQuery($sql, $params) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . implode(" ", $this->conn->errorInfo()));
        }
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Use fetchAll() to get all results
        $stmt->closeCursor();  // Use closeCursor() instead of close()

        if (count($result) > 0) {
            return $result[0];  // Return the first result
        } else {
            return null;
        }
    }

    private function validarDados($dados, $camposNecessarios) {
        foreach ($camposNecessarios as $campo) {
            if (!isset($dados[$campo]) || empty($dados[$campo])) {
                return false;
            }
        }
        return true;
    }
}
?>
