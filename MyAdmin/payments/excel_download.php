<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

$fromdate=date('Y-m-d',strtotime($_REQUEST['dt_from']));
  $todate=date('Y-m-d',strtotime($_REQUEST['dt_to']));;
  $cond ="";

    if($fromdate)
    {
      $cond .= "ord_date>='".$fromdate."'";
    }
    if($todate)
    {
      $cond .= "AND ord_date<='".$todate."'";
    }
	if($status!='0')
	{
		$cond .=" AND order_status_id='".$status."'";
	}
$orders=$conn->select_query(ORDER,"*",$cond.'order by ord_id desc',"",1); 


$xl=$orders['result'];
    
include(dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 //echo date('H:i:s') ;
$i = 4 ; 
$j = 5 ; 
$sno = 1 ;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'Order Details');

$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Order Id');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Customer Name');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Paymode');

$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Category');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Product Name');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Month/Days');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Quantity');

//$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Refundable Deposit');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Security Deposit');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Handling Charge');
//$objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Tax');

$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Total');
$objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Order Status');
$objPHPExcel->getActiveSheet()->SetCellValue('M3', 'Billing Address');
$objPHPExcel->getActiveSheet()->SetCellValue('N3', 'Shipping Address');
$objPHPExcel->getActiveSheet()->SetCellValue('O3', 'Order Date');


foreach ($xl as $key => $value) 
{
 $userdetails = $conn->select_query(USER,"*","user_id='".$value['customer_id']."'","1");
 $orderdet = $conn->select_query(ORDERPRODUCT,"*","order_id='".$value['ord_id']."'","");
$order_status = $conn->select_query(ORDERSTATUS,"*","order_status_id='".$value['order_status_id']."' AND status='Y'","1");

//state
  $billstate = $conn->select_query(STATE,"*","zone_id='".$value['bill_state']."'","1");
 $shipstate = $conn->select_query(STATE,"*","zone_id='".$value['ship_state']."'","1"); 
 //billaddress
 $billingadd=$value['bill_address'].','.$value['bill_city'].','.$billstate['name'].','.$value['bill_pincode'];
 //shippingadd
 $shippingadd=$value['ship_address'].','.$value['ship_city'].','.$shipstate['name'].','.$value['ship_pincode'];
 if($value['paymethod']=='COD')
 {
    $paymethod='Cash Payable';
  }else
  {
     $paymethod=$value['paymethod'];
  }
   
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(70);
$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setWidth(70);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $sno);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,$value['order_id']);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, ucfirst($userdetails['user_name']));
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $paymethod);
foreach($orderdet['result'] as $resdet){
	
	if($resdet['cat_id']!='3')
	{
		$txtmd='Months';
	}else
	{
		$txtmd='Days';
	}
	
	if($resdet['month_days']==12 && $resdet['cat_id']!='3')
	{
		$monthval='Above 3 ';
	}else
	{
		$monthval=$resdet['month_days'];
	}
	
	$cat = $conn->select_query(CATEGORY,"*","cat_p_id='".$resdet['cat_id']."'","1");
	
	$prod = $conn->select_query(PRODUCT,"*","p_id='".$resdet['product_id']."'","1");
	
$objPHPExcel->getActiveSheet()->getRowDimension($j)->setRowHeight(70);
$objPHPExcel->getActiveSheet()->getColumnDimension($j)->setWidth(70);
	
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$j, $cat['cat_title']);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$j, $prod['p_name']);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$j, $monthval.$txtmd);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$j, $resdet['quantity']);
//$objPHPExcel->getActiveSheet()->SetCellValue('I'.$j, $resdet['refundable_deposit']);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$j, $resdet['security_deposite']);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$j, $resdet['handling_price']);
//$objPHPExcel->getActiveSheet()->SetCellValue('L'.$j,$resdet['tax']);
$j++;
$i++;

}

$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $value['total']);
$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $order_status['name']);
$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $billingadd);
$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $shippingadd);
$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, date('d-m-Y',strtotime($value['ord_date'])));


	$i++;
	$j++;
	$sno++;
}
$objPHPExcel->getActiveSheet()->setTitle('Order Detail Report');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Order Detail Report.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
?>