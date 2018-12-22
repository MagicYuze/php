<!DOCTYPE html>
<html>
<head>
<title>Events</title>
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
<?php include "head.php"?>
<div style="float:left; margin-top:50px; margin-left:100px">
	<div>
		<h3 class="modal-title" id="myModalLabel">
		<span class="glyphicon glyphicon-shopping-cart"></span>订单详情
		</h3>
	</div>
	<table>
		<tbody>
			<tr>
				<td class="text-center" style="width: 50px"></td>
				<td title="name" width="200px">商品名称</td>
				<td title="num" width="200px">数量</td>
				<td title="price" width="200px">单价</td>
			</tr>
			<?php
				$title=' ';
				if(isset($_GET["type"])){  //确认收货
					$oid=$_GET["oid"];
					$updateSQL="update orders SET state=2 where oid='".$oid."'";
				}
				if(isset($_GET["oid"])){  //查看时,即只传进订单号时
					$oid=$_GET["oid"];
					$selectSQL="select * from orders where oid='".$oid."'";
					$resultSet=mysql_query($selectSQL);
					while($db=mysql_fetch_array($resultSet)){

						//判断是否出现确认收货按钮(已完成的订单没有)
						if($db["state"]!=2){
							$title="确认收货";
						}

						//把数据库中url编码的转成json编码的数据,然后进行解码
						$json_url = $db['goodslist'];
						$goodslist = URLdecode($json_url);
						$json_data = json_decode($goodslist);
						$item_num = count($json_data);
						$order = array();

						foreach((array)$json_data as $item){						  
							$goods = array(	
							      'gid' => $item->gid,
							      'gnum' => $item->gnum
						    );
							//往二维数组追加元素
							array_push($order,$goods);
						}

						$price;
						foreach ($order as $key => $value) {   //从二维数组中取数据(特定的结构:gid,gnum顺序)
    						foreach ($value as $k => $v) { 							
        						if($k=="gid"){  //商品的id
        							$sqls="select * from goods where gid='".$v."'";
        							$result=mysql_query($sqls);
        							while($row=mysql_fetch_array($result)){
        								echo "<tr>";
        								echo "<td class=\"text-center\" style=\"width: 50px\">";
        								echo "<img width=\"50px\" height=\"50px\" src='".$row['picture']."'></td>";
        								echo "<td title=\"name\" width=\"200px\">".$row["gname"]."</td>";
        								$price=$row["price"];
        							}
        						}else if($k=="gnum"){  //订单中的商品数量
        							echo "<td title=\"num\" width=\"200px\">".$v."</td>";
        							echo "<td title=\"price\" width=\"200px\">".$price."</td>";
        							echo "</tr>";
        						}
    						}

						}

						echo "<tr>
							<td class=\"text-center\" style=\"width: 50px\"></td>
							<td title=\"name\">总价</td>
							<td title=\"price\"></td>
							<td title=\"total\">¥".$db["money"]."</td>
						</tr>";
					}
				}
				
			?>
			<!--<tr>
				<td class="text-center" style="width: 50px">
					<img width="50px" height="50px" src="images/2.png"></td>
				<td title="name" width="200px">百事可乐</td>
				<td title="num" width="200px">4</td>
				<td title="price" width="200px">¥5.00</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 50px">
					<img width="50px" height="50px" src="images/2.png"></td>
				<td title="name">百事可乐</td>
				<td title="num">4</td>
				<td title="price">¥5.00</td>
			</tr>
			<tr>
				<td class="text-center" style="width: 50px"></td>
				<td title="name">总价</td>
				<td title="price"></td>
				<td title="total">¥40.00</td>
			</tr>-->
		</tbody>
	</table>
	
	<div class="modal-footer">
		<?php
			if($title!=' ')
				echo "<a href=/php/user/orderform.php?type=ok&oid=".$_GET["oid"]."'><button type=\"button\" class=\"btn btn-default\">".$title."</button></a>&nbsp";
		?>
		<a href="events.php"><button type="button" class="btn btn-default">返回</button></a>
	</div>
</div>

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
</body>
</html>