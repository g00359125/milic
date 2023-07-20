# ************************************************************
# Author: Mateja Cvetkovic
# Database: milicdb
# Date: 2023-06-10 01:08:31 +0000
# ************************************************************


# Table: users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `surname` varchar(50) NOT NULL DEFAULT '',
  `dob` datetime NOT NULL,
  `address` varchar(100) NOT NULL DEFAULT '',
  `mobile` varchar(13) NOT NULL DEFAULT '', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Table: products
# ------------------------------------------------------------
DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `abv` decimal(3,1) NOT NULL,
  `year` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Table: products
# ------------------------------------------------------------
DROP TABLE IF EXISTS `prices`;

CREATE TABLE `prices` (
  `product_id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `abv` decimal(3,1) NOT NULL,
  `year` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`,`name`, `surname`, `dob`, `address`, `mobile`)
VALUES
	(1, 'admin@milic.com', '$2y$10$n8BGpe/nVmCQwqacAISn3OgUOgyLlpoNz9X4BVooD2TRMsRcGk7AS', 'Mateja', 'Cvetkovic', '1998-07-09', 'Paja Jovanovica 10, 26300 Vrsac, Serbia', '(060) 482 0668'),
	(2,'petarp@email.com','$2y$10$n8BGpe/nVmCQwqacAISn3OgUOgyLlpoNz9X4BVooD2TRMsRcGk7AS', 'Petar', 'Petrovic', '1996-12-03', 'Kraljevica Marka 50, 26300 Vrsac, Serbia', '(060) 482 0667');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
INSERT INTO `orders` (`id`, `user_id`, `order_time`, `order_total`, `status`, `delivery_time`) VALUES
(1, 2, '2023-07-10 11:40:20', '6000.00', 'CREATED', NULL),
(2, 3, '2023-07-10 09:43:00', '6000.00', 'CREATED', NULL),
(3, 5, '2023-07-11 17:22:11', '2000.00', 'CREATED', NULL),
(4, 6, '2023-07-11 15:02:19', '4000.00', 'CREATED', NULL),
(5, 8, '2023-07-12 10:44:34', '4000.00', 'CREATED', NULL);
COMMIT;

INSERT INTO `order_details` (`order_id`, `product_id`, `qty`, `unit_price`, `discount`) VALUES ('1', '1', '4', '2000', '0');
INSERT INTO `order_details` (`order_id`, `product_id`, `qty`, `unit_price`, `discount`) VALUES ('1', '2', '2', '2000', '0');