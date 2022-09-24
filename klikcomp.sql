-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2022 at 06:12 AM
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
-- Database: `klikcomp`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `satuan`, `keterangan`, `barcode`, `harga_jual`, `harga_beli`, `stock`, `id_kategori`, `id_supplier`, `created_at`, `updated_at`) VALUES
(2, 'RAM', 'Pcs', 'RAM DDR 3', NULL, '85000', '50000', 0, 7, 5, '2022-06-19 08:30:39', '2022-07-02 21:11:01'),
(3, 'Mouse', 'Pcs', 'mouse', NULL, '70000', '30000', 17, 7, 3, '2022-06-20 03:20:28', '2022-07-02 21:14:35'),
(4, 'Monitor Acer', 'Pcs', 'Monitor 21 inc', NULL, '1000000', '900000', 22, 9, 3, '2022-06-21 00:18:27', '2022-07-01 08:11:10'),
(5, 'Keyboard', 'Pcs', 'Keyboard', NULL, '60000', '40000', 19, 7, 5, '2022-06-21 00:19:51', '2022-07-01 09:27:26'),
(6, 'SSD', 'Pcs', 'SSD Vgen', NULL, '400000', '250000', 23, 7, 3, '2022-06-21 00:21:31', '2022-06-21 00:21:31'),
(7, 'CCTV Lampu', 'Pcs', 'CCTV Lampu', NULL, '150000', '120000', 22, 10, 3, '2022-06-21 01:15:07', '2022-07-01 09:16:26'),
(8, 'Mainboard', 'Pcs', 'Mainboard Bagus', NULL, '500000', '430000', 22, 7, 3, '2022-06-21 01:16:27', '2022-07-01 08:09:28'),
(9, 'CCTV HikVision', 'Pcs', 'HikVision', NULL, '350000', '300000', 21, 10, 5, '2022-06-21 01:17:58', '2022-06-30 07:45:23'),
(10, 'CCTV Dahua', 'Pcs', 'Dahua OK', NULL, '250000', '200000', 46, 10, 3, '2022-06-21 01:19:47', '2022-07-02 20:08:17'),
(11, 'Monitor Redmi', 'Pcs', 'Redmi 32 Inc', NULL, '2500000', '2000000', 23, 9, 5, '2022-06-21 01:21:02', '2022-06-21 01:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `barang_detail`
--

CREATE TABLE `barang_detail` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_detail`
--

INSERT INTO `barang_detail` (`id`, `id_barang`, `gambar`) VALUES
(1, 1, '1rYpqFMxSCHVvASL9bNB0Zh1hEByq3bFnRjr23W0.jpg'),
(2, 1, 'WiWMg7kcsanyNmur9quhIIj10B0qVPFmr3PV4Uyt.jpg'),
(4, 2, 'ljvG3yzGgAaZsuWdq7DYZKOgxU3TVIRJqWroftuY.jpg'),
(5, 2, 'S9TARPEHGjkjNlrwPkemuFcpsrxDGaP1gDQczFnq.jpg'),
(6, 2, 'DxQmBmPD1d2p16giCAHQRbfm1hJBeiWC2qNlHuup.jpg'),
(7, 3, 'hVPsFJzvnzddmLvPwL93GPfKWKCN03ilAoIs9AV9.jpg'),
(8, 3, 'atkPOMfuZNgq0cez1MgQCjj4uGClh0sOmDcTDemM.jpg'),
(9, 3, 'eeKezB5NPgZORgUNnWulXWw2gq1WkpSpu1R8kyJD.jpg'),
(10, 4, 'EI9awGgkR4whzW5gvfokSsGRLngy9qN1olXhs0iO.jpg'),
(11, 4, 'PK7cIA9OuPhXjkjeO4l4zPaX88tHQRjgKJ43qBsK.jpg'),
(12, 4, 'swXEf89MqKfiSNeh0MeTtrPBNF5xgq0Tudm3WWIA.jpg'),
(13, 5, 'k4hvgKxnFXZK7BErwg3Qxq7gZy7ZBYT7QydXkMTE.jpg'),
(14, 5, 'ahWcafdDVXe9A07Nyek8rmPIDbSzxSTVAmItqxCW.jpg'),
(15, 5, '4jIQKNiSGKfJzPnm7pj1knzwtCPcFyMfuE03qKxJ.jpg'),
(16, 5, '3o2AKKDXLOYuJzrZCS0GUnS6Dz4HVgdDwWkvIXhH.jpg'),
(17, 5, 'tyRKq8oq6rejJGXUTuviGYNFAIbhiWRt1wPEihw6.jpg'),
(18, 6, 'LGjoEWTI7rnF8asAjyQp1PfNuzpRVyNfI0B9lUaG.jpg'),
(19, 6, 'AJir2YbEhtsutakUEyelWKKgDbupk72MPFbQaIvx.jpg'),
(20, 6, 'N5ns0tjpzcPp4mHmxVdbU7WZKhAz6INRS2ldsSTr.jpg'),
(21, 7, 'PGkR5HXoy5a5dN2WhgPSdHiGVu9WSsrkaMwnNsVK.jpg'),
(22, 7, 'k34JOuwbAntWAVb0GCfOzwnmkmvf94V80c99AXyN.jpg'),
(23, 7, 'SagJFtisXrOrGjEP7mjXNbYjEQFcNa5l5XydSchN.jpg'),
(24, 8, 'V3WORAEW6gL5e6fVmV62DLhj5lV1RG8fsesYymp5.jpg'),
(25, 8, 'SRLRnykewVGmes7ZuxFlXtbqcNthbJZITd9O47Y4.jpg'),
(26, 8, 'ZZKjEOYOC8RJmRkJdd1lw33PpMQGk4loYnlbh1Nn.jpg'),
(27, 8, 'JfBJM5ss4GVopzLTIvrQwodP5V26Lgsznh82kzYh.jpg'),
(28, 9, 'ZzK4FZCDBbUQUZh7w7gTWtmS4a9eyP9fxYPmtR8Y.jpg'),
(29, 9, 'O8PbchFxTMT67PFd05rcYWtXhWtF5VQtaeaB7lxQ.jpg'),
(30, 9, 'kBdllQTZHc2bH6ctQjhKiBbh4V8RFfYTmeilyXei.jpg'),
(31, 10, 'eWkodJYMPZ3lpRfHMczygBIzlVwdm3hOUTnGDiYP.jpg'),
(32, 10, 'zSXrEHya8ZXQS9CCog8bnswoHAuyd330ByhTKBHh.jpg'),
(33, 10, 'KE4CigeT7PRhtKzeCnRFOfcf0bU20FH8eM3izrq8.jpg'),
(34, 10, 'gwzCTpbbkYfDpSUEU8GyKIPBPvYKO0QxsCOxtbUv.jpg'),
(35, 11, '3LjJT6kr8tPjE0cQ3DhbNnlgiaof3vuGQzQDpt1b.jpg'),
(36, 11, 'PleKZ1Q9hh2Nk8946eaPRF8dAiRF5FgPz8CAuBwc.jpg'),
(37, 11, 'tTvIK3wrjI2RYVy43SKecBv36XGlBuJTPD1kZFYG.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(7, 'Aksesoris'),
(9, 'Monitor'),
(10, 'CCTV');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('febriarianto464@gmail.com', '$2y$10$.rdykOjJhLciLHRuOUChqObOXDlQ1eF.6WzklQVpkz402qjTgTsgK', '2022-06-13 19:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat`, `no_tlp`) VALUES
(0, '-', '-', '-'),
(3, 'Achdiat Putra Pratama', 'GedongTataan Karet ijo', '+6281312312312'),
(4, 'Febri Arianto', 'Pringsewu', '+6281234567891');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `no_pembelian` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_pembelian`, `id_supplier`, `total`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 3, '100000.00', 2, '2022-07-02 20:08:17', '2022-07-02 20:08:17'),
(2, 3, '100000.00', 2, '2022-07-02 20:23:07', '2022-07-02 20:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_item`
--

