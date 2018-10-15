<?php
require(dirname(__FILE__).'/appcore/app-register.php');
//echo "df";exit;
if(isset($_REQUEST['cat_slug']))
{
$catslug= $conn->variable($_REQUEST['cat_slug']);
}else{
$catslug= $conn->variable($_REQUEST['productlist_slug']);
}
$mcatslug= $conn->variable($_REQUEST['mcat_slug']);
$locslug= $conn->variable($_REQUEST['loc_slug']);
 
if($locslug!='')
{
	$cookloct = $conn->select_query(LOCATION,"*","lo_name='".$locslug."' AND lo_status = 'Y'",1);
	$cookie_name = "current_location";
 $cookie_value = $cookloct['lo_id'];
//unset($_COOKIE["current_location"]);
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
/*if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}*/
//echo $_COOKIE["current_location"];
	//exit;
	
}

/*if(!$catslug)
{
  $conn->divert(SITE_URL);
}*/

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$che_category = $conn->select_query(CATEGORY,"*","cat_slug='".$catslug."' AND cat_status = 'Y'", "1");

$maincat = $conn->select_query(CATEGORY,"*","cat_id='".$che_category['cat_p_id']."' AND cat_status = 'Y'", "1");

$selprod = $conn->select_query(PRODUCT,"*","p_category='".$che_category['cat_p_id']."' AND p_sub_category='".$che_category['cat_id']."' AND p_status = 'Y' order by p_position asc", "");

 $product_details = $conn->pagination(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) ","*",$cond,"p.p_position asc",$website,$paging,$_GET['page']);


$categorys = $conn->select_query(CATEGORY,"*","cat_slug='".$catslug."' AND cat_status = 'Y'", "1");

$subcats = $conn->select_query(CATEGORY,"*","cat_p_id='".$categorys['cat_p_id']."' AND cat_status = 'Y' order by cat_pos ", "");


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
 
  $product_details = $conn->pagination(PRODUCTPRICE." as pp LEFT JOIN ".PRODUCT." as p ON(p.p_id=pp.pp_product_id) ","*",$cond,"p.p_position asc",$website,$paging,$_GET['page']);
}
//print_r($product_details); exit;
$websitenew = SITE_URL.'productlist/'.$catslug.'.html?type=subcat';
$pagingnew = $EXTRA_ARG['set_fpsize'];

