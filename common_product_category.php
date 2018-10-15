<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$catslug= $conn->variable($_REQUEST['cat_slug']);
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
 
$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");
$selcategorys = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$che_category = $conn->select_query(CATEGORY,"*","cat_slug='".$catslug."' AND cat_status = 'Y'", "1");


$categorys = $conn->select_query(CATEGORY,"*","cat_slug='".$catslug."' AND cat_status = 'Y'", "1");

$subcats = $conn->select_query(CATEGORY,"*","cat_p_id='".$categorys['cat_id']."' AND cat_status = 'Y' order by cat_pos", "");


/*echo "<pre>";
 print_r($subcats);
echo "</pre>";*/
//echo $$che_category; exit;
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

 if(isset($_COOKIE["current_location"])) {
    //echo $_COOKIE["current_location"];  exit;
    $feat_location = $conn->select_query(LOCATION,"*","lo_id='".$_COOKIE["current_location"]."' AND lo_status = 'Y'", '1');  
  }

 $feat_loc = $conn->Execute("SELECT * FROM tbl__product prod RIGHT JOIN tbl__product_price price ON prod.p_id = price.pp_product_id WHERE price.pp_location_id='".$feat_location['lo_id']."' AND price.pp_feature='Y' AND prod.p_status='Y' order by prod.p_position asc");
 
// print_r("SELECT * FROM tbl__product prod RIGHT JOIN tbl__product_price price ON prod.p_id = price.pp_product_id WHERE price.pp_location_id='".$feat_location['lo_id']."' AND price.pp_feature='Y' AND prod.p_status='Y' order by prod.p_id asc");
 
$featrow=mysql_num_rows($feat_loc);

//print_r($product_details); exit;



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <?php include "seo-cat.php";?>
     <?php  include "inner-header.php"; ?>
      <?php include "tracker.php"; ?> 
     <base href="<?php echo SITE_URL; ?>">
  </head>
  <body>
<?php include 'menu.php'; ?>
<section id="inner-header">
<div class="sub-page-category-inner">
  <div class="container-fluid">
  <div class="row">
  <div class="col-lg-9">
    <div class="pull-left">
      <ol class="breadcrumb">
        <li><a href="<?php echo SITE_URL;?>" style="color:#333;">Home</a></li>
        <li class="active"><?php echo $che_category['cat_title']; ?></li>
      </ol>
    </div>
    </div>
    <div class="col-lg-3">
      <div class="text-right" style="padding-top:10px;">
      <?php 
  if(isset($btn_search)&& $search_key!='')
{
	//print_r(SITE_URL.'search-listing/'.$current_location_name["lo_name"].'/'.$search_key.'.html');exit;
	echo '<script>
	document.getElementById(frm_search).reset();
	$("#frm_search").reset();
	</script>';
	$conn->divert(SITE_URL.'search-listing/'.strtolower($current_location_name["lo_name"]).'/'.$catslug.'/'.$search_key);
	
}

?>
        <div class="input-group">
        <form name="frm_search" id="frm_search" method="post" >
      <input type="text" class="form-control form-control-search" placeholder="Search for..." name="search_key" id="search_key" required>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" name="btn_search" id="btn_search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
      </span>
    </div>
      </div>
    </div>
    </div>
  </div>
  </div>
</section>


<!--<section class="new_paddin">action="<?php echo SITE_URL; ?>/searchlist/<?php echo $current_location_name["lo_name"]; ?>"
   <div class="container-fluid">
      <div class="row">
          <ul>
            <li>Home &nbsp;</li>
             <span>/</span>
            <li>&nbsp;Rent For Home</li>
          </ul>
      </div>
   </div>
</section>-->
<div class="clear-fix"></div>  
  <!-- ================================================================ -->
