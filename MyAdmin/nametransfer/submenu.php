<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");
$listcounts=$conn->getRow("Select * from (select count(name_trans_id) as pencount from ".NAMETRANSFER." WHERE status='W' limit 1)as p, (select count(name_trans_id) as procount from ".NAMETRANSFER." WHERE status='N' limit 1)as pr, (select count(name_trans_id) as comcount from ".NAMETRANSFER." WHERE status='D' limit 1)as shp, (select count(name_trans_id) as cancount from ".NAMETRANSFER." WHERE status='C' limit 1)as can");
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
