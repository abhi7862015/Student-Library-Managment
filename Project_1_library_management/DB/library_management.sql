-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2022 at 08:12 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_details`
--

DROP TABLE IF EXISTS `book_details`;
CREATE TABLE IF NOT EXISTS `book_details` (
  `book_id` int(10) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(225) NOT NULL,
  `book_author_name` varchar(60) NOT NULL,
  `book_isbn_no` bigint(13) NOT NULL,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `book_isbn_no` (`book_isbn_no`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_details`
--

INSERT INTO `book_details` (`book_id`, `book_name`, `book_author_name`, `book_isbn_no`) VALUES
(1, 'The India Story	', 'Bimal Jalal', 1231231231231),
(2, 'Listen to Your Heart: The London Adventure', 'Ruskin Bond', 1231231231232),
(3, 'Business of Sports: The Winning Formula for Success', 'Vinit Karnik', 1231231231233),
(4, 'A Place Called Home', 'Preeti Shenoy', 1231231231234),
(5, 'Modi @20: Dreams Meeting Delivery', 'VP Venkaiah Naidu', 1231231231235);

-- --------------------------------------------------------

--
-- Table structure for table `issued_book_details`
--

DROP TABLE IF EXISTS `issued_book_details`;
CREATE TABLE IF NOT EXISTS `issued_book_details` (
  `issued_book_id` int(10) NOT NULL AUTO_INCREMENT,
  `book_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `is_returned` varchar(10) NOT NULL,
  `returned_date` datetime(6) DEFAULT NULL,
  `issued_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`issued_book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issued_book_details`
--

INSERT INTO `issued_book_details` (`issued_book_id`, `book_id`, `student_id`, `is_returned`, `returned_date`, `issued_date`) VALUES
(6, 2, 1, 'No', NULL, '2022-07-15 11:41:07.103371'),
(5, 5, 4, 'No', NULL, '2022-07-15 11:40:59.313293'),
(4, 2, 5, 'Yes', '2022-07-15 18:01:40.000000', '2022-07-15 11:39:53.520426');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

DROP TABLE IF EXISTS `student_details`;
CREATE TABLE IF NOT EXISTS `student_details` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(60) NOT NULL,
  `student_username` varchar(60) NOT NULL,
  `student_password` varchar(60) NOT NULL,
  `student_roll_no` int(10) NOT NULL,
  `student_phone_no` int(10) NOT NULL,
  `student_image_href_link` varchar(225) NOT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_username` (`student_username`),
  UNIQUE KEY `student_roll_no` (`student_roll_no`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`student_id`, `student_name`, `student_username`, `student_password`, `student_roll_no`, `student_phone_no`, `student_image_href_link`) VALUES
(1, 'Abhishek', 'abhi123', 'e10adc3949ba59abbe56e057f20f883e', 12, 1231231232, 'images.png'),
(2, 'Vimal', 'v1231', 'e10adc3949ba59abbe56e057f20f883e', 13, 1231231232, 'images.png'),
(3, 'Naman', 'namo123', 'e10adc3949ba59abbe56e057f20f883e', 1, 1231231232, 'images.png'),
(4, 'Aakash', 'mishra_123', '25f9e794323b453885f5181f1b624d0b', 2, 1231238978, 'images.png'),
(5, 'Rahul', 'rahulk123', 'fcea920f7412b5da7be0cf42b8c93759', 20, 1234561234, 'images.png'),
(6, 'Rahul', 'rahulk1234', 'fcea920f7412b5da7be0cf42b8c93759', 21, 1234561234, 'images.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
