<?php
require(dirname(__FILE__).'/appcore/app-register.php');
  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: 0");
  
 require 'mailer/PHPMailerAutoload.php'; 
$cart_product= $shopcart->getProducts();
 $cart_total= $shopcart->getTotalAmount();
foreach ($cart_product as $key => $product){

}

// Validate cart has products and has stock.
if (!$shopcart->hasProducts()) {
  $conn->divert(SITE_URL."cart.html");
}

//$cart_products= $shopcart->getProducts();

//print_r($cart_products);

//foreach ($cart_products as $cart_product) {
  # code...
//}
//echo $cart_product['total'];exit;
//cart tab
//echo $_SESSION['ses_cartstep'];
if(!isset($_SESSION['ses_cartstep']))
{
unset ($_SESSION['ses_cartstep']); 
  $_SESSION['ses_cartstep']=1;
}

/*print_r($cart_product);exit;*/
  $cart_total= $shopcart->getTotalAmount();

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");         

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");
$customer_details= $shopcart->customerDetails();
 

$uid = $_SESSION['prentz_user_id'];
if($uid) 
{    
    $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");
	$billadd = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND address_status = 'Y'  AND  default_add = 'Y'","1");
	if($_SESSION['ses_billingaddress']==''){
	$_SESSION['ses_billingaddress']= $billadd['address_id'];
	}
  }

 $shippingaddress = $conn->select_query(ORDER,"*","customer_id='".$uid."' AND  order_status_id = '5'","");

foreach ($shippingaddress['result'] as $cart_products) {
  # code...
}
 $billingaddresss = $conn->select_query(ORDER,"*","customer_id='".$uid."' AND  order_status_id = '5'","");


foreach ($billingaddresss['result'] as $billingaddress) {
  # code...
}

$uid = $_SESSION['prentz_user_id'];

if(isset($billing_save))
{

  $Alertsuccessmessage = '';
  $arr=array('order_status_id'=>5,'customer_id'=>$uid,'customer_id'=>$uid,'ord_id'=>$orderid_product['order_id']);
  $ins=$conn->insert(ORDER,"",$arr);
  if($ins)
  {
   // $Alertsuccessmessage = "Successfully Saved.";
	
        
  }
}

 if(isset($btn_billing))
 {	
	 $_SESSION['ses_cartstep']='2';	 
	 $_SESSION['ses_billingaddress']=$billingid;
	// $Alert_shipping_message = "Successfully Saved.";
	//$Alertsuccessurl=SITE_URL."checkout.php";
	 
 }


 if(isset($btn_shiping))
 { 
	 $_SESSION['ses_cartstep']='3';
	  $_SESSION['ses_shippingaddress']=$shippingid;
	 //  $Alert_shipping_message = "Successfully Saved.";
	 
 }
 if(isset($btn_summary))
 { 
	 $_SESSION['ses_cartstep']='4';
	  //$_SESSION['ses_shippingaddress']=$shippingid;
	  // $Alert_shipping_message = "Successfully Saved.";
	 
 }

if(isset($btn_address))
{
//echo "asd";exit;
  $Alert_shipping_message = '';
  $arr=array('address_status'=>'Y','customer_id'=>$uid);
  $ins=$conn->insert(USERADDRESS,"",$arr);
  if($ins)
  {
    $Alert_shipping_message = "Successfully Saved.";
	$Alertsuccessurl=SITE_URL."checkout.html";
        
  }
}
 $useraddress = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND  address_status = 'Y' order by default_add desc","");
 
