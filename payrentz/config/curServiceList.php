<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  $serviceList = $functs->curserviceListFn();
  $total_length =count($serviceList);
  
   
   
  $output = array('data' => array());
  for ($x = 0; $x < $total_length; $x++) 
  {
          $getser = $functs->getserFn($serviceList[$x] ['product_id'],$serviceList[$x] ['customer_id']);
		 
		  $output['data'][] = array($serviceList[$x] ['product_id'],$serviceList[$x] ['product_id'],$serviceList[$x] ['customer_id'],$getser[0]['service_applied_date'],$getser[0]['issue_type'],'<a data-toggle="modal" data-target="#serviceclosemodal" style="cursor:pointer" onclick="closeservice(\''. $serviceList[$x] ["product_id"] .'\')">close</a>');  
				
  }
	
	 
  




echo json_encode($output);
 
?>