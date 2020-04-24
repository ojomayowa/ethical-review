-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2020 at 11:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_approval`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `name`, `staff_id`, `password`, `created_at`) VALUES
(1, 'Mason Stewart', '1998343', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-08 10:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `approval_request_eao`
--

CREATE TABLE `approval_request_eao` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `eao_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approval_request_eao`
--

INSERT INTO `approval_request_eao` (`id`, `request_id`, `eao_id`, `created_at`) VALUES
(1, 11, 234567, '2020-04-16 22:07:31'),
(2, 11, 123456, '2020-04-16 22:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `eao_feedbacks`
--

CREATE TABLE `eao_feedbacks` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `eao_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eao_feedbacks`
--

INSERT INTO `eao_feedbacks` (`id`, `request_id`, `eao_id`, `feedback`, `status`, `created_at`) VALUES
(6, 11, 234567, 'ASACACASCA', 1, '2020-04-18 11:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `experiments`
--

CREATE TABLE `experiments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `approval_status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experiments`
--

INSERT INTO `experiments` (`id`, `student_id`, `title`, `description`, `approval_status`, `created_at`) VALUES
(13, 2000916, 'experiment title', 'description', 3, '2020-04-12 13:09:53'),
(14, 2000916, 'kiuuuiuuu', 'ufufufuffuy', 2, '2020-04-12 14:18:20'),
(15, 2000916, 'An Award Winning Fresh 105.9 Part 2', 'An Award Winning Fresh 105.9 FM Best Indigenous Radio Station, a commercial radio station operating in Ibadan, Oyo State and with a reach extending to other parts of Oyo as well as Ogun State. It is the brainchild of renowned Entertainer, Yinka Ayefele (MON), and is positioned to promote, complement and revamp the entertainment and lifestyle sphere in Ibadan. The station is conveniently located at Yinka Ayefele Music House, on the Lagos – Ibadan by-pass road, Felele, Ibadan. descThe goal of a reset stylesheet is to reduce browser inconsistencies in things like default line heights, margins and font sizes of headings, and so on. The general reasoning behind this was discussed in a May 2007 post, if you\'re interested. Reset styles quite often appear in CSS frameworks, and the original \"meyerweb reset\" found its way into Blueprint, among others.The goal of a reset stylesheet is to reduce browser inconsistencies in things like default line heights, margins and font sizes of headings, and so on. The general reasoning behind this was discussed in a May 2007 post, if you\'re interested. Reset styles quite often appear in CSS frameworks, and the original \"meyerweb reset\" found its way into Blueprint, among others.', 3, '2020-04-12 14:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `experiment_approval_officers`
--

CREATE TABLE `experiment_approval_officers` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experiment_approval_officers`
--

INSERT INTO `experiment_approval_officers` (`id`, `staff_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, '123456', 'Kola Tunez', 'kolatunz@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-16 22:06:49'),
(2, '234567', 'Ibra Mo Vic', 'ibra@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-16 22:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fullname`, `student_id`, `email`, `password`, `created_at`) VALUES
(4, 'OLUWAMAYOWA DANIEL OJO', '20009163', 'ojomayor@yahoo.com', 'e3ceb5881a0a1fdaad01296d7554868d', '2020-04-06 10:00:00'),
(6, 'OLUWAMAYOWA DANIEL OJO', '20009167', 'ojomayor@yahogo.com', '589a2fdd3f239fd160f0e80a799bc1e7', '2020-04-06 10:02:11'),
(7, 'adeniji ayo', '2000916', 'adenijiayocharles@gmail.com', 'a5410ee37744c574ba5790034ea08f79', '2020-04-06 10:11:42'),
(8, 'OLUWAMAYOWA DANIEL OJO', 'sdsd', 'sdsdsd', '6c14f32a74b71cb26c99bf35ff5101a1', '2020-04-06 10:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `submitted_requests`
--

CREATE TABLE `submitted_requests` (
  `id` int(10) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `experiment_id` int(10) NOT NULL,
  `reasons` text NOT NULL,
  `file_location` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submitted_requests`
--

INSERT INTO `submitted_requests` (`id`, `student_id`, `experiment_id`, `reasons`, `file_location`, `created_at`) VALUES
(10, '2000916', 13, 'Entertainer, Yinka Ayefele (MON), and is positioned to promote, complement and revamp the entertainment and lifestyle sphere in Ibadan. The station is conveniently located at Yinka Ayefele Music House, on the Lagos – Ibadan by-pass road, Felele, Ibadan.', 'OJO LOGIS.docx', '2020-04-12 13:10:29'),
(11, '2000916', 14, 'It may be used on all commercial varieties of winter and spring wheat and barley, winter oats and rye, and listed cereals undersown with grass or clover.DIOWEED 50 is a broad-spectrum herbicide for the control of broad-leaved weeds in cereals and grassland.\r\n\r\nIt may be used on all commercial varieties of winter and spring wheat and barley, winter oats and rye, and listed cereals undersown with grass or clover.DIOWEED 50 is a broad-spectrum herbicide for the control of broad-leaved weeds in cereals and grassland.\r\n\r\nIt may be used on all commercial varieties ol of broad-leaved weeds in cereals and grassland.\r\n\r\nIt may be used on all commercial varieties of winter and spring wheat and barley, winter oats and rye, and listed cereals undersown with grass or clover.DIOWEED 50 is a broad-spectrum herbicide for the control of broad-leaved weeds in cereals and grassland.\r\n\r\nIt may be used on all commercial varieties of winter and spring wheat and barley, winter oats and rye, and listed cereals undersown with grass or clover.', 'coverletter.docx', '2020-04-12 14:19:37'),
(12, '2000916', 15, 'hgmghghgh', 'coverletter.docx', '2020-04-12 14:45:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_request_eao`
--
ALTER TABLE `approval_request_eao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eao_feedbacks`
--
ALTER TABLE `eao_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiments`
--
ALTER TABLE `experiments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiment_approval_officers`
--
ALTER TABLE `experiment_approval_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitted_requests`
--
ALTER TABLE `submitted_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approval_request_eao`
--
ALTER TABLE `approval_request_eao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eao_feedbacks`
--
ALTER TABLE `eao_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `experiments`
--
ALTER TABLE `experiments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `experiment_approval_officers`
--
ALTER TABLE `experiment_approval_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submitted_requests`
--
ALTER TABLE `submitted_requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
