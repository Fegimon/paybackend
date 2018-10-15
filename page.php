<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$slug=$_REQUEST['slug'];
$cms = $conn->select_query(TOPMENU,"*","tl_slug='".$slug."'","1");


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php include "seo-page.php";?>
<?php include "header.php"; ?>
<base href="<?php echo SITE_URL; ?>">
<?php include "tracker.php"; ?>
</head>
<body>
<div class="main">
<section id="">
   <?php include 'menu.php';?>
</section>

<section id="inner-banner">
<img src="images/new-banner.png" class="img-responsive" alt=""/>
    <div class="container">
    <h1 class="banner-title">  <?php echo  $cms['tl_name']; ?> </h1>
    </div>
</section>

<section id="breadcum">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active"> <?php echo  $cms['tl_name']; ?> </li>
        </ol>
        
    </div>
    </div>
</section>


<section id="faq">
<div class="container">
	<div class="">
        <div class="faq">
            <div class="col-md-offset-1 col-md-10 col-xs-12">
                    <?php echo  $cms['tl_content']; ?>
                    
            </div>
        </div>
  </div>
</div>
</section>
</div>
<?php include "footer.php"; ?>

  </body>
</html>