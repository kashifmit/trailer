-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2019 at 11:42 AM
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
-- Database: `Trailer`
--

-- --------------------------------------------------------

--
-- Table structure for table `axle`
--

CREATE TABLE `axle` (
  `AxleId` int(11) NOT NULL,
  `AxleName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `axle`
--

INSERT INTO `axle` (`AxleId`, `AxleName`) VALUES
(1, 'T (TWIN)'),
(2, 'S (SINGLE)'),
(3, 'UKNOWN');

-- --------------------------------------------------------

--
-- Table structure for table `condition_status`
--

CREATE TABLE `condition_status` (
  `ConditionStatusId` int(11) NOT NULL,
  `ConditionType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `condition_status`
--

INSERT INTO `condition_status` (`ConditionStatusId`, `ConditionType`) VALUES
(1, 'Road Worthy'),
(2, 'Not Road Worthy');

-- --------------------------------------------------------

--
-- Table structure for table `conducts_service`
--

CREATE TABLE `conducts_service` (
  `VendorId` int(11) NOT NULL,
  `InvoiceNo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` varchar(45) NOT NULL,
  `CustomerName` varchar(90) NOT NULL,
  `StreetNo` varchar(45) NOT NULL,
  `StreetName` varchar(45) NOT NULL,
  `SuiteNo` varchar(30) NOT NULL,
  `City` varchar(90) NOT NULL,
  `PostalCode` varchar(15) NOT NULL,
  `StateAbbreviation` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drop_trailer_cost_tbl`
--

CREATE TABLE `drop_trailer_cost_tbl` (
  `CostPerHour` float NOT NULL,
  `CustomerNo` varchar(45) NOT NULL,
  `DTAId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dta`
--

CREATE TABLE `dta` (
  `DTAId` varchar(45) NOT NULL,
  `NumberOfTrailers` int(11) NOT NULL,
  `FreeDays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `TrailerSerialNo` varchar(45) NOT NULL,
  `LastInsepctionDate` date NOT NULL,
  `TrailerBinaryId` int(11) DEFAULT NULL,
  `TrailerDetailId` int(11) DEFAULT NULL,
  `SiteId` int(11) NOT NULL,
  `ModelYear` varchar(4) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `Id` varchar(45) NOT NULL,
  `FileName` varchar(90) NOT NULL,
  `mimetype` varchar(45) NOT NULL,
  `DataFileStuff` mediumblob NOT NULL,
  `VehicleId` varchar(45) DEFAULT NULL,
  `InvoiceNo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `InvoiceNo` varchar(45) NOT NULL,
  `Qty` int(11) NOT NULL,
  `ServiceDecription` varchar(90) NOT NULL,
  `ChargeAmt` float NOT NULL,
  `TrailerSerialNo` varchar(45) DEFAULT NULL,
  `TractorSerialNo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`InvoiceNo`, `Qty`, `ServiceDecription`, `ChargeAmt`, `TrailerSerialNo`, `TractorSerialNo`) VALUES
('1', 2, 'Maintenance', 50, '685c38797807e5d', NULL),
('2', 5, 'Service Provide', 100, NULL, '255c387e4a1ee78'),
('3', 2, 'Maintenance', 50, '675c38790f83509', NULL),
('4', 2, 'Maintenance', 50, '665c3878e76ea14', NULL),
('5', 5, 'Service Provide', 100, NULL, '265c387f681a994'),
('6', 5, 'Service Provide', 100, NULL, '415c3ecd0861f7e'),
('7', 5, 'Service Provide', 100, NULL, '405c3883c0ead0e');

-- --------------------------------------------------------

--
-- Table structure for table `model_year`
--

CREATE TABLE `model_year` (
  `ModelYear` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model_year`
--

INSERT INTO `model_year` (`ModelYear`) VALUES
('1900'),
('1901'),
('1902'),
('1903'),
('1904'),
('1905'),
('1906'),
('1907'),
('1908'),
('1909'),
('1910'),
('1911'),
('1912'),
('1913'),
('1914'),
('1915'),
('1916'),
('1917'),
('1918'),
('1919'),
('1920'),
('1921'),
('1922'),
('1923'),
('1924'),
('1925'),
('1926'),
('1927'),
('1928'),
('1929'),
('1930'),
('1931'),
('1932'),
('1933'),
('1934'),
('1935'),
('1936'),
('1937'),
('1938'),
('1939'),
('1940'),
('1941'),
('1942'),
('1943'),
('1944'),
('1945'),
('1946'),
('1947'),
('1948'),
('1949'),
('1950'),
('1951'),
('1952'),
('1953'),
('1954'),
('1955'),
('1956'),
('1957'),
('1958'),
('1959'),
('1960'),
('1961'),
('1962'),
('1963'),
('1964'),
('1965'),
('1966'),
('1967'),
('1968'),
('1969'),
('1970'),
('1971'),
('1972'),
('1973'),
('1974'),
('1975'),
('1976'),
('1977'),
('1978'),
('1979'),
('1980'),
('1981'),
('1982'),
('1983'),
('1984'),
('1985'),
('1986'),
('1987'),
('1988'),
('1989'),
('1990'),
('1991'),
('1992'),
('1993'),
('1994'),
('1995'),
('1996'),
('1997'),
('1998'),
('1999'),
('2000'),
('2001'),
('2002'),
('2003'),
('2004'),
('2005'),
('2006'),
('2007'),
('2008'),
('2009'),
('2010'),
('2011'),
('2012'),
('2013'),
('2014'),
('2015'),
('2016'),
('2017'),
('2018'),
('2019');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `organizationId` varchar(200) NOT NULL,
  `organizationName` varchar(85) NOT NULL,
  `userId` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`organizationId`, `organizationName`, `userId`, `updated_at`, `created_at`) VALUES
('$2y$10$0HcTfWt0BPPHJjjzGyZ8uptKPjjTM0.JMlIWJxF4SD4ZTd4umqY6', 'demoapp', 1, '2019-01-24 23:09:22', '2019-01-24 23:09:22'),
('$2y$10$80XhZLYyQH8piWQmBIQlFu6u4QnAlbTzZluxEG6jNd1JPXSas39Ly', 'Trailerapp2', 1, '2019-01-25 09:52:10', '2019-01-23 07:14:17'),
('$2y$10$acZhACFk535kfBWt9DVOOkHRqtPeB55b29s2GRmP9bAub7AgECcG', 'test_app', 1, '2019-01-25 00:29:59', '2019-01-25 00:29:59'),
('$2y$10$k.RkPDKyuQsL5XiwpPddBuDOQUwGRLT5WTKzMXKmgpmAbEjx.t4w6', 'MobileFirst', 1, '2019-01-23 07:14:38', '2019-01-23 07:14:38'),
('$2y$10$p5tsUxvyW6E09YhxUtf5.09J17zLxwZbvGGnaCFY8f5Jk6McqmW', 'Parul', 1, '2019-01-25 04:24:03', '2019-01-25 04:24:03'),
('$2y$10$PIwpNRhBsjeIdBosAeSPuUDwswHotB9Fgwk.mQkuQVwjdX1Qjm', 'MAKE IN INDIA', 1, '2019-01-25 01:24:51', '2019-01-25 01:24:51'),
('$2y$10$qKOGKmnkBdEW4Wsts1VFxeCpAYgOOBXkLcEuVZVZSb.HOSSlOOfja', 'TRAILERAPP_DEMO', 1, '2019-01-25 01:02:11', '2019-01-25 01:02:11'),
('$2y$10$V0ooZzH7luMn9paQfpNGbOV1dOxWkiwPKfcRSyi36oa3l1xW6bNW', 'Test_Demo', 1, '2019-01-25 03:15:36', '2019-01-25 03:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `org_invitation`
--

CREATE TABLE `org_invitation` (
  `invitationId` int(200) NOT NULL,
  `orgId` varchar(200) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `VehicleId` varchar(45) NOT NULL,
  `Make` varchar(45) NOT NULL,
  `PlateNo` varchar(15) NOT NULL,
  `Class` varchar(45) NOT NULL,
  `ExpireDate` date NOT NULL,
  `TitleNo` varchar(45) NOT NULL,
  `RegistrationDate` date NOT NULL,
  `StateAbbreviation` varchar(4) NOT NULL,
  `TrailerSerialNo` varchar(45) DEFAULT NULL,
  `Document` varchar(200) NOT NULL,
  `TractorSerialNo` varchar(45) DEFAULT NULL,
  `ModelYear` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `registration1`
--

CREATE TABLE `registration1` (
  `VehicleId` int(11) NOT NULL,
  `Make` varchar(45) NOT NULL,
  `PlateNo` varchar(15) NOT NULL,
  `Class` varchar(45) NOT NULL,
  `ExpireDate` date NOT NULL,
  `TitleNo` varchar(45) NOT NULL,
  `RegistrationDate` date NOT NULL,
  `StateAbbreviation` varchar(4) NOT NULL,
  `Document` varchar(200) NOT NULL,
  `ModelYear` varchar(4) NOT NULL,
  `TrailerSerialNo` varchar(45) DEFAULT NULL,
  `TractorSerialNo` varchar(45) DEFAULT NULL,
  `Own_info` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `registration_regfee`
--
-- Error reading structure for table Trailer.registration_regfee: #1932 - Table 'trailer.registration_regfee' doesn't exist in engine
-- Error reading data for table Trailer.registration_regfee: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `Trailer`.`registration_regfee`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `reg_renewal`
--

CREATE TABLE `reg_renewal` (
  `DocumentId` int(11) NOT NULL,
  `RenewalFee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reg_renewal_other_fees`
--

CREATE TABLE `reg_renewal_other_fees` (
  `OtherFee` float NOT NULL,
  `DocumentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `RentalTransId` varchar(45) NOT NULL,
  `VendorId` int(11) DEFAULT NULL,
  `SiteId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rental_term`
--

CREATE TABLE `rental_term` (
  `RentalTermId` varchar(45) NOT NULL,
  `RentalTerm` varchar(45) NOT NULL,
  `Length` int(11) NOT NULL,
  `ConversionToStandard` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rentedvia`
--

CREATE TABLE `rentedvia` (
  `TrailerSerialNo` varchar(45) NOT NULL,
  `RentalTransId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'SuperAdmin'),
(2, 'OrganizationAdmin'),
(3, 'TrailerManager');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `SalesTransId` varchar(45) NOT NULL,
  `Price` float NOT NULL,
  `Date` date NOT NULL,
  `TrailerSerialNo` varchar(45) NOT NULL,
  `SiteId` int(11) NOT NULL,
  `VendorId` int(11) NOT NULL,
  `TractorSerialNo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `SiteId` int(11) NOT NULL,
  `site_unique_id` varchar(150) NOT NULL,
  `SiteName` varchar(85) NOT NULL,
  `SteetNo` varchar(45) NOT NULL,
  `StreetName` varchar(85) NOT NULL,
  `SuiteNo` varchar(45) NOT NULL,
  `City` varchar(85) NOT NULL,
  `PostalCode` varchar(15) NOT NULL,
  `StateAbbreviation` varchar(4) NOT NULL,
  `OrganizationId` varchar(200) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `hide` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `site_services_cust_tbl`
--

CREATE TABLE `site_services_cust_tbl` (
  `SiteId` int(11) NOT NULL,
  `CustomerNo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `StateAbbreviation` varchar(4) NOT NULL,
  `StateName` varchar(45) NOT NULL,
  `Country` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateAbbreviation`, `StateName`, `Country`) VALUES
('AB', 'Alberta', 'Canada'),
('AK', 'Alaska', 'United States of America'),
('AL', 'Alabama', 'United States of America'),
('AR', 'Arkansas', 'United States of America'),
('AZ', 'Arizona', 'United States of America'),
('BC', 'British Columbia', 'Canada'),
('CA', 'California', 'United States of America'),
('CO', 'Colorado', 'United States of America'),
('CT', 'Connecticut', 'United States of America'),
('DE', 'Delaware', 'United States of America'),
('FL', 'Florida', 'United States of America'),
('GA', 'Georgia', 'United States of America'),
('GU', 'Guam', 'Guam'),
('HI', 'Hawaii', 'United States of America'),
('IA', 'Iowa', 'United States of America'),
('ID', 'Idaho', 'United States of America'),
('IL', 'Illinois', 'United States of America'),
('IN', 'Indiana', 'United States of America'),
('KS', 'Kansas', 'United States of America'),
('KY', 'Kentucky', 'United States of America'),
('LA', 'Louisiana', 'United States of America'),
('MA', 'Massachusetts', 'United States of America'),
('MB', 'Manitoba', 'Canada'),
('MD', 'Maryland', 'United States of America'),
('ME', 'Maine', 'United States of America'),
('MI', 'Michigan', 'United States of America'),
('MN', 'Minnesota', 'United States of America'),
('MO', 'Missouri', 'United States of America'),
('MS', 'Mississippi', 'United States of America'),
('MT', 'Montana', 'United States of America'),
('NB', 'New Brunswick', 'Canada'),
('NC', 'North Carolina', 'United States of America'),
('ND', 'North Dakota', 'United States of America'),
('NE', 'Nebraska', 'United States of America'),
('NH', 'New Hampshire', 'United States of America'),
('NJ', 'New Jersey', 'United States of America'),
('NL', 'Newfoundland and Labrador', 'Canada'),
('NM', 'New Mexico', 'United States of America'),
('NS', 'Nova Scotia', 'Canada'),
('NT', 'Northwest Territories', 'Canada'),
('NU', 'Nunavut', 'Canada'),
('NV', 'Nevada', 'United States of America'),
('NY', 'New York', 'United States of America'),
('OH', 'Ohio', 'United States of America'),
('OK', 'Oklahoma', 'United States of America'),
('ON', 'Ontario', 'Canada'),
('OR', 'Oregon', 'United States of America'),
('PA', 'Pennsylvania', 'United States of America'),
('PE', 'Prince Edward Island', 'Canada'),
('PR', 'Puerto Rico', 'Puerto Rico'),
('QC', 'Quebec', 'Canada'),
('RI', 'Rhode Island', 'United States of America'),
('SC', 'South Carolina', 'United States of America'),
('SD', 'South Dakota', 'United States of America'),
('SK', 'Saskatchewan', 'Canada'),
('TN', 'Tennessee', 'United States of America'),
('TX', 'Texas', 'United States of America'),
('UT', 'Utah', 'United States of America'),
('VA', 'Virginia', 'United States of America'),
('VI', 'Virgin Islands', 'Virgin Islands'),
('VT', 'Vermont', 'United States of America'),
('WA', 'Washington', 'United States of America'),
('WI', 'Wisconsin', 'United States of America'),
('WV', 'West Virginia', 'United States of America'),
('WY', 'Wyoming', 'United States of America'),
('YT', 'Yukon', 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `suspension`
--

CREATE TABLE `suspension` (
  `SuspensionId` int(11) NOT NULL,
  `SuspensionName` varchar(45) NOT NULL,
  `SuspensionDescription` varchar(95) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suspension`
--

INSERT INTO `suspension` (`SuspensionId`, `SuspensionName`, `SuspensionDescription`) VALUES
(1, 'Spring Ride', 'Spring Ride'),
(2, 'Air Ride', 'Air Ride'),
(3, 'Spread Axle', 'Spread Axle');

-- --------------------------------------------------------

--
-- Table structure for table `tire`
--

CREATE TABLE `tire` (
  `TireId` int(11) NOT NULL,
  `TireSize` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tractor`
--

CREATE TABLE `tractor` (
  `TractorSerialNo` varchar(45) NOT NULL,
  `LastInspectionDate` varchar(200) NOT NULL,
  `SiteId` int(11) DEFAULT NULL,
  `ModelYear` varchar(4) DEFAULT NULL,
  `TractordetailId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `TractorDetails`
--

CREATE TABLE `TractorDetails` (
  `TractorDetailId` int(11) NOT NULL,
  `TractorTypeId` int(11) NOT NULL,
  `ManuFacturerID` int(11) NOT NULL,
  `ConditionStatusId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TractorDetails`
--

INSERT INTO `TractorDetails` (`TractorDetailId`, `TractorTypeId`, `ManuFacturerID`, `ConditionStatusId`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2019-01-07 05:13:57', '2019-01-07 05:13:57'),
(2, 2, 1, 2, '2019-01-07 05:14:11', '2019-01-07 05:14:11'),
(3, 4, 1, 2, '2019-01-07 06:18:43', '2019-01-07 06:18:43'),
(4, 3, 1, 2, '2019-01-07 07:09:10', '2019-01-07 07:09:10'),
(5, 1, 1, 1, '2019-01-09 03:33:57', '2019-01-09 03:33:57'),
(6, 1, 1, 1, '2019-01-09 03:34:32', '2019-01-09 03:34:32'),
(7, 1, 1, 1, '2019-01-09 03:35:30', '2019-01-09 03:35:30'),
(8, 1, 1, 1, '2019-01-09 03:36:08', '2019-01-09 03:36:08'),
(9, 1, 1, 1, '2019-01-11 05:45:33', '2019-01-11 05:45:33'),
(10, 1, 1, 1, '2019-01-11 05:45:52', '2019-01-11 05:45:52'),
(11, 1, 1, 1, '2019-01-11 05:51:20', '2019-01-11 05:51:20'),
(12, 1, 1, 1, '2019-01-11 05:51:59', '2019-01-11 05:51:59'),
(13, 1, 1, 1, '2019-01-11 05:52:52', '2019-01-11 05:52:52'),
(14, 1, 1, 1, '2019-01-11 05:53:39', '2019-01-11 05:53:39'),
(15, 1, 1, 1, '2019-01-11 05:54:11', '2019-01-11 05:54:11'),
(16, 1, 1, 1, '2019-01-11 05:54:22', '2019-01-11 05:54:22'),
(17, 1, 1, 1, '2019-01-11 05:56:02', '2019-01-11 05:56:02'),
(18, 1, 1, 1, '2019-01-11 05:56:34', '2019-01-11 05:56:34'),
(19, 1, 1, 1, '2019-01-11 05:56:45', '2019-01-11 05:56:45'),
(20, 1, 1, 1, '2019-01-11 05:56:59', '2019-01-11 05:56:59'),
(21, 1, 1, 1, '2019-01-11 05:57:13', '2019-01-11 05:57:13'),
(22, 1, 1, 1, '2019-01-11 05:58:12', '2019-01-11 05:58:12'),
(23, 1, 1, 1, '2019-01-11 05:58:32', '2019-01-11 05:58:32'),
(24, 1, 1, 1, '2019-01-11 05:58:35', '2019-01-11 05:58:35'),
(25, 1, 1, 1, '2019-01-11 06:00:18', '2019-01-11 06:00:18'),
(26, 1, 1, 1, '2019-01-11 06:05:04', '2019-01-11 06:05:04'),
(27, 1, 1, 1, '2019-01-11 06:18:13', '2019-01-11 06:18:13'),
(28, 1, 1, 1, '2019-01-11 06:19:01', '2019-01-11 06:19:01'),
(29, 1, 1, 1, '2019-01-11 06:19:29', '2019-01-11 06:19:29'),
(30, 1, 1, 1, '2019-01-11 06:19:37', '2019-01-11 06:19:37'),
(31, 1, 1, 1, '2019-01-11 06:19:40', '2019-01-11 06:19:40'),
(32, 1, 1, 1, '2019-01-11 06:20:31', '2019-01-11 06:20:31'),
(33, 1, 1, 1, '2019-01-11 06:20:45', '2019-01-11 06:20:45'),
(34, 1, 1, 1, '2019-01-11 06:20:47', '2019-01-11 06:20:47'),
(35, 1, 1, 1, '2019-01-11 06:21:27', '2019-01-11 06:21:27'),
(36, 1, 1, 1, '2019-01-11 06:21:29', '2019-01-11 06:21:29'),
(37, 1, 1, 1, '2019-01-11 06:21:45', '2019-01-11 06:21:45'),
(38, 1, 1, 1, '2019-01-11 06:22:10', '2019-01-11 06:22:10'),
(39, 1, 1, 1, '2019-01-11 06:23:08', '2019-01-11 06:23:08'),
(40, 1, 1, 1, '2019-01-11 06:23:36', '2019-01-11 06:23:36'),
(41, 1, 1, 1, '2019-01-16 00:49:52', '2019-01-16 00:49:52'),
(42, 1, 1, 1, '2019-01-17 03:11:53', '2019-01-17 03:11:53'),
(43, 3, 1, 2, '2019-01-17 05:42:56', '2019-01-17 05:42:56'),
(44, 4, 1, 2, '2019-01-17 08:34:46', '2019-01-17 08:34:46'),
(45, 2, 1, 1, '2019-01-17 23:05:24', '2019-01-17 23:05:24'),
(46, 3, 1, 1, '2019-01-18 09:48:02', '2019-01-17 23:05:41'),
(47, 1, 1, 1, '2019-01-21 06:05:27', '2019-01-21 06:05:27'),
(48, 1, 1, 1, '2019-01-21 06:05:52', '2019-01-21 06:05:52'),
(49, 1, 1, 1, '2019-01-21 06:06:17', '2019-01-21 06:06:17'),
(50, 1, 1, 1, '2019-01-25 02:28:13', '2019-01-25 02:28:13'),
(51, 3, 1, 1, '2019-01-25 02:48:44', '2019-01-25 02:48:44'),
(52, 1, 1, 1, '2019-01-25 02:49:44', '2019-01-25 02:49:44'),
(53, 4, 1, 1, '2019-01-25 02:50:08', '2019-01-25 02:50:08'),
(54, 1, 1, 1, '2019-01-25 04:00:04', '2019-01-25 04:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `tractor_detail`
--

CREATE TABLE `tractor_detail` (
  `TractorDetail_Id` int(11) NOT NULL,
  `SerialNo` varchar(45) NOT NULL,
  `ManuFacturerID` int(11) DEFAULT NULL,
  `TractorTypeId` int(11) DEFAULT NULL,
  `ConditionStatusId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tractor_manu`
--

CREATE TABLE `tractor_manu` (
  `ManuFacturerID` int(11) NOT NULL,
  `ManuName` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tractor_manu`
--

INSERT INTO `tractor_manu` (`ManuFacturerID`, `ManuName`) VALUES
(1, 'Mahindra');

-- --------------------------------------------------------

--
-- Table structure for table `tractor_rented_via`
--

CREATE TABLE `tractor_rented_via` (
  `Price` float NOT NULL,
  `RentalStartDate` date NOT NULL,
  `RentalTerm` varchar(45) NOT NULL,
  `RentalTransId` varchar(45) NOT NULL,
  `TractorSerialNo` varchar(45) NOT NULL,
  `RentalTermId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tractor_type`
--

CREATE TABLE `tractor_type` (
  `TractorTypeId` int(11) NOT NULL,
  `TractorTypeName` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tractor_type`
--

INSERT INTO `tractor_type` (`TractorTypeId`, `TractorTypeName`) VALUES
(1, 'Lawn'),
(2, 'Garden'),
(3, 'Subcompact'),
(4, ' Compact Utility');

-- --------------------------------------------------------

--
-- Table structure for table `trailertracking`
--

CREATE TABLE `trailertracking` (
  `TrackingId` varchar(45) NOT NULL,
  `TrailerSerialNo` varchar(45) DEFAULT NULL,
  `TractorSerialNo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_category`
--

CREATE TABLE `trailer_category` (
  `TrailerCategoryId` int(11) NOT NULL,
  `TrailerTypeCategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trailer_category`
--

INSERT INTO `trailer_category` (`TrailerCategoryId`, `TrailerTypeCategoryName`) VALUES
(1, 'Cargo/Concession'),
(2, 'Heavy Duty Trailer'),
(3, 'Horse Trailer'),
(4, 'Utility Trailer'),
(5, 'Vehicle Trailer'),
(6, 'Other Trailer'),
(7, 'Towable RV'),
(8, 'Miscellaneous (Trailer)');

-- --------------------------------------------------------

--
-- Table structure for table `trailer_desc_tires`
--

CREATE TABLE `trailer_desc_tires` (
  `TrailerTireDescriptionId` int(11) NOT NULL,
  `DoorId` int(11) DEFAULT NULL,
  `RoofId` int(11) DEFAULT NULL,
  `AxleId` int(11) DEFAULT NULL,
  `TireId` int(11) DEFAULT NULL,
  `WheelId` int(11) DEFAULT NULL,
  `TrailerSerialNo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_detail`
--

CREATE TABLE `trailer_detail` (
  `TrailerDetailId` int(11) NOT NULL,
  `ManufacturerId` varchar(45) DEFAULT NULL,
  `TrailerTypeId` int(11) DEFAULT NULL,
  `ConditionStatusId` int(11) DEFAULT NULL,
  `SuspensionId` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trailer_detail`
--

INSERT INTO `trailer_detail` (`TrailerDetailId`, `ManufacturerId`, `TrailerTypeId`, `ConditionStatusId`, `SuspensionId`, `updated_at`, `created_at`) VALUES
(8, '2', 6, 2, 3, '2019-01-07 06:18:25', '2019-01-07 06:18:25'),
(9, '2', 16, 2, 2, '2019-01-07 07:09:21', '2019-01-07 07:09:21'),
(11, '2', 4, 1, 2, '2019-01-09 00:28:25', '2019-01-09 00:28:25'),
(12, '2', 2, 2, 3, '2019-01-11 04:30:44', '2019-01-11 04:30:44'),
(13, '2', 2, 2, 3, '2019-01-11 04:32:10', '2019-01-11 04:32:10'),
(14, '2', 2, 2, 3, '2019-01-11 04:34:00', '2019-01-11 04:34:00'),
(15, '2', 2, 2, 3, '2019-01-11 04:34:12', '2019-01-11 04:34:12'),
(16, '2', 2, 2, 3, '2019-01-11 04:35:22', '2019-01-11 04:35:22'),
(17, '2', 2, 2, 3, '2019-01-11 04:38:16', '2019-01-11 04:38:16'),
(18, '2', 2, 2, 3, '2019-01-11 04:38:43', '2019-01-11 04:38:43'),
(19, '1', 1, 1, 1, '2019-01-11 04:39:13', '2019-01-11 04:39:13'),
(20, '1', 1, 1, 1, '2019-01-11 04:39:30', '2019-01-11 04:39:30'),
(21, '1', 1, 1, 1, '2019-01-11 04:40:25', '2019-01-11 04:40:25'),
(22, '1', 1, 1, 1, '2019-01-11 04:41:56', '2019-01-11 04:41:56'),
(23, '1', 1, 1, 1, '2019-01-11 04:42:15', '2019-01-11 04:42:15'),
(24, '1', 1, 1, 1, '2019-01-11 04:43:05', '2019-01-11 04:43:05'),
(25, '1', 1, 1, 1, '2019-01-11 04:43:23', '2019-01-11 04:43:23'),
(26, '1', 1, 1, 1, '2019-01-11 04:55:39', '2019-01-11 04:55:39'),
(27, '1', 1, 1, 1, '2019-01-11 04:56:03', '2019-01-11 04:56:03'),
(28, '1', 1, 1, 1, '2019-01-11 04:56:21', '2019-01-11 04:56:21'),
(29, '1', 1, 1, 1, '2019-01-11 04:59:29', '2019-01-11 04:59:29'),
(30, '1', 1, 1, 1, '2019-01-11 04:59:53', '2019-01-11 04:59:53'),
(31, '1', 1, 1, 1, '2019-01-11 05:00:23', '2019-01-11 05:00:23'),
(32, '1', 1, 1, 1, '2019-01-11 05:00:50', '2019-01-11 05:00:50'),
(33, '1', 1, 1, 1, '2019-01-11 05:01:09', '2019-01-11 05:01:09'),
(34, '1', 1, 1, 1, '2019-01-11 05:06:40', '2019-01-11 05:06:40'),
(35, '1', 1, 1, 1, '2019-01-11 05:06:54', '2019-01-11 05:06:54'),
(36, '1', 1, 1, 1, '2019-01-11 05:07:07', '2019-01-11 05:07:07'),
(37, '1', 1, 1, 1, '2019-01-11 05:08:30', '2019-01-11 05:08:30'),
(38, '1', 1, 1, 1, '2019-01-11 05:09:23', '2019-01-11 05:09:23'),
(39, '1', 1, 1, 1, '2019-01-11 05:10:07', '2019-01-11 05:10:07'),
(40, '1', 1, 1, 1, '2019-01-11 05:12:09', '2019-01-11 05:12:09'),
(41, '1', 1, 1, 1, '2019-01-11 05:12:35', '2019-01-11 05:12:35'),
(42, '1', 1, 1, 1, '2019-01-11 05:13:00', '2019-01-11 05:13:00'),
(43, '1', 1, 1, 1, '2019-01-11 05:14:24', '2019-01-11 05:14:24'),
(44, '1', 1, 1, 1, '2019-01-11 05:15:42', '2019-01-11 05:15:42'),
(45, '1', 1, 1, 1, '2019-01-11 05:16:38', '2019-01-11 05:16:38'),
(46, '1', 1, 1, 1, '2019-01-11 05:18:06', '2019-01-11 05:18:06'),
(47, '1', 1, 1, 1, '2019-01-11 05:19:46', '2019-01-11 05:19:46'),
(48, '1', 1, 1, 1, '2019-01-11 05:20:25', '2019-01-11 05:20:25'),
(49, '1', 1, 1, 1, '2019-01-11 05:20:40', '2019-01-11 05:20:40'),
(50, '1', 1, 1, 1, '2019-01-11 05:20:53', '2019-01-11 05:20:53'),
(51, '1', 1, 1, 1, '2019-01-11 05:28:41', '2019-01-11 05:28:41'),
(52, '1', 1, 1, 1, '2019-01-11 05:29:21', '2019-01-11 05:29:21'),
(53, '1', 1, 1, 1, '2019-01-11 05:29:40', '2019-01-11 05:29:40'),
(54, '1', 1, 1, 1, '2019-01-11 05:29:51', '2019-01-11 05:29:51'),
(55, '1', 1, 1, 1, '2019-01-11 05:31:40', '2019-01-11 05:31:40'),
(56, '1', 1, 1, 1, '2019-01-11 05:32:21', '2019-01-11 05:32:21'),
(57, '1', 1, 1, 1, '2019-01-11 05:33:06', '2019-01-11 05:33:06'),
(58, '1', 1, 1, 1, '2019-01-11 05:33:34', '2019-01-11 05:33:34'),
(59, '1', 1, 1, 1, '2019-01-11 05:34:01', '2019-01-11 05:34:01'),
(60, '1', 1, 1, 1, '2019-01-11 05:34:31', '2019-01-11 05:34:31'),
(61, '1', 1, 1, 1, '2019-01-11 05:34:41', '2019-01-11 05:34:41'),
(62, '1', 1, 1, 1, '2019-01-11 05:35:53', '2019-01-11 05:35:53'),
(63, '1', 1, 1, 1, '2019-01-11 05:35:56', '2019-01-11 05:35:56'),
(64, '1', 1, 1, 1, '2019-01-11 05:36:08', '2019-01-11 05:36:08'),
(65, '1', 1, 1, 1, '2019-01-11 05:36:41', '2019-01-11 05:36:41'),
(66, '1', 1, 1, 1, '2019-01-11 05:37:19', '2019-01-11 05:37:19'),
(67, '1', 1, 1, 1, '2019-01-11 05:37:59', '2019-01-11 05:37:59'),
(68, '1', 1, 1, 1, '2019-01-11 05:39:44', '2019-01-11 05:39:44'),
(69, '2', 5, 1, 3, '2019-01-17 03:15:13', '2019-01-17 03:15:13'),
(70, '2', 4, 2, 2, '2019-01-17 08:20:31', '2019-01-17 08:20:31'),
(71, '2', 15, 2, 2, '2019-01-17 08:37:04', '2019-01-17 08:37:04'),
(72, '1', 22, 1, 1, '2019-01-24 05:56:58', '2019-01-24 05:56:58'),
(73, '1', 22, 1, 1, '2019-01-24 05:57:39', '2019-01-24 05:57:39'),
(74, '1', 30, 1, 1, '2019-01-24 05:59:08', '2019-01-24 05:59:08'),
(75, '1', 1, 1, 1, '2019-01-24 06:03:59', '2019-01-24 06:03:59'),
(76, '1', 1, 1, 1, '2019-01-24 06:08:39', '2019-01-24 06:08:39'),
(77, '1', 1, 1, 1, '2019-01-24 06:10:41', '2019-01-24 06:10:41'),
(78, '1', 1, 1, 1, '2019-01-24 06:20:10', '2019-01-24 06:20:10'),
(79, '1', 1, 1, 1, '2019-01-24 06:30:34', '2019-01-24 06:30:34'),
(80, '1', 1, 1, 2, '2019-01-24 06:46:14', '2019-01-24 06:46:14'),
(81, '1', 1, 1, 2, '2019-01-24 06:47:18', '2019-01-24 06:47:18'),
(82, '1', 1, 1, 1, '2019-01-24 06:54:58', '2019-01-24 06:54:58'),
(83, '1', 9, 1, 1, '2019-01-25 02:50:48', '2019-01-25 02:50:48'),
(84, '1', 13, 1, 1, '2019-01-25 02:51:41', '2019-01-25 02:51:41'),
(85, '1', 27, 1, 1, '2019-01-25 02:52:09', '2019-01-25 02:52:09'),
(86, '1', 1, 1, 1, '2019-01-25 03:12:11', '2019-01-25 03:12:11'),
(87, '1', 1, 1, 1, '2019-01-25 04:01:33', '2019-01-25 04:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `trailer_detail_binary`
--

CREATE TABLE `trailer_detail_binary` (
  `TrailerBinaryId` int(11) NOT NULL,
  `PlateVan` enum('0','1','Unknown') NOT NULL,
  `LogPosts` enum('0','1','Unknown') NOT NULL,
  `XPosts` enum('0','1','Unknown') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_door`
--

CREATE TABLE `trailer_door` (
  `DoorId` int(11) NOT NULL,
  `DoorName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_length`
--

CREATE TABLE `trailer_length` (
  `Length` int(11) NOT NULL,
  `UnitOfMeasure` varchar(8) NOT NULL,
  `TrailerDetailId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_rented_via`
--

CREATE TABLE `trailer_rented_via` (
  `Price` float NOT NULL,
  `RentalStartDate` date NOT NULL,
  `RentalTerm` int(11) NOT NULL,
  `RentalTransId` varchar(45) NOT NULL,
  `TrailerSerialNo` varchar(45) NOT NULL,
  `RentalTermId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_roof`
--

CREATE TABLE `trailer_roof` (
  `RoofId` int(11) NOT NULL,
  `RoofType` varchar(95) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_siding`
--

CREATE TABLE `trailer_siding` (
  `SidingId` int(11) NOT NULL,
  `SidingName` varchar(85) NOT NULL,
  `SidingDescription` varchar(85) NOT NULL,
  `TrailerDetailId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_specs`
--

CREATE TABLE `trailer_specs` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(85) NOT NULL,
  `ManufacturerId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trailer_type`
--

CREATE TABLE `trailer_type` (
  `TrailerTypeId` int(11) NOT NULL,
  `TypeName` varchar(85) NOT NULL,
  `TrailerCategoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trailer_type`
--

INSERT INTO `trailer_type` (`TrailerTypeId`, `TypeName`, `TrailerCategoryId`) VALUES
(1, 'ATV', 5),
(2, 'Boat Trailer', 5),
(3, 'Car Carrier', 2),
(4, 'Car Hauler', 5),
(5, 'Cargo Trailers', 1),
(6, 'Concessions/Vending', 1),
(7, 'Deckover', 4),
(8, 'Destination Trailer', 7),
(9, 'Drop Deck', 2),
(10, 'Dry Van', 2),
(11, 'Dump (Heavy Duty)', 2),
(12, 'Dump (Utility)', 4),
(13, 'Equipment', 4),
(14, 'Expandable Trailer', 7),
(15, 'Fifth Wheel', 7),
(16, 'Fish House', 7),
(17, 'Flat Deck', 4),
(18, 'Flatbed (Utility)', 4),
(19, 'Flatbed/Flat Deck (Heavy Duty)', 2),
(20, 'Hay', 4),
(21, 'Horse Trailer', 3),
(22, 'Jet Ski', 5),
(23, 'Landscape', 4),
(24, 'Live Floor', 2),
(25, 'Livestock Trailer', 3),
(26, 'Lowboy', 2),
(27, 'Motor Cycle Trailer', 5),
(28, 'Miscellaneous (Trailer)', 8),
(29, 'Office', 1),
(30, 'Park Model', 7),
(31, 'Popup', 7),
(32, 'Recycling', 6),
(33, 'Refrigerated', 2),
(34, 'Roll-off', 4),
(35, 'Snowmobile', 5),
(36, 'Step Deck', 4),
(37, 'Tanker', 2),
(38, 'Tilt Deck', 4),
(39, 'Tilt Deck (Heavy Duty)', 2),
(40, 'Tow Dolly', 5),
(41, 'Toy Hauler', 7),
(42, 'Travel Trailer', 7),
(43, 'Utility Trailer', 4),
(44, 'Vehicle Tilt Deck', 5),
(45, 'Vending Cart', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_manufacturer`
--

CREATE TABLE `t_manufacturer` (
  `ManufacturerId` varchar(45) NOT NULL,
  `ManuName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_manufacturer`
--

INSERT INTO `t_manufacturer` (`ManufacturerId`, `ManuName`) VALUES
('1', 'volvo'),
('2', 'ford');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(200) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Role_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `name`, `email`, `password`, `Role_id`, `updated_at`, `created_at`) VALUES
(1, 'darren', 'darren@instaspections.com', '$2y$10$VAiVCNPr9rbR6MWD4nKfqe/kTvDzgjZsJRSDsTumrLzIbMQEq2wlO', 1, '2019-01-25 10:39:44', '2018-12-22 00:25:20'),
(11, 'john', 'john@sitemanager.in', '$2y$10$T6OkxSLmmcaQxbMvsGKQaO9Sb0t/acO6BAUdeBEeQ1VlWmHgD/kMC', 2, '2019-01-25 03:16:20', '2019-01-25 03:16:20'),
(12, 'david', 'david@tm.in', '$2y$10$udCUtFRMCq7CwB4jIIsZIeI.VhHLmlcfWIeh/EHA4fe/BrFEruFMe', 3, '2019-01-25 03:18:24', '2019-01-25 03:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_phone_no`
--

CREATE TABLE `user_phone_no` (
  `PhoneNo` varchar(20) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_site_tbl`
--

CREATE TABLE `user_site_tbl` (
  `SiteId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_vendor_tbl`
--

CREATE TABLE `user_vendor_tbl` (
  `VendorId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `VendorId` int(11) NOT NULL,
  `VendorName` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wheel`
--

CREATE TABLE `wheel` (
  `WheelId` int(11) NOT NULL,
  `WheelType` varchar(45) NOT NULL,
  `WheelTypeDesc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wheel`
--

INSERT INTO `wheel` (`WheelId`, `WheelType`, `WheelTypeDesc`) VALUES
(1, 'Stud Pilot', 'have tapered stud holes'),
(2, 'Hub Pilot', 'Use hub bore to fit over matching size ridge'),
(3, 'Open Rim', 'description not available'),
(4, 'Uknown', 'Wheel type n/a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `axle`
--
ALTER TABLE `axle`
  ADD PRIMARY KEY (`AxleId`);

--
-- Indexes for table `condition_status`
--
ALTER TABLE `condition_status`
  ADD PRIMARY KEY (`ConditionStatusId`);

--
-- Indexes for table `conducts_service`
--
ALTER TABLE `conducts_service`
  ADD PRIMARY KEY (`VendorId`,`InvoiceNo`),
  ADD KEY `InvoiceNo` (`InvoiceNo`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `StateAbbreviation` (`StateAbbreviation`);

--
-- Indexes for table `drop_trailer_cost_tbl`
--
ALTER TABLE `drop_trailer_cost_tbl`
  ADD PRIMARY KEY (`CustomerNo`,`DTAId`),
  ADD KEY `DTAId` (`DTAId`);

--
-- Indexes for table `dta`
--
ALTER TABLE `dta`
  ADD PRIMARY KEY (`DTAId`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`TrailerSerialNo`),
  ADD KEY `TrailerBinaryId` (`TrailerBinaryId`),
  ADD KEY `TrailerDetailId` (`TrailerDetailId`),
  ADD KEY `ModelYear` (`ModelYear`),
  ADD KEY `SiteId` (`SiteId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `InvoiceNo` (`InvoiceNo`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`InvoiceNo`),
  ADD KEY `TrailerSerialNo` (`TrailerSerialNo`),
  ADD KEY `TractorSerialNo` (`TractorSerialNo`);

--
-- Indexes for table `model_year`
--
ALTER TABLE `model_year`
  ADD PRIMARY KEY (`ModelYear`);

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
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`VehicleId`),
  ADD KEY `StateAbbreviation` (`StateAbbreviation`),
  ADD KEY `SerialNo` (`TrailerSerialNo`),
  ADD KEY `TractorSerialNo` (`TractorSerialNo`),
  ADD KEY `ModelYear` (`ModelYear`);

--
-- Indexes for table `registration1`
--
ALTER TABLE `registration1`
  ADD PRIMARY KEY (`VehicleId`),
  ADD KEY `StateAbbreviation` (`StateAbbreviation`),
  ADD KEY `ModelYear` (`ModelYear`),
  ADD KEY `TrailerSerialNo` (`TrailerSerialNo`),
  ADD KEY `TractorSerialNo` (`TractorSerialNo`);

--
-- Indexes for table `reg_renewal`
--
ALTER TABLE `reg_renewal`
  ADD PRIMARY KEY (`DocumentId`);

--
-- Indexes for table `reg_renewal_other_fees`
--
ALTER TABLE `reg_renewal_other_fees`
  ADD PRIMARY KEY (`OtherFee`,`DocumentId`),
  ADD KEY `DocumentId` (`DocumentId`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`RentalTransId`),
  ADD KEY `VendorId` (`VendorId`),
  ADD KEY `SiteId` (`SiteId`);

--
-- Indexes for table `rental_term`
--
ALTER TABLE `rental_term`
  ADD PRIMARY KEY (`RentalTermId`);

--
-- Indexes for table `rentedvia`
--
ALTER TABLE `rentedvia`
  ADD PRIMARY KEY (`TrailerSerialNo`,`RentalTransId`),
  ADD KEY `RentalTransId` (`RentalTransId`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`SalesTransId`),
  ADD KEY `TrailerSerialNo` (`TrailerSerialNo`),
  ADD KEY `SiteId` (`SiteId`),
  ADD KEY `VendorId` (`VendorId`),
  ADD KEY `TractorSerialNo` (`TractorSerialNo`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`SiteId`),
  ADD KEY `StateAbbreviation` (`StateAbbreviation`),
  ADD KEY `OrganizationId` (`OrganizationId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `hide` (`hide`);

--
-- Indexes for table `site_invitation`
--
ALTER TABLE `site_invitation`
  ADD PRIMARY KEY (`invitationId`);

--
-- Indexes for table `site_services_cust_tbl`
--
ALTER TABLE `site_services_cust_tbl`
  ADD PRIMARY KEY (`SiteId`,`CustomerNo`),
  ADD KEY `CustomerNo` (`CustomerNo`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`StateAbbreviation`);

--
-- Indexes for table `suspension`
--
ALTER TABLE `suspension`
  ADD PRIMARY KEY (`SuspensionId`);

--
-- Indexes for table `tire`
--
ALTER TABLE `tire`
  ADD PRIMARY KEY (`TireId`);

--
-- Indexes for table `tractor`
--
ALTER TABLE `tractor`
  ADD PRIMARY KEY (`TractorSerialNo`),
  ADD KEY `SiteId` (`SiteId`),
  ADD KEY `ModelYear` (`ModelYear`),
  ADD KEY `TractrodetailId` (`TractordetailId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `TractorDetails`
--
ALTER TABLE `TractorDetails`
  ADD PRIMARY KEY (`TractorDetailId`),
  ADD KEY `TractorTypeId` (`TractorTypeId`),
  ADD KEY `ConditionStatusId` (`ConditionStatusId`),
  ADD KEY `ManuFacturerID` (`ManuFacturerID`);

--
-- Indexes for table `tractor_detail`
--
ALTER TABLE `tractor_detail`
  ADD PRIMARY KEY (`TractorDetail_Id`),
  ADD KEY `SerialNo` (`SerialNo`),
  ADD KEY `ManuFacturerID` (`ManuFacturerID`),
  ADD KEY `TractorTypeId` (`TractorTypeId`),
  ADD KEY `ConditionStatusId` (`ConditionStatusId`);

--
-- Indexes for table `tractor_manu`
--
ALTER TABLE `tractor_manu`
  ADD PRIMARY KEY (`ManuFacturerID`);

--
-- Indexes for table `tractor_rented_via`
--
ALTER TABLE `tractor_rented_via`
  ADD PRIMARY KEY (`RentalTransId`,`TractorSerialNo`),
  ADD KEY `TractorSerialNo` (`TractorSerialNo`),
  ADD KEY `RentalTermId` (`RentalTermId`);

--
-- Indexes for table `tractor_type`
--
ALTER TABLE `tractor_type`
  ADD PRIMARY KEY (`TractorTypeId`);

--
-- Indexes for table `trailertracking`
--
ALTER TABLE `trailertracking`
  ADD PRIMARY KEY (`TrackingId`),
  ADD KEY `TrailerSerialNo` (`TrailerSerialNo`),
  ADD KEY `TractorSerialNo` (`TractorSerialNo`);

--
-- Indexes for table `trailer_category`
--
ALTER TABLE `trailer_category`
  ADD PRIMARY KEY (`TrailerCategoryId`);

--
-- Indexes for table `trailer_desc_tires`
--
ALTER TABLE `trailer_desc_tires`
  ADD PRIMARY KEY (`TrailerTireDescriptionId`),
  ADD KEY `DoorId` (`DoorId`),
  ADD KEY `RoofId` (`RoofId`),
  ADD KEY `AxleId` (`AxleId`),
  ADD KEY `TireId` (`TireId`),
  ADD KEY `WheelId` (`WheelId`),
  ADD KEY `TrailerSerialNo` (`TrailerSerialNo`);

--
-- Indexes for table `trailer_detail`
--
ALTER TABLE `trailer_detail`
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
-- Indexes for table `trailer_door`
--
ALTER TABLE `trailer_door`
  ADD PRIMARY KEY (`DoorId`);

--
-- Indexes for table `trailer_length`
--
ALTER TABLE `trailer_length`
  ADD PRIMARY KEY (`Length`),
  ADD KEY `TrailerDetailId` (`TrailerDetailId`);

--
-- Indexes for table `trailer_rented_via`
--
ALTER TABLE `trailer_rented_via`
  ADD PRIMARY KEY (`RentalTransId`,`TrailerSerialNo`),
  ADD KEY `TrailerSerialNo` (`TrailerSerialNo`),
  ADD KEY `RentalTermId` (`RentalTermId`);

--
-- Indexes for table `trailer_roof`
--
ALTER TABLE `trailer_roof`
  ADD PRIMARY KEY (`RoofId`);

--
-- Indexes for table `trailer_siding`
--
ALTER TABLE `trailer_siding`
  ADD PRIMARY KEY (`SidingId`),
  ADD KEY `TrailerDetailId` (`TrailerDetailId`);

--
-- Indexes for table `trailer_specs`
--
ALTER TABLE `trailer_specs`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `ManufacturerId` (`ManufacturerId`);

--
-- Indexes for table `trailer_type`
--
ALTER TABLE `trailer_type`
  ADD PRIMARY KEY (`TrailerTypeId`),
  ADD KEY `TrailerCategoryId` (`TrailerCategoryId`);

--
-- Indexes for table `t_manufacturer`
--
ALTER TABLE `t_manufacturer`
  ADD PRIMARY KEY (`ManufacturerId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `Role_id` (`Role_id`);

--
-- Indexes for table `user_phone_no`
--
ALTER TABLE `user_phone_no`
  ADD PRIMARY KEY (`PhoneNo`,`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `user_site_tbl`
--
ALTER TABLE `user_site_tbl`
  ADD PRIMARY KEY (`SiteId`,`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `user_vendor_tbl`
--
ALTER TABLE `user_vendor_tbl`
  ADD PRIMARY KEY (`VendorId`,`UserId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`VendorId`);

--
-- Indexes for table `wheel`
--
ALTER TABLE `wheel`
  ADD PRIMARY KEY (`WheelId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `axle`
--
ALTER TABLE `axle`
  MODIFY `AxleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `condition_status`
--
ALTER TABLE `condition_status`
  MODIFY `ConditionStatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `org_invitation`
--
ALTER TABLE `org_invitation`
  MODIFY `invitationId` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `registration1`
--
ALTER TABLE `registration1`
  MODIFY `VehicleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reg_renewal`
--
ALTER TABLE `reg_renewal`
  MODIFY `DocumentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `SiteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `site_invitation`
--
ALTER TABLE `site_invitation`
  MODIFY `invitationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `suspension`
--
ALTER TABLE `suspension`
  MODIFY `SuspensionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tire`
--
ALTER TABLE `tire`
  MODIFY `TireId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TractorDetails`
--
ALTER TABLE `TractorDetails`
  MODIFY `TractorDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tractor_detail`
--
ALTER TABLE `tractor_detail`
  MODIFY `TractorDetail_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tractor_manu`
--
ALTER TABLE `tractor_manu`
  MODIFY `ManuFacturerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tractor_type`
--
ALTER TABLE `tractor_type`
  MODIFY `TractorTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trailer_category`
--
ALTER TABLE `trailer_category`
  MODIFY `TrailerCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trailer_desc_tires`
--
ALTER TABLE `trailer_desc_tires`
  MODIFY `TrailerTireDescriptionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trailer_detail`
--
ALTER TABLE `trailer_detail`
  MODIFY `TrailerDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `trailer_detail_binary`
--
ALTER TABLE `trailer_detail_binary`
  MODIFY `TrailerBinaryId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trailer_door`
--
ALTER TABLE `trailer_door`
  MODIFY `DoorId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trailer_roof`
--
ALTER TABLE `trailer_roof`
  MODIFY `RoofId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trailer_siding`
--
ALTER TABLE `trailer_siding`
  MODIFY `SidingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trailer_specs`
--
ALTER TABLE `trailer_specs`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trailer_type`
--
ALTER TABLE `trailer_type`
  MODIFY `TrailerTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `VendorId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wheel`
--
ALTER TABLE `wheel`
  MODIFY `WheelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conducts_service`
--
ALTER TABLE `conducts_service`
  ADD CONSTRAINT `conducts_service_ibfk_1` FOREIGN KEY (`VendorId`) REFERENCES `vendor` (`VendorId`),
  ADD CONSTRAINT `conducts_service_ibfk_2` FOREIGN KEY (`InvoiceNo`) REFERENCES `maintenance` (`InvoiceNo`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`StateAbbreviation`) REFERENCES `state` (`StateAbbreviation`);

--
-- Constraints for table `drop_trailer_cost_tbl`
--
ALTER TABLE `drop_trailer_cost_tbl`
  ADD CONSTRAINT `drop_trailer_cost_tbl_ibfk_1` FOREIGN KEY (`CustomerNo`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `drop_trailer_cost_tbl_ibfk_2` FOREIGN KEY (`DTAId`) REFERENCES `dta` (`DTAId`);

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_2` FOREIGN KEY (`TrailerBinaryId`) REFERENCES `trailer_detail_binary` (`TrailerBinaryId`),
  ADD CONSTRAINT `equipment_ibfk_3` FOREIGN KEY (`TrailerDetailId`) REFERENCES `trailer_detail` (`TrailerDetailId`),
  ADD CONSTRAINT `equipment_ibfk_4` FOREIGN KEY (`ModelYear`) REFERENCES `model_year` (`ModelYear`),
  ADD CONSTRAINT `equipment_ibfk_5` FOREIGN KEY (`SiteId`) REFERENCES `site` (`SiteId`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`InvoiceNo`) REFERENCES `maintenance` (`InvoiceNo`);

--
-- Constraints for table `registration1`
--
ALTER TABLE `registration1`
  ADD CONSTRAINT `registration1_ibfk_1` FOREIGN KEY (`ModelYear`) REFERENCES `model_year` (`ModelYear`),
  ADD CONSTRAINT `registration1_ibfk_2` FOREIGN KEY (`StateAbbreviation`) REFERENCES `state` (`StateAbbreviation`),
  ADD CONSTRAINT `registration1_ibfk_3` FOREIGN KEY (`TractorSerialNo`) REFERENCES `tractor` (`TractorSerialNo`),
  ADD CONSTRAINT `registration1_ibfk_4` FOREIGN KEY (`TrailerSerialNo`) REFERENCES `equipment` (`TrailerSerialNo`);

--
-- Constraints for table `reg_renewal_other_fees`
--
ALTER TABLE `reg_renewal_other_fees`
  ADD CONSTRAINT `reg_renewal_other_fees_ibfk_1` FOREIGN KEY (`DocumentId`) REFERENCES `reg_renewal` (`DocumentId`);

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`VendorId`) REFERENCES `vendor` (`VendorId`),
  ADD CONSTRAINT `rental_ibfk_2` FOREIGN KEY (`SiteId`) REFERENCES `site` (`SiteId`);

--
-- Constraints for table `rentedvia`
--
ALTER TABLE `rentedvia`
  ADD CONSTRAINT `rentedvia_ibfk_1` FOREIGN KEY (`TrailerSerialNo`) REFERENCES `equipment` (`TrailerSerialNo`),
  ADD CONSTRAINT `rentedvia_ibfk_2` FOREIGN KEY (`RentalTransId`) REFERENCES `rental` (`RentalTransId`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`TrailerSerialNo`) REFERENCES `equipment` (`TrailerSerialNo`),
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`SiteId`) REFERENCES `site` (`SiteId`),
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`VendorId`) REFERENCES `vendor` (`VendorId`),
  ADD CONSTRAINT `sale_ibfk_4` FOREIGN KEY (`TractorSerialNo`) REFERENCES `tractor` (`TractorSerialNo`);

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_2` FOREIGN KEY (`StateAbbreviation`) REFERENCES `state` (`StateAbbreviation`),
  ADD CONSTRAINT `site_ibfk_3` FOREIGN KEY (`OrganizationId`) REFERENCES `organization` (`OrganizationId`);

--
-- Constraints for table `site_services_cust_tbl`
--
ALTER TABLE `site_services_cust_tbl`
  ADD CONSTRAINT `site_services_cust_tbl_ibfk_1` FOREIGN KEY (`SiteId`) REFERENCES `site` (`SiteId`),
  ADD CONSTRAINT `site_services_cust_tbl_ibfk_2` FOREIGN KEY (`CustomerNo`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `tractor`
--
ALTER TABLE `tractor`
  ADD CONSTRAINT `tractor_ibfk_2` FOREIGN KEY (`ModelYear`) REFERENCES `model_year` (`ModelYear`),
  ADD CONSTRAINT `tractor_ibfk_3` FOREIGN KEY (`TractordetailId`) REFERENCES `TractorDetails` (`TractorDetailId`),
  ADD CONSTRAINT `tractor_ibfk_4` FOREIGN KEY (`SiteId`) REFERENCES `site` (`SiteId`);

--
-- Constraints for table `TractorDetails`
--
ALTER TABLE `TractorDetails`
  ADD CONSTRAINT `tractordetails_ibfk_1` FOREIGN KEY (`ManuFacturerID`) REFERENCES `tractor_manu` (`ManuFacturerID`),
  ADD CONSTRAINT `tractordetails_ibfk_2` FOREIGN KEY (`TractorTypeId`) REFERENCES `tractor_type` (`TractorTypeId`),
  ADD CONSTRAINT `tractordetails_ibfk_3` FOREIGN KEY (`ConditionStatusId`) REFERENCES `condition_status` (`ConditionStatusId`);

--
-- Constraints for table `tractor_detail`
--
ALTER TABLE `tractor_detail`
  ADD CONSTRAINT `tractor_detail_ibfk_1` FOREIGN KEY (`SerialNo`) REFERENCES `tractor` (`TractorSerialNo`),
  ADD CONSTRAINT `tractor_detail_ibfk_2` FOREIGN KEY (`ManuFacturerID`) REFERENCES `tractor_manu` (`ManuFacturerID`),
  ADD CONSTRAINT `tractor_detail_ibfk_3` FOREIGN KEY (`TractorTypeId`) REFERENCES `tractor_type` (`TractorTypeId`),
  ADD CONSTRAINT `tractor_detail_ibfk_4` FOREIGN KEY (`ConditionStatusId`) REFERENCES `condition_status` (`ConditionStatusId`);

--
-- Constraints for table `tractor_rented_via`
--
ALTER TABLE `tractor_rented_via`
  ADD CONSTRAINT `tractor_rented_via_ibfk_1` FOREIGN KEY (`RentalTransId`) REFERENCES `rental` (`RentalTransId`),
  ADD CONSTRAINT `tractor_rented_via_ibfk_2` FOREIGN KEY (`TractorSerialNo`) REFERENCES `tractor` (`TractorSerialNo`),
  ADD CONSTRAINT `tractor_rented_via_ibfk_3` FOREIGN KEY (`RentalTermId`) REFERENCES `rental_term` (`RentalTermId`);

--
-- Constraints for table `trailertracking`
--
ALTER TABLE `trailertracking`
  ADD CONSTRAINT `trailertracking_ibfk_1` FOREIGN KEY (`TrailerSerialNo`) REFERENCES `equipment` (`TrailerSerialNo`),
  ADD CONSTRAINT `trailertracking_ibfk_2` FOREIGN KEY (`TractorSerialNo`) REFERENCES `tractor` (`TractorSerialNo`);

--
-- Constraints for table `trailer_desc_tires`
--
ALTER TABLE `trailer_desc_tires`
  ADD CONSTRAINT `trailer_desc_tires_ibfk_1` FOREIGN KEY (`DoorId`) REFERENCES `trailer_door` (`DoorId`),
  ADD CONSTRAINT `trailer_desc_tires_ibfk_2` FOREIGN KEY (`RoofId`) REFERENCES `trailer_roof` (`RoofId`),
  ADD CONSTRAINT `trailer_desc_tires_ibfk_3` FOREIGN KEY (`AxleId`) REFERENCES `axle` (`AxleId`),
  ADD CONSTRAINT `trailer_desc_tires_ibfk_4` FOREIGN KEY (`TireId`) REFERENCES `tire` (`TireId`),
  ADD CONSTRAINT `trailer_desc_tires_ibfk_5` FOREIGN KEY (`WheelId`) REFERENCES `wheel` (`WheelId`),
  ADD CONSTRAINT `trailer_desc_tires_ibfk_6` FOREIGN KEY (`TrailerSerialNo`) REFERENCES `equipment` (`TrailerSerialNo`);

--
-- Constraints for table `trailer_detail`
--
ALTER TABLE `trailer_detail`
  ADD CONSTRAINT `trailer_detail_ibfk_1` FOREIGN KEY (`ManufacturerId`) REFERENCES `t_manufacturer` (`ManufacturerId`),
  ADD CONSTRAINT `trailer_detail_ibfk_2` FOREIGN KEY (`TrailerTypeId`) REFERENCES `trailer_type` (`TrailerTypeId`),
  ADD CONSTRAINT `trailer_detail_ibfk_3` FOREIGN KEY (`ConditionStatusId`) REFERENCES `condition_status` (`ConditionStatusId`),
  ADD CONSTRAINT `trailer_detail_ibfk_4` FOREIGN KEY (`SuspensionId`) REFERENCES `suspension` (`SuspensionId`);

--
-- Constraints for table `trailer_length`
--
ALTER TABLE `trailer_length`
  ADD CONSTRAINT `trailer_length_ibfk_1` FOREIGN KEY (`TrailerDetailId`) REFERENCES `trailer_detail` (`TrailerDetailId`);

--
-- Constraints for table `trailer_rented_via`
--
ALTER TABLE `trailer_rented_via`
  ADD CONSTRAINT `trailer_rented_via_ibfk_1` FOREIGN KEY (`RentalTransId`) REFERENCES `rental` (`RentalTransId`),
  ADD CONSTRAINT `trailer_rented_via_ibfk_2` FOREIGN KEY (`TrailerSerialNo`) REFERENCES `equipment` (`TrailerSerialNo`),
  ADD CONSTRAINT `trailer_rented_via_ibfk_3` FOREIGN KEY (`RentalTermId`) REFERENCES `rental_term` (`RentalTermId`);

--
-- Constraints for table `trailer_siding`
--
ALTER TABLE `trailer_siding`
  ADD CONSTRAINT `trailer_siding_ibfk_1` FOREIGN KEY (`TrailerDetailId`) REFERENCES `trailer_detail` (`TrailerDetailId`);

--
-- Constraints for table `trailer_specs`
--
ALTER TABLE `trailer_specs`
  ADD CONSTRAINT `trailer_specs_ibfk_1` FOREIGN KEY (`ManufacturerId`) REFERENCES `t_manufacturer` (`ManufacturerId`);

--
-- Constraints for table `trailer_type`
--
ALTER TABLE `trailer_type`
  ADD CONSTRAINT `trailer_type_ibfk_1` FOREIGN KEY (`TrailerCategoryId`) REFERENCES `trailer_category` (`TrailerCategoryId`);

--
-- Constraints for table `user_phone_no`
--
ALTER TABLE `user_phone_no`
  ADD CONSTRAINT `user_phone_no_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `user_site_tbl`
--
ALTER TABLE `user_site_tbl`
  ADD CONSTRAINT `user_site_tbl_ibfk_1` FOREIGN KEY (`SiteId`) REFERENCES `site` (`SiteId`),
  ADD CONSTRAINT `user_site_tbl_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `user_vendor_tbl`
--
ALTER TABLE `user_vendor_tbl`
  ADD CONSTRAINT `user_vendor_tbl_ibfk_1` FOREIGN KEY (`VendorId`) REFERENCES `vendor` (`VendorId`),
  ADD CONSTRAINT `user_vendor_tbl_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
