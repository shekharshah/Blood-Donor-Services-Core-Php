-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2019 at 07:06 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.12-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_donor`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `AREA_ID` int(11) NOT NULL,
  `CITY_ID` int(11) NOT NULL,
  `STATE_ID` int(11) NOT NULL,
  `AREA_NAME` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`AREA_ID`, `CITY_ID`, `STATE_ID`, `AREA_NAME`) VALUES
(1, 1, 1, 'Satellite'),
(2, 1, 1, 'Bodakdev'),
(5, 1, 1, 'Maninagar'),
(6, 1, 1, 'Sattadar'),
(7, 1, 1, 'Ghatlodia'),
(8, 1, 1, 'Vasna'),
(10, 1, 1, 'RTO'),
(11, 1, 1, 'Chankheda'),
(12, 1, 1, 'Sola'),
(13, 1, 1, 'Bopal'),
(14, 1, 1, 'South Bopal'),
(15, 1, 1, 'Sarkhej'),
(16, 1, 1, 'Makarba'),
(17, 1, 1, 'Anandnagar'),
(18, 1, 1, 'Prahladnagar'),
(19, 1, 1, 'Jodhpur'),
(20, 1, 1, 'Ambavadi'),
(21, 1, 1, 'Paldi'),
(22, 1, 1, 'Ashram Road'),
(23, 1, 1, 'Shyamal'),
(24, 1, 1, 'Nehrunagar'),
(25, 1, 1, 'C.G Road'),
(26, 1, 1, 'Panjrapol'),
(27, 1, 1, 'Mithakhali');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor_register`
--