<section id="product-listing">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	  
      <h3>Categories
       <?php if($subcats['nr']){?>
         <div class="product-arrow pull-right"><a class="btn prevone"><i class="fa fa-chevron-left"></i></a> <a class="btn nextone"><i class="fa fa-chevron-right"></i></a> </div>
          <?php } ?>
        </h3>
        <?php if($subcats['nr']){?>
        <div id="owl-demo2" class="owl-carousel" style="margin-top:0px;">
        
       <!-- category show start-->
       
       
         <?php foreach($subcats['result'] as $rescat) {
			 
			 $exist = $conn->image_exist($rescat['cat_img'],"uploads/category/");
     $catimg= ($exist) ? "category/image/".$rescat['cat_img'] : "images/product-1.png";   
			  ?>
          <div class="item-text">
            <div class="item2">
              <div class="content"> 
               <a href="<?php echo SITE_URL; ?>productlist/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $catslug; ?>/<?php echo $rescat['cat_slug']  ?>.html">
                <div class="content-overlay"></div>
                 <img class="content-image" src="<?php echo $catimg;?>" class="img-responsive">
                <div class="content-details fadeIn-bottom">
                  <h3 class="content-title"><?php echo $rescat['cat_title']?></h3>
               <?php /*?>   <p>Starting from <i class="fa fa-rupee"></i>529</p><?php */?>
                </div></a>
                
                 </div>
            </div>
          </div>

          <!-- category show  end-->
          <?php } ?>
         
        </div>
       <?php }else{?>
       <div class="text-center txt-styl">
              <ul>
                <li> <i class="fa fa-warning"></i> &nbsp;No Record Found</li>
              </ul>
            </div>
            <?php }?>
      </div>
    </div>
  </div>
   
  <div class="featured-product-section wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
  <div class="container-fluid">
    <div class="row">
      <div class="featured-product-section-in">
        <h3>Featured products
         <?php if($featrow>0){?><div class="product-arrow pull-right"><a class="btn prev"><i class="fa fa-chevron-left"></i></a> <a class="btn next"><i class="fa fa-chevron-right"></i></a> </div>  <?php }?>
        </h3>
        
        <div class="products-in">
          <div id="demo">
          <?php if($featrow>0){?>
            <div id="owl-demo" class="owl-carousel">
             <?php 
				while($res=mysql_fetch_array($feat_loc))
				{
					$seltax = $conn->select_query(TAX,"*","tax_id='".$res["pp_taxes"]."'", '1');  
					if($res['p_category']=='3')
					{
						 $tax=($seltax['tax_percentage']/100);
						 $rent=round($res['ps_price_month'], 2);
						$taxamnt= $rent * $tax;
						//$month=$rent+$taxamnt;
						$month=$rent;
					}elseif($res['p_category']!='3')
					{
						//$month=round($res['pp_price_3_month'], 2);
						$tax=($seltax['tax_percentage']/100);
						 $rent=round($res['pp_price_12_month'], 2);
						$taxamnt= $rent * $tax;
						//$month=$rent+$taxamnt;
						$month=$rent;
					}
					
					$exist = $conn->image_exist($res['p_image'],"uploads/product/");
     $prodimg= ($exist) ? "product/image/".$res['p_image'] : "images/product-1.png";   
				?>
              <div class="item-text">
                <div class="item">
                  <div class="hovereffect"> <a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $catslug; ?>/<?php echo $res['p_slug']  ?>.html"><img src="<?php echo $prodimg; ?>" alt="Product-1"></a>
                    <div class="overlay">  <a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $catslug; ?>/<?php echo $res['p_slug']  ?>.html" class="rent-now-button prd-button">Rent Now</a> </div>
                  </div>
                </div>
                <h5><a href="<?php echo SITE_URL; ?>product-detail/<?php echo strtolower($current_location_name["lo_name"]); ?>/<?php echo $catslug; ?>/<?php echo $res['p_slug']  ?>.html" class="prd-button"><?php echo $res['p_name'] ?></a></h5>
                <?php if($res['p_category']!='3'){?>  <p>₹ <?php echo $month; ?></p><?php }?>
              </div>
              <?php }?>
            </div>
            <?php }else{?>
            <div class="text-center txt-styl">
              <ul>
                <li> <i class="fa fa-warning"></i> &nbsp;No Record Found</li>
              </ul>
            </div>
            <?php }?>
          </div>
        </div>
        
        
      </div>
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
          <p class="prd-price">Rs.<?php echo round($product_detail['ps_price_month'], 2); ?><span> Rent/Month</span></p>
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
<?php include "footer.php"; ?>
 </body>
</html>

