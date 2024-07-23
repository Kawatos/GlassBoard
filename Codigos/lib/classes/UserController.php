<?php 
class UserController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function criarNovoUsuario($dados) {
        if ($this->isPostRequest() && $this->validarDados($dados, ["primeironome", "primeirologin", "primeirasenha"])) {
            $nome = $dados["primeironome"];
            $email = $dados["primeirologin"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("E-mail inválido.");
            }
            $senha = password_hash($dados["primeirasenha"], PASSWORD_DEFAULT);

            $sqlInsert = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            $params = [$nome, $email, $senha];

            return $this->executeQuery($sqlInsert, $params, 'sss');
        }
        return false;
    }

    public function editarUsuario($dados, $user_id) {
        if ($this->validarDados($dados, ["nome", "email"])) {
            $nome = $dados["nome"];
            $email = $dados["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("E-mail inválido.");
            }

            $sqlUpdate = "UPDATE usuarios SET nome = ?, email = ?";
            $params = [$nome, $email];
            $types = 'ss';

            if (!empty($dados["senha"])) {
                $senha = password_hash($dados["senha"], PASSWORD_DEFAULT);
                $sqlUpdate .= ", senha = ?";
                $params[] = $senha;
                $types .= 's';
            }

            $sqlUpdate .= " WHERE id = ?";
            $params[] = $user_id;
            $types .= 'i';

            return $this->executeQuery($sqlUpdate, $params, $types);
        }
        return false;
    }

    public function apagarUsuario($user_id) {
        $sqlDelete = "DELETE FROM usuarios WHERE id = ?";
        $params = [$user_id];

        return $this->executeQuery($sqlDelete, $params, 'i');
    }

    public function login($email, $senha) {
        $sqlSelect = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sqlSelect);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            if (password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_name'] = $usuario['nome'];
                return $usuario;
            } else {
                echo "Senha incorreta.\n";
            }
        } else {
            echo "Usuário não encontrado.\n";
        }
        return null;
    }

    public function getUserById($user_id) {
        $sqlSelect = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sqlSelect);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param('i', $user_id);
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
            throw new Exception("Erro na preparação da consulta: " . $this->conn->error);
        }
        $stmt->bind_param($types, ...$params);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    private function validarDados($dados, $camposNecessarios) {
        foreach ($camposNecessarios as $campo) {
            if (!isset($dados[$campo]) || empty($dados[$campo])) {
                return false;
            }
        }
        return true;
    }

    private function isPostRequest() {
        return $_SERVER["REQUEST_METHOD"] === "POST";
    }
}
?>