CREATE TABLE `blood_donor_register` (
  `donor_id` int(11) NOT NULL,
  `donor_name` varchar(150) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `blood_type` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `body_weight` varchar(11) DEFAULT NULL,
  `email_id` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `confirm_pass` varchar(50) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `state` varchar(150) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `address` text,
  `pincode` int(11) DEFAULT NULL,
  `contact_1` text,
  `contact_2` text,
  `last_donate_blood` date DEFAULT NULL,
  `donor_pic` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_donor_register`
--

INSERT INTO `blood_donor_register` (`donor_id`, `donor_name`, `gender`, `blood_type`, `dob`, `body_weight`, `email_id`, `password`, `confirm_pass`, `country`, `state`, `city`, `address`, `pincode`, `contact_1`, `contact_2`, `last_donate_blood`, `donor_pic`, `status`) VALUES
(43, 'Chirag Ghevariya', 'Male', 'O-', '1988-05-10', '95', 'chirag@gmail.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'India', 'Gujarat', 'Ahmedabad', 'Lorem voluptatibus esse qui veritatis laborum exercitationem pariatur Veniam', 898989, '8908908900', '', '2018-12-12', 'donor_images/noimage.jpg', 1),
(45, 'Shekhar Shah', 'Male', 'O+', '1996-10-22', '29', 'shahshekhar54@gmail.com', '6d3108c3f3168481c6fbe33833e2010e', '6d3108c3f3168481c6fbe33833e2010e', 'India', 'Gujarat', 'Ahmedabad', '304 - Samyak Complex, Opp- Rosewood Estate, Lotus School Road, Jodhpur, Satellite', 380015, '8460283985', '9825051280', NULL, 'donor_images/abc.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blood_stock`
--

CREATE TABLE `blood_stock` (
  `id` int(11) NOT NULL,
  `donor_name` varchar(20) NOT NULL,
  `blood_type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `blood_campaign` varchar(20) NOT NULL,
  `doctor_info` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Available',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_stock`
--

INSERT INTO `blood_stock` (`id`, `donor_name`, `blood_type`, `quantity`, `blood_campaign`, `doctor_info`, `status`, `date`) VALUES
(4, 'Sanjay Dhakal', 'B+', 12, 'Emla Blood Campaign', 'Sanjay Dhakal MBBS', 'Available', '2018-08-28'),
(5, 'Sulav Lovely', 'A+', 50, 'Save Small Life Camp', 'Sanjay Dhakal MBBS', 'Available', '2018-08-08'),
(6, 'Pukar', 'B+', 19, 'Emla Blood Campaign', 'Sanish Grg', 'Not Available', '2018-08-08'),
(7, 'Sudip Tiwari', 'AB+', 12, 'Save Small Life Camp', 'Raju Man bahadur', 'Available', '2018-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `camp_name` varchar(50) NOT NULL,
  `camp_org_name` varchar(20) NOT NULL,
  `camp_address` text NOT NULL,
  `camp_area` varchar(150) NOT NULL,
  `camp_city` varchar(150) NOT NULL,
  `camp_org_number` varchar(11) NOT NULL,
  `camp_date` date NOT NULL,
  `camp_time` text NOT NULL,
  `camp_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `camp_name`, `camp_org_name`, `camp_address`, `camp_area`, `camp_city`, `camp_org_number`, `camp_date`, `camp_time`, `camp_desc`) VALUES
(27, 'Khoon Doo!!!', 'Shekhar Shah', '304-Samyak Complex, Lotus School Road, Jodhpur', 'Ashram Road', 'Ahmedabad', '8460283985', '2019-04-09', '12:27', 'Excepteur placeat u'),
(28, 'Ronan Padilla', 'Margaret Willis', 'Njewa Campus', 'Chankheda', 'Ahmedabad', '9632595236', '2019-03-31', '15:58', 'Odit magna voluptate'),
(29, 'Rebekah Webb', 'Brynn Mcdowell', '304-Samyak Complex, Lotus School Road, Jodhpur', 'RTO', 'Ahmedabad', '8460283982', '2019-05-24', '08:52', 'Aut rem nisi aut ea'),
(30, 'Nathaniel Lawson', 'Tate Hendrix', 'Culpa asperiores ali', 'Paldi', 'Ahmedabad', '9898989898', '2019-04-02', '09:36', 'Reiciendis et eligen'),
(31, 'Ebony Villarreal', 'Fuller Barker', 'Cumque voluptate com', 'Sola', 'Ahmedabad', '6789067890', '2019-08-13', '02:18', 'Est commodi qui aut ');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `CITY_ID` int(11) NOT NULL,
  `STATE_ID` int(11) NOT NULL,
  `CITY_NAME` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CITY_ID`, `STATE_ID`, `CITY_NAME`) VALUES
(1, 1, 'Ahmedabad');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `COUNTRY_ID` int(11) NOT NULL,
  `COUNTRY_NAME` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`COUNTRY_ID`, `COUNTRY_NAME`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ID` int(11) NOT NULL COMMENT ' ',
  `IMAGE_NAME` varchar(50) DEFAULT NULL,
  `IMAGE` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ID`, `IMAGE_NAME`, `IMAGE`) VALUES
(1, 'Main_Page_Slider_1', 'dynamicimages/blood8.jpeg'),
(2, 'Hello', 'dynamicimages/s2.jpg'),
(3, 'About_Us', 'dynamicimages/blood.jpg'),
(4, 'About_Us_2', 'dynamicimages/aboutus.jpg'),
(46, 'About_Us_2', 'dynamicimages/blood4.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(150) DEFAULT NULL,
  `CONTACT` text,
  `EMAIL` varchar(200) DEFAULT NULL,
  `MESSAGE` text,
  `STATUS` text NOT NULL,
  `LOGS` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `NAME`, `CONTACT`, `EMAIL`, `MESSAGE`, `STATUS`, `LOGS`) VALUES
(20, 'Yasir Boone', '+1 (487) 498-1081', 'mataze@mailinator.net', 'QuoQuo incidunt dolores iste quo id voluptas dolor suscipit modi lorem id nobis veniam dolor incidunt dolores iste quo id voluptas dolor suscipit modi lorem id nobis veniam dolor', '0', '2019-02-04 16:48:47'),
(23, 'Gemma Savage', '8765432190', 'lekokys@mailinator.net', 'Qui est minima iste ipsam quisquam est molestiae et inventore harum quia a qui laborum', '0', '2019-03-05 17:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(100) NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `part_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `body_weight` int(11) DEFAULT NULL,
  `part_emailid` varchar(100) DEFAULT NULL,
  `part_address` text,
  `pincode` int(10) DEFAULT NULL,
  `contact_1` varchar(11) DEFAULT NULL,
  `contact_2` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `form_id`, `part_name`, `gender`, `dob`, `blood_type`, `body_weight`, `part_emailid`, `part_address`, `pincode`, `contact_1`, `contact_2`) VALUES
(17, 27, 'Shekhar Shah', 'Female', '1993-02-02', 'A+', 88, 'shekhar.shah@plusaim.com', 'Neque a culpa labor', 380015, '9898253470', '9128375672'),
(18, 29, 'Kunj', 'Male', '1996-05-14', 'AB+', 67, 'kunjshah12@gmail.com', 'qwety', 380038, '9898989898', '9876543210'),
(19, 28, 'Aisha', 'Female', '2004-10-22', 'A-', 80, 'alisha1295@yahoo.com', 'Home Satellite Ahmedabad', 380016, '9898706860', '9524654895'),
(21, 30, 'Chase Pierce', 'Female', '1996-06-12', 'O+', 57, 'pedohen@mailinator.com', 'Odio sunt iusto ulla', 890890, '8908908900', '9825342134'),
(22, 31, 'Trevor Mack', 'Female', '1976-03-15', 'O+', 77, 'fozeno@mailinator.com', 'Blanditiis eos omni', 989898, '9876543210', '8787877870');

-- --------------------------------------------------------

--
-- Table structure for table `request_blood`
--

CREATE TABLE `request_blood` (
  `id` int(11) NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `NAME` varchar(200) DEFAULT NULL,
  `GENDER` varchar(200) DEFAULT NULL,
  `BLOOD_TYPE` varchar(50) DEFAULT NULL,
  `REQ_BLOOD` varchar(200) DEFAULT NULL,
  `HOSP_ADDRESS` text,
  `CITY` varchar(100) DEFAULT NULL,
  `PINCODE` int(11) DEFAULT NULL,
  `DOC_NAME` varchar(200) DEFAULT NULL,
  `REQ_DATE` date DEFAULT NULL,
  `REQ_TIME` time DEFAULT NULL,
  `CONTACT_NAME` varchar(200) DEFAULT NULL,
  `EMAIL_ID` varchar(100) DEFAULT NULL,
  `CONTACT_1` text,
  `CONTACT_2` text,
  `REASON` text,
  `PATIENT_IMAGE` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `task_status` int(11) DEFAULT NULL,
  `LOGS` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_blood`
--

INSERT INTO `request_blood` (`id`, `form_id`, `NAME`, `GENDER`, `BLOOD_TYPE`, `REQ_BLOOD`, `HOSP_ADDRESS`, `CITY`, `PINCODE`, `DOC_NAME`, `REQ_DATE`, `REQ_TIME`, `CONTACT_NAME`, `EMAIL_ID`, `CONTACT_1`, `CONTACT_2`, `REASON`, `PATIENT_IMAGE`, `status`, `task_status`, `LOGS`) VALUES
(21, 45, 'Talon Cote', 'Male', 'O+', '1', 'Quia dolores perspiciatis rerum ullamco est sed quia aspernatur dolor aut aut sint repellendus Ullam', 'Ahmedabad', 890089, 'Tempore autem sit ', '2019-03-28', '10:00:00', 'Xavier Murphy', 'nefynuhewu@mailinator.net', '8797897899', '9808908900', 'Rerum perferendis saepe repellendus Facere consequatur dolor libero nulla reiciendis rerum ullam quo aut nostrum dolorum', 'patient_image/noimage.jpg', 0, 2, '2019-03-25 12:48:05'),
(26, 43, 'Mia Castaneda', 'Female', 'O-', '1', 'Aliquid voluptatem Qui commodi et iusto hic nulla qui vitae omnis sunt id hic recusandae Pariatur Ut', 'Ahmedabad', 400001, 'Voluptate amet dese', '2019-03-28', '02:00:00', 'Christine Koch', 'fany@mailinator.com', '7689079280', '', 'Quis accusamus fuga Consequatur Et necessitatibus fuga Atque ut minima voluptatem', 'patient_image/female.png', 0, 0, '2019-03-25 15:48:02'),
(36, 45, 'Chantale Goodwin', 'Male', 'O+', '1', 'Ipsum natus eveniet quos voluptas ipsum ut qui dolor et minima dicta possimus aut libero voluptas ipsum eum quidem nostrum', 'Ahmedabad', 310001, 'Exercitationem exped', '2019-03-29', '20:00:00', 'Megan Avery', 'liqeqisob@mailinator.com', '8901203405', '', 'Dolor ipsam eos adipisci delectus aspernatur impedit inventore commodo sed anim anim minima', 'patient_image/patientimage.jpg', 0, 0, '2019-03-26 17:27:17'),
(37, 43, 'Rhoda Chapman', 'Female', 'O-', '1', 'Voluptas accusamus placeat corrupti dolor totam neque et officiis totam do fugit sed ea recusandae Dolorem qui', 'Ahmedabad', 567567, 'Nisi dolore iste ips', '2019-03-30', '11:25:00', 'Rahim Lamb', 'revytaweca@mailinator.com', '6676756756', '', 'Quibusdam tenetur ut ipsum aut elit eius laboriosam vel', 'patient_image/patientimage.jpg', 0, 0, '2019-03-26 17:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(50) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `confirm_pass` varchar(50) DEFAULT NULL,
  `mob_no` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `user_name`, `email_id`, `password`, `confirm_pass`, `mob_no`) VALUES
(1, 'shekhar', 'shah12@gmail.com', '6d3108c3f3168481c6fbe33833e2010e', '6d3108c3f3168481c6fbe33833e2010e', '9898909090'),
(3, 'darsh', 'darshgajjar@gmail.com', 'darsh', 'darsh', '9825098250'),
(4, 'krunal', 'krunal@gmail.com', 'krunal', 'krunal', '7978797879'),
(5, 'kunj', 'kunj.shah@plusaim.com', 'kunj', 'kunj', '9825098980'),
(6, 'bhargav', 'bhargav@gmail.com', '6bfbd7be3be0a2445508edb9b979f642', 'bhargav', '7897899090'),
(27, 'Zohan', 'zoxazip@mailinator.net', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '9874778800'),
(28, 'chirag', 'chiragpatel@gmail.com', '10229078f31bb101fdfbb40341d18025', '10229078f31bb101fdfbb40341d18025', '9876543210'),
(30, 'devarsh', 'deva@dev.com', 'f93989df62e475157e935f077e4c3d71', 'f93989df62e475157e935f077e4c3d71', '9898767690'),
(31, 'Malav', 'malavchudasma@hotmail.com', 'c3ece695e56f99035f198f218c04ac7e', 'c3ece695e56f99035f198f218c04ac7e', '8460907080'),
(32, 'Kishan', 'kishankori1997@yahoo.com', '328797d645a15f3b8a3050a45b54967b', '328797d645a15f3b8a3050a45b54967b', '7897897890'),
(33, 'sahil', 'sahil@gmail.com', 'e8c8f45019430b6f79862746e96d6e70', 'e8c8f45019430b6f79862746e96d6e70', '6781234560'),
(34, 'Nikhil', 'nikhilpandit@gmail.com', '102eb1ef188b1a24e1a3e2621298702a', '102eb1ef188b1a24e1a3e2621298702a', '9879098790'),
(41, 'Anil', 'anilprajapati@gmail.com', 'dae25370b4b2cd9c9d8483059950cdf4', 'dae25370b4b2cd9c9d8483059950cdf4', '7878789090');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `STATE_ID` int(11) NOT NULL,
  `STATE_NAME` varchar(150) NOT NULL,
  `COUNTRY_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`STATE_ID`, `STATE_NAME`, `COUNTRY_ID`) VALUES
(1, 'Gujarat', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`AREA_ID`);

--
-- Indexes for table `blood_donor_register`
--
ALTER TABLE `blood_donor_register`
  ADD PRIMARY KEY (`donor_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `blood_stock`
--
ALTER TABLE `blood_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`CITY_ID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`COUNTRY_ID`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_blood`
--
ALTER TABLE `request_blood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`STATE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `AREA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `blood_donor_register`
--
ALTER TABLE `blood_donor_register`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `blood_stock`
--
ALTER TABLE `blood_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `CITY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `COUNTRY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ', AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `request_blood`
--
ALTER TABLE `request_blood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `STATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
