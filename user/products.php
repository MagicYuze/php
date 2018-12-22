<!DOCTYPE html>
<html>
<head>
<title>products</title>
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
<!-- header -->
	<?php include "head.php" ?>
	<?php include "functions/page.php" ?>
		<div class="w3l_banner_nav_right">
			<div class="w3l_banner_nav_right_banner7">
				<h3>Best Deals For New Products<span class="blink_me"></span></h3>
			</div>
			<?php
				$gname;
				$cid;
				$cname;

				if(isset($_POST['gname'])){  //搜索功能,判断gname是否为空，以区分分类商品功能(POST的方式)
					$gname=$_POST['gname'];
					$selectSQ="select * from goods,category where gname LIKE '%".$gname."%' and goods.cid=category.cid";  //商品名称存在				
				}else if(isset($_GET['gname'])){   //(GET的方式,分页要用到)
					$gname=$_GET['gname'];
					$selectSQ="select * from goods,category where gname LIKE '%".$gname."%' and goods.cid=category.cid";
				}
				else if(isset($_GET['cid'])){
					$cid=$_GET['cid'];
					$selectSQ="select * from category where cid='".$cid."'";  //分类id存在
				}

				$resultSet=mysql_query($selectSQ);
				while($db=mysql_fetch_array($resultSet)){  //只是取个种类名字
					$cname=$db["cname"];
				}
			?>
			 <div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_sub" style="position: relative;">
				<h3><?php echo $cname ?></h3>   <!--商品类别名称-->
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<br/>
				<?php
					$page_size=$_GET["page_size"];  //几个为一页
					$page_current=$_GET["page_current"];  //当前页数

					$selectGood='';									
					if(isset($cid)){ //分类的sql语句				
						$selectGood="select * from goods where cid='".$cid."' and gcount>0 and state=1";   //总数据
					}
					else if(isset($gname)){   //这是搜索的sql语句(不同于上面:不需要再取cname了)
						$selectGood="select * from goods where gname LIKE '%".$gname."%' and gcount>0 and state=1";
					}

					$resultSet=mysql_query($selectGood);

					$total_records=mysql_num_rows($resultSet);  //总记录条数
					
					$start_records=($page_current-1)*$page_size;  //limit开始的条数
					$end_records=$page_size;  //limit的条数

					if(isset($cid)){ //分类的sql语句				
						$selectGood="select * from goods where cid='".$cid."' limit ".$start_records.",".$end_records;
					}
					else if(isset($gname)){   //这是搜索的sql语句
						$selectGood="select * from goods where gname LIKE '%".$gname."%' limit ".$start_records.",".$end_records;
					}

					$resultSet=mysql_query($selectGood);  //根据数据库取对应条数的

					while($db=mysql_fetch_array($resultSet)){  	//一个个展示(暂未分页)
						if($db["state"]==1 && $db["gcount"]>0){   //判断状态是否可以出售
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
										."<a href='/php/user/single.php?gid=".$db["gid"]."'><img src='".$db["picture"]."' style='height:140px;width:140px;' alt=' ' class='img-responsive'></a>"
										."<p>".$db["gname"]."</p>"
										."<h4>￥".$db["price"]."</h4></div>"

										."<div class=\"snipcart-details\">
											<button class=\"btn btn-danger my-cart-btn hvr-sweep-to-right\" data-id='".$db["gid"]."' data-name='".$db["gname"]."'data-summary='".$db["introduction"]."' data-price='".$db["price"]."' data-quantity='1' data-image='".$db["picture"]."'>加入购物车</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>";
				    }
				}
					$url;
					if(isset($cid)){ //分类的url	
				  		$url="/php/user/products.php?&page_size=".$page_size."&cid=".$cid;
				  	}else if(isset($gname)){
				  		$url="/php/user/products.php?&page_size=".$page_size."&gname=".$gname;
				  	}
				  echo "<div style='margin-top:400px; margin-left:780px;'>";
				  page($total_records,$page_size,$page_current,$url,null);
				  echo "</div>";
				?>				
				</div>
			</div>
		</div>

					<!--<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/49.png" alt=" " class="img-responsive" /></a>
											<p>orange soft drink (250 ml)</p>
											<h4>$5.00</h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="49" data-name="Orange soft drink" data-summary="summary 49" data-price="5.00" data-quantity="1" data-image="images/49.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/14.png" alt=" " class="img-responsive" /></a>
											<p>prune juice - sunsweet (1 ltr)</p>
											<h4>$4.00 <span>$5.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="14" data-name="Prune juice - sunsweet" data-summary="summary 14" data-price="4.00" data-quantity="1" data-image="images/14.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/15.png" alt=" " class="img-responsive" /></a>
											<p>coco cola zero can (330 ml)</p>
											<h4>$3.00 <span>$5.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="15" data-name="Coco cola zero can" data-summary="summary 15" data-price="3.00" data-quantity="1" data-image="images/15.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/16.png" alt=" " class="img-responsive" /></a>
											<p>sprite bottle (2 ltr)</p>
											<h4>$3.00 <span>$4.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="16" data-name="Sprite bottle" data-summary="summary 16" data-price="3.00" data-quantity="1" data-image="images/16.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<br/>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/13.png" alt=" " class="img-responsive" /></a>
											<p>mixed fruit juice (1 ltr)</p>
											<h4>$3.00 <span>$4.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="13" data-name="Mixed fruit juice" data-summary="summary 13" data-price="3.00" data-quantity="1" data-image="images/13.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/50.png" alt=" " class="img-responsive" /></a>
											<p>aamras juice (250 ml)</p>
											<h4>$4.00 <span>$5.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="50" data-name="Paper boat aamras juice" data-summary="summary 50" data-price="4.00" data-quantity="1" data-image="images/50.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/51.png" alt=" " class="img-responsive" /></a>
											<p>coconut water (1000 ml)</p>
											<h4>$6.00 <span>$8.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="51" data-name="Tender coconut water" data-summary="summary 51" data-price="6.00" data-quantity="1" data-image="images/51.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/52.png" alt=" " class="img-responsive" /></a>
											<p>ceres orange juice (1 ltr)</p>
											<h4>$6.00 <span>$8.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="52" data-name="Ceres orange juice" data-summary="summary 52" data-price="6.00" data-quantity="1" data-image="images/52.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<br/>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/53.png" alt=" " class="img-responsive" /></a>
											<p>dabur glucose D (250 gm)</p>
											<h4>$10.00 <span>$12.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="53" data-name="Dabur glucose D" data-summary="summary 53" data-price="10.00" data-quantity="1" data-image="images/53.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/54.png" alt=" " class="img-responsive" /></a>
											<p>mix lemon flavour (50 gm)</p>
											<h4>$8.00 <span>$10.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="54" data-name="Mix lemon flavour" data-summary="summary 54" data-price="8.00" data-quantity="1" data-image="images/54.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="tag"><img src="images/tag.png" alt=" " class="img-responsive" /></div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/55.png" alt=" " class="img-responsive" /></a>
											<p>schweppes water (250 ltr)</p>
											<h4>$6.00 <span>$7.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="55" data-name="Schweppes tonic water" data-summary="summary 55" data-price="6.00" data-quantity="1" data-image="images/55.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div>
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="single.html"><img src="images/56.png" alt=" " class="img-responsive" /></a>
											<p>red bull energy drink (250 ml)</p>
											<h4>$7.00 <span>$9.00</span></h4>
										</div>
										<div class="snipcart-details">
											<button class="btn btn-danger my-cart-btn hvr-sweep-to-right" data-id="56" data-name="Red bull energy drink" data-summary="summary 56" data-price="7.00" data-quantity="1" data-image="images/56.png">Add to Cart</button>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>-->
		<div class="clearfix"></div>
	</div>

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