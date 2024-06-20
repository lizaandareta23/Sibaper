<?php
// Kelas Database untuk mengelola koneksi ke database
class Database {
    private $host = 'localhost'; // Ganti dengan host database Anda
    private $username = 'root'; // Ganti dengan username database Anda
    private $password = ''; // Ganti dengan password database Anda
    private $dbname = 'rutilahu'; // Ganti dengan nama database Anda
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

// Kelas Penduduk untuk mengelola data penduduk
class Penduduk {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getPenduduk($no_ktp) {
        $sql = "SELECT * FROM penduduk WHERE no_ktp='{$this->db->escape_string($no_ktp)}'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }

    public function updatePenduduk($data) {
        $sql = "UPDATE penduduk SET
                nama = '{$this->db->escape_string($data['nama'])}',
                no_kk = '{$this->db->escape_string($data['no_kk'])}',
                tempatlahir = '{$this->db->escape_string($data['tempatlahir'])}',
                tanggallahir = '{$this->db->escape_string($data['tanggallahir'])}',
                jeniskelamin = '{$this->db->escape_string($data['jeniskelamin'])}',
                alamat = '{$this->db->escape_string($data['alamat'])}',
                rtrw = '{$this->db->escape_string($data['rtrw'])}',
                desa = '{$this->db->escape_string($data['desa'])}',
                kecamatan = '{$this->db->escape_string($data['kecamatan'])}',
                agama = '{$this->db->escape_string($data['agama'])}',
                statuskawin = '{$this->db->escape_string($data['statuskawin'])}',
                pekerjaan = '{$this->db->escape_string($data['pekerjaan'])}',
                kewarganegaraan = '{$this->db->escape_string($data['kewarganegaraan'])}',
                penghasilan = '{$this->db->escape_string($data['penghasilan'])}'
                WHERE no_ktp = '{$this->db->escape_string($data['no_ktp'])}'";
        return $this->db->query($sql);
    }
}

$penduduk = new Penduduk();

if (isset($_GET['no_ktp'])) {
    $no_ktp = $_GET['no_ktp'];
    $tampil = $penduduk->getPenduduk($no_ktp);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'no_ktp' => $_POST['no_ktp'],
        'nama' => $_POST['nama'],
        'no_kk' => $_POST['no_kk'],
        'tempatlahir' => $_POST['tempatlahir'],
        'tanggallahir' => $_POST['tanggallahir'],
        'jeniskelamin' => $_POST['jeniskelamin'],
        'alamat' => $_POST['alamat'],
        'rtrw' => $_POST['rtrw'],
        'desa' => $_POST['desa'],
        'kecamatan' => $_POST['kecamatan'],
        'agama' => $_POST['agama'],
        'statuskawin' => $_POST['statuskawin'],
        'pekerjaan' => $_POST['pekerjaan'],
        'kewarganegaraan' => $_POST['kewarganegaraan'],
        'penghasilan' => $_POST['penghasilan']
    ];
    $penduduk->updatePenduduk($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Penduduk</title>
    <script>
        function validasi() {
            var nomorindukktp = document.getElementById('nomor0').value;
            var nama = document.getElementById('nomor1').value;
            var nomorkk = document.getElementById('nomor9').value;
            var tempatlahir = document.getElementById('nomor2').value;
            var tanggallahir = document.getElementById('nomor3').value;
            var alamat = document.getElementById('nomor5').value;
            var rtrw = document.getElementById('nomor6').value;
            var desa = document.getElementById('nomor7').value;
            var kecamatan = document.getElementById('nomor8').value;
            var jeniskelamin = document.getElementById('nomor10').value;
            var agama = document.getElementById('nomor11').value;
            var statuskawin = document.getElementById('nomor12').value;
            var pekerjaan = document.getElementById('nomor13').value;
            var kewarganegaraan = document.getElementById('nomor14').value;
            var penghasilan = document.getElementById('nomor15').value;

            if (nomorindukktp == "") {
                alert('Nomor Induk KTP harus diisi');
                document.getElementById('nomor0').focus();
                return false;
            } else if (nomorindukktp.length != 16) {
                alert('Panjang Nomor Induk KTP harus =  16 digit');
                document.getElementById('nomor0').focus();
                return false;
            }

            if (nama == "") {
                alert('Nama harus diisi');
                document.getElementById('nomor1').focus();
                return false;
            }
            if (nomorkk == "") {
                alert('Nomor KK harus diisi');
                document.getElementById('nomor9').focus();
                return false;
            } else if (nomorkk.length != 16) {
                alert('Panjang Nomor KK harus =  16 digit');
                document.getElementById('nomor9').focus();
                return false;
            }
            if (tempatlahir == "") {
                alert('Tempat Lahir harus diisi');
                document.getElementById('nomor2').focus();
                return false;
            }
            if (tanggallahir == "") {
                alert('Tanggal Lahir harus diisi');
                document.getElementById('nomor3').focus();
                return false;
            }
            if (jeniskelamin == "") {
                alert('Jenis Kelamin harus dipilih');
                document.getElementById('nomor10').focus();
                return false;
            }
            if (alamat == "") {
                alert('Alamat harus diisi');
                document.getElementById('nomor5').focus();
                return false;
            }
            if (rtrw == "") {
                alert('RT/RW harus diisi');
                document.getElementById('nomor6').focus();
                return false;
            }
            if (desa == "") {
                alert('Kel/Desa harus diisi');
                document.getElementById('nomor7').focus();
                return false;
            }
            if (kecamatan == "") {
                alert('Kecamatan harus diisi');
                document.getElementById('nomor8').focus();
                return false;
            }
            if (agama == "") {
                alert('Agama harus diisi');
                document.getElementById('nomor11').focus();
                return false;
            }
            if (statuskawin == "") {
                alert('Status Kawin harus diisi');
                document.getElementById('nomor12').focus();
                return false;
            }
            if (pekerjaan == "") {
                alert('Pekerjaan harus diisi');
                document.getElementById('nomor13').focus();
                return false;
            }
            if (kewarganegaraan == "") {
                alert('Kewarganegaraan harus diisi');
                document.getElementById('nomor14').focus();
                return false;
            }
            if (penghasilan == "") {
                alert('Penghasilan harus diisi');
                document.getElementById('nomor15').focus();
                return false;
            }
        }
    </script>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
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
    <form action="" method="POST" onsubmit="return validasi();">
        <table>
            <h1><center>PENDUDUK</center></h1>

            <tr>
                <td>Nomor Induk KTP</td>
                <td>:</td>
                <td><input type="text" name="no_ktp" id="nomor0" value="<?php echo $tampil['no_ktp']; ?>"></td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" id="nomor1" value="<?php echo $tampil['nama']; ?>"></td>
            </tr>
    <tr>
     <td>Nomor KK</td>
     <td>:</td>
     <td><input type=text name=no_kk id=nomor9 value="<?php echo $tampil['no_kk']; ?>"></td>
    </tr>

    <tr>
     <td>Tempat Lahir</td>
     <td>:</td>
     <td><input type=text name=tempatlahir id=nomor2 value="<?php echo $tampil['tempatlahir']; ?>"></td>
    </tr>
    
    <tr>
     <td>Tanggal Lahir</td>
     <td>:</td>
     <td><input type=date name=tanggallahir id=nomor3 value="<?php echo $tampil['tanggallahir']; ?>"></td>
    </tr>

    <tr>
    <td>Jenis Kelamin</td>
    <td>:</td>
    <td><select name=jeniskelamin id=nomor10 >
    <option value="">-- Pilih -- </option>
    <option <?php if ($tampil['jeniskelamin'] == 'Perempuan') echo 'selected="selected"'; ?>> Perempuan </option>
    <option <?php if ($tampil['jeniskelamin'] == 'Laki-laki') echo 'selected="selected"'; ?>> Laki-laki </option>
    </select></td>
    </tr>

    <tr>
    <td>Alamat</td>
    <td>:</td>
    <td><textarea cols="65" rows="5" type="text" name="alamat" id="nomor5"><?php echo $tampil['alamat']; ?></textarea></td>
</tr>

    <tr>
     <td>RT/RW</td>
     <td>:</td>
     <td><input type=text name=rtrw id=nomor6 value="<?php echo $tampil['rtrw']; ?>"></td>
    </tr>

    <tr>
     <td>Kel/Desa</td>
     <td>:</td>
     <td><input type=text name=desa id=nomor7 value="<?php echo $tampil['desa']; ?>"></td>
    </tr>

    <tr>
     <td>Kecamatan</td>
     <td>:</td>
     <td><input type=text name=kecamatan id=nomor8 value="<?php echo $tampil['kecamatan']; ?>"></td>
    </tr>

    <tr>
    <td>Agama</td>
    <td>:</td>
    <td><select name=agama id=nomor11>
    <option value=>-- Pilih -- </option>
    <option <?php if ($tampil['agama'] == 'Islam') echo 'selected="selected"'; ?>> Islam </option>
    <option <?php if ($tampil['agama'] == 'Kristen Protestan') echo 'selected="selected"'; ?>> Kristen Protestan </option>
    <option <?php if ($tampil['agama'] == 'Kristen Katolik') echo 'selected="selected"'; ?>> Kristen Katolik </option>
    <option <?php if ($tampil['agama'] == 'Hindu') echo 'selected="selected"'; ?>> Hindu </option>
    <option <?php if ($tampil['agama'] == 'Buddha') echo 'selected="selected"'; ?>> Buddha </option>
    <option <?php if ($tampil['agama'] == 'Khonghucu') echo 'selected="selected"'; ?>> Khonghucu </option>
    </select></td>
    </tr>

    <tr>
    <td>Status Kawin</td>
    <td>:</td>
    <td><select name=statuskawin id=nomor12>
    <option value=>-- Pilih -- </option>
    <option <?php if ($tampil['statuskawin'] == 'Belum Kawin') echo 'selected="selected"'; ?>> Belum Kawin </option>
    <option <?php if ($tampil['statuskawin'] == 'Kawin') echo 'selected="selected"'; ?>> Kawin </option>
    <option <?php if ($tampil['statuskawin'] == 'Cerai Hidu') echo 'selected="selected"'; ?>> Cerai Hidup </option>
    <option <?php if ($tampil['statuskawin'] == 'Cerai Mati') echo 'selected="selected"'; ?>> Cerai Mati </option>
    </select></td>
    </tr>

    <tr>
    <td>Pekerjaan</td>
    <td>:</td>
    <td><select name=pekerjaan id=nomor13 >
    <option value=>-- Pilih -- </option>
    <option <?php if ($tampil['pekerjaan'] == 'PNS') echo 'selected="selected"'; ?>> PNS </option>
    <option <?php if ($tampil['pekerjaan'] == 'Karyawan') echo 'selected="selected"'; ?>> Karyawan </option>
    <option <?php if ($tampil['pekerjaan'] == 'Wiraswasta') echo 'selected="selected"'; ?>> Wiraswasta </option>
    <option <?php if ($tampil['pekerjaan'] == 'Buruh Harian Lepas') echo 'selected="selected"'; ?>>Buruh Harian Lepas</option>
    </select></td>
    </tr>

    <tr>
    <td>Kewarganegaraan</td>
    <td>:</td>
    <td><select name=kewarganegaraan id=nomor14>
    <option value=>-- Pilih -- </option>
    <option <?php if ($tampil['kewarganegaraan'] == 'WNI') echo 'selected="selected"'; ?>> WNI </option>
    </select></td>

    <tr>
    <td>Penghasilan</td>
    <td>:</td>
    <td><select name=penghasilan id=nomor15>
    <option value=>-- Pilih -- </option>
    <option  <?php if ($tampil['penghasilan'] == 'Rp1.000.000 - Rp2.000.000') echo 'selected="selected"'; ?>> Rp1.000.000 - Rp2.000.000 </option>
    <option  <?php if ($tampil['penghasilan'] == 'Rp3.000.000 - Rp4.000.000') echo 'selected="selected"'; ?>> Rp3.000.000 - Rp4.000.000 </option>
    <option  <?php if ($tampil['penghasilan'] == 'Rp5.000.000 - Rp6.000.000') echo 'selected="selected"'; ?>> Rp5.000.000 - Rp6.000.000 </option> 
    </select> / Bulan</td>
    </tr>

    <tr>
     <td colspan=3>
      <input type=submit value=Simpan name=ubah>
      <input type=reset value=Hapus>
      <a href=lihat_penduduk.php.?tcari=>
     <input type=button value=Lihat>
     </td>
    </tr>
   </table>
   </form>
   <footer class="copy">
        <h4><center>&copy; 2023 RUTILAHU - Dinas Perumahan Rakyat dan Kawasan Pemukiman</center></h4>
    </footer>


<?php


// Memproses permintaan untuk mengambil data penduduk berdasarkan no_ktp
if (isset($_GET['no_ktp'])) {
    $no_ktp = $_GET['no_ktp'];
    $tampil = $penduduk->getPenduduk($no_ktp);
}

// Memproses perubahan data jika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ubah'])) {
    $data = [
        'no_ktp' => $_POST['no_ktp'],
        'nama' => $_POST['nama'],
        'no_kk' => $_POST['no_kk'],
        'tempatlahir' => $_POST['tempatlahir'],
        'tanggallahir' => $_POST['tanggallahir'],
        'jeniskelamin' => $_POST['jeniskelamin'],
        'alamat' => $_POST['alamat'],
        'rtrw' => $_POST['rtrw'],
        'desa' => $_POST['desa'],
        'kecamatan' => $_POST['kecamatan'],
        'agama' => $_POST['agama'],
        'statuskawin' => $_POST['statuskawin'],
        'pekerjaan' => $_POST['pekerjaan'],
        'kewarganegaraan' => $_POST['kewarganegaraan'],
        'penghasilan' => $_POST['penghasilan']
    ];
    $penduduk->updatePenduduk($data);
    echo "<script>alert('Data Berhasil diubah'); document.location='lihat_penduduk.php?tcari='</script>";
}
?>
