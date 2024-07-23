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
            $sqlInsert = "INSERT INTO documentos (date, title, summary, content, author, user_id) VALUES (NOW(), ?, ?, ?, ?, ?)";
            $params = [$dados["title"], $dados["summary"], $dados["content"], $dados["author"], $this->user_id];

            return $this->executeQuery($sqlInsert, $params, 'ssssi');
        }
        return false;
    }

    public function editarPagina($dados) {
        if ($this->validarDados($dados, ["id", "title", "summary", "content", "author"])) {
            $sqlUpdate = "UPDATE documentos SET title = ?, summary = ?, content = ?, date = NOW(), author = ? WHERE id = ? AND user_id = ?";
            $params = [$dados["title"], $dados["summary"], $dados["content"], $dados["author"], $dados["id"], $this->user_id];

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

        return $this->executeSelectQuery($sqlSelect, $params, 'ii');
    }

    private function executeQuery($sql, $params, $types) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param($types, ...$params);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    private function executeSelectQuery($sql, $params, $types) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
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