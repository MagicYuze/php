<?php 
	include "checkLogin.php";
	$gname = "";
	$gid = 0;
	$cid = 0;
	$price = "";
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


	if(isset($_GET['gid'])){
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
	    $price = $row['price'];
		$cid = $row['cid'];
		$cname = $category[$cid];
		$introduction = $row['introduction'];
	    mysql_close($con);
	}

	if(isset($_POST['cid'])&&$_POST['cid']!=0){
		$gname = $_POST['gname'];
		$gid = $_POST['gid'];
		$price = $_POST['price'];
		$cid = $_POST['cid'];
		// $picture = "";
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


	    if($gid == 0){
	    	$res = mysql_query('select * from goods order by gid DESC');
       		$gid = mysql_fetch_assoc($res)['gid']+1;
		    $sql = 'INSERT INTO  goods (gid,gname,cid,gcount,picture,introduction,price,state) VALUES ('.$gid.',"'.$gname.'",'.$cid.',0,"'.$picture.'","'.$introduction.'",'.$price.',1);';
		    $res = mysql_query($sql);

		    if(mysql_affected_rows()>0){
		    	echo '<script>alert("恭喜您，添加商品成功！");window.location="showGoods.php"</script>';
		    }else{
		    	echo '<script>alert("不好意思，添加商品失败……");</script>';
		    	echo $sql;
		    }
		    mysql_close($con);
	    }else{
	    	$sql = 'UPDATE goods SET gname = "'.$gname.'",cid='.$cid.',picture="'.$picture.'",introduction="'.$introduction.'",price='.$price.' WHERE gid = '.$gid;
	    	$res = mysql_query($sql);
	    	if(mysql_affected_rows()>0){
		    	echo '<script>alert("恭喜您，修改商品信息成功！");window.location="showGoods.php"</script>';
		    }else{
		    	echo '<script>alert("'.$res.'");window.location="editGoods.php?gid='.$gid.'"</script>';
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
						<h2><i class="icon-edit"></i>商品分类</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data"/>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="cname">商品名称：</label>
							  <div class="controls">
								<input type="text" class="span3" id="gname" name="gname" value="<?php echo $gname;?>"/>
							  </div>
							</div>
							<div class="control-group">
											<label class="control-label" for="cname">商品类别：</label>
											<div class="controls">
											  	<select id="cname" name="cid">
											  	<option selected="selected" value="<?php echo $cid?>"><?php echo $cname?></option>
											  	 <?php foreach ( $category as $cid=>$cname ) { 
                        							echo '<option value="'.$cid.'">'.$cname.'</option>';
                    								}
                    							 ?>
											  	</select>
											</div>
										</div>
							<div class="control-group">
							  <label class="control-label" for="price">商品单价：</label>
							  <div class="controls">
							  	<input type="hidden" name="gid" value="<?php echo $gid;?>"/>
								<input type="text" class="span3" id="price" name="price" value="<?php echo $price;?>" onkeyup="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')"/>&nbsp;元
							  </div>
							</div>     
							<div class="control-group">
								<label class="control-label">商品图片：</label>
								<div class="controls">
									<input type="hidden" name="picture" value="<?php echo $picture; ?>">
								  <input type="file" name="image" size="25" maxlength="100" accept=".jpg,.gif,.jpeg,.png"/>
								</div>
							  </div>
							  <div class="control-group">
							  <label class="control-label" for="introduction">商品详情：</label>
							  <div class="controls">
								<input type="text" class="span3" id="introduction" name="introduction" value="<?php echo $introduction;?>"/>
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