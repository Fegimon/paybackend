<?php
 
 require_once('config.php'); 
 
 @$value = $_POST['value'];  
 
 $getcustomername = $functs->getcustomername($value);

 echo json_encode($getcustomername);
?>