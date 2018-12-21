<!DOCTYPE html>
<html>
<head>
<title>Single</title>
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
 		  margin: 20em 0 0;
 	}
</style>
<!-- start-smoth-scrolling -->

</head>
	
<body>
<!-- header -->
	<?php include "head.php" ?>
		<div class="w3l_banner_nav_right" style="height: 600px">
			<div class="w3l_banner_nav_right_banner3">
				<h3>Best Deals For New Products<span class="blink_me"></span></h3>
			</div>
				<?php
					$gid=$_GET['gid'];
					$selectSQL="select * from goods where gid='".$gid."'";
					$resultSet=mysql_query($selectSQL);
					while($db=mysql_fetch_array($resultSet)){
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
						<div class=\"snipcart-thumb agileinfo_single_right_snipcart\">
							<h4>$".$db["price"]."</h4>
						</div>
						<div class=\"snipcart-details agileinfo_single_right_details\">
							<button class=\"btn btn-danger my-cart-btn hvr-sweep-to-right\" data-id='".$db["gid"]."' data-name='".$db["gname"]."' data-summary='summary ".$db["gid"]."'  data-price='".$db["price"]."' data-quantity='1' data-image='".$db["picture"]."'>加入购物车</button>
						</div>
					</div>
				</div>
				<div class=\"clearfix\"> </div>
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>";						
					}
					
				?>									
		</div>
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