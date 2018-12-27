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
  <!-- header -->
  <?php include "head.php"?>
  <div class="w3l_banner_nav_right">
  <div class="events">
  <h3>订单</h3>
  <?php
          if(isset($_SESSION["user"])){    //已经登录的情况
           $uid=$_SESSION["user"];
           $title='';
           $selectSQL="select o.aid,oid,odate,address,money,state from orders as o,address as a where o.uid='".$uid."' and o.aid=a.aid";
           $resultSet=mysql_query($selectSQL);
           while($db=mysql_fetch_array($resultSet)){
            if($db["state"]==0) $title="待发货";
            else if($db["state"]==1) $title="待收货";
            else if($db["state"]==2) $title="已完成";
            echo "<div class=\"w3agile_event_grids\">
            <div class=\"col-md-6 w3agile_event_grid\">
            <div class=\"col-md-3 w3agile_event_grid_left\"><i class=\"fa\">".$title."</i></div>
            <div class=\"col-md-9 w3agile_event_grid_right\"><p><a href='orderform.php?oid=".$db["oid"]."'><h4>订单号：".$db["oid"]."</h4></a></p>
            <p><h4>订单时间：".$db["odate"]."</h4></p>
            <p><h4>收货地址：".$db["address"]."</h4></p>
            <h4>订单总金额：".$db["money"]."</h4>
            </div>
            <div class=\"clearfix\"> </div>
            </div>
            </div>
            <div class=\"clearfix\"> </div><br/>";
            ;
          }
          close_connection();      
        }
        ?>
      </div>
    </div>

<!--<div class="w3l_banner_nav_right">
  <div class="events">
      <h3>订单</h3>

      <div class="w3agile_event_grids">
        <div class="col-md-6 w3agile_event_grid">
          <div class="col-md-3 w3agile_event_grid_left">
            <i class="fa">待收货</i>
          </div>
          <div class="col-md-9 w3agile_event_grid_right">
          <p><a href="orderform.php"><h4>订单号：1234567894512156484121</h4></a></p>
            <p><h4>订单时间：2018/12/21</h4></p>
            <h4>订单总金额：¥189</h4>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="clearfix"> </div>
  </div>
</div>-->

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