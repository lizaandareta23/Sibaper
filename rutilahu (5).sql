-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 03:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rutilahu`
--

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id_desa` int(11) NOT NULL,
  `nama_desa` text NOT NULL,
  `nama_kepala_desa` text NOT NULL,
  `alamat_kantor_desa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id_desa`, `nama_desa`, `nama_kepala_desa`, `alamat_kantor_desa`) VALUES
(1, 'cobaaaa', 'Liza', 'jln.pinayungan'),
(2, 'ppppp', 'pppppppp', 'ppppppp'),
(3, 'Kampung sawah', 'cobaa', 'Karawang'),
(4, 'ppppp', 'pppppppp', 'ppppppp');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` varchar(20) NOT NULL,
  `nama_kecamatan` text NOT NULL,
  `nama_camat` text NOT NULL,
  `kepala_bagian_perencanaan` text NOT NULL,
  `alamat_kantor_kecamatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`, `nama_camat`, `kepala_bagian_perencanaan`, `alamat_kantor_kecamatan`) VALUES
('41352', 'Rengasdengklok', 'Bp. Abdul', 'Bp. Ngulon', 'R7RR+69M, Jalan Raya, Amansari, Kec. R.Dengklok, Karawang, Jawa Barat 41352'),
('41381', 'Talagasari', 'Bp. Asep', 'Bp. Ngaler', 'P96Q+WV9, Talagasari, Kec. Talagasari, Karawang, Jawa Barat 41381');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `no_ktp` varchar(16) NOT NULL,
  `nama` text NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `tempatlahir` text NOT NULL,
  `tanggallahir` date NOT NULL,
  `jeniskelamin` text NOT NULL,
  `alamat` text NOT NULL,
  `rtrw` varchar(10) NOT NULL,
  `desa` text NOT NULL,
  `kecamatan` text NOT NULL,
  `agama` text NOT NULL,
  `statuskawin` text NOT NULL,
  `pekerjaan` text NOT NULL,
  `kewarganegaraan` text NOT NULL,
  `penghasilan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`no_ktp`, `nama`, `no_kk`, `tempatlahir`, `tanggallahir`, `jeniskelamin`, `alamat`, `rtrw`, `desa`, `kecamatan`, `agama`, `statuskawin`, `pekerjaan`, `kewarganegaraan`, `penghasilan`, `status`) VALUES
('1112345678910100', 'coba', '1112345678910100', 'coba coba', '2023-12-28', 'Perempuan', 'cobaa', '003/001', 'kpsawah', 'jayakerta', 'Islam', 'Kawin', 'Karyawan', 'WNI', 'Rp1.000.000 - Rp2.000.000', 'Lolos'),
('1234567891011122', 'Liza Andareta', '1234567891011126', 'Karawang', '2023-12-28', 'Perempuan', 'Karawang', '003/001', 'kpsawah', 'jayakerta', 'Islam', 'Belum Kawin', 'PNS', 'WNI', 'Rp1.000.000 - Rp2.000.000', 'Gagal'),
('1234567891011123', 'Liza Andareta', '1234567891011124', 'Karawang', '2023-12-02', 'Laki-laki', 'Karawang', '003/001', 'Kampung Sawah', 'Jayakerta', 'Khonghucu', 'Kawin', 'PNS', 'WNI', 'Rp1.000.000 - Rp2.000.000', 'Lolos'),
('1234567891011125', 'Siti Aisah', '1234567891011126', 'Karawang', '2023-12-13', 'Perempuan', 'Dusun.pedes', '001/004', 'Payung sari', 'Pedes', 'Islam', 'Belum Kawin', 'Karyawan', 'WNI', 'Rp3.000.000 - Rp4.000.000', 'Lolos'),
('1234567891011166', 'Dea Vajrin Anwari', '1234567891011122', 'Karawang', '2023-12-27', 'Perempuan', 'Karawang', '003/001', 'Pasirkamuning', 'Telagasari', 'Islam', 'Belum Kawin', 'PNS', 'WNI', 'Rp1.000.000 - Rp2.000.000', 'Gagal'),
('2748274671829409', 'Dandelieon', '2748274671829417', 'jepang', '2023-12-29', 'Laki-laki', 'Dusun Nagasaki', '002/011', 'Isekai', 'Trukun', 'Kristen Protestan', 'Kawin', 'Wiraswasta', 'WNI', 'Rp1.000.000 - Rp2.000.000', 'Gagal'),
('7463728364718380', 'Abu isa', '7465628364718357', 'Karawang', '2024-06-05', 'Laki-laki', 'gdstr', '010/034', 'Kampung Sawah', 'Jayakerta', 'Islam', 'Kawin', 'Karyawan', 'WNI', 'Rp3.000.000 - Rp4.000.000', 'Lolos');

