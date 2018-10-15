<?php
 require_once('config.php'); 
$customer = $functs->re_list();

echo json_encode($customer);
 
?>