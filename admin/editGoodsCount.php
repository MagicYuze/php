<?php 
include "checkLogin.php";
$gname = "";
$gid = 0;
$gcount = 0;
if(isset($_GET['gid'])){
		$con = mysql_connect("118.89.24.240","php","123456");//连接数据库
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
	    mysql_select_db("phpfinal",$con);//选择数据库
	    $sql = 'select * from goods where gid ='.$_GET['gid'];
	    $res = mysql_query($sql);
	    $row = mysql_fetch_array($res);  
	    $gid = $row['gid'];
	    $json_url = $row['type'];
	    $type_json = URLdecode($json_url);
	    $json_data = json_decode($type_json);
	    $type_num = count($json_data);
	    $types = array();

		// 将json数据中的信息解析存到一个数组中
	    foreach((array)$json_data as $item){
	    	if(!strcmp($_GET['type'], $item->type)){
	    		$gcount = $item->gcount;
	    		$gname = $row['gname'].' '.$item->type;
	    	}
	    }
	    mysql_close($con);
	}
	if(isset($_POST['gcount'])&&$_POST['gcount']!=0){
		$gcount = $_POST['gcount'];
		$gid = $_POST['gid'];
		$type = $_POST['type'];
		$con = mysql_connect("118.89.24.240","php","123456");//连接数据库
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
	    mysql_select_db("phpfinal",$con);//选择数据库
	    $sql = 'select * from goods where gid ='.$_POST['gid'];
	    $res = mysql_query($sql);
	    $row = mysql_fetch_array($res);  
	    $gid = $row['gid'];
	    $json_url = $row['type'];
	    $type_json = URLdecode($json_url);
	    $json_data = json_decode($type_json);
	    $type_num = count($json_data);
	    $types = array();
	    // 将json数据中的信息解析存到一个数组中
	    foreach((array)$json_data as $item){
	    	if(!strcmp($_POST['type'], $item->type))
	    		$type_gcount = $_POST['gcount'];
	    	else
	    		$type_gcount = $item->gcount;
	    	$type = array(	
	    		'type' => $item->type,
	    		'price' => $item->price,
	    		'gcount' => $type_gcount,
	    		'state' => $item->state  
	    	);
				//往二维数组追加元素
	    	array_push($types,$type);
	    }$newURI = URLencode(json_encode($types, JSON_UNESCAPED_UNICODE));


	    $sql = 'UPDATE goods SET type = "'.$newURI.'"WHERE gid = '.$gid;
	    $res = mysql_query($sql);
	    if(mysql_affected_rows()>0){
	    	echo '<script>alert("恭喜您，修改库存信息成功！");window.location="showGoods.php"</script>';
	    }else{
	    	echo "<script>alert('不好意思，修改库存信息失败……');</script>";
	    }
	    mysql_close($con);
	}
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<!-- start: Meta -->
		<meta charset="utf-8" />
		<title>基于PHP的手机商城</title>
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
		<div class="box-header">
		<h2><i class="icon-edit"></i><?php echo $gname;?></h2>
	</div>
	<div class="box-content">
		<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"/>
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="gcount">库存数量：</label>
					<div class="controls">
						<input type="hidden" name="gid" value="<?php echo $gid;?>">
						<input type="hidden" name="type" value="<?php echo $_GET['type'];?>">
						<input onkeyup = "value=value.replace(/[^\d]/g,'')" type="text" class="span3"  id="gcount" name="gcount" value="<?php echo $gcount;?>"/>
					</div>
				</div>        

				<div class="form-actions">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="submit" class="btn btn-primary">提交</button>
					<button type="reset" class="btn">重置</button>
				</div>
			</fieldset>
		</form>   

	</div>
</div><!--/span-->
</div><!--/row-->				
</div>
<!-- end: Content -->

</div><!--/fluid-row-->

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