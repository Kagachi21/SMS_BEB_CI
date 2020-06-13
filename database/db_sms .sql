-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 12:09 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen_harian`
--

CREATE TABLE `tb_absen_harian` (
  `id` int(6) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_absen` enum('Hadir','Hadir(Telat)','Tidak Hadir','Pulang') NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1 = datang, 2 = pulang'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absen_harian`
--

INSERT INTO `tb_absen_harian` (`id`, `nis`, `tanggal`, `status_absen`, `id_kelas`, `type`) VALUES
(23, '9459', '2020-06-12 08:51:16', 'Pulang', 'xiia1', 2),
(24, '9999', '2020-06-12 08:51:46', 'Pulang', 'xiia1', 2),
(25, '9789', '2020-06-12 08:52:12', 'Pulang', 'xiiis', 2),
(26, '9679', '2020-06-12 08:52:37', 'Pulang', 'xiia1', 2),
(27, '9569', '2020-06-12 08:53:06', 'Pulang', 'xiiis', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen_pelajaran`
--

CREATE TABLE `tb_absen_pelajaran` (
  `id` int(6) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `jam` tinyint(2) NOT NULL,
  `status_absen` enum('Hadir','Izin','Sakit','Alpha') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absen_pelajaran`
--

INSERT INTO `tb_absen_pelajaran` (`id`, `nis`, `id_kelas`, `id_mapel`, `nip`, `jam`, `status_absen`, `tanggal`) VALUES
(13, '9459', 'xiia1', 6, 111, 1, 'Hadir', '2020-06-12 08:12:34'),
(14, '9679', 'xiia1', 6, 111, 1, 'Hadir', '2020-06-12 08:12:34'),
(15, '9999', 'xiia1', 6, 111, 1, 'Hadir', '2020-06-12 08:12:34'),
(16, '9569', 'xiiis', 9, 777, 1, 'Hadir', '2020-06-12 08:39:29'),
(17, '9789', 'xiiis', 9, 777, 1, 'Hadir', '2020-06-12 08:39:29'),
(18, '9459', 'xiia1', 7, 222, 2, 'Hadir', '2020-06-12 08:40:13'),
(19, '9679', 'xiia1', 7, 222, 2, 'Hadir', '2020-06-12 08:40:13'),
(20, '9999', 'xiia1', 7, 222, 2, 'Hadir', '2020-06-12 08:40:13'),
(21, '9459', 'xiia1', 8, 333, 3, 'Hadir', '2020-06-12 08:40:55'),
(22, '9679', 'xiia1', 8, 333, 3, 'Hadir', '2020-06-12 08:40:55'),
(23, '9999', 'xiia1', 8, 333, 3, 'Hadir', '2020-06-12 08:40:55'),
(24, '9459', 'xiia1', 3, 444, 4, 'Hadir', '2020-06-12 08:41:31'),
(25, '9679', 'xiia1', 3, 444, 4, 'Hadir', '2020-06-12 08:41:31'),
(26, '9999', 'xiia1', 3, 444, 4, 'Hadir', '2020-06-12 08:41:31'),
(27, '9459', 'xiia1', 1, 555, 5, 'Hadir', '2020-06-12 08:42:01'),
(28, '9679', 'xiia1', 1, 555, 5, 'Hadir', '2020-06-12 08:42:01'),
(29, '9999', 'xiia1', 1, 555, 5, 'Hadir', '2020-06-12 08:42:01'),
(30, '9569', 'xiiis', 10, 666, 2, 'Hadir', '2020-06-12 08:43:44'),
(31, '9789', 'xiiis', 10, 666, 2, 'Hadir', '2020-06-12 08:43:44'),
(32, '9569', 'xiiis', 4, 888, 3, 'Hadir', '2020-06-12 08:44:21'),
(33, '9789', 'xiiis', 4, 888, 3, 'Hadir', '2020-06-12 08:44:21'),
(34, '9569', 'xiiis', 2, 999, 4, 'Hadir', '2020-06-12 08:44:50'),
(35, '9789', 'xiiis', 2, 999, 4, 'Hadir', '2020-06-12 08:44:51'),
(36, '9569', 'xiiis', 11, 1010, 5, 'Hadir', '2020-06-12 08:47:44'),
(37, '9789', 'xiiis', 11, 1010, 5, 'Hadir', '2020-06-12 08:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `kode` enum('Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `kode`) VALUES
(1, 'admin1', '1111', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bk`
--

CREATE TABLE `tb_bk` (
  `id_bk` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `jenis` tinyint(1) NOT NULL COMMENT 'sedang, berat, sangat berat',
  `tanggal` date NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `point` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bk`
--

INSERT INTO `tb_bk` (`id_bk`, `nis`, `jenis`, `tanggal`, `deskripsi`, `point`) VALUES
(6, 7787871, 1, '2020-01-11', 'iinufnvjfnvjnfhvbhdfvhfbvhfvfbvhbfvhbfhvbfuhvbfvhuf', 50),
(7, 7787871, 3, '2020-01-11', 'menghamili kakak kelas', 69),
(8, 7787871, 1, '2020-01-11', 'Mabuk ekstasi, pil anjing, orang tua, ngefly bos...mantap slurr', 123),
(13, 787, 1, '2020-01-11', 'jldfds', 78),
(14, 7787871, 2, '2020-01-19', 'berkelahi', 20),
(15, 0, 2, '2020-01-08', 'q', 10),
(16, 0, 2, '2020-01-02', 'merokok', 100),
(17, 0, 2, '2020-01-20', 'Sangat Susah Sekali', 80),
(18, 0, 2, '2020-01-20', 'Aku Cinta Sekali', 80),
(19, 0, 3, '2020-01-21', 'ugggjgkj', 100),
(20, 787, 1, '2020-01-07', 'loncat genteng', 20),
(21, 9459, 2, '2020-01-13', 'duel sama guru', 15),
(22, 9459, 1, '2020-01-21', 'Aku humu', 65),
(23, 6112, 1, '2020-01-21', 'Tidur saat pelajaran', 10),
(24, 9679, 1, '2020-06-01', 'Telat 5 kali berturut turut', 10),
(25, 9999, 1, '2020-06-04', 'Main hp pada jam pelajaran', 10),
(26, 9569, 1, '2020-06-09', 'Menyontek pada saat ujian', 15),
(27, 9789, 1, '2020-06-10', 'Memakai lipstik di sekolah', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id` int(6) NOT NULL,
  `nip` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id`, `nip`, `nama`, `email`, `password`, `alamat`) VALUES
(4, 111, 'GuruBio', 'bio@gmail.com', '1', 'Jalan Biologi'),
(7, 222, 'GuruFisika', 'fisika@gmail.com', '1', 'Jalan Fisika'),
(8, 333, 'GuruKimia', 'kimia@gmail.com', '1', 'Jalan Kimia'),
(9, 444, 'GuruIndo', 'indo@gmail.com', '1', 'Jalan Indonesia'),
(10, 555, 'GuruOlahraga', 'olahraga@gmail.com', '1', 'Jalan Olahraga'),
(11, 666, 'GuruEkonomi', 'ekonomi@gmail.com', '1', 'Jalan Ekonomi'),
(12, 777, 'GuruGeografi', 'geografi@gmail.com', '1', 'jalan geografi'),
(13, 888, 'GuruInggris', 'inggris@gmail.com', '1', 'jalan inggris\r\n'),
(14, 999, 'GuruOlahragaIps', 'olgaips@gmail.com', '1', 'Jalan Olahraga Ips'),
(15, 1010, 'GuruSejarah', 'sejarah@gmail.com', '1', 'jalan sejarah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id` int(6) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id`, `nip`, `id_kelas`, `id_mapel`, `hari`, `jam`) VALUES
(24, '111', 'xiia1', 6, 'Monday', 1),
(25, '222', 'xiia1', 7, 'Monday', 2),
(26, '333', 'xiia1', 8, 'Monday', 3),
(27, '444', 'xiia1', 3, 'Monday', 4),
(28, '555', 'xiia1', 1, 'Monday', 5),
(29, '666', 'xiiis', 10, 'Monday', 2),
(30, '777', 'xiiis', 9, 'Monday', 1),
(31, '888', 'xiiis', 4, 'Monday', 3),
(32, '999', 'xiiis', 2, 'Monday', 4),
(34, '1010', 'xiiis', 11, 'Monday', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `tipe_kelas` enum('IPA','IPS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `nama`, `tipe_kelas`) VALUES
('xa1', 'X . MIPA . 1', 'IPA'),
('xa2', 'X . MIPA . 2', 'IPA'),
('xa3', 'X . MIPA . 3', 'IPA'),
('xia1', 'XI . MIPA . 1', 'IPA'),
('xia2', 'XI . MIPA . 2', 'IPA'),
('xia3', 'XI . MIPA . 3', 'IPA'),
('xiia1', 'XII . MIPA . 1', 'IPA'),
('xiia2', 'XII . MIPA . 2', 'IPA'),
('xiia3', 'XII . MIPA . 3', 'IPA'),
('xiiis', 'XII . IPS . 1', 'IPS'),
('xiis1', 'XI . IPS . 1', 'IPS'),
('xis1', 'X . IPS . 1', 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keterangan`
--

CREATE TABLE `tb_keterangan` (
  `id` int(6) NOT NULL,
  `nis` int(11) NOT NULL,
  `jenis` enum('Ijin','Sakit') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keterangan`
--

INSERT INTO `tb_keterangan` (`id`, `nis`, `jenis`, `tanggal`, `foto`) VALUES
(6, 787, 'Ijin', '2020-01-21 13:42:30', '787.jpeg'),
(7, 6112, 'Sakit', '2020-01-21 23:28:34', '6112.png'),
(9, 9459, 'Sakit', '2020-06-12 08:22:52', '9459.jpeg'),
(10, 9569, 'Sakit', '2020-06-12 08:35:43', '9569.jpeg'),
(11, 9679, 'Ijin', '2020-06-12 08:36:19', '9679.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jurusan` enum('IPA','IPS','Umum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id`, `nama`, `jurusan`) VALUES
(1, 'Olahraga', 'IPA'),
(2, 'Olahraga', 'IPS'),
(3, 'Bahasa Indoneisa', 'IPA'),
(4, 'Bahasa Inggris', 'IPS'),
(6, 'Biologi', 'IPA'),
(7, 'Fisika', 'IPA'),
(8, 'Kimia', 'IPA'),
(9, 'Geografi', 'IPS'),
(10, 'Ekonomi', 'IPS'),
(11, 'Sejarah Indonesia', 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ortu`
--

CREATE TABLE `tb_ortu` (
  `nik` varchar(15) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `kode` enum('user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ortu`
--

INSERT INTO `tb_ortu` (`nik`, `nis`, `username`, `password`, `kode`) VALUES
('1239459', '9459', 'Ortudidi', '1', 'user'),
('23432432', '9679', 'Ortunando', '1', 'user'),
('3131313', '9999', 'Ortuwafa', '1', 'user'),
('5765778', '9569', 'Ortumita', '1', 'user'),
('787687', '9789', 'Orturisma', '1', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(6) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `jml_tagihan` int(8) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Lunas',
  `jenis_pembayaran` tinyint(1) NOT NULL COMMENT '''SPP Tahun 1'',''SPP Tahun 2'',''SPP Tahun 3'',''Study Tour''',
  `deskripsi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `nis`, `tanggal`, `jml_tagihan`, `status`, `jenis_pembayaran`, `deskripsi`) VALUES
(6, '9459', '2020-06-12 08:24:45', 150000, 'Lunas', 1, 'LUNAS'),
(7, '9679', '2020-06-12 08:25:19', 150000, 'Lunas', 1, 'LUNAS'),
(8, '9999', '2020-06-12 08:25:41', 150000, 'Lunas', 1, 'LUNAS'),
(9, '9569', '2020-06-12 08:26:09', 150000, 'Lunas', 1, 'LUNAS'),
(10, '9789', '2020-06-12 08:26:30', 150000, 'Lunas', 1, 'LUNAS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `kode` enum('User') DEFAULT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama`, `email`, `password`, `jenis_kelamin`, `id_kelas`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `no_hp`, `kode`, `foto`) VALUES
('9459', 'Rahmansyah Putra Pribadi', 'rahmansyah@gmail.com', '1', 1, 'xiia1', 'Indonesia . Jawa Timur . Kab Bondowoso . Kec Wonosari . Desa Sumber Kalong . RT/RW 019/007 . Kode Po', 'Surabaya', '2000-01-01', '08990312017', NULL, '9459.jpeg'),
('9569', 'Rizkiana Amita Sari', 'Mita@gmail.com', '1111', 0, 'xiiis', 'Balung', 'Jember', '1999-11-12', '08995691999', NULL, '9569.jpeg'),
('9679', 'Hernando Farazi Herrera', 'Nando@gmail.com', '1111', 1, 'xiia1', 'Jember Patrang', 'Jember', '2000-02-12', '08996792000', NULL, '9679.jpeg'),
('9789', 'Risma Muliyawati', 'Risma@gmail.com', '1111', 0, 'xiiis', 'Gumuk Emas', 'Jember', '2001-03-13', '08997892001', NULL, '9789.jpeg'),
('9999', 'Muhammad Ali Wafa', 'wafa@gmail.com', '1', 1, 'xiia1', 'knknknklmklkkmknk', 'Jember', '2000-01-07', '08990312019', NULL, '9999.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun_ajaran`
--

CREATE TABLE `tb_tahun_ajaran` (
  `tahun_ajaran` varchar(10) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tahun_ajaran`
--

INSERT INTO `tb_tahun_ajaran` (`tahun_ajaran`, `awal`, `akhir`) VALUES
('2019-2020', '2020-01-14', '2020-01-16'),
('2020-2021', '2020-01-17', '2020-01-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absen_harian`
--
ALTER TABLE `tb_absen_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`),
  ADD KEY `ke_kelas_master1` (`id_kelas`);

--
-- Indexes for table `tb_absen_pelajaran`
--
ALTER TABLE `tb_absen_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ke_master_kelas` (`id_kelas`),
  ADD KEY `ke_master5` (`nis`),
  ADD KEY `ke_mapel_master` (`id_mapel`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_bk`
--
ALTER TABLE `tb_bk`
  ADD PRIMARY KEY (`id_bk`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_keterangan`
--
ALTER TABLE `tb_keterangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ortu`
--
ALTER TABLE `tb_ortu`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `ke_kelas_master` (`id_kelas`);

--
-- Indexes for table `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  ADD PRIMARY KEY (`tahun_ajaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absen_harian`
--
ALTER TABLE `tb_absen_harian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_absen_pelajaran`
--
ALTER TABLE `tb_absen_pelajaran`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_bk`
--
ALTER TABLE `tb_bk`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_keterangan`
--
ALTER TABLE `tb_keterangan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
