-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 12:53 PM
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
-- Database: `library_managment_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `IssueBook` (IN `issuedid` BIGINT, IN `ISBNO` VARCHAR(16), IN `collegeid` VARCHAR(15), IN `issuedate` DATE, IN `duedate` DATE)   BEGIN
        DECLARE available_books INT;
        DECLARE user_due_books INT;
        
        -- Check if the user has any due books
        SELECT COUNT(*) INTO user_due_books 
        FROM issuedbook
        WHERE college_id = collegeid AND returned_date IS NULL;
        
        IF user_due_books > 5 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User has due books. Cannot issue more books.';
        END IF;
        
        -- Check if the book is available
        SELECT available_copies INTO available_books 
        FROM books 
        WHERE ISBN = ISBNO;
        
        IF available_books <= 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No available copies of this book.';
        END IF;
        
        -- Issue the book
        INSERT INTO issuedbook (issued_id, ISBN, college_id, issue_date, due_date) 
        VALUES (issuedid, ISBNO, collegeid, issuedate, duedate);

        -- Update available copies
        UPDATE books 
        SET borrowed_copies = borrowed_copies + 1,
        available_copies = available_copies - 1
        WHERE ISBN = ISBNO;
        
        COMMIT;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) NOT NULL,
  `book_id` bigint(20) NOT NULL,
  `ISBN` varchar(16) NOT NULL,
  `book_title` varchar(40) NOT NULL,
  `book_author` varchar(30) NOT NULL,
  `book_subject` varchar(30) NOT NULL,
  `total_copies` int(11) NOT NULL,
  `borrowed_copies` int(11) DEFAULT NULL,
  `available_copies` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_id`, `ISBN`, `book_title`, `book_author`, `book_subject`, `total_copies`, `borrowed_copies`, `available_copies`, `created_at`) VALUES
