<?php
class Database {
    private $host = 'localhost'; // ganti dengan host database Anda
    private $username = 'root'; // ganti dengan username database Anda
    private $password = ''; // ganti dengan password database Anda
    private $dbname = 'rutilahu'; // ganti dengan nama database Anda
    public $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
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

    public function close() {
        $this->connection->close();
    }
}

class Rutilahu {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRutilahuByNoKTP($no_ktp) {
        $no_ktp = $this->db->escape_string($no_ktp);
        $result = $this->db->query("SELECT * FROM rutilahu WHERE no_ktp='$no_ktp'");
        return $result->fetch_assoc();
    }

    public function updateRutilahu($no_ktp, $status_tanah, $titik_koordinat, $luas_tanah_p, $luas_tanah_l, $tipe_bangunan, $jenis_bantuan, $kesimpulan) {
        $no_ktp = $this->db->escape_string($no_ktp);
        $status_tanah = $this->db->escape_string($status_tanah);
        $titik_koordinat = $this->db->escape_string($titik_koordinat);
        $luas_tanah_p = $this->db->escape_string($luas_tanah_p);
        $luas_tanah_l = $this->db->escape_string($luas_tanah_l);
        $tipe_bangunan = $this->db->escape_string($tipe_bangunan);
        $jenis_bantuan = $this->db->escape_string($jenis_bantuan);
        $kesimpulan = $this->db->escape_string($kesimpulan);

        $sql = "UPDATE rutilahu SET
                status_tanah = '$status_tanah',
                titik_koordinat = '$titik_koordinat',
                luas_tanah_p = '$luas_tanah_p',
                luas_tanah_l = '$luas_tanah_l',
                tipe_bangunan = '$tipe_bangunan',
                jenis_bantuan = '$jenis_bantuan',
                kesimpulan = '$kesimpulan'
                WHERE no_ktp = '$no_ktp'";

        return $this->db->query($sql);
    }
}

// Main Script
include "../lib/koneksi.php"; // Adjust this path as per your file structure

$db = new Database();
$rutilahu = new Rutilahu($db);

if(isset($_GET['no_ktp'])) {
    $no_ktp = $_GET['no_ktp'];
    $tampil = $rutilahu->getRutilahuByNoKTP($no_ktp);
}

if(isset($_POST['proses'])) {
    $no_ktp = $_POST['no_ktp'];
    $status_tanah = $_POST['status_tanah'];
    $titik_koordinat = $_POST['titik_koordinat'];
    $luas_tanah_p = $_POST['luas_tanah_p'];
    $luas_tanah_l = $_POST['luas_tanah_l'];
    $tipe_bangunan = $_POST['tipe_bangunan'];
    $jenis_bantuan = $_POST['jenis_bantuan'];
    $kesimpulan = $_POST['kesimpulan'];

    $result = $rutilahu->updateRutilahu($no_ktp, $status_tanah, $titik_koordinat, $luas_tanah_p, $luas_tanah_l, $tipe_bangunan, $jenis_bantuan, $kesimpulan);
    
    if($result) {
        echo "<script>alert('Data Berhasil diubah'); window.location='lihat_rutilahu.php?tcari=';</script>";
    } else {
        echo "<script>alert('Gagal mengubah data');</script>";
    }
}
?>

<script>
function validasi() {
    var no_ktp = document.getElementById('nomor1').value;
    var status_tanah = document.getElementById('nomor2').value;
    var titik_koordinat = document.getElementById('nomor3').value;
    var luas_tanah_p = document.getElementById('nomor4a').value;
    var luas_tanah_l = document.getElementById('nomor4b').value;
    var tipe_bangunan = document.getElementById('nomor5').value;
    var jenis_bantuan = document.getElementById('nomor6').value;
    var kesimpulan = document.getElementById('nomor7').value;

    if (no_ktp == "") {
        alert('no ktp harus diisi');
        document.getElementById('nomor1').focus();
        return false;
    }
    if (status_tanah == "") {
        alert('status tanah harus diisi');
        document.getElementById('nomor2').focus();
        return false;
    }
    if (titik_koordinat == "") {
        alert('titik koordinat harus diisi');
        document.getElementById('nomor3').focus();
        return false;
    }
    if (luas_tanah_p == "" || luas_tanah_l == "") {
        alert('Luas Tanah harus diisi');
        document.getElementById('nomor4a').focus();
        return false;
    }
    if (tipe_bangunan == "") {
        alert('tipe bangunan harus diisi');
        document.getElementById('nomor5').focus();
        return false;
    }
    if (jenis_bantuan == "") {
        alert('jenis bantuan harus diisi');
        document.getElementById('nomor6').focus();
        return false;
    }
    if (kesimpulan == "") {
        alert('kesimpulan harus diisi');
        document.getElementById('nomor7').focus();
        return false;
    }
    return true;
}
</script>

