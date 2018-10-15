<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");
$listcounts=$conn->getRow("Select * from (select count(id) as pencount from ".COMMONSERVICEREQUEST." WHERE status='W' limit 1)as p, (select count(id) as procount from ".COMMONSERVICEREQUEST." WHERE status='N' limit 1)as pr, (select count(id) as comcount from ".COMMONSERVICEREQUEST." WHERE status='D' limit 1)as shp, (select count(id) as cancount from ".COMMONSERVICEREQUEST." WHERE status='C' limit 1)as can");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
  <a class="btn btn-app bg-aqua" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=pending" title="Active"> <i class="fa fa-check-circle"></i> Pending (<?php echo  $listcounts['pencount'];?>) </a>
  <a class="btn btn-app bg-orange" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=processing" title="Active"> <i class="fa fa-check-circle"></i> Processing (<?php echo  $listcounts['procount'];?>) </a>
 
  <a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=completed" title="Active"> <i class="fa fa-check-circle"></i> Complete (<?php echo  $listcounts['comcount'];?>) </a>
  <a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=cancelled" title="Active"> <i class="fa fa-check-circle"></i> Cancelled (<?php echo  $listcounts['cancount'];?>) </a>
  </div>
</div>
