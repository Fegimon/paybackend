<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

$users=$conn->select_query(USER,"*","user_status='Y' order by user_name asc",""); 

$xl=$users['result'];
    
include(dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 //echo date('H:i:s') ;
$i = 4 ; 
$sno = 1 ;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'User Details');

$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'User Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Payrentz Unique Id');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'User Email');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'User Mobile');

$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Martial Status');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'DOB');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Gender');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Secondary Contact');

$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Secondary Email');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Door/Flat No/Apartment Name');
$objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Area');
$objPHPExcel->getActiveSheet()->SetCellValue('M3', 'City');
$objPHPExcel->getActiveSheet()->SetCellValue('N3', 'pincode');
$objPHPExcel->getActiveSheet()->SetCellValue('O3', 'State');
$objPHPExcel->getActiveSheet()->SetCellValue('P3', 'Residence Status');
$objPHPExcel->getActiveSheet()->SetCellValue('Q3', 'Company Address');

foreach ($xl as $key => $value) 
{
  
  if($value['dob']!='0000-00-00')
  {
	  $dob=date('d-m-Y',strtotime($value['dob']));
  }else
  {
	  $dob='Nill';
  }
  
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(70);
$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setWidth(70);
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $sno);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, ucfirst($value['user_name']));
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $value['payrentz_unique']);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $value['user_email']);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, '`'.$value['user_mobile']);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $value['marital_Status']=='S'?'Sinle':'Married');
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $dob);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $value['user_gender']);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, '`'.$value['secondary_contact']);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $value['secondary_email']);
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $value['permanent_flat_no']);
$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $value['permanent_area']);
$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $value['permanent_city']);
$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $value['permanent_pin_code']);
$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, $value['permanent_state']);
$objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $value['residence_status']);
$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, $value['company_address']);



	$i++;
	$sno++;
}
$objPHPExcel->getActiveSheet()->setTitle('User Detail Report');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="User Detail Report.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
?>