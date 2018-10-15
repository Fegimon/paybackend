<?php
 require_once('config.php'); 
 session_start();
 @$pro      = $_POST['pro'];
 @$cus      = $_POST['cus'];
 @$r_date   = $_POST['r_date'];
 @$r_remark = $_POST['r_remark']; 

 
 $update_data = array('return_date' =>$r_date,'return_remark' =>$r_remark,'is_returned'=>1);
 $where_con   = array('customer_id' =>$cus,'product_id' =>$pro,'is_closure'=>0);
 $table_name  = 'mapping_table';
 $functs->updateTableFn($update_data,$where_con,$table_name);
  echo json_encode($output);
 
?>