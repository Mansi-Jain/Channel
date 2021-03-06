-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 14, 2017 at 02:58 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogger_info`
--

CREATE TABLE `blogger_info` (
  `blogger_id` int(11) NOT NULL,
  `blogger_firstname` varchar(20) NOT NULL,
  `blogger_username` varchar(255) NOT NULL,
  `blogger_password` varchar(255) NOT NULL,
  `blogger_creation_date` date NOT NULL,
  `blogger_is_active` tinyint(1) NOT NULL,
  `blogger_updated_Date` date DEFAULT NULL,
  `blogger_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogger_info`
--

INSERT INTO `blogger_info` (`blogger_id`, `blogger_firstname`, `blogger_username`, `blogger_password`, `blogger_creation_date`, `blogger_is_active`, `blogger_updated_Date`, `blogger_end_date`) VALUES
(4, 'Mansi', 'mansi', 'mansi', '2017-07-31', 1, NULL, NULL),
(6, 'Hith', 'hith', 'hith', '2017-08-01', 1, NULL, NULL),
(7, 'Kritika', 'kritika', 'kritika', '2017-08-02', 1, NULL, NULL),
(8, 'Utsav', 'utsav', 'utsav', '2017-08-04', 1, NULL, NULL),
(9, 'Arpan', 'arpan', 'arpan', '2017-08-07', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_detail`
--

