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


$uid = $_SESSION['prentz_user_id'];
if($uid) 
{    
    $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");
  
}



if(isset($btn_update))
{
  if($user_email!=''&&$user_name!=''&&$user_mobile!='')
  {
    $User = $conn->select_query(USER,"user_id","user_status!='Y' AND (user_email='".$conn->variable($user_email)."' OR user_mobile='".$conn->variable($user_mobile)."') AND user_id!='".$uid."'","1");
    if(!$User['nr'])
    {
      $arr=array();
      $ins=$conn->update(USER,"user_id='".$uid."'",$arr);
      if($ins)
      {
        $Alertsuccess = "Updated Successfully Saved.";
        $Alertsuccessurl=($Alertsuccessurl)?$Alertsuccessurl:SITE_URL."my-profile.html";
      }
    }else
    {
      $Alerterror = "Email/Mobile already exist.";
    }
  }else
  {
    $Alerterror = "Please fill required fields.";
  }
  
}


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
          <li class="active">My Profile</li>
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
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>personal-details.html" > My Profile</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.html"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
      <!-- <li class="category-menu"><a href="name-return.php"> Name Transfer</a></li>-->
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
   </ul> 
   </div> 
    <div class="admin-menu visible-xs">
       <button type="button" class="btn btn-admenu toggle rotate" data-toggle="collapse" data-target="#admin-menu"> <span>Dashboard Menu</span> <div class="fa-style rotate"><i class="fa faaa fa-angle-down rotate"></i></div></button>
  <div id="admin-menu" class="collapse admenu-box">
    <ul class="nav navbar-nav">
        <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-profile.html" > My Profile</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.html"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>unpayrentz-service.php">Non PayRentz Service Request</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
       <!--<li class="category-menu"><a href="name-return.php"> Name Transfer</a></li>-->
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
      </ul>
  </div>
    </div>
</div> 
<div class="col-md-9 col-xs-12 col-sm-9">
<div class="order-detail wow fadeInDown pg-bottom">
  <div class="row">
      <center><h2 class="profile-title"><a style="color:green" href="<?php echo SITE_URL; ?>personal-details.html">GO TO UPDATE YOUR PROFILE DETAILS</a></h2></center>
          <div class="col-md-6 mg-form">
              
           <!--   <form class="form-horizontal" name="reg_update" id="reg_update" method="post">
    
  <div class="form-group">
    <label for="">Name</label>
    <input type="text" class="form-control" name="user_name" id="user_name"placeholder="Name" value="<?php echo  $userdetails['user_name']; ?>">
  </div>
    
  <div class="form-group">
    <label for="">Email address</label>
    <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Email Id" value="<?php echo  $userdetails['user_email']; ?>">
  </div>
    
  <div class="form-group">
    <label for="">Mobile Number</label>
    <input type="text" class="form-control" name="user_mobile" id="user_mobile" placeholder="Number" value="<?php echo  $userdetails['user_mobile']; ?>">
  </div>

 
  <button type="submit"  name="btn_update"  class="btn btn-primary btn-red">Update</button>
</form>
 -->
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