<!DOCTYPE html>
<html>
<head>
<title>Sign In & Sign Up</title>
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
<!-- start-smoth-scrolling -->
</head>
	
<body>
<?php include "head.php" ?>
<?php    //js中无法写php
	if(is_array($_GET)&&count($_GET)>0){ //先判断是否通过get传值了
		$type=$_GET['type'];
		if($type=="log"){  //注销
			unset($_SESSION["user"]);
			echo "<script>window.location.href='login.php'</script>";
		}
	}
?>
		<div class="w3l_banner_nav_right">
<!-- login -->
		<div class="w3_login" id="lr">
			<h3>登录 & 注册</h3>
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
					<div class="tooltip">跳转</div>
				  </div>
				  <div class="form">
					<h2>登录</h2>
					<form action="/php/user/check.php?type=login" method="post">
					  <input type="text" name="Username" placeholder="用户名" required=" ">
					  <input type="password" name="Password" placeholder="密码" required=" ">
					  <input type="submit" value="登录">
					</form>
				  </div>
				  <div class="form">
					<h2>注册</h2>
					<form action="/php/user/check.php?type=register" method="post">
					  <input type="text" name="Username" placeholder="用户名" required=" ">
					  <input type="password" name="Password" placeholder="密码" required=" ">
					  <input type="email" name="Email" placeholder="邮箱地址" required=" ">
					  <input type="text" name="Phone" placeholder="手机号码" required=" ">
					  <input type="submit" value="注册">
					</form>
				  </div>
				  <div class="cta"><a href="javascript:void(0)" id="change">忘记密码?</a></div>
				</div>
			</div>

			<script>
				$('#change').click(function(){
					$('#lr').slideUp("slow");
					$('#forget').slideDown("slow");
					$('#forget1').css("display","block");
				});
			</script>

			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>

		<div class="w3_login" style="display:none" id="forget">    <!--忘记密码-->
			<h3>更改密码</h3>
			<div class="w3_login_module">
				<div class="module form-module">
					<div class="toggle"><i class="fa fa-times fa-pencil"></i>
				  	</div>
					<div class="form" id="forget1">
						<h2>更改密码</h2>
						<form action="/php/user/check.php?type=change" method="post">
							<input type="text" name="Username" placeholder="用户名" required=" ">
					  		<input type="email" name="Email" placeholder="邮箱地址" required=" ">
					  		<input type="text" name="Phone" placeholder="手机号码" required=" ">
					  		<input type="password" name="newPassword" placeholder="新密码" required=" ">	
					  		<input type="submit" value="更改">
						</form>
				 	</div>
				 	<div class="cta"><a href="javascript:void(0)" id="lg">登录?</a></div>
				</div>
			</div>

			<script>
				$('#lg').click(function(){
					$('#lr').slideDown("slow");
					$('#forget').slideUp("slow");
				});
			</script>
		</div>
<!-- //login -->
		</div>
		<div class="clearfix"></div>
<!-- //banner -->
<!-- footer -->
	<?php include "foot.php" ?>
<!-- //footer -->
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
</body>
</html>