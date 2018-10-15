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

$curMonth = date('m');
$curYear  = date('Y');
@$customerid    = $_POST['customerid'];
@$customername = $_POST['customername'];
//@$advamount = $_POST['advamount'];
@$advamount = $_POST['recvamount'];
@$recvamount = $_POST['recvamount'];
if($curMonth == 1)
{
  $curMonth = 12;
  $curYear = $curYear -1;
}
else
{
  $curMonth = $curMonth-1;
}
$getrenthistory = $functs->getRentHistoryFn($customerid,$curMonth,$curYear);

if(count($getrenthistory) != 0)
{
  print_r($advamount);
  $getrenthistorydetail = $functs->getrenthistorydetailFn($customerid);
	foreach ($getrenthistorydetail as $key1 => $value1) {
		if($advamount > 0 )
		{

			if($advamount > ($value1["rent_cost"]))
			{
				$cr = $value1["rent_cost"] - $value1["recived_rent_cost"];
	      $value1["recived_rent_cost"] = $value1["recived_rent_cost"]+$cr;
				$advamount = $advamount - $cr;

				$update_data = array('recived_rent_cost'=>$value1["recived_rent_cost"]);
			  $where_con = array('id' =>$value1["id"]);
			  $table_name='rent_history';
				$functs->updateTableFn($update_data,$where_con,$table_name);
			}
	    else {

	      $value1["recived_rent_cost"] = $value1["recived_rent_cost"]+$advamount;
	      //$value1["recived_rent_cost"] = $advamount;
				$update_data = array('recived_rent_cost'=>$value1["recived_rent_cost"]);
			  $where_con = array('id' =>$value1["id"]);
			  $table_name='rent_history';
				$functs->updateTableFn($update_data,$where_con,$table_name);
				$advamount = 0;
	   }

		}


	}
//	print_r($getrenthistorydetail);
}
else {
  //print_r($advamount);
	$getMapProduct = $functs->getMapProduct($customerid);

  //print_r($getMapProduct);

	foreach ($getMapProduct as $key => $value) {

	$prod  = $value["product_id"];
	$total = $value["total"];
          //print_r($value);
					$Insert_data = array('customer_id' => $customerid,'product_id' => $prod,'month' =>$curMonth,'year' =>$curYear,'rent_cost'=>$total);
	           $table_name='rent_history';
	            $insertData = $functs->insertFn($table_name,$Insert_data);

			 }

      $getrenthistorydetail = $functs->getrenthistorydetailFn($customerid);
       //print_r($getrenthistory);
       foreach ($getrenthistorydetail as $key1 => $value1) {
     		if($advamount > 0 )
     		{

     			if($advamount > ($value1["rent_cost"]))
     			{
     				$cr = $value1["rent_cost"] - $value1["recived_rent_cost"];
     	      $value1["recived_rent_cost"] = $value1["recived_rent_cost"]+$cr;
     				$advamount = $advamount - $cr;

     				$update_data = array('recived_rent_cost'=>$value1["recived_rent_cost"]);
     			  $where_con = array('id' =>$value1["id"]);
     			  $table_name='rent_history';
     				$functs->updateTableFn($update_data,$where_con,$table_name);
     			}
     	    else {

     	      $value1["recived_rent_cost"] = $value1["recived_rent_cost"]+$advamount;
     	      //$value1["recived_rent_cost"] = $advamount;
     				$update_data = array('recived_rent_cost'=>$value1["recived_rent_cost"]);
     			  $where_con = array('id' =>$value1["id"]);
     			  $table_name='rent_history';
     				$functs->updateTableFn($update_data,$where_con,$table_name);
     				$advamount = 0;
     	   }

     		}


     	}

}





	@$rentcollectedby = $_POST['rentcollectedby'];
	@$rentdepositedby = $_POST['rentdepositedby'];
	@$type = $_POST['type'];
	//$type = ucfirst($type);
	@$rentcolon = $_POST['rentcolon'];
	@$follow_status = $_POST['follow_status'];
	@$rent_remark = $_POST['rent_remark'];
	@$rent_remark = $_POST['rent_remark'];
	@$rec = $_POST['rec'];
	@$rendepcolon = $_POST['rendepcolon'];
	$balance = $advamount-$recvamount;
	$reciv = $_POST['reciv'];
	$re = $reciv + $recvamount;
	$update_data = array('received_total_rent_cost'=>$re);
    $where_con = array('customer_id' =>$customerid);
    $table_name='invoice';
	$functs->updateTableFn($update_data,$where_con,$table_name);
	 $Insert_data = array('customer_id'=>$customerid,'reiceved_amount'=>$recvamount,'amount_reiceved_on'=>$rentcolon,'payment_mode'=>$type,'collected_on'=>$rentcolon,'collected_by'=>$rentcollectedby,'deposit_by'=>$rentdepositedby, 'deposit_on'=>$rendepcolon,'reciept_status'=>$rec);
     $table_name='rentfollowup';
     $insertData = $functs->insertFn($table_name,$Insert_data);

	$month =date('m');
	$dateee = date('d-m-y');
	$c_t=date("jS F, Y", strtotime($dateee));

	$getcostomerDetail = $functs->fngetcostomerDetail($customerid);
	$c_name=$getcostomerDetail["customer_name"];
	$c_email=$getcostomerDetail["email"];
	$getcostomerAddress = $functs->fngetcostomerAddress($customerid);
	$c_address= $getcostomerAddress["address"];
	$getContact = $functs->fngetContact($customerid);
	$c_contact  = $getContact["mobile"];
	$gender=$getcostomerDetail["gender"];

	  if($gender==0)
 {
	$n_front="Mr.";
 }
 if($gender==2)
 {
	$n_front="M/s.";
 }
  if($gender==1)
 {
	$n_front="Ms.";
 }
 if($gender==3)
 {
	 $n_front="Dr.";
 }

