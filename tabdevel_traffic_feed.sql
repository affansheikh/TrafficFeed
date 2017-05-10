-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2017 at 11:47 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabdevel_traffic_feed`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL,
  `post` varchar(255) NOT NULL,
  `posted_by` int(255) NOT NULL,
  `posted_on` varchar(255) NOT NULL,
  `place_name` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `location`, `lat`, `lng`, `post`, `posted_by`, `posted_on`, `place_name`) VALUES
(2, '31.47074919359081,74.41163957118988', '31.47074919359081', '74.41163957118988', 'i am stuck in bhatta Chowk', 3, '1494394762001', 'Lahore'),
(3, '31.474067692309408,74.40741375088692', '31.474067692309408', '74.40741375088692', 'i am stuck. heavy traffic', 3, '1494394808577', 'Lahore'),
(4, '31.470764635391134,74.41161710768938', '31.470764635391134 ', '74.41161710768938', 'i am stuck at heavy traffic in bhatta chowk', 3, '1494395315327', 'Lahore'),
(5, '31.470764635391134,74.41161710768938', '31.470764635391134 ', '74.41161710768938', 'i am stuck at heavy traffic in bhatta chowk', 3, '1494395345793', 'Lahore');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `mobile`, `password`) VALUES
(1, 'amrish', 'Kakadiya', 'amrish.kakadiya@gmail.com', '9033779583', '12345'),
(2, 'Anshuman', 'Tiwari', 'anshuman.sfi@gmail.com', '8687155546', 'amrishiloveyou'),
(3, 'hamza ', 'farrukh', 'farrukhhamza4@gmail.com', '03215149049', 'hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