CREATE TABLE `blog_detail` (
  `blog_Detail_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `blog_detail_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `contactlist`
--

CREATE TABLE `contactlist` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_detail`
--

INSERT INTO `blog_detail` (`blog_Detail_id`, `blog_id`, `blog_detail_image`) VALUES
(24, 34, 'images/mistake.jpg'),
(25, 35, 'images/can-stock-photo_csp29972583.jpg'),
(26, 36, 'images/download.jpg'),
(27, 37, 'images/download (1).jpg'),
(28, 38, 'images/download (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_master`
--

CREATE TABLE `blog_master` (
  `blog_id` int(11) NOT NULL,
  `blogger_id` int(11) NOT NULL,
  `blog_title` varchar(100) NOT NULL,
  `blog_desc` varchar(10000) NOT NULL,
  `blog_category` varchar(100) NOT NULL,
  `blog_author` varchar(50) NOT NULL,
  `blog_is_active` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL,
  `updated_date` date DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0';
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `blog_id` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `blog_master`
--

INSERT INTO `blog_master` (`blog_id`, `blogger_id`, `blog_title`, `blog_desc`, `blog_category`, `blog_author`, `blog_is_active`, `creation_date`, `updated_date`) VALUES
(35, 6, 'Incomplete Tasks!', '      We do compare!\r\nYes! We compare our success, wealth, marks, and the list is very long. What it brings in our mind is Negativity , and even sometimes hinders us from the happiness of our own achievements.\r\nWhat we need to do is, we need to compare the amount of time, effort given by that person in achieving particular success. Then ask yourself, did I invested same amount of time on that field ? Sometimes what happens is we were comparing ourselves with one who had achieved success in the field, which is of not our interest even! Itâ€™s like an engineer comparing his success with a doctor !', 'Philosophy', 'Hith', 1, '2017-08-12', '2017-08-14'),
(36, 6, 'Donald Trump', '  In July, Donald Trump did something extraordinary even for him: He called on a foreign power to launch an espionage operation against his chief political opponent, hacking into Hillary Clintonâ€™s email server to find 30,000 emails she allegedly deleted.\r\n\r\n&quot;Russia, if youâ€™re listening, I hope youâ€™re able to find the 30,000 emails that are missing,&quot; Trump said. &quot;I think you will probably be rewarded mightily by our press.&quot;\r\n\r\nWhen Trump said it, it didnâ€™t sound like a joke â€�? especially in light of recent events. Just before Trump&#039;s comment, WikiLeaks released about 19,000 emails that were stolen from the DNC servers by hackers who were almost certainly linked to the Russian state. These emails included talk of a (never-realized) plot to attack Bernie Sanders on his religion, a revelation that exacerbated divisions inside the Democratic Party and thus seemingly helped Trumpâ€™s political chances.\r\n\r\nAll of this raises one big question: What the hell is going on with Trump and Russia?\r\n\r\nThe answer appears to be twofold. First, the Kremlin appears to be interfering in the US election in a way likely to help Trump become president. Whether or not thatâ€™s the intent of the meddling, that is the result.\r\n\r\nSecond, Trump is deeply, weirdly pro-Russian.\r\n\r\nTrumpâ€™s proposed foreign policy would, intentionally or no, aid Vladimir Putin in ways the Russian dictator could only dream about before Trump. Trump has repeatedly expressed wild admiration for Putin personally; his campaign staff and businesses have extensive ties to Russian interests. (Just yesterday, the New York Times reported the existence of a handwritten ledger documenting $12.7 million in payments to Trump&#039;s campaign manager, Paul Manafort, from Ukraine&#039;s pro-Russian deposed president, Viktor Yanukovych).', 'Politics', 'hith', 1, '2017-08-15', '2017-08-21'),
(37, 7, 'Hilary Clinton', '    When Hillary Clinton was elected to the U.S. Senate in 2001, she became the first American first lady to ever win a public office seat. She later became the 67th U.S. secretary of state in 2009, serving until 2013. In 2016, she became the first woman in U.S. history to become the presidential nominee of a major political party.\r\n\r\nHillary Diane Clinton was born Hillary Diane Rodham on October 26, 1947, in Chicago, Illinois. She was raised in Park Ridge, Illinois, a picturesque suburb located 15 miles northwest of downtown Chicago.\r\n\r\nHillary Rodham was the eldest daughter of Hugh Rodham, a prosperous fabric store owner, and Dorothy Emma Howell Rodham; she has two younger brothers, Hugh Jr. (born 1950) and Anthony (born 1954).', 'Politics', 'kritika', 1, '2017-08-20', '2017-08-21'),
(38, 9, 'Sachin Tendulkar', 'Sachin Tendulkar was born April 24, 1973, in Bombay, India. Introduced to cricket at age 11, Tendulkar was just 16 when he became India&#039;s youngest Test cricketer. In 2005, he became the first cricketer to score 35 centuries (100 runs in a single inning) in Test play. In 2008, he reached another major milestone by surpassing Brian Lara&#039;s mark of 11,953 Test runs. Tendulkar took home the World Cup with his team in 2011, and wrapped up his record-breaking career in 2013.\r\n\r\nLargely considered cricket&#039;s greatest batsman, Sachin Tendulkar was born April 24, 1973, in Bombay, India, to a middle-class family, the youngest of four children. His father was a writer and a professor, while his mother worked for a life insurance company.\r\n\r\nNamed after his family&#039;s favorite music director, Sachin Dev Burman, Tendulkar wasn&#039;t a particularly gifted student, but he&#039;d always shown himself to be a standout athlete. He was 11 years old when he was given his first cricket bat, and his talent in the sport was immediately apparent. At the age of 14, he scored 326 out of a world-record stand of 664 in a school match. As his accomplishments grew, he became a sort of cult figure among Bombay schoolboys.\r\n\r\n', 'Sports', 'Arpan', 1, '2017-08-24', '2017-08-25'),
(39, 4, 'Mistakes', '                We are committing many mistakes unknowingly, but they prove to be very destructive in future. Even if we have knowledge about that mistakes, we will commit it, because itâ€™s basic human nature. So whatâ€™s the solution for these mistakes? The solution is, we need to change our view towards that mistakes(more on that later). Many such mistakes are:\r\n\r\nWe do compare!\r\nYes! We compare our success, wealth, marks, and the list is very long. What it brings in our mind is Negativity , and even sometimes hinders us from the happiness of our own achievements.\r\nWhat we need to do is, we need to compare the amount of time, effort given by that person in achieving particular success. Then ask yourself, did I invested same amount of time on that field ? Sometimes what happens is we were comparing ourselves with one who had achieved success in the field, which is of not our interest even! Itâ€™s like an engineer comparing his success with a doctor !', 'Philosophy', ',mansi', 1, '2017-08-26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_name` varchar(255) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_name`, `creation_date`) VALUES
('Identity card.pdf', '2017-03-14'),
('bonafide.pdf', '2017-03-14'),
('Vatsal-Sodha_resume.pdf', '2017-03-14'),
('transcript.pdf', '2017-03-14'),
('cover-letter.doc', '2017-03-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogger_info`
--
ALTER TABLE `blogger_info`
  ADD PRIMARY KEY (`blogger_id`);

--
-- Indexes for table `contactlist`
--
ALTER TABLE `contactlist`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `blog_detail`
--
ALTER TABLE `blog_detail`
  ADD PRIMARY KEY (`blog_Detail_id`),
  ADD KEY `blog_id` (`blog_id`);


--
-- Indexes for table `blog_master`
--
ALTER TABLE `blog_master`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `blogger_id` (`blogger_id`);


--
-- Indexes for table `blog_detail`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogger_info`
--
ALTER TABLE `blogger_info`
  MODIFY `blogger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


--
-- AUTO_INCREMENT for table `contactlist`
--
ALTER TABLE `contactlist`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;


--
-- AUTO_INCREMENT for table `blogger_info`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;


--
-- AUTO_INCREMENT for table `blog_detail`
--
ALTER TABLE `blog_detail`
  MODIFY `blog_Detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `blog_master`
--
ALTER TABLE `blog_master`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_detail`
--
ALTER TABLE `blog_detail`
  ADD CONSTRAINT `blog_detail_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog_master` (`blog_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog_master` (`blog_id`);

--
-- Constraints for table `blog_master`
--
ALTER TABLE `blog_master`
  ADD CONSTRAINT `blog_master_ibfk_1` FOREIGN KEY (`blogger_id`) REFERENCES `blogger_info` (`blogger_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
