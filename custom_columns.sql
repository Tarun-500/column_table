-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 30, 2024 at 09:10 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `custom_columns`
--

DROP TABLE IF EXISTS `custom_columns`;
CREATE TABLE IF NOT EXISTS `custom_columns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `column_class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_visible` tinyint NOT NULL,
  `column_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_columns`
--

INSERT INTO `custom_columns` (`id`, `user_id`, `column_name`, `column_class`, `is_visible`, `column_id`) VALUES
(1, 4, 'myname', 'myname', 1, 1),
(3, 1, 'tRUN', 'trun', 1, 0),
(4, 4, 'city', 'city', 1, 0),
(5, 3, 'city', 'city', 1, 0),
(7, 3, 'One', 'one', 1, 0),
(9, 3, 'Middle name', 'middle-name', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
