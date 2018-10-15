<?php require(dirname(__FILE__).'/appcore/app-register.php');
//echo "hi"; 
//echo session_id();
//exit;
$cart_product= $shopcart->getProducts();

  $cart_total= $shopcart->getTotalAmount();
/*print_r($cart_total);exit();
*/

foreach ($cart_product as $key => $product){

}
$uid = $_SESSION['prentz_user_id'];
if($uid) 
{    
    $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");
 }


if(isset($saves))
{
	 $conn->divert(SITE_URL.'checkout.html');
/*	 
  $arr=array('product_id'=>$product['product_id'],'customer_id'=>$userdetails['user_id'],'order_status_id'=>'1','payment_status'=>'pending','loc_id'=>$_COOKIE["current_location"]);

  $ins=$conn->insert(ORDERPRODUCT,"",$arr);
  if($ins)
  {

            $oid=mysql_insert_id();
            $_SESSION['ses_oid'] = $oid;
            $ordertxt="PRZ10000";
            $ord_id = $ordertxt . $oid;


$update = $conn->Execute("UPDATE ".ORDERPRODUCT." set order_id='" . $ord_id . "' where order_product_id='" . $oid . "'");

    $succAlert = "Successfully Saved.";
	header("Location:checkout.php"); 
    $conn->divert(SITE_URL.'/checkout.html');
// echo "window.location.href =checkout.php";
    
  }*/
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo-general.php";?>
<?php include "header.php"; ?>
<base href="<?php echo SITE_URL; ?>">
<?php include "tracker.php"; ?>
</head>
<body>
<div class="main">
<section id="">
   <?php include 'menu.php';?>
</section>
<section id="inner-header">
  <div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">Cart</li>
          <?php if($cart_total['nr']){ ?>
            <p class="cart-display"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Your cart contains <?php echo $cart_total['nr']; ?> item(s),Initial amount payable ₹ <?php echo $cart_total['total_payout']; ?>
            </p>
          <?php } ?>
        </ol>
        
    </div>
  </div>
</section> 


<!--<form action="myform.php"  method="post">-->
<form name="frm_place"  method="post">

<section id="dynamic_cart" >
  
<div class="dynamic_cart"></div>
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
        <?php  if($product['p_category']!='3')
				{
					$cart_option=$product['option'];
					
				}else
				{
					$cart_option=$product['rent_days'];
				}?>
                 <input type="hidden" name="monthly_price" value="<?php echo $product['price_month']; ?>">
       <input type="hidden" name="month_days" value="<?php echo $cart_option; ?>">
            <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
             <input type="hidden" name="cat_id" value="<?php echo $product['p_category']; ?>">
          <div class="col-md-3 col-sm-3">
         <!-- <p>Tenure</p>
          <p>12 Months</p>-->
          
        <?php /*?>   <select class="form-control" onchange="changeOption(<?php echo $product['cart_id']; ?>, this); return false;">
            <option value="3" <?php echo ($product['option']=='3')? 'selected="selected"':''; ?>>1</option>
            <option value="6" <?php echo ($product['option']=='6')? 'selected="selected"':''; ?>>2</option>
            <option value="9" <?php echo ($product['option']=='9')? 'selected="selected"':''; ?>>3</option>
            <option value="12" <?php echo ($product['option']=='12')? 'selected="selected"':''; ?>>>3</option>
          </select> <?php */?>


<?php 

 if($product['p_category']!='3')
            {
				 //echo $product['option'];
				//echo ($product['option']);
				?>
            <p>Rental Plan</p>
          <div class="radio">
      <label><input type="radio" name="option<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);"  value="1" <?php echo ($product['option']=='1')? 'checked="checked"':''; ?>/>1</label>
      <label><input type="radio" name="option<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="2" <?php echo ($product['option']=='2')? 'checked="checked"':''; ?>>2</label>
      <label><input type="radio" <?php echo ($product['option']=='3')? 'checked="checked"':''; ?> name="option<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="3" >3</label>
      <label><input type="radio" name="option<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="12" <?php if($product['option']=='12'){echo  'checked="checked"';} ?>>&gt;3</label>
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
           <?php if($product['p_category']!='3'){
			   
			 if($product['option']=='1')
			 {
				 
			 }elseif($product['option']=='2')
			 {
				 
			 }
			 elseif($product['option']=='3')
			 {
			 }
			  elseif($product['option']=='12')
			 {
			 }
			   ?>
          <div class="col-md-3 col-sm-3">
          <p>Rent</p>
          <p class="permonth<?php echo $product['cart_id']; ?>"> ₹ <?php echo $product['price']; ?>/- Month</p>
          </div>
           <?php }elseif($product['p_category']=='3'){?>
            <div class="col-md-3 col-sm-3">
          <p>Rent Price Will Be Discussed On Phone</p>
         <?php /*?> <p>₹ <?php echo $product['price']; ?>/- Month</p><?php */?>
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

          <p>₹ <?php echo $product['total']; ?></p>
          <input type="hidden"  name="refundable_deposit"  value="<?php echo $product['total']; ?>">
          </div>
            <?php }elseif($product['p_category']=='3'){?>
            <div class="col-md-3 col-sm-3">
          <p>Security Deposit Will be discuessed on Phone</p>

          <?php /*?><p>₹ <?php echo $product['total']; ?></p><?php */?>
          <input type="hidden"  name="refundable_deposit"  value="<?php echo $product['total']; ?>">
          </div>
          <?php }?>
          </div>
      </div>
      </div>
  </div>
  <?php } } ?>
    
