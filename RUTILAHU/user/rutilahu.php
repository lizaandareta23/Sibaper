<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles2.css">
    <title>RUTILAHU Form</title>
    <script>
        class kelolapermohonanbantuan {
            constructor() {
                this.noKtp = document.getElementById('nomor1');
                this.statusTanah = document.getElementById('nomor2');
                this.titikKoordinat = document.getElementById('nomor3');
                this.luasTanahP = document.getElementById('nomor4a');
                this.luasTanahL = document.getElementById('nomor4b');
                this.tipeBangunan = document.getElementById('nomor5');
                this.jenisBantuan = document.getElementById('nomor6');
                this.kesimpulan = document.getElementById('nomor7');
            }

            validate() {
                if (this.noKtp.value === "") {
                    alert('no ktp harus diisi');
                    this.noKtp.focus();
                    return false;
                }
                if (this.statusTanah.value === "") {
                    alert('status tanah harus diisi');
                    this.statusTanah.focus();
                    return false;
                }
                if (this.titikKoordinat.value === "") {
                    alert('titik koordinat harus diisi');
                    this.titikKoordinat.focus();
                    return false;
                }
                if (this.luasTanahP.value === "" || this.luasTanahL.value === "") {
                    alert('Luas Tanah harus diisi');
                    this.luasTanahP.focus();
                    return false;
                }
                if (this.tipeBangunan.value === "") {
                    alert('tipe bangunan harus diisi');
                    this.tipeBangunan.focus();
                    return false;
                }
                if (this.jenisBantuan.value === "") {
                    alert('jenis bantuan harus diisi');
                    this.jenisBantuan.focus();
                    return false;
                }
                if (this.kesimpulan.value === "") {
                    alert('kesimpulan harus diisi');
                    this.kesimpulan.focus();
                    return false;
                }
                return true;
            }
        }

        function validasi() {
            const validator = new kelolapermohonanbantuan();
            return validator.validate();
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
    <form action="simpan-rutilahu.php" method="post" onsubmit="return validasi();">
        <h1><center>RUTILAHU</center></h1>
        <div class="underline-title"></div>
        <table>
            <tr>
                <td>no ktp</td>
                <td>:</td>
                <td><input type="text" name="no_ktp" id="nomor1"></td>
            </tr>
            <tr>
                <td>status tanah</td>
                <td>:</td>
                <td>
                    <select name="status_tanah" id="nomor2">
                        <option value="">----pilih---</option>
                        <option value="Tanah pengairan">Tanah pengairan</option>
                        <option value="Tanah Hutan">Tanah Hutan</option>
                        <option value="Tanah Jalan Tol">Tanah Jalan Tol</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>titik koordinat</td>
                <td>:</td>
                <td><input type="text" size="10" name="titik_koordinat" id="nomor3"></td>
            </tr>
            <tr>
                <td>luas tanah</td>
                <td>:</td>
                <td>
                    P <input type="text" size="10" name="luas_tanah_p" id="nomor4a">
                    L <input type="text" size="10" name="luas_tanah_l" id="nomor4b">
                </td>
            </tr>
            <tr>
                <td>tipe bangunan</td>
                <td>:</td>
                <td>
                    <select name="tipe_bangunan" id="nomor5">
                        <option value="">----pilih---</option>
                        <option value="Permanen">Permanen</option>
                        <option value="non permanen">Non Permanen</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>jenis bantuan</td>
                <td>:</td>
                <td>
                    <select name="jenis_bantuan" id="nomor6">
                        <option value="">----pilih---</option>
                        <option value="Subsidi">Subsidi</option>
                        <option value="Komersial">Komersial</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>kesimpulan</td>
                <td>:</td>
                <td><input type="text" size="20" name="kesimpulan" id="nomor7"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="proses" value="Simpan">
                    <input type="reset" name="Reset" value="Hapus">
                    <a href="lihat_penduduk2.php?tcari="><input type="button" value="Lihat"></a>
                </td>
            </tr>
        </table>
    </form>
    <footer class="copy">
        <h4><center>&copy; 2023 RUTILAHU - Dinas Perumahan Rakyat dan Kawasan Pemukiman</center></h4>
    </footer>
</body>
</html>
