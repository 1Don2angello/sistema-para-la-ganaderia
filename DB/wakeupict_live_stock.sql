-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2019 at 04:57 AM
-- Server version: 10.1.38-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wakeupict_live_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(222) NOT NULL,
  `category_id` varchar(222) NOT NULL,
  `category` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(100) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `ion_user_id` varchar(100) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `add_date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sub_category` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `voucher_no` varchar(100) NOT NULL,
  `paid` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_sub_category`
--

CREATE TABLE `expense_sub_category` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `food_id` varchar(250) NOT NULL,
  `consumption` varchar(250) NOT NULL,
  `ave_consumption` varchar(250) NOT NULL,
  `quantity` varchar(250) NOT NULL,
  `note` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(4, 'driver', 'driver'),
(5, 'Client', '');

-- --------------------------------------------------------

--
-- Table structure for table `livestock`
--

CREATE TABLE `livestock` (
  `id` int(250) NOT NULL,
  `livestock_id` varchar(250) NOT NULL,
  `livestock_name` varchar(222) NOT NULL,
  `date` varchar(250) NOT NULL,
  `quantity` varchar(250) NOT NULL,
  `note` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(222) NOT NULL,
  `medicine_id` varchar(222) NOT NULL,
  `duration` varchar(250) NOT NULL,
  `no` varchar(250) NOT NULL,
  `p_date` varchar(250) NOT NULL,
  `n_date` varchar(250) NOT NULL,
  `l_date` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `client_id` varchar(100) NOT NULL,
  `local_sale_id` text NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `supplier` varchar(100) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `paid_by` varchar(20) NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL,
  `cc_no` varchar(20) DEFAULT NULL,
  `cc_holder` varchar(25) DEFAULT NULL,
  `cc_month` varchar(2) DEFAULT NULL,
  `cc_year` varchar(4) DEFAULT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `amount` varchar(100) NOT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `dollar_amount` varchar(100) NOT NULL,
  `dollar_rate` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `pos_paid` decimal(25,4) DEFAULT '0.0000',
  `pos_balance` decimal(25,4) DEFAULT '0.0000',
  `approval_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(222) NOT NULL,
  `product_id` varchar(222) NOT NULL,
  `code` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `note` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `type` varchar(222) NOT NULL,
  `cost` varchar(222) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `quantity` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(100) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `unit_price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `amount_payable` decimal(65,2) NOT NULL,
  `paid_amount` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `purchase_status` int(100) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `x` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(10) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `sale_status` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL DEFAULT '0',
  `flat_vat` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) NOT NULL,
  `gross_total` varchar(100) NOT NULL,
  `amount_received` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `system_vendor` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `facebook_id` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `date_format` varchar(100) NOT NULL,
  `login_title` varchar(100) NOT NULL,
  `codec_username` varchar(100) NOT NULL,
  `codec_purchase_code` varchar(100) NOT NULL,
  `language` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_vendor`, `title`, `address`, `phone`, `email`, `facebook_id`, `currency`, `unit`, `discount`, `vat`, `date_format`, `login_title`, `codec_username`, `codec_purchase_code`, `language`) VALUES
(1, 'Live Stock - Chicken Farm Management System', 'LIVESTOCK', 'katra allahabad', '+254712351185', 'admin@example.com', '#', '$', 'pcs', '0', 'percentage', 'd-m-Y', 'Live Stock - Chicken Farm Management System', '', '', 'english');

-- --------------------------------------------------------

--
-- Table structure for table `shed`
--

