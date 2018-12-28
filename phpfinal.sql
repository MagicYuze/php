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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `address` */

insert  into `address`(`aid`,`uid`,`address`) values (1,2,'东莞理工学院学生宿舍楼8栋'),(2,3,'东莞理工学院学生宿舍楼23栋'),(3,4,'东莞理工学院学生宿舍楼8栋'),(4,6,'东莞理工皇家学院'),(5,6,'学生宿舍楼23栋'),(6,7,'学生宿舍8栋'),(7,5,'帝国理工'),(8,5,'帝国理工大学'),(9,3,'广州塔'),(10,3,'北京天安门');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `comment` */

insert  into `comment`(`ccid`,`gid`,`type`,`ctime`,`uid`,`cInfo`,`cImage`) values (1,1,'黑色 6 64GB','2018-12-28 13:20:20',7,'喜欢圆润白色的外观，总体满意，如果品控和相机再做好一点，那就完美了。<br>\r\n《一》屏幕，我个人觉得看起来比较舒服，不阴阳，不过屏幕向右倾斜了一点点，所以黑边不一，其他品牌的旗舰屏幕正正的黑边都对称，如果魅族能跟进，那就好了<br>\r\n《二》相机，硬件不错，细节可以，但色彩偏冷，只能看看后期的软件更新了。<br>\r\n《三》马达的声音和触感不错。<br>\r\n《四》包装灰尘多，出厂膜上面有擦拭的水痕。<br>\r\n《五》边边的缝隙可以接受，不过边边进了几颗尘，清理不出来。<br>\r\n《六》基于Android 8.1做出来的Flyme7系统流畅可以，现在的Android做的很好，不会卡。','/php/user/comment/16X_1.png'),(2,1,'黑色 6 64GB','2018-12-28 13:23:41',7,'第三次购买魅族牌子的手机了，系统不用多说了，安卓机里面系统非常流畅，算是数一数二的，无意冒犯自认为。电池优化的很好，续航时间很长3640毫安大电池，拍照美颜效果好清晰，白皙透彻，景色和物体的颜色一一分明，系统软件反应特快，流畅无比，渐变色的玻璃后盖，6点五英寸大屏幕，吃鸡太爽了。视野更广了更容易分辨敌人位置，当初到实体店里面体验太多的手机了，觉得这个手机的手感是其中之一很好的，是最适合自己的。但无奈实体店太贵了，需要加价才买得到。一直关注着京东，魅族自营手机店，终于，10月22号十点，刚到就开卖了，立即下单，终于抢到了，真的太高兴了，另外一个手机下载了魅族商城，不到一分钟就没货了，有点失望。还是京东厉害，十多20分钟了居然还可以抢，不愧是我最爱，也是唯一喜爱的购物平台，因为京东有货到付款，这是独一无二的，排除其他什么“－品会”，京东自营，送货是最快的，服务是最好的，加持京东物流，购买无忧无虑！只管买买买就可以了！魅族旗舰机抢到了，终于抢到了 ！等了两个多月的机子！这次的包装太简陋了，从成都寄过来的几百公里，就套了一个气泡膜袋，打开的时候，手机的外包装都瘪了一个小角，心疼啊！好在里面没事','/php/user/comment/16X_2.jpg'),(4,1,'白色 6 64GB','2018-12-28 15:16:31',5,'第一感觉：真香！?<br>\r\n魅族官网抢了三次，以失败告终！<br>\r\n失望之余，同一天竟然在京东意外抢到了！！！?<br>\r\n魅族做工依然扎实，用手机里的魅蓝note拍的，用了三年半的老手机了，依然坚挺！（运存和内存均告急）<br>\r\n先做个开箱体验，后期再追加使用体验的评价！?','/php/user/comment/default.png'),(5,2,'白色 6 64GB','2018-12-28 15:17:09',5,'购买经过:提前关闭了WiFi内的所有其他设备，重启了下路由器，锻炼了下手速，开抢。20号0点0秒抢购下单成功。下单成功后，当天下午3点收到手机。<br>\r\n京配感受:京东包装手机真的很暴力，几千块的东西拿个气泡袋就发过来了，收到后盒子都已经磕坏了，应该是分拣扔的。<br>\r\n产品包装感受:设计很漂亮但是和手机一样很容易沾染指纹，背部的参数标贴印刷不是很好很模糊。<br>\r\n开箱清单:手机，充电头，数据线，透明手机壳，取卡针，保修卡，VIP卡。<br>\r\n手机:第一眼觉得屏占比高的感觉手机很小，比坚果pro2上下小2cm左右。黑色机身感觉很一体性特别好，很漂亮。一打眼看就知道是三星的屏幕。手机的接缝很好，做工非常优良(之前还担心第一批手机怕做工不好)，手感很好，大小也很合适单手持握不割手。机身中框材质有点类似小米6x，感觉不够档次。屏幕及后盖容易沾染指纹。比较惊喜的是听筒，现在的手机听筒都做的很小，而且都是开个槽就完了，锤子pro2听筒经常进灰。过段时间要掏一下，16听筒有一层小孔。感觉填充感好一些也不容易进灰。<br>\r\n字数限制只能写这么多，静待追评吧，追评发开机体验。及指纹，人脸识别。','/php/user/comment/default.png'),(6,1,'黑色 6 32GB','2018-12-28 15:17:43',5,'还可以 价格也还比较实惠 我是我们村第一个在网上买东西的人。这里大部分人是不网购的。他们买东西价格一般不超过五块，听说我在网上买东西后，整个村都震惊了，村长跑到我家里对我爸说我是不是疯了? 说这日子没法过了，让我出去租房子住，面对重重压力，我坚持要买。我相信我这个月的工资不会白花，终于快递到了我怀揣着激动的心情，颤抖的打开包裹，感觉我的眼都要亮瞎了，啊..这颜值、这一霎那，手感、这质量、只怪我读书少，无法用华丽的语言来形容它。我举着它，骄傲的站在村口，他们就跳井，吓得我赶紧收起宝贝，挤出人群落荒而逃。为测试我立刻去我们村高达100米山上村长家客厅里测试宝贝效果，用完后，在全村人羡慕的目光中，仰首挺胸扬长而去。','/php/user/comment/default.png'),(8,1,'白色 6 64GB','2018-12-28 15:23:59',5,'一直都用魅族手机，图和视频是用魅族MX6拍得，说说一天重度使用的感受，16X拍照绝对牛，电池续航和发布会说的没差，做工真的非常好，真的很精致，手感超绝。使用起来非常流畅，因为我的MX6内存32g的不够用了才换了这台16X，128G！710处理器够用，我不是游戏重度患者。16X要游戏其实也很流畅！一盘吃鸡下来掉百分之十左右的电，正常范围！我连续玩三盘吃鸡，也不怎么热，我开的是高帧率，中画质。反正超值，颜值高，手感好！大爱！','/php/user/comment/eb1f01e2adab09924b2c16f8c3b8dd5.png');

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

