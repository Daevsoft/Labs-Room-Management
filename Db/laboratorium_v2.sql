-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Jul 2020 pada 05.48
-- Versi server: 8.0.17
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratorium`
--
CREATE DATABASE IF NOT EXISTS `laboratorium` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `laboratorium`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `NRA` int(15) NOT NULL,
  `NamaA` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `NIK` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `TmpLahir` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `TglLahir` date NOT NULL,
  `Gender` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'L',
  `Alamat` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Telp` varchar(14) COLLATE utf8mb4_bin NOT NULL,
  `TglReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `StatusA` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'active',
  `StatusRec` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`NRA`, `NamaA`, `NIK`, `TmpLahir`, `TglLahir`, `Gender`, `Alamat`, `Telp`, `TglReg`, `StatusA`, `StatusRec`) VALUES
(1, 'Naruto Uzumacan', '23784827348', 'Jakarta', '1997-06-12', 'L', 'Jln. Ada', '07487237', '2020-06-10 17:00:00', 'active', ''),
(1591959029, 'Surugi Otori', '18279832938', 'Jakarta', '1992-06-12', 'L', 'Jln. Lika liku No.3 RT01/03 Jakarta Timur', '091823019', '2020-06-12 10:50:29', 'active', NULL),
(1592139881, 'Kiko Ruciko', '72384781', 'Jakarta', '1995-11-16', 'L', 'Jl. Suka Aja No.1 RT09 Jakarta Timur Indonesia', '027473872387', '2020-06-14 13:04:41', 'active', NULL),
(1592215985, 'Lilo Lumino', '5454233', 'Banten', '1999-09-21', 'L', 'Jln. Merdeka', '02133564345', '2020-06-15 10:13:05', 'active', NULL),
(1592331369, 'Kuskus', '878768762834', 'Bogor', '1998-10-23', 'L', 'Jalan Kemangi', '0192872384', '2020-06-16 18:16:09', 'active', NULL),
(1592332780, 'Nunu', '78676172', 'Jakarta', '1999-09-29', 'P', 'Jln Sukaraya No.2', '0623647712', '2020-06-16 18:39:40', 'active', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `asalbarang`
--

CREATE TABLE `asalbarang` (
  `KodeAsal` int(15) NOT NULL,
  `Deskripsi` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `asalbarang`
--

INSERT INTO `asalbarang` (`KodeAsal`, `Deskripsi`) VALUES
(89182398, 'Gudang B'),
(891289489, 'Gudang A'),
(1592135668, 'Ruang Lab 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `NI` int(15) NOT NULL,
  `Nama` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Satuan` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `KodeAsal` int(15) NOT NULL,
  `NoReferensi` int(15) DEFAULT NULL,
  `KodeKategori` int(15) NOT NULL,
  `TglInputData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `StatusReg` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `inventaris`
--

INSERT INTO `inventaris` (`NI`, `Nama`, `Satuan`, `KodeAsal`, `NoReferensi`, `KodeKategori`, `TglInputData`, `StatusReg`) VALUES
(2381239, 'Headset Gaming', 'Unit', 891289489, 187482, 1592135668, '2020-06-13 00:57:12', '0'),
(9823489, 'Keyboard Logitech', 'Unit', 89182398, 819281823, 40, '2020-06-13 00:27:39', '0'),
(87192898, 'Mouse Logitech', 'Unit', 89182398, 19283989, 40, '2020-06-13 00:55:32', '0'),
(1592136302, 'Cooling Pad', 'Unit', 1592135668, 182783527, 40, '2020-06-14 12:05:02', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwalpemakaian`
--

