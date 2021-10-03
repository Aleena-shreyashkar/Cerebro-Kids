-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 04:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginr`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `username`, `password`, `created_at`) VALUES
(1, '', 'gfstrsrt@ryttyt.fyufu', '$2y$10$5G9qBDRvIX/tjwc05ySA4OxGZfGVd.7p7guPuUjGm6WlfAcTfvjOa', '2021-06-19 15:00:01'),
(2, '', 'ghfyufyuj@tycjdcjy.com', '$2y$10$BeqCRQrGJ2peb7b2r3bfXOiRk7zOB7qu7tkFIhvM4MDRS3kbA1wti', '2021-06-19 15:05:48'),
(3, '', 'hfstht@thdthdty.com', '$2y$10$8pcBHUC2KPAjOK9VhKvtUuUIYUUPHFBWha48npoYozkjbdb1RrhqC', '2021-06-19 15:10:04'),
(4, '', 'ghhdcegdg@tycjhcjhv.cioghiu', '$2y$10$nUDUTrhNFEHVhSfbZKSqfOnsXk1k3TcKv8eEWka6Aja/2CLE1uPAO', '2021-06-19 15:11:59'),
(5, '', 'hjfuyfuiui@yfyjuf.jdcyu', '$2y$10$8oE8o9UBsoZtlaUONgPXnu0e.GMydhOK.ZiHCF/WjjGOsOe7wSSA2', '2021-06-19 15:13:29'),
(6, '', 'tyydyudyud@tydtudyuy', '$2y$10$F1/hTLQDEp6ELjzANUiVBO/3Tu8aaNrD5tARj8j2JhDHozVTZIBh.', '2021-06-19 15:16:44'),
(7, '', 'rdsrysrsyt@trxryxy', '$2y$10$5QkyuB6xfc4JC.obgsf9JeSN4yrjym3HAAhdYDia.MXhnUldLdn3K', '2021-06-19 15:18:10'),
(8, 'Aleena Shreyashkar', 'aleenashreyashkar4476@gmail.com', '$2y$10$fuKQGsNnfItxrJcVbr2hs.ZE86cyXhpNiklZU79T0Yr2.MBG4IeIO', '2021-06-19 15:23:19'),
(9, '', 'singhanshu@gmail.com', '$2y$10$zQFhfDjc8eesOCnbBZ9WlOfi.Qd7nXwdaNwK6uoxW5obtDQJFdAOG', '2021-06-19 18:21:43'),
(10, '', 'eubi@gmail.com', '$2y$10$v.714Pv0UFq/N/ItIDb2C.2D8TtSIaMnve.coYvyx6uF3O53OmVU6', '2021-06-19 18:25:17'),
(11, '', 'au@gmail.com', '$2y$10$cWRZIDgXGAtealtYQjVUMeOSn8.rh8gBH6KQvtcfAtzY1sERO6BDi', '2021-06-19 18:29:53'),
(12, '', 'as@gmail.com', '$2y$10$nim0In6nZR.aiVmr.rddmeauvnp6vWDcX5XFQ63S4bTRSRBc7hzde', '2021-06-19 18:36:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
