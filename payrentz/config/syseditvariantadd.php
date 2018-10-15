<?php
 require_once('config.php');  
 			@$editvariantid = $_POST['editvariantid'];   			 
			@$editstatusvariant = $_POST['editstatusvariant'];			
			@$editverantdesct = $_POST['editverantdesct'];
			@$editverantcode = $_POST['editverantcode'];
			@$editvariantname = $_POST['editvariantname'];
			
			@$rendcost = $_POST['rendcost'];			
			@$depositeamt = $_POST['depositeamt'];   			 
			@$processingfees = $_POST['processingfees'];
			@$insfees = $_POST['insfees'];
			@$othersfees = $_POST['othersfees'];
			@$tenure = $_POST['tenure'];
			
			
				if($editstatusvariant == 'Active')
				{
					@$editstatusvariant = 1;
				}
				else
				{
					@$editstatusvariant = 0;					
				}
				
			$result = count($tenure);	
			
			$update = array('name' => $editvariantname,'description' => $editverantdesct,'status' => $editstatusvariant);		
			$where_clause = array('ptdvar_id'=> $editvariantid );
			$updated = $functs->update('product_variant', $update, $where_clause);					
			
			$query6="SELECT * FROM product_variant_cost where ptdvar_id='$editvariantid'";
			$numofclr = $functs->num_rows( $query6 );
			
			for($i=0;$i<$numofclr;$i++)
			{
				$delete1 = array('ptdvar_id' => $editvariantid);
				$deleted1 = $functs->delete( 'product_variant_cost', $delete1, 1 );
			}
			
			for($i=0;$i<$result;$i++)
			{							
				$Insert_data1 = array('ptdvar_id' => $editvariantid ,'rent_cost' => $rendcost[$i],'security_deposit_price' => $depositeamt[$i],
				'processing_fee' =>$processingfees[$i],'ins_fee'=>$insfees[$i],'other_fee'=>$othersfees[$i],'tenure' =>$tenure[$i]);	
    			$table_name1='product_variant_cost';
				$insertData = $functs->insertFn($table_name1,$Insert_data1);
			}



 ?>