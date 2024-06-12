-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 05:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookhub (2)`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`, `phone`, `address`, `photo`, `status`) VALUES
(1, 'DARSHAN UNAGAR', 'dhruvik', '123456', 'dhruvik@gmail.com', '9313951625', '2nd floor ,106, lalita chowkdi , katargam', 'bimg/dar2.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `allmessages`
--

CREATE TABLE `allmessages` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allmessages`
--

INSERT INTO `allmessages` (`id`, `sender_name`, `subject`, `message`, `attachment`, `sent_at`, `key`) VALUES
(1, 'dhruvik', 'sdsd', 'sdsdsdsdsd', 'finerecod (1).sql', '2024-03-11 14:46:57', 'y'),
(2, 'dhruvik', 'sdsd', 'sdsdsdsdsd', 'finerecod (1).sql', '2024-03-11 15:25:06', 'y'),
(3, 'dhruvik', 'file downlode', 'hii ', 'Unit_3.pdf', '2024-03-11 15:32:43', 'y'),
(4, 'dhruvik', 'file downlode', 'hii ', 'Unit_3.pdf', '2024-03-11 15:35:44', 'y'),
(5, 'dhruvik', 'ssd', 'sds', 'admin (2).sql', '2024-03-11 16:10:48', 'y'),
(6, 'dhruvik', '57', '5757', '', '2024-03-11 16:15:39', 'y'),
(7, 'dhruvik', '57', '5757', '', '2024-03-11 16:18:18', 'y'),
(8, 'dhruvik', '57', '5757', '', '2024-03-11 16:19:59', 'y'),
(9, 'dhruvik', '57', '5757', '', '2024-03-11 16:21:17', 'y'),
(10, 'dhruvik', '57', '5757', '', '2024-03-11 16:23:12', 'y'),
(11, 'dhruvik', '57', '5757', '', '2024-03-11 16:23:46', 'y'),
(12, 'dhruvik', '57', '5757', '', '2024-03-11 16:24:14', 'y'),
(13, 'dhruvik', '57', '5757', '', '2024-03-11 16:25:20', 'y'),
(14, 'dhruvik', 'vvxvv', 'aaa', '', '2024-03-11 18:13:07', 'y'),
(15, 'dhruvik', 'lagan', 'mara lagan', '2942_Google Quantum Computing.pdf', '2024-03-12 08:06:46', 'y'),
(16, 'dhruvik', 'lagan', 'mara lagan', '2942_Google Quantum Computing.pdf', '2024-03-12 08:07:38', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `authorname` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `name`, `categories`, `img`, `price`, `authorname`, `date`) VALUES
(11, 'dhruvik', 'bca', 'dhr.jpg', 0.00, 'adad', '2024-02-29'),
(12, 'dfsf', 'sdfs', 'data tabel.jpg', 0.00, '', '0000-00-00'),
(13, '10', 'bca', 'blue-black-muscle-car-with-license-plate-that-says-trans-front.jpg', 500.00, 'dhruvik', '2024-03-05'),
(14, 'KALOTAR ', 'ABC', '7903737.jpg', 152.00, 'SADDF', '2024-03-09'),
(15, 'c++', 'bca', '5ebaa3080bb0327177a67d697223498a41GxQsLNarL._SX328_BO1,204,203,200_.jpg', 500.00, 'asas', '2024-03-09'),
(16, 'sa', 'aa', '1568426481.jpg', 121.00, 'asa', '2024-03-09'),
(17, 'aa', 'asa', 'admin.jpg', 1212.00, 'sasa', '2024-03-09'),
(18, 'asa', 'sa', 'blue-black-muscle-car-with-license-plate-that-says-trans-front.jpg', 343.00, 'rtt', '2024-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

CREATE TABLE `book_requests` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `lid` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_url` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `key` varchar(1) NOT NULL DEFAULT 'n',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_requests`
--

INSERT INTO `book_requests` (`id`, `student_name`, `lid`, `book_name`, `book_url`, `author_name`, `key`, `date_created`, `email`) VALUES
(1, 'dhruvik', 123, 'dasfs', 'faf', 'faf', 'y', '2024-03-11 17:16:39', 'john.doe@example.com'),
(2, 'dhruvik', 123, 'dasfs', 'asa', 'asasas', 'y', '2024-03-11 17:44:50', 'john.doe@example.com'),
(3, 'dhruvik', 123, 'dasfs', 'asa', 'asasas', 'y', '2024-03-11 17:46:41', 'john.doe@example.com'),
(4, 'dhruvik', 123, 'dasd', 'not avelabl', 'asdad', 'y', '2024-03-11 17:47:43', 'john.doe@example.com'),
(5, 'dhruvik', 123, 'dasd', 'not avelabl', 'asdad', 'y', '2024-03-11 17:55:18', 'john.doe@example.com'),
(6, 'dhruvik', 123, 'sas', 'sas', 'asa', 'y', '2024-03-11 17:56:17', 'john.doe@example.com'),
(7, 'dhruvik', 123, 'asas', 'sasasa', 'asas', 'y', '2024-03-11 17:58:30', 'john.doe@example.com'),
(8, 'dhruvik', 123, 'asas', 'sasasa', 'asas', 'y', '2024-03-11 18:09:25', 'john.doe@example.com'),
(9, 'dhruvik', 123, 'rt', 'rt', 'rytyr', 'y', '2024-03-11 18:27:49', 'john.doe@example.com'),
(10, 'dhruvik', 123, 'trwtrt', 'sgsgsg', 'tggsgs', 'y', '2024-03-11 18:28:07', 'john.doe@example.com'),
(11, 'dhruvik', 123, 'sas', 'asa', 'assasa', 'y', '2024-03-11 18:31:49', 'john.doe@example.com'),
(12, 'dhruvik', 123, 'dasfs', 'gsg', 'dfg', 'y', '2024-03-11 18:36:10', 'john.doe@example.com'),
(13, 'dhruvik', 123, 'asasasas', 'asa', 'asaasa', 'y', '2024-03-11 18:38:24', 'john.doe@example.com'),
(14, 'dhruvik', 123, 'fgdgdsg', 'sggsg', 'sggfs', 'y', '2024-03-11 18:41:18', 'john.doe@example.com'),
(15, 'dhruvik', 123, 'asasa', 'asasa', 'saa', 'y', '2024-03-12 07:51:05', 'john.doe@example.com'),
(16, 'dhruvik', 123, 'asasa', 'asasa', 'saa', 'y', '2024-03-12 07:51:16', 'john.doe@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `clgstudent`
--

CREATE TABLE `clgstudent` (
  `cid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `dept` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clgstudent`
--

INSERT INTO `clgstudent` (`cid`, `name`, `gender`, `address`, `email`, `phone`, `sem`, `dept`) VALUES
(101, 'dhruvik', 'Male', '123 Main St', 'john.doe@example.com', '1234567890', '1', 'bca'),
(102, 'Jane Doe', 'Female', '456 Elm St', 'jane.doe@example.com', '0987654321', '2', 'bba'),
(103, 'Alice Smith', 'Female', '789 Oak St', 'alice.smith@example.com', '1112223333', '3', 'bca'),
(104, 'Bob Johnson', 'Male', '321 Pine St', 'bob.johnson@example.com', '4445556666', '1', 'bcom'),
(105, 'Eve Wilson', 'Female', '654 Birch St', 'eve.wilson@example.com', '7778889999', '2', 'bba'),
(106, 'Charlie Brown', 'Male', '987 Maple St', 'charlie.brown@example.com', '2223334444', '3', 'bca'),
(107, 'Grace Lee', 'Female', '135 Cherry St', 'grace.lee@example.com', '5556667777', '1', 'bcom'),
(108, 'Sam Green', 'Male', '246 Walnut St', 'sam.green@example.com', '8889990000', '2', 'bba'),
(109, 'Lily Davis', 'Female', '579 Cedar St', 'lily.davis@example.com', '3334445555', '3', 'bca'),
(110, 'Tom Wilson', 'Male', '864 Ash St', 'tom.wilson@example.com', '6667778888', '1', 'bcom');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courcid` int(11) NOT NULL,
  `courcename` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `faculty` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courcid`, `courcename`, `img`, `description`, `duration`, `fee`, `date`, `faculty`) VALUES
(1, 'Course 1', 'image1.jpg', 'Description 1', '2 months', 100.00, '2024-03-12', 'Faculty A'),
(2, 'Course 2', 'image2.jpg', 'hiii', '3 months', 150.00, '2024-03-15', 'Faculty B');

-- --------------------------------------------------------

--
-- Table structure for table `finerecod`
--

CREATE TABLE `finerecod` (
  `id` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `library_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `issued_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fine_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paydate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finerecod`
--

INSERT INTO `finerecod` (`id`, `bookid`, `student_name`, `library_id`, `email`, `phone`, `issued_date`, `return_date`, `fine_date`, `amount`, `paydate`) VALUES
(1, 0, '', '', '', '', '0000-00-00', '0000-00-00', '2024-03-05', 100.00, '2024-03-05'),
(2, 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 0.00, '2024-03-05'),
(3, 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 0.00, '2024-03-05'),
(4, 11, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-05', '2024-02-29', '2024-03-05', 100.00, '2024-03-05'),
(5, 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 0.00, '2024-03-05'),
(6, 0, '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 0.00, '2024-03-05'),
(7, 11, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-05', '2024-02-29', '2024-03-05', 100.00, '2024-03-05'),
(8, 13, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-05', '2024-03-02', '2024-03-05', 100.00, '2024-03-05'),
(9, 13, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-05', '2024-03-02', '2024-03-05', 100.00, '2024-03-05'),
(10, 11, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-30', '2024-02-28', '2024-03-05', 100.00, '2024-03-05'),
(11, 0, '', '', '', '', '0000-00-00', '0000-00-00', '2024-03-05', 100.00, '2024-03-05'),
(12, 0, '', '', '', '', '0000-00-00', '0000-00-00', '2024-03-05', 100.00, '2024-03-05'),
(13, 12, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-05', '2024-02-26', '2024-03-05', 100.00, '2024-03-05'),
(14, 11, 'dhruvik', '123', 'john.doe@example.com', '1234567890', '2024-03-06', '2024-03-05', '2024-03-06', 100.00, '2024-03-07'),
(15, 11, 'dhruvik', '123', 'john.doe@example.com', '1234567890', '2024-03-06', '2024-03-05', '2024-03-06', 100.00, '2024-03-07'),
(16, 11, 'dhruvik', '123', 'john.doe@example.com', '1234567890', '2024-03-07', '2024-03-01', '2024-03-07', 100.00, '2024-03-07'),
(17, 11, 'dhruvik', '123', 'john.doe@example.com', '1234567890', '2024-03-07', '2024-03-01', '2024-03-07', 100.00, '2024-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `issuedbook`
--

CREATE TABLE `issuedbook` (
  `issueid` int(11) NOT NULL,
  `bookid` int(11) DEFAULT NULL,
  `bookname` varchar(255) DEFAULT NULL,
  `idate` date DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `studname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `lid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuedbook`
--

INSERT INTO `issuedbook` (`issueid`, `bookid`, `bookname`, `idate`, `rdate`, `studname`, `email`, `phone`, `lid`) VALUES
(1, 101, 'Book 1', '2024-03-15', '2024-04-15', 'John Doe', 'john@example.com', '123456789', 'LID001');

-- --------------------------------------------------------

--
-- Table structure for table `issurecord`
--

CREATE TABLE `issurecord` (
  `issueid` int(11) NOT NULL,
  `bookid` int(11) DEFAULT NULL,
  `bookname` varchar(255) DEFAULT NULL,
  `idate` date DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `studname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `lid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issurecord`
--

INSERT INTO `issurecord` (`issueid`, `bookid`, `bookname`, `idate`, `rdate`, `studname`, `email`, `phone`, `lid`) VALUES
(1, 11, NULL, '2024-03-05', '2024-03-20', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(2, 12, '2024-03-05', '0000-00-00', '2024-03-20', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(3, 12, 'dfsf', '2024-03-05', '2024-03-20', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(4, 11, 'dhruvik', '2024-03-05', '2024-02-28', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(5, 11, 'dhruvik', '2024-03-05', '2024-02-29', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(6, 11, 'dhruvik', '2024-03-05', '2024-03-20', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(7, 13, '10', '2024-03-05', '2024-03-20', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(8, 13, '10', '2024-03-05', '2024-03-02', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(9, 11, 'dhruvik', '2024-03-30', '2024-02-28', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(10, 11, 'dhruvik', '2024-03-05', '2024-03-20', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(11, 12, 'dfsf', '2024-03-05', '2024-02-26', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(12, 11, 'dhruvik', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(13, 11, 'dhruvik', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(14, 11, 'dhruvik', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(15, 13, '10', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 123),
(16, 11, 'dhruvik', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 123),
(17, 12, 'dfsf', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 123),
(18, 13, '10', '2024-03-06', '2024-03-09', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(19, 11, 'dhruvik', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(20, 11, 'dhruvik', '2024-03-06', '2024-03-05', 'dhruvik', 'john.doe@example.com', '1234567890', 123),
(21, 12, 'dfsf', '2024-03-06', '2024-03-21', 'dhruvik', 'john.doe@example.com', '1234567890', 123),
(22, 11, 'dhruvik', '2024-03-07', '2024-03-01', 'dhruvik', 'john.doe@example.com', '1234567890', 123),
(23, 11, 'dhruvik', '2024-03-07', '2024-02-28', 'dhruvik', 'john.doe@example.com', '1234567890', 33),
(24, 12, 'dfsf', '2024-03-09', '2024-03-24', 'dhruvik', 'john.doe@example.com', '1234567890', 123);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(50) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `KEY` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_name`, `receiver_id`, `message`, `sent_at`, `KEY`) VALUES
(25, 'dhruvik', 123, 'you not a pay fine pay a fine another library take legal actiob', '2024-03-10 17:19:58', 'y'),
(26, 'dhruvik', 123, 'kaklotar dhruvik narnbhai', '2024-03-10 18:12:05', 'y'),
(27, 'dhruvik', 1, 'dhruvik\r\nkaklotar \r\naapde javanuc hene val', '2024-03-11 13:47:37', 'y'),
(28, 'dhruvik', 123, 'dhruvik', '2024-03-11 13:47:46', 'y'),
(29, 'dhruvik', 123, 'dhruvik kaklotar narabhai\r\nkaklotar h\r\njakjaf\r\najfakf', '2024-03-11 13:48:25', 'y'),
(30, 'dhruvik', 123, 'sasa', '2024-03-11 16:04:44', 'y'),
(31, 'dhruvik', 123, 'your book requst accpted our library work on it ', '2024-03-11 18:09:19', 'y'),
(32, 'dhruvik', 1, 'juuurur', '2024-03-12 07:51:13', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `studentname` varchar(255) DEFAULT NULL,
  `lid` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bookname` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `payment_id`, `date`, `studentname`, `lid`, `address`, `contact`, `email`, `bookname`, `author`, `price`) VALUES
(1, 13, 0, '2024-03-12', '', '', '', '', '', '10', NULL, NULL),
(2, 14, 0, '2024-03-12', 'Jane Doe', '1', '456 Elm St', '0987654321', 'jane.doe@example.com', 'KALOTAR ', NULL, NULL),
(3, 14, 0, '2024-03-12', 'Jane Doe', '1', '456 Elm St', '0987654321', 'jane.doe@example.com', 'KALOTAR ', '', 152.00),
(4, 14, 0, '2024-03-12', 'Jane Doe', '1', '456 Elm St', '0987654321', 'jane.doe@example.com', 'KALOTAR ', 'SADDF', 152.00);

-- --------------------------------------------------------

--
-- Table structure for table `pfine`
--

CREATE TABLE `pfine` (
  `id` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `library_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `issued_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fine_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pfine`
--

INSERT INTO `pfine` (`id`, `bookid`, `student_name`, `library_id`, `email`, `phone`, `issued_date`, `return_date`, `fine_date`, `amount`) VALUES
(23, 11, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-07', '2024-02-28', '2024-03-07', 100.00),
(24, 11, 'dhruvik', '33', 'john.doe@example.com', '1234567890', '2024-03-07', '2024-02-28', '2024-03-07', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `reg_student`
--

CREATE TABLE `reg_student` (
  `cid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `dept` varchar(10) NOT NULL,
  `lid` int(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `rdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_student`
--

INSERT INTO `reg_student` (`cid`, `name`, `gender`, `address`, `email`, `phone`, `sem`, `dept`, `lid`, `password`, `photo`, `rdate`) VALUES
(102, 'Jane Doe', 'Female', '456 Elm St', 'jane.doe@example.com', '0987654321', '2', 'bba', 1, '2', '', '2024-03-29'),
(101, 'dhruvik', 'Male', '123 Main St', 'john.doe@example.com', '1234567890', '1', 'bca', 123, '123', '', '2024-03-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allmessages`
--
ALTER TABLE `allmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courcid`);

--
-- Indexes for table `finerecod`
--
ALTER TABLE `finerecod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuedbook`
--
ALTER TABLE `issuedbook`
  ADD PRIMARY KEY (`issueid`);

--
-- Indexes for table `issurecord`
--
ALTER TABLE `issurecord`
  ADD PRIMARY KEY (`issueid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pfine`
--
ALTER TABLE `pfine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allmessages`
--
ALTER TABLE `allmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `finerecod`
--
ALTER TABLE `finerecod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `issuedbook`
--
ALTER TABLE `issuedbook`
  MODIFY `issueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `issurecord`
--
ALTER TABLE `issurecord`
  MODIFY `issueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pfine`
--
ALTER TABLE `pfine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