insert  into `goods`(`gid`,`gname`,`introduction`,`picture`,`cid`,`type`) values (1,'魅族16X','高通骁龙710 屏下指纹 旗舰双摄','\\php\\admin\\img\\goods\\meizu16X.jpg',1,'%5B%7B%22type%22%3A%22%E9%BB%91%E8%89%B2+6+32GB%22%2C%22price%22%3A2499%2C%22gcount%22%3A12%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%99%BD%E8%89%B2+6+64GB%22%2C%22price%22%3A3199%2C%22gcount%22%3A27%2C%22state%22%3A1%7D%5D'),(2,'魅族16th','骁龙845 AI加速 屏幕下指纹 AI双摄光学防抖','\\php\\admin\\img\\goods\\meizu16th.jpg',1,'%5B%7B%22type%22%3A%22%E9%BB%91%E8%89%B2+6+32GB%22%2C%22price%22%3A2499%2C%22gcount%22%3A19%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%99%BD%E8%89%B2+6+64GB%22%2C%22price%22%3A3199%2C%22gcount%22%3A28%2C%22state%22%3A1%7D%5D'),(3,'魅族X8','骁龙710处理器 人脸指纹双解锁 旗舰双摄','\\php\\admin\\img\\goods\\meizuX8.jpg',1,'%5B%7B%22type%22%3A%22%E7%8E%89%E7%99%BD+4+64GB%22%2C%22price%22%3A1498%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E4%BA%AE%E9%BB%91+6+64GB%22%2C%22price%22%3A1798%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E5%B9%BB%E8%93%9D+6+128GB%22%2C%22price%22%3A1998%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%5D'),(4,'魅族15','骁龙660 前置2000万AI智能美颜','\\php\\admin\\img\\goods\\meizu15.jpg',1,'%5B%7B%22type%22%3A%22%E7%99%BD%E8%89%B2+4+64GB%22%2C%22price%22%3A1498%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E9%BB%91%E8%89%B2+4+128GB%22%2C%22price%22%3A1698%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%5D'),(5,'魅族 V8 高配版','高清双摄 指纹+人脸双解锁','\\php\\admin\\img\\goods\\meizuV8.jpg',1,'%5B%7B%22type%22%3A%22%E9%9B%85%E9%87%91+4+64GB%22%2C%22price%22%3A1098%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E6%9B%9C%E9%BB%91+4+64GB%22%2C%22price%22%3A1098%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%83%9F%E7%B4%AB+4+64GB%22%2C%22price%22%3A1098%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%81%B0%E8%93%9D+4+64GB%22%2C%22price%22%3A1098%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%5D'),(6,'荣耀V20','28日00:00已预定用户支付尾款','\\php\\admin\\img\\goods\\huaweiV20.png',2,'%5B%7B%22type%22%3A%22%E9%AD%85%E6%B5%B7%E8%93%9D+6GB+128GB%22%2C%22price%22%3A2999%2C%22gcount%22%3A9%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E5%B9%BB%E5%A4%9C%E9%BB%91+8GB+128GB%22%2C%22price%22%3A3499%2C%22gcount%22%3A%22100%22%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E9%AD%85%E4%B8%BD%E7%BA%A2+8GB+128GB%22%2C%22price%22%3A3499%2C%22gcount%22%3A0%2C%22state%22%3A1%7D%5D'),(7,'HUAWEI Mate 20','麒麟980新一代人工智能芯片，6.53英寸珍珠屏，超高屏占比，超微距影像，超大广角徕卡三摄旗舰手机','\\php\\admin\\img\\goods\\huaweiMate20.png',2,'%5B%7B%22type%22%3A%22%E4%BA%AE%E9%BB%91%E8%89%B2+6GB+64GB%22%2C%22price%22%3A3999%2C%22gcount%22%3A8%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E5%AE%9D%E7%9F%B3%E8%93%9D+6GB+128GB%22%2C%22price%22%3A4999%2C%22gcount%22%3A0%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%BF%A1%E5%86%B7%E7%BF%A0+6GB+128GB%22%2C%22price%22%3A4999%2C%22gcount%22%3A0%2C%22state%22%3A1%7D%5D'),(8,'荣耀8X','千元屏霸 高屏占比 2000万AI双摄','\\php\\admin\\img\\goods\\huawei8X.jpg',2,'%5B%7B%22type%22%3A%22%E9%AD%85%E6%B5%B7%E8%93%9D+4GB+64GB%22%2C%22price%22%3A1399%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E5%B9%BB%E5%A4%9C%E9%BB%91+6GB+64GB%22%2C%22price%22%3A1599%2C%22gcount%22%3A461%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E9%AD%85%E7%84%B0%E7%BA%A2+6GB+128GB%22%2C%22price%22%3A1899%2C%22gcount%22%3A452%2C%22state%22%3A1%7D%5D'),(9,'HUAWEI nova 4','华为 HUAWEI nova 4 4800万超广角三摄 高配 全网通版（苏音蓝）','\\php\\admin\\img\\goods\\huaweiNova4.png',2,'%5B%7B%22type%22%3A%22%E8%8B%8F%E9%9F%B3%E8%93%9D+4800%E4%B8%87%E5%83%8F%E7%B4%A0+8GB+128GB%22%2C%22price%22%3A3399%2C%22gcount%22%3A98%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E8%8B%8F%E9%9F%B3%E8%93%9D+2000%E4%B8%87%E5%83%8F%E7%B4%A0+8GB+128GB%22%2C%22price%22%3A3099%2C%22gcount%22%3A99%2C%22state%22%3A1%7D%5D'),(10,'R17','【直降200元 I 赠永生花】 光感屏幕指纹，6.4英寸水滴屏。','\\php\\admin\\img\\goods\\oppoR17.png',3,' [{\"type\":\"流光蓝 8GB 128GB\",\"price\":3199,\"gcount\":100,\"state\":1},{\"type\":\"霓光紫 6GB 128GB\",\"price\":2799,\"gcount\":221,\"state\":1},{\"type\":\"新年红 6GB 128GB\",\"price\":2799,\"gcount\":13,\"state\":1}]'),(11,'K1','【享3期免息 | 赠帆布包】 骁龙660，光感屏幕指纹。','\\php\\admin\\img\\goods\\oppoK1.png',3,' [{\"type\":\"梵星蓝 6GB&64GB\",\"price\":1799,\"gcount\":54,\"state\":1},{\"type\":\"墨玉黑 4GB&64GB\",\"price\":1599,\"gcount\":212,\"state\":1}] [{\"type\":\"梵星蓝 6GB 64GB\",\"price\":1799,\"gcount\":54,\"state\":1},{\"type\":\"墨玉黑 4GB 64GB\",\"price\":1599,\"gcount\":212,\"state\":1}]'),(12,'Find X','【赠 30G 云空间 I 赠 永生花 I 骁龙 845】 搭配购买 O-Free 无线耳机 省 50 元。','\\php\\admin\\img\\goods\\oppoFindX.png',3,'%5B%7B%22type%22%3A%22%E6%B3%A2%E5%B0%94%E5%A4%9A%E7%BA%A2+8GB+256GB%22%2C%22price%22%3A5499%2C%22gcount%22%3A53%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E6%B3%A2%E5%B0%94%E5%A4%9A%E7%BA%A2+8GB+128GB%22%2C%22price%22%3A4999%2C%22gcount%22%3A19%2C%22state%22%3A1%7D%5D'),(13,'Z1','4GB内存，6.26新一代全面屏，AI智慧双摄，骁龙660AIE处理器，Jovi智能助手','\\php\\admin\\img\\goods\\vivoZ1.png',4,'%5B%7B%22type%22%3A%22%E6%9E%81%E5%85%89%E7%89%B9%E5%88%AB%E7%89%88+4GB+64GB%22%2C%22price%22%3A1299%2C%22gcount%22%3A13%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%93%B7%E9%87%89%E9%BB%91+4GB+64GB%22%2C%22price%22%3A1498%2C%22gcount%22%3A20%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E7%93%B7%E9%87%89%E8%93%9D+4GB+128GB%22%2C%22price%22%3A1798%2C%22gcount%22%3A20%2C%22state%22%3A1%7D%5D'),(14,'Xplay6','Xplay6 A 128G超大内存，新一代全曲面设计；6G大运存，旗舰品质，强劲性能；后置双摄；正面指纹解锁，免费镭射镌刻','\\php\\admin\\img\\goods\\Xplay6.png',4,'%5B%7B%22type%22%3A%22%E7%A3%A8%E7%A0%82%E9%BB%91+6GB+128GB%22%2C%22price%22%3A3998%2C%22gcount%22%3A13%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E9%A6%99%E6%A7%9F%E9%87%91+6GB+128GB%22%2C%22price%22%3A3998%2C%22gcount%22%3A19%2C%22state%22%3A1%7D%5D'),(15,'iPhone XS Max','此版本单卡使用与公开版网络相同，双卡使用移动4G网络优先。','\\php\\admin\\img\\goods\\iPhoneXSMax.jpg',5,'%5B%7B%22type%22%3A%22%E9%87%91%E8%89%B2+3GB+256GB%22%2C%22price%22%3A10499%2C%22gcount%22%3A7%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E9%93%B6%E8%89%B2+3GB+256GB%22%2C%22price%22%3A10499%2C%22gcount%22%3A18%2C%22state%22%3A1%7D%5D'),(16,'iPhone XS','【原封国行正品】京东配送 快捷时效 全国联保 【送199元尊享礼包】含无线充+防摔保护壳+全屏钢化膜+数据线+指环扣','\\php\\admin\\img\\goods\\iPhoneXS.jpg',5,'%5B%7B%22type%22%3A%22%E9%87%91%E8%89%B2+3GB+256GB%22%2C%22price%22%3A9888%2C%22gcount%22%3A9%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E9%93%B6%E8%89%B2+3GB+256GB%22%2C%22price%22%3A9888%2C%22gcount%22%3A20%2C%22state%22%3A1%7D%5D'),(17,'小米8 青春版','潮流镜面渐变色 / 2400万自拍旗舰 / 7.5mm超薄机身 / 6.26\"小刘海全面屏 / AI裸妆美颜 / 骁龙660AIE处理器','\\php\\admin\\img\\goods\\mi8young.jpg',6,'%5B%7B%22type%22%3A%22%E6%B7%B1%E7%A9%BA%E7%81%B0+6GB+64GB%22%2C%22price%22%3A1699%2C%22gcount%22%3A8%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E6%9A%AE%E5%85%89%E9%87%91+4GB+64GB%22%2C%22price%22%3A1399%2C%22gcount%22%3A20%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E6%A2%A6%E5%B9%BB%E8%93%9D+4GB+128GB%22%2C%22price%22%3A1799%2C%22gcount%22%3A109%2C%22state%22%3A1%7D%5D'),(18,'小米8','全球首款 压感屏幕指纹 / 双频GPS超精准定位 / 支持红外人脸识别 / 骁龙845 AIE 旗舰处理器','\\php\\admin\\img\\goods\\mi8.png',6,'%5B%7B%22type%22%3A%22%E9%80%8F%E6%98%8E+8GB+128GB%22%2C%22price%22%3A3399%2C%22gcount%22%3A1228%2C%22state%22%3A1%7D%2C%7B%22type%22%3A%22%E9%BB%91%E8%89%B2+6GB+128GB%22%2C%22price%22%3A3199%2C%22gcount%22%3A220%2C%22state%22%3A1%7D%5D');

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

