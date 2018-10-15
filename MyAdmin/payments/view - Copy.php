<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";
$id = $conn->variable($q);

$sel = $conn->select_query(ORDER,"*","order_id='".$id."'","1");
 $order_status = $conn->select_query(ORDERSTATUS,"*","order_status_id='".$sel['order_status_id']."' AND status='Y'","1");
?>
<?php #Admin Html head
$conn->adminHtmlhead();
$conn->admninBody();
?>

<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $Pagetitle['title']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $Pagetitle['title']; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php include "submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-navy">View <?php echo $Pagetitle['title']; ?></h3>
              <div class="pull-right"> <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" class="form-horizontal" >
                <!-- text input -->
                <dl class="dl-horizontal">
                  <dt>Order Id :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['ord_id']));?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Customer Name :</dt>
                  <dd><?php echo ucfirst($sel['firstname']).' '.$sel['lastname'];?></dd>
                </dl>				        
                <dl class="dl-horizontal">
                  <dt>Customer Email Id:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['email']));?></dd>
                </dl>               
                <dl class="dl-horizontal">
                  <dt>Customer Phone Number:</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['telephone']));?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Order Status :</dt>
                  <dd><?php echo $order_status['name'];?></dd>
                </dl>
                <dl class="dl-horizontal">
                  <dt>Date Added :</dt>
				          <dd><?php echo date('d-m-Y',strtotime($sel['date_added']));?></dd>
                </dl>
                  <dl class="dl-horizontal">
                  <dt>Date Added :</dt>
				          <dd><?php echo date('d-m-Y',strtotime($sel['date_added']));?></dd>
                </dl>




                 <dl class="dl-horizontal">
                  <dt>Payment Firstname :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['payment_firstname']));?></dd>
				       
                </dl>


                 <dl class="dl-horizontal">
                  <dt>Payment Lastname :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['payment_lastname']));?></dd>
				       
                </dl>


   <dl class="dl-horizontal">
                  <dt>Payment Company :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['payment_company']));?></dd>
				       
                </dl>

                <dl class="dl-horizontal">
                  <dt>Payment Address :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['payment_address_1']));?>,<?php echo $conn->stripval(ucfirst($sel['payment_address_2']));?></dd>
				       
                </dl>
                  <dl class="dl-horizontal">
                  <dt>Payment City :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['payment_city']));?></dd>
				       
                </dl>


                  <dl class="dl-horizontal">
                  <dt>Payment Postcode :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['payment_postcode']));?></dd>
				       
                </dl>



 <dl class="dl-horizontal">
                  <dt>Payment Country :</dt>
                  <dd><?php echo $conn->stripval(ucfirst($sel['payment_country']));?></dd>
				       
                </dl>



                <dl class="dl-horizontal">
                  <dt>Shipping Address</dt>
                  <?php 
                  $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

      $find = array(
        '{firstname}',
        '{lastname}',
        '{company}',
        '{address_1}',
        '{address_2}',
        '{city}',
        '{postcode}',
        '{zone}',
        '{zone_code}',
        '{country}'
      );

      $replace = array(
        'firstname' => $sel['shipping_firstname'],
        'lastname'  => $sel['shipping_lastname'],
        'company'   => $sel['shipping_company'],
        'address_1' => $sel['shipping_address_1'],
        'address_2' => $sel['shipping_address_2'],
        'city'      => $sel['shipping_city'],
        'postcode'  => $sel['shipping_postcode'],
        'zone'      => $sel['shipping_zone'],
        'zone_code' => $sel['shipping_zone_code'],
        'country'   => $sel['shipping_country']
      );

      $shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
      ?>
                  <dd><?php echo $shipping_address;?></dd>
                </dl>


            <?php 
            $order_product = $conn->select_query(ORDERPRODUCT,"*","order_id='".$sel['order_id']."'","");            
            if(!empty($order_product['nr'])){ ?>
                  <dl class="dl-horizontal">
                    <dt>Product Details </dt>
                      <dd> <table class="table table-striped table-bordered table-hover"> 
                      <th>Product</th><th>Quantity</th><th>Unit Price</th><th>Security Deposit</th><th>Handling Charge</th><th>Total</th>               
                        <?php foreach ($order_product['result'] as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['quantity']; ?></td>
                            <td><?php echo $value['monthly_price']; ?></td>
                            <td><?php echo $value['security_deposite']; ?></td>
                            <td><?php echo $value['handling_price']; ?></td>
                            <td><?php echo $value['total']; ?></td>
                        </tr>
                        <?php } ?>
                        </table>  
                    </dd>
                  </dl> 
            <?php } ?> 
                 

            </div>
            <!-- /.box-body --> 
            <!-- /.box --> 
          </div>
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  
  <?php include "../common/footer.php"; ?>
  <!-- /.content-wrapper --> 
</div>
<?php include "../common/footer-scripts.php"; ?>
</body></html>