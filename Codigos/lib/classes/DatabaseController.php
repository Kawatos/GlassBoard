<?php 
class DatabaseController {
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;
    public $conn;
    public function __construct() {
        $this->dbHost = "localhost";
        $this->dbUser = "root";
        $this->dbPass = "";
        $this->dbName = "glassboard";
        $this->conn = $this->connect();
    }
    private function connect() {


        $conn = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);

        if (!$conn) {
            die("Erro na hora de conectar");
        }

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        return $conn;
    }


}
?>