if(isset($btn_cod))
{
	
	//billing address
	
	$billingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND address_id='".$_SESSION['ses_billingaddress']."' AND address_status = 'Y'","1");
	
	//shipping address
	
	
	$shippingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND address_id='".$_SESSION['ses_shippingaddress']."' AND address_status = 'Y'","1");
	 
	  $cart_totalne= $shopcart->getTotalAmount();
	 
	$arr=array('paymethod'=>'COD','customer_id'=>$uid,'order_status_id'=>'1','payment_status'=>'pending','loc_id'=>$_COOKIE["current_location"],'bill_add_id'=>$_SESSION['ses_billingaddress'],'bill_address'=>$billingadd['address_1'],'bill_city'=>$billingadd['city'],'bill_state'=>$billingadd['state_id'],'bill_pincode'=>$billingadd['postcode'],'ship_add_id'=>$_SESSION['ses_shippingaddress'],'ship_address'=>$shippingadd['address_1'],'ship_city'=>$shippingadd['city'],'ship_state'=>$shippingadd['state_id'],'ship_pincode'=>$shippingadd['postcode'],'total'=>$cart_totalne['total_payout'],'ord_date'=>NOW);

  $ins=$conn->insert(ORDER,"",$arr);
  
  
  if($ins)
  {

            $oid=mysql_insert_id();
            $_SESSION['ses_oid'] = $oid;
            $ordertxt="PRZ10000";
            $ord_id = $ordertxt . $oid;


$update = $conn->Execute("UPDATE ".ORDER." set order_id='" . $ord_id . "' where ord_id='" . $oid . "'");

//order detail
foreach ($cart_product as $key => $product){
	
	if($product['p_category']!='3')
				{
					$cart_option=$product['option'];
					
					//tax
	
	 $product_detail = $conn->select_query(PRODUCTPRICE,"*", "pp_product_id = '".$product['product_id']."'  AND pp_location_id= '".$_COOKIE["current_location"]."'", "1");
	 
	 $tax = $conn->select_query(TAX,"*", "tax_id = '".$product['tax_id']."' AND tax_status = 'Y'", "1");
 $tax_amount1 = ($product_detail['pp_price_3_month']) * ($tax['tax_percentage']/100); 
 $tax_amount2 = ($product_detail['pp_price_6_month']) * ($tax['tax_percentage']/100); 
 $tax_amount3= ($product_detail['pp_price_9_month']) * ($tax['tax_percentage']/100); 
 $tax_amount4 = ($product_detail['pp_price_12_month']) * ($tax['tax_percentage']/100); 
 
 switch ($cart_option)
 {
	                               case "1":$ajaxamnt=round(($product_detail['pp_price_3_month'] ), 2);
								    $prodamnt=round(($product_detail['pp_price_3_month'] - $tax_amount1), 2);
									$taxval=$tax_amount1;
									break;
									case "2":$ajaxamnt=round(($product_detail['pp_price_6_month'] ), 2);
									$prodamnt=round(($product_detail['pp_price_6_month'] - $tax_amount2), 2);
									$taxval=$tax_amount2;
									break;
									case "3":$ajaxamnt=round(($product_detail['pp_price_9_month'] ), 2);
									$prodamnt=round(($product_detail['pp_price_9_month'] - $tax_amount3), 2);
									$taxval=$tax_amount3;
									break;
							       case "12":$ajaxamnt=round(($product_detail['pp_price_12_month']), 2);
									$prodamnt=round(($product_detail['pp_price_12_month']  - $tax_amount4), 2);
									$taxval=$tax_amount4;
									break;
									
 }
					
				}else
				{
					$cart_option=$product['rent_days'];
				}

 
	 $arrdet=array('order_id'=>$oid,'product_id'=>$product['product_id'],'customer_id'=>$userdetails['user_id'],'name'=>$product['name'],'month_days'=>$cart_option,'cat_id'=>$product['p_category'],'quantity'=>$product['quantity'],'paymethod'=>'COD','refundable_deposit'=>$product['total'],'monthly_price'=>$product['price_month'],'security_deposite'=>$product['security_deposit'],'handling_price'=>$product['handling_charge'],'total'=>$cart_total['total_payout'],'tax'=>$taxval,'order_status_id'=>'1','payment_status'=>'pending','ord_date'=>DATE,'loc_id'=>$_COOKIE["current_location"]);

  $insdetail=$conn->insert(ORDERPRODUCT,"",$arrdet);
}

//delete cart
if($insdetail)
{
 $cart_chk = $conn->select_query(CART, "*", "customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "'", '');
	   
	  if($cart_chk)
	   {
		   foreach ($cart_chk['result'] as $rescart) {  
		           $conn->delete_query(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'"); 
                 }
	   }
}

/*include "mailcontent/ordermail.php";
include "mailcontent/orderadminmail.php";*/
//exit;
unset ($_SESSION['ses_cartstep']); 
unset($_SESSION['prentz_cart']);
    $conn->divert(SITE_URL.'myform.html');
// echo "window.location.href =checkout.php";ORDERPRODUCT
    
  }

}

//online
if(isset($btn_online))
{
	
	//billing address
	
	$billingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND address_id='".$_SESSION['ses_billingaddress']."' AND address_status = 'Y'","1");
	
	//shipping address
	
	
	$shippingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND address_id='".$_SESSION['ses_shippingaddress']."' AND address_status = 'Y'","1");
	 
	  $cart_totalon= $shopcart->getTotalAmount();
	 
	$arr=array('paymethod'=>'ONLINE','customer_id'=>$uid,'order_status_id'=>'1','payment_status'=>'pending','loc_id'=>$_COOKIE["current_location"],'bill_add_id'=>$_SESSION['ses_billingaddress'],'bill_address'=>$billingadd['address_1'],'bill_city'=>$billingadd['city'],'bill_state'=>$billingadd['state_id'],'bill_pincode'=>$billingadd['postcode'],'ship_add_id'=>$_SESSION['ses_shippingaddress'],'ship_address'=>$shippingadd['address_1'],'ship_city'=>$shippingadd['city'],'ship_state'=>$shippingadd['state_id'],'ship_pincode'=>$shippingadd['postcode'],'total'=>$cart_totalon['total_payout'],'ord_date'=>NOW);

  $ins=$conn->insert(ORDER,"",$arr);
  if($ins)
  {

            $oid=mysql_insert_id();
            $_SESSION['ses_oid'] = $oid;
            $ordertxt="PRZ10000";
            $ord_id = $ordertxt . $oid;


$update = $conn->Execute("UPDATE ".ORDER." set order_id='" . $ord_id . "' where ord_id='" . $oid . "'");


//order detail
foreach ($cart_product as $key => $product){
	
	if($product['p_category']!='3')
				{
					$cart_option=$product['option'];
					
					//tax
	
	 $product_detail = $conn->select_query(PRODUCTPRICE,"*", "pp_product_id = '".$product['product_id']."'  AND pp_location_id= '".$_COOKIE["current_location"]."'", "1");
	 
	 $tax = $conn->select_query(TAX,"*", "tax_id = '".$product['tax_id']."' AND tax_status = 'Y'", "1");
 $tax_amount1 = ($product_detail['pp_price_3_month']) * ($tax['tax_percentage']/100); 
 $tax_amount2 = ($product_detail['pp_price_6_month']) * ($tax['tax_percentage']/100); 
 $tax_amount3= ($product_detail['pp_price_9_month']) * ($tax['tax_percentage']/100); 
 $tax_amount4 = ($product_detail['pp_price_12_month']) * ($tax['tax_percentage']/100); 
 
 switch ($cart_option)
 {
	                               case "1":$ajaxamnt=round(($product_detail['pp_price_3_month'] ), 2);
								    $prodamnt=round(($product_detail['pp_price_3_month'] - $tax_amount1), 2);
									$taxval=$tax_amount1;
									break;
									case "2":$ajaxamnt=round(($product_detail['pp_price_6_month'] ), 2);
									$prodamnt=round(($product_detail['pp_price_6_month'] - $tax_amount2), 2);
									$taxval=$tax_amount2;
									break;
									case "3":$ajaxamnt=round(($product_detail['pp_price_9_month'] ), 2);
									$prodamnt=round(($product_detail['pp_price_9_month'] - $tax_amount3), 2);
									$taxval=$tax_amount3;
									break;
									case "12":$ajaxamnt=round(($product_detail['pp_price_12_month'] ), 2);
									$prodamnt=round(($product_detail['pp_price_12_month'] - $tax_amount4 ), 2);
									$taxval=$tax_amount4;
									break;
									
 }
					
				}else
				{
					$cart_option=$product['rent_days'];
				}

 
	 $arrdet=array('order_id'=>$oid,'product_id'=>$product['product_id'],'customer_id'=>$userdetails['user_id'],'name'=>$product['name'],'month_days'=>$cart_option,'cat_id'=>$product['p_category'],'quantity'=>$product['quantity'],'paymethod'=>'ONLINE','refundable_deposit'=>$product['total'],'monthly_price'=>$product['price_month'],'security_deposite'=>$product['security_deposit'],'handling_price'=>$product['handling_charge'],'total'=>$cart_total['total_payout'],'tax'=>$taxval,'order_status_id'=>'1','payment_status'=>'pending','ord_date'=>DATE,'loc_id'=>$_COOKIE["current_location"]);

  $insdetail=$conn->insert(ORDERPRODUCT,"",$arrdet);
}

//delete cart
if($insdetail)
{
 $cart_chk = $conn->select_query(CART, "*", "customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "'", '');
	   
	  if($cart_chk)
	   {
		   foreach ($cart_chk['result'] as $rescart) {  
		           $conn->delete_query(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'"); 
                 }
	   }
}

/*include "mailcontent/ordermail.php";
include "mailcontent/orderadminmail.php";*/
	
unset($_SESSION['prentz_cart']);
unset ($_SESSION['ses_cartstep']); 
require_once "paytm/pgRedirect.php";
    
  }
  
  
	
}

//section open close

//sec 1
if($_SESSION['ses_cartstep']==1)
{
	$sect1='active';
	$bot1='active';
}
elseif($_SESSION['ses_cartstep']<1)
{
	$sect1='disabled';
	$bot1='disabled';
}
elseif($_SESSION['ses_cartstep']>1)
{
	$sect1='';
	$bot1='disabled';
}

//sec 2
if($_SESSION['ses_cartstep']==2)
{
	$sect2='active';
	$bot2='active';
}
elseif($_SESSION['ses_cartstep']<2)
{
	$sect2='disabled';
	$bot2='disabled';
}elseif($_SESSION['ses_cartstep']>2)
{
	$sect2='';
	$bot2='disabled';
}

//sec 3
if($_SESSION['ses_cartstep']==3)
{
	$sect3='active';
	$bot3='active';
}
elseif($_SESSION['ses_cartstep']<3)
{
	$sect3='disabled';
	$bot3='disabled';
}
elseif($_SESSION['ses_cartstep']>3)
{
	$sect3='';
	$bot3='disabled';
}

//sec 3
if($_SESSION['ses_cartstep']==4)
{
	$sect4='active';
	$bot4='active';
}
elseif($_SESSION['ses_cartstep']<4)
{
	$sect4='disabled';
	$bot4='disabled';
}elseif($_SESSION['ses_cartstep']>4)
{
	$sect4='';
	$bot4='disabled';
}
//unset ($_SESSION['ses_cartstep']); 
//get order
$getOrder = $conn->select_query(ORDERPRODUCT,"*","order_product_id='".$_SESSION['ses_oid']."'","1"); 
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
       <li class="active">Checkout</li>
     </ol>
     
 </div>
 </div>
</section>
 




<style type="text/css">
   /*******************************
* Does not work properly if "in" is added after "collapse".
* Get free snippets on bootpen.com
*******************************/
    .panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    .panel-default > .panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: #FAFAFA;
        border-color: #EEEEEE;
    }

    .panel-title {
        font-size: 14px;
    }

    .panel-title > a {
        display: block;
        padding: 15px;
        text-decoration: none;
    }

    .more-less {
        float: right;
        color: #212121;
    }

    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }

/* ----- v CAN BE DELETED v ----- */

</style>
<section id="checkout">
<div class="container-fluid">
<div class="container demo text-pad-none">

	<h2 class="tab-title <?php echo $sect1; ?>" data-panel="collapse-1">1. Billing Address</h2>
	<div id="collapse-1" class="cpanel-collapse <?php echo $bot1; ?>">
    <div class="panel-body">
      <div class="container text-pad-none">
    <div class="text-right text-cent">
        <div class="text-right text-cent btn_1">
  <button type="button" class="btn btn-info btn-lg btn-lg-add" data-toggle="modal" data-target="#myModal_2">Add New Address</button>
</div>
    </div>

</div>  

<div class="row">
   <div class="address_padding">
        <?php
		if($useraddress['nr']){
		 foreach ($useraddress['result'] as $resaddress) {
			   $state = $conn->select_query(STATE,"*","zone_id='".$resaddress['state_id']."'","1");
			 
			  ?>
        <div class="col-lg-3">
        <div class="div2 active">
   <form method="post">
           <label class="radio-inline">
      <input type="radio" name="billingid" id="billingid" <?php echo ($resaddress['address_id']==$_SESSION['ses_billingaddress'])? 'checked':''; ?> required value="<?php echo $resaddress['address_id'] ?>" /><?php echo $resaddress['firstname'] ?>
    </label>
          <p><?php echo $resaddress['address_1'] ?>,<?php echo $resaddress['city'] ?><br><?php echo $state['name'] ?>,<?php echo $resaddress['postcode'] ?></p>
        </div>
        </div>
        
                <?php }
		}?>
       
       </div>
    </div>    
 <div class="text-right btn_1"> 
  <button type="submit" name="btn_billing" id="btn_billing"  class="btn btn-primary">Continue</button>
                     </form>
                </div>

            </div>
    </div>
	<h2 class="tab-title <?php echo $sect2; ?>" data-panel="collapse-2">2. Shipping Address</h2>
	<div id="collapse-2" class="cpanel-collapse <?php echo $bot2; ?>">
    	<div class="panel-body">



<div class="container">
    <form name="form-add"  method="post" autocomplete="off">
  <!--<h2>Modal Example</h2>-->
  <!-- Trigger the modal with a button -->
    <div class="text-right text-cent">
        <div class="text-right text-cent btn_1">
  <button type="button" class="btn btn-info btn-lg btn-lg-add" data-toggle="modal" data-target="#myModal_2">Add New Address</button>
</div>
    </div>

  <!-- Modal -->
  
  
    </form>
  
</div>   
 <div class="row">
       <div class="address_padding">
          <form method="post">
            
        
        <?php 
		if($useraddress['nr']){
		 foreach ($useraddress['result'] as $resaddress) { 
		  $state = $conn->select_query(STATE,"*","zone_id='".$resaddress['state_id']."'","1");
		 ?>
        <div class="col-lg-3">
           
        <div class="div2 active">
   
           <label class="radio-inline">
      <input type="radio" name="shippingid" <?php echo ($resaddress['address_id']==$_SESSION['ses_shippingaddress'])? 'checked':''; ?> required value="<?php echo $resaddress['address_id'] ?>"><?php echo $resaddress['firstname'] ?>
    </label>
          <p><?php echo $resaddress['address_1'] ?>,<?php echo $resaddress['city'] ?><br><?php echo $state['name'] ?>,<?php echo $resaddress['postcode'] ?></p>
        </div>

        </div>
         <?php } }?>
       
       </div>

     </div>
 <div class="text-right btn_1">
                    <button type="submit" name="btn_shiping" id="btn_shiping"  class="btn btn-primary">Continue</button></form> 
                </div>
            </div>
    </div>
	<h2 class="tab-title <?php echo $sect3; ?>" data-panel="collapse-3">3. Order Summary</h2>
	<div id="collapse-3" class="cpanel-collapse <?php echo $bot3; ?>">
        <div class="cart-box checkout-cart m15">
        <?php if($cart_product){ 
        foreach ($cart_product as $key => $product) {
			
    if(!empty($product['image'])){
        if (file_exists('uploads/product/'.$product['image'])) { 
          $p_image='products/image/'.$product['image'];         
        }else{ 
          $p_image='noimg/noimage.png';
        }                 
      }else{
          $p_image='noimg/noimage.png';
          
      }  
	  if($product['p_category']!='3')
				{
					
			if($product['option']=='1')
			 {
				$cart_option='1'; 
			 }elseif($product['option']=='2')
			 {
				$cart_option='2'; 
			 }
			 elseif($product['option']=='3')
			 {
				 $cart_option='3';
			 }
			  elseif($product['option']=='12')
			 {
				 $cart_option='Above 3 Month';
			 }
					
				}else
				{
					$cart_option=$product['rent_days'];
				}
	   ?>
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <img src="<?php echo $p_image; ?>" alt="<?php echo $product['name']; ?>" class="img-responsive">
                </div>
                <div class="col-md-10 col-sm-10">
                    <h2><?php echo $product['name']; ?></h2>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 style-rad">
                            <p>Rental Plan :</p>
                            <div class="radio style-rad-1"><?php echo $cart_option; ?></div>
                        </div>
                        <div class="col-md-3 col-sm-3 style-rad">
                            <p>Rent :</p>
                            <p class="permonth125 style-rad-2"><?php  if($product['p_category']!='3'){?> ₹ <?php echo $product['price']; ?>/- Month <?php }elseif($product['p_category']=='3'){?>Rent Price Will Be Discussed On Phone<?php }?></p>
                        </div>
                        <div class="col-md-3 col-sm-3 style-rad">
                            <p>Quantity :</p>
                            <div class="quant-width style-rad-5">
                                <div class="input-group style-rad-3"><?php echo $product['quantity']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 style-rad">
                            <p>Security Deposit :</p>
                            <p class="style-rad-4"><?php  if($product['p_category']!='3'){?> ₹ <?php echo $product['total']; ?>/- Month <?php }elseif($product['p_category']=='3'){?>Rent Price Will Be Discussed On Phone<?php }?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php }}?>
        </div>
        <?php 
		$shippingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND address_id='".$_SESSION['ses_shippingaddress']."' AND address_status = 'Y'","1");
	 
	$state = $conn->select_query(STATE,"*","zone_id='".$shippingadd['state_id']."'","1");
		
		?>
        <div class="row">
            <div class="checkout-delInfo col-md-6">
                <h2>Delivery Address</h2>
                <p><?php echo $shippingadd['firstname']?>,<br>
				<?php echo $shippingadd['address_1']?>,<br>
               <?php echo $shippingadd['city']?> ,<br>
                 <?php echo $state['name']?> -  <?php echo $shippingadd['postcode']?>.</p>
            </div>
            <div class="checkout-total col-md-6">
                <p>Total Deposit : <span>₹ <?php echo $cart_total['total_deposit']; ?>/-</span> </p>
                <p>Handling Charges : <span>₹ <?php echo $cart_total['handling_charge']; ?>/-</span> </p>
                <p>Total Payout : <span>₹ <?php echo $cart_total['total_payout']; ?>/-</span></p>
              <form method="post">  <button type="submit" name="btn_summary" id="btn_summary"  class="btn btn-primary">Continue</button></form>
                <!--<button class="btn btn-primary">Continue</button>-->
            </div>
        </div>
       
    </div>
	<h2 class="tab-title <?php echo $sect4; ?>" data-panel="collapse-4">4. Payment Method </h2>
	<div id="collapse-4" class="cpanel-collapse <?php echo $bot4; ?>">
    
    <div class="col-md-3 col-sm-4 col-xs-12 ">
          <div class="payment payment-1">
          
          

   
          <form method="post">
         <p style="font-size:16px;"><label class="radio-inline"> <input type="radio" name="paymethod" id="cod" value="COD" checked>Cash  </label></p> 
         <p style="font-size:16px;"><label class="radio-inline"> <input type="radio" name="paymethod" id="paytm" value="PAYTM">Online Payment </label></p> 
         </form>
             <!-- <p style="font-size:16px;"> Credit Card</p>  <p style="font-size:16px; color:#ee2027">
              <p style="font-size:16px;"> Net Banking</p>  
              <p style="font-size:16px;"> Debit Card</p>  -->
              
          </div>
          </div>
    	    <div class="col-md-6 col-sm-4 col-xs-12 " id="COD">
          <div class="payment-detail">
          <h3 class="ctitle">Cash Payable</h3>

<form method="post" action="">   

            <input type="hidden" name="ORDER_ID" value="<?php echo $cart_product['order_id'] ?>">
            <input type="hidden" name="CUST_ID" value="<?php echo $cart_product['customer_id'] ?>">
          
       <button type="submit" name="btn_cod" id="btn_cod" class="btn btn-default btn-buy">ORDER NOW</button></td>       
   
  
  </form>


          </div>
          </div>
          
          
          <div class="col-md-6 col-sm-4 col-xs-12 "  id="PAYTM">
          <div class="payment-detail">
          <h3 class="ctitle">Online Payment </h3>

<form method="post" action="">   
            <input type="hidden" name="ORDER_ID" value="<?php echo $cart_product['order_id'] ?>">
            <input type="hidden" name="CUST_ID" value="<?php echo $cart_product['customer_id'] ?>">
          
       <button type="submit" name="btn_online" id="btn_online" class="btn btn-default btn-buy">PAY NOW</button></td>        
  </form>


          </div>
          </div>
          
    </div>
    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="display:none;">


       
        <div class="panel panel-default active">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="<?php echo  $step1expand; ?>" aria-controls="collapseOne">
                      Billing Address
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse <?php echo  $step1exin; ?>" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                      



<div class="container text-pad-none">
    <div class="text-right text-cent">
        <div class="text-right text-cent btn_1">
  <button type="button" class="btn btn-info btn-lg btn-lg-add" data-toggle="modal" data-target="#myModal_2">Add New Address</button>
</div>
    </div>

  <!-- Modal -->
  <?php /*?><div class="modal fade" id="myModal_1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Address</h4>
        </div>

        <form name="form-add" id="form-add-address"  method="post">
        <div class="modal-body">
          <!--<p>Some text in the modal.</p>-->
                <div class="form-group">
                <label for="name">Name <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="Name" name="firstname" id="firstname" maxlength="100" type="text" required>
              </div>
              <div class="form-group">
                <label for="address">Address <span style="color:#a70f13">*</span></label>
               <!--  <input class="form-control" placeholder="Address" name="billing_address" id="billing_address" maxlength="150" type="text" required> -->

                <textarea class="form-control" placeholder="Address" name="shipping_address_1" id="shipping_address_1"></textarea>
              </div>
              
              <div class="form-group">
                <label for="city">City <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="City" name="shipping_city" id="shipping_city" maxlength="100" type="text" required>
              </div>
              <div class="form-group">
                <label for="state">State <span style="color:#a70f13">*</span></label>
                                
                <select class="form-control" name="state_id" id="address-state">
                  <option value="">---Select State---</option>
                                  <option value="1475">Andaman and Nicobar Islands</option>
                                  <option value="1476">Andhra Pradesh</option>
                                  <option value="1477">Arunachal Pradesh</option>
                                  <option value="1478">Assam</option>
                                  <option value="1479">Bihar</option>
                                  <option value="1480">Chandigarh</option>
                                  <option value="1481">Dadra and Nagar Haveli</option>
                                  <option value="1482">Daman and Diu</option>
                                  <option value="1483">Delhi</option>
                                  <option value="1484">Goa</option>
                                  <option value="1485">Gujarat</option>
                                  <option value="1486">Haryana</option>
                                  <option value="1487">Himachal Pradesh</option>
                                  <option value="1488">Jammu and Kashmir</option>
                                  <option value="1489">Karnataka</option>
                                  <option value="1490">Kerala</option>
                                  <option value="1491">Lakshadweep Islands</option>
                                  <option value="1492">Madhya Pradesh</option>
                                  <option value="1493">Maharashtra</option>
                                  <option value="1494">Manipur</option>
                                  <option value="1495">Meghalaya</option>
                                  <option value="1496">Mizoram</option>
                                  <option value="1497">Nagaland</option>
                                  <option value="1498">Orissa</option>
                                  <option value="1499">Puducherry</option>
                                  <option value="1500">Punjab</option>
                                  <option value="1501">Rajasthan</option>
                                  <option value="1502">Sikkim</option>
                                  <option value="1503">Tamil Nadu</option>
                                  <option value="4231">Telangana</option>
                                  <option value="1504">Tripura</option>
                                  <option value="1505">Uttar Pradesh</option>
                                  <option value="1506">West Bengal</option>
                  
                </select>
              </div>
              <div class="form-group">
                <label for="pincode">Pincode <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="Pincode" name="shipping_postcode" id="shipping_postcode" maxlength="6" type="text" required>
              </div>
              <div class="form-group">
                <label for="email">E-mail Address <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="E-mail Address" name="address-email" id="address-email" maxlength="150" type="text" required>
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="Mobile Number" name="mobile_no" id="mobile_no" maxlength="15" type="text" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" name="shipping_save" id="btn" class="btn btn-primary btn-red">Submit</button>


          <!--        -->
              </div>
        </div>
         </form>


        <!--<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>-->
      </div>
      
    </div>
  </div><?php */?>
  

</div>  

<div class="row row-payment">
   <div class="address_padding">
                         
        <?php
		if($useraddress['nr']){
		 foreach ($useraddress['result'] as $resaddress) {
			   $state = $conn->select_query(STATE,"*","zone_id='".$resaddress['state_id']."'","1");
			 
			  ?>
        <div class="col-lg-3">
           
        <div class="div2 active">
   <form method="post">
           <label class="radio-inline">
      <input type="radio" name="billingid" id="billingid" <?php echo ($resaddress['address_id']==$getOrder['bill_add_id'])? 'checked':''; ?> value="<?php echo $resaddress['address_id'] ?>">Address
    </label>
          <p><?php echo $resaddress['address_1'] ?>,<?php echo $resaddress['city'] ?><br><?php echo $state['name'] ?>,<?php echo $resaddress['postcode'] ?></p>
         
        </div>

        </div>
         <?php }
		}?>
       
       </div>
    </div>
    
    
     <?php
	  //STEP 2
	  
	  $step2expand=(isset($_SESSION['ses_cartstep'])&&$_SESSION['ses_cartstep']=="2")?"true":"false";
	  $step2exclass=(isset($_SESSION['ses_cartstep'])&&$_SESSION['ses_cartstep']=="2")?'':'class="collapsed"'; 
	 // $step2attr=($_SESSION['ses_cartstep']>=2)? $step2exclass.' role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="'.$step2expand.'" aria-controls="collapseTwo"':' href="javascript:void(0);" onClick="displayalert(\'Step 2 is available only after completing Step 1 : Delivery Type !!!\')"  ';
	 $step2exin=(isset($_SESSION['ses_cartstep'])&&$_SESSION['ses_cartstep']=="2")?'in':'';
	   ?>

 <div class="text-right btn_1">
 <a class="collapsed" style="float: right;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="<?php echo $step2expand; ?>" aria-controls="collapseTwo">                       
                      <!-- <button  class="btn btn-primary">Continue</button>-->
                    </a>
                     <button type="submit" name="btn_billing" id="btn_billing"  class="btn btn-primary">Continue</button>
                     </form>
                </div>

            </div>
        </div>
</div>


        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Shipping Address
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse <?php echo $step2exin; ?>" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">



<div class="container">
    <form name="form-add"  method="post" autocomplete="off">
  <!--<h2>Modal Example</h2>-->
  <!-- Trigger the modal with a button -->
    <div class="text-right text-cent">
        <div class="text-right text-cent btn_1">
  <button type="button" class="btn btn-info btn-lg btn-lg-add" data-toggle="modal" data-target="#myModal_2">Add New Address</button>
</div>
    </div>

  <!-- Modal -->
  
  
    </form>
  
</div>   
 <div class="row">
       <div class="address_padding">
          <form method="post">
            
        
        <?php 
		if($useraddress['nr']){
		 foreach ($useraddress['result'] as $resaddress) { 
		  $state = $conn->select_query(STATE,"*","zone_id='".$resaddress['state_id']."'","1");
		 ?>
        <div class="col-lg-3">
           
        <div class="div2 active">
   
           <label class="radio-inline">
      <input type="radio" name="shippingid" <?php echo ($resaddress['address_id']==$_SESSION['ses_shippingaddress'])? 'checked':''; ?> value="<?php echo $resaddress['address_id'] ?>">Address
    </label>
          <p><?php echo $resaddress['address_1'] ?>,<?php echo $resaddress['city'] ?><br><?php echo $state['name'] ?>,<?php echo $resaddress['postcode'] ?></p>
        </div>

        </div>
         <?php } }?>
       
       </div>

     </div>


 <div class="text-right btn_1">

                     <a class="collapsed" style="float: right;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"></a>
                    <!--<button type="submit" name="btn_shiping" id="btn_shiping"  class="btn btn-primary">Continue</button>--></form> 
                </div>
            </div>
        </div>
</div>





  <?php
	  //STEP 2
	  
	  $step3expand=(isset($_SESSION['ses_cartstep'])&&$_SESSION['ses_cartstep']=="3")?"true":"false";
	  $step3exclass=(isset($_SESSION['ses_cartstep'])&&$_SESSION['ses_cartstep']=="3")?'':'class="collapsed"'; 
	 // $step2attr=($_SESSION['ses_cartstep']>=2)? $step2exclass.' role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="'.$step2expand.'" aria-controls="collapseTwo"':' href="javascript:void(0);" onClick="displayalert(\'Step 2 is available only after completing Step 1 : Delivery Type !!!\')"  ';
	 $step3exin=(isset($_SESSION['ses_cartstep'])&&$_SESSION['ses_cartstep']=="3")?'in':'';
	   ?>


        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="<?php echo $step3expand; ?>" aria-controls="collapseThree">
                      
                        Order Summary
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse <?php echo $step3exin; ?>" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">




                  <div class="panel-body">
              <div class="pay-rentz-2 text_heading">
            
              <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                 <!--<h2>Product Details</h2>-->
                </div>
                <div class="col-lg-3">
                  <!--<h2>Delivery Address</h2>-->
                </div>
</div>
              <div class="row">
                <div class="col-lg-3"><img class="content-image" src="<?php echo SITE_URL.'/uploads/product/'.$cart_product['image'];?>"></div>
                <div class="col-lg-6">





                <h4><?php echo  $cart_product['name'] ?></h4>
             <!--    <h6>Lorem Ipsum</h6> -->
                 <p>&#8377;&nbsp;<?php echo  $cart_product['total'] ?> &nbsp;&nbsp;&nbsp;<!-- <span>&#8377;&nbsp;3000</span> --></p>
                 <h6>Quantity &nbsp;<?php echo  $cart_product['quantity'] ?>:</6>
                </div>
                <div class="col-lg-3">


                     

                  <h2>Delivery Address</h2>
                <label id="choiceLabel"></label></div>
                
                 <p><?php 
				 
				 $shipadd = $conn->select_query(USERADDRESS,"*","customer_id='".$uid."' AND address_id='". $_SESSION['ses_shippingaddress']."' AND address_status = 'Y'","1");
				 
			  $state = $conn->select_query(STATE,"*","zone_id='".$shipadd['state_id']."'","1");
			  echo $shipadd['address_1'] ?>,<?php echo $shipadd['city'] ?><br><?php echo $state['name'] ?>,<?php echo $shipadd['postcode'] ?></p>
</div>
             <div class="row">
             
              <!-- <div class="text-right btn_1">
                 <button class="btn btn-primary" type="button" id="btn_add_address" name="btn_add_address" value="submit">Changes</button>
               </div>-->
             </div>
   
    
</div>
      </div>
   
         <div class="text-right btn_1">
                     <a class="collapsed" style="float: right;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree"><button  class="btn btn-primary">Continue</button>
                    </a>
                 </div>
                </div>
            </div>
        </div>

<!-- Payment Method start -->

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                      
                        Payment Method 
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                      <div class="panel-body">
          
          <div class="col-md-3 col-sm-4 col-xs-12 ">
          <div class="payment">
          <form method="post">
         <p style="font-size:16px;"> <input type="radio" name="paymethod" id="cod" value="COD" checked>Cash on Delivery - &nbsp;Cash</p> 
         <p style="font-size:16px;"><input type="radio" name="paymethod" id="paytm" value="PAYTM">Paytm - &nbsp;Online Payment</p> 
         </form>
             <!-- <p style="font-size:16px;"> Credit Card</p>  <p style="font-size:16px; color:#ee2027">
              <p style="font-size:16px;"> Net Banking</p>  
              <p style="font-size:16px;"> Debit Card</p>  -->
              
          </div>
          </div>
          
          <div class="col-md-6 col-sm-4 col-xs-12 " id="COD">
          <div class="payment-detail">
          <h3 class="ctitle">Cash on delivery is Available </h3>

<form method="post" action="">   

            <input type="hidden" name="ORDER_ID" value="<?php echo $cart_product['order_id'] ?>">
            <input type="hidden" name="CUST_ID" value="<?php echo $cart_product['customer_id'] ?>">
          
       <button type="submit" name="btn_cod" id="btn_cod" class="btn btn-default btn-buy">ORDER NOW</button></td>       
   
  
  </form>


          </div>
          </div>
          
          
          <div class="col-md-6 col-sm-4 col-xs-12 " style="display:none" id="PAYTM">
          <div class="payment-detail">
          <h3 class="ctitle">Online Payment By Paytm </h3>

<form method="post" action="">   

            <input type="hidden" name="ORDER_ID" value="<?php echo $cart_product['order_id'] ?>">
            <input type="hidden" name="CUST_ID" value="<?php echo $cart_product['customer_id'] ?>">
          
       <button type="submit" name="btn_subs" id="btn_subs" class="btn btn-default btn-buy">PAY NOW</button></td>       
   
  
  </form>


          </div>
          </div>
          
         <div class="col-md-3 col-sm-4 col-xs-12 total-pmdiv no-pad">
                  <div id="pricediv">               <div class="total-div">Total Deposit : ₹&nbsp;  <?php echo  round($cart_product['total'],2) ;?></div>  
               <div class="total-div" id="dd_24hrs" >Handling Charge   : <span id="div_24hrs">₹  <?php echo  round(($cart_product['handling_charge'] * $cart_product['quantity']), 2); ?></span></div>  
                <div class="pay-amount"><strong>GRAND TOTAL<br>

                  <?php
				  $handling= round(($cart_product['handling_charge'] * $cart_product['quantity']), 2);
				   $total_value = $cart_product['total'] + $handling?>
                <span class="red">₹ <?php echo round($total_value,2)  ?></span></strong></div>
               
                </div>
                  </div>
          


    </div><!-- panel-group -->
    
    
</div><!-- container -->
</div><!-- container -->
</section>

<div class="modal fade" id="myModal_2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Address</h4>
        </div>
        <div class="modal-body">
          <!--<p>Some text in the modal.</p>-->
                <div class="form-group">
                <form name="form_addr" id="form_add" method="post">
                <label for="name">Name <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="Name" name="firstname" id="firstname" maxlength="100" type="text" required>
              </div>
              <div class="form-group">
                <label for="address">Address <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="Address" name="address_1" id="address_1" maxlength="150" type="text" required>
              </div>
              
              <div class="form-group">
                <label for="city">City <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="City" name="city" id="city" maxlength="100" type="text" required>
              </div>
              <div class="form-group">
                <label for="state">State <span style="color:#a70f13">*</span></label>
                                
                <select class="form-control" name="state_id" id="state_id">
                  <option value="1475">---Select State---</option>
                                  <option value="1475">Andaman and Nicobar Islands</option>
                                  <option value="1476">Andhra Pradesh</option>
                                  <option value="1477">Arunachal Pradesh</option>
                                  <option value="1478">Assam</option>
                                  <option value="1479">Bihar</option>
                                  <option value="1480">Chandigarh</option>
                                  <option value="1481">Dadra and Nagar Haveli</option>
                                  <option value="1482">Daman and Diu</option>
                                  <option value="1483">Delhi</option>
                                  <option value="1484">Goa</option>
                                  <option value="1485">Gujarat</option>
                                  <option value="1486">Haryana</option>
                                  <option value="1487">Himachal Pradesh</option>
                                  <option value="1488">Jammu and Kashmir</option>
                                  <option value="1489">Karnataka</option>
                                  <option value="1490">Kerala</option>
                                  <option value="1491">Lakshadweep Islands</option>
                                  <option value="1492">Madhya Pradesh</option>
                                  <option value="1493">Maharashtra</option>
                                  <option value="1494">Manipur</option>
                                  <option value="1495">Meghalaya</option>
                                  <option value="1496">Mizoram</option>
                                  <option value="1497">Nagaland</option>
                                  <option value="1498">Orissa</option>
                                  <option value="1499">Puducherry</option>
                                  <option value="1500">Punjab</option>
                                  <option value="1501">Rajasthan</option>
                                  <option value="1502">Sikkim</option>
                                  <option value="1503">Tamil Nadu</option>
                                  <option value="4231">Telangana</option>
                                  <option value="1504">Tripura</option>
                                  <option value="1505">Uttar Pradesh</option>
                                  <option value="1506">West Bengal</option>
                  
                </select>
              </div>
              <div class="form-group">
                <label for="pincode">Pincode <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="Pincode" name="postcode" id="postcode" maxlength="6" type="text" required>
              </div>
              <div class="form-group">
                <label for="email">E-mail Address <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="E-mail Address" name="email_id" id="email_id" maxlength="150" type="text" required>
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number <span style="color:#a70f13">*</span></label>
                <input class="form-control" placeholder="Mobile Number" name="mobile_no" id="mobile_no" maxlength="15" type="text" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" name="btn_address" id="btn_address" class="btn btn-primary btn-red">Submit</button>
</form>


              </div>
        </div>
        <!--<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>-->
      </div>
      
    </div>
  </div>





<?php include "footer.php"; ?>

<script type="text/javascript">
function makedelivery(delival)
{
  if(delival)
  {   
        $('.delivery-button').removeClass('btn-red');
        $('.delivery-button').text('Deliver here');

        $('#delivery-button-'+delival).text('Selected');
        $('#delivery-button-'+delival).addClass('btn-red');
        
        $('#delivery-button-'+delival).css('background-color', '#ee2027');

        $('#deliveryaddress').val(delival);         
  }
}
<?php if (!$_SESSION['prentz_user_id']) { ?>
  $(document).ready(function() {
    // active   
     $('#collapse-checkout-option .panel-body').html(html);
   console.log($('#collapseOne').parent()) ;
      $('#collapseOne').parent().find('.panel-heading .panel-title').html('<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> 1. Before you place your order! - Signin </a>');

      $('a[href=#collapseOne]').trigger('click');

      $('#collapseOne').parent().find('.panel-heading').addClass('active');
  });      
<?php } else { ?>
$(document).ready(function() {
	
      $('#collapseTwo .panel-body').load('checkout_response.php #checkout-ajax-address');

      $('#collapseTwo').parent().find('.panel-heading .panel-title').html('<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">     2. Delivery Address  </a>');

      $('a[href=\'#collapseTwo\']').trigger('click');
      $('#collapseTwo').parent().find('.panel-heading').addClass('active'); 
});
<?php } ?>

//button-payment-address
$(document).delegate('#button-payment-address', 'click', function() {
  
  $('#collapseThree .panel-body').load('checkout_response.php #checkout-ajax-product-list');

  $('#collapseThree').parent().find('.panel-heading .panel-title').html('<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 3. Order Summary </a>');

  $('a[href=\'#collapseThree\']').trigger('click');
  $('#collapseThree').parent().find('.panel-heading').addClass('active');   

  $('#collapseFour').parent().find('.panel-heading .panel-title').html(' 4. Payment Method ');
  $('#collapseFour').parent().find('.panel-heading').removeClass('active'); 

 }); 

//button-product-conform
$(document).delegate('#button-product-conform', 'click', function() {
    
  $('#collapseFour').parent().find('.panel-heading .panel-title').html('<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> 4. Payment Method </a>');

  $('a[href=\'#collapseFour\']').trigger('click');
  $('#collapseFour').parent().find('.panel-heading').addClass('active');   

  //$('#collapseFour').parent().find('.panel-heading .panel-title').html(' 4. Payment Method ');
  
 }); 

</script>

<script type="text/javascript">
$(document).ready(function(){

	
  $(document).on("click", "#check_login", function(){      

       var checkemail = $("#check_email").val();
       var checkpassword = $("#check_pwd").val();

        if (!validateEmail(checkemail)) {
            $('.check_err_email').html('<div class="text-danger"> Email id is not valid </div>');
            return false;
        } else {
            $('.check_err_email').html('');
        }

        if(checkpassword.length == 0){
           $('.check_err_pwd').html('<div class="text-danger"> Password Cant be Empty! </div>');
            return false;
        } else {
            $('.check_err_pwd').html('');
        }

        $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/login.php',
            data: {"email": checkemail,"password": checkpassword},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) {
                $(document).ready(function(){
                  $('#myModalLogin').modal('show');
                });
                $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });
              }
              if (json['fail']) {
                $('.check_err').html('<div class="text-danger"> '+json['fail']+' </div>'); 
              }
                
            }
        });
        return true;
    });

