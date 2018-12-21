-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-12-21 14:35:16
-- 服务器版本： 5.5.57-log
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpfinal`
--

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `tid` varchar(20) NOT NULL COMMENT '购物车编号',
  `uid` int(11) NOT NULL COMMENT '用户信息',
  `goodslist` varchar(100) NOT NULL COMMENT '商品列表｛gid：商品id，gnum：购买商品数量｝'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(11) NOT NULL COMMENT '分类id',
  `cname` varchar(20) NOT NULL COMMENT '分类名称',
  `state` tinyint(1) NOT NULL COMMENT '分类状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='物品分类表';

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`cid`, `cname`, `state`) VALUES
(2, '酒水饮料', 1),
(3, '手机数码', 1),
(4, '电脑办公', 1),
(5, '家用电器', 1),
(6, '男装女装', 1),
(1, '食品生鲜', 1),
(7, '测试', 1);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `gid` int(11) NOT NULL COMMENT '商品id',
  `gname` varchar(20) NOT NULL COMMENT '商品名称',
  `introduction` varchar(100) NOT NULL COMMENT '商品详情',
  `picture` varchar(100) NOT NULL DEFAULT '\\php\\admin\\img\\goods\\default.jpg' COMMENT '商品图片地址',
  `cid` int(11) NOT NULL COMMENT '商品类别',
  `price` double NOT NULL COMMENT '商品价格',
  `gcount` int(11) NOT NULL COMMENT '商品库存',
  `state` tinyint(1) NOT NULL COMMENT '商品状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品表';

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`gid`, `gname`, `introduction`, `picture`, `cid`, `price`, `gcount`, `state`) VALUES
(1, '苹果', '新鲜的苹果。', '/php/admin/img/goods/微信图片_20181216150236.jpg', 1, 12, 1000, 1),
(2, '测试', '最后一次了！', '/php/admin/img/goods/default.jpg', 4, 1000, 200, 1);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `oid` varchar(20) NOT NULL COMMENT '订单号',
  `odate` datetime NOT NULL COMMENT '订单产生时间',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `goodslist` varchar(100) NOT NULL COMMENT '商品列表｛gid：商品id，gnum：购买商品数量｝',
  `state` tinyint(1) NOT NULL COMMENT '订单状态',
  `money` double NOT NULL COMMENT '订单总金额'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`oid`, `odate`, `uid`, `goodslist`, `state`, `money`) VALUES
('E45G689KJ654FGHY7NB', '2018-12-14 09:00:26', 2, '[{"gid":2,"gnum":3},{"gid":1,"gnum":3}]', 0, 1534),
('R7JO689KJ654FGHY7NB', '2018-12-19 09:57:26', 2, '[{"gid":1,"gnum":4},{"gid":2,"gnum":3}]', 1, 655.5),
('BHU6G89KJ654FGHY7NB', '2018-12-19 09:57:26', 2, '[{"gid":2,"gnum":4},{"gid":1,"gnum":3}]', 2, 22.8);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL COMMENT '用户id',
  `uname` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(30) NOT NULL COMMENT '密码',
  `openid` varchar(80) NOT NULL COMMENT 'QQopenid',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `state` tinyint(1) NOT NULL COMMENT '状态',
  `level` tinyint(1) NOT NULL COMMENT '权限'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `uname`, `password`, `openid`, `phone`, `email`, `state`, `level`) VALUES
(1, 'admin', 'admin', '', '', '', 1, 1),
(2, 'MagicYang', '123123', '', '13433633248', 'yangyuze1997@qq.com', 1, 0),
(3, 'LinLiqiang', '123123', '', '', '1833608080@qq.com', 1, 0),
(4, 'ZhangJinjian', '123123', '', '', '', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
