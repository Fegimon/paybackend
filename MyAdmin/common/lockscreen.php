<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
if(isset($_SESSION['admin_id'])){$conn->divert(ADMIN_URL."common/home.php");}

if(!(isset($_SESSION['lock_id']))){$conn->divert(ADMIN_URL);}
$lockAlert=$_SESSION['alert']['login']['success'];

if(isset($btn_sub))
{
	if($_SESSION['lock_id']=='admin')
	{
		$checkadmin = $conn->select_query(ADMIN,"admin_id,admin_name,admin_pass","admin_pass='".$conn->encpyt($pwd)."' AND `type`='admin'","1");
		if($checkadmin['nr'])
		{
			$_SESSION['admin_id'] = $checkadmin['admin_id'];
			$_SESSION['admin_uname'] = $checkadmin['admin_name'];
			$_SESSION['type'] = "admin";
			unset($_SESSION['lock_id']);
			$conn->divert($RES_SURL['set_url'].ADMIN_PATH."/common/home.php");
		}else
		{
			$msg = "Invalid password.";
			$_SESSION['alert']['login']['error']=$msg; 
			unset($_SESSION['lock_id']);
			$conn->divert(ADMIN_URL);
			
		}
	}else
	{
		$checkadmin = $conn->select_query(OPERATOR,"op_id,op_name,op_uname,op_password","op_id='".$_SESSION['lock_id']."' AND op_password='".$conn->encpyt($pwd)."' AND op_status='Y'","1");
		
		if($checkadmin['nr'])
		{				
			  $_SESSION['admin_id'] = $checkadmin['op_id'];
			  $_SESSION['admin_name'] = $conn->stripval($checkadmin['op_name']);
			  $_SESSION['admin_uname'] = $checkadmin['op_uname'];
			  $_SESSION['type'] = "O";
			  unset($_SESSION['lock_id']);
			  $conn->divert($RES_SURL['set_url'].ADMIN_PATH."/common/home.php");
		}else
		{
			$msg = "Invalid password.";
			$_SESSION['alert']['login']['error']=$msg; 
			unset($_SESSION['lock_id']);
			$conn->divert(ADMIN_URL);
		}
	}
}
?>
<?php #Admin Html head
$conn->adminHtmlhead(); ?>
<body class="lockscreen">
<div class="lockscreen-wrapper">
  <?php if($lockAlert){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4> <i class="icon fa fa-check"></i> Alert!</h4>
    <?php echo $lockAlert; ?> </div>
  <?php }?>
  <div class="lockscreen-logo"> <a href="<?php echo ADMIN_URL; ?>"><b>Admin</b></a> </div>
  <!-- User name -->
  <div class="lockscreen-name text-yellow"><?php echo $_SESSION['lock_uname']; ?></div>
  
  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item"> 
    
 
    
    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" method="post" name="frm_login" id="frm_login">
      <div class="input-group">
        <input name="pwd" id="upass" type="password" class="form-control validate[required]" placeholder="Password" maxlength="50" />
        <div class="input-group-btn">
          <button class="btn" type="submit" name="btn_sub" id="btn_sub" value="submit"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials --> 
    
  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center text-gray"> Enter your password to retrieve your session </div>
  <div class='text-center'> <a class="text-yellow" href="<?php echo ADMIN_URL.'index.php' ?>">Or sign in as a different user</a> </div>
  <div class='lockscreen-footer text-center text-gray'> Copyright &copy; <?php echo date('Y'); ?> <b><a href="http://www.mirrorminds.in" target="_blank" class='text-aqua'>Mirrorminds</a></b><br>
    All rights reserved </div>
</div>
<?php include "footer-scripts.php"; ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#frm_login").validationEngine('attach',{promptPosition : "topLeft: -70"});
});	

jQuery('.formErrorContent').attr('background','#f00 none repeat scroll 0 0'); 
</script>

</body>
</html>
