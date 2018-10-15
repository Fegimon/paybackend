<?php 
ini_set("allow_url_fopen", 1);
require(dirname(__FILE__).'/appcore/app-register.php');

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y' order by cat_pos asc");

$selbrand = $conn->select_query(BRAND,"*","brand_status = 'Y' order by brand_pos asc");

$about_us = $conn->select_query(TLINK,"*","tl_id='5'","1");

$sel = $conn->select_query(ADMIN,"*","admin_id='1'","1");

$comment = $conn->select_query(COMMENT,"*","lt_status = 'Y'");



if($sel['setting_fields']!='')
{
  $why = @unserialize($sel['setting_fields']);
  array_walk($why,'decode_ArrayWalk');
}

$home_category=explode(',', $why['home_category']);

foreach ($home_category as $key => $value) {
  $homecats[] = $conn->select_query(CATEGORY,"*","cat_status = 'Y' AND cat_id = '". $value ."' order by cat_pos asc","1");
}

$categorys = $conn->select_query(CATEGORY,"*","cat_status = 'Y'  order by cat_pos asc","1");

$cart_total= $shopcart->getTotalAmount();

  if(isset($_COOKIE["current_location"])) {
    //echo $_COOKIE["current_location"];  exit;
    $feat_loc = $conn->select_query(LOCATION,"*","lo_id='".$_COOKIE["current_location"]."' AND lo_status = 'Y'", '1');  
  }


 $feat_loc = $conn->Execute("SELECT * FROM tbl__product prod RIGHT JOIN tbl__product_price price ON prod.p_id = price.pp_product_id WHERE price.pp_location_id='".$feat_loc['lo_id']."' AND price.pp_feature='Y' AND prod.p_status='Y' order by prod.p_id asc");
 
 
//$featrow=mysql_num_rows($feat_loc);
// print_r("SELECT * FROM tbl__product prod RIGHT JOIN tbl__product_price price ON prod.p_id = price.pp_product_id WHERE price.pp_location_id='".$feat_loc['lo_id']."' AND price.pp_feature='Y' AND prod.p_status='Y' order by prod.p_id asc");

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
<!-- ================================================ -->
<div class="container-fluid">
  <div class="row">
    <div class="top-space"></div>
    <?php if($categorys['nr']){
     ?>
    <ul class="home-img-section-in">
      <li> 
        <!-- <a href="common_product_category.php"> --> 
        <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-home'  ?>.html">
        <div class='wrapper action_hover wow fadeInDown' data-wow-duration="2s" style="visibility: visible; animation-name: fadeInDown;"> 
          
          <!-- image -->
          <div class="mg-image"> <img src='<?php echo SITE_URL; ?>images/rent-1.jpg' class="img-responsive"; /> </div>
          <!-- description div -->
          <div class='description wrapper-default'> 
            <!-- description content -->
            
            <h3> Rent For Home</h3>
            <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-home'  ?>.html" class="a-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Explore now</a> 
            <!-- end description content --> 
          </div>
          <!-- end description div --> 
          
        </div>
        </a> </li>
      <li> <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-office'  ?>.html">
        <div class='wrapper wow fadeInDown' data-wow-duration="2s" style="visibility: visible; animation-name: fadeInDown;"> 
          <!-- image -->
          <div class="mg-image mg-image-1" > <img src='<?php echo SITE_URL; ?>images/office-1.jpg' class="img-responsive"; /> </div>
          <!-- description div -->
          <div class='description wrapper-default'>
            <h3>Rent for Office</h3>
            <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-office'  ?>.html" class="a-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Explore now</a> </div>
          <!-- end description div --> 
          
        </div>
        </a> </li>
      <li> <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-events'  ?>.html">
        <div class='wrapper wow fadeInDown' data-wow-duration="2s" style="visibility: visible; animation-name:fadeInDown;"> 
          <!-- image -->
          <div class="mg-image mg-image-1"> <img src='<?php echo SITE_URL; ?>images/event-1.jpg' class="img-responsive"; /> </div>
          <!-- description div -->
          <div class='description wrapper-default'>
            <h3>Event Rentals</h3>
            <a href="rent-for-office.html" class="a-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Explore now</a> </div>
          <!-- end description div --> 
          
        </div>
        </a> </li>
      <div class="clear-fix"></div>
      <div class="home-image-two">
        <li> <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-office'  ?>.html">
          <div class='wrapper wow fadeInUp' data-wow-duration="2s" style="visibility: visible; animation-name: fadeInUp;"> 
            <!-- image -->
            <div class="mg-image"> <img src='<?php echo SITE_URL; ?>images/service-1.jpg' class="img-responsive"; /> </div>
            <!-- description div -->
            <div class='description wrapper-default '> 
              <!-- description content -->
              <h3>Service / Repairs</h3>
              <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-office'  ?>.html" class="a-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Raise request</a> 
              <!-- end description content --> 
            </div>
            <!-- end description div --> 
            
          </div>
          </a> </li>
        <li> <a href="<?php echo SITE_URL; ?>category/<?php echo 'rent-for-office'  ?>.html">
          <div class='wrapper wow fadeInUp' data-wow-duration="2s" style="visibility: visible; animation-name: fadeInUp;"> 
            <!-- image -->
            <div class="mg-image mg-image-2"> <img src='<?php echo SITE_URL; ?>images/solution-1.jpg' class="img-responsive"; /> </div>
            <!-- description div -->
            <div class='description wrapper-default'>
              <h3>Solutions ( Business )</h3>
              <a href="<?php echo SITE_URL; ?>rent-for-office.html" class="a-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Learn More</a> </div>
            <!-- end description div --> 
            
          </div>
          </a> </li>
        <li> <a href="<?php echo SITE_URL; ?>rent-for-office.html">
          <div class='wrapper wow fadeInUp' data-wow-duration="2s" style="visibility: visible; animation-name: fadeInUp;"> 
            <!-- image -->
            <div class="mg-image mg-image-2"> <img src='<?php echo SITE_URL; ?>images/buy-1.jpg' class="img-responsive"; /> </div>
            <!-- description div -->
            <div class='description wrapper-default'>
              <h3>Buy</h3>
              <a href="<?php echo SITE_URL; ?>rent-for-office.html" class="a-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Shop Online</a> </div>
            <!-- end description div --> 
            
          </div>
          </a> </li>
      </div>
    </ul>
    <?php } ?>
  </div>
