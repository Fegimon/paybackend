<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$cart_product= $shopcart->getProducts();

$cart_total= $shopcart->getTotalAmount();

$customer_details= $shopcart->customerDetails();

if (!$_SESSION['prentz_user_id']) {
  $conn->divert(SITE_URL."cart.php");
}

$sel_address = $conn->select_query(USERADDRESS, "*", "customer_id='".$_SESSION['prentz_user_id']."' AND address_status = 'Y'");

?>
<div id="checkout-ajax-address"> 
  <?php if($sel_address['nr']){
    foreach ($sel_address['result'] as $key => $address) { ?>
      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="address-mdiv">
              <h5 class="ctitle"><?php echo $address['firstname']; ?></h5>
              <p class="ctext"><?php echo $address['address_1']; ?><br>
                <?php echo $address['city'].', '.$address['postcode']; ?><br>
                Mobile : <?php echo $address['mobile_no']; ?></p>
                <?php if($customer_details['user_primary_address']==$address['address_id']){$class_add="btn-red";$button_name="Selected"; }else{$class_add="";$button_name="Deliver here";} ?>
              <button type="button" id="delivery-button-<?php echo $address['address_id'];?>" onClick="makedelivery('<?php echo $address['address_id'];?>');" class="btn btn-primary delivery-button <?php echo $class_add; ?>" ><?php echo $button_name; ?></button>
              <!--<a class="add-btn editaddress" href="javascript:void(0);" id="" data-toggle="modal" data-target="#edit-address" title="Edit"><i class="fa fa-pencil"></i></a>-->
            </div>
      </div>                   
          
  <?php  } } ?> 
  <div class="clearfix"></div>
          
      <div id="payment_address" class="mg-top">
        <center>
          <button type="button" class="btn btn-primary btn-red" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo"> Add New Address</button>
          <input type="hidden" name="delivery_address" id="deliveryaddress" value="<?php echo $customer_details['user_primary_address']; ?>">
          <button type="button" id="button-payment-address" data-loading-text="Loading..." class="btn btn-primary btn-red">Continue</button>           
        </center>
      </div> 
  <?php // }  ?>
</div>

<div id="checkout-ajax-product-list">
        <section id="product-listing" class="hidden-xs">
<div class="container-fluid">
<?php if($cart_product){ 
        foreach ($cart_product as $key => $product) {
         
  ?>
    <div class="cart-box wow fadeInUp">
    <div class="row">
    <?php if(!empty($product['image'])){
        if (file_exists('uploads/product/'.$product['image'])) { 
          $p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/product/'.$product['image'].'&w=250&h=250&zc=0';          
        }else{ 
          $p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
        }                 
      }else{
          $p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          
      }   ?>
        <div class="col-md-2 col-sm-2">
            <a href="javascript:void(0)"><img src="<?php echo $p_image; ?>" alt="<?php echo $product['name']; ?>" class="img-responsive center-block hvr-pulse"></a>
        </div>
        <div class="col-md-10 col-sm-10">
        <a href="javascript:void(0)"><h2> <?php echo $product['name']; ?> </h2></a>
        <div class="row">
        <div class="col-md-3 col-sm-3">
        <!--<p>Tenure</p>
        <p>12 Months</p>-->
        </div>
        <div class="col-md-3 col-sm-3">
        <p>Rent</p>
        <p>₹ <?php echo $product['price']; ?>/- Month</p>
        </div>
        <div class="col-md-3 col-sm-3">
        <p>Quantity</p>
        <div class="quant-width">
            <div class="input-group">
               <?php echo $product['quantity']; ?>
            </div>
        </div>
        </div>
        <div class="col-md-3 col-sm-3">
        <p>Refundable Deposit</p>
        <p>₹ <?php echo $product['total']; ?>/-</p>
        </div>
        </div>
    </div>
    </div>
</div>  
 <?php } } ?>   
    
</div>
</section>


<section id="product-listing" class="visible-xs">
<div class="container">
<div class="cart-box wow fadeInup">
     <div class="row">
        <div class="col-xs-12">
             <p class="mbl-cross"><i class="fa fa-times" aria-hidden="true"></i></p>
            <a href="#"><img src="images/list1.png" alt="" class="img-responsive center-block hvr-pulse"></a>
        </div>
        <div class="col-xs-10 col-xs-offset-1">
        <a href="#"><h2> Washing Machine - 7ltr</h2></a>
        <div class="row">
        <div class="col-xs-12">
        <p>Tenure : 12 Months</p>
        </div>
        <div class="col-xs-12">
        <p>Rent : ₹ 500/- Month</p>
        </div>
        <div class="col-md-12">
        <p>Refundable Deposit :  ₹ 3500/-</p>
        </div>
        <div class="col-md-12">
        <p>Quantity</p>
        <div class="quant-width">
            <div class="input-group">
                <span class="input-group-btn">
                       <button type="button" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="">
                          <span class="glyphicon glyphicon-minus quantity"></span>
                        </button>
                 </span>
                 <input type="text" id="quantity" name="quantity" class="form-control input-number" value="2" min="1" max="100">
                    <span class="input-group-btn">
                      <button type="button" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="">
                     <span class="glyphicon glyphicon-plus quantity"></span>
                      </button>
                     </span>
             </div>
        </div>
        </div>
        </div>
    </div>
    </div>
</div>
    
</div>
</section>

<section id="cart-total" class="hidden-xs">
<div class="container">
<div class="cart-totals">
    
    <div class="col-md-1  pull-right grand-total">
         <p>  ₹ <?php echo $cart_total['total_deposit']; ?>/-  </p><br/>
        <p>  ₹ <?php echo $cart_total['handling_charge']; ?>/- </p><br/>
        <p>  ₹ <?php echo $cart_total['total_payout']; ?>/-  </p><br/>
    </div>
    
    <div class="col-md-2 col-md-offset-3 pull-right">
        <p> Total Deposit  &nbsp; :  </p><br/>
        <p> Processesing Charge  &nbsp;  :    </p><br/>
        <p> Total Payout &nbsp;  : </p><br/>
    </div>
    
    <div class="col-md-3 pull-right">
        <p> Total Rent : <span>₹ <?php echo $cart_total['total_rent']; ?>/- </span></p>
    </div>
    </div>   
<div class="clearfix"></div>
<div class="mg-top">
        <center>
            <button type="button" id="button-product-conform" data-loading-text="Loading..." class="btn btn-primary btn-red">Continue</button>
        </center>
       </div> 
</div>
    
</section>
          
<section id="cart-toal" class="visible-xs">
<div class="container">
<div class="cart-totals">
    <p>Total Deposit :  ₹ 7000/-</p>
    <p>Processing Charge :  ₹ 500/-</p>
    <p>Total Payout :  ₹ 7500/-</p>
    <p> Total Rent : <span>₹ 750/- </span></p>
</div>    
</div>          
</section>
          
          

      </div>