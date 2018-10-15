<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

require_once('../../dbconn.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$h = 'asd';
// create some HTML content
$date = date('d/m/y');
$id = $_GET['id'];
$html = '<div style="text-align:right">Date : '.$date .'</div>
         <div style="text-align:right">Invoice No : 0000'.$id.'</div>
<div  >Bill To : M/s Akbar Holidays Pvt Ltd,
  </div>
  <div>#39/4641 R.Madhavan Road,</div>
  <div>Cochin 600028,</div>
  <div>TamilNadu,India.</div>
 ';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// output some RTL HTML content
$html = '';
$pdf->writeHTML($html, true, false, true, false, '');


$query1="SELECT * from general where  enquire_id ='$id'   ";
    $execute1 = mysql_query($query1);
    
	
	
	 while($result1 = mysql_fetch_array($execute1))  
 {
 $query="SELECT * from accommodation where  enquire_id ='$id' and  assigned_status='1' ";
    $execute = mysql_query($query);
    
	

	 while($result = mysql_fetch_array($execute))  
 {
   
	$total_acc=$result["total_cost"];	  
		   
	     
    $check_in1  = $result1["check_in1"];
	$check_out1 = $result1["check_out1"];
// test some inline CSS
$html = '<div></div>




<h2 style="text-align:center">Hotel Information</h2>
<table border="1" cellspacing="3" cellpadding="4">
	<tr>
		<th colspan="2">HOTEL NAME</th>
		<th >GUEST NAME </th>
		<th>ADULT </th>
		<th>CHILD </th>
		<th>NIGHTS </th>
		<th>Check In</th>
		<th>Check Out</th>
	</tr>
	<tr>
	<td colspan="2">'.$result["hotel_name"].'</td>
	<td>'.$result1["guest_name"].'</td>
	<td>'.$result1["no_of_adult"].'</td>
	<td>'.$result1["no_of_child"].'</td>
	<td>'.$result["no_of_nites"].'</td>
	<td>'.$result1["check_in1"].'</td>
	<td>'.$result1["check_out1"].'</td>
	</tr>
		
</table>';
    
	$margin =	$result1["margin_all"];   

 } 
 
 }
$pdf->writeHTML($html, true, false, true, false, '');



 
 
 // test some inline CSS


$html5 = '<div></div>




<h2 style="text-align:center">Attraction Information</h2>
<table border="1" cellspacing="3" cellpadding="4">
	<tr>
		<th>Day</th>
		<th  colspan="2">Attraction NAME </th>
		<th>Inclusion </th>
		<th>Date </th>
		
	</tr>	
';


$query4="SELECT * from tours_and_sight where  enquire_id ='$id'   ";
    $execute4 = mysql_query($query4);
    
	
    $total_att = 0;
	 while($result4 = mysql_fetch_array($execute4))  
 {
   
   $total_att +=$result4["total_cost"];
	$html5 .= '

	<tr>
	<td>'.$result4["days"].'</td>
	<td  colspan="2">'.$result4["tour_name"].'</td>
	<td>Transport And Guied</td>
	<td>'.$result4["q_date"].'</td>
	</tr>
	';	  
		   
	     
       
// test some inline CSS

		   

 } 

$html5 .= '</table>';

    

 $pdf->writeHTML($html5, true, false, true, false, '');
 
 
 
 $query6="SELECT * from transportation where  enquire_id ='$id'   ";
    $execute6 = mysql_query($query6);
    
	

	 while($result6 = mysql_fetch_array($execute6))  
 {
   
		  
	$total_tra = $result6["cost"];	   
	     
       
// test some inline CSS
$html6 = '<div></div>




<h2 style="text-align:center">Transport Information</h2>
<table border="1" cellspacing="3" cellpadding="4">
	<tr>
		<th colspan="2">Transport NAME</th>
		<th >Transport Type</th>
		<th>Arraival</th>
		<th>Departure</th>
	</tr>
	<tr>
	<td colspan="2">Sit</td>
	<td>'.$result6["transport_type"].'</td>
	<td>'.$check_in1.'</td>
	<td>'.$check_out1 .'</td>
	</tr>
		
</table>';
    
		   

 } 


 $pdf->writeHTML($html6, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();



// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

$price=$total_att+$total_acc+$total_tra+$margin;
$bank=100;
$total_price =$price+$bank;

$html7 = '<div style="text-align:right;"> Total Ammount Of Package : '.$price.'  </div>
          <div style="text-align:right;"> Bank Charges: '.$bank.'  </div>
		  <div style="text-align:right;"> Total       : '.$total_price.'  </div>




		
';
    
		   




 $pdf->writeHTML($html7, true, false, true, false, '');
 
 $html8 = '<div></div>
          <div></div>
          <div style=""> Bank Detail, </div>
          <div style="">ACCOUNT NAME : VINTAGE TOURS & TRAVELS PTE LTD </div>
		  <div style="">ACCOUNT NO : 647-224997-001</div>
          <div style="">ACCOUNT TYPE : Current</div>
          <div style="">BANK CODE : OCBC</div>
		  <div style="">ACCOUNT NAME : 7339</div>
          <div style="">SWIFT CODE : OCBCSGSG</div>
		  <div style="">BANK ADDRESS : 63,CHULIA STREET,#11-01,OCBC CENTRE EAST,SINGAPORE 049514.</div>';
    
		   




 $pdf->writeHTML($html8, true, false, true, false, '');
 
  $html9 = '<div></div>
          <div></div>
  <div style="text-align:center">Vintage Tours & Travel PTE. LTD,#04-57, SERANGOON PLAZA,320 SERANGOON RD,SINGAPORE. -218108</div>';
    
		   




 $pdf->writeHTML($html9, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();



// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
