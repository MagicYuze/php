<?php 
include "checkLogin.php";
$gname = "";
$gid = 0;
$cid = 0;
$type = "";
$cname = "-- 请选择类别 --";
$introduction = "";
$picture = "";


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


    if(isset($_GET['gid'])&&isset($_GET['type'])&&!isset($_GET['method'])){
		$con = mysql_connect("118.89.24.240","php","123456");//连接数据库
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
	    mysql_select_db("phpfinal",$con);//选择数据库
	    $sql = 'select * from goods where gid ='.$_GET['gid'];
	    $res = mysql_query($sql);
	    $row = mysql_fetch_array($res);
	    $picture = $row['picture'];
	    $gname = $row['gname'];
	    $gid = $row['gid'];
	    $cid = $row['cid'];
	    $cname = $category[$cid];
	    $introduction = $row['introduction'];
	    $json_url = $row['type'];
	    $type_json = URLdecode($json_url);
	    $json_data = json_decode($type_json);
	    $type_num = count($json_data);
	    // 将json数据中的信息解析存到一个数组中
	    foreach((array)$json_data as $item){
	    	if(!strcmp($item->type, $_GET['type']))
	    		$type = array(	
	    			'type' => $item->type,
	    			'price' => $item->price,
	    			'gcount' => $item->gcount,
	    			'state' => $item->state  
	    		);
	    }
	    mysql_close($con);
	}

	if(isset($_POST['cid'])&&$_POST['cid']!=0){
		$gname = $_POST['gname'];
		$gid = $_POST['gid'];
		$price = $_POST['price'];
		$cid = $_POST['cid'];
		$typea = $_POST['type'];
		$state = 1;
		$gcount = 0;	
		$introduction = $_POST['introduction'];

		if(isset($_FILES['image'])){
			$file = $_FILES['image'];
			$error = $file['error'];
			switch ($error) {
				case 0:
				$fileName = $file['name'];
				$fileType = $file['type'];
				$fileSize = $file['size'];
				$fileTmp_name = $file['tmp_name'];

				$destination = "./img/goods/".$fileName;
				move_uploaded_file($fileTmp_name,iconv('UTF-8','gbk',$destination));
				$picture = "/php/admin/img/goods/".$fileName; 
				break;
				default:
				if(!empty($_POST['picture']))
					$picture = $_POST['picture'];
				else
					$picture = "/php/admin/img/goods/default.jpg";
			}
		}  

		$con = mysql_connect("118.89.24.240","php","123456");//连接数据库
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
	    mysql_select_db("phpfinal",$con);//选择数据库

	    //判断是否数据库中有这个商品了
	    $sql = 'select * from goods where gname="'.$_POST['gname'].'" AND cid='.$_POST['cid'];
	    $flag = mysql_num_rows(mysql_query($sql));
	    if($flag <= 0){//表示数据库中没有此商品
	    	$res = mysql_query('select * from goods order by gid DESC');
	    	$gid = mysql_fetch_assoc($res)['gid']+1;
	    	$newArray = array();
	    	$types = array(	
	    		'type' => $type,
	    		'price' => $price,
	    		'gcount' => 0,
	    		'state' => 1);
	    	array_push($newArray, $types);
	    	$typesURI = URLencode(json_encode($newArray,JSON_UNESCAPED_UNICODE));
	    	$sql = 'INSERT INTO  goods (gid,gname,cid,picture,introduction,type) VALUES ('.$gid.',"'.$gname.'",'.$cid.',"'.$picture.'","'.$introduction.'","'.$typesURI.'");';
	    	$res = mysql_query($sql);

	    	if(mysql_affected_rows()>0){
	    		echo '<script>alert("恭喜您，添加手机成功！");window.location="showGoods.php"</script>';
	    	}else{
	    		echo '<script>alert("不好意思，添加手机失败……");</script>';
	    		// echo $sql;
	    	}
	    	mysql_close($con);
	    }else if($flag > 0){
	    	$sql = 'select * from goods where gname ="'.$_POST['gname'].'" AND cid = '.$_POST['cid'];
	    	$res = mysql_query($sql);
	    	$row = mysql_fetch_array($res);
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
	    		array_push($types, $type);
	    	}
	    	$type = array(	
	    			'type' => $typea,	
	    			'price' => $price,
	    			'gcount' => $gcount,
	    			'state' => $state  
	    		);
	    	array_push($types, $type);
	    	$newURI = URLencode(json_encode($types, JSON_UNESCAPED_UNICODE));
	    	// $newURI = json_encode($types, JSON_UNESCAPED_UNICODE);
	    	$sql = 'UPDATE goods SET type = "'.$newURI.'" WHERE gname = "'.$gname.'";';
	    	$res = mysql_query($sql);
	    	// echo $sql;
	    	if(mysql_affected_rows()>0){
	    		echo '<script>alert("恭喜您，已将该类型手机添加到'.$_POST['gname'].'的信息中！");window.location="showGoods.php"</script>';
	    	}else{
	    		echo '<script>alert("不好意思啊，添加失败了");window.location="editGoods.php?gid='.$gid.'"</script>';
	    	}
	    	mysql_close($con);
	    }else{//更新商品的详细类别的信息
	    	$gid = $_POST['gid'];
	    	$price = $_POST['price'];
	    	$typea = $_POST['type'];
	    	$typeOld = $_POST['typeOld'];

	    	$sql = 'select * from goods where gid ='.$_POST['gid'];
	    	$res = mysql_query($sql);
	    	$row = mysql_fetch_array($res);
	    	$json_url = $row['type'];
	    	$type_json = URLdecode($json_url);
	    	$json_data = json_decode($type_json);
	    	$type_num = count($json_data);
	    	$types = array();
	   		 // 将json数据中的信息解析存到一个数组中
	    	foreach((array)$json_data as $item){
	    		if(!strcmp($item->type, $typeOld))
	    			$type = array(	
	    				'type' => $typea,
	    				'price' => $price,
	    				'gcount' => $item->gcount,
	    				'state' => $item->state  
	    			);
	    		else
	    			$type = array(	
	    				'type' => $item->type,	
	    				'price' => $item->price,
	    				'gcount' => $item->gcount,
	    				'state' => $item->state  
	    			);
	    		array_push($types, $type);
	    	}
	    	$newURI = URLencode(json_encode($types, JSON_UNESCAPED_UNICODE));
	    	// $newURI = json_encode($types, JSON_UNESCAPED_UNICODE);
	    	$sql = 'UPDATE goods SET type = "'.$newURI.'" WHERE gid = '.$gid;
	    	$res = mysql_query($sql);
	    	// echo $sql;
	    	if(mysql_affected_rows()>0){
	    		echo '<script>alert("恭喜您，修改该类型手机信息成功！");window.location="showGoods.php"</script>';
	    	}else{
	    		echo '<script>alert("不好意思啊，修改失败了");window.location="editGoods.php?gid='.$gid.'"</script>';
	    	}
	    	mysql_close($con);
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
		<div class="box-header">
		<h2><i class="icon-edit"></i>手机分类</h2>
		</div>
		<div class="box-content">
		<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data"/>
		<fieldset>
		<div class="control-group">
		<label class="control-label" for="cname">手机名称：</label>
		<div class="controls">
		<input type="text" class="span3" id="gname" name="gname" value="<?php echo $gname;?>"
		<?php if(isset($_GET['type'])) echo 'readonly="readonly"'?>
		/>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="cname">手机类别：</label>
		<div class="controls">
		<select id="cname" name="cid">
		<option selected="selected" value="<?php echo $cid?>"><?php echo $cname?></option>
		<?php 
		if(!isset($_GET['type']))
			foreach ( $category as $cid=>$cname ) { 
				echo '<option value="'.$cid.'">'.$cname.'</option>';
			}
			?>
		</select>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="type">手机详情：</label>
	<div class="controls">
		<input type="text" class="span3" id="type" name="type" value="<?php if(isset($_GET['type'])) echo $type['type'];?>"/>
		<input type="hidden" id="typeOld" name="typeOld" value="<?php if(isset($_GET['type'])) echo $type['type'];?>"/>
	</div>
</div>     
<div class="control-group">
	<label class="control-label" for="price">手机单价：</label>
	<div class="controls">
		<input type="hidden" name="gid" value="<?php echo $gid;?>"/>
		<input type="text" class="span3" id="price" name="price" value="<?php if(isset($_GET['type'])) echo $type['price'];?>" onkeyup="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')"/>&nbsp;元
	</div>
</div>     
<div class="control-group">
	<label class="control-label">手机图片：</label>
	<div class="controls">
		<input type="hidden" name="picture" value="<?php echo $picture; ?>">
		<input type="file" name="image" size="25" maxlength="100" accept=".jpg,.gif,.jpeg,.png"/>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="introduction">手机介绍：</label>
	<div class="controls">
		<input type="text" class="span3" id="introduction" name="introduction" value="<?php echo $introduction;?>"<?php if(isset($_GET['type'])) echo 'readonly="readonly"'?>/>
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