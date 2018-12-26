<?php
header("Content-type: text/html; charset=utf-8"); 
include_once("functions/database.php");
function randomkeys($length)  //产生订单号
{ 	
	$key="";
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz 
	ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	for($i=0;$i<$length;$i++) 
	{ 
		$key .= $pattern{mt_rand(0,35)};    //生成php随机数 
	} 
	return $key; 
}
function getaid($address){  //取地址aid
		$aid=0;
		$selectSQL="select * from address where address='".$address."' and uid='".$_SESSION["user"]."'";
		$res = mysql_query($selectSQL);
		if(mysql_num_rows($res)>=1){ //已经存在
			while($db=mysql_fetch_array($res)){
				$aid=$db["aid"];
			}
		}
		return $aid;
}

session_start();
get_connection();

$totalprice=$_POST['totalprice'];

if($totalprice==0){
	echo '<script>alert("您的购物车为空，请购买后再结算！");window.location="index.php";</script>';
}else{
	$address=$_POST['raddress'];  //这是地址的aid
	$newaddress=$_POST["newaddress"];  //这是新增地址
	$json_url=$_POST["goods"];  //传过来的URL形式的购物车信息

	if($address=='' && $newaddress==''){
		echo '<script>alert("没有选择收货地址！");window.location="index.php";</script>';
	}
	else if($address!='' && $newaddress!=''){
		echo '<script>alert("您的收货地址其冲突！");window.location="index.php";</script>';
	}
	else if($address=='' && $newaddress!=''){  //没有选择已有地址,选择新增地址
		getaid($newaddress);

		if(mysql_affected_rows()>0){
			echo '<script>alert("您的地址已经存在了,无法新增！");window.location="index.php";</script>';
		}else{
			$insertSQL="insert into address(uid,address) values('".$_SESSION["user"]."','".$newaddress."')";
			mysql_query($insertSQL);
			$address=getaid($newaddress);
		}
	}
	$goodslist = URLdecode($json_url);
	$json_data = json_decode($goodslist);
	$cart = array();

	foreach((array)$json_data as $item){  //存进订单的数据要从购物车信息取 					  
		$goods = array(
			'gid' =>$item->id,
			'type' =>$item->type,
			'gnum' =>$item->quantity,
			'check' =>'1'   //代表可评论
		);
		array_push($cart,$goods);
	}

	$json_list = json_encode($cart);
	$json_url = URLEncode($json_list);

	$oid = randomkeys(20);

	$sql = "insert into orders(oid,odate,uid,goodslist,state,money,aid) VALUES ('".$oid."',now(),'".$_SESSION["user"]."','".$json_url."',0,'".$totalprice."','".$address."')";
	mysql_query($sql);
	echo '<script>alert("付款成功，请及时查看订单！");window.location="events.php";</script>';

	}
	close_connection();
?>
