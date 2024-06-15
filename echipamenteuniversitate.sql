-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 01:29 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `echipamenteuniversitate`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorii_dotari`
--

CREATE TABLE `categorii_dotari` (
  `ID_Categorie` int(11) NOT NULL,
  `Nume_Categorie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorii_dotari`
--

INSERT INTO `categorii_dotari` (`ID_Categorie`, `Nume_Categorie`) VALUES
(1, 'laptop'),
(2, 'pc'),
(3, 'cabluri'),
(4, 'periferice'),
(5, 'ac');

-- --------------------------------------------------------

--
-- Table structure for table `dotari`
--

CREATE TABLE `dotari` (
  `ID_Dotare` int(11) NOT NULL,
  `ID_Categorie` int(11) NOT NULL,
  `Nume_Dotare` varchar(15) NOT NULL,
  `Cantitate` int(11) NOT NULL,
  `Stare` varchar(10) NOT NULL,
  `ID_Locatie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dotari`
--

INSERT INTO `dotari` (`ID_Dotare`, `ID_Categorie`, `Nume_Dotare`, `Cantitate`, `Stare`, `ID_Locatie`) VALUES
(78, 5, 'ac', 2, 'buna', 1),
(232, 1, 'laptop hp', 24, 'buna', 5),
(328, 3, 'usb c', 100, 'buna', 2),
(344, 3, 'cablu internet', 17, 'medie', 4),
(437, 1, 'laptop lenovo', 22, 'rea', 4),
(444, 2, 'monitor hp', 25, 'buna', 5),
(531, 1, 'laptop asus', 2, 'buna', 2),
(4322, 1, 'laptop asus', 23, 'jalnica', 2);

-- --------------------------------------------------------

--
-- Table structure for table `istoric_achizitii`
--

CREATE TABLE `istoric_achizitii` (
  `ID_Achizitie` int(11) NOT NULL,
  `ID_Dotare` int(11) NOT NULL,
  `Data_Achizitie` date NOT NULL,
  `Cost_Achizitie` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `istoric_achizitii`
--

INSERT INTO `istoric_achizitii` (`ID_Achizitie`, `ID_Dotare`, `Data_Achizitie`, `Cost_Achizitie`) VALUES
(33, 344, '2024-01-09', 434),
(55, 328, '2024-01-10', 3546),
(224, 4322, '2021-01-14', 4324),
(345, 232, '2023-11-15', 3333),
(445, 531, '2024-01-01', 5647);

-- --------------------------------------------------------

--
-- Table structure for table `locatii`
--

CREATE TABLE `locatii` (
  `ID_Locatie` int(11) NOT NULL,
  `Departament` varchar(20) NOT NULL,
  `Corp` varchar(2) NOT NULL,
  `Facultate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locatii`
--

INSERT INTO `locatii` (`ID_Locatie`, `Departament`, `Corp`, `Facultate`) VALUES
(1, 'Dep1', 'PR', 'Fac1'),
(2, 'Dep1', 'PR', 'Fac1'),
(3, 'Dep2', 'CN', 'Fac2'),
(4, 'Dep3', 'CN', 'Fac2'),
(5, 'Dep4', 'BN', 'Fac3');

-- --------------------------------------------------------

--
-- Table structure for table `mentenante`
--

CREATE TABLE `mentenante` (
  `ID_Mentenanta` int(11) NOT NULL,
  `ID_Dotare` int(11) NOT NULL,
  `Data_Mentenanta` date NOT NULL,
  `Cost_Mentenanta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mentenante`
--

INSERT INTO `mentenante` (`ID_Mentenanta`, `ID_Dotare`, `Data_Mentenanta`, `Cost_Mentenanta`) VALUES
(34, 437, '2023-12-13', 867),
(432, 328, '2024-01-01', 654);

-- --------------------------------------------------------

--
-- Table structure for table `profesori`
--

CREATE TABLE `profesori` (
  `ID_Profesor` int(11) NOT NULL,
  `Nume_Profesor` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profesori`
--

