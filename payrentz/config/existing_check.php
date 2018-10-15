<?php
 
 require_once('config.php'); 
 
 @$value = $_POST['value'];
 @$type = $_POST['type'];
 
 
 $checkList = $functs->getCheckList($value,$type);

 echo json_encode($checkList);
?>