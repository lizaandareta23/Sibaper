<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tim Survey</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
            text-align: left;
        }
        th, td {
            padding: 10px;
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
        .genap:hover, .ganjil:hover {
            background-color: #2dbd6e;
        }
        .kanan { margin-left: 300px; }
        input[type="button"], input[type="submit"] {
            background-color: #2dbd6e;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-left: 5px;
        }
        input[type="button"]:hover, input[type="submit"]:hover {
            background-color: #a6f77b;
        }
    </style>
</head>
<body>
<?php
// File: lihat_survey.php

// Class untuk mengelola koneksi database dan operasi CRUD tim survey
class TimSurveyManager {
    private $koneksi;

    // Constructor untuk menginisialisasi koneksi
    public function __construct($db) {
        $this->koneksi = $db;
    }

    // Method untuk menampilkan data tim survey
    public function tampilkanDataTimSurvey($kode_cari) {
        try {
            $query = "SELECT * FROM tim_survey";

            if (!empty($kode_cari)) {
                $query = "SELECT * FROM tim_survey WHERE nama LIKE '%$kode_cari%'";
            }

            $result = mysqli_query($this->koneksi, $query);
            if (!$result) {
                throw new Exception('Query error: ' . mysqli_error($this->koneksi));
            }

            $jm_baris = mysqli_num_rows($result);

            echo "<a href='timsurvey.php'><input type='button' value='Kembali'></a>";
            echo "<form action='lihat_survey.php' method='get'>
                    <h1 style='text-align: center;'>DATA TIM SURVEY</h1>
                    <div class='kanan'>
                        <input type='text' name='tcari' placeholder='nama'>
                        <input type='submit' value='Cari'>
                    </div>
                  </form>";

            echo "<table>
                    <tr class='data'>
                        <th>No</th>
                        <th>Id Pegawai</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Tanggal</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th colspan='2'>Proses</th>
                    </tr>";

            $k = 1;
            while ($data = mysqli_fetch_assoc($result)) {
                $row_class = ($k % 2 == 1) ? 'ganjil' : 'genap';

                // Pemeriksaan keberadaan kunci 'kecamatan'
                $kecamatan = isset($data['kecamatan']) ? $data['kecamatan'] : '';

                echo "<tr class='$row_class'>
                        <td>$k</td>
                        <td>".$data['id_pegawai']."</td>
                        <td>".$data['nama']."</td>
                        <td>".$data['jabatan']."</td>
                        <td>".$data['tanggal']."</td>
                        <td>".$data['desa']."</td>
                        <td>".$kecamatan."</td>
                        <td>
                            <a href='ubah_survey.php?id_pegawai=".$data['id_pegawai']."'><input type='button' value='Edit'></a>
                        </td>
                        <td>
                            <a href='lihat_survey.php?id=".$data['id_pegawai']."' onclick='return confirm(\"Yakin Hapus data?\")'>
                                <input type='button' value='Hapus'>
                            </a>
                        </td>
                    </tr>";
                $k++;
            }
            echo "</table>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Method untuk menghapus data tim survey berdasarkan id_pegawai
    public function hapusDataTimSurvey($id_pegawai) {
        try {
            mysqli_query($this->koneksi, "DELETE FROM tim_survey WHERE id_pegawai='$id_pegawai'");
            echo "<script>alert('Data berhasil dihapus'); window.location='lihat_survey.php?tcari=';</script>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Inisialisasi koneksi database
include "../lib/koneksi.php"; // Sesuaikan dengan file koneksi database Anda

try {
    // Pastikan $koneksi sudah diinisialisasi dengan objek mysqli yang valid sebelum membuat objek TimSurveyManager
    if (!$koneksi instanceof mysqli) {
        throw new Exception('Koneksi database tidak valid.');
    }

    $manager = new TimSurveyManager($koneksi);

    // Tangkap parameter dari URL
    $kode_cari = isset($_GET['tcari']) ? $_GET['tcari'] : '';

    // Tangkap parameter id untuk menghapus data
    if (isset($_GET['id'])) {
        $id_pegawai = $_GET['id'];
        $manager->hapusDataTimSurvey($id_pegawai);
    }

    // Panggil method tampilkanDataTimSurvey dengan parameter pencarian
    $manager->tampilkanDataTimSurvey($kode_cari);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
</body>
</html>
