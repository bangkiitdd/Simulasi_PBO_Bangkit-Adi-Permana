-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 02:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_ti1c_bangkitadipermana`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` int NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(50) DEFAULT NULL,
  `lokasi_kampus` varchar(50) DEFAULT NULL,
  `jenis_prestasi` varchar(50) DEFAULT NULL,
  `tingkat_prestasi` varchar(50) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(50) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMAN 1 Jakarta', '85.50', 300000, 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'SMKN 2 Bandung', '80.00', 300000, 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Citra Lestari', 'SMA Kristen 1', '88.25', 300000, 'Reguler', 'Ilmu Komputer', 'Kampus B', NULL, NULL, NULL, NULL),
(4, 'Dedi Kurniawan', 'SMAN 3 Semarang', '78.90', 300000, 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(5, 'Eka Putri', 'MAN 1 Yogyakarta', '83.40', 300000, 'Reguler', 'Sistem Informasi', 'Kampus B', NULL, NULL, NULL, NULL),
(6, 'Fajar Hidayat', 'SMKN 1 Surabaya', '81.15', 300000, 'Reguler', 'Ilmu Komputer', 'Kampus Utama', NULL, NULL, NULL, NULL),
(7, 'Gita Amalia', 'SMAN 5 Denpasar', '86.70', 300000, 'Reguler', 'Teknik Informatika', 'Kampus B', NULL, NULL, NULL, NULL),
(8, 'Hendra Wijaya', 'SMAN 1 Medan', '92.00', 400000, 'Prestasi', NULL, NULL, 'Sains (Olimpiade Matematika)', 'Nasional', NULL, NULL),
(9, 'Indah Permata', 'SMAN 2 Padang', '90.50', 400000, 'Prestasi', NULL, NULL, 'Olahraga (Bulutangkis)', 'Provinsi', NULL, NULL),
(10, 'Joko Susilo', 'SMKN 4 Malang', '89.00', 400000, 'Prestasi', NULL, NULL, 'Seni (FLS2N Gitar Solo)', 'Nasional', NULL, NULL),
(11, 'Kartika Sari', 'SMA Al-Azhar', '94.20', 400000, 'Prestasi', NULL, NULL, 'Sains (Karya Ilmiah)', 'Internasional', NULL, NULL),
(12, 'Lutfi Hakim', 'SMAN 1 Solo', '88.80', 400000, 'Prestasi', NULL, NULL, 'Olahraga (Basket)', 'Kabupaten', NULL, NULL),
(13, 'Mega Utami', 'SMAN 8 Makassar', '91.30', 400000, 'Prestasi', NULL, NULL, 'Seni (Paduan Suara)', 'Provinsi', NULL, NULL),
(14, 'Naufal Rizqi', 'MAN 2 Polman', '89.95', 400000, 'Prestasi', NULL, NULL, 'Sains (Robotika)', 'Nasional', NULL, NULL),
(15, 'Oki Setiawan', 'SMAN 1 Palembang', '84.00', 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-990/DIK/2026', 'Kementerian Kominfo'),
(16, 'Putri Rahayu', 'SMAN 3 Pontianak', '86.50', 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-112/PERHUB/2026', 'Kementerian Perhubungan'),
(17, 'Qori Sandi', 'SMKN 1 Balikpapan', '82.10', 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-554/BUMN/2026', 'PT Pertamina'),
(18, 'Rian Hidayat', 'SMAN 1 Banjarmasin', '87.30', 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-881/DIK/2026', 'Kementerian Kominfo'),
(19, 'Siti Aminah', 'SMAN 2 Ambon', '85.00', 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-204/PERHUB/2026', 'Kementerian Perhubungan'),
(20, 'Taufik Ismail', 'MAN 1 Jayapura', '83.80', 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-773/BUMN/2026', 'PT Telkom Indonesia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
