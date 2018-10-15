<?php
require(dirname(__FILE__).'/appcore/app-register.php');
/*
print_r($_POST);
echo $func;
exit;*/
function phoneNumbervalidation($mobile)
{
 if(preg_match('/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})?([0-9]{10})$/', $mobile,$matches)){
 //print_r($matches);
 return true;
 }
 else
 return false;
}
$cart_total= $shopcart->getTotalAmount();
if(isset($func) && $func=="address_add")
{
	$json=array();
	if(!$_SESSION['prentz_user_id']){
		$json['redirect'] = SITE_URL."index.php";
		break;
	}
	
	//print_r($_POST)	;	
	if ((strlen(trim($_POST['name'])) < 1) || (strlen(trim($_POST['name'])) > 32)) {		
		$json['error']['name'] = "Please enter the name";
	}
	
	if ((strlen(trim($_POST['address'])) < 3) || (strlen(trim($_POST['address'])) > 128)) {
		$json['error']['address'] = "Please enter the address";
	}
	
	if ((strlen(trim($_POST['city'])) < 2) || (strlen(trim($_POST['city'])) > 32)) {
		$json['error']['city'] = "Please enter the city";
	}

	if(!isset($_POST['state']) || empty($_POST['state'])){
		$json['error']['state'] = "Please enter the state";
	}	
	
	if ((strlen(trim($_POST['pincode'])) < 2) || (strlen(trim($_POST['pincode'])) > 10)) {	
		$json['error']['pincode'] = "Please enter the pincode";
	}
	
	if(empty($_POST['email']) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
		$json['error']['email'] = "Please enter the valid email id";
	}

	if(empty($_POST['mobile']) || !(phoneNumbervalidation($_POST['mobile']))){
		$json['error']['mobile'] = "Please enter the mobile";
	}
		            
	if (!$json) {
		$new_add = array('customer_id' => $_SESSION['prentz_user_id'], 'firstname' => $_POST['name'], 'address_1' => $_POST['address'], 'email_id' => $_POST['email'], 'mobile_no' => $_POST['mobile'], 'city' => $_POST['city'], 'postcode' => $_POST['pincode'], 'state_id'=>$_POST['state'], 'country_id' => '99', 'address_status' => 'Y', 'created_dt' => NOW);

        $ins_address = $conn->insert(USERADDRESS,"",$new_add);

        if ($ins_address) {
          $new=array('user_primary_address'=>$ins_address['id']);
          $ins = $conn->update(USER, "user_id='".$_SESSION['prentz_user_id']."'", $new);
        }
        $json['success'] = "Address successfully added";
	}

	echo json_encode($json);
}

