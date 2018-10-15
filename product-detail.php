<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$proslug= $conn->variable($_REQUEST['pro_slug']);
$mcatslug= $conn->variable($_REQUEST['mcat_slug']);
$locslug= $conn->variable($_REQUEST['loc_slug']);
 
if($locslug!='')
{
	$cookloct = $conn->select_query(LOCATION,"*","lo_name='".$locslug."' AND lo_status = 'Y'",1);
	$cookie_name = "current_location";
 $cookie_value = $cookloct['lo_id'];
//unset($_COOKIE["current_location"]);
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
/*if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}*/
//echo $_COOKIE["current_location"];
	//exit;
	
}

  //echo "hkhj";exit;
  if(!$proslug)
  {
   // $conn->divert(SITE_URL);
  }
$maincat = $conn->select_query(CATEGORY,"*","cat_slug='".$mcatslug."' AND cat_status = 'Y'", "1");
  $product_detail = $conn->select_query(PRODUCT,"*", "p_slug = '".$proslug."' AND p_category = '".$maincat['cat_id']."'  AND p_status = 'Y'", "1");

if(isset($_COOKIE["current_location"])) {
      //echo $_COOKIE["current_location"];  exit;
      $feat_location = $conn->select_query(LOCATION,"*","lo_id='".$_COOKIE["current_location"]."' AND lo_status = 'Y'", '1');  
    }


  if(!$product_detail['nr'] && !empty($proslug)){
    $conn->divert(SITE_URL);
  }
  $cond="p.p_status='Y' AND pp.pp_location_id='".$feat_location['lo_id']."'";
  $cond .="  AND p.p_category = '".$maincat['cat_id']."' AND p.p_slug = '".$proslug."'";
  $product_details = $conn->select_query(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) LEFT JOIN ".TAX." t ON(t.tax_id=pp.pp_taxes)","*",$cond,"1");




  //if(isset($_COOKIE["current_location"])) {   
   // $cond="p.p_status='Y' AND pp.pp_location_id='".$_COOKIE["current_location"]."'";
    //$cond .=" AND p.p_slug = '".$proslug."'"; 
    
   // $product_details = $conn->select_query(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) LEFT JOIN ".TAX." t ON(t.tax_id=pp.pp_taxes)","*",$cond,"1");
  //} else {
   // $product_details='';
  //}

  $sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

  $selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

  //$product_detail = $conn->select_query(PRODUCT,"*", "p_id = '1' AND p_status = 'Y'", "1");
  if($product_details['nr']){
  //  $product_price = $conn->select_query(PRODUCTPRICE,"*", "pp_product_id = '1' AND pp_location_id = '1'", "1");

    $product_spec = $conn->select_query(PRODUCTSPECIFICATION,"*", "product_id = '".$product_details['p_id']."'");//print_r($product_spec);exit;

    $product_image = $conn->select_query(PRODUCTIMAGE,"*", "product_id = '".$product_details['p_id']."'"); 
$categorys = $conn->select_query(CATEGORY,"*","cat_id='".$product_details['p_category']."' AND cat_status = 'Y'", "1");
$bredcumsubcat = $conn->select_query(CATEGORY,"*","cat_id='".$product_details['p_sub_category']."' AND cat_status = 'Y'", "1");

$subcats = $conn->select_query(CATEGORY,"*","cat_p_id='".$categorys['cat_id']."' AND cat_status = 'Y' order by cat_pos ", "");
	
	
	//print_r($product_image);exit;

  //  $product_tax = $conn->select_query(TAX,"*", "tax_id = '". $product_details['pp_taxes'] ."'", "1"); //print_r($product_tax);exit;

  }



  /*$featrow=mysql_num_rows($feat_loc);*/

  
   $feat_loc = $conn->Execute("SELECT * FROM tbl__product prod RIGHT JOIN tbl__product_price price ON prod.p_id = price.pp_product_id WHERE price.pp_location_id='".$feat_location['lo_id']."' AND price.pp_feature='Y' AND prod.p_status='Y' order by prod.p_id asc");
  $featrow=mysql_num_rows($feat_loc);
  
  //echo $product_details['p_category'];
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo-product.php";?>
<?php  include "inner-header.php"; ?>
<?php include "tracker.php"; ?>
<base href="<?php echo SITE_URL; ?>">
</head>
<body>
<!--<div style="margin-top:7.5em;"></div>-->
<?php include 'menu.php';?>
<?php if($product_details['nr']){ ?>
<?php if($product_details['nr']){ 
  ?>
<section id="inner-header">
  <div class="container-fluid padd-1-none">
<div class="row">
    <div class="">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active"><a href="<?php echo SITE_URL; ?>category/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $categorys['cat_slug']  ?>.html"><?php echo $categorys['cat_title']; ?></li></a>
          <li class="active"><a href="<?php echo SITE_URL; ?>productlist/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $bredcumsubcat['cat_slug']  ?>.html"><?php echo $bredcumsubcat['cat_title']; ?></li></a>
          <li class="active"><?php echo $product_details['p_name']; ?></li>
    </div>
   </div>
     <div class="row">
    <div class="">
   
    	<ul class="product-menu">
         <!--  <li><a href="http://192.168.1.30/payrentz-dev/listing"><img src="images/p5.png" class="prod-img center-block">All Products</a></li> -->
            <?php foreach($subcats['result'] as $res) {
           // echo "<pre>";
           // print_r($res); exit;
            if (!empty($res['cat_logo'])) {

            if (file_exists('uploads/category/'.$res['cat_logo'])) { 
             // $cat_logo = SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/category/'.$res['cat_logo'].'&w=30&h=30&zc=0';
              $cat_logo='categorys/image/'.$res['cat_logo'];  
            } else { 
             // $cat_logo = SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=30&h=30&zc=0';
              $cat_logo='catnoimg/noimage.png';
            }                 
            } else {
             // $cat_logo = SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=30&h=30&zc=0';
              $cat_logo='catnoimg/noimage.png';
            }

           ?>
                    <li class=""><a href="<?php echo SITE_URL; ?>productlist/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $res['cat_slug']  ?>.html"><img src="<?php echo $cat_logo; ?>" class="prod-img center-block"><?php echo $conn->stripval(ucfirst($res['cat_title'])); ?></a></li>
                  
              <?php } ?>     
        </ul>
            
    </div>
    </div>
</div>
</section>
<section id="product-detail" style="margin-top:20px;">
  <div class="container">
  <div class="col-md-6">
    <div class="product-detail-left">
      <ul id="product-gallery" class="gc-start">
        <li><img  src="<?php echo SITE_URL;?>uploads/product/<?php echo $conn->stripval($product_details['p_image']); ?>" alt="" class="img-responsive"/></li>
        <?php foreach($product_image['result'] as $res) { ?>
        <li><img  src="<?php echo SITE_URL;?>uploads/product/<?php echo $conn->stripval($res['product_image']); ?>" alt="" class="img-responsive"/></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="col-md-6 col-xs-12">
    <div class="product-detail-right">
      <h1><?php echo $product_details['p_name']; ?></h1>
      <div id="product">
        <div ng-app="myapp">
          <?php if($product_details['p_category']!='3')
					{
						
					//$tax_amount = ($product_details['pp_price_12_month']) * ($product_details['tax_percentage']/100); 
					$taxper=$product_details['tax_percentage']+100;
					$tax_amount = ($product_details['pp_price_12_month'] / $taxper)*100; 
					
					
						?>
          <div ng-controller="TestController as vm">
            <div class="rental-plan">
              <p>Choose Rental Period (Months)</p>
              <div class="row">
                <div class="col-md-8 col-xs-12">
                  <div class="range-slide"> 
                    
                    <!--<rzslider rz-slider-model="vm.priceSlider.value" rz-slider-options="vm.priceSlider.options"></rzslider>-->
                    <div class="radio">
                      <form method="post">
                        <label>
                          <input type="radio" name="option" class="month_rad" value="1" checked="checked" />
                          1</label>
                        <label>
                          <input type="radio" name="option" class="month_rad" value="2">
                          2</label>
                        <label>
                          <input type="radio" name="option" class="month_rad" value="3">
                          3</label>
                        <label>
                          <input type="radio" name="option" class="month_rad" value="12" checked="checked">
                          >3</label>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="total-rent">
              <div class="col-md-4 col-xs-12">
                <p> Rent Per Month </p>
              </div>
              <div class="col-md-8 col-xs-12">
                <p><span class="permonth"> ₹ <?php echo round(($product_details['pp_price_12_month'] /*+ $tax_amount*/), 2); ?></span> </p>
                <div class="tax-info"> <a href="javascript:void(0);"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                  <div>
                    <ul class="rent-in-text">
                      <li> Rent Per Month </li>
                      <li> : <span class="monthrent"><?php echo '₹ '.round($tax_amount, 2);
					   ?></span> </li>
                      <li> Applicable Taxes </li>
                      <li> : <span class="monthtax">
                        <?php 
						//$tax_amount = ($product_details['pp_price_12_month']) * ($product_details['tax_percentage']/100); 
						echo '₹ '.round(($product_details['pp_price_12_month']- $tax_amount), 2);  ?>
                        </span> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <?php }elseif($product_details['p_category']=='3'){
	  $tax_amount = ($product_details['ps_price_month']) * ($product_details['tax_percentage']/100); 
	  ?>
          <div ng-controller="TestController as vm">
            <div class="rental-plan">
              <p>Choose No.Of Days Of Rent</p>
              <div class="row">
                <div class="col-md-8 col-xs-12">
                  <div class="range-slide"> 
                    
                    <!--<rzslider rz-slider-model="vm.priceSlider.value" rz-slider-options="vm.priceSlider.options"></rzslider>--> 
                    <!--<div class="radio">
        <label><input type="radio" name="option" value="1" checked="checked" />1</label>
        <label><input type="radio" name="option" value="2">2</label>
        <label><input type="radio" name="option" value="3">3</label>
        <label><input type="radio" name="option" value="12">>3</label>
      </div>-->
                    <div class="row">
                      <div class="col-lg-3 col-sm-3 col-xs-3">
                        <div class="form-group">
                          <input type="text" class="form-control" id="rent_days" name="rent_days">
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-3 col-xs-3">
                        <p>Days</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="total-rent">
              <div class="col-md-6 col-xs-12">
                <p> Rent Price Will Be Discussed On Phone</p>
              </div>
              <div class="col-md-6 col-xs-12">
                <p><span>
                  <?php // ₹ echo round(($product_details['ps_price_month'] + $tax_amount), 2); ?>
                  </span> </p>
                <div class="tax-info"> 
                  <!--<a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i>(Inclusive Tax)</a>-->
                  
                  <div>
                    <ul class="rent-in-text">
                      <li> Rent Per Month </li>
                      <li> : <span><?php echo '₹ '.round($product_details['ps_price_month'], 2); ?></span> </li>
                      <li> Applicable taxes (<?php echo $product_details['tax_percentage'].' %'; ?>) </li>
                      <li> : <span>
                        <?php $tax_amount = ($product_details['ps_price_month']) * ($product_details['tax_percentage']/100); echo '₹ '.round($tax_amount, 2); ?>
                        </span> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <?php }?>
          
          <?php /*?><div class="refund-box">
            <div class="refund">
              <?php if($product_details['p_category']!='3'){?>
              <p> Security Deposit  : <span><?php echo '₹ '.round($product_details['pp_security_deposit'], 2); ?></span> <a href="javascript:void(0);" data-toggle="tooltip" title="This Amount is Refundable on Return of the Product"><i class="fa fa-info-circle" aria-hidden="true"></i> ( Refundable deposit ) </a>
              </p>
              
                <?php }?>
              <p> Handling Charge : <span><?php echo '₹ '.round($product_details['pp_handling_charge'], 2); ?></span> <a href="javascript:void(0);" data-toggle="tooltip" title="Non Refundable – To cover Delivery, Pickup, Installation & Service"><i class="fa fa-info-circle" aria-hidden="true"></i> (Processing Charge ) </a>
              </p> 
            </div>
          </div><?php */?>
          <div class="box-popup-1">
            <div class="popover__wrapper">
   <?php if($product_details['p_category']!='3'){?>
    <h2 class="popover__title">Security Deposit  : <span><?php echo '₹ '.round($product_details['pp_security_deposit'], 2); ?></span> <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> </a></h2>
    <?php }?>
  <div class="push popover__content">
    <p class="popover__message">This Amount is <b>Refundable</b> on Return of the Product</p>
    
  </div>
</div>

<div class="popover__wrapper">
  
  <h2 class="popover__title">Handling Charge : <span><?php echo '₹ '.round($product_details['pp_handling_charge'], 2); ?></span> <a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> </a></h2>
 
  <div class="push popover__content">
    <p class="popover__message"> <b>Non Refundable</b>  – To cover Delivery, Pickup, Installation & Service</p>
    
  </div>
</div>
          </div>
          <div class="addcart">
            <input type="hidden" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_details['p_id']; ?>" />
            <button id="button-cart" class="btn btn-primary">
            <i class="fa fa-shopping-cart fa-mg" aria-hidden="true"></i> <a href="javascript:void(0);">Rent Now</a>
            </button>
            <!-- <a href="cart.php" class="btn btn-primary"> <i class="fa fa-credit-card-alt fa-mg" aria-hidden="true"></i> Rent Now</a> -->
            <button id="button-cart1" class="btn btn-primary btn-primary-cart"> <i class="fa fa-shopping-cart fa-mg" aria-hidden="true"></i> Add to Cart</button>
            <!--<a href="javascript:void(0);" class="btn btn-primary btn-primary-cart"> <i class="fa fa-shopping-cart fa-mg" aria-hidden="true"></i> Add to Cart</a>--> 
          </div>
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
    <p class="p-text"><?php echo $conn->stripval($product_details['p_desc']); ?> </p>
    <h3 class="rented-title"> Specifications</h3>
    <div class="col-md-4 col-xs-12">
      <div class="table-responsive table-box">
        <table class="table table-bordered">
          <!--<tbody class="text-center">-->
            <?php foreach($product_spec['result'] as $res) { ?>
            <tr>
              <td><?php echo $conn->stripval(ucfirst($res['ps_name'])); ?></td>
              <td><?php echo $conn->stripval(ucfirst($res['ps_detail'])); ?></td>
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
<?php } else { ?>
<section id="product-detail">
  <div class="container-fluid">
    <p>No Product Available</p>
  </div>
</section>
<?php } ?>
<section id="product-llisting">
  <div class="container-fluid">
    <div class="featured-product-section wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
      <div class="container-fluid">
        <div class="row">
          <div class="featured-product-section-in">
            <h3>People Also Rented
          <?php if($featrow>0){?>    <div class="product-arrow pull-right"><a class="btn prev"><i class="fa fa-chevron-left"></i></a> <a class="btn next"><i class="fa fa-chevron-right"></i></a> </div><?php }?>
            </h3>
            <div class="products-in">
              <div id="demo">
                <?php if($featrow>0){?>
                <div id="owl-demo" class="owl-carousel">
                  <?php 
          while($res=mysql_fetch_array($feat_loc))
          {
            if($res['p_category']=='3')
            {
              $month=round($res['ps_price_month'], 2);
            }elseif($res['p_category']!='3')
            {
              $month=round($res['pp_price_12_month'], 2);
            }
            
            $exist = $conn->image_exist($res['p_image'],"uploads/product/");
       $prodimg= ($exist) ? "product/image/".$res['p_image'] : "images/product-1.png";   
          ?>
                  <div class="item-text">
                    <div class="item">
                      <div class="hovereffect"> <a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $res['p_slug']  ?>.html"><img src="<?php echo $prodimg; ?>" alt="Product-1"></a>
                        <div class="overlay"> <a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $res['p_slug']  ?>.html" class="rent-now-button prd-button">Rent Now</a> </div>
                      </div>
                    </div>
                    <h5><a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $res['p_slug']  ?>.html" class=" prd-button"><?php echo $res['p_name'] ?></a></h5>
                  <?php if($res['p_category']!='3'){?>   <p><?php echo '₹ '.$month; ?></p> <?php }?>
                  </div>
                  <?php }?>
                  <?php /*?> <div class="item-text">
                  <div class="item">
                    <div class="hovereffect"> <img src="images/product-1.png" alt="Product-1">
                      <div class="overlay">  <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                    </div>
                  </div>
                  <h5>Washing Machine</h5>
                  <p>₹ 15,000</p>
                </div>
                <div class="item-text">
                  <div class="item">
                    <div class="hovereffect"> <img src="images/product-2.png" alt="Product-1">
                      <div class="overlay"> <!-- <a href="#" class="prd-cart-button prd-button">Add To Cart</a> --> <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                    </div>
                  </div>
                  <h5>Led TV</h5>
                  <p>₹ 15,000</p>
                </div>
                <div class="item-text">
                  <div class="item">
                    <div class="hovereffect"> <img src="images/product-3.png" alt="Product-1">
                      <div class="overlay"> <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                    </div>
                  </div>
                  <h5>Gym</h5>
                  <p>₹ 15,000</p>
                </div>
                <div class="item-text">
                  <div class="item">
                    <div class="hovereffect"> <img src="images/product-4.png" alt="Product-1">
                      <div class="overlay">  <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                    </div>
                  </div>
                  <h5>Furniture</h5>
                  <p>₹ 15,000</p>
                </div>
                <div class="item-text">
                  <div class="item">
                    <div class="hovereffect"> <img src="images/product-1.png" alt="Product-1">
                      <div class="overlay">  <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                    </div>
                  </div>
                  <h5>Washing Machine</h5>
                  <p>₹ 15,000</p>
                </div>
                <div class="item-text">
                  <div class="item">
                    <div class="hovereffect"><img src="images/product-2.png" alt="Product-1">
                      <div class="overlay">  <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                    </div>
                  </div>
                  <h5>Led</h5>
                  <p>₹ 15,000</p>
                </div><?php */?>
                </div>
                <?php }else{?>
                <div class="text-center txt-styl">
              <ul>
                <li> <i class="fa fa-warning"></i> &nbsp;No Record Found</li>
              </ul>
            </div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include"footer.php" ?>
<script type="application/javascript">
 $('.month_rad').click(function(e) {
	//alert("asada");
var selmon=$(this).val();
var prodval=$('#product_id').val();
 $.ajax({
            url: '<?php echo SITE_URL; ?>ajax_submit.php?func=monthreload',
            data:'prod='+prodval+'&monthval='+selmon,
            type: "POST",
			 dataType: 'json',
            success:function(data){
				//alert(data['totalamnt']);
				//$("#ajaxcmnt").text(data);
				//$("#ajaxcmnt").text(data);
				  $('.permonth').text("₹ "+ data['totalamnt']); 
				   $('.monthrent').text("₹ "+ data['prodamnt']); 
				    $('.monthtax').text("₹ "+ data['tax']); 
			//	$("#ajaxcmnt").load(url+" #ajaxcmnt");
            }
      });
	  
  });	

</script> 
<script type="text/javascript"><!--
    $('#button-cart').on('click', function() {
  	  <?php if(isset($_SESSION['prentz_user_id'])) { ?>
      $.ajax({
        url: '<?php echo SITE_URL; ?>ajax_submit.php?func=cart_add',
        type: 'post',
        data: $('#product input[type=\'hidden\'],#product input[type=\'text\'], #product input[type=\'radio\']:checked'),
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
          //  $('.breadcrumb').after('<div class="alert alert-success container-fluid">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            
           // $('html, body').animate({ scrollTop: 0 }, 'slow');

           // $('.mini-cart').load('cart_response.php .cart-info');
  		 window.location.href = "cart.php";
            if (json['cart_number']) {              
                $('.cart-number').html+'('+(json['cart_number']+')');
            }
          }
        },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
      });
  	<?php }else {?>
  	
  //	alert("Please Login To Continue");
  	$('#myModal').modal('show');
  	<?php }?>
    });
//reload price based on month	


		
    //--></script> 
<script type="text/javascript"><!--
    $('#button-cart1').on('click', function() {
  	  <?php if(isset($_SESSION['prentz_user_id'])) { ?>
      $.ajax({
        url: '<?php echo SITE_URL; ?>ajax_submit.php?func=cart_add',
        type: 'post',
        data: $('#product input[type=\'hidden\'],#product input[type=\'text\'], #product input[type=\'radio\']:checked'),
        dataType: 'json',
        beforeSend: function() {
          $('#button-cart1').button('loading');
        },
        complete: function() {
          $('#button-cart1').button('reset');
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
			 // location.reload();
			 
            $('.breadcrumb').after('<div class="alert alert-success container-fluid">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            
            $('html, body').animate({ scrollTop: 0 }, 'slow');

            $('.mini-cart').load('cart_response.php .cart-info');
  		// window.location.href = "cart.php";
            if (json['cart_number']) { 
			 location.reload();
			// alert(json['cart_number']);      
			//$('.cartdiv').load('menu.php  .cartdiv');    
			//$('.cartdiv').empty().load('menu.php' + '.cartdiv');   
                $('.cart-number').html(json['cart_number']);
				 
            }
          }
        },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
      });
  	<?php }else {?>
  	
  //	alert("Please Login To Continue");
  	$('#myModal').modal('show');
  	<?php }?>
    });
//reload price based on month	


		
    //--></script>
    
    <script>
	    $(document).ready(function() {
   $('[data-toggle="popover"]').popover({
      placement: 'top',
      trigger: 'hover'
   });
});
    </script>
</body>
</html>