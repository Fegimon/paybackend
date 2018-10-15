<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$conn->valoperator("2");

if($ct == "mc"){
  $submenu_cond = " AND cat_p_id='0'";  
} elseif($ct == "sc"){
  $submenu_cond = " AND cat_p_id != '0'";  
} else {
  $submenu_cond ="";
}

$listcounts=$conn->getRow("Select * from (select count(cat_id) as actcount from ".CATEGORY." WHERE cat_status='Y' ".$submenu_cond." limit 1)as a,(select count(cat_id)inactcount   from ".CATEGORY." WHERE cat_status='N' ".$submenu_cond." limit 1)as b,(select count(cat_id) as waitcount from ".CATEGORY." WHERE cat_status='W' ".$submenu_cond." limit 1)as c");
 ?>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
  	<?php if($ct == "sc"){ ?>
  		<a class="btn btn-app" href="<?php echo ADMIN_URL.$path_folder.'form.php?ct='.$ct; ?>" title="Add"> <i class="fa fa-file-o"></i> Add </a>
  	<?php } ?>	
  	<a class="btn btn-app bg-green" href="<?php echo ADMIN_URL.$path_folder.'list.php?ct='.$ct; ?>" title="Active"> <i class="fa fa-check-circle"></i> Active (<?php echo  $listcounts['actcount'];?>) </a> 
  	<?php if($ct == "sc"){ ?>
  		<a class="btn btn-app bg-red" href="<?php echo ADMIN_URL.$path_folder.'list.php?token=inactive&ct='.$ct; ?>" title="Inactive"> <i class="fa fa-ban"></i> Inactive (<?php echo $listcounts['inactcount']; ?>) </a> 
  	<?php } ?>		
  </div>
</div>
