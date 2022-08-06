-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 06:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rest_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_mahasiswa`
--

CREATE TABLE `t_mahasiswa` (
  `npm` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `t_mahasiswa`
--

INSERT INTO `t_mahasiswa` (`npm`, `nama`, `jenis_kelamin`, `alamat`, `agama`, `no_hp`, `email`) VALUES
(1204001, 'Jadon', 'Laki-laki', 'Bandung', 'Islam', '0833333333333', 'jadon@ulbi.ac.id'),
(1204002, 'Hiya', 'Perempuan', 'Huya', 'Khonghucu', '0822222222222', 'hihu@ulbi.ac.id'),
(1204003, 'Chiko', 'Laki-laki', 'Bandung', 'Protestan', '0811111111111', 'chiko@ulbi.ac.id'),
(1204004, 'Zigaz', 'Laki-laki', 'Zaga', 'Islam', '123131232', 'zigzag@ulbi.ac.id'),
(1204005, 'Joni', 'Laki-laki', 'Bandung', 'Budha', '08123123213232', 'joni11@ulbi.ac.id'),
(1204006, 'Abi', 'Laki-laki', 'Abu', 'Hindu', '08123123122', 'abi99@ulbi.ac.id'),
(1204007, 'Kiki', 'Perempuan', 'Cimahi', 'Protestan', '1111111111', 'kiki@ulbi.ac.id'),
(1204013, 'fauziah ', 'perempuan', 'sumatra', 'islam', '082298776023', 'zi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_mahasiswa`
--
ALTER TABLE `t_mahasiswa`
  ADD PRIMARY KEY (`npm`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
