<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$id=$_REQUEST['id'];
$sel = $conn->select_query(ORDER,"*","order_id='".$id."'","1");
if(!$sel['nr'])
{
	 $conn->divert(SITE_URL.'my-order.html');
}else
{
	$orderdet = $conn->select_query(ORDERPRODUCT,"*","order_id='".$sel['ord_id']."'","");
}

$userdetails = $conn->select_query(USER,"*","user_id='".$sel['customer_id']."'","1");
//billing add
$billingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$sel['customer_id']."' AND address_id='".$sel['bill_add_id']."'","1");

//shipping add
$shippingadd = $conn->select_query(USERADDRESS,"*","customer_id='".$sel['customer_id']."' AND address_id='".$sel['ship_add_id']."'","1");


 $billstate = $conn->select_query(STATE,"*","zone_id='".$sel['bill_state']."'","1");
 $shipstate = $conn->select_query(STATE,"*","zone_id='".$sel['ship_state']."'","1");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo-general.php";?>
<?php include "header.php"; ?>
<base href="<?php echo SITE_URL; ?>">
<?php include "tracker.php"; ?>
</head>
<body>
<div class="main">
<section id="">
<?php include 'menu.php';?>
</section>
<section id="inner-header">
  <div class="container-fluid">
    <div class="pull-left">
      <ol class="breadcrumb">
        <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
        <li class="active">My Order</li>
      </ol>
    </div>
  </div>
