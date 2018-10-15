<?php
 require_once('config.php'); 
 session_start();
$city = $_SESSION['city'] ;
$customer = $functs->getNonCustomerList($city);

echo json_encode($customer);
 
?>