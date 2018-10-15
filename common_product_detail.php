
<?php if($product_details['nr']){ ?>
<section id="in-header">
<div class="container">
<div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL;?>">Home</a></li>
          <li><a href="listing">Products</a></li>
          <li class="active"><span class="hidden-text" style=""><?php echo $product_details['p_name']; ?></span></li>
        </ol>
</div>
</div>
</section>


<section id="product-detail">
<div class="container">
<div class="col-md-6">

	  <div class="product-detail-left">
        <ul id="product-gallery" class="gc-start">
         <li><img  src="uploads/product/<?php echo $conn->stripval($product_details['p_image']); ?>" alt="" class="img-responsive"/></li>
         
          <?php foreach($product_image['result'] as $res) { ?>
              <li><img  src="uploads/product/<?php echo $conn->stripval($res['product_image']); ?>" alt="" class="img-responsive"/></li>
          <?php } ?>
          </ul>
  	  </div>
</div>
<div class="col-md-6 col-xs-12">
 <div class="product-detail-right">
 <h1><?php echo $product_details['p_name']; ?></h1>
 <div id="product">
 <div ng-app="myapp">
  <div ng-controller="TestController as vm">
    
 <div class="rental-plan">
 <p>Choose rental period (Months)</p>
 <div class="row">
	 <div class="col-md-8 col-xs-12">
  <div class="range-slide">
 
      <!--<rzslider rz-slider-model="vm.priceSlider.value" rz-slider-options="vm.priceSlider.options"></rzslider>-->
    <div class="radio">
      <label><input type="radio" name="option" value="1">1</label>
      <label><input type="radio" name="option" value="2">2</label>
      <label><input type="radio" name="option" value="3">3</label>
      <label><input type="radio" name="option" value="12">>3</label>
    </div>
    
</div>
	 </div>
	
	 </div>
 </div>
   


   <div class="clearfix"></div>
   
  <div class="total-rent">
 <div class="col-md-4 col-xs-12">
 <p> Rent per month </p>
  </div>
   <div class="col-md-8 col-xs-12">
<p><span>  ₹  <?php echo round(($product_details['ps_price_month'] + $tax_amount), 2); ?></span>  </p> 

<div class="tax-info">
<a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>(Inclusive Tax)</a>

<div>

<ul class="rent-in-text">
<li>
  Rent Per Month  
</li>
<li>
   : <span><?php echo 'Rs '.round($product_details['ps_price_month'], 2); ?></span>
  </li>
  <li>
 Applicable taxes (<?php echo $product_details['tax_percentage'].' %'; ?>) 
</li>
<li>
   :  <span><?php $tax_amount = ($product_details['ps_price_month']) * ($product_details['tax_percentage']/100); echo 'Rs '.round($tax_amount, 2); ?></span>
  </li>
</ul>

</div>

</div>




   
  </div>
 
  <div class="clearfix"></div>
    </div>
</div>
  <div class="refund-box">
  
  <div class="refund">
  <p> Security Deposit  :  <span><?php echo 'Rs '.round($product_details['pp_security_deposit'], 2); ?></span> 
  <a href="#" data-toggle="tooltip" title="Some-Text!"><i class="fa fa-info-circle" aria-hidden="true"></i> ( Refundable deposit ) </a><p>
  
   <p> Handling Charge :  <span><?php echo 'Rs '.round($product_details['pp_handling_charge'], 2); ?></span> 
  <a href="#" data-toggle="tooltip" title="Some-Text!"><i class="fa fa-info-circle" aria-hidden="true"></i> (Processing Charge ) </a><p>
  
  </div>
  
  
  </div>
  
  <div class="addcart">
    
      <input type="hidden" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
      <input type="hidden" name="product_id" value="<?php echo $product_details['p_id']; ?>" />
      <button id="button-cart" class="btn btn-danger"> <i class="fa fa-shopping-cart fa-mg" aria-hidden="true"></i> Add to Cart</button>
      <a href="cart.php" class="btn btn-primary"> <i class="fa fa-credit-card-alt fa-mg" aria-hidden="true"></i> Rent Now</a>
  </div>

  </div>
  
 </div>
</div>
</div>
</section>


<section id="specification">
<div class="spec-title">
<div class="container-fluid">
<h3>Description</h3>
</div>
</div>

<div class="container-fluid">
<p class="p-text"><?php echo 'Rs '.$conn->stripval($product_details['p_desc']); ?>
</p>
   
<h3 class="rented-title"> SPECIFICATIONS</h3>
<div class="col-md-4 col-xs-12">
<div class="table-responsive table-box">
<table class="table table-bordered">
<tbody class="text-center">
<?php foreach($product_spec['result'] as $res) { ?>
<tr>
<td><?php echo $conn->stripval(ucfirst($res['ps_name'])); ?> 	</td>
<td><?php echo $conn->stripval(ucfirst($res['ps_detail'])); ?> </td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>



<div class="clearfix"></div>
    </div>
</section>

<?php } else { ?>
<section id="product-detail">
<div class="container-fluid">
 <p>No Product Available</p>
 </div>
</section>
<?php } ?>

<section id="product-llisting">
<div class="container-fluid">
<h3 class="rented-title"> People Also Rented</h3>

<div class="people-rented">
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="product-detail.php"><img src="images/list1.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="product-detail.php"><p class="prd-name">Washing Machine<span>- 7ltr</span></p></a>
<p class="prd-price">₹ 1500<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list2.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Washing Machine<span>- 4ltr</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list3.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">LED TV<span>- 15 Inch</span></p></a>
<p class="prd-price">₹ 500<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list4.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Tread Mill<span>- Medium</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->

<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list5.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Split AC<span>- 1Ton</span></p></a>
<p class="prd-price">₹ 1000<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list6.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Led Tv<span>- 21 inch</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list7.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Royal Chair<span>- Designer Furniture</span></p></a>
<p class="prd-price">₹ 500<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list8.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Sofa Set<span>- Designer Furniture</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->

<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="product-detail.php"><img src="images/list1.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="product-detail.php"><p class="prd-name">Washing Machine<span>- 7ltr</span></p></a>
<p class="prd-price">₹ 1500<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list2.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Washing Machine<span>- 4ltr</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list3.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">LED TV<span>- 15 Inch</span></p></a>
<p class="prd-price">₹ 500<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list4.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Tread Mill<span>- Medium</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->

<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list5.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Split AC<span>- 1Ton</span></p></a>
<p class="prd-price">₹ 1000<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list6.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Led Tv<span>- 21 inch</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list7.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Royal Chair<span>- Designer Furniture</span></p></a>
<p class="prd-price">₹ 500<span> Rent/Month</span></p>
</div>
</div><!--col-->
<div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
<div class="col-box">
<div class="hovereffect">
      <a href="#"><img src="images/list8.png" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay">
                <a href="#" class="prd-cart-button prd-button">Add To Cart</a>
                 <a href="#" class="rent-now-button prd-button">Rent Now</a>
            </div>
    </div>

<a href="#"><p class="prd-name">Sofa Set<span>- Designer Furniture</span></p></a>
<p class="prd-price">₹ 1200<span> Rent/Month</span></p>
</div>
</div><!--col-->
</div>
</div>
</section>

<?php //include"footer.php" ?>

<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
  $.ajax({
    url: 'ajax_submit.php?func=cart_add',
    type: 'post',
    data: $('#product input[type=\'hidden\'], #product input[type=\'radio\']:checked'),
    dataType: 'json',
    beforeSend: function() {
      $('#button-cart').button('loading');
    },
    complete: function() {
      $('#button-cart').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      
      if (json['error']) {        
               // Highlight any found errors
        $('.container').before(json['error']);
      }

      if (json['error_option']) {        
               // Highlight any found errors
        $('.range-slide').after('<div class="text-danger">' + json['error_option'] + '</div>');
      }

      if (json['success']) {
        $('.breadcrumb').after('<div class="alert alert-success container-fluid">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        
        $('html, body').animate({ scrollTop: 0 }, 'slow');

        $('.mini-cart').load('cart_response.php .cart-info');
        if (json['cart_number']) {              
            $('.cart-number').html(json['cart_number']);
        }
      }
    },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
  });
});
//--></script>

 <?php /* </body>
</html> */?>