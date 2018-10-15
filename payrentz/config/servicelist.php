<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  $serviceList = $functs->serviceListFn();
  $total_length =count($serviceList);
  
   
   
  $output = array('data' => array());
  for ($x = 0; $x < $total_length; $x++) 
  {
	
		   
	   
          
	
		  $output['data'][] = array($serviceList[$x] ['product_id'],$serviceList[$x] ['product_id'],$serviceList[$x] ['customer_id'],'<a data-toggle="modal" data-target="#serviceinitmodal" style="cursor:pointer" onclick="initiateservice(\''. $serviceList[$x] ["product_id"] .'\',\''. $serviceList[$x] ["customer_id"] .'\')">initiate</a>');  
				
	  }
	
	 
  




echo json_encode($output);
 
?>