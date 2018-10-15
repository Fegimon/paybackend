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
        $this->Cell(0, 15, 'QUOTATION', 0, false, 'R', 0, '', 0, false, 'T', 'M');


    }

    // Page footer
    public function Footer() {

		$this->SetY(-38);
        // Set font
        $this->SetFont('helvetica', 'B', 12);
		$this->Cell(0, 10, 'You are one among our prestigious clients. Thank you for choosing PayRentz', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->SetY(-32);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, 'Happy to hear from you, do reach us if u have a suggestion/feedback', 0, false, 'C', 0, '', 0, false, 'T', 'M');

		$this->SetY(-26);
        // Set font
        $this->SetFont('helvetica', '', 8);
		$this->Cell(0, 10, 'No.24/53, Eldams Road, Teynampet, Chennai - 600 018', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetY(-22);
        // Set font
        $this->SetFont('helvetica', '', 8);
		$this->Cell(0, 10, '
			Tel: 044 - 3100 3040 / 3100 4050, E-mail: rent@payrentz.com, Web: www.payrentz.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->SetY(-18);
        // Set font
        $this->SetFont('helvetica', 'B', 8);
		$this->Cell(0, 10, 'CIN No : U71309TN2016PTC113411 / GSTIN : 33AAICP8598H1ZT ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->SetY(-12);
        // Set font
        //$this->SetFont('helvetica', 'I', 8);
       // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

 @$c_id = $_POST['c_id'];
 @$e_id = $_POST['e_id'];

  $s_id = explode(",",$c_id);
  $c = count($s_id);
  $t=date('d-m-Y');
  $c_t=date("jS F, Y", strtotime($t));



 for ($x = 0; $x < $c; $x++) {


 if($s_id[$x] == 'Non Customer')
 {

 $cid = $e_id;
 $getcostomerDetail = $functs->fngettempcostomerDetail($cid);
 $c_name=$getcostomerDetail["customer_name"];
 $gender=$getcostomerDetail["gender"];
 $c_email=$getcostomerDetail["email"];
 $split_c_email= explode(",",$c_email);
 $t_mail_length= count($split_c_email);
 $e_a = $getcostomerDetail["extra_amount"];
 $getcostomerAddress = $functs->fngettempcostomerAddress($cid);
 $c_address = $getcostomerAddress["address"];
 $html_tr3='';
 $getContact   = $functs-> fngettempContact($cid);
 $c_contact    = $getContact["mobile"];
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
 }
 else
 {

 $cid = $s_id[$x];
 $getcostomerDetail = $functs->fngetcostomerDetail($s_id[$x]);
 $c_name=$getcostomerDetail["customer_name"];
 $gender=$getcostomerDetail["gender"];
 $c_email=$getcostomerDetail["email"];
 $split_c_email= explode(",",$c_email);
 $t_mail_length= count($split_c_email);
 $e_a = $getcostomerDetail["extra_amount"];
 $getcostomerAddress = $functs->fngetcostomerAddress($s_id[$x]);
 $c_address = $getcostomerAddress["address"];
 $html_tr3='';
 $getContact   = $functs-> fngetContact($s_id[$x]);
 $c_contact    = $getContact["mobile"];

 //$i_month = $getGeneralInvoiceDetail ["month"];
 // $i_id = $getGeneralInvoiceDetail ["id"];
 // $i_year = $getGeneralInvoiceDetail ["year"];
 // $p_r_c = $getcostomerDetail ["pending_cost"];
 //$lpc = $getcostomerDetail ["lpc"];
 // $lpc  = sprintf("%01.2f", $lpc);

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





 }

 $getQuotationGenralDetail  = $functs->quotationGenralDetail($e_id);
 $i_date = $getQuotationGenralDetail["enquiry_date"];
 $i_date = date("jS F, Y", strtotime($i_date));
 $getQuotationProductDetail = $functs->quotationProductDetail($e_id);
 $received = $getQuotationGenralDetail["received"];
 $received     = sprintf("%01.2f", $received);

$c_g_i = count($getQuotationProductDetail);
$o_total =0;
$t_quty =0;
$t_rent =0;
$t_adv =0;
$t_hc =0;
  for($y = 0; $y < $c_g_i; $y++)
  {
	  $security  = $getQuotationProductDetail[$y]['quantity'] * $getQuotationProductDetail[$y]['security_deposit_amount'];
	  $security  = sprintf("%01.2f", $security);
	  $process   = $getQuotationProductDetail[$y]['quantity'] * $getQuotationProductDetail[$y]['processing_fee'];
	  $process   = sprintf("%01.2f", $process);
	  $ins       = $getQuotationProductDetail[$y]['quantity'] * $getQuotationProductDetail[$y]['ins_fee'];
	  $rent      = $getQuotationProductDetail[$y]['quantity'] * $getQuotationProductDetail[$y]['rent_per_month'];
	  $rent      = sprintf("%01.2f", $rent);
	  $total     = $security + $process + $ins;
	  $total     = sprintf("%01.2f", $total);
	  $o_total   = $total+$o_total;



	  //total
	   $t_quty     = $t_quty+$getQuotationProductDetail[$y]['quantity'];
	   $t_rent     = $t_rent+$rent;
	   $t_rent     = sprintf("%01.2f", $t_rent);
	   $t_adv      = $t_adv+$security;
	   $t_adv      = sprintf("%01.2f", $t_adv);
       $t_hc       = $t_hc+$process+$ins ;
	   $t_hc       = sprintf("%01.2f", $t_hc);

       $ins = sprintf("%01.2f", $ins);
	  $html_tr3 .='<tr   style="border:1px solid #dedede;text-align:center; ">
  <td style="border: 1px solid #c1c1c1;  background:#000;text-align:left;" width="50%">'.$getQuotationProductDetail[$y]['pr_sub_name'].' '.$getQuotationProductDetail[$y]['name'].' </td>
					<td style="border: 1px solid #c1c1c1;" width="6%">'.$getQuotationProductDetail[$y]['quantity'].'</td>
					<td style="border: 1px solid #c1c1c1;" width="16%">'.$rent.'</td>
					<td style="border: 1px solid #c1c1c1;" width="16%">'.$security.'</td>
					<td style="border: 1px solid #c1c1c1;" width="16%">'.sprintf("%01.2f",$process+$ins).'</td>
				</tr>';






  }




 $o_total     = sprintf("%01.2f", $o_total);
 $t_total     = $o_total-$received;
 $t_total     = sprintf("%01.2f", $t_total);




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

						<td  style="border:1px solid #dedede; font-size:12px;" width="20%">$c_t</td>
					</tr>
					<tr>
					        <td rowspan="2" colspan="3"><span>$c_address.</span></td>
							<td></td>
						<td >Enquiry #:</td>

						<td style="border:1px solid #dedede;font-size:12px">$e_id</td>
					</tr>
					<tr>

					        <td></td>
						<td>Enquiry On:</td>

						<td style="border:1px solid #dedede;font-size:12px">$i_date</td>
					</tr>
					<tr>
					        <td colspan="3">$c_contact.</td>
					        <td></td>
						<td></td>

						<td ></td>
					</tr>
					<tr>
					            <td colspan="3">E-mail : <a href="mailto:" style="font-size:12px">$c_email</a></td>
					        	<td></td>
						<td></td>

						<td > </td>
					</tr>
				</table>
			</div>
		</header>
		<table style=" width: 100%;">



			<tbody>
			<tr   style="border:1px solid #dedede; background-color: #0000B7;color:#fff;text-align:center; ">
					<td style="border: 1px solid #c1c1c1;  background:#000;" width="50%">Product  Description</td>
					<td style="border: 1px solid #c1c1c1;" width="6%">Units</td>
					<td style="border: 1px solid #c1c1c1;" width="16%">Rent Month</td>
					<td style="border: 1px solid #c1c1c1;" width="16%">Rental Deposit (Refundable)</td>
					<td style="border: 1px solid #c1c1c1;" width="16%">Handling Charges(HC)</td>
				</tr>

				$html_tr3
				<tr   style="border:1px solid #dedede;text-align:center; ">
  <td style="border: 1px solid #c1c1c1;  background:#000;text-align:left;" width="50%"></td>
					<td style="border: 1px solid #c1c1c1;background-color:#d4d4d4" width="6%">$t_quty</td>
					<td style="border: 1px solid #c1c1c1;background-color:#d4d4d4" width="16%">$t_rent</td>
					<td style="border: 1px solid #c1c1c1;background-color:#d4d4d4" width="16%">$t_adv</td>
					<td style="border: 1px solid #c1c1c1;background-color:#d4d4d4" width="16%">$t_hc</td>
				</tr>


			</tbody>
		</table>



		<br>
		<br>
<br>

<br>
<br>
<br>
			<table >
					<tr>
					    <td  width="62%" style="border:1px solid #dedede ;text-align:center;"><span style="font-size:11px">Make all Cheque/Online Payments to </span>

						</td>
                                                <td width="3%"></td>
						<td width="19%">Security Deposit</td>

						<td  width="17%" style="text-align:right"> $t_adv</td>
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
						<td>Handling Charges</td>

						<td style="text-align:right">$t_hc</td>

					</tr>
					<tr>
					 <td></td>
					 <td>Received</td>

						<td style="text-align:right">$received</td>


					</tr>
					<tr>
					 <td></td>
						<td  style=" border-bottom:1px solid #dedede ;border-top:1px solid #dedede ; border-left:1px solid #dedede ;">Total</td>

						<td style="text-align:right; border-bottom:1px solid #dedede ;border-top:1px solid #dedede ; border-right:1px solid #dedede ;  ">Rs. $t_total</td>
					</tr>
					<tr>
					 <td></td>
						<td></td>

						<td ></td>

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
				<p>Important NOTES </p>
		<ul>
<li>Acceptable ID proof is Aadhar Card/  Passport/ Driving License/ Pan Card</li>
<li>In case of rented property, a copy of Rental agreement is mandatory.</li>
<li>Minimum rental period is three months. (Subject to change from time to time)</li>
<li>Security deposit in refundable upon satisfactory return of the product.</li>
<li>Rent is postpaid and it has to be paid on or before 7th of every month.</li>
<li>2 week’s notice to be provided to end contract.</li>
<li>Handling charges covers delivery, pickup, installation & uninstallation of the product.
<li>In case of an Air Conditioner, Installation charges are Rs 1,500 per AC.  If the Installation requires MCB, Iron grill, extra copper wire, ladder and rope then it will be charged on actuals. ( Indicative cost for MCB Box is Rs 500, Iron Grill-Rs 750, Extra Copper Wire- Rs 650 per meter, Ladder/ Rope- Rs 400)</li>
		</ul>










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

$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/payrentz/quote'.$e_id.'.pdf', 'F');

 //PHPMailer Object
//$mail = new PHPMailer;


//PHPMailer Object
$mail = new PHPMailer;
//$mail->setFrom('accounts@payrentz.com', 'Your Name');
//$mail->addAddress('simb143123@gmail.com', 'My Friend');


//From email address and name
$mail->From = "rent@payrentz.com";
$mail->FromName = "Payrentz";
$msg ='Please FYA';

//$mail->addAddress('simb143123@gmail.com', 'My Friend');



//$mail->AddAttachment("http://knowyourprocess.in/demo-vt/VT13454089.pdf");


//To address and name
	$mail->addBCC("silambarasandp12@gmail.com");

	$mail->addBCC("seo.payrentz@gmail.com");
        $mail->addBCC("rent@payrentz.com");


 for ($l = 0; $l < $t_mail_length; $l++) {

// print_r($split_c_email[$l]);

// $mail->addAddress($split_c_email[$l]);
  }


$mail->addReplyTo("accounts@payrentz.com", "Reply");

//CC and BCC
$mail->addAddress("seo.payrentz@gmail.com");
//$mail->addAddress("silambarasandp12@gmail.com");
//$mail->addAddress("rent@payrentz.com");
//$mail->addAddress("silambarasandp12@gmail.com");

$mail->AddAttachment($_SERVER["DOCUMENT_ROOT"] . '/payrentz/quote'.$e_id.'.pdf');

$mail->Subject  = 'Quotation - '.$n_front.''.$c_name.'';
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
Thank you for choosing PayRentz for your rental needs.
</p>
<p style="padding: 0 20px;text-align: justify;">
As per our discussion, please find enclosed quotation that comprises details of monthly rent, refundable Security Deposit and handling charges for renting the products indicated by you.
</p>
<p style="padding: 0 20px;text-align: justify;">
Please find the attached application form to be duly filled and signed by you. Along with the application form , kindly share a copy of your ID/ Address proof and a latest passport size photograph.
</p>
<p style="padding: 0 20px;text-align: justify;">
Delivery / Installation will be done in 2/3 days after receipt of duly filled application, supporting documents and payment.
</p>
<p style="padding: 0 20px;text-align: justify;">
At PayRentz, it is always our endeavour to provide remarkable client experience and serve each client with utmost dedication and trust.
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




<tr><td><p style="padding: 0 20px;margin-bottom: 10px;"> Please feel free to write to us/call us for any queries.</p></td></tr>
<tr><td><p style="padding: 0 20px;margin-bottom: 10px;">Team – PayRentz</p></td></tr>
<tr><td><a style="padding: 0 20px;margin-bottom: 10px;" href="mailto:www.payrentz.com">www.payrentz.com</a></td></tr>


<tr><td style="text-align: center; background: #3C8DBC; color: #b0cade;" colspan="2"><p style="padding: 0 20px;">
<a href="https://www.facebook.com/PayRentz-1679677475596048/" target="_blank"><img style="border: none;" src="http://dewpondtechnologies.com/payrentz/assets/images/facebook.png" /></a>
<a href="https://twitter.com/PayRentz" target="_blank"><img style="border: none;" src="http://dewpondtechnologies.com/payrentz/assets/images/twitter.png" /></a>
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
