<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Validation</title>
    <link rel="stylesheet" href="styles2.css">
    <script>
        class FormValidator {
            constructor(formId) {
                this.form = document.getElementById(formId);
                this.fields = {
                    nomorindukktp: 'nomor0',
                    nama: 'nomor1',
                    nomorkk: 'nomor9',
                    tempatlahir: 'nomor2',
                    tanggallahir: 'nomor3',
                    alamat: 'nomor5',
                    rtrw: 'nomor6',
                    desa: 'nomor7',
                    kecamatan: 'nomor8',
                    jeniskelamin: 'nomor10',
                    agama: 'nomor11',
                    statuskawin: 'nomor12',
                    pekerjaan: 'nomor13',
                    kewarganegaraan: 'nomor14',
                    penghasilan: 'nomor15'
                };
            }

            validate() {
                for (let [field, id] of Object.entries(this.fields)) {
                    let element = document.getElementById(id);
                    if (element.value === "") {
                        alert(`${this.getFieldName(field)} harus diisi`);
                        element.focus();
                        return false;
                    }
                    if ((field === 'nomorindukktp' || field === 'nomorkk') && element.value.length !== 16) {
                        alert(`Panjang ${this.getFieldName(field)} harus = 16 digit`);
                        element.focus();
                        return false;
                    }
                }
                return true;
            }

            getFieldName(field) {
                const fieldNames = {
                    nomorindukktp: 'Nomor Induk KTP',
                    nama: 'Nama',
                    nomorkk: 'Nomor KK',
                    tempatlahir: 'Tempat Lahir',
                    tanggallahir: 'Tanggal Lahir',
                    alamat: 'Alamat',
                    rtrw: 'RT/RW',
                    desa: 'Kel/Desa',
                    kecamatan: 'Kecamatan',
                    jeniskelamin: 'Jenis Kelamin',
                    agama: 'Agama',
                    statuskawin: 'Status Kawin',
                    pekerjaan: 'Pekerjaan',
                    kewarganegaraan: 'Kewarganegaraan',
                    penghasilan: 'Penghasilan'
                };
                return fieldNames[field];
            }
        }

        function validasi() {
            const validator = new FormValidator('dataDiriForm');
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
    <form id="dataDiriForm" action="simpan_penduduk.php" method="POST" onsubmit="return validasi();">
        <table>
            <h1><center>Data Diri</center></h1>
            <div class="underline-title"></div>
            <tr>
                <td>Nomor Induk KTP</td>
                <td>:</td>
                <td><input type="text" name="no_ktp" id="nomor0"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" id="nomor1"></td>
            </tr>
            <tr>
                <td>Nomor KK</td>
                <td>:</td>
                <td><input type="text" name="no_kk" id="nomor9"></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" name="tempatlahir" id="nomor2"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="date" name="tanggallahir" id="nomor3"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><select name="jeniskelamin" id="nomor10">
                    <option value="">-- Pilih --</option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-laki">Laki-laki</option>
                </select></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea cols="65" rows="5" name="alamat" id="nomor5"></textarea></td>
            </tr>
            <tr>
                <td>RT/RW</td>
                <td>:</td>
                <td><input type="text" name="rtrw" id="nomor6"></td>
            </tr>
            <tr>
                <td>Kel/Desa</td>
                <td>:</td>
                <td><input type="text" name="desa" id="nomor7"></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><input type="text" name="kecamatan" id="nomor8"></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><select name="agama" id="nomor11">
                    <option value="">-- Pilih --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen Protestan">Kristen Protestan</option>
                    <option value="Kristen Katolik">Kristen Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Khonghucu">Khonghucu</option>
                </select></td>
            </tr>
            <tr>
                <td>Status Kawin</td>
                <td>:</td>
                <td><select name="statuskawin" id="nomor12">
                    <option value="">-- Pilih --</option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><select name="pekerjaan" id="nomor13">
                    <option value="">-- Pilih --</option>
                    <option value="PNS">PNS</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Buruh Harian Lepas">Buruh Harian Lepas</option>
                </select></td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td>:</td>
                <td><select name="kewarganegaraan" id="nomor14">
                    <option value="">-- Pilih --</option>
                    <option value="WNI">WNI</option>
                </select></td>
            </tr>
            <tr>
                <td>Penghasilan</td>
                <td>:</td>
                <td><select name="penghasilan" id="nomor15">
                    <option value="">-- Pilih --</option>
                    <option value="Rp1.000.000 - Rp2.000.000">Rp1.000.000 - Rp2.000.000</option>
                    <option value="Rp3.000.000 - Rp4.000.000">Rp3.000.000 - Rp4.000.000</option>
                    <option value="Rp5.000.000 - Rp6.000.000">Rp5.000.000 - Rp6.000.000</option>
                </select> / Bulan</td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Simpan" name="proses">
                    <input type="reset" value="Hapus">
                    <a href="lihat_penduduk2.php?tcari=">
                    <input type="button" value="Lihat"></a>
                </td>
            </tr>
        </table>
    </form
