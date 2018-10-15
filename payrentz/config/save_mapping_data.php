<?php
 require_once('config.php');
$getTaxPer = $functs->getTaxPercenTax(0);	   	   	   	   
	  
	  $e_rent_cost[$x] =  $e_rent_cost[$x] - ($e_rent_cost[$x] * ($getTaxPer[0]/100));
 @$e_id = $_POST['e_id'];
 @$e_cus_id = $_POST['e_cus_id'];
 @$e_product = $_POST['e_product'];
 @$e_delivery = $_POST['e_delivery'];
 @$e_deliveryon = $_POST['e_deliveryon'];
 @$e_install = $_POST['e_install'];
 @$e_rent = $_POST['e_rent'];

 @$e_rent_cost = $_POST['e_rent_cost'];      
 @$e_security = $_POST['e_security'];
 @$e_pro_fee = $_POST['e_pro_fee'];
 @$e_ins_fee = $_POST['e_ins_fee'];
   $delete_where = array('enquiry_id' => $e_id);
   $table_name='mapping_table';
   $functs->deletefn($delete_where,$table_name);
   $update_data = array('is_mapped' => 1);
   $where_con = array( 'enquiry_id' => $e_id);
   $table_name='enquiries';
   $functs->updateTableFn($update_data,$where_con,$table_name);
  $pr_count  = count(@$e_product);
  for($x = 0; $x <$pr_count ; $x++)
  {
	  
	  $getTaxPer = $functs->getTaxPercenTax($e_product[$x]);
	  //print_r($getTaxPer[0]["gst"]);
	  
	  $e_rent_cost[$x] =  $e_rent_cost[$x] - ($e_rent_cost[$x] * ($getTaxPer[0]["gst"]/100));
	  
	 
	  
	  
    if($e_product[$x] =='11aaa' || empty($e_deliveryon[$x])|| empty($e_install[$x])|| empty($e_rent[$x]))
    {
	     $st=0;
     }
     else
     {
	      $st=1;
        $update_data = array('prtd_location' => 0);
        $where_con = array( 'product_id' => $e_product[$x]);
        $table_name='product';
        $functs->updateTableFn($update_data,$where_con,$table_name);
      }	  	  
	  
	  
      $Insert_data = array('enquiry_id' => $e_id,'customer_id'=>$e_cus_id,'product_id' => $e_product[$x],'delivery_date' =>$e_delivery[$x],'installation_date'=> $e_install[$x],'rent_on_date'=> $e_rent[$x],'delivered_at' =>$e_deliveryon[$x],'mapped_status' =>$st, 'rent_per_month'=>$e_rent_cost[$x],'actual_security_deposit_amount'=>$e_security[$x],'actual_processing_fee'=>$e_pro_fee[$x],'actual_installation_fee'=>$e_ins_fee[$x]);
      $table_name='mapping_table';
      $insertData = $functs->insertFn($table_name,$Insert_data);
   }
   header('Location: ../verifiedenquiry-view.php');
?>
