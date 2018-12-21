<?php 
	include "checkLogin.php";
	$con = mysql_connect("118.89.24.240","php","123456");//连接数据库
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("phpfinal",$con);//选择数据库
    //统计用户数
    $sql_countUser = 'select count("") as num from user';
    $res = mysql_query($sql_countUser);
    $row = mysql_fetch_array($res);
    $countUser = $row['num'];
    //统计商品分类数
    $sql_countCategory = 'select count("") as num from category';
    $res = mysql_query($sql_countCategory);
    $row = mysql_fetch_array($res);
    $countCategory = $row['num'];
    //统计商品数
    $sql_countGoods = 'select count("") as num from goods';
    $res = mysql_query($sql_countGoods);
    $row = mysql_fetch_array($res);
    $countGoods = $row['num'];
    //统计订单数
    $sql_countOrder = 'select count("") as num from orders';
    $res = mysql_query($sql_countOrder);
    $row = mysql_fetch_array($res);
    $countOrder = $row['num'];

    //近7天的订单情况
    //前6天订单数量 
    $sql_num_6days_ago = 'SELECT count("") as num FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 6';
    $res = mysql_query($sql_num_6days_ago);
    $row = mysql_fetch_array($res);
    $num_6days_ago = $row['num'];
    //前6天订单销量
    $sql_money_6days_ago = 'SELECT SUM(money) as total FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 6';
    $res = mysql_query($sql_money_6days_ago);
    $row = mysql_fetch_array($res);
    $money_6days_ago = $row['total']/1000;

    //前5天订单数量 
    $sql_num_5days_ago = 'SELECT count("") as num FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 5';
    $res = mysql_query($sql_num_5days_ago);
    $row = mysql_fetch_array($res);
    $num_5days_ago = $row['num'];
    //前5天订单销量
    $sql_money_5days_ago = 'SELECT SUM(money) as total FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 5';
    $res = mysql_query($sql_money_5days_ago);
    $row = mysql_fetch_array($res);
    $money_5days_ago = $row['total']/1000;

    //前4天订单数量 
    $sql_num_4days_ago = 'SELECT count("") as num FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 4';
    $res = mysql_query($sql_num_4days_ago);
    $row = mysql_fetch_array($res);
    $num_4days_ago = $row['num'];
    //前4天订单销量
    $sql_money_4days_ago = 'SELECT SUM(money) as total FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 4';
    $res = mysql_query($sql_money_4days_ago);
    $row = mysql_fetch_array($res);
    $money_4days_ago = $row['total']/1000;

    //前3天订单数量 
    $sql_num_3days_ago = 'SELECT count("") as num FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 3';
    $res = mysql_query($sql_num_3days_ago);
    $row = mysql_fetch_array($res);
    $num_3days_ago = $row['num'];
    //前3天订单销量
    $sql_money_3days_ago = 'SELECT SUM(money) as total FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 3';
    $res = mysql_query($sql_money_3days_ago);
    $row = mysql_fetch_array($res);
    $money_3days_ago = $row['total']/1000;

    //前2天订单数量 
    $sql_num_2days_ago = 'SELECT count("") as num FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 2';
    $res = mysql_query($sql_num_2days_ago);
    $row = mysql_fetch_array($res);
    $num_2days_ago = $row['num'];
    //前2天订单销量
    $sql_money_2days_ago = 'SELECT SUM(money) as total FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 2';
    $res = mysql_query($sql_money_2days_ago);
    $row = mysql_fetch_array($res);
    $money_2days_ago = $row['total']/1000;

    //前1天订单数量 
    $sql_num_1day_ago = 'SELECT count("") as num FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 1';
    $res = mysql_query($sql_num_1day_ago);
    $row = mysql_fetch_array($res);
    $num_1day_ago = $row['num'];
    //前1天订单销量
    $sql_money_1day_ago = 'SELECT SUM(money) as total FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 1';
    $res = mysql_query($sql_money_1day_ago);
    $row = mysql_fetch_array($res);
    $money_1day_ago = $row['total']/1000;

    //当天订单数量 
    $sql_num_today = 'SELECT count("") as num FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 0';
    $res = mysql_query($sql_num_today);
    $row = mysql_fetch_array($res);
    $num_today = $row['num'];
    //当天订单销量
    $sql_money_today = 'SELECT SUM(money) as total FROM orders WHERE TO_DAYS( NOW( ) ) - TO_DAYS(odate) = 0';
    $res = mysql_query($sql_money_today);
    $row = mysql_fetch_array($res);
    $money_today = $row['total']/1000;

    mysql_close();
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
				
				<div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
					<div class="boxchart-overlay blue">
						<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
					</div>	
					<span class="title">用户总数</span>
					<span class="value"><?php echo $countUser?></span>
				</div>
				
				<div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
					<div class="boxchart-overlay green">
						<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					</div>	
					<span class="title">商品分类总数</span>
					<span class="value"><?php echo $countCategory?></span>
				</div>
				
				<div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
					<div class="boxchart-overlay yellow">
						<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					</div>	
					<span class="title">商品总数</span>
					<span class="value"><?php echo $countGoods?></span>
				</div>
				
				<div class="span3 smallstat box mobileHalf" ontablet="span6" ondesktop="span3">
					<div class="boxchart-overlay red">
						<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					</div>	
					<span class="title">订单总数</span>
					<span class="value"><?php echo $countOrder?></span>
				</div>
			
			</div>	


			<div class="row-fluid">
				
				<div class="box span12">
					<div class="box-header">
						<h2>近7天&nbsp;&nbsp;&nbsp;&nbsp;订单(笔)/销量(千元)信息</h2>
					</div>
					<div class="box-content" style="height:308px;">
						<input type="hidden" id="MonB" value="<?php echo $num_6days_ago?>">
						<input type="hidden" id="MonR" value="<?php echo $money_6days_ago?>">
						<input type="hidden" id="TueB" value="<?php echo $num_5days_ago?>">
						<input type="hidden" id="TueR" value="<?php echo $money_5days_ago?>">
						<input type="hidden" id="WedB" value="<?php echo $num_4days_ago?>">
						<input type="hidden" id="WedR" value="<?php echo $money_4days_ago?>">
						<input type="hidden" id="TurB" value="<?php echo $num_3days_ago?>">
						<input type="hidden" id="TurR" value="<?php echo $money_3days_ago?>">
						<input type="hidden" id="FriB" value="<?php echo $num_2days_ago?>">
						<input type="hidden" id="FriR" value="<?php echo $money_2days_ago?>">
						<input type="hidden" id="SatB" value="<?php echo $num_1day_ago?>">
						<input type="hidden" id="SatR" value="<?php echo $money_1day_ago?>">
						<input type="hidden" id="SunB" value="<?php echo $num_today?>">
						<input type="hidden" id="SunR" value="<?php echo $money_today?>">
						<div id="stats-chart2" class="span11" style="height:308px"></div>
					</div>	
				</div>	
			</div>
			<!-- end: Content -->
				
				</div><!--/fluid-row-->
				
		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>
		
		<div class="clearfix"></div>
		
		<?php include "footer.php"?>
				
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