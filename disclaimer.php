<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$terms_cont = $conn->select_query(TLINK,"*","tl_id='1'","1");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <?php  include "inner-header.php"; ?>
      <?php include "seo-footmenu.php";?>
  </head>
  <body>
    <?php include 'menu.php';?>
<section id="inner-banner">
<img src="images/new-banner.png" class="img-responsive" alt=""/>
    <div class="container">
    <h1 class="banner-title">Disclaimer</h1>
    </div>
</section>

<section id="breadcum">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">Disclaimer</li>
        </ol>
        
    </div>
    </div>
</section>


<section id="faq">
<div class="container">
	<div class="row">
        <div class="faq">
          <div class="col-md-offset-1 col-md-10 col-xs-12">
                    <?php echo  $terms_cont['tl_content']; ?>
                    
            </div>
     
        </div>
  </div>
</div>
</section>
 
<?php include "footer.php"; ?>
 </body>
</html>