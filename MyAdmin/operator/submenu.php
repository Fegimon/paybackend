<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$path_folder = "operator/";
//$conn->valoperator("4");

if($_SESSION['type']=='O')
{
	$extrcond=" AND op_id!='".$_SESSION['admin_id']."'";
}
$listcounts=$conn->getRow("Select * from (select count(op_id) as actcount from ".OPERATOR." WHERE op_status='Y' ".$extrcond." limit 1)as a,(select count(op_id)inactcount   from ".OPERATOR." WHERE op_status='N' ".$extrcond." limit 1)as b");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2"> <a class="btn btn-app" href="<?php echo ADMIN_URL.$path_folder; ?>new.php" title="Add"> <i class="fa fa-file-o"></i> Add </a> <a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder; ?>list.php" title="Active"> <i class="fa fa-check-circle"></i> Active (<?php echo  $listcounts['actcount'];?>) </a> <a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder; ?>list.php?token=inactive"  title="Inactive"> <i class="fa fa-ban"></i> Inactive (<?php echo $listcounts['inactcount']; ?>) </a></div>
</div>
