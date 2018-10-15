<?php
require(dirname(__FILE__).'/appcore/app-register.php');
//echo "dsfS";exit;
$cp_slug= $conn->variable($_REQUEST['cp_slug']);

$che_category = $conn->select_query(CATEGORY,"*","cat_slug='".$cp_slug."' AND cat_status = 'Y'", "1");

$product_detail = $conn->select_query(PRODUCT,"*", "p_slug = '".$cp_slug."' AND p_status = 'Y'", "1");

//echo $cp_slug; 
//print_r($product_detail);
//print_r($che_category);
//exit;

/*if(!$che_category['nr'] && !empty($cp_slug)){
  $conn->divert(SITE_URL);
}*/

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

if($che_category['nr'] || $cp_slug=="shopall"){

  if($cp_slug){
    $website = SITE_URL.$cp_slug.'.html?type=cat';
  } else {
    $website = SITE_URL.'shopall.html?type=cat';
  }
  
  if(isset($_COOKIE["current_location"])) { 

    $paging = $EXTRA_ARG['set_fpsize'];

    $cond="p.p_status='Y' AND pp.pp_location_id='".$_COOKIE["current_location"]."'";
    
    if($che_category['nr']){
      $cond .= " AND find_in_set('".$che_category['cat_id']."',p.p_category) <> 0";
    }
   
    $cat_product_details = $conn->pagination(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) ","*",$cond,"p.p_id asc",$website,$paging,$_GET['page']);
  }
} elseif ($product_detail['nr']) {

    if(isset($_COOKIE["current_location"])) {   
      $cond="p.p_status='Y' AND pp.pp_location_id='".$_COOKIE["current_location"]."'";
      $cond .=" AND p.p_slug = '".$cp_slug."'";
      
      $product_details = $conn->select_query(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) LEFT JOIN ".TAX." t ON(t.tax_id=pp.pp_taxes)","*",$cond,"1");
    } else {
      $product_details='';
    }

    if($product_details['nr']){
   
      $product_spec = $conn->select_query(PRODUCTSPECIFICATION,"*", "product_id = '".$product_details['p_id']."'");

      $product_image = $conn->select_query(PRODUCTIMAGE,"*", "product_id = '".$product_details['p_id']."'"); 

    }

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
<?php include 'menu.php';?>
 <div class="top-space"></div>
<?php
if(isset($cat_product_details)){
  include 'common_product_listing.php';
} elseif($product_details['nr']) {
  include 'common_product_detail.php';
}else{
  echo "<p>No Product Available</p>";
}
?>
<?php include "footer.php"; ?>

 </body>
</html>