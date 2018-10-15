<?php
 require_once('config.php'); 
 
 @$type = $_POST['type']; 
 switch ($type) {
	 
    case "transportexpanse":
	$customer = $functs->transporttableid();
	echo json_encode($customer);
	break;
	
	case "servicerequest":
	$customer = $functs->servicerequest();
	echo json_encode($customer);
	break;
 }
 

 
?>