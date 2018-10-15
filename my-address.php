<?php
require(dirname(__FILE__).'/appcore/app-register.php');

unset($_SESSION['prentz_redirect']);

if (!isset($_SESSION['prentz_user_id'])) { 

  $_SESSION['prentz_redirect'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $_SESSION['prentz_expired'] = "Session Expired..! Login Again..!";

  $conn->divert($RES_SURL['set_url']);
}

$userid=$_SESSION['prentz_user_id'];

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

 $useraddress = $conn->select_query(USERADDRESS,"*","customer_id='".$userid."' AND  address_status = 'Y' order by default_add desc","");
 
 
 if(isset($my_address))
{
//echo "asd";exit;
  $Alert_shipping_message = '';
  $arr=array('address_status'=>'Y','customer_id'=>$userid);
  $ins=$conn->insert(USERADDRESS,"",$arr);
  if($ins)
  {
    $Alert_shipping_message = "Successfully Saved.";
        
  }
}
//set defalut address
 if(isset($add_default))
{
	 $addid=$_REQUEST['addid'];
	 $upnew=array('default_add'=>'Y');
	 $updel=array('default_add'=>'N');
	 $updremove = $conn->update(USERADDRESS,"address_id!='".$addid."' AND customer_id='".$_SESSION['prentz_user_id']."'",$updel);
	  $upd = $conn->update(USERADDRESS,"address_id='".$addid."' AND  customer_id='".$_SESSION['prentz_user_id']."' ",$upnew);
	  if($upd)
  {
    $address_msg = "Successfully Saved.";
	$Alertsuccessurl=SITE_URL.'my-address.html';
        
  }
}
//address update
if(isset($upd_add))
{
	 $updaddid=$_REQUEST['updaddid'];
	 $upnewadd=array();
	  $updaddress = $conn->update(USERADDRESS,"address_id='".$updaddid."' AND  customer_id='".$_SESSION['prentz_user_id']."' ",$upnew);
	  if($updaddress)
  {
    $address_msg = "Successfully Saved.";
	$Alertsuccessurl=SITE_URL.'my-address.html';
        
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
          <li class="active">My Address</li>
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
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-address.html"> Addresses</a></li>
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
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.html" > My Profile</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
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
      <h2 class="profile-title">My Addresses</h2>
      
      <?php if($useraddress['nr'])
	  { 
	  foreach($useraddress['result'] as $resadd){
		  $state = $conn->select_query(STATE,"*","zone_id='".$resadd['state_id']."'","1");
		  
		  if($resadd['default_add']=='Y')
		  {
			   $class='btn btn-primaryn btn-red'; 
			   $text='CONTACT ADDRESS';
		  }else
		  {
			 $class='btn btn-default'; 
			 $text='MAKE CONTACT ADDRESS';
		  }
	  ?>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="address-mdiv">
              <h5 class="ctitle"><?php echo $resadd['firstname']; ?></h5>
              <p class="ctext"><?php echo $resadd['address_1']; ?><br>
			  <?php echo $resadd['city']; ?><br>
                <?php echo $state['name']; ?>, <?php echo $resadd['postcode']; ?><br>
                Mobile : <?php echo $resadd['mobile_no']; ?></p>
                <?php  if($resadd['default_add']=='Y')
		  {?>
                <label class="btn btn-primaryn btn-red">CONTACT ADDRESS</label>
                <?php }else{?>
                <form name="form_add" method="post" >
                <input type="hidden" name="addid" id="addid" value="<?php echo $resadd['address_id']; ?>"/>
       <button type="submit" class="btn btn-default" name="add_default" id="add_default" 
       onClick="return confirm('Are you sure want to change default address?');">MAKE CONTACT ADDRESS</button>
       </form>
              <?php }?>
              <?php /*?><a class="add-btn editaddress" href="javascript:void(0);" id="" data-toggle="modal" data-target="#editaddress<?php echo $resadd['address_id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a><?php */?>
                          </div>
          </div>
      <?php }}?>
            <!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="address-mdiv">
              <h5 class="ctitle">prem</h5>
              <p class="ctext">test<br>
                singapore, 600028<br>
                Mobile : 9876543210</p>
              <button type="submit" class="btn btn-default" id="">Selected</button>
              <a class="add-btn editaddress" href="javascript:void(0);" id="" data-toggle="modal" data-target="#edit-address" title="Edit"><i class="fa fa-pencil"></i></a>
            </div>
          </div>-->
          
          <div class="clearfix"></div>
          
        <div class="mg-top">
          <center>
         <button type="button" class="btn btn-primary btn-red" data-toggle="modal" name="btn_address" id="btn_address" data-target="#exampleModal1" data-whatever="@mdo"> Add New Address</button>
        </center>
       </div> 
     </div>
</div>   
 
</div>
    
    
</div>
</div>
</section>

<?php
if($useraddress['nr']){
	foreach($useraddress['result'] as $resadd ){?>              
<div class="modal fade" id="editaddress<?php echo $resadd['address_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-register" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Edit Address</h4>
      </div>
      <div class="modal-body">
        <form name="form-add" id="form-add-address" method="post" autocomplete="off">
        <input type="hidden" name="updaddid" id="updaddid" value="<?php echo $resadd['address_id']; ?>">
          <div class="form-group">
            <label for="name">Name <span style="color:#a70f13">*</span></label>
            <input  class="form-control" placeholder="Name" name="firstname" id="firstname" maxlength="100" type="text" value="<?php echo $resadd['firstname']; ?>">
          </div>
          <div class="form-group">
            <label for="address">Address <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="Address" name="address_1" id="address_1" maxlength="150" type="text" value="<?php echo $resadd['address_1']; ?>">
          </div>
          <div class="form-group">
            <label for="city">City <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="City" name="city" id="address-city" maxlength="100" type="text" value="<?php echo $resadd['city']; ?>">
          </div>
          <div class="form-group">
            <label for="state">State <span style="color:#a70f13">*</span></label>
            <?php $state_detail = $conn->select_query(STATE,"*", "country_id = '99' AND status = '1' order by name", ""); ?>
            <select class="form-control" name="state_id" id="state_id">
              <?php foreach ($state_detail['result'] as $key => $state_value) { ?>
              <option value="<?php echo $state_value['zone_id'];?>" <?php echo ($resadd['state_id']==$state_value['zone_id'])? 'selected':''; ?> ><?php echo $state_value['name'];?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="pincode">Pincode <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="postcode" name="postcode" id="address-pincode" maxlength="6" type="text" value="<?php echo $resadd['postcode']; ?>">
          </div>
          <div class="form-group">
            <label for="email">E-mail Address <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="E-mail Address" name="email_id" id="email_id" maxlength="150" type="text" value="<?php echo $resadd['email_id']; ?>">
          </div>
          <div class="form-group">
            <label for="mobile">Mobile Number <span style="color:#a70f13">*</span></label>
            <input class="form-control" placeholder="Mobile Number" name="mobile_no" id="mobile_no" maxlength="15" type="text" value="<?php echo $resadd['mobile_no']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit" id="upd_add" name="upd_add" value="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php }} ?>
<?php include "footer.php"; ?>
<script>

<?php 
//SUCCESS  Alerts
if(isset($address_msg) && $address_msg !='')
{
//echo "sdf";exit;  
  ?>
bootbox.dialog({
  message: "<p style='font-size:13px'><?php echo $address_msg; ?></p>",
  title: "<?php echo SITE_NAME; ?>",
  buttons: {
    success: {
      label: "OK",
      className: "btn-success"
 <?php if($Alertsuccessurl){?>
    ,callback: function() {
        window.location.href="<?php echo $Alertsuccessurl; ?>";
      }
     <?php }?>
     
    }
  }
});
<?php
}?>
</script>
  </body>
</html>