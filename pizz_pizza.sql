-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 04:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizz_pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_username` text NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  `admin_position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_username`, `admin_password`, `admin_position`) VALUES
(1, 'Nico', 'lee', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(11) NOT NULL,
  `customer_ID` int(11) NOT NULL,
  `crust_ID` int(11) NOT NULL,
  `size_ID` int(11) NOT NULL,
  `topping_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `cart_total_price` float(50,2) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `customer_ID`, `crust_ID`, `size_ID`, `topping_ID`, `product_ID`, `quantity`, `cart_total_price`, `order_id`) VALUES
(51, 3, 1, 1, 1, 3, 1, 15.00, 25),
(52, 3, 1, 2, 5, 7, 1, 25.00, 25),
(53, 3, 1, 1, 1, 4, 1, 17.00, 26),
(54, 3, 1, 1, 1, 9, 1, 16.50, 26),
(55, 3, 1, 1, 1, 13, 1, 18.00, 26),
(56, 1, 1, 1, 1, 7, 1, 19.00, 27),
(57, 3, 1, 1, 1, 1, 1, 20.00, 28),
(58, 3, 1, 1, 1, 13, 1, 18.00, 28),
(59, 3, 1, 3, 1, 4, 1, 27.00, 29),
(60, 3, 1, 2, 4, 9, 1, 23.50, 29),
(61, 3, 1, 1, 1, 13, 1, 18.00, 29),
(62, 3, 1, 1, 1, 4, 1, 17.00, 30),
(63, 3, 1, 1, 1, 8, 1, 13.50, 30),
(64, 3, 1, 1, 1, 3, 1, 15.00, 31),
(65, 3, 1, 1, 1, 8, 1, 13.50, 31),
(66, 3, 1, 1, 1, 4, 1, 17.00, 32),
(67, 3, 1, 1, 1, 7, 1, 19.00, 32),
(68, 1, 1, 1, 1, 3, 1, 15.00, 33),
(69, 1, 1, 2, 5, 4, 1, 23.00, 33),
(70, 1, 1, 1, 1, 3, 1, 15.00, 37),
(71, 4, 1, 1, 1, 3, 1, 15.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_ID` int(11) NOT NULL,
  `cus_firstName` text NOT NULL,
  `cus_lastName` text NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `cus_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_ID`, `cus_firstName`, `cus_lastName`, `cus_email`, `cus_password`) VALUES
(1, 'sada', 'asd', 'asd@gmail.com', 'asd'),
(2, 'Nico', 'Lee', 'nico@gmail.com', 'nico12'),
(3, 'www', 'aaa', 'wa@gmail.com', 'was'),
(4, 'jaden', 'martin', 'jaden@gmail.com', 'jadenhandsome');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `feedback_message` text NOT NULL,
  `feedback_date` date NOT NULL,
  `feedback_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_ID`, `name`, `email`, `feedback_message`, `feedback_date`, `feedback_time`) VALUES
(4, 'nico', 'lee@gmail.com', 'good', '2023-06-24', '11:06:29'),
(10, 'as', 'as@gmail.com', 'sad', '2023-06-25', '21:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_crust`
--

CREATE TABLE `pizza_crust` (
  `crust_ID` int(11) NOT NULL,
  `crust_name` text NOT NULL,
  `crust_price` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizza_crust`
--

INSERT INTO `pizza_crust` (`crust_ID`, `crust_name`, `crust_price`) VALUES
(1, 'thin', '0.00'),
(2, 'thick', '0.00'),
(3, 'stuffed crust', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_order`
--

CREATE TABLE `pizza_order` (
  `order_id` int(11) NOT NULL,
  `total_price` float(50,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_phone` text NOT NULL,
  `customer_address` text NOT NULL,
  `payment` text NOT NULL,
  `purchase_date` text NOT NULL,
  `purchase_time` text NOT NULL,
  `rider_id` int(11) NOT NULL DEFAULT 0,
  `pickup` int(2) NOT NULL DEFAULT 0,
  `delivered` int(2) NOT NULL DEFAULT 0,
  `user_confirmation` int(2) NOT NULL DEFAULT 0,
  `payment_status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizza_order`
--

INSERT INTO `pizza_order` (`order_id`, `total_price`, `user_id`, `customer_name`, `customer_phone`, `customer_address`, `payment`, `purchase_date`, `purchase_time`, `rider_id`, `pickup`, `delivered`, `user_confirmation`, `payment_status`) VALUES
(25, 44.00, 3, 'Yap', '019-1111111', '61,sdasdadasdasdsa, ergedthrfgbdfgdgdgfg.', 'PayPal', '20/06/2023', '10:53pm', 2, 1, 1, 1, 1),
(26, 55.50, 3, 'abu', '012-123456744', '44, saefsdfgdgdfgsdfg, srgdfgdfgsfasdfadf.', 'HLBank', '20/06/2023', '11:03pm', 2, 1, 1, 1, 1),
(27, 23.00, 1, 'sad', '023-23346654757', '66, dfsdfsdfsdfsdf, rsgdrgderfaedasdasd.', 'PayPal', '20/06/2023', '11:10pm', 1, 1, 1, 1, 1),
(28, 42.00, 3, 'bbbbb', '123-1342534534', '43, srgfsdfsdfsdfs, rhfhdfgsdfsd', 'CIMB', '20/06/2023', '11:12pm', 2, 1, 1, 1, 1),
(29, 72.50, 3, 'yap', '011-2324353563', '31, fdfsfsdfsdfsf, sdfsdfs.', 'PayPal', '21/06/2023', '06:05pm', 2, 1, 1, 1, 1),
(30, 34.50, 3, '1111111', '343433545', '43, wdfsdfsdfsdfs, sfdfgdgsdf.', 'HLBank', '21/06/2023', '06:11pm', 0, 0, 0, 0, 0),
(31, 32.50, 3, '324234', '012-435346456', '32, srdgfdfgdfgsdfgd, yhjfgdfgdfg.', 'PayPal', '21/06/2023', '06:16pm', 2, 1, 1, 1, 1),
(32, 40.00, 3, 'sdsff', '34-4565765', '32, sdfgdfg, dfghdfgsfdsdf.', 'PayPal', '21/06/2023', '06:17pm', 0, 0, 0, 0, 0),
(33, 42.00, 1, 'Nico', '011-62056682', '73,Jalan besar, 54', 'HLBank', '22/06/2023', '11:46pm', 1, 1, 1, 1, 1),
(34, 4.00, 1, 'nicp', '123123', '1231ws  fef', 'PayPal', '22/06/2023', '11:47pm', 0, 0, 0, 0, 0),
(35, 4.00, 1, 'nicp', '123123', '1231ws  fef', 'PayPal', '22/06/2023', '11:48pm', 0, 0, 0, 0, 0),
(36, 4.00, 1, 'nio  ', '1231234', 'njalan besar', 'CIMB', '22/06/2023', '11:48pm', 1, 1, 1, 1, 1),
(37, 19.00, 1, 'nico', '11', '21', 'HLBank', '23/06/2023', '11:13pm', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pizza_size`
--

CREATE TABLE `pizza_size` (
  `size_ID` int(11) NOT NULL,
  `size_name` text NOT NULL,
  `size_price` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizza_size`
--

INSERT INTO `pizza_size` (`size_ID`, `size_name`, `size_price`) VALUES
(1, 'small', '0.00'),
(2, 'medium', '5.00'),
(3, 'large', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_topping`
--

CREATE TABLE `pizza_topping` (
  `topping_ID` int(11) NOT NULL,
  `topping_name` text NOT NULL,
  `topping_price` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizza_topping`
--

INSERT INTO `pizza_topping` (`topping_ID`, `topping_name`, `topping_price`) VALUES
(1, 'none', '0.00'),
(2, 'sausage', '1.50'),
(3, 'mushrooms', '1.50'),
(4, 'bacon', '2.00'),
(5, 'onions', '1.00'),
(6, 'pepperoni', '2.50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` decimal(50,2) NOT NULL,
  `product_rating` decimal(5,1) NOT NULL,
  `product_category` text NOT NULL,
  `product_description` text NOT NULL,
  `available` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_rating`, `product_category`, `product_description`, `available`) VALUES
(1, 'Viennese', '20.00', '4.0', 'meat', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 0),
(2, 'Mimosa', '18.00', '4.0', 'meat', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 0),
(3, 'Boscaiola', '15.00', '5.0', 'meat', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(4, 'Mare Monti', '17.00', '3.9', 'seafood', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(5, 'Al Tonno', '15.00', '4.0', 'seafood', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(6, 'Zucca', '15.50', '3.8', 'seafood', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(7, 'Frutti Mare', '19.00', '4.2', 'seafood', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(8, 'England Bar', '13.50', '4.2', 'vegetarian', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(9, 'Pinakbet', '16.50', '4.6', 'vegetarian', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(10, 'Ricotta', '16.80', '4.1', 'vegetarian', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(11, 'Bufalina', '15.00', '4.3', 'vegetarian', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(12, 'Funghi', '14.50', '4.0', 'vegetarian', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1),
(13, 'Quattro', '18.00', '4.6', 'vegetarian', 'All ingredients are cut into thin strips and stir-fried until done before they are placed onto the pizza base. The pizza is usually smeared with tomato paste and sprinkled with cheese such as mozzarella.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `rider_ID` int(11) NOT NULL,
  `rider_username` text NOT NULL,
  `rider_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rider`
--

INSERT INTO `rider` (`rider_ID`, `rider_username`, `rider_password`) VALUES
(1, 'Abu', 'mham');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`),
  ADD KEY `1` (`crust_ID`),
  ADD KEY `2` (`customer_ID`),
  ADD KEY `3` (`product_ID`),
  ADD KEY `4` (`size_ID`),
  ADD KEY `5` (`topping_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_ID`);

--
-- Indexes for table `pizza_crust`
--
ALTER TABLE `pizza_crust`
  ADD PRIMARY KEY (`crust_ID`);

--
-- Indexes for table `pizza_order`
--
ALTER TABLE `pizza_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pizza_size`
--
ALTER TABLE `pizza_size`
  ADD PRIMARY KEY (`size_ID`);

--
-- Indexes for table `pizza_topping`
--
ALTER TABLE `pizza_topping`
  ADD PRIMARY KEY (`topping_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`rider_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pizza_crust`
--
ALTER TABLE `pizza_crust`
  MODIFY `crust_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pizza_order`
--
ALTER TABLE `pizza_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pizza_size`
--
ALTER TABLE `pizza_size`
  MODIFY `size_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pizza_topping`
--
ALTER TABLE `pizza_topping`
  MODIFY `topping_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rider`
--
ALTER TABLE `rider`
  MODIFY `rider_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
