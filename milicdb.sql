-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2023 at 01:48 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milicdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `discount_value` decimal(4,2) NOT NULL,
  `valid_from` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_to` datetime DEFAULT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_discounts_users_created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `code`, `discount_value`, `valid_from`, `valid_to`, `created_by`) VALUES
(1, 'Summer 2023 discount', 'SUMMER23', '10.00', '2023-06-01 00:00:00', '2023-09-01 00:00:00', 1),
(2, 'For Mateja', 'MC2023', '45.00', '2023-01-01 00:00:00', '2024-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_total` decimal(8,2) NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'CREATED',
  `delivery_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_users_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_time`, `order_total`, `status`, `delivery_time`) VALUES
(1, 2, '2023-07-10 11:40:20', '72.00', 'CREATED', NULL),
(2, 3, '2023-07-10 09:43:00', '72.00', 'CREATED', NULL),
(3, 5, '2023-07-11 17:22:11', '18.00', 'CREATED', NULL),
(4, 6, '2023-07-11 15:02:19', '36.00', 'CREATED', NULL),
(5, 8, '2023-07-12 10:44:34', '36.00', 'CREATED', NULL),
(9, 1, '2023-07-31 01:37:58', '72.00', 'CREATED', NULL),
(10, 1, '2023-07-31 01:42:33', '72.00', 'CREATED', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `unit_price` decimal(8,2) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_order_product` (`order_id`,`product_id`) USING BTREE,
  KEY `fk_order_details_products_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `qty`, `unit_price`, `discount`) VALUES
(1, 1, 3, '18.00', '0'),
(2, 2, 2, '18.00', '0'),
(2, 3, 1, '18.00', '0'),
(3, 3, 1, '18.00', '0'),
(4, 1, 1, '18.00', '0'),
(4, 2, 1, '18.00', '0'),
(5, 2, 1, '18.00', '0'),
(5, 3, 1, '18.00', '0'),
(9, 1, 1, '18.00', '0'),
(9, 2, 3, '18.00', '0'),
(10, 3, 4, '18.00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE IF NOT EXISTS `prices` (
  `product_id` int NOT NULL,
  `price_rsd` decimal(8,2) NOT NULL,
  `price_eur` decimal(8,2) NOT NULL,
  `price_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  UNIQUE KEY `product_id` (`product_id`,`price_rsd`,`price_eur`,`price_created`),
  KEY `fk_prices_users_created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`product_id`, `price_rsd`, `price_eur`, `price_created`, `created_by`) VALUES
