-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 02:26 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_four`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `email`, `pword`) VALUES
('Brooke_Eden', 'brookee.eden@gmail.com', '$2y$10$Swa2StpOcvIwWykbajIfM.WwL50QRVsYUsl2l4EqYVCGEu0Pu4p1e'),
('Honhd567', 'DerrickZheng00@gmail.com', '$2y$10$bWr/fPPjwB0an5SvGfkHLe8EiK.BkLFD1ReVBF9e1ZiwM/yCjKSEq'),
('Jmmurphy123', 'JMMurphy137@gmail.com', '$2y$10$smQoiE6dBvwtVT4s5l0/Pej1FKjaWP7aLAzjHguIjQGZYJrLz93n2'),
('N68grass', 'n.snodgrass97@gmail.com', '$2y$10$9ZPM.JE93w/jwkjiUyaV1.X5aDahHyz04VHz9bEb6vwc3Mljlglky');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `username` varchar(25) NOT NULL,
  `comment` text NOT NULL,
  `dates` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `username` varchar(25) NOT NULL,
  `dates` varchar(10) NOT NULL,
  `review` varchar(255) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`username`, `dates`, `review`, `img`) VALUES
('N68grass', '01-30-2015', 'If you havent been to Japan, well pack your bags because you NEED to go. The food was the best Ive ever had and just being submerged in the culture was an experience Ill never forget.', 'public/img/japan.jpg'),
('TestNS', '04-20-1969', 'pls work', 'public/img/1thonk.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
