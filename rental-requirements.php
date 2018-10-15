<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$catslug= $conn->variable($_REQUEST['cat_slug']);

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

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

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <?php  include "inner-header.php"; ?>
     <base href="<?php echo SITE_URL; ?>">
  </head>
  <body>
<?php include 'menu.php'; ?>

<section id="inner-header" >
<div class="sub-page-category-inner">
  <div class="container-fluid">
    <div class="pull-left">
      <ol class="breadcrumb">
        <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
        <li class="active">Rental Requirements</li>
      </ol>
    </div>
    <div class="pull-right">
      <ul class="product-menu">
        <li><a href="<?php echo SITE_URL.'shopall.html';?>"><img src="images/p5.png" class="prod-img center-block">All Products</a></li>
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
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="text-center">
     <div class="btn-group btn-group-toggle " data-toggle="buttons">
  <label class="btn btn-secondary ">
  <a href="personal-details.php">
    <input type="radio" name="options" id="option1" autocomplete="off" checked > 1. Personal Details
    </a>
  </label>
  
  <label class="btn btn-secondary">
  <a href="professional-details.php">
    <input type="radio" name="options" id="option2" autocomplete="off"> 2. Professional Details
    </a>
  </label>
  <label class="btn btn-secondary active">
  <a href="rental-requirements.php">
    <input type="radio" name="options" id="option3" autocomplete="off"> 3. Rental Requirements
    </a>
  </label>
  <label class="btn btn-secondary">
  <a href="reference-details.php">
    <input type="radio" name="options" id="option3" autocomplete="off">Reference Details
    </a>
  </label>
</div>
<div>&nbsp;</div>
</div>
     </div>
      <div class="personal-detail-form">
      <h3>Rental Requirements</h3>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <form action="" >
  <div class="form-group">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="products-required">Products Required</label>
    <input type="products-required" class="form-control" id="products-required">
  </div>
  </div>

    
    <div class="form-group">
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <label for="rental-duration">Rental Duration</label>
    <input type="rental-duration" class="form-control" id="rental-duration">

    </div>
    
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<label for="rent-month">Rent/Month: ₹ </label>
    <input type="rent-month" class="form-control" id="rent-month">
    </div> 
    </div>
    


<div class="form-group">
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <label for="registration-rs">Registration: ₹</label>
    <input type="registration-rs" class="form-control" id="registration-rs">

    </div>
    
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<label for="rental-deposit">Rental Deposit: ₹ </label>
    <input type="rental-deposit" class="form-control" id="rental-deposit">
    </div>
      
      
    </div> 

    

    <div> &nbsp;</div>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="pull-right">
   <a  href="reference-details" class="btn btn-success btn-md">Submit</a>
     </div>
     
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

