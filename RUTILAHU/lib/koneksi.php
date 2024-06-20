<?php
class Database {
    private static $instance = null;
    private $connection;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'rutilahu';

    private function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Koneksi database gagal: " . $this->connection->connect_error);
        }
    }

    public static function Koneksi() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance->connection;
    }
}

// Usage example
$koneksi = Database::Koneksi();
?>
