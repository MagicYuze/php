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

<style>
	#addaddress,#choseaddress{
		border: 2px solid #C7C0C0;
		cursor: pointer;
	}
	#addaddress{
		width: 75px;
	}
	#choseaddress{
		width: 100px;
	}
	#addaddress:hover,#choseaddress:hover{
  		border: 2px solid #E21535;
  	}

</style>
</head>
	
<body>
<!-- header -->
<?php include "head.php"?>
<div style="float:left; margin-top:50px; margin-left:100px">
	<div>
		<h3 class="modal-title" id="myModalLabel">
		<span class="glyphicon glyphicon-shopping-cart"></span>确认购买商品信息
		</h3>
	</div>
	<form action='/php/user/handleCartData.php' method="post">
	<table>
		<tbody>
			<tr>
				<td class="text-center" style="width: 50px"></td>
				<td title="name" width="170px" height="50px">商品名称</td>
				<td title="type" width="170px">机身种类</td>
				<td title="num" width="170px">数量</td>
				<td title="price" width="170px">单价</td>
			</tr>

			<?php

				$json_url=$_POST["json_data"];

				$use_url=$json_url;    //把未解码的URL传递过去

				$goodslist = URLdecode($json_url);
				$json_data = json_decode($goodslist);
				$cart = array();

				$totalprice=0;

				foreach((array)$json_data as $item){						  
						$goods = array(
							'gid' =>$item->id,
							'gname' =>$item->name,
							'price' =>$item->price,
							'gnum' =>$item->quantity,
							'type' =>$item->type,
							'image' =>$item->image
						);
						$totalprice+=$item->price;
						array_push($cart,$goods);
				}

				foreach ($cart as $key => $value) { //从二维数组中取数据	
						echo "<tr>";
						echo "<td class=\"text-center\" style=\"width: 50px\">";
        				echo "<img width=\"50px\" height=\"50px\" src='".$value['image']."'></td>";
        				echo "<td title=\"name\" width=\"170px\" height=\"88px\">".$value['gname']."</td>";
        				echo "<td title=\"type\" width=\"170px\" height=\"88px\">".$value["type"]."</td>"; 
        				echo "<td title=\"num\" width=\"170px\">".$value["gnum"]."</td>";
        				echo "<td title=\"num\" width=\"170px\">".$value["price"]."</td>";
        		}
        		echo "</tr>";
        		echo "<tr>
						<td class=\"text-center\" style=\"width: 50px\"  height=\"88px\"></td>
						<td title=\"name\">总价</td>
						<td title=\"total\">¥".$totalprice."</td>
						<td title=\"price\"></td>
					</tr>";

				echo "<tr>
						<td class=\"text-center\" style=\"width: 50px\"  height=\"88px\"></td>
						<td title=\"name\">收货地址</td>
						<td title=\"address\"><select id='nowaddress' name='raddress'><option value=''>请选择</option>";

                //用下拉框把用户的已添加的收货地址显示
				$uid=$_SESSION["user"];
				$selectSQL="select * from address where uid='".$uid."'";
				$resultSet=mysql_query($selectSQL);
				while($db=mysql_fetch_array($resultSet)){
					echo "<option value='".$db["aid"]."'>".$db["address"]."</option>";
				}

				echo "</select></td>";
				echo "<td><span id='addaddress' onclick=\"document.getElementById('nowaddress').style.display='none';document.getElementById('choseaddress').style.display='none';
				document.getElementById('add').style.display='block';document.getElementById('choseaddress').style.display='block';this.style.display='none';\">新增地址</span>

				<span id='choseaddress' style='display: none' onclick=\"document.getElementById('nowaddress').style.display='block';document.getElementById('add').style.display='none';this.style.display='none';document.getElementById('addaddress').style.display='block';\">返回选择地址</span></td>";
				echo "<td>
				<input id='add' type='text' name='newaddress' style='display: none' placeholder='添加新地址' /></td>";
				echo "<td></td>";
				echo "</tr>";

		    ?>
		    </tbody>
	</table>

	<div class="modal-footer">
	   <input type="hidden" name="totalprice" value="<?php echo $totalprice; ?>" />
	   <input type="hidden" name="goods" value="<?php echo $use_url; ?>" />
	   <input type="submit" name="submit" value="确定付款" class="btn btn-default" />
	</div>
	</form>
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