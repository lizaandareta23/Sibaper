<?php
session_start();

class registrasi {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $this->connectDatabase();
    }

    // Database connection
    private function connectDatabase() {
        $host = "localhost";
        $db_name = "rutilahu";
        $username = "root";
        $password = "";

        $this->conn = new mysqli($host, $username, $password, $db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // User registration
    public function register($name, $email, $password, $group) {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        $password_md5 = md5($this->conn->real_escape_string($password));
        $group = $this->conn->real_escape_string($group);

        $query = "INSERT INTO " . $this->table_name . " SET nama='$name', email='$email', sandi='$password_md5', grup='$group'";
        $result = $this->conn->query($query);

        if ($result) {
            echo "<script>
                alert('Registrasi berhasil');
                window.location = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Registrasi gagal');
                window.location = 'tambah_user.php';
            </script>";
        }
    }
}

// Usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app = new registrasi();
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['sandi'];
    $group = $_POST['grup'];
    $app->register($name, $email, $password, $group);
}
?>
