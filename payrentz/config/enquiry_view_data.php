<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  @$e_id = $_POST['e_id'];
  

  $singleEnquiryGenData = $functs->singleEnquiryGenDataFn($e_id);
  $customerType = $singleEnquiryGenData["customer_status"];
  
  //data for New customer
  if($customerType ==1)
  {
	 $c_id = $e_id;
	 $getEnqCusDetail = $functs->getEnqCusDetailFn($c_id,$customerType);
	 $getEnqCusConDetail = $functs->getEnqCusConDetailFn($c_id,$customerType);
	
	 
  }
  
  //data for existing customer
  else
  {
	  $c_id = $singleEnquiryGenData["customer_id"];
	  $getEnqCusDetail = $functs->getEnqCusDetailFn($c_id,$customerType);
	  $getEnqCusConDetail = $functs->getEnqCusConDetailFn($c_id,$customerType);
	  
  }
  
  //enquiry product detail
  $getProductDetails      = $functs-> getProductDetailsfn($e_id);
  //$particularCusGenDetail = $functs-> particularCusGenDetailFn($c_id,$customerType);
 // $particularCusConDetail = $functs-> particularCusConDetailFn($c_id,$customerType);
 // $particularCusAddDetail = $functs-> particularCusAddDetailFn($c_id,$customerType);

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
  $output["email"]         = $getEnqCusDetail['email'];
  $output["e_poduct"]      = $getProductDetails;

  echo json_encode($output);
 
?>