(1, '2000.00', '18.00', '2023-07-09 00:00:00', 1),
(2, '2000.00', '18.00', '2023-07-09 00:00:00', 1),
(3, '2000.00', '18.00', '2023-07-09 00:00:00', 1),
(4, '2400.00', '20.00', '2023-07-09 00:00:00', 1),
(5, '2400.00', '20.00', '2023-07-09 00:00:00', 1),
(5, '2520.00', '21.00', '2023-07-29 00:00:00', 1),
(6, '2400.00', '20.00', '2023-07-09 00:00:00', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `prices_view_en`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `prices_view_en`;
CREATE TABLE IF NOT EXISTS `prices_view_en` (
`product_id` int
,`name` varchar(50)
,`description` varchar(200)
,`volume` decimal(3,1)
,`year` int
,`abv` decimal(3,1)
,`image` varchar(50)
,`qty` int
,`price` decimal(8,2)
,`price_created` datetime
,`user` varchar(101)
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_sr_l` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `name_sr_c` varchar(50) NOT NULL DEFAULT '',
  `name_en` varchar(50) NOT NULL DEFAULT '',
  `desc_sr_l` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `desc_sr_c` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `desc_en` varchar(200) NOT NULL DEFAULT '',
  `abv` decimal(3,1) NOT NULL DEFAULT '0.0',
  `volume` decimal(3,1) NOT NULL DEFAULT '1.0',
  `year` int NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name_sr_l`, `name_sr_c`, `name_en`, `desc_sr_l`, `desc_sr_c`, `desc_en`, `abv`, `volume`, `year`, `qty`, `image`) VALUES
(1, 'Kajsija', 'Кајсија', 'Appricot', 'opis rakije od kajsija', 'опис ракије од кајсија', 'spirit made from appricot', '42.0', '0.7', 2023, 30, 'kajsija.jpg'),
(2, 'Orah', 'Орах', 'Walnut', 'opis rakije od oraha', 'опис ракије од ораха', 'spirit made from walnut', '42.0', '0.7', 2023, 20, 'orah.jpg'),
(3, 'Dunja', 'Дуња', 'Quince', 'opis rakije od dunja', 'опис ракије од дуња', 'spirit made from quince', '43.0', '0.7', 2023, 30, 'dunja.jpg'),
(4, 'Kajsija', 'Кајсија', 'Appricot', 'opis rakije od kajsija', 'опис ракије од кајсија', 'spirit made from appricot', '42.0', '1.0', 2022, 0, 'kajsija.jpg'),
(5, 'Orah', 'Орах', 'Walnut', 'opis rakije od oraha', 'опис ракије од ораха', 'spirit made from walnut', '42.0', '1.0', 2022, 0, 'orah.jpg'),
(6, 'Dunja', 'Дуња', 'Quince', 'opis rakije od dunja', 'опис ракије од дуња', 'spirit made from quince', '43.0', '1.0', 2022, 0, 'dunja.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `surname` varchar(50) NOT NULL DEFAULT '',
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL DEFAULT '',
  `mobile` varchar(13) NOT NULL DEFAULT '',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `dob`, `address`, `mobile`, `isAdmin`) VALUES
(1, 'admin@milic.com', '$2y$10$n8BGpe/nVmCQwqacAISn3OgUOgyLlpoNz9X4BVooD2TRMsRcGk7AS', 'Mateja', 'Cvetkovic', '1998-07-09', 'Paja Jovanovica 10, 26300 Vrsac, Serbia', '(060) 482 066', 1),
(2, 'petarp@email.com', '$2y$10$n8BGpe/nVmCQwqacAISn3OgUOgyLlpoNz9X4BVooD2TRMsRcGk7AS', 'Petar', 'Petrovic', '1996-12-03', 'Kraljevica Marka 50, 26300 Vrsac, Serbia', '(060) 482 066', 0),
(3, 'jovanj@gmail.com', '$2y$10$39xJjvpu8JGj.NHN.YLPm.dKp0Gw0m2EeNmnNn1NKP.T5cbreq4v2', 'Jovan', 'Jovanovic', '1999-11-20', 'Balkanska 1, 26300 Vrsac', '(064) 470 138', 0),
(4, 'ivani@gmail.com', '$2y$10$n8BGpe/nVmCQwqacAISn3OgUOgyLlpoNz9X4BVooD2TRMsRcGk7AS', 'Ivan', 'Ivanovic', '1997-04-12', 'Abrasevica 22, 26300 Vrsac ', '(063) 938 592', 0),
(5, 'markon@gmail.com', '$2y$10$kFrahUtOJy321J7YmMPtu.Z0x3XgvT0Fa5CsgFnDvRT9xGxockFDG', 'Marko', 'Nikolic', '1971-10-08', 'Nemanjina 56, 26300 Vrsac', '(064) 178 098', 0),
(6, 'draganm@gmail.com', '$2y$10$bjy2uW0IBRQAwDgN4Jyyv.v5hkJbls9IyauLc478O.F4BU.gYhXbS', 'Dragan', 'Martinovic', '1967-05-17', '58 Wellpark Grove, Galway', '(087) 544 765', 0),
(7, 'simeonr@email.com', '$2y$10$zgshp5yhO3FgMiFu1i6F0OCYpHMddyimIKHedtMWWOd0CgrbwYc0i', 'Simeon', 'Radjenovic', '1998-11-25', '42 Heroja Pinkija, 26300 Vrsac', '(060) 045 156', 0),
(8, 'uwes@email.com', '$2y$10$dDBkhBOvuruZUzeO2u6yGun.q4aSOUJoAqNAg9n1OR93EsczvVO0.', 'Uwe', 'Svensson', '1948-04-17', 'Aslunda 105, Marsta', '(076) 659 569', 0),
(9, 'mirkos@gmail.com', '$2y$10$Npsx6nkX708bkcBXAUwI3OOvNaIiLjeLkXq3sfl5Z7u8wV8SKTshK', 'Mirko', 'Stevanovic', '1957-01-12', 'Decanska 45, 26300 Vrsac', '(063) 121 131', 0),
(10, 'milanm@gmail.com', '$2y$10$Hkhmq9Bv9Hjv9FpPe7u8FOux0PMP65JBjUSd.Oh0r6HJHNv57FsoK', 'Milan', 'Milanovic', '1964-10-05', 'Dvorska 12, 26300 Vrsac, Serbia', '(064) 156 145', 0),
(11, 'marko@gmail.com', '$2y$10$Gx2bDNXK0Ez2kie3/4yD8OV1krICzWPjSTNARjhPEaWIawqD6rzwu', 'Mark', 'ODonnel', '1998-04-05', 'Lurgan Park 42, Galway, Ireland', '(087) 344 764', 0),
(12, 'sergejms@gmail.com', '$2y$10$BMY7yUMsxQmm67m/0qrazu7i6VlDAdT2admTCQDh6xDFiUYKfd2IS', 'Sergej', 'Milinkovic Savic', '1995-02-27', 'King Abdulah 31, Abu Dhabi, UEA', '(066) 542 666', 0),
(13, 'aleksandarm@gmail.com', '$2y$10$bB3oNaB1eksjJv1pqCel5OC5dlEsDfKE7rvEGp5FVXestGK5p0mrW', 'Aleksandar', 'Mitrovic', '1999-08-26', 'Strahinjica Bana 51, 11000 Beograd, Srbija ', '(061) 611 889', 0);

-- --------------------------------------------------------

--
-- Structure for view `prices_view_en`
--
DROP TABLE IF EXISTS `prices_view_en`;

DROP VIEW IF EXISTS `prices_view_en`;
CREATE ALGORITHM=UNDEFINED DEFINER=`newuser`@`localhost` SQL SECURITY DEFINER VIEW `prices_view_en`  AS SELECT `prices`.`product_id` AS `product_id`, `products`.`name_en` AS `name`, `products`.`desc_en` AS `description`, `products`.`volume` AS `volume`, `products`.`year` AS `year`, `products`.`abv` AS `abv`, `products`.`image` AS `image`, `products`.`qty` AS `qty`, `prices`.`price_eur` AS `price`, max(`prices`.`price_created`) AS `price_created`, concat(`users`.`name`,' ',`users`.`surname`) AS `user` FROM ((`prices` join `users` on((`prices`.`created_by` = `users`.`id`))) join `products` on((`prices`.`product_id` = `products`.`id`))) GROUP BY `prices`.`product_id``product_id`  ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `fk_discounts_users_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_details_orders_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_order_details_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `fk_prices_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_prices_users_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
