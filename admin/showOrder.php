<?php 
	include "checkLogin.php";
	date_default_timezone_set("PRC");
    $con = mysql_connect("118.89.24.240","php","123456");//连接数据库
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("phpfinal",$con);//选择数据库

    //根据时间区间查询订单
  	if(isset($_POST['time1'])&&isset($_POST['time2'])){
  		$time1 = $_POST['time1'];
  		$time2 = $_POST['time2'];
  		if($time1>$time2){
  			$tmp = $time1;
  			$time1 = $time2;
  			$time2 = $tmp;
  		}
  		$sql = 'select * from orders where odate between"'.$time1.'" and "'.$time2.'"';
  		$res = mysql_query($sql,$con);
  	}


    if(isset($_GET['method'])){
    	if($_GET['method']=="check"){
    		if($_GET['state']==3){
    		  $sql = 'select * from orders';
    		  $res = mysql_query($sql,$con);
    		}else{
    		  $sql = 'select * from orders where state='.$_GET['state'];
    		  $res = mysql_query($sql,$con);
    		}
    	}
    	else if($_GET['method']=="del"){
    		$sql = 'delete from orders where oid="'.$_GET['oid'].'"';
    		mysql_query($sql);
    		echo '<script>alert("恭喜您，删除订单成功！");window.location="showOrder.php?method=check&state='.$_GET['state'].'"</script>';
    	}else if($_GET['method']=="changeState"){
    		$sql = 'UPDATE orders SET state=1 where oid="'.$_GET['oid'].'";';
    		echo $sql;
    		mysql_query($sql);
    		echo "<script>alert('恭喜您，发货成功！');window.location='showOrder.php?method=check&state=1'</script>";
    	}
    }	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8" />
	<title>基于PHP的购物商城</title>
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="css/style.min.css" rel="stylesheet" />
	<link href="css/style-responsive.min.css" rel="stylesheet" />
	<link href="css/retina.css" rel="stylesheet" />
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
	
	<!-- start: Favicon and Touch Icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
	<link rel="shortcut icon" href="ico/favicon.png" />
	<!-- end: Favicon and Touch Icons -->	
		
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>
		<?php include "header.php" ?>
	
		<div class="container-fluid-full">
		<div class="row-fluid">
			<?php include "banner.php" ?>
						
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title="">
						<h2><i class="icon-sitemap"></i><span class="break"></span>商品详情</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							  	  <th style="text-align:center;">订单号</th>
							 	  <th style="text-align:center;">订单时间</th>
							  	  <th style="text-align:center;">用户名</th>
							  	  <th style="text-align:center;">手机(型号)*数量</th>
							  	  <th style="text-align:center;">评价状态</th>
								  <th style="text-align:center;">订单金额</th>
								  <th style="text-align:center;">订单状态</th>  
								  <th style="text-align:center;">操作</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  while ($row = mysql_fetch_assoc($res)){
						  	if($row['state']==0){
						  		$tip="label-important";
						  		$state="待发货";
						  	}else if($row['state']==1){
						  		$tip="label-warning";
						  		$state="待收货";
						  	}else{
						  		$tip="label-success";
						  		$state="已完成";
						  	}

							$json_url = $row['goodslist'];
							$goodslist = URLdecode($json_url);
						    $json_data = json_decode($goodslist);
							$item_num = count($json_data);
						    $order = array();

						    foreach((array)$json_data as $item){
						    	$sqls = 'select * from goods where gid = '.$item->gid;
						    	$ress = mysql_query($sqls);
						    	$rows = mysql_fetch_assoc($ress);
						    	if($item->check==0){
						    		$check = '已评论';
						    		$tip2 = 'label-success';
						    	}
						    	else{
						    		$check = '未评论';
						    		$tip2 = 'label-important';
						    	}
							    $goods = array(	
							        'gname' => $rows['gname'],
							        'gnum' => $item->gnum,
							        'type' => $item->type,
							        'check' => $check,
							        'tip' => $tip2
						    	);
							    //往二维数组追加元素
							    array_push($order,$goods);
							}
						  		$uid = $row['uid'];
								$sqls = 'select * from user where uid = '.$uid;
							    		$ress = mysql_query($sqls);
							    		$rows = mysql_fetch_assoc($ress);
							    $uname = $rows['uname'];

							    $oid = $row['oid'];
								$odate = $row['odate'];
								$money = $row['money'];


						  	echo '
							<tr>
								<td style="text-align:center;vertical-align:middle;" class="center">'.$oid.'</td>
								<td style="text-align:center;vertical-align:middle;" class="center">'.$odate.'</td>
								<td style="text-align:center;vertical-align:middle;" class="center">'.$uname.'</td>
								<td style="text-align:center;vertical-align:middle;" class="center">';
   								
   							foreach($order as $k=>$goods){  
   								if($goods["gname"])
						       		echo $goods["gname"]."(".$goods["type"].")*".$goods['gnum']."<br>"; 
						    }


							echo '
								</td>
								<td style="text-align:center;vertical-align:middle;" class="center">';
								//单品评价状态
								for($i=0;$i<$item_num;$i++)
									echo '<span class="label '.$goods["tip"].'">'.$goods["check"].'</span><br>';
							
							echo '
								</td>
								<td style="text-align:center;vertical-align:middle;" class="center">'.$money.'</td>
								<td style="text-align:center;vertical-align:middle;" class="center">
									<span class="label '.$tip.'">'.$state.'</span>
								</td>
								
								<td style="text-align:center;vertical-align:middle;" class="center"> ';
									if($row['state']==0)
										echo '
									<a class="btn btn-info" href="showOrder.php?oid='.$row['oid'].'&method=changeState">
										<i class="icon-truck "></i> 
										';
							echo ' 
									</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a class="btn btn-danger" href="showOrder.php?method=del&oid='.$row['oid'].'&state='.$row['state'].'">
										<i class="icon-trash "></i> 
									</a>
								</td>
							</tr>
							';
						}?>
						  </tbody>
					  </table>             
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			

		<?php include "footer.php" ?>
		<?php mysql_close();?>
				
	</div><!--/.fluid-container-->

	<!-- start: JavaScript-->
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/jquery-migrate-1.2.1.min.js"></script>	
		<script src="js/jquery-ui-1.10.3.custom.min.js"></script>	
		<script src="js/jquery.ui.touch-punch.js"></script>	
		<script src="js/modernizr.js"></script>	
		<script src="js/bootstrap.min.js"></script>	
		<script src="js/jquery.cookie.js"></script>	
		<script src='js/fullcalendar.min.js'></script>	
		<script src='js/jquery.dataTables.min.js'></script>
		<script src="js/excanvas.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.pie.js"></script>
		<script src="js/jquery.flot.stack.js"></script>
		<script src="js/jquery.flot.resize.min.js"></script>
		<script src="js/jquery.flot.time.js"></script>
		
		<script src="js/jquery.chosen.min.js"></script>	
		<script src="js/jquery.uniform.min.js"></script>		
		<script src="js/jquery.cleditor.min.js"></script>	
		<script src="js/jquery.noty.js"></script>	
		<script src="js/jquery.elfinder.min.js"></script>	
		<script src="js/jquery.raty.min.js"></script>	
		<script src="js/jquery.iphone.toggle.js"></script>	
		<script src="js/jquery.uploadify-3.1.min.js"></script>	
		<script src="js/jquery.gritter.min.js"></script>	
		<script src="js/jquery.imagesloaded.js"></script>	
		<script src="js/jquery.masonry.min.js"></script>	
		<script src="js/jquery.knob.modified.js"></script>	
		<script src="js/jquery.sparkline.min.js"></script>	
		<script src="js/counter.min.js"></script>	
		<script src="js/raphael.2.1.0.min.js"></script>
		<script src="js/justgage.1.0.1.min.js"></script>	
		<script src="js/jquery.autosize.min.js"></script>	
		<script src="js/retina.js"></script>
		<script src="js/jquery.placeholder.min.js"></script>
		<script src="js/wizard.min.js"></script>
		<script src="js/core.min.js"></script>	
		<script src="js/charts.min.js"></script>	
		<script src="js/custom.min.js"></script>
	<!-- end: JavaScript-->
	

</body>
</html>