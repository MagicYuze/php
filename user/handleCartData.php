<?php 
header("Content-type: text/html; charset=utf-8"); 
if(isset($_POST['submit'])){	
	//读取cart列表中的json数据，将其存入一个数组作为订单的goodslist
	$json = urldecode($_POST['json_data']);
	$json_data = json_decode($json);
	$goodslist = array();
	foreach((array)$json_data as $item){
		// $gid = $item->id;
		// $gnum = $item->quantity;
		$goods = array(	
			'gid' => $item->id,
			'gnum' => $item->quantity
		);
		// echo $gid.','.$gnum.'<br>';
		array_push($goodslist,$goods);
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
	include_once("functions/database.php");
	get_connection();
	$sql = 'INSERT INTO orders (oid,odate,uid,goodslist,state,money) VALUES ("'.$oid.'",now(),'.$uid.',"'.$json_url.'",0,'.$money.');';
	$res = mysql_query($sql);

	if(mysql_affected_rows()>0){
		echo '<script>alert("恭喜您，购买成功！请等待发货！");window.location="index.php";localStorage.products="";</script>';
	}else{
		echo '<script>alert("'.$sql.'");</script>';
	}
}close_connection();
?>