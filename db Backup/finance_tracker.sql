-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 08:32 PM
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
-- Database: `finance_tracker`
--

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `month`, `year`, `amount`) VALUES
(1, 3, 2025, 5000.00);

--
-- Dumping data for table `savings_goals`
--

INSERT INTO `savings_goals` (`id`, `user_id`, `amount`, `months`, `created_at`, `updated_at`) VALUES
(1, 1, 5000.00, 1, '2025-03-31 15:40:40', '2025-03-31 18:20:04');

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `serial_number`, `type`, `category`, `amount`, `created_at`) VALUES
(1, 1, 'income', 'Salary', 50000.00, '2025-03-31 14:46:59'),
(2, 2, 'expense', 'Movie', 500.00, '2025-03-31 14:47:09'),
(3, 3, 'expense', 'Food', 300.00, '2025-03-31 14:47:22'),
(4, 4, 'expense', 'Shopping', 1200.00, '2025-03-31 14:47:31'),
(6, 5, 'expense', 'Salary', 590.00, '2025-03-31 14:50:39'),
(7, 6, 'expense', 'Shopping', 2000.00, '2025-03-31 18:08:42'),
(8, 7, 'expense', 'Food', 1000.00, '2025-03-31 18:08:49'),
(9, 8, 'expense', 'Shopping', 35000.00, '2025-03-31 18:21:44'),
(10, 9, 'expense', 'Movie', 8500.00, '2025-03-31 18:22:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
