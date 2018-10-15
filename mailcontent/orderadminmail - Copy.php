<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$sel = $conn->select_query(ORDER,"*","ord_id='".$_SESSION['ses_oid']."'","1");
 $userdetails = $conn->select_query(USER,"*","user_id='".$sel['customer_id']."'","1");
$from=$userdetails['user_email'];
$fromname=$userdetails['user_name'];
$sub="Order placed - ".$sel['order_id'];

 $to=$EXTRA_ARG['set_email'];
 $id=$_SESSION['ses_oid'];
if($_SESSION['ses_oid']!='')
{
	
	$sel = $conn->select_query(ORDER,"*","ord_id='".$_SESSION['ses_oid']."'","1");
	
	$orderdet = $conn->select_query(ORDERPRODUCT,"*","order_id='".$id."'","");

$userdetails = $conn->select_query(USER,"*","user_id='".$sel['customer_id']."'","1");
//billing add
$billingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$sel['customer_id']."' AND address_id='".$sel['bill_add_id']."'","1");

//shipping add
$shippingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$sel['customer_id']."' AND address_id='".$sel['ship_add_id']."'","1");


 $billstate = $conn->select_query(STATE,"*","zone_id='".$sel['bill_state']."'","1");
 $shipstate = $conn->select_query(STATE,"*","zone_id='".$sel['ship_state']."'","1");
 $paymethod=($sel['paymethod']=='COD')? "Cash Payable":$sel['paymethod'];

$user = $conn->select_query(USER,"*","user_id='".$sel['customer_id']."'","1");
 $order_status = $conn->select_query(ORDERSTATUS,"*","order_status_id='".$sel['order_status_id']."' AND status='Y'","1");
 
}else
{
	   $conn->divert(SITE_URL);
}

