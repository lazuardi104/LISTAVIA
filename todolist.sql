-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 07:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('selesai','sedang dikerjakan','belum dikerjakan') NOT NULL DEFAULT 'belum dikerjakan',
  `prioritas` enum('segera','biasa') NOT NULL DEFAULT 'biasa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `judul`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `status`, `prioritas`) VALUES
(4, 1, 'makan', 'minum', '4984-09-09', '0092-04-08', 'selesai', 'biasa'),
(5, 2, 'minuman bergizi', 'nana', '0000-00-00', '0782-08-23', 'belum dikerjakan', 'biasa'),
(6, 2, 'jauza', 'jancok', '9999-09-09', '1111-11-11', '', 'biasa'),
(7, 3, 'tidur', 'mahal', '2007-09-02', '2020-10-04', 'sedang dikerjakan', 'biasa'),
(8, 3, 'jhsddjk', 'kjasnck,m c', '0001-08-07', '0038-08-29', '', 'biasa'),
(9, 3, 'aklsjc,', 'as,.klmc ', '0798-02-08', '0098-07-06', 'belum dikerjakan', 'biasa'),
(10, 3, 'wiohfncsz', 'klmc,.z ', '0890-06-07', '0789-05-06', 'sedang dikerjakan', 'biasa'),
(11, 3, 'hgsvjhbjn', 'kjashcns', '0789-05-06', '0000-00-00', 'selesai', 'biasa'),
(12, 1, 'minum dong', 'gisul', '2025-02-12', '2025-02-14', 'sedang dikerjakan', 'segera'),
(15, 1, 'dvagsv', 'sdavsdv', '0000-00-00', '0023-12-23', 'selesai', 'segera'),
(16, 1, '214wsad', 'asasfcas', '4124-04-12', '0124-02-14', 'selesai', 'biasa'),
(17, 1, 'asfcd', 'csdvcsdv', '0004-02-12', '0000-00-00', 'sedang dikerjakan', 'biasa'),
(18, 1, 'wadaf', 'dc213123', '1231-02-13', '0067-07-06', 'selesai', 'segera'),
(19, 1, 'tugas 2', 'kontol', '0000-00-00', '6789-05-04', 'belum dikerjakan', 'segera');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `full_name`, `password`, `created_at`) VALUES
(1, 'zua', '', '', '$2y$10$qE3OPSWYw2oVK5I1QsOKQOkLpjPk5/Bkvdi4YeOP.X1kyJ5xbiOTi', '2025-02-02 12:43:07'),
(2, 'na', '', '', '$2y$10$0sHU/WAtPmio6b6FMt5HW.mgcVmSu.HQBwuY5ubaX4p6IWXJuTfuq', '2025-02-02 12:44:07'),
(3, 'lazuardi', '', '', '$2y$10$pVGzcZBy8NVBgoZtVuo1ZOeikbu5lK5VrfmHPB0795j3ncNNWg2XG', '2025-02-02 22:45:00'),
(4, 'nuni', '', '', '$2y$10$OwoVjcayjYwleSpl7NjBou79upaLcIQcbwaFctfujM7aqPa15h97W', '2025-02-04 12:55:59'),
(5, 'admin', 'lazuardiilmi104@gmail.com', 'lazuardiilmi', '$2y$10$bD4ZdzgINJk9SmCsqCw.auvDbgx8HU2/hpwsnwwCBnFgFftzBtQUC', '2025-02-04 13:19:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
