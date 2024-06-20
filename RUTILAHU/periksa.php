<?php
class login {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $this->startSession();
        $this->connectDatabase();
    }

    // Start the session
    private function startSession() {
        session_start();
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

    // User authentication
    public function authenticate($email, $password) {
        $email = $this->conn->real_escape_string($email);
        $password = md5($this->conn->real_escape_string($password));

        $query = "SELECT * FROM " . $this->table_name . " WHERE email = '$email'";
        $result = $this->conn->query($query);

        if ($result->num_rows == 0) {
            echo "<script>
                alert('Email belum terdaftar');
                window.location = 'index.php';
            </script>";
            exit;
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE email = '$email' AND sandi = '$password'";
            $result = $this->conn->query($query);

            if ($result->num_rows == 0) {
                echo "<script>
                    alert('Kata sandi salah');
                    window.location = 'index.php';
                </script>";
                exit;
            } else {
                $data = $result->fetch_assoc();
                $this->createSession($data);

                if ($data['grup'] == 'a') {
                    header("Location: admin/index.php");
                } else if ($data['grup'] == 'b') {
                    header("Location: user/index.php");
                }
            }
        }
    }

    // Create session
    private function createSession($data) {
        $_SESSION['sandi'] = $data['sandi'];
        $_SESSION['nama'] = $data['nama'];
    }
}

// Usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app = new login();
    $email = $_POST['email'];
    $password = $_POST['sandi'];
    $app->authenticate($email, $password);
}
?>
