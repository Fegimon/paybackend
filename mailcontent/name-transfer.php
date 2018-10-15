<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$from=$EXTRA_ARG['set_email'];
$fromname=SITE_NAME;
$sub="Name Transfer Request- ".$from;
$sub1="Thank you for your Name Transfer Request.";
$message='<table width="100%" bgcolor="#dfdfdf" border="0" cellspacing="10" cellpadding="0" style="padding-top:10px;">
	  <tr>
		<td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff; margin-top:0px;">
			<tr>
			  <td bgcolor="#2d2d2d" height="36" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#e4e4e4;	text-align:left;	font-weight:bold; padding-left:14px;">Name Transfer Request</td>
			</tr>
			<tr>
			  <td bgcolor="#30B1F2" style="line-height:3px;">&nbsp;</td>
			</tr>
			<tr>
			  <td style="line-height:11px;"><img src="'.SITE_URL.'/images/mail-banner.jpg" /></td>
			</tr>
			
			<tr>
			  <td style="padding-top:0px; padding-bottom:10px;"><table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #e8e9eb;  -webkit-border-radius: 3px; -moz-border-radius: 3px;border-radius: 3px; margin-top:18px">
				  <tr>
					<td style="padding:3px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
						<tr>
						  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#fbfbfb;">
							  <tr>
								<td width="36%" height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">Name</td>
								<td width="1%" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td width="63%"  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$name.'</td>
							  </tr>
							  <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">Email</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$email.'</td>
							  </tr>
							  <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">Mobile No</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$mobile.'</td>
							  </tr>
							  
							    <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">Order Id</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$mainord_id.'</td>
							  </tr>
							  
							  <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">Products</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$pronames.'</td>
							  </tr>
							  
							   <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">New Name</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$new_name.'</td>
							  </tr>
							  
							   <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">New Email id</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$new_email.'</td>
							  </tr>
							   <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">New Mobile Number</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$new_mobile.'</td>
							  </tr>
							   <tr>
								<td height="33" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;	padding-left:15px;">Address</td>
								<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">:</td>
								<td  style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#6d6d6d;	text-align:left;">'.$new_address.'</td>
							  </tr>
							</table></td>
						</tr>
					  </table></td>
				  </tr>
				</table></td>
			</tr>
			<tr>
			  <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#3f3f3f; background:#fafafa; line-height:30px; text-align:center;"><div class="footer-con">
				  <p><strong>Have a Great Day</strong>, Thanks &amp; Regards, <strong style="color:#0fb2e4;">Customer Care Team</strong></p>
				</div></td>
			</tr>
			<tr>
			  <td bgcolor="#30B1F2" style="line-height:1px;">&nbsp;</td>
			</tr>
	
	
		  </table></td>
	  </tr>
	</table>';
	
	$message1='<table width="100%" bgcolor="#dfdfdf" border="0" cellspacing="10" cellpadding="0" style="padding-top:10px;">
	  <tr>
		<td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff; margin-top:0px;">
			<tr>
			  <td bgcolor="#2d2d2d" height="36" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#e4e4e4;	text-align:left;	font-weight:bold; padding-left:14px;">Thank you for your Name Transfer Request.</td>
			</tr>
			<tr>
			  <td bgcolor="#30B1F2" style="line-height:3px;">&nbsp;</td>
			</tr>
			<tr>
			  <td style="line-height:11px;"><img src="'.SITE_URL.'/images/mail-banner.jpg" /></td>
			</tr>
			<tr>
			  <td style="padding-top:0px; padding-bottom:10px;"><table align="center" border="0" cellspacing="0" width="86%" style="margin-top:5px">
				  <tbody>
					<tr>
					  <td height="30" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#3f3f3f;	text-align:left;">Dear <span style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#3f3f3f;	text-align:left; font-weight:bold; text-transform:uppercase;">'.$name.',</span></td>
					</tr>
					<tr>
					  <td height="30" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#3f3f3f; line-height:13pt;	text-align:justify; padding-bottom:5px;">Thanks for your Name Transfer Request.We will contact you soon.</td>
					</tr>
					<tr>
					  <td></td>
					</tr>
				  </tbody>
				</table></td>
			</tr>';
		/*$Ads=$conn->select_query(ADS, "*", "ads_type='email' AND ads_status='Y' ORDER BY RAND()",1);
		if($Ads['nr'])
		{
			if($Ads['ads_image'])
			{
				$adsexist = $conn->image_exist($Ads['ads_image'],"uploads/ads/");
				if($adsexist)
				{*/
					//$message1.='<tr>
       /*?>    <td style="line-height:11px;"><img src="'.SITE_URL.'uploads/ads/'.$Ads['ads_image'].'" /></td>
        </tr>';
				}
			}
		}<?php */
        $message1.='
			<tr>
			  <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#3f3f3f; background:#fafafa; line-height:30px; text-align:center;"><div class="footer-con">
				  <p><strong>Have a Great Day</strong>, Thanks &amp; Regards, <strong style="color:#0fb2e4;">Customer Care Team</strong></p>
				</div></td>
			</tr>
			<tr>
			  <td bgcolor="#30B1F2" style="line-height:1px;">&nbsp;</td>
			</tr>
		  </table></td>
	  </tr>
	</table>';
  
/*echo $to, $sub, $message; 
echo $to1, $sub1, $message1; 
exit;*/



$mail = new PHPMailer;
			$mail->setFrom($from,$fromname);
			$mail->addAddress($to);
			$mail->Subject =$sub;
			$mail->msgHTML($message);		
			$mail->send();
			
			
			$mail1 = new PHPMailer;
			$mail1->setFrom($from1,$fromname1);
			$mail1->addAddress($to1);
			$mail1->Subject =$sub1;
			$mail1->msgHTML($message1);		
			$mail1->send();

		
?>