</div>
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
             <p class="mbl-cross"><span onclick="cartRemove(<?php echo $product['cart_id']; ?>,1); return false;"><i class="fa fa-times" aria-hidden="true"></i></span></p>
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
            <!--<a href="#"><img src="images/list1.png" alt="" class="img-responsive center-block hvr-pulse"></a>-->
            <a href="<?php echo SITE_URL.'product-detail/'.$product['slug'].'.html';?>"><img src="<?php echo $p_image; ?>" alt="<?php echo $product['name']; ?>" class="img-responsive center-block hvr-pulse"></a>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-none">
        <!--<a href="#"><h2> Washing Machine - 7ltr</h2></a>-->
        <a href="<?php echo SITE_URL.'product-detail/'.$product['slug'].'.html';?>"><h2><?php echo $product['name']; ?> </h2></a>
        <div class="row">
        <div class="col-xs-12 disp-value">
        <!--<p>Tenure : 12 Months</p>-->
        <p>Rental plan :</p>
         <?php /*?> <select class="form-control" onchange="changeOption(<?php echo $product['cart_id']; ?>, this); return false;">
            <option value="3" <?php echo ($product['option']=='3')? 'selected="selected"':''; ?>>1-3</option>
            <option value="6" <?php echo ($product['option']=='6')? 'selected="selected"':''; ?>>4-6</option>
            <option value="9" <?php echo ($product['option']=='9')? 'selected="selected"':''; ?>>7-9</option>
            <option value="12" <?php echo ($product['option']=='12')? 'selected="selected"':''; ?>>10-12</option>
          </select><?php */?>
          <?php  if($product['p_category']!='3')
            {?>
            <div class="radio">
     <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="1" <?php echo ($product['option']=='1')? 'checked="checked"':''; ?>/>1</label>
      <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="2" <?php echo ($product['option']=='2')? 'checked="checked"':''; ?>>2</label>
      <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="3" <?php echo ($product['option']=='3')? 'checked="checked"':''; ?>>3</label>
      <label><input type="radio" name="options<?php echo $product['cart_id']; ?>" class="month_rad" onclick="changeOption(<?php echo $product['cart_id']; ?>, this);" value="12" <?php echo ($product['option']=='12')? 'checked="checked"':''; ?>>&gt;3</label>
    </div>
    <?php }elseif($product['p_category']=='3'){?>
    <div class="form_paddin">
          <div class="form-group">
       <input type="text" class="form-control" id="usr" value="<?php echo $product['rent_days']; ?>">
      </div>
      </div>
      <?php }?>
        </div>
         <?php  if($product['p_category']!='3')
            {?>
        <div class="col-xs-6">
        <p class="permonth<?php echo $product['cart_id']; ?>">Rent : ₹ <?php echo $product['price']; ?>/- Month</p>
        </div>
        <div class="col-md-6 col-xs-6 col-none">
        <p>Refundable Deposit :  <?php echo $product['total']; ?></p>
        </div>
        <?php }elseif($product['p_category']=='3'){?>
         <div class="col-xs-6 col-none">
        <p>Rent Will Be Discussed On Phone</p>
        </div>
        <div class="col-md-12">
        <p>Security Deposit  Will Be Discussed On Phone</p>
        </div>
         <?php }?>
        <div class="col-md-12 col-xs-12 disp-value disp-1">
        <p>Quantity : </p>
        <!--<div class="quant-width">
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
        </div>-->
        
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
    
    <div class="col-md-4  pull-right grand-total pad-00">
        <p>Total Deposit  &nbsp; :   ₹ <?php echo $cart_total['total_deposit']; ?>/-  </p><br/>
        <p>Handling Charges  &nbsp;  :   ₹ <?php echo $cart_total['handling_charge']; ?>/- </p><br/>
 <input type="hidden"  name="handling_price"  value="<?php echo $cart_total['handling_charge']; ?>">
        <p>Total Payout &nbsp;  :  ₹ <?php echo $cart_total['total_payout']; ?>/-</p><br/>
         <input type="hidden" name="total" value="<?php echo $cart_total['total_payout']; ?>">
    </div>
    
   <!-- <div class="col-md-2 col-md-offset-3 pull-right">
        <p> Total Deposit  &nbsp; :  </p><br/>
        <p> Processesing Charge  &nbsp;  :    </p><br/>
        <p> Total Payout &nbsp;  : </p><br/>
    </div>-->
    
    <!-- <div class="col-md-3 pull-right">
        <p> Total Rent : <span>₹ <?php echo $cart_total['total_rent']; ?>/- </span></p>
    </div> -->
    </div>    
