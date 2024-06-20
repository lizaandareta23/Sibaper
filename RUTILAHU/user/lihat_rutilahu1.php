<head>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }

        .data {
            background-color: #a6f77b;
        }

        .ganjil {
            background-color: #fff;
        }

        .genap {
            background-color: #f0ffe8;
        }

        .genap:hover,
        .ganjil:hover {
            background-color: #2dbd6e;
        }

        .kanan {
            margin-left: 300px;
        }

        input[type="button"],
        input[type="submit"] {
            background-color: #2dbd6e;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-left: 5px;
        }

        input[type="button"]:hover,
        input[type="submit"]:hover {
            background-color: #a6f77b;
        }
    </style>
</head>

<?php
class Database {
    private $connection;

    public function __construct($host, $username, $password, $dbname) {
        $this->connection = new mysqli($host, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function escape_string($string) {
        return $this->connection->real_escape_string($string);
    }

    public function num_rows($result) {
        return $result->num_rows;
    }

    public function fetch_assoc($result) {
        return $result->fetch_assoc();
    }

    public function close() {
        $this->connection->close();
    }
}

class Rutilahu {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRecords($kode_cari) {
        if (empty($kode_cari)) {
            $query = "SELECT * FROM rutilahu";
        } else {
            $query = "SELECT * FROM rutilahu WHERE no_ktp LIKE '%" . $this->db->escape_string($kode_cari) . "%'";
        }
        return $this->db->query($query);
    }

    public function deleteRecord($no_ktp) {
        $query = "DELETE FROM rutilahu WHERE no_ktp='" . $this->db->escape_string($no_ktp) . "'";
        return $this->db->query($query);
    }

    public function displayRecords($records) {
        $num_rows = $this->db->num_rows($records);
        echo "<a href=rutilahu.php><input type=button value=Kembali></a>";
        echo "<form action=lihat_rutilahu1.php method=get>
                <h1 style='text-align: center;'>DATA PENDAFTAR RUTILAHU</h1>
                <div class=kanan>
                    <input type=text name=tcari placeholder=nama>
                    <input type=submit value=Cari>
                </div>
            </form>";

        echo "<table border=1 class=kanan>
                <tr class=data>
                    <td>NO</td>
                    <td>No KTP</td>
                    <td>Status Tanah</td>
                    <td>Titik Koordinat</td>
                    <td>Luas Tanah P</td>
                    <td>Luas Tanah L</td>
                    <td>Tipe Bangunan</td>
                    <td>Jenis Bantuan</td>
                    <td>Kesimpulan</td>
                    <td colspan=2>Proses</td>
                </tr>";

        for ($k = 1; $k <= $num_rows; $k++) {
            $data = $this->db->fetch_assoc($records);
            $class = ($k % 2 == 1) ? 'ganjil' : 'genap';
            echo "<tr class=$class>
                    <td>$k</td>
                    <td>" . $data['no_ktp'] . "</td>
                    <td>" . $data['status_tanah'] . "</td>
                    <td>" . $data['titik_koordinat'] . "</td>
                    <td>" . $data['luas_tanah_p'] . "</td>
                    <td>" . $data['luas_tanah_l'] . "</td>
                    <td>" . $data['tipe_bangunan'] . "</td>
                    <td>" . $data['jenis_bantuan'] . "</td>
                    <td>" . $data['kesimpulan'] . "</td>
                </tr>";
        }
        echo "</table></center>";
    }
}

// Initialize database connection
$db = new Database('localhost', 'root', '', 'rutilahu');
$rutilahu = new Rutilahu($db);

$kode_cari = isset($_GET['tcari']) ? $_GET['tcari'] : '';
$records = $rutilahu->getRecords($kode_cari);
$rutilahu->displayRecords($records);

if (isset($_GET['id'])) {
    $no_ktp = $_GET['id'];
    if ($rutilahu->deleteRecord($no_ktp)) {
        echo "<script>alert('Data berhasil dihapus'); document.location='lihat_rutilahu.php?tcari='</script>";
    }
}

$db->close();
?>
