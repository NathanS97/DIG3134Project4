-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2019 at 12:19 AM
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
('N68grass', 'n.snodgrass97@gmail.com', '$2y$10$9ZPM.JE93w/jwkjiUyaV1.X5aDahHyz04VHz9bEb6vwc3Mljlglky'),
('TestNS', 'testNS@gmail.com', '$2y$10$b/q87itu9kuJ/rsQMZswxeCmrWC//fgEjqmsvrTBPByvdPx5dSrBu');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `dates` datetime NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `username`, `dates`, `comment`) VALUES
(17, 'N68grass', '2019-12-06 16:41:19', 'First :D'),
(25, 'Brooke_Eden', '2019-12-08 16:45:33', 'Wow, super pretty! Love all the colors on the trees. '),
(27, 'Jmmurphy123', '2019-12-08 16:52:09', 'That sounded like an amazing trip, I cant wait to visit Japan in the future'),
(29, 'Honhd567', '2019-12-08 17:00:17', 'I was planning to visit at some point, I am a big fan of Japanese temple architecture.');

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
('N68grass', '01-30-2015', 'If you havent been to Japan, well pack your bags because you NEED to go. The food was the best Ive ever had and just being submerged in the culture was an experience Ill never forget.', 'public/img/japan.jpg');

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
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
