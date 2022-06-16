-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 05:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `m_title` varchar(255) NOT NULL,
  `m_index` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `id_parent`, `m_title`, `m_index`) VALUES
(26, 0, 'Giày', 1),
(27, 0, 'Áo', 1),
(28, 0, 'Quần', 1),
(29, 26, 'Giày thể thao', 1),
(30, 27, 'Áo sơ mi', 1),
(31, 28, 'Quần đùi', 1),
(32, 26, 'Giày lười', 1),
(33, 27, 'Áo thun', 1),
(34, 28, 'Quần Kaki', 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_product`
--

CREATE TABLE `image_product` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `imageAlbum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `m_title` varchar(255) NOT NULL,
  `m_price` int(11) NOT NULL,
  `m_image` varchar(255) NOT NULL,
  `m_quantity` int(11) NOT NULL,
  `m_description` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `idUser` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `m_title`, `m_price`, `m_image`, `m_quantity`, `m_description`, `created_at`, `updated_at`, `idUser`, `idCategory`) VALUES
(29, 'NIKE AIR FORCE 1 ', 1000000, '1655392557.jpg', 333, 'Giay11111', '2022-06-16', '2022-06-16', 3, 29),
(30, 'NIKE AIR ZOOM PEGASUS 38', 900000, '1655392645.jpg', 3242, 'Đây là giày', '2022-06-16', '2022-06-16', 3, 29),
(31, 'MỌI 5910 NÂU', 650000, '1655392719.jpg', 4334, 'Đây là giày lười', '2022-06-16', '2022-06-16', 3, 32),
(32, 'ÁO KIỂU PHỐI BÈO', 120000, '1655392840.jpg', 10, 'Đây là áo thun', '2022-06-16', '2022-06-16', 4, 33),
(33, 'SƠ MI ĐẮP CHÉO', 279000, '1655392929.jpg', 21123, 'Đây là áo sơ mi', '2022-06-16', '2022-06-16', 4, 30),
(34, 'QUẦN ĐÙI CARO PIGOFASHION 1', 99000, '1655393044.jpg', 111, 'Đây là quần đùi', '2022-06-16', '2022-06-16', 8, 31),
(35, 'Giày MLB NY Chunky High Shoes', 3200000, '1655393228.jpg', 200, 'Giày MLB', '2022-06-16', '2022-06-16', 8, 29),
(36, 'Giày MLB NY Chunky High Shoes 1', 3200000, '1655393228.jpg', 200, 'Giày MLB', '2022-06-16', '2022-06-16', 8, 29);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `m_email` varchar(255) NOT NULL,
  `m_password` text NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `m_email`, `m_password`, `m_name`, `m_role`, `created_at`) VALUES
(3, 'thanhdatnguyenle2000@gmail.com', 'be647fe53c3532b9c04fa4960b719977', 'Nguyễn Lê Thành Đạt', 'admin', '2022-06-14'),
(4, 'thanhdat111nguyenle2000@gmail.com', 'be647fe53c3532b9c04fa4960b719977', 'Role Admin 1', 'admin', '2022-06-14'),
(8, 'datnltps13413@fpt.edu.vn', 'be647fe53c3532b9c04fa4960b719977', 'Role User 1', 'user', '2022-06-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_product`
--
ALTER TABLE `image_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `image_product`
--
ALTER TABLE `image_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
