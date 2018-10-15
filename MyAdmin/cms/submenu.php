<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");
/*$listcounts=$conn->getRow("Select * from (select count(post_id) as actcount from ".POST." WHERE cat_id='3' AND post_status='Y' limit 1)as a,(select count(post_id)inactcount   from ".POST." WHERE cat_id='3' AND post_status='N'  limit 1)as b,(select count(post_id) as waitcount from ".POST." WHERE cat_id='3'AND post_status='W' limit 1)as c");*/
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2"><?php /* ?> <a class="btn btn-app" href="<?php echo ADMIN_URL.$path_folder; ?>new.php" title="Add"> <i class="fa fa-file-o"></i> Add </a> <?php /* ?><a class="btn btn-app bg-yellow" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=wait" title="Waiting"> <i class="fa fa-spinner"></i> Waiting (<?php echo  $listcounts['waitcount'];?>) </a><a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder; ?>list.php" title="Active"> <i class="fa fa-check-circle"></i> Active (<?php echo  $listcounts['actcount'];?>) </a> <a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=inactive" title="Inactive"> <i class="fa fa-ban"></i> Inactive (<?php echo $listcounts['inactcount']; ?>) </a><?php */?> </div>
</div>
