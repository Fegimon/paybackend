<?php
 require_once('config.php'); 
 
   //Get static Data 
  

  
  //save enquiry data
 $generatedEnqiryId = $_POST['e_id'];
 $e_cus_id = $_POST['e_cus_id'];
  //Dynamic Data
 @$e_var = $_POST['e_var'];
 @$e_quan = $_POST['e_quan'];
 @$e_delivery = $_POST['e_delivery'];
 @$e_rent = $_POST['e_rent'];
 @$e_tenure = $_POST['e_tenure'];
 @$e_rent_cost = $_POST['e_rent_cost'];
 @$e_security = $_POST['e_security'];
 @$e_pro_fee = $_POST['e_pro_fee'];
 @$e_ins_fee = $_POST['e_ins_fee'];
 
 $var_count =count($e_var);
 $functs->deleteEquiryProduct($generatedEnqiryId);
 $t_s_amount =0 ;
 $t_p_amount =0 ;
 $t_i_amount =0 ;
 
 for ($x = 0; $x < $var_count; $x++) 
 {
	 
  //Get variant amount  
  $t_s_amount +=$e_security[$x]*$e_quan[$x];
  $t_p_amount += $e_pro_fee[$x]*$e_quan[$x];
  $t_i_amount += $e_ins_fee[$x]*$e_quan[$x];
  
  //save enquiry product
  $values = array('enquiry_id' => $generatedEnqiryId,'customer_id' => $e_cus_id,'ptdvar_id' => $e_var[$x],'quantity' => $e_quan[$x],'expecting_delivery_date' => $e_delivery[$x],'rent_per_month' => $e_rent_cost[$x],'security_deposit_amount' =>$e_security[$x] ,'rent_months_count' =>$e_rent[$x],'tenure' =>$e_tenure[$x],'processing_fee' => $e_pro_fee[$x],'ins_fee' =>$e_ins_fee[$x]);
  $storeBase = 'enquiry_products';
  $functs->insertFn($storeBase,$values); 

  
 }   
         $total_amount=$t_s_amount+$t_p_amount+$t_i_amount;
         $update_data = array('total_security_amount' =>$t_s_amount,'total_processing_fee' =>$t_p_amount,'t_installation_fee' =>$t_i_amount,'total_amount'=>$total_amount);
		 $where_con = array('enquiry_id' =>$generatedEnqiryId);
         $table_name='enquiries';
         $functs->updateTableFn($update_data,$where_con,$table_name);
         		 



 
 
 header('Location: ../enquiry-view.php');
?>