if(isset($func) && $func=="cart_update")
{
	$json=array();
	if(!empty($_POST['qty']) && !empty($_POST['cart_key'])){
		$shopcart->updateCart($_POST['cart_key'], $_POST['qty'], '');	
		$json['success'] = "successfully updated";		
	}elseif(!empty($_POST['option']) && !empty($_POST['cart_key'])){
		$shopcart->updateCart($_POST['cart_key'], '', $_POST['option']);	
		$json['success'] = "successfully updated";	
	}else
	{
		$json['error'] = "Somthing was wrong";
	}	
	$cart_total= $shopcart->getTotalAmount();
	$json['cart_display']='<i class="fa fa-shopping-cart" aria-hidden="true"></i> Your cart contain '. $cart_total['nr'] .' item(s),Initial amount payable ₹ '. $cart_total['total_payout'];

	$json['cart_number']=($cart_total['nr'])? $cart_total['nr']:0 ;
	$_SESSION['prentz_cart'] = ($cart_total['nr'])? $cart_total['nr']:0 ;
            

	echo json_encode($json);
}
if(isset($func) && $func=="cart_remove")
{
	$json=array();
	
		// Remove
	if (isset($_POST['key']))
	 {
		$shopcart->removeCart($_POST['key']);	
		$json['success'] = "successfully updated";		
	}else
	{
		$json['error'] = "Somthing was wrong";
	}	
	$cart_total= $shopcart->getTotalAmount();
	$json['cart_display']='<i class="fa fa-shopping-cart" aria-hidden="true"></i> Your cart contain '. $cart_total['nr'] .' item(s),Initial amount payable ₹ '. $cart_total['total_payout'];

	$json['cart_number']=($cart_total['nr'])? $cart_total['nr']:0 ;
	$_SESSION['prentz_cart'] = ($cart_total['nr'])? $cart_total['nr']:0 ;
            

	echo json_encode($json);
}
if(isset($func) && $func=="cart_add")
{
	
	$json=array();

		if (isset($_POST['product_id'])) {
			$product_id = (int)$_POST['product_id'];
		} else {
			$product_id = 0;
		}
		
		if (isset($_POST['quantity'])) {
			$quantity = (int)$_POST['quantity'];
		} else {
			$quantity = 1;
		}

		if (isset($_POST['option'])) {
			$option = $_POST['option'];
		} else {
			$option = '';
		}
		
       if (isset($_POST['rent_days'])) {
			$rent_days = $_POST['rent_days'];
		} else {
			$rent_days = '';
		}
		
		$product_info = $conn->select_query(PRODUCT,"*", "p_id = '".$product_id."' AND p_status = 'Y'", "1");

		if (!$product_info['nr']) {
			$json['error']="Product is Not Avaliable";
		} /*else {
			if(empty($option)){
				$json['error_option']="Please select the rental plan";
			}
		}*/

		if (!$json) {
			$shopcart->addCart($product_id, $quantity, $option,$rent_days);

			$json['success'] = "Product successfully Added in Cart";
			$cart_total= $shopcart->getTotalAmount();
			$json['cart_display']='<i class="fa fa-shopping-cart" aria-hidden="true"></i> Your cart contain '. $cart_total['nr'] ." item(s),Initial amount payable ₹ ". $cart_total['total_payout'];

			$json['cart_number']=($cart_total['nr'])? $cart_total['nr']:0 ;
			$_SESSION['prentz_cart'] = ($cart_total['nr'])? $cart_total['nr']:0 ;
				
		} else {
			$json['redirect'] = str_replace('&amp;', '&', SITE_URL.'product-detail/'.$product_info['p_slug'].'.html');
		}

	echo json_encode($json);
}
if(isset($func) && $func=="monthreloadcart")
{
$selmonth=$_REQUEST['monthval'];
$cartid=$_REQUEST['cartid'];

$cart_info = $conn->select_query(CART,"*", "cart_id = '".$cartid."' AND product_id != ''", "1");

 $product_detail = $conn->select_query(PRODUCTPRICE,"*", "pp_product_id = '".$cart_info['product_id']."'  AND pp_location_id= '".$_COOKIE["current_location"]."'", "1");
 
   $tax = $conn->select_query(TAX,"*", "tax_id = '".$product_detail['pp_taxes']."' AND tax_status = 'Y'", "1");
   
   $taxper=$tax['tax_percentage']+100;
					
 $tax_amount1 = ($product_detail['pp_price_3_month'] / $taxper)*100; 
 $tax_amount2 = ($product_detail['pp_price_6_month'] / $taxper)*100; 
 $tax_amount3= ($product_detail['pp_price_9_month'] / $taxper)*100 ; 
 $tax_amount4 = ($product_detail['pp_price_12_month'] / $taxper)*100; 
 
 switch ($selmonth)
 {
	                             /*  case "1":$ajaxamnt=round(($product_detail['pp_price_3_month'] + $tax_amount1), 2);
								    $prodamnt=round(($product_detail['pp_price_3_month']), 2);
									$taxval=$tax_amount1;
									break;
									case "2":$ajaxamnt=round(($product_detail['pp_price_6_month'] + $tax_amount2), 2);
									$prodamnt=round(($product_detail['pp_price_6_month']), 2);
									$taxval=$tax_amount2;
									break;
									case "3":$ajaxamnt=round(($product_detail['pp_price_9_month'] + $tax_amount3), 2);
									$prodamnt=round(($product_detail['pp_price_9_month']), 2);
									$taxval=$tax_amount3;
									break;
									case "12":$ajaxamnt=round(($product_detail['pp_price_12_month'] + $tax_amount4), 2);
									$prodamnt=round(($product_detail['pp_price_12_month']), 2);
									$taxval=$tax_amount4;
									break;*/
									
									  case "1":$ajaxamnt=round(($product_detail['pp_price_3_month'] ), 2);
								    $taxval=round(($product_detail['pp_price_3_month'] - $tax_amount1), 2);
									$prodamnt=round($tax_amount1,2);
									break;
									case "2":$ajaxamnt=round(($product_detail['pp_price_6_month']), 2);
									$taxval=round(($product_detail['pp_price_6_month'] - $tax_amount2), 2);
									$prodamnt=round($tax_amount2,2);
									break;
									case "3":$ajaxamnt=round(($product_detail['pp_price_9_month']), 2);
									$taxval=round(($product_detail['pp_price_9_month'] - $tax_amount3), 2);
									$prodamnt=round($tax_amount3,2);
									break;
									case "12":$ajaxamnt=round(($product_detail['pp_price_12_month']), 2);
									$taxval=round(($product_detail['pp_price_12_month'] - $tax_amount4), 2);
									$prodamnt=round($tax_amount4,2);
									break;
									
 }
 $json['totalamnt']=$ajaxamnt;
 $json['prodamnt']=$prodamnt;
 $json['tax']=$taxval;
echo json_encode($json);
 exit;
}

