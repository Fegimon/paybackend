<?php
 require_once('config.php'); 
 //print_r($_POST);
 			@$subcategoryproduct = $_POST['subcategoryproduct'];   			 
			@$statusvariant = $_POST['statusvariant'];
				if($statusvariant == 'Active')
				{
					@$statusvariant = 1;
				}
				else
				{
					@$statusvariant = 0;
				}
			
			@$variantname = $_POST['variantname'];   			 
			@$verantdesct = $_POST['verantdesct'];
			@$rendcost = $_POST['rendcost'];
			@$variantcode = $_POST['variantcode'];
			@$depositeamt = $_POST['depositeamt'];   			 
			@$processingfees = $_POST['processingfees'];
			@$insfees = $_POST['insfees'];
			@$othersfees = $_POST['othersfees'];
			@$tenure = $_POST['tenure'];
			

			$Insert_data = array('ptd_sub_catgry_id' => $subcategoryproduct,'name' => $variantname,
			'description' =>$verantdesct,'status'=>$statusvariant,'variant_code' =>$variantcode);	
    		$table_name='product_variant';
			$insertData = $functs->insertFn($table_name,$Insert_data);
			$variantid= $insertData;						
			
			$result = count($tenure);
			

			for($i=0;$i<$result;$i++)
			{
				
				$Insert_data1 = array('ptdvar_id' => $variantid ,'rent_cost' => $rendcost[$i],'security_deposit_price' => $depositeamt[$i],
				'processing_fee' =>$processingfees[$i],'ins_fee'=>$insfees[$i],'other_fee'=>$othersfees[$i],'tenure' =>$tenure[$i]);	
    			$table_name1='product_variant_cost';
				$insertData = $functs->insertFn($table_name1,$Insert_data1); 
			
			}



 ?>