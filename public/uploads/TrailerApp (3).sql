-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2019 at 06:44 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TrailerApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `SerialNo` varchar(45) NOT NULL,
  `LastInsepctionDate` date NOT NULL,
  `YearManufactured` varchar(4) NOT NULL,
  `SiteId` varchar(45) NOT NULL,
  `TrailerBinaryId` varchar(45) NOT NULL,
  `TrailerDetailId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `organizationId` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  `organizationName` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organizationId`, `userId`, `organizationName`, `updated_at`, `created_at`) VALUES
('$2y$10$7fPsCVHS4L7kOMvyK9q5cO.f8yMv34O6vhsRNo3Pjvh9FYiiOxIi', 1, 'mobilr_first123', '2018-12-27 07:03:53', '2018-12-27 07:03:53'),
('$2y$10$iLMQihTIlgjBOkbj2uU77btg5fHKBu.vWZ1W8h74u4PEMMytu', 1, 'BenchMatch', '2018-12-24 07:05:04', '2018-12-24 07:05:04'),
('$2y$10$OEf8yeOZ3tVsKBN6NXthOQLWuKRmweaI3MrgswBUn9WHMKPSsulm', 1, 'MobileFirst Applications', '2018-12-27 23:10:47', '2018-12-27 23:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `org_invitation`
--

CREATE TABLE `org_invitation` (
  `invitationId` int(11) NOT NULL,
  `orgId` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_invitation`
--

INSERT INTO `org_invitation` (`invitationId`, `orgId`, `Email`, `created_at`, `updated_at`, `status`) VALUES
(9, '$2y$10$iLMQihTIlgjBOkbj2uU77btg5fHKBu.vWZ1W8h74u4PEMMytu', 'abc@gmail.como', '2018-12-24 12:36:49', '2018-12-24 07:06:49', 1),
(18, '$2y$10$My6aVQx3S95uF4bT4SsLulFyquCrymHp9BfDm4Kinhd8iTbBnfFC', 'ashish.mobilefirst@gmail.com', '2018-12-24 07:33:29', '2018-12-24 07:33:29', 0),
(19, '$2y$10$iLMQihTIlgjBOkbj2uU77btg5fHKBu.vWZ1W8h74u4PEMMytu', 'ashish.mobilefirst@gmail.com', '2018-12-26 12:58:24', '2018-12-26 07:28:24', 1),
(20, '$2y$10$1YvDuuOgdn4EH5HCdS7njunH02x4fLF21dg1lCMT8Iky9Gwo1rkWO', 'ashish.mobilefirst@gmail.com', '2018-12-26 13:01:11', '2018-12-26 07:31:11', 1),
(21, '$2y$10$TclIJgraUb0cEx3DyG0m7OADomOsB3Lm4GJMZb5q3LaDyo.UtyxI2', 'ashish.mobilefirst@gmail.com', '2018-12-26 13:35:44', '2018-12-26 08:05:44', 1),
(22, '$2y$10$YRy5Ys2z7opPhNbXTCLCOYmLk7Qgp4rQsmUlhBM6XAKbyI12kp6', 'ashish.mobilefirst@gmail.com', '2018-12-27 06:01:28', '2018-12-27 06:01:28', 0),
(23, '$2y$10$YRy5Ys2z7opPhNbXTCLCOYmLk7Qgp4rQsmUlhBM6XAKbyI12kp6', 'abc@gmail.como', '2018-12-27 06:01:43', '2018-12-27 06:01:43', 0),
(24, '$2y$10$TlHwbyo5JAZPrl9uJC.Iv.FfmXSQ55x4YObFjfj0sDQJspg1KpJc.', 'test@gmail.com', '2018-12-27 12:08:02', '2018-12-27 06:38:02', 1),
(25, '$2y$10$7fPsCVHS4L7kOMvyK9q5cO.f8yMv34O6vhsRNo3Pjvh9FYiiOxIi', 'demo123@gmail.com', '2018-12-27 12:35:04', '2018-12-27 07:05:04', 1),
(26, '$2y$10$7fPsCVHS4L7kOMvyK9q5cO.f8yMv34O6vhsRNo3Pjvh9FYiiOxIi', 'ashish.mobilefirst@gmail.com', '2018-12-28 04:41:45', '2018-12-27 23:11:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `roleId` int(11) NOT NULL,
  `Role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`roleId`, `Role_name`) VALUES
(1, 'Super_admin'),
(2, 'Admin'),
(3, 'TM');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `SiteId` varchar(150) NOT NULL,
  `SiteName` varchar(55) NOT NULL,
  `SteetNo` varchar(45) NOT NULL,
  `StreetName` varchar(65) NOT NULL,
  `SuiteNo` varchar(45) NOT NULL,
  `City` varchar(55) NOT NULL,
  `State` varchar(50) NOT NULL,
  `PostalCode` varchar(9) NOT NULL,
  `OrganizationId` varchar(45) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`SiteId`, `SiteName`, `SteetNo`, `StreetName`, `SuiteNo`, `City`, `State`, `PostalCode`, `OrganizationId`, `updated_at`, `created_at`) VALUES