//$selprod = $conn->pagination(PRODUCT,"*","p_category='".$che_category['cat_p_id']."' AND p_sub_category='".$che_category['cat_id']."' AND p_status = 'Y'","p_category asc",$websitenew,$pagingnew,$_GET['paging']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo-cat.php";?>
<?php  include "inner-header.php"; ?>
<?php include "tracker.php"; ?>
<base href="<?php echo SITE_URL; ?>">
</head><body>
<?php include 'menu.php';?>
<section id="inner-header" >
  <div class="container-fluid padd-1-none">
    <div class="row">
      <div class="">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL;?>">Home</a></li> 
          <li class="active"><a href="<?php echo SITE_URL; ?>category/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $maincat['cat_slug']; ?>.html"><?php echo $maincat['cat_title']; ?></li></a>
          <li class="active"><?php echo $che_category['cat_title']; ?></li>
          <?php /*?><li class="active"><a href="<?php echo SITE_URL; ?>productlist/<?php echo $current_location_name["lo_name"]; ?>/<?php echo $che_category['cat_slug']  ?>.html"><?php echo $che_category['cat_title']; ?></li></a><?php */?>
          <!-- <li class="active">All Products</li> -->
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="">
        <ul class="product-menu">
          <!--  <li><a href="<?php echo SITE_URL.'listing';?>"><img src="images/p5.png" class="prod-img center-block">All Products</a></li> -->
          <?php foreach($subcats['result'] as $res) {
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
          <li class=""><a href="<?php echo SITE_URL; ?>productlist/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $res['cat_slug']  ?>.html"><img src="<?php echo $cat_logo; ?>" class="prod-img center-block"><?php echo $conn->stripval(ucfirst($res['cat_title'])); ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="product-llisting">
  <div class="container-fluid">
    <div class="">
      <?php if($product_details['nr']){ 
  foreach ($product_details['result'] as $key => $product_detail) {
	  
	  
	  $seltax = $conn->select_query(TAX,"*","tax_id='".$product_detail["pp_taxes"]."'", '1');  
					if($product_detail['p_category']=='3')
					{
						 $tax=($seltax['tax_percentage']/100);
						 $rent=round($product_detail['ps_price_month'], 2);
						$taxamnt= $rent * $tax;
						//$month=$rent+$taxamnt;
						$month=$rent;
						$txt='Day';
					}elseif($product_detail['p_category']!='3')
					{
						//$month=round($res['pp_price_3_month'], 2);
						$tax=($seltax['tax_percentage']/100);
						 $rent=round($product_detail['pp_price_12_month'], 2);
						$taxamnt= $rent * $tax;
						//$month=$rent+$taxamnt;
						$month=$rent;
						$txt='Month';
					}
					
	  
	  	$exist = $conn->image_exist($product_detail['p_image'],"uploads/product/");
     $prodimg= ($exist) ? "product/image/".$product_detail['p_image'] : "images/product-1.png";  
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
            <a href="<?php echo SITE_URL.'product-detail/'.strtolower($current_location_name["lo_name"]).'/'.$mcatslug.'/'.$product_detail['p_slug'].'.html';?>"><img src="<?php echo $prodimg; ?>" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay"> <a href="javascript:void(0)" onclick="cartAdd('<?php echo $product_detail['p_id']; ?>', '1', '');" class="prd-cart-button prd-button">Add To Cart</a> <a href="javascript:void(0)" onclick="cartAdd('<?php echo $product_detail['p_id']; ?>', '1', '1');" class="rent-now-button prd-button">Rent Now</a> </div>
          </div>
          <a href="<?php echo SITE_URL.'product-detail/'.strtolower($current_location_name["lo_name"]).'/'.$mcatslug.'/'.$product_detail['p_slug'].'.html';?>">
          <p class="prd-name"><?php echo $product_detail['p_name']; ?></p>
          </a>
          <?php if($product_detail['p_category']!='3'){?>  <p class="prd-price">₹ <?php echo round($month, 2); ?><span> Rent/<?php echo $txt;?></span></p><?php  }?>
        </div>
      </div>
      <!--col-->
      <?php } } else { ?>
      <!-- <div class="col-md-12">
                No Products Found
          </div> -->
      <?php  } ?>
      <div class="col-md-12">
        <div class="text-center">
          <nav aria-label="Page navigation">
            <?php 
		// echo $product_details['nr'];exit;
		 if($product_detail['nr']>$paging){
              $pagepagination = str_replace("&laquo; prev", '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',$product_detail['page']);
              $pagepagination = str_replace("next &raquo;", '<i class="fa fa-angle-double-right" aria-hidden="true"></i>', $pagepagination);
              $pagepagination = str_replace("span", 'a', $pagepagination);
         echo  $pagepagination;

          } ?>
          </nav>
        </div>
      </div>
      
      <!-- product list start -->
      
      <?php ?>
      <?php if($selprod['nr']){ ?>
      <?php foreach ($selprod['result'] as $selpro) {
	
		$exist = $conn->image_exist($selpro['p_image'],"uploads/product/");
     $prodimg= ($exist) ? "product/image/".$selpro['p_image'] : "images/product-1.png";  
	 
	 
	
	 ?>
      <?php $sel_price = $conn->select_query(PRODUCTPRICE,"*","pp_product_id='".$selpro['p_id']."' AND pp_location_id ='".$_COOKIE["current_location"]."'","1");  ?>
      <?php if($sel_price['nr']){
	
	  $seltax = $conn->select_query(TAX,"*","tax_id='".$sel_price["pp_taxes"]."'", '1');  
					if($selpro['p_category']=='3')
					{
						 $tax=($seltax['tax_percentage']/100);
						 $rent=round($sel_price['ps_price_month'], 2);
						$taxamnt= $rent * $tax;
						//$month=$rent+$taxamnt;
						$month=$rent;
						$txt='Day';
					}elseif($selpro['p_category']!='3')
					{
						//$month=round($res['pp_price_3_month'], 2);
						$tax=($seltax['tax_percentage']/100);
						 $rent=round($sel_price['pp_price_12_month'], 2);
						$taxamnt= $rent * $tax;
						//$month=$rent+$taxamnt;
						$month=$rent;
						$txt='Month';
					}
	?>
      <div class="col-md-3 col-sm-3 col-lg-3">
        <div class="col-box">
          <div class="hovereffect"> <a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $selpro['p_slug']  ?>.html"><img src="<?php echo $prodimg;?>" class="img-responsive center-block wow flipInX"></a>
            <div class="overlay"> 
              <!-- <a href="#" class="prd-cart-button prd-button">Add To Cart</a> --> 
              <a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $selpro['p_slug']  ?>.html" class="rent-now-button prd-button">Rent Now</a> </div>
          </div>
          <a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $mcatslug; ?>/<?php echo $selpro['p_slug']  ?>.html">
          <p class="prd-name"><?php echo $selpro['p_name'] ?></p>
          </a>
          <?php if($selpro['p_category']!='3'){?>   <p class="prd-price">₹ <?php echo round($month, 2); ?><span> Rent/<?php echo $txt;?></span></p><?php }?>
          <?php /*?><?php
if ($sel_price ['pp_price_3_month'] != 0.0000) { ?>
   <p class="prd-price">₹.<?php echo round($sel_price ['pp_price_3_month'], 2); ?><span> Rent/Month</span></p>
<?php } else { ?>

 <p class="prd-price">₹.<?php echo round($sel_price ['ps_price_month'], 2); ?><span> Rent/Month</span></p>
  
<?php } ?><?php */?>
        </div>
      </div>
      <!--col-->
      <?php }?>
      <?php } ?>
      <?php if($selprod['nr']>$paging){?>
      <?php $pagepagination1 = str_replace("&laquo; prev", '<img src="<?php echo SITE_URL; ?>images/arrow-pre-small.png" alt="">',$selprod['page']);
	   $pagepagination = str_replace("next &raquo;", '<img src="<?php echo SITE_URL; ?>images/arrow-next-small.png" alt="">', $pagepagination1);
	   $pagepagination1 = str_replace("span", 'a', $pagepagination1);
	   echo  $pagepagination1;?>
      <?php }?>
      <?php }else{ ?>
      <div class="text-center txt-styl">
        <ul>
          <li> <i class="fa fa-warning"></i> &nbsp;No Record Found</li>
        </ul>
      </div>
      <?php }?>
      <!-- product list end --> 
      
    </div>
  </div>
</section>
<?php include "footer.php"; ?>
</body>
</html>
