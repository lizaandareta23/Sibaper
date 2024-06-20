<!DOCTYPE html>
<html>
<head>
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

<h1><center>TIM SURVEY</center></h1>
<div class="underline-title"></div>

<form action="" method="post" onsubmit="return validasi();">
    <table>
        <tr>
            <td>ID Pegawai</td>
            <td>:</td>
            <td><input type="text" name="id_pegawai" id="nomer1" size="30"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" id="nomer2" size="30"></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><input type="text" name="jabatan" id="nomer3" size="30"></td>
        </tr>
        <tr>
            <td>Tanggal Survey</td>
            <td>:</td>
            <td><input type="date" name="tanggal" id="nomer4" size="30"></td>
        </tr>
        <tr>
            <td>Desa/Kelurahan</td>
            <td>:</td>
            <td><input type="text" name="desa" id="nomer5" size="30"></td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td><input type="text" name="kecamatan" id="nomer6" size="30"></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="proses" value="Simpan">
                <input type="reset" name="Reset" value="Hapus">
                <a href="lihat_survey.php?tcari=">
                    <input type="button" value="Lihat">
                </a>
            </td>
        </tr>
    </table>
</form>

<footer class="copy">
    <h4><center>&copy; 2023 RUTILAHU - Dinas Perumahan Rakyat dan Kawasan Pemukiman</center></h4>
</footer>

<script>
    function validasi() {
        var id_pegawai = document.getElementById('nomer1').value;
        var nama = document.getElementById('nomer2').value;
        var jabatan = document.getElementById('nomer3').value;
        var tanggal = document.getElementById('nomer4').value;
        var desa = document.getElementById('nomer5').value;
        var kecamatan = document.getElementById('nomer6').value;

        if (id_pegawai == "") {
            alert('ID Harus Diisi');
            document.getElementById('nomer1').focus();
            return false;
        }

        if (nama == "") {
            alert('Nama Harus Diisi');
            document.getElementById('nomer2').focus();
            return false;
        }

        if (jabatan == "") {
            alert('Jabatan Harus Diisi');
            document.getElementById('nomer3').focus();
            return false;
        }

        if (tanggal == "") {
            alert('Tanggal Harus Diisi');
            document.getElementById('nomer4').focus();
            return false;
        }

        if (desa == "") {
            alert('Desa Harus Diisi');
            document.getElementById('nomer5').focus();
            return false;
        }

        if (kecamatan == "") {
            alert('Kecamatan Harus Diisi');
            document.getElementById('nomer6').focus();
            return false;
        }
    }
</script>

<?php
class timsurvey {
    private $koneksi;

    public function __construct($db) {
        $this->koneksi = $db;
    }

    public function tambahSurvey($id_pegawai, $nama, $jabatan, $tanggal, $desa, $kecamatan) {
        $cek = mysqli_query($this->koneksi, "SELECT * FROM tim_survey WHERE id_pegawai ='$id_pegawai'");
        $jumlah = mysqli_num_rows($cek);

        if ($jumlah == 1) {
            echo "
            <script>
                alert('Data sudah ada');
                window.location = 'timsurvey.php?a=$id_pegawai&b=$nama&c=$jabatan&d=$tanggal&e=$desa&f=$kecamatan';
            </script>
            ";
        } else {
            $simpan = mysqli_query($this->koneksi, "INSERT INTO tim_survey SET 
                id_pegawai='$id_pegawai', 
                nama='$nama', 
                jabatan='$jabatan', 
                tanggal='$tanggal', 
                desa='$desa', 
                kecamatan='$kecamatan'");

            if ($simpan) {
                echo "
                <script>
                    alert('Data berhasil ditambahkan');
                    window.location = 'timsurvey.php';
                </script>
                ";
            }
        }
    }
}

include "../lib/koneksi.php"; 

if (isset($_POST['proses'])) {
    $id_pegawai = $_POST['id_pegawai'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $tanggal = $_POST['tanggal'];
    $desa = $_POST['desa'];
    $kecamatan = $_POST['kecamatan'];

    $manager = new timsurvey($koneksi);
    $manager->tambahSurvey($id_pegawai, $nama, $jabatan, $tanggal, $desa, $kecamatan);
}
?>
</body>
</html>
