<?php
require_once(dirname(__FILE__).'/../appcore/app-register.php');
if(isset($_SESSION['admin_id'])){$conn->divert(ADMIN_URL."common/home.php");}

unset($_SESSION['lock_id']);
if(isset($log_submit))
{
	$uname=$conn->variable($_POST['uname']);
	if($type=='O')
	{
		$checkadmin = $conn->select_query(OPERATOR,"op_id,op_name,op_uname,op_password","op_uname='".$uname."' AND op_password='".$conn->encode($pwd)."'  AND op_status='Y'","1");
		
		if($checkadmin['nr'])
		{				
			  $_SESSION['admin_id'] = $checkadmin['op_id'];
			  $_SESSION['admin_name'] = $conn->stripval($checkadmin['op_name']);
			  $_SESSION['admin_uname'] = $checkadmin['op_uname'];
			  $_SESSION['type'] = "O";
			  $conn->divert($RES_SURL['set_url'].ADMIN_PATH."/common/home.php");
		}else
		{
			$msg = "Invalid username or password.";
		}
		
	}else
	{
		$checkadmin = $conn->select_query(ADMIN,"admin_id,admin_name,admin_pass","admin_name='".$uname."' AND admin_pass='".$conn->encode($pwd)."' AND `type`='admin'","1");
		if($checkadmin['nr'])
		{
			$_SESSION['admin_id'] = $checkadmin['admin_id'];
			$_SESSION['admin_uname'] = $checkadmin['admin_name'];
			$_SESSION['type'] = "admin";
			
			$conn->divert($RES_SURL['set_url'].ADMIN_PATH."/common/home.php");
		}else
		{
			$msg = "Invalid username or password.";
			
		}
	}
}
if($_SESSION['alert']['login']['error'])
{
	$msg=$_SESSION['alert']['login']['error'];
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<?php include "layout/title.php"; ?>
</head>
<body class="login-page">
<div class="login-box">
<?php if($RES_SURL['setting_logo']!='')
{
	$logoexist = $conn->image_exist($RES_SURL['setting_logo'],"../uploads/common/");
}
$logoimg = ($logoexist) ? SITE_URL."uploads/common/".$RES_SURL['setting_logo'] : ADMIN_URL."img/logo.png";
?>
  <div class="login-logo"><img alt="<?php echo SITE_NAME; ?>" title="<?php echo SITE_NAME; ?>" src="<?php echo SITE_URL; ?>timthumb.php?src=<?php echo $logoimg;?>&h=100&zc=0&q=95" > <?php /*?><a><b>Admin</b></a><?php */?> </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <?php if($msg!=''){?>
  <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $msg; ?> </div><?php }?>
    <p class="login-box-msg">Sign in to start your session</p>
    <form name="frm_login" id="frm_login" action="" method="post">
    <?php if($RES_SURL['setting_operator']=="Y"){?>
      <div class="form-group has-feedback">
        <p >Type :
          <label>
            <input type="radio" checked="checked" name="type" id="type" value="A" class="validate[required]" />
            &nbsp;&nbsp;Admin</label>
          &nbsp;&nbsp;&nbsp;
          <label>
            <input type="radio"  name="type" id="type" value="O" class="validate[required]" />
            &nbsp;&nbsp;Operator</label>
        </p>
      </div>
      <?php }?>
      <div class="form-group has-feedback">
        <input  name="uname" type="text" id="uname" class="form-control validate[required]" placeholder="Login ID" required maxlength="150" />
        <span class="glyphicon  glyphicon-user form-control-feedback"></span> </div>
      <div class="form-group has-feedback">
        <input name="pwd" type="password" id="pwd"  class="form-control validate[required]" placeholder="Password" required  maxlength="150" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
      <div class="row">
        <div class="col-xs-8">
          <?php /*?><div class="checkbox icheck">
            <label>
              <input type="checkbox">
              Remember Me </label>
          </div><?php */?>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="log_submit" id="log_submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
    <?php /*?> <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a> <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a> </div>
    <!-- /.social-auth-links -->
    
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>  <?php */?>
  </div>
  <!-- /.login-box-body --> 
</div>

<!-- /.login-box -->
<?php include "common/footer-scripts.php"; ?>
<!-- iCheck --> 
<script src="<?php echo ADMIN_URL; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script> 
<script type="text/javascript">
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
		
      });
jQuery(document).ready(function(){
	jQuery("#frm_login").validationEngine('attach',{promptPosition : "topLeft"});
});	  
</script>
</body>
</html>