-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2018 at 01:42 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, '000449', 'ABDULLAH MEDICOS - DADU', '0164', 'Abdullah Medicos', 'Dadu', 20, 2),
(2, '000014', 'AHSAN TRADERS', '0042', 'Ahsan Traders', 'Rahim Yar Khan', 21, 2);

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
(18, 'Test', 'test', 12, 'home', 'test', 2);

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
  `module_id` int(11) NOT NULL,
  `is_relation` int(11) NOT NULL DEFAULT '0',
  `relation_table` varchar(100) DEFAULT NULL,
  `relation_column` varchar(100) DEFAULT NULL,
  `value_column` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_fileds`
--

INSERT INTO `modules_fileds` (`id`, `name`, `type`, `length`, `required`, `module_id`, `is_relation`, `relation_table`, `relation_column`, `value_column`) VALUES
(8, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(9, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(10, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(11, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(12, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(13, 'test2', 'INT', 100, 0, 14, 0, '', '', ''),
(14, 'test2', 'INT', 100, 0, 14, 0, '', '', ''),
(15, 'test2', 'INT', 100, 0, 14, 0, '', '', ''),
(16, 'test2', 'INT', 100, 0, 14, 0, '', '', ''),
(17, 'test2', 'INT', 100, 0, 14, 0, '', '', ''),
(18, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(19, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(20, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(21, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(22, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(23, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(24, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(25, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(26, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(27, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(28, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(29, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(30, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(31, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(32, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(33, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(34, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(35, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(36, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(37, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(38, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(39, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(40, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(41, 'test2', 'VARCHAR', 100, 1, 14, 0, '', '', ''),
(42, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(43, 'test2', 'VARCHAR', 100, 1, 14, 0, '', '', ''),
(44, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(45, 'test2', 'VARCHAR', 100, 0, 14, 0, '', '', ''),
(46, 'test3', 'TEXT', 250, 0, 14, 0, '', '', ''),
(47, 'test4', 'DATE', 100, 0, 14, 0, '', '', ''),
(48, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(49, 'test2', 'VARCHAR', 100, 1, 14, 0, '', '', ''),
(50, 'test3', 'TEXT', 250, 0, 14, 0, '', '', ''),
(51, 'test4', 'DATE', 100, 0, 14, 0, '', '', ''),
(52, 'test', 'INT', 100, 1, 14, 0, '', '', ''),
(53, 'test2', 'VARCHAR', 100, 1, 14, 0, '', '', ''),
(54, 'test3', 'TEXT', 250, 0, 14, 0, '', '', ''),
(55, 'test4', 'DATE', 100, 0, 14, 0, '', '', ''),
(56, 'companyname ', 'TEXT', 13, 1, 15, 0, '', '', ''),
(57, 'ntn', 'INT', 13, 1, 15, 0, '', '', ''),
(58, 'website', 'VARCHAR', 100, 1, 15, 0, '', '', ''),
(59, 'full_name', 'VARCHAR', 100, 1, 16, 0, '', '', ''),
(60, 'website', 'VARCHAR', 100, 0, 16, 0, '', '', ''),
(61, 'phone', 'INT', 11, 1, 16, 0, '', '', ''),
(62, 'dirth_of_date', 'DATE', 100, 1, 16, 0, '', '', ''),
(63, 'full_name', 'VARCHAR', 100, 1, 16, 0, '', '', ''),
(64, 'date_of_birth', 'DATE', 100, 1, 16, 0, '', '', ''),
(65, 'full_name', 'VARCHAR', 100, 1, 16, 0, '', '', ''),
(66, 'date_of_bi', 'DATE', 100, 1, 16, 0, '', '', ''),
(67, 'full_name', 'VARCHAR', 100, 1, 16, 0, '', '', ''),
(68, 'date_of_birth', 'DATE', 100, 1, 16, 0, '', '', ''),
(69, 'full_name', 'VARCHAR', 100, 1, 16, 0, '', '', ''),
(70, 'date_of_birth', 'DATE', 100, 1, 16, 0, '', '', ''),
(71, 'full_name', 'VARCHAR', 100, 1, 16, 0, '', '', ''),
(72, 'date_of_birth', 'DATE', 100, 1, 16, 0, '', '', ''),
(73, 'website', 'VARCHAR', 100, 0, 16, 0, '', '', ''),
(74, 'email', 'VARCHAR', 100, 1, 16, 0, '', '', ''),
(75, 'full_name', 'VARCHAR', 100, 1, 17, 0, '', '', ''),
(76, 'website', 'VARCHAR', 50, 1, 17, 0, '', '', ''),
(77, 'phone', 'INT', 11, 0, 17, 0, '', '', ''),
(78, 'date_of_birth', 'DATE', 100, 0, 17, 0, '', '', ''),
(79, 'full_name', 'VARCHAR', 100, 1, 18, 0, NULL, NULL, NULL),
(80, 'employee_id', 'INT', 11, 1, 18, 1, 'users', 'id', 'name,email'),
(81, 'product_id', 'INT', 11, 1, 18, 0, NULL, NULL, NULL);

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
(163, 2, 2, 1, 1, 1, 1, 1, 1, 1),
(164, 3, 2, 1, 1, 1, 1, 1, 1, 1),
(165, 5, 2, 1, 1, 1, 1, 1, 1, 1),
(166, 7, 2, 1, 1, 1, 1, 1, 1, 1),
(167, 9, 2, 1, 1, 1, 1, 1, 1, 1),
(168, 10, 2, 1, 1, 1, 1, 1, 1, 1),
(169, 11, 2, 1, 1, 1, 1, 1, 1, 1),
(170, 12, 2, 1, 1, 1, 1, 1, 1, 1),
(171, 13, 2, 1, 1, 1, 1, 1, 1, 1),
(172, 14, 2, 1, 1, 1, 1, 1, 1, 1),
(173, 15, 2, 1, 1, 1, 1, 1, 1, 1),
(174, 16, 2, 1, 1, 1, 1, 1, 1, 1),
(175, 17, 2, 1, 1, 1, 1, 1, 1, 1);

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
(1, 'ACTIFLOR', 'POWD. SACHE 0010G  0250MG X 10', 184850, 'abcde', 3, 1000, 2);

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
(10, '000449', '184850', '2017-12-31', '4343', 3434, 2);

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
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(20, 'DADU', 'DADU@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 14),
(21, 'AHSAN', 'AHSAN@gmail.com', 'd6a9a933c8aafc51e55ac0662b6e4d4a', 14);

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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules_fileds`
--
ALTER TABLE `modules_fileds`
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
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `modules_fileds`
--
ALTER TABLE `modules_fileds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
