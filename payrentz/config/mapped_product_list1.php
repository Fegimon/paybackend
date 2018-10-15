<?php
 require_once('config.php'); 
 session_start();
$city = $_SESSION['city'] ;
$mapped = $functs->getMappedListFnR($city);

echo json_encode($mapped);
 
?>