</div>
<!-- ================================================ -->
<div class="about-bg" style="visibility: visible; animation-name: fadeInUp;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="about-left">
          <div class="wow fadeInLeft" data-wow-duration="2s" style="visibility: visible; animation-name:fadeInLeft;">
            <h2>PayRentz - The Rental People</h2>
            <p>PayRentz specializes in providing rental solutions to clients by offering a wide range of Appliances, Home Entertainment, Furniture and Fitness Products apart from other customized requirements. Whatever may be your rental needs, PayRentz has it covered with a solution tailored for you. Our objective is to make life easy for clients by offering customized rental solutions which includes speedy delivery, free transportation, free standard installation, flexible payment options and prompt service delivery.<br />
              <br />
              PayRentz is founded and run by a team of professionals who quit lucrative corporate careers after working with top financial institutions and software companies for more than a decade. PayRentz aims to become the leading and preferred rental solutions provider in the country. Each member of the founding team has taken individual responsibility of Sales, Credit, Operations and Service to ensure that all the said functions are given its due attention to achieve remarkable client experience. </p>
          </div>
          <div class="text-right wow fadeInUp" data-wow-duration="2s" style="visibility: visible; animation-name:fadeInUp;"> <a href="<?php echo SITE_URL; ?>about_us.html" class="btn btn-primary readmore-btn hvr-grow">Read More</a> </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="about-right">
          <div class="center-block"> <img src="<?php echo SITE_URL; ?>images/about-img.png" class="img-responsive hvr-bob-opp" /> </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ===================================== -->
