-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2017 at 05:56 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_time` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `content`, `author_id`, `date_time`) VALUES
(4, 4, 'heyyaaa', 27, '2017-04-16 09:51:17'),
(5, 4, 'jhhhgdfh', 27, '2017-04-16 10:17:12'),
(6, 4, 'fdjhdfghdfjd', 27, '2017-04-16 10:17:21'),
(7, 4, 'smdbjhsdhjsd', 27, '2017-04-16 10:17:27'),
(8, 4, 'dsmnbfjdbjsdh', 27, '2017-04-16 10:17:36'),
(9, 4, 'dsfjkdddf', 27, '2017-04-16 10:17:47'),
(12, 8, 'hello there\r\n', 27, '2017-04-20 14:30:49'),
(13, 7, 'nice click', 27, '2017-04-20 15:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`user_id`, `friend_id`) VALUES
(26, 27),
(27, 26),
(27, 28),
(27, 29),
(27, 30),
(27, 32),
(27, 33),
(28, 27),
(29, 27),
(30, 27),
(32, 27),
(33, 27);

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like_unlike`
--

CREATE TABLE `like_unlike` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `type` int(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_unlike`
--

INSERT INTO `like_unlike` (`id`, `userid`, `postid`, `type`, `timestamp`) VALUES
(3, 27, 5, 0, '2017-04-20 01:56:16'),
(4, 27, 4, 1, '2017-06-03 15:48:41'),
(5, 30, 2, 1, '2017-04-20 07:50:13'),
(6, 30, 6, 1, '2017-04-20 07:58:15'),
(7, 30, 7, 1, '2017-04-20 08:16:07'),
(8, 27, 8, 1, '2017-04-20 08:12:45'),
(9, 30, 8, 1, '2017-04-20 08:08:23'),
(10, 27, 7, 1, '2017-06-03 15:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `user_id`, `text`, `sender_id`, `sender_email`) VALUES
(0, 29, 'bhumika', 27, 'anamikap24@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `post_Content` varchar(30000) NOT NULL,
  `Content` varchar(2000) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_time` varchar(2000) NOT NULL,
  `num_comment` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `post_Content`, `Content`, `image`, `author_id`, `date_time`, `num_comment`, `num_likes`) VALUES
(4, 'hello kem cho?', 'bhumika bhumika@gmail.com hello kem cho? slider4.jpg now()', 'slider4.jpg', 29, '2017-04-16 04:08:54', 6, 1),
(5, 'whats up!', 'Anamika anamika@gmail.com whats up! p2.jpg now()', 'p2.jpg', 26, '2017-04-16 04:10:24', 0, 0),
(7, 'awsom click... nice mood', 'Sameer sameer@gmail.com awsom click... nice mood p2.jpg now()', 'p2.jpg', 30, '2017-04-20 13:32:04', 1, 2),
(8, 'candid moment', 'Anamika anamikap24@gmail.com candid moment 1.jpg now()', '1.jpg', 27, '2017-04-20 13:37:13', 1, 2),
(9, 'modern day celebration !!', 'Anamika anamikap24@gmail.com modern day celebration !! p1.jpg now()', 'p1.jpg', 27, '2017-04-20 14:14:49', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Content` varchar(2000) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `CreationDate` date NOT NULL,
  `UpdatedDate` date NOT NULL,
  `IsAdmin` int(10) NOT NULL,
  `Profile_Pic` varchar(2000) NOT NULL,
  `Cover_Pic` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Username`, `Email`, `Password`, `Content`, `Gender`, `CreationDate`, `UpdatedDate`, `IsAdmin`, `Profile_Pic`, `Cover_Pic`) VALUES
(26, 'Anamika', 'anamika@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Anamika anamika@gmail.com Female', 'Female', '2017-04-01', '2017-04-01', 0, 't2.jpg', 'p3.jpg'),
(27, 'Anamika', 'anamikap24@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Anamika anamikap24@gmail.com Female', 'Female', '2017-04-01', '2017-04-01', 0, 't3.jpg', '2.jpg'),
(28, 'aaaaa', 'aa@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'aaaaa aa@gmail.com Female', 'Female', '2017-04-01', '2017-04-01', 0, 'r2.jpg', 'g6.jpg'),
(29, 'bhumika', 'bhumika@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'bhumika bhumika@gmail.com Female', 'Female', '2017-04-01', '2017-04-01', 0, 't4.jpg', '1.jpg'),
(30, 'Sameer', 'sameer@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Sameer sameer@gmail.com Male', 'Male', '2017-04-16', '2017-04-16', 0, 't1.jpg', 'g7.jpg'),
(31, 'mohnish', 'mohnish@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'mohnish mohnish@gmail.com Male', 'Male', '2017-04-16', '2017-04-16', 0, 'default_pic.jpg', 'default-cover.png'),
(32, 'Monu', 'monu@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Monu Patel monu@gmail.com Male', 'Male', '2017-04-16', '2017-04-16', 0, 'default_pic.jpg', 'default-cover.png'),
(33, 'bhumi', 'bhumi@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'bhumi bhumi@gmail.com Female', 'Female', '2017-04-16', '2017-04-16', 0, 'default_pic_girl.jpg', 'default-cover.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`user_id`,`friend_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `like_unlike`
--
ALTER TABLE `like_unlike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `friends_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`UserId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
