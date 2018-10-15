<?php
//require(dirname(__FILE__).'/appcore/app-register.php');

$catslug= $conn->variable($_REQUEST['cat_slug']);
$catslug='rent-for-office';
/*$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

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
<?php include 'menu.php'; */?>

<section id="inner-header">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL;?>">Home</a></li>
          <li class="active">All Products</li>
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
           <li><a href="<?php echo SITE_URL.$conn->stripval($res['cat_slug']).'.html'; ?>"><img src="<?php echo $cat_logo; ?>" class="prod-img center-block"><?php echo $conn->stripval(ucfirst($res['cat_title'])); ?></a></li>
           <?php } ?>    
        </ul>
    </div>
</div>
</section>


<section id="product-llisting">
<div class="container-fluid">
<div class="">
<?php if($cat_product_details['nr']){ 
  foreach ($cat_product_details['result'] as $key => $product_detail) {
	  
	  	$exist = $conn->image_exist($product_detail['p_image'],"uploads/product/");
     $prodimg= ($exist) ? "product/image/".$product_detail['p_image'] : "images/product-1.png";   
  ?>
  <div class="col-md-3 col-xs-6 col-sm-3 col-lg-3">
    <div class="col-box">
      <div class="hovereffect">
          <?php if(!empty($product_detail['p_image'])){
        if (file_exists('uploads/product/'.$product_detail['p_image'])) { 
          $p_image='product/image/'.$product_detail['p_image'];                    
        }else{ 
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
        }                 
      }else{
          //$p_image=SITE_URL.'timthumb.php?src='.SITE_URL.'uploads/noimage.png&w=250&h=250&zc=0';
          $p_image='noimg/noimage.png';
          
      }   ?>
          <a href="<?php echo SITE_URL.$product_detail['p_slug'].'.html';?>"><img src="<?php echo $prodimg; ?>" class="img-responsive center-block wow flipInX"></a>
              <div class="overlay">
                  <a href="javascript:void(0)" onClick="cartAdd('<?php echo $product_detail['p_id']; ?>', '1', '');" class="prd-cart-button prd-button">Add To Cart</a>
                  <a href="javascript:void(0)" onClick="cartAdd('<?php echo $product_detail['p_id']; ?>', '1', '1');" class="rent-now-button prd-button">Rent Now</a>
              </div>
      </div>

      <a href="<?php echo SITE_URL.$product_detail['p_slug'].'.html';?>"><p class="prd-name"><?php echo $product_detail['p_name']; ?></p></a>
      <p class="prd-price">₹<?php echo round($product_detail['ps_price_month'], 2); ?><span> Rent/Month</span></p>
    </div>
  </div><!--col-->
<?php } } else { ?>
          <div class="col-md-12">
                No Products Found
          </div>
<?php  } ?>


    
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
</div>
</section>
<?php /* ?>
<?php include "footer.php"; ?>

 </body>
</html>
<?php */ ?>