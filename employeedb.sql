-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 02, 2024 at 03:55 AM
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
  `column_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `column_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_visible` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_columns`
--

INSERT INTO `custom_columns` (`id`, `user_id`, `column_name`, `column_class`, `is_visible`) VALUES
(3, 3, 'Pet Name', 'pet_name', 1),
(4, 4, 'Favorite Food', 'favorite_food', 1),
(5, 5, 'Favorite Movie', 'favorite_movie', 1),
(6, 6, 'Favorite Book', 'favorite_book', 1),
(7, 7, 'Favorite Sport', 'favorite_sport', 1),
(8, 8, 'Favorite Music', 'favorite_music', 1),
(10, 10, 'Favorite Season', 'favorite_season', 1);

-- --------------------------------------------------------

--
-- Table structure for table `custom_column_values`
--

DROP TABLE IF EXISTS `custom_column_values`;
CREATE TABLE IF NOT EXISTS `custom_column_values` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `column_id` int NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `column_class` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `column_id` (`column_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_column_values`
--

INSERT INTO `custom_column_values` (`id`, `user_id`, `column_id`, `value`, `column_class`) VALUES
(3, 3, 3, 'Buddy', NULL),
(4, 4, 4, 'Pizza', NULL),
(5, 5, 5, 'Inception', NULL),
(6, 6, 6, 'Pride and Prejudice', NULL),
(7, 7, 7, 'Soccer', NULL),
(8, 8, 8, 'Rock', NULL),
(10, 10, 10, 'Spring', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nickname`, `mobile`, `email`, `role`, `address`, `gender`, `profile_image`) VALUES
(3, 'Alice Johnson', 'Ally', '5555555555', 'alice@example.com', 'Designer', '789 Pine St', 'Female', 'uploads/alice.jpg'),
(4, 'Bob Brown', 'Bobby', '4444444444', 'bob@example.com', 'Tester', '321 Maple St', 'Male', 'uploads/bob.jpg'),
(5, 'Charlie Davis', 'Char', '3333333333', 'charlie@example.com', 'Support', '654 Birch St', 'Male', 'uploads/charlie.jpg'),
(6, 'Diana Evans', 'Di', '2222222222', 'diana@example.com', 'HR', '987 Cedar St', 'Female', 'uploads/diana.jpg'),
(7, 'Eve Foster', 'Evie', '1111111111', 'eve@example.com', 'Marketing', '159 Spruce St', 'Female', 'uploads/eve.jpg'),
(8, 'Frank Green', 'Frankie', '6666666666', 'frank@example.com', 'Sales', '753 Willow St', 'Male', 'uploads/frank.jpg'),
(10, 'Henry Irving', 'Hank', '8888888888', 'henry@example.com', 'Admin', '951 Poplar St', 'Male', 'uploads/henry.jpg'),
(12, 'garima goyal', 'GARIMA', '789549687', 'garima@gmail.com', 'Developer', 'sukhaliya', 'Female', 'uploads/imgpsh_fullsize_anim-1.jpg'),
(13, 'diya shah', 'diya', '8889855674', 'diya@gmail.com', 'Qa', 'pardeshipura', 'Female', 'uploads/imgpsh_fullsize_anim-removebg-preview.png'),
(17, 'Anay shah', 'anay', '987844848', 'anay@gmail.com', 'student', 'Indore', 'Male', 'uploads/imgpsh_fullsize_anim-removebg-preview.png'),
(21, 'david beckom', 'david', '4565445445', 'sdsfs@gmf.ddd', 'wewewQ', 'ererererr', 'Male', 'uploads/imgpsh_fullsize_anim-removebg-preview.png'),
(22, 'royal enfield', 'royal', '854789347', 'royal@gmail.com', 'Bike', 'chennai', 'Female', 'uploads/imgpsh_fullsize_anim-removebg-preview.png'),
(23, 'Ashish kumar', 'aasu', '98585858', 'ashish@gmail.com', 'poject manager', 'office ', 'Male', 'uploads/imgpsh_fullsize_anim-removebg-preview.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_columns`
--
ALTER TABLE `custom_columns`
  ADD CONSTRAINT `custom_columns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `custom_column_values`
--
ALTER TABLE `custom_column_values`
  ADD CONSTRAINT `custom_column_values_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `custom_column_values_ibfk_2` FOREIGN KEY (`column_id`) REFERENCES `custom_columns` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
