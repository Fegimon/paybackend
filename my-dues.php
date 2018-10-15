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
          <li class="active">My Dues</li>
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
            <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
            <li class="category-menu "><a href="<?php echo SITE_URL; ?>personal-details.html" > My Profile</a></li>
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
              <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-profile.html" > My Profile</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-address.php"> Addresses</a></li>
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
<div class="order-detail wow fadeInDown">
<div class="row">
      <!--<h2 class="profile-title">My Dues</h2>-->
        <div class="col-md-4 col-sm-4">
       <!--<form>
    <div class="radio">
      <label><input type="radio" name="optradio" checked>Option 1</label>
    </div>
    <div class="radio">
      <label for='r11'><input type="radio" name="optradio" id='r11'>Option 2  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a></label>
    </div>
    
    <div id="collapseOne" class="panel-collapse collapse in">
        <div class="panel-body">
          <p>HTML stands for HyperText Markup Language. HTML is the main markup language for describing the structure of Web pages. <a href="http://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
        </div>
      </div>
   
  </form>-->
  
  <form method="post" action="#" class="text_form">
  
  <h4>My Dues</h4>
  <div>
    <div>
    <p>Please Call Us To know Your Dues</p>
     <!-- <input type="radio" name="choice-animals" id="choice-animals-dogs" checked>
      <label for="choice-animals-dogs">&#8377;2000</label>-->
    
      <!--<div class="reveal-if-active">
        <label for="which-dog">Good call. What's the name of your favorite dog?</label>
        <input type="text" id="which-dog" name="which-dog" class="require-if-active" data-require-pair="#choice-animals-dogs">
      </div>-->
    </div>
    
    <?php /*?><div>
      <input type="radio" name="choice-animals" id="choice-animals-cats">
      <label for="choice-animals-cats">Other Payments</label>
    
      <div class="reveal-if-active">
       <!-- <label for="which-cat">&#8377;1000</label>-->
        <input type="text" id="which-cat" name="which-cat" class="require-if-active" data-require-pair="#choice-animals-cats">
      </div>
    </div><?php */?>
  </div>
  
  
  <!--<div>
    <input type="checkbox" name="choice-dollar" id="choice-dollar">
    <label for="choice-dollar">Sure.</label>

    <div class="reveal-if-active">
      Wouldn't we all.
    </div>
  </div>-->
  
 <!-- <div>
    <input type="submit" value="Submit">
  </div>-->
      
</form>
        </div>
        <div class="col-md-10 col-sm-9">
        
    </div>
    <div class="clearfix"></div>
    
    </div>
    
</div>   
    <!--<div class="order-detail wow fadeInDown">
<div class="row">
        <div class="col-md-2 col-sm-3">
            <a href="#"><img src="images/list3.png" alt="" class="img-responsive center-block hvr-pulse"></a>
        </div>
        <div class="col-md-10 col-sm-9">
        <div class="row mg-top">
        <div class="col-md-4 col-sm-4">
            <a href="#"><p>Led Television - 32inch </p></a>
        <p><span>12 Months</span></p>
        </div>
        <div class="col-md-4 col-sm-3">
        <p>₹ 500/- Month</p>
            <p><span> Jan - March</span></p>
        </div>
        <div class="col-md-4 col-sm-5">
        <a href="#" class="btn btn-primary pay-btn"> Pay Now</a>
        </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="delivery">
        <div class="pull-left">
            <p> Ordered On : <span>Tue 5th MAR '17 </span></p>
        </div>
        <div class="pull-right">
        <p class="order-id"> Order Id : PR0122345644</p>
        </div>
    
    </div>
    </div>
    
</div>-->
    
    
<!--<div class="pay-rentz">
  <div class="table-responsive">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Due Months</th>
        <th>Paid Date</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Washing Machine</td>
        <td>Jan - March</td>  
        <td>09/29/2017</td>
        <td> Rs. 500</td>
      </tr>
        <tr>
        <td>2</td>
        <td>Washing Machine</td>
        <td>April - June</td>  
        <td>09/29/2017</td>
        <td> Rs. 500</td>
      </tr>
        <tr>
        <td>3</td>
        <td>Washing Machine</td>
        <td>July - Sep</td>  
        <td>09/29/2017</td>
        <td> Rs. 500</td>
      </tr>
        <tr>
        <td>4</td>
        <td>Washing Machine</td>
        <td>Oct - Dec</td>  
        <td>09/29/2017</td>
        <td> Rs. 500</td>
      </tr>
    </tbody>
  </table>
  </div>      
    
</div>-->   
  
</div>
</div>
</div>
</section>

<?php include "footer.php"; ?>

  </body>
</html>