$message='<table width="100%" bgcolor="#dfdfdf" border="0" cellspacing="10" cellpadding="0" style="padding-top:10px;">
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff; margin-top:0px;">
        <tr>
          <td bgcolor="#2d2d2d" height="36" style="font-size:12px;	font-family:Arial, Helvetica, sans-serif;	color:#e4e4e4;	text-align:left;	font-weight:bold; padding-left:14px;">'.$sub.'</td>
        </tr>
        <tr>
          <td bgcolor="#30B1F2" style="line-height:3px;">&nbsp;</td>
        </tr>
        <tr>
          <td style="line-height:11px;"><img src="'.SITE_URL.'/images/mail-banner.jpg" /></td>
        </tr>
        <tr>
          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:4px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td><table align="center" border="0" cellspacing="0" width="100%">
                         <tbody>
                        <tr>
                          <td width="72%" height="30" class="heading1">Order Details : '.$sel['order_id'].' </td>
                          <td width="15%"><table width="70%" border="0" align="right" cellpadding="0" cellspacing="0">
                              <tbody>
                              
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
                <tr>
                  <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr style="background: #E4E4E4 none repeat scroll 0 0;
    border: 1px solid #C3C3C3;" class="head_bg">
                          <td style="color: #2C2C2C; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; line-height: 16px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_head" height="28" colspan="2">Shopping Cart Items</td>
                     <td style="color: #2C2C2C; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; line-height: 16px; padding-left: 10px; text-align: left; text-decoration: none;" width="14%" class="form_head" height="28">Security Deposit</td>
                          <td style="color: #2C2C2C; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; line-height: 16px; padding-left: 10px; text-align: left; text-decoration: none;" width="14%" class="form_head" height="28">Handling Charge</td>
                          <td style="color: #2C2C2C; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; line-height: 16px; padding-left: 10px; text-align: left; text-decoration: none;" width="17%" class="form_head" height="28">Qty</td>
						  
						   <td style="color: #2C2C2C; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold; line-height: 16px; padding-left: 10px; text-align: left; text-decoration: none;" width="17%" class="form_head" height="28">Price</td>
						   
                        </tr>'; 
			$i=1;
      $totdep=0;
      $tothand=0
			 foreach($orderdet['result'] as $resdet){
				
								$tot=$resdet['quantity']*round($resdet['security_deposite']+$resdet['handling_price']);								
								$totdep +=$resdet['quantity']*$resdet['security_deposite'];
								$tothand +=$resdet['quantity']*$resdet['handling_price'];
						
                           $message.='<tr>
						   <td  class="form_text3"><strong>'.$resdet['name'].' </strong> </td>
                          <td width="27%" style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="37%" width="63%" height="30" class="form_text">'.$resdet['quantity'] .' x Rs  '. round($resdet['security_deposite']+$resdet['handling_price']).' </td>
                            <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;"  class="form_text">'. round($resdet['security_deposite']).'</td>
                              <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'. round($resdet['handling_price']) .'</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;"  sclass="form_text">'. $resdet['quantity'] .'</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;"  class="form_text">Rs &nbsp;'. $tot .'</td></tr>';}
                               
                          $message.= '<tr>
                          <td colspan="5"><table width="121%" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                 <tr class="row_color">
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="64%" height="30" class="form_text">&nbsp;</td>
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" colspan="2" valign="bottom" class="form_text">Total Deposit :</td>
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="17%" valign="bottom" class="form_text">Rs '.$totdep.'</td>
                                </tr>
                             
                                <tr class="row_color">
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="64%" height="30" class="form_text">&nbsp;</td>
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px;  text-align: left; text-decoration: none;" colspan="2" valign="bottom" class="form_text">Handling Charge :</td>
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="17%" valign="bottom" class="form_text">Rs '.$tothand.'</td>
                                </tr>
                                 <tr class="row_color">
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="64%" height="30" class="form_text">&nbsp;</td>
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" colspan="2" valign="bottom" class="form_text">Total Payout :</td>
                                  <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="17%" valign="bottom" class="form_text">Rs '.round($sel['total']).'</td>
                                </tr>
                                <tr>
                                  <td colspan="4" class="dot">&nbsp;</td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table>
                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr class="row_color">
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="37%" width="19%" class="form_text"><strong>Payment Mode</strong></td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="37%" width="3%" class="form_text"><strong>:</strong></td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="37%" width="78%" class="form_text"><strong>'.$paymethod.'</strong></td>
                        </tr>
                       
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="37%" class="form_text"><strong>Date</strong></td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="37%" class="form_text"><strong>:</strong></td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="37%" class="form_text"><strong>'.date('d-m-Y',strtotime($sel['ord_date'])).'</strong></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
             
                <tr>
                  <td><table width="49%" border="0" cellspacing="0" cellpadding="0" style="float:left">
                      <tbody>
                        <tr style="background: #E4E4E4 none repeat scroll 0 0;
    border: 1px solid #C3C3C3;" class="head_bg">
                          <td style="    color: #2C2C2C; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; font-weight: bold;
 line-height: 16px; padding-left: 10px;text-align: left; text-decoration: none;" colspan="3" class="form_head" height="28">Billing Information</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="27%" class="form_text">Name</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="3%" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="70%" class="form_text">'. ucfirst($billingadd['firstname']).' </td>
                        </tr>
                        <tr class="row_color">
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">E-mail</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="70%" class="form_text">'. $billingadd['email_id'].'</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">Mobile</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="70%" class="form_text">'.  $billingadd['mobile_no'] .'</td>
                        </tr>
                        
                        
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" valign="top" class="form_text">Address</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" valign="top" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'.  $sel['bill_address'] .'</td>
                        </tr>
                        <tr class="row_color">
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">City</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'.  $sel['bill_city'].'</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">State</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'. $billstate['name'].'</td>
                        </tr>
                        <tr class="row_color">
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">Zip Code</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'. $sel['bill_pincode'].'</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">Country</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'.  'India' .'</td>
                        </tr>
                      </tbody>
                    </table>
                    <table width="49%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr style="background: #E4E4E4 none repeat scroll 0 0;
    border: 1px solid #C3C3C3;" class="head_bg">
                          <td height="28" colspan="3" class="form_head">Ship to  Information </td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="29%" class="form_text">Name</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="6%" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="65%" class="form_text">'.  ucfirst($shippingadd['firstname']).' </td>
                        </tr>
                        <tr class="row_color">
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">E-mail</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="65%" class="form_text">'.  $shippingadd['email_id'].'</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">Mobile</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" width="65%" class="form_text">'.  $shippingadd['mobile_no'].'</td>
                        </tr>
                        
                       
                        
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" valign="top" class="form_text">Address</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" valign="top" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'.  $sel['ship_address'] .'</td>
                        </tr>
                        <tr class="row_color">
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">City</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'. $sel['ship_city'].'</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">State</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'.  $shipstate['name'].'</td>
                        </tr>
                        <tr class="row_color">
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">Zip Code</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'.$sel['ship_pincode'].'</td>
                        </tr>
                        <tr>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">Country</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">:</td>
                          <td style="border-bottom: 1px solid #f2f2f2; color: #515050; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px; line-height: 40px; padding-left: 10px; text-align: left; text-decoration: none;" class="form_text">'.'India'.'</td>
                        </tr>
                      </tbody>
                    </table></td>
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
  
//echo $to, $sub, $message; exit;

$mail = new PHPMailer;
$mail->setFrom($from,$fromname);
$mail->addAddress($to);
$mail->Subject =$sub;
$mail->msgHTML($message);		
$mail->send();

		
?>