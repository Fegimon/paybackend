<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$fromname=SITE_NAME;
$sub="Change of password - ".SITE_NAME;
$message='<table width="100%" bgcolor="#dfdfdf" border="0" cellspacing="10" cellpadding="0" style="padding-top:10px;">
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff; margin-top:0px;">
        <tr>
          <td bgcolor="#2d2d2d" height="36" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#e4e4e4;	text-align:left;	font-weight:bold; padding-left:14px;">Change of password</td>
        </tr>
        <tr>
          <td bgcolor="#30B1F2" style="line-height:3px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="line-height:11px;"><img src="'.SITE_URL.'images/mail/mail-banner.jpg" /></td>
        </tr>
			  
			  <tr>
				<td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					  <td style="padding:4px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
						  <tr>
							<td><table align="center" border="0" cellspacing="0" width="100%">
							  <tbody>
								<tr>
								  <td height="30" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#3f3f3f;	text-align:left;">Dear <span style="font-size:11px;	font-family:Arial, Helvetica, sans-serif;	color:#3f3f3f;	text-align:left; font-weight:bold; text-transform:uppercase;">'.$uname.'</span></td>
								</tr>
								<tr>
								  <td height="30" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#3f3f3f; line-height:13pt;	text-align:justify; padding-bottom:5px;">Your password has been changed successfully.</td>
								</tr>
								<tr>
								  <td height="30" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#3f3f3f; line-height:13pt;	text-align:justify; padding-bottom:5px;">Your login details :-</td>
								</tr>
								<tr>
								  <td><table align="center" border="0" cellspacing="10" width="100%"   style="background:#f7f7f7; border:1px solid #e8e8e8; -moz-border-radius:7px; -webkit-border-radius: 7px; -khtml-border-radius: 7px; border-radius: 7px;">
									<tbody>
									  <tr>
										<td width="34%" style="font-size:11px;	font-family:Arial, Helvetica, sans-serif;	color:#000000;	text-align:left;	padding-left:15px;	font-weight:bold;">Email ID/Username</td>
										<td width="4%" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#000;	text-align:left; line-height:20px;">:</td>
										<td width="62%" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#000;	text-align:left; line-height:20px;">'.$user_email.'</td>
									  </tr>
									  <tr>
										<td style="font-size:11px;	font-family:Arial, Helvetica, sans-serif;	color:#000000;	text-align:left;	padding-left:15px;	font-weight:bold;">Password</td>
										<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#000;	text-align:left; line-height:20px;">:</td>
										<td style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#000;	text-align:left; line-height:20px;">'.$new_pass.'</td>
									  </tr>
									</tbody>
								  </table></td>
								</tr>
								
								<tr>
								  <td style="font-size:11px; color:#fff; line-height:5px;">.</td>
								</tr>
							  </tbody>
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
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
$headers .= "From: $fromname <$from>" . "\r\n";
//echo $to, $sub, $message,$headers; exit;
@mail($to, $sub, $message, $headers);

?>