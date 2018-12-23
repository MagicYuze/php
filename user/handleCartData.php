<?php 
header("Content-type: text/html; charset=utf-8"); 
include_once("functions/database.php");
$GLOBALS['flag']=0;
function checkGcount($gid,$bnum){
	get_connection();
	$sql = 'select * from goods where gid='.$gid;
	$res = mysql_query($sql);
	if($res){
		$row = mysql_fetch_assoc($res);
		if($row['gcount']-$bnum<0)
			$GLOBALS['flag']++;
	}
	close_connection();
}

function sqlChangeGcount($gid,$bnum){
	get_connection();
	$sql = 'UPDATE goods SET gcount=gcount-'.$bnum.' where gid='.$gid;
	$res = mysql_query($sql);
	close_connection();
}

if(isset($_POST['submit'])){	
	//读取cart列表中的json数据，将其存入一个数组作为订单的goodslist
	$json = urldecode($_POST['json_data']);
	$json_data = json_decode($json);
	$goodslist = array();
	foreach((array)$json_data as $item){
		$gid = $item->id;
		$gnum = $item->quantity;
		$goods = array(	
			'gid' => $gid,
			'gnum' => $gnum
		);
		checkGcount($gid,$gnum);
		// echo $gid.','.$gnum.'<br>';
		array_push($goodslist,$goods);
	}
	if($GLOBALS['flag']){//判断是否所有商品都库存充足
		echo '<script>alert("不好意思，购买失败！您购买的商品中有'.$GLOBALS['flag'].'种商品库存不足！");localStorage.products="";window.location="index.php";</script>';
	}else{

		foreach((array)$json_data as $item){
			$gid = $item->id;
			$bnum = $item->quantity;
			sqlChangeGcount($gid,$bnum);
		}

		$json_list = json_encode($goodslist);
		$json_url = URLEncode($json_list);
	//产生订单号
		function randomkeys($length) 
		{ 	$key="";
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz 
		ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
		for($i=0;$i<$length;$i++) 
		{ 
			$key .= $pattern{mt_rand(0,35)};    //生成php随机数 
		} 
		return $key; 
	} 
	$oid = randomkeys(20);
	
	// 获取当前用户id
	if (!session_id()) session_start();
	// echo $_SESSION['user'];
	$uid = $_SESSION['user'];

	//计算总金额
	$money = 0;
	foreach((array)$json_data as $item){
		$price = $item->price;
		$gnum = $item->quantity;
		$money+=$price*$gnum;
	}
	if($money){//判断购物车是否为空
		get_connection();
		$sql = 'INSERT INTO orders (oid,odate,uid,goodslist,state,money) VALUES ("'.$oid.'",now(),'.$uid.',"'.$json_url.'",0,'.$money.');';
		$res = mysql_query($sql);

		if(mysql_affected_rows()>0){
			echo '<script>alert("恭喜您，购买成功！请等待发货！");localStorage.products="";window.location="index.php";</script>';
		}else{
			echo '<script>alert("不好意思，购买失败！请确认您的操作！");window.location="index.php";</script>';
		}
		close_connection();
	}else{
		echo '<script>alert("您的购物车为空，请购买后再结算！");window.location="index.php";</script>';
	}
}
}
?>