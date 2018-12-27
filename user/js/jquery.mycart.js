//最新版本！！！！！！！！！！！！！！！！！！！！！！！！！！
$(document).ready(function () {
  setInterval(function() {
    $("#body").load(location.href+" #body>*","");
  }, 1000);
});
(function ($) {

  "use strict";

  var OptionManager = (function () {
    var objToReturn = {};

    var defaultOptions = {
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      classProductQuantity: 'my-product-quantity',
      classProductRemove: 'my-product-remove',
      classCheckoutCart: 'my-cart-checkout',
      affixCartIcon: true,
      showCheckoutModal: true,
      clickOnAddToCart: function($addTocart) { },
      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) { },
      checkoutCart: function(products, totalPrice, totalQuantity) { },
      getDiscountPrice: function(products, totalPrice, totalQuantity) { return null; }
    };


    var getOptions = function (customOptions) {
      var options = $.extend({}, defaultOptions);
      if (typeof customOptions === 'object') {
        $.extend(options, customOptions);
      }
      return options;
    }

    objToReturn.getOptions = getOptions;
    return objToReturn;
  }());


  var ProductManager = (function(){
    var objToReturn = {};

    /*
    PRIVATE
    */
    localStorage.products = localStorage.products ? localStorage.products : "";
    // localStorage.product = localStorage.product ? localStorage.product : "";
    var getIndexOfProduct = function(id,type){
      var productIndex = -1;
      var products = getAllProducts();
      $.each(products, function(index, value){
        if(value.id == id&&value.type == type){//
          productIndex = index;
          return;
        }
      });
      return productIndex;
    }
    var setAllProducts = function(products){
      localStorage.products = JSON.stringify(products);
      $("#json_data").val(encodeURI(localStorage.products));
      // localStorage.product = JSON.stringify(products);
    }
    var addProduct = function(id,type, name, summary, price, quantity, image) {
      var products = getAllProducts();
      products.push({
        id: id,
        type: type,
        name: name,
        summary: summary,
        price: price,
        quantity: quantity,
        image: image
      });
      setAllProducts(products);
    }

    /*
    PUBLIC
    */
    var getAllProducts = function(){
      try {
        var products = JSON.parse(localStorage.products);
        return products;
      } catch (e) {
        return [];
      }
    }
    var updatePoduct = function(id,type, quantity) {
      var productIndex = getIndexOfProduct(id,type);
      if(productIndex < 0){
        return false;
      }
      var products = getAllProducts();
      products[productIndex].quantity = typeof quantity === "undefined" ? products[productIndex].quantity * 1 + 1 : quantity;
      setAllProducts(products);
      return true;
    }
    var setProduct = function(id,type, name, summary, price, quantity, image) {
      if(typeof id === "undefined"){
        console.error("id required")
        return false;
      }
      if(typeof type === "undefined"){
        console.error("id required")
        return false;
      }
      if(typeof name === "undefined"){
        console.error("name required")
        return false;
      }
      if(typeof image === "undefined"){
        console.error("image required")
        return false;
      }
      if(!$("#session_uid").val()){
        console.error("没有登陆");
        alert("请登陆后再添加到购物车!");
        return false;
      }
      if(!$.isNumeric(price)){
        console.error("price is not a number");
        alert("请选择机型后再添加到购物车！");
        return false;
      }
      if(!$.isNumeric(quantity)) {
        console.error("quantity is not a number");
        return false;
      }
      summary = typeof summary === "undefined" ? "" : summary;

      if(!updatePoduct(id,type)){
        addProduct(id, type,name, summary, price, quantity, image);
      }
    }
    var clearProduct = function(){
      setAllProducts([]);
    }
    var removeProduct = function(id,type){
      var products = getAllProducts();
      products = $.grep(products, function(value, index) {
        return value.id != id||value.type !=type;
      });
      setAllProducts(products);
    }
    var getTotalQuantity = function(){
      var total = 0;
      var products = getAllProducts();
      $.each(products, function(index, value){
        total += value.quantity * 1;
      });
      return total;
    }
    var getTotalPrice = function(){    //total价格
      var products = getAllProducts();
      var total = 0;
      $.each(products, function(index, value){
        total += value.quantity * value.price;
      });
      return total.toFixed(2);   //四舍无入，保留两位小数
    }

    objToReturn.getAllProducts = getAllProducts;
    objToReturn.updatePoduct = updatePoduct;
    objToReturn.setProduct = setProduct;
    objToReturn.clearProduct = clearProduct;
    objToReturn.removeProduct = removeProduct;
    objToReturn.getTotalQuantity = getTotalQuantity;
    objToReturn.getTotalPrice = getTotalPrice;
    return objToReturn;
  }());


  var loadMyCartEvent = function(userOptions){

    var options = OptionManager.getOptions(userOptions);
    var $cartIcon = $("." + options.classCartIcon);
    var $cartBadge = $("." + options.classCartBadge);
    var classProductQuantity = options.classProductQuantity;
    var classProductRemove = options.classProductRemove;
    var classCheckoutCart = options.classCheckoutCart;

    var idCartModal = 'my-cart-modal';
    var idCartTable = 'my-cart-table';
    var idGrandTotal = 'my-cart-grand-total';
    var idEmptyCartMessage = 'my-cart-empty-message';
    var idDiscountPrice = 'my-cart-discount-price';
    var classProductTotal = 'my-product-total';
    var classAffixMyCartIcon = 'my-cart-icon-affix';
 // $(document).ready(function(){
 //    setInterval(loadMyCartEvent, 1000);
 //   });
 $cartBadge.text(ProductManager.getTotalQuantity());

 if(!$("#" + idCartModal).length) {
  $('body').append(
    '<div class="modal fade" id="' + idCartModal + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">' +
    '<div class="modal-dialog" role="document">' +
    '<div class="modal-content">' +
    '<div class="modal-header">' +
    '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
    '<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-shopping-cart"></span>我的购物车</h4>' +
    '</div>' +
    '<div class="modal-body">' +
    '<form action="/php/user/checkCart.php" method="post">'+
    '<input id="json_data" type="hidden" name="json_data" value="'+encodeURI(localStorage.products)+'" />'+
    '<table class="table table-hover table-responsive" id="' + idCartTable + '"></table>' +
    '<hr><div style="text-align:right;"><input type="button" name="clearCart" class="btn btn-default" value="清空购物车" id="clearCart">'+
    '</input>&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-default" value="结算"><div>' + 
    '</form>'+
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>'
    );
}

var drawTable = function(){
  var $cartTable = $("#" + idCartTable);
  $cartTable.empty();

  var products = ProductManager.getAllProducts();
  $.each(products, function(){
    var total = this.quantity * this.price;
        total.toFixed(2);    //四舍五入，保留两位小数
        $cartTable.append(
          '<tr title="' + this.summary + '" data-id="' + this.id + '" data-type="' + this.type + '" data-price="' + this.price + '">' +
          '<td class="text-center" style="width: 30px;"><img width="30px" height="30px" src="' + this.image + '"/></td>' +
          '<td>' + this.name + '('+this.type+')</td>' +
          '<td title="单价">￥' + this.price + '</td>' +
          '<td title="数量"><input type="number" min="1" style="width: 70px;" class="' + classProductQuantity + '" value="' + this.quantity + '"/></td>' +
          '<td title="总价" class="' + classProductTotal + '">￥' + total + '</td>' +
          '<td title="移出购物车" class="text-center" style="width: 30px;"><a href="javascript:void(0);" class="btn btn-xs btn-danger ' + classProductRemove + '">X</a></td>' +
          '</tr>'
          );
      });

  $cartTable.append(products.length ?
    '<tr>' +
    '<td></td>' +
    '<td><strong>总金额</strong></td>' +
    '<td></td>' +
    '<td></td>' +
    '<td><strong id="' + idGrandTotal + '">￥</strong></td>' +
    '<td></td>' +
    '</tr>'
    : '<div class="alert alert-danger" role="alert" id="' + idEmptyCartMessage + '">您的购物车为空。</div>'
    );

      showGrandTotal();
    }
    var showModal = function(){
      drawTable();
      $("#" + idCartModal).modal('show');
    }
    var updateCart = function(){
      $.each($("." + classProductQuantity), function(){
        var id = $(this).closest("tr").data("id");
        var type = $(this).closest("tr").data("type");
        ProductManager.updatePoduct(id,type, $(this).val());
      });
    }
    var showGrandTotal = function(){
      $("#" + idGrandTotal).text("￥" + ProductManager.getTotalPrice());
    }

    /*
    EVENT
    */
    if(options.affixCartIcon) {
      typeof $cartIcon.offset() != "undefined" ? true : false;
      if($cartIcon.offset()){
        var cartIconBottom = $cartIcon.offset().top * 1 + $cartIcon.css("height").match(/\d+/) * 1;
        var cartIconPosition = $cartIcon.css('position');
        $(window).scroll(function () {
          if ($(window).scrollTop() >= cartIconBottom) {
            $cartIcon.css('position', 'fixed').css('z-index', '999').addClass(classAffixMyCartIcon);
          } else {
            $cartIcon.css('position', cartIconPosition).css('background-color', 'inherit').removeClass(classAffixMyCartIcon);
          }
        });
      }
    }
    $(function(){ 
      $("#clearCart").bind("click",function(){ 
        localStorage.products="";
        window.location.href="index.php";
      }); 
    }); 

    $cartIcon.click(function(){
      options.showCheckoutModal ? showModal() : options.clickOnCartIcon($cartIcon, ProductManager.getAllProducts(), ProductManager.getTotalPrice(), ProductManager.getTotalQuantity());
    });

    $(document).on("input", "." + classProductQuantity, function () {
      var price = $(this).closest("tr").data("price");
      var id = $(this).closest("tr").data("id");
      var type = $(this).closest("tr").data("type");
      var quantity = $(this).val();

      $(this).parent("td").next("." + classProductTotal).text("￥" + (price * quantity).toFixed(2));
      ProductManager.updatePoduct(id,type, quantity);

      $cartBadge.text(ProductManager.getTotalQuantity());
      showGrandTotal();
      // showDiscountPrice();
    });

    $(document).on('keypress', "." + classProductQuantity, function(evt){
      if(evt.keyCode == 38 || evt.keyCode == 40){
        return ;
      }
      evt.preventDefault();
    });

    $(document).on('click', "." + classProductRemove, function(){
      var $tr = $(this).closest("tr");
      var id = $tr.data("id");
      var type = $tr.data("type");
      $tr.hide(500, function(){
        ProductManager.removeProduct(id,type);
        drawTable();
        $cartBadge.text(ProductManager.getTotalQuantity());
      });
    });

    $("." + classCheckoutCart).click(function(){
      var products = ProductManager.getAllProducts();
      if(!products.length) {
        $("#" + idEmptyCartMessage).fadeTo('fast', 0.5).fadeTo('fast', 1.0);
        return ;
      }
      updateCart();
      options.checkoutCart(ProductManager.getAllProducts(), ProductManager.getTotalPrice(), ProductManager.getTotalQuantity());
      ProductManager.clearProduct();
      $cartBadge.text(ProductManager.getTotalQuantity());
      $("#" + idCartModal).modal("hide");
    });

  }


  var MyCart = function (target, userOptions) {
    /*
    PRIVATE
    */
    var $target = $(target);
    var options = OptionManager.getOptions(userOptions);
    var $cartIcon = $("." + options.classCartIcon);
    var $cartBadge = $("." + options.classCartBadge);

    /*
    EVENT
    */
    $target.click(function(){
      options.clickOnAddToCart($target);

      var id = $target.data('id');
      var type = $target.data('type');
      var name = $target.data('name');
      var summary = $target.data('summary');
      var price = $target.data('price');
      var quantity = $target.data('quantity');
      var image = $target.data('image');

      ProductManager.setProduct(id,type, name, summary, price, quantity, image);
      $cartBadge.text(ProductManager.getTotalQuantity());
    });

  }


  $.fn.myCart = function (userOptions) {
    loadMyCartEvent(userOptions);
    return $.each(this, function () {
      new MyCart(this, userOptions);
    });
  }
})(jQuery);

