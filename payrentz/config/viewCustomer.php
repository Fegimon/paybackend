<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  @$c_id = $_POST['c_id'];
  @$c_status = $_POST['c_status'];


	 
	$particularCusGenDetail = $functs-> particularCusGenDetailFn($c_id,$c_status);
	$particularCusProDetail = $functs-> particularCusProDetailFn($c_id,$c_status);
	$particularCusConDetail = $functs-> particularCusConDetailFn($c_id,$c_status);
	$particularCusAddDetail = $functs-> particularCusAddDetailFn($c_id,$c_status);
	$particularCusRefDetail = $functs-> particularCusRefDetailFn($c_id,$c_status);
	$particularCusKycDetail = $functs-> particularCusKycDetailFn($c_id,$c_status);
	 
 
  
  //data for existing customer


  

  $output = [];
  $output["gen"]    = $particularCusGenDetail;
  $output["pro"]    = $particularCusProDetail;
  $output["con"]    = $particularCusConDetail;
  $output["ref"]    = $particularCusRefDetail;
  $output["kyc"]    = $particularCusKycDetail;
  $output["add"]    = $particularCusAddDetail;
  
  
  echo json_encode($output);
 
?>