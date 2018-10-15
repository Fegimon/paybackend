<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Page Config
include "pageconfig.php";

  $id = $conn->variable($q);
  $sel = $conn->select_query(Tax,"*","tax_id='".$id."'","1");
  if(!$sel['nr'] && !empty($id))
{
  $conn->divert(ADMIN_URL.$path_folder.'list.php');
}

if($id){
  $btn_name="edit";
} else {
  $btn_name="add";
}
  if(isset($edit))
  {
      $ins = $conn->update(Tax,"tax_id='".$id."'",$new);
      if($ins)
      {
        $succAlert = "Successfully Updated.";
        $conn->adminAlert($pageKey,$succAlert);
        $rpage=(isset($_REQUEST['rpage']))? base64_decode($_REQUEST['rpage']):ADMIN_URL.$path_folder.'list.php';
        $conn->divert($rpage);
      }

  }


  if(isset($add))
{

    $new = array('tax_status'=>'Y','tax_dt'=>NOW);
    $ins = $conn->insert(Tax,"",$new);
    if($ins)
    {
      $succAlert = "Successfully Saved.";
      $conn->adminAlert($pageKey,$succAlert);
      $conn->divert(ADMIN_URL.$path_folder.'list.php');
    
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
                  <h3 class="box-title text-navy"><?php echo ucfirst($btn_name).' '.$Pagetitle['title']; ?></h3>
                  <div class="pull-right">
                  <a style="margin-right:4px;" class="btn  btn-default btn-xs text-purple" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i> Back</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                    <!-- text input -->
					<div class="form-group">
                      <label>Name <span class="text-red">*</span></label>
                      <input  name="tax_name" id="tax_name" type="text" class="form-control validate[required]" placeholder="Enter Name" maxlength="200" value="<?php echo $conn->stripval($sel['tax_name']);?>" />
                    </div>
					<div class="form-group">
                  <label>Tax Percentage <span class="text-red">*</span></label>
                  <input  name="tax_percentage" id="tax_percentage" type="text" class="form-control validate[required]" placeholder="Enter Percentage" maxlength="200" value="<?php echo $conn->stripval($sel['tax_percentage']);?>" />
                  </div>
                    <div class="form-group">
                      <label>Position <span class="text-red">*</span></label>
                      <input name="tax_pos" id="tax_pos" type="text" class="form-control validate[required,custom[integer]] " placeholder="Enter Position"  maxlength="2"  style="width:110px;" value="<?php echo $conn->stripval($sel['tax_pos']);?>" />
                      </div>
                    <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
                    <button class="btn btn-primary" name="<?php echo $btn_name; ?>" id="<?php echo $btn_name; ?>" type="submit">Submit</button></center>
                  </div>

                  </form>
                </div><!-- /.box-body -->
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
<!--File upload-->
<link href="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" charset="utf-8" src="<?php echo ADMIN_URL; ?>plugins/fileinputupload/fileinput.min.js"></script> 

<script type="text/javascript">  
 jQuery(document).ready(function() {
jQuery("#frm_new").validationEngine();
setTimeout("document.getElementById('banner_title').focus(); ", 500 ); 
});

</script>
</body>
</html>