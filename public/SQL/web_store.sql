-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2022 at 03:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(12, 9),
(13, 10),
(14, 11),
(15, 21),
(16, 22);

-- --------------------------------------------------------

--
-- Table structure for table `contain`
--

CREATE TABLE `contain` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contain`
--

INSERT INTO `contain` (`id`, `cart_id`, `product_id`, `qty_product`) VALUES
(5, 12, 3, 2),
(7, 12, 2, 1),
(19, 15, 11, 2),
(20, 15, 17, 3),
(21, 15, 2, 1),
(22, 13, 3, 1),
(23, 14, 11, 2),
(24, 16, 3, 3),
(26, 16, 17, 10);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220628053206', '2022-06-28 07:34:20', 52),
('DoctrineMigrations\\Version20220628053623', '2022-06-28 07:36:39', 36),
('DoctrineMigrations\\Version20220628054032', '2022-06-28 07:40:45', 35),
('DoctrineMigrations\\Version20220628054135', '2022-06-28 07:41:50', 34),
('DoctrineMigrations\\Version20220628054232', '2022-06-28 07:42:46', 37),
('DoctrineMigrations\\Version20220628060703', '2022-06-28 08:07:15', 54),
('DoctrineMigrations\\Version20220628061452', '2022-06-28 08:14:57', 681),
('DoctrineMigrations\\Version20220702043344', '2022-07-02 06:34:03', 191),
('DoctrineMigrations\\Version20220702045257', '2022-07-02 11:53:02', 130),
('DoctrineMigrations\\Version20220705041750', '2022-07-05 06:18:18', 324),
('DoctrineMigrations\\Version20220705061143', '2022-07-05 13:11:48', 77),
('DoctrineMigrations\\Version20220705114404', '2022-07-05 13:44:20', 295);

-- --------------------------------------------------------

--
-- Table structure for table `feadback`
--

CREATE TABLE `feadback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feadback`
--

INSERT INTO `feadback` (`id`, `user_id`, `username`, `email`, `phone`, `message`, `product_name`) VALUES
(3, 10, 'huuduy', 'huuduy@gmail.com', '0931927908', 'The Vans Navy shoe is so good! I feel confortable when wear it.', 'Vans Navy'),
(4, 11, 'nga', 'ngantk@gmail.com', '0346257198', 'Great!', 'Vans Navy');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `payment` double NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_date`, `delivery_date`, `payment`, `address`, `status`, `phone`, `user_id`, `client`) VALUES
(25, '2022-07-06', NULL, 9000000, 'Vinh Long', NULL, '0346257198', 11, 'Nga'),
(29, '2022-07-06', NULL, 8100000, 'An Phu Thuan, Chau Thanh, Dong Thap', NULL, '0939716868', 21, 'kimngando'),
(30, '2022-07-07', NULL, 3000000, 'Chau Thanh, Dong Thap', NULL, '0931927908', 10, 'huuduy'),
(31, '2022-07-08', NULL, 3000000, 'Vinh Long', NULL, '0346257198', 11, 'Nga'),
(32, '2022-07-08', NULL, 31000000, 'TP. Ho Chi Minh', NULL, '0942797979', 22, 'Neymar JR');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `qty_pro` int(11) NOT NULL,
  `order_id_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `qty_pro`, `order_id_id`, `product_id`) VALUES
(18, 1, 25, 3),
(19, 2, 25, 4),
(25, 2, 29, 11),
(26, 3, 29, 17),
(27, 1, 29, 2),
(28, 1, 30, 3),
(29, 2, 31, 11),
(30, 3, 32, 3),
(31, 5, 32, 12),
(32, 10, 32, 17);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `quantity`, `price`, `detail`, `supplier_id_id`) VALUES
(2, 'Converse Red', 'Converse-red.jpg', 26, 1500000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 2),
(3, 'Nike Air Jodan', 'Nike-air-jodan.jpg', 16, 3000000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 3),
(4, 'Nike Air Force 1', 'Nike-Air-1.jpg', 21, 3000000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 3),
(5, 'Vans Navy', 'Vans-navy.jpg', 26, 1200000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 4),
(11, 'Converse White', 'Converse-white.jpg', 20, 1500000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 2),
(12, 'Balencia Mix', 'Balencia-mix.jpg', 14, 2000000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 1),
(17, 'Converse Yellow', 'Converse-yellow.jpg', 6, 1200000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 2),
(18, 'Nike Air Jordan Yellow', 'Nike-air-jodan-yellow.jpg', 50, 5000000, 'The product made in Vietnamese at Huu Duy company and distributed by DHC shop. Sport shoe with high material, create a feeling of comfort for the user feet. 12 months warranty.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `email`) VALUES
(1, 'Balenciaga', 'balenciaga@gmail.com'),
(2, 'Converse', 'converse@gmail.com'),
(3, 'Nike', 'nike@gmail.com'),
(4, 'Vans', 'vans@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `fullname`, `email`, `address`, `phone`, `gender`, `birthday`) VALUES
(4, 'duyadmin', '[\"ROLE_ADMIN\"]', '$2y$13$UVZsLRcnU.uq2AdWv6v4aeca4L3s2RtTABNshj16kzcIWnE8F0ZUi', 'Do Huu Duy', 'huuduy@gmail.com', 'Chau Thanh, Dong Thap', '0931927908', 'Male', '2022-06-30'),
(8, 'huynhadmin', '[\"ROLE_ADMIN\"]', '$2y$13$sb9coRiKaepa4WfMvLGKderWddZMBU2R8PXn6Wxkilvfx8AHDCkj2', 'Tran Chi Huynh', 'huynhtc@gmail.com', 'Ca Mau', '0123456789', 'Male', '2022-07-02'),
(9, 'chinh', '[\"ROLE_USER\"]', '$2y$13$0ppFHNS9h2zFD1r6PM9FjOf3UpJr7Q3jboWl8ulwd.KP08bjDtyUu', 'nhat chinh', 'chinh@gmail.com', 'Thanh Binh, Dong Thap', '0939471248', 'Male', '2022-07-02'),
(10, 'huuduy', '[\"ROLE_USER\"]', '$2y$13$.NpobJaWPXpK0IAheNhJX.N5ckqnOWu70QGAJN8p4U9uKQ31MsyEq', 'Do Huu Duy', 'huuduy@gmail.com', 'Chau Thanh, Dong Thap', '0931927908', 'Male', '2002-07-10'),
(11, 'Nga', '[\"ROLE_USER\"]', '$2y$13$aaPPt2iXajrE7yAK1PAA..bpenN0zVPgxXGMZheHW2WQVnLj0Gs8O', 'Nguyen Thi Kim Nga', 'ngantk@gmail.com', 'Vinh Long', '0942718429', 'Female', '1983-05-18'),
(21, 'kimngando', '[\"ROLE_USER\"]', '$2y$13$V4y05xyMXwgsBIp2snGChe7fgkO5JuioX/C8iREaSTYJhhZMvt0Ji', 'Do Kim Ngan', 'ngandk@gmail.com', 'An Phu Thuan, Chau Thanh, Dong Thap', '0939716868', 'Female', '2011-06-02'),
(22, 'Neymar JR', '[\"ROLE_USER\"]', '$2y$13$/nXH5.l2mzP8mK9tOsutXOaG6X7JGrTx8ZnOJujNQ2LRnTL3/qvqC', 'Neymar Da Silva Santos Junior', 'neymerjr@gmail.com', 'TP. Ho Chi Minh', '0942797979', 'Male', '1992-02-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BA388B7A76ED395` (`user_id`);

--
-- Indexes for table `contain`
--
ALTER TABLE `contain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4BEFF7C81AD5CDBF` (`cart_id`),
  ADD KEY `IDX_4BEFF7C84584665A` (`product_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `feadback`
--
ALTER TABLE `feadback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_49B8064EA76ED395` (`user_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED896F46FCDAEAAA` (`order_id_id`),
  ADD KEY `IDX_ED896F464584665A` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04ADA65F9C7D` (`supplier_id_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contain`
--
ALTER TABLE `contain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `feadback`
--
ALTER TABLE `feadback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `contain`
--
ALTER TABLE `contain`
  ADD CONSTRAINT `FK_4BEFF7C81AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_4BEFF7C84584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `feadback`
--
ALTER TABLE `feadback`
  ADD CONSTRAINT `FK_49B8064EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_ED896F464584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_ED896F46FCDAEAAA` FOREIGN KEY (`order_id_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04ADA65F9C7D` FOREIGN KEY (`supplier_id_id`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
