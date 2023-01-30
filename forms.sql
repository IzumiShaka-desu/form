-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 30, 2023 at 07:01 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_data`
--

CREATE TABLE `form_data` (
  `id` int(11) NOT NULL,
  `nama_pic` varchar(25) NOT NULL,
  `shift` varchar(25) NOT NULL,
  `jam` varchar(25) NOT NULL,
  `tersedia` int(11) NOT NULL,
  `aktual` int(11) NOT NULL,
  `no_wo` varchar(25) NOT NULL,
  `part_number` varchar(25) NOT NULL,
  `ct` varchar(25) NOT NULL,
  `plan_cap` varchar(25) NOT NULL,
  `actual` int(11) NOT NULL,
  `act_vs_cap` varchar(25) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  `proses` varchar(25) NOT NULL,
  `uraian` varchar(25) NOT NULL,
  `minute_breakdown` varchar(25) NOT NULL,
  `reject_qty` int(11) NOT NULL,
  `reject_jenis` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`id`, `nama_pic`, `shift`, `jam`, `tersedia`, `aktual`, `no_wo`, `part_number`, `ct`, `plan_cap`, `actual`, `act_vs_cap`, `jenis`, `proses`, `uraian`, `minute_breakdown`, `reject_qty`, `reject_jenis`, `created_at`) VALUES
(1, '', '', '', 0, 0, '', '', '', '', 0, '', '', '', '', '', 0, '', '2023-01-30 06:59:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_data`
--
ALTER TABLE `form_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_data`
--
ALTER TABLE `form_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
