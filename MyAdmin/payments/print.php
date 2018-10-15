<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";
$id = $conn->variable($q);

$sel = $conn->select_query(ORDER,"*","ord_id='".$id."'","1");
$orderdet = $conn->select_query(ORDERPRODUCT,"*","order_id='".$id."'","");

$userdetails = $conn->select_query(USER,"*","user_id='".$sel['customer_id']."'","1");
//billing add
$billingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$sel['customer_id']."' AND address_id='".$sel['bill_add_id']."'","1");

//shipping add
$shippingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$sel['customer_id']."' AND address_id='".$sel['ship_add_id']."'","1");


 $billstate = $conn->select_query(STATE,"*","zone_id='".$sel['bill_state']."'","1");
 $shipstate = $conn->select_query(STATE,"*","zone_id='".$sel['ship_state']."'","1");
 

$user = $conn->select_query(USER,"*","user_id='".$sel['customer_id']."'","1");
 $order_status = $conn->select_query(ORDERSTATUS,"*","order_status_id='".$sel['order_status_id']."' AND status='Y'","1");
 #Admin Html head
$conn->adminHtmlhead();
$conn->admninBody();
?>

    <section class="content">
     
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-body">
                    
                
                <div class="col-lg-12">
                   <div class="text-right">
                     <button onclick="print()">print</button>
                   </div>
                </div>
                <div class="printback-bg">
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                     <div class="print-back-img"><img src="<?php echo ADMIN_URL ?>user/payrentz-logo.png" class="img-responsive" /></div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                  <div class="text-right">
                     <h1>Application Form</h1>
                     <div class="box-print"> <p> #</p></div>
                   </div>
                  </div>
                  </div>
                 <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td height="55"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td width="72%" height="30" class="heading1">Order Details : <?php echo $sel['order_id']; ?></td>
                          <td width="15%"><table width="70%" border="0" align="right" cellpadding="0" cellspacing="0">
                              <tbody>
                                <!--<tr>
                            <td width="30%"><img src="images/icon/back_icon.gif" width="20" height="14"></td>
                            <td width="70%"><a href="javascript:history.go(-1)" class="backlink">Back</a></td>
                          </tr>-->
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
                <tr>
                  <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr class="head_bg">
                          <td class="form_head" height="28" colspan="2">Shopping Cart Items</td>
                          <td width="13%" class="form_head" height="28">Duration</td>
                           <td width="12%" class="form_head" height="28">Security Deposit</td>
                            <td width="12%" class="form_head" height="28">Handling Charge</td>
                          <td width="12%" class="form_head" height="28">Qty</td>
                          <td width="20%" class="form_head" height="28">Price</td>
                        </tr>
                        <?php if($orderdet['nr']){
							foreach($orderdet['result'] as $resdet){
								
								$tot=$resdet['quantity']*round($resdet['security_deposite']+$resdet['handling_price']);
								
								$totdep +=$resdet['quantity']*$resdet['security_deposite'];
								$tothand +=$resdet['quantity']*$resdet['handling_price'];
								if($sel['paymethod']=='COD')
								{
									$paymethod='Cash Payable';
								}else
								{
									$paymethod=$sel['paymethod'];
								}
								
								if($resdet['cat_id']!='3')
				{
					$dutext='Month';
					if($resdet['month_days']=='12')
					{
						$monthdays='Above 3';
					}else
					{
						$monthdays=$resdet['month_days'];
					}
					
				}else
				{
					$dutext='Days';
					$monthdays=$resdet['month_days'];
				}
				
							?>
                        <tr>
                      <td width="9%" class="form_text3"><strong><?php echo $resdet['name'] ?></strong> </td>
                          <td width="22%" class="form_text"><?php echo $resdet['quantity'] ?> x ₹  <?php echo round($resdet['security_deposite']+$resdet['handling_price']) ?> </td>
                         <td class="form_text"><?php echo $monthdays.'&nbsp;'.$dutext; ?></td>
                            <td class="form_text"><?php echo round($resdet['security_deposite']); ?></td>
                              <td class="form_text"><?php echo round($resdet['handling_price']); ?></td>
                          <td class="form_text"><?php echo $resdet['quantity'] ?></td>
                          <td class="form_text">₹ &nbsp;<?php echo $tot; ?></td>
                        </tr>
                       <?php }}?>
                        <tr>
                          <td colspan="5"><table width="121%" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr class="row_color">
                                  <td width="64%" height="30" class="form_text">&nbsp;</td>
                                  <td colspan="2" valign="bottom" class="form_text">Total Deposit :</td>
                                  <td width="17%" valign="bottom" class="form_text">₹ <?php echo $totdep ?></td>
                                </tr>
                               <!-- <tr>
                                  <td width="61%" height="30" class="form_text">&nbsp;</td>
                                  <td colspan="2" valign="bottom" class="form_text">Shipping :</td>
                                  <td width="20%" valign="bottom" class="form_text">$ 0.00</td>
                                </tr>
                                <tr class="row_color">
                                  <td width="61%" height="30" class="form_text">&nbsp;</td>
                                  <td colspan="2" valign="bottom" class="form_text">COD Cost (0%) :</td>
                                  <td width="20%" valign="bottom" class="form_text">$ 0.00</td>
                                </tr>-->
                                <tr class="row_color">
                                  <td width="64%" height="30" class="form_text">&nbsp;</td>
                                  <td colspan="2" valign="bottom" class="form_text">Handling Charge :</td>
                                  <td width="17%" valign="bottom" class="form_text">₹ <?php echo $tothand ?></td>
                                </tr>
                                 <tr class="row_color">
                                  <td width="64%" height="30" class="form_text">&nbsp;</td>
                                  <td colspan="2" valign="bottom" class="form_text">Total Payout :</td>
                                  <td width="17%" valign="bottom" class="form_text">₹ <?php echo round($sel['total']); ?></td>
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
                          <td width="19%" class="form_text"><strong>Payment Mode</strong></td>
                          <td width="3%" class="form_text"><strong>:</strong></td>
                          <td width="78%" class="form_text"><strong><?php echo $paymethod ?></strong></td>
                        </tr>
                          <tr class="row_color">
                          <td width="19%" class="form_text"><strong>Payment Status</strong></td>
                          <td width="3%" class="form_text"><strong>:</strong></td>
                          <td width="78%" class="form_text"><strong><?php echo ucfirst($sel['payment_status']) ?></strong></td>
                        </tr>
                        <!--<tr>
                          <td width="19%" class="form_text"><strong>Delivery Type</strong></td>
                          <td width="3%" class="form_text"><strong>:</strong></td>
                          <td width="78%" class="form_text"><strong>Solefitness Team</strong></td>
                        </tr>
                        <tr class="row_color">
                          <td class="form_text"><strong>Coupon code</strong></td>
                          <td class="form_text"><strong>:</strong></td>
                          <td class="form_text"><strong> Not Entered </strong></td>
                        </tr>-->
                        <tr>
                          <td class="form_text"><strong>Date</strong></td>
                          <td class="form_text"><strong>:</strong></td>
                          <td class="form_text"><strong><?php echo date('d-m-Y',strtotime($sel['ord_date'])); ?></strong></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <!--<tr>
                  <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr class="head_bg">
                          <td colspan="3" class="form_head" height="28">Notes Information </td>
                        </tr>
                        <tr>
                          <td colspan="3">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>-->
                <tr>
                  <td><table width="49%" border="0" cellspacing="0" cellpadding="0" style="float:left">
                      <tbody>
                        <tr class="head_bg">
                          <td colspan="3" class="form_head" height="28">Billing Information</td>
                        </tr>
                        <tr>
                          <td width="27%" class="form_text">Name</td>
                          <td width="3%" class="form_text">:</td>
                          <td width="70%" class="form_text"><?php echo ucfirst($billingadd['firstname']); ?> </td>
                        </tr>
                        <tr class="row_color">
                          <td class="form_text">E-mail Address</td>
                          <td class="form_text">:</td>
                          <td width="70%" class="form_text"><?php echo $billingadd['email_id']; ?></td>
                        </tr>
                        <tr>
                          <td class="form_text">Mobile </td>
                          <td class="form_text">:</td>
                          <td width="70%" class="form_text"><?php echo $billingadd['mobile_no']; ?></td>
                        </tr>
                        
                        <!--<tr class="row_color">

                      <td class="form_text">Landline Number</td>

                      <td class="form_text">:</td>

                      <td width="70%" class="form_text">Nil</td>

                    </tr>-->
                        
                        <tr>
                          <td valign="top" class="form_text">Address</td>
                          <td valign="top" class="form_text">:</td>
                          <td class="form_text"><?php echo $sel['bill_address'] ?></td>
                        </tr>
                        <tr class="row_color">
                          <td class="form_text">City</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo $sel['bill_city'] ?></td>
                        </tr>
                        <tr>
                          <td class="form_text">State</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo $billstate['name'] ?></td>
                        </tr>
                        <tr class="row_color">
                          <td class="form_text">Pin/Zip Code</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo $sel['bill_pincode'] ?></td>
                        </tr>
                        <tr>
                          <td class="form_text">Country</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo 'India' ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <table width="49%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr class="head_bg">
                          <td height="28" colspan="3" class="form_head">Ship to  Information </td>
                        </tr>
                        <tr>
                          <td width="29%" class="form_text">Name</td>
                          <td width="6%" class="form_text">:</td>
                          <td width="65%" class="form_text"><?php echo ucfirst($shippingadd['firstname']); ?> </td>
                        </tr>
                        <tr class="row_color">
                          <td class="form_text">E-mail Address</td>
                          <td class="form_text">:</td>
                          <td width="65%" class="form_text"><?php echo $shippingadd['email_id']; ?></td>
                        </tr>
                        <tr>
                          <td class="form_text">Mobile</td>
                          <td class="form_text">:</td>
                          <td width="65%" class="form_text"><?php echo $shippingadd['mobile_no']; ?></td>
                        </tr>
                        
                        <!-- <tr class="row_color">

                      <td class="form_text">Landline Number</td>

                      <td class="form_text">:</td>

                      <td width="65%" class="form_text">Nil</td>

                    </tr>-->
                        
                        <tr>
                          <td valign="top" class="form_text">Address</td>
                          <td valign="top" class="form_text">:</td>
                          <td class="form_text"><?php echo $sel['ship_address'] ?></td>
                        </tr>
                        <tr class="row_color">
                          <td class="form_text">City</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo $sel['ship_city'] ?></td>
                        </tr>
                        <tr>
                          <td class="form_text">State</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo $shipstate['name'] ?></td>
                        </tr>
                        <tr class="row_color">
                          <td class="form_text">Pin/Zip Code</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo $sel['ship_pincode'] ?></td>
                        </tr>
                        <tr>
                          <td class="form_text">Country</td>
                          <td class="form_text">:</td>
                          <td class="form_text"><?php echo 'India'; ?></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            </div>
            <!-- /.box-body --> 
            <!-- /.box --> 
          </div>
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
   
<?php include "../common/footer-scripts.php"; ?>

</body></html>
