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

/*Table structure for table `address` */

CREATE TABLE `address` (
  `aid` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址id',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  PRIMARY KEY (`aid`),
  UNIQUE KEY `aid` (`aid`),
  KEY `uid` (`uid`),
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `address` */

insert  into `address`(`aid`,`uid`,`address`) values (1,2,'东莞理工学院学生宿舍楼8栋'),(2,3,'东莞理工学院学生宿舍楼23栋'),(3,4,'东莞理工学院学生宿舍楼8栋'),(4,6,'东莞理工皇家学院'),(5,6,'学生宿舍楼23栋'),(6,7,'学生宿舍8栋'),(7,5,'帝国理工');

/*Table structure for table `category` */

CREATE TABLE `category` (
  `cid` int(11) NOT NULL COMMENT '分类id',
  `cname` varchar(20) NOT NULL COMMENT '分类名称',
  `state` tinyint(1) NOT NULL COMMENT '分类状态',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物品分类表';

/*Data for the table `category` */

insert  into `category`(`cid`,`cname`,`state`) values (1,'魅族',1),(2,'华为',1),(3,'OPPO',1),(4,'vivo',1),(5,'iPhone',1),(6,'小米',1);

/*Table structure for table `comment` */

CREATE TABLE `comment` (
  `ccid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `gid` int(11) DEFAULT NULL COMMENT '商品id',
  `type` varchar(50) DEFAULT NULL COMMENT '商品型号',
  `ctime` datetime DEFAULT NULL COMMENT '评论时间',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `cInfo` mediumtext COMMENT '评论内容',
  `cImage` varchar(100) DEFAULT '/php/user/comment/default.png' COMMENT '评论图片',
  PRIMARY KEY (`ccid`),
  KEY `gid` (`gid`),
  KEY `uid` (`uid`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`gid`) REFERENCES `goods` (`gid`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `comment` */

/*Table structure for table `goods` */

CREATE TABLE `goods` (
  `gid` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `gname` varchar(20) NOT NULL COMMENT '商品名称',
  `introduction` varchar(100) NOT NULL COMMENT '商品详情',
  `picture` varchar(100) NOT NULL DEFAULT '\\php\\admin\\img\\goods\\default.jpg' COMMENT '商品图片地址',
  `cid` int(11) NOT NULL COMMENT '商品类别',
  `type` mediumtext NOT NULL COMMENT '商品型号',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='商品表';

/*Data for the table `goods` */

insert  into `goods`(`gid`,`gname`,`introduction`,`picture`,`cid`,`type`) values (1,'魅族16X','高通骁龙710 屏下指纹 旗舰双摄','\\php\\admin\\img\\goods\\meizu16X.jpg',1,'%5B%7B%22type%22%3A%22%E9%BB%91%E8%89%B2+6+64GB%22%2C%22price%22%3A2099%2C%22gcount%22%3A19%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%99%BD%E8%89%B2+6+64GB%22%2C%22price%22%3A2199%2C%22gcount%22%3A30%2C%22state%22%3A1%7D%5D'),(2,'魅族16th','骁龙845 AI加速 屏幕下指纹 AI双摄光学防抖','\\php\\admin\\img\\goods\\meizu16th.jpg',1,' [{\"type\":\"黑色 6 32GB\",\"price\":2499,\"gcount\":20,\"state\":1},{\"type\":\"白色 6 64GB\",\"price\":3199,\"gcount\":30,\"state\":1}]'),(3,'魅族X8','骁龙710处理器 人脸指纹双解锁 旗舰双摄','\\php\\admin\\img\\goods\\meizuX8.jpg',1,' [{\"type\":\"玉白 4 64GB\",\"price\":1498,\"gcount\":100,\"state\":1},{\"type\":\"亮黑 6 64GB\",\"price\":1798,\"gcount\":100,\"state\":1},{\"type\":\"幻蓝 6 128GB\",\"price\":1998,\"gcount\":100,\"state\":1}]'),(4,'魅族15','骁龙660 前置2000万AI智能美颜','\\php\\admin\\img\\goods\\meizu15.jpg',1,' [{\"type\":\"白色 4 64GB\",\"price\":1498,\"gcount\":100,\"state\":1},{\"type\":\"黑色 4 128GB\",\"price\":1698,\"gcount\":100,\"state\":1}]'),(5,'魅族 V8 高配版','高清双摄 指纹+人脸双解锁','\\php\\admin\\img\\goods\\meizuV8.jpg',1,' [{\"type\":\"雅金 4 64GB\",\"price\":1098,\"gcount\":100,\"state\":1},{\"type\":\"曜黑 4 64GB\",\"price\":1098,\"gcount\":100,\"state\":1},{\"type\":\"烟紫 4 64GB\",\"price\":1098,\"gcount\":100,\"state\":1},{\"type\":\"灰蓝 4 64GB\",\"price\":1098,\"gcount\":100,\"state\":1}]'),(6,'荣耀V20','28日00:00已预定用户支付尾款','\\php\\admin\\img\\goods\\huaweiV20.png',2,' [{\"type\":\"魅海蓝 6GB 128GB\",\"price\":2999,\"gcount\":10,\"state\":1},{\"type\":\"幻夜黑 8GB 128GB\",\"price\":3499,\"gcount\":1,\"state\":1},{\"type\":\"魅丽红 8GB 128GB\",\"price\":3499,\"gcount\":1,\"state\":1}]'),(7,'HUAWEI Mate 20','麒麟980新一代人工智能芯片，6.53英寸珍珠屏，超高屏占比，超微距影像，超大广角徕卡三摄旗舰手机','\\php\\admin\\img\\goods\\huaweiMate20.png',2,' [{\"type\":\"亮黑色 6GB 64GB\",\"price\":3999,\"gcount\":10,\"state\":1},{\"type\":\"宝石蓝 6GB 128GB\",\"price\":4999,\"gcount\":1,\"state\":1},{\"type\":\"翡冷翠 6GB 128GB\",\"price\":4999,\"gcount\":1,\"state\":1}]'),(8,'荣耀8X','千元屏霸 高屏占比 2000万AI双摄','\\php\\admin\\img\\goods\\huawei8X.jpg',2,' [{\"type\":\"魅海蓝 4GB 64GB\",\"price\":1399,\"gcount\":100,\"state\":1},{\"type\":\"幻夜黑 6GB 64GB\",\"price\":1599,\"gcount\":463,\"state\":1},{\"type\":\"魅焰红 6GB 128GB\",\"price\":1899,\"gcount\":453,\"state\":1}]'),(9,'HUAWEI nova 4','华为 HUAWEI nova 4 4800万超广角三摄 高配 全网通版（苏音蓝）','\\php\\admin\\img\\goods\\huaweiNova4.png',2,' [{\"type\":\"苏音蓝 4800万像素 8GB 128GB\",\"price\":3399,\"gcount\":100,\"state\":1},{\"type\":\"苏音蓝 2000万像素 8GB 128GB\",\"price\":3099,\"gcount\":100,\"state\":1}]'),(10,'R17','【直降200元 I 赠永生花】 光感屏幕指纹，6.4英寸水滴屏。','\\php\\admin\\img\\goods\\oppoR17.png',3,' [{\"type\":\"流光蓝 8GB 128GB\",\"price\":3199,\"gcount\":100,\"state\":1},{\"type\":\"霓光紫 6GB 128GB\",\"price\":2799,\"gcount\":221,\"state\":1},{\"type\":\"新年红 6GB 128GB\",\"price\":2799,\"gcount\":13,\"state\":1}]'),(11,'K1','【享3期免息 | 赠帆布包】 骁龙660，光感屏幕指纹。','\\php\\admin\\img\\goods\\oppoK1.png',3,' [{\"type\":\"梵星蓝 6GB&64GB\",\"price\":1799,\"gcount\":54,\"state\":1},{\"type\":\"墨玉黑 4GB&64GB\",\"price\":1599,\"gcount\":212,\"state\":1}] [{\"type\":\"梵星蓝 6GB 64GB\",\"price\":1799,\"gcount\":54,\"state\":1},{\"type\":\"墨玉黑 4GB 64GB\",\"price\":1599,\"gcount\":212,\"state\":1}]'),(12,'Find X','【赠 30G 云空间 I 赠 永生花 I 骁龙 845】 搭配购买 O-Free 无线耳机 省 50 元。','\\php\\admin\\img\\goods\\oppoFindX.png',3,' [{\"type\":\"波尔多红 8GB 256GB\",\"price\":5499,\"gcount\":54,\"state\":1},{\"type\":\"波尔多红 8GB 128GB\",\"price\":4999,\"gcount\":21,\"state\":1}]'),(13,'Z1','4GB内存，6.26新一代全面屏，AI智慧双摄，骁龙660AIE处理器，Jovi智能助手','\\php\\admin\\img\\goods\\vivoZ1.png',4,' [{\"type\":\"极光特别版 4GB 64GB\",\"price\":1299,\"gcount\":14,\"state\":1},{\"type\":\"瓷釉黑 4GB 64GB\",\"price\":1498,\"gcount\":21,\"state\":1},{\"type\":\"瓷釉蓝 4GB 128GB\",\"price\":1798,\"gcount\":21,\"state\":1}]'),(14,'Xplay6','Xplay6 A 128G超大内存，新一代全曲面设计；6G大运存，旗舰品质，强劲性能；后置双摄；正面指纹解锁，免费镭射镌刻','\\php\\admin\\img\\goods\\Xplay6.png',4,' [{\"type\":\"磨砂黑 6GB 128GB\",\"price\":3998,\"gcount\":14,\"state\":1},{\"type\":\"香槟金 6GB 128GB\",\"price\":3998,\"gcount\":21,\"state\":1}]'),(15,'iPhone XS Max','此版本单卡使用与公开版网络相同，双卡使用移动4G网络优先。','\\php\\admin\\img\\goods\\iPhoneXSMax.jpg',5,' [{\"type\":\"金色 3GB 256GB\",\"price\":10499,\"gcount\":10,\"state\":1},{\"type\":\"银色 3GB 256GB\",\"price\":10499,\"gcount\":21,\"state\":1}]'),(16,'iPhone XS','【原封国行正品】京东配送 快捷时效 全国联保 【送199元尊享礼包】含无线充+防摔保护壳+全屏钢化膜+数据线+指环扣','\\php\\admin\\img\\goods\\iPhoneXS.jpg',5,' [{\"type\":\"金色 3GB 256GB\",\"price\":9888,\"gcount\":10,\"state\":1},{\"type\":\"银色 3GB 256GB\",\"price\":9888,\"gcount\":21,\"state\":1}]'),(17,'小米8 青春版','潮流镜面渐变色 / 2400万自拍旗舰 / 7.5mm超薄机身 / 6.26\"小刘海全面屏 / AI裸妆美颜 / 骁龙660AIE处理器','\\php\\admin\\img\\goods\\mi8young.jpg',6,' [{\"type\":\"深空灰 6GB 64GB\",\"price\":1699,\"gcount\":10,\"state\":1},{\"type\":\"暮光金 4GB 64GB\",\"price\":1399,\"gcount\":21,\"state\":1},{\"type\":\"梦幻蓝 4GB 128GB\",\"price\":1799,\"gcount\":110,\"state\":1}]'),(18,'小米8','全球首款 压感屏幕指纹 / 双频GPS超精准定位 / 支持红外人脸识别 / 骁龙845 AIE 旗舰处理器','\\php\\admin\\img\\goods\\mi8.png',6,' [{\"type\":\"透明 8GB 128GB\",\"price\":3399,\"gcount\":1230,\"state\":1},{\"type\":\"黑色 6GB 128GB\",\"price\":3199,\"gcount\":221,\"state\":1}]');

/*Table structure for table `orders` */

CREATE TABLE `orders` (
  `oid` varchar(20) NOT NULL COMMENT '订单号',
  `odate` datetime NOT NULL COMMENT '订单产生时间',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `goodslist` mediumtext NOT NULL COMMENT '商品列表｛gid：商品id，gnum：购买商品数量｝',
  `state` tinyint(1) NOT NULL COMMENT '订单状态',
  `money` double NOT NULL COMMENT '订单总金额',
  `aid` int(11) DEFAULT NULL COMMENT '地址id',
  PRIMARY KEY (`oid`),
  KEY `uid` (`uid`),
  KEY `aid` (`aid`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `address` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

/*Data for the table `orders` */

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`uid`,`uname`,`password`,`phone`,`email`,`state`,`level`) values (1,'admin','admin',NULL,NULL,1,1),(2,'杨宇泽','123123','13433633248','yangyuze1997@qq.com',1,0),(3,'张锦坚','123123','15625708071','435770815@qq.com',1,0),(4,'林立强','123123','13433614355','1833608080@qq.com',1,0),(5,'liqiang','123123','13433614355','1833608080@qq.com',1,0),(6,'jan','123123','15625708071','435770815@qq.com',1,0),(7,'MagicYang','123123','13433633248','yangyuze1997@qq.com',1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
