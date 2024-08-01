<?php
class DatabaseController {
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;
    public $conn;

    public function __construct() {
        $config = include('config.php');
        $this->dbHost = $config['dbHost'];
        $this->dbUser = $config['dbUser'];
        $this->dbPass = $config['dbPass'];
        $this->dbName = $config['dbName'];
        $this->connect();
    }

    private function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>