CREATE TABLE `jadwalpemakaian` (
  `NUJP` int(15) NOT NULL,
  `NRA` int(15) NOT NULL,
  `TglPakai` date NOT NULL,
  `JamMulai` time NOT NULL DEFAULT '00:00:00',
  `JamSelesai` time NOT NULL DEFAULT '00:00:00',
  `StatusPakai` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'antrian',
  `StatusRec` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `jadwalpemakaian`
--

INSERT INTO `jadwalpemakaian` (`NUJP`, `NRA`, `TglPakai`, `JamMulai`, `JamSelesai`, `StatusPakai`, `StatusRec`) VALUES
(801898219, 1591959029, '2020-06-13', '08:00:00', '09:00:00', 'selesai', NULL),
(1592141961, 1592139881, '2020-06-18', '07:00:00', '09:00:00', 'mulai', NULL),
(1592147327, 1592139881, '2020-06-19', '07:00:00', '09:50:00', 'antrian', NULL),
(1592382490, 1592332780, '2020-06-19', '10:00:00', '11:50:00', 'antrian', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `KodeKategori` int(15) NOT NULL,
  `Deskripsi` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`KodeKategori`, `Deskripsi`) VALUES
(40, 'Elektronik'),
(41, 'Alat Kebersihan'),
(1592135601, 'Aksesoris'),
(1592135624, 'Aksesoris'),
(1592135668, 'Aksesoris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `NUP` int(15) NOT NULL,
  `NRA` int(15) NOT NULL,
  `NamaP` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `KtSandi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `LevelP` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'anggota',
  `TglBuat` date NOT NULL,
  `StatusP` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`NUP`, `NRA`, `NamaP`, `KtSandi`, `LevelP`, `TglBuat`, `StatusP`) VALUES
(100, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2020-06-15', 'active'),
(1591959029, 1591959029, 'so11', '202cb962ac59075b964b07152d234b70', 'anggota', '2020-06-12', 'active'),
(1592139881, 1592139881, 'kiko99', '202cb962ac59075b964b07152d234b70', 'kiko99', '2020-06-14', 'active'),
(1592215985, 1592215985, 'lilo12', '202cb962ac59075b964b07152d234b70', 'pengelola', '2020-06-15', 'active'),
(1592331370, 1592331369, 'kks22', '827ccb0eea8a706c4c34a16891f84e7b', 'pengelola', '2020-06-16', 'active'),
(1592332780, 1592332780, 'nunu99', '827ccb0eea8a706c4c34a16891f84e7b', 'anggota', '2020-06-16', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reqpemakaian`
--

CREATE TABLE `reqpemakaian` (
  `NURP` int(15) NOT NULL,
  `NRA` int(15) NOT NULL,
  `TglReq` date NOT NULL,
  `TglPakai` date NOT NULL,
  `JamMulai` time NOT NULL,
  `JamSelesai` time NOT NULL,
  `Pengulangan` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `ApprKaLab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `reqpemakaian`
--

INSERT INTO `reqpemakaian` (`NURP`, `NRA`, `TglReq`, `TglPakai`, `JamMulai`, `JamSelesai`, `Pengulangan`, `ApprKaLab`) VALUES
(801898219, 1591959029, '2020-06-12', '2020-06-13', '08:00:00', '09:00:00', 'tidak', 'disetujui'),
(1592141961, 1592139881, '2020-06-14', '2020-06-18', '07:00:00', '09:00:00', 'ulangi', 'disetujui'),
(1592147327, 1592139881, '2020-06-14', '2020-06-19', '07:00:00', '09:50:00', 'tidak', 'disetujui'),
(1592180279, 1591959029, '2020-06-15', '2020-06-20', '08:00:00', '09:50:00', 'tidak', 'ditolak'),
(1592382490, 1592332780, '2020-06-17', '2020-06-19', '10:00:00', '11:50:00', 'tidak', 'disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reqpinjamalat`
--

CREATE TABLE `reqpinjamalat` (
  `NURPA` int(15) NOT NULL,
  `NURP` int(10) NOT NULL,
  `KodeAlat` int(15) NOT NULL,
  `JumlahAlat` int(15) NOT NULL,
  `StatusRec` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '0',
  `Kondisi` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data untuk tabel `reqpinjamalat`
--

INSERT INTO `reqpinjamalat` (`NURPA`, `NURP`, `KodeAlat`, `JumlahAlat`, `StatusRec`, `Kondisi`) VALUES
(9182398, 801898219, 9823489, 2, '1', 30),
(1592034651, 801898219, 2381239, 2, '1', 50),
(1592055499, 801898219, 87192898, 1, '0', 20),
(1592178133, 1592141961, 1592136302, 3, '0', 75),
(1592178134, 1592141961, 9823489, 1, '1', 80),
(1592331560, 1592147327, 9823489, 1, '1', 0),
(1592331561, 1592147327, 87192898, 1, '0', 0),
(1592331562, 1592147327, 2381239, 1, '1', 0),
(1592382588, 1592382490, 9823489, 1, '1', 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`NRA`);

--
-- Indeks untuk tabel `asalbarang`
--
ALTER TABLE `asalbarang`
  ADD PRIMARY KEY (`KodeAsal`);

--
-- Indeks untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`NI`),
  ADD KEY `KodeKategori` (`KodeKategori`),
  ADD KEY `inventaris_ibfk_1` (`KodeAsal`);

--
-- Indeks untuk tabel `jadwalpemakaian`
--
ALTER TABLE `jadwalpemakaian`
  ADD PRIMARY KEY (`NUJP`),
  ADD KEY `NRA` (`NRA`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KodeKategori`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`NUP`),
  ADD KEY `NRA` (`NRA`);

--
-- Indeks untuk tabel `reqpemakaian`
--
ALTER TABLE `reqpemakaian`
  ADD PRIMARY KEY (`NURP`),
  ADD KEY `NRA` (`NRA`);

--
-- Indeks untuk tabel `reqpinjamalat`
--
ALTER TABLE `reqpinjamalat`
  ADD PRIMARY KEY (`NURPA`),
  ADD KEY `NURP` (`NURP`),
  ADD KEY `KodeAlat` (`KodeAlat`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD CONSTRAINT `inventaris_ibfk_1` FOREIGN KEY (`KodeAsal`) REFERENCES `asalbarang` (`KodeAsal`),
  ADD CONSTRAINT `inventaris_ibfk_2` FOREIGN KEY (`KodeKategori`) REFERENCES `kategori` (`KodeKategori`);

--
-- Ketidakleluasaan untuk tabel `jadwalpemakaian`
--
ALTER TABLE `jadwalpemakaian`
  ADD CONSTRAINT `jadwalpemakaian_ibfk_1` FOREIGN KEY (`NRA`) REFERENCES `anggota` (`NRA`);

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`NRA`) REFERENCES `anggota` (`NRA`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reqpemakaian`
--
ALTER TABLE `reqpemakaian`
  ADD CONSTRAINT `reqpemakaian_ibfk_1` FOREIGN KEY (`NRA`) REFERENCES `anggota` (`NRA`);

--
-- Ketidakleluasaan untuk tabel `reqpinjamalat`
--
ALTER TABLE `reqpinjamalat`
  ADD CONSTRAINT `reqpinjamalat_ibfk_1` FOREIGN KEY (`NURP`) REFERENCES `reqpemakaian` (`NURP`) ON DELETE CASCADE,
  ADD CONSTRAINT `reqpinjamalat_ibfk_2` FOREIGN KEY (`KodeAlat`) REFERENCES `inventaris` (`NI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
