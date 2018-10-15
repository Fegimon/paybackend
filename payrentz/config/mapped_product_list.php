<?php
 require_once('config.php'); 
 session_start();
$city = $_SESSION['city'] ;
$mapped = $functs->getMappedListFn($city);

echo json_encode($mapped);
 
?>