<?php 
class UserController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function criarNovoUsuario($dados) {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($dados["primeironome"]) && isset($dados["primeirologin"]) && isset($dados["primeirasenha"])) {
            $nome = $dados["primeironome"];
            $email = $dados["primeirologin"];
            $senha = $dados["primeirasenha"];

            $sqlInsert = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            $params = [$nome, $email, $senha];

            return $this->executeQuery($sqlInsert, $params, 'sss');
        }
        return false;
    }

    public function editarUsuario($dados, $user_id) {
        if (isset($dados["update-perfil"])) {
            $nome = $dados["nome"];
            $email = $dados["email"];
            $senha = $dados["senha"];

            $sqlUpdate = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $params = [$nome, $email, $senha, $user_id];

            return $this->executeQuery($sqlUpdate, $params, 'sssi');
        }
        return false;
    }

    public function apagarUsuario($user_id) {
        $sqlDelete = "DELETE FROM usuarios WHERE id = ?";
        $params = [$user_id];

        return $this->executeQuery($sqlDelete, $params, 'i');
    }

    public function login($email, $senha) {
        $sqlSelect = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $this->conn->prepare($sqlSelect);
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param('ss', $email, $senha);
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
