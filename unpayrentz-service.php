<?php
require(dirname(__FILE__).'/appcore/app-register.php');

unset($_SESSION['prentz_redirect']);

if (!isset($_SESSION['prentz_user_id'])) { 

  $_SESSION['prentz_redirect'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $_SESSION['prentz_expired'] = "Session Expired..! Login Again..!";

  $conn->divert($RES_SURL['set_url']."index.php");
}

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");



if(isset($_REQUEST['status']))
{
    $status=$_REQUEST['status'];

}
if($status=='completed')
{
  $cond .="status = 'C' and user_id='". $_SESSION['prentz_user_id']."'";
}else if($status=='pending')
{
  $cond .="status = 'W' and user_id='". $_SESSION['prentz_user_id']."'";
}
else if($status=='processing')
{
  $cond .="status = 'Y' and user_id='". $_SESSION['prentz_user_id']."'";
}
else if($status=='cancelled')
{
  $cond .="status = 'N' and user_id='". $_SESSION['prentz_user_id']."'";
}else
{
	$cond .="status = 'W' and user_id='". $_SESSION['prentz_user_id']."'";
}


$listcounts=$conn->getRow("Select * from (select count(name_trans_id) as pencount from ".NAMETRANSFER." WHERE status='W' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as p, (select count(name_trans_id) as procount from ".NAMETRANSFER." WHERE status='Y' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as pr, (select count(name_trans_id) as comcount from ".NAMETRANSFER." WHERE status='C' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as shp, (select count(name_trans_id) as cancount from ".NAMETRANSFER." WHERE status='N' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as can");

$comments = $conn->select_query(COMMONSERVICEREQUEST,"*",$cond . "order by id desc","",1);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php include "seo-general.php";?>
   <?php include "header.php"; ?>
  
     <?php  include "inner-header.php"; ?>
  </head>
  <body>
    <?php include 'menu.php';?>
<section id="inner-header">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li><a href="#">Dashboard</a></li>
          <li class="active">Product Return</li>
        </ol>
        
    </div>
    </div>
</section>



<section id="dashboard">

<div class="container-fluid">
<div class="my-order">
<div class="col-md-3 col-xs-12 col-sm-3">
   <div class="order-category hidden-xs">
   <ul id="category-list">
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-order.php" > My Order</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-dues.php"> My Dues</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.php" > My Profile</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.php"> Change Password</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.php"> Service Request</a></li>
    <li class="category-menu active"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.php"> Product Return</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>name-return.php"> Name Transfer</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.php"> Product Transfer</a></li>
   </ul> 
   </div> 
    <div class="admin-menu visible-xs">
        <button type="button" class="btn btn-admenu toggle rotate" data-toggle="collapse" data-target="#admin-menu"> <span>Dashboard Menu</span> <div class="fa-style rotate"><i class="fa faaa fa-angle-down rotate"></i></div></button>
  <div id="admin-menu" class="collapse admenu-box">
    <ul class="nav navbar-nav">
        <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-order.php" > My Order</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-dues.php"> My Dues</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.php" > My Profile</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.php"> Change Password</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.php"> Service Request</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.php"> Product Return</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>name-return.php"> Name Transfer</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.php"> Product Transfer</a></li>
      </ul>
  </div>
    </div>
</div>  
<div class="col-md-9 col-xs-12 col-sm-9">
<div class="order-detail wow fadeInDown">
   <h2 class="profile-title">Non PayRentz Service Request</h2>

<!--<div class="pull-right">
<button type="button" class="btn btn-info " data-toggle="modal" data-target="#name-return">
Name Return
</button>
</div>-->


<div class="clear-fix"></div>
<div>&nbsp;</div>
<div class="pull-right pull-none">
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>name-return.php?status=pending" class="btn btn-dash btn-info pending-btn" role="button">Pending (<?php echo  $listcounts['pencount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>name-return.php?status=processing" class="btn btn-dash btn-info processing-btn" role="button">Processing (<?php echo  $listcounts['procount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>name-return.php?status=completed" class="btn btn-dash btn-info complete-btn" role="button">Complete (<?php echo  $listcounts['comcount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>name-return.php?status=cancelled" class="btn btn-info btn-dash cancelled-btn" role="button">Cancelled(<?php echo  $listcounts['cancount'];?>)</a>
</div>

</div>
<div class="clear-fix"></div>
   <div class="row list-box">
  <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email Id</th>
        <th>Mobile Number</th>
         <th>Product Name</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
  <?php
	  $i=1;
	  if($comments['nr'])
	  {
	   foreach($comments['result'] as $rescmnt) {
		  
		   $orders = $conn->select_query(ORDER,"*","ord_id ='".$rescmnt['main_ord_id']."'","1");
		   ?>
      
      <tr>
        <td> <?php echo $i; ?></td>
        <td><?php echo $rescmnt['name']?></td>
        <td><?php echo $rescmnt['email_id']?></td>
        <td><?php echo $rescmnt['phone']?></td>
         <td><?php echo $rescmnt['prodname']?></td>
        <td><?php echo $rescmnt['address']?></td>
      </tr>
       <?php $i++;}} ?>
    </tbody>
  </table>
  </div>      
    
</div>        
    
</div>   
    
</div>
</div>
</div>
    
</section>
 
<?php include "footer.php"; ?>
 </body>
</html>

<div class="modal fade" id="name-return" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLongTitle">Name Transfer <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h3>
        
        </button>

      </div>
      <div class="modal-body">
       <form class="service-form">
   
  <div class="form-group">
    <label for="">New Name</label>
    <input type="text" class="form-control" id="" placeholder="">
  </div>         
  <div class="form-group">
    <label for="">New Email Id</label>
    <input type="email" class="form-control" id="" placeholder="">
  </div>
 <div class="form-group">
    <label for="">New Mobile Number</label>
    <input type="text" class="form-control" id="" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Address</label>
      
    <textarea class="form-control" rows="4"></textarea>

  </div>
  
</form>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-primary btn-red">Submit</button>
      </div>
    </div>
  </div>
</div>