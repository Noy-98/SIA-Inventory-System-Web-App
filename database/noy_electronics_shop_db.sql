-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 09:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noy_electronics_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `session_id`, `email`, `ip_address`, `login_time`) VALUES
(9, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 07:31:21'),
(10, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 07:31:22'),
(11, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 07:34:10'),
(12, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 07:35:34'),
(13, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 07:36:02'),
(14, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 07:36:02'),
(15, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 07:36:12'),
(16, '0iollot25ds73jlhuqpagac4a6', 'yajaspacio@gmail.com', '::1', '2023-06-20 07:36:53'),
(17, '0iollot25ds73jlhuqpagac4a6', 'yajaspacio@gmail.com', '::1', '2023-06-20 08:03:44'),
(18, '0iollot25ds73jlhuqpagac4a6', 'yajaspacio@gmail.com', '::1', '2023-06-20 08:12:49'),
(19, '0iollot25ds73jlhuqpagac4a6', 'yajaspacio@gmail.com', '::1', '2023-06-20 08:44:19'),
(20, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 09:11:41'),
(21, '0iollot25ds73jlhuqpagac4a6', 'noy.electronic.shop@gmail.com', '::1', '2023-06-20 09:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `upload_in` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`id`, `name`, `price`, `quantity`, `upload_in`) VALUES
(6, '', '123', '123', '2023-06-20 14:56:11'),
(7, '2222', '222', '222', '2023-06-20 14:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_table`
--

CREATE TABLE `supplier_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `url` varchar(100) NOT NULL,
  `upload_in` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_table`
--

INSERT INTO `supplier_table` (`id`, `name`, `address`, `phone`, `url`, `upload_in`) VALUES
(16, 'whoop', 'makati', '09075950366', 'asdasdsa', '2023-06-20 12:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','employee') NOT NULL DEFAULT 'employee',
  `code` varchar(10) NOT NULL,
  `date_and_time` datetime NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`id`, `name`, `address`, `phone_number`, `email`, `password`, `user_type`, `code`, `date_and_time`, `image`) VALUES
(1, 'Team Aspacioink', 'Makati', '09075950366', 'noy.electronic.shop@gmail.com', '$2y$10$nMke8tIIvm8bUn6oYPzKqOormr6Y9UPY6qX8z/ZtbSL51beBfv9ii', 'admin', '', '2023-06-20 07:09:14', ''),
(30, 'Jay', '', '', 'yajaspacio@gmail.com', '$2y$10$NhQuulUEndnyX64egGgKl.yyV6t.Hrq15eY..OGSdvrsQp/2n9/Yq', 'employee', '', '2023-06-20 13:36:48', 'Jay64913af0760a36.44019982.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_table`
--
ALTER TABLE `supplier_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier_table`
--
ALTER TABLE `supplier_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
