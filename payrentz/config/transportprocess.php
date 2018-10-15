<?php
  require_once('config.php');
  @$transportdate = $_POST['transportdate'];
  @$transport_amount = $_POST['transport_amount'];
  @$transport_remark = $_POST['transport_remark'];
  @$driverid = $_POST['driverid'];
  @$license = $_POST['license'];
  @$validtill = $_POST['validtill'];
  @$transport_product = $_POST['transport_product'];
  @$transportcustome_id = $_POST['transportcustome_id'];
  $result = count($transportcustome_id);
  $costforper = $transport_amount / $result;
  for($i=0;$i<$result;$i++)
  {
  	$Insert_data = array('customer_id' => $transport_product[$i],'product_id' => $transportcustome_id[$i],'transfer_date' =>$transportdate,'amount_spent'=>$costforper,'remarks'=>$transport_remark,'driver_id' =>$driverid,'license_no' => $license,'valid_till' =>$validtill);
  	$table_name='transport_expenses';
  	$insertData = $functs->insertFn($table_name,$Insert_data);

  	$extra="SELECT pending_cost from customer_general_detail where customer_id= '".$transport_product[$i]."'";
  	$extradata = $functs->get_extra($extra);
    if(sizeof($extradata)>0){
      $extra_amount = $extradata[0]["pending_cost"];
    }
    else{
      $extra_amount =0;
    }

  	$extra_amount = $extra_amount + $costforper;

  	$update = array('pending_cost' => $extra_amount );
  	$where_clause = array('customer_id'=> $transport_product[$i]);
  	$updated = $functs->updateTableFn($update, $where_clause,'customer_general_detail');
    $update = array('delivery_status' =>'1' );
  	$where_clause = array('product_id' => $transport_product[$i]);
  	$updated = $functs->updateTableFn($update, $where_clause,'mapping_table');
  }
?>
