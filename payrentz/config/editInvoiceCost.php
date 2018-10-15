<?php
 require_once('config.php'); 
 //print_r($_POST);
 
 			@$t_rent_cost = $_POST['t_rent_cost'];   			 
			@$l_pay_charge = $_POST['l_pay_charge'];
			@$tax = $_POST['tax'];   			 
			@$p_amonunt = $_POST['p_amonunt'];
			@$e_cost = $_POST['e_cost'];
			@$c_id = $_POST['c_id'];
			@$pending_rent_cost =($t_rent_cost+$tax+$p_amonunt+$l_pay_charge)-$e_cost;
			
		        $update = array('total_rent_cost' =>$t_rent_cost,'tax' =>$tax,'pending_rent_cost'=> $pending_rent_cost);		
				$where_clause = array('customer_id' => $c_id);
				$updated = $functs->updateTableFn($update, $where_clause,'invoice');
				$update = array('extra_amount' =>$e_cost,'pending_cost' =>$p_amonunt,'lpc' =>$l_pay_charge);		
				$where_clause = array('customer_id' => $c_id);
				$updated = $functs->updateTableFn($update, $where_clause,'customer_general_detail');
				

				 ?>