<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  @$c_id = $_POST['c_id'];
  

  $getMappedData = $functs->getMappedDataFn($c_id);
  
 

  echo json_encode($getMappedData);
 
?>