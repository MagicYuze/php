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
				}else if(isset($_GET['gname'])){   //(GET的方式,搜索页面的分页要用到)
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
						$selectGood="select * from goods where cid='".$cid."'";   
					}
					else if(isset($gname)){   //这是搜索的sql语句(不同于上面:不需要再取cname了)
						$selectGood="select * from goods where gname LIKE '%".$gname."%'";
					}

					$resultSet=mysql_query($selectGood);


					$notIngid="(";
					$total_records=0;
					while($db=mysql_fetch_array($resultSet)){  //取得各种种类的数量和

						//把数据库中url编码的转成json编码的数据,然后进行解码
						$json_url = $db['type'];
						$typelist = URLdecode($json_url);
						$json_data = json_decode($typelist);
						//$item_num = count($json_data);
						//$type = array();
						$totalgcount=0;
						$totalstate=0;   

						foreach((array)$json_data as $item){						  
							/*$types = array(	
							      'type' => $item->type,
							      'price' => $item->price,
							      'gcount' => $item->gcount,
							      'state' => $item->state
						    );*/
						    $totalstate+=$item->state;
							$totalgcount+=$item->gcount;
							//往二维数组追加元素
							//array_push($type,$types);
						}

						if($totalgcount==0 || $totalstate==0){
							$total_records-=1;   //如果该商品所有种类库存为0或者都不展示时，总记录数-1
							$notIngid.=$db["gid"].",";
						}	
					}

					if(substr($notIngid,-1)==',') $notIngid=substr($notIngid, 0, -1); //去掉最后一个,
					$notIngid.=")";


					//为了配合数据库的limit，即分页功能
					$total_records+=mysql_num_rows($resultSet);  //总记录条数(去掉所有种类库存为0的)
					
					$start_records=($page_current-1)*$page_size;  //limit开始的条数
					$end_records=$page_size;  //limit的条数

					if(isset($cid)){ //分类的sql语句
						if($notIngid!="()")	 $selectGood="select * from goods where cid='".$cid."' and gid not in".$notIngid." limit ".$start_records.",".$end_records;
						else $selectGood="select * from goods where cid='".$cid."'limit ".$start_records.",".$end_records;
					}
					else if(isset($gname)){   //这是搜索的sql语句
						if($notIngid!="()")  $selectGood="select * from goods where gname LIKE '%".$gname."%' and gid not in".$notIngid." limit ".$start_records.",".$end_records;
						else $selectGood="select * from goods where gname LIKE '%".$gname."%' limit ".$start_records.",".$end_records;
					}

					$resultSet=mysql_query($selectGood);  //根据数据库取对应条数的

					while($db=mysql_fetch_array($resultSet)){  	//一个个展示

						$json_url = $db['type'];
						$typelist = URLdecode($json_url);
						$json_data = json_decode($typelist);
						$type = array();

						foreach((array)$json_data as $item){						  
							$types = array(	
							      'type' => $item->type,
							      'price' => $item->price,
							      'gcount' => $item->gcount,
							      'state' => $item->state
						    );
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
										."<a href='/php/user/single.php?page_current=1&page_size=4&gid=".$db["gid"]."'><img src='".$db["picture"]."' style='height:140px;width:140px;' alt=' ' class='img-responsive'></a>"
										."<p>".$db["gname"]."</p>"
										."<h4>￥".$minprice."-".$maxprice."</h4></div>"
										."</div>
									</div>
								</figure>
							</div>
						</div>
						</div>";
					}
					echo "</div>";

					$url;
					if(isset($cid)){ //分类的url	
				  		$url="/php/user/products.php?&page_size=".$page_size."&cid=".$cid;
				  	}else if(isset($gname)){
				  		$url="/php/user/products.php?&page_size=".$page_size."&gname=".$gname;
				  	}
				  echo "<div style='margin-top:320px; margin-left:780px;'>";
				  page($total_records,$page_size,$page_current,$url,null);
				  echo "</div>";
				  close_connection();
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