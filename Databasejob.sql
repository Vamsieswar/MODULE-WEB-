-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 05:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` bigint(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `passedout_year` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cover_letter` text NOT NULL,
  `resume_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `name`, `email`, `contact_number`, `category`, `passedout_year`, `status`, `address`, `cover_letter`, `resume_path`, `created_at`, `sid`) VALUES
(57, 'VAMSI123', 'vamsi0123@gmail.com', 1234, 'marketing', '2023', 'Accepted', 'chennai', 'efd', 'EXTERNAL TRAINING - 23.11.2023.pdf', '2024-03-28 04:37:07', 1),
(58, 'VAMSI123', 'vamsi0123@gmail.com', 1234, 'marketing', '2023', 'Accepted', 'chennai', 'test', 'RESUME 17-11 (8).pdf', '2024-03-28 04:38:38', 1),
(59, 'VAMSI123', 'vamsi0123@gmail.com', 1234, 'Project Management', '2023', 'Accepted', 'chennai', 'erer', 'resume.pdf', '2024-03-28 04:40:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(10) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `number` bigint(10) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `number`, `email`, `password`) VALUES
(1, 'Admin User', 8979555558, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251'),
(2, 'sailaja', 4564564564, 'sailu@gmail.com', 'sailu'),
(3, 'aswini', 4564564567, 'ashu@gmail.com', 'ashu'),
(4, 'vamsi', 6786786867, 'vamsiraina82@gmail.com', '123'),
(9, 'varshitha', 7671061099, 'varshitha@gmail.com', '1234'),
(11, 'vamsi73', 7671061099, 'vamsi0123@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(255) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `vancancy` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `description`, `vancancy`) VALUES
(2, 'Project Management', 'Project Management', 25),
(3, 'marketing', 'marketing', 50),
(5, 'vamsi', 'vamsi', 10),
(7, 'test', 'test', 23),
(8, 'check', 'check', 34);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`, `phone_number`) VALUES
(1, 'VAMSI', 'vamsi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '3185254.jpg', 0),
(2, 'aswini', 'ashu@gmail.com', '912ec803b2ce49e4a541068d495ab570', 'pexels-photo-338713.jpeg', 0),
(3, 'ashu', 'ashu@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'pancard.png', 0),
(4, 'devi', 'devi@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'pancard.png', 0),
(5, 'ashu', 'ashu@gmail.com', 'fd2cc6c54239c40495a0d3a93b6380eb', '', 0),
(6, 'vamsi', 'vamsiraina82@gmail.com', '202cb962ac59075b964b07152d234b70', '', 0),
(7, 'VAMSI123', 'vamsi0123@gmail.com', '123', '', 2147483647),
(8, 'Ashu', 'ashu@gmail.com', 'ashu', '', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
