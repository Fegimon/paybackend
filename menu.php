<?php
$uid = $_SESSION['prentz_user_id'];
if($uid) 
{    
 $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");  
}
$carttotalloc= $shopcart->getTotalAmount();
$cartlocval=$carttotalloc['nr'];

//cart update

if(isset($_SESSION['prentz_cart']))
{
	$cartcount=$_SESSION['prentz_cart'];
}
else
{
	$cartcount='0';
}
$topmenus = $conn->select_query(TOPMENU,"*","tl_status = 'Y'");

$buy_urls = $conn->select_query(ADMIN,"*","");

//$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y' order by cat_pos asc");

  if(isset($_COOKIE["current_location"])) {
    //echo $_COOKIE["current_location"];  exit;
    $current_location_name = $conn->select_query(LOCATION,"*","lo_id='".$_COOKIE["current_location"]."' AND lo_status = 'Y'", '1');  
  }

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y' order by lo_name asc");

$cart_total= $shopcart->getTotalAmount();

?>
<style>

.sub-menu-parent a{
	position:relative;
	}
.sub-menu-parent span{
	 color:#f27721;
	}
.sub-menu-parent span:hover{
	 color:#fff;
	}
.sub-menu-parent:hover{
	 color:#fff !important;
	}
</style>
<!-- mobile header -->
<div class="header">
<div class="mobile-hidden visible-xs navbar-fixed-top mob-header">
  <div id="header-container" class="container navbar-container mob-header"> <a href="#menu" class="pull-left menu-icon-size"> <i class="fa fa-cbar"></i> </a> <a id="brand" class="navbar-brand wow fadeInLeft" href="<?php echo SITE_URL;  ?>"><img src="<?php echo SITE_URL ?>images/mobile-payrentz-logo.png" class="img-responsive mob-header-img"> </a>
    <div>
      <ul class="mobile-top-in">
        <li><a style="font-size:9px !important" href="tel:<?php echo $RES_SURL['set_phone'];  ?>"><i class="fa fa-phone"></i> <?php echo $RES_SURL['set_phone'];  ?></a></li>
        <li><a style="font-size:9px !important" href="tel:<?php echo $RES_SURL['set_phone1'];  ?>"><i class="fa fa-phone"></i><?php       echo $RES_SURL['set_phone1'];  ?></a></li>
        <?php if($uid) {?>
        <li class="dropdown dropdown-color-1"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo  $userdetails['user_name']; ?><span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menu-color-1" role="menu">
        <li ><a href="<?php echo SITE_URL; ?>my-profile.html" >My Profile</a></li>
        <li><a href="<?php echo SITE_URL; ?>change-password.html">Change Password</a></li>
       <li><a href="javascript:void(0)" data-toggle="modal" data-target="#logout">Logout</a></li>
      </ul>
    </li>
    <?php }else{?>
        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"> <i class="fa fa-user"></i> Login</a></li>          
        <?php }?>
        <li role="presentation" class="dropdown  menu-pad-0">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <?php echo ucfirst($current_location_name["lo_name"]); ?> <span class="caret"></span>
    </a>
      <ul class="dropdown-menu menu-pad-1">
        <li class="loaction-width">
          <div  id="drop-panel">
            <div class=" city-col">
             <?php foreach ($sellocation['result'] as  $resloc) {
				 $exist = $conn->image_exist($resloc['lo_image'],"uploads/location/");
		 $locimg = ($exist) ? "location/image/".$resloc['lo_image'] : "images/chennai.png";
				 
				  ?>
              <ul>
                <li><img src="<?php echo $locimg; ?>"  alt="<?php echo $resloc['lo_name']; ?>" /> </li>
               <li> <a href="javascript:void(0)" class="set_location" location_id="<?php echo $resloc['lo_id']; ?>"><?php echo ucfirst($resloc['lo_name']); ?></a> </li>
              </ul>
              <?php }?>
              <!--<ul>
                <li><img src="images/coiambatore.png"  alt="Payrentz" /> </li>
                <li> <a href="javascript:void(0)" class="set_location" location_id="#">Coiambatore</a> </li>
              </ul>-->
            </div>
          </div>
        </li>
      </ul>
    </li>
    
    <li class="sub-menu-parent" tab-index="0">
       <a href="<?php echo SITE_URL; ?>cart.html"><i class="fa fa-cart-plus"></i> <sup><span class="cartdiv">( <?php echo $cartcount;?> )</span></sup> </a>
       
     </li> 
      </ul> 
    
      
   
    </div>
  </div>
</div>
<nav class="navbar navbar-default navbar-fixed-top hidden-xs">
<div class="container-fluid">
<div class="row">
<div id="header-main">
<div id="header-inner">
<div class="logo-width">
  <div class="navbar-header">
    <div class="navbar-toggle"><a href="#menu"><i class="fa fa-bars"></i></a></div>
    <a class="navbar-brand home-nav-brand" title="Payrentz" href="<?php echo SITE_URL;  ?>"><img src="<?php echo SITE_URL ?>images/payrentz-logo.png"  alt="Payrentz" /></a> </div>
