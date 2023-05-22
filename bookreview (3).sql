-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 06:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbook`
--

CREATE TABLE `tblbook` (
  `Book_Key` int(15) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Category_Key` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `Authors_Firstname` varchar(100) NOT NULL,
  `Authors_Lastname` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbook`
--

INSERT INTO `tblbook` (`Book_Key`, `Title`, `Category_Key`, `ISBN`, `Authors_Firstname`, `Authors_Lastname`, `description`) VALUES
(1, 'Adventure of the Lost World', 1, '9783161484100', 'John', 'Doe', 'A thrilling adventure story about the search for a lost world.'),
(2, 'Secrets of the Galaxy', 2, '9783161484101', 'Jane', 'Smith', 'An intriguing tale of interstellar exploration and mystery.'),
(3, 'The Last Magician', 3, '9783161484102', 'Alice', 'Johnson', 'A captivating fantasy novel about the last magician in a world of science.'),
(4, 'Chronicles of the Old Kingdom', 4, '9783161484103', 'Robert', 'Brown', 'An epic tale about the struggle for power in the Old Kingdom.'),
(5, 'The Silent Song', 5, '9783161484104', 'Emily', 'Williams', 'A poignant drama about love, loss, and redemption.'),
(6, 'The Hidden Truth', 1, '9783161484105', 'Michael', 'Davis', 'A gripping detective story about the pursuit of elusive truth.'),
(7, 'The Whispering Winds', 2, '9783161484106', 'Elizabeth', 'Miller', 'A compelling drama about life, love, and the power of words.'),
(8, 'The Shattered Mirror', 3, '9783161484107', 'Charles', 'Wilson', 'A spellbinding mystery about a mirror that reveals more than just reflections.'),
(9, 'The Dream Weaver', 4, '9783161484108', 'Jessica', 'Moore', 'A mesmerizing fantasy novel about a weaver who can weave dreams into reality.'),
(10, 'The Final Frontier', 5, '9783161484109', 'William', 'Taylor', 'A riveting sci-fi novel about the last humans in a distant frontier of space.'),
(11, 'Eternal Shadow', 1, '9783161484110', 'Laura', 'Thompson', 'A haunting tale of ancient curses and eternal love.'),
(12, 'The Time Weaver', 2, '9783161484111', 'Richard', 'Martin', 'An engaging fantasy novel about a weaver who can manipulate time.'),
(13, 'The Crystal Prophecy', 3, '9783161484112', 'Sarah', 'Robinson', 'An epic adventure story about a prophecy that could change the world.'),
(14, 'The Forgotten Kingdom', 4, '9783161484113', 'George', 'Anderson', 'A thrilling tale about the rediscovery of a forgotten kingdom and its secrets.'),
(15, 'The Silent Stars', 5, '9783161484114', 'Sophia', 'Thomas', 'A captivating sci-fi novel about a crew exploring a silent and mysterious star system.'),
(16, 'The Hidden Echo', 1, '9783161484115', 'James', 'Harris', 'A suspenseful mystery novel about echoes from the past that could change the future.'),
(17, 'The Enchanted Forest', 2, '9783161484116', 'Anna', 'Jackson', 'A mesmerizing fantasy novel about a forest where fairy tales come to life.'),
(18, 'The Last Voyage', 3, '9783161484117', 'Henry', 'White', 'A gripping adventure novel about a perilous voyage into uncharted territories.'),
(19, 'The Ancient Cipher', 4, '9783161484118', 'Grace', 'Lewis', 'An intriguing mystery novel about a cipher that could reveal ancient secrets.'),
(20, 'The Starry River', 5, '9783161484119', 'Joseph', 'Jones', 'A riveting sci-fi novel about a river of stars that could lead to unknown civilizations.'),
(25, 'Sample Book', 19, '123', 'sample', 'sample', 'sample'),
(26, 'Book 1 : Chrisitan wars', 20, '234567890', 'ez', 'ez', 'Lablab');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `Category_Key` int(15) NOT NULL,
  `Category_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`Category_Key`, `Category_Name`) VALUES
(1, 'Fantasy'),
(2, 'Sci-Fi'),
(3, 'Mystery'),
(4, 'Thriller'),
(5, 'Romance'),
(6, 'Westerns'),
(7, 'Southern Gothic fiction'),
(10, 'Fiction'),
(11, 'Dystopian Fiction'),
(12, 'Classic Romance'),
(13, 'Coming-of-Age Fiction'),
(14, 'Jazz Age Fiction'),
(15, 'Philosophical Fiction'),
(19, 'Sample Category'),
(20, 'Christian Wars');

-- --------------------------------------------------------

--
-- Table structure for table `tblreview`
--

CREATE TABLE `tblreview` (
  `Review_ID` int(11) NOT NULL,
  `Book_Key` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Time` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Review` varchar(150) NOT NULL,
  `Rating` int(5) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreview`
--

INSERT INTO `tblreview` (`Review_ID`, `Book_Key`, `Username`, `Date`, `Time`, `Title`, `Review`, `Rating`, `Status`) VALUES
(15, 2, 'TestMod', '2023-05-13', '23:30:55', 'Decent', 'It\'s mid, All I can say is meh.', 3, 1),
(16, 3, 'TestMod', '2023-05-13', '23:31:38', 'Abracadabrah!', 'Amazing! Author, if I had daughters I\'d marry them all to you', 5, 1),
(17, 3, 'TestMod', '2023-05-13', '23:32:59', 'Magic?', 'It\'s a TOTAL Supah mAgic WORLD!! What Else can you ask forrrrr???', 5, 1),
(21, 5, 'mod', '2023-05-15', '08:14:18', 'qwdqwqedqweqeeqweqe', 'wewqeqwe', 1, 1),
(23, 2, 'mod', '2023-05-15', '09:29:19', 'This book is nice!', 'This book is nice!', 5, 1),
(24, 1, 'admin', '2023-05-21', '20:39:01', 'Wendylls gwapo', 'gwapo po', 5, 1),
(25, 26, 'admin', '2023-05-21', '20:40:59', 'Way lami', 'Pero tam is kaayu christian', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `userType` int(1) NOT NULL DEFAULT 0,
  `Email` varchar(30) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`Firstname`, `Lastname`, `Username`, `Password`, `userType`, `Email`, `Status`) VALUES
('admin', 'admin', 'admin', 'admin', 2, '', 0),
('mod', 'mod', 'mod', 'mod', 1, 'mod@gmail.com', 0),
('user1', 'user1', 'user1', 'user1', 0, 'sfdsfaedsaf@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbook`
--
ALTER TABLE `tblbook`
  ADD PRIMARY KEY (`Book_Key`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`Category_Key`);

--
-- Indexes for table `tblreview`
--
ALTER TABLE `tblreview`
  ADD PRIMARY KEY (`Review_ID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbook`
--
ALTER TABLE `tblbook`
  MODIFY `Book_Key` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `Category_Key` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblreview`
--
ALTER TABLE `tblreview`
  MODIFY `Review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
