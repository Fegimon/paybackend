<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$cart_product= $shopcart->getProducts();

$cart_total= $shopcart->getTotalAmount();

?>
<div class="dynamic_cart"></div>
<section id="new_dynamic_cart">
<section id="product-listing" class="hidden-xs">
<div class="container">
<?php if($cart_product){ 
        foreach ($cart_product as $key => $product) {
  ?>
   <input type="hidden" name="product_id" id="product_id" value="<?php echo $product['product_id']; ?>" />
    <input type="hidden" name="product_option" id="product_option" value="<?php echo $product['option']; ?>" />
    <div class="cart-box wow fadeInUp">
      <div class="row">
          <div class="col-md-2 col-sm-2">
          <?php if(!empty($product['image'])){
        if (file_exists('uploads/product/'.$product['image'])) { 
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/product/'.$product['image'].'&w=250&h=250&zc=0';  
          $p_image='products/image/'.$product['image'];          
        }else{ 
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
        }                 
      }else{
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
        $p_image='noimg/noimage.png';
          
      }   ?>
              <a href="<?php echo SITE_URL.'product-detail/'.$product['slug'].'.html';?>"><img src="<?php echo $p_image; ?>" alt="<?php echo $product['name']; ?>" class="img-responsive center-block hvr-pulse"></a>
          </div>
          <div class="col-md-10 col-sm-10">
          <h2> <a href="<?php echo SITE_URL.'product-detail/'.$product['slug'].'.html';?>"><?php echo $product['name']; ?> </a> <span onclick="cartRemove(<?php echo $product['cart_id']; ?>,1); return false;"><i class="fa fa-times" aria-hidden="true"></i></span></h2>
          <div class="row">
          <div class="col-md-3 col-sm-3">
         <!-- <p>Tenure</p>
          <p>12 Months</p>-->
          <?php 

 if($product['p_category']!='3')
            {?>
          <p>Rental plan</p>
           <div class="radio">
     <label><input type="radio" class="month_rad" name="option<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);"  value="1" <?php echo ($product['option']=='1')? 'checked="checked"':''; ?>/>1</label>
      <label><input type="radio" class="month_rad" name="option<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="2" <?php echo ($product['option']=='2')? 'checked="checked"':''; ?>>2</label>
      <label><input type="radio" class="month_rad" name="option<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="3" <?php echo ($product['option']=='3')? 'checked="checked"':''; ?>>3</label>
      <label><input type="radio" class="month_rad" name="option<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="12" <?php echo ($product['option']=='12')? 'checked="checked"':''; ?>>&gt;3</label>
          </div>
          
            <?php }elseif($product['p_category']=='3'){?>
     <p>No.Of Days</p>
    <div class="form_paddin">
          <div class="form-group">
       <input type="text" class="form-control" id="usr" value="<?php echo $product['rent_days']; ?>">
      </div>
      </div>
      <?php }?>
          </div>
           <?php if($product['p_category']!='3'){?>
          <div class="col-md-3 col-sm-3">
          <p>Rent</p>
          <p class="permonth<?php echo $product['cart_id']; ?>">₹ <?php echo $product['price']; ?>/- Month</p>
          </div>
           <?php }elseif($product['p_category']=='3'){?>
           <div class="col-md-3 col-sm-3">
          <p>Rent Will Be Discussed On Phone</p>
          <?php /*?><p>₹ <?php echo $product['price']; ?>/- Month</p><?php */?>
          </div>
          <?php }?>
          <div class="col-md-3 col-sm-3">
          <p>Quantity</p>
          <div class="quant-width">
              <div class="input-group">
                  <span class="input-group-btn">
                         <button type="button" onclick="changeQty(<?php echo $product['cart_id']; ?>, 0); return false;" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="">
                            <span class="glyphicon glyphicon-minus quantity"></span>
                          </button>
                   </span>
                   <input type="text" id="quantity<?php echo $product['cart_id'];?>" name="quantity" readonly class="form-control input-number" value="<?php echo $product['quantity']; ?> " min="1" max="100">
                      <span class="input-group-btn">
                        <button type="button" onclick="changeQty(<?php echo $product['cart_id']; ?>,1); return false;" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="">
                       <span class="glyphicon glyphicon-plus quantity"></span>
                        </button>
                       </span>
               </div>
          </div>
          </div>
           <?php if($product['p_category']!='3'){?>
          <div class="col-md-3 col-sm-3">
          <p>Security Deposit</p>
          <p>₹ <?php echo $product['total']; ?>/-</p>
          </div>
           <?php }elseif($product['p_category']=='3'){?>
          <div class="col-md-3 col-sm-3">
          <p>Security Deposit Will Be Discussed On Phone</p>
          <?php /*?><p>₹ <?php echo $product['total']; ?>/-</p><?php */?>
          </div>
          <?php }  ?>
      </div>
      </div>
  </div>
  
    
</div>
<?php } } ?>
</section>