<div class="featured-product-section wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
  <div class="container-fluid">
    <div class="row">
      <div class="featured-product-section-in">
        <h3>Featured Products
          <div class="product-arrow pull-right"><a class="btn prev"><i class="fa fa-chevron-left"></i></a> <a class="btn next"><i class="fa fa-chevron-right"></i></a> </div>
        </h3>
        <div class="products-in">
          <div id="demo">
            <div class="text-center txt-styl">
              <ul>
                <li> <i class="fa fa-warning"></i> &nbsp;No Record Found</li>
              </ul>
            </div>
            <div id="owl-demo" class="owl-carousel">
              <?php if($featrow>0){
				while($res=mysql_fetch_array($feat_loc))
				{
					
					  $seltax = $conn->select_query(TAX,"*","tax_id='".$res["pp_taxes"]."'", '1');  
					if($res['p_category']=='3')
					{
						 $tax=($seltax['tax_percentage']/100);
						 $rent=round($res['ps_price_month'], 2);
						$taxamnt= $rent * $tax;
						$month=$rent+$taxamnt;
						$txt='Day';
					}elseif($res['p_category']!='3')
					{
						//$month=round($res['pp_price_3_month'], 2);
						$tax=($seltax['tax_percentage']/100);
						 $rent=round($res['pp_price_3_month'], 2);
						$taxamnt= $rent * $tax;
						$month=$rent+$taxamnt;
						$txt='Month';
					}
					
					/*if($res['p_category']=='3')
					{
						$month=round($res['ps_price_month'], 2);
					}elseif($res['p_category']!='3')
					{
						$month=round($res['pp_price_3_month'], 2);
					}*/
					
					$exist = $conn->image_exist($res['p_image'],"uploads/product/");
     $prodimg= ($exist) ? "product/image/".$res['p_image'] : "images/product-1.png";   
				?>
              <div class="item-text">
                <div class="item">
                  <div class="hovereffect"> <img src="<?php echo $prodimg; ?>" alt="Product-1">
                    <div class="overlay"> <a href="<?php echo SITE_URL; ?>product-detail/<?php echo $res['p_slug']  ?>.html" class="rent-now-button prd-button">Rent Now</a> </div>
                  </div>
                </div>
                <h5><?php echo $res['p_name'] ?></h5>
                <p>₹ <?php echo 'Rs '.$month; ?></p>
              </div>
              <?php }}?>
              <?php /*?><!-- <div class="item-text">
                <div class="item">
                  <div class="hovereffect"> <img src="images/product-2.png" alt="Product-1">
                    <div class="overlay">  <a href="#" class="prd-cart-button prd-button">Add To Cart</a> --> <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                  </div>
                </div>
                <h5>Led TV</h5>
                <p>₹ 15,000</p>
              </div>
              <div class="item-text">
                <div class="item">
                  <div class="hovereffect"> <img src="images/product-3.png" alt="Product-1">
                    <div class="overlay"> <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                  </div>
                </div>
                <h5>Gym</h5>
                <p>₹ 15,000</p>
              </div>
              <div class="item-text">
                <div class="item">
                  <div class="hovereffect"> <img src="images/product-4.png" alt="Product-1">
                    <div class="overlay">  <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                  </div>
                </div>
                <h5>Furniture</h5>
                <p>₹ 15,000</p>
              </div>
              <div class="item-text">
                <div class="item">
                  <div class="hovereffect"> <img src="images/product-1.png" alt="Product-1">
                    <div class="overlay">  <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                  </div>
                </div>
                <h5>Washing Machine</h5>
                <p>₹ 15,000</p>
              </div>
              <div class="item-text">
                <div class="item">
                  <div class="hovereffect"><img src="images/product-2.png" alt="Product-1">
                    <div class="overlay">  <a href="product-detail.php" class="rent-now-button prd-button">Rent Now</a> </div>
                  </div>
                </div>
                <h5>Led</h5>
                <p>₹ 15,000</p>
              </div><?php */?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section id="banner-strip">
  <p class="sec-title">Why PayRentz</p>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-3 col-lg-3 col-sm-3"> <img src="<?php echo SITE_URL; ?>images/wallet.png" class="img-responsive center-block  wow fadeInUp">
        <p class="icon-title">Helps Your Wallet</p>
        <p class="icon-desc"><?php echo $conn->stripval($why['wallet']); ?></p>
      </div>
      <!--col-->
      <div class="col-xs-12 col-md-3 col-lg-3 col-sm-3"> <img src="<?php echo SITE_URL; ?>images/rent.png" class="img-responsive center-block wow fadeInUp">
        <p class="icon-title">Rent To Own</p>
        <p class="icon-desc"><?php echo $conn->stripval($why['rent']);?></p>
      </div>
      <!--col-->
      <div class="col-xs-12 col-md-3 col-lg-3 col-sm-3"> <img src="<?php echo SITE_URL; ?>images/time.png" class="img-responsive center-block wow fadeInUp">
        <p class="icon-title">Saves Time</p>
        <p class="icon-desc"><?php echo $conn->stripval($why['time']);?></p>
      </div>
      <!--col-->
      <div class="col-xs-12 col-md-3 col-lg-3 col-sm-3"> <img src="<?php echo SITE_URL; ?>images/service.png" class="img-responsive center-block wow fadeInUp">
        <p class="icon-title">Service and Maintenance</p>
        <p class="icon-desc"><?php echo $conn->stripval($why['service']);?></p>
      </div>
      <!--col--> 
    </div>
    <!--row--> 
  </div>
  <!--fluid--> 
  
