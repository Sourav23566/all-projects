-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2026 at 06:42 PM
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
-- Database: `userdb_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `pass1` varchar(255) NOT NULL,
  `education` text NOT NULL,
  `language` text NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'regular',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `mobile`, `pass1`, `education`, `language`, `profile_pic`, `role`, `created`) VALUES
('user-2890-1783239922', 'Sourav kar', 'souravkar989@gmail.com', '8670480715', '$2y$10$J0LeaBHzUoNboG6Zuhv0IuoyNfq3UyFxI/FSmHub65pzBEOzyJkfK', '10th,12th,graduation,postgraduation', 'Bengali,English,Hindi', './uploads/ecb4cc1c53541372-1783239922my.jpg', 'admin', '2026-07-05 08:25:22'),
('user-7191-1770065657', 'Amit saha', 'amitsaha12@gmail.com', '9875648952', '$2y$10$iqUbycSZZe3kkU7tOmdvV.GxJxb.LDoqda1A45msqfM4ZyW4lKLJy', '10th,12th,graduation', 'Bengali,English', './uploads/615056b51da26728-1770065657avater2.jpeg', 'regular', '2026-02-02 20:54:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
