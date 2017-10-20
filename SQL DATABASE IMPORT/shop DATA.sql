-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2016 at 11:49 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `status`, `time_date`, `orderdetails`, `userid`) VALUES
(1, 'Shipped', '2016-12-23 11:19:22', ' 111 233 244 644 2311 8665', 13),
(2, 'Shipped', '2016-12-29 10:55:41', ' 111 233 244 644 2311 8665', 13);

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_ID`, `p_name`, `p_description`, `p_price`) VALUES
(233, 'Copper Pipe ', '25FT of copper pipe 1/2 inch     ', '45.00'),
(244, 'Cement', '25kg bag of cement', '5.20'),
(644, 'Hammer ', 'One BlackSpur Hammer  ', '2.90'),
(2311, 'Sand', 'One 25KG bag of cement', '5.10'),
(8665, 'Bathroom sink ', 'One Complete bathroom sink ', '250.00');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `surname`, `DOB`, `address`, `phone`, `email`, `type_user`, `username`, `password`, `sessionid`) VALUES
(1, 'lipe', 'CCT                       ', '2016-10-12', 'Apt 205 Dame St. Dublin2                   ', '0857658529                 ', 'lipe@hotmail.com', 3, 'lipe                      ', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'ndjaas7b0mnak9p3rh796geg00'),
(8, 'Ana', 'CCT                       ', '2016-10-12', 'Apt 208 Dame St. Dublin2                   ', '0857658528                 ', 'ana@hotmail.com', 3, 'ana                  ', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', ''),
(11, 'Jenny ', 'CCT   ', '1986-11-24', 'Dame street  , Dublin 2', '0899453423   ', 'jenny@gmail.com', 1, 'jenny   ', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 'ndjaas7b0mnak9p3rh796geg00'),
(12, 'Jess', 'CCT    ', '1992-09-19', 'Apt 207 , Dublin 8  ', '0897658528    ', 'jess@hotmail.com', 2, 'jess    ', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', ''),
(13, 'Tom', 'CCT         ', '2222-02-22', 'Dame St, D2  ', '0857658528 ', 'tom@hotmail.com', 4, 'tom     ', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
