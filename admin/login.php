<?php
$remember = "";
$userName = '';
$password = '';
if(isset($_GET['method'])){
	if($_GET['method']=="del"){
		session_start();
		unset($_SESSION['uid']);
	}
}
//第一次登陆的时候，通过用户输入的信息来确认用户
if(isset($_POST['usernamee'])&&isset($_POST['password'])){
	if ( ( $_POST['usernamee'] != null ) && ( $_POST['password'] != null ) ) {
		    $userName = $_POST['usernamee'];
		    $password = $_POST['password'];
		    $con = mysqli_connect('118.89.24.240','php','123456');

		    mysqli_select_db($con,'phpfinal');

		    $sql = 'select * from user where uname = "'.$userName.'"';
		    $res = mysqli_query($con,$sql);
		    $row = mysqli_fetch_assoc($res);
		    if ($row['password'] == $password) {
		    	if($row['state']==0){
		    		echo '<script>alert("该账户已被停用！");window.location="login.php"</script>;';
		    	}else if($row['level']==0){
		    		echo '<script>alert("该账户无权限进入管理系统！");window.location="login.php"</script>;';
		    	}
		    	if(isset($_POST['remember'])){
		    		if($_POST['remember']=="yes"){
			    		//密码验证通过，设置cookies，把用户名和密码保存在客户端
				        setcookie('username',$userName,time()+60*60*24*30);//设置时效一个月,一个月后这个cookie失效
				        setcookie('password',$password,time()+60*60*24*30);
		    		}
		    	}else{
				        setcookie('username');//设置时效一个月,一个月后这个cookie失效
				        setcookie('password');
		    	}
		        
		        session_start();
		        $_SESSION['uid'] = $row['uid'];
				//最后跳转到登录后的欢迎页面
		        // header('Location: index.php');
		        echo '<script>window.location="index.php"</script>;';
		    }
		    else
		    	echo '<script>alert("用户名或密码错误");</script>;';
		}
	}
if(isset($_COOKIE['username'])){
	//再次访问的时候通过cookie来识别用户
	if ( ($_COOKIE['username'] != null)  && ($_COOKIE['password'] != null) ) {
	    $userName = $_COOKIE['username'];
	    $password = $_COOKIE['password'];
	    $remember = "checked";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8" />
	<title>基于PHP的购物商城</title>
	<meta name="description" content="SimpliQ - Flat & Responsive Bootstrap Admin Template." />
	<meta name="author" content="Łukasz Holeczek" />
	<meta name="keyword" content="SimpliQ, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina" />
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
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<h2>登录您的账户</h2>
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" />
						<fieldset>
							
							<input class="input-large span12" name="usernamee" id="usernamee" type="text" placeholder="输入用户名" value="<?php echo $userName ?>"/>

							<input class="input-large span12" name="password" id="password" type="password" placeholder="输入密码" value="<?php echo $password ?>"/>

							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><input name="remember" value="yes" type="checkbox" id="remember" checked="<?php echo $remember ?>" />记住密码</label>
							
							<div class="clearfix"></div>
							
							<button type="submit" class="btn btn-primary span12">登录</button>
						</fieldset>	

					</form>	
				</div>
			</div><!--/row-->
			
				</div><!--/fluid-row-->
				
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