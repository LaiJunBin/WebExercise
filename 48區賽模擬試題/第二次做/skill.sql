-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018-04-02 05:27:23
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
  `l_css` text NOT NULL,
  `l_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `news`
--

CREATE TABLE `news` (
  `n_id` int(10) NOT NULL,
  `n_title` varchar(100) NOT NULL,
  `n_content` text NOT NULL,
  `n_link` varchar(100) NOT NULL,
  `n_count` int(10) NOT NULL,
  `n_category` varchar(100) NOT NULL,
  `n_img` varchar(100) NOT NULL,
  `n_layout` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `u_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `u_password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `u_type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `u_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`u_id`, `u_username`, `u_name`, `u_password`, `u_type`, `u_login`) VALUES
(0, 'admin', 'admin', '1234', '管理者', '2018-04-02 09:26:39');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`l_id`);

--
-- 資料表索引 `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`n_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `layout`
--
ALTER TABLE `layout`
  MODIFY `l_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
