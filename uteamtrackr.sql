-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 11:27 AM
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
-- Database: `uteamtrackr`
--

-- --------------------------------------------------------

--
-- Table structure for table `departaments`
--

CREATE TABLE `departaments` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Admin` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Org` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departament_ranks`
--

CREATE TABLE `departament_ranks` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Dept` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departament_ranks_users`
--

CREATE TABLE `departament_ranks_users` (
  `ID` int(255) NOT NULL,
  `Recipient` int(255) NOT NULL,
  `Rank` int(255) NOT NULL,
  `Dept` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `endorsements`
--

CREATE TABLE `endorsements` (
  `ID` int(255) NOT NULL,
  `Skill` int(255) NOT NULL,
  `Sender` int(255) NOT NULL,
  `Recipient` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Adress` varchar(255) NOT NULL,
  `Admin` int(255) NOT NULL DEFAULT 0,
  `Token` varchar(255) NOT NULL,
  `Verified` int(255) NOT NULL DEFAULT 0 COMMENT '0 = Unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Dept` int(255) NOT NULL,
  `Org` int(255) NOT NULL,
  `Users` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Org` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(255) NOT NULL,
  `FName` varchar(255) NOT NULL DEFAULT '',
  `LName` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL DEFAULT '',
  `Country` varchar(255) DEFAULT '',
  `County` varchar(255) DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `PostalCode` varchar(255) NOT NULL DEFAULT '',
  `Pass` varchar(255) NOT NULL DEFAULT '',
  `Rank` varchar(255) NOT NULL DEFAULT 'a:1:{i:0;s:4:"user";}',
  `Bio` text NOT NULL DEFAULT '',
  `Img` varchar(255) NOT NULL DEFAULT '',
  `Skills` varchar(255) NOT NULL DEFAULT 'a:0:{}',
  `Org` int(255) NOT NULL DEFAULT 0,
  `Dept` varchar(255) NOT NULL DEFAULT 'a:0:{}',
  `Projects` varchar(255) NOT NULL DEFAULT '',
  `Token` varchar(255) NOT NULL DEFAULT '',
  `Verified` int(255) NOT NULL DEFAULT 0 COMMENT '0=Unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verified_skills`
--

CREATE TABLE `verified_skills` (
  `ID` int(255) NOT NULL,
  `Skill` int(255) NOT NULL,
  `Recipient` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departaments`
--
ALTER TABLE `departaments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `departament_ranks`
--
ALTER TABLE `departament_ranks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `departament_ranks_users`
--
ALTER TABLE `departament_ranks_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `endorsements`
--
ALTER TABLE `endorsements`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `verified_skills`
--
ALTER TABLE `verified_skills`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departaments`
--
ALTER TABLE `departaments`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departament_ranks`
--
ALTER TABLE `departament_ranks`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departament_ranks_users`
--
ALTER TABLE `departament_ranks_users`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `endorsements`
--
ALTER TABLE `endorsements`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verified_skills`
--
ALTER TABLE `verified_skills`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
