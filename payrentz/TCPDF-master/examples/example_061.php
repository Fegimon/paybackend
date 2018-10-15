<?php
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
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
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
require_once('../../config/config.php');
require_once "../../config/PHPMailer-master/PHPMailerAutoload.php";



// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {

		$this->SetTextColor(0,0,128);
        // Logo
        $image_file = K_PATH_IMAGES.'logo.png';
        $this->Image($image_file, 10, 2, 50, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Invoice', 0, false, 'R', 0, '', 0, false, 'T', 'M');


    }

    // Page footer
    public function Footer() {

		$this->SetY(-25);
        // Set font
        $this->SetFont('helvetica', 'B', 12);
		$this->Cell(0, 10, 'You are one among our prestigious clients. Thank you for choosing PayRentz', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->SetY(-21);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, 'Happy to hear from you, do reach us if u have a suggestion/feedback', 0, false, 'C', 0, '', 0, false, 'T', 'M');

		$this->SetY(-16);
        // Set font
        $this->SetFont('helvetica', '', 8);
		$this->Cell(0, 10, 'No.24/53, Eldams Road, Teynampet, Chennai - 600 018', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetY(-12);
        // Set font
        $this->SetFont('helvetica', '', 8);
		$this->Cell(0, 10, '
			Tel:  044 48638090 / 24363040, E-mail: rent@payrentz.com, Web: www.payrentz.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->SetY(-8);
        // Set font
        $this->SetFont('helvetica', 'B', 8);
		$this->Cell(0, 10, 'CIN No : U71309TN2016PTC113411 / GSTIN : 33AAICP8598H1ZT ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->SetY(-6);
       // $this->SetAutoPageBreak(TRUE, 0);
        // Set font
        //$this->SetFont('helvetica', 'I', 8);
       // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

 @$c_id = $_POST['c_id'];

  $s_id = explode(",",$c_id);
  $c = count($s_id);
  $t=date('d-m-Y');
  $c_t=date("jS M, Y", strtotime($t));



 for ($x = 0; $x < $c; $x++) {

 $getcostomerDetail = $functs->fngetcostomerDetail($s_id[$x]);

 $cid = $s_id[$x];
 $c_name=$getcostomerDetail["customer_name"];
 $gender=$getcostomerDetail["gender"];
 $c_email=$getcostomerDetail["email"];
 $split_c_email= explode(",",$c_email);
 $t_mail_length= count($split_c_email);
 $e_a = $getcostomerDetail["extra_amount"];
 $getcostomerAddress = $functs->fngetcostomerAddress($s_id[$x]);
 $c_address= $getcostomerAddress["address"];
 $getGeneralInvoiceDetail = $functs->fnGetGeneralInvoiceDetail($s_id[$x]);
 $i_month = $getGeneralInvoiceDetail ["month"];
 $i_id = $getGeneralInvoiceDetail ["id"];
 $i_year = $getGeneralInvoiceDetail ["year"];
 $p_r_c = $getcostomerDetail ["pending_cost"];
 $lpc = $getcostomerDetail ["lpc"];
 $lpc  = sprintf("%01.2f", $lpc);

 if($gender==0)
 {
	$n_front="Mr.";
 }
 if($gender==3)
 {
	$n_front="M/s.";
 }
  if($gender==1)
 {
	$n_front="Ms.";
 }
 if($gender==2)
 {
	 $n_front="Dr.";
 }

$html_tr3='';
if($p_r_c > 0)
{
 $html_tr3 .='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">Last Month Rent Pending Cost</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_c.'</td>
				</tr>';

}
$html_trlpc='';
if($lpc > 0)
{
 $html_trlpc .='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">Late Payment Charge</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$lpc.'</td>
				</tr>';

}
$html_tr4='';
if($e_a > 0)
{
 $html_tr4 .='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">Extra Amount Paid</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">-'.$e_a.'</td>
				</tr>';

}



 $i_total_rent_cost = $getGeneralInvoiceDetail ["total_rent_cost"];




 $tax =0;


 $i_date=$i_month.' - '.$i_year;
 $getGeneralMappingDetail = $functs->fngetGeneralMappingDetail($s_id[$x]);
 $getContact = $functs->fngetContact($s_id[$x]);
 $c_contact    = $getContact["mobile"];
 $c_g_i =count($getGeneralMappingDetail);
 $html_tr1='';
 $html_tr51='';
 $html_tr61='';
 $html_tr71='';
 $html_tr81='';
 $color = 0;
 $tax2 = 0;
 $tax3 = 0;
 $tax4 = 0;
 $cgstValc=0;
 $sgstValc=0;
 $cgstValc2=0;
 $sgstValc2=0;
 $cgstValc3=0;
 $sgstValc3=0;
 $cgstValc4=0;
 $sgstValc4=0;
 $html_trc1='';
 $html_trc2='';
 $html_trc3='';
 $html_trc4='';
 $Ccgst=0;
 $Csgst=0;
 for($y = 0; $y < $c_g_i; $y++)
 {


  $p_variant   = $getGeneralMappingDetail[$y]["name"];
	$p_des       = $getGeneralMappingDetail[$y]["des"];
	$p_count     = $getGeneralMappingDetail[$y]["c"];
	$p_r_cost    = $getGeneralMappingDetail[$y]["r_c"];
	$p_t_cost    = $getGeneralMappingDetail[$y]["t_c"];
	$cgst        = $getGeneralMappingDetail[$y]["cgst"];
	$sgst        = $getGeneralMappingDetail[$y]["sgst"];
	 if($cgst == 14)
	 {
	 $cgstVal  = ($cgst / 100) * $p_t_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValc  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_t_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValc  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax += $gst;
	 $html_tr51 .='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">'.$p_count.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_t_cost.'</td>
				</tr>';
	$html_trc1 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 14%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValc).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 14%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValc).'</td>
				</tr>';
	 }
	 else if($cgst == 6)
	 {
	 $cgstVal  = ($cgst / 100) * $p_t_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValc2  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_t_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValc2  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax2 += $gst;
    $html_tr61 .='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">'.$p_count.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_t_cost.'</td>
				</tr>';
	$html_trc2 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 06%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValc2).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 06%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValc2).'</td>
				</tr>';
	 }
   else if($cgst == 2.5)
	 {
	 $cgstVal  = ($cgst / 100) * $p_t_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValc4  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_t_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValc4  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax4 += $gst;
    $html_tr81 .='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">'.$p_count.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_t_cost.'</td>
				</tr>';
	$html_trc4 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 2.5%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValc4).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 2.5%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValc4).'</td>
				</tr>';
	 }
	 else
	 {
	 $cgstVal  = ($cgst / 100) * $p_t_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValc3  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_t_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValc3  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax3 += $gst;
    $html_tr71 .='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">'.$p_count.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_t_cost.'</td>
				</tr>';
	$html_trc3 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 09%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValc3).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 09%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValc3).'</td>
				</tr>';


	 }







 }


   if($c_g_i > 0)
   {
	   $html_tr51 .= $html_trc1;
	   $html_tr61 .= $html_trc2;
	   $html_tr71 .= $html_trc3;
	   $html_tr1 = $html_tr51.$html_tr71.$html_tr61;
   }


 $getGeneralMappingDetailc = $functs->fngetGeneralMappingDetailc($s_id[$x]);

  $c_c =count($getGeneralMappingDetailc);
 $html_tr2 ='';
 $html_trr51='';
 $html_trr61='';
 $html_trr71='';
 $html_trr81='';
 $cgstValcc=0;
 $sgstValcc=0;
 $cgstValcc2=0;
 $sgstValcc2=0;
  $cgstValcc3=0;
 $sgstValcc3=0;
 $cgstValcc4=0;