CREATE TABLE `pembelian_item` (
  `no_pembelian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_item`
--

INSERT INTO `pembelian_item` (`no_pembelian`, `id_barang`, `jumlah`, `harga`) VALUES
(0, 10, 12, '12.00'),
(0, 2, 12, '12.00');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `uang_bayar` decimal(10,2) NOT NULL,
  `diskon` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `kembalian` decimal(10,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `id_pelanggan`, `uang_bayar`, `diskon`, `total`, `kembalian`, `keterangan`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 3, '2.00', '0.00', '2.00', '50.00', NULL, 2, '2022-06-28 18:51:15', '2022-06-28 18:51:15'),
(2, 0, '300.00', '0.00', '300.00', '0.00', NULL, 2, '2022-06-28 18:52:14', '2022-06-28 18:52:14'),
(3, 4, '750.00', '0.00', '750.00', '0.00', NULL, 2, '2022-06-28 18:53:11', '2022-06-28 18:53:11'),
(4, 0, '600.00', '0.00', '600.00', '0.00', NULL, 2, '2022-06-27 20:26:26', '2022-06-29 03:27:09'),
(5, 4, '1.00', '0.00', '950.00', '50.00', NULL, 2, '2022-06-30 07:45:23', '2022-06-30 07:45:23'),
(6, 4, '450.00', '0.00', '410.00', '40.00', NULL, 2, '2022-07-01 07:55:12', '2022-07-01 07:55:12'),
(7, 3, '60.00', '0.00', '60.00', '0.00', NULL, 2, '2022-07-01 08:06:33', '2022-07-01 08:06:33'),
(8, 3, '60.00', '0.00', '60.00', '0.00', NULL, 2, '2022-07-01 08:06:55', '2022-07-01 08:06:55'),
(9, 3, '60.00', '0.00', '60.00', '0.00', NULL, 2, '2022-07-01 08:08:38', '2022-07-01 08:08:38'),
(10, 0, '500.00', '0.00', '500.00', '0.00', NULL, 2, '2022-07-01 08:09:28', '2022-07-01 08:09:28'),
(11, 4, '1.00', '0.00', '1.00', '0.00', NULL, 2, '2022-07-01 08:11:10', '2022-07-01 08:11:10'),
(12, 4, '1.00', '0.00', '1.00', '0.00', NULL, 2, '2022-07-01 08:13:05', '2022-07-01 08:13:05'),
(13, 4, '60.00', '0.00', '60.00', '0.00', NULL, 2, '2022-07-01 08:14:32', '2022-07-01 08:14:32'),
(14, 0, '150000.00', '0.00', '150000.00', '0.00', NULL, 2, '2022-07-01 09:16:26', '2022-07-01 09:16:26'),
(15, 0, '60000.00', '0.00', '60000.00', '0.00', NULL, 2, '2022-07-01 09:27:26', '2022-07-01 09:27:26'),
(16, 0, '950000.00', '101000.00', '920000.00', '30000.00', NULL, 2, '2022-07-02 21:11:01', '2022-07-02 21:11:01'),
(17, 4, '60000.00', '10000.00', '60000.00', '0.00', NULL, 2, '2022-07-02 21:14:34', '2022-07-02 21:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_item`
--

CREATE TABLE `penjualan_item` (
  `no_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_item`
--

INSERT INTO `penjualan_item` (`no_penjualan`, `id_barang`, `jumlah`, `harga_jual`) VALUES
(1, 3, 5, '70000.00'),
(1, 4, 1, '1000000.00'),
(1, 6, 2, '400000.00'),
(2, 5, 5, '60000.00'),
(3, 7, 5, '150000.00'),
(4, 10, 1, '250000.00'),
(4, 9, 1, '350000.00'),
(5, 10, 1, '250000.00'),
(5, 9, 2, '350000.00'),
(6, 5, 1, '60000.00'),
(6, 3, 5, '70000.00'),
(7, 5, 1, '60000.00'),
(10, 8, 1, '500000.00'),
(11, 4, 1, '1000000.00'),
(13, 5, 1, '60000.00'),
(14, 7, 1, '150000.00'),
(15, 5, 1, '60000.00'),
(16, 2, 12, '85000.00'),
(17, 3, 1, '70000.00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`, `alamat`, `no_tlp`) VALUES
(3, 'Toko Berkah Jaya', 'Pringsewu', '+6281234567891'),
(5, 'Toko Abadi jaya', 'Gading', '+620800000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Febri', 'febriarianto464@gmail.com', NULL, '$2y$10$C1vKPXj80LXYYcD8TbZKDuN4CIohChcs25.ls8k3SdCbHVFxxt7Xe', 'user', NULL, '2022-06-08 20:31:19', '2022-06-08 20:31:19'),
(2, 'Admin User', 'admin@klik-comp.com', NULL, '$2y$10$kYfX9etihiYzgkRxOBJ8weWkqKkYTXcvWHyrg.vjWAGzbGzsVUG9q', 'admin', NULL, '2022-06-20 22:05:37', '2022-06-20 22:05:37'),
(3, 'Kasir', 'kasir@klik-comp.com', NULL, '$2y$10$nP426yc0j0QbfPK5B6m6I.CLIh7dCfZ.nP6uML8Iq5CLZ7Vx3nlNq', 'kasir', NULL, '2022-07-01 10:55:50', '2022-07-01 10:55:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_detail`
--
ALTER TABLE `barang_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `barang_detail`
--
ALTER TABLE `barang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `no_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `no_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