$(document).on("click", ".btn_register", function(){  

    var phoneno_check = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;     

       var check_reg_email = $("#check_reg_email").val();
       var check_reg_username = $("#check_reg_name").val();
       var check_reg_mobile = $("#check_reg_mobile").val();
       var check_reg_pass = $("#check_reg_pwd").val();
       var check_confirmPassword = $("#check_reg_cpwd").val();

        if(check_reg_username.length == 0){
           $('.reg_err_username').html('<div class="text-danger"> Username Cant be Empty! </div>');
            return false;
        } else {
            $('.reg_err_username').html('');
        }

        if (!validateEmail(check_reg_email)) {
            $('.reg_err_email').html('<div class="text-danger"> Email id is not valid </div>');
            return false;
        } else {
            $('.reg_err_email').html('');
        }

        if(!check_reg_mobile.match(phoneno_check)){
           $('.reg_err_mobile').html('<div class="text-danger"> Enter Valid Mobile Number </div>');
            return false;
        } else {
            $('.reg_err_mobile').html('');
        }

        if(check_reg_pass.length == 0){
           $('.reg_err_password').html('<div class="text-danger"> Password Cant be Empty! </div>');
            return false;
        } else {
            $('.reg_err_password').html('');
        }

        if (check_reg_pass != check_confirmPassword) {
            $('.reg_err_cpassword').html('<div class="text-danger"> Passwords not match </div>'); 
            return false;
        } else {
             $('.reg_err_cpassword').html('');
        }

         $.ajax
        ({ 
            url: '<?php echo SITE_URL ?>login/signup.php',
            data: {"email": check_reg_email, "username": check_reg_username, "mobile": check_reg_mobile, "password": check_reg_pass},
            type: 'post',
            dataType: 'json',
            success: function(json)
            {
              if (json['success']) {
                 $(document).ready(function(){
                  $('#myModalReg').modal('show');
                });
                $(document).ready(function(){
                  setTimeout(function() {
                   window.location.href = json['redirect']
                  }, 500);
                });
              }

              if (json['fail']) {
                $('.reg_err').html('<div class="text-danger">  '+json['fail']+' </div>'); 
              }
                
            }
        });

        return true;

       
    });
});




