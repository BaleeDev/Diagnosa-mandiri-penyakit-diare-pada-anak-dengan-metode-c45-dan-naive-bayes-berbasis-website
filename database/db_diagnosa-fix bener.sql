-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 29 Agu 2022 pada 16.12
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_diagnosa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_atribut`
--

CREATE TABLE `tbl_atribut` (
  `id_atribut` int(11) NOT NULL,
  `Nama_atribut` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_atribut`
--

INSERT INTO `tbl_atribut` (`id_atribut`, `Nama_atribut`) VALUES
(1, 'Jenis_Kelamin'),
(2, 'Umur'),
(3, 'Status_Mental'),
(4, 'Derajat_Haus'),
(5, 'Frekuensi_Denyut_Jantung'),
(6, 'Kualitas_Denyut_Nadi'),
(7, 'Pernapasan'),
(8, 'Palpebra'),
(9, 'Air_Mata'),
(10, 'Mulut_Dan_Lidah'),
(11, 'Turgor'),
(12, 'Capillary_Refill_Time'),
(13, 'Ekstremitas'),
(14, 'Produksi_Urin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_c45`
--

CREATE TABLE `tbl_c45` (
  `id` int(11) NOT NULL,
  `NOD` decimal(2,1) NOT NULL,
  `Nama_atribut` varchar(30) NOT NULL,
  `Nama_Class` varchar(30) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Tanpa_Dehidrasi` int(11) NOT NULL,
  `Dehidrasi_Ringan` int(11) NOT NULL,
  `Dehidrasi_Sedang` int(11) NOT NULL,
  `Dehidrasi_Berat` int(11) NOT NULL,
  `Entrhopy` decimal(9,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id_class` int(11) NOT NULL,
  `id_atribut` int(11) NOT NULL,
  `Nama_Class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_class`
--

INSERT INTO `tbl_class` (`id_class`, `id_atribut`, `Nama_Class`) VALUES
(1, 1, 'Laki-Laki'),
(2, 1, 'Perempuan'),
(3, 2, '0 - < 1'),
(4, 2, '1 - < 5'),
(5, 2, '5 - < 6'),
(6, 2, '6 - < 10'),
(7, 2, '10 - < 13'),
(8, 3, 'Sadar'),
(9, 3, 'Gelisah'),
(10, 3, 'Apatis'),
(11, 4, 'Minum Normal'),
(12, 4, 'Tampak Kehausan'),
(13, 4, 'Rasa Haus Berkurang'),
(14, 5, 'Normal'),
(15, 5, 'Meningkat'),
(16, 5, 'Takikardia'),
(17, 6, 'Normal'),
(18, 6, 'Menurun'),
(19, 6, 'Lemah'),
(20, 7, 'Normal'),
(21, 7, 'Cepat'),
(22, 7, 'Dalam'),
(23, 8, 'Normal'),
(24, 8, 'Sedikit Cekung'),
(25, 8, 'Sangat Cekung'),
(26, 9, 'Normal'),
(27, 9, 'Berkurang'),
(28, 9, 'Tidak Ada'),
(29, 10, 'Lembab'),
(30, 10, 'Kering'),
(31, 10, 'Sangat Kering'),
(32, 11, 'Rekoil Cepat'),
(33, 11, 'Rekoil < 2 Detik'),
(34, 11, 'Rekoil > 2 Detik'),
(35, 12, 'Normal'),
(36, 12, 'Memanjang'),
(37, 12, 'Minimal'),
(38, 13, 'Hangat'),
(39, 13, 'Dingin'),
(40, 14, 'Normal'),
(41, 14, 'Menurun'),
(42, 14, 'Minimal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_data`
--

CREATE TABLE `tbl_data` (
  `id_data` int(11) NOT NULL,
  `Jenis_Kelamin` varchar(15) NOT NULL,
  `Umur` varchar(15) NOT NULL,
  `Status_Mental` varchar(15) NOT NULL,
  `Derajat_Haus` varchar(30) NOT NULL,
  `Frekuensi_Denyut_Jantung` varchar(15) NOT NULL,
  `Kualitas_Denyut_Nadi` varchar(15) NOT NULL,
  `Pernapasan` varchar(15) NOT NULL,
  `Palpebra` varchar(15) NOT NULL,
  `Air_Mata` varchar(15) NOT NULL,
  `Mulut_Dan_Lidah` varchar(20) NOT NULL,
  `Turgor` varchar(30) NOT NULL,
  `Capillary_Refill_Time` varchar(15) NOT NULL,
  `Ekstremitas` varchar(15) NOT NULL,
  `Produksi_Urin` varchar(15) NOT NULL,
  `Hasil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_data`
--

INSERT INTO `tbl_data` (`id_data`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES
(33, 'Laki-Laki', '1 - < 5', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(34, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(35, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(36, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(37, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(38, 'Perempuan', '0 - < 1', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(39, 'Laki-Laki', '0 - < 1', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(40, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(41, 'Perempuan', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(42, 'Laki-Laki', '1 - < 5', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(43, 'Laki-Laki', '1 - < 5', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Minimal', 'Dehidrasi Ringan'),
(44, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Lemah', 'Cepat', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Ringan'),
(45, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(46, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(47, 'Perempuan', '10 - < 13', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(48, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Dalam', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Memanjang', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(49, 'Laki-Laki', '0 - < 1', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(50, 'Laki-Laki', '1 - < 5', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(51, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(52, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(53, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(54, 'Perempuan', '1 - < 5', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(55, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(56, 'Laki-Laki', '1 - < 5', 'Gelisah', 'Rasa Haus Berkurang', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(57, 'Perempuan', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(58, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(59, 'Laki-Laki', '1 - < 5', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Menurun', 'Cepat', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(60, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(61, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(62, 'Perempuan', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gain`
--

CREATE TABLE `tbl_gain` (
  `id` int(11) NOT NULL,
  `NOD` decimal(2,1) NOT NULL,
  `Nama_atribut` varchar(30) NOT NULL,
  `Gain` decimal(7,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Nama_Pengguna` varchar(50) NOT NULL,
  `Alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id`, `Email`, `Password`, `Nama_Pengguna`, `Alamat`, `telepon`, `Status`) VALUES
(1, 'rezfi@gmail.com', '123', 'Dr. Rezfi', 'Gondang', '083129108755', 'Admin'),
(2, 'iqballelouch9@gmail.com', '1234', 'Muhammad Ikbal Tamimi', 'Gondang', '083129234551', 'Admin'),
(4, 'hilda@gmail.com', '123', 'Hilda Sasmala Sari', 'Gondang', '083221477566', 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_probabilitas`
--

CREATE TABLE `tbl_probabilitas` (
  `id_probabilitas` int(11) NOT NULL,
  `Nama_atribut` varchar(30) NOT NULL,
  `Nama_Class` varchar(30) NOT NULL,
  `Tanpa_Dehidrasi` decimal(4,3) NOT NULL,
  `Dehidrasi_Ringan` decimal(4,3) NOT NULL,
  `Dehidrasi_Sedang` decimal(4,3) NOT NULL,
  `Dehidrasi_Berat` decimal(4,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_probabilitas`
--

INSERT INTO `tbl_probabilitas` (`id_probabilitas`, `Nama_atribut`, `Nama_Class`, `Tanpa_Dehidrasi`, `Dehidrasi_Ringan`, `Dehidrasi_Sedang`, `Dehidrasi_Berat`) VALUES
(9871, 'Jenis_Kelamin', 'Laki-Laki', '0.300', '0.300', '0.867', '0.600'),
(9872, 'Jenis_Kelamin', 'Perempuan', '0.700', '0.700', '0.133', '0.400'),
(9873, 'Umur', '0 - < 1', '0.300', '0.100', '0.200', '0.000'),
(9874, 'Umur', '1 - < 5', '0.300', '0.300', '0.267', '0.200'),
(9875, 'Umur', '5 - < 6', '0.200', '0.400', '0.333', '0.333'),
(9876, 'Umur', '6 - < 10', '0.100', '0.200', '0.200', '0.333'),
(9877, 'Umur', '10 - < 13', '0.000', '0.000', '0.000', '0.133'),
(9878, 'Status_Mental', 'Sadar', '0.800', '0.900', '0.133', '0.000'),
(9879, 'Status_Mental', 'Gelisah', '0.200', '0.100', '0.867', '0.467'),
(9880, 'Status_Mental', 'Apatis', '0.000', '0.000', '0.000', '0.533'),
(9881, 'Derajat_Haus', 'Minum Normal', '1.000', '0.100', '0.000', '0.000'),
(9882, 'Derajat_Haus', 'Tampak Kehausan', '0.000', '0.900', '0.933', '0.067'),
(9883, 'Derajat_Haus', 'Rasa Haus Berkurang', '0.000', '0.000', '0.067', '0.933'),
(9884, 'Frekuensi_Denyut_Jantung', 'Normal', '0.400', '0.500', '0.200', '0.000'),
(9885, 'Frekuensi_Denyut_Jantung', 'Meningkat', '0.600', '0.400', '0.800', '0.200'),
(9886, 'Frekuensi_Denyut_Jantung', 'Takikardia', '0.000', '0.100', '0.000', '0.800'),
(9887, 'Kualitas_Denyut_Nadi', 'Normal', '0.900', '0.400', '0.133', '0.000'),
(9888, 'Kualitas_Denyut_Nadi', 'Menurun', '0.100', '0.500', '0.867', '0.067'),
(9889, 'Kualitas_Denyut_Nadi', 'Lemah', '0.000', '0.100', '0.000', '0.933'),
(9890, 'Pernapasan', 'Normal', '0.600', '0.400', '0.467', '0.000'),
(9891, 'Pernapasan', 'Cepat', '0.400', '0.600', '0.533', '0.067'),
(9892, 'Pernapasan', 'Dalam', '0.000', '0.000', '0.000', '0.933'),
(9893, 'Palpebra', 'Normal', '1.000', '0.800', '0.000', '0.000'),
(9894, 'Palpebra', 'Sedikit Cekung', '0.000', '0.200', '1.000', '0.267'),
(9895, 'Palpebra', 'Sangat Cekung', '0.000', '0.000', '0.000', '0.733'),
(9896, 'Air_Mata', 'Normal', '1.000', '0.900', '0.333', '0.000'),
(9897, 'Air_Mata', 'Berkurang', '0.000', '0.100', '0.667', '0.200'),
(9898, 'Air_Mata', 'Tidak Ada', '0.000', '0.000', '0.000', '0.800'),
(9899, 'Mulut_Dan_Lidah', 'Lembab', '1.000', '0.100', '0.133', '0.200'),
(9900, 'Mulut_Dan_Lidah', 'Kering', '0.000', '0.900', '0.867', '0.333'),
(9901, 'Mulut_Dan_Lidah', 'Sangat Kering', '0.000', '0.000', '0.000', '0.467'),
(9902, 'Turgor', 'Rekoil Cepat', '0.800', '0.800', '0.000', '0.000'),
(9903, 'Turgor', 'Rekoil < 2 Detik', '0.200', '0.200', '0.800', '0.067'),
(9904, 'Turgor', 'Rekoil > 2 Detik', '0.000', '0.000', '0.200', '0.933'),
(9905, 'Capillary_Refill_Time', 'Normal', '0.900', '0.800', '0.467', '0.000'),
(9906, 'Capillary_Refill_Time', 'Memanjang', '0.000', '0.000', '0.333', '0.800'),
(9907, 'Capillary_Refill_Time', 'Minimal', '0.100', '0.200', '0.200', '0.200'),
(9908, 'Ekstremitas', 'Hangat', '1.000', '1.000', '0.600', '0.000'),
(9909, 'Ekstremitas', 'Dingin', '0.000', '0.000', '0.400', '1.000'),
(9910, 'Produksi_Urin', 'Normal', '1.000', '0.800', '0.133', '0.000'),
(9911, 'Produksi_Urin', 'Menurun', '0.000', '0.100', '0.867', '0.200'),
(9912, 'Produksi_Urin', 'Minimal', '0.000', '0.100', '0.000', '0.800');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rules`
--

CREATE TABLE `tbl_rules` (
  `id` int(11) NOT NULL,
  `NOD` decimal(2,1) NOT NULL,
  `Nama_atribut` varchar(30) NOT NULL,
  `Nama_Class` varchar(30) NOT NULL,
  `Hasil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_semua_data`
--

CREATE TABLE `tbl_semua_data` (
  `id` int(11) NOT NULL,
  `Jenis_Kelamin` varchar(15) NOT NULL,
  `Umur` varchar(15) NOT NULL,
  `Status_Mental` varchar(15) NOT NULL,
  `Derajat_Haus` varchar(30) NOT NULL,
  `Frekuensi_Denyut_Jantung` varchar(15) NOT NULL,
  `Kualitas_Denyut_Nadi` varchar(15) NOT NULL,
  `Pernapasan` varchar(15) NOT NULL,
  `Palpebra` varchar(15) NOT NULL,
  `Air_Mata` varchar(15) NOT NULL,
  `Mulut_Dan_Lidah` varchar(20) NOT NULL,
  `Turgor` varchar(30) NOT NULL,
  `Capillary_Refill_Time` varchar(15) NOT NULL,
  `Ekstremitas` varchar(15) NOT NULL,
  `Produksi_Urin` varchar(15) NOT NULL,
  `Hasil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_semua_data`
--

INSERT INTO `tbl_semua_data` (`id`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES
(1, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(2, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(3, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(5, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(6, 'Perempuan', '0 - < 1', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(7, 'Laki-Laki', '0 - < 1', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(8, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(9, 'Perempuan', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak ada', 'Sangat kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(10, 'Laki-Laki', '1 - < 5 ', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(11, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Minimal', 'Dehidrasi Ringan'),
(12, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Lemah', 'Cepat', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Ringan'),
(13, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(14, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(15, 'Perempuan', '10 - < 13', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(16, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Dalam', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Memanjang', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(17, 'Laki-Laki', '0 - < 1', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(18, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(19, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(20, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(21, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(22, 'Perempuan', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(23, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(24, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Rasa Haus Berkurang', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(25, 'Perempuan', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(26, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(27, 'Laki-Laki', '1 - < 5 ', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Menurun', 'Cepat', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(28, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(29, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(30, 'Perempuan', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Tidak ada', 'Sangat Kering', 'Rekoil < 2 detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(31, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(32, 'Perempuan', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(33, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(34, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(35, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(36, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(37, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(38, 'Laki-Laki', '0 - < 1', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(39, 'Perempuan', '6 - < 10', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(40, 'Laki-Laki', '6 - < 10', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(41, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(42, 'Perempuan', '1 - < 5 ', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(43, 'Perempuan', '1 - < 5 ', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(44, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(45, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(46, 'Laki-Laki', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(47, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(48, 'Perempuan', '6 - < 10', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(49, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(50, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(51, 'Laki-Laki', '13 - < 18', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(52, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(53, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(54, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(55, 'Perempuan', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(56, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(57, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(58, 'Perempuan', '1 - < 5 ', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(59, 'Perempuan', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(60, 'Perempuan', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(61, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(62, 'Perempuan', '6 - < 10', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(63, 'Laki-Laki', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(64, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(65, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(66, 'Perempuan', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(67, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(68, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(69, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(70, 'Laki-Laki', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(71, 'Perempuan', '13 - < 18', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(72, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(73, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(74, 'Perempuan', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(75, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(76, 'Perempuan', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(77, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(78, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(79, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(80, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(81, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(82, 'Perempuan', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(83, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(84, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(85, 'Perempuan', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(86, 'Perempuan', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(87, 'Perempuan', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(88, 'Perempuan', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(89, 'Laki-Laki', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(90, 'Perempuan', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(91, 'Laki-Laki', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(92, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(93, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(94, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(95, 'Laki-Laki', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(96, 'Laki-Laki', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(97, 'Perempuan', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(98, 'Perempuan', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(99, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(100, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(101, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(102, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(103, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(104, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(105, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(106, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(107, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(108, 'Laki-Laki', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(109, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(110, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(111, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(112, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(113, 'Laki-Laki', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(114, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(115, 'Perempuan', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(116, 'Perempuan', '13 - < 18', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(117, 'Laki-Laki', '6 - < 10', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(118, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(119, 'Perempuan', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak ada', 'Sangat kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(120, 'Laki - Laki', '10 - < 13', 'Gelisah', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(121, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(122, 'Perempuan', '1 - < 5', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(123, 'Perempuan', '1 - < 5', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Dalam', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Memanjang', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(124, 'Laki - Laki', '0 - < 1', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(125, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(126, 'Laki - Laki', '1 - < 5', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(127, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_testing`
--

CREATE TABLE `tbl_testing` (
  `id_testing` int(11) NOT NULL,
  `Jenis_Kelamin` varchar(15) NOT NULL,
  `Umur` varchar(15) NOT NULL,
  `Status_Mental` varchar(15) NOT NULL,
  `Derajat_Haus` varchar(30) NOT NULL,
  `Frekuensi_Denyut_Jantung` varchar(15) NOT NULL,
  `Kualitas_Denyut_Nadi` varchar(15) NOT NULL,
  `Pernapasan` varchar(15) NOT NULL,
  `Palpebra` varchar(15) NOT NULL,
  `Air_Mata` varchar(15) NOT NULL,
  `Mulut_Dan_Lidah` varchar(20) NOT NULL,
  `Turgor` varchar(30) NOT NULL,
  `Capillary_Refill_Time` varchar(15) NOT NULL,
  `Ekstremitas` varchar(15) NOT NULL,
  `Produksi_Urin` varchar(15) NOT NULL,
  `Hasil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_testing`
--

INSERT INTO `tbl_testing` (`id_testing`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES
(5577, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5578, 'Laki - Laki', '1 - < 5', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(5579, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(5580, 'Laki - Laki', '0 - < 1', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5581, 'Perempuan', '1 - < 5', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Dalam', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Memanjang', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5582, 'Perempuan', '1 - < 5', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5583, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(5584, 'Laki - Laki', '10 - < 13', 'Gelisah', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5585, 'Perempuan', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak ada', 'Sangat kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5586, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5587, 'Laki-Laki', '6 - < 10', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5588, 'Perempuan', '13 - < 18', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(5589, 'Perempuan', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5590, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(5591, 'Laki-Laki', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(5592, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5593, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5594, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5595, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5596, 'Laki-Laki', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(5597, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5598, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(5599, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5600, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5601, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5602, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5603, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5604, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5605, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5606, 'Perempuan', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(5607, 'Perempuan', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5608, 'Laki-Laki', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5609, 'Laki-Laki', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5610, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5611, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5612, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(5613, 'Laki-Laki', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5614, 'Perempuan', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5615, 'Laki-Laki', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(5616, 'Perempuan', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5617, 'Perempuan', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5618, 'Perempuan', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5619, 'Perempuan', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5620, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5621, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5622, 'Perempuan', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5623, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5624, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(5625, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5626, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5627, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5628, 'Perempuan', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5629, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(5630, 'Perempuan', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5631, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(5632, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(5633, 'Perempuan', '13 - < 18', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5634, 'Laki-Laki', '10 - < 13', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(5635, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(5636, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_training`
--

CREATE TABLE `tbl_training` (
  `id_data` int(11) NOT NULL,
  `Jenis_Kelamin` varchar(15) NOT NULL,
  `Umur` varchar(15) NOT NULL,
  `Status_Mental` varchar(15) NOT NULL,
  `Derajat_Haus` varchar(30) NOT NULL,
  `Frekuensi_Denyut_Jantung` varchar(15) NOT NULL,
  `Kualitas_Denyut_Nadi` varchar(15) NOT NULL,
  `Pernapasan` varchar(15) NOT NULL,
  `Palpebra` varchar(15) NOT NULL,
  `Air_Mata` varchar(15) NOT NULL,
  `Mulut_Dan_Lidah` varchar(20) NOT NULL,
  `Turgor` varchar(30) NOT NULL,
  `Capillary_Refill_Time` varchar(15) NOT NULL,
  `Ekstremitas` varchar(15) NOT NULL,
  `Produksi_Urin` varchar(15) NOT NULL,
  `Hasil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_training`
--

INSERT INTO `tbl_training` (`id_data`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`) VALUES
(4508, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4509, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4510, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4511, 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(4512, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4513, 'Perempuan', '0 - < 1', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4514, 'Laki-Laki', '0 - < 1', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(4515, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(4516, 'Perempuan', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak ada', 'Sangat kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4517, 'Laki-Laki', '1 - < 5 ', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4518, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Takikardia', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Minimal', 'Dehidrasi Ringan'),
(4519, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Lemah', 'Cepat', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Ringan'),
(4520, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4521, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4522, 'Perempuan', '10 - < 13', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4523, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Dalam', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Memanjang', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4524, 'Laki-Laki', '0 - < 1', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(4525, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(4526, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(4527, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4528, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4529, 'Perempuan', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4530, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(4531, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Rasa Haus Berkurang', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(4532, 'Perempuan', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4533, 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Minimal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4534, 'Laki-Laki', '1 - < 5 ', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Menurun', 'Cepat', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(4535, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4536, 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(4537, 'Perempuan', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Tidak ada', 'Sangat Kering', 'Rekoil < 2 detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Berat'),
(4538, 'Perempuan', '0 - < 1', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4539, 'Perempuan', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4540, 'Perempuan', '0 - < 1', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4541, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4542, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4543, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(4544, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4545, 'Laki-Laki', '0 - < 1', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(4546, 'Perempuan', '6 - < 10', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4547, 'Laki-Laki', '6 - < 10', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4548, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4549, 'Perempuan', '1 - < 5 ', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4550, 'Perempuan', '1 - < 5 ', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4551, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Tampak Kehausan', 'Normal', 'Menurun', 'Normal', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Sedang'),
(4552, 'Perempuan', '5 - < 6', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4553, 'Laki-Laki', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4554, 'Laki-Laki', '1 - < 5 ', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(4555, 'Perempuan', '6 - < 10', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4556, 'Laki-Laki', '5 - < 6', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4557, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4558, 'Laki-Laki', '13 - < 18', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4559, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang'),
(4560, 'Laki-Laki', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4561, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4562, 'Perempuan', '5 - < 6', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4563, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Meningkat', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4564, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(4565, 'Perempuan', '1 - < 5 ', 'Gelisah', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4566, 'Perempuan', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4567, 'Perempuan', '5 - < 6', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4568, 'Laki-Laki', '0 - < 1', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4569, 'Perempuan', '6 - < 10', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4570, 'Laki-Laki', '6 - < 10', 'Apatis', 'Rasa Haus Berkurang', 'Meningkat', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat'),
(4571, 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Normal', 'Sedikit Cekung', 'Normal', 'Kering', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Menurun', 'Dehidrasi Sedang'),
(4572, 'Perempuan', '1 - < 5 ', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi'),
(4573, 'Perempuan', '6 - < 10', 'Sadar', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Normal', 'Normal', 'Kering', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan'),
(4574, 'Laki-Laki', '6 - < 10', 'Gelisah', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil > 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_uji`
--

CREATE TABLE `tbl_uji` (
  `id` varchar(100) NOT NULL,
  `Nama_Anak` varchar(50) NOT NULL,
  `Jenis_Kelamin` varchar(15) NOT NULL,
  `Umur` varchar(15) NOT NULL,
  `Status_Mental` varchar(15) NOT NULL,
  `Derajat_Haus` varchar(30) NOT NULL,
  `Frekuensi_Denyut_Jantung` varchar(15) NOT NULL,
  `Kualitas_Denyut_Nadi` varchar(15) NOT NULL,
  `Pernapasan` varchar(15) NOT NULL,
  `Palpebra` varchar(15) NOT NULL,
  `Air_Mata` varchar(15) NOT NULL,
  `Mulut_Dan_Lidah` varchar(20) NOT NULL,
  `Turgor` varchar(30) NOT NULL,
  `Capillary_Refill_Time` varchar(15) NOT NULL,
  `Ekstremitas` varchar(15) NOT NULL,
  `Produksi_Urin` varchar(15) NOT NULL,
  `Hasil` varchar(30) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_uji`
--

INSERT INTO `tbl_uji` (`id`, `Nama_Anak`, `Jenis_Kelamin`, `Umur`, `Status_Mental`, `Derajat_Haus`, `Frekuensi_Denyut_Jantung`, `Kualitas_Denyut_Nadi`, `Pernapasan`, `Palpebra`, `Air_Mata`, `Mulut_Dan_Lidah`, `Turgor`, `Capillary_Refill_Time`, `Ekstremitas`, `Produksi_Urin`, `Hasil`, `tgl`) VALUES
('P2022-07-1602:14:15', 'Dika', 'Laki-Laki', '10 - < 13', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Normal', 'Cepat', 'Sedikit Cekung', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Normal', 'Dehidrasi Sedang', '2022-07-16'),
('P2022-07-1602:18:17', 'Rizal', 'Laki-Laki', '1 - < 5', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Normal', 'Cepat', 'Normal', 'Normal', 'Lembab', 'Rekoil < 2 Detik', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan', '2022-07-16'),
('P2022-07-1610:36:28', 'Hilda', 'Perempuan', '1 - < 5', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Lemah', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Minimal', 'Hangat', 'Minimal', 'Dehidrasi Sedang', '2022-07-16'),
('P2022-07-1807:13:31', 'Eca', 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Sedang', '2022-07-18'),
('P2022-07-1808:33:00', 'Muhammad Ikbal', 'Laki-Laki', '5 - < 6', 'Sadar', 'Minum Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Tanpa Dehidrasi', '2022-07-18'),
('P2022-07-1904:29:01', 'baleedev', 'Laki-Laki', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Lemah', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Minimal', 'Dehidrasi Sedang', '2022-07-19'),
('P2022-07-1906:28:39', 'Hilda Sasmala Sari', 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Normal', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Lembab', 'Rekoil < 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Sedang', '2022-07-19'),
('P2022-07-1908:30:31', 'Abrian', 'Laki-Laki', '1 - < 5', 'Apatis', 'Rasa Haus Berkurang', 'Takikardia', 'Lemah', 'Dalam', 'Sangat Cekung', 'Tidak Ada', 'Sangat Kering', 'Rekoil > 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Berat', '2022-07-19'),
('P2022-07-2208:43:06', 'L', 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Lemah', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Sedang', '2022-07-22'),
('P2022-07-2210:27:03', 'Han', 'Perempuan', '6 - < 10', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Menurun', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Memanjang', 'Dingin', 'Menurun', 'Dehidrasi Sedang', '2022-07-22'),
('P2022-07-2210:34:04', 'LL', 'Perempuan', '5 - < 6', 'Gelisah', 'Tampak Kehausan', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Lembab', 'Rekoil Cepat', 'Normal', 'Hangat', 'Normal', 'Dehidrasi Ringan', '2022-07-22'),
('P2022-07-2610:45:27', 'Farhan', 'Perempuan', '1 - < 5', 'Gelisah', 'Tampak Kehausan', 'Meningkat', 'Lemah', 'Cepat', 'Sedikit Cekung', 'Berkurang', 'Kering', 'Rekoil < 2 Detik', 'Minimal', 'Dingin', 'Minimal', 'Dehidrasi Sedang', '2022-07-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jeniskelamain` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`nik`, `nama`, `jeniskelamain`, `alamat`, `telepon`, `email`, `password`, `status`) VALUES
('10987865', 'Dina', 'Gondang', 'Perempuan', '628312984639', 'dina@gmail.com', '123', 'Aktif'),
('123453278', 'Puja', 'Tanjung', 'Laki-Laki', '6289671362195', 'puja@gmail.com', '123', 'Aktif'),
('12345678', 'Muhammad Ikbal', 'Gondang', 'Laki-Laki', '083129108638', 'iqballelouch9@gmail.com', '123', 'Aktif'),
('23876549', 'baleedev', 'Gondang', 'Perempuan', '628312984639', 'ely@gmail.com', '123', 'Aktif'),
('546890752678', 'Nadila Hazqia', 'Mataram', 'Perempuan', '6285333648321', 'nadia@gmail.com', '1234', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_atribut`
--
ALTER TABLE `tbl_atribut`
  ADD PRIMARY KEY (`id_atribut`);

--
-- Indeks untuk tabel `tbl_c45`
--
ALTER TABLE `tbl_c45`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indeks untuk tabel `tbl_data`
--
ALTER TABLE `tbl_data`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `tbl_gain`
--
ALTER TABLE `tbl_gain`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_probabilitas`
--
ALTER TABLE `tbl_probabilitas`
  ADD PRIMARY KEY (`id_probabilitas`);

--
-- Indeks untuk tabel `tbl_rules`
--
ALTER TABLE `tbl_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_semua_data`
--
ALTER TABLE `tbl_semua_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_testing`
--
ALTER TABLE `tbl_testing`
  ADD PRIMARY KEY (`id_testing`);

--
-- Indeks untuk tabel `tbl_training`
--
ALTER TABLE `tbl_training`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `tbl_uji`
--
ALTER TABLE `tbl_uji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_atribut`
--
ALTER TABLE `tbl_atribut`
  MODIFY `id_atribut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_c45`
--
ALTER TABLE `tbl_c45`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16369;

--
-- AUTO_INCREMENT untuk tabel `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tbl_data`
--
ALTER TABLE `tbl_data`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `tbl_gain`
--
ALTER TABLE `tbl_gain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4646;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_probabilitas`
--
ALTER TABLE `tbl_probabilitas`
  MODIFY `id_probabilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9913;

--
-- AUTO_INCREMENT untuk tabel `tbl_rules`
--
ALTER TABLE `tbl_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=927;

--
-- AUTO_INCREMENT untuk tabel `tbl_semua_data`
--
ALTER TABLE `tbl_semua_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT untuk tabel `tbl_testing`
--
ALTER TABLE `tbl_testing`
  MODIFY `id_testing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5637;

--
-- AUTO_INCREMENT untuk tabel `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4575;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
