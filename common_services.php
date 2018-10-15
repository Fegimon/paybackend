<?php
require(dirname(__FILE__).'/appcore/app-register.php');


 if(isset($_SESSION['prentz_user_id'])) 
 {
	 $userid=$_SESSION['prentz_user_id'];
 }

$catslug= $conn->variable($_REQUEST['cat_slug']);

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$commonservices = $conn->select_query(COMMONSERVICE,"*","brand_status = 'Y'");

$che_category = $conn->select_query(CATEGORY,"*","cat_slug='".$catslug."' AND cat_status = 'Y'", "1");
//echo $catslug; exit;
if(!$che_category['nr'] && !empty($catslug)){
  $conn->divert(SITE_URL);
}

if($catslug){
  $website = SITE_URL.'listing/'.$catslug.'.html?type=cat';
} else {
  $website = SITE_URL.'listing?type=cat';
}

if(isset($_COOKIE["current_location"])) { 
  $paging = $EXTRA_ARG['set_fpsize'];
  $cond="p.p_status='Y' AND pp.pp_location_id='".$_COOKIE["current_location"]."'";
  if($che_category['nr']){
    $cond .= " AND find_in_set('".$che_category['cat_id']."',p.p_category) <> 0";
  }
 
  $product_details = $conn->pagination(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) ","*",$cond,"p.p_id asc",$website,$paging,$_GET['page']);
}
//print_r($product_details); exit;


if(isset($save))
{
	$maincat=$_REQUEST['com_id'];
  $arr=array('status'=>'W','com_id'=>$maincat,'user_id'=>$userid);
  $ins=$conn->insert(COMMONSERVICEREQUEST,"",$arr);
  if($ins)
  {
   require 'mailer/PHPMailerAutoload.php';
   
   $name=$_REQUEST['name'];
	$mobile=$_REQUEST['phone'];
	$email=$_REQUEST['email_id'];
	$prodname=$_REQUEST['prodname'];
	$description=$_REQUEST['description'];
	$address=$_REQUEST['address'];
		//SELLER HERE
		$to=$EXTRA_ARG['service_email'];
		$from=$_REQUEST['email_id'];
		$uname=$_REQUEST['name'];
		
		$to1=$conn->variable($_REQUEST['email_id']);
		$from1=$EXTRA_ARG['service_email'];
		$fromname1=SITE_NAME;
		include "mailcontent/servicemail.php";
		
	//	$Alertsuccess="Enquiry Submited successfully. We will contact you soon ";
		//$Alertsuccessurl=SITE_URL.'common_services.html';
    
  }
}