$('#COD').show();
$('#PAYTM').hide();
$(document).on("click", "#paytm", function(){
	$('#COD').hide();
	$('#PAYTM').show();
});	


$(document).on("click", "#cod", function(){
	$('#COD').show();
	$('#PAYTM').hide();
});	


<?php 
//SUCCESS  Alerts
if(isset($Alertsuccessmessage) && $Alertsuccessmessage !='')
{
//echo "sdf";exit;  
  ?>
bootbox.dialog({
  message: "<p style='font-size:13px'><?php echo $Alertsuccessmessage; ?></p>",
  title: "<?php echo SITE_NAME; ?>",
  buttons: {
    success: {
      label: "OK",
      className: "btn-success"

    ,callback: function() {
        window.location.href="";
      }
     
    }
  }
});
<?php
}?>




<?php 
//SUCCESS  Alerts
if(isset($Alert_shipping_message) && $Alert_shipping_message !='')
{
//echo "sdf";exit;  
  ?>
bootbox.dialog({
  message: "<p style='font-size:13px'><?php echo $Alert_shipping_message; ?></p>",
  title: "<?php echo SITE_NAME; ?>",
  buttons: {
    success: {
      label: "OK",
      className: "btn-success"
 <?php if($Alertsuccessurl){?>
    ,callback: function() {
        window.location.href="<?php echo $Alertsuccessurl; ?>";
      }
     <?php }?>
     
    }
  }
});
<?php
}?>

