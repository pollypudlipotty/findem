-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2024 at 05:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FindEm`
--

DROP DATABASE IF EXISTS FindEm;
CREATE DATABASE FindEm;


-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
                               `appointment_id` int(11) NOT NULL,
                               `service_id` int(11) NOT NULL,
                               `status_id` int(11) NOT NULL,
                               `appointment_date` date NOT NULL,
                               `appointment_time` time NOT NULL,
                               `appointment_duration` int(11) NOT NULL,
                               `appointment_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `service_id`, `status_id`, `appointment_date`, `appointment_time`, `appointment_duration`, `appointment_fee`) VALUES
                                                                                                                                                               (1, 1, 2, '2024-02-13', '15:00:00', 1, 5000),
                                                                                                                                                               (2, 2, 2, '2024-02-28', '00:00:16', 2, 5000),
                                                                                                                                                               (3, 2, 2, '2024-02-28', '00:00:11', 3, 10000),
                                                                                                                                                               (4, 1, 1, '2024-02-29', '00:00:10', 1, 500),
                                                                                                                                                               (5, 2, 2, '2024-04-18', '10:30:00', 30, 5000),
                                                                                                                                                               (7, 1, 2, '2024-04-04', '12:00:00', 60, 5000),
                                                                                                                                                               (19, 1, 2, '2024-04-23', '10:00:00', 1, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
                               `reservation_id` int(11) NOT NULL,
                               `appointment_id` int(11) NOT NULL,
                               `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `appointment_id`, `user_id`) VALUES
                                                                              (1, 1, 6),
                                                                              (2, 2, 7),
                                                                              (3, 3, 6),
                                                                              (4, 7, 9),
                                                                              (5, 19, 8),
                                                                              (6, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
                        `role_id` int(11) NOT NULL,
                        `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
                                                (1, 'seeker'),
                                                (2, 'provider');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
                           `service_id` int(11) NOT NULL,
                           `service_provider_id` int(11) NOT NULL,
                           `service_category_id` int(11) NOT NULL,
                           `service_name` varchar(30) NOT NULL,
                           `service_district` int(11) NOT NULL,
                           `service_address` varchar(50) NOT NULL,
                           `service_housenumber` int(11) NOT NULL,
                           `service_description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_provider_id`, `service_category_id`, `service_name`, `service_district`, `service_address`, `service_housenumber`, `service_description`) VALUES
                                                                                                                                                                                            (1, 1, 1, 'Kati Szalon', 10, 'Erzsébet királyné útja 20/b fsz.', 10, 'Hajvágást, hajfestést és alkalmi frizura készítését vállalok.'),
                                                                                                                                                                                            (2, 5, 9, 'vidám tattoo', 14, 'szív u ', 5, 'fineline tattoo');

-- --------------------------------------------------------

--
-- Table structure for table `service_category`
--

CREATE TABLE `service_category` (
                                    `category_id` int(11) NOT NULL,
                                    `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_category`
--

INSERT INTO `service_category` (`category_id`, `category_name`) VALUES
                                                                    (1, 'fodrászat'),
                                                                    (2, 'kozmetika'),
                                                                    (3, 'masszázs'),
                                                                    (4, 'műköröm'),
                                                                    (5, 'személyi edzés'),
                                                                    (6, 'légkondiszerelés'),
                                                                    (7, 'villanyszerelés'),
                                                                    (8, 'vízvezetékszerelés'),
                                                                    (9, 'tetoválás'),
                                                                    (10, 'egyéb');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
                          `status_id` int(11) NOT NULL,
                          `status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
                                                      (1, 'available'),
                                                      (2, 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
                        `user_id` int(11) NOT NULL,
                        `role_id` int(11) NOT NULL,
                        `first_name` varchar(30) NOT NULL,
                        `last_name` varchar(30) NOT NULL,
                        `email_address` varchar(50) NOT NULL,
                        `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `first_name`, `last_name`, `email_address`, `password`) VALUES
                                                                                                      (1, 2, 'Katalin', 'Kiss', 'katikiss@gmail.com', '123456'),
                                                                                                      (5, 2, 'asd', 'asd', 'hjgfeuz@jf.hh', 'asd'),
                                                                                                      (6, 1, 'péter', 'cica', 'cica@fej.hu', 'kutya'),
                                                                                                      (7, 1, 'lujza', 'paff', 'paff@lujza.hu', 'cica'),
                                                                                                      (8, 1, 'jfurt', 'asde', 'hjshf@gtfr.hh', '111111aA'),
                                                                                                      (9, 1, 'anna', 'kiss', 'kis.anna@gmail.com', 'asda11A'),
                                                                                                      (10, 1, 'feri', 'nagy', 'nagyferi@citromail.hu', '1111qQ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
    ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
    ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
    ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
    ADD PRIMARY KEY (`service_id`),
  ADD KEY `service_provider_id` (`service_provider_id`),
  ADD KEY `service_category_id` (`service_category_id`);

--
-- Indexes for table `service_category`
--
ALTER TABLE `service_category`
    ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
    ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
    MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
    MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
    MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
    MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_category`
--
ALTER TABLE `service_category`
    MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
    MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
    ADD CONSTRAINT `service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
    ADD CONSTRAINT `appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
    ADD CONSTRAINT `service_category_id` FOREIGN KEY (`service_category_id`) REFERENCES `service_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_provider_id` FOREIGN KEY (`service_provider_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
    ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;