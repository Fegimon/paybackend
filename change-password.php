<?php
require(dirname(__FILE__).'/appcore/app-register.php');

if (!isset($_SESSION['prentz_user_id'])) {
  $conn->divert($RES_SURL['set_url']."index.php");
}

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");





$uid= $_SESSION['prentz_user_id'];
  $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");
if(!isset($uid))
{
    header("Location:index.php");    
}


if($uid)
{
//$userdetail = $conn->select_query(USERDETAILS,"*","user_id='".$uid."' AND user_name!=''","1");
 $userdetail = $conn->select_query(USER,"*","user_id='".$uid."' AND user_name!=''","1");

if(isset($btn_pass))
{
    if($uid!="")
    { 
	// $chkpass=$conn->tep_encrypt_password($user_pwd);
// $checkOP = $conn->select_query(USER,"user_pwd","password ='".$chkpass."' AND user_id='".$uid."'","1"); 

 
    
      if($user_pwd==$conf_pwd){
        $userpass=$conn->tep_encrypt_password($user_pwd);
      $upd = $conn->Execute("UPDATE ".USER." SET user_pwd='".$conn->variable($user_pwd)."',user_pwd='". $userpass."' WHERE user_id='".$uid."'"); 
      if($upd)
      {
    $Alertsuccess = "Password successfully changed.Please Login Again";
  $Alertsuccessurl=SITE_URL.'logout.php';
       }
           }
           else 
           {
            
          echo '<script language="javascript">alert("passwords do not matched");</script>';
           }
   
    }

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
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
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
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.html" > My Profile</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
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
<div class="order-detail wow fadeInDown pg-bottom pd-1">
  <div class="row">
      <h2 class="profile-title">Change Password</h2>
          <div class="col-md-5 col-xs-12 mg-form">
              
              <form>
 <div class="input-list">
 
 <!--<div class="form-group style-4">
    <label for="">Current Password</label>
    <input type="password" class="form-control"  name="curr_pwd" id="curr_pwd" placeholder="New Password">
  </div>-->
  
  <div class="form-group style-4">
    <label for="">New Password</label>
    <input type="password" class="form-control"  name="user_pwd" id="user_pwd" placeholder="New Password">
  </div>
    
  <div class="form-group style-4">
    <label for="">Repeat Password</label>
    <input type="password" class="form-control"  name="conf_pwd" id="conf_pwd" placeholder="Repeat Password">
  </div>
    
 
  <button type="submit" class="btn btn-primary btn-red" name="btn_pass"  id="btn_pass">Update</button>

     </div>
</form>
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