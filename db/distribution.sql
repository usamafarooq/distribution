-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2018 at 09:10 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distribution`
--

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

CREATE TABLE `distribution` (
  `id` int(11) NOT NULL,
  `scm_code` varchar(100) NOT NULL,
  `scm_name` varchar(100) NOT NULL,
  `dsr_code` varchar(100) NOT NULL,
  `dsr_name` varchar(100) NOT NULL,
  `station` varchar(100) NOT NULL,
  `distribution_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`id`, `scm_code`, `scm_name`, `dsr_code`, `dsr_name`, `station`, `distribution_id`, `user_id`) VALUES
(7, '112321', 'ghgh', '2323', 'errtrt', 'tttt', 28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `factory`
--

CREATE TABLE `factory` (
  `id` int(50) NOT NULL,
  `scm_order_no` int(50) NOT NULL,
  `dc_no` int(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `cn` varchar(50) NOT NULL,
  `kg` varchar(50) NOT NULL,
  `cartons` varchar(50) NOT NULL,
  `packs` varchar(50) NOT NULL,
  `receive_quantity` int(50) NOT NULL DEFAULT '0',
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factory`
--

INSERT INTO `factory` (`id`, `scm_order_no`, `dc_no`, `date`, `cn`, `kg`, `cartons`, `packs`, `receive_quantity`, `user_id`) VALUES
(1, 14, 2, '6', '6', '6', 'demo', 'demodc', 0, 2),
(2, 112321, 2, '6', '6', '6', 'demo1', 'demodc1', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `finance_order`
--

CREATE TABLE `finance_order` (
  `id` int(50) NOT NULL,
  `scm_code` varchar(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `qty1` int(50) NOT NULL,
  `qty2` int(50) NOT NULL,
  `qty3` int(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `dc_no` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance_order`
--

INSERT INTO `finance_order` (`id`, `scm_code`, `order_id`, `qty1`, `qty2`, `qty3`, `remarks`, `dc_no`, `user_id`) VALUES
(1, '14', 2, 6, 6, 6, 'demo', 'demodc', 2),
(2, '449', 3, 5, 5, 5, 'demo', 'demodc', 2),
(3, '14', 5, 4, 4, 4, 'demo', 'demodc', 2),
(4, '112321', 7, 6, 6, 6, 'demo', 'demodc', 2),
(5, '449', 4, 6, 0, 6, 'demo', 'demodc', 2),
(6, 'Distributor Code', 0, 0, 0, 0, 'Qty', 'Hardcoded', 2),
(7, '14', 2, 0, 0, 3, '15', '00000', 2),
(8, '000449', 3, 0, 0, 3, '15', '00000', 2),
(9, '000449', 4, 0, 0, 245, '18', '00000', 2),
(10, '14', 5, 0, 0, 3, '9', '00000', 2),
(11, '112321', 7, 0, 0, 3, '18', '00000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `main_name` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `main_name`, `sort`, `icon`, `url`, `user_id`) VALUES
(2, 'Dashboard', 'dashboard', 1, 'home', 'home', 4),
(3, 'Modules', 'modules', 4, 'home', 'modules', 4),
(5, 'Role/Permission', 'role', 2, 'home', 'role', 4),
(7, 'Users', 'user', 3, 'home', 'users', 2),
(9, 'Team', 'team', 5, 'home', 'team', 2),
(10, 'Product', 'product', 6, 'home', 'product', 2),
(11, 'Distribution', 'distribution', 7, 'home', 'distribution', 2),
(12, 'Sales', 'sales', 8, 'home', 'sales', 2),
(13, 'Order', 'orders', 9, 'home', 'orders', 2),
(14, 'Finance', 'finance', 9, 'home', 'finance', 2),
(15, 'Factory', 'factory', 12, 'home', 'factory', 2),
(16, 'Distributor', 'distributor', 15, 'home', 'distributor', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules_fileds`
--

CREATE TABLE `modules_fileds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `length` int(11) NOT NULL,
  `required` int(11) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `distribution_code` varchar(100) NOT NULL,
  `pak_code` varchar(100) NOT NULL,
  `order_field` int(50) NOT NULL,
  `order_field2` int(50) NOT NULL,
  `order_field3` int(50) NOT NULL,
  `growth` int(50) NOT NULL,
  `carton` int(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `distribution_code`, `pak_code`, `order_field`, `order_field2`, `order_field3`, `growth`, `carton`, `date`, `user_id`) VALUES
(2, '14', '184850', 5, 5, 5, 3, 50, '2017-12-04', 2),
(3, '000449', '184850', 5, 5, 5, 7, 7, '2018-01-09', 2),
(4, '000449', '184001', 6, 6, 6, 7, 7, '2018-01-09', 2),
(5, '14', '184850', 3, 3, 3, 90, 90, '2018-01-09', 2),
(7, '112321', '184850', 6, 6, 6, 4, 4, '2018-01-15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `view_all` int(11) NOT NULL DEFAULT '0',
  `created` int(11) DEFAULT '0',
  `edit` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `disable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `module_id`, `user_id`, `user_type_id`, `view`, `view_all`, `created`, `edit`, `deleted`, `disable`) VALUES
(28, 2, 2, 13, 1, 0, 0, 0, 0, 0),
(29, 3, 2, 13, 0, 1, 0, 1, 0, 0),
(30, 5, 2, 13, 0, 0, 1, 0, 0, 0),
(35, 2, 2, 14, 1, 0, 0, 0, 0, 0),
(36, 3, 2, 14, 0, 0, 0, 0, 0, 0),
(37, 5, 2, 14, 0, 0, 0, 0, 0, 0),
(232, 2, 2, 1, 1, 1, 1, 1, 1, 1),
(233, 3, 2, 1, 1, 1, 1, 1, 1, 1),
(234, 5, 2, 1, 1, 1, 1, 1, 1, 1),
(235, 7, 2, 1, 1, 1, 1, 1, 1, 1),
(236, 9, 2, 1, 1, 1, 1, 1, 1, 1),
(237, 10, 2, 1, 1, 1, 1, 1, 1, 1),
(238, 11, 2, 1, 1, 1, 1, 1, 1, 1),
(239, 12, 2, 1, 1, 1, 1, 1, 1, 1),
(240, 13, 2, 1, 1, 1, 1, 1, 1, 1),
(241, 14, 2, 1, 1, 1, 1, 1, 1, 1),
(242, 15, 2, 1, 1, 1, 1, 1, 1, 1),
(243, 16, 2, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `product_code` int(11) NOT NULL,
  `team` varchar(100) NOT NULL,
  `scm_product_code` int(30) NOT NULL,
  `tp_product` int(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `description`, `product_code`, `team`, `scm_product_code`, `tp_product`, `user_id`) VALUES
(1, 'ACTIFLOR', 'POWD. SACHE 0010G  0250MG X 10', 184850, 'abcde', 3, 1000, 2),
(2, 'TCTIFLOR', 'POWD. SACHE 0010G  0250MG X 10', 184001, 'abcde', 245, 16700, 2),
(6, 'T3TIFLOR', 'POWD. SACHE 0010G  0250MG X 10', 101841, 'arcde', 241, 1670, 2),
(7, 'B3TIFLOR', 'POWD. SACHE 0010G  0250MG X 10', 913, 'arcde', 242, 1670, 2),
(8, 'FATTIFLOR', 'POWD. SACHE 0010G 0250MG X 10', 1000841, 'abcde', 2428, 361011, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `distribution_code` varchar(100) NOT NULL,
  `packcode` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `sales` varchar(100) NOT NULL,
  `closing` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `distribution_code`, `packcode`, `date`, `sales`, `closing`, `user_id`) VALUES
(10, '14', '184850', '2017-12-31', '4345', 3434, 2),
(11, '14', '184850', '2017-12-26', '4343', 3414, 2),
(12, '14', '184850', '2017-11-26', '4343', 3414, 2),
(13, '000449', '101841', '2018-01-13', '23', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `user_id`) VALUES
(1, 'abcde', 2),
(2, 'demoteam', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(2, 'admin', 'admin@gmail.com', 'e6e061838856bf47e1de730719fb2609', 1),
(4, 'admin1', 'admin1@gmail.com', 'e6e061838856bf47e1de730719fb2609', 1),
(5, 'Udata', 'Udata@gmail.com', '5327b0d1bfa868acb9baac5a9d901815', 14),
(6, 'mob', 'admindd@gmail.com', '6cf0a3d27fdc438e4ee601448e452e48', 14),
(9, 'rtrt', 'adminsdee@milya.com', '532b7cbe070a3579f424988a040752f2', 14),
(10, 'musa', 'musa@gmail.com', 'c45d99e5638d1f9f801b545096003a8d', 14),
(12, 'rtrteree', 'adminsdeee11@milya.com', '0acf3d81f151df5994a88f039e636228', 14),
(13, 'musaeeee', 'mus22a@gmail.com', 'dbc4d84bfcfe2284ba11beffb853a8c4', 14),
(14, 'hero11', 'hero11@milya.com', '0acf3d81f151df5994a88f039e636228', 14),
(15, 'hero22', 'hero22@gmail.com', 'dbc4d84bfcfe2284ba11beffb853a8c4', 14),
(16, 'rest11', 'rest11@milya.com', '0acf3d81f151df5994a88f039e636228', 14),
(17, 'west22', 'hwest22@gmail.com', 'dbc4d84bfcfe2284ba11beffb853a8c4', 14),
(18, 'opp', 'opp@milya.com', 'e201220da86c13f4d9badaab658fa973', 14),
(19, 'urrr', 'urrr@gmail.com', '549ce24fb62238d013a6e222cb4d41d8', 14),
(22, '21321', 'dasdas', 'd41d8cd98f00b204e9800998ecf8427e', 14),
(28, 'tyyy', 'tyyy@gmail.com', 'b7bc2a2f5bb6d521e64c8974c143e9a0', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `user_id`) VALUES
(1, 'Admin', 2),
(13, 'Company', 2),
(14, 'Distribution', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distribution`
--
ALTER TABLE `distribution`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scm_code` (`scm_code`),
  ADD UNIQUE KEY `dsr_code` (`dsr_code`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance_order`
--
ALTER TABLE `finance_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD UNIQUE KEY `scm_product_code` (`scm_product_code`),
  ADD KEY `product_ibfk_1` (`user_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distribution`
--
ALTER TABLE `distribution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `factory`
--
ALTER TABLE `factory`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `finance_order`
--
ALTER TABLE `finance_order`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `distribution`
--
ALTER TABLE `distribution`
  ADD CONSTRAINT `distribution_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