</section>
<section id="dashboard">
  <div class="container-fluid padding-none-class">
    <div class="my-order">
      <div class="col-md-3 col-xs-12 col-sm-3">
        <div class="order-category hidden-xs">
          <ul id="category-list">
            <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
            <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
            <li class="category-menu "><a href="<?php echo SITE_URL; ?>personal-details.html" > My Profile</a></li>
            <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.html"> Addresses</a></li>
            <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
            <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
            <li class="category-menu"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
            <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
            <!-- <li class="category-menu"><a href="name-return.php"> Name Transfer</a></li>-->
            <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
          </ul>          
        </div>
        <div class="admin-menu visible-xs">
          <button type="button" class="btn btn-admenu toggle rotate" data-toggle="collapse" data-target="#admin-menu"> <span>Dashboard Menu</span>
          <div class="fa-style rotate"><i class="fa faaa fa-angle-down rotate"></i></div>
          </button>
          <div id="admin-menu" class="collapse admenu-box">
            <ul class="nav navbar-nav">
              <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.html" > My Profile</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
              <!--<li class="category-menu"><a href="name-return.php"> Name Transfer</a></li>-->
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
            </ul>            
          </div>
        </div>
      </div>
      <div class="col-md-9 col-xs-12 col-sm-9">
        <div class="text-order">
          <h2>MY ORDER ID : <?php echo $sel['order_id']; ?></h2>
        </div>
        <table width="100%" border="1" class="ordertable">
          <tbody>
            <tr>
              <td class="td-col1">Order ID</td>
              <td class="td-col2"><?php echo $sel['order_id']; ?></td>
            </tr>
            <tr>
              <td class="td-col1">Order Date</td>
              <td class="td-col2"><?php echo date('d-m-Y',strtotime($sel['ord_date'])); ?><br></td>
            </tr>
            <tr>
              <td class="td-col1">Payment Mode</td>
              <td class="td-col2"><?php echo ($sel['paymethod']=='COD')? "Cash Payable":$sel['paymethod']; ?><br></td>
            </tr>
            <!--<tr><td class="td-col1">Delivery Type</td>
                    <td class="td-col2">SF Delivery Team<br></td>
                </tr>-->
            <tr> </tr>
          </tbody>
        </table>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-none-list">
          <div class="atitle-3">
            <h2>Billing Address</h2>
          </div>
          <div class="adetailBox">
            <p class="ctext"> <?php echo ucfirst($billingadd['firstname']); ?><br>
              <?php echo $sel['bill_address'] ?>, <?php echo $sel['bill_city'] ?>, <?php echo $sel['bill_pincode'] ?><br>
              <?php echo $billstate['name'] ?><br>
              Mobile : <?php echo $billingadd['mobile_no']; ?><br>
              Email : <?php echo $billingadd['email_id']; ?></p>
            <div class="clear"></div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pad-none-list">
          <div class="atitle-3">
            <h2>Delivery Address</h2>
          </div>
          <div class="adetailBox">
            <p class="ctext"><?php echo $shippingadd['email_id']; ?><br>
              <?php echo $sel['ship_address'] ?>, <?php echo $sel['ship_city'] ?>, <?php echo $sel['ship_pincode'] ?><br>
              <?php echo $shipstate['name'] ?><br>
              Mobile : <?php echo $shippingadd['mobile_no']; ?><br>
              Email : <?php echo $shippingadd['email_id']; ?></p>
            <div class="clear"></div>
          </div>
        </div>
        <div>&nbsp;</div>
        <div class="text-order-1">
          <h4>ITEM ORDERED [ <i class="fa fa-history"></i> Order Placed ]</h4>
        </div>
        <table class="table table-cart">
          <thead>
            <tr class="hidden-xs visible-lg visible-md visible-sm">
              <th style="width: 26%;">Item</th>
              <th>Qty</th>
              <th>Rent Month</th>
              <th>Security Deposit</th>
              <th>Handling Charges</th>
              <th style="text-align: right;">Sub Total</th>
            </tr>
            <tr class="visible-xs">
              <th colspan="6">Product Detail</th>
            </tr>
          </thead>
          <tbody>
          <?php  foreach($orderdet['result'] as $resdet){
			  $tot=$resdet['quantity']*round($resdet['security_deposite']+$resdet['handling_price']);
			  $totqty+=$resdet['quantity'];
			  $totdep +=$resdet['quantity']*$resdet['security_deposite'];
        $totpardep =$resdet['quantity']*$resdet['security_deposite'];
			  $tothand +=$resdet['quantity']*$resdet['handling_price'];
        $totparhand =$resdet['quantity']*$resdet['handling_price'];
			  $totalmonth +=$resdet['quantity']*$resdet['monthly_price'];
        $totalparmonth =$resdet['quantity']*$resdet['monthly_price'];
			   ?>
            <tr class="visible-xs">
              <td class="position-relative" colspan="6">
                <p><a href="javascript:void(0);"><?php echo $resdet['name']; ?></a></p>
                <table class="table table-cart-mobile">
                  <tbody>
                    <tr>
                      <th class="col-xs-6"> Qty : <?php echo $resdet['quantity']; ?>  </th>
                      <th class="col-xs-6"><div class="text-right">&#8377;&nbsp; <?php echo round($resdet['handling_price']); ?></div></th>
                    </tr>
                    <tr>
                     <!-- <th class="col-xs-12 bold text-right" colspan="2">&#8377;&nbsp;<?php echo $tot ?></th>-->
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr class="hidden-xs">
              <td><!--<img src="http://192.168.1.30/solefitness2017/products/bimages/cart-small/f63-12965.jpg" alt="Nil" title="Nil" class="cart-img">-->
                
                <p><a href="javascript:void(0);"><?php echo $resdet['name'] ?></a></p></td>
              <td><?php echo $resdet['quantity']; ?></td>
               <td>&#8377;&nbsp;<?php echo $totalparmonth; ?></td>
              <td>&#8377;&nbsp;<?php echo $totpardep; ?></td>
               <td>&#8377;&nbsp;<?php echo $totparhand; ?></td>
              <td class="bold text-right">&#8377;&nbsp;<?php echo $tot ?></td>
            </tr>
            <?php }?> 
            <tr>
             <td class="total-box" align="right"> Total :</td>
             <td class="total-box" style="text-align:left"> <?php echo $totqty; ?></td>
              <td class="total-box" style="text-align:left"> &#8377;&nbsp;<?php echo $totalmonth; ?></td>
              <td class="total-box" style="text-align:left"> &#8377;&nbsp;<?php echo $totdep; ?></td>
              <td class="total-box" style="text-align:left"> &#8377;&nbsp;<?php echo $tothand; ?></td>
              <td class="total-box">Total Deposit : &#8377;&nbsp;<?php echo $totdep ?></td>
            </tr>            
            <tr>
              <!--<td colspan="6" class="total-box">Total Deposit : &#8377;&nbsp;<?php echo $totdep ?></td>-->
            </tr>
            <tr>
              <td colspan="6" class="total-box">Handling Charges  : &#8377;&nbsp;<?php echo $tothand ?></td>
            </tr>
            <!--<tr>
              <td colspan="6" class="total-box">COD : &#8377;&nbsp;0.00</td>
            </tr>-->
            <tr>
              <td colspan="6"><h3 class="pull-right" style="color:#a94442; font-size:20px; font-family: inherit;">Total Payout :&#8377; <?php echo round($sel['total']); ?></h3></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?php include "footer.php"; ?>
</body>
</html>