<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  @$id = $_POST['id'];
  $productList = $functs->getProductParVariantFn($id);
  $product_no = count($productList);
   $li_product = array();
  for ($x = 0; $x < $product_no; $x++)
   {   
    $p_id = $functs->liveproductFn($productList[$x]["product_id"]);

	if(count($p_id)>0)
	{
	
	}
	else
	{
	$li_product [] = $productList[$x];
	
	}

   } 
echo json_encode($li_product);
?>