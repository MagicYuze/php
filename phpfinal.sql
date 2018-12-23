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

insert  into `goods`(`gid`,`gname`,`introduction`,`picture`,`cid`,`price`,`gcount`,`state`) values (1,'苹果(红富士)','新鲜的苹果。','/php/admin/img/goods/apple.jpg',1,12,10000,1),(2,'可口可乐(250ml)','外国进口！','\\php\\admin\\img\\goods\\15.png',2,5,2000,1),(0,'雪碧(500ml)','暂无！','\\php\\admin\\img\\goods\\16.png',2,8,1000,1),(5,'可乐(300ml)','暂无!','\\php\\admin\\img\\goods\\2.png',2,3.5,1000,1),(4,'啊华田(300ml)','暂无！','\\php\\admin\\img\\goods\\14.png',2,4,1000,1),(6,'洗洁剂','不伤手','\\php\\admin\\img\\goods\\17.png',7,15,1200,1),(3,'水果啤酒(3罐装)','外国进口！酒精度为15','\\php\\admin\\img\\goods\\23.jpg',2,12,1000,1),(7,'全面屏手机','500元以下！难得的机会','\\php\\admin\\img\\goods\\phone1.jpg',3,398,0,1),(8,'老年人手机','洛基亚牌子，耐用','\\php\\admin\\img\\goods\\phone2.jpg',3,55,50,1),(9,'红米6Pro','大减价了','\\php\\admin\\img\\goods\\红米6Pro.jpg',3,588,300,1),(10,'智睿i3台机','大减价了','\\php\\admin\\img\\goods\\computer1.jpg',4,788,320,1),(11,'超清屏','大减价了','\\php\\admin\\img\\goods\\show1.png',4,1599,30,1),(12,'扫地机器人','最新产品','\\php\\admin\\img\\goods\\homeuse.jpg',5,2955,32,1),(13,'100%羊毛','女装','\\php\\admin\\img\\goods\\clothes.jpg',6,538,50,1),(14,'农家葡萄酒','手工制作','\\php\\admin\\img\\goods\\wine1.jpg',2,31.8,5,1),(15,'白葡萄酒','德国进口','\\php\\admin\\img\\goods\\wine2.jpg',2,136,15,1),(16,'荔枝酒','低度数','\\php\\admin\\img\\goods\\wine3.jpg',2,112,10,1),(17,'果汁酒饮料','日本进口','\\php\\admin\\img\\goods\\wine4.png',2,14.5,6,1),(18,'点钞机','点钞效率超级高！','/php/admin/img/goods/dianchaoji.jpg',4,1888,11,1);

/*Table structure for table `orders` */

CREATE TABLE `orders` (
  `oid` varchar(20) NOT NULL COMMENT '订单号',
  `odate` datetime NOT NULL COMMENT '订单产生时间',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `goodslist` mediumtext NOT NULL COMMENT '商品列表｛gid：商品id，gnum：购买商品数量｝',
  `state` tinyint(1) NOT NULL COMMENT '订单状态',
  `money` double NOT NULL COMMENT '订单总金额',
  PRIMARY KEY (`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

/*Data for the table `orders` */

insert  into `orders`(`oid`,`odate`,`uid`,`goodslist`,`state`,`money`) values ('h0k0x653hea9l9gus0qs','2018-12-23 11:06:37',2,'%5B%7B%22gid%22%3A0%2C%22gnum%22%3A6%7D%5D',0,48),('9thwyxkbkhs1cnwwxcmf','2018-12-23 11:06:45',2,'%5B%7B%22gid%22%3A1%2C%22gnum%22%3A5%7D%5D',0,60),('ixvbgzh4ypbms7zev8p8','2018-12-23 11:11:02',2,'%5B%7B%22gid%22%3A2%2C%22gnum%22%3A3%7D%5D',0,15),('v9a04hgwdr2et6aaatnc','2018-12-23 10:52:05',5,'%5B%7B%22gid%22%3A2%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A0%2C%22gnum%22%3A2%7D%2C%7B%22gid%22%3A5%2C%22gnum%22%3A3%7D%2C%7B%22gid%22%3A4%2C%22gnum%22%3A2%7D%5D',0,39.5),('p4ezp1s1otrnjnl66929','2018-12-23 11:00:51',2,'%5B%7B%22gid%22%3A0%2C%22gnum%22%3A%226%22%7D%5D',0,48),('l9ar3mv4iy7d5uwmwd9d','2018-12-23 11:00:18',5,'%5B%7B%22gid%22%3A2%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A0%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A5%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A4%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A3%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A16%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A13%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A1%2C%22gnum%22%3A2%7D%2C%7B%22gid%22%3A6%2C%22gnum%22%3A2%7D%2C%7B%22gid%22%3A7%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A8%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A9%2C%22gnum%22%3A1%7D%5D',0,1777.5),('5hsdokbioieftmv7uqt0','2018-12-23 10:59:34',2,'%5B%7B%22gid%22%3A1%2C%22gnum%22%3A4%7D%5D',0,48),('q5xso1p31hypk1jz3j2p','2018-12-23 10:59:26',2,'%5B%7B%22gid%22%3A1%2C%22gnum%22%3A3%7D%5D',0,36),('soit76xxte18ntaqnrx1','2018-12-23 10:59:23',5,'%5B%7B%22gid%22%3A12%2C%22gnum%22%3A1%7D%2C%7B%22gid%22%3A18%2C%22gnum%22%3A1%7D%5D',0,4843),('c3y5egvu7l4ibt6q2wsr','2018-12-23 10:59:13',2,'%5B%7B%22gid%22%3A1%2C%22gnum%22%3A2%7D%5D',0,24),('s786omrd1vd2c2psesad','2018-12-23 10:58:32',2,'%5B%7B%22gid%22%3A2%2C%22gnum%22%3A3%7D%5D',0,15),('5homp3oouv5h04jamdsb','2018-12-23 10:56:32',2,'%5B%7B%22gid%22%3A5%2C%22gnum%22%3A%223%22%7D%5D',0,10.5),('7qzwps2i9w010itaz4y8','2018-12-23 11:14:17',2,'%5B%7B%22gid%22%3A1%2C%22gnum%22%3A1%7D%5D',0,12),('721sd7ehseoz7th9efrs','2018-12-23 12:18:38',2,'%5B%7B%22gid%22%3A1%2C%22gnum%22%3A1%7D%5D',0,12),('c9g5ikjwcpreno56pcrv','2018-12-23 12:21:10',2,'%5B%7B%22gid%22%3A7%2C%22gnum%22%3A%222%22%7D%5D',0,796);

/*Table structure for table `user` */

CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `uname` varchar(20) DEFAULT NULL COMMENT '用户名',
  `password` varchar(20) DEFAULT NULL COMMENT '密码',
  `phone` varchar(13) DEFAULT NULL COMMENT '手机号',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `state` tinyint(4) DEFAULT '1' COMMENT '状态',
  `level` tinyint(4) DEFAULT '0' COMMENT '权限',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`uid`,`uname`,`password`,`phone`,`email`,`state`,`level`) values (1,'admin','admin',NULL,NULL,1,1),(2,'MagicYang','123123','13433633248','yangyuze1997@qq.com',1,0),(4,'top','123','561511','123456@qq.com',1,1),(5,'liqiang','123','561511','123456@qq.com',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
