<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

if($reportdown!='all')
{
 $fromuid=$_REQUEST['from_date'];
  $touid=$_REQUEST['to_date'];;
  $users=$conn->select_query(RM4DETAILS,"*","RM4_entry_dt>='".$fromuid."' AND RM4_entry_dt<='".$touid."' AND RM4_status='Y' AND RM4_siteid='".$op_loc['feat_id']."' order by rm4_details_id desc","");

	
}

  $fromdate=$_REQUEST['dt_from'];
  $todate=$_REQUEST['dt_to'];
  $cond ="";

    if($fromuid)
    {
      $cond .= "ord_date>='".$fromuid."'";
    }
    if($touid)
    {
      $cond .= "AND ord_date<='".$touid."'";
    }
	if($status!='0')
	{
		$cond .=" AND order_status_id='".$status."'";
	}
$orders=$conn->select_query(ORDER,"*",$cond.'order by ord_id desc',""); 


$xl=$orders['result'];
    
include(dirname(__FILE__).'/PHPExcel/Classes/PHPExcel.php');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 //echo date('H:i:s') ;
$i = 4 ; 
$sno = 1 ;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'Form 3 Entries');

$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Login ID');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Opening Date');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Opening Time');

$objPHPExcel->getActiveSheet()->SetCellValue('E3', '(User Serial) US');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', '(Server Serial) SS');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Entry Date');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Status');

$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Last Updated');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Mobile Date');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Mobile Time');
$objPHPExcel->getActiveSheet()->SetCellValue('L3', 'Lattitude');
$objPHPExcel->getActiveSheet()->SetCellValue('M3', 'Longitude');
$objPHPExcel->getActiveSheet()->SetCellValue('N3', 'Data');


$objPHPExcel->getActiveSheet()->SetCellValue('O3', 'Image1');
$objPHPExcel->getActiveSheet()->SetCellValue('P3', 'Image2');
$objPHPExcel->getActiveSheet()->SetCellValue('Q3', 'Image3');
$objPHPExcel->getActiveSheet()->SetCellValue('R3', 'Image4');
foreach ($xl as $key => $value) 
{
  
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(70);
$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setWidth(70);
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $sno);
	$supervsorname = $conn->select_query(REGISTRATION,"*","user_id='".$value['RM4_supervisor_id']."'","1");
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, ucfirst($supervsorname['username']));
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $value['RM4_manual_dt']);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $value['RM4_manual_time']);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $value['RM4_locid']);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $value['RM4_serverid']);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $value['RM4_entry_dt']);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $value['RM4_status']);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $value['RM4_lastupdated']);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $value['RM4_mobile_dt']);
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $value['RM4_mobile_time']);
$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $value['RM4_lattitude']);
$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $value['RM4_logitude']);
$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, $value['RM4_data']);







if($reportdown!='all')
{
if($value['RM4_image1']!='')
{
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(70);
$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setWidth(70);

 $exist = $conn->image_exist($value['RM4_image1'],SITE_URL."uploads/rm4images/".date("d-m-y",strtotime($value['RM4_entry_dt']))."/");
 $img1 = ($exist) ? $value['RM4_image1'] : "";

$punimg=$value['RM4_image1'];	
$path=$punimg;
$ext = pathinfo($value['RM4_image1'], PATHINFO_EXTENSION);
if($ext == "png"){
    if($value['RM4_image1'])
        $gdImage=imagecreatefrompng($value['RM4_image1']);
        // echo $punimg; exit;
    
}else{
    if($value['RM4_image1'])
      $gdImage=imagecreatefromjpeg($value['RM4_image1']);
    
}     
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
    if($value['RM4_image1'])
    $objDrawing->setImageResource($gdImage);
	
if($ext == "png")    
    $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
else
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
//$objDrawing->setHeight(-1);
$objDrawing->setWidth(-1);
$objDrawing->setCoordinates('O'.$i);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}


if($value['RM4_image2']!='')
{
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(70);
$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setWidth(70);


 $exist = $conn->image_exist($value['RM4_image2'],SITE_URL."uploads/rm4images/".date("d-m-y",strtotime($value['RM4_entry_dt']))."/");
 $img2 = ($exist) ? $value['RM4_image2'] : "";

$punimg=$value['RM4_image2'];  
$path=$punimg;
$ext = pathinfo($value['RM4_image2'], PATHINFO_EXTENSION);
if($ext == "png"){
    if($value['RM4_image2'])
        $gdImage = imagecreatefrompng($value['RM4_image2']);
      //echo $punimg; exit;
    
}else{
    if($value['RM4_image2'])
      $gdImage=imagecreatefromjpeg($value['RM4_image2']);    
} 
    
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
    if($value['RM4_image2'])
    $objDrawing->setImageResource($gdImage);
  

if($ext == "png")    
    $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
else
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);

$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(-1);
$objDrawing->setWidth(-1);
$objDrawing->setCoordinates('P'.$i);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}


