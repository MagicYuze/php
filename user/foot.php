<div class="wthree_footer_copy">
  <p>Copyright &copy; 2018.Company name All rights reserved.
  </div>

  <!--start cart js-->
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
  <!--end cart js-->