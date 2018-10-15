<?php
require(dirname(__FILE__).'/appcore/app-register.php');

unset($_SESSION['prentz_redirect']);

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
else if($status=='cancelled')
{
  $cond .="status = 'N' and user_id='". $_SESSION['prentz_user_id']."'";
}
else if($status=='processing')
{
  $cond .="status = 'Y' and user_id='". $_SESSION['prentz_user_id']."'";
}
else
{
   $cond .="status = 'W' and user_id='". $_SESSION['prentz_user_id']."'";
}


if (!isset($_SESSION['prentz_user_id'])) { 

  $_SESSION['prentz_redirect'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $_SESSION['prentz_expired'] = "Session Expired..! Login Again..!";

  $conn->divert($RES_SURL['set_url']."index.php");
}


$listcounts=$conn->getRow("Select * from (select count(id) as pencount from ".SERVICEREQUEST." WHERE status='W' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as p, (select count(id) as procount from ".SERVICEREQUEST." WHERE status='Y' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as pr, (select count(id) as comcount from ".SERVICEREQUEST." WHERE status='C' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as shp, (select count(id) as cancount from ".SERVICEREQUEST." WHERE status='N' and user_id='". $_SESSION['prentz_user_id']."' limit 1)as can");


$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$comments = $conn->select_query(SERVICEREQUEST,"*",$cond ."order by id desc","");

$userid=$_SESSION['prentz_user_id'];

if(isset($save))
{
	$prodname = $conn->select_query(ORDERPRODUCT,"*","customer_id ='".$userid."' AND order_status_id='5'  AND order_product_id ='".$p_id."' order by order_product_id desc","1");
  $arr=array('status'=>'W','user_id'=>$userid,'product_name'=>$prodname['name']);
  $ins=$conn->insert(SERVICEREQUEST,"",$arr);
  if($ins)
  {
    $succAlert = "Successfully Saved.";
    
  
    
  }
}

$orders = $conn->select_query(ORDERPRODUCT,"*","customer_id ='".$userid."' AND order_status_id='5' order by order_product_id desc","");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo-general.php";?>
<?php include "header.php"; ?>
<base href="<?php echo SITE_URL; ?>">
<?php include "tracker.php"; ?>
</head>
<body>
<div class="main">
<section id="">
   <?php include 'menu.php';?>
</section>

<section id="inner-header">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">My Order</li>
        </ol>
        
    </div>
    </div>
</section>



<section id="dashboard">
<div class="container-fluid padding-none-class">
<div class="my-order">
<div class="col-md-3 col-xs-12 col-sm-3">
   <div class="order-category hidden-xs">
   <ul id="category-list">
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>personal-details.html" > My Profile</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-address.html"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
       <li class="category-menu"><a href="name-return.php"> Name Transfer</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Relocation</a></li>
     
   </ul> 
   </div> 
    <div class="admin-menu visible-xs">
        <button type="button" class="btn btn-admenu toggle rotate" data-toggle="collapse" data-target="#admin-menu"> <span>Dashboard Menu</span> <div class="fa-style rotate"><i class="fa faaa fa-angle-down rotate"></i></div></button>
  <div id="admin-menu" class="collapse admenu-box">
    <ul class="nav navbar-nav">
        <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.html" > My Profile</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>name-return.php"> Name Transfer</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Relocation</a></li>
     
      </ul>
  </div>
    </div>
</div> 
<div class="col-md-9 col-xs-12 col-sm-9">
<div class="order-detail wow fadeInDown">



 <?php if($succAlert){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4> <i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $succAlert; ?> </div>
          <?php }?>
          <?php if($ErrAlert){?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4> <i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $ErrAlert; ?> </div>
          <?php }?>
   <h2 class="profile-title">Service Request</h2>

<!--<div class="pull-right pull-none">
<button type="button" class="btn btn-info btn-service" data-toggle="modal" data-target="#service-request">Add
</button>
</div>-->
<div class="clear-fix"></div>
<!--<div>&nbsp;</div>-->
<div class="pull-right pull-none">
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>service-request.php?status=pending" class="btn btn-dash btn-info pending-btn" role="button">Pending (<?php echo  $listcounts['pencount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>service-request.php?status=processing" class="btn btn-dash btn-info processing-btn" role="button">Processing (<?php echo  $listcounts['procount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>service-request.php?status=completed" class="btn btn-dash btn-info complete-btn" role="button">Complete (<?php echo  $listcounts['comcount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>service-request.php?status=cancelled" class="btn btn-info btn-dash cancelled-btn" role="button">Cancelled(<?php echo  $listcounts['cancount'];?>)</a>
</div>

</div>
<div class="clearfix"></div>
<div class="row list-box">

      <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Comments</th>
      </tr>
    </thead>
    
    <tbody>

      <?php
	  $i=1;
	   foreach($comments['result'] as $rescmnt) {
		  
		   $orders = $conn->select_query(ORDER,"*","ord_id ='".$rescmnt['main_ord_id']."'","1");
		   ?>
      
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $orders['order_id']?> - <?php echo $rescmnt['product_name']?></td>
        <td><?php echo $rescmnt['comments']?></td>
      </tr>
      
       <?php $i++;} ?>
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
<div class="modal fade" id="service-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLongTitle">Service Request<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h3>
        
        </button>

      </div>
      <div class="modal-body">
       
<form name="service-request" id="service-request" method="post">
              
  <div class="form-group">
     <!-- <label for="">Product Name</label> <br/>
    <label class="checkbox-inline">
  <input type="checkbox" id="inlineCheckbox1" value="option1"> Television
</label>
<label class="checkbox-inline">
  <input type="checkbox" id="inlineCheckbox2" value="option2"> Fridge
</label>
<label class="checkbox-inline">
  <input type="checkbox" id="inlineCheckbox3" value="option3"> Washing Machine
</label>
<label class="checkbox-inline">
  <input type="checkbox" id="inlineCheckbox4" value="option4"> Furniture
</label>
<label class="checkbox-inline">
  <input type="checkbox" id="inlineCheckbox5" value="option5"> Bike 
</label>-->
<label for="">Product Name</label> <br/>
<select name="p_id" id="p_id">

<?php if($orders['nr']){?>
<option value="">--Select Product--</option>
<?php
	foreach($orders['result'] as $resords){
	 ?>
<option value="<?php echo $resords['order_product_id']; ?>"><?php echo $resords['order_id']; ?> - <?php echo $resords['name']; ?></option> 
<?php }}else{?>
<option value="">--No Orders--</option>
<?php }?>
</select>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Comments</label>
      
    <textarea class="form-control"  name="comments" id="comments" required rows="4"></textarea>

  </div>



      </div>
      <div class="modal-footer">
       <button type="submit" name="save" class="btn btn-primary btn-red">Submit</button>
      </div>

      </form>
    </div>
  </div>
</div>


  </body>
</html>
