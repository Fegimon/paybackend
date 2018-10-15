<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();

#Module Common Config
$Menutoken=$pageKey="1";
$path_folder = "common/";
$conn->valoperator("1");

$admin_id = $_SESSION['admin_id'];
$sel = $conn->select_query(ADMIN,"*","admin_id='1'","1");
if($sel['setting_fields']!='')
{
  $res = @unserialize($sel['setting_fields']);
  array_walk($res,'decode_ArrayWalk');
}

if(isset($btn_sub)) 
{ 
  if($sitename && $set_url && $fields['set_bpsize'])
  {
    if(count($res))
    {
      foreach( $res as $key=>$rval)
      {
        if(!$fields[$key] && !@array_key_exists ($key,$fields))
        {
          $fields[$key]=$rval;
        }
      }
    }
    
      #Older browser support
      array_walk($fields,'encode_ArrayWalk');
      $extra=@serialize($fields);
      
      #image upload
      $setting_logo=$conn->adminupload('settinglogo',"../../uploads/common/");
      if($setting_logo)
      {
        $arr=array("setting_logo"=>$setting_logo,'setting_fields'=>$extra);
        $upd = $conn->update(ADMIN,"admin_id='1'",$arr,"../../uploads/common/","",$sitename);
        if($upd)
        {
          $succAlert = "Settings Successfully Saved.";
          $conn->adminAlert($pageKey,$succAlert);
          $conn->divert(ADMIN_URL.'common/admin_settings.php');
        }
        
      }else
      {
        $errAlert = "Error in File upload";
     }
}
}
$succAlert=$conn->getadminAlert($pageKey);

$conn->adminHtmlhead($extrahead);
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
                  <h3 class="box-title text-navy"><?php echo $Pagetitle['title']; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form role="form" method="post" name="frm_new" id="frm_new" action="" enctype="multipart/form-data">
                    <!-- text input -->
					         <div class="form-group">
                      <label>Helps Your Wallet <span class="text-red">*</span></label>
                      <input  name="fields[wallet]" id="wallet" type="text" class="form-control validate[required]" placeholder="Enter Quote" maxlength="200" value="<?php echo $conn->stripval($sel['wallet']); ?>" />
                    </div>

                    <div class="form-group">
                      <label>Rent To Own <span class="text-red">*</span></label>
                      <input  name="fields[rent]" id="rent" type="text" class="form-control validate[required]" placeholder="Enter Quote" maxlength="200" value="<?php echo $conn->stripval($sel['rent']);?>" />
                    </div>

                    <div class="form-group">
                      <label>Saves Time <span class="text-red">*</span></label>
                      <input  name="fields[time]" id="time" type="text" class="form-control validate[required]" placeholder="Enter Quote" maxlength="200" value="<?php echo $conn->stripval($sel['time']);?>" />
                    </div>

                    <div class="form-group">
                      <label>Service and Maintenance <span class="text-red">*</span></label>
                      <input  name="fields[service]" id="service" type="text" class="form-control validate[required]" placeholder="Enter Quote" maxlength="200" value="<?php echo $conn->stripval($sel['service']);?>" />
                    </div>
					
                    <div class="box-footer"><center><input type="hidden" name="successkey" id="successkey"  value="" />
                    <button class="btn btn-primary" name="btn_sub" id="btn_sub" type="submit">Submit</button></center>
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