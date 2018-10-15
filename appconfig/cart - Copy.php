<?php
class Cart  //create a class for make connection
{    
	//public $a;

	public function __construct($App){	
	
		$this->db = new createConnection($App); 
		
        // Remove all the expired carts with no customer ID
        
        $cond=" customer_id = '0' AND date_added < DATE_SUB(NOW(), INTERVAL 1 HOUR) ";
        $this->db->delete_query(CART, $cond); 

        if ($_SESSION['prentz_user_id']) {
            // We want to change the session ID on all the old items in the customers cart
            if(!$_POST){
               /* echo "<script>alert('hi');</script>";*/
           
                $new = array('session_id' =>  session_id());
                $cond=" customer_id = '" . (int)$_SESSION['prentz_user_id'] . "'";
                $this->db->update(CART, $cond, $new);   
             
                // Once the customer is logged in we want to update the customers cart
               
                $cart_query = $this->db->select_query(CART,"*", "customer_id = '0' AND session_id = '" . session_id() . "'");
             //   print_r($cart_query); exit;
                foreach ($cart_query['result'] as $cart) {               
                    $this->db->delete_query(CART, "cart_id = '" . (int)$cart['cart_id'] . "'"); 

                    // The advantage of using $this->add is that it will check if the products already exist and increaser the quantity if necessary.
                    $this->addCart($cart['product_id'], $cart['quantity'], $cart['option_cart']);
                  //  echo $cart['cart_id']; 
                }
                //exit;
            }
        }
    }

    public function getProducts(){
    	$product_data = array();
        //echo session_id(); exit;
    	$cart_query = $this->db->select_query(CART,"*", "customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "'");
    	
    	if($cart_query['nr']){
    		foreach ($cart_query['result'] as $cart) {
    			$cond="p.p_status='Y' AND pp.pp_location_id='".$_COOKIE["current_location"]."'";
  				$cond .=" AND p.p_id = '".$cart['product_id']."'";
    			$product_query = $this->db->select_query(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) LEFT JOIN ".TAX." t ON(t.tax_id=pp.pp_taxes)","*",$cond,"1");
    			//print_r($product_query);
    			if ($product_query['nr'] && ($cart['quantity'] > 0)) {
    				//echo "<pre>"; print_r($product_query); exit;
                    $tax_amount = ($product_query['ps_price_month']) * ($product_query['tax_percentage']/100);
                    $price = $product_query['ps_price_month'] + $tax_amount;
                   // echo $price;
                    $product_data[] = array(
                    'cart_id'         => $cart['cart_id'],
                    'product_id'      => $product_query['p_id'],
                    'name'            => $product_query['p_name'],
                    'slug'            => $product_query['p_slug'],
                    'image'           => $product_query['p_image'],                                      
                    'quantity'        => $cart['quantity'],
                    'option'        => $cart['option_cart'],
                    'security_deposit'  => $product_query['pp_security_deposit'],
                    'handling_charge'   => $product_query['pp_handling_charge'],                    
                    'price_month'       => $product_query['ps_price_month'],
                   // 'price'           => round((($price) * $cart['quantity']), 2),
                     'price'           => round($price, 2),
                    //'total'          => $product_query['pp_security_deposit'] + $product_query['pp_handling_charge'], 
                   // 'total'          => round( $product_query['pp_security_deposit'], 2 ) ,  
                    'total'          => round( ($product_query['pp_security_deposit'] * $cart['quantity']), 2 ) ,                
                    'tax_id'    => $product_query['tax_id']                  
                );
    			} else {
                    $this->removeCart($cart['cart_id']);
                }
    		}
    	}
    	
    	//exit;
        return $product_data;
    }

    public function getTotalAmount(){
        $product_details=$this->getProducts();
        $total['nr']=0;
        $total['total_deposit']=0;
        $total['handling_charge']=0;
        $total['total_payout']=0;
        $total['total_rent']=0;
        if(!empty($product_details)){
            foreach ($product_details as $product) {
                $total['total_deposit']=$total['total_deposit'] + ($product['security_deposit'] * $product['quantity']);
                $total['handling_charge']=$total['handling_charge'] + ($product['handling_charge'] * $product['quantity']);
                $total['total_payout']=$total['handling_charge'] + $total['total_deposit'];
                $total['total_rent']=round(($total['total_rent']+$product['price']), 2 );
            }

            $total['nr']=count($product_details);
        }

        return $total;
    }

    public function addCart($product_id, $quantity = 1, $option) {
       
	   $cart_chk = $this->db->select_query(CART, "*", "customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "'", '');
	   
	   if($cart_chk)
	   {
		   foreach ($cart_chk['result'] as $rescart) {  
		                
                   // $this->db->delete_query(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'"); 
				  /* $new = array( 'customer_id' => 0);
					 $this->db->update(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'", $new); */ 
					  $this->db->delete_query(CART, "cart_id = '" . (int)$rescart['cart_id'] . "'"); 
 
                }
	   }
		
        $query = $this->db->select_query(CART,"COUNT(*) AS total", "customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "' AND product_id = '" . (int)$product_id . "'", "1");

        $cart_query = $this->db->select_query(CART, "*", "customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "' AND product_id = '" . (int)$product_id . "'", '1');
       // print_r($query); 
        //exit;
        if (!$query['total']) {
           // echo "if"; exit;
            $new = array( 'customer_id' => (int)$_SESSION['prentz_user_id'], 'session_id' => session_id(), 'product_id' => (int)$product_id, 'quantity'=>$quantity, 'option_cart'=>$option, 'date_added'=>NOW);
                            
                $ins = $this->db->insert(CART, "", $new);
				//print_r($ins);exit;
        } else {
          //  echo "else"; exit;
            $new = array('quantity'=>$cart_query['quantity']+$quantity);
            $cond=" customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "' AND product_id = '" . (int)$product_id . "'";
           $this->db->update(CART, $cond, $new);  
        }
    }

    public function updateCart($cart_id, $quantity='', $option=''){ // echo "hi"; exit;     
        if(!empty($quantity)){
            $new = array('quantity'=>$quantity);
        }
        if(!empty($option)){
            $new = array('option_cart'=>$option);
        }
        $cond=" cart_id = '" . (int)$cart_id . "' AND customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "' ";
        $this->db->update(CART, $cond, $new);    
    }

    public function removeCart($cart_id) {
       
        $cond=" cart_id = '" . (int)$cart_id . "' AND customer_id = '" . (int)$_SESSION['prentz_user_id'] . "' AND session_id = '" . session_id() . "' ";
        $this->db->delete_query(CART, $cond); 
    }

    public function hasProducts() {
        return count($this->getProducts());
    }

    public function customerDetails() {
        if ($_SESSION['prentz_user_id']) { 

            $cus_query = $this->db->select_query(USER, "*", "user_id = '" . (int)$_SESSION['prentz_user_id'] . "'", '1');
            if($cus_query['nr']){
                return $cus_query;
            } else {
                return false;
            }
        }else {
            return false;
        }
    }
	
}