$sgstValcc4=0;
 $html_trcc1='';
 $html_trcc2='';
 $html_trcc3='';
 $html_trcc4='';

 $color = 0;
 for($z = 0; $z < $c_c; $z++)
 {

	$p_variant   = $getGeneralMappingDetailc [$z]["name"];
	$p_des       = $getGeneralMappingDetailc[$z]["des"];
	$p_r_cost    = $getGeneralMappingDetailc [$z]["r_c"];
	$p_rod       = $getGeneralMappingDetailc [$z]["rod"];
	$cgst        = $getGeneralMappingDetailc[$z]["cgst"];
	$sgst        = $getGeneralMappingDetailc[$z]["sgst"];
	$p_rod=date("jS F, Y", strtotime($p_rod));
	$p_rod1 = date('m/t/Y', strtotime($p_rod));
	$p_rod2=date("jS F, Y", strtotime($p_rod1));
	if($cgst == 14)
	 {

	 $cgstVal  = ($cgst / 100) * $p_r_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValcc  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_r_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValcc  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax += $gst;
	  $html_trr51 .='<tr height="30" class=""  style="border:1px solid #dedede;   ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'(From '.$p_rod.' To '.$p_rod2.')</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">1</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
				</tr>';
	$html_trcc1 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 14%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValcc).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 14%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValcc).'</td>
				</tr>';

	 }

	 else if($cgst == 6)
	 {
	 $cgstVal  = ($cgst / 100) * $p_r_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValcc2  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_r_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValcc2  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax2 += $gst;
	  $html_trr61 .='<tr height="30" class=""  style="border:1px solid #dedede;   ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'(From '.$p_rod.' To '.$p_rod2.')</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">1</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
				</tr>';
	$html_trcc2 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 06%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValcc2).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 06%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValcc2).'</td>
				</tr>';
	 }
   else if($cgst == 2.5)
	 {
	 $cgstVal  = ($cgst / 100) * $p_r_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValcc4  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_r_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValcc4  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax4 += $gst;
	  $html_trr81 .='<tr height="30" class=""  style="border:1px solid #dedede;   ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'(From '.$p_rod.' To '.$p_rod2.')</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">1</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
				</tr>';
	$html_trcc4 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 2.5%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValcc4).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 2.5%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValcc4).'</td>
				</tr>';
	 }
	 else
	 {
	 $cgstVal  = ($cgst / 100) * $p_r_cost;
	 $cgstVal  = sprintf("%01.2f", $cgstVal);
	 $cgstValcc3  += $cgstVal;
	 $Ccgst += $cgstVal;
	 $sgstVal  = ($sgst / 100) * $p_r_cost;
	 $sgstVal  = sprintf("%01.2f", $sgstVal);
	 $sgstValcc3  +=$sgstVal ;
	 $Csgst += $sgstVal;
	 $gst = $cgstVal+$sgstVal;
     $tax3 += $gst;
	  $html_trr71 .='<tr height="30" class=""  style="border:1px solid #dedede;   ">
					<td style="border: 1px solid #c1c1c1; ">'.$p_des.' '.$p_variant.'(From '.$p_rod.' To '.$p_rod2.')</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;">1</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.$p_r_cost.'</td>
				</tr>';
	$html_trcc3 ='<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CGST @ 09%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $cgstValcc3).'</td>
				</tr>
				<tr height="30" class=""  style="border:1px solid #dedede; ">
					<td style="border: 1px solid #c1c1c1; ">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SGST @ 09%</td>
					<td style="border: 1px solid #c1c1c1; text-align:center;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;"></td>
					<td style="border: 1px solid #c1c1c1; text-align:right;">'.sprintf("%01.2f", $sgstValcc3).'</td>
				</tr>';

	 }






 }

 if($c_c > 0)
 {

	   $html_trr51 .= $html_trcc1;
	   $html_trr61 .= $html_trcc2;
	   $html_trr71 .= $html_trcc3;
	   $html_tr2 = $html_trr51.$html_trr71.$html_trr61;
 }
