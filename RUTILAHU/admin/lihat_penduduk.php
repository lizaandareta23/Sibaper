<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar RUTILAHU</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        .data { background-color: #a6f77b; }
        .ganjil { background-color: #fff; }
        .genap { background-color: #f0ffe8; }
        .genap:hover, .ganjil:hover { background-color: #2dbd6e; }
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
// File: lihat_penduduk.php

// Class untuk mengelola koneksi database dan operasi CRUD penduduk
class PendudukManager {
    private $koneksi;

    // Constructor untuk menginisialisasi koneksi
    public function __construct($db) {
        if (!$db instanceof mysqli) {
            throw new Exception('Koneksi database tidak valid.');
        }
        $this->koneksi = $db;
    }

    // Method untuk menampilkan data penduduk
    public function tampilkanDataPenduduk($kode_cari) {
        try {
            $query = "SELECT * FROM penduduk";
            
            if (!empty($kode_cari)) {
                $kode_cari = mysqli_real_escape_string($this->koneksi, $kode_cari);
                $query = "SELECT * FROM penduduk WHERE nama LIKE '%$kode_cari%'";
            }

            if (!$this->koneksi instanceof mysqli) {
                throw new Exception('Koneksi database tidak valid.');
            }

            $result = mysqli_query($this->koneksi, $query);
            if (!$result) {
                throw new Exception('Query error: ' . mysqli_error($this->koneksi));
            }

            $jm_baris = mysqli_num_rows($result);

            echo "<a href='penduduk.php'><input type='button' value='Kembali'></a>";
            echo "<form action='lihat_penduduk.php' method='get'>
                    <h1 style='text-align: center;'>DATA PENDUDUK</h1>
                    <div class='kanan'>
                        <input type='text' name='tcari' placeholder='nama' value='".htmlspecialchars($kode_cari)."'>
                        <input type='submit' value='Cari'>
                    </div>
                  </form>";

            echo "<table border='1'>
                    <tr class='data'>
                        <td>No</td>
                        <td>Nomer KTP</td>
                        <td>Nama</td>
                        <td>Nomer KK</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Alamat</td>
                        <td>RT/RW</td>
                        <td>Kel/Desa</td>
                        <td>Kecamatan</td>
                        <td>Agama</td>
                        <td>Status Kawin</td>
                        <td>Pekerjaan</td>
                        <td>Kewarganegaraan</td>
                        <td>Penghasilan</td>
                        <td colspan='2'>Proses</td>
                    </tr>";

            for ($k = 1; $k <= $jm_baris; $k++) {
                $data = mysqli_fetch_assoc($result);
                $row_class = ($k % 2 == 1) ? 'ganjil' : 'genap';

                echo "<tr class='$row_class'>
                        <td>$k</td>
                        <td>".$data['no_ktp']."</td>
                        <td>".$data['nama']."</td>
                        <td>".$data['no_kk']."</td>
                        <td>".$data['tempatlahir']."</td>
                        <td>".$data['tanggallahir']."</td>
                        <td>".$data['jeniskelamin']."</td>
                        <td>".$data['alamat']."</td>
                        <td>".$data['rtrw']."</td>
                        <td>".$data['desa']."</td>
                        <td>".$data['kecamatan']."</td>
                        <td>".$data['agama']."</td>
                        <td>".$data['statuskawin']."</td>
                        <td>".$data['pekerjaan']."</td>
                        <td>".$data['kewarganegaraan']."</td>
                        <td>".$data['penghasilan']."</td> 
                        <td align='center'>
                            <a href='ubah_penduduk.php?no_ktp=".$data['no_ktp']."'><input type='button' value='Edit'></a>
                        </td>
                        <td align='center'>
                            <a href='lihat_penduduk.php?id=".$data['no_ktp']."' onclick='return confirm(\"Yakin Hapus data?\")'>
                                <input type='button' value='Hapus'>
                            </a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Method untuk menghapus data penduduk
    public function hapusDataPenduduk($no_ktp) {
        try {
            if (!$this->koneksi instanceof mysqli) {
                throw new Exception('Koneksi database tidak valid.');
            }

            $no_ktp = mysqli_real_escape_string($this->koneksi, $no_ktp);
            mysqli_query($this->koneksi, "DELETE FROM penduduk WHERE no_ktp='$no_ktp'");
            echo "<script>alert('Data berhasil dihapus'); window.location='lihat_penduduk.php?tcari=';</script>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Inisialisasi koneksi database
include "../lib/koneksi.php"; // Pastikan file ini sesuai dengan konfigurasi koneksi Anda

try {
    if (!$koneksi instanceof mysqli) {
        throw new Exception('Koneksi database tidak valid.');
    }

    $manager = new PendudukManager($koneksi);

    $kode_cari = isset($_GET['tcari']) ? $_GET['tcari'] : '';

    $manager->tampilkanDataPenduduk($kode_cari);

    if (isset($_GET['id'])) {
        $no_ktp = $_GET['id'];
        $manager->hapusDataPenduduk($no_ktp);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
</body>
</html>
