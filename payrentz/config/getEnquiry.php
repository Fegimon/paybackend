<?php
require_once('config.php'); 
@$i_type = $_POST['i_type'];
 if($i_type =='mobile' || $i_type =='c_id')
 {
 @$value = $_POST['value'];
 
 $EnquiryGetCustomer = $functs->enquiryGetCustomerFn($value,$i_type);
 $Enqexit = $functs->Enqexitfn($EnquiryGetCustomer[0]["customer_id"]);
 $EnquiryGetCustomer[0] ["enq"] =$Enqexit ;
 echo json_encode($EnquiryGetCustomer); 
 }
  if($i_type =='p_cat')
 {
 $enquiryProductCategory = $functs->enquiryProductCategory();
 echo json_encode($enquiryProductCategory); 
 }
 
 if($i_type =='variant')
 {
	 @$cat_id = $_POST['cat_id'];
 $enquiryVariant = $functs->enquiryVariantFn($cat_id);
 echo json_encode($enquiryVariant); 
 }
 
 if($i_type =='variantcost')
 {
	 @$var_id = $_POST['var_id'];
 $enquiryVariant = $functs->getVariantAmountFn($var_id);
 echo json_encode($enquiryVariant); 
 }
 
 if($i_type =='tenurecost')
 {
	 
	 
	 @$ten = $_POST['ten'];
	 @$p_var_id = $_POST['p_var_id'];
    
	 for($ind=$ten;$ind > 0;$ind-=1) {
      $getTenureCost = $functs->getTenureCostFn($p_var_id,$ind);
	   if (empty($getTenureCost)) 
	  {
		  
          
      }
	   else
	  {
		 echo json_encode($getTenureCost[0]); 
		 exit;
	  }
     }
	 
	 
	 
    
 }
 
 
 if($i_type =='emp')
 {
  $empList = $functs->empListfn();
 
  echo json_encode($empList);  
  
	 
 }
 
  if($i_type =='payHistory')
 {
  @$e_id = $_POST['e_id'];
  $payHistory = $functs->payHistoryFn($e_id);
 
  echo json_encode($payHistory);
     
 }
 
 ?>