if ($ins) {
    echo "<script type='text/javascript'>alert('Thank you for submitting your service request our representative will call you soon to schedule an appointment.!')</script>";
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
<section id="inner-header" >
  <div class="sub-page-category-inner">
    <div class="container-fluid">
      <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">Services</li>
        </ol>
      </div>
      <div class="pull-right">
        <ul class="product-menu">
          <!-- <li><a href="<?php echo SITE_URL.'shopall.html';?>"><img src="images/p5.png" class="prod-img center-block">All Products</a></li> -->
          <?php foreach($selcategory['result'] as $res) {
           // echo "<pre>";
           // print_r($res); exit;
            if (!empty($res['cat_logo'])) {

            if (file_exists('uploads/category/'.$res['cat_logo'])) { 
             // $cat_logo = SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/category/'.$res['cat_logo'].'&w=30&h=30&zc=0';
              $cat_logo='categorys/image/'.$res['cat_logo'];  
            } else { 
             // $cat_logo = SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=30&h=30&zc=0';
              $cat_logo='catnoimg/noimage.png';
            }                 
            } else {
             // $cat_logo = SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=30&h=30&zc=0';
              $cat_logo='catnoimg/noimage.png';
            }

           ?>
          <?php /*?>        <li><a href="<?php echo SITE_URL.$conn->stripval($res['cat_slug']).'.html'; ?>"><img src="<?php echo $cat_logo; ?>" class="prod-img center-block"><?php echo $conn->stripval(ucfirst($res['cat_title'])); ?></a></li><?php */?>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<div class="clear-fix"></div>

<!-- ================================================================ -->

<section id="product-llisting">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h3>Services</h3>
      </div>
      <div class="service-img-top">
        <?php foreach($commonservices['result'] as $commonservice ) { ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="service-inner">
            <div class="content"> 
              
              <!-- Modal -->
              
              <div class="modal fade" id="myModal_1" role="dialog">
                <div class="modal-dialog"> 
                  
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Add Information</h4>
                    </div>
                    <form class="sa-innate-form" id="frm_enq" method="post">
                      <input type="hidden" name="com_id" value="<?php echo $commonservice['id'] ?>">
                      <div class="modal-body"> 
                        
                        <!--<p>Some text in the modal.</p>-->
                        <div class="form-group">
                          <label for="name">Name <span style="color:#a70f13">*</span></label>
                          <input class="form-control"  placeholder="Name" name="name" id="address-name" maxlength="100" type="text" required>
                        </div>
                        <div class="form-group">
                          <label for="email">E-mail Address <span style="color:#a70f13">*</span></label>
                          <input class="form-control" placeholder="E-mail Address" name="email_id" id="address-email" maxlength="150" type="text" required>
                        </div>
                        <div class="form-group">
                          <label for="mobile">Mobile Number <span style="color:#a70f13">*</span></label>
                          <input class="form-control" placeholder="Mobile Number" name="phone" id="address-mobile" maxlength="15" type="text" required>
                        </div>
                        
                          <div class="form-group">
                          <label for="mobile">Product Name <span style="color:#a70f13">*</span></label>
                          <input class="form-control" placeholder="Product Name" name="prodname" id="address-mobile" maxlength="15" type="text" required>
                        </div>
                        
                        <div class="form-group">
                          <label for="mobile">Description <span style="color:#a70f13">*</span></label>
                          <textarea name="description" id="description" required></textarea>
                        </div>
                        <div class="form-group">
                          <label for="address">Address <span style="color:#a70f13">*</span></label>
                          <textarea name="address" id="address" required></textarea>
                        </div>
                        
                       <!-- <div class="form-group">
                          <label for="state">Type <span style="color:#a70f13">*</span></label>
                          <select class="form-control" name="type" id="address-state">
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                          </select>
                        </div>-->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" name="save" class="btn btn-primary btn-red">Submit</button>
                        </div>
                      </div>
                    </form>
                    <!--<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>--> 
                  </div>
                </div>
              </div>
              
              <!--model --> 
              
              <a href="#" target="_self" data-toggle="modal" data-target="#myModal_1">
              <div class="content-overlay"></div>
              <img class="content-image" src="<?php echo SITE_URL.'/uploads/commonservice/'.$commonservice['brand_img'];?>">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">
                  <?php  echo $commonservice['name']?>
                </h3>
              </div>
              </a> </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php /*?><div class="product-listing-sub">
  <div class="container-fluid">
    <div class="row">
    <h3>Featured Products</h3>
      <?php if($cat_product_details['nr']){ 
  foreach ($cat_product_details['result'] as $key => $product_detail) {
  ?>
      <div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
        <div class="col-box">
          <div class="hovereffect">
            <?php if(!empty($product_detail['p_image'])){
        if (file_exists('uploads/product/'.$product_detail['p_image'])) { 
          $p_image='products/image/'.$product_detail['p_image'];                    
        }else{ 
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
        }                 
      }else{
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
          
      }   ?>
            <a href="<?php echo SITE_URL.$product_detail['p_slug'].'.html';?>"><img src="<?php echo $p_image; ?>" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay"> <a href="javascript:void(0)" onclick="cartAdd('<?php echo $product_detail['p_id']; ?>', '1', '');" class="prd-cart-button prd-button">Add To Cart</a> <a href="javascript:void(0)" onclick="cartAdd('<?php echo $product_detail['p_id']; ?>', '1', '1');" class="rent-now-button prd-button">Rent Now</a> </div>
          </div>
          <a href="<?php echo SITE_URL.$product_detail['p_slug'].'.html';?>">
          <p class="prd-name"><?php echo $product_detail['p_name']; ?></p>
          </a>
          <p class="prd-price">₹<?php echo round($product_detail['ps_price_month'], 2); ?><span> Rent/Month</span></p>
        </div>
      </div>
      <!--col-->
      
      <?php } } else { ?>
      <div class="col-md-12"> No Products Found </div>
      <?php  } ?>
    </div>
            <div class="col-md-12">
        <div class="text-center">
        <nav aria-label="Page navigation">         
         <?php if($cat_product_details['nr']>$paging){
              $pagepagination = str_replace("&laquo; prev", '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',$cat_product_details['page']);
              $pagepagination = str_replace("next &raquo;", '<i class="fa fa-angle-double-right" aria-hidden="true"></i>', $pagepagination);
              $pagepagination = str_replace("span", 'a', $pagepagination);
         echo  $pagepagination;

          } ?>
    
        </nav>
        </div>
      </div>   
  </div>
  
  </div><?php */?>
  </div>
  </div>
</section>
<div id="myModal-common" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="text-center">
          <h3>Non PayRentz Product</h3>
        </div>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="email">Name:</label>
            <input type="email" class="form-control" id="email" placeholder="Name" name="email">
          </div>
          <div class="form-group">
            <label for="pwd">Email:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Email" name="pwd">
          </div>
          <div class="form-group">
            <label for="pwd">Mobile No:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Mobile No" name="pwd">
          </div>
          <div class="form-group">
            <label for="comment">Address:</label>
            <textarea class="form-control" rows="5" id="comment" placeholder="Address"></textarea>
          </div>
          <div class="form-group">
            <label for="pwd">Product Name:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Product Name" name="pwd">
          </div>
          <div class="form-group">
            <label for="comment">Remarks:</label>
            <textarea class="form-control" rows="5" id="comment" placeholder="Remarks"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
<script>
    $(window).load(function(){        
  // $('#myModal-common').modal('show');
    }); 
</script>
</body>
</html>