('$2y$10$57tMWtYrWeFSfLl5Z87Q7.qhTE9mlXyQXt6s4FMBj4h5liquYDEa.', 'demo', '25', 'demo', 'demo', 'demo', 'demo', '251010', '8', '2018-12-27 06:38:31', '2018-12-27 06:38:31'),
('$2y$10$YRy5Ys2z7opPhNbXTCLCOYmLk7Qgp4rQsmUlhBM6XAKbyI12kp6', 'Benchmatch', '25', 'CG Road', 'Saleforce', 'Ahmedabad', 'Gujarat', '380015', '2', '2018-12-28 04:30:18', '2018-12-27 05:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `site_invitation`
--

CREATE TABLE `site_invitation` (
  `invitationId` int(11) NOT NULL,
  `SiteId` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_invitation`
--

INSERT INTO `site_invitation` (`invitationId`, `SiteId`, `Email`, `created_at`, `updated_at`, `status`) VALUES
(1, '$2y$10$YRy5Ys2z7opPhNbXTCLCOYmLk7Qgp4rQsmUlhBM6XAKbyI12kp6', 'arpan@mobilefirst.in', '2018-12-27 12:06:49', '2018-12-27 06:36:49', 1),
(2, '$2y$10$57tMWtYrWeFSfLl5Z87Q7.qhTE9mlXyQXt6s4FMBj4h5liquYDEa.', 'demo@gmail.com', '2018-12-27 12:08:52', '2018-12-27 06:38:52', 1),
(3, '$2y$10$iN4Z6JPGKglevGwJTJMWb.YnTqVsEQV1UA09Xr3BqEejvHHw5nFaG', 'test123@gmail.com', '2018-12-27 12:10:22', '2018-12-27 06:40:22', 1),
(4, '$2y$10$YRy5Ys2z7opPhNbXTCLCOYmLk7Qgp4rQsmUlhBM6XAKbyI12kp6', 'test2@gmail.com', '2018-12-28 04:43:17', '2018-12-27 23:13:17', 1),
(5, '$2y$10$YRy5Ys2z7opPhNbXTCLCOYmLk7Qgp4rQsmUlhBM6XAKbyI12kp6', 'test123@gmail.com', '2018-12-31 03:41:00', '2018-12-31 03:41:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `TRAILER_CATEGORY`
--

CREATE TABLE `TRAILER_CATEGORY` (
  `TrailerCategoryId` int(11) NOT NULL,
  `TrailerTypeCategoryName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TRAILER_CATEGORY`
--

INSERT INTO `TRAILER_CATEGORY` (`TrailerCategoryId`, `TrailerTypeCategoryName`) VALUES
(1, 'Trailer'),
(2, 'Tractor');

-- --------------------------------------------------------

--
-- Table structure for table `trailer_details`
--

CREATE TABLE `trailer_details` (
  `TrailerDetailId` varchar(45) NOT NULL,
  `ManufacturerId` varchar(45) DEFAULT NULL,
  `TrailerTypeId` varchar(45) NOT NULL,
  `ConditionStatusId` varchar(45) NOT NULL,
  `SuspensionId` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_detail_binary`
--

CREATE TABLE `trailer_detail_binary` (
  `TrailerBinaryId` varchar(45) NOT NULL,
  `PlateVan` int(11) DEFAULT NULL,
  `LogPosts` int(11) DEFAULT NULL,
  `XPosts` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Role_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userId`, `name`, `email`, `password`, `Role_id`, `updated_at`, `created_at`) VALUES
(1, 'abc', 'abc@gmail.com', '$2y$10$VAiVCNPr9rbR6MWD4nKfqe/kTvDzgjZsJRSDsTumrLzIbMQEq2wlO', 1, '2018-12-27 06:11:25', '2018-12-22 05:55:20'),
(2, 'mak', 'mak@gmail.com', '$2y$10$9l2646nKjLw.TQ2m2UQ7POKArXjz4/QRCSaTCVkZtn7jCiFk1XEtW', 2, '2018-12-27 06:11:29', '2018-12-22 06:02:01'),
(3, 'demo', 'demo@gmail.com', '$2y$10$rECWBawd2K8fZjUgCA9KXumBBjclCGkwKt8DAywPYViLSwrUmmUJO', 2, '2018-12-27 06:11:32', '2018-12-23 22:50:51'),
(6, 'ashish', 'ashish.mobilefirst@gmail.com', '$2y$10$l420coIZLz7Ke4u/BUmgOehLRJ9ZSCmgCgRhRo4yCXkO4.O8.gmre', 3, '2018-12-27 06:11:35', '2018-12-26 08:05:44'),
(7, 'arpan', 'arpan@mobilefirst.in', '$2y$10$bqQpsPRf1YLEMFGm3.9RMeFyDSIKtzEiKCOc6DZVxhtUN9iDVUJ2q', 3, '2018-12-27 06:36:49', '2018-12-27 06:36:49'),
(8, 'test1', 'test@gmail.com', '$2y$10$Cw/acn3ys.ltGBaHMvxiiu48zOMlDFptrHaRjBX97PQMJvc8ILSzC', 2, '2018-12-27 06:38:02', '2018-12-27 06:38:02'),
(9, 'demo', 'demo@gmail.com', '$2y$10$V1qb0pdbtqFM/JPVsabtc.o9O5hi5uyGLGN4fKTfcL5J6i8.ZeJr2', 3, '2018-12-27 06:38:52', '2018-12-27 06:38:52'),
(10, 'test123', 'test123@gmail.com', '$2y$10$e5pUHsdtDvJpQ0vSCxcL4.TLPy0Y3GMAAkYrmsXUUdEO0CRBm/6he', 3, '2018-12-27 06:40:22', '2018-12-27 06:40:22'),
(11, 'demo123', 'demo123@gmail.com', '$2y$10$z/6AngnzErqf5uW8AFnpKe940j7REGjYKDrZnvpkmREsTwa31p.Ke', 2, '2018-12-27 07:05:04', '2018-12-27 07:05:04'),
(12, 'ashish', 'ashish.mobilefirst@gmail.com', '$2y$10$8PRPGVBdnyQZJAmjvFImiuo/drfqfQl./s7.0zhBOYJVzjxyucp5S', 2, '2018-12-27 23:11:45', '2018-12-27 23:11:45'),
(13, 'test2', 'test2@gmail.com', '$2y$10$XurSPy7RbfJeBNzBmWih/upFDdfMmj/dIAB.9sdhZEsPQlYOT8Nnu', 3, '2018-12-27 23:13:17', '2018-12-27 23:13:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`SerialNo`),
  ADD KEY `SiteId` (`SiteId`),
  ADD KEY `TrailerBinaryId` (`TrailerBinaryId`),
  ADD KEY `TrailerDetailId` (`TrailerDetailId`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`organizationId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `org_invitation`
--
ALTER TABLE `org_invitation`
  ADD PRIMARY KEY (`invitationId`),
  ADD KEY `orgId` (`orgId`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`SiteId`),
  ADD KEY `OrganizationId` (`OrganizationId`);

--
-- Indexes for table `site_invitation`
--
ALTER TABLE `site_invitation`
  ADD PRIMARY KEY (`invitationId`),
  ADD KEY `orgId` (`SiteId`);

--
-- Indexes for table `TRAILER_CATEGORY`
--
ALTER TABLE `TRAILER_CATEGORY`
  ADD PRIMARY KEY (`TrailerCategoryId`);

--
-- Indexes for table `trailer_details`
--
ALTER TABLE `trailer_details`
  ADD PRIMARY KEY (`TrailerDetailId`),
  ADD KEY `ManufacturerId` (`ManufacturerId`),
  ADD KEY `TrailerTypeId` (`TrailerTypeId`),
  ADD KEY `ConditionStatusId` (`ConditionStatusId`),
  ADD KEY `SuspensionId` (`SuspensionId`);

--
-- Indexes for table `trailer_detail_binary`
--
ALTER TABLE `trailer_detail_binary`
  ADD PRIMARY KEY (`TrailerBinaryId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `org_invitation`
--
ALTER TABLE `org_invitation`
  MODIFY `invitationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_invitation`
--
ALTER TABLE `site_invitation`
  MODIFY `invitationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `TRAILER_CATEGORY`
--
ALTER TABLE `TRAILER_CATEGORY`
  MODIFY `TrailerCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`SiteId`) REFERENCES `SITE` (`SiteId`),
  ADD CONSTRAINT `equipment_ibfk_2` FOREIGN KEY (`TrailerBinaryId`) REFERENCES `TRAILER_DETAIL_BINARY` (`TrailerBinaryId`),
  ADD CONSTRAINT `equipment_ibfk_3` FOREIGN KEY (`TrailerDetailId`) REFERENCES `TRAILER_DETAIL` (`TrailerDetailId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