CREATE TABLE `shed` (
  `id` int(222) NOT NULL,
  `shed_id` varchar(222) NOT NULL,
  `chicken_type` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `quantity` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL,
  `no` varchar(222) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(222) NOT NULL,
  `staff_id` varchar(222) NOT NULL,
  `img_url` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(222) NOT NULL,
  `supplier_id` varchar(222) NOT NULL,
  `img_url` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'Admin', '$2y$08$g1u0qcMP1wTgxK0yyho4xuc5EdtJwuCD8ETe6OQQWkAQmbFBA.DQ.', 'NULL', 'admin@example.com', 'NULL', NULL, NULL, NULL, 1268889823, 1560242951, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(244, '103.231.163.30', 'Mr Client', '$2y$08$AZVlco3jHL3LH2MyOKe59O7hcmakwE0Wgwp5pu5KZdSTxbvLFMe.2', NULL, 'client@example.com', NULL, NULL, NULL, NULL, 1442014065, 1510985852, 1, NULL, NULL, NULL, NULL),
(246, '110.76.129.222', 'fsdfsdf', '$2y$08$RPFDGLN.q6/WcRA0pOz7NudhXmFsVe8vrYV/rdt.WrbbNjnyWT6wG', NULL, 'fsdfsdf', NULL, NULL, NULL, NULL, 1507121290, NULL, 1, NULL, NULL, NULL, NULL),
(247, '118.67.223.106', 'tyutyuyi', '$2y$08$eQPrpQxpl3zZDpq.gziAUOagrghqhEmBWKuaIlwblAOcU869Z4RKq', NULL, 'tyuyiyui@.com', NULL, NULL, NULL, NULL, 1508135227, NULL, 1, NULL, NULL, NULL, NULL),
(248, '118.67.223.106', 'dddddd', '$2y$08$vhohdo2iHbGEjTpFOw7ImeiQB/WA4p3lEanxYOKMFng677.RhkKRu', NULL, 'dddddd', NULL, NULL, NULL, NULL, 1508932770, NULL, 1, NULL, NULL, NULL, NULL),
(249, '103.26.246.170', 'ggg', '$2y$08$dk9f25OIfW44FSPDJOmfKus2Pcc0eIZvZ.5068Nb.NXJ5DG/WTThO', NULL, 'kjkjhjj@hhh', NULL, NULL, NULL, NULL, 1509450300, NULL, 1, NULL, NULL, NULL, NULL),
(250, '103.26.246.170', 'dddd', '$2y$08$PQIGJwoGgSJmd4zk6a9sUO0iP5adDDybCfhqlABz7zKxkNTm.acxy', NULL, 'ddd@gg', NULL, NULL, NULL, NULL, 1509451031, NULL, 1, NULL, NULL, NULL, NULL),
(251, '103.26.246.170', 'wwwww', '$2y$08$e/XNombowDssScpaU1sc5.8E0gJa24efQdVbPcGtfoNO6JRceyeLS', NULL, 'ww@gmail.com', NULL, NULL, NULL, NULL, 1509777416, NULL, 1, NULL, NULL, NULL, NULL),
(252, '103.26.246.170', 'opu', '$2y$08$6qeavNT1HjeJpw8jfBAVzOirmLd58qSdizO5Gg2.mTQ9zuGw2Dasm', NULL, 'jjjj@ggh', NULL, NULL, NULL, NULL, 1509778258, NULL, 1, NULL, NULL, NULL, NULL),
(253, '103.26.246.170', 'ddd', '$2y$08$jlaGemAoQSWL4mByq4TKruWWsFeywepCiQ2d3oWWp0duyuS/E0bb.', NULL, 'll@lll', NULL, NULL, NULL, NULL, 1509778311, NULL, 1, NULL, NULL, NULL, NULL),
(254, '103.26.246.170', 'hfduih', '$2y$08$Txl/s1JTC2TD/4J3q2Ae2urbBlYqCXjO/rlXi21BKbzn8rPE.Ca0C', NULL, 'dfdf@gfg', NULL, NULL, NULL, NULL, 1509779534, NULL, 1, NULL, NULL, NULL, NULL),
(255, '103.26.246.170', 'fghfgf', '$2y$08$S8Fc92uhKjOymqjRQxirZeZpI71u3egLsr/gEKFdcPlJU.Rw16m9C', NULL, 'fthgf@fgfg', NULL, NULL, NULL, NULL, 1509781167, NULL, 1, NULL, NULL, NULL, NULL),
(256, '103.231.162.58', 'bsvsnvnvbnbvnbv', '$2y$08$3yWGstY8MAWmn6w/flv7c.LYcDiRMqUtkzm2SPyVairVyhdNoqB4i', NULL, 'nbvnbvnbvn@jhbjhg.com', NULL, NULL, NULL, NULL, 1510034923, NULL, 1, NULL, NULL, NULL, NULL),
(257, '103.26.246.170', 'Rahim', '$2y$08$2BJY1hU6NBF9rC.55LM1ZuTMsTYDhtFTx8yG7GIAMeYjWNtR.y9hi', NULL, 'rahim@gmail.com', NULL, NULL, NULL, NULL, 1510405457, 1510985791, 1, NULL, NULL, NULL, NULL),
(258, '103.26.246.170', 'Karim', '$2y$08$MYtGDNHM/wpoJHECx7jhyus4WmZEkIMEGnv4AC5IvRDPoRPgKBfuu', NULL, 'karim@gmail.com', NULL, NULL, NULL, NULL, 1510405508, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(246, 244, 5),
(248, 246, 5),
(249, 247, 5),
(250, 248, 5),
(251, 249, 4),
(252, 250, 4),
(253, 251, 5),
(254, 252, 5),
(255, 253, 5),
(256, 254, 4),
(257, 255, 4),
(258, 256, 4),
(259, 257, 4),
(260, 258, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `id` int(222) NOT NULL,
  `vaccine_id` varchar(222) NOT NULL,
  `name` varchar(250) NOT NULL,
  `no` varchar(250) NOT NULL,
  `l_date` varchar(250) NOT NULL,
  `duration` varchar(250) NOT NULL,
  `add_date` varchar(250) NOT NULL,
  `n_date` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_sub_category`
--
ALTER TABLE `expense_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livestock`
--
ALTER TABLE `livestock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shed`
--
ALTER TABLE `shed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `expense_sub_category`
--
ALTER TABLE `expense_sub_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `livestock`
--
ALTER TABLE `livestock`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=795;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shed`
--
ALTER TABLE `shed`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
