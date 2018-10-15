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
<title>403 - Forbidden Error</title>
<?php include "style.php"; ?>
</head>
<body style="background:#FFFFFF">
<div class="main">
  <div class="container page-text">
    <div class="row"> <div class="col-sm-12" style="margin-top:10%">
      <center><a href="<?php echo SITE_URL ?>" target="_blank" title="<?php echo SITE_NAME; ?>"><img src="<?php echo SITE_URL ?>images/logo.png" class="img-responsive" ></a></center>
      
      <div style="margin-top:100px;">
      <center><h2 style="color:#C00">403 - Access Forbidden</h2>
      <p  style="margin-top:50px; font-size:16px">Sorry, you were denied access to the requested URL. This virtual directory does not allow contents to be listed. </p></center>
      </div>
    </div>
     
  </div>
</div>
</div>
</body>
</html>