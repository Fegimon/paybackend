<?php
 
 require_once('config.php'); 
 

$pendlist = $functs->pendingListFn();

echo json_encode($pendlist);
?>