<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

if(isset($btn_sub))
{
	if($op_uname!=''&&$op_name!=''&&$password!='')
	{
		$User = $conn->select_query(OPERATOR,"op_id","op_status!='D' AND op_uname='".$conn->variable($op_uname)."'","1");
		if(!$User['nr'])
		{
			$password=$conn->encode($_REQUEST['password']);
			$feat_id=@implode(",",$feat);
			$new=array('op_password'=>$password,'feat_id'=>$feat_id,'op_dt'=>NOW,'op_status'=>'Y');
			$ins = $conn->insert(OPERATOR,"",$new);
			if($ins)
			{
				$succAlert = "Successfully Saved.";
				$conn->adminAlert($pageKey,$succAlert);
				$conn->divert(ADMIN_URL.$path_folder.'list.php');
			}
		}else
		{
			$sel=$_REQUEST;
			$sel['op_uname']='';
			$errAlert = "Username already exist.";
		}
	}else
	{
		$sel=$_REQUEST;
		$errAlert = "Please fill required fields.";
	}
}
?>
<?php #Admin Html head
$conn->adminHtmlhead(); 
$conn->admninBody();
?>
<div class="wrapper">
  <?php include "../layout/header.php"; ?>
  <?php include "../layout/slidebar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $Pagetitle['title']; ?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo ADMIN_URL; ?>common/home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $Pagetitle['title']; ?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <?php include "submenu.php"; ?>
      <!-- Default box -->
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <?php if($errAlert){?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $errAlert; ?> </div>
          <?php }?>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title text-navy">Add <?php echo $Pagetitle['title']; ?></h3>
              <div class="pull-right"> <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                <!-- text input -->
                <div class="form-group">
                  <label>Name <span class="text-red">*</span></label>
                  <input  name="op_name" id="op_name" type="text" class="form-control validate[required]" placeholder="Enter Name" maxlength="200" value="<?php echo  $conn->stripval($sel['op_name']);?>" />
                </div>
                <div class="form-group">
                  <label>Username <span class="text-red">*</span></label>
                  <input name="op_uname" id="op_uname" type="text" class="form-control validate[required,funcCall[checkoperator],custom[username]]" placeholder="Username" maxlength="50" />
                </div>
                <div class="form-group">
                  <label>Password <span class="text-red">*</span></label>
                  <input name="password" id="password" type="text" class="form-control validate[required,minSize[5]]" placeholder="Username" maxlength="30" value="<?php echo $conn->get_rand_id(6);?>"  />
                </div>
                <div class="box-header">
                  <h3 class="box-title text-navy">Features</h3>
                  <div class="box-tools pull-right">
                    <label>
                      <input name="all" class="mall"  type="checkbox" value="<?php echo $res['banner_id']; ?>"  onclick="mark();" />
                      &nbsp;Select All</label>
                  </div>
                </div>
                <div class="form-group">
                  <?php $i=1;
				$Menus = $conn->select_query(ADMINMENU,"*","pid='0' AND menu_status='Y' order by menu_pos","");
				if($Menus['nr'])
				{
				foreach ($Menus['result'] as $resmenu)
				{ ?>
                  <div class="col-md-4" >
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="feat[]" id="feat<?php echo $resmenu['menu_id']; ?>" class="opfeat validate[minCheckbox[1]]"  value="<?php echo $resmenu['menu_id']; ?>" />
                        <?php echo $resmenu['menu_title']; ?></label>
                    </div>
                  </div>
                  <?php  }}?>
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
<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_new").validationEngine();
setTimeout("document.getElementById('op_name').focus(); ", 500 ); 
});
function checkoperator(field, rules, i, options)
{
	var rvalue=false;
	if(field.val()!="")
	{
		$.ajax({url: '<?php echo ADMIN_URL.$path_folder."ajax.php" ?>',type: 'post',async:false,data:{ "func": "checkoperator", "id": $('#op_uname').val() ,"edit":"<?php echo $sel['op_id'] ?>"},
		success:function(result)
		{
			if(result=="wrong")
			{
				rvalue=true;
			}
		}});
	}
	if(rvalue)
	{
		return options.allrules.validate2User.alertText;
	}
}

function mark()
{
	var x=$(".mall").is(":checked");
	if(x)
	{
		$(".opfeat").prop("checked",true);
		return false;
	}else
	{
		$(".opfeat").prop("checked",false);
		return false;
	}
}
function checkmark()
{
	var val;
	temp=true;
	$('.opfeat').each(function() {
		var $this = $(this);
		val=$(this).is(":checked");
		temp=(val&&temp)?true :false;
		
	});
	
	if(temp)
	{
		$(".mall").prop("checked",true);
	}else
	{
		$(".mall").prop("checked",false);
	}
	
}

$('.opfeat').on('change', checkmark);
</script>
</body>
</html>