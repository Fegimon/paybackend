<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");
$listcounts=$conn->getRow("Select * from (select count(user_id) as actcount from ".USER." WHERE user_status='Y' limit 1)as a,(select count(user_id)inactcount   from ".USER." WHERE user_status='N'  limit 1)as b,(select count(user_id) as waitcount from ".USER." WHERE user_status='W' limit 1)as c");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2"><a class="btn btn-app bg-yellow" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=wait" title="Waiting"> <i class="fa fa-spinner"></i> Waiting (<?php echo  $listcounts['waitcount'];?>) </a><a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder; ?>list.php" title="Active"> <i class="fa fa-check-circle"></i> Active (<?php echo  $listcounts['actcount'];?>) </a> <a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=inactive" title="Inactive"> <i class="fa fa-ban"></i> Inactive (<?php echo $listcounts['inactcount']; ?>) </a><a class="btn btn-app" href="<?php echo ADMIN_URL.$path_folder; ?>excel_download.php" title="Excel Download"> <i class="fa fa-file-excel-o"></i>Excel Download</a>
 </div>
</div>
