<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body {
            background: -webkit-linear-gradient(bottom, #2dbd6e, #a6f77b);
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px; /* Adjusted width for the form */
            margin: 0 auto; /* Center the form */
        }

        .registration-form table {
            width: 100%;
        }

        .registration-form td {
            text-align: left;
        }

        .registration-form label {
            font-size: 12px;
            display: block;
            margin-bottom: 5px;
        }

        .registration-form input[type="text"],
        .registration-form input[type="email"],
        .registration-form input[type="password"],
        .registration-form select,
        .registration-form input[type="submit"] {
            width: calc(100% - 20px); /* Adjusted width to consider padding */
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .registration-form input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        .registration-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="registration-form">
        <form action="" method="post">
            <table>
                <h2>Daftar RUTILAHU</h2>
                <tr>
                    <td><label for="nama">Nama:</label></td>
                </tr>
                <tr>
                    <td><input type="text" id="nama" name="nama" placeholder="Nama" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                </tr>
                <tr>
                    <td><input type="email" id="email" name="email" placeholder="Email" required></td>
                </tr>
                <tr>
                    <td><label for="sandi">Kata Sandi:</label></td>
                </tr>
                <tr>
                    <td><input type="password" id="sandi" name="sandi" placeholder="Kata Sandi" required></td>
                </tr>
                <tr>
                    <td><label for="grup">Bagian:</label></td>
                </tr>
                <tr>
                    <td>
                        <select id="grup" name="grup" required>
                            <option value="a">Admin</option>
                            <option value="b">Pendaftar RUTILAHU</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Simpan"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    // Check if form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Include the class definition
        class UserRegistration {
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

            // Register a new user
            public function register($name, $email, $password, $group) {
                $name = $this->conn->real_escape_string($name);
                $email = $this->conn->real_escape_string($email);
                $password_md5 = md5($this->conn->real_escape_string($password));
                $group = $this->conn->real_escape_string($group);

                $query = "INSERT INTO " . $this->table_name . " (nama, email, sandi, grup) VALUES ('$name', '$email', '$password_md5', '$group')";
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
        $name = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['sandi'];
        $group = $_POST['grup'];

        $userRegistration = new UserRegistration();
        $userRegistration->register($name, $email, $password, $group);
    }
    ?>
</body>
</html>