<section id="product-listing" class="visible-xs">
<div class="container">
<?php if($cart_product){ 
        foreach ($cart_product as $key => $product) {
         
  ?>
   <input type="hidden" name="product_id" id="product_id" value="<?php echo $product['product_id']; ?>" />
    <input type="hidden" name="product_option" id="product_option" value="<?php echo $product['option']; ?>" />
<div class="cart-box wow fadeInup">
     <div class="row">
        <div class="col-xs-12">
          <?php if(!empty($product['image'])){
        if (file_exists('uploads/product/'.$product['image'])) { 
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/product/'.$product['image'].'&w=250&h=250&zc=0';  
          $p_image='products/image/'.$product['image'];          
        }else{ 
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
        }                 
      }else{
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
        $p_image='noimg/noimage.png';
          
      }   ?>
             <p class="mbl-cross"><i class="fa fa-times" aria-hidden="true"></i></p>
            <a href="<?php echo SITE_URL.'product-detail/'.$product['slug'].'.html';?>"><img src="<?php echo $p_image; ?>" alt="<?php echo $product['name']; ?>" alt="" class="img-responsive center-block hvr-pulse"></a>
        </div>
        <div class="col-xs-10 col-xs-offset-1">
        <a href="<?php echo SITE_URL.'product-detail/'.$product['slug'].'.html';?>"><h2> <?php echo $product['name']; ?></h2></a>
        <div class="row">
        <div class="col-xs-12">
       <!-- <p>Tenure : 12 Months</p>-->
       
       <?php 

 if($product['p_category']!='3')
            {?>
        <p>Rental plan</p>
      <div class="radio">
   <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="1" <?php echo ($product['option']=='1')? 'checked="checked"':''; ?>/>1</label>
      <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="2" <?php echo ($product['option']=='2')? 'checked="checked"':''; ?>>2</label>
      <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="3" <?php echo ($product['option']=='3')? 'checked="checked"':''; ?>>3</label>
      <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="12" <?php echo ($product['option']=='12')? 'checked="checked"':''; ?>>&gt;3</label>
    </div>
    
      <?php }elseif($product['p_category']=='3'){?>
     <p>No.Of Days</p>
    <div class="form_paddin">
          <div class="form-group">
       <input type="text" class="form-control" id="usr" value="<?php echo $product['rent_days']; ?>">
      </div>
      </div>
      <?php }?>
        </div>
          <?php if($product['p_category']!='3'){?>
        <div class="col-xs-12">
        <p class="permonth<?php echo $product['cart_id']; ?>">Rent : ₹ <?php echo $product['price']; ?>/- Month</p>
        </div>
        <div class="col-md-12">
        <p>Refundable Deposit :  ₹ <?php echo $product['total']; ?></p>
        </div>
          <?php }elseif($product['p_category']=='3'){?>  
		    <div class="col-xs-12">
        <p>Rent Will Be Discussed On Phone</p>
        </div>
        <div class="col-md-12">
        <p>Security Deposit Will Be Discussed On Phone</p>
        </div>
		  
		  <?php }?>
        <div class="col-md-12">
        <p>Quantity</p>
        <div class="quant-width">
              <div class="input-group">
                  <span class="input-group-btn">
                         <button type="button" onclick="changeQty(<?php echo $product['cart_id']; ?>, 0); return false;" class="quantity-left-minus btn btn-quant btn-number"  data-type="minus" data-field="">
                            <span class="glyphicon glyphicon-minus quantity"></span>
                          </button>
                   </span>
                   <input type="text" id="quantity<?php echo $product['cart_id'];?>" readonly name="quantity" class="form-control input-number" value="<?php echo $product['quantity']; ?> " min="1" max="100">
                      <span class="input-group-btn">
                        <button type="button" onclick="changeQty(<?php echo $product['cart_id']; ?>,1); return false;" class="quantity-right-plus btn btn-quant btn-number" data-type="plus" data-field="">
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
<?php } } ?>
    