if($value['RM4_image3']!='')
{

 $exist = $conn->image_exist($value['RM4_image3'],SITE_URL."uploads/rm4images/".date("d-m-y",strtotime($value['RM4_entry_dt']))."/");
 $img3 = ($exist) ? $value['RM4_image3'] : "";

$punimg3=$value['RM4_image3'];	
$path3=$punimg3;
$ext3 = pathinfo($value['RM4_image3'], PATHINFO_EXTENSION);

if($ext3 == "png"){
    if($value['RM4_image3'])
        $gdImage3=imagecreatefrompng($value['RM4_image3']);
     //echo $punimg3; exit;
}else{
    if($value['RM4_image3'])
      $gdImage3=imagecreatefromjpeg($value['RM4_image3']);    
} 
    
$objDrawing3 = new PHPExcel_Worksheet_MemoryDrawing();
    if($value['RM4_image3'])
    $objDrawing3->setImageResource($gdImage3);
	
if($ext3 == "png")    
    $objDrawing3->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
else
$objDrawing3->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);



$objDrawing3->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing3->setHeight(-1);
$objDrawing3->setWidth(-1);
$objDrawing3->setCoordinates('Q'.$i);
$objDrawing3->setWorksheet($objPHPExcel->getActiveSheet());
}
else
{     
    $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i,'No Image Found');
}



if($value['RM4_image4']!='')
{

 $exist = $conn->image_exist($value['RM4_image4'],SITE_URL."uploads/rm4images/".date("d-m-y",strtotime($value['RM4_entry_dt']))."/");
 $img4 = ($exist) ? $value['RM4_image4'] : "";

$punimg3=$value['RM4_image4']; 
$path3=$punimg3;
$ext3 = pathinfo($value['RM4_image4'], PATHINFO_EXTENSION);

if($ext3 == "png"){
    if($value['RM4_image4'])
        $gdImage3=imagecreatefrompng($value['RM4_image4']);
     //echo $punimg3; exit;
}else{
    if($value['RM4_image4'])
      $gdImage3=imagecreatefromjpeg($value['RM4_image4']);    
} 
    
$objDrawing3 = new PHPExcel_Worksheet_MemoryDrawing();
    if($value['RM4_image4'])
    $objDrawing3->setImageResource($gdImage3);  
if($ext3 == "png")    
    $objDrawing3->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
else
$objDrawing3->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing3->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing3->setHeight(-1);
$objDrawing3->setWidth(-1);
$objDrawing3->setCoordinates('R'.$i);
$objDrawing3->setWorksheet($objPHPExcel->getActiveSheet());
}
else
{  
  $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i,'No Image Found');
}

}
else
{

$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, $value['RM4_image1']);
$objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, $value['RM4_image2']);
if($value['RM4_image3']!="")
{
  $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, $value['RM4_image3']);
}
else
{
  $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, "No Image Found");
}
if($value['RM4_image4']!='')
{
  $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, $value['RM4_image4']);
}
else
{
  $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, "No Image Found");
}

}
	$i++;
	$sno++;
}
$objPHPExcel->getActiveSheet()->setTitle('Form Entry Report');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Form4.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
?>