</div>
<div id="navbar" class="navbar-collapse collapse">
<div class="header-top-width">
<ul class="nav navbar-nav hidden-xs navbar-right menuon-top">
<li ><a href="javascript:void(0)"><i class="fa fa-phone"></i>  <?php echo $RES_SURL['set_phone'];  ?></a></li>
<li ><a href="javascript:void(0)"><i class="fa fa-phone"></i>&nbsp;<?php echo $RES_SURL['set_phone1'];  ?></a></li>
<li ><a href="<?php  echo SITE_URL;?>my-dues.html"> <i class="fa fa-credit-card"></i> Make a Payment</a></li>
<?php if($uid) {?>

<!-- <li ><a href="#" > <i class="fa fa-user"></i><?php echo  $userdetails['user_name']; ?></a></li> -->
 <li class="dropdown "><a href="javascript:void(0)" data-hover="dropdown" aria-expanded="false"><?php echo  $userdetails['user_name']; ?><span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li ><a href="<?php echo SITE_URL; ?>my-profile.html" >My Profile</a></li>
        <li><a href="<?php echo SITE_URL; ?>change-password.html">Change Password</a></li>
       <li><a href="javascript:void(0)" data-toggle="modal" data-target="#logout">Logout</a></li>
      </ul>
    </li>
    <li class="sub-menu-parent" tab-index="0">
       <a href="<?php echo SITE_URL; ?>cart.html"><i class="fa fa-cart-plus"></i> <sup><span class="cartdiv">( <?php echo $cartcount;?> )</span></sup> </a>
       
     </li>
<?php }else{?>
<li ><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"> <i class="fa fa-user"></i> Login</a></li>
<li class="sub-menu-parent" tab-index="0">
       <a href="<?php echo SITE_URL; ?>cart.html"><i class="fa fa-cart-plus"></i> <sup><span class="cartdiv">( <?php echo $cartcount;?> )</span></sup> </a>
       <!--<ul class="sub-menu">
         <li class="submenu-style"><a href="digital-marketing.html">Recentely Added Items(2)</a></li>
          <li class="submenu-style-1"><a href="digital-marketing.html">SUBTOTAL: &#8377;999</a></li>
          <button class="btn btn-default" type="submit">View In Cart</button>
       </ul>-->
     </li>
<?php }?>

</div>
<div class="header-bottom-width">
  <ul class="nav navbar-nav hidden-xs navbar-left nav-menu-text">
    <li class=" dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="javascript:void(0)">Rent<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li ><a href="<?php echo SITE_URL; ?>category/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo 'rent-for-home'  ?>.html"><i class="fa fa-stop"></i> Rent For Home</a></li>
        <li ><a href="<?php echo SITE_URL; ?>category/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo 'rent-for-office'  ?>.html"> <i class="fa fa-stop"></i> Rent For Office</a></li>
        <li ><a href="<?php echo SITE_URL; ?>category/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo 'rent-for-events'  ?>.html"><i class="fa fa-stop"></i> Rent For Events</a></li>
      </ul>
    </li>
    
    <li class="dropdown "><a href="javascript:void(0)" data-hover="dropdown" aria-expanded="false">Service <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo SITE_URL; ?>service-request.html"><i class="fa fa-stop"></i>PayRentz Product</a></li>
        <li><a href="<?php echo SITE_URL; ?>common_services.html"><i class="fa fa-stop"></i>Non PayRentz Product</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="javascript:void(0)" data-hover="dropdown" aria-expanded="false">Buy <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo SITE_URL; ?>clearance-website.html"><i class="fa fa-stop"></i>Clearance Website</a></li>
      </ul>
    </li>
    <li class="dropdown "><a href="javascript:void(0)" data-hover="dropdown" aria-expanded="false">Business Solutions <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo SITE_URL; ?>business.html"><i class="fa fa-stop"></i> Business Solutions  </a></li>
      </ul>
    </li>
    <!--  <li><a href="personal-details.php"> Personal Details </a></li> -->
    <?php if($topmenus['nr']){ ?>
    <?php foreach ($topmenus['result'] as  $topmenu) { ?>
    <li class="dropdown "><a href="<?php echo SITE_URL; ?>page/<?php echo $topmenu['tl_slug']; ?>.html" data-hover="dropdown" aria-expanded="false"><?php echo $topmenu['tl_name'] ?></a></li>
    <?php }?>
    <?php }?>
  </ul>
   <?php if($sellocation['nr']){ ?>
   
  <ul class="nav navbar-nav navbar-right location-map">
    <li class="dropdown"> <a href="javascript:void(0)" id="city-link" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false" location_id="<?php echo $_COOKIE["current_location"]; ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $current_location_name["lo_name"]; ?> <span class="caret"></span></a>
      <ul class="dropdown-menu ">
        <li class="loaction-width">
          <div  id="drop-panel">
            <div class=" city-col">
             <?php foreach ($sellocation['result'] as  $resloc) {
				 $exist = $conn->image_exist($resloc['lo_image'],"uploads/location/");
		 $locimg = ($exist) ? "location/image/".$resloc['lo_image'] : "images/chennai.png";
				 
				  ?>
              <ul>
                <li><img src="<?php echo $locimg; ?>"  alt="<?php echo $resloc['lo_name']; ?>" /> </li>
               <li> <a href="javascript:void(0)" class="set_location" location_id="<?php echo $resloc['lo_id']; ?>"><?php echo $resloc['lo_name']; ?></a> </li>
              </ul>
              <?php }?>
              <!--<ul>
                <li><img src="images/coiambatore.png"  alt="Payrentz" /> </li>
                <li> <a href="javascript:void(0)" class="set_location" location_id="#">Coiambatore</a> </li>
              </ul>-->
            </div>
          </div>
        </li>
      </ul>
    </li>
  </ul>
  <?php }?>
</div>
</div>
</div>
</div>
</div>
</div>
</nav>
</div>
