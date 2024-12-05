-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 03:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_penjualan`
--

CREATE TABLE `item_penjualan` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_penjualan`
--

INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `obat_id`, `jumlah`, `harga`) VALUES
(1, 1, 1, 2, 12000.00),
(2, 1, 4, 2, 7500.00),
(3, 2, 6, 2, 10000.00),
(4, 3, 1, 3, 12000.00),
(5, 4, 6, 3, 30000.00);

-- --------------------------------------------------------

--
-- Table structure for table `item_pesanan_pembelian`
--

CREATE TABLE `item_pesanan_pembelian` (
  `id` int(11) NOT NULL,
  `pesanan_pembelian_id` int(11) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_pesanan_pembelian`
--

INSERT INTO `item_pesanan_pembelian` (`id`, `pesanan_pembelian_id`, `obat_id`, `jumlah`) VALUES
(1, 1, 1, 5),
(2, 1, 3, 5),
(3, 1, 4, 5),
(4, 2, 1, 13),
(5, 3, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `tanggal_kadaluarsa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama`, `stok`, `harga`, `tanggal_kadaluarsa`) VALUES
(1, 'paracetamoll', 25, 12000.00, '2024-10-24'),
(3, 'bodrex', 10, 6000.00, '2024-11-01'),
(4, 'procold', 13, 7500.00, '2024-11-01'),
(5, 'mixagrip', 12, 7500.00, '2025-01-07'),
(6, 'rinox', 3, 10000.00, '2024-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `telepon`) VALUES
(1, 'kila', 'jayapura', '83123713'),
(3, 'aco', 'abe', '070927308723'),
(4, 'budi', 'kotaraja', '73027032424'),
(5, 'ginaa', 'mandala', '31243214214');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kontak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id`, `nama`, `kontak`) VALUES
(1, 'dadad', '2342423'),
(2, 'kila', '081829839273'),
(3, 'gina', '234325325');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `tanggal_jual` date DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'belum dibayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `pelanggan_id`, `tanggal_jual`, `total_harga`, `status`) VALUES
(1, 3, '2024-11-01', 39000.00, 'dibayar'),
(2, 5, '2024-11-28', 20000.00, 'dibayar'),
(3, 1, '2024-11-28', 36000.00, 'dibayar'),
(4, 3, '2024-11-28', 90000.00, 'belum dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_pembelian`
--

CREATE TABLE `pesanan_pembelian` (
  `id` int(11) NOT NULL,
  `pemasok_id` int(11) DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_pembelian`
--

INSERT INTO `pesanan_pembelian` (`id`, `pemasok_id`, `tanggal_pesan`) VALUES
(1, 2, '2024-11-01'),
(2, 3, '2024-11-28'),
(3, 1, '2024-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'kila', 'syakilakth@gmail.com', '$2y$10$fkZRmFq82oU93RD1cF2vaet9MjqiBICODBBSlluT8TNq0/ijCKKWS', '2024-11-16 07:57:10', NULL),
(2, 'kila', 'syakilaputrism@gmail.com', '$2y$10$3uDALDzCNTbnHIjna5e5fuE7.M379fCabWFPBNPyMi/U4/pi9M4ga', '2024-11-16 08:05:58', NULL),
(3, 'cembong', 'cembong22@gmail.com', '$2y$10$JrQ0ph8zbLJduQgHX.HY2OxeAMPIHIo/dKgytRmXhWfY/deeEPtmm', '2024-11-22 01:41:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_penjualan`
--
ALTER TABLE `item_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indexes for table `item_pesanan_pembelian`
--
ALTER TABLE `item_pesanan_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_pembelian_id` (`pesanan_pembelian_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `pesanan_pembelian`
--
ALTER TABLE `pesanan_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemasok_id` (`pemasok_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_penjualan`
--
ALTER TABLE `item_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_pesanan_pembelian`
--
ALTER TABLE `item_pesanan_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan_pembelian`
--
ALTER TABLE `pesanan_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_penjualan`
--
ALTER TABLE `item_penjualan`
  ADD CONSTRAINT `item_penjualan_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  ADD CONSTRAINT `item_penjualan_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`);

--
-- Constraints for table `item_pesanan_pembelian`
--
ALTER TABLE `item_pesanan_pembelian`
  ADD CONSTRAINT `item_pesanan_pembelian_ibfk_1` FOREIGN KEY (`pesanan_pembelian_id`) REFERENCES `pesanan_pembelian` (`id`),
  ADD CONSTRAINT `item_pesanan_pembelian_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `pesanan_pembelian`
--
ALTER TABLE `pesanan_pembelian`
  ADD CONSTRAINT `pesanan_pembelian_ibfk_1` FOREIGN KEY (`pemasok_id`) REFERENCES `pemasok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
