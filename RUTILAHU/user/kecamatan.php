<?php
session_start();

// Class untuk menampilkan header dan footer halaman
class View {
    public function displayHeader() {
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Form Kecamatan</title>
            <link rel="stylesheet" href="styles2.css">
            <style>
                /* Tambahan CSS untuk tampilan yang bagus */
                .container {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                }
                .gambar {
                    margin-bottom: 20px;
                }
                .text {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .underline-title {
                    border-bottom: 2px solid #000;
                    margin-bottom: 20px;
                }
                .copy {
                    margin-top: 20px;
                    text-align: center;
                }
            </style>
            <script>
                // Class Validator untuk validasi form
                class Validator {
                    static validate() {
                        var id_kecamatan = document.getElementById('nomor0').value;
                        var nama_kecamatan = document.getElementById('nomor1').value;
                        var nama_camat = document.getElementById('nomor2').value;
                        var kepala_bagian_perencanaan = document.getElementById('nomor3').value;
                        var alamat_kantor_kecamatan = document.getElementById('nomor4').value;
                        var kota = document.getElementById('nomor5').value;
                        var jumlah_desa = document.getElementById('nomor6').value;

                        if (id_kecamatan == "") {
                            alert('Id harus diisi');
                            document.getElementById('nomor0').focus();
                            return false;
                        }
                        if (nama_kecamatan == "") {
                            alert('Kecamatan harus diisi');
                            document.getElementById('nomor1').focus();
                            return false;
                        }
                        if (nama_camat == "") {
                            alert('Nama Camat harus diisi');
                            document.getElementById('nomor2').focus();
                            return false;
                        }
                        if (kepala_bagian_perencanaan == "") {
                            alert('Kep. Bagian perencanaan program harus diisi');
                            document.getElementById('nomor3').focus();
                            return false;
                        }
                        if (alamat_kantor_kecamatan == "") {
                            alert('Alamat kantor kecamatan harus diisi');
                            document.getElementById('nomor4').focus();
                            return false;
                        }
                        if (kota == "") {
                            alert('Kota harus diisi');
                            document.getElementById('nomor5').focus();
                            return false;
                        }
                        if (jumlah_desa == "") {
                            alert('Jumlah Desa harus diisi');
                            document.getElementById('nomor6').focus();
                            return false;
                        }
                        return true;
                    }
                }
            </script>
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
HTML;
    }

    public function displayFooter() {
        echo <<<HTML
            <footer class="copy">
                <h4><center>&copy; 2023 RUTILAHU - Dinas Perumahan Rakyat dan Kawasan Pemukiman</center></h4>
            </footer>
        </body>
        </html>
HTML;
    }

    public function displayForm() {
        echo <<<HTML
            <form action="simpan_kecamatan.php" method="post" onsubmit="return Validator.validate();">
                <table>
                    <h1><center>KECAMATAN</center></h1>
                    <div class="underline-title"></div>
                    <tr>
                        <td>ID Kecamatan</td>
                        <td>:</td>
                        <td><input type="text" name="id_kecamatan" id="nomor0" size="30"></td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td><input type="text" name="nama_kecamatan" id="nomor1" size="30"></td>
                    </tr>
                    <tr>
                        <td>Nama Camat</td>
                        <td>:</td>
                        <td><input type="text" name="nama_camat" id="nomor2" size="30"></td>
                    </tr>
                    <tr>
                        <td>Kepala Sub Bagian Perencanaan Program</td>
                        <td>:</td>
                        <td><input type="text" name="kepala_bagian_perencanaan" id="nomor3" size="30"></td>
                    </tr>
                    <tr>
                        <td>Alamat Kantor Kecamatan</td>
                        <td>:</td>
                        <td><textarea cols="65" rows="5" type="text" name="alamat_kantor_kecamatan" id="nomor4" size="30"></textarea></td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td>:</td>
                        <td><input type="text" name="kota" id="nomor5" size="30"></td>
                    </tr>
                    <tr>
                        <td>Jumlah Desa Terdaftar RUTILAHU</td>
                        <td>:</td>
                        <td><input type="text" name="jumlah_desa" id="nomor6" size="30"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" value="Simpan" name="proses">
                            <input type="reset" value="Hapus">
                            <a href="lihat_kecamatan1.php.?tcari="><input type="button" value="Lihat"></a>
                        </td>
                    </tr>
                </table>
            </form>
HTML;
    }
}

// Penggunaan kelas View untuk menampilkan halaman
$view = new View();
$view->displayHeader();
$view->displayForm();
$view->displayFooter();
?>
