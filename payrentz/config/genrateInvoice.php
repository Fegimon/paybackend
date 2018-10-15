<?php

 require_once('config.php');

 $action = false;
 $t=date('d-m-Y');
 $d=date("d",strtotime($t));
 $m=date("m",strtotime($t));
 $y=date("y",strtotime($t));
 $p_m=$m-1;

 //update cost

$invoice = $functs->getInvoiceList($action);
//print_r($invoice);
 $c = count($invoice['data']);
    for ($x = 0; $x < $c; $x++)
	{
	$pen =$invoice['data'][$x][4];
	$rec =$invoice['data'][$x][1];
	$amt =$invoice['data'][$x][5];
	$t=date('d-m-Y');
    $m=date("m",strtotime($t));
    $y=date("y",strtotime($t));
//print_r($invoice['data'][$x][5]);
//exit;

	if($amt >= 0 )
	{


		$update_data = array('pending_cost' => $amt,'extra_amount'=>0,'lpc'  =>0);
        $where_con = array( 'customer_id' => $invoice['data'][$x][0]);
        $table_name='customer_general_detail';
        $functs->updateTableFn($update_data,$where_con,$table_name);
        
	    //pending history
		   $delete_where = array('month' =>$m,'year' =>$y,'customer_id' => $invoice['data'][$x][0]);
           $table_name='pending_history';
           $functs->deletefn($delete_where,$table_name);
		   $Insert_data = array('customer_id' => $invoice['data'][$x][0],'amount' => $amt,'month' =>$m,'year' =>$y);
           $table_name='pending_history';
           $insertData = $functs->insertFn($table_name,$Insert_data);

	}
	else
	{
		$amt = abs($amt);
		$update_data = array('pending_cost' => 0,'extra_amount'=>$amt,'lpc'  =>0);
        $where_con = array( 'customer_id' => $invoice['data'][$x][0]);
        $table_name='customer_general_detail';
        $functs->updateTableFn($update_data,$where_con,$table_name);

        //extra amount history
		   $delete_where = array('month' =>$m,'year' =>$y,'customer_id' => $invoice['data'][$x][0]);
           $table_name='extra_amount_history';
           $functs->deletefn($delete_where,$table_name);
		 $Insert_data = array('customer_id' => $invoice['data'][$x][0],'amount' => $amt,'month' =>$m,'year' =>$y);
         $table_name='extra_amount_history';
         $insertData = $functs->insertFn($table_name,$Insert_data);

	}

	}

    $i = $functs->invoiceCheckList($m);
	$functs->deleteInvoice();
	$functs->updteInvoiceSatus();
	$functs->generateInvoiceThisMonthNewEnq();
	$functs->generateInvoiceThisMonthExEnq();
	$genrateall = $functs->invoiceGenrateAll();
    $invoice = $functs->getInvoiceList($action);
    $c = count($invoice['data']);
    for ($x = 0; $x < $c; $x++)
	{
     $getcostomerDetail = $functs->fngetcostomerDetail($invoice['data'][$x][0]);
     $in_vo_list = $functs->in_vo_list($invoice['data'][$x][0]);

 $t_r_c  = $in_vo_list["total_rent_cost"];
 $tax    = $in_vo_list["tax"];
 $received_total_rent_cost    = $in_vo_list["received_total_rent_cost"];
 $e_a    = $getcostomerDetail["extra_amount"];
 $p_r_c  = $getcostomerDetail ["pending_cost"];
 $lpc    = $getcostomerDetail ["lpc"];
 $lpc    = sprintf("%01.2f", $lpc);
 $total  = ($t_r_c+$tax+$p_r_c+$lpc)-$e_a;

 $functs->fnconfrimMailStatus($invoice['data'][$x][0],$tax,$total);
    }
	echo json_encode($invoice);
