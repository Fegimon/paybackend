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
  $cond .="status = 'D'";
}else if($status=='pending')
{
  $cond .="status = 'W'";
}
else if($status=='cancelled')
{
  $cond .="status = 'C'";
}
else if($status=='processing')
{
  $cond .="status = 'N'";
}







$listcounts=$conn->getRow("Select * from (select count(id) as pencount from ".PRODUCTRETURN." WHERE status='W' limit 1)as p, (select count(id) as procount from ".PRODUCTRETURN." WHERE status='N' limit 1)as pr, (select count(id) as comcount from ".PRODUCTRETURN." WHERE status='D' limit 1)as shp, (select count(id) as cancount from ".PRODUCTRETURN." WHERE status='C' limit 1)as can");

$comments = $conn->select_query(PRODUCTRETURN,"*",$cond,"");

if(isset($pro_save))
{
	 $dtime=date('Y-m-d H:i:s',strtotime($datetime));
  $arr=array('status'=>'W','date_time'=>$dtime);
  $ins=$conn->insert(PRODUCTRETURN,"",$arr);
  if($ins)
  {
    $succAlert = "Successfully Saved.";
    
  
    
  }
}

?>
<style>
.click-box a{
	 text-align:center;
	}
.padding-table th{
	padding: 10px 5px 10px 5px !important;
	text-align: center !important;
	}
.checkbox-style input[type=checkbox], input[type=radio] {
    margin-top: 8px !important;
}
</style>
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
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>personal-details.html" > My Profile</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-address.html"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
      <!-- <li class="category-menu"><a href="name-return.php"> Name Transfer</a></li>-->
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
   </ul> 
   </div> 
    <div class="admin-menu visible-xs">
        <button type="button" class="btn btn-admenu" data-toggle="collapse" data-target="#admin-menu"> Dashboard Menu</button>
  <div id="admin-menu" class="collapse admenu-box">
    <ul class="nav navbar-nav">
        <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.html" > My Profile</a></li>
       <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>change-password.html"> Change Password</a></li>
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>service-request.html"> Service Request</a></li>
       <li class="category-menu active"><a href="<?php echo SITE_URL; ?>product-return.html"> Product Return</a></li>
       <!--<li class="category-menu"><a href="name-return.php"> Name Transfer</a></li>-->
       <li class="category-menu"><a href="<?php echo SITE_URL; ?>product-transfer.html"> Product Transfer</a></li>
      </ul>
  </div>
    </div>
</div> 
<div class="col-md-9 col-xs-12 col-sm-9 padd-0">
<div class="order-detail wow fadeInDown">
  <!-- <h2 class="profile-title">Product Return</h2>-->

<div class="pull-right">
<button type="button" class="btn btn-info " data-toggle="modal" data-target="#addproduct">
Name Transfer
</button>
</div>


<div class="clear-fix"></div>
<div>&nbsp;</div>
<div class="pull-right ">
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>product-return.php?status=pending" class="btn btn-info pending-btn" role="button">Pending (<?php echo  $listcounts['pencount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>product-return.php?status=processing" class="btn btn-info processing-btn" role="button">Processing (<?php echo  $listcounts['procount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>product-return.php?status=completed" class="btn btn-info complete-btn" role="button">Complete (<?php echo  $listcounts['comcount'];?>)</a>
</div>
<div class="btn-group">
<a href="<?php echo SITE_URL; ?>product-return.php?status=cancelled" class="btn btn-info cancelled-btn" role="button">Cancelled(<?php echo  $listcounts['cancount'];?>)</a>
</div>

</div>


<div class="clear-fix"></div>
<div class="row list-box">
 <div class="table-responsive">          
  <table class="table table-bordered">
    <thead class="padding-table">
      <tr>
        <th>Sl.No</th>
        <th>Order Id</th>
        <th>order Date</th>
        <th align="center">Paid Amount</th>
        <th class="no-border">View</th>
        <th class="no-border">Name Transfer</th>
        <th class="no-border">Product Return</th>
        <th class="no-border">Product Relocation</th>
        <th class="no-border">Service Request</th>
      </tr>
    </thead>
    <tbody>
       
      <tr>
        <td align="center">1</td>
        <td align="center">2</td>
        <td align="center">12-12-18</td>
        <td align="center">&#8377; 777</td>
        <td align="center" class="click-box"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
      </tr>
       <tr>
        <td align="center">2</td>
        <td align="center">2</td>
        <td align="center">2-12-18</td>
        <td align="center">&#8377; 333</td>
        <td align="center" class="click-box"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
      </tr>
      <tr>
        <td align="center">3</td>
        <td align="center">2</td>
        <td align="center">7-12-18</td>
        <td align="center">&#8377; 352</td>
        <td align="center" class="click-box"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
        <td align="center" class="click-box no-border"><a href=""><i class="fa fa-eye"></i></a></td>
      </tr>
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



<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content checkbox-style">
      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLongTitle">Product Transfer <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h3>
        
        </button>

      </div>
       <form name="product-return" id="product-return" method="post">
      <div class="modal-body">
     
  <form>
 <!-- <input type="checkbox" name="vehicle" value="Bike"> I have a bike<br>
  <input type="checkbox" name="vehicle" value="Car" checked> I have a car<br>-->
  <label class="checkbox-inline"><input type="checkbox" value="">Product 1</label>
<label class="checkbox-inline"><input type="checkbox" value="">Product 2</label>
<label class="checkbox-inline"><input type="checkbox" value="">Product 3</label>
 </form>  
 <div class="form-group">
    <label for="">Mobile Number</label>
    <input type="text" required  name="number" id="number" class="form-control"  placeholder="number">
  </div>
   <div class="form-group">
    <label for="">Product Order ID</label> <br/>
   <select name="pro_id" required="" id="pro_id" class="form-control" id="sel1">
    <option selected="selected">Select Prodcut Odrder ID</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
  </div>
 <div class="form-group">
     <label for="">Date & Time</label>
      <div class="input-group date-time" id="datetimepicker">
          <input name="datetime" id="datepicker" required class="form-control"/><span class="input-group-addon"><span class="fa fa-calendar"></span></span>
        </div>
</div>
  <div class="form-group">
    <label for="exampleInputFile">Comments</label>
      
    <textarea  name="comments" id="comments" class="form-control" rows="4" required></textarea>

  </div>
  <div class="form-group">
    <label for="">Supporting Documents</label>
    <input type="file" name="image" id="image">
  </div>


      </div>
      <div class="modal-footer">
       <button type="submit" name="protran_save" class="btn btn-primary btn-red">Submit</button>
      </div>
     
    </div>
     </form>
  </div>
</div>
  </body>
</html>

<script type="text/javascript">
  if (/Mobi/.test(navigator.userAgent)) {
  // if mobile device, use native pickers
  $(".date-time input").attr("type", "datetime-local");
  $(".date input").attr("type", "date");
  $(".time input").attr("type", "time");
} else {
  // if desktop device, use DateTimePicker
  $("#datetimepicker").datetimepicker({
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      next: "fa fa-chevron-right",
      previous: "fa fa-chevron-left"
    }
  });
  $("#datepicker").datetimepicker({
    format: "L",
    icons: {
      next: "fa fa-chevron-right",
      previous: "fa fa-chevron-left"
    }
  });
  $("#timepicker").datetimepicker({
    format: "LT",
    icons: {
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down"
    }
  });
}

</script>