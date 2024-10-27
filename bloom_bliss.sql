-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 27, 2024 at 12:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloom_bliss`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `bouquet_qty` int(10) NOT NULL,
  `bouquet_id` int(5) NOT NULL,
  `total_price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `amount_paid` varchar(10) NOT NULL,
  `id_user` int(5) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `address`, `pmode`, `amount_paid`, `id_user`, `order_date`) VALUES
(20, 'Jl. Pepaya No. 9, RT 001/RW 002, Kel. Jagakarsa, Kec. Jagakarsa, Jakarta Selatan 12630', 'COD', '2329000', 2, '2024-06-30'),
(22, 'Jl. Akasia No. 7, Sukmajaya, Abadijaya, Depok', 'Card', '1000000', 4, '2024-06-30'),
(25, 'wakeone', 'COD', '4475000', 3, '2024-07-02'),
(26, 'Jl. Kencana Surya No. 9, Yogyakarta', 'COD', '750000', 1, '2024-07-03'),
(27, 'Jl. ', 'COD', '800000', 1, '2024-07-03'),
(33, 'Jl. Saturnusa', 'COD', '656100', 4, '2024-07-15'),
(35, 'wakeone', 'COD', '675000', 2, '2024-07-15'),
(36, 'wakeone', 'COD', '656100', 2, '2024-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_orderdetail` int(5) NOT NULL,
  `bouquet_id` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `order_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_orderdetail`, `bouquet_id`, `qty`, `order_id`) VALUES
(1, 2, 2, 20),
(2, 1, 1, 20),
(5, 5, 2, 22),
(8, 8, 1, 25),
(9, 4, 1, 25),
(10, 3, 3, 25),
(11, 9, 1, 25),
(12, 3, 1, 26),
(13, 2, 1, 27),
(22, 1, 1, 33),
(24, 3, 1, 35),
(25, 1, 1, 36);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(5) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `pw_admin` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `email_admin`, `pw_admin`) VALUES
(1, 'admin@gmail.com', '$2y$10$gn.x5Vegoo5htYOXluSDLuGbJ9elKGXVZZqBntGVvqs6Hzx4n1MfC');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `bouquet_id` int(5) NOT NULL,
  `bouquet_name` varchar(50) NOT NULL,
  `bouquet_image` varchar(256) NOT NULL,
  `bouquet_description` text NOT NULL,
  `bouquet_type` varchar(30) NOT NULL,
  `bouquet_price` int(11) NOT NULL,
  `bouquet_ratings` double NOT NULL,
  `bouquet_category` enum('Wedding','Graduation','Birthday') NOT NULL,
  `bouquet_code` varchar(10) NOT NULL,
  `bouquet_stock` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`bouquet_id`, `bouquet_name`, `bouquet_image`, `bouquet_description`, `bouquet_type`, `bouquet_price`, `bouquet_ratings`, `bouquet_category`, `bouquet_code`, `bouquet_stock`) VALUES
(1, 'Pink Skies', 'wedding-bouquet1.png', 'Pink roses symbolize unconditional happiness.', 'Pink Roses', 729000, 4.9, 'Wedding', 'BQ001', 236),
(2, 'Summer Sea', 'wedding-bouquet2.png', 'All the colors give the feeling of joy and excitement.', 'Many Flowers', 800000, 5, 'Wedding', 'BQ002', 470),
(3, 'Spring Blossom', 'wedding-bouquet3.png', 'It symbolize purity, elegance, and new beginnings.', 'Sunflowers, Pink Roses', 750000, 4.8, 'Wedding', 'BQ003', 174),
(4, 'Secret Garden', 'graduation-bouquet4.png', 'It symbolize a new journey to release our beautiful youth.', 'Many Flowers', 600000, 4.9, 'Graduation', 'BQ004', 352),
(5, 'Blue Moon', 'graduation-bouquet5.png', 'The calming hue evokes a sense of relaxation.', 'Gentiana Trifloras', 500000, 4.8, 'Graduation', 'BQ005', 397),
(6, 'Hydrangea Love', 'graduation-bouquet6.png', 'Associated with heartfelt emotions and gratitude.', 'Hydrangeas', 700000, 5, 'Graduation', 'BQ006', 210),
(7, 'Valley of Lilies', 'birthday-bouquet7.png', 'Expressing sincere emotions & life\'s significant moments.', 'White Lilies, White Roses', 810000, 5, 'Birthday', 'BQ007', 418),
(8, 'La Vie En Rose', 'birthday-bouquet8.png', 'Are the quintessential symbol of love and passion.', 'Red Roses', 850000, 4.9, 'Birthday', 'BQ008', 144),
(9, 'In Bloom', 'birthday-bouquet9.png', 'Exudes an ethereal charm and understated elegance.', 'Gypsophilas', 775000, 4.8, 'Birthday', 'BQ009', 192);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(5) NOT NULL,
  `usn_user` varchar(20) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `notelp_user` varchar(10) NOT NULL,
  `pw_user` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `usn_user`, `nama_user`, `email_user`, `notelp_user`, `pw_user`) VALUES
(1, 'jennie27', 'jennie', 'jennie@gmail.com', '0106200000', '$2y$10$sGcZ4T3cKReLFWHz9Z1m6OzGRXAY4cdlqNSUoYqr4YykdsU1PxdHO'),
(2, 'liakim', 'lia', 'lia@gmail.com', '0812123456', '$2y$10$/lGwy6XunvCjWkLDAKThhu8u/rVC/YLDbYgjM1Uv/gCnZLqXxSqBS'),
(3, 'cacafay', 'caca', 'caca@gmail.com', '0857101988', '$2y$10$KKIG9M28pFmqctxwAwmjsuf1hKiNzHTYhwVyCyK8sibGxF7nHCEGu'),
(4, 'saputr_', 'susan', 'susan@gmail.com', '0821232425', '$2y$10$vkEZHVNvxoDH7dutOoFtPOT/zJpYUTlrGz/9gk7h1NHxQ8x0McwP.'),
(5, 'dindarhm', 'dinda ', 'dinda@gmail.com', '0815578304', '$2y$10$zSaazO85RizoOnAm9HWNxu9tOVn7kUNKVimDDKczePIyM46fHQ67.'),
(20, 'cinta', 'cinta', 'cinta@gmail.com', '0101234567', '$2y$10$5xq/ugJ2IEpK0iE7929As.Ir4YjJ9PHFB1VaLUVGXRlgV87OgFZQO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_bouquet_id` (`bouquet_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id_user_fk` (`id_user`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_orderdetail`),
  ADD KEY `fk_bouquet_id` (`bouquet_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`bouquet_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_orderdetail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `bouquet_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`bouquet_id`) REFERENCES `tb_produk` (`bouquet_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`bouquet_id`) REFERENCES `tb_produk` (`bouquet_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_to_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
