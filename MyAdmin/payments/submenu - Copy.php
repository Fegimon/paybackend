<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");
$listcounts=$conn->getRow("Select * from (select count(order_id) as pencount from ".ORDERPRODUCT." WHERE order_status_id='1' limit 1)as p, (select count(order_id) as procount from ".ORDERPRODUCT." WHERE order_status_id='2' limit 1)as pr, (select count(order_id) as shpcount from ".ORDERPRODUCT." WHERE order_status_id='3' limit 1)as shp, (select count(order_id) as comcount from ".ORDERPRODUCT." WHERE order_status_id='5' limit 1)as com, (select count(order_id) as cancount from ".OORDERPRODUCTRDER." WHERE order_status_id='6' limit 1)as can");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
  <a class="btn btn-app bg-aqua" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=pending" title="Active"> <i class="fa fa-check-circle"></i> Pending (<?php echo  $listcounts['pencount'];?>) </a>
  <a class="btn btn-app bg-orange" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=processing" title="Active"> <i class="fa fa-check-circle"></i> Processing (<?php echo  $listcounts['procount'];?>) </a>
  <a class="btn btn-app bg-blue" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=shipped" title="Active"> <i class="fa fa-check-circle"></i> Shipped (<?php echo  $listcounts['shpcount'];?>) </a>
  <a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=completed" title="Active"> <i class="fa fa-check-circle"></i> Complete (<?php echo  $listcounts['comcount'];?>) </a>
  <a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=cancelled" title="Active"> <i class="fa fa-check-circle"></i> Cancelled (<?php echo  $listcounts['cancount'];?>) </a>
  </div>
</div>
