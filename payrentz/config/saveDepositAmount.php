<?php
 require_once('config.php'); 

 @$p_e_id       = $_POST['p_e_id'];
 @$p_cus_id     = $_POST['p_cus_id'];
 @$p_rec_amount = $_POST['p_rec_amount'];   			 
 @$pay_rec_on   = $_POST['pay_rec_on'];
 @$pay_mode     = $_POST['pay_mode'];   			 
 @$p_collect_on = $_POST['p_collect_on'];
 @$p_collect_by = $_POST['p_collect_by'];   			 
 @$p_deposit_on = $_POST['p_deposit_on'];
 @$p_deposit_by = $_POST['p_deposit_by'];
 @$p_r_amount   = $_POST['p_r_amount'];
 @$t_cost       = $p_rec_amount+$p_r_amount;
 
 
 $Insert_data = array('enquiry_id' => $p_e_id,'customer_id' => $p_cus_id,'reiceved_amount' => $p_rec_amount,'amount_reiceved_on'=>$pay_rec_on,'payment_mode' =>$pay_mode,'collected_on'=>$p_collect_on,'collected_by'=>$p_collect_by,'deposit_by' =>$p_deposit_by,'deposit_on' => $p_deposit_on);	
 $table_name='deposit_money_transaction';
 $insertData = $functs->insertFn($table_name,$Insert_data); 
         $update_data = array('amount_received_from_customer' => $t_cost);
		 $where_con = array('enquiry_id' => $p_e_id);
         $table_name='enquiries';
         $functs->updateTableFn($update_data,$where_con,$table_name); 
 
 ?>