$i_total_cost  =round($i_total_rent_cost+ $p_r_c-$e_a+$tax+$tax2+$tax3+$tax4+$lpc);
 $n = sprintf("%01.2f", $i_total_cost);
 $i_total_cost2  =round($i_total_rent_cost+ $p_r_c-$e_a+$lpc);
 $n2 = sprintf("%01.2f", $i_total_cost2);
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 061');
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
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

$Ccgst=sprintf("%01.2f", $Ccgst);
$Csgst=sprintf("%01.2f", $Csgst);
$tes = "";
if($n > 15000)
{
$tes = "<br><br><br><br><br><br>";
}
// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->


		<style>
			.clearfix:after {
			  content: "";
			  display: table;
			  clear: both;
			}

			body {
			  position: relative;
			  width: 21cm;
			  height: 29.7cm;
			  margin: 0 auto;
			  color: #001028;

			  font-family: helvetica;
			  font-size: 9px;
			  font-family: helvetica;
			}

			header {
			  padding: 10px 0;
			  margin-bottom: 30px;
			}
			td, th{
				padding:5px 15px;
			}
			table {

				border-collapse: collapse;
				border-spacing: 0;
				margin-bottom: 20px;
			}

			tr.d0 td {
  background-color: #c3bfbf;
  color: black;
}
tr.d1 td {
  background-color: #fff;
  color: black;
}
		</style>



			<div class="clearfix" style="margin-top:5px;">

				<table >
					<tr>
					    <td colspan="3" width="50%"><span style="font-size:16px;font-weight: bold;">$n_front $c_name</span>

						</td>
						<td width="12%" ></td>
						<td width="20%">Date:</td>

						<td  style="border:1px solid #dedede;" width="20%">$c_t</td>
					</tr>
					<tr>
					        <td rowspan="2" colspan="3"><span>$c_address.</span></td>
							<td></td>
						<td >Invoice #:</td>

						<td style="border:1px solid #dedede;">INV-$i_id</td>
					</tr>
					<tr>

					        <td></td>
						<td>Customer ID:</td>

						<td style="border:1px solid #dedede;">$cid</td>
					</tr>
					<tr>
					        <td colspan="3">$c_contact.</td>
					        <td></td>
						<td>Due For:</td>

						<td style="border:1px solid #dedede;">September - 2018</td>
					</tr>
					<tr>
					            <td colspan="3">E-mail : <a href="mailto:" style="font-size:12px">$c_email</a></td>
					        	<td></td>
						<td>Payment Due by:</td>

						<td style="border:1px solid #dedede;">7th October, 2018 </td>
					</tr>
				</table>
			</div>
		</header>
		<table style=" width: 100%;">

				<tr  style=" color:#fff; border: 1px solid #fff;font-size:11px;" height="45"  >
					<th style="">Product  Description </th>
					<th style="">No.of Units</th>
					<th style="">Rent for Unit</th>
					<th style="">Total Unit</th>
				</tr>

			<tbody>
			<tr   style="border:1px solid #dedede; background-color: #0000B7;color:#fff;text-align:center; ">
					<td style="border: 1px solid #c1c1c1;  background:#000;" width="70%">Product  Description</td>
					<td style="border: 1px solid #c1c1c1;" width="6%">No of Units</td>
					<td style="border: 1px solid #c1c1c1;" width="12%">Rent Per Unit</td>
					<td style="border: 1px solid #c1c1c1;" width="12%">Total Rent</td>
				</tr>
				 $html_tr1
				 $html_tr2
				 $html_tr3
				 $html_tr4
				 $html_trlpc




			</tbody>
		</table>



		<br><br><br>
               $tes

			<table >
					<tr>
					    <td  width="62%" style="border:1px solid #dedede ;text-align:center;"><span style="font-size:11px">Make all Cheque/Online Payments to </span>

						</td>
                                                <td width="10%"></td>
						<td width="12%">Subtotal</td>

						<td  width="17%" style="text-align:right"> $n2</td>
					</tr>
					<tr>
					<td rowspan="6" style="border:1px solid #dedede ;text-align:left">
					PR RENTAL SOLUTIONS PRIVATE LIMITED<br>
					Account Number : 50200022697507<br>
					Account Type: Current Account<br>
					Bank Name: HDFC Bank<br>
					Branch: Raja Annamalai Puram<br>
					IFSC Code: HDFC0000141<br>

					</td>
					    <td></td>
						<td>CGST</td>

						<td style="text-align:right"> $Ccgst</td>

					</tr>
					<tr>
					 <td></td>
						<td>SGST</td>

						<td style="text-align:right"> $Csgst</td>
					</tr>
					<tr>
					 <td></td>
						<td>Discount</td>

						<td style="text-align:right">-</td>
					</tr>
					<tr>
					 <td></td>
						<td  style=" border-bottom:1px solid #dedede ;border-top:1px solid #dedede ; border-left:1px solid #dedede ;">Total</td>

						<td style="text-align:right; border-bottom:1px solid #dedede ;border-top:1px solid #dedede ; border-right:1px solid #dedede ;  ">Rs. $n</td>

					</tr>
					<tr>
					        <td></td>

						<td ></td>

						<td ></td>
					</tr>
					<tr>

					    <td></td>
						<td></td>

						<td ></td>

					</tr>
				</table>



			<h4>Note:</h4>
			1.Two weeks' notice to be provided to terminate the contract else proportionate rent will be collected.<br>
			2.Rent to be paid on or before 7th of every month. <br>
			3. Late payment charges of Rs. 10 per day per product is applicable.<br><br>









