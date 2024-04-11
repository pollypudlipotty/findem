-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2024 at 06:24 PM
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
                               `appointment_duration` float NOT NULL,
                               `appointment_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `service_id`, `status_id`, `appointment_date`, `appointment_time`, `appointment_duration`, `appointment_fee`) VALUES
                                                                                                                                                               (25, 6, 2, '2024-04-17', '15:00:00', 1.5, 6500),
                                                                                                                                                               (26, 6, 1, '2024-05-29', '17:30:00', 1, 5000),
                                                                                                                                                               (27, 5, 1, '2024-04-25', '10:00:00', 2, 8900),
                                                                                                                                                               (28, 5, 1, '2024-05-30', '17:00:00', 1, 6800),
                                                                                                                                                               (29, 4, 2, '2024-04-22', '08:00:00', 1.5, 7500),
                                                                                                                                                               (30, 4, 2, '2024-05-24', '11:30:00', 2, 12000),
                                                                                                                                                               (31, 3, 1, '2024-04-29', '09:30:00', 3, 35000),
                                                                                                                                                               (32, 3, 2, '2024-05-28', '12:00:00', 1.5, 12000),
                                                                                                                                                               (33, 7, 1, '2024-04-17', '08:00:00', 2.5, 15000),
                                                                                                                                                               (34, 7, 1, '2024-05-08', '09:30:00', 2, 12500),
                                                                                                                                                               (35, 7, 1, '2024-05-20', '17:00:00', 2, 12500),
                                                                                                                                                               (36, 6, 1, '2024-04-30', '10:30:00', 1.5, 8000),
                                                                                                                                                               (37, 8, 2, '2024-04-14', '16:30:00', 1.5, 8900),
                                                                                                                                                               (38, 8, 1, '2024-05-07', '14:00:00', 1.5, 8900),
                                                                                                                                                               (39, 9, 2, '2024-04-29', '18:00:00', 1, 9500),
                                                                                                                                                               (40, 9, 1, '2024-05-09', '11:30:00', 1, 9500),
                                                                                                                                                               (41, 9, 1, '2024-05-28', '14:00:00', 0.5, 5000),
                                                                                                                                                               (42, 9, 2, '2024-05-03', '16:30:00', 0.5, 5000),
                                                                                                                                                               (43, 10, 2, '2024-04-16', '10:30:00', 2, 15000),
                                                                                                                                                               (44, 10, 1, '2024-05-07', '16:30:00', 2.5, 20000),
                                                                                                                                                               (45, 10, 1, '2024-05-30', '13:00:00', 2, 15000),
                                                                                                                                                               (46, 11, 2, '2024-04-27', '10:00:00', 1, 5000),
                                                                                                                                                               (47, 11, 2, '2024-04-28', '09:30:00', 1, 5000),
                                                                                                                                                               (48, 11, 1, '2024-05-08', '17:00:00', 1, 5000),
                                                                                                                                                               (49, 11, 1, '2024-05-28', '08:30:00', 1, 5000);

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
                                                                              (11, 25, 11),
                                                                              (12, 30, 12),
                                                                              (13, 32, 13),
                                                                              (14, 37, 11),
                                                                              (15, 29, 12),
                                                                              (16, 39, 13),
                                                                              (17, 42, 11),
                                                                              (18, 43, 14),
                                                                              (19, 46, 14),
                                                                              (20, 47, 11);

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
                           `service_housenumber` varchar(5) NOT NULL,
                           `service_description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_provider_id`, `service_category_id`, `service_name`, `service_district`, `service_address`, `service_housenumber`, `service_description`) VALUES
                                                                                                                                                                                            (3, 15, 9, 'Abonyi Tattoo', 15, 'Pók utca', '25', 'Blackwork és fineline tetoválást vállalok. Kész minták közül lehet választani de segítek megvalósítani a saját ötleteiteket is.'),
                                                                                                                                                                                            (4, 16, 5, 'FittDini', 10, 'Nap utca', '12', 'A 10. kerületi Fitt25 edzőteremben várom a kedves vendégeket személyi edzésre.'),
                                                                                                                                                                                            (5, 17, 2, 'Tulipán Szépségszalon', 13, 'Ipoly utca', '10/b', 'Különböző arckezelésekre várom női és férfi vendégeimet egyaránt.'),
                                                                                                                                                                                            (6, 18, 1, 'Barberking', 8, 'Bérkocsis utca', '35/a', 'Szakáll- és hajvágást is egyaránt vállalok saját szalonomban a 8. kerület szívében.'),
                                                                                                                                                                                            (7, 19, 7, 'PaliVill', 14, 'Colombus utca', '11', 'Villanyszerelést vállalok Zuglóban és környékén. A reggeli és esti órákban is bátran keressenek.'),
                                                                                                                                                                                            (8, 20, 4, 'Diamond Nails', 7, 'Kertész utca', '36', 'Megvalósítom álmaid műkörmét.'),
                                                                                                                                                                                            (9, 21, 3, 'Lótusz Masszázsszalon', 13, 'Dráva u', '24', 'Tibeti energizáló talpmasszázs bármilyen korosztálynak.'),
                                                                                                                                                                                            (10, 22, 8, 'Duguláselhárítás', 9, 'Ecseri út', '66/b', 'Kisebb és nagyobb vízvezeték szerelő munkákat is vállalok. Csapatom gyors és megbízható.'),
                                                                                                                                                                                            (11, 23, 10, 'Cicaszittelés', 14, 'Laky Adolf utca', '33', 'Korlátozott számban otthonomban is fogadok cicusokat ameddig a gazdijuk távol van, de megbeszélés szerint házhoz is megyek napi kétszer, gondoskodni az egyedül maradt kedvencekről.');

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
                                                                                                      (11, 1, 'Katalin', 'Szabó', 'katika65@gmail.com', '1234Aa'),
                                                                                                      (12, 1, 'Tamás', 'Kecskés', 'k.tomi00@gmail.com', '9632Kt'),
                                                                                                      (13, 1, 'Panni', 'Nagy', 'pannithegreat@yahoo.com', '5656pG'),
                                                                                                      (14, 1, 'Ottó', 'Herczeg', 'ottoherczeg@gmail.vom', '7485Hz'),
                                                                                                      (15, 2, 'Evelin', 'Abonyi', 'evi92@gmail.com', '45eA45'),
                                                                                                      (16, 2, 'Dénes', 'Sándor', 'dini665@yahoo.com', '66diNi6'),
                                                                                                      (17, 2, 'Magdi', 'Takács', 'taki.magdi@gmail.com', 'Taki5587'),
                                                                                                      (18, 2, 'Ferenc', 'Kiss', 'k.fer72@gmai.com', 'K4545f'),
                                                                                                      (19, 2, 'Pál', 'Taskó', 'palika55@yahoo.com', 'palI78'),
                                                                                                      (20, 2, 'Karolina', 'Vendel', 'karcsi92@gmail.com', 'karCsi92'),
                                                                                                      (21, 2, 'Zalán', 'Kincses', 'zaliK87@gmail.com', 'Zalka47'),
                                                                                                      (22, 2, 'Béla', 'Lendvai', 'belus66@gmail.com', 'bB5698'),
                                                                                                      (23, 2, 'Kincső', 'Szabados', 'szabi.kincs@gmail.com', '741Szab');

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
    MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
    MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
    MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
    MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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