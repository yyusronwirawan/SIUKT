-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 05:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-ukt`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_ukt`
--

CREATE TABLE `kelompok_ukt` (
  `id_kelompok_ukt` int(11) NOT NULL,
  `kelompok_ukt` int(11) NOT NULL,
  `program_studi` varchar(100) DEFAULT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok_ukt`
--

INSERT INTO `kelompok_ukt` (`id_kelompok_ukt`, `kelompok_ukt`, `program_studi`, `nominal`) VALUES
(1, 1, 'D3 Keperawatan', 500000),
(2, 2, 'D3 Keperawatan', 1000000),
(3, 3, 'D3 Keperawatan', 5000000),
(4, 4, 'D3 Keperawatan', 6000000),
(5, 5, 'D3 Keperawatan', 7000000),
(6, 6, 'D3 Keperawatan', 8000000),
(7, 7, 'D3 Keperawatan', 9000000),
(8, 8, 'D3 Keperawatan', 10000000),
(9, 1, 'D3 Sistem Informasi', 500000),
(10, 2, 'D3 Sistem Informasi', 1000000),
(11, 3, 'D3 Sistem Informasi', 3000000),
(12, 4, 'D3 Sistem Informasi', 4000000),
(13, 5, 'D3 Sistem Informasi', 5000000),
(14, 6, 'D3 Sistem Informasi', 6000000),
(15, 7, 'D3 Sistem Informasi', 7000000),
(16, 8, 'D3 Sistem Informasi', 8000000),
(35, 1, 'D3 Agroindustri', 500000),
(36, 2, 'D3 Agroindustri', 1000000),
(37, 3, 'D3 Agroindustri', 3000000),
(38, 4, 'D3 Agroindustri', 4000000),
(39, 5, 'D3 Agroindustri', 5000000),
(40, 6, 'D3 Agroindustri', 6000000),
(41, 7, 'D3 Agroindustri', 7000000),
(42, 8, 'D3 Agroindustri', 8000000),
(43, 1, 'D3 Pemeliharaan Mesin', 500000),
(44, 2, 'D3 Pemeliharaan Mesin', 1000000),
(45, 3, 'D3 Pemeliharaan Mesin', 3000000),
(46, 4, 'D3 Pemeliharaan Mesin', 4000000),
(47, 5, 'D3 Pemeliharaan Mesin', 5000000),
(48, 6, 'D3 Pemeliharaan Mesin', 6000000),
(49, 7, 'D3 Pemeliharaan Mesin', 7000000),
(50, 8, 'D3 Pemeliharaan Mesin', 8000000),
(51, 1, 'D4 Teknologi Produksi Tanaman Pangan', 500000),
(52, 2, 'D4 Teknologi Produksi Tanaman Pangan', 1000000),
(53, 3, 'D4 Teknologi Produksi Tanaman Pangan', 3500000),
(54, 4, 'D4 Teknologi Produksi Tanaman Pangan', 4500000),
(55, 5, 'D4 Teknologi Produksi Tanaman Pangan', 5500000),
(56, 6, 'D4 Teknologi Produksi Tanaman Pangan', 6500000),
(57, 7, 'D4 Teknologi Produksi Tanaman Pangan', 7500000),
(58, 8, 'D4 Teknologi Produksi Tanaman Pangan', 8500000),
(59, 1, 'D4 Teknologi Rekayasa Manufaktur', 500000),
(60, 2, 'D4 Teknologi Rekayasa Manufaktur', 1000000),
(61, 3, 'D4 Teknologi Rekayasa Manufaktur', 3500000),
(62, 4, 'D4 Teknologi Rekayasa Manufaktur', 4500000),
(63, 5, 'D4 Teknologi Rekayasa Manufaktur', 5500000),
(64, 6, 'D4 Teknologi Rekayasa Manufaktur', 6500000),
(65, 7, 'D4 Teknologi Rekayasa Manufaktur', 7500000),
(66, 8, 'D4 Teknologi Rekayasa Manufaktur', 8500000),
(67, 1, 'D4 Teknologi Rekayasa Perangkat Lunak', 500000),
(68, 2, 'D4 Teknologi Rekayasa Perangkat Lunak', 1000000),
(69, 3, 'D4 Teknologi Rekayasa Perangkat Lunak', 3500000),
(70, 4, 'D4 Teknologi Rekayasa Perangkat Lunak', 4500000),
(71, 5, 'D4 Teknologi Rekayasa Perangkat Lunak', 5500000),
(72, 6, 'D4 Teknologi Rekayasa Perangkat Lunak', 6500000),
(73, 7, 'D4 Teknologi Rekayasa Perangkat Lunak', 7500000),
(74, 8, 'D4 Teknologi Rekayasa Perangkat Lunak', 8500000);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` varchar(11) DEFAULT NULL,
  `ideal` enum('Benefit','Cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `ideal`) VALUES
(4, 'Pendapatan Orang Tua', '0.6', 'Benefit'),
(5, 'Pekerjaan Orang Tua', '0.4', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `status_user` enum('Bagian Keuangan','Mahasiswa','Akademik','Kabag Umum & Akademik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `id_mahasiswa`, `keterangan`, `waktu`, `status_user`) VALUES
(1, NULL, 1, 'Melakukan proses penentuan UKT ', '2023-07-12 14:43:36', 'Mahasiswa'),
(2, NULL, 1, 'Mengirim data penentuan UKT ', '2023-07-12 14:43:45', 'Mahasiswa'),
(3, 1, NULL, 'Memberikan keputusan setuju penentuan UKT kepada Renaldi Noviandi', '2023-07-12 15:03:54', 'Bagian Keuangan'),
(4, 1, NULL, 'Melakukan edit pengaturan', '2023-07-16 22:10:02', 'Bagian Keuangan'),
(5, 1, NULL, 'Melakukan edit pengaturan', '2023-07-16 22:10:11', 'Bagian Keuangan'),
(6, 8, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107050', '2023-07-16 22:12:39', 'Akademik'),
(7, NULL, 3, 'Melakukan proses penentuan UKT ', '2023-07-16 22:14:05', 'Mahasiswa'),
(8, NULL, 3, 'Mengirim data penentuan UKT ', '2023-07-16 22:14:21', 'Mahasiswa'),
(9, 1, NULL, 'Melakukan edit pengaturan', '2023-07-16 22:21:08', 'Bagian Keuangan');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(50) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `tahun_angkatan` varchar(5) DEFAULT NULL,
  `nomor_telepon` varchar(30) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `status` enum('Mahasiswa') DEFAULT 'Mahasiswa',
  `id_kelompok_ukt` int(11) DEFAULT NULL,
  `foto_user` text DEFAULT NULL,
  `status_pengajuan` enum('Tidak','Penangguhan','Penurunan','Penentuan') DEFAULT 'Tidak',
  `status_mahasiswa` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `prodi`, `tahun_angkatan`, `nomor_telepon`, `nim`, `email`, `password`, `status`, `id_kelompok_ukt`, `foto_user`, `status_pengajuan`, `status_mahasiswa`, `created_at`, `updated_at`) VALUES
(1, 'Renaldi Noviandi', 'D3 Sistem Informasi', '2023', '0895336928026', 10110003, 'renaldinoviandi9@gmail.com', '$2y$10$9aJMcuhSDDYdyLOzMeVqFuorb2PGWU3CO425x6R2A8Z9N5GPF22FW', 'Mahasiswa', 11, NULL, 'Tidak', 'Aktif', '2023-07-12 07:41:39', '2023-07-12 07:41:39'),
(2, 'Pengkuh Rangga Nurhidayat', 'D3 Sistem Informasi', '2023', '0895336928026', 10110004, 'pengkuh123@gmail.com', '$2y$10$HRqi3pr3/KEGDhgJ6ONPeefCKoC0RJR77OBKwdS0XJb9odUsLQ1aO', 'Mahasiswa', NULL, NULL, 'Tidak', 'Aktif', '2023-07-12 07:41:39', '2023-07-12 07:41:39'),
(3, 'Mahasiswa 5', 'D3 Sistem Informasi', '2023', '08989784353', 10107050, 'renaldinoviandi@gmail.com', '$2y$10$SeXuKTbe5e/5xs7g0gMIHu6HQatJNzZS32o9bUzBdY1mgfviFa9y6', 'Mahasiswa', NULL, '07162023151239 Mahasiswa 5.png', 'Penentuan', 'Aktif', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_nilai_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_kriteria` varchar(100) DEFAULT NULL,
  `ukt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_nilai_kriteria`, `id_kriteria`, `nilai_kriteria`, `ukt`) VALUES
(2, 4, 'Rp. 0 - Rp. 1.000.000', 1),
(6, 4, 'Rp. 1.000.001 - Rp. 2.000.000', 2),
(7, 4, 'Rp. 2.000.001 - Rp. 4.000.000', 3),
(8, 4, 'Rp. 4.000.001 - Rp. 6.000.000', 4),
(9, 4, 'Rp. 6.000.001 - Rp. 8.000.000', 5),
(10, 4, 'Rp. 8.000.001 - Rp. 10.000.000', 6),
(11, 4, 'Rp. 10.000.001 - Rp. 15.000.000', 7),
(12, 4, '>= Rp. 15.000.001', 8),
(15, 5, 'Kuli Pasar', 1),
(16, 5, 'Buruh Tani', 2),
(17, 5, 'Buruh Pabrik', 3),
(18, 5, 'Kuli Bangunan', 3),
(19, 5, 'Pegawai Negeri Sipil dengan golongan I atau II', 4),
(20, 5, 'Pegawai Negeri Sipil dengan golongan III atau IV yang sudah memperoleh Tukin/TPP/Tunjangan Profesi', 5),
(21, 5, 'Pegawai BUMN', 6),
(22, 5, 'Pejabat negara (maksimal setingkat kepala pemerintahan kabupaten atau kota)', 7),
(23, 5, 'Pejabat Negara (di atas tingkat kepala pemerintahan kabupaten atau kota)', 8),
(24, 15, '>=8', 1),
(25, 15, '7', 2),
(26, 15, '6', 3),
(27, 15, '5', 4),
(28, 15, '4', 5),
(29, 15, '3', 6),
(30, 15, '2', 7),
(31, 15, '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `penangguhan_ukt`
--

CREATE TABLE `penangguhan_ukt` (
  `id_penangguhan_ukt` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `alamat_orang_tua` varchar(255) DEFAULT NULL,
  `nomor_telepon_orang_tua` varchar(30) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `nominal_ukt` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `angsuran_pertama` int(11) DEFAULT NULL,
  `angsuran_kedua` int(11) DEFAULT NULL,
  `tanggal_angsuran_pertama` date DEFAULT NULL,
  `tanggal_angsuran_kedua` date DEFAULT NULL,
  `tanggal_wawancara` date DEFAULT NULL,
  `jam_wawancara` varchar(10) DEFAULT NULL,
  `jenis_wawancara` enum('Online','Offline') DEFAULT NULL,
  `link_wawancara` text DEFAULT NULL,
  `status_penangguhan` enum('Setuju','Tidak Setuju','Proses di Bagian Keuangan','Belum Dikirim','Proses di Kepala Bagian') DEFAULT NULL,
  `tanggal_pengajuan` datetime DEFAULT NULL,
  `bagian_keuangan` varchar(30) DEFAULT NULL,
  `kabag` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penentuan_ukt`
--

CREATE TABLE `penentuan_ukt` (
  `id_penentuan_ukt` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `label_kriteria` text NOT NULL,
  `value_kriteria` text NOT NULL,
  `target_kriteria` text NOT NULL,
  `hasil_ukt` varchar(5) NOT NULL,
  `tanggal_penentuan` datetime DEFAULT NULL,
  `status_penentuan` enum('Proses','Setuju','Tidak Setuju','Belum Dikirim') DEFAULT NULL,
  `status_laporan` enum('Belum','Sudah') NOT NULL DEFAULT 'Belum',
  `slip_gaji` text DEFAULT NULL,
  `struk_listrik` text DEFAULT NULL,
  `struk_air` text DEFAULT NULL,
  `kk` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penentuan_ukt`
--

INSERT INTO `penentuan_ukt` (`id_penentuan_ukt`, `id_mahasiswa`, `label_kriteria`, `value_kriteria`, `target_kriteria`, `hasil_ukt`, `tanggal_penentuan`, `status_penentuan`, `status_laporan`, `slip_gaji`, `struk_listrik`, `struk_air`, `kk`) VALUES
(1, 1, 'Pendapatan Orang Tua;Pekerjaan Orang Tua', 'Rp. 2.000.001 - Rp. 4.000.000;Buruh Pabrik', '3;3', '3', '2023-07-12 14:43:36', 'Setuju', 'Sudah', '07122023144333 Slip Gaji Renaldi Noviandi.pdf', '07122023144336 Struk Listrik Renaldi Noviandi.pdf', '07122023144336 Struk Air Renaldi Noviandi.pdf', '07122023144336 Kartu Keluarga Renaldi Noviandi.pdf'),
(2, 3, 'Pendapatan Orang Tua;Pekerjaan Orang Tua', 'Rp. 2.000.001 - Rp. 4.000.000;Buruh Pabrik', '3;3', '2', '2023-07-16 22:14:05', 'Proses', 'Belum', '07162023221404 Slip Gaji Mahasiswa 5.pdf', '07162023221405 Struk Listrik Mahasiswa 5.pdf', '07162023221405 Struk Air Mahasiswa 5.pdf', '07162023221405 Kartu Keluarga Mahasiswa 5.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `penurunan_ukt`
--

CREATE TABLE `penurunan_ukt` (
  `id_penurunan_ukt` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `alamat_rumah` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `tanggal_survey` date DEFAULT NULL,
  `status_penurunan` enum('Belum Dikirim','Proses di Bagian Keuangan','Setuju','Tidak Setuju','Proses di Kepala Bagian') NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL,
  `surat_pengajuan` text DEFAULT NULL,
  `sktm` text DEFAULT NULL,
  `khs` text DEFAULT NULL,
  `struk_listrik` text DEFAULT NULL,
  `foto_rumah` text DEFAULT NULL,
  `slip_gaji` text DEFAULT NULL,
  `bagian_keuangan` varchar(30) DEFAULT NULL,
  `kabag` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `batas_ukt_penangguhan` int(11) NOT NULL,
  `batas_ukt_penurunan` int(11) NOT NULL,
  `persen_denda` int(11) NOT NULL,
  `persen_angsuran_pertama` int(11) NOT NULL,
  `batas_tanggal_angsuran` int(11) NOT NULL,
  `form_penurunan_sktm` int(11) NOT NULL,
  `form_penurunan_khs` int(11) NOT NULL,
  `form_penurunan_struk_listrik` int(11) NOT NULL,
  `form_penurunan_slip_gaji` int(11) NOT NULL,
  `form_penurunan_foto_rumah` int(11) NOT NULL,
  `form_penurunan_surat_pengajuan` int(11) NOT NULL,
  `tanda_tangan_kabag` text DEFAULT NULL,
  `form_penentuan_slip_gaji` int(11) NOT NULL,
  `form_penentuan_struk_listrik` int(11) NOT NULL,
  `form_penentuan_struk_air` int(11) NOT NULL,
  `form_penentuan_kk` int(11) NOT NULL,
  `penentuan_edit_ukt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `batas_ukt_penangguhan`, `batas_ukt_penurunan`, `persen_denda`, `persen_angsuran_pertama`, `batas_tanggal_angsuran`, `form_penurunan_sktm`, `form_penurunan_khs`, `form_penurunan_struk_listrik`, `form_penurunan_slip_gaji`, `form_penurunan_foto_rumah`, `form_penurunan_surat_pengajuan`, `tanda_tangan_kabag`, `form_penentuan_slip_gaji`, `form_penentuan_struk_listrik`, `form_penentuan_struk_air`, `form_penentuan_kk`, `penentuan_edit_ukt`) VALUES
(1, 2, 2, 5, 50, 60, 1, 1, 1, 1, 1, 1, ' Tanda Tangan Kepala Bagian.png', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(30) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `status` enum('Bagian Keuangan','Kabag Umum & Akademik','Akademik') NOT NULL,
  `foto_user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `nomor_telepon`, `nik`, `password`, `status`, `foto_user`) VALUES
(1, 'Bagian Keuangan Polsub', 'renaldinoviandi0@gmail.com', '0895336928026', '11111111', '$2y$10$sIgZRbYhk3OmrUSTZBJyH.qMkghMa7bdaAFwODNfSCZ8OIfsB4cZi', 'Bagian Keuangan', '06092023181650 Bagian Keuangan Polsub.png'),
(7, 'Kepala Bagian Umum Polsub', 'kabagumum@gmail.com', '0895336928026', '22222222', '$2y$10$Mi7m2zB8AeozsKahryXjjOAv02twIJSnZ1yTBj1XcTWplf2t8mhcW', 'Kabag Umum & Akademik', '06092023183206 Kepala Bagian Umum Polsub.png'),
(8, 'Akademik Polsub', 'akademik@gmail.com', '0895336928026', '33333333', '$2y$10$YD65weMRRPxSaNpz.UWNJ.KCc4I4ovIyk4R4imWD914o9COvvqNwe', 'Akademik', '06052023124138 Akademik.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelompok_ukt`
--
ALTER TABLE `kelompok_ukt`
  ADD PRIMARY KEY (`id_kelompok_ukt`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_nilai_kriteria`);

--
-- Indexes for table `penangguhan_ukt`
--
ALTER TABLE `penangguhan_ukt`
  ADD PRIMARY KEY (`id_penangguhan_ukt`);

--
-- Indexes for table `penentuan_ukt`
--
ALTER TABLE `penentuan_ukt`
  ADD PRIMARY KEY (`id_penentuan_ukt`);

--
-- Indexes for table `penurunan_ukt`
--
ALTER TABLE `penurunan_ukt`
  ADD PRIMARY KEY (`id_penurunan_ukt`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelompok_ukt`
--
ALTER TABLE `kelompok_ukt`
  MODIFY `id_kelompok_ukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `penangguhan_ukt`
--
ALTER TABLE `penangguhan_ukt`
  MODIFY `id_penangguhan_ukt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penentuan_ukt`
--
ALTER TABLE `penentuan_ukt`
  MODIFY `id_penentuan_ukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penurunan_ukt`
--
ALTER TABLE `penurunan_ukt`
  MODIFY `id_penurunan_ukt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
