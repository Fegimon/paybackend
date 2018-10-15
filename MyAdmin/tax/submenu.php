<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");
$listcounts=$conn->getRow("Select * from (select count(tax_id) as actcount from ".Tax." WHERE tax_status='Y' limit 1)as a,(select count(tax_id)inactcount   from ".Tax." WHERE tax_status='N'  limit 1)as b");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2"> <a class="btn btn-app" href="<?php echo ADMIN_URL.$path_folder; ?>form.php" title="Add"> <i class="fa fa-file-o"></i> Add </a> <a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder; ?>list.php" title="Active"> <i class="fa fa-check-circle"></i> Active (<?php echo  $listcounts['actcount'];?>) </a> <a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=inactive" title="Inactive"> <i class="fa fa-ban"></i> Inactive (<?php echo $listcounts['inactcount']; ?>) </a> </div>
</div>
