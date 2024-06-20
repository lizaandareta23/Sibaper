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

    public function close() {
        $this->connection->close();
    }
}

class Rutilahu {
    private $db;
    private $no_ktp;
    private $status_tanah;
    private $titik_koordinat;
    private $luas_tanah_p;
    private $luas_tanah_l;
    private $tipe_bangunan;
    private $jenis_bantuan;
    private $kesimpulan;

    public function __construct($db, $data) {
        $this->db = $db;
        $this->no_ktp = $data['no_ktp'];
        $this->status_tanah = $data['status_tanah'];
        $this->titik_koordinat = $data['titik_koordinat'];
        $this->luas_tanah_p = $data['luas_tanah_p'];
        $this->luas_tanah_l = $data['luas_tanah_l'];
        $this->tipe_bangunan = $data['tipe_bangunan'];
        $this->jenis_bantuan = $data['jenis_bantuan'];
        $this->kesimpulan = $data['kesimpulan'];
    }

    public function isDuplicate() {
        $query = "SELECT * FROM rutilahu WHERE no_ktp = '" . $this->db->escape_string($this->no_ktp) . "'";
        $result = $this->db->query($query);
        return $this->db->num_rows($result) > 0;
    }

    public function save() {
        $query = "INSERT INTO rutilahu 
                  (no_ktp, status_tanah, titik_koordinat, luas_tanah_p, luas_tanah_l, tipe_bangunan, jenis_bantuan, kesimpulan) 
                  VALUES (
                      '" . $this->db->escape_string($this->no_ktp) . "',
                      '" . $this->db->escape_string($this->status_tanah) . "',
                      '" . $this->db->escape_string($this->titik_koordinat) . "',
                      '" . $this->db->escape_string($this->luas_tanah_p) . "',
                      '" . $this->db->escape_string($this->luas_tanah_l) . "',
                      '" . $this->db->escape_string($this->tipe_bangunan) . "',
                      '" . $this->db->escape_string($this->jenis_bantuan) . "',
                      '" . $this->db->escape_string($this->kesimpulan) . "'
                  )";
        return $this->db->query($query);
    }
}

// Initialize database connection
$db = new Database('localhost', 'root', '', 'rutilahu');

// Get POST data
$data = [
    'no_ktp' => $_POST['no_ktp'],
    'status_tanah' => $_POST['status_tanah'],
    'titik_koordinat' => $_POST['titik_koordinat'],
    'luas_tanah_p' => $_POST['luas_tanah_p'],
    'luas_tanah_l' => $_POST['luas_tanah_l'],
    'tipe_bangunan' => $_POST['tipe_bangunan'],
    'jenis_bantuan' => $_POST['jenis_bantuan'],
    'kesimpulan' => $_POST['kesimpulan']
];

// Create Rutilahu object
$rutilahu = new Rutilahu($db, $data);

if ($rutilahu->isDuplicate()) {
    echo "<script>
            alert('Data sudah ada');
            window.location = 'rutilahu.php?a=" . $data['no_ktp'] . "&b=" . $data['status_tanah'] . "&c=" . $data['titik_koordinat'] . "&d=" . $data['luas_tanah_p'] . "&e=" . $data['luas_tanah_l'] . "&f=" . $data['jenis_bantuan'] . "&g=" . $data['kesimpulan'] . "';
          </script>";
} else {
    if ($rutilahu->save()) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location = 'rutilahu.php';
              </script>";
    }
}

$db->close();
?>
