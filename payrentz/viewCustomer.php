<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  @$c_id = $_POST['c_id'];
  @$c_status = $_POST['c_status'];

 
  
  //data for New customer
  if($c_status ==1)
  {
	 
	$particularCusGenDetail = $functs-> particularCusGenDetailFn($c_id,$c_status);
	
	 print_r($particularCusGenDetail);
	 exit;
  }
  
  //data for existing customer
  else
  {
	  $c_id = $singleEnquiryGenData["customer_id"];
	  $getEnqCusDetail = $functs->getEnqCusDetailFn($c_id,$customerType);
	  $getEnqCusConDetail = $functs->getEnqCusConDetailFn($c_id,$customerType);
	  
  }
  exit;
  //enquiry product detail
  $getProductDetails = $functs->getProductDetailsfn($e_id);
  

  $output = [];
  $output["enquiry_id"]    = $e_id;
  $output["customer_id"]   = $c_id;
  $output["att_by"]        = $singleEnquiryGenData["attended_by"];
  $output["att_to"]        = $singleEnquiryGenData["assigned_to"];
  $output["e_date"]        = $singleEnquiryGenData["enquiry_date"];
  $output["c_status"]      = $singleEnquiryGenData["customer_status"];
  $output["f_date"]        = $singleEnquiryGenData["followup_date"];
  $output["remark"]        = $singleEnquiryGenData["followup_remarks"];  
  $output["customer_name"] = $getEnqCusDetail['customer_name'];
  $output["mobile"]        = $getEnqCusConDetail['mobile'];
  $output["e_poduct"]      = $getProductDetails;
 

  echo json_encode($output);
 
?>