if(isset($func) && $func=="monthreload")
{
$selmonth=$_REQUEST['monthval'];
$product_id=$_REQUEST['prod'];


 $product_detail = $conn->select_query(PRODUCTPRICE,"*", "pp_product_id = '".$product_id."'  AND pp_location_id= '".$_COOKIE["current_location"]."'", "1");
   $tax = $conn->select_query(TAX,"*", "tax_id = '".$product_detail['pp_taxes']."' AND tax_status = 'Y'", "1");
   
  $taxper=$tax['tax_percentage']+100;
					
 $tax_amount1 = ($product_detail['pp_price_3_month'] / $taxper)*100; 
 $tax_amount2 = ($product_detail['pp_price_6_month'] / $taxper)*100; 
 $tax_amount3= ($product_detail['pp_price_9_month'] / $taxper)*100 ; 
 $tax_amount4 = ($product_detail['pp_price_12_month'] / $taxper)*100; 
 
 switch ($selmonth)
 {
	                              /* case "1":$ajaxamnt=round(($product_detail['pp_price_3_month'] + $tax_amount1), 2);
								    $prodamnt=round(($product_detail['pp_price_3_month']), 2);
									$taxval=$tax_amount1;
									break;
									case "2":$ajaxamnt=round(($product_detail['pp_price_6_month'] + $tax_amount2), 2);
									$prodamnt=round(($product_detail['pp_price_6_month']), 2);
									$taxval=$tax_amount2;
									break;
									case "3":$ajaxamnt=round(($product_detail['pp_price_9_month'] + $tax_amount3), 2);
									$prodamnt=round(($product_detail['pp_price_9_month']), 2);
									$taxval=$tax_amount3;
									break;
									case "12":$ajaxamnt=round(($product_detail['pp_price_12_month'] + $tax_amount4), 2);
									$prodamnt=round(($product_detail['pp_price_12_month']), 2);
									$taxval=$tax_amount4;
									break;*/
									 case "1":$ajaxamnt=round(($product_detail['pp_price_3_month'] ), 2);
								    $taxval=round(($product_detail['pp_price_3_month'] - $tax_amount1), 2);
									$prodamnt=round($tax_amount1,2);
									break;
									case "2":$ajaxamnt=round(($product_detail['pp_price_6_month'] ), 2);
									$taxval=round(($product_detail['pp_price_6_month'] - $tax_amount2), 2);
									$prodamnt=round($tax_amount2,2);
									break;
									case "3":$ajaxamnt=round(($product_detail['pp_price_9_month'] ), 2);
									$taxval=round(($product_detail['pp_price_9_month'] - $tax_amount3), 2);
									$prodamnt=round($tax_amount3,2);
									break;
									case "12":$ajaxamnt=round(($product_detail['pp_price_12_month']), 2);
									$taxval=round(($product_detail['pp_price_12_month'] - $tax_amount4), 2);
									$prodamnt=round($tax_amount4,2);
									break;
									
 }
 $json['totalamnt']=$ajaxamnt;
 $json['prodamnt']=$prodamnt;
 $json['tax']=$taxval;
echo json_encode($json);
 exit;
}

//clear cart

if(isset($func) && $func=="cart_clear")
{
		   $cart_chk = $conn->select_query(CART, "*", "customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "'", '');
	   
	  if($cart_chk)
	   {
		   foreach ($cart_chk['result'] as $rescart) {  
		                
                   // $this->db->delete_query(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'"); 
				 //  $new = array( 'customer_id' => 0);
					 //$this->db->update(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'", $new); 
					  $conn->delete_query(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'"); 
 
                }
				unset($_SESSION['prentz_cart']);
			$json['success']=1;	
	   }
	echo json_encode($json);
 exit;
}
?>
