<?php
header("Conten-type:text/html;charset=utf-8");
include_once("functions/database.php");
get_connection();
session_start();
$gid = "";
$type = "";
$oid="";

if(isset($_GET["goodsid"])){  //这是点击链接进来获取的数据，当重新提交表单时要重新获取
	if(isset($_GET["goodstype"])){
		if(isset($_GET["oid"])){
			$gid=$_GET["goodsid"];
			$type=$_GET["goodstype"];
			$oid=$_GET["oid"];
		}
	}
}

if(!empty($_POST)){   //这是点击提交按钮获取的数据
	$cInfo=$_POST['cInfo'];

	$myfile = $_FILES['cImage'];
	$error = $myfile['error'];
	$cImage="";
	switch ($error) {
		case 0:
		$fileName = $myfile['name'];
		$fileTmp_name = $myfile['tmp_name'];
		$cImage = "comment/".$fileName; 
		move_uploaded_file($fileTmp_name, $cImage);
				$cImage="/php/user/".$cImage;  //文件上传要么相对路径，要么就要全路径
				break;
				case 4:
				$cImage="";  //不选择图片
				break;
				default:
				echo "<script>alert('上传图片失败');window.location.reload();</script>";
			}

		//$res = mysql_query('select * from comment order by ccid DESC');
		//$ccid = mysql_fetch_assoc($res)['ccid']+1;
			$uid=$_SESSION["user"];

			$sql;
		if($cImage!="") //不选择图片时也能提交
		$sql = "INSERT INTO  comment (gid,type,ctime,uid,cInfo,cImage) VALUES ('".$gid."','".$type."',now(),'".$uid."','".$cInfo."','".$cImage."')";
		else $sql = "INSERT INTO  comment (gid,type,ctime,uid,cInfo) VALUES ('".$gid."','".$type."',now(),'".$uid."','".$cInfo."')";
		$res = mysql_query($sql) or die(mysql_error());

		if(mysql_affected_rows()>0){  //如果评论成功，不可再次评论
			$selectSQL="select * from orders where oid='".$oid."'";
			$resultSet=mysql_query($selectSQL);
			$json_url='';
			while($db=mysql_fetch_array($resultSet)){

				//把数据库中url编码的转成json编码的数据,然后进行解码
				$json_url = $db['goodslist'];
				$goodslist = URLdecode($json_url);
				$json_data = json_decode($goodslist);
				$item_num = count($json_data);
				$order = array();

				foreach((array)$json_data as $item){  //已评论过的check为0
					$gooids;
					if($item->gid==$gid && $item->type==$type){
						$goods = array(	
							'gid' => $item->gid,
							'type' => $item->type,
							'gnum' => $item->gnum,
							'check' => '0'
						);
					}else{
						$goods = array(	
							'gid' => $item->gid,
							'type' => $item->type,
							'gnum' => $item->gnum,
							'check' => $item->check
						);
					}		  
					//往二维数组追加元素
					array_push($order,$goods);
				}

				$json_list = json_encode($order);
				$json_url = URLEncode($json_list);
			}
			$updateSQL="update orders set goodslist='".$json_url."' where oid='".$oid."'";
			$resultSet=mysql_query($updateSQL);
			close_connection();
			echo "<script>alert('评论成功！');window.location='orderform.php?&oid=".$_GET["oid"]."'</script>";
		}else{
			echo '<script>alert("评论失败……");</script>';
		}
	}


	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>基于PHP的手机商城</title>
		<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- //for-mobile-apps -->
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- font-awesome icons -->
		<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
		<!-- //font-awesome icons -->
		<!-- js -->
		<script src="js/jquery-1.11.1.min.js"></script>
		<!-- //js -->
		<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

		<!-- start: Favicon and Touch Icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
		<link rel="shortcut icon" href="ico/favicon.png" />
		<!-- end: Favicon and Touch Icons -->	

		<!-- start-smoth-scrolling -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>

		<style>
		textarea{
			width:800px;
			height:200px;
			resize:none;
			border-radius:2px;
			border:2px solid green;
		}
	</style>
	<!-- start-smoth-scrolling -->
</head>

<body>
	<!-- header -->
	<?php include "head.php"?>
	<!-- 页面如下 -->
	<div style="float:left; margin-top:50px; margin-left:100px">
	<form class="form-horizontal" action="<?php echo "/php/user/comment.php?goodsid=".$gid."&goodstype=".$type."&oid=".$oid;?>" method="post" enctype="multipart/form-data" >
	<fieldset>
	<div><textarea placeholder="请输入评论" id="cInfo" name="cInfo" required=""></textarea></div>
	<div>
	<input type="file" name="cImage" size="25" maxlength="100" accept=".jpg,.gif,.jpeg,.png"/><div>
	<div style="float:right">
	<input type="submit" name="submit" value="提交" />
	<?php echo "<a href='/php/user/orderform.php?oid=".$oid."'><button type=\"button\">返回</button></a>";?>
</div>
</fieldset>
</form>
</div>

<div class="clearfix"></div>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$(".dropdown").hover(            
			function() {
				$('.dropdown-menu', this).stop( true, true ).slideDown("fast");
				$(this).toggleClass('open');        
			},
			function() {
				$('.dropdown-menu', this).stop( true, true ).slideUp("fast");
				$(this).toggleClass('open');       
			}
			);
	});
</script>
<script type="text/javascript" id="snipcart" src="js/snipcart.js" data-api-key="ZGQxNzVjZTItOWRmNS00YjJhLTlmNGUtMDE4NjdiY2RmZGNj"></script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
	$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
				*/
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
		<!-- //here ends scrolling icon -->
		<script type='text/javascript' src="js/jquery.mycart.js"></script>
		<script type="text/javascript">
			$(function () {

				var goToCartIcon = function($addTocartBtn){
					var $cartIcon = $(".my-cart-icon");
					var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
					$addTocartBtn.prepend($image);
					var position = $cartIcon.position();
					$image.animate({
						
					}, 500 , "linear", function() {
						$image.remove();
					});
				}

				$('.my-cart-btn').myCart({
					classCartIcon: 'my-cart-icon',
					classCartBadge: 'my-cart-badge',
					affixCartIcon: true,
					checkoutCart: function(products) {
						$.each(products, function(){
							console.log(this);
						});
					},
					clickOnAddToCart: function($addTocart){
						goToCartIcon($addTocart);
					},
					getDiscountPrice: function(products) {
						var total = 0;
						$.each(products, function(){
							total += this.quantity * this.price;
						});
						return total * 1;
					}
				});

			});
		</script>
	</body>
	</html>