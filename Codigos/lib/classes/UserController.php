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
            
            // Depuração: Verifique o valor do e-mail
            if (empty($email)) {
                throw new Exception("E-mail está vazio.");
            }
            var_dump($email);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("E-mail inválido: " . $email);
            }
            
            $senha = password_hash($dados["primeirasenha"], PASSWORD_DEFAULT);

            $sqlInsert = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->conn->prepare($sqlInsert);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            
            return $stmt->execute();
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

            $sqlUpdate = "UPDATE usuarios SET nome = :nome, email = :email";
            $params = ['nome' => $nome, 'email' => $email];

            if (!empty($dados["senha"])) {
                $senha = password_hash($dados["senha"], PASSWORD_DEFAULT);
                $sqlUpdate .= ", senha = :senha";
                $params['senha'] = $senha;
            }

            $sqlUpdate .= " WHERE id = :id";
            $params['id'] = $user_id;

            $stmt = $this->conn->prepare($sqlUpdate);
            
            return $stmt->execute($params);
        }
        return false;
    }

    public function apagarUsuario($user_id) {
        $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sqlDelete);
        $stmt->bindParam(':id', $user_id);

        return $stmt->execute();
    }

    public function login($email, $senha) {
        $sqlSelect = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($sqlSelect);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->errorInfo()[2]);
        }
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
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
        $sqlSelect = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sqlSelect);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->errorInfo()[2]);
        }
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function executeQuery($sql, $params) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Erro na preparação da consulta: " . $this->conn->errorInfo()[2]);
        }
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value);
        }
        return $stmt->execute();
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
