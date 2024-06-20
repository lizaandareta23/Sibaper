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
            width: 300px;
            margin: 0 auto;
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
            width: calc(100% - 20px);
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
        class Database {
            private $host = "localhost";
            private $db_name = "rutilahu";
            private $username = "root";
            private $password = "";
            public $conn;

            public function getConnection() {
                $this->conn = null;
                try {
                    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
                    if ($this->conn->connect_error) {
                        throw new Exception("Connection failed: " . $this->conn->connect_error);
                    }
                } catch (Exception $e) {
                    die("Connection error: " . $e->getMessage());
                }
                return $this->conn;
            }
        }

        class Penduduk {
            private $conn;
            private $table_name = "penduduk";

            public $no_ktp;
            public $nama;
            public $no_kk;
            public $tempatlahir;
            public $tanggallahir;
            public $jeniskelamin;
            public $alamat;
            public $rtrw;
            public $desa;
            public $kecamatan;
            public $agama;
            public $statuskawin;
            public $pekerjaan;
            public $kewarganegaraan;
            public $penghasilan;

            public function __construct($db) {
                $this->conn = $db;
            }

            public function isDuplicate() {
                $query = "SELECT * FROM " . $this->table_name . " WHERE no_ktp = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("s", $this->no_ktp);
                $stmt->execute();
                $stmt->store_result();
                return $stmt->num_rows > 0;
            }

            public function create() {
                $query = "INSERT INTO " . $this->table_name . " SET 
                    no_ktp = ?, 
                    nama = ?, 
                    no_kk = ?, 
                    tempatlahir = ?, 
                    tanggallahir = ?, 
                    jeniskelamin = ?, 
                    alamat = ?, 
                    rtrw = ?, 
                    desa = ?, 
                    kecamatan = ?, 
                    agama = ?, 
                    statuskawin = ?, 
                    pekerjaan = ?, 
                    kewarganegaraan = ?, 
                    penghasilan = ?";

                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sssssssssssssss", 
                    $this->no_ktp, 
                    $this->nama, 
                    $this->no_kk, 
                    $this->tempatlahir, 
                    $this->tanggallahir, 
                    $this->jeniskelamin, 
                    $this->alamat, 
                    $this->rtrw, 
                    $this->desa, 
                    $this->kecamatan, 
                    $this->agama, 
                    $this->statuskawin, 
                    $this->pekerjaan, 
                    $this->kewarganegaraan, 
                    $this->penghasilan
                );

                return $stmt->execute();
            }
        }

        $database = new Database();
        $db = $database->getConnection();

        $penduduk = new Penduduk($db);

        $penduduk->no_ktp = $_POST['no_ktp'];
        $penduduk->nama = $_POST['nama'];
        $penduduk->no_kk = $_POST['no_kk'];
        $penduduk->tempatlahir = $_POST['tempatlahir'];
        $penduduk->tanggallahir = $_POST['tanggallahir'];
        $penduduk->jeniskelamin = $_POST['jeniskelamin'];
        $penduduk->alamat = $_POST['alamat'];
        $penduduk->rtrw = $_POST['rtrw'];
        $penduduk->desa = $_POST['desa'];
        $penduduk->kecamatan = $_POST['kecamatan'];
        $penduduk->agama = $_POST['agama'];
        $penduduk->statuskawin = $_POST['statuskawin'];
        $penduduk->pekerjaan = $_POST['pekerjaan'];
        $penduduk->kewarganegaraan = $_POST['kewarganegaraan'];
        $penduduk->penghasilan = $_POST['penghasilan'];

        if ($penduduk->isDuplicate()) {
            echo "
                <script>
                    alert('Data sudah ada');
                    window.location = 'penduduk.php?a={$penduduk->no_ktp}&b={$penduduk->nama}&c={$penduduk->no_kk}&d={$penduduk->tempatlahir}&e={$penduduk->tanggallahir}&f={$penduduk->jeniskelamin}&g={$penduduk->alamat}&h={$penduduk->rtrw}&i={$penduduk->desa}&j={$penduduk->kecamatan}&k={$penduduk->agama}&l={$penduduk->statuskawin}&m={$penduduk->pekerjaan}&n={$penduduk->kewarganegaraan}&o={$penduduk->penghasilan}';
                </script>
            ";
        } else {
            if ($penduduk->create()) {
                echo "
                    <script>
                        alert('Data berhasil ditambahkan selanjutnya mengisi data rutilahu');
                        window.location = 'rutilahu.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Data gagal ditambahkan');
                        window.location = 'penduduk.php';
                    </script>
                ";
            }
        }
    }
    ?>
</body>
</html>
