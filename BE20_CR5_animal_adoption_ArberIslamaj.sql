-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2023 at 07:09 PM
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
-- Database: `BE20_CR5_animal_adoption_ArberIslamaj`
--
CREATE DATABASE IF NOT EXISTS `BE20_CR5_animal_adoption_ArberIslamaj` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `BE20_CR5_animal_adoption_ArberIslamaj`;

-- --------------------------------------------------------

--
-- Table structure for table `adoption`
--

CREATE TABLE `adoption` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_animal` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption`
--

INSERT INTO `adoption` (`id`, `fk_user`, `fk_animal`, `date`) VALUES
(14, 1, 1, '2023-11-25 00:00:00'),
(15, 3, 5, '2023-11-25 00:00:00'),
(16, 4, 9, '2023-11-25 00:00:00'),
(17, 5, 12, '2023-11-25 00:00:00'),
(18, 1, 23, '2023-11-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `petID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `size` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `vaccinated` varchar(50) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`petID`, `name`, `picture`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`) VALUES
(1, 'Buddy', '65620a609cba5.jpg', 'Wien Street 1', 'Friendly and playful dog', 'medium', 3, 'Yes', 'Labrador Retriever', 'adopted'),
(2, 'Whiskers', '6562094de3593.jpg', 'Wien Street 2', 'Adorable and independent cat', 'small', 2, 'Yes', 'Siamese', 'available'),
(3, 'Rocky', '656206e044a58.png', 'Wien Street 3', 'Energetic and loving dog', 'large', 10, 'Yes', 'German Shepherd', 'available'),
(4, 'Mittens', '656207b732e77.jpg', 'Wien Street 4', 'Cuddly and friendly cat', 'medium', 1, 'no', 'Maine Coon', 'available'),
(5, 'Spike', '656208b88d9d8.jpg', 'Wien Street 5', 'Playful and curious hedgehog', 'small', 4, 'no', 'African Pygmy Hedgehog', 'adopted'),
(6, 'Luna', '65620a1d988ea.jpg', 'Wien Street 6', 'Gentle and calm rabbit', 'small', 2, 'Yes', 'Holland Lop', 'available'),
(7, 'Leo', '65620b7599a3e.jpg', 'Wien Street 7', 'Active and friendly hamster', 'small', 1, 'no', 'Syrian Hamster', 'available'),
(8, 'Daisy', '65620c3c0d06e.jpg', 'Wien Street 8', 'Sweet and affectionate guinea pig', 'small', 3, 'Yes', 'American Guinea Pig', 'available'),
(9, 'Max', '65620d03c479a.png', 'Wien Street 9', 'Loyal and intelligent dog', 'medium', 9, 'Yes', 'Golden Retriever', 'adopted'),
(10, 'Oliver', '65620ea546ce2.jpg', 'Wien Street 10', 'Charming and mischievous cat', 'small', 11, 'Yes', 'British Shorthair', 'available'),
(11, 'Coco', '65620f87de82c.jpg', 'Wien Street 11', 'Playful and friendly parrot', 'small', 6, 'Yes', 'Budgerigar', 'available'),
(12, 'Nala', '65621038890f1.jpg', 'Wien Street 12', '', 'medium', 8, 'Yes', 'Persian', 'adopted'),
(23, 'Animal to delete', 'pet.png', 'Favoritenstrasse 15', ' Please delete me to test the functionality! I am not vaccinated!', 'medium', 2, 'Yes', 'Happy animal', 'adopted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `source` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `address`, `phone`, `pass`, `picture`, `source`) VALUES
(1, 'Bill', 'Harley', 'bill.harley@codereview.at', 'Vienna', '+43601234567', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'avatar.png', 'user'),
(2, 'Arber', 'Islamaj', 'arber.islamaj@codereview.at', 'Vienna', '+4360123456', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'avatar.png', 'adm'),
(3, 'Jeffrey', 'Allison', 'j.allison@codereview.at', 'Salzburg', '+4360123456', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'avatar.png', 'user'),
(4, 'Janette', 'Bryant', 'janette.b@codereview.at', 'Linz', '+4360123456', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'avatar.png', 'user'),
(5, 'Vanessa', 'Smith', 'vanesa.smith@codereview.at', 'Graz', '+4360123456', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'avatar.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_animal` (`fk_animal`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`petID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `adoption_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `adoption_ibfk_2` FOREIGN KEY (`fk_animal`) REFERENCES `animals` (`petID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
