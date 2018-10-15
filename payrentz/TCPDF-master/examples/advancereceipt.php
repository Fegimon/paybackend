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
        $this->Image($image_file, 10, 10, 50, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Invoice', 0, false, 'R', 0, '', 0, false, 'T', 'M');
		
		
    }

    // Page footer
   
}


	@$customerid = $_POST['customerid'];
	@$customername = $_POST['customername'];
	@$advamount = $_POST['advamount'];
	@$recvamount = $_POST['recvamount'];
	@$vouchernum = $_POST['vouchernum'];
	@$dateofpurch = $_POST['dateofpurch'];
	@$type = $_POST['type'];
	$type = ucfirst($type);
	@$remarks = $_POST['remarks'];
	@$d_id = $_POST['d_id'];
	
	 $update = array('reciept_status' =>1);		
				$where_clause = array('id' => $d_id);
				$updated = $functs->updateTableFn($update, $where_clause,'deposit_money_transaction');
	$balance = $advamount-$recvamount;

	$month =date('m'); 
	$dateee = date('d-m-y');	
	$c_t=date("jS F, Y", strtotime($dateee));
	
	$getcostomerDetail = $functs->fngetcostomerDetail($customerid);
	$c_name=$getcostomerDetail["customer_name"];
	$c_email=$getcostomerDetail["email"];
	$e_a = $getcostomerDetail["extra_amount"];
	$getcostomerAddress = $functs->fngetcostomerAddress($customerid);	 
	$c_address= $getcostomerAddress["address"];
	$getContact = $functs->fngetContact($customerid);
	$c_contact  = $getContact["mobile"];
	
	$advan_inid = $customerid.$dateee;
	
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 002');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}
	$pdf->SetFont('times', '', 10);

	$pdf->AddPage();

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
			  
			  font-family: Arial, sans-serif; 
			  font-size: 9px; 
			  font-family: Arial;
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
	
	
			
			<div class="clearfix">
				<img src="logo.png" alt="Smiley face"/>
				<p style="text-align:center;font-size:20px;font-weight:600;">Advance Receipt</p>
				<table >
					<tr>
					    <td rowspan="5" colspan="3" width="50%"><span style="font-size:16px;font-weight: bold;">Mr/Mrs. $customername</span><br>
						 <span>$c_address.</span><br>
						 <span>Mobile : $c_contact.</span><br>
						 <span>E-mail : <a href="mailto:" style="font-size:12px">$c_email</a></span>
						</td>
						<td width="12%" ></td>
						<td width="20%">Date:</td>
						
						<td style="border:1px solid #dedede;" width="20%">$c_t</td>
					</tr>
					<tr>
					        <td></td>
						<td >Vourcher Num :</td>
						
						<td style="border:1px solid #dedede;">$vouchernum</td>
					</tr>
					<tr>     
					        <td></td>
						<td>Customer ID:</td>						
						<td style="border:1px solid #dedede;">$customerid</td>
					</tr>					
				</table>
			</div>
		</header>
		<br/>
		<br/><br/><br/>
		<br/><br/>
		<table style=" width: 100%;">					
			<tbody>
				<tr style="border:1px solid #dedede;color:#000;text-align:center;font-size:14px; ">
					<td style="border: 1px solid #c1c1c1;  background:#000;" width="50%">Total Amount</td>
					<td style="border: 1px solid #c1c1c1;" width="50%">$advamount</td>					
				</tr>				
				<tr style="border:1px solid #dedede;color:#000;text-align:center;font-size:14px; ">
					<td style="border: 1px solid #c1c1c1;  background:#000;" width="50%">Received Amount</td>
					<td style="border: 1px solid #c1c1c1;" width="50%">$recvamount</td>					
				</tr>
				<tr style="border:1px solid #dedede;color:#000;text-align:center; font-size:14px;">
					<td style="border: 1px solid #c1c1c1;  background:#000;" width="50%">Balance Amount</td>
					<td style="border: 1px solid #c1c1c1;" width="50%">$balance</td>					
				</tr>
				<tr style="border:1px solid #dedede;color:#000;text-align:center;font-size:14px; ">
					<td style="border: 1px solid #c1c1c1;  background:#000;" width="50%">Total Amount</td>
					<td style="border: 1px solid #c1c1c1;" width="50%">$type</td>					
				</tr>
			</tbody>
		</table>
		<br><br>
		<img src="pdf-img.png" alt="Smiley face"  width="300" height="160"/>
		
		<br><br>
		<br/>
		<br/><br/><br/>
		<br/><br/><br/>
				<div style="text-align:center">
			<h4 style="font-weight: bold; font-size:17px">You are one among our prestigious clients. Thank you for choosing PayRentz</h4>
			<P style="font-style: italic;">Happy to hear from you, do reach us if u have a suggestion/feedback</p>
			<p>
			           No.24/53, Eldams Road, Teynampet, Chennai - 600 018<br>
			Tel: 044 - 3100 3040 / 3100 4050, E-mail:<a href="mailto:"> rent@payrentz.com</a>, Web:<a href=""> www.payrentz.com</a></p>
		</div>
		
	
EOF;

// output the HTML content

$pdf->writeHTML($html, true, false, true, false, '');
	
$filepath = $_SERVER["DOCUMENT_ROOT"].'payrtz/Documents/customer/'.$customerid.'/'.$customername.'-'.$dateee.'-'.$month.'.pdf';

	// $pdf->Write(0, $html, '', 0, 'C', true, 0, false, false, 0);
$pdf->Output($_SERVER["DOCUMENT_ROOT"].'/payrtz/Documents/customer/'.$customerid.'/'.$customername.'-'.$dateee.'-'.$month.'.pdf','F');

	//PHPMailer Object
$mail = new PHPMailer;
//From email address and name
$mail->From = "accounts@payrentz.com";
$mail->FromName = "Payrentz";
$msg ='Please FYA';
$mail->addAddress("navitha0511@gmail.com");

$mail->addReplyTo("accounts@payrentz.com", "Reply");

$mail->addBCC("navitha0511@gmail.com");

$mail->isHTML(true);

$mail->Subject = "Advance Receipt - PayRentz";

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

$mail->AddAttachment($_SERVER["DOCUMENT_ROOT"].'/payrtz/Documents/customer/'.$customerid.'/'.$customername.'-'.$dateee.'-'.$month.'.pdf');
$mail->send();


echo $filepath;
?>