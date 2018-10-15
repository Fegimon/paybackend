<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$businesssolution = $conn->select_query('tbl__topmenu',"*","tl_id='5'","1");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php include "seo-mainmenu.php";?>
     <?php  include "inner-header.php"; ?>
  </head>
  <body>
    <?php include 'menu.php';?>

<section id="inner-banner">
<img src="<?php echo SITE_URL ?>images/new-banner.png" class="img-responsive" alt=""/>
    <div class="container">
    <h1 class="banner-title"> Clearance Website </h1>
    </div>
</section>

<section id="breadcum">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">Clearance Website</li>
        </ol>
        
    </div>
    </div>
</section>


<section id="faq">
<div class="container">
	<div class="">
        <div class="faq">
            <div class="col-md-offset-1 col-md-10 col-xs-12">
            <!--<h2>UzedPro</h2>-->
                  <?php echo $businesssolution['tl_content'] ?>
                    
            </div>
        </div>
  </div>
</div>
</section>

<?php include "footer.php"; ?>

  </body>
</html>