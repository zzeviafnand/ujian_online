-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 Des 2018 pada 02.24
-- Versi Server: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujianonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `nama_jadwal` varchar(50) NOT NULL,
  `keterangan_jadwal` varchar(100) NOT NULL,
  `tanggal_mulai_jadwal` datetime NOT NULL,
  `tanggal_selesai_jadwal` datetime NOT NULL,
  `waktu_jadwal` varchar(3) NOT NULL,
  `status_jadwal` int(1) NOT NULL,
  `pengaturan_jadwal` varchar(10) NOT NULL,
  `id_kbm` int(11) NOT NULL,
  `kode_kelas` varchar(6) NOT NULL,
  `register_petugas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `nama_jadwal`, `keterangan_jadwal`, `tanggal_mulai_jadwal`, `tanggal_selesai_jadwal`, `waktu_jadwal`, `status_jadwal`, `pengaturan_jadwal`, `id_kbm`, `kode_kelas`, `register_petugas`) VALUES
(1, 'Bahasa Indonesia XII RPL & TKJ', 'Ujian Semester Ganjil Bahasa Indonesia XII RPL & TKJ', '2018-12-08 17:17:38', '2018-12-19 23:08:05', '60', 1, '1:1:1', 1, 'RPL121', 'rizkameivani'),
(2, 'Bahasa Indonesia XII RPL & TKJ', 'Ujian Semester Ganjil Bahasa Indonesia XII RPL & TKJ', '2018-12-08 17:17:38', '2018-12-08 17:18:34', '60', 1, '1:1:0', 1, 'TKJ121', 'admin'),
(3, 'Seni Budaya XII RPL & TKJ', 'Ujian Semester Ganjil Seni Budaya XII RPL & TKJ', '2018-12-08 22:21:58', '2018-12-31 22:22:02', '60', 1, '1:1:0', 6, 'RPL121', 'admin'),
(4, 'Seni Budaya XII RPL & TKJ', 'Ujian Semester Ganjil Seni Budaya XII RPL & TKJ', '2018-12-08 22:21:58', '2018-12-31 22:22:02', '60', 1, '1:1:0', 6, 'TKJ121', 'admin'),
(5, 'Bahasa Inggris XII RPL & TKJ', 'Ujian Semester Ganjil Bahasa Inggris  XII RPL & TKJ', '2018-12-08 22:23:30', '2018-12-31 22:22:59', '60', 1, '1:1:0', 2, 'RPL121', 'admin'),
(6, 'Bahasa Inggris XII RPL & TKJ', 'Ujian Semester Ganjil Bahasa Inggris  XII RPL & TKJ', '2018-12-08 22:23:30', '2018-12-31 22:22:59', '60', 1, '1:1:0', 2, 'TKJ121', 'admin'),
(7, 'Bahasa Indonesia X RPL', 'Ujian Semester Ganjil Bahasa Indonesia X RPL', '2018-12-09 19:00:30', '2018-12-31 19:00:02', '60', 1, '0:0:0', 3, 'RPL101', 'admin'),
(8, 'Bahasa Indonesia XI RPL dan TKJ', 'Ujian Semester Ganjil Bahasa Indonesia XI RPL dan TKJ', '2018-12-09 20:57:36', '2018-12-31 20:56:38', '600', 1, '1:1:0', 5, 'RPL111', 'rizkameivani'),
(9, 'Bahasa Indonesia XI RPL dan TKJ', 'Ujian Semester Ganjil Bahasa Indonesia XI RPL dan TKJ', '2018-12-09 20:57:36', '2018-12-31 20:56:38', '60', 1, '0:0:0', 5, 'TKJ111', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawab`
--

