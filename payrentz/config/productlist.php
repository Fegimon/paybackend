<?php
 require_once('config.php'); 
$customer = $functs->getproductList();

echo json_encode($customer);
 
?>