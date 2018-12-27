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
 <script src='js/okzoom.js'></script>
  <script>
    $(function(){
      $('#example').okzoom({
        width: 150,
        height: 150,
        border: "1px solid black",
        shadow: "0 0 5px #000"
      });
    });
  </script>

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
<style>
 	.wthree_footer_copy {
 		  margin: 90em 0 0;
 	}
 	.type{
  		border: 2px solid #C7C0C0;
  		cursor: pointer;
  	}
  	.type:hover{
  		border: 2px solid #E21535;
  	}
  	table{border-collapse: collapse;}
	tr{border-bottom: 1px solid gray;}
	td{padding:20px}
</style>
<!-- start-smoth-scrolling -->

</head>
	
<body>
<!-- header -->
	<?php include "head.php" ?>
	<?php include "functions/page.php" ?>
	<?php 
	//获取session['user'];
	if (!session_id()) session_start();
	$uid = NULL;
	if(isset($_SESSION['user'])){
		$uid = $_SESSION['user'];
	}
	?>
		<div class="w3l_banner_nav_right" style="height: 600px">
			<div class="w3l_banner_nav_right_banner3">
				<h3>Best Deals For New Products<span class="blink_me"></span></h3>
			</div>
				<?php
					$gid=$_GET['gid'];
					$selectSQL="select * from goods where gid='".$gid."'";
					$resultSet=mysql_query($selectSQL);

					while($db=mysql_fetch_array($resultSet)){

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

						echo "<div class=\"agileinfo_single\">
				<h5>".$db["gname"]."</h5>
				<div class=\"col-md-4 agileinfo_single_left\">
					<img id=\"example\" src='".$db["picture"]."' style='width:212px; height:212px'alt=' 'class=\"img-responsive\" />
				</div>
				<div class=\"col-md-8 agileinfo_single_right\">
					<br/>
					<div class=\"w3agile_description\">
						<h4>商品描述:</h4>
						<p>".$db["introduction"]."</p>
					</div>
					<div class=\"snipcart-item block\">
						<div class=\"snipcart-thumb agileinfo_single_right_snipcart\"><div style=>选择型号:&nbsp;";

						foreach ($type as $key => $value) {   //循环读
							if($value["state"]>0 && $value["gcount"]>0){
								echo "<span class='type' href='javascript:void(0)' onclick=\"document.getElementById('gcount').innerHTML='库存数量:'+'".$value["gcount"]."';document.getElementById('price').innerHTML='单价:￥'+'".$value["price"]."';var list=document.getElementsByClassName('type');for (var i = 0; i < list.length; i++) {list[i].style.border='2px solid #C7C0C0';}this.style.border='2px solid #E21535';  document.getElementById('addtocart').setAttribute('data-type','".$value["type"]."');document.getElementById('addtocart').setAttribute('data-price','".$value["price"]."');"."\">".$value["type"]."</span>&nbsp;";
							}

						}

						echo "</div><br>";
						echo "<div id='gcount'>库存数量:</div><br>";
						echo "<div id='price'>单价:￥</div><br>";
						echo '<input type="hidden" name="session_uid" id="session_uid" value="'.$uid.'">';
						echo "<div class=\"snipcart-details agileinfo_single_right_details\">
							<button onclick=\"window.location.reload();\"  id='addtocart' class=\"btn btn-danger my-cart-btn hvr-sweep-to-right\" data-id='".$db["gid"]."' data-name='".$db["gname"]."' data-summary='".$db["introduction"]."'  data-quantity='1' data-image='".$db["picture"]."' data-type='' data-price=''>加入购物车</button>
						</div>
					</div>
				</div>
				<div class=\"clearfix\"> </div>
			</div>
		</div>";					
					}
				?>	
				<div class="clearfix"></div><br/><br/>
				<div>    <!--这里循环评论-->
					<h3>买家评论:</h3>
					<?php 
						$gid=$_GET['gid'];
						
						$page_size=$_GET["page_size"];  //几个为一页
						$page_current=$_GET["page_current"];  //当前页数
						$selectComment='';									
						if(isset($gid)){ //评论的sql语句				
							$selectComment="select * from comment where gid='".$_GET["gid"]."'";   
						}
						$resultSet=mysql_query($selectComment);
						$total_records=0;
						$db=mysql_fetch_array($resultSet);
						$total_records+=mysql_num_rows($resultSet);  //总记录条数(去掉所有种类库存为0的)
					
						$start_records=($page_current-1)*$page_size;  //limit开始的条数
						$end_records=$page_size;  //limit的条数

						$selectComment="select * from comment where gid='".$gid."'limit ".$start_records.",".$end_records;
						$resultSet=mysql_query($selectComment);  //根据数据库取对应条数的

						while($db=mysql_fetch_array($resultSet)){

							echo "<div>
									<table>
										<tbody>
											<tr>
												<td width=\"700px\">
													<div>".$db["cInfo"]."</div>
													<div>
													<img id=\"example\" src='".$db["cImage"]."' style='width:50px; height:50px'/>
													</div>
													<div>".$db["ctime"]."</div>
												</td>
												<td width=\"100px\">
													<div>".$db["type"]."</div>
												</td>
												<td width=\"100px\">
													<div>";
													$selectSQL1="select * from user where uid='".$db["uid"]."'";
													$resultSet1=mysql_query($selectSQL1);
													while($db1=mysql_fetch_array($resultSet1)){
														echo "$db1[uname]";
													}
												echo "</div>
												</td>
											</tr>
										</tbody>
									</table>
									</div>	";		
						}
						$url;
						if(isset($gid)){ //商品的url	
							$url="/php/user/single.php?&page_size=".$page_size."&gid=".$gid;
						}else if(isset($cname)){
							$url="/php/user/single.php?&page_size=".$page_size."&cname=".$cname;
						}
						echo "<div style='margin-top:20px; margin-left:780px;'>";
						page($total_records,$page_size,$page_current,$url,null);
						echo "</div>";
						close_connection();


					 ?>
				</div>
			</div>								
		</div>
<!-- //banner -->
<script type='text/javascript' src="js/jquery.mycart.js"></script>
 <script type="text/javascript">
    $(function () {

      var goToCartIcon = function($addTocartBtn){
        var $cartIcon = $(".my-cart-icon");
        var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
        $addTocartBtn.prepend($image);
        var position = $cartIcon.position();
        $image.animate({
         
        }, 500 , "linear", function() {
          $image.remove();
        });
      }

      $('.my-cart-btn').myCart({
        classCartIcon: 'my-cart-icon',
        classCartBadge: 'my-cart-badge',
        affixCartIcon: true,
        checkoutCart: function(products) {
          $.each(products, function(){
            console.log(this);
          });
        },
        clickOnAddToCart: function($addTocart){
          goToCartIcon($addTocart);
        },
        getDiscountPrice: function(products) {
          var total = 0;
          $.each(products, function(){
            total += this.quantity * this.price;
          });
          return total * 1;
        }
      });

    });
  </script>
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