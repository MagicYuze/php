<?php 
include "checkLogin.php";
    $con = mysql_connect("118.89.24.240","php","123456");//连接数据库
    if (!$con){
    	die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("phpfinal",$con);//选择数据库
    $sql = 'select * from category';
    $res = mysql_query($sql);
    
    if(isset($_GET['method'])){
    	if($_GET['method']=="del"){
    		$sql = "select * from goods where cid=".$_GET['cid'];
    		$res = mysql_query($sql);
    		if(mysql_num_rows($res)>0)
    			echo "<script>alert('不好意思，此品牌还有基于PHP的手机商城，无法删除！');window.location='showCategory.php'</script>";
    		else{
    			$sql = "delete from category where cid=".$_GET['cid'];
    			mysql_query($sql);
    			echo "<script>alert('恭喜您，删除品牌成功！');window.location='showCategory.php'</script>";
    		}
    	}else if($_GET['method']=="changeState"){
    		if($_GET['state']==1)
    			$sql = "UPDATE category SET state=0 where cid=".$_GET['cid'];
    		else if($_GET['state']==0)
    			$sql = "UPDATE category SET state=1 where cid=".$_GET['cid'];
    		mysql_query($sql);
    		echo "<script>alert('恭喜您，修改该品牌状态成功！');window.location='showCategory.php'</script>";
    	}
    }
    mysql_close($con);
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
		<h2><i class="icon-sitemap"></i><span class="break"></span>基于PHP的手机商城品牌</h2>
		</div>
		<div class="box-content">
		<table class="table table-striped table-bordered bootstrap-datatable datatable">
		<thead>
		<tr>
		<th style="text-align:center;">品牌ID</th>
		<th style="text-align:center;">品牌名称</th>
		<th style="text-align:center;">状态</th>
		<th style="text-align:center;">操作</th>
		</tr>
		</thead>   
		<tbody>
		<?php
		while ($row = mysql_fetch_assoc($res) ){
			if($row['state']==0){
				$tip="label-important";
				$state="已禁用";
			}else{
				$tip="label-success";
				$state="正常使用";
			}
			echo '
			<tr>
			<td style="text-align:center;" class="center">'.$row['cid'].'</td>
			<td style="text-align:center;" class="center">'.$row['cname'].'</td>
			<td style="text-align:center;" class="center">
			<span class="label '.$tip.'">'.$state.'</span>
			</td>
			<td style="text-align:center;" class="center">
			<a class="btn btn-success" href="showCategory.php?method=changeState&state='.$row['state'].'&cid='.$row['cid'].'">
			<i class="icon-off "></i> 
			</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="btn btn-info" href="editCategory.php?cid='.$row['cid'].'">
			<i class="icon-edit "></i>  
			</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="btn btn-danger" href="showCategory.php?method=del&cid='.$row['cid'].'">
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