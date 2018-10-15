<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$businesssolutions = $conn->select_query(BUSINESSSOLUTION,"*","tl_status = 'Y'","",1);

?>

<!DOCTYPE html>
<html lang="en">
 <head>
<meta charset="utf-8">
<?php include "seo-mainmenu.php";?>
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
    <h1 class="banner-title">Business Solutions</h1>
    </div>
</section>

<section id="breadcum">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">Business Solutions</li>
        </ol>
    </div>
    </div>
</section>
<section id="faq">
	<div class="container">
        <?php foreach ($businesssolutions['result'] as $businesssolution) {?>
        <div class="faq">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
       	 <p><?php echo $businesssolution['tl_content'] ?></p>
        </div>
        </div>
        <?php }?>
    </div>
</section>


<section id="faq">
<div class="container">
        
  </div>
</section>

<?php include "footer.php"; ?>
  </body>
</html>