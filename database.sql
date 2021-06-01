-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2021 at 06:48 PM
-- Server version: 10.5.9-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `location`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `status` varchar(150) NOT NULL,
  `pickup` date NOT NULL,
  `dropoff` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `createdAt`, `user`, `vehicle`, `status`, `pickup`, `dropoff`) VALUES
(49, '2021-03-27 11:58:35', 2, 1, 'pendingdelete', '2021-05-29', '2021-07-30'),
(50, '2021-09-27 12:30:29', 1, 5, 'active', '2021-05-30', '2021-05-31'),
(51, '2021-09-28 07:20:30', 1, 7, 'pending', '2021-06-02', '2021-06-06'),
(52, '2021-05-28 12:47:37', 1, 12, 'pending', '2021-05-31', '2021-05-31'),
(53, '2021-05-31 10:39:35', 1, 12, 'pending', '2021-06-03', '2021-06-27'),
(54, '2021-05-31 18:06:12', 1, 11, 'pending', '2021-06-03', '2021-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(150) NOT NULL,
  `privilege` varchar(150) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pass`, `firstName`, `lastName`, `createdAt`, `phone`, `privilege`) VALUES
(1, 'cbenhzaine@gmail.com', '$2y$10$Is7l4tWjAkGZ7zRql3W9Ne1lu8ykdQ4oxyhOqWKr3dObyhOx7BBj.', 'Hassan', 'Benhzaine', '2021-05-26 08:53:33', '0607873886', 'admin'),
(2, 'darlogservices@gmail.com', '$2y$10$uwWmZ6dCoZlZAm62AayswODsQ8ppmowTfFXfpHTz0yF95rIyDQ3IG', 'Tayeb', 'Benhzaine', '2021-05-27 11:33:14', '0696175690', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `brand` varchar(150) NOT NULL,
  `model` varchar(150) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `type` varchar(150) NOT NULL,
  `photo` varchar(150) DEFAULT 'default.jpg',
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `createdAt`, `brand`, `model`, `description`, `year`, `type`, `photo`, `price`) VALUES
(1, '2021-05-26 08:53:33', 'Mazda', 'RX7', 'The Mazda RX-7 is a front/mid-engine, rear-wheel-drive, rotary engine-powered sports car that was manufactured and marketed by Mazda from 1978 to 2002', 2001, 'car', 'car-1.jpg', 260),
(2, '2021-05-26 08:53:33', 'YAMAHA', 'BOLT', 'Comfortable reliable custom Bolt. Mechanic built and maintained she’s always ready to ride. I ride, surf, and explore all over the Oahu on this bike and hope you can enjoy the 2-wheel island life as well! 🤙🏽 I have a variety of helmet sizes available to rent.', 2014, 'bike', 'bike-1.jpg', 430),
(3, '2021-05-26 08:53:33', 'YAMAHA', 'NIKEN GT', 'NIKEN doesn’t look like anything on the road because it isn’t like anything else on the road. Graceful curves highlight the mass-forward design to show off the unique LMW system, combining futuristic technology with flowing, organic style. The NIKEN™ LMW chassis is an exclusive motorcycle control system that provides unparalleled rider confidence across a wide range of road conditions. ', 2019, 'bike', 'bike-2.jpg', 960),
(4, '2021-05-26 08:53:33', 'KTM', '390 DUKE', 'This \"little\" Duke 390 is a ripper and loads of fun around the city and in our local canyons! It\'s an aggressive machine with sharp handling and entertaining even for experienced riders. If there\'s one thing this bike doesn\'t like doing, it\'s going slow. While it can handle freeway speeds with no problem, it\'s not much of a highway cruiser.', 2018, 'bike', 'bike-3.jpg', 590),
(5, '2021-05-26 08:53:33', 'HONDA', 'CRF250L', 'Not looking forward to the hassle of parking in Waikiki? Looking to hoon around town and explore some twisties? This bike will get you practically anywhere on the island. This \'14 Honda CRF250L Supermoto is in tiptop shape and features a cushy suspension, Warp9 elite wheels, upgraded front rotor, sticky street tires, bright LED lighting, flatland skid plate/radiator guard, Protaper bars, adjustable clutch/brake levers, and a full FMF exhaust.', 2014, 'bike', 'bike-4.jpg', 600),
(6, '2021-05-26 08:53:33', 'INDIAN', 'ROADMASTER', 'The mighty Indian Roadmaster! Fully equipped top of the line Indian. It has all the bells and whistles including stereo system with Bluetooth and usb connection, trip computer with range and consumption, and navigation GPS. Even has cruise control! This is the ultimate cruiser providing the most comfortable ride possible for 2 people. You will love this bike!', 2017, 'bike', 'bike-5.jpg', 970),
(7, '2021-05-26 08:53:33', 'KAWASAKI', 'VN1600-A3', 'I know you\'re excited to get out on the open road and explore all that we have to offer here. Whether you\'re heading into the mountains to explore quaint mountain living, amazing hot springs or our spectacular wine country this bike is how you want to arrive. Around the city exploring our museums, historical sites, or catching a Rockies game.', 2005, 'bike', 'default.jpg', 1620),
(8, '2021-05-26 08:53:33', 'YAMAHA', 'STRYKER', 'Great bike, lots of fun. Cobra swept pipes, and a custom built intake makes it scream.', 2015, 'bike', 'bike-7.jpg', 830),
(9, '2021-05-26 08:53:33', 'DUCATI\r\n', '899 PANIGALE', 'The Ducati 899 Panigale is a 898 cc (54.8 cu in) sport bike from Ducati, released in 2013 to replace the 848.[1] The motorcycle is named after the small manufacturing town of Borgo Panigale. It has a 148-horsepower (110 kW) version of the engine in the previously released 1199 Panigale. Claimed dry weight is 169 kilograms (373 lbs).', 2014, 'bike', 'bike-8.jpg', 1440),
(10, '2021-05-26 08:53:33', 'SUZUKI ', 'GSX1250FA', 'he GSX1250F might pack a 257kg fully-fueled weight, but it hides it well. The seat is low and the bars raised, putting you in a good position for low-speed traffic-splitting or hustling along an open road. Bumps expose the limits of the cheap suspension – using the rebound damping adjusters might help. Smooth roads are no problem, the GSX steering sweetly but stably with no excess pitching back and forth – the uprated springs/damping in the forks over the Bandit help.', 2011, 'bike', 'bike-9.jpg', 710),
(11, '2021-05-27 14:49:20', 'Range Rover', 'Evoque', 'no description', 2008, 'car', 'car-2.jpg', 300),
(12, '2021-05-27 14:50:39', 'McLaren', '720s', 'no description', 2019, 'car', 'car-3.jpg', 1000),
(13, '2021-05-31 18:15:35', 'Ford', 'Mustang GT', 'no desc', 2011, 'car', 'car-4.jpg', 400),
(14, '2021-05-31 18:16:56', 'BMW', 'M2 Competition', 'no desc', 2014, 'car', 'car-5.jpg', 500),
(15, '2021-05-31 18:18:00', 'Alfa Romeo', '4C', 'no des', 2010, 'car', 'car-6.jpg', 600),
(16, '2021-05-31 18:19:03', 'Mercedes-Benz', 'SLK', 'no desc', 2002, 'car', 'car-7.jpg', 400),
(17, '2021-05-31 18:19:42', 'GMC', 'Hummer', 'no', 2006, 'car', 'car-8.jpg', 800),
(18, '2021-05-31 18:20:29', 'Mercedes-Benz', 'SLS', 'no', 2014, 'car', 'car-9.jpg', 700),
(19, '2021-05-31 18:21:31', 'Mercedes-Benz', 'SLS Coupe', 'no', 2014, 'car', 'car-10.jpg', 800),
(20, '2021-05-31 18:22:44', 'Mercedes-Benz', 'CLK', 'no', 2017, 'car', 'car-11.jpg', 500),
(21, '2021-05-31 18:23:22', 'Audi', 'Q5', 'no', 2016, 'car', 'car-12.jpg', 300),
(22, '2021-05-31 18:47:17', 'DAF', 'XF', 'sqf', 2018, 'truck', 'truck-1.jpg', 300),
(23, '2021-05-31 18:47:29', 'DAF', 'XF', 'sqf', 2018, 'truck', 'truck-1.jpg', 300),
(24, '2021-05-31 18:47:29', 'DAF', 'XF', 'sqf', 2018, 'truck', 'truck-1.jpg', 300),
(25, '2021-05-31 18:47:29', 'DAF', 'XF', 'sqf', 2018, 'truck', 'truck-1.jpg', 300),
(26, '2021-05-31 18:47:29', 'DAF', 'XF', 'sqf', 2018, 'truck', 'truck-1.jpg', 300),
(27, '2021-05-31 18:47:29', 'DAF', 'XF', 'sqf', 2018, 'truck', 'truck-1.jpg', 300),
(28, '2021-05-31 18:47:29', 'DAF', 'XF', 'sqf', 2018, 'truck', 'truck-1.jpg', 300);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `vehicle` (`vehicle`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`vehicle`) REFERENCES `vehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
