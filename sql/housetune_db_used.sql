-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-02-16 16:38:00
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `housetune_db_used`
--

-- --------------------------------------------------------

--
-- 資料表結構 `category_room`
--

CREATE TABLE `category_room` (
  `id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `category_room`
--

INSERT INTO `category_room` (`id`, `name`) VALUES
(1, 'Living room'),
(2, 'Kitchen'),
(3, 'Bedroom'),
(4, 'Bathroom');

-- --------------------------------------------------------

--
-- 資料表結構 `used_product`
--

CREATE TABLE `used_product` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_room` int(3) NOT NULL,
  `categogry_product` int(3) NOT NULL,
  `description` text NOT NULL,
  `original_price` int(7) NOT NULL,
  `price` int(6) NOT NULL,
  `img` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bought_time` year(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `used_product`
--

INSERT INTO `used_product` (`id`, `name`, `category_room`, `categogry_product`, `description`, `original_price`, `price`, `img`, `bought_time`, `created_at`, `updated_at`, `valid`) VALUES
(1, 'Havbeg椅', 1, 2, '', 7000, 1000, 'Havbeg.jpg', 2012, '2022-11-04 15:12:56', '2022-11-14 23:02:12', 1),
(2, 'Arlk桌', 1, 3, '', 8000, 2000, 'Arlk.jpg', 2010, '2022-11-04 15:13:31', '0000-00-00 00:00:00', 1),
(3, 'Bingsta椅', 1, 2, '', 8000, 2000, 'Bingsta.jpg', 2008, '2022-11-04 15:16:04', '0000-00-00 00:00:00', 1),
(4, 'Borgeby桌', 1, 3, '', 7600, 1200, 'Borgeby.jpg', 2006, '2022-11-04 15:17:27', '0000-00-00 00:00:00', 1),
(5, 'Ekero椅', 3, 2, '', 7000, 5000, 'Ekero.jpg', 2021, '2022-11-04 15:23:13', '0000-00-00 00:00:00', 1),
(6, 'Gallnas椅', 1, 2, '', 10000, 7000, 'Gallnas.jpg', 2016, '2022-11-04 15:23:48', '2022-11-14 23:01:33', 1),
(7, 'Gistad椅', 1, 2, '', 12000, 6000, 'Gistad.jpg', 2008, '2022-11-04 15:23:48', '0000-00-00 00:00:00', 1),
(8, 'Glostad沙發', 1, 1, '', 13000, 6000, 'Glostad.jpg', 2009, '2022-11-04 15:26:04', '0000-00-00 00:00:00', 1),
(9, 'Hemnes桌', 1, 3, '', 7600, 4000, 'Hemnes.jpg', 2018, '2022-11-04 15:26:57', '0000-00-00 00:00:00', 1),
(10, 'Hol桌', 1, 3, '', 4600, 1000, 'Hol.jpg', 2005, '2022-11-04 15:27:44', '2022-11-14 23:01:57', 1),
(11, 'Kivik沙發', 1, 1, '', 15000, 8000, 'Kivik.jpg', 2020, '2022-11-04 15:28:29', '2022-11-14 23:01:50', 1),
(12, 'Klippan沙發', 1, 1, '', 13000, 10000, 'Klippan.jpg', 2018, '2022-11-04 15:29:25', '0000-00-00 00:00:00', 1),
(13, 'Landskrona沙發', 1, 1, '', 13000, 7000, 'Landskrona.jpg', 2017, '2022-11-04 15:30:07', '0000-00-00 00:00:00', 1),
(14, 'Liatrop桌', 1, 3, '', 7600, 2000, 'Liatrop.jpg', 2007, '2022-11-04 15:30:46', '0000-00-00 00:00:00', 1),
(15, 'Poang椅', 1, 2, '', 10000, 7000, 'Poang.jpg', 2010, '2022-11-04 15:31:31', '0000-00-00 00:00:00', 1),
(16, 'Remsta椅', 1, 2, '', 9000, 3000, 'Remsta.jpg', 2005, '2022-11-04 15:32:41', '0000-00-00 00:00:00', 1),
(17, 'Strandmon椅', 1, 2, '', 8000, 7000, 'Strandmon.jpg', 2020, '2022-11-04 15:33:28', '0000-00-00 00:00:00', 1),
(18, 'Vimle沙發', 1, 1, '', 16000, 8000, 'Vimle.jpg', 2015, '2022-11-04 15:34:11', '0000-00-00 00:00:00', 1),
(19, 'Viskabacka椅', 1, 2, '', 13000, 11000, 'Viskabacka.jpg', 2020, '2022-11-04 15:34:41', '0000-00-00 00:00:00', 1),
(20, 'Vittsjo桌', 2, 3, '', 10000, 8000, 'Vittsjo.jpg', 2009, '2022-11-04 15:35:26', '0000-00-00 00:00:00', 1),
(22, 'Norden桌', 2, 3, '', 5000, 3000, 'Norden.jpg', 2012, '2022-11-11 15:01:11', '2022-11-11 15:01:11', 1),
(23, 'Barsviken桌', 2, 3, '', 7600, 8000, 'Barsviken.jpg', 2013, '2022-11-11 15:06:05', '2022-11-11 15:06:05', 1),
(24, 'Kallhall桌', 2, 3, '', 8000, 3000, 'Kallhall.jpg', 2014, '2022-11-11 15:07:23', '2022-11-11 15:07:23', 1),
(25, 'Danderyd桌 ', 2, 1, '', 13000, 5000, 'Danderyd.jpg', 2015, '2022-11-11 15:08:05', '2022-11-11 15:08:05', 1),
(26, 'Ingatorp桌', 2, 3, '', 8000, 4000, 'Ingatorp.jpg', 2016, '2022-11-11 15:09:09', '2022-11-14 23:01:15', 1),
(27, 'Friheten沙發', 2, 1, '', 13000, 10000, 'Friheten.jpg', 2017, '2022-11-11 15:10:00', '2022-11-11 15:10:00', 1),
(28, 'Vrestorp沙發', 2, 1, '', 14000, 6000, 'Vrestorp.jpg', 2018, '2022-11-11 15:10:46', '2022-11-11 15:10:46', 1),
(29, 'Ekolsund椅', 3, 2, '', 7600, 4000, 'Ekolsund.jpg', 2016, '2022-11-11 15:12:37', '2022-11-11 15:12:37', 1),
(30, 'Soderhamn椅', 3, 2, '', 13000, 8000, 'Soderhamn.jpg', 2015, '2022-11-11 15:13:58', '2022-11-11 15:13:58', 1),
(31, 'Stocksund椅', 3, 2, '', 10000, 4000, 'Stocksund.jpg', 2014, '2022-11-11 15:14:58', '2022-11-11 15:14:58', 1),
(32, 'Ekod椅', 3, 2, '', 13000, 4000, 'Ekod.jpg', 2014, '2022-11-11 15:16:25', '2022-11-11 15:16:25', 1),
(33, 'Viskafors椅', 3, 2, '', 15000, 9000, 'Viskafors.jpg', 2013, '2022-11-11 15:18:37', '2022-11-11 15:18:37', 1),
(34, 'Tofteryd桌', 1, 2, '', 7000, 3500, 'Tofteryd.jpg', 2017, '2022-11-11 15:21:09', '2022-11-11 15:21:09', 1),
(35, 'Ypperlig桌', 1, 2, '', 8000, 5000, 'Ypperlig.jpg', 2018, '2022-11-11 15:22:36', '2022-11-11 15:22:36', 1),
(36, 'Lycksele沙發', 3, 1, '', 7000, 5000, 'Lycksele.jpg', 2020, '2022-11-11 15:25:29', '2022-11-11 15:25:29', 1),
(37, 'Flottebo沙發', 3, 2, '', 15000, 8000, 'Flottebo.jpg', 2013, '2022-11-11 15:26:10', '2022-11-11 15:26:10', 1),
(38, 'Holmsund沙發', 3, 2, 'amazing\r\n', 10000, 6000, 'Holmsund.jpg', 2014, '2022-11-11 15:28:10', '2022-11-14 17:58:45', 1),
(39, 'Odensvik櫃', 4, 4, '', 9000, 7000, 'Odensvik.jpg', 2020, '2022-11-11 15:29:54', '2022-11-11 15:29:54', 1),
(40, 'Godmorgon鏡', 4, 4, '', 8000, 6000, 'Godmorgon.jpg', 2021, '2022-11-11 15:31:22', '2022-11-11 15:31:22', 1),
(41, 'Sandared凳', 3, 2, '', 3000, 1000, 'Sandared.jpg', 2020, '2022-11-14 22:54:03', '2022-11-14 22:54:03', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `category_room`
--
ALTER TABLE `category_room`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `used_product`
--
ALTER TABLE `used_product`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `category_room`
--
ALTER TABLE `category_room`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `used_product`
--
ALTER TABLE `used_product`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
