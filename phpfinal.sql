/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.5.57-log : Database - phpfinal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`phpfinal` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `phpfinal`;

/*Table structure for table `cart` */

CREATE TABLE `cart` (
  `tid` varchar(20) NOT NULL COMMENT '购物车编号',
  `uid` int(11) NOT NULL COMMENT '用户信息',
  `goodslist` varchar(100) NOT NULL COMMENT '商品列表｛gid：商品id，gnum：购买商品数量｝',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cart` */

/*Table structure for table `category` */

CREATE TABLE `category` (
  `cid` int(11) NOT NULL COMMENT '分类id',
  `cname` varchar(20) NOT NULL COMMENT '分类名称',
  `state` tinyint(1) NOT NULL COMMENT '分类状态',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='物品分类表';

/*Data for the table `category` */

insert  into `category`(`cid`,`cname`,`state`) values (2,'酒水饮料',1),(3,'手机数码',1),(4,'电脑办公',1),(5,'家用电器',1),(6,'男装女装',1),(1,'食品生鲜',1),(7,'其他',1);

/*Table structure for table `goods` */

CREATE TABLE `goods` (
  `gid` int(11) NOT NULL COMMENT '商品id',
  `gname` varchar(20) NOT NULL COMMENT '商品名称',
  `introduction` varchar(100) NOT NULL COMMENT '商品详情',
  `picture` varchar(100) NOT NULL DEFAULT '\\php\\admin\\img\\goods\\default.jpg' COMMENT '商品图片地址',
  `cid` int(11) NOT NULL COMMENT '商品类别',
  `price` double NOT NULL COMMENT '商品价格',
  `gcount` int(11) NOT NULL COMMENT '商品库存',
  `state` tinyint(1) NOT NULL COMMENT '商品状态',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品表';

/*Data for the table `goods` */

insert  into `goods`(`gid`,`gname`,`introduction`,`picture`,`cid`,`price`,`gcount`,`state`) values (1,'苹果(红富士)','新鲜的苹果。','/php/admin/img/goods/apple.jpg',1,12,1000,1),(0,'雪碧(500ml)','暂无！','\\php\\admin\\img\\goods\\16.png',2,8,1000,1),(5,'可乐(300ml)','暂无!','\\php\\admin\\img\\goods\\2.png',2,3.5,1000,1),(4,'啊华田(300ml)','暂无！','\\php\\admin\\img\\goods\\14.png',2,4,1000,1),(6,'洗洁剂','不伤手','\\php\\admin\\img\\goods\\17.png',7,15,1200,1);

/*Table structure for table `orders` */

CREATE TABLE `orders` (
  `oid` varchar(20) NOT NULL COMMENT '订单号',
  `odate` datetime NOT NULL COMMENT '订单产生时间',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `goodslist` varchar(100) NOT NULL COMMENT '商品列表｛gid：商品id，gnum：购买商品数量｝',
  `state` tinyint(1) NOT NULL COMMENT '订单状态',
  `money` double NOT NULL COMMENT '订单总金额',
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

/*Data for the table `orders` */

insert  into `orders`(`oid`,`odate`,`uid`,`goodslist`,`state`,`money`) values ('E45G689KJ654FGHY7NB','2018-12-14 09:00:26',2,'[{\"gid\":2,\"gnum\":3},{\"gid\":1,\"gnum\":3}]',0,1534),('R7JO689KJ654FGHY7NB','2018-12-19 09:57:26',2,'[{\"gid\":1,\"gnum\":4},{\"gid\":2,\"gnum\":3}]',1,655.5),('BHU6G89KJ654FGHY7NB','2018-12-19 09:57:26',2,'[{\"gid\":2,\"gnum\":4},{\"gid\":1,\"gnum\":3}]',2,22.8);

/*Table structure for table `user` */

CREATE TABLE `user` (
  `uid` int(11) NOT NULL COMMENT '用户id',
  `uname` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(30) NOT NULL COMMENT '密码',
  `openid` varchar(80) NOT NULL COMMENT 'QQopenid',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `state` tinyint(1) NOT NULL COMMENT '状态',
  `level` tinyint(1) NOT NULL COMMENT '权限',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

/*Data for the table `user` */

insert  into `user`(`uid`,`uname`,`password`,`openid`,`phone`,`email`,`state`,`level`) values (1,'admin','admin','','','',1,1),(2,'MagicYang','123123','','13433633248','yangyuze1997@qq.com',0,0),(3,'LinLiqiang','123123','','','1833608080@qq.com',1,0),(4,'ZhangJinjian','123123','','','',1,0),(0,'jan','321321','','15625708071','435770815@qq.com',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