INSERT INTO `profesori` (`ID_Profesor`, `Nume_Profesor`, `Email`) VALUES
(1, 'Profesorescu', 'profesorescu@gmail.com'),
(4, 'Andrei Andreescu', 'andrei@gmail.com'),
(6, 'Maria', 'maria34@gmail.com'),
(8, 'stefan', 'stefan.6@gmail.com'),
(12, 'alexandru alex', 'alex@yahoo.com'),
(13, 'brabulescu ion', 'brabulescu_i@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `profesori_dotari`
--

CREATE TABLE `profesori_dotari` (
  `ID_Profesor` int(11) NOT NULL,
  `ID_Dotare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profesori_dotari`
--

INSERT INTO `profesori_dotari` (`ID_Profesor`, `ID_Dotare`) VALUES
(12, 232),
(12, 444),
(4, 78),
(6, 328),
(6, 4322),
(8, 344),
(8, 437),
(6, 531);

-- --------------------------------------------------------

--
-- Table structure for table `profesori_locatii`
--

CREATE TABLE `profesori_locatii` (
  `ID_Profesor` int(11) NOT NULL,
  `ID_Locatie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profesori_locatii`
--

INSERT INTO `profesori_locatii` (`ID_Profesor`, `ID_Locatie`) VALUES
(4, 1),
(1, 3),
(6, 2),
(8, 4),
(12, 5),
(13, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorii_dotari`
--
ALTER TABLE `categorii_dotari`
  ADD PRIMARY KEY (`ID_Categorie`);

--
-- Indexes for table `dotari`
--
ALTER TABLE `dotari`
  ADD PRIMARY KEY (`ID_Dotare`),
  ADD KEY `ID_Categorie` (`ID_Categorie`),
  ADD KEY `ID_Locatie` (`ID_Locatie`);

--
-- Indexes for table `istoric_achizitii`
--
ALTER TABLE `istoric_achizitii`
  ADD PRIMARY KEY (`ID_Achizitie`),
  ADD KEY `ID_Dotare` (`ID_Dotare`);

--
-- Indexes for table `locatii`
--
ALTER TABLE `locatii`
  ADD PRIMARY KEY (`ID_Locatie`);

--
-- Indexes for table `mentenante`
--
ALTER TABLE `mentenante`
  ADD PRIMARY KEY (`ID_Mentenanta`),
  ADD KEY `ID_Dotare` (`ID_Dotare`);

--
-- Indexes for table `profesori`
--
ALTER TABLE `profesori`
  ADD PRIMARY KEY (`ID_Profesor`);

--
-- Indexes for table `profesori_dotari`
--
ALTER TABLE `profesori_dotari`
  ADD KEY `ID_Profesor` (`ID_Profesor`),
  ADD KEY `ID_Dotare` (`ID_Dotare`);

--
-- Indexes for table `profesori_locatii`
--
ALTER TABLE `profesori_locatii`
  ADD KEY `ID_Profesor` (`ID_Profesor`),
  ADD KEY `ID_Locatie` (`ID_Locatie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profesori`
--
ALTER TABLE `profesori`
  MODIFY `ID_Profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dotari`
--
ALTER TABLE `dotari`
  ADD CONSTRAINT `dotari_ibfk_1` FOREIGN KEY (`ID_Categorie`) REFERENCES `categorii_dotari` (`ID_Categorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dotari_ibfk_2` FOREIGN KEY (`ID_Locatie`) REFERENCES `locatii` (`ID_Locatie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `istoric_achizitii`
--
ALTER TABLE `istoric_achizitii`
  ADD CONSTRAINT `istoric_achizitii_ibfk_1` FOREIGN KEY (`ID_Dotare`) REFERENCES `dotari` (`ID_Dotare`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mentenante`
--
ALTER TABLE `mentenante`
  ADD CONSTRAINT `mentenante_ibfk_1` FOREIGN KEY (`ID_Dotare`) REFERENCES `dotari` (`ID_Dotare`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profesori_dotari`
--
ALTER TABLE `profesori_dotari`
  ADD CONSTRAINT `profesori_dotari_ibfk_1` FOREIGN KEY (`ID_Dotare`) REFERENCES `dotari` (`ID_Dotare`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesori_dotari_ibfk_3` FOREIGN KEY (`ID_Profesor`) REFERENCES `profesori` (`ID_Profesor`);

--
-- Constraints for table `profesori_locatii`
--
ALTER TABLE `profesori_locatii`
  ADD CONSTRAINT `profesori_locatii_ibfk_2` FOREIGN KEY (`ID_Locatie`) REFERENCES `locatii` (`ID_Locatie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesori_locatii_ibfk_3` FOREIGN KEY (`ID_Profesor`) REFERENCES `profesori` (`ID_Profesor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