</section>
<section id="testimonial">
  <p class="sec-title">See What Customers Says</p>
  <img src="<?php echo SITE_URL; ?>images/testi-bg.png" class="img-responsive pull-left testimonial-bg hidden-xs hidden-sm wow fadeInLeft ">
  <div class="container-fluid">
    <div class="col-md-offset-6 col-md-6">
      <div class="testimonial-slider">
        <?php foreach($comment['result'] as $res) { 

  if(!empty($res['lt_profile'])){
      if (file_exists('uploads/comment/'.$res['lt_profile'])) { 
        $cmt_image='comment/image/'.$res['lt_profile'];        
      }else{ 
        $cmt_image='uploads/noimage.png';
      }                 
    }else{
      $cmt_image='uploads/noimage.png';
    }

?>
        <div id="slide">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-12"> <div class="text-center"><img src="<?php echo $cmt_image; ?>" class="img-responsive"> </div></div>
                <div class="col-md-10 col-sm-10">
                  <p class="quotes"><i class="fa fa-quote-left" aria-hidden="true"></i></p>
                  <p class="customer-text"><?php echo $res['lt_desc']; ?></p>
                  <p class="customer-name"><?php echo $res['lt_name']; ?></p>
                  <p>( <?php echo $res['lt_designation']; ?> )</p>
                </div>
              </div>
              <!--row--> 
            </div>
            <!--row2--> 
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<?php include "footer.php"; ?>
<!--<section class="blog-section">
  <div class="container-fluid">
    <div class="row">
      <h3>News From Our Blog</h3>
    </div>
  </div>
</section>
<?php
// Define recursive function to extract nested values
function printValues($arr) {
  global $count;
  global $values;
  
  // Check input is an array
  if(!is_array($arr)){
      die("ERROR: Input is not an array");
  }
  
  /*
  Loop through array, if value is itself an array recursively call the
  function else add the value found to the output items array,
  and increment counter by 1 for each value found
  */
  foreach($arr as $key=>$value){
      if(is_array($value)){
          printValues($value);
      } else{
          $values[] = $value;
          $count++;
      }
  }
  
  // Return total count and values found in array
  return array('total' => $count, 'values' => $values);
}

// Assign JSON encoded string to a PHP variable

$json = file_get_contents('http://192.168.1.30/payrentz-dev/blog/wp-json/wp/v2/posts?_embed');


// Decode JSON data into PHP associative array format
$arr = json_decode($json, true);

// Call the function and print all the values
$result = printValues($arr);

// echo "<pre>";
// echo "<h3>" . $result["total"] . " value(s) found: </h3>";
 //echo implode("<br>", $result["values"]);

// echo "</pre>";
?>

<section class="services-section">
  <div class="brands wow fadeInUp">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-sm-12 col-xs-12">
          <div class="left">
            <div class="brand-img ">
<?php 
for($i = 0; $i<count($arr);$i++ ){
?>
              <div> <a href="<?php echo $arr[$i]["link"] ?>" target="_blank">
                <article class="caption"> <img src="<?php echo $arr[$i]["_embedded"]["wp:featuredmedia"][0]["source_url"] ?>" class="caption__media">
                  <div class="caption__overlay">
                    <h5 class="caption__overlay__title"> <?php echo $arr[$i]["title"]["rendered"]; ?></h5>
                    <p><?php echo $arr[$i]["excerpt"]["rendered"]; ?></p>
                  </div>
                </article>
                </a> </div>

                <?php 
                }
                ?>
               <div> <a href="#">
                <article class="caption"> <img src="<?php echo SITE_URL; ?>images/images13.png" class="caption__media">
                  <div class="caption__overlay">
                    <h5 class="caption__overlay__title"> Quisque ultricies erat in molestie tristique</h5>
                    <p>PayRentz specializes in providing rental solutions to clients by offering a wide range of Appliances,</p>
                  </div>
                </article>
                </a> </div>
              <div> <a href="#">
                <article class="caption"> <img src="<?php echo SITE_URL; ?>images/images12.png" class="caption__media">
                  <div class="caption__overlay">
                    <h5 class="caption__overlay__title"> Quisque ultricies erat in molestie tristique</h5>
                    <p>PayRentz specializes in providing rental solutions to clients by offering a wide range of Appliances,</p>
                  </div>
                </article>
                </a> </div>
              <div> <a href="#">
                <article class="caption"> <img src="<?php echo SITE_URL; ?>images/images14.png" class="caption__media">
                  <div class="caption__overlay">
                    <h5 class="caption__overlay__title"> Quisque ultricies erat in molestie tristique</h5>
                    <p>PayRentz specializes in providing rental solutions to clients by offering a wide range of Appliances,</p>
                  </div>
                </article>
                </a> </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>-->

<script>
$('#myModal').on('scroll', function() {
    var threshold = 60;

    if ($('#myModal').scrollTop() > threshold) {
        $('.fixed-header').addClass('affixed');
    }
    else {
        $('.fixed-header').removeClass('affixed');
    }
});

$('#myModal').on('hide.bs.modal', function (e) {
    $('.fixed-header').removeClass('affixed');
});

$('.fixed-header button').click(function() {
    $('#myModal').modal('hide');
});
</script>

</body>
</html>