</div>
    
</section>
<?php } ?>
</section>
<section id="cart-btn">
<div class="container">

   <!--  <a href="checkout.php" class="btn btn-danger pull-right btn-blue">Place Order</a>   -->

<div class="row">
    <button type="submit" name="saves" id="saves" class="btn btn-danger pull-right btn-blue">Place Order</button>  
    <a href="index.php" class="btn btn-primary pull-right btn-blue">Cancel </a>
  </div>
</div>

</form>
</section>


<?php include "footer.php"; ?>

<script>

  function changeQty(position, increase) {
    //alert(position);
   // alert(increase);
   var selmon=$('#product_option').val();	
    var qty = parseInt($('#quantity' + position).val());

    if ( !isNaN(qty) ) {
      qty = increase ? qty + 1 : (qty - 1 >= 1 ? qty - 1 : 0);
      
      if(qty > 0){
        $.ajax({
          url: 'ajax_submit.php?func=cart_update',
          type: 'post',
          dataType: 'json',
          data: {qty:qty,cart_key:position},
          success: function (json) {
			  // location.reload();
            if (json['cart_display']) {              
              $('.cart-display').html(json['cart_display']);
            }

            if (json['cart_number']) {    
			//$('.cartdiv').load('menu.php  .cartdiv');            
              $('.cart-number').html(json['cart_number']);
            }
            
            $('#dynamic_cart').load('cart_response.php #new_dynamic_cart');
             $('.mini-cart').load('cart_response.php .cart-info');
			  test(selmon);
			  // location.reload();
           // $('#cart-total').html(json['total']);
           //cart_display cart_number


           /* if (json['error']) {
              $('.dynamic_cart').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }

            if (json['success']) {
              $('.dynamic_cart').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
            }*/
          }
        });
        $('#quantity' + position).val(qty);  
      } 
    } else {
      $('#quantity' + position).val(1);
    }   
      return false;      
    }

    function changeOption(cart_key, obj){
       $.ajax({
          url: 'ajax_submit.php?func=cart_update',
          type: 'post',
          dataType: 'json',
          data: {option:obj.value,cart_key:cart_key},
          success: function (json) {
			//   location.reload();
            if (json['cart_display']) {              
              $('.cart-display').html(json['cart_display']);
            }

            if (json['cart_number']) {    
			
			//$('.cartdiv').load('menu.php  .cartdiv');            
              $('.cart-number').html(json['cart_number']);
            }
            
            $('#dynamic_cart').load('cart_response.php #new_dynamic_cart');
             $('.mini-cart').load('cart_response.php .cart-info');
			 test(cart_key,obj.value);
			 
           // $('#cart-total').html(json['total']);
           //cart_display cart_number


           /* if (json['error']) {
              $('.dynamic_cart').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }

            if (json['success']) {
              $('.dynamic_cart').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
            }*/
          }
        });
		
    }
      
</script>

<script type="application/javascript">
function test(cart_key,obj)
{
	//alert("hi");
var cartid=cart_key;
var selmon=obj;
//var prodval=$('#product_id').val();
 $.ajax({
            url: '<?php echo SITE_URL; ?>ajax_submit.php?func=monthreloadcart',
            data:'cartid='+cartid+'&monthval='+selmon,
            type: "POST",
			 dataType: 'json',
            success:function(data){
				//alert(data['totalamnt']);
				//$("#ajaxcmnt").text(data);
				//$("#ajaxcmnt").text(data);
				  $('.permonth'+cartid).text("₹ "+ data['totalamnt']+ "/- Month"); 
				   $('.monthrent').text("Rs "+ data['prodamnt']); 
				    $('.monthtax').text("Rs "+ data['tax']); 
			//	$("#ajaxcmnt").load(url+" #ajaxcmnt");
            }
      });
	  
}

</script>

</body>
</html>