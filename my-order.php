<?php
require(dirname(__FILE__).'/appcore/app-register.php');

unset($_SESSION['prentz_redirect']);
  
if (!isset($_SESSION['prentz_user_id'])) { 

  $_SESSION['prentz_redirect'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $_SESSION['prentz_expired'] = "Session Expired..! Login Again..!";

  $conn->divert($RES_SURL['set_url']."index.php");
}
 require 'mailer/PHPMailerAutoload.php';
$userid=$_SESSION['prentz_user_id'];

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");


$uid = $_SESSION['prentz_user_id'];
if($uid) 
{    
    $userdetails = $conn->select_query(USER,"*","user_id='".$uid."'","1");
	
	//over all mails
	   $to=$EXTRA_ARG['set_email'];
	   
	   $name=$userdetails['user_name'];
	   $email=$userdetails['user_email'];
	   $mobile=$userdetails['user_mobile'];
		
		$from=$userdetails['user_email'];
		$uname=$userdetails['user_name'];
		
		$to1=$conn->variable($userdetails['user_email']);
		$from1=$EXTRA_ARG['from_email'];
		$fromname1=SITE_NAME;
		
  
}


$orders = $conn->select_query(ORDER,"*","customer_id ='".$userid."' order by ord_id desc","");
//service Req
if(isset($save))
{
	if($detailord!='' && $comments!='')
	{
//	$prodname = $conn->select_query(ORDERPRODUCT,"*","customer_id ='".$userid."' AND order_status_id='5'  AND order_product_id ='".$p_id."' order by order_product_id desc","1");
	
$mainord_id=$_REQUEST['mainord'];
$p_id=implode(',',$detailord);

foreach($detailord as $pname){
$prodname = $conn->select_query(ORDERPRODUCT,"name","order_product_id ='".$pname."'","1");

$pronames[]=$prodname['name'];
}
$pronames=implode(',',$pronames);
//print_r($pronames);exit;
  $arr=array('status'=>'W','p_id'=>$p_id,'main_ord_id'=>$mainord_id,'user_id'=>$userid,'product_name'=>$pronames,'serdate'=>NOW);
  $ins=$conn->insert(SERVICEREQUEST,"",$arr);
  if($ins)
  {
	 $comments=$_REQUEST['comments'];
		//SELLER HERE
		
		include "mailcontent/service-req.php";
		
    $succAlert = "Request Send Successfully.";
    
  
    
  }
	}else
{
	 $errorAlert = "Please Fill The Fields";
}
}

//product Return

if(isset($prod_return))
{
	if($retuord!='' && $comments!='')
	{
		
//$prodname = $conn->select_query(ORDERPRODUCT,"*","customer_id ='".$userid."' AND order_status_id='5'  AND order_product_id ='".$p_id."' order by order_product_id desc","1");
	
$mainord_id=$_REQUEST['mainord'];
$p_id=implode(',',$retuord);

foreach($retuord as $pname){
$prodname = $conn->select_query(ORDERPRODUCT,"name","order_product_id ='".$pname."'","1");

$pronames[]=$prodname['name'];
}
$pronames=implode(',',$pronames);
		
	 $dtime=date('Y-m-d H:i:s',strtotime($datetime));
  $arr=array('user_id'=>$userid,'status'=>'W','date_time'=>$dtime,'req_date'=>NOW,'pro_id'=>$p_id,'main_ord_id'=>$mainord_id,'prod_name'=>$pronames);
  $ins=$conn->insert(PRODUCTRETURN,"",$arr);
  if($ins)
  {
	  $comments=$_REQUEST['comments'];
	  include "mailcontent/prod-return.php";
    $succAlert = "Request Send Successfully.";
    
  
    
  }
	}
	else
{
	 $errorAlert = "Please Fill The Fields";
}
}

//product relocation
if(isset($prodtran_save))
{
	if($prodtrans!='' && $comments!='' && $number!='')
	{
		
//$prodname = $conn->select_query(ORDERPRODUCT,"*","customer_id ='".$userid."' AND order_status_id='5'  AND order_product_id ='".$p_id."' order by order_product_id desc","1");
	
$mainord_id=$_REQUEST['mainord'];
$p_id=implode(',',$prodtrans);

foreach($prodtrans as $pname){
$prodname = $conn->select_query(ORDERPRODUCT,"name","order_product_id ='".$pname."'","1");

$pronames[]=$prodname['name'];
}
$pronames=implode(',',$pronames);
		
		
 function GetImageExtension($imagetype)
   	 {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
		   case 'application/pdf': return '.pdf';
		  case 'application/msword': return $imagetype;
           default: return false;
       }
     }
	 
//id proof	 
	if (!empty($_FILES["prodimage"]["name"])) 

{
$up_dir="transfer/";
	$file_name=$_FILES["prodimage"]["name"];
	$temp_name=$_FILES["prodimage"]["tmp_name"]; 
	$imgtype=$_FILES["prodimage"]["type"];
 $ext= GetImageExtension($imgtype); 
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path = "transfer/".$imagename;
	$idproof=SITE_URL.$target_path;
	
	move_uploaded_file($temp_name, $target_path);
}
		
	 $dtime=date('Y-m-d H:i:s',strtotime($datetime));
  $arr=array('user_id'=>$userid,'status'=>'W','date_time'=>$dtime,'pro_id'=>$p_id,'main_ord_id'=>$mainord_id,'prod_name'=>$pronames,'image'=>$idproof);
  $ins=$conn->insert(PRODUCTTRANSFER,"",$arr);
  if($ins)
  {
	  
	  $comments=$_REQUEST['comments'];
	  include "mailcontent/relocation.php";
    $succAlert = "Request Send Successfully.";
    
  
    
  }
	}
	else
{
	 $errorAlert = "Please Fill The Fields";
}
}


