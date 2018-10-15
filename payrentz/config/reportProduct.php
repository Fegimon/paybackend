<?php
 require_once('config.php'); 
 session_start();
  $city = $_SESSION['city'] ;
  @$p_id = $_POST['p_id'];
  

  $productGeneralDetail = $functs->productGeneralDetailFn($p_id);
  $productCount         = $functs->productCountFn($p_id);
  $MappedHistory        = $functs->MappedHistoryFn($p_id);
  $rentHistory          = $functs->rentHistoryFn($p_id);
  $serviceHistory       = $functs->serviceHistoryFn($p_id);
  $generalHistory       = $functs->generalHistoryFn($p_id);
  $transportHistory     = $functs->tranportHistoryFn($p_id);

  

  $output = [];
  $output["general"]            = $productGeneralDetail;
  $output["productCount"]       = $productCount;
  $output["MappedHistory"]      = $MappedHistory;
  $output["rentHistory"]        = $rentHistory;
  $output["serviceHistory"]     = $serviceHistory;
  $output["generalHistory"]     = $generalHistory;
  $output["transportHistory"]   = $transportHistory;
  echo json_encode($output);
 
?>