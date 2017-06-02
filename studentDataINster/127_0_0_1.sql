-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-11 14:56:02
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_data`
--
CREATE DATABASE IF NOT EXISTS `student_data` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `student_data`;

-- --------------------------------------------------------

--
-- 表的结构 `undergraduate`
--

CREATE TABLE `undergraduate` (
  `id` int(11) NOT NULL COMMENT '序号',
  `forecast` varchar(24) NOT NULL COMMENT '预报名号',
  `card_number` varchar(64) NOT NULL COMMENT '准考证号',
  `name` varchar(24) NOT NULL COMMENT '姓名',
  `sex` int(11) NOT NULL COMMENT '性别',
  `birthData` date NOT NULL COMMENT '出生年月',
  `profession` varchar(64) NOT NULL COMMENT '首报专业',
  `level` varchar(20) NOT NULL COMMENT '学历层次',
  `Identity` char(18) NOT NULL COMMENT '身份证号码',
  `iphone` char(11) NOT NULL COMMENT '联系电话'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `undergraduate`
--
ALTER TABLE `undergraduate`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `undergraduate`
--
ALTER TABLE `undergraduate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
