<!DOCTYPE html>
<html>
<head>
	<title>基于PHP的手机商城</title>
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

	<!-- start: Favicon and Touch Icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
	<link rel="shortcut icon" href="ico/favicon.png" />
	<!-- end: Favicon and Touch Icons -->	

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
	<div class="w3l_banner_nav_right">
	<section class="slider">
	<div class="flexslider">
	<ul class="slides">
	<li>
	<div class="w3l_banner_nav_right_banner">

	</div>
	</li>
	<li>
	<div class="w3l_banner_nav_right_banner1">

	</div>
	</li>
	<li>
	<div class="w3l_banner_nav_right_banner2">

	</div>
	</li>
	</ul>
	</div>
	</section>
	<!-- flexSlider -->
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
	$(window).load(function(){
		$('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
				$('body').removeClass('loading');
			}
		});
	});
	</script>
			<!-- //flexSlider -->
			</div>
			<div class="clearfix"></div>
			</div>
			<!-- banner -->
			<!-- top-brands -->
			<div class="top-brands">
			<div class="container">
			<h3>热卖商品</h3>
			<div class="agile_top_brands_grids">
			<?php
					$selectSQL="select * from goods"; //只取前4个符合标准的
					$resultSet=mysql_query($selectSQL);
					$number=0;
					while(($db=mysql_fetch_array($resultSet)) && $number<4){

						$json_url = $db['type'];
						$typelist = URLdecode($json_url);
						$json_data = json_decode($typelist);
						$type = array();

						$totalgcount=0;
						$totalstate=0;   

						foreach((array)$json_data as $item){ //判断该商品
							$types = array(	
								'type' => $item->type,
								'price' => $item->price,
								'gcount' => $item->gcount,
								'state' => $item->state
							);
							$totalstate+=$item->state;
							$totalgcount+=$item->gcount;
							//往二维数组追加元素
							array_push($type,$types);
						}

						$maxprice=0;
						foreach ($type as $key => $value) {
							$maxprice=max($maxprice , $value['price']);
						}
						$minprice=$maxprice;
						foreach ($type as $key => $value) {   //从二维数组中取数据,取个最小价格出来
							$minprice=min($minprice,$value["price"]);
						}


						if($totalstate>0 && $totalgcount>0){
							$number+=1;
							echo "<div class=\"col-md-3 w3ls_w3l_banner_left\">
							<div class=\"hover14 column\">
							<div class=\"agile_top_brand_left_grid w3l_agile_top_brand_left_grid\">
							<div class=\"agile_top_brand_left_grid_po\s\">
							<img src=\"images/offer.png\" alt=\" \" class=\"img-responsive\" />
							</div>
							<div class=\"agile_top_brand_left_grid1\">
							<figure>
							<div class=\"snipcart-item block\">
							<div class=\"snipcart-thumb\">"
							."<a href='/php/user/single.php?page_current=1&page_size=4&gid=".$db["gid"]."'><img src='".$db["picture"]."' style='height:140px; width:140px;' alt=' ' class='img-responsive'></a>"."<p>".$db["gname"]."</p>"."<h4>￥".$minprice."-".$maxprice."</h4></div>
							</div>
							</figure>
							</div>
							</div>
							</div>
							</div>";
						}

						/*if($db["state"]==1){   //判断状态是否
							echo "<div class=\"col-md-3 w3ls_w3l_banner_left\">
						<div class=\"hover14 column\">
						<div class=\"agile_top_brand_left_grid w3l_agile_top_brand_left_grid\">
							<div class=\"agile_top_brand_left_grid_po\s\">
								<img src=\"images/offer.png\" alt=\" \" class=\"img-responsive\" />
							</div>
							<div class=\"agile_top_brand_left_grid1\">
								<figure>
									<div class=\"snipcart-item block\">
										<div class=\"snipcart-thumb\">"
										."<a href='/php/user/single.php?gid=".$db["gid"]."'><img src='".$db["picture"]."' style='height:140px; width:140px;' alt=' ' class='img-responsive'></a>"
										."<p>".$db["gname"]."</p>"
										."<h4>￥".$db["price"]."</h4></div>"

										."
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>";
				}*/
			}
			?>
				<!--<div class="col-md-3 top_brand_left">
					<div class="hover14 column">
						<div class="agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block" >
										<div class="snipcart-thumb">
											<a href="single.html"><img title=" " alt=" " src="images/1.png" /></a>		
											<p>fortune sunflower oil</p>
											<h4>$7.99</h4>
										</div>
										<div class="snipcart-details top_brand_home_details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="1" data-name="Fortune sunflower oil" data-summary="summary 1" data-price="7.99" data-quantity="1" data-image="images/1.png">加入购物车</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
					</div>
				</div> -->
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //top-brands -->


	<!-- //footer -->
	<?php include "foot.php" ?>

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