-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2025 at 12:33 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u951570841_weddingan`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `created_at`, `is_verified`, `verification_token`) VALUES
(1, 'jokowi@prabowo.com', '$2y$10$xTDlYLI6REpBjDnvtvY/u.m1Eb9qvAuA0GHXr3gPQ9ckWjo.R0DZe', '2025-04-28 20:17:09', 0, NULL),
(3, 'prabowo@admin.com', '$2y$10$SXg5QFaWXVZ8gWz4ZLRi/e9W2A68wdOCqLhnSlqXYa/j6KP.qrHVe', '2025-04-28 21:00:13', 0, 'ab4f2b3d0e910eff45892b085ed00d33'),
(6, 'gibran@silucu.com', '$2y$10$6pdH0IXorxAQwW/o3Dq/heiDLaGwWfxLlVDf7nE4DtflXHFBOBKLa', '2025-04-28 21:21:44', 0, 'c544e39e7cce1e9f87613879f9a6b310'),
(9, 'sonichedgehogzx@gmail.com', '$2y$10$WJ3xsd5j2m7s9fmbUa5ngOWR2WB.ONuohCcQcLCdrGpOAxiaGCbyy', '2025-04-28 21:35:45', 1, NULL),
(11, 'riisamanha@gmail.com', '$2y$10$.dHqco8IlRTfpKqdk5YdxOBm9tE5xOJUtLsKpE2WQMIX/VEEzK98a', '2025-04-29 09:31:07', 1, NULL),
(12, 'kapalmeleduk5@gmail.com', '$2y$10$ZoKVl5ciJRJauYEOWmkXye9M.tZrUI4hT86dVXensm2.8sp87dag.', '2025-04-29 09:34:28', 1, NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
