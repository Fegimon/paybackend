<?php
 require_once('config.php'); 
 session_start();
 $city = $_SESSION['city'] ;

 @$r_id= $_POST['removeId'];
 @$r_type = $_POST['removeType'];
 if($r_type === 'customer')
 {
   $isMapped = $functs->mapvalid($r_id);
   
   if(count($isMapped) > 0)
   {
	echo 'e';  
   }
   else 
   {
	$isMd = $functs->mapd($r_id);
    if(count($isMd) > 0)
	{
	 echo 'm'; 	
	}
    else
    {
	   echo $r_id; 
    }	   
	
   }		
  
 }
   $currentdata = date('Y-m-d');
   $m=date("m",strtotime($currentdata));
   $y=date("y",strtotime($currentdata));
  if($r_type === 'closecus')
 {
         $update_data = array('remove_type' =>1,'close_month'=>$m,'close_year'=>$y,'closed_on'=>$currentdata);
		 $where_con = array('customer_id' =>$r_id);
         $table_name='customer_general_detail';
         $functs->updateTableFn($update_data,$where_con,$table_name);	
  
 }
 
  if($r_type === 'movecus')
 {
   	 $update_data = array('remove_type' =>0);
		 $where_con = array('customer_id' =>$r_id);
         $table_name='customer_general_detail';
         $functs->updateTableFn($update_data,$where_con,$table_name);	
  
 }
 
  if($r_type === 'enquiry')
 {
   $recivedAmt = $functs->amountRecivedCheck($r_id);  
   if($recivedAmt > 0)
   {
	echo 'e';  
   }
   else 
   {
	 echo 'm'; 	
   }		
  
 }
 
  if($r_type === 'removeEnq')
 {
         $update_data = array('is_closed' =>1);
		 $where_con = array('enquiry_id' =>$r_id);
         $table_name='enquiries';
         $functs->updateTableFn($update_data,$where_con,$table_name);	
  
 }
 
 
?>