<?php
// Include koneksi dan mendefinisikan kelas Penduduk
include "../lib/koneksi.php";

// Kelas untuk mengelola data penduduk
class verifikasipermohonan {
    private $koneksi;

    public function __construct($db) {
        $this->koneksi = $db;
    }

    public function updateStatus($no_ktp, $status) {
        $update_query = "UPDATE penduduk SET status='$status' WHERE no_ktp='$no_ktp'";
        return mysqli_query($this->koneksi, $update_query);
    }
}

// Inisialisasi objek Penduduk dengan koneksi yang telah dibuat sebelumnya
$penduduk = new verifikasipermohonan($koneksi);

// Memproses permintaan untuk memperbarui status jika parameter diberikan melalui GET
if (isset($_GET['no_ktp']) && isset($_GET['status'])) {
    $no_ktp = $_GET['no_ktp'];
    $status = $_GET['status'];

    // Memanggil metode updateStatus dari objek Penduduk
    $penduduk->updateStatus($no_ktp, $status);

    // Redirect kembali ke halaman sebelumnya
    header("Location: lihat_penduduk2.php");
    exit();
}
?>
