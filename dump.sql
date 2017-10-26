-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016 年 10 朁E31 日 19:05
-- サーバのバージョン： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lig`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `division` varchar(7) DEFAULT NULL,
  `department` varchar(9) DEFAULT NULL,
  `name` varchar(7) DEFAULT NULL,
  `kana` varchar(10) DEFAULT NULL,
  `nickname` varchar(11) DEFAULT NULL,
  `cid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `employee`
--

INSERT INTO `employee` (`id`, `division`, `department`, `name`, `kana`, `nickname`, `cid`) VALUES
(1, 'A部', 'ｰ', '山田 太郎', 'ヤマダ タロウ', 'たろう', 0),
(2, 'B部', 'ｰ', '佐藤　花子', 'サトウ ハナコ', 'はな', 0),
(3, 'C部', 'ｰ', '鈴木 武', 'ススキ タケシ', 'たけ', 0),
(4, 'D部', 'ｰ', '武田 剛', 'タケダ　ゴウ', 'ごう', 0),
(5, 'E部', '-', '吉田 栄太', 'ヨシダ エイタ', 'えい', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hours` varchar(2) CHARACTER SET utf8 NOT NULL,
  `minutes` varchar(2) CHARACTER SET utf8 NOT NULL,
  `company` varchar(64) CHARACTER SET utf8 NOT NULL,
  `customer` varchar(32) CHARACTER SET utf8 NOT NULL,
  `employee` varchar(11) CHARACTER SET utf8 NOT NULL,
  `code` varchar(4) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