<link rel="stylesheet" type="text/css" href="styles2.css">
<div class="container">
    <div class="gambar">
        <img src="karawang.png" alt="" width="150" height="100">
    </div>
    <div class="text">
        <h3>PEMERINTAH</h3>
        <h1>KABUPATEN KARAWANG</h1>
        <h3>JAWABARAT</h3>
    </div>
</div>

<form action="" method="post" onsubmit="return validasi();">
    <h1><center>RUTILAHU</center></h1>
    <table>
        <tr>
            <td>no ktp</td>
            <td>:</td>
            <td><input type="text" name="no_ktp" id="nomor1" value="<?php echo htmlspecialchars($tampil['no_ktp']); ?>"></td>
        </tr>
        <tr>
            <td>status tanah</td>
            <td>:</td>
            <td>
                <select name="status_tanah" id="nomor2">
                    <option value="">----pilih---</option>
                    <option <?php if ($tampil['status_tanah'] == 'Tanah pengairan') echo 'selected="selected"'; ?>>Tanah pengairan</option>
                    <option <?php if ($tampil['status_tanah'] == 'Tanah Hutan') echo 'selected="selected"'; ?>>Tanah Hutan</option>
                    <option <?php if ($tampil['status_tanah'] == 'Tanah Jalan Tol') echo 'selected="selected"'; ?>>Tanah Jalan Tol</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>titik koordinat</td>
            <td>:</td>
            <td><input type="text" size="10" name="titik_koordinat" id="nomor3" value="<?php echo htmlspecialchars($tampil['titik_koordinat']); ?>"></td>
        </tr>
        <tr>
            <td>luas tanah</td>
            <td>:</td>
            <td>
                P <input type="text" size="10" name="luas_tanah_p" id="nomor4a" value="<?php echo htmlspecialchars($tampil['luas_tanah_p']); ?>">
                L <input type="text" size="10" name="luas_tanas_tanah_l" id="nomor4b" value="<?php echo htmlspecialchars($tampil['luas_tanah_l']); ?>">
            </td>
        </tr>
        <tr>
            <td>tipe bangunan</td>
            <td>:</td>
            <td>
                <select name="tipe_bangunan" id="nomor5">
                    <option value="">----pilih---</option>
                    <option <?php if ($tampil['tipe_bangunan'] == 'Permanen') echo 'selected="selected"'; ?>>Permanen</option>
                    <option <?php if ($tampil['tipe_bangunan'] == 'Non Permanen') echo 'selected="selected"'; ?>>Non Permanen</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>jenis bantuan</td>
            <td>:</td>
            <td>
                <select name="jenis_bantuan" id="nomor6">
                    <option value="">----pilih---</option>
                    <option <?php if ($tampil['jenis_bantuan'] == 'Subsidi') echo 'selected="selected"'; ?>>Subsidi</option>
                    <option <?php if ($tampil['jenis_bantuan'] == 'Komersial') echo 'selected="selected"'; ?>>Komersial</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>kesimpulan</td>
            <td>:</td>
            <td><input type="text" size="20" name="kesimpulan" id="nomor7" value="<?php echo htmlspecialchars($tampil['kesimpulan']); ?>"></td>
        </tr>
        <tr>
            <td colspan=3>
                <input type="submit" name="proses" value="Simpan">
                <input type="reset" name="Reset" value="Hapus">
                <a href="lihat_rutilahu.php?tcari="><input type="button" value="Lihat"></a>
            </td>
        </tr>
    </table>
</form>