EOF;

// output the HTML content

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page





// reset pointer to the last page


// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output('example_06.pdf', 'I');

$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/payrentz/Inv_'.$i_id.'_SEP_2018_'.$s_id[$x].'.pdf', 'F');
 //PHPMailer Object
//$mail = new PHPMailer;


//PHPMailer Object
$mail = new PHPMailer;
//$mail->setFrom('accounts@payrentz.com', 'Your Name');
//$mail->addAddress('simb143123@gmail.com', 'My Friend');


//From email address and name
$mail->From = "accounts@payrentz.com";
$mail->FromName = "Payrentz";
$msg ='Please FYA';

//$mail->addAddress('simb143123@gmail.com', 'My Friend');



//$mail->AddAttachment("http://knowyourprocess.in/demo-vt/VT13454089.pdf");


//To address and name
	$mail->addBCC("silambarasandp12@gmail.com");
	// $mail->addBCC("simplyarunkannan@gmail.com");

      $mail->addBCC("seo.payrentz@gmail.com");
        $mail->addBCC("accounts@payrentz.com");

 for ($l = 0; $l < $t_mail_length; $l++) {

 //print_r($split_c_email[$l]);

 $mail->addAddress($split_c_email[$l]);
 }


$mail->addReplyTo("accounts@payrentz.com", "Reply");

