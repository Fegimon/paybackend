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
      $cond .= "namedate>='".$fromdate."'";
    }
    if($todate)
    {
      $cond .= "AND namedate<='".$todate."'";
    }
	if($status!='all')
	{
		$cond .=" AND status='".$status."'";
	}
	

$orders=$conn->select_query(NAMETRANSFER,"*","$cond order by name_trans_id desc",""); 

$xl=$orders['result'];
    
include(dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 //echo date('H:i:s') ;
$i = 4 ; 
$sno = 1 ;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'Name Transfer Details');

$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Order Id');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Product Name');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Customer Name');

$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'New Name');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'New Email');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'New Mobile');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'New Address');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Status');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Date');


foreach ($xl as $key => $value) 
{
    $orders = $conn->select_query(ORDER,"*","ord_id ='".$value['main_ord_id']."'","1");
     $users = $conn->select_query(USER,"*","user_id ='".$value['user_id']."'","1");
	 
  if($value['namedate']!='0000-00-00')
  {
	  $serdate=date('d-m-Y',strtotime($value['namedate']));
  }else
  {
	  $serdate='Nill';
  }
  
  $status=$value['status'];
  switch($status)
{
  case 'W':
  $ttxt="Pending";
  break;

  case 'Y':
  $ttxt="Processing";
  break;
  
  case 'C':
  $ttxt="Completed";
  break;

case 'N':
  $ttxt="Cancelled";
  break;

  default :
  $ttxt="Pending";
  break;  
}

  
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(70);
$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setWidth(70);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $sno);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $orders['order_id']);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $value['prod_name']);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, ucfirst($users['user_name']));
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $value['new_name']);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $value['new_email']);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $value['new_mobile']);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $value['new_address']);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $ttxt);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $serdate);

	$i++;
	$sno++;
}
$objPHPExcel->getActiveSheet()->setTitle('Name Transfer Report');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Name Transfer Report.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
?>