//Name Transfer
if(isset($btn_nametrans))
{
	if($nametrans!='' && $new_name!='' && $new_email!=''&& $new_mobile!=''&& $new_address!='')
	{
		
//$prodname = $conn->select_query(ORDERPRODUCT,"*","customer_id ='".$userid."' AND order_status_id='5'  AND order_product_id ='".$p_id."' order by order_product_id desc","1");
	
$mainord_id=$_REQUEST['mainord'];
$p_id=implode(',',$nametrans);

foreach($nametrans as $pname){
$prodname = $conn->select_query(ORDERPRODUCT,"name","order_product_id ='".$pname."'","1");

$pronames[]=$prodname['name'];
}
$pronames=implode(',',$pronames);
		
	 $dtime=date('Y-m-d H:i:s',strtotime($datetime));
  $arr=array('user_id'=>$userid,'new_name'=>$new_name,'new_email'=>$new_email,'new_mobile'=>$new_mobile,'new_address'=>$new_address,'status'=>'W','namedate'=>DATE,'pro_id'=>$p_id,'main_ord_id'=>$mainord_id,'prod_name'=>$pronames);
  $ins=$conn->insert(NAMETRANSFER,"",$arr);
  if($ins)
  {
	   $comments=$_REQUEST['comments'];
	  include "mailcontent/name-transfer.php";
	  
	  
	  
    $succAlert = "Request Send Successfully.";
    
  
    
  }
	}
	else
{
	 $errorAlert = "Please Fill The Fields";
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
<style>
#treeDiv {
	background-color: white;
	/*border: 1px solid #7f9db9;*/
	height: 100px;
	overflow: auto;
	padding: 2px;
	width: 300px;
}
</style>
?>
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
            <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
            <li class="category-menu "><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
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
          <button type="button" class="btn btn-admenu toggle rotate" data-toggle="collapse" data-target="#admin-menu"> <span>Dashboard Menu</span>
          <div class="fa-style rotate"><i class="fa faaa fa-angle-down rotate"></i></div>
          </button>
          <div id="admin-menu" class="collapse admenu-box">
            <ul class="nav navbar-nav">
              <li class="category-menu active"><a href="<?php echo SITE_URL; ?>my-order.html" > My Order</a></li>
              <li class="category-menu"><a href="<?php echo SITE_URL; ?>my-dues.html"> My Dues</a></li>
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
        <table class="table table-order">
          <thead>
            <tr class="hidden-xs visible-lg visible-md visible-sm">
              <th style="width:4%;">S.No</th>
              <th style="width:14%;">Order ID</th>
              <th style="width:13%;">ITEM | Amount</th>
               <th style="width:13%;">Per Month</th>
              <th style="width:15%;">Payment Mode</th>
              <th style="width:9%;">Status</th>
              <th style="width:45%;">Action</th>
            </tr>
            <tr class="visible-xs">
              <th colspan="6" class="col-xs-12">Order Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php if($orders['nr']){
				$i=1;
			  foreach($orders['result'] as $resord){
				  
 $order_status = $conn->select_query(ORDERSTATUS,"*","order_status_id='".$resord['order_status_id']."' AND status='Y'","1");
 	$orderdet = $conn->select_query(ORDERPRODUCT,"*","order_id='".$resord['ord_id']."'","");
	if($orderdet['nr'])
	{
		
		 foreach($orderdet['result'] as $resmonth)
		 {
			 $totalmonth +=$resmonth['monthly_price'];
		 }
		
	}
			  ?>
            <tr class="visible-xs">
              <td colspan="6" class="position-relative"><a class="tooltip-t ancrlink" href="<?php echo SITE_URL; ?>order-details/<?php echo $resord['order_id']; ?>.html" title="View  <?php echo $resord['order_id']; ?>"> <?php echo $resord['order_id']; ?></a> <span class="odate">Date : <?php echo date('d-m-Y',strtotime($resord['ord_date'])); ?></span> <strong>Payment Type :</strong><?php echo $resord['paymethod'] ?><br>
                <strong>Status :</strong> <i class="fa fa-ok-sign icn-delived"></i> <?php echo $order_status['name'] ?>
                <table class="table table-cart-mobile">
                  <tbody>
                    <tr>
                      <th class="col-xs-12 bold text-right"><?php echo $orderdet['nr'];?> <span class="odate-1">|</span> &#8377; <?php echo $resord['total']; ?></th>
                    </tr>
                  </tbody>
                  <tbody>
                    <tr>
                      <th class="col-xs-12 bold">Action:<br>
                      <?php if($resord['order_status_id']=='5'){?>
                        <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#service-request">Service Request</button>
                        <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#addproduct">Product Return</button>
                        <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#name-return">Name Transfer</button>
                        <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#product-transfer">Product Relocation</button>
                      <?php }else{echo 'Product Not Yet Delivered';}?>
                      </th>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr class="hidden-xs">
              <td scope="row"><?php echo $i;?></td>
              <td><a class="tooltip-t ancrlink" href="<?php echo SITE_URL; ?>order-details/<?php echo $resord['order_id']; ?>.html" title="View <?php echo $resord['order_id']; ?>"><?php echo $resord['order_id']; ?></a> <span class="odate">Date : <?php echo date('d-m-Y',strtotime($resord['ord_date'])); ?></span></td>
              <td><?php echo $orderdet['nr'];?> <span class="odate-1">|</span> &#8377; <?php echo round($resord['total'],2); ?></td>
               <td><?php echo $totalmonth; ?></td>
              <td><?php echo $resord['paymethod'] ?></td>
              <td><i class="fa fa-ok-sign icn-delived"></i> <?php echo $order_status['name'] ?></td>
              <td>
              <?php if($resord['order_status_id']=='5'){?>
              <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#service-request<?php echo $resord['ord_id'];?>">Service Request</button>
                <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#addproduct<?php echo $resord['ord_id'];?>">Product Return</button>
                <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#name-return<?php echo $resord['ord_id'];?>">Name Transfer</button>
                <button type="submit" class="btn btn-tab btn-primary btn-primary-tab" data-toggle="modal" data-target="#product-transfer<?php echo $resord['ord_id'];?>">Product Relocation</button>
                  <?php }else{echo 'Product Not Yet Delivered';}?>
                </td>
            </tr>
            <?php $i++;}}else{?>
            <tr class="visible-xs">
              <td>No Records Found</td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?php include "footer.php"; ?>
<?php if($orders['nr']){
			  foreach($orders['result'] as $resord){
$orderdet = $conn->select_query(ORDERPRODUCT,"*","order_id='".$resord['ord_id']."' ","");	
//AND AND order_status_id='5'	  
				  ?>
<!--Service Request Start-->
<div class="modal fade" id="service-request<?php echo $resord['ord_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">
        Service Request - <?php echo $resord['order_id']; ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </h3>
        </button>
      </div>
      <div class="modal-body">
      <form name="service-request" id="service-request" method="post">
        <div class="form-group">
          <label for="">Product Name</label>
          <br/>
          <div id="treeDiv">
            <input type="hidden"  name="mainord" id="mainord" value="<?php echo $resord['ord_id']; ?>">
            <ul style="list-style:none; padding-left:10px; margin:0px; line-height:25px;">
              <?php if($orderdet['nr']){?>
              <?php
	foreach($orderdet['result'] as $resdet){
	 ?>
              <li>
           <input type="checkbox" name="detailord[]" id="detailord" value="<?php echo $resdet['order_product_id']; ?>" >
                <?php echo ucfirst($resdet['name']); ?> </li>
              <?php }}else{?>
              <?php }?>
            </ul>
          </div>
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
<!--Service Request End--> 

<!--Product Return Start-->
<div class="modal fade" id="addproduct<?php echo $resord['ord_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">
        Product Return - <?php echo $resord['order_id']; ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </h3>
        </button>
      </div>
      <form name="product-return" id="product-return" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Product Name</label>
            <br/>
            <div id="treeDiv">
            <input type="hidden"  name="mainord" id="mainord" value="<?php echo $resord['ord_id']; ?>">
            <ul style="list-style:none; padding-left:10px; margin:0px; line-height:25px;">
              <?php if($orderdet['nr']){?>
              <?php
	foreach($orderdet['result'] as $resdet){
	 ?>
              <li>
           <input type="checkbox" name="retuord[]" id="retuord" value="<?php echo $resdet['order_product_id']; ?>" >
                <?php echo ucfirst($resdet['name']); ?> </li>
              <?php }}else{?>
              <?php }?>
            </ul>
          </div>
          </div>
          <div class="form-group">
            <label for="">Date & Time</label>
            <div class="input-group date-time" id="datetimepicker<?php echo $resord['ord_id']; ?>">
              <input name="datetime<?php echo $resord['ord_id']; ?>" id="datepicker" class="form-control"/>
              <span class="input-group-addon"><span class="fa fa-calendar"></span></span> </div>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Comments</label>
            <textarea  name="comments" id="comments" class="form-control" required rows="4"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="prod_return" class="btn btn-primary btn-red">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Product Return End--> 

<!--product-transfer Start-->
<div class="modal fade" id="product-transfer<?php echo $resord['ord_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title" id="exampleModalLongTitle">
      Product Transfer - <?php echo $resord['order_id']; ?>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
      </h3>
      </button>
    </div>
    <form name="product-return" id="product-return" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <label for="">Mobile Number</label>
          <input type="text" required  name="number" id="number" class="form-control"  placeholder="number">
        </div>
        <div class="form-group">
          <label for="">Product Name</label>
          <br/>
          <div id="treeDiv">
            <input type="hidden"  name="mainord" id="mainord" value="<?php echo $resord['ord_id']; ?>">
            <ul style="list-style:none; padding-left:10px; margin:0px; line-height:25px;">
              <?php if($orderdet['nr']){?>
              <?php
	foreach($orderdet['result'] as $resdet){
	 ?>
              <li>
           <input type="checkbox" name="prodtrans[]" id="prodtrans" value="<?php echo $resdet['order_product_id']; ?>" >
                <?php echo ucfirst($resdet['name']); ?> </li>
              <?php }}else{?>
              <?php }?>
            </ul>
          </div>
        </div>
        <div class="form-group">
          <label for="">Date & Time</label>
          <div class="input-group date-time" id="datetimepicker">
            <input name="datetime" id="datepicker" required class="form-control"/>
            <span class="input-group-addon"><span class="fa fa-calendar"></span></span> </div>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Comments</label>
          <textarea  name="comments" id="comments" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label for="">Supporting Documents</label>
          <input type="file" name="prodimage" id="prodimage">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="prodtran_save" class="btn btn-primary btn-red">Submit</button>
      </div>
      </div>
    </form>
  </div>
</div>
<!--product-transfer End--> 

<!--Name Transfer Start-->
<div class="modal fade" id="name-return<?php echo $resord['ord_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">
        Name Transfer - <?php echo $resord['order_id']; ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
        </h3>
        </button>
      </div>
      <div class="modal-body">
        <form class="service-form">
        <div class="form-group">
          <label for="">Product Name</label>
          <br/>
        <div id="treeDiv">
            <input type="hidden"  name="mainord" id="mainord" value="<?php echo $resord['ord_id']; ?>">
            <ul style="list-style:none; padding-left:10px; margin:0px; line-height:25px;">
              <?php if($orderdet['nr']){?>
              <?php
	foreach($orderdet['result'] as $resdet){
	 ?>
              <li>
           <input type="checkbox" name="nametrans[]" id="nametrans" value="<?php echo $resdet['order_product_id']; ?>" >
                <?php echo ucfirst($resdet['name']); ?> </li>
              <?php }}else{?>
              <?php }?>
            </ul>
          </div>
          </div>
          <div class="form-group">
            <label for="">New Name</label>
            <input type="text" class="form-control" name="new_name" id="new_name" placeholder="">
          </div>
          <div class="form-group">
            <label for="">New Email Id</label>
            <input type="email" class="form-control" name="new_email" id="new_email" placeholder="">
          </div>
          <div class="form-group">
            <label for="">New Mobile Number</label>
            <input type="text" class="form-control" name="new_mobile" id="new_mobile" placeholder="">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Address</label>
            <textarea class="form-control" rows="4" name="new_address" id="new_address"></textarea>
          </div>
      
      </div>
      <div class="modal-footer">
        <button type="submit" name="btn_nametrans" id="btn_nametrans" class="btn btn-primary btn-red">Submit</button>
      </div>
    </div>
      </form>                                                                                                   
  </div>
</div>
<!--Name Transfer End-->
<script type="text/javascript">
            $(function () {
                $('#datetimepicker<?php echo $resord['ord_id']; ?>').datetimepicker();
            });
        </script> 
<?php }}?>


        
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
<script>

<?php 
//SUCCESS  Alerts
if(isset($succAlert) && $succAlert !='')
{
//echo "sdf";exit;  
  ?>
bootbox.dialog({
  message: "<p style='font-size:13px'><?php echo $succAlert; ?></p>",
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
}

if(isset($errorAlert) && $errorAlert !='')
{
//echo "sdf";exit;  
  ?>
bootbox.dialog({
  message: "<p style='font-size:13px'><?php echo $errorAlert; ?></p>",
  title: "<?php echo SITE_NAME; ?>",
  buttons: {
    success: {
      label: "OK",
      className: "btn-danger"
 <?php if($Alerterror){?>
    ,callback: function() {
        window.location.href="<?php echo $Alerterror; ?>";
      }
     <?php }?>
     
    }
  }
});
<?php
}
?>
</script>

</body>
</html>