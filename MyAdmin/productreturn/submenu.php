<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");
$listcounts=$conn->getRow("Select * from (select count(id) as pencount from ".PRODUCTRETURN." WHERE status='W' limit 1)as p, (select count(id) as procount from ".PRODUCTRETURN." WHERE status='Y' limit 1)as pr, (select count(id) as comcount from ".PRODUCTRETURN." WHERE status='C' limit 1)as shp, (select count(id) as cancount from ".PRODUCTRETURN." WHERE status='N' limit 1)as can");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
  <a class="btn btn-app bg-aqua" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=pending" title="Active"> <i class="fa fa-check-circle"></i> Pending (<?php echo  $listcounts['pencount'];?>) </a>
  <a class="btn btn-app bg-orange" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=processing" title="Active"> <i class="fa fa-check-circle"></i> Processing (<?php echo  $listcounts['procount'];?>) </a>
 
  <a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=completed" title="Active"> <i class="fa fa-check-circle"></i> Complete (<?php echo  $listcounts['comcount'];?>) </a>
  <a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=cancelled" title="Active"> <i class="fa fa-check-circle"></i> Cancelled (<?php echo  $listcounts['cancount'];?>) </a>
    <a class="btn btn-app" href="<?php echo ADMIN_URL.$path_folder; ?>form1excel-oper.php" title="Excel Download"> <i class="fa fa-file-excel-o"></i>Excel Download</a>
  </div>
</div>
