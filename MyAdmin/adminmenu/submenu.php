<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$listcounts=$conn->getRow("Select * from (select count(menu_id) as actcount from ".ADMINMENU." WHERE menu_status='Y' ".$extrcond." limit 1)as a,(select count(menu_id)inactcount   from ".ADMINMENU." WHERE menu_status='N' ".$extrcond." limit 1)as b");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2"> <a class="btn btn-app"  title="Add" href="<?php echo ADMIN_URL.$path_folder; ?>new.php"> <i class="fa fa-file-o"></i> Add </a> <a class="btn btn-app bg-green" title="Active Events" href="<?php echo ADMIN_URL.$path_folder; ?>list.php"> <i class="fa fa-check-circle"></i> Active List (<?php echo  $listcounts['actcount'];?>) </a> <a class="btn btn-app bg-red"  title="Inactive Events" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=inactive"> <i class="fa fa-ban"></i> Inactive List (<?php echo $listcounts['inactcount']; ?>) </a></div>
</div>
