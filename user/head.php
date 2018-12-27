<!-- header -->
<?php 
include_once ('functions/database.php'); 
get_connection();
isset($_SESSION) OR session_start();
?>

<div class="agileits_header">
	<div class="w3l_offers">
		<a href="index.php">PHP手机商城</a>
	</div>
	<div class="w3l_search">
		<form action="/php/user/products.php?page_current=1&page_size=4" method="post">
			<input type="text" name="gname" value="搜索商品..." onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '搜索商品...';}" required="">
			<input type="submit" value=" ">
		</form>
	</div>
	<div class="w3l_header_right">
		<ul>
			<li class="dropdown profile_details_drop">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
				<div class="mega-dropdown-menu">
					<div class="w3ls_vegetables">
						<ul class="dropdown-menu drp-mnu">
						</ul>
					</div>                  
				</div>	
			</li>
		</ul>
	</div>
	<div class="w3l_header_right">
		<ul>
			<li class="dropdown profile_details_drop" width="50px">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true" ></i><span>
					<?php 
							if(isset($_SESSION["username"])){  //登录后存的用户名
								echo $_SESSION["username"];
							}
							?></span></a>
							<div class="mega-dropdown-menu">
								<div class="w3ls_vegetables">
									<ul class="dropdown-menu drp-mnu">
										<?php
										if(isset($_SESSION["user"])){
											echo "<li><a href=\"login.php?type=log\" id=\"logoff\">注销</a></li>";	
										}
										else{
											echo "<li><a href=\"login.php\">登录</a></li>"; 
											echo "<li><a href=\"login.php\">注册</a></li>";
										}
										?>
									</ul>
								</div>                  
							</div>	
						</li>
					</ul>
				</div>
				<div class="w3l_header_right1">
					<h2><a href="">欢迎光临</a></h2>
				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- script-for sticky-nav -->
			<script>
				$(document).ready(function() {
					var navoffeset=$(".agileits_header").offset().top;
					$(window).scroll(function(){
						var scrollpos=$(window).scrollTop(); 
						if(scrollpos >=navoffeset){
							$(".agileits_header").addClass("fixed");
						}else{
							$(".agileits_header").removeClass("fixed");
						}
					});
					
				});
			</script>
			<!-- //script-for sticky-nav -->
			<div class="logo_products">
				<div class="container">
					<div class="w3ls_logo_products_left">
						<h1><a href="index.php"><span>手机</span>商城</a></h1>
					</div>
					<div class="w3ls_logo_products_left1">
						<ul class="special_items">
							<?php
						if(isset($_SESSION['user'])){		//已登录
							echo "<li>
							<span class=\"glyphicon glyphicon-shopping-cart my-cart-icon\" style=\"cursor: pointer\"><a href=\"javascript:void(0)\">
							<i class=\"badge badge-notify my-cart-badge\"></i>&nbsp;&nbsp;购物车
							</a>
							</span><i>/</i>
							</li>
							<li><a href=\"events.php\"><img src=\"./images/orderform.jpg\" width=\"16px\" height=\"16px\" style=\"margin-top:-2px;\">&nbsp;订单</a><i>/</i></li>";
						}
						?>
					<!--<li>
						<span class="glyphicon glyphicon-shopping-cart my-cart-icon" style="cursor: pointer"><a href="javascript:void(0)">
								<i class="badge badge-notify my-cart-badge"></i>&nbsp;&nbsp;购物车
						 </a>
						</span><i>/</i>
					</li>
					<li><a href="events.php"><img src="./images/orderform.jpg" width="16px" height="16px" style="margin-top:-2px;">&nbsp;订单</a><i>/</i></li>-->

					<li><?php for($i=0;$i<45;$i++)echo "&nbsp;"; ?></li>
				</ul>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+2016) 414 00000</li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i>16软卓1班@php.com</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //header -->
	<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">首页</a><span>|</span></li>
				<?php
						$searchSQL="select * from category";
						$resultSet=mysql_query($searchSQL);
						while($db=mysql_fetch_array($resultSet)){
							if($db['state']==1){
								echo "<li><a href=\"products.php?page_current=1&page_size=4&cid=".$db['cid']."\">".$db['cname']."</a><span>|</span></li>";
							}
						}
						?>
			</ul>
		</div>
	</div>
	<!-- //products-breadcrumb -->

	<!-- 以上已完成，订单如下 -->
	<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav nav_1">
						<?php
						$searchSQL="select * from category";
						$resultSet=mysql_query($searchSQL);
						while($db=mysql_fetch_array($resultSet)){
							if($db['state']==1){
								echo "<li><a href=\"products.php?page_current=1&page_size=4&cid=".$db['cid']."\">".$db['cname']."</a></li>";
							}
						}
						?>
						<!--<li><a href="products.html">Branded Foods</a></li>
						<li><a href="household.html">Households</a></li>
						<li class="dropdown mega-dropdown active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Veggies & Fruits<span class="caret"></span></a>				
							<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
								<div class="w3ls_vegetables">
									<ul>	
										<li><a href="vegetables.html">Vegetables</a></li>
										<li><a href="vegetables.html">Fruits</a></li>
									</ul>
								</div>                  
							</div>				
						</li>
						<li><a href="kitchen.html">Kitchen</a></li>
						<li><a href="short-codes.html">Short Codes</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Beverages<span class="caret"></span></a>
							<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
								<div class="w3ls_vegetables">
									<ul>
										<li><a href="drinks.html">Soft Drinks</a></li>
										<li><a href="drinks.html">Juices</a></li>
									</ul>
								</div>                  
							</div>	
						</li>
						<li><a href="pet.html">Pet Food</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Frozen Foods<span class="caret"></span></a>
							<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
								<div class="w3ls_vegetables">
									<ul>
										<li><a href="frozen.html">Frozen Snacks</a></li>
										<li><a href="frozen.html">Frozen Nonveg</a></li>
									</ul>
								</div>                  
							</div>	
						</li>
						<li><a href="bread.html">Bread & Bakery</a></li>-->
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</div>

	<style>
	.snipcart-thumb h4{
		margin-inline-start: 45%;
	}
	.snipcart-thumb p{
		margin-inline-start: 21%;
	}
</style>