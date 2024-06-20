<?php
// File: simpan_survey_oop.php

class TimSurveyManager {
    private $koneksi;

    // Konstruktor untuk menginisialisasi koneksi ke database
    public function __construct($db) {
        $this->koneksi = $db;
    }

    // Metode untuk menambahkan anggota tim survey
    public function tambahSurvey($id_pegawai, $nama, $jabatan, $tanggal, $desa, $kecamatan) {
        // Validasi redundant data atau data yang sama
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
            $simpan = mysqli_query($this->koneksi, "INSERT INTO tim_survey SET id_pegawai='$id_pegawai', nama='$nama', jabatan='$jabatan', tanggal='$tanggal', desa='$desa', kecamatan='$kecamatan'");

            if ($simpan) {
                echo "
                    <script>
                        alert('Data berhasil ditambahkan');
                        window.location = 'timsurvey.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Data gagal ditambahkan');
                        window.location = 'timsurvey.php';
                    </script>
                ";
            }
        }
    }
}

// Inisialisasi koneksi database
include "../lib/koneksi.php"; // Sesuaikan dengan file koneksi database Anda
$manager = new TimSurveyManager($koneksi);

// Tangkap data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pegawai = $_POST['id_pegawai'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $tanggal = $_POST['tanggal'];
    $desa = $_POST['desa'];
    $kecamatan = $_POST['kecamatan'];

    // Panggil metode untuk menambahkan anggota tim survey
    $manager->tambahSurvey($id_pegawai, $nama, $jabatan, $tanggal, $desa, $kecamatan);
}
?>
