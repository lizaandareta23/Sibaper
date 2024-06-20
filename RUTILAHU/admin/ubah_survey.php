<?php
// Include koneksi dan mendefinisikan kelas Penduduk
include "../lib/koneksi.php";

// Kelas untuk mengelola tim survey
class TimSurvey {
    private $koneksi;

    public function __construct($db) {
        $this->koneksi = $db;
    }

    public function getSurveyById($id_pegawai) {
        $sql = mysqli_query($this->koneksi, "SELECT * FROM tim_survey WHERE id_pegawai='$id_pegawai'");
        return mysqli_fetch_array($sql);
    }

    public function updateSurvey($data) {
        $sql = "UPDATE tim_survey SET
                id_pegawai = '{$data['id_pegawai']}',
                nama = '{$data['nama']}',
                jabatan = '{$data['jabatan']}',
                tanggal = '{$data['tanggal']}',
                kecamatan = '{$data['kecamatan']}'
                WHERE id_pegawai = '{$data['id_pegawai']}'";
        return mysqli_query($this->koneksi, $sql);
    }
}

// Inisialisasi objek TimSurvey dengan koneksi yang telah dibuat sebelumnya
$survey = new TimSurvey($koneksi);

// Memproses permintaan untuk mengambil data tim survey berdasarkan ID
if (isset($_GET['id_pegawai'])) {
    $id_pegawai = $_GET['id_pegawai'];
    $tampil = $survey->getSurveyById($id_pegawai);
}

// Memproses perubahan data jika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ubah'])) {
    $data = [
        'id_pegawai' => $_POST['id_pegawai'],
        'nama' => $_POST['nama'],
        'jabatan' => $_POST['jabatan'],
        'tanggal' => $_POST['tanggal'],
        'kecamatan' => $_POST['kecamatan']
    ];
    $survey->updateSurvey($data);
    echo "<script>alert('Data Berhasil diubah'); document.location='lihat_survey.php?tcari='</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Ubah Survey</title>
    <script>
        function validasi() {
            var id_pegawai = document.getElementById('nomer1').value;
            var nama = document.getElementById('nomer2').value;
            var jabatan = document.getElementById('nomer3').value;
            var tanggal = document.getElementById('nomer4').value;
            var kecamatan = document.getElementById('nomer5').value;

            if (id_pegawai == "") {
                alert('ID Harus Diisi');
                document.getElementById('nomer1').focus();
                return false;
            }

            if (nama == ""){
                alert('Nama Harus Diisi');
                document.getElementById('nomer2').focus();
                return false;
            }

            if (jabatan == ""){
                alert('Jabatan Harus Diisi');
                document.getElementById('nomer3').focus();
                return false;
            }

            if (tanggal == ""){
                alert('Tanggal Harus Diisi');
                document.getElementById('nomer4').focus();
                return false;
            }

            if (kecamatan == ""){
                alert('Kecamatan Harus Diisi');
                document.getElementById('nomer5').focus();
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
            <h1><center>TIM SURVEY</center></h1>

            <tr>
                <td>ID</td>
                <td>:</td>
                <td><input type="text" name="id_pegawai" id="nomer1" size="30" value="<?php echo $tampil['id_pegawai']; ?>"></td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" id="nomer2" size="30" value="<?php echo $tampil['nama']; ?>"></td>
            </tr>

            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><input type="text" name="jabatan" id="nomer3" size="30" value="<?php echo $tampil['jabatan']; ?>"></td>
            </tr>

            <tr>
                <td>Tanggal Survey</td>
                <td>:</td>
                <td><input type="date" name="tanggal" id="nomer4" size="30" value="<?php echo $tampil['tanggal']; ?>"></td>
            </tr>

            <tr>
                <td>Tujuan</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><input type="text" name="kecamatan" id="nomer5" size="30" value="<?php echo $tampil['kecamatan']; ?>"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Simpan" name="ubah">
                    <input type="reset" value="Hapus">
                    <a href="lihat_survey.php?tcari="><input type="button" value="Lihat"></a>
                </td>
            </tr>
        </table>
    </form>
    <footer class="copy">
        <h4><center>&copy; 2023 RUTILAHU - Dinas Perumahan Rakyat dan Kawasan Pemukiman</center></h4>
    </footer>
</body>
</html>
