-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-03-31 05:06:36
-- 伺服器版本: 10.1.31-MariaDB
-- PHP 版本： 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `skill`
--

-- --------------------------------------------------------

--
-- 資料表結構 `layout`
--

CREATE TABLE `layout` (
  `l_id` int(10) NOT NULL,
  `l_title` varchar(100) NOT NULL,
  `l_css` text NOT NULL,
  `l_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `login`
--

CREATE TABLE `login` (
  `l_id` int(10) NOT NULL,
  `l_number` varchar(10) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `l_username` varchar(100) NOT NULL,
  `l_password` varchar(100) NOT NULL,
  `l_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `l_login` datetime NOT NULL,
  `l_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `login`
--

INSERT INTO `login` (`l_id`, `l_number`, `l_name`, `l_username`, `l_password`, `l_date`, `l_login`, `l_type`) VALUES
(1, '000', 'admin', 'admin', '1234', '2018-03-31 08:46:44', '2018-03-31 08:46:54', '管理員');

-- --------------------------------------------------------

--
-- 資料表結構 `news`
--

CREATE TABLE `news` (
  `n_id` int(10) NOT NULL,
  `n_title` varchar(10) NOT NULL,
  `n_content` text NOT NULL,
  `n_img` varchar(100) NOT NULL,
  `n_link` varchar(100) NOT NULL,
  `n_layout` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`l_id`);

--
-- 資料表索引 `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`l_id`);

--
-- 資料表索引 `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`n_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `layout`
--
ALTER TABLE `layout`
  MODIFY `l_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `login`
--
ALTER TABLE `login`
  MODIFY `l_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