</script>
<script type="text/javascript">
 (function (){
    var radios = document.getElementsByName('optradio');
    console.log(radios);
    for(var i = 0; i < radios.length; i++){
        radios[i].onclick = function(){
            document.getElementById('choiceLabel').innerText = this.value;
        }
    }
})();
</script>
<script type="text/javascript">
   function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
  
  <script>
      /**
 * Bootstrap Accordion header active v1.0
 * Manu Morante @unavezfui
 * Last update: 20/10/2014
 * https://codepen.io/unavezfui/pen/HibzA
 */
(function() {
  
  $(".panel").on("show.bs.collapse hide.bs.collapse", function(e) {
    if (e.type=='show'){
      $(this).addClass('active');
    }else{
      $(this).removeClass('active');
    }
  });  

}).call(this);

  </script>


  <script>
	//$('.cpanel-collapse').not(':first').slideUp().addClass('disabled');
		$('[data-panel]').click(function(){
		var $this = $(this),
			panelId = $this.data('panel');
		if(!$this.hasClass('disabled')){
			$('[data-panel]').not($this).removeClass('active');
			$('.cpanel-collapse').not('#'+panelId).slideUp();
			if($(this).hasClass('active')){
			   // $('#'+panelId).slideUp();
			   //$this.removeClass('active');
			}else{
				$('#'+panelId).slideDown();
				$this.addClass('active');
			}
		}
	});
  </script>
  </body>
</html>

