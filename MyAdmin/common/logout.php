<?php require(dirname(__FILE__).'/../../appcore/app-register.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITE_NAME;?></title>
</head>
<body>
</body>
</html>
<?php 
unset($_SESSION['lock_id']);
unset($_SESSION['admin_id']);
unset( $_SESSION['admin_name']);
unset($_SESSION['admin_uname']);
unset($_SESSION['type']);
session_destroy();
$conn->divert(ADMIN_URL);?>