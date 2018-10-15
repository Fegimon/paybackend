<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

if(isset($btn_sub))
{
	if($_SESSION['type']=="admin"){
		$checkOP = $conn->select_query(ADMIN,"admin_pass","admin_pass ='".$conn->encode($opwd)."' AND admin_id='1' AND type='admin'","1");	
		if($checkOP['nr']==1)
		{
			
			$upd = $conn->Execute("UPDATE ".ADMIN." SET admin_name= '".$conn->variable($admin_uname)."' ,admin_pass='".$conn->encode($pwd)."' WHERE admin_id='1' AND type='admin'");
			if($upd)
			{
				$succAlert = "Password successfully changed. Click ok you must relogin with the new password.";
				$_SESSION['alert']['login']['success']=$succAlert;
				$_SESSION['lock_id']="admin";
				$_SESSION['lock_uname']=$_SESSION['admin_uname'];

				unset($_SESSION['admin_id']);
				unset($_SESSION['admin_uname']);
				unset($_SESSION['type']);
				$conn->divert(ADMIN_URL.'common/lockscreen.php');
				
			}
		}else{
			$ErrAlert = "Wrong old password.";
		}
		
	}else if($_SESSION['type']=="O"){
		
		$checkoperator= $conn->select_query(OPERATOR,"op_password","op_password='".$conn->encode($opwd)."' AND op_status='Y'","1");
		if($checkoperator['nr']==1)
		{
			$updoperator = $conn->Execute("UPDATE ".OPERATOR." SET op_password='".$conn->encode($pwd)."' WHERE op_id='".$_SESSION['admin_id']."'");
			if($updoperator) {
				$succAlert = "Password successfully changed.Please relogin with the new password.";
				$_SESSION['alert']['login']['success']=$succAlert;
				$_SESSION['lock_id']=$_SESSION['admin_id'];
				$_SESSION['lock_uname']=$_SESSION['admin_uname'];
				unset($_SESSION['admin_id']);
				unset($_SESSION['admin_uname']);
				unset($_SESSION['type']);
				$conn->divert(ADMIN_URL.'common/lockscreen.php');
			}
		}else{
			$ErrAlert = "Wrong old password.";
		}
		
	}
}
$succAlert = "Password successfully changed. Click ok you must relogin with the new password.";
?>
<?php #Admin Html head
$conn->adminHtmlhead();
$conn->admninBody();
?>
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Change password
        <?php /*?><small>it all starts here</small><?php */?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change password</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="row">
        <div class="col-md-8 col-md-offset-1">
         <?php if($ErrAlert){?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $ErrAlert; ?> </div>
          <?php }?>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-navy">Change password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_pass" id="frm_pass" action="" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>Username <span class="text-red">*</span></label>
                  <input name="admin_uname" id="admin_uname" type="text" class="form-control validate[required,custom[username]]" placeholder="Username" maxlength="50" <?php if($_SESSION['type']=="O"){ echo 'readonly="readonly"'; }?> value="<?php echo $_SESSION['admin_uname']; ?>" />
                </div>
                <div class="form-group">
                  <label>Old Password <span class="text-red">*</span></label>
                  <input name="opwd" id="opwd"  type="password" class="form-control validate[required,minSize[5]]" placeholder="Old Password" maxlength="30" value=""  />
                </div>
                <div class="form-group">
                  <label>New Password <span class="text-red">*</span></label>
                  <input  name="pwd" id="pwd" type="password" class="form-control validate[required,minSize[5]]" placeholder="New Password " maxlength="30" value=""  />
                </div>
                <div class="form-group">
                  <label>Confirm Password <span class="text-red">*</span></label>
                  <input name="cpwd" id="cpwd" type="password" class="form-control validate[required,equals[pwd]]" placeholder="Confirm Password" maxlength="30" value=""  />
                </div>
                <div class="clearfix "></div>
                <div class="box-footer">
                  <center><button class="btn btn-primary" name="btn_sub" id="btn_sub" type="submit">Submit</button></center>
                </div>
              </form>
            </div>
            <!-- /.box-body --> 
            <!-- /.box --> 
          </div>
        </div>
      </div>
      <!-- /.box --> 
      
    </section>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  
  <?php include "../common/footer.php"; ?>
  <!-- /.content-wrapper --> 
</div>
<?php include "../common/footer-scripts.php"; ?>
<link href="<?php echo ADMIN_URL; ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ADMIN_URL; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_pass").validationEngine();
});

</script>
</body>
</html>