</div>
</section>
<?php if($cart_total['nr']){ ?>
<section id="cart-total">
<div class="container">
<div class="cart-totals">
    
    <div class="col-md-4  pull-right grand-total">
        <p>Total Deposit  &nbsp; :  ₹ <?php echo $cart_total['total_deposit']; ?>/-  </p><br/>
        <p>Processesing Charge  &nbsp;  :   ₹ <?php echo $cart_total['handling_charge']; ?>/- </p><br/>
        <p> Total Payout &nbsp;  :  ₹ <?php echo $cart_total['total_payout']; ?>/-  </p><br/>
    </div>
    
    <!--<div class="col-md-2 col-md-offset-3 pull-right">
        <p> Total Deposit  &nbsp; :  </p><br/>
        <p> Processesing Charge  &nbsp;  :    </p><br/>
        <p> Total Payout &nbsp;  : </p><br/>
    </div>-->
    
    <div class="col-md-3 pull-right">
       <!-- <p> Total Rent : <span>₹ <?php //echo $cart_total['total_rent']; ?>/- </span></p>-->
    </div>
    </div>    
</div>
    
</section>
<?php } ?>
</section>

 <div class="cart-info">
 	<?php if($cart_product){ ?>
 	<h3>Recently added items (<?php echo $cart_total['nr'];?>)</h3>
    	<?php foreach ($cart_product as $key => $product) { ?>                  
                <div class="cart-message">
                    <a href="javascript:void(0);" onclick="cartRemove(<?php echo $product['cart_id']; ?>,1); return false;" class="pull-right mg-cross">
                    <i class="fa fa-times cross-fa" aria-hidden="true"></i>
                    </a>
                    <div class="mini-img">
                     <?php if(!empty($product['image'])){
        if (file_exists('uploads/product/'.$product['image'])) { 
        //  $p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/product/'.$product['image'].'&w=250&h=250&zc=0';   
          $p_image='products/image/'.$product['image'];             
        }else{ 
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
        }                 
      }else{
         // $p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
      }   ?>
                        <img src="<?php echo $p_image; ?>" alt="" class="img-responsive">
                    </div>
                    <div class="mini-name">                        
                        <h2> <a href="<?php echo SITE_URL.'product-detail/'.$product['slug'].'.html';?>"><?php echo $product['name']; ?> </a> </h2>
                        <!--<p> 1 x <span> ₹300.00/pm </span></p>-->
                    </div>
                </div>
                 <div class="clearfix"></div>
        <?php } ?>
                <div class="clearfix"></div>
              
                <div class="total-box">
                     <span>Subtotal :</span> $ <?php echo $cart_total['total_payout']; ?>          
                </div>
                <a href="<?php echo SITE_URL ?>cart.html" class="btn btn-cart"> View cart</a>
                <?php } else{ ?>
                <h3>Your cart is empty</h3>
                <?php } ?>
            </div>
            