(1, 8935490557952030562, '0-8731-0650-4', 'The Legal Status of the Common Law', 'Jane Berriman', 'Business', 14, 2, 12, '2024-03-28 11:35:35'),
(3, 9223372036854775807, '0-5105-7104-2', 'The Rule Book: Building Blocks of Games', 'Jaakko Stenros', 'Computer Science', 75, -1, 76, '2024-03-28 11:40:26'),
(4, 74404281484325263, '0-8221-3720-8', 'Adaptive Middleware for the IoT', 'Patrick Felicia', 'Computer Science', 12, 0, 12, '2024-03-28 08:36:21'),
(5, 5709798920, '0-1573-1095-7', 'The Kubernetes Workshop', 'Zachary Arnold', 'Computer Science', 44, 0, 44, '2024-03-28 11:36:33'),
(6, 50517038389302, '0-7151-5757-4', 'Influence: The Psychology of Persuasion', 'Robert B. Cialdini', 'Psychology', 15, 0, 15, '2024-03-28 08:01:04'),
(8, 6434433782916, '0-3057-7356-9', 'M.Sc. Zoology', 'Anita Sehgal', 'Zoology', 5, 1, 4, '2024-03-28 11:19:38'),
(9, 9562568878, '0-6150-7386-7', 'Doughnut Economics: Think Like an Econom', 'Kate Raworth', 'Economics', 50, 0, 50, '2024-03-28 08:04:41'),
(10, 5755512549920, '0-7593-6776-0', 'Quantitative Technique for Dummies', 'Colin Beveridge', 'Mathematics', 5, 0, 5, '2024-03-28 11:36:33'),
(11, 8182, '0-7882-8742-7', 'Descriptive Statistics and Probability T', 'Robert Barks', 'Mathematics', 24, 0, 24, '2024-03-28 08:46:09'),
(12, 9767049773, '0-9778-3308-9', 'Principles and Techniques of Biochemistr', 'Andreas Hofmann', 'Biochemistry', 2, 0, 2, '2024-03-28 08:48:16'),
(13, 51720053007, '0-9850-4493-4', 'Chordate Zoology', 'S Chand', 'Zoology', 5, 0, 5, '2024-03-28 08:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `issuedbook`
--

CREATE TABLE `issuedbook` (
  `id` bigint(20) NOT NULL,
  `issued_id` bigint(20) NOT NULL,
  `ISBN` varchar(16) NOT NULL,
  `college_id` varchar(15) NOT NULL,
  `issue_date` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` datetime NOT NULL,
  `returned_date` datetime DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuedbook`
--

INSERT INTO `issuedbook` (`id`, `issued_id`, `ISBN`, `college_id`, `issue_date`, `due_date`, `returned_date`, `fine`, `created_at`) VALUES
(1, 6764, '0-8731-0650-4', '2071197', '2024-03-28 00:00:00', '2024-04-04 00:00:00', NULL, NULL, '2024-03-28 11:19:16'),
(2, 16032198616, '0-8731-0650-4', '2058695', '2024-03-28 00:00:00', '2024-04-04 00:00:00', NULL, NULL, '2024-03-28 11:19:28'),
(3, 722305899043961, '0-3057-7356-9', '2058695', '2024-03-28 00:00:00', '2024-04-04 00:00:00', NULL, NULL, '2024-03-28 11:19:38'),
(4, 696047, '0-7593-6776-0', '2459697', '2024-03-28 00:00:00', '2024-04-04 00:00:00', NULL, 0, '2024-03-28 11:19:50'),
(5, 2704457117348054, '0-1573-1095-7', '2459697', '2024-03-28 00:00:00', '2024-04-04 00:00:00', NULL, 0, '2024-03-28 11:19:58'),
(6, 973534650, '0-5105-7104-2', '2459697', '2024-03-16 00:00:00', '2024-03-23 00:00:00', '2024-03-28 00:00:00', 50, '2024-03-28 11:25:25'),
(7, 9223372036854775807, '0-8731-0650-4', '2060497', '2024-03-28 00:00:00', '2024-04-04 00:00:00', NULL, 0, '2024-03-28 11:26:00');

--
-- Triggers `issuedbook`
--
DELIMITER $$
CREATE TRIGGER `update_on_return` BEFORE UPDATE ON `issuedbook` FOR EACH ROW BEGIN
    DECLARE fine_amount DECIMAL(10, 2);
    DECLARE days_late INT;
    
    -- Update copies
    IF OLD.returned_date IS NULL AND NEW.returned_date IS NOT NULL THEN
        UPDATE books
        SET available_copies = available_copies + 1, borrowed_copies = borrowed_copies - 1
        WHERE ISBN = NEW.ISBN;
    END IF;
    
    -- Calculate the fine
    SET days_late = DATEDIFF(NEW.returned_date, NEW.due_date);
    
    IF days_late > 0 THEN
        SET fine_amount = days_late * 10; 
    ELSE
        SET fine_amount = 0;
    END IF;
    
    -- Set the fine_amount in the NEW row being updated
    SET NEW.fine = fine_amount;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `college_id` varchar(15) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_type`, `college_id`, `user_fname`, `user_lname`, `user_email`, `user_phone`, `password`, `created_at`) VALUES
(1, 1, 'Admin', '2364023', 'Prachi', 'Naik', 'admin@college.com', '123456795', 'admin@123', '2024-03-23 19:53:26'),
(2, 2, 'Admin', '2364024', 'Mahek', 'Shaikh', 'admin1@college.com', '1236547898', 'admin1@123', '2024-03-23 21:52:05'),
(6, 9223372036854775807, 'Faculty', '2071197', 'Shreya', 'Ghoshal', 'shreya@college.com', '1234569874', 'shreya', '2024-03-24 18:21:48'),
(7, 258039895897554129, 'Faculty', '2180298', 'Vernon', 'Chwe', 'vernon@college.com', '1234568745', 'vernon', '2024-03-24 18:22:52'),
(8, 379893587980636, 'Faculty', '2100495', 'Hermione', 'Granger', 'hermione@college.com', '1204536987', 'hermione', '2024-03-26 12:15:38'),
(9, 9562388273, 'Faculty', '2231103', 'Sarah', 'Vaz', 'sarah@college.com', '7845120369', 'sarah', '2024-03-26 12:16:18'),
(10, 39061493510342, 'Faculty', '2354295', 'John', 'Doe', 'john@college.com', '8456127858', 'john', '2024-03-28 10:52:04'),
(11, 5930025422434253, 'Student', '2058695', 'Ashley', 'Flowers', 'ashley@college.com', '8989475698', 'ashley', '2024-03-28 10:56:59'),
(12, 7691494352032968, 'Student', '2100696', 'Jade', 'Thirlwall', 'jade@college.com', '9898977589', 'jade', '2024-03-28 10:58:15'),
(13, 15099486029445640, 'Student', '2459697', 'Kunal', 'Khemu', 'kunal@college.com', '775896475', 'kunal', '2024-03-28 10:59:26'),
(14, 1386980844858095, 'Student', '2080696', 'Jun', 'Moon', 'jun@college.com', '9987879878', 'jun', '2024-03-28 11:00:25'),
(15, 682560427150, 'Student', '2190698', 'Vaishnavi', 'Nair', 'vaishnavi@college.com', '987541239', 'vaishnavi', '2024-03-28 11:01:36'),
(16, 32334607341, 'Student', '2211196', 'Jihoon', 'Lee', 'jihoon@college.com', '798410025', 'jihoon', '2024-03-28 11:02:42'),
(18, 5855069939758, 'Student', '2060497', 'Eunwoo', 'Cha', 'eunwoo@college.com', '987548126', 'eunwoo', '2024-03-28 11:04:51'),
(19, 72767623539869, 'Staff', '2151297', 'Jane', 'Doe', 'jane@college.com', '9896589658', 'jane', '2024-03-28 11:08:08'),
(20, 787659919, 'Staff', '21300103', 'Kahlil', 'Barretto', 'kahlil@college.com', '7785693210', 'kahlil', '2024-03-28 11:13:38');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_student_faculty`
-- (See below for the actual view)
--
CREATE TABLE `view_student_faculty` (
`user_type` varchar(10)
,`college_id` varchar(15)
,`user_fname` varchar(50)
,`user_lname` varchar(50)
,`user_email` varchar(30)
,`user_phone` varchar(10)
,`borrowed_books_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `view_student_faculty`
--
DROP TABLE IF EXISTS `view_student_faculty`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_student_faculty`  AS SELECT `u`.`user_type` AS `user_type`, `u`.`college_id` AS `college_id`, `u`.`user_fname` AS `user_fname`, `u`.`user_lname` AS `user_lname`, `u`.`user_email` AS `user_email`, `u`.`user_phone` AS `user_phone`, (select count(0) from `issuedbook` `i` where `i`.`college_id` = `u`.`college_id`) AS `borrowed_books_count` FROM `users` AS `u` WHERE `u`.`user_type` = 'Student' OR `u`.`user_type` = 'Faculty' ORDER BY `u`.`college_id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_id` (`book_id`);

--
-- Indexes for table `issuedbook`
--
ALTER TABLE `issuedbook`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `issued_id` (`issued_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `issuedbook`
--
ALTER TABLE `issuedbook`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
