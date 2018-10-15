<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  @$e_id = $_POST['e_id'];
  

  $verifiedDataMap = $functs->verifiedDataMapFn($e_id);
 
  
  
 

  echo json_encode($verifiedDataMap);
 
?>