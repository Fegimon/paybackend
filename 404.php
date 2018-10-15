<?php
require(dirname(__FILE__).'/appcore/app-register.php');
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META http-equiv="refresh" content="3;URL=<?php echo SITE_URL; ?>">
<title>404 - Page Not Found</title>
<?php include "style.php"; ?>
</head>
<body style="background:#FFFFFF">
<div class="main">
  <div class="container page-text">
    <div class="row"> <div class="col-sm-12" style="margin-top:10%">
      <center><a href="<?php echo SITE_URL ?>" target="_blank"  title="<?php echo SITE_NAME; ?>" ><img src="<?php echo SITE_URL ?>images/logo.png" class="img-responsive"></a></center>
      
      <div style="margin-top:100px;">
      <center><h2 style="color:#C00">404 Page Not Found</h2>
      <p  style="margin-top:50px; font-size:16px">Sorry, but the page you are looking for has not been found. Try checking the URL for error, then hit the refresh button on your browser </p></center>
      </div>
    </div>
     
  </div>
</div>
</div>
</body>
</html>