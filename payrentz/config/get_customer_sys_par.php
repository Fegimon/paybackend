<?php
 
 require_once('config.php'); 
 
 $action = false;
 $t=date('d-m-Y');
 $d=date("d",strtotime($t));

if($d == 30)
{
$generateNewInvoice = $functs->generateInvoiceThisMonthNewEnq(); 
$generateInvoice = $functs->generateInvoiceThisMonthExEnq();
}
else
{
	
}
$invoice = $functs->getInvoiceList($action);

echo json_encode($invoice);
?>