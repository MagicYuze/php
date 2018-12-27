<?php
$gid = "";
$type = "";
$cInfo = ""; 
$cImage = ""; 

$con = mysql_connect("118.89.24.240","php","123456");//连接数据库
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("phpfinal",$con);//选择数据库



if(isset($_POST['cInfo'])&&$_POST['cInfo']!=NULL){
	if(isset($_FILES['cImage'])){
		$file = $_FILES['cImage'];
		$error = $file['error'];
		switch ($error) {
			case 0:
				$fileName = $file['name'];
				$fileType = $file['type'];
				$fileSize = $file['size'];
				$fileTmp_name = $file['tmp_name'];
				$cImage = "/php/admin/img/goods/".$fileName; 
				break;
			default:
				if(!empty($_POST['cImage']))
					$cImage = $_POST['cImage'];
				else
					$cImage = "/php/admin/img/goods/default.jpg";
		}
		if(isset($_GET["goodsid"])){
			if(isset($_GET["goodstype"])){
				$gid=$_GET["goodsid"];
				$type=$_GET["goodstype"];
			}
		}

		$res = mysql_query('select * from comment order by ccid DESC');
		$ccid = mysql_fetch_assoc($res)['ccid']+1;
		$ctime = date("Y/m/d");
		$sql = 'INSERT INTO  comment (ccid,gid,type,ctime,uid,cInfo,cImage) VALUES ("'.$ccid.'","'.$gid.'","'.$type.'","'.$ctime.'","'.$cInfo.'","'.$cInfo.'","'.$cImage.'");';
		$res = mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<script>alert("评论成功！");window.location="orderform.php?&oid=".$_GET["oid"]."</script>';
		}else{
			echo '<script>alert("评论失败……");</script>';// echo $sql;
		}
	} 
}


?>

<!DOCTYPE html>
<html>
<head>
<title></title>
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

<style>
	textarea{
		width:800px;
		height:200px;
		resize:none;
		border-radius:2px;
		border:2px solid green;
	}
</style>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
<?php include "head.php"?>

<!-- 页面如下 -->
<div style="float:left; margin-top:50px; margin-left:100px">
<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data"/>
		<fieldset>
	<div><textarea placeholder="请输入评论" id="cInfo" name="cInfo" value="<?php echo $cInfo;?>"></textarea></div>
	<div><input type="file" name="cImage" size="25" maxlength="100" accept=".jpg,.gif,.jpeg,.png" value="<?php echo $cImage; ?>"/><div>
	<div style="float:right">
		<button type="submit">提交</button>
		<?php echo "<a href='orderform.php?oid=".$_GET["oid"]."'><button>返回</button></a>";?>
	</div>
</fieldset>
</form>
</div>

<div class="clearfix"></div>

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
 <script src="js/jquery.uploadify-3.1.min.js"></script>
</body>
</html>