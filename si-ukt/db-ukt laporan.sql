-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 09:27 PM
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
(9, 1, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 500000),
(10, 2, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 1000000),
(11, 3, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 3000000),
(12, 4, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 4000000),
(13, 5, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 5000000),
(14, 6, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 6000000),
(15, 7, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 7000000),
(16, 8, 'D3 Sistem Informasi, Agroindustri, Pemeliharaan Mesin', 8000000),
(25, 1, 'D4', 500000),
(26, 2, 'D4', 1000000),
(27, 3, 'D4', 3500000),
(28, 4, 'D4', 4500000),
(29, 5, 'D4', 5500000),
(30, 6, 'D4', 6500000),
(31, 7, 'D4', 7500000),
(32, 8, 'D4', 8500000);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
(4, 'Pendapatan Orang Tua', '0.6'),
(5, 'Pekerjaan Orang Tua', '0.4');

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
(9, NULL, 7, 'Melakukan hapus staff dengan NIK/NIP 111111111', '2023-04-06 13:57:55', 'Mahasiswa'),
(40, NULL, 7, 'Melakukan edit profil', '2023-04-18 20:34:17', 'Mahasiswa'),
(41, NULL, 7, 'Melakukan edit profil', '2023-04-18 20:35:03', 'Mahasiswa'),
(42, NULL, 7, 'Melakukan edit profil', '2023-04-18 20:35:32', 'Mahasiswa'),
(43, NULL, 7, 'Melakukan edit profil', '2023-04-18 20:35:44', 'Mahasiswa'),
(44, NULL, 7, 'Melakukan edit profil', '2023-04-18 20:36:29', 'Mahasiswa'),
(45, NULL, 7, 'Melakukan edit profil', '2023-04-18 20:36:50', 'Mahasiswa'),
(81, 2, NULL, 'Melakukan hapus nilai kriteria', '2023-05-01 14:35:20', ''),
(82, NULL, 7, 'Melakukan pengajuan penangguhan UKT ', '2023-05-06 20:40:06', 'Mahasiswa'),
(83, NULL, 7, 'Melakukan pengajuan penangguhan UKT ', '2023-05-06 20:41:18', 'Mahasiswa'),
(84, NULL, 9, 'Melakukan pengajuan penangguhan UKT ', '2023-05-06 20:52:12', 'Mahasiswa'),
(85, NULL, 9, 'Melakukan pengajuan penangguhan UKT ', '2023-05-06 20:56:01', 'Mahasiswa'),
(86, NULL, 9, 'Melakukan pengajuan penangguhan UKT ', '2023-05-06 20:57:53', 'Mahasiswa'),
(87, NULL, 9, 'Melakukan pengajuan penangguhan UKT ', '2023-05-06 20:58:35', 'Mahasiswa'),
(94, NULL, 9, 'Melakukan hapus data pengajuan', '2023-05-09 19:52:37', 'Mahasiswa'),
(95, NULL, 9, 'Melakukan edit pengajuan penangguhan UKT ', '2023-05-10 04:36:45', 'Mahasiswa'),
(96, NULL, 9, 'Melakukan edit pengajuan penangguhan UKT ', '2023-05-10 04:46:31', 'Mahasiswa'),
(97, NULL, 9, 'Melakukan edit pengajuan penangguhan UKT ', '2023-05-10 04:47:00', 'Mahasiswa'),
(98, NULL, 9, 'Melakukan kirim data pengajuan', '2023-05-10 05:20:49', 'Mahasiswa'),
(99, NULL, 9, 'Melakukan edit pengajuan penangguhan UKT ', '2023-05-10 14:38:18', 'Mahasiswa'),
(100, NULL, 9, 'Melakukan edit pengajuan penangguhan UKT ', '2023-05-10 14:38:38', 'Mahasiswa'),
(101, NULL, 9, 'Melakukan kirim data pengajuan', '2023-05-10 14:38:44', 'Mahasiswa'),
(104, NULL, NULL, 'Memberi keputusan setuju untuk pengajuan penangguhan UKT dari Renaldi', '2023-05-11 09:24:21', ''),
(110, 1, NULL, 'Melakukan edit profil', '2023-05-13 08:15:02', 'Bagian Keuangan'),
(111, 1, NULL, 'Melakukan edit profil', '2023-05-13 08:15:14', 'Bagian Keuangan'),
(112, 1, NULL, 'Melakukan edit profil', '2023-05-13 08:16:07', 'Bagian Keuangan'),
(113, 1, NULL, 'Melakukan edit profil', '2023-05-13 08:16:16', 'Bagian Keuangan'),
(114, 1, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107040', '2023-05-13 10:32:31', 'Bagian Keuangan'),
(115, 1, NULL, 'Melakukan edit mahasiswa dengan NIM 10107040', '2023-05-13 10:32:54', 'Bagian Keuangan'),
(116, 1, NULL, 'Melakukan edit mahasiswa dengan NIM 10107041', '2023-05-13 10:33:24', 'Bagian Keuangan'),
(117, 1, NULL, 'Melakukan hapus mahasiswa dengan NIM 10107041', '2023-05-13 10:33:32', 'Bagian Keuangan'),
(118, 1, NULL, 'Melakukan tambah Kelompok UKT 8 dengan nominal Rp 1.000.000.000', '2023-05-13 10:36:25', 'Bagian Keuangan'),
(119, 1, NULL, 'Melakukan edit Kelompok UKT 7 dengan nominal Rp 2.000.000.000', '2023-05-13 10:36:57', 'Bagian Keuangan'),
(120, 1, NULL, 'Melakukan hapus Kelompok UKT  dengan nominal Rp 0', '2023-05-13 10:37:07', 'Bagian Keuangan'),
(121, 1, NULL, 'Melakukan edit Kriteria', '2023-05-13 10:40:26', 'Bagian Keuangan'),
(122, 1, NULL, 'Melakukan tambah Kriteria', '2023-05-13 10:40:48', 'Bagian Keuangan'),
(123, 1, NULL, 'Melakukan hapus Kriteria', '2023-05-13 10:41:24', 'Bagian Keuangan'),
(124, 1, NULL, 'Melakukan edit Kriteria', '2023-05-13 10:41:37', 'Bagian Keuangan'),
(125, 1, NULL, 'Melakukan tambah nilai kriteria', '2023-05-13 10:42:39', 'Bagian Keuangan'),
(126, 1, NULL, 'Melakukan edit nilai kriteria', '2023-05-13 10:42:57', 'Bagian Keuangan'),
(127, 1, NULL, 'Melakukan hapus nilai kriteria', '2023-05-13 10:43:04', 'Bagian Keuangan'),
(128, 1, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107054', '2023-05-15 10:13:54', 'Bagian Keuangan'),
(129, 1, NULL, 'Melakukan hapus mahasiswa dengan NIM 10107050', '2023-05-15 10:14:14', 'Bagian Keuangan'),
(130, 1, NULL, 'Melakukan tambah Kelompok UKT 8 dengan nominal Rp 1.000', '2023-05-15 10:15:04', 'Bagian Keuangan'),
(131, 1, NULL, 'Melakukan edit Kelompok UKT 8 dengan nominal Rp 1.000', '2023-05-15 10:15:35', 'Bagian Keuangan'),
(132, 1, NULL, 'Melakukan hapus Kelompok UKT 8 dengan nominal Rp 1.000', '2023-05-15 10:15:51', 'Bagian Keuangan'),
(133, 1, NULL, 'Melakukan edit Kriteria', '2023-05-15 10:16:32', 'Bagian Keuangan'),
(134, 1, NULL, 'Melakukan tambah nilai kriteria', '2023-05-15 10:16:57', 'Bagian Keuangan'),
(135, 1, NULL, 'Melakukan tambah nilai kriteria', '2023-05-15 10:17:25', 'Bagian Keuangan'),
(136, 1, NULL, 'Melakukan hapus nilai kriteria', '2023-05-15 10:17:39', 'Bagian Keuangan'),
(137, 1, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107050', '2023-05-15 10:27:15', 'Bagian Keuangan'),
(138, NULL, 17, 'Melakukan pengajuan penangguhan UKT ', '2023-05-15 10:31:18', 'Mahasiswa'),
(139, NULL, 17, 'Melakukan kirim data pengajuan', '2023-05-15 10:31:45', 'Mahasiswa'),
(140, 1, NULL, 'Memberi jadwal wawancara', '2023-05-15 10:33:22', 'Bagian Keuangan'),
(141, NULL, 17, 'Melakukan pengajuan penurunan UKT ', '2023-05-21 11:59:44', 'Mahasiswa'),
(142, NULL, 17, 'Melakukan pengajuan penurunan UKT ', '2023-05-21 12:00:36', 'Mahasiswa'),
(143, NULL, 17, 'Melakukan pengajuan penurunan UKT ', '2023-05-21 12:02:16', 'Mahasiswa'),
(144, NULL, 17, 'Melakukan pengajuan penurunan UKT ', '2023-05-21 12:09:36', 'Mahasiswa'),
(145, NULL, 17, 'Melakukan pengajuan penurunan UKT ', '2023-05-21 12:29:28', 'Mahasiswa'),
(146, NULL, 17, 'Melakukan edit pengajuan penurunan UKT ', '2023-05-21 18:03:24', 'Mahasiswa'),
(147, NULL, 17, 'Melakukan edit pengajuan penurunan UKT ', '2023-05-21 18:10:43', 'Mahasiswa'),
(148, NULL, 17, 'Melakukan edit pengajuan penurunan UKT ', '2023-05-21 18:13:58', 'Mahasiswa'),
(149, NULL, 17, 'Melakukan kirim pengajuan penurunan UKT ', '2023-05-21 18:21:41', 'Mahasiswa'),
(150, 1, NULL, 'Memberikan jadwal survey pengajuan penurunan UKT Renaldi', '2023-05-21 19:57:57', 'Bagian Keuangan'),
(151, 1, NULL, 'Memberikan keputusan tidak setuju untuk pengajuan penurunan UKT Renaldi', '2023-05-21 20:09:31', 'Bagian Keuangan'),
(152, 1, NULL, 'Memberikan keputusan setuju untuk pengajuan penurunan UKT Renaldi', '2023-05-21 20:15:07', 'Bagian Keuangan'),
(153, 1, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107052', '2023-05-22 11:34:50', 'Bagian Keuangan'),
(154, NULL, 18, 'Melakukan pengajuan penangguhan UKT ', '2023-05-22 11:37:00', 'Mahasiswa'),
(155, NULL, 18, 'Melakukan edit pengajuan penangguhan UKT ', '2023-05-22 11:37:20', 'Mahasiswa'),
(156, NULL, 18, 'Melakukan kirim data pengajuan', '2023-05-22 11:37:31', 'Mahasiswa'),
(157, 1, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107001', '2023-05-24 09:37:50', 'Bagian Keuangan'),
(158, 1, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107002', '2023-05-24 09:39:03', 'Bagian Keuangan'),
(159, NULL, 20, 'Melakukan pengajuan penurunan UKT ', '2023-05-24 09:42:56', 'Mahasiswa'),
(160, NULL, 20, 'Melakukan kirim pengajuan penurunan UKT ', '2023-05-24 09:43:47', 'Mahasiswa'),
(161, 1, NULL, 'Memberikan jadwal survey pengajuan penurunan UKT Mahasiswa 2', '2023-05-24 09:45:46', 'Bagian Keuangan'),
(162, 1, NULL, 'Memberikan keputusan setuju untuk pengajuan penurunan UKT Mahasiswa 2', '2023-05-24 09:47:13', 'Bagian Keuangan'),
(163, NULL, 19, 'Melakukan pengajuan penurunan UKT ', '2023-05-25 10:21:50', 'Mahasiswa'),
(164, NULL, 19, 'Melakukan kirim pengajuan penurunan UKT ', '2023-05-25 10:22:49', 'Mahasiswa'),
(165, 1, NULL, 'Memberikan jadwal survey pengajuan penurunan UKT Mahasiswa 1', '2023-05-25 10:26:37', 'Bagian Keuangan'),
(166, 1, NULL, 'Memberikan keputusan setuju untuk pengajuan penurunan UKT Mahasiswa 1', '2023-05-25 10:27:05', 'Bagian Keuangan'),
(167, NULL, 19, 'Melakukan pengajuan penurunan UKT ', '2023-05-26 13:23:07', 'Mahasiswa'),
(168, NULL, 19, 'Melakukan kirim pengajuan penurunan UKT ', '2023-05-26 13:23:30', 'Mahasiswa'),
(169, 1, NULL, 'Memberikan jadwal survey pengajuan penurunan UKT Mahasiswa 1', '2023-05-26 13:25:16', 'Bagian Keuangan'),
(170, 1, NULL, 'Memberikan keputusan setuju untuk pengajuan penurunan UKT Mahasiswa 1', '2023-05-26 13:25:49', 'Bagian Keuangan'),
(171, NULL, 19, 'Melakukan pengajuan penangguhan UKT ', '2023-05-26 21:44:51', 'Mahasiswa'),
(172, NULL, 19, 'Melakukan pengajuan penangguhan UKT ', '2023-05-26 21:54:11', 'Mahasiswa'),
(173, NULL, 19, 'Melakukan edit pengajuan penangguhan UKT ', '2023-05-26 21:54:54', 'Mahasiswa'),
(174, NULL, 19, 'Melakukan kirim data pengajuan', '2023-05-26 21:55:19', 'Mahasiswa'),
(175, 1, NULL, 'Memberi jadwal wawancara', '2023-05-26 22:00:27', 'Bagian Keuangan'),
(176, 1, NULL, 'Memberi keputusan setuju untuk pengajuan penangguhan UKT dari Mahasiswa 1', '2023-05-26 22:02:12', 'Bagian Keuangan'),
(177, 1, NULL, 'Memberi keputusan setuju untuk pengajuan penangguhan UKT dari Renaldi 5', '2023-05-26 22:02:17', 'Bagian Keuangan'),
(178, 1, NULL, 'Memberi keputusan setuju untuk pengajuan penangguhan UKT dari Renaldi', '2023-05-26 22:02:21', 'Bagian Keuangan'),
(179, NULL, 19, 'Melakukan pengajuan penurunan UKT ', '2023-05-26 23:03:35', 'Mahasiswa'),
(180, NULL, 19, 'Melakukan edit pengajuan penurunan UKT ', '2023-05-26 23:07:13', 'Mahasiswa'),
(181, NULL, 19, 'Melakukan kirim pengajuan penurunan UKT ', '2023-05-26 23:07:42', 'Mahasiswa'),
(182, 1, NULL, 'Memberikan jadwal survey pengajuan penurunan UKT Mahasiswa 1', '2023-05-26 23:08:27', 'Bagian Keuangan'),
(183, 1, NULL, 'Memberikan keputusan setuju untuk pengajuan penurunan UKT Mahasiswa 1', '2023-05-26 23:08:33', 'Bagian Keuangan'),
(184, 1, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107003', '2023-05-27 18:48:09', 'Bagian Keuangan'),
(185, NULL, 21, 'Melakukan pengajuan penurunan UKT ', '2023-05-27 19:50:07', 'Mahasiswa'),
(186, NULL, 21, 'Melakukan edit pengajuan penurunan UKT ', '2023-05-27 19:51:48', 'Mahasiswa'),
(187, NULL, 21, 'Melakukan kirim pengajuan penurunan UKT ', '2023-05-27 19:58:24', 'Mahasiswa'),
(188, 1, NULL, 'Memberikan jadwal survey pengajuan penurunan UKT Mahasiswa 3', '2023-05-27 20:01:16', 'Bagian Keuangan'),
(189, 1, NULL, 'Melakukan edit pengaturan', '2023-05-28 14:42:34', 'Bagian Keuangan'),
(190, 1, NULL, 'Melakukan edit pengaturan', '2023-05-28 14:43:25', 'Bagian Keuangan'),
(191, 1, NULL, 'Melakukan edit pengaturan', '2023-05-28 14:46:20', 'Bagian Keuangan'),
(192, 1, NULL, 'Melakukan edit pengaturan', '2023-05-28 14:48:58', 'Bagian Keuangan'),
(193, 1, NULL, 'Melakukan edit pengaturan', '2023-05-28 14:49:32', 'Bagian Keuangan'),
(194, 1, NULL, 'Melakukan edit nilai kriteria', '2023-05-29 09:21:08', 'Bagian Keuangan'),
(195, 1, NULL, 'Melakukan edit pengaturan', '2023-05-29 11:02:39', 'Bagian Keuangan'),
(196, 1, NULL, 'Melakukan tambah user dengan role ', '2023-06-05 05:34:43', 'Bagian Keuangan'),
(197, 1, NULL, 'Melakukan edit user dengan role ', '2023-06-05 05:45:03', 'Bagian Keuangan'),
(198, 1, NULL, 'Melakukan edit user dengan role ', '2023-06-05 05:45:16', 'Bagian Keuangan'),
(199, 1, NULL, 'Melakukan edit user dengan role ', '2023-06-05 05:45:47', 'Bagian Keuangan'),
(200, 1, NULL, 'Melakukan edit user dengan role ', '2023-06-05 05:46:14', 'Bagian Keuangan'),
(201, 1, NULL, 'Melakukan edit user dengan role ', '2023-06-05 05:46:30', 'Bagian Keuangan'),
(202, 1, NULL, 'Melakukan hapus user dengan role ', '2023-06-05 05:48:47', 'Bagian Keuangan'),
(203, 1, NULL, 'Melakukan edit pengaturan', '2023-06-05 13:13:46', 'Bagian Keuangan'),
(204, 1, NULL, 'Melakukan tambah user dengan role ', '2023-06-05 19:31:51', 'Bagian Keuangan'),
(205, 1, NULL, 'Melakukan tambah user dengan role ', '2023-06-05 19:41:38', 'Bagian Keuangan'),
(206, 8, NULL, 'Melakukan tambah mahasiswa dengan NIM 10107005', '2023-06-05 20:57:43', 'Akademik'),
(207, 8, NULL, 'Melakukan edit mahasiswa dengan NIM 10107005', '2023-06-05 20:57:55', 'Akademik'),
(208, 8, NULL, 'Melakukan hapus mahasiswa dengan NIM 10107005', '2023-06-05 20:58:07', 'Akademik'),
(209, 8, NULL, 'Melakukan edit profil', '2023-06-05 21:19:48', 'Akademik'),
(210, 8, NULL, 'Melakukan edit profil', '2023-06-05 21:20:04', 'Akademik'),
(211, 7, NULL, 'Melakukan edit profil', '2023-06-05 21:23:57', 'Kabag Umum & Akademik'),
(212, NULL, 21, 'Melakukan pengajuan penangguhan UKT ', '2023-06-05 21:52:53', 'Mahasiswa'),
(213, NULL, 21, 'Melakukan edit pengajuan penangguhan UKT ', '2023-06-05 21:53:07', 'Mahasiswa'),
(214, NULL, 21, 'Melakukan kirim data pengajuan', '2023-06-05 21:53:24', 'Mahasiswa'),
(215, NULL, 21, 'Melakukan kirim data pengajuan', '2023-06-05 21:54:42', 'Mahasiswa'),
(216, 1, NULL, 'Memberi jadwal wawancara', '2023-06-06 01:39:56', 'Bagian Keuangan'),
(217, 1, NULL, 'Memberi keputusan tidak setuju untuk pengajuan penangguhan UKT dari Mahasiswa 3', '2023-06-06 01:42:03', 'Bagian Keuangan'),
(218, 1, NULL, 'Memberi keputusan setuju dan mengirim data pengajuan penangguhan UKT ke Kabag Umum & Akademik', '2023-06-06 01:45:27', 'Bagian Keuangan'),
(219, 7, NULL, 'Memberi keputusan tidak setuju untuk pengajuan penangguhan UKT dari Mahasiswa 3', '2023-06-06 10:51:04', 'Kabag Umum & Akademik'),
(220, 7, NULL, 'Memberi keputusan setuju data pengajuan penangguhan UKT Mahasiwa yang bernama Mahasiswa 3', '2023-06-06 10:59:14', 'Kabag Umum & Akademik'),
(221, 1, NULL, 'Memberi keputusan tidak setuju untuk pengajuan penangguhan UKT dari Mahasiswa 3', '2023-06-06 11:24:53', 'Bagian Keuangan'),
(222, 1, NULL, 'Memberi keputusan setuju dan mengirim data pengajuan penangguhan UKT ke Kabag Umum & Akademik', '2023-06-06 11:26:12', 'Bagian Keuangan'),
(223, 7, NULL, 'Memberi keputusan tidak setuju untuk pengajuan penangguhan UKT dari Mahasiswa 3', '2023-06-06 11:26:36', 'Kabag Umum & Akademik'),
(224, 7, NULL, 'Memberi keputusan setuju data pengajuan penangguhan UKT Mahasiwa yang bernama Mahasiswa 3', '2023-06-06 11:26:57', 'Kabag Umum & Akademik'),
(225, 7, NULL, 'Melakukan edit profil', '2023-06-06 12:05:10', 'Kabag Umum & Akademik'),
(226, 7, NULL, 'Melakukan edit profil', '2023-06-06 12:05:15', 'Kabag Umum & Akademik'),
(227, 7, NULL, 'Melakukan edit profil', '2023-06-06 12:15:51', 'Kabag Umum & Akademik'),
(228, 7, NULL, 'Memberi keputusan setuju data pengajuan penangguhan UKT Mahasiwa yang bernama Mahasiswa 3', '2023-06-06 12:28:59', 'Kabag Umum & Akademik'),
(229, 1, NULL, 'Memberi keputusan setuju dan mengirim data pengajuan penangguhan UKT ke Kabag Umum & Akademik', '2023-06-06 13:28:30', 'Bagian Keuangan'),
(230, 7, NULL, 'Memberi keputusan setuju data pengajuan penangguhan UKT Mahasiwa yang bernama Mahasiswa 3', '2023-06-06 13:28:56', 'Kabag Umum & Akademik'),
(231, 1, NULL, 'Melakukan edit pengaturan', '2023-06-06 15:04:20', 'Bagian Keuangan'),
(232, 7, NULL, 'Memberi keputusan setuju data pengajuan penangguhan UKT Mahasiwa yang bernama Mahasiswa 3', '2023-06-06 15:06:28', 'Kabag Umum & Akademik'),
(233, 1, NULL, 'Melakukan edit pengaturan', '2023-06-06 21:38:11', 'Bagian Keuangan'),
(234, NULL, 21, 'Melakukan pengajuan penurunan UKT ', '2023-06-06 21:43:46', 'Mahasiswa'),
(235, NULL, 21, 'Melakukan edit pengajuan penurunan UKT ', '2023-06-06 21:46:17', 'Mahasiswa'),
(236, NULL, 21, 'Melakukan kirim pengajuan penurunan UKT ', '2023-06-06 21:55:35', 'Mahasiswa'),
(237, NULL, 21, 'Melakukan kirim pengajuan penurunan UKT Mahasiswa dengan NIM 10107003', '2023-06-06 22:03:45', 'Mahasiswa'),
(238, 1, NULL, 'Memberikan jadwal survey pengajuan penurunan UKT Mahasiswa 3', '2023-06-06 22:20:06', 'Bagian Keuangan'),
(239, 1, NULL, 'Memberikan keputusan tidak setuju untuk pengajuan penurunan UKT Mahasiswa 3', '2023-06-06 22:33:30', 'Bagian Keuangan'),
(240, 1, NULL, 'Memberikan keputusan setuju untuk pengajuan penurunan UKT Mahasiswa 3', '2023-06-06 22:42:25', 'Bagian Keuangan'),
(241, 7, NULL, 'Memberikan keputusan tidak setuju untuk pengajuan penurunan UKT Mahasiswa 3', '2023-06-06 23:24:44', 'Kabag Umum & Akademik'),
(242, 7, NULL, 'Memberikan keputusan setuju untuk pengajuan penurunan UKT Mahasiswa 3', '2023-06-06 23:40:52', 'Kabag Umum & Akademik'),
(243, 8, NULL, 'Melakukan hapus mahasiswa dengan NIM 10107050', '2023-06-07 23:58:17', 'Akademik'),
(244, 8, NULL, 'Melakukan hapus mahasiswa dengan NIM 10107042', '2023-06-07 23:58:28', 'Akademik'),
(245, 8, NULL, 'Melakukan hapus mahasiswa dengan NIM 10107042', '2023-06-08 00:05:03', 'Akademik'),
(246, 8, NULL, 'Melakukan hapus mahasiswa dengan NIM 10107055', '2023-06-08 00:05:09', 'Akademik'),
(247, 8, NULL, 'Melakukan edit mahasiswa dengan NIM 10107055', '2023-06-08 00:05:52', 'Akademik'),
(248, NULL, 22, 'Melakukan edit profil', '2023-06-08 20:54:11', 'Mahasiswa'),
(249, 1, NULL, 'Melakukan edit profil', '2023-06-08 21:05:51', 'Bagian Keuangan'),
(250, 1, NULL, 'Melakukan edit profil', '2023-06-08 21:06:10', 'Bagian Keuangan'),
(251, 7, NULL, 'Melakukan edit profil', '2023-06-08 21:27:50', 'Kabag Umum & Akademik'),
(252, NULL, 22, 'Melakukan edit profil', '2023-06-09 01:16:36', 'Mahasiswa'),
(253, 8, NULL, 'Melakukan edit profil', '2023-06-09 01:51:49', 'Akademik');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(50) DEFAULT NULL,
  `tahun_angkatan` year(4) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(30) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `status` enum('Mahasiswa') DEFAULT 'Mahasiswa',
  `id_kelompok_ukt` int(11) DEFAULT NULL,
  `foto_user` text DEFAULT NULL,
  `status_pengajuan` enum('Tidak','Penangguhan','Penurunan') DEFAULT 'Tidak',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `tahun_angkatan`, `prodi`, `nomor_telepon`, `nim`, `email`, `password`, `status`, `id_kelompok_ukt`, `foto_user`, `status_pengajuan`, `created_at`, `updated_at`) VALUES
(22, 'Mahasiswa', NULL, 'D3 Sistem Informasi', '08989784353', 10107004, 'mahasiswa4@gmail.com', '$2y$10$3..nSR4cOdzururkffmmSedqg4tuhmxhx4xEmO5PRj/kZnGmDEPeS', 'Mahasiswa', NULL, '06082023135411Mahasiswa 4.png', 'Tidak', NULL, NULL);

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
(2, 4, '1000000-2000000', 1),
(5, 5, 'Guru', 8);

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

--
-- Dumping data for table `penangguhan_ukt`
--

INSERT INTO `penangguhan_ukt` (`id_penangguhan_ukt`, `id_mahasiswa`, `nama_orang_tua`, `alamat_orang_tua`, `nomor_telepon_orang_tua`, `semester`, `nominal_ukt`, `denda`, `alasan`, `angsuran_pertama`, `angsuran_kedua`, `tanggal_angsuran_pertama`, `tanggal_angsuran_kedua`, `tanggal_wawancara`, `jam_wawancara`, `jenis_wawancara`, `link_wawancara`, `status_penangguhan`, `tanggal_pengajuan`, `bagian_keuangan`, `kabag`) VALUES
(6, 17, 'Nama Orang Tua', 'Subang', '0893489734', 2, 1000000, 50000, 'Alasan', 20322, 200000, '2023-05-16', '2023-05-18', '2023-05-17', '10:33', 'Online', 'http://localhost:8000/kelola-penangguhan-ukt', 'Setuju', '2023-05-15 00:00:00', 'Bu Ida', NULL),
(7, 18, 'Nama Orang Tua', 'Subang', '089886554566', 3, 1000000, 50000, 'Alasan', 500000, 500000, '2023-05-22', '2023-05-22', NULL, NULL, 'Online', NULL, 'Setuju', '2023-05-22 11:37:00', 'Bu Ida', NULL),
(8, 19, 'Nama Orang Tua', 'Subang', '08989786786', 3, 1000000, 50000, 'Alasan', 525000, 525000, '2023-06-08', '2023-06-25', '2023-06-07', '22:00', 'Online', 'http://localhost:8000/kelola-penangguhan-ukt', 'Setuju', '2023-05-26 21:54:11', 'Bu Ida', NULL),
(9, 22, 'Nama Orang Tua', 'Subang', '089839832423', 2, 1000000, 50000, 'Alasan', 525000, 525000, '2023-06-30', '2023-07-31', '2023-06-07', '14:00', 'Online', 'http://localhost:8000/kelola-penangguhan-ukt', 'Proses di Kepala Bagian', '2023-06-05 21:52:53', 'Bu Ida', 'Kepala Bagian Umum');

-- --------------------------------------------------------

--
-- Table structure for table `penentuan_ukt`
--

CREATE TABLE `penentuan_ukt` (
  `id_penentuan_ukt` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `tanggal_penentuan` datetime DEFAULT NULL,
  `status_penentuan` enum('Proses','Setuju','Tidak Setuju') DEFAULT NULL,
  `bagian_keuangan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penentuan_ukt`
--

INSERT INTO `penentuan_ukt` (`id_penentuan_ukt`, `id_mahasiswa`, `tanggal_penentuan`, `status_penentuan`, `bagian_keuangan`) VALUES
(1, 22, '2023-06-01 21:22:06', 'Proses', 'Bagian Keuangan');

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

--
-- Dumping data for table `penurunan_ukt`
--

INSERT INTO `penurunan_ukt` (`id_penurunan_ukt`, `id_mahasiswa`, `alamat_rumah`, `semester`, `tanggal_survey`, `status_penurunan`, `tanggal_pengajuan`, `surat_pengajuan`, `sktm`, `khs`, `struk_listrik`, `foto_rumah`, `slip_gaji`, `bagian_keuangan`, `kabag`) VALUES
(2, 17, 'Suabng', 5, '2023-05-31', 'Setuju', '2023-05-21 18:21:41', '05212023181358 Surat Pengajuan Renaldi.pdf', '05212023181358 SKTM Renaldi.pdf', '05212023181358 KHS Renaldi.pdf', '05212023181358 Struk Listrik Renaldi.pdf', '05212023181358 Foto Rumah Renaldi.pdf', '05212023181358 Slip Gaji Renaldi.pdf', NULL, NULL),
(3, 20, 'Subang', 6, '2023-05-31', 'Setuju', '2023-05-24 09:43:47', '05242023094256 Surat Pengajuan Mahasiswa 2.pdf', '05242023094256 SKTM Mahasiswa 2.pdf', '05242023094256 KHS Mahasiswa 2.pdf', '05242023094256 Struk Listrik Mahasiswa 2.pdf', '05242023094256 Foto Rumah Mahasiswa 2.pdf', '05242023094256 Slip Gaji Mahasiswa 2.pdf', NULL, NULL),
(6, 19, 'Jl. Mayjen Sutoyo No.46, Karanganyar, Kec. Subang, Kab. Subang, Jawa Barat 41211', 3, '2023-06-07', 'Setuju', '2023-05-26 23:07:42', '05262023230713 Surat Pengajuan Mahasiswa 1.pdf', '05262023230713 SKTM Mahasiswa 1.pdf', '05262023230713 KHS Mahasiswa 1.pdf', '05262023230713 Struk Listrik Mahasiswa 1.pdf', '05262023230713 Foto Rumah Mahasiswa 1.pdf', '05262023230713 Slip Gaji Mahasiswa 1.pdf', NULL, NULL),
(8, 22, 'Jl. Mayjen Sutoyo No.46, Karanganyar, Kec. Subang, Kab. Subang, Jawa Barat 41211', 4, '2023-06-30', 'Proses di Kepala Bagian', '2023-06-06 22:03:45', '06062023214617 Surat Pengajuan Mahasiswa 3.pdf', '06062023214617 SKTM Mahasiswa 3.pdf', '06062023214617 KHS Mahasiswa 3.pdf', '06062023214617 Struk Listrik Mahasiswa 3.pdf', '06062023214617 Foto Rumah Mahasiswa 3.pdf', '06062023214617 Slip Gaji Mahasiswa 3.pdf', 'Bu Ida', 'Kepala Bagian Umum');

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
  `tanda_tangan_kabag` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `batas_ukt_penangguhan`, `batas_ukt_penurunan`, `persen_denda`, `persen_angsuran_pertama`, `batas_tanggal_angsuran`, `form_penurunan_sktm`, `form_penurunan_khs`, `form_penurunan_struk_listrik`, `form_penurunan_slip_gaji`, `form_penurunan_foto_rumah`, `form_penurunan_surat_pengajuan`, `tanda_tangan_kabag`) VALUES
(1, 2, 2, 5, 50, 60, 1, 1, 1, 1, 1, 1, ' Tanda Tangan Kepala Bagian.png');

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
(1, 'Bagian Keuangan', 'renaldinoviandi0@gmail.com', '08989784353', '11111111', '$2y$10$sIgZRbYhk3OmrUSTZBJyH.qMkghMa7bdaAFwODNfSCZ8OIfsB4cZi', 'Bagian Keuangan', '06082023140610 Bagian Keuangan.png'),
(7, 'Kabag Umum & Akademik', 'kabagumum@gmail.com', '08989784353', '22222222', '$2y$10$Mi7m2zB8AeozsKahryXjjOAv02twIJSnZ1yTBj1XcTWplf2t8mhcW', 'Kabag Umum & Akademik', '06052023123151 Kepala Bagian Umum.png'),
(8, 'Akademik', 'akademik@gmail.com', '08989784353', '33333333', '$2y$10$YD65weMRRPxSaNpz.UWNJ.KCc4I4ovIyk4R4imWD914o9COvvqNwe', 'Akademik', '06052023124138 Akademik.png');

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
  MODIFY `id_kelompok_ukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id_nilai_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penangguhan_ukt`
--
ALTER TABLE `penangguhan_ukt`
  MODIFY `id_penangguhan_ukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penentuan_ukt`
--
ALTER TABLE `penentuan_ukt`
  MODIFY `id_penentuan_ukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penurunan_ukt`
--
ALTER TABLE `penurunan_ukt`
  MODIFY `id_penurunan_ukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