-- --------------------------------------------------------

--
-- Table structure for table `rutilahu`
--

CREATE TABLE `rutilahu` (
  `no_ktp` varchar(16) NOT NULL,
  `status_tanah` varchar(20) NOT NULL,
  `titik_koordinat` varchar(50) NOT NULL,
  `luas_tanah_p` int(11) NOT NULL,
  `luas_tanah_l` int(11) NOT NULL,
  `tipe_bangunan` varchar(12) NOT NULL,
  `jenis_bantuan` varchar(10) NOT NULL,
  `kesimpulan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rutilahu`
--

INSERT INTO `rutilahu` (`no_ktp`, `status_tanah`, `titik_koordinat`, `luas_tanah_p`, `luas_tanah_l`, `tipe_bangunan`, `jenis_bantuan`, `kesimpulan`) VALUES
('1234567891011123', 'Tanah pengairan', '-9249,248,21', 130, 90, 'non permanen', 'Subsidi', 'HAdiuwefyu'),
('2147483647', 'Tanah pengairan', '2147483647', 111, 111, 'Permanen', 'Subsidi', 'cobaaaa'),
('222222', 'Tanah pengairan', '-9249', 110, 200, 'Permanen', 'Subsidi', 'weee'),
('444444', 'Tanah pengairan', '1111111', 111, 111, 'Permanen', 'Subsidi', 'cobaa11111'),
('4672848926713786', 'Tanah Hutan', '-56284,248,39', 80, 50, 'non permanen', 'Subsidi', 'Bismillah'),
('7634293656', 'Tanah pengairan', '-0373,762834.341', 100, 120, 'Permanen', 'Subsidi', 'berhasil'),
('888888', 'Tanah pengairan', '1111111', 111, 0, 'Permanen', 'Komersial', 'cobaa111');

-- --------------------------------------------------------

--
-- Table structure for table `tim_survey`
--

CREATE TABLE `tim_survey` (
  `id_pegawai` int(20) NOT NULL,
  `nama` text NOT NULL,
  `jabatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `desa` text NOT NULL,
  `kecamatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tim_survey`
--

INSERT INTO `tim_survey` (`id_pegawai`, `nama`, `jabatan`, `tanggal`, `desa`, `kecamatan`) VALUES
(89503, 'Dadan Satria', 'Direktur Utama', '2023-12-28', 'Kiarapayung', 'Klari'),
(89513, 'Dea vajrin.A', 'Sekertaris Direktur', '2023-12-04', 'Pasirkamuning', 'Talagasari'),
(89518, 'Siti Aisah', 'HRD 2', '2023-12-28', 'Pedes', 'Rengasdengklol'),
(89542, 'Muanwar', 'Pelaksana', '2024-01-24', 'Pasirpogor', 'Majalaya'),
(89544, 'Abu Isa', 'Jajaran Direksi', '2023-12-28', 'Kp', 'Karangpawitan'),
(123456, 'jay', 'HRD', '2024-06-01', 'Busan', 'Korsel');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sandi` varchar(255) NOT NULL,
  `grup` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `sandi`, `grup`) VALUES
(12, 'Liza Andareta', 'lizaandareta@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'a'),
(13, 'Liza Andareta', 'lizaandareta@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id_desa`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`no_ktp`);

--
-- Indexes for table `rutilahu`
--
ALTER TABLE `rutilahu`
  ADD PRIMARY KEY (`no_ktp`);

--
-- Indexes for table `tim_survey`
--
ALTER TABLE `tim_survey`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