//CC and BCC
//$mail->addAddress("seo.payrentz@gmail.com");
//$mail->addAddress("silambarasandp12@gmail.com");
//$mail->addBCC("accounts@payrentz.com");
//$mail->addAddress("silambarasandp12@gmail.com");

$mail->AddAttachment($_SERVER["DOCUMENT_ROOT"] . '/payrentz/Inv_'.$i_id.'_SEP_2018_'.$s_id[$x].'.pdf');

$mail->Subject  = 'September 2018 Rent Invoice - PayRentz';
$mail->isHTML(true);

$mail->Body     = '<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Payrentz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet" type="text/css">

</head>

<body style="background: #10324b;">

<table style=" border: solid 1px #d7e2e4; border-radius: 3px; background: #fff;  padding: 0px;">
<tr><td colspan="2"><img style="padding: 15px 15px 0px 15px;" src="http://payrentz.com/payrentz/assets/images/pay-logo-old.png" alt="Payrentz Logo" width="200" height="90"/></td></tr>

<tr><td colspan="2">
<p style="padding: 0 20px; font-family: myriad Pro; font-size: 15px; color: #3d4247;">Dear Customer,</p>

<p style=" padding-left: 20px; margin: 0px;font-size: 20px; color: #0f1012;">Greetings from PayRentz !</p>
</td></tr>

