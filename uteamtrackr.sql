-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 10:30 PM
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
  `Email` varchar(255) NOT NULL,
  `Admin` varchar(255) NOT NULL,
  `Org` int(255) NOT NULL
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
  `Admin` int(255) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `Verified` int(255) NOT NULL DEFAULT 0 COMMENT '0 = Unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`ID`, `Name`, `Phone`, `Email`, `Adress`, `Admin`, `Token`, `Verified`) VALUES
(12, 'Sebastian-Lucian Amariei', '+40771798737', 'amariei_sebastianl@yahoo.com', 'Str. Grigore Antipa nr.9,', 0, '2ae628d7c42045d37ec7de9b7315e156', 1);

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

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ID`, `Name`, `Dept`, `Org`, `Users`) VALUES
(1, 'Gasirea Timpului', 1, 12, ''),
(2, 'Gasirea Timpului', 1, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `ID` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Org` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`ID`, `Name`, `Org`) VALUES
(1, 'PHP', 12),
(3, 'JAVA', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(255) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `County` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Rank` varchar(255) NOT NULL,
  `Bio` text NOT NULL,
  `Img` varchar(255) NOT NULL,
  `Skills` varchar(255) NOT NULL,
  `Org` int(255) NOT NULL,
  `Dept` int(255) NOT NULL,
  `Projects` varchar(255) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `Verified` int(255) NOT NULL DEFAULT 0 COMMENT '0=Unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FName`, `LName`, `Email`, `Phone`, `Country`, `County`, `City`, `PostalCode`, `Pass`, `Rank`, `Bio`, `Img`, `Skills`, `Org`, `Dept`, `Projects`, `Token`, `Verified`) VALUES
(25, 'Sebastian-Lucian', 'Amariei', 'amariei_sebastianl@yahoo.com', '+40771798737', 'Romania', 'Suceava', 'Suceava', '720111', 'd', 'admin', 'asdasdasd', '', 'a:4:{i:0;s:1:\"3\";i:1;s:1:\"5\";i:2;s:1:\"6\";i:3;s:1:\"1\";}', 12, 0, '', '2e331506c7393b05d9417f28b477f693', 1);

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
-- AUTO_INCREMENT for table `endorsements`
--
ALTER TABLE `endorsements`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `verified_skills`
--
ALTER TABLE `verified_skills`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
