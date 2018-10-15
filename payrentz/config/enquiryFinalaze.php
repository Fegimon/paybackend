<?php
 require_once('config.php'); 
 session_start();
$city = $_SESSION['city'] ;
@$a_type = $_POST['a_type'];
@$id = $_POST['id'];
@$cost = $_POST['cost'];
@$cost_type = $_POST['cost_type'];
@$c_id = $_POST['c_id'];


if($a_type =='approve')
{
	     $update_data = array('enquiry_status' => 1);
		 $where_con = array('enquiry_id' =>$id);
         $table_name='enquiries';
         $functs->updateTableFn($update_data,$where_con,$table_name);
		 $costEx = $functs->getPenExt($cost_type,$c_id);
		 $total_cost = $costEx+$cost;
		 $update_data = array($cost_type =>$total_cost);
		 $where_con = array('customer_id' =>$c_id);
         $table_name='customer_general_detail';
         $functs->updateTableFn($update_data,$where_con,$table_name); 
		
}
if($a_type =='reject')
{
	
}
if($a_type =='close')
{
	
}
//$customer = $functs->getCustomerList($city);

//echo json_encode();
 
?>