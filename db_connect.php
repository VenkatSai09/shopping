<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'shopping';
    private $username = 'root';  // Change as needed
    private $password = '';      // Change as needed
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