<tr><td colspan="3">
<p style="padding: 0 20px;text-align: justify;">
Thank you for choosing PayRentz as your rental partner. Your continued patronage is much appreciated. Please find attached your monthly bill with itemized details.
</p>
<p style="padding: 0 20px;text-align: justify;">
The invoice amount is <strong>Rs. '.$n.' </strong> and is due to be paid on or before 7th October.
</p>
<p style="padding: 0 20px;text-align: justify;">
We note that Online Fund Transfer (NEFT / IMPS) continues to remain as the most preferred mode of payment for most of our clients. Our bank account details are provided below for your ready reference:
</p>
</td></tr>

<tr><td colspan="2" style="background: #F07722; color: #fff; font-size: 18px; padding-top: 15px;padding-bottom: 15px; text-align: center; margin-top: 20px; margin-top: 20px; margin-bottom: 20px;">Account Details
</td></tr>

<tr><td style="padding: 0 50px;">Beneficiary Name</td><td>PR RENTAL SOLUTIONS PRIVATE LIMITED</td></tr>
<tr><td style="padding: 0 50px;">A/c No</td><td>50200022697507</td></tr>
<tr><td style="padding: 0 50px;">Bank Name</td><td>HDFC Bank Ltd</td></tr>
<tr><td style="padding: 0 50px;">Account Type</td><td>Current Account</td></tr>
<tr><td style="padding: 0 50px;">IFSC CODE</td><td>HDFC0000141</td></tr>
<tr><td style="padding: 0 50px;">Branch Name</td><td>R. A. PURAM, Chennai</td></tr>


<tr><td colspan="3" >

<p style="padding: 0 20px;text-align: justify;">
Kindly like and share PayRentz page in <a target="_blank" href="https://www.facebook.com/PayRentz-1679677475596048/">Facebook</a> and follow us on <a target="_blank" href="https://twitter.com/PayRentz">Twitter</a> to stay connected and know more about products and offerings.
</p>
<p style="padding: 0 20px;text-align: justify;">
We strive to serve you to your complete satisfaction. Please feel free to write to us/call us for any support and provide feedback to improve our services.
</p>

<p style="padding: 0 20px;">
<span style="font-weight: bold; color: #f0561c;">Assuring you the best of services as always.</span></p>
</td></tr>

<tr><td><p style="padding: 0 20px;margin-bottom: 10px;">Warm Regards,</p></td></tr>
<tr><td><p style="padding: 0 20px;margin-bottom: 10px;">Team – PayRentz</p></td></tr>
<tr><td><a style="padding: 0 20px;margin-bottom: 10px;" href="mailto:www.payrentz.com">www.payrentz.com</a></td></tr>


<tr><td style="text-align: center; background: #3C8DBC; color: #b0cade;" colspan="2"><p style="padding: 0 20px;">
<a href="https://www.facebook.com/PayRentz-1679677475596048/" target="_blank"><img style="border: none;"  ></a>
<a href="https://twitter.com/PayRentz" target="_blank"><img style="border: none;" src="http://dewpondtechnologies.com/payrentz/assets/images/twitter.png" ></a>
</td></tr>
</table>



</body>

</html>';
if(!$mail->send()) {
 echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been s.';
}





  //$taxsave = $tax+$tax2;
 //print_r($taxsave);
  // $functs->fnconfrimMailStatus($s_id[$x],$taxsave,$n);

}





//echo($_SERVER['DOCUMENT_ROOT']);
//============================================================+
// END OF FILE
//============================================================+
?>