insert  into `orders`(`oid`,`odate`,`uid`,`goodslist`,`state`,`money`,`aid`) values ('3remx2lg83hf4c4ms15t','2018-12-27 15:21:34',5,'%5B%7B%22gid%22%3A1%2C%22type%22%3A%22%5Cu9ed1%5Cu8272+6+32GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%2C%7B%22gid%22%3A1%2C%22type%22%3A%22%5Cu767d%5Cu8272+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%5D',2,5698,7),('hhcg50syha8im8xno38o','2018-12-21 15:32:48',3,'%5B%7B%22gid%22%3A1%2C%22type%22%3A%22%E9%BB%91%E8%89%B2+6+32GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A1%2C%22type%22%3A%22%E7%99%BD%E8%89%B2+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A2%2C%22type%22%3A%22%E9%BB%91%E8%89%B2+6+32GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A2%2C%22type%22%3A%22%E7%99%BD%E8%89%B2+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A3%2C%22type%22%3A%22%E7%8E%89%E7%99%BD+4+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A3%2C%22type%22%3A%22%E4%BA%AE%E9%BB%91+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A3%2C%22type%22%3A%22%E5%B9%BB%E8%93%9D+6+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A4%2C%22type%22%3A%22%E7%99%BD%E8%89%B2+4+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A4%2C%22type%22%3A%22%E9%BB%91%E8%89%B2+4+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A6%2C%22type%22%3A%22%E9%AD%85%E6%B5%B7%E8%93%9D+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A6%2C%22type%22%3A%22%E5%B9%BB%E5%A4%9C%E9%BB%91+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A6%2C%22type%22%3A%22%E9%AD%85%E4%B8%BD%E7%BA%A2+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A7%2C%22type%22%3A%22%E4%BA%AE%E9%BB%91%E8%89%B2+6GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A7%2C%22type%22%3A%22%E5%AE%9D%E7%9F%B3%E8%93%9D+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A7%2C%22type%22%3A%22%E7%BF%A1%E5%86%B7%E7%BF%A0+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A8%2C%22type%22%3A%22%E9%AD%85%E6%B5%B7%E8%93%9D+4GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A8%2C%22type%22%3A%22%E5%B9%BB%E5%A4%9C%E9%BB%91+6GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A8%2C%22type%22%3A%22%E9%AD%85%E7%84%B0%E7%BA%A2+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A9%2C%22type%22%3A%22%E8%8B%8F%E9%9F%B3%E8%93%9D+4800%E4%B8%87%E5%83%8F%E7%B4%A0+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A9%2C%22type%22%3A%22%E8%8B%8F%E9%9F%B3%E8%93%9D+2000%E4%B8%87%E5%83%8F%E7%B4%A0+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A13%2C%22type%22%3A%22%E6%9E%81%E5%85%89%E7%89%B9%E5%88%AB%E7%89%88+4GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A13%2C%22type%22%3A%22%E7%93%B7%E9%87%89%E9%BB%91+4GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A13%2C%22type%22%3A%22%E7%93%B7%E9%87%89%E8%93%9D+4GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A14%2C%22type%22%3A%22%E7%A3%A8%E7%A0%82%E9%BB%91+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A14%2C%22type%22%3A%22%E9%A6%99%E6%A7%9F%E9%87%91+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A15%2C%22type%22%3A%22%E9%87%91%E8%89%B2+3GB+256GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A15%2C%22type%22%3A%22%E9%93%B6%E8%89%B2+3GB+256GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A16%2C%22type%22%3A%22%E9%87%91%E8%89%B2+3GB+256GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A16%2C%22type%22%3A%22%E9%93%B6%E8%89%B2+3GB+256GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A17%2C%22type%22%3A%22%E6%B7%B1%E7%A9%BA%E7%81%B0+6GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A17%2C%22type%22%3A%22%E6%9A%AE%E5%85%89%E9%87%91+4GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A17%2C%22type%22%3A%22%E6%A2%A6%E5%B9%BB%E8%93%9D+4GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A18%2C%22type%22%3A%22%E9%80%8F%E6%98%8E+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A18%2C%22type%22%3A%22%E9%BB%91%E8%89%B2+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A5%2C%22type%22%3A%22%E9%9B%85%E9%87%91+4+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A5%2C%22type%22%3A%22%E6%9B%9C%E9%BB%91+4+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A5%2C%22type%22%3A%22%E7%83%9F%E7%B4%AB+4+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A5%2C%22type%22%3A%22%E7%81%B0%E8%93%9D+4+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%5D',1,124527,10),('i7j057syi1q2sbrnlgf4','2018-12-25 15:28:57',6,'%5B%7B%22gid%22%3A15%2C%22type%22%3A%22%E9%87%91%E8%89%B2+3GB+256GB%22%2C%22gnum%22%3A%221%22%2C%22check%22%3A%221%22%7D%5D',1,10499,4),('jnnqezjt9nou9q88fh6m','2018-12-24 15:29:02',3,'%5B%7B%22gid%22%3A9%2C%22type%22%3A%22%E8%8B%8F%E9%9F%B3%E8%93%9D+4800%E4%B8%87%E5%83%8F%E7%B4%A0+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A12%2C%22type%22%3A%22%E6%B3%A2%E5%B0%94%E5%A4%9A%E7%BA%A2+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%5D',1,8398,9),('l0972hpdfutrbaengea4','2018-12-23 15:10:27',5,'%5B%7B%22gid%22%3A2%2C%22type%22%3A%22%5Cu767d%5Cu8272+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%2C%7B%22gid%22%3A1%2C%22type%22%3A%22%5Cu9ed1%5Cu8272+6+32GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%2C%7B%22gid%22%3A1%2C%22type%22%3A%22%5Cu767d%5Cu8272+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%5D',2,8897,8),('mrr38ljzngp5qscf32kj','2018-12-22 15:11:12',5,'%5B%7B%22gid%22%3A1%2C%22type%22%3A%22%5Cu9ed1%5Cu8272+6+32GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%2C%7B%22gid%22%3A8%2C%22type%22%3A%22%5Cu5e7b%5Cu591c%5Cu9ed1+6GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A12%2C%22type%22%3A%22%5Cu6ce2%5Cu5c14%5Cu591a%5Cu7ea2+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%5D',2,9097,7),('pgbookys87qmhpfx9jbk','2018-12-25 15:31:22',6,'%5B%7B%22gid%22%3A7%2C%22type%22%3A%22%E4%BA%AE%E9%BB%91%E8%89%B2+6GB+64GB%22%2C%22gnum%22%3A%221%22%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A15%2C%22type%22%3A%22%E9%87%91%E8%89%B2+3GB+256GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%5D',1,14498,5),('rmnv1l1i2qrye26fif6x','2018-12-24 15:11:56',5,'%5B%7B%22gid%22%3A15%2C%22type%22%3A%22%E9%93%B6%E8%89%B2+3GB+256GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A1%2C%22type%22%3A%22%E9%BB%91%E8%89%B2+6+32GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%5D',0,12998,8),('rtyg9qrhcbgp8crlc9ol','2018-12-23 15:29:48',6,'%5B%7B%22gid%22%3A12%2C%22type%22%3A%22%E6%B3%A2%E5%B0%94%E5%A4%9A%E7%BA%A2+8GB+256GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A18%2C%22type%22%3A%22%E9%80%8F%E6%98%8E+8GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%5D',0,8898,5),('z52ua1rq2u7ybkeoegr5','2018-12-27 13:18:23',7,'%5B%7B%22gid%22%3A1%2C%22type%22%3A%22%5Cu9ed1%5Cu8272+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%5D',2,2099,6),('zcra1anp2eli1m1m8vx3','2018-12-26 15:28:24',3,'%5B%7B%22gid%22%3A17%2C%22type%22%3A%22%E6%B7%B1%E7%A9%BA%E7%81%B0+6GB+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%2C%7B%22gid%22%3A14%2C%22type%22%3A%22%E9%A6%99%E6%A7%9F%E9%87%91+6GB+128GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%221%22%7D%5D',1,5697,2),('zii1t63ome0hiym1zq5h','2018-12-26 13:22:17',7,'%5B%7B%22gid%22%3A1%2C%22type%22%3A%22%5Cu9ed1%5Cu8272+6+64GB%22%2C%22gnum%22%3A1%2C%22check%22%3A%220%22%7D%5D',2,2099,6);

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
