<?php 
include "checkLogin.php";
    $con = mysql_connect("118.89.24.240","php","123456");//连接数据库
    if (!$con){
    	die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("phpfinal",$con);//选择数据库

    $sql = 'select * from category';
    $res = mysql_query($sql);
    $category = array();
    if(mysql_num_rows($res)>0){
    	while ($row = mysql_fetch_assoc($res) )
    		$category[$row['cid']] = $row['cname'];
    }


    $sql = 'select * from goods';
    $res = mysql_query($sql);

    if(isset($_GET['method'])){
    	if($_GET['method']=="del"){
    		$sql = 'select * from goods where gid ='.$_GET['gid'];
    		$res = mysql_query($sql);
    		$row = mysql_fetch_array($res);
    		$json_url = $row['type'];
    		$type_json = URLdecode($json_url);
    		$json_data = json_decode($type_json);
    		$type_num = count($json_data);
    		$types = array();
	   		 // 将json数据中的信息解析存到一个数组中
    		foreach((array)$json_data as $item){
    			if(strcmp($item->type, $_GET['type'])){
    				$type = array(	
    					'type' => $item->type,	
    					'price' => $item->price,
    					'gcount' => $item->gcount,
    					'state' => $item->state  
    				);
    				array_push($types, $type);
    			}
    		}
    		if(count($types)){
    		$newURI = URLencode(json_encode($types, JSON_UNESCAPED_UNICODE));
    		// $newURI = json_encode($types, JSON_UNESCAPED_UNICODE);
    		$sql = 'UPDATE goods SET type = "'.$newURI.'" WHERE gid = '.$_GET['gid'];
    		// echo $sql;
    		}else{//如果是空数组直接把整个手机全都删掉
    			$sql = 'delete from goods where gid = '.$_GET['gid'];
    		}
    		$res = mysql_query($sql);
    		if(mysql_affected_rows()>0)
    			echo "<script>alert('恭喜您，删除该型号手机成功！');window.location='showGoods.php'</script>";
    		else
    			echo "<script>alert('不好意思啊，删除该型号手机失败了！');window.location='showGoods.php'</script>";
    	}else if($_GET['method']=="changeState"){
    		$goods_type = $_GET['type'];
    		$sql = 'select * from goods where gid='.$_GET['gid'];
    		$res = mysql_query($sql);
    		$row = mysql_fetch_assoc($res);
    		$json_url = $row['type'];
    		$type_json = URLdecode($json_url);
    		$json_data = json_decode($type_json);
    		$type_num = count($json_data);
    		$types = array();

			// 将json数据中的信息解析存到一个数组中
    		foreach((array)$json_data as $item){
    			$newState = $item->state;

    			if(!strcmp($goods_type, $item->type)){
    				if($item->state)
    					$newState = 0;
    				else{
    					$newState = 1;
    				}
    			}
    			$type = array(	
    				'type' => $item->type,
    				'price' => $item->price,
    				'gcount' => $item->gcount,
    				'state' => $newState
    			);
				//往二维数组追加元素
    			array_push($types,$type);
    		}
    		$newURI = URLencode(json_encode($types, JSON_UNESCAPED_UNICODE));
    		// $newURI = json_encode($types, JSON_UNESCAPED_UNICODE);
    		$sql = "UPDATE goods SET type=\"".$newURI."\" where gid=".$_GET['gid'];
    		mysql_query($sql);
    		// echo $sql;
    		echo "<script>alert('恭喜您，修改该种类手机状态成功！');window.location='showGoods.php'</script>";
    	}
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
		<div class="box-header" data-original-title="">
		<h2><i class="icon-sitemap"></i><span class="break"></span>手机型号</h2>
		</div>
		<div class="box-content">
		<table class="table table-striped table-bordered bootstrap-datatable datatable">
		<thead>
		<tr>
		<th style="text-align:center;">手机图片</th>
		<th style="text-align:center;">手机名称</th>
		<th style="text-align:center;">手机品牌</th>
		<th style="text-align:center;">手机型号</th>
		<th style="text-align:center;">手机单价</th>
		<th style="text-align:center;">手机库存</th>
		<th style="text-align:center;">销售状态</th>
		<th style="text-align:center;">操作</th>
		</tr>
		</thead>   
		<tbody>
		<?php
		
		while ($row = mysql_fetch_assoc($res) ){
			$json_url = $row['type'];
			$type_json = URLdecode($json_url);
			$json_data = json_decode($type_json);
			$type_num = count($json_data);
			$types = array();
			
			// 将json数据中的信息解析存到一个数组中
			foreach((array)$json_data as $item){
				$type = array(	
					'type' => $item->type,
					'price' => $item->price,
					'gcount' => $item->gcount,
					'state' => $item->state  
				);
				//往二维数组追加元素
				array_push($types,$type);
			}
			echo '
			<tr>
			<td style="text-align:center;" class="center"><img style="width:100px;height:120px;	" src="'.$row['picture'].'"/></td>
			<td style="text-align:center;vertical-align:middle;line-height:30px;" class="center">'.$row['gname'].'</td>
			<td style="text-align:center;vertical-align:middle;line-height:30px;" class="center">'.$category[$row['cid']].'</td>
			<td style="text-align:center;vertical-align:middle;line-height:30px;" class="center">';
			//显示手机详情
			for($i=0;$i<$type_num;$i++){
				echo $types[$i]['type'];
				echo '<br>';
			}
			echo '
			</td><td style="text-align:center;vertical-align:middle;line-height:30px;" class="center">';
			//显示手机价格
			for($i=0;$i<$type_num;$i++){
				echo $types[$i]['price'].'元';
				echo '<br>';
			}
			echo '
			</td><td style="text-align:center;vertical-align:middle;line-height:30px;" class="center">';
			//显示手机价格
			for($i=0;$i<$type_num;$i++){
				echo $types[$i]['gcount'].'部';
				echo '<br>';
			}
			echo '</td><td style="text-align:center;vertical-align:middle;line-height:30px;" class="center">';
			//显示手机状态
			for($i=0;$i<$type_num;$i++){
				$state = $types[$i]['state'];
				if($state==0) echo '<span class="label label-important">已停售</span><br>';
				else echo '<span class="label label-success">正常销售</span><br>';
			}
			echo'
			</td><td style="text-align:center;vertical-align:middle;line-height:30px;" class="center">';
			for($i=0;$i<$type_num;$i++){
				echo '
				<a class="btn btn-success" href="showGoods.php?method=changeState&gid='.$row['gid'].'&type='.$types[$i]['type'].'">
				<i class="icon-off "></i> 
				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="btn btn-warning" href="editGoodsCount.php?gid='.$row['gid'].'&type='.$types[$i]['type'].'">
				<i class="icon-shopping-cart"></i>  
				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="btn btn-info" href="editGoods.php?gid='.$row['gid'].'&type='.$types[$i]['type'].'&method=edit">
				<i class="icon-edit "></i>  
				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="btn btn-danger" href="showGoods.php?method=del&gid='.$row['gid'].'&type='.$types[$i]['type'].'">
				<i class="icon-trash "></i> 
				</a><br>';
			}
			echo '
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