<?php
require(dirname(__FILE__).'/appcore/app-register.php');

$sellocation = $conn->select_query(LOCATION,"*","lo_status = 'Y'");

$selcategory = $conn->select_query(CATEGORY,"*","cat_status = 'Y'");

$work = $conn->select_query(TLINK,"*","tl_id='8'","1");

$del = $conn->select_query(TLINK,"*","tl_id='9'","1");

$rent = $conn->select_query(TLINK,"*","tl_id='10'","1");

$refund = $conn->select_query(TLINK,"*","tl_id='11'","1");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <?php  include "inner-header.php"; ?>
  </head>
  <body>
    <?php include 'menu.php';?>
<section id="inner-banner">
<img src="images/new-banner.png" class="img-responsive" alt=""/>
    <div class="container">
    <h1 class="banner-title"> Frequently Asked Questions</h1>
    </div>
</section>

<section id="breadcum">
<div class="container-fluid">
    <div class="pull-left">
        <ol class="breadcrumb">
          <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
          <li class="active">FAQ</li>
        </ol>
        
    </div>
    </div>
</section>


<section id="faq">
<div class="container">
	<div class="row">
        <div class="faq">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#work" class="list-group-item active text-center">
                  <h4>How it Works</h4>
                </a>
                <a href="#del" class="list-group-item text-center">
                  <h4>Delivery & Installation</h4>
                </a>
                <a href="#rent" class="list-group-item text-center">
                  <h4>Rental Process & Tenure </h4>
                </a>
                <a href="#refund" class="list-group-item text-center">
                  <h4>Refunds & Returns</h4>
                </a>
               
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div id="work" class="bhoechie-tab-content active">
                   <?php echo  $work['tl_content']; ?>
                    
                </div>
                <!-- train section -->
                <div id="del" class="bhoechie-tab-content">
                    <?php echo  $del['tl_content']; ?>
                    
                </div>
    
                <!-- hotel search -->
                <div id="rent" class="bhoechie-tab-content">
                    <?php echo  $rent['tl_content']; ?>
                    
                </div>
                <div id="refund" class="bhoechie-tab-content">
                   <?php echo  $refund['tl_content']; ?>
                    
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