CREATE TABLE `jawab` (
  `id` int(11) NOT NULL,
  `nis_siswa` int(5) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_soaljawab` int(11) DEFAULT NULL,
  `hasil_jawab` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jawab`
--

INSERT INTO `jawab` (`id`, `nis_siswa`, `id_jadwal`, `id_soal`, `id_soaljawab`, `hasil_jawab`) VALUES
(1, 4588, 1, 2, 8, 1),
(2, 4588, 1, 1, 2, 1),
(3, 4588, 1, 3, 12, 1),
(4, 4588, 1, 11, 51, 1),
(5, 4588, 1, 14, 68, 1),
(6, 4588, 1, 19, 94, 1),
(7, 4588, 1, 6, 26, 1),
(8, 4588, 1, 7, 33, 1),
(9, 4588, 1, 16, 78, 1),
(10, 4588, 1, 15, 74, 1),
(11, 4588, 1, 10, 49, 1),
(12, 4588, 1, 4, 18, 1),
(13, 4588, 1, 12, 56, 1),
(14, 4588, 1, 18, 86, 1),
(15, 4588, 1, 5, 24, 1),
(16, 4588, 1, 17, 81, 1),
(17, 4588, 1, 8, 38, 1),
(18, 4588, 1, 13, 61, 1),
(19, 4588, 1, 20, 98, 1),
(20, 4588, 1, 9, 42, 1),
(21, 4589, 1, 9, 42, 1),
(22, 4589, 1, 7, 33, 1),
(23, 4589, 1, 17, 84, 2),
(24, 4589, 1, 10, 46, 2),
(25, 4589, 1, 12, 59, 2),
(26, 4589, 1, 8, 38, 1),
(27, 4589, 1, 13, 61, 1),
(28, 4589, 1, 20, 98, 1),
(29, 4589, 1, 4, 18, 1),
(30, 4589, 1, 1, 1, 2),
(31, 4589, 1, 19, 94, 1),
(32, 4589, 1, 5, 24, 1),
(33, 4589, 1, 16, 78, 1),
(34, 4589, 1, 2, 8, 1),
(35, 4589, 1, 15, 75, 2),
(36, 4589, 1, 18, 87, 2),
(37, 4589, 1, 6, 26, 1),
(38, 4589, 1, 3, 12, 1),
(39, 4589, 1, 14, 69, 2),
(40, 4589, 1, 11, 51, 1),
(41, 4584, 1, 18, 87, 2),
(42, 4584, 1, 5, 22, 2),
(43, 4584, 1, 19, 94, 1),
(44, 4584, 1, 9, 42, 1),
(45, 4584, 1, 16, 78, 1),
(46, 4584, 1, 8, 40, 2),
(47, 4584, 1, 11, 51, 1),
(48, 4584, 1, 15, 71, 2),
(49, 4584, 1, 20, 99, 2),
(50, 4584, 1, 4, 17, 2),
(51, 4584, 1, 2, 6, 2),
(52, 4584, 1, 17, 85, 2),
(53, 4584, 1, 7, 33, 1),
(54, 4584, 1, 13, 61, 1),
(55, 4584, 1, 1, 4, 2),
(56, 4584, 1, 6, 26, 1),
(57, 4584, 1, 3, 12, 1),
(58, 4584, 1, 14, 69, 2),
(59, 4584, 1, 10, 48, 2),
(60, 4584, 1, 12, 60, 2),
(61, 4585, 1, 4, 20, 2),
(62, 4585, 1, 5, 21, 2),
(63, 4585, 1, 8, 38, 1),
(64, 4585, 1, 13, 64, 2),
(65, 4585, 1, 17, 85, 2),
(66, 4585, 1, 20, 100, 2),
(67, 4585, 1, 6, 30, 2),
(68, 4585, 1, 11, 53, 2),
(69, 4585, 1, 16, 77, 2),
(70, 4585, 1, 1, 4, 2),
(71, 4585, 1, 9, 44, 2),
(72, 4585, 1, 7, 34, 2),
(73, 4585, 1, 19, 93, 2),
(74, 4585, 1, 18, 88, 2),
(75, 4585, 1, 12, 57, 2),
(76, 4585, 1, 3, 14, 2),
(77, 4585, 1, 15, 71, 2),
(78, 4585, 1, 10, 49, 1),
(79, 4585, 1, 14, 69, 2),
(80, 4585, 1, 2, 6, 2),
(88, 1007, 8, 34, 160, 2),
(89, 1007, 8, 33, 164, 3),
(90, 4588, 3, 25, 123, 2),
(91, 4588, 3, 29, 144, 2),
(92, 4588, 3, 21, 101, 1),
(93, 4588, 3, 27, NULL, 0),
(94, 4588, 3, 23, NULL, 0),
(95, 4588, 3, 24, NULL, 0),
(96, 4588, 3, 26, NULL, 0),
(97, 4588, 3, 30, NULL, 0),
(98, 4588, 3, 28, NULL, 0),
(99, 4588, 3, 22, NULL, 0),
(100, 4585, 3, 30, 149, 1),
(101, 4585, 3, 24, NULL, 0),
(102, 4585, 3, 22, NULL, 0),
(103, 4585, 3, 23, NULL, 0),
(104, 4585, 3, 29, NULL, 0),
(105, 4585, 3, 21, NULL, 0),
(106, 4585, 3, 26, NULL, 0),
(107, 4585, 3, 28, NULL, 0),
(108, 4585, 3, 27, NULL, 0),
(109, 4585, 3, 25, NULL, 0),
(110, 1009, 8, 33, NULL, 0),
(111, 1009, 8, 34, 163, 1),
(112, 4590, 1, 15, 71, 2),
(113, 4590, 1, 14, 70, 2),
(114, 4590, 1, 2, 10, 2),
(115, 4590, 1, 16, 77, 2),
(116, 4590, 1, 6, 26, 1),
(117, 4590, 1, 20, 98, 1),
(118, 4590, 1, 1, NULL, 0),
(119, 4590, 1, 17, NULL, 0),
(120, 4590, 1, 5, NULL, 0),
(121, 4590, 1, 19, NULL, 0),
(122, 4590, 1, 13, NULL, 0),
(123, 4590, 1, 4, NULL, 0),
(124, 4590, 1, 10, NULL, 0),
(125, 4590, 1, 11, NULL, 0),
(126, 4590, 1, 7, NULL, 0),
(127, 4590, 1, 9, NULL, 0),
(128, 4590, 1, 18, NULL, 0),
(129, 4590, 1, 8, NULL, 0),
(130, 4590, 1, 3, NULL, 0),
(131, 4590, 1, 12, NULL, 0),
(132, 4594, 1, 19, NULL, 0),
(133, 4594, 1, 20, NULL, 0),
(134, 4594, 1, 12, NULL, 0),
(135, 4594, 1, 7, NULL, 0),
(136, 4594, 1, 8, NULL, 0),
(137, 4594, 1, 6, NULL, 0),
(138, 4594, 1, 2, NULL, 0),
(139, 4594, 1, 11, NULL, 0),
(140, 4594, 1, 5, NULL, 0),
(141, 4594, 1, 1, NULL, 0),
(142, 4594, 1, 17, NULL, 0),
(143, 4594, 1, 4, NULL, 0),
(144, 4594, 1, 15, NULL, 0),
(145, 4594, 1, 16, NULL, 0),
(146, 4594, 1, 9, NULL, 0),
(147, 4594, 1, 14, NULL, 0),
(148, 4594, 1, 13, NULL, 0),
(149, 4594, 1, 3, NULL, 0),
(150, 4594, 1, 10, NULL, 0),
(151, 4594, 1, 18, NULL, 0),
(152, 4593, 1, 17, NULL, 0),
(153, 4593, 1, 4, NULL, 0),
(154, 4593, 1, 3, NULL, 0),
(155, 4593, 1, 8, NULL, 0),
(156, 4593, 1, 11, NULL, 0),
(157, 4593, 1, 18, NULL, 0),
(158, 4593, 1, 1, NULL, 0),
(159, 4593, 1, 19, NULL, 0),
(160, 4593, 1, 12, NULL, 0),
(161, 4593, 1, 6, NULL, 0),
(162, 4593, 1, 10, NULL, 0),
(163, 4593, 1, 2, NULL, 0),
(164, 4593, 1, 7, NULL, 0),
(165, 4593, 1, 9, NULL, 0),
(166, 4593, 1, 13, NULL, 0),
(167, 4593, 1, 14, NULL, 0),
(168, 4593, 1, 15, NULL, 0),
(169, 4593, 1, 5, NULL, 0),
(170, 4593, 1, 16, NULL, 0),
(171, 4593, 1, 20, NULL, 0),
(172, 4593, 3, 27, 132, 2),
(173, 4593, 3, 21, 103, 2),
(174, 4593, 3, 25, 124, 2),
(175, 4593, 3, 26, 128, 2),
(176, 4593, 3, 30, 149, 1),
(177, 4593, 3, 29, 142, 2),
(178, 4593, 3, 24, 118, 1),
(179, 4593, 3, 22, 108, 1),
(180, 4593, 3, 23, 115, 1),
(181, 4593, 3, 28, 140, 2),
(182, 4598, 1, 10, NULL, 0),
(183, 4598, 1, 4, NULL, 0),
(184, 4598, 1, 6, NULL, 0),
(185, 4598, 1, 2, NULL, 0),
(186, 4598, 1, 20, NULL, 0),
(187, 4598, 1, 14, NULL, 0),
(188, 4598, 1, 8, NULL, 0),
(189, 4598, 1, 15, 72, 2),
(190, 4598, 1, 12, NULL, 0),
(191, 4598, 1, 13, NULL, 0),
(192, 4598, 1, 7, NULL, 0),
(193, 4598, 1, 5, NULL, 0),
(194, 4598, 1, 17, NULL, 0),
(195, 4598, 1, 9, NULL, 0),
(196, 4598, 1, 18, NULL, 0),
(197, 4598, 1, 1, 3, 2),
(198, 4598, 1, 3, NULL, 0),
(199, 4598, 1, 19, NULL, 0),
(200, 4598, 1, 16, NULL, 0),
(201, 4598, 1, 11, NULL, 0),
(202, 4586, 1, 20, 98, 1),
(203, 4586, 1, 17, NULL, 0),
(204, 4586, 1, 12, NULL, 0),
(205, 4586, 1, 6, NULL, 0),
(206, 4586, 1, 14, NULL, 0),
(207, 4586, 1, 15, NULL, 0),
(208, 4586, 1, 7, NULL, 0),
(209, 4586, 1, 5, NULL, 0),
(210, 4586, 1, 19, NULL, 0),
(211, 4586, 1, 13, NULL, 0),
(212, 4586, 1, 4, NULL, 0),
(213, 4586, 1, 11, NULL, 0),
(214, 4586, 1, 1, NULL, 0),
(215, 4586, 1, 18, NULL, 0),
(216, 4586, 1, 3, NULL, 0),
(217, 4586, 1, 9, NULL, 0),
(218, 4586, 1, 16, NULL, 0),
(219, 4586, 1, 10, NULL, 0),
(220, 4586, 1, 8, NULL, 0),
(221, 4586, 1, 2, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `kode_jurusan` varchar(5) NOT NULL,
  `nama_jurusan` varchar(40) NOT NULL,
  `register_petugas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`kode_jurusan`, `nama_jurusan`, `register_petugas`) VALUES
('A01', 'Akuntansi', 'marfiaulfa'),
('RPL01', 'Rekayasa Perangkat Lunak', 'marfiaulfa'),
('TKJ01', 'Teknik Komputer Jaringan', 'syujaafifah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kbm`
--

CREATE TABLE `kbm` (
  `id_kbm` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `kode_semester` varchar(8) NOT NULL,
  `register_petugas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kbm`
--

INSERT INTO `kbm` (`id_kbm`, `id_mapel`, `kode_semester`, `register_petugas`) VALUES
(1, 1, 'TAS18195', 'indahlestari'),
(2, 6, 'TAS18195', 'dafitpranata'),
(3, 7, 'TAS18195', 'silvyarahayu'),
(4, 9, 'TAS18195', 'salsafebrianti'),
(5, 1, 'TAS18193', 'syujaafifah'),
(6, 5, 'TAS18195', 'marfiaulfa'),
(7, 2, 'TAS18193', 'silvyarahayu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(8) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kode_jurusan` varchar(5) DEFAULT NULL,
  `kode_tahunajaran` varchar(6) NOT NULL,
  `register_petugas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`, `kode_jurusan`, `kode_tahunajaran`, `register_petugas`) VALUES
('RPL101', '10RPL', 'RPL01', 'TA1819', 'indahlestari'),
('RPL111', '11RPL', 'RPL01', 'TA1819', 'dafitpranata'),
('RPL121', '12RPL', 'RPL01', 'TA1819', 'silvyarahayu'),
('TKJ101', '10TKJ', 'TKJ01', 'TA1819', 'salsafebrianti'),
('TKJ111', '11TKJ', 'TKJ01', 'TA1819', 'syujaafifah'),
('TKJ121', '12TKJ', 'TKJ01', 'TA1819', 'marfiaulfa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `kategori_mapel` int(1) NOT NULL,
  `kkm_mapel` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `kategori_mapel`, `kkm_mapel`) VALUES
(1, 'Bahasa Indonesia', 1, 75),
(2, 'Pendidikan Agama Islam', 1, 75),
(3, 'Pendidikan Kewarganegaraan', 1, 75),
(4, 'Penjas, Olahraga dan Kesehatan', 1, 75),
(5, 'Seni Budaya', 1, 75),
(6, 'Bahasa Inggris', 2, 75),
(7, 'Matematika', 2, 75),
(8, 'Fisika', 2, 80),
(9, 'Kimia', 2, 80),
(10, 'Kewirausahaan', 2, 75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `register_petugas` varchar(30) NOT NULL,
  `nipk_petugas` varchar(20) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `tempat_petugas` varchar(40) NOT NULL,
  `tanggal_petugas` date NOT NULL,
  `kelamin_petugas` int(1) NOT NULL,
  `telepon_petugas` varchar(15) NOT NULL,
  `alamat_petugas` varchar(100) NOT NULL,
  `level_petugas` int(1) NOT NULL,
  `password_petugas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`register_petugas`, `nipk_petugas`, `nama_petugas`, `tempat_petugas`, `tanggal_petugas`, `kelamin_petugas`, `telepon_petugas`, `alamat_petugas`, `level_petugas`, `password_petugas`) VALUES
('admin', '1209082102000003', 'Febri Hidayan', 'Sei Beluru', '1998-02-21', 1, '082283503608', 'Perumahan Fajar Kualu Damai II, Jl. Suka Karya Blok E No.8', 1, '$2y$10$Z.02Oj7ALohvdQLpOTz4Q.zTipDH04VRohOul/i2CR9xiXsLrUKjO'),
('dafitpranata', '202020', 'Dafit Pranata', 'Pekanbaru', '2001-05-11', 1, '081374000124', 'Jl. Subrantas Km 12 No. 231', 3, '$2y$10$x9X3bWUKc6/iyeKyrdtSquCDwuvxAL5R3eBi1bhhI8eeGdPDCDvZC'),
('indahlestari', '202020', 'Indah Lestari', 'Pekanbaru', '1998-04-08', 2, '082282828282', 'Jl. Bangau Sakti No. 1', 3, '$2y$10$ew9q3xW.KJoBpIEGfa9XoOCfl0BDZURcHFR9SAaP.V4Rz9sju9rPi'),
('maharani', '1299222999000', 'Maharani Purnama Fitri', '', '0000-00-00', 2, '081288039271', 'Jl. Air Hitam Km 4', 2, '$2y$10$mMADmbnsFxsaces1AzKUpuxYwsjXQsOUsK5oRNjeg/IZk6R1G5cJq'),
('marfiaulfa', '1209082102000003', 'Marfia Ulfa', '', '0000-00-00', 2, '08228388800', 'Jl. Ahmad Yani KM 08 No. 348', 3, '$2y$10$EphsXST8DmfnvpzpT5R0PeaTx9fkZ9ocPDfxX5cgNUwk9Wku0.hYm'),
('rizkameivani', '1299222999000', 'Rizka Meivani', '', '0000-00-00', 2, '081374000124', 'Jl. Ampelan Juanda No. 87', 4, '$2y$10$P3KxNoTwPoJ6N4rIfGAZxui3Zie9vz1xocTT4LU21uC1984zP6APG'),
('salsafebrianti', '202020', 'Salsa Febrianti', '', '0000-00-00', 2, '08228388800', 'Gang. Jingkau, Jl. Teropong No. 8', 3, '$2y$10$mBn63V7vWglHe4Jf7IuhkO6QygbUVw0WAz7f/1o1vvmUnT3uQff56'),
('silvyarahayu', '938384373837373', 'Silvya Rahayu', '', '0000-00-00', 2, '08130022883', 'Jl. Suka Jadi No. 9', 3, '$2y$10$cO0asItwiLsopWjblsBuleFA8hOoNcphbFrz894rcTwED1es.0Fii'),
('syujaafifah', '938384373837373', 'Syuja Afifah', '', '0000-00-00', 2, '082283503999', 'Jl. Sokarno Hatta No. 467', 3, '$2y$10$FnRxLq.PSY0g1dRROirmm.izgcYWkTfGb4V2cgiH4T.VHv6GsULiG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `kode_semester` varchar(8) NOT NULL,
  `kategori_semester` int(1) NOT NULL,
  `kode_tahunajaran` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`kode_semester`, `kategori_semester`, `kode_tahunajaran`) VALUES
('TAS18191', 1, 'TA1920'),
('TAS18193', 3, 'TA1920'),
('TAS18195', 5, 'TA1920');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis_siswa` int(5) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelamin_siswa` int(1) NOT NULL,
  `tempat_siswa` varchar(40) NOT NULL,
  `tanggal_siswa` date NOT NULL,
  `kode_kelas` varchar(8) NOT NULL,
  `telepon_siswa` varchar(15) NOT NULL,
  `status_siswa` int(1) NOT NULL DEFAULT '1',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pengaturan_siswa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis_siswa`, `nama_siswa`, `kelamin_siswa`, `tempat_siswa`, `tanggal_siswa`, `kode_kelas`, `telepon_siswa`, `status_siswa`, `username`, `password`, `pengaturan_siswa`) VALUES
(1001, 'Friska Julia Putri', 2, 'Pekanbaru', '2000-02-02', 'RPL101', '0822829900', 1, '1001', '$2y$10$JEcrvif5qlzm6kNKeWJ24e5Pb5tuZxxaleAN2EhwxTWMmPGGvp52u', NULL),
(1002, 'Amanda Sonya', 2, 'Pekanbaru', '2000-02-02', 'RPL101', '0822829900', 1, '1002', '$2y$10$yeAnQ9HKZTg1oM8f2wcrPugTbkft43a3c6xbZajuDXVm2JRSBKJ/6', NULL),
(1003, 'Naufal Mufadol', 1, 'Pekanbaru', '2000-02-02', 'RPL101', '0822829900', 1, '1003', '$2y$10$w.4WDf1uNLI0uV84vkT3u.OKPOOoUDFpLFPM4pyx0zetyqHeSfepi', NULL),
(1004, 'Eka Setia Wati', 2, 'Pekanbaru', '2000-02-02', 'RPL101', '0822829900', 1, '1004', '$2y$10$h5VzOqPRXBeVitYbdTMnuuZb8OVvfs/Sod.t1X.yPs.t94xrhVLmq', NULL),
(1005, 'Taufik Hidayat', 1, 'Pekanbaru', '2000-02-02', 'RPL101', '0822829900', 1, '1005', '$2y$10$6K1ab9OlDXyZYo/JHaTqG.9kRQc47G83y29Lx9uG03ym0ebXxtDsq', NULL),
(1006, 'Pagita Ria', 2, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1006', '$2y$10$SJZaHdOnFjf9ZuhDqZyO..I59zoDFQSe7nX0yoE/e7R48pevxlD9O', '0:58:14:8:0:1'),
(1007, 'Deni Kusuma Atmaja', 1, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1007', '$2y$10$3d9XXzWtOr2UUbVMgXbvLuCsf3H7pfwaTLAQ/vfZgLMv.gC/xqmlS', '9:13:8:8:0:1'),
(1008, 'Rizka Fadillah', 2, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1008', '$2y$10$aiLJPlHhNyDit8Ff.0x98ufKpCXFWGP3uv1YyHeqL9Mljw/tYmg6K', NULL),
(1009, 'Azli Alvarizi', 1, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1009', '$2y$10$PaDxSRwMM0IBN9oz6IvjtuXyF5iIelv.B5FzIQswSE54mHJc8ZvrO', NULL),
(1010, 'Fitri Amalia', 2, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1010', '$2y$10$xgXPFhaeg9Cv2uDTaGJe1.zRmSMFU4oIuR5pWAa.Ivql.yPpUrUiO', NULL),
(1011, 'Racha Syahfitri', 1, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1011', '$2y$10$aKd60xKjl6e0DGLH8jhRk.rrT6/J41vkl2X./0Ky27ys2zz25KHM2', '0:34:50:8:0:0'),
(1012, 'Tika Lestari', 2, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1012', '$2y$10$LbPOt1EUlZdoEGCbghAKouavErpHdZtHBnXZPledA6uGnTPaKcKqC', NULL),
(1013, 'Baida Julia Putri', 2, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1013', '$2y$10$4VokQ3HmXmc.fL7VsPjDzuTOY7c1HwaitCra9EX70D2p2lYi6Q6Gm', NULL),
(1014, 'Dian Syaputra', 1, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1014', '$2y$10$2YbwAhE.QRiDEusJqcJTdOeNP4PbYIxzcJbdENqoQBFerU5FnrjU6', NULL),
(1015, 'Putri Ramadani', 2, 'Pekanbaru', '2000-02-02', 'RPL111', '0822829900', 1, '1015', '$2y$10$O.70lgFdoX4QRvp8GlcgT.SE3mhjnt9XsDCUKXwb0uKcaI8ByFbNu', NULL),
(1016, 'Rini Indriani', 2, 'Pekanbaru', '2000-02-02', 'TKJ101', '0822829900', 1, '1016', '$2y$10$n9gmfHcYvK8ino7ASVlU7OEwRV7S8iD8Q1x0p2eiV0VICPzLbNS.m', NULL),
(1017, 'Bima Ardiansyaha', 1, 'Pekanbaru', '2000-02-02', 'TKJ101', '0822829900', 1, '1017', '$2y$10$JcnOhBiXIFbDcJ2Yskfqb.6fMTMdkAynFA5/cS9jaFixfyws5xFjW', NULL),
(1018, 'Fitri Ani', 2, 'Pekanbaru', '2000-02-02', 'TKJ101', '0822829900', 1, '1018', '$2y$10$.1atS9XuNjQ9Qu1BDnyLzOz8Jz4Yi/psbaOtE4rttGHJfxuCVlca2', NULL),
(1019, 'Alif Latina Dava', 2, 'Pekanbaru', '2000-02-02', 'TKJ101', '0822829900', 1, '1019', '$2y$10$UlvTGRvVscKPAmFmONYZXe0gqIGomNC4bvyuX9HcG/AlKr3/DKx1i', NULL),
(1020, 'Atika Lestary', 2, 'Pekanbaru', '2000-02-02', 'TKJ101', '0822829900', 1, '1020', '$2y$10$z5xZtYRGI3JQVA3pkP6bnOz6vZGxN/7Tzj3yD2HWJu09LIVQdnyjW', NULL),
(1021, 'Reni Mirnayana', 2, 'Pekanbaru', '2000-02-02', 'TKJ111', '0822829900', 1, '1021', '$2y$10$jwvq25FkA8PWyT7kuAagyeDccobdMIJrhfHNYc/AeKfiJOKWp88jK', NULL),
(1022, 'Dinda Monisa', 2, 'Pekanbaru', '2000-02-02', 'TKJ111', '0822829900', 1, '1022', '$2y$10$CC9FuigMYLLae1RyGWp4kOdp4U6GmjgyVo5y6ABddVt1aA6sCyuSS', NULL),
(1023, 'Anisa Pujiyanti', 2, 'Pekanbaru', '2000-02-02', 'TKJ111', '0822829900', 1, '1023', '$2y$10$i66/gttz8VvbvI4GFCgtfeQZRmNFauvfT8RaIVpRr1IsRfIqNRbMC', NULL),
(1024, 'Mulia Putri', 2, 'Pekanbaru', '2000-02-02', 'TKJ111', '0822829900', 1, '1024', '$2y$10$uApGck7pdYNcuc3KNUCI0Oa9lOtoe0YScYjHPAe2fQFMkelhEZLo.', NULL),
(1025, 'Sunariatik RIa', 2, 'Pekanbaru', '2000-02-02', 'TKJ111', '0822829900', 1, '1025', '$2y$10$CzAQWcBx2.YKBo4JUNFq4ul2ItIaWXX5ZWf8mRVveKumwM2aNeG5q', NULL),
(1026, 'Indah Novita Sari', 2, 'Pekanbaru', '2000-02-02', 'TKJ121', '0822829900', 1, '1026', '$2y$10$6/ti685DeBDLHdaNny.IBOhu0yRjNnmW6b9va3xU2WvKl1mMNtszO', NULL),
(1027, 'Yuli Sartika', 2, 'Pekanbaru', '2000-02-02', 'TKJ121', '0822829900', 1, '1027', '$2y$10$V3le1XTsbj8lPvXtUaW2teaPy8KnA7sHtkj3pLaaQtdBWnIGzAgJG', NULL),
(1028, 'Arwan Sipanayungan', 1, 'Pekanbaru', '2000-02-02', 'TKJ121', '0822829900', 1, '1028', '$2y$10$IFHa/RUKXWznQHDVlP0v1uX4EwNTTaBqYe1sKayhlA1D27WXw7SOe', NULL),
(1029, 'Alya Seneti', 2, 'Pekanbaru', '2000-02-02', 'TKJ121', '0822829900', 1, '1029', '$2y$10$p0AD6TjUsth/TUQbibo9gOrdabkzgpENTAi9i96VJwmwt8Swg/fxS', NULL),
(1030, 'Muhammad Devi Riswandi', 2, 'Pekanbaru', '2000-02-02', 'TKJ121', '0822829900', 1, '1030', '$2y$10$1Hbo393/4/cYfzJdqJUflO6IAJvfVEwO49KaXMfutjvHwR8Do8HwK', NULL),
(4584, 'Abdul Muttaqin', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4584', '$2y$10$GLQJFXQyupD85hHIPyWjQ.IVTC9nxQnzN/UL.jGK7iJ.6CDTxRnNy', NULL),
(4585, 'Adel Gustinigo', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4585', '$2y$10$E8dIOjpSCuchHm4MTON6FuUjni43htx0Q4UkzfFhRxEZv3CRNINeC', NULL),
(4586, 'Ahmad Miftah Hidayat', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4586', '$2y$10$l3uyibkBX19ph2thrYM29.ZDPySCmdX67RwoTObfqhbfr7w.pcUCG', '0:33:13:1:0:0'),
(4587, 'Arlan Joliansa Indruru', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4587', '$2y$10$9K9wi3cfr3eadlxtC8cuvORqLAM1L9TXmnKYf3/QvaLnCFOIoEKem', NULL),
(4588, 'Febri Hidayan', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4588', '$2y$10$1wf/zfvvGKEYCHgIi/zFz.V1szQX1UXlyyR0vCksOnSWf6tf.DluK', '0:59:38:3:0:0'),
(4589, 'Husnul Hotimah', 2, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4589', '$2y$10$rjrDJ3ba5cPWkwYAgRyUCOOyqYYxgXDwUKONemGH2WN3oZ4FVV3ju', NULL),
(4590, 'Jefri Gunawan', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4590', '$2y$10$hBhq6rLI32O4vCogkC28DOghZRhnYkww4rIJSsI.cFVXFaOlIBXPq', NULL),
(4591, 'M. Mario Arya Putra', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4591', '$2y$10$PKK0MiwAi5534oVsdDWUH.TBfD71ua7qCme8p1jQ/fuL8icp4Rn9G', NULL),
(4592, 'M. Rohan Balma', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4592', '$2y$10$Q70PAQZY//jqS6OfkQ2KTuW9vbVQdhU.NrXEQTSt0kioAD08an/1G', NULL),
(4593, 'Muhammad Farhan', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4593', '$2y$10$iRJ7aN/F.Wh2pvmsHSAT..ytV.1m8kC34NoFQ/jR9FM3GY5lAHNYa', NULL),
(4594, 'Muhammad Haikal Al-Anshari', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4594', '$2y$10$bMtAX3eMfj32zcNvKLxPAeFU6qcdYaXAd1JG/rY1pyVMRfPgvU0lO', NULL),
(4596, 'Nadyatul Khairiah', 2, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4596', '$2y$10$7WPhxeP68n.Zyi4IkKyh6ulo.2ZmwD4D1lqmlwT18Eg.as4qiCBPy', NULL),
(4598, 'Nofi Azizah', 2, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4598', '$2y$10$duf1tix4wkPiI8ybLJLpnuMJp0GJjJ10xTgPVa/gHA7AWvvkRnyqK', '0:34:3:1:0:0'),
(4600, 'Putri Ghamelia', 2, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4600', '$2y$10$g.uITUcdN51j3RDp4/Q85.K0ZddoSayA/OFjuFvSZgTDp9RFHPHM2', NULL),
(4601, 'Rafi Nur Ibrahim', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4601', '$2y$10$IO1otIxqZ6NG1bawAEoMnu4q3XpUBCAV1UEDQeMKF2ViyAZdbtpDC', NULL),
(4602, 'Rahmat Suzanto Pratama', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4602', '$2y$10$M29Ym7XAW.76ZpyjtqSQXuylOff2BWV2Jb9TuO5C4A7rd3EbJqTGe', NULL),
(4603, 'Rahmat Zidan', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4603', '$2y$10$3IKGbwVHoAUo6h40zggoi.ONmK/3MZT7hiKHQu821zTGCugH3Ys1.', NULL),
(4604, 'Raihan', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4604', '$2y$10$9I/5pm48dcCkBn6etLZZf.U/yFUtjpoHXk0tkNM.W33kejpfCWWg.', NULL),
(4605, 'SalsaBilla', 2, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4605', '$2y$10$stvKHy0h/42BLdnCYStYZuxUAZhO85rk.j9I0RoG5L6h6o.UoaAhS', NULL),
(4606, 'Syyaidah Rofilah Anindi', 2, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4606', '$2y$10$1DiytufpIv82ufe9JP63IOWUY95F2AGbS.nhJ8VT9UKyEypD2m67i', NULL),
(4607, 'Wihardinata Restu Wiguna', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4607', '$2y$10$D3j2le.vP0kN1SQ0P2K97.TLFJbXZddmZRZ9mXT3TAa5DwDCJLXgW', NULL),
(4608, 'Yusep Sardianto', 1, 'Pekanbaru', '2000-05-23', 'RPL121', '082283894900', 1, '4608', '$2y$10$cZdLBliMv6CiLaILDjmywO5Pjd9A5FBXQeCKY49abEVYkt6ZcLVtW', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_kbm` int(11) NOT NULL,
  `kategori_soal` int(1) NOT NULL,
  `text_soal` text NOT NULL,
  `skor_soal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `id_kbm`, `kategori_soal`, `text_soal`, `skor_soal`) VALUES
(1, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<div class=\"ckeditor-html5-video\" data-responsive=\"true\" style=\"text-align: center;\">\r\n<video controls=\"controls\" src=\"uploads/files/Video/Facebook.MP4\" style=\"max-width: 100%; height: auto;\">&nbsp;</video>\r\n</div>\r\n\r\n<p>Era globalisasi membawa dampak ganda. Di satu sisi, membawa iklim yang semakin terbuka untuk bekerja sama mengisi dan saling melengkapi kepentingan bersama. misalnya dalam bidang ekonomi. Di sisi lain, juga menghasilkan situasi persaingan yang makin ketat dan tajam. Era ini menjanjikan masa depan yang makin cerah bagi negara yang bersunggu-sungguh menghadapi globalisasi.</p>\r\n\r\n<p>Gagasan pokok paragraf tersebut adalah....</p>\r\n', 5),
(2, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p><img alt=\"\" src=\"uploads/images/Screenshot%20(7).png\" /></p>\r\n\r\n<p>Berikut ini adalah cara untuk mendapatkan kenyamanan saat melakukan perjalanan menggunakan pesawat. Biasakan datang lebih awal saat memilih tempat duduk. Pilihlah barang bawaan menjadi dua, yaitu untuk dibawa masuk kabin pesawat dan yang harus masuk bagasi. Siapkan bacaan dan lepaslah sepetu Anda pakai agar kaki tidak terasa kaku.</p>\r\n\r\n<p>Gagasan pokok paragraf tersebut adalah...</p>\r\n', 5),
(3, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<div class=\"ckeditor-html5-audio\" style=\"text-align: center;\">\r\n<audio controls=\"controls\" controlslist=\"nodownload\" src=\"uploads/files/Audio/09_Iwan%20Fals%20-%20%20Perjalanan%20Waktu.mp3\">&nbsp;</audio>\r\n</div>\r\n\r\n<p>pengelolaan SMK sering dikeluhkan oleh masyarakt karena kurang selaras dengan kebutuhan dunia industri. Oleh karena itu,&nbsp;<em>paradigma</em>&nbsp;tentang pengelolaan SMK perlu di pertajam dan ditinjau kembali secara&nbsp;<em>komprehensif</em>.</p>\r\n\r\n<p>Makna instilah&nbsp;<em>paradigma&nbsp;</em>dan&nbsp;<em>komprehensif</em>&nbsp;dalam paragraf tersebut adalah....</p>\r\n', 5),
(4, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Sekolah perlu menanamkan budaya&nbsp;<em>kompetitif</em>&nbsp;dan&nbsp;<em>kreatif</em>&nbsp;di kalangan peserta didik agar tidak tertinggal di era digital. Kita tidak ingin anak-anak kita hanya menjadi penonton dan penikmat hasil karya orang lain.</p>\r\n\r\n<p>Makna kata&nbsp;<em>kreatif&nbsp;</em>dan&nbsp;<em>kompetitif</em> dalam paragraf tersebut adalah....</p>\r\n', 5),
(5, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Terkait dengan&nbsp;<em>suplai</em>&nbsp;barang kebutuhan pokok ke daerah, pemerintah harus segera membuat aturan teknis yang jelas. Harus disiapkan langkah-langkah&nbsp;<em>fundamental&nbsp;</em>untuk layanan pokok masyarakat banyak di wilayah itu.</p>\r\n\r\n<p>Makna istilah&nbsp;<em>suplai</em>&nbsp;dan&nbsp;<em>fundamental</em> dalam paragraf tersebut adalah....</p>\r\n', 5),
(6, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Indonesia butuh&nbsp;<em>intestasi&nbsp;</em>yang sangat besar untuk menaikkan eksplorasi dan produksi migas. Para investor perlu diyakinkan agar mau memperpanjang kontrak. Pemerintah pun sebaiknya memberikan <em>insentif</em>&nbsp;agar para pemilik modal tergerak untuk menanamkan modalnya di Indonesia.</p>\r\n\r\n<p>Makna&nbsp;istilah&nbsp;<em>investasi</em>&nbsp;dan<em>&nbsp;insentif</em> dalam paragraf tersebut adalah....</p>\r\n', 5),
(7, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p><em>Indikator</em>&nbsp;keberhasilan pemerintah di negara maju dapat terlihat dari realisasi target pemenuhan lapangan kerja. Pemenuhan lapangan kerja akan menurunkan tingkat kemiskinan secara otomatis.</p>\r\n\r\n<p>Makna kata&nbsp;<em>indikator&nbsp;</em>pada paragraf tersebut adalah....</p>\r\n', 5),
(8, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Meskipun rupiah bergerak melemah,&nbsp;<em>stabilitas&nbsp;</em>sektor keuangan Indonesia diyakini masih kukuh dibandingkan negara-negara berkembang lainnya. Hal ini tidak terlepas dari kebijakan fiskal pemerintah yang tanggap dan sigap menghadapi setiap perubahan dan gejolak ekonomi global.</p>\r\n\r\n<p>Makna kata&nbsp;<em>stabilitas</em>&nbsp;pada paragraf tersebut adalah....</p>\r\n', 5),
(9, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Jalur&nbsp;<em>pedestrian</em>&nbsp;yang dibangun dari dana bantuan pemerintah itu diharapkan dapat dimanfaatkan untuk fasilitas RTH (Ruang Terbuka Hijau) bagi masyarakat.</p>\r\n\r\n<p>Makna kata&nbsp;<em>pedestrian&nbsp;</em>pada paragraf tersebut adalah....</p>\r\n', 5),
(10, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Krisis keuangan itu mirip dengan penyakit manusia. Pada saat obat ditemukan untuk sebuah penyakit, penyakit lain yang belum ada obatnya sudah muncul. Beberapa penyakit yang semula belum ada obatnya kini dengan sangat mudah dilakukan tindakan preventif nya, yaitu dengan vaksinasi dan diagnosis dini. Jika manusianya tetap terjangkit, obatnya pun telah tersedia. Makan tetapi, lain halnya jika penyakitnya relatif baru dan belum ada obat ataupun prosedur pengobat nya.</p>\r\n\r\n<p>Gagasan pokok teks tersebut adalah....</p>\r\n', 5),
(11, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>(1)&nbsp;undang-undang desa sudah memasuki tahun ketiga. (2) sayangnya, cita-cita mulia yang ingin diwujudkan dalam uu tersebut belum dapat dirasakan sepenuhnya. (3)&nbsp;berbagai masalah masih menjadi tantangan desa. (4) salah satunya adalah penggunaan APBD yang belum sepenuhnya dapat dipertanggungjawabkan. (5)&nbsp;selain itu, masih banyak program pembangunan yang tidak fokus pada pemberdayaan masyarakat.</p>\r\n\r\n<p>Ide pokok paragraf tersebut terdapat pada kalimat nomor....</p>\r\n', 5),
(12, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Jati diri kita akan diketahui jika berpenampilan sesuai dengan citra. Berpenampilan tidak harus mahal. Hal terpenting adalah mencocokkan antara pakaian yang kita pakai dan kondisi tubuh kita.</p>\r\n\r\n<p>Gagasan pokok paragraf tersebut adalah....</p>\r\n', 5),
(13, 1, 1, '<p>Cermati teks berikut.</p>\r\n\r\n<p>(10 Untuk menjaga penampilan diri, kita harus tampil dinamis dan energik. (2) Dinamis artinya kita harus mampu berbusana yang bisa disesuaikan dengan waktu, tempat, dan acara. (3) Energik berarti kita tampil attractive dan bersemangat. (4) Jika keduanya sudah kita miliki, lingkungan akan menerima kita dengan baik. (5) Akan tetapi, keduanya harus diperoleh melalui pelatihan dan kesabaran.</p>\r\n\r\n<p>Gagasan pokok paragraf tersebut terdapat pada kalimat nomor....</p>\r\n', 5),
(14, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Persatuan dan kesatuan bangsa indonesia dapat dipecahkan melalui nilai budaya. Saat ini, kita hidup dalam kemajemukan.Kondisi ini membuka peluang terjadinya pergeseran nilai budaya yang dapat meletakkan persatuan bangsa. Oleh karena itu, nilai budaya harus selalu diupayakan dengan berbagai cara agar persatuan dan kesatuan bangsa tetap kuat.</p>\r\n\r\n<p>Gagasan pokok paragraf tersebut adalah....</p>\r\n', 5),
(15, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Pendidikan pengelolaan lingkungan hidup perlu ditanamkan kepada anak-anak sejak usia dini. Anak-anak lebih mudah mewujudkan nilai dan kebiasaan pelestarian lingkungan hidup dibandingkan dengan orang dewasa. Dengan demikian, diharapkan kerusakan lingkungan dapat dicegah melalui kepedulian generasi mendatang terhadap lingkungan.</p>\r\n\r\n<p>Simpulan paragraf tersebut adalah....</p>\r\n', 5),
(16, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Dewasa ini, kepribadian anak tidak dapat dilakukan hanya di umur atau figure kedua orang tua mereka. Kepribadian seseorang itu juga dapat terbentuk dari lingkungan sekitar dan dari pergaulan mereka [...]</p>\r\n\r\n<p>Simpulan yang tepat untuk paragraf tersebut adalah....</p>\r\n', 5),
(17, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Jumlah pemilik <em>smartphone</em> meningkat tajam. Saat ini, tidak ada lagi mahasiswa, siswa SMA, SMP, dan SD yang tidak memilikinya.persoalannya adalah apakah mereka menggunakan <em>smartphone</em> itu hanya untuk komunikasi? Apakah orang tua melakukan pendampingan dalam menggunakan alat tersebut, khususnya untuk anak SD dan SMP? [...]</p>\r\n\r\n<p>Simpulan yang tepat untuk paragraf tersebut adalah....</p>\r\n', 5),
(18, 1, 1, '<p>Cermati teks berikut.</p>\r\n\r\n<p>Sampai di kantor memberikan dampak buruk bagi lingkungan. Sampah organik akan menimbulkan bau yang tidak sedap jika sudah dua hari. Sementara itu, sampah organik tidak bisa terurai langsung dengan tanah. Padahal di satu sisi,sampai juga memiliki dampak positif bagi yang bisa mengelola nya.sampe organik bisa diolah menjadi pupuk dan sampah organik bisa didaur ulang untuk membuat kerajinan.</p>\r\n\r\n<p>Kalimat simpulan yang tepat untuk paragraf tersebut adalah....</p>\r\n', 5),
(19, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Perubahan iklim merupakan fenomena yang dipicu kegiatan manusia, terutama yang berkaitan dengan penggunaan bahan bakar fosil dan kegiatan ali guna lahan. Kegiatan tersebut dapat menghasilkan gas yang semakin lama semakin banyak jumlahnya di atmosfer. gas gas tersebut memiliki sifat seperti kaca yang meneruskan radiasi saya matahari sehingga suhu atmosfer bumi meningkat. Inilah yang disebut efek rumah kaca yang mengakibatkan pemanasan global.</p>\r\n\r\n<p>Simpulan paragraf tersebut adalah....</p>\r\n', 5),
(20, 1, 1, '<p>Cermati paragraf berikut.</p>\r\n\r\n<p>Pasar uang bursa dunia kembali terusik, tidak terkecuali di negara-negara di Benua Asia yang masih dilanda krisis.perkembangan ini tentu saja merasakan di tengah berbagai upaya negara-negara tersebut untuk keluar dari krisis ekonomi dan keuangan yang sudah berlangsung lebih dari satu tahun ini.</p>\r\n\r\n<p>Pernyataan yang sesuai dengan isi peraga tersebut adalah....</p>\r\n', 5),
(21, 6, 1, '<p>Keindahan terlihat dari objek yang terlihat adalah pandangan dari teori....</p>\r\n', 5),
(22, 6, 1, '<p>Berdasarkan teori subjektif, keindahan dapat terlihat berdasarkan....</p>\r\n', 5),
(23, 6, 1, '<p>Prinsip dari penciptaan karya seni rupa disebut prinsip desain yang meliputi...</p>\r\n', 5),
(24, 6, 1, '<p>Berikut ini yang tidak termasuk ke dalam bentuk-bentuk komposisi, yaitu....</p>\r\n', 5),
(25, 6, 1, '<p>bentuk menciptakan komposisi yang harmonis dalam pembuatan sebuah desain harus meliputi hal berikut ini, kecuali....</p>\r\n', 5),
(26, 6, 1, '<p>Seni rupa tradisional dilandasi pengaruh kuat dari....</p>\r\n', 5),
(27, 6, 1, '<p>Gagasan atau ide yang terbaru atau belum pernah ada sebelumnya disebut....</p>\r\n', 5),
(28, 6, 1, '<p>Berikut ni merupakan pembagian seni rupa pada zaman batu, kecuali....</p>\r\n', 5),
(29, 6, 1, '<p>Hasil karya seni rupa yang terbuat dari batu-batu kasar disebut zaman....</p>\r\n', 5),
(30, 6, 1, '<p>Sarchopagus adalah hasil karya seni rupa pada zaman megalitikum yang berfungsi sebagai....</p>\r\n', 5),
(31, 2, 1, '<p>Henry: I think Amelia is a good student.</p>\r\n\r\n<p>Susan: A agree with you. She always studies hard.</p>\r\n\r\n<p>Hendry: Yes, she is very diligent and always active in the class.</p>\r\n\r\n<p>Susan: I&#39;m sure she will get the best score this semester.</p>\r\n\r\n<p>Hendry: Si am I.</p>\r\n\r\n<p>Why does Susan think taht Amelia is a good student?</p>\r\n', 5),
(32, 2, 1, '<p>Rosie: What are your plans after graduating from vocational high scholl?</p>\r\n\r\n<p>Sania: I have applied for a scholarship. I&#39;m going to continue to Leeds University. How about you?</p>\r\n\r\n<p>Rosie: I really want to continue to university, but my parents want me to work first. They cannot support me financially.</p>\r\n\r\n<p>Sania: I hope yout get the best in yout future.</p>\r\n\r\n<p>What will Rosia possibly do after graduating from vocational high school?</p>\r\n', 5),
(33, 5, 2, '<p>Jelaskan apa yang dimaksud dengan amanat penokohan</p>\r\n', 5),
(34, 5, 1, '<p>Ibu kota jakarta merupakan salah satu milik negara</p>\r\n', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soaljawab`
--

CREATE TABLE `soaljawab` (
  `id_soaljawab` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `text_soaljawab` varchar(255) NOT NULL,
  `kunci_soaljawab` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soaljawab`
--

INSERT INTO `soaljawab` (`id_soaljawab`, `id_soal`, `text_soaljawab`, `kunci_soaljawab`) VALUES
(1, 1, '<p>globalisasi melahirkan persaingan yang ketat dan tajam</p>\r\n', 0),
(2, 1, '<p>globalisasi membawa banyak dampak bagi kehidupan</p>\r\n', 1),
(3, 1, '<p>globalisasi membawa iklim semakin terbuka</p>\r\n', 0),
(4, 1, '<p>globalisasi dapat meningkatkan kerja sama sosial</p>\r\n', 0),
(5, 1, '<p>globalisasi melahirkan masa depan yang semakin baik</p>\r\n', 0),
(6, 2, '<p>cara naik pesawat terbang yang tidak berbahaya</p>\r\n', 0),
(7, 2, '<p>cara duduk saat melakukan perjalanan dengan pesawat terbang</p>\r\n', 0),
(8, 2, '<p>cara mendapatkan kenyamanan dalam perbangan</p>\r\n', 1),
(9, 2, '<p>hal yang perlu dilakukan dalam penerbangan jauh</p>\r\n', 0),
(10, 2, '<p>kiat khusus melakukan perjalan jauh dan saat membawa barang bawaan</p>\r\n', 0),
(11, 3, '<p>tukar keinginan, ingin maju</p>\r\n', 0),
(12, 3, '<p>kerangka berpikir, luas dan lengkap</p>\r\n', 1),
(13, 3, '<p>wawasan maju, cara berpikir</p>\r\n', 0),
(14, 3, '<p>pandangan hidup, mampu berpikir</p>\r\n', 0),
(15, 3, '<p>berpikir maju, pandangan luas</p>\r\n', 0),
(16, 4, 'rajin dan berdaya saing', 0),
(17, 4, 'cepat dan dapat bersaing', 0),
(18, 4, 'berdaya cipta dan dapat bersaing', 1),
(19, 4, 'rajin dan daya saing', 0),
(20, 4, 'berdaya cipta dan pemenang', 0),
(21, 5, 'pembekalan dan tepat', 0),
(22, 5, 'pengiriman dan tertata', 0),
(23, 5, 'pembekalan dan bermanfaat', 0),
(24, 5, 'pemberian dan landasan', 1),
(25, 5, 'pengiriman dan mendasar', 0),
(26, 6, 'penanaman modal dan tambahan penghasilan', 1),
(27, 6, 'permintaan dan pengurangan beban', 0),
(28, 6, 'penanaman modal dan tambahan pekerjaan', 0),
(29, 6, 'pengelolaan dan pengurangan penghasilan', 0),
(30, 6, 'permodalan dan tambahan pekerjaan', 0),
(31, 7, 'dorongan', 0),
(32, 7, 'kekuatan', 0),
(33, 7, 'petunjuk', 1),
(34, 7, 'dukungan', 0),
(35, 7, 'manfaat', 0),
(36, 8, 'kesetaraan', 0),
(37, 8, 'kesamaan', 0),
(38, 8, 'keseimbangan', 1),
(39, 8, 'keutuhan', 0),
(40, 8, 'kelengkapan', 0),
(41, 9, 'perdesaan', 0),
(42, 9, 'pejalan kaki', 1),
(43, 9, 'sepeda', 0),
(44, 9, 'pedagang kaki lima', 0),
(45, 9, 'olahraga', 0),
(46, 10, 'Tindakan preventif pengobatan penyakit manusia', 0),
(47, 10, 'Pengobatan penyakit melalui vaksinasi', 0),
(48, 10, 'Kondisi krisis keuangan dan tindakan diagnosis', 0),
(49, 10, 'Perumpamaan krisis keuangan dengan penyakit manusia', 1),
(50, 10, 'Prosedur pengobatan penyakit baru', 0),
(51, 11, '(1)', 1),
(52, 11, '(2)', 0),
(53, 11, '(3)', 0),
(54, 11, '(4)', 0),
(55, 11, '(5)', 0),
(56, 12, 'Katon antara jati diri dan penampilan', 1),
(57, 12, 'Cara berpenampilan secara sederhana', 0),
(58, 12, 'Kesesuaian antara pakaian dan postur tubuh', 0),
(59, 12, 'Cara menjaga penampilan diri', 0),
(60, 12, 'Tampil sederhana dengan pakaian yang mahal', 0),
(61, 13, '(1)', 1),
(62, 13, '(2)', 0),
(63, 13, '(3)', 0),
(64, 13, '(4)', 0),
(65, 13, '(5)', 0),
(66, 14, 'Nilai budaya indonesia adalah kesatuan dan persatuan', 0),
(67, 14, 'Nilai budaya sebagai sarana pangkal kan persatuan dan kesatuan', 0),
(68, 14, 'Kemajemukan kehidupan berbangsa dan bernegara', 1),
(69, 14, 'Pergeseran nilai budaya pada masyarakat indonesia', 0),
(70, 14, 'Upaya meminimalkan keretakan bangsa indonesia', 0),
(71, 15, 'Kerusakan lingkungan tidak hanya tanggung jawab pemerintah', 0),
(72, 15, 'Pendidikan tentang lingkungan hidup menjadi tanggung jawab masyarakat', 0),
(73, 15, 'Anak-anak lebih mudah menerima pendidikan tentang lingkungan hidup', 0),
(74, 15, 'Pencegahan kerusakan lingkungan dapat dilakukan melalui pendidikan sejak usia dini', 1),
(75, 15, 'Pengelolaan lingkungan hidup dapat dimulai dari anak sekolah', 0),
(76, 16, 'Jadi, orang tua memiliki kebebasan untuk menjadikan kepribadian anaknya sesuai dengan keinginan.', 0),
(77, 16, 'Oleh karena itu, orang tua sebaiknya ikut memperhatikan pergaulan anak-anak mereka', 0),
(78, 16, 'Maka, perbedaan karakter anak disebabkan karena perbedaan cara mendidik anak-anaknya', 1),
(79, 16, 'Dengan demikian, anak harus dididik dengan baik karena anak adalah titipan tuhan.', 0),
(80, 16, 'Oleh karena itu, anak kecil muda dipengaruhi lingkungan karena iya belum memiliki tekad', 0),
(81, 17, 'Orang tua harus melakukan pengawasan tentang penggunaan alat komunikasi itu', 1),
(82, 17, 'Pemerintah perlu menghimbau produsen agar mengurangi volume produksi smartphone', 0),
(83, 17, 'Harus ada razia rutin di sekolah agar para siswa tidak membawa smartphone ke sekolah', 0),
(84, 17, 'Kepedulian guru dalam pendidikan mental siswa sangat diperlukan oleh sekolah', 0),
(85, 17, 'Harus ada penegakan disiplin di rumah dan di sekolah tentang penggunaan smartphone', 0),
(86, 18, 'Sampah memiliki dampak positif dan negatif', 1),
(87, 18, 'Dampak negatif sampai lebih banyak dibandingkan dan positifnya', 0),
(88, 18, 'Kita harus pandai mengelola sampah menjadi barang serbaguna', 0),
(89, 18, 'Sampah adalah permasalahan yang tidak kunjung selesai', 0),
(90, 18, 'Abay sampah dibagi menjadi dua yaitu organik dan anorganik', 0),
(91, 19, 'Ghost ghost hasil pembakaran mematikan ribuan spesies', 0),
(92, 19, 'Surat movie bumi meningkat karena efek rumah kaca', 0),
(93, 19, 'Peningkatan suhu di dalam rumah yang menggunakan kaca', 0),
(94, 19, 'Pemanasan global akibat efek rumah kaca', 1),
(95, 19, 'Bumi semakin panas dan semakin padat penduduknya', 0),
(96, 20, 'Pasar uang dan bursa adalah segalanya bagi manusia', 0),
(97, 20, 'Krisis ekonomi negara-negara benua asia pengaruhi negara lain', 0),
(98, 20, 'Krisis ekonomi dan keuangan yang sudah berlangsung 1 tahun', 1),
(99, 20, 'Pengaruh pasar uang dan berusaha dunia terhadap negara-negara di Benua asia', 0),
(100, 20, 'Krisis uang dan berkembangnya ekonomi masyarakat dalam melanda dunia', 0),
(101, 21, 'objektif', 1),
(102, 21, 'otentik', 0),
(103, 21, 'subjektif', 0),
(104, 21, 'fanatik', 0),
(105, 21, 'fonetik', 0),
(106, 22, 'benda yang terlihat', 0),
(107, 22, 'cara pandang terhadap suatu objek', 0),
(108, 22, 'diri yang melihat benda tersebut', 1),
(109, 22, 'teknik pembuatan benda tersebut', 0),
(110, 22, 'tingkat kerumitan dari benda tersebut', 0),
(111, 23, 'komposisi', 0),
(112, 23, 'ekspresi', 0),
(113, 23, 'kreativitas', 0),
(114, 23, 'proporsi', 0),
(115, 23, 'a, b, dan c benar', 1),
(116, 24, 'bentuk sentral', 0),
(117, 24, 'bentuk diagonal ekspresi', 0),
(118, 24, 'bentuk ortogonal', 1),
(119, 24, 'bentuk geometris', 0),
(120, 24, 'bentuk horizontal', 0),
(121, 25, 'proposi', 0),
(122, 25, 'keunikan', 1),
(123, 25, 'kesimbangan', 0),
(124, 25, 'kontras', 0),
(125, 25, 'irama', 0),
(126, 26, 'tidak pendidikan pembuatnya', 0),
(127, 26, 'adat dan budaya masyarakat setempat', 1),
(128, 26, 'tingkat ekonomi masyarakat setempat', 0),
(129, 26, 'pola hubungan sosial masyarakat setempat', 0),
(130, 26, 'aturan atau norma masyarakat setempat', 0),
(131, 27, 'proporsi', 0),
(132, 27, 'ekspresi', 0),
(133, 27, 'kreativitas', 1),
(134, 27, 'kontras', 0),
(135, 27, 'komposisi', 0),
(136, 28, 'zaman paleolithikum', 0),
(137, 28, 'zaman meslithikum', 0),
(138, 28, 'zaman perundagian', 1),
(139, 28, 'zaman neolithikum', 0),
(140, 28, 'zaman megalithikum', 0),
(141, 29, 'zaman paleolithikum', 1),
(142, 29, 'zaman mesolithikum', 0),
(143, 29, 'zaman perundagian', 0),
(144, 29, 'zaman neolithikum', 0),
(145, 29, 'zaman megalithikum', 0),
(146, 30, 'tempat menyimpan makanan', 0),
(147, 30, 'tempat pemujaan', 0),
(148, 30, 'tempat persembahan korban', 0),
(149, 30, 'tempat penguburan mayat', 1),
(150, 30, 'tempat memasak', 0),
(151, 31, '<p>Amelia is very diligent.</p>\r\n', 0),
(152, 31, '<p>Amelia always studies hard.</p>', 1),
(153, 31, '<p>Amelia is the best in her class.</p>\r\n', 0),
(154, 31, '<p>Amelia is a very active student.</p>\r\n', 0),
(155, 32, '<p>She will apply for a job.</p>\r\n', 1),
(156, 32, '<p>She will continue to university.</p>\r\n', 0),
(157, 32, '<p>She will apply for a scholarship.</p>\r\n', 0),
(158, 32, '<p>She will go to Leeds University.</p>\r\n', 0),
(159, 34, '<p>Malaysia</p>\r\n', 0),
(160, 34, '<p>Singapura</p>\r\n', 0),
(161, 34, '<p>China</p>\r\n', 0),
(162, 34, '<p>Timor Leste</p>\r\n', 0),
(163, 34, '<p>Indonesia</p>\r\n', 1),
(164, 33, 'Jadi dari pada belajar php sendiri saya akan belajar mencintai. Jadi dari pada belajar php sendiri saya akan belajar mencintai. Jadi dari pada belajar php sendiri saya akan belajar mencintai. Jadi dari pada belajar php sendiri saya akan belajar mencintai.', 0),
(168, 33, 'Vbhhhhhhvuvuvuv', 0),
(169, 33, 'Penolakan merupakan salah satu cara agar kita bisa pandai yang bercermin kebaikan', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahunajaran`
--

CREATE TABLE `tahunajaran` (
  `kode_tahunajaran` varchar(6) NOT NULL,
  `nama_tahunajaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahunajaran`
--

INSERT INTO `tahunajaran` (`kode_tahunajaran`, `nama_tahunajaran`) VALUES
('TA1819', '2018/2019'),
('TA1920', '2019/2020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `ujian_ibfk_1` (`id_kbm`),
  ADD KEY `register_petugas` (`register_petugas`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indexes for table `jawab`
--
ALTER TABLE `jawab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_soal` (`id_soal`),
  ADD KEY `jawab_ibfk_1` (`nis_siswa`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `jawab_ibfk_4` (`id_soaljawab`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`kode_jurusan`),
  ADD KEY `register_petugas` (`register_petugas`);

--
-- Indexes for table `kbm`
--
ALTER TABLE `kbm`
  ADD PRIMARY KEY (`id_kbm`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `register_petugas1` (`register_petugas`),
  ADD KEY `kode_semester` (`kode_semester`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`),
  ADD KEY `register_petugas` (`register_petugas`),
  ADD KEY `kode_tahunajaran` (`kode_tahunajaran`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`register_petugas`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`kode_semester`),
  ADD KEY `kode_tahunajaran` (`kode_tahunajaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis_siswa`),
  ADD KEY `kode_kelas` (`kode_kelas`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `soal_ibfk_1` (`id_kbm`);

--
-- Indexes for table `soaljawab`
--
ALTER TABLE `soaljawab`
  ADD PRIMARY KEY (`id_soaljawab`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
  ADD PRIMARY KEY (`kode_tahunajaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jawab`
--
ALTER TABLE `jawab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `kbm`
--
ALTER TABLE `kbm`
  MODIFY `id_kbm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nis_siswa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4609;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `soaljawab`
--
ALTER TABLE `soaljawab`
  MODIFY `id_soaljawab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_kbm`) REFERENCES `kbm` (`id_kbm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`register_petugas`) REFERENCES `petugas` (`register_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawab`
--
ALTER TABLE `jawab`
  ADD CONSTRAINT `jawab_ibfk_1` FOREIGN KEY (`nis_siswa`) REFERENCES `siswa` (`nis_siswa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jawab_ibfk_2` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jawab_ibfk_3` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jawab_ibfk_4` FOREIGN KEY (`id_soaljawab`) REFERENCES `soaljawab` (`id_soaljawab`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`register_petugas`) REFERENCES `petugas` (`register_petugas`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kbm`
--
ALTER TABLE `kbm`
  ADD CONSTRAINT `kbm_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kbm_ibfk_4` FOREIGN KEY (`register_petugas`) REFERENCES `petugas` (`register_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kbm_ibfk_5` FOREIGN KEY (`kode_semester`) REFERENCES `semester` (`kode_semester`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`register_petugas`) REFERENCES `petugas` (`register_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_ibfk_3` FOREIGN KEY (`kode_tahunajaran`) REFERENCES `tahunajaran` (`kode_tahunajaran`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`kode_tahunajaran`) REFERENCES `tahunajaran` (`kode_tahunajaran`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_kbm`) REFERENCES `kbm` (`id_kbm`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soaljawab`
--
ALTER TABLE `soaljawab`
  ADD CONSTRAINT `soaljawab_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