$dateee = date('d-m-y');
	$advan_inid = $customerid.$dateee;
       $recvamount = sprintf("%.2f", $recvamount);
$number = $recvamount;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;

$digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');


   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " .
          $words[$point = $point % 10] : '';
   $let = $result . "Rupees  " . $points . "";


 if($type == 'Cash')
 {
 $dyn = '<tr style="">
<td style="width:20%;"><b>Cash </b></td>
<td style="width:80%;"><table  ><tr><td align="center"  style="border:2px solid #000000; padding:0px; width:30px; height:20px;"><img class="" align="bottom" src="tick.png" alt="" height="8" width="12" ></td></tr>   </table></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr style="">
<td style="width:20%;"><b>Cheque </b></td>
<td style="width:40%;"><b><table ><tr><td style="border:2px solid #000000; padding:0px; width:30px; height:20px; text-align:left;"></td></tr>   </table> </b></td>
<td style="width:40%; text-align:right;"><b> PR Rental Solutions Pvt Ltd</b></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>

<tr style="">
<td style="width:20%;"><b>Online Payment </b></td>
<td style="width:80%;"><table ><tr><td style="border:2px solid #000000; padding:0px; width:30px; height:20px;"></td></tr>   </table></td>
</tr>';

}
else if($type == 'Cheque')
{
$dyn = '<tr style="">
<td style="width:20%;"><b>Cash </b></td>
<td style="width:80%;"><table  ><tr><td align="center"  style="border:2px solid #000000; padding:0px; width:30px; height:20px;"></td></tr>   </table></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr style="">
<td style="width:20%;"><b>Cheque </b></td>
<td style="width:40%;"><b><table ><tr><td style="border:2px solid #000000; padding:0px; width:30px; height:20px; text-align:left;"><img class="" align="bottom" src="tick.png" alt="" height="8" width="12" ></td></tr>   </table> </b></td>
<td style="width:40%; text-align:right;"><b> PR Rental Solutions Pvt Ltd</b></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>

<tr style="">
<td style="width:20%;"><b>Online Payment </b></td>
<td style="width:80%;"><table ><tr><td style="border:2px solid #000000; padding:0px; width:30px; height:20px;"></td></tr>   </table></td>
</tr>';
}
else if($type == 'Online Transfer' )
{
$dyn = '<tr style="">
<td style="width:20%;"><b>Cash </b></td>
<td style="width:80%;"><table  ><tr><td align="center"  style="border:2px solid #000000; padding:0px; width:30px; height:20px;"></td></tr>   </table></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr style="">
<td style="width:20%;"><b>Cheque </b></td>
<td style="width:40%;"><b><table ><tr><td style="border:2px solid #000000; padding:0px; width:30px; height:20px; text-align:left;"></td></tr>   </table> </b></td>
<td style="width:40%; text-align:right;"><b> PR Rental Solutions Pvt Ltd</b></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>

<tr style="">
<td style="width:20%;"><b>Online Payment </b></td>
<td style="width:80%;"><table ><tr><td style="border:2px solid #000000; padding:0px; width:30px; height:20px;"><img class="" align="bottom" src="tick.png" alt="" height="8" width="12" ></td></tr>   </table></td>
</tr>';
}




// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {





		//Page header
		public function Header() {
$customerid = $_POST['customerid'];
        $dateee = date('d-m-y');
	$advan_inid = $customerid.$dateee;

			$this->SetTextColor(0,0,0);
			// Logo
			$image_file = 'pr.jpg';
			$this->Image($image_file, 15, 10, 60, 20, 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
			// Set font
			$this->SetFont('helvetica', 'B', 20);

			$this->Cell(75,30, 'Receipt', 0, false, 'C', 0, '', 0, false, 'T', 'M');


			$this->SetFont('helvetica', '', 10);
			// Title
			$this->Cell(45, 15, "Receipt #: $advan_inid", 0, false, 'R', 0, '', 0, false, 'T', 'M');
			$this->SetFont('helvetica', '', 10);
			// Title
			$this->Cell(0, 25, "Date: $dateee", 0, false, 'R', 0, '', 0, false, 'T', 'M');






		}



		// Page footer
		public function Footer() {

			// $this->SetY(-38);
			// // Set font
			// $this->SetFont('helvetica', 'B', 12);
			// $this->Cell(0, 10, 'You are one among our prestigious clients. Thank you for choosing Yatrika Tours', 0, false, 'C', 0, '', 0, false, 'T', 'M');
			// $this->SetY(-32);
			// // Set font
			// $this->SetFont('helvetica', 'I', 8);
			// $this->Cell(0, 10, 'Happy to hear from you, do reach us if u have a suggestion/feedback', 0, false, 'C', 0, '', 0, false, 'T', 'M');

			$this->SetY(-26);
			$this->SetFont('helvetica', 'B', 10);
			$this->Cell(0, 5, 'This is a system generated receipt, signature not required.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->SetY(-22);

			$this->SetY(-26);
			$this->SetFont('helvetica', 'B', 10);
			$this->Cell(0, 8, '____________________________________________________________________________________________', 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->SetY(-22);


			// Set font
			$this->SetFont('helvetica', 'B', 10);
			$this->Cell(0, 15, '#24/53, Eldams Road, Teynampet, Chennai - 600 018, Phone No: 044 4863 8090.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->SetY(-22);
			// Set font
			$this->SetFont('helvetica', 'B', 10);
			$this->Cell(0, 25, '
			 rent@payrentz.com | www.payrentz.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->SetY(-18);
			// Set font

			// Set font
			//$this->SetFont('helvetica', 'I', 8);
			// $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}

}




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

	$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Payrentz</title>

</head>
<body>
<main>
<table>
<tr style="">
<td style="width:85%;"></td>

<td style="width:15%;"><table style=""><tr><td valign="middle" style="text-align:center; border:2px solid #000000; padding:0px; width:100px; height:25px; ">$recvamount</td></tr></table></td>
</tr>
</table>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<table style="font-size:13px; font-family:roboto; " >
<tr style="">
<td style="width:35%;"><b>Received with thanks from </b> </td>
<td style="width:65%; border-bottom: 1px dotted black;">$n_front  $customername </td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr style="">
<td style="width:35%;"><b>Amount</b> </td>
<td style="width:65%; border-bottom: 1px dotted black;"> $let </td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr style="">
<td style="width:35%;"><b>Towards</b> </td>
<td style="width:65%; border-bottom: 1px dotted black;"> Rent for the month of May 2018 </td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr style="">
<td style="width:35%;"> </td>
<td style="width:65%; border-bottom: 1px dotted black;"></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr style="">
<td style="width:35%;"><b>Payment Received in:</b> </td>
<td style="width:65%; border-bottom: 1px dotted black;"></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
$dyn
</table>



</main>

<footer>


</footer>
</body>
</html>
EOF;

// output the HTML content
if($rec == 1)
{
	$pdf->writeHTML($html, true, false, true, false, '');

$filepath = $_SERVER["DOCUMENT_ROOT"].'/payrentz/Documents/customer/'.$customerid.'/rentreceipt'.$customername.'-'.$dateee.'-'.$month.'.pdf';

	// $pdf->Write(0, $html, '', 0, 'C', true, 0, false, false, 0);
$pdf->Output($_SERVER["DOCUMENT_ROOT"].'/payrentz/Documents/customer/'.$customerid.'/rentreceipt'.$customername.'-'.$dateee.'-'.$month.'.pdf','F');


	//PHPMailer Object
$mail = new PHPMailer;
//From email address and name
$mail->From = "accounts@payrentz.com";
$mail->FromName = "Payrentz";
$msg ='Please FYA';
$mail->addAddress("silambarasandp12@gmail.com");

$mail->addReplyTo("silambarasandp12@gmail.com", "Reply");

$mail->addBCC("rent@payrentz.com");

$mail->isHTML(true);

$mail->Subject = "Rent Receipt - PayRentz";

$msg="
Dear Valued Client,<br><br>

Greetings from PayRentz!<br><br>

Please find your PayRentz bill attached with this mail detailing the monthly rent.<br><br>

Recently we have moved our banking operations to HDFC Bank Ltd, request you to transfer the rent to the following HDFC bank account.<br><br>

Bank Name     : HDFC Bank<br><br>
Branch Name   : R. A. PURAM<br><br>
Account name  : PR RENTAL SOLUTIONS PRIVATE LIMITED<br><br>
Account Type  : Current Account<br><br>
A/C No        : 50200022697507<br><br>
IFSC CODE     : HDFC0000141<br><br>


Kindly note that you could earn a referral bonus worth Rs. 250/- for every client you refer to us. The referral bonus will be adjusted from your subsequent monthly rent upon successful completion of your referral.<br><br>

Do like and share PayRentz page in Facebook and support us to reach larger audience.<br><br>

We strive to serve you to your complete satisfaction. Please feel free to write to us/call us for any support.<br><br>

Assuring you best of services as always.<br><br>

Happy Renting!<br><br>

Warm Regards,<br><br>

Team PayRentz<br><br>

";
$mail->Body = $msg;
$mail->AltBody = "This is the plain text version of the email content";

$mail->AddAttachment($_SERVER["DOCUMENT_ROOT"].'/payrentz/Documents/customer/'.$customerid.'/rentreceipt'.$customername.'-'.$dateee.'-'.$month.'.pdf');
$mail->send();